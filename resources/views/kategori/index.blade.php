
@include('layout.header')

<h3>Kategori</h3>

<a href="{{ route('kategori.create') }}" class="tombol">
    Tambah
</a>

<table>
    <thead>
        <tr>
            <th class="kolom-nomor">No.</th>
            <th class="kolom-nama">Nama Kategori</th>
            <th class="kolom-aksi">Aksi</th>
        </tr>
    </thead>

    <tbody>
        @forelse ($allKategori as $key => $r)
            <tr>
                <td>{{ $key + 1 }}</td>

                <td>{{ $r->nama_kategori }}</td>

                <td>
                    <div class="aksi-container">

                        <a href="{{ route('kategori.show', $r->id) }}"
                           class="tombol">
                            Detail
                        </a>

                        <a href="{{ route('kategori.edit', $r->id) }}"
                           class="tombol">
                            Edit
                        </a>

                        <form action="{{ route('kategori.destroy', $r->id) }}"
                              method="POST"
                              class="form-hapus"
                              onsubmit="return confirm('Apakah kamu yakin ingin menghapus kategori ini?')">

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
                <td colspan="3" class="data-kosong">
                    Belum ada data kategori.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

@include('layout.footer')
