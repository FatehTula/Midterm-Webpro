<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Penerbit;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    /**
     * Menampilkan seluruh data buku.
     */
    public function index(Request $request)
    {
    // [BARU] Mengambil kata kunci pencarian dari URL.
    $keyword = trim((string) $request->query('q', ''));

    // Memuat relasi kategori dan penerbit.
    $query = Buku::with(['kategori', 'penerbit']);

    // [BARU] Mencari berdasarkan judul atau pengarang.
    // Nama kolom harus sesuai dengan database dan model.
    if ($keyword !== '') {
        $query->where(function ($search) use ($keyword) {
            $search->where('judul', 'like', '%' . $keyword . '%')
                   ->orWhere('pengarang', 'like', '%' . $keyword . '%');
        });
    }

    // [DIUBAH] Gunakan nama variabel yang dipakai Blade.
    $allBuku = $query->get();

    // [DIUBAH] Kirim $allBuku dan $keyword ke halaman.
    return view('Buku.index', compact('allBuku', 'keyword'));
    }

    /**
     * Menampilkan formulir tambah buku.
     */
    public function create()
    {
        $penerbit = Penerbit::all();
        $kategori = Kategori::all();

        return view('buku.create', compact('penerbit', 'kategori'));
    }

    /**
     * Menyimpan buku baru.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'pengarang' => 'required|string|max:255',
            'tahun_terbit' => 'required|integer|digits:4',
            'kategori_id' => 'required|exists:kategoris,id',
            'penerbit_id' => 'required|exists:penerbits,id',
        ]);

        Buku::create($validatedData);

        return redirect()
            ->route('buku.index')
            ->with('success', 'Buku berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail buku.
     */
    public function show(Buku $buku)
    {
        $buku->load(['kategori', 'penerbit']);

        return view('buku.show', compact('buku'));
    }

    /**
     * Menampilkan formulir edit buku.
     */
    public function edit(Buku $buku)
    {
        $penerbit = Penerbit::all();
        $kategori = Kategori::all();

        return view(
            'buku.edit',
            compact('buku', 'penerbit', 'kategori')
        );
    }

    /**
     * Memperbarui data buku.
     */
    public function update(Request $request, Buku $buku)
    {
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'pengarang' => 'required|string|max:255',
            'tahun_terbit' => 'required|integer|digits:4',
            'kategori_id' => 'required|exists:kategoris,id',
            'penerbit_id' => 'required|exists:penerbits,id',
        ]);

        $buku->update($validatedData);

        return redirect()
            ->route('buku.index')
            ->with('success', 'Buku berhasil diperbarui.');
    }

    /**
     * Menghapus buku.
     */
    public function destroy(Buku $buku)
    {
        $buku->delete();

        return redirect()
            ->route('buku.index')
            ->with('success', 'Buku berhasil dihapus.');
    }
}