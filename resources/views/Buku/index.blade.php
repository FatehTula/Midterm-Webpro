
@include('layout.header')

<h3>Buku</h3>

<a href="{{ route('buku.create') }}" class="tombol">Tambah</a>

<br><br>

@if (session('success'))
    <p class="success">{{ session('success') }}</p>
@endif

{{-- =====================================================
     PENCARIAN DAN FILTER — DIPERTAHANKAN
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

    /* [BARU] Tampilan navigasi pagination */
    .pagination-wrap {
        margin: 22px 0;
    }

    .pagination-wrap nav {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 8px;
    }

    .pagination-wrap nav > div {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 6px;
    }

    .pagination-wrap nav a,
    .pagination-wrap nav span[aria-current="page"] span,
    .pagination-wrap nav span[aria-disabled="true"] span {
        display: inline-block;
        padding: 8px 12px;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        text-decoration: none;
        color: #334155;
    }

    .pagination-wrap nav a:hover {
        background: #e2e8f0;
    }

    .pagination-wrap nav span[aria-current="page"] span {
        background: #334155;
        color: #fff;
        border-color: #334155;
    }

    .pagination-wrap nav span[aria-disabled="true"] span {
        color: #94a3b8;
    }
</style>

<form
    action="{{ route('buku.index') }}"
    method="GET"
    class="filter-buku"
>
    {{-- Pencarian judul atau pengarang --}}
    <input
        type="search"
        name="q"
        placeholder="Cari judul atau pengarang..."
        value="{{ $keyword ?? request('q', '') }}"
        aria-label="Cari judul atau pengarang"
    >

    {{-- Filter kategori --}}
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

    {{-- Filter penerbit --}}
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

    {{-- Reset pencarian dan filter --}}
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

@if (
    ($keyword ?? '') !== '' ||
    ($kategoriFilter ?? '') !== '' ||
    ($penerbitFilter ?? '') !== ''
)
    <p>
        Total hasil pencarian:
        <strong>{{ $allBuku->total() }}</strong> buku.
    </p>
@endif

{{-- =====================================================
     TABEL BUKU — DIPERTAHANKAN
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
                {{-- [DIUBAH] Nomor urut berlanjut antarhalaman --}}
                <td>{{ $allBuku->firstItem() + $key }}</td>

                <td>{{ $r->judul }}</td>
                <td>{{ $r->pengarang }}</td>
                <td>{{ $r->tahun_terbit }}</td>

                <td>
                    {{ $r->penerbit?->nama_penerbit ?? '-' }}
                </td>

                <td>
                    {{ $r->kategori?->nama_kategori ?? '-' }}
                </td>

                {{-- Tombol CRUD tetap dipertahankan --}}
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



@if ($allBuku->hasPages())
    <div class="pagination-wrap">
        {{ $allBuku->links() }}
    </div>
@endif

@include('layout.footer')
