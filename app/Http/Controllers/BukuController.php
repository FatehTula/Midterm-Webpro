<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Penerbit;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    /**
     * Menampilkan daftar buku dan menangani pencarian/filter.
     */
    public function index(Request $request)
    {
        // [BARU] Ambil kata kunci pencarian.
        $keyword = trim((string) $request->query('q', ''));

        // [BARU] Ambil filter kategori dan penerbit dari URL.
        $kategoriFilter = $request->query('kategori_id', '');
        $penerbitFilter = $request->query('penerbit_id', '');

        // Query awal tetap memuat relasi kategori dan penerbit.
        $query = Buku::with(['kategori', 'penerbit']);

        // [DIPERTAHANKAN] Pencarian berdasarkan judul atau pengarang.
        if ($keyword !== '') {
            $query->where(function ($search) use ($keyword) {
                $search->where(
                    'judul',
                    'like',
                    '%' . $keyword . '%'
                )->orWhere(
                    'pengarang',
                    'like',
                    '%' . $keyword . '%'
                );
            });
        }

        // [BARU] Filter berdasarkan kategori jika dipilih.
        if ($kategoriFilter !== '') {
            $query->where('kategori_id', $kategoriFilter);
        }

        // [BARU] Filter berdasarkan penerbit jika dipilih.
        if ($penerbitFilter !== '') {
            $query->where('penerbit_id', $penerbitFilter);
        }

        // [DIPERTAHANKAN] Gunakan $allBuku agar cocok dengan Blade.
        $allBuku = $query->get();

        // [BARU] Ambil opsi dropdown dari database.
        $kategoris = Kategori::orderBy('nama_kategori')->get();
        $penerbits = Penerbit::orderBy('nama_penerbit')->get();

        // [DIUBAH] Kirim semua data yang dibutuhkan oleh Blade.
        // Pertahankan nama view yang saat ini digunakan proyekmu.
        return view('buku.index', compact(
            'allBuku',
            'keyword',
            'kategoris',
            'penerbits',
            'kategoriFilter',
            'penerbitFilter'
        ));
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
