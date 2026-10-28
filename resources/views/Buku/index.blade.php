
@include('layout.header')

<h3>Buku</h3>

<a href="{{ route('buku.create') }}" class="tombol">Tambah</a>

<br><br>

@if (session('success'))
    <p class="success">{{ session('success') }}</p>
@endif

{{-- =====================================================
     [BARU] FORM PENCARIAN DAN FILTER BUKU
     ===================================================== --}}

<style>
    .filter-buku {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        align-items: center;
        margin: 16px 0;
    }

    .filter-buku input,
    .filter-buku select {
        padding: 9px 12px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font: inherit;
    }

    .filter-buku input {
        min-width: 220px;
        flex: 1;
    }

    .filter-buku select {
        min-width: 160px;
    }
</style>

<form
    action="{{ route('buku.index') }}"
    method="GET"
    class="filter-buku"
>
    {{-- [BARU] Pencarian judul atau pengarang --}}
    <input
        type="search"
        name="q"
        placeholder="Cari judul atau pengarang..."
        value="{{ $keyword ?? request('q', '') }}"
        aria-label="Cari judul atau pengarang"
    >

    {{-- [BARU] Dropdown kategori --}}
    <select name="kategori_id" aria-label="Filter kategori">
        <option value="">Semua Kategori</option>

        @foreach ($kategoris as $kategori)
            <option
                value="{{ $kategori->id }}"
                @selected(
                    (string) ($kategoriFilter ?? '') ===
                    (string) $kategori->id
                )
            >
                {{ $kategori->nama_kategori }}
            </option>
        @endforeach
    </select>

    {{-- [BARU] Dropdown penerbit --}}
    <select name="penerbit_id" aria-label="Filter penerbit">
        <option value="">Semua Penerbit</option>

        @foreach ($penerbits as $penerbit)
            <option
                value="{{ $penerbit->id }}"
                @selected(
                    (string) ($penerbitFilter ?? '') ===
                    (string) $penerbit->id
                )
            >
                {{ $penerbit->nama_penerbit }}
            </option>
        @endforeach
    </select>

    <button type="submit" class="tombol">
        Cari / Filter
    </button>

    {{-- [BARU] Tampil hanya saat ada kriteria pencarian/filter --}}
    @if (
        ($keyword ?? '') !== '' ||
        ($kategoriFilter ?? '') !== '' ||
        ($penerbitFilter ?? '') !== ''
    )
        <a href="{{ route('buku.index') }}" class="tombol">
            Reset
        </a>
    @endif
</form>

{{-- [BARU] Informasi jumlah hasil saat filter digunakan --}}
@if (
    ($keyword ?? '') !== '' ||
    ($kategoriFilter ?? '') !== '' ||
    ($penerbitFilter ?? '') !== ''
)
    <p>
        Hasil: <strong>{{ $allBuku->count() }}</strong> buku ditemukan.
    </p>
@endif

{{-- =====================================================
     TABEL BUKU LAMA — TETAP DIPERTAHANKAN
     ===================================================== --}}

<table>
    <thead>
        <tr>
            <th>No.</th>
            <th>Judul Buku</th>
            <th>Pengarang</th>
            <th>Tahun</th>
            <th>Penerbit</th>
            <th>Kategori</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        @forelse ($allBuku as $key => $r)
            <tr>
                {{-- Kolom 1: Nomor --}}
                <td>{{ $key + 1 }}</td>

                {{-- Kolom 2: Judul Buku --}}
                <td>{{ $r->judul }}</td>

                {{-- Kolom 3: Pengarang --}}
                <td>{{ $r->pengarang }}</td>

                {{-- Kolom 4: Tahun --}}
                <td>{{ $r->tahun_terbit }}</td>

                {{-- Kolom 5: Penerbit --}}
                <td>
                    {{ $r->penerbit?->nama_penerbit ?? '-' }}
                </td>

                {{-- Kolom 6: Kategori --}}
                <td>
                    {{ $r->kategori?->nama_kategori ?? '-' }}
                </td>

                {{-- Kolom 7: Aksi — TIDAK DIUBAH --}}
                <td>
                    <div class="aksi-container">
                        <a
                            href="{{ route('buku.show', $r->id) }}"
                            class="tombol"
                        >
                            Detail
                        </a>

                        <a
                            href="{{ route('buku.edit', $r->id) }}"
                            class="tombol"
                        >
                            Edit
                        </a>

                        <form
                            action="{{ route('buku.destroy', $r->id) }}"
                            method="POST"
                            class="form-hapus"
                            onsubmit="return confirm('Apakah kamu yakin ingin menghapus buku ini?')"
                        >
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="tombol">
                                Hapus
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="data-kosong">
                    @if (
                        ($keyword ?? '') !== '' ||
                        ($kategoriFilter ?? '') !== '' ||
                        ($penerbitFilter ?? '') !== ''
                    )
                        Tidak ada buku yang sesuai dengan pencarian
                        atau filter yang dipilih.
                    @else
                        Belum ada data buku.
                    @endif
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

@include('layout.footer')
