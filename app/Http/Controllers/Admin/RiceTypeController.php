<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RiceType;
use Illuminate\Http\Request;

class RiceTypeController extends Controller
{
    public function index()
    {
        $riceTypes = RiceType::latest()->get();
        return view('admin.rice-types.index', compact('riceTypes'));
    }

    public function create()
    {
        return view('admin.rice-types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|integer|min:0',
        ]);

        RiceType::create($request->all());

        return redirect()->route('admin.rice-types.index')
            ->with('success', 'Jenis beras berhasil ditambahkan');
    }

    public function edit(RiceType $riceType)
    {
        return view('admin.rice-types.edit', compact('riceType'));
    }

    public function update(Request $request, RiceType $riceType)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|integer|min:0',
        ]);

        $riceType->update($request->all());

        return redirect()->route('admin.rice-types.index')
            ->with('success', 'Jenis beras berhasil diperbarui');
    }

    public function destroy(RiceType $riceType)
    {
        $riceType->delete();

        return back()->with('success', 'Jenis beras berhasil dihapus');
    }
}
