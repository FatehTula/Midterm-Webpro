@include('layout.header')

<h3>Detail Buku</h3>

<table>
    <tbody>
        <tr>
            <td>Judul Buku</td>
            <td>:</td>
            <td>{{ $buku->judul }}</td>
        </tr>

        <tr>
            <td>Pengarang</td>
            <td>:</td>
            <td>{{ $buku->pengarang }}</td>
        </tr>

        <tr>
            <td>Tahun Terbit</td>
            <td>:</td>
            <td>{{ $buku->tahun_terbit }}</td>
        </tr>

        <tr>
            <td>Kategori</td>
            <td>:</td>
            <td>{{ $buku->kategori?->nama_kategori ?? '-' }}</td>
        </tr>

        <tr>
            <td>Penerbit</td>
            <td>:</td>
            <td>{{ $buku->penerbit?->nama_penerbit ?? '-' }}</td>
        </tr>
    </tbody>
</table>

<br>

<a href="{{ route('buku.index') }}" class="tombol">
    Kembali
</a>

<a href="{{ route('buku.edit', $buku->id) }}" class="tombol">
    Edit
</a>

@include('layout.footer')