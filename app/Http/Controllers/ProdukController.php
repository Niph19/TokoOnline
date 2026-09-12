<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard', [
            'jumlahProduk' => Produk::count(),
            'jumlahPesanan' => Pesanan::count(),
            'pesananTerbaru' => Pesanan::with(['user', 'produk'])->latest()->take(5)->get(),
        ]);
    }

    public function index()
    {
        return view('admin.produk.index', ['produks' => Produk::latest()->paginate(12)]);
    }

    public function create()
    {
        return view('admin.produk.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_produk' => ['required', 'string', 'max:255'],
            'harga' => ['required', 'integer', 'min:0'],
            'stok' => ['required', 'integer', 'min:0'],
            'deskripsi' => ['required', 'string'],
            'image' => ['required', 'image', 'max:2048'],
        ]);
        $data['image'] = $request->file('image')->store('produk', 'public');
        Produk::create($data);

        return redirect()->route('admin.produk.index')->with('success', 'Produk ditambahkan.');
    }

    public function edit(Produk $produk)
    {
        return view('admin.produk.edit', compact('produk'));
    }

    public function update(Request $request, Produk $produk)
    {
        $data = $request->validate([
            'nama_produk' => ['required', 'string', 'max:255'],
            'harga' => ['required', 'integer', 'min:0'],
            'stok' => ['required', 'integer', 'min:0'],
            'deskripsi' => ['required', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('produk', 'public');
        }
        $produk->update($data);

        return redirect()->route('admin.produk.index')->with('success', 'Produk diperbarui.');
    }

    public function destroy(Produk $produk)
    {
        $produk->delete();

        return back()->with('success', 'Produk dihapus.');
    }
}
