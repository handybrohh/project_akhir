<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    // Menampilkan semua transaksi penjualan
    public function tampil()
    {
        $penjualan = Penjualan::all();
        return view('penjualan', compact('penjualan'));
    }

    // Menambah transaksi penjualan
    public function tambah(Request $request)
    {
        $request->validate([
            'kode_transaksi' => 'required|unique:penjualan,kode_transaksi',
            'tanggal_penjualan' => 'required|date',
            'harga_per_barang' => 'required|numeric',
            'jumlah_barang' => 'required|integer|min:1',
        ]);

        // Periksa apakah stok produk mencukupi
        $produk = Produk::where('kode_barang', $request->kode_transaksi)->first();
        if (!$produk || $produk->stok < $request->jumlah_barang) {
            return back()->with('error', 'Stok tidak mencukupi.');
        }

        // Proses penjualan
        Penjualan::create([
            'kode_transaksi' => $request->kode_transaksi,
            'tanggal_penjualan' => $request->tanggal_penjualan,
            'harga_per_barang' => $request->harga_per_barang,
            'jumlah_barang' => $request->jumlah_barang,
            'total_harga' => $request->harga_per_barang * $request->jumlah_barang,
        ]);

        // Kurangi stok produk
        $produk->stok -= $request->jumlah_barang;
        $produk->save();

        return redirect()->route('penjualan')->with('success', 'Penjualan berhasil ditambahkan.');
    }

    // Mengedit transaksi penjualan
    public function edit(Request $request, Penjualan $penjualan)
    {
        $request->validate([
            'kode_transaksi' => 'required|unique:penjualan,kode_transaksi,' . $penjualan->id,
            'tanggal_penjualan' => 'required|date',
            'harga_per_barang' => 'required|numeric',
            'jumlah_barang' => 'required|integer|min:1',
        ]);

        $penjualan->update([
            'kode_transaksi' => $request->kode_transaksi,
            'tanggal_penjualan' => $request->tanggal_penjualan,
            'harga_per_barang' => $request->harga_per_barang,
            'jumlah_barang' => $request->jumlah_barang,
            'total_harga' => $request->harga_per_barang * $request->jumlah_barang,
        ]);

        return redirect()->route('penjualan')->with('success', 'Data penjualan berhasil diperbarui.');
    }

    // Menghapus transaksi penjualan
    public function delete(Penjualan $penjualan)
    {
        $penjualan->delete();
        return redirect()->route('penjualan')->with('success', 'Penjualan berhasil dihapus.');
    }
}
