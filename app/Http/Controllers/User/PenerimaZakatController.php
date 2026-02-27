<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\PenerimaZakat;
use App\Models\Perumahan;
use App\Models\Rt;
use Illuminate\Http\Request;

class PenerimaZakatController extends Controller
{
    public function index(Request $request)
    {
        $query = PenerimaZakat::query();

        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('blok', 'like', '%' . $request->search . '%');
        }

        $data = $query->latest()->paginate(10);

        return view('user.penerima-zakat.index', compact('data'));
    }

    public function create()
    {
        $perumahans = Perumahan::orderBy('name')->get();
        $rts = Rt::orderBy('name')->get();

        return view('user.penerima-zakat.create', compact('perumahans', 'rts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'perumahan' => 'required',
            'blok' => 'required',
            'rt' => 'required',
            'notes' => 'nullable',
        ]);

        PenerimaZakat::create($validated);

        return redirect()->route('user.penerima-zakat.index')
            ->with('success', 'Data penerima zakat berhasil ditambahkan');
    }

    public function edit(PenerimaZakat $penerima_zakat)
    {
        $perumahans = Perumahan::orderBy('name')->get();
        $rts = Rt::orderBy('name')->get();

        return view('user.penerima-zakat.edit', compact(
            'penerima_zakat',
            'perumahans',
            'rts'
        ));
    }

    public function update(Request $request, PenerimaZakat $penerima_zakat)
    {
        $validated = $request->validate([
            'name' => 'required',
            'perumahan' => 'required',
            'blok' => 'required',
            'rt' => 'required',
            'notes' => 'nullable',
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
