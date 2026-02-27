<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ZakatPayment;
use App\Models\ZakatType;
use App\Models\RiceType;
use App\Models\Perumahan;
use App\Models\Rt;

class ZakatPaymentController extends Controller
{
    // Index
    public function index(Request $request)
    {
        $search = $request->search;
        $perumahan = $request->perumahan;
        $rt = $request->rt;
        $zakat = $request->zakat;

        $payments = ZakatPayment::with('zakatType', 'riceType', 'perumahan', 'rt')
            ->where('user_id', auth()->id())

            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama_muzakki', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%")
                        ->orWhere('blok', 'like', "%{$search}%")
                        ->orWhereHas('zakatType', function ($z) use ($search) {
                            $z->where('name', 'like', "%{$search}%");
                        });
                });
            })

            ->when($perumahan, fn($q) => $q->where('perumahan_id', $perumahan))
            ->when($rt, fn($q) => $q->where('rt_id', $rt))
            ->when($zakat, fn($q) => $q->where('zakat_type_id', $zakat))

            ->latest()
            ->paginate(10)
            ->withQueryString();

        if ($request->ajax()) {
            return view('user.zakat.partials.table', compact('payments'))->render();
        }

        $perumahans = Perumahan::all();
        $rts = Rt::all();
        $zakatTypes = ZakatType::all();

        return view('user.zakat.index', compact(
            'payments',
            'perumahans',
            'rts',
            'zakatTypes'
        ));
    }

    // Create
    public function create()
    {
        $zakatTypes = ZakatType::all();
        $riceTypes = RiceType::all();
        $perumahans = Perumahan::all();
        $rts = Rt::all();

        return view('user.zakat.create', compact('zakatTypes', 'riceTypes', 'perumahans', 'rts'));
    }

    // Store
    public function store(Request $request)
    {
        $request->validate([
            'nama_muzakki' => 'required|string|max:255',
            'perumahan_id' => 'required|exists:perumahans,id',
            'rt_id' => 'required|exists:rts,id',
            'zakat_type_id' => 'required|exists:zakat_types,id',
            'jumlah_jiwa' => 'required|integer|min:0',
            'metode_pembayaran' => 'required|in:tunai,beras',

            // validasi dasar (akan dipersempit di bawah)
            'bayar' => 'nullable|integer|min:0',
            'beras_kg' => 'nullable|numeric|min:0',
            'rice_type_id' => 'nullable|exists:rice_types,id',
        ]);

        $zakatType = ZakatType::findOrFail($request->zakat_type_id);
        $isFitrah = strtolower($zakatType->name) === 'zakat fitrah';

        // ===============================
        // JUMLAH ORANG
        // ===============================
        $jumlahJiwa = $isFitrah
            ? $request->jumlah_jiwa + 1 // muzakki + tanggungan
            : $request->jumlah_jiwa;   // zakat lain: apa adanya

        $bayar = 0;
        $infaq = 0;

        // ===============================
        // ZAKAT FITRAH
        // ===============================
        if ($isFitrah) {

            if ($request->metode_pembayaran === 'tunai') {

                if (!$request->rice_type_id) {
                    return back()->withErrors([
                        'rice_type_id' => 'Jenis beras wajib dipilih untuk zakat fitrah.'
                    ])->withInput();
                }

                $rice = RiceType::findOrFail($request->rice_type_id);
                $wajibBayar = $rice->price * $jumlahJiwa;

                if ($request->bayar < $wajibBayar) {
                    return back()->withErrors([
                        'bayar' => 'Nominal bayar tidak boleh kurang dari kewajiban zakat fitrah.'
                    ])->withInput();
                }

                $bayar = $request->bayar;
                $infaq = max(0, $bayar - $wajibBayar);
            } else {
                // === BERAS ===
                $wajibKg = $jumlahJiwa * 3;

                if ($request->beras_kg < $wajibKg) {
                    return back()->withErrors([
                        'beras_kg' => 'Jumlah beras tidak boleh kurang dari kewajiban zakat fitrah.'
                    ])->withInput();
                }

                $bayar = $wajibKg;
                $infaq = max(0, $request->beras_kg - $wajibKg);
            }
        }
        // ===============================
        // ZAKAT MAAL & FIDIYAH
        // ===============================
        else {
            // bebas, tidak ada kewajiban
            $bayar = $request->bayar ?? 0;
            $infaq = 0;
        }

        ZakatPayment::create([
            'user_id' => auth()->id(),
            'nama_muzakki' => $request->nama_muzakki,
            'perumahan_id' => $request->perumahan_id,
            'rt_id' => $request->rt_id,
            'blok' => $request->blok,
            'phone' => $request->phone,
            'zakat_type_id' => $request->zakat_type_id,
            'rice_type_id' => $isFitrah && $request->metode_pembayaran === 'tunai'
                ? $request->rice_type_id
                : null,
            'jumlah_jiwa' => $jumlahJiwa,
            'metode_pembayaran' => $request->metode_pembayaran,
            'bayar' => $bayar,
            'infaq' => $infaq,
        ]);

        return redirect()
            ->route('user.zakat.index')
            ->with('success', 'Pembayaran berhasil disimpan');
    }

    // Edit
    public function edit(ZakatPayment $zakat) // <-- nama parameter harus sama dengan {zakat}
    {
        $zakatTypes = ZakatType::all();
        $riceTypes = RiceType::all();
        $perumahans = Perumahan::all();
        $rts = Rt::all();

        return view('user.zakat.edit', compact('zakat', 'zakatTypes', 'riceTypes', 'perumahans', 'rts'));
    }

    // Update
    public function update(Request $request, ZakatPayment $zakat)
    {
        if ($zakat->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'nama_muzakki' => 'required|string|max:255',
            'perumahan_id' => 'required|exists:perumahans,id',
            'rt_id' => 'required|exists:rts,id',
            'blok' => 'nullable|string|max:50',
            'phone' => 'nullable|string|max:20',
            'zakat_type_id' => 'required|exists:zakat_types,id',
            'jumlah_jiwa' => 'required|integer|min:1', // TOTAL ORANG
            'metode_pembayaran' => 'required|in:tunai,beras',
            'rice_type_id' => 'required_if:metode_pembayaran,tunai|exists:rice_types,id',
            'bayar' => 'required_if:metode_pembayaran,tunai|integer|min:0',
            'beras_kg' => 'required_if:metode_pembayaran,beras|numeric|min:0',
        ]);

        // ✅ LANGSUNG PAKAI NILAI DARI FORM
        $totalOrang = $request->jumlah_jiwa;

        if ($request->metode_pembayaran === 'tunai') {
            $rice = RiceType::findOrFail($request->rice_type_id);
            $wajibBayar = $rice->price * $totalOrang;
            $bayar = $request->bayar;
            if ($bayar < $wajibBayar) {
                return back()
                    ->withErrors([
                        'bayar' => 'Nominal bayar tidak boleh kurang dari kewajiban zakat.'
                    ])
                    ->withInput();
            }
            $infaq = max(0, $bayar - $wajibBayar);
        } else {
            $wajibKg = $totalOrang * 3;
            if ($request->beras_kg < $wajibKg) {
                return back()
                    ->withErrors([
                        'beras_kg' => 'Jumlah beras tidak boleh kurang dari kewajiban zakat.'
                    ])
                    ->withInput();
            }
            $bayar = $wajibKg;
            $infaq = max(0, $request->beras_kg - $wajibKg);
        }

        $zakat->update([
            'nama_muzakki' => $request->nama_muzakki,
            'perumahan_id' => $request->perumahan_id,
            'rt_id' => $request->rt_id,
            'blok' => $request->blok,
            'phone' => $request->phone,
            'zakat_type_id' => $request->zakat_type_id,
            'rice_type_id' => $request->metode_pembayaran === 'tunai'
                ? $request->rice_type_id
                : null,
            'jumlah_jiwa' => $totalOrang,
            'metode_pembayaran' => $request->metode_pembayaran,
            'bayar' => $bayar,
            'infaq' => $infaq,
        ]);

        return redirect()->route('user.zakat.index')
            ->with('success', 'Data zakat berhasil diperbarui');
    }

    // Destroy
    public function destroy(ZakatPayment $zakat)
    {
        $zakat->delete();
        return redirect()->route('user.zakat.index')->with('success', 'Pembayaran berhasil dihapus');
    }
}
