<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ZakatType;
use Illuminate\Http\Request;

class ZakatTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $zakatTypes = ZakatType::all();
        return view('admin.zakat-types.index', compact('zakatTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.zakat-types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        ZakatType::create([
            'name' => $request->name
        ]);

        return redirect()->route('admin.zakat-types.index')
            ->with('success', 'Jenis Zakat berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ZakatType $zakatType)
    {
        return view('admin.zakat-types.edit', compact('zakatType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ZakatType $zakatType)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255|unique:zakat_types,name,' . $zakatType->id,
        ], [
            'name.required' => 'Nama jenis zakat wajib diisi.',
            'name.unique' => 'Nama jenis zakat sudah ada.',
            'name.max' => 'Nama jenis zakat maksimal 255 karakter.',
        ]);

        $zakatType->update([
            'name' => $request->name
        ]);

        return redirect()->route('admin.zakat-types.index')
            ->with('success', 'Jenis Zakat berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ZakatType $zakatType)
    {
        try {
            $zakatType->delete();

            return redirect()->route('admin.zakat-types.index')
                ->with('success', 'Jenis Zakat berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('admin.zakat-types.index')
                ->with('error', 'Gagal menghapus jenis zakat. Pastikan tidak ada data terkait.');
        }
    }
}
