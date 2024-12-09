<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    // Menampilkan semua produk
    public function tampil()
    {
        $produk = Produk::all();
        return view('produk', compact('produk'));
    }

    // Menambah produk baru
    public function tambah(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'harga' => 'required',
            'stok' => 'required',
        ]);

        Produk::create($request->all());

        return redirect()->route('produk')->with('success', 'Produk berhasil ditambahkan.');
    }

    // Mengedit produk yang ada
    public function edit(Request $request, Produk $produk)
    {
        $request->validate([
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'harga' => 'required',
            'stok' => 'required',
        ]);

        $produk->update($request->all());

        return redirect()->route('produk')->with('success', 'Produk berhasil diubah.');
    }

    // Menghapus produk
    public function delete(Produk $produk)
    {
        $produk->delete();

        return redirect()->route('produk')->with('success', 'Produk berhasil dihapus.');
    }
}