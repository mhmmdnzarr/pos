<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\ItemPenjualan;
use App\Models\itemPenjualan as ModelsItemPenjualan;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
 
class ItemPenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
 
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
 
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:produk,id', // Sesuaikan nama tabel produk (produk/produks)
            'quantity'   => 'required|integer|min:1'
        ]);
 
        DB::transaction(function () use ($request) {
 
            // 🛠️ PERBAIKAN: Gunakan firstOrCreate agar jika transaksi 'OPEN' belum ada, otomatis dibuatkan baru!
            $sale = Penjualan::firstOrCreate(
                [
                    'user_id' => Auth::id(),
                    'status'  => 'OPEN',
                ],
                [
                    'total_pembayaran' => 0,
                    'payment_method'   => null,
                ]
            );
 
            $product = Produk::lockForUpdate()->findOrFail($request->product_id);
 
            // Cek ketersediaan stok SAJA — stok TIDAK dipotong di sini.
            // Stok baru benar-benar dipotong satu kali, saat checkout
            // (lihat PenjualanController@update). Ini mencegah stok
            // terpotong dua kali: sekali saat add-to-cart, sekali lagi
            // saat bayar.
            //
            // Catatan: kuantitas yang dibandingkan adalah TOTAL kuantitas
            // produk ini di keranjang (item lama + tambahan baru), bukan
            // cuma quantity yang baru diinput, supaya user tidak bisa
            // menambah produk yang sama berkali-kali melebihi stok yang ada.
            $existingItem = ItemPenjualan::where('penjualan_id', $sale->id)
                ->where('produk_id', $product->id)
                ->lockForUpdate()
                ->first();
 
            $kuantitasSebelumnya = $existingItem ? $existingItem->kuantitas : 0;
            $totalKuantitasDiKeranjang = $kuantitasSebelumnya + $request->quantity;
 
            if ($product->stok < $totalKuantitasDiKeranjang) {
                throw ValidationException::withMessages([
                    'quantity' => 'Stok produk tidak mencukupi (Tersisa: ' . $product->stok . ')'
                ]);
            }
 
            // Update / insert item penjualan
            if ($existingItem) {
                // UPDATE
                $existingItem->kuantitas = $totalKuantitasDiKeranjang;
                $existingItem->subtotal  = $existingItem->kuantitas * $existingItem->harga_satuan;
                $existingItem->save();
            } else {
                // CREATE
                ItemPenjualan::create([
                    'penjualan_id' => $sale->id,
                    'produk_id'    => $product->id,
                    'kuantitas'    => $request->quantity,
                    'harga_satuan' => $product->harga_jual,
                    'subtotal'     => $request->quantity * $product->harga_jual,
                ]);
            }
 
            // Hitung total pembayaran pada Penjualan
            $sale->total_pembayaran = $sale->itemPenjualan()->sum('subtotal');
            $sale->save();
        });
 
        // Redirect kembali ke halaman POS/Kasir
        return redirect()->route('penjualan.create')->with('success', 'Berhasil menambahkan produk ke keranjang!');
    }
 
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
 
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }
 
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }
 
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(itemPenjualan $itempenjualan)
    {
        $this->authorize('delete', $itempenjualan);
 
        // Catatan: karena stok sekarang TIDAK dipotong saat add-to-cart,
        // menghapus item dari keranjang (transaksi masih OPEN) TIDAK PERLU
        // mengembalikan stok — stok memang belum pernah dipotong untuk item ini.
        //
        // increment('stok', ...) di sini hanya benar untuk kasus PEMBATALAN
        // transaksi yang statusnya sudah COMPLETED (stoknya memang sudah
        // terlanjur terpotong saat checkout). Jika route ini HANYA dipakai
        // untuk hapus item dari keranjang yang masih OPEN, hapus baris
        // increment di bawah ini.
        DB::transaction(function () use ($itempenjualan) {
 
            $produk = $itempenjualan->produk;
            $sale   = $itempenjualan->penjualan;
 
            if ($sale->status === 'COMPLETED') {
                $produk->increment('stok', $itempenjualan->kuantitas);
            }
 
            $itempenjualan->delete();
 
            $sale->update([
                'total_pembayaran' => $sale->itemPenjualan()->sum('subtotal')
            ]);
        });
 
        return back();
    }
}
 