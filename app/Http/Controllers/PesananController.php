<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use App\Models\Pesanan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    public function create(Produk $produk)
    {
        if (Auth::user()->role === 'admin') {
            abort(403, 'Admin tidak dapat melakukan pemesanan.');
        }
        abort_if($produk->stok < 1, 404);

        return view('pesanan.create', [
            'produk' => $produk,
            'alamats' => Auth::user()->alamat,
        ]);
    }

    public function store(Request $request, Produk $produk)
    {
        $data = $request->validate([
            'alamat_id' => ['nullable', 'exists:alamats,id'],
            'alamat' => ['required_without:alamat_id', 'string', 'max:255'],
            'kecamatan' => ['required_without:alamat_id', 'string', 'max:255'],
            'kota' => ['required_without:alamat_id', 'string', 'max:255'],
            'provinsi' => ['required_without:alamat_id', 'string', 'max:255'],
            'kode_pos' => ['required_without:alamat_id', 'string', 'max:20'],
            'kuantitas' => ['required', 'integer', 'min:1', 'max:'.$produk->stok],
            'tipe' => ['required', 'in:cod,transfer'],
            'bukti_pembayaran' => ['nullable', 'required_if:tipe,transfer', 'image', 'max:2048'],
        ]);

        $alamatId = $data['alamat_id'] ?? null;

        if ($alamatId) {
            abort_unless(Alamat::whereKey($alamatId)->where('user_id', Auth::id())->exists(), 403);
        } else {
            $alamat = Alamat::create([
                'user_id' => Auth::id(),
                'alamat' => $data['alamat'],
                'kecamatan' => $data['kecamatan'],
                'kota' => $data['kota'],
                'provinsi' => $data['provinsi'],
                'kode_pos' => $data['kode_pos'],
            ]);
            $alamatId = $alamat->id;
        }

        $data['user_id'] = Auth::id();
        $data['produk_id'] = $produk->id;
        $data['alamat_id'] = $alamatId;
        $data['total_harga'] = $produk->harga * $data['kuantitas'];
        $data['status'] = 'Menunggu Pembayaran';
        unset($data['alamat'], $data['kecamatan'], $data['kota'], $data['provinsi'], $data['kode_pos']);
        if ($request->hasFile('bukti_pembayaran')) {
            $data['bukti_pembayaran'] = $request->file('bukti_pembayaran')->store('bukti-pembayaran', 'public');
        }

        Pesanan::create($data);
        $produk->decrement('stok', $data['kuantitas']);

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dibuat.');
    }

    public function index()
    {
        $pesanans = Pesanan::where('user_id', Auth::id())->with(['produk', 'alamat'])->latest()->paginate(10);

        return view('pesanan.index', compact('pesanans'));
    }

    public function show(Pesanan $id)
    {
        abort_unless($id->user_id === Auth::id(), 403);

        return view('pesanan.show', ['pesanan' => $id->load(['produk', 'alamat'])]);
    }

    public function adminIndex()
    {
        $pesanans = Pesanan::with(['user', 'produk', 'alamat'])->latest()->paginate(15);

        return view('admin.pesanan.index', compact('pesanans'));
    }

    public function updateStatus(Request $request, Pesanan $pesanan)
    {
        $data = $request->validate([
            'status' => ['required', 'in:Menunggu Pembayaran,Diproses,Dikirim,Selesai,Dibatalkan'],
        ]);
        $pesanan->update($data);

        return back()->with('success', 'Status pesanan diperbarui.');
    }
}
