<?php

namespace App\Http\Controllers;

use App\Http\Requests\Produk\StoreRequest;
use App\Http\Requests\Produk\UpdateRequest;
use App\Http\Requests\SearchRequest;
use App\Models\Produk;
use App\Models\Jenis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index(SearchRequest $request)
    {
        $this->authorize('viewAny', Produk::class);

        $keyword = $request->input('search');

        $products = Produk::with(['jenis', 'user'])
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('nama', 'like', '%' . $keyword . '%');
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('produk.index', compact('products'));
    }

    public function create()
    {
        $this->authorize('create', Produk::class);

        $jenis = Jenis::all();

        return view('produk.create', compact('jenis'));
    }

    public function store(StoreRequest $request)
    {
        $this->authorize('create', Produk::class);

        $dataReq = $request->validated();

        $data['jenis_id']   = $dataReq['jenis_id'];
        $data['user_id']    = Auth::id();
        $data['nama']       = $dataReq['name'];
        $data['harga_beli'] = $dataReq['purchase_price'];
        $data['harga_jual'] = $dataReq['selling_price'];
        $data['stok']       = $dataReq['stock'] ?? 0;

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('products', 'public');
        }

        Produk::create($data);

        return redirect()->route('produk.index')->with('success', 'Product created successfully.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Produk $produk)
    {
        $this->authorize('view', $produk);

        $jenis = Jenis::all();

        return view('produk.edit', compact('produk', 'jenis'));
    }

    public function update(UpdateRequest $request, Produk $produk)
    {
        $this->authorize('update', $produk);
        $dataReq = $request->validated();

        $data = [
            'jenis_id'   => $dataReq['jenis_id'],
            'user_id'    => Auth::id(),
            'nama'       => $dataReq['name'],
            'harga_beli' => $dataReq['purchase_price'],
            'harga_jual' => $dataReq['selling_price'],
            'stok'       => $dataReq['stock'],
        ];

        if ($request->hasFile('foto')) {
            if ($produk->foto && Storage::disk('public')->exists($produk->foto)) {
                Storage::disk('public')->delete($produk->foto);
            }
            $data['foto'] = $request->file('foto')->store('products', 'public');
        }

        $produk->update($data);

        return redirect()->route('produk.edit', $produk->id)->with('success', 'Product updated successfully.');
    }

    public function destroy(Produk $produk)
    {
        $this->authorize('delete', $produk);

        if ($produk->foto) {
            Storage::disk('public')->delete($produk->foto);
        return redirect()->route('produk.index')->with('success', 'Product berhasil dihapus.');
    }
}
}