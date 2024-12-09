<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penjualan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        // Fungsi untuk format uang
        function formatCurrency(amount) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR'
            }).format(amount);
        }
    </script>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Penjualan</h2>
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">Tambah Penjualan</button>
        <table class="table table-bordered table-striped">
            <thead class="table-dark text-center">
                <tr>
                    <th>Kode Transaksi</th>
                    <th>Tanggal</th>
                    <th>Harga per Barang</th>
                    <th>Jumlah Barang/Produk</th>
                    <th>Total Harga</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($penjualan as $pnjln)
                <tr>
                    <td>{{ $pnjln->kode_transaksi }}</td>
                    <td>{{ $pnjln->tanggal_penjualan }}</td>
                    <td>{{ formatCurrency($pnjln->harga_per_barang) }}</td>
                    <td>{{ $pnjln->jumlah_barang }}</td>
                    <td>{{ formatCurrency($pnjln->total_harga) }}</td>
                    <td class="text-center">
                        <!-- Button Edit -->
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $pnjln->id }}">Edit</button>
                        <!-- Form Delete -->
                        <form action="{{ route('penjualan.delete', $pnjln->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                <!-- Modal Edit Penjualan -->
                <div class="modal fade" id="modalEdit{{ $pnjln->id }}" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalEditLabel">Edit Penjualan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('penjualan.edit', $pnjln->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="kode_transaksi" class="form-label">Kode Transaksi</label>
                                        <input type="text" name="kode_transaksi" class="form-control" value="{{ $pnjln->kode_transaksi }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tanggal_penjualan" class="form-label">Tanggal</label>
                                        <input type="date" name="tanggal_penjualan" class="form-control" value="{{ $pnjln->tanggal_penjualan }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="harga_per_barang" class="form-label">Harga per Barang</label>
                                        <input type="number" name="harga_per_barang" class="form-control" value="{{ $pnjln->harga_per_barang }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="jumlah_barang" class="form-label">Jumlah Barang/Produk</label>
                                        <input type="number" name="jumlah_barang" class="form-control" value="{{ $pnjln->jumlah_barang }}" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Tambah Penjualan -->
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahLabel">Tambah Penjualan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('penjualan.tambah') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="kode_transaksi" class="form-label">Kode Transaksi</label>
                            <input type="text" name="kode_transaksi" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_penjualan" class="form-label">Tanggal</label>
                            <input type="date" name="tanggal_penjualan" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="harga_per_barang" class="form-label">Harga per Barang</label>
                            <input type="number" name="harga_per_barang" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah_barang" class="form-label">Jumlah Barang/Produk</label>
                            <input type="number" name="jumlah_barang" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Tambah Penjualan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
