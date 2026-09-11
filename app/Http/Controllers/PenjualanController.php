<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Http\Requests\StoreRequest;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SearchRequest $request)
    {
        $user = Auth::user();
        $keyword = $request->input('search');

        $sales = Penjualan::query()
            // Filter berdasarkan role
            ->when($user->role->name === 'kasir', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            // Search nama user
            ->when($keyword, function ($query) use ($keyword) {
                $query->whereHas('user', function ($q) use ($keyword) {
                    $q->where('name', 'like', '%' . $keyword . '%');
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('penjualan.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(SearchRequest $request)
    {
        // Cari atau buat draf transaksi aktif untuk user yang login
        $sale = Penjualan::firstOrCreate(
            [
                'user_id' => Auth::id(),
                'status'  => 'OPEN',
            ],
            [
                'total_pembayaran'  => 0,
                'metode_pembayaran' => 'CASH',
            ]
        );

        $keyword = $request->input('search');

        // Pencarian Produk
        $products = Produk::when($keyword, function ($query) use ($keyword) {
                $query->where('nama', 'like', '%' . $keyword . '%');
            })
            ->orderBy('nama')
            ->get();

        $mode = 'create';

        return view('penjualan.pos', compact('sale', 'products', 'mode'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Opsional: Digunakan jika pembuatan transaksi dilakukan via submit Form POST standar
    }

    /**
     * Display the specified resource.
     */
    public function show(Penjualan $penjualan)
    {
        $this->authorize('view', $penjualan);

        $penjualan->load(['user', 'itemPenjualan.produk.jenis']);

        return view('penjualan.show', compact('penjualan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penjualan $penjualan)
    {
        abort_if($penjualan->status === 'COMPLETED', 403, 'Transaksi yang sudah selesai tidak dapat diubah.');

        $sale = $penjualan;
        $sale->load('itemPenjualan.produk');
        
        $products = Produk::orderBy('nama')->get();
        $mode = 'edit';

        return view('penjualan.pos', compact('sale', 'products', 'mode'));
    }

    /**
     * Update the specified resource in storage (Checkout Process).
     */
    public function update(Request $request, Penjualan $penjualan)
{
    $request->validate([
        'payment_method' => 'required|in:CASH,QRIS',
        'cash_amount'    => 'nullable|numeric|min:' . $penjualan->total_pembayaran,
    ]);

    if ($penjualan->status !== 'OPEN') {
        return back()->with('error', 'Transaksi sudah diproses.');
    }

    if ($penjualan->itemPenjualan()->count() === 0) {
        return back()->with('error', 'Keranjang belanja masih kosong.');
    }

    DB::transaction(function () use ($penjualan, $request) {

        // 1. Potong stok produk
        foreach ($penjualan->itemPenjualan as $item) {
            if ($item->produk->stok < $item->kuantitas) {
                throw new \Exception("Stok untuk produk '{$item->produk->nama}' tidak mencukupi.");
            }

            $item->produk->decrement('stok', $item->kuantitas);
        }

        // 2. Hitung ulang total
        $total = $penjualan->itemPenjualan()->sum('subtotal');

        // 3. Hitung nominal tunai dan kembalian
        $cashAmount = $request->payment_method === 'CASH' ? ($request->cash_amount ?? 0) : $total;
        $kembalian  = $request->payment_method === 'CASH' ? ($cashAmount - $total) : 0;

        // 4. Update data penjualan ke database
        $penjualan->update([
            'metode_pembayaran' => $request->payment_method,
            'total_pembayaran'  => $total,
            'cash_amount'       => $cashAmount, // <-- TANGKAP INPUTAN UANG
            'kembalian'         => $kembalian,  // <-- SIMPAN KEMBALIAN
            'status'            => 'COMPLETED',
        ]);
    });

    return redirect()
        ->route('penjualan.index')
        ->with('success', 'Transaksi berhasil diselesaikan.');
}

    /**
     * Remove the specified resource from storage (Batal Transaksi).
     */
    public function destroy(Penjualan $penjualan)
    {
        $this->authorize('delete', $penjualan);

        if ($penjualan->status !== 'OPEN') {
            return redirect()
                ->route('penjualan.index')
                ->with('error', 'Transaksi yang sudah selesai tidak dapat dibatalkan.');
        }

        DB::transaction(function () use ($penjualan) {
            // Hapus item-item dalam keranjang
            $penjualan->itemPenjualan()->delete();

            // Hapus data transaksi utama
            $penjualan->delete();
        });

        return redirect()
            ->route('penjualan.index')
            ->with('success', 'Transaksi berhasil dibatalkan.');
    }

    /**
     * Print Receipt / Struk.
     */
    public function print(int $id)
    {
        $sale = Penjualan::with(['user', 'itemPenjualan.produk'])->findOrFail($id);

        return view('penjualan.print', compact('sale'));
    }
}