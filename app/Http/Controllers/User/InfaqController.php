<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Infaq;
use App\Models\ZakatPayment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class InfaqController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Infaq::where('user_id', auth()->id());

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('imam', 'like', '%' . $request->search . '%')
                    ->orWhere('kultum', 'like', '%' . $request->search . '%')
                    ->orWhere('bilal', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->tanggal) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        $infaqs = $query->latest('tanggal')->paginate(10);

        // 🔥 TOTAL MANUAL (semua manual dijumlah dulu)
        $totalManual = Infaq::where('user_id', auth()->id())
            ->when($request->tanggal, function ($q) use ($request) {
                $q->whereDate('tanggal', $request->tanggal);
            })
            ->sum('pemasukan_manual');

        // 🔥 TOTAL DARI ZAKAT (hanya sekali per tanggal)
        $totalDariZakat = ZakatPayment::where('user_id', auth()->id())
            ->when($request->tanggal, function ($q) use ($request) {
                $q->whereDate('created_at', $request->tanggal);
            })
            ->where('metode_pembayaran', 'tunai')
            ->sum('infaq');

        // 🔥 TOTAL AKHIR
        $grandTotal = $totalManual + $totalDariZakat;

        return view('user.infaq.index', compact(
            'infaqs',
            'totalManual',
            'totalDariZakat',
            'grandTotal'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.infaq.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'pemasukan_manual' => 'required|integer|min:0',
            'imam' => 'required|string|max:255',
            'kultum' => 'required|string|max:255',
            'bilal' => 'required|string|max:255',
        ]);

        $infaqZakat = ZakatPayment::whereDate('created_at', $request->tanggal)
            ->where('user_id', auth()->id())
            ->sum('infaq');

        $total = $request->pemasukan_manual + $infaqZakat;

        Infaq::create([
            'tanggal' => $request->tanggal,
            'pemasukan_manual' => $request->pemasukan_manual,
            'pemasukan_dari_zakat' => $infaqZakat,
            'total_pemasukan' => $total,
            'imam' => $request->imam,
            'kultum' => $request->kultum,
            'bilal' => $request->bilal,
            'user_id' => auth()->id(),
        ]);

        return redirect()
            ->route('user.infaq.index')
            ->with('success', 'Data infaq berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Infaq $infaq)
    {
        $this->authorize('view', $infaq);

        return view('user.infaq.show', compact('infaq'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Infaq $infaq)
    {

        return view('user.infaq.edit', compact('infaq'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Infaq $infaq)
    {

        $request->validate([
            'tanggal' => 'required|date',
            'pemasukan_manual' => 'required|integer|min:0',
            'imam' => 'required|string|max:255',
            'kultum' => 'required|string|max:255',
            'bilal' => 'required|string|max:255',
        ]);

        $infaqZakat = ZakatPayment::whereDate('created_at', $request->tanggal)
            ->where('user_id', auth()->id())
            ->sum('infaq');

        $total = $request->pemasukan_manual + $infaqZakat;

        $infaq->update([
            'tanggal' => $request->tanggal,
            'pemasukan_manual' => $request->pemasukan_manual,
            'pemasukan_dari_zakat' => $infaqZakat,
            'total_pemasukan' => $total,
            'imam' => $request->imam,
            'kultum' => $request->kultum,
            'bilal' => $request->bilal,
        ]);

        return redirect()
            ->route('user.infaq.index')
            ->with('success', 'Data infaq berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Infaq $infaq)
    {

        $infaq->delete();

        return redirect()
            ->route('user.infaq.index')
            ->with('success', 'Data infaq berhasil dihapus.');
    }
}
