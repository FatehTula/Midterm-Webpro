<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Penerbit;

class DashboardController extends Controller
{
    /**
     * [BARU] Menampilkan dashboard statistik perpustakaan.
     */
    public function index()
    {
        // [BARU] Statistik jumlah data utama.
        $totalBuku = Buku::count();
        $totalKategori = Kategori::count();
        $totalPenerbit = Penerbit::count();

        // [BARU] Hitung jumlah buku untuk setiap kategori.
        $jumlahBukuPerKategori = Buku::query()
            ->selectRaw('kategori_id, COUNT(*) as total')
            ->groupBy('kategori_id')
            ->pluck('total', 'kategori_id');

        $bukuPerKategori = Kategori::query()
            ->orderBy('nama_kategori')
            ->get()
            ->map(function ($kategori) use ($jumlahBukuPerKategori) {
                return [
                    'nama_kategori' => $kategori->nama_kategori,
                    'jumlah_buku' => (int) $jumlahBukuPerKategori->get(
                        $kategori->id,
                        0
                    ),
                ];
            });

        // [BARU] Ambil lima buku terbaru berdasarkan ID.
        $bukuTerbaru = Buku::with(['kategori', 'penerbit'])
            ->orderByDesc('id')
            ->limit(5)
            ->get();

        // [BARU] Kirim data statistik ke halaman dashboard.
        return view('dashboard.index', compact(
            'totalBuku',
            'totalKategori',
            'totalPenerbit',
            'bukuPerKategori',
            'bukuTerbaru'
        ));
    }
}
