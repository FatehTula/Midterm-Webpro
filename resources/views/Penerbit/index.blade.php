
@include('layout.header')

<h3>Penerbit</h3>

<a href="{{ route('penerbit.create') }}" class="tombol">
    Tambah
</a>

<table>
    <thead>
        <tr>
            <th class="kolom-nomor">No.</th>
            <th class="kolom-nama">Nama Penerbit</th>
            <th class="kolom-aksi">Aksi</th>
        </tr>
    </thead>

    <tbody>
        @forelse ($allPenerbit as $key => $r)
            <tr>
                <td>{{ $key + 1 }}</td>

                <td>{{ $r->nama_penerbit }}</td>

                <td>
                    <div class="aksi-container">

                        <a href="{{ route('penerbit.show', $r->id) }}"
                           class="tombol">
                            Detail
                        </a>

                        <a href="{{ route('penerbit.edit', $r->id) }}"
                           class="tombol">
                            Edit
                        </a>

                        <form action="{{ route('penerbit.destroy', $r->id) }}"
                              method="POST"
                              class="form-hapus"
                              onsubmit="return confirm('Apakah kamu yakin ingin menghapus penerbit ini?')">

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
                    Belum ada data penerbit.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

@include('layout.footer')
