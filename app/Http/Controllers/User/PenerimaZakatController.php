<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\KategoriPenerima;
use App\Models\PenerimaZakat;
use App\Models\Perumahan;
use App\Models\Rt;
use Illuminate\Http\Request;

class PenerimaZakatController extends Controller
{
    public function index(Request $request)
    {
        $query = PenerimaZakat::query();
        $perumahans = Perumahan::orderBy('name')->get();
        $rts = Rt::orderBy('name')->get();

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('blok', 'like', '%' . $request->search . '%');
            });
        }

        // Filter Perumahan
        if ($request->perumahan) {
            $query->where('perumahan', $request->perumahan);
        }

        // Filter RT
        if ($request->rt) {
            $query->where('rt', $request->rt);
        }

        $filterLabel = 'Semua Data';

        if ($request->perumahan && $request->rt) {
            $filterLabel = 'Perumahan ' . $request->perumahan . ' - ' . $request->rt;
        } elseif ($request->perumahan) {
            $filterLabel = 'Perumahan ' . $request->perumahan;
        } elseif ($request->rt) {
            $filterLabel = $request->rt;
        }


        $data = $query->latest()->paginate(10);

        return view('user.penerima-zakat.index', compact('data', 'perumahans', 'rts', 'filterLabel'));
    }

    public function create()
    {
        $perumahans = Perumahan::orderBy('name')->get();
        $rts = Rt::orderBy('name')->get();
        $kategori_penerimas = KategoriPenerima::orderBy('name')->get();

        return view('user.penerima-zakat.create', compact('perumahans', 'rts', 'kategori_penerimas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'perumahan' => 'required',
            'blok' => 'required',
            'rt' => 'required',
            'kategori' => 'required',
        ]);

        PenerimaZakat::create($validated);

        return redirect()->route('user.penerima-zakat.index')
            ->with('success', 'Data penerima zakat berhasil ditambahkan');
    }

    public function edit(PenerimaZakat $penerima_zakat)
    {
        $perumahans = Perumahan::orderBy('name')->get();
        $rts = Rt::orderBy('name')->get();
        $kategori_penerimas = KategoriPenerima::orderBy('name')->get();

        return view('user.penerima-zakat.edit', compact(
            'penerima_zakat',
            'perumahans',
            'rts',
            'kategori_penerimas'
        ));
    }

    public function update(Request $request, PenerimaZakat $penerima_zakat)
    {
        $validated = $request->validate([
            'name' => 'required',
            'perumahan' => 'required',
            'blok' => 'required',
            'rt' => 'required',
            'kategori' => 'required',
        ]);

        $penerima_zakat->update($validated);

        return redirect()->route('user.penerima-zakat.index')
            ->with('success', 'Data berhasil diperbarui');
    }

    public function destroy(PenerimaZakat $penerima_zakat)
    {
        $penerima_zakat->delete();

        return back()->with('success', 'Data berhasil dihapus');
    }
}
