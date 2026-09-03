<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use App\Http\Requests\SearchRequest;
use Illuminate\Http\Request;

class JenisController extends Controller
{
    public function index(SearchRequest $request)
    {
        $this->authorize('viewAny', Jenis::class);

        $keyword = $request->input('search');

        $jenis = Jenis::when($keyword, function ($query) use ($keyword) {
                $query->where('nama_jenis', 'like', '%' . $keyword . '%');
            })
            ->withCount('produk')
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('jenis.index', compact('jenis'));
    }

    public function create()
    {
        $this->authorize('viewAny', Jenis::class);

        // Inisialisasi model kosong untuk mode Create
        $jenis = new Jenis();

        return view('jenis.create', compact('jenis'));
    }

    public function store(Request $request)
    {
        $this->authorize('viewAny', Jenis::class);

        $request->validate([
            'nama_jenis' => 'required|string|max:255|unique:jenis,nama_jenis',
        ]);

        Jenis::create($request->only('nama_jenis'));

        return redirect()->route('jenis.index')->with('success', 'Jenis berhasil ditambahkan.');
    }

    public function edit(Jenis $jenis)
    {
        $this->authorize('viewAny', Jenis::class);

        return view('jenis.edit', compact('jenis'));
    }

    public function update(Request $request, Jenis $jenis)
    {
        $this->authorize('viewAny', Jenis::class);

        $request->validate([
            'nama_jenis' => 'required|string|max:255|unique:jenis,nama_jenis,' . $jenis->id,
        ]);

        $jenis->update($request->only('nama_jenis'));

        return redirect()->route('jenis.index')->with('success', 'Jenis berhasil diupdate.');
    }

    public function destroy(Jenis $jenis)
    {
        $this->authorize('delete', $jenis);

        if ($jenis->produk()->exists()) {
            return back()->with('errors', 'Jenis tidak bisa dihapus karena masih dipakai produk.');
        }

        $jenis->delete();

        return redirect()->route('jenis.index')->with('success', 'Jenis berhasil dihapus.');
    }
}