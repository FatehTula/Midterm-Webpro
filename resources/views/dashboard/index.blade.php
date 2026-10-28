
@include('layout.header')

<style>
    .dashboard-statistik {
        max-width: 1100px;
        margin: 0 auto;
        padding: 20px 0;
    }

    .dashboard-statistik .subjudul {
        color: #64748b;
        margin-bottom: 24px;
    }

    .statistik-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 16px;
        margin-bottom: 28px;
    }

    .statistik-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 20px;
    }

    .statistik-card h4 {
        color: #475569;
        margin: 0 0 12px;
        font-size: 15px;
    }

    .statistik-card .angka {
        color: #1d4ed8;
        font-size: 30px;
        font-weight: bold;
        margin: 0;
    }

    .dashboard-bagian {
        margin-top: 28px;
    }

    .dashboard-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 12px;
        background: #fff;
    }

    .dashboard-table th,
    .dashboard-table td {
        padding: 12px;
        border: 1px solid #e2e8f0;
        text-align: left;
    }

    .dashboard-table th {
        background: #f1f5f9;
    }

    .dashboard-link {
        display: inline-block;
        margin: 0 0 20px;
    }
</style>

<div class="dashboard-statistik">

    {{-- [BARU] Judul dashboard --}}
    <h2>Dashboard Statistik</h2>
    <p class="subjudul">
        Ringkasan data aplikasi pengelolaan buku.
    </p>

    <a
        href="{{ route('buku.index') }}"
        class="tombol dashboard-link"
    >
        Kelola Data Buku
    </a>

    {{-- [BARU] Kartu statistik utama --}}
    <div class="statistik-grid">

        <div class="statistik-card">
            <h4>Total Buku</h4>
            <p class="angka">{{ $totalBuku }}</p>
        </div>

        <div class="statistik-card">
            <h4>Total Kategori</h4>
            <p class="angka">{{ $totalKategori }}</p>
        </div>

        <div class="statistik-card">
            <h4>Total Penerbit</h4>
            <p class="angka">{{ $totalPenerbit }}</p>
        </div>

    </div>

    {{-- [BARU] Tabel jumlah buku per kategori --}}
    <section class="dashboard-bagian">
        <h3>Jumlah Buku per Kategori</h3>

        <table class="dashboard-table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Kategori</th>
                    <th>Jumlah Buku</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($bukuPerKategori as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item['nama_kategori'] }}</td>
                        <td>{{ $item['jumlah_buku'] }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">
                            Belum ada data kategori.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </section>

    {{-- [BARU] Daftar lima buku terbaru --}}
    <section class="dashboard-bagian">
        <h3>Lima Buku Terbaru</h3>

        <table class="dashboard-table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Judul Buku</th>
                    <th>Pengarang</th>
                    <th>Tahun</th>
                    <th>Penerbit</th>
                    <th>Kategori</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($bukuTerbaru as $index => $buku)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $buku->judul }}</td>
                        <td>{{ $buku->pengarang }}</td>
                        <td>{{ $buku->tahun_terbit }}</td>
                        <td>
                            {{ $buku->penerbit?->nama_penerbit ?? '-' }}
                        </td>
                        <td>
                            {{ $buku->kategori?->nama_kategori ?? '-' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            Belum ada data buku.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </section>

</div>

@include('layout.footer')
