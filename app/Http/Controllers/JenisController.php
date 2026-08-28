<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use Illuminate\Http\Request;

class JenisController extends Controller
{
    public function index()
    {
        $jenis = Jenis::latest()->paginate(10);
        return view('jenis.index', compact('jenis'));
    }

    public function create()
    {
        return view('jenis.create');
    }

    public function store(Request $request)
    {
        $request->validate(['nama_jenis' => 'required|string|max:255']);
        Jenis::create($request->all());

        return redirect()->route('jenis.index')->with('success', 'Jenis berhasil ditambahkan.');
    }

    public function edit(Jenis $jeni)
    {
        return view('jenis.edit', ['jenis' => $jeni]);
    }

    public function update(Request $request, Jenis $jeni)
    {
        $request->validate(['nama_jenis' => 'required|string|max:255']);
        $jeni->update($request->all());

        return redirect()->route('jenis.index')->with('success', 'Jenis berhasil diperbarui.');
    }

    public function destroy(Jenis $jeni)
    {
        $jeni->delete();
        return redirect()->route('jenis.index')->with('success', 'Jenis berhasil dihapus.');
    }
}