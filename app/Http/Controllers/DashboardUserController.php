<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;

class DashboardUserController extends Controller
{
    public function index()
    {
        $barangs = Barang::paginate(3);
        return view('userPage.components.home', [
            'barangs' => $barangs
        ]);
    }

    public function getProduk()
    {
        $kategoris = Kategori::all();
        $barangs = Barang::all();
        return view('userPage.components.produk', [
            'barangs' => $barangs,
            'kategoris' => $kategoris
        ]);
    }

    public function getProdukByKategori(Kategori $kategori)
    {
        $kategoris = Kategori::all();
        $barangs = Barang::where('kategori_id', $kategori->id)->get();
        return view('userPage.components.produk', [
            'barangs' => $barangs,
            'kategoris' => $kategoris
        ]);
    }

    public function singleProduk(Barang $barang)
    {
        $barang = Barang::where('uuid', $barang->uuid)->with(['kategori'])->first();
        return view('userPage.components.singleProduk', [
            'barang' => $barang
        ]);
    }
}
