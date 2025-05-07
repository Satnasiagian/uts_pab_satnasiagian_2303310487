<!-- TODO: tuliskan tampilan view anda disini -->
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manajemen Barang</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
<div class="max-w-6xl mx-auto bg-white p-6 rounded shadow">
    <!-- Header -->
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Manajemen Barang</h1>
        <a href="{{ route('produk.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Tambah Barang</a>
    </div>

    <!-- Filter (opsional dikembangkan) -->
    <div class="flex gap-4 mb-6">
        <input type="text" placeholder="Cari nama barang..." class="w-full border px-3 py-2 rounded">
        <select class="border px-3 py-2 rounded">
            <option>Semua Kategori</option>
            <option>Elektronik</option>
            <option>Gadget</option>
            <option>Aksesoris</option>
        </select>
    </div>

    <!-- Tabel Daftar Barang -->
    <div>
        <h2 class="text-xl font-semibold mb-2">Daftar Barang</h2>
        <div class="overflow-x-auto">
            <table class="w-full text-left border">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="p-2">NAMA</th>
                        <th class="p-2">HARGA</th>
                        <th class="p-2">STOK</th>
                        <th class="p-2">DESKRIPSI</th>
                        <th class="p-2">KATEGORI</th>
                        <th class="p-2">STATUS</th>
                        <th class="p-2">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($produks as $produk)
                    <tr class="border-t">
                        <td class="p-2">{{ $produk->nama }}</td>
                        <td class="p-2">Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                        <td class="p-2">{{ $produk->stok }}</td>
                        <td class="p-2">{{ $produk->deskripsi }}</td>
                        <td class="p-2">{{ $produk->kategori }}</td>
                        <td class="p-2">
                            <span class="{{ $produk->status ? 'text-green-600' : 'text-red-600' }}">
                                {{ $produk->status ? 'Aktif' : 'Tidak Aktif' }}
                            </span>
                        </td>
                        <td class="p-2 space-x-2">
                            <a href="{{ route('produk.edit', $produk) }}" class="bg-yellow-400 px-3 py-1 rounded text-white hover:bg-yellow-500">Edit</a>
                            <form action="{{ route('produk.destroy', $produk) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Yakin ingin menghapus?')" class="bg-red-600 px-3 py-1 rounded text-white hover:bg-red-700">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="p-4 text-center text-gray-500">Tidak ada data produk.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="flex justify-between items-center mt-4 text-sm text-gray-600">
        <span>Menampilkan {{ $produks->firstItem() }} - {{ $produks->lastItem() }} dari {{ $produks->total() }} barang</span>
        {{ $produks->links() }}
    </div>
</div>
@endsection
