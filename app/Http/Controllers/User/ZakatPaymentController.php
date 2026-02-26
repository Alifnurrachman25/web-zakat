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
    public function index()
    {
        $payments = ZakatPayment::with('zakatType', 'riceType', 'perumahan', 'rt')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('user.zakat.index', compact('payments'));
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
            'blok' => 'nullable|string|max:50',
            'phone' => 'nullable|string|max:20',
            'zakat_type_id' => 'required|exists:zakat_types,id',
            'rice_type_id' => 'nullable|exists:rice_types,id',
            'jumlah_jiwa' => 'required|integer|min:1',
            'metode_pembayaran' => 'required|in:tunai,beras',
            'bayar' => 'required|integer|min:0',
        ]);

        $wajib_bayar = $request->metode_pembayaran === 'beras' && $request->rice_type_id
            ? RiceType::find($request->rice_type_id)->price * $request->jumlah_jiwa
            : 48000 * $request->jumlah_jiwa;

        $infaq = max(0, $request->bayar - $wajib_bayar);

        ZakatPayment::create([
            'user_id' => auth()->id(),
            'nama_muzakki' => $request->nama_muzakki,
            'perumahan_id' => $request->perumahan_id,
            'rt_id' => $request->rt_id,
            'blok' => $request->blok,
            'phone' => $request->phone,
            'zakat_type_id' => $request->zakat_type_id,
            'rice_type_id' => $request->rice_type_id,
            'jumlah_jiwa' => $request->jumlah_jiwa,
            'metode_pembayaran' => $request->metode_pembayaran,
            'bayar' => $request->bayar,
            'infaq' => $infaq,
        ]);

        return redirect()->route('user.zakat.index')->with('success', 'Pembayaran berhasil disimpan');
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
        $request->validate([
            'nama_muzakki' => 'required|string|max:255',
            'perumahan_id' => 'required|exists:perumahans,id',
            'rt_id' => 'required|exists:rts,id',
            'blok' => 'nullable|string|max:50',
            'phone' => 'nullable|string|max:20',
            'zakat_type_id' => 'required|exists:zakat_types,id',
            'rice_type_id' => 'nullable|exists:rice_types,id',
            'jumlah_jiwa' => 'required|integer|min:1',
            'metode_pembayaran' => 'required|in:tunai,beras',
            'bayar' => 'required|integer|min:0',
        ]);

        $wajib_bayar = $request->metode_pembayaran === 'beras' && $request->rice_type_id
            ? RiceType::find($request->rice_type_id)->price * $request->jumlah_jiwa
            : 48000 * $request->jumlah_jiwa;

        $infaq = max(0, $request->bayar - $wajib_bayar);

        $zakat->update([
            'nama_muzakki' => $request->nama_muzakki,
            'perumahan_id' => $request->perumahan_id,
            'rt_id' => $request->rt_id,
            'blok' => $request->blok,
            'phone' => $request->phone,
            'zakat_type_id' => $request->zakat_type_id,
            'rice_type_id' => $request->rice_type_id,
            'jumlah_jiwa' => $request->jumlah_jiwa,
            'metode_pembayaran' => $request->metode_pembayaran,
            'bayar' => $request->bayar,
            'infaq' => $infaq,
        ]);

        return redirect()->route('user.zakat.index')->with('success', 'Pembayaran berhasil diperbarui');
    }

    // Destroy
    public function destroy(ZakatPayment $zakat)
    {
        $zakat->delete();
        return redirect()->route('user.zakat.index')->with('success', 'Pembayaran berhasil dihapus');
    }
}
