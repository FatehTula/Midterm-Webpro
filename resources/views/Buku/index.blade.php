@include('layout.header')

<h3>Buku</h3>

<a href="{{ route('buku.create') }}" class="tombol">Tambah</a>

<br><br>

@if (session('success'))
    <p class="success">{{ session('success') }}</p>
@endif

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

                {{-- Kolom 7: Aksi --}}
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
                    Belum ada data buku.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

@include('layout.footer')