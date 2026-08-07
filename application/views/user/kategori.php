<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-12">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <!-- Tambah Kategori -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Kategori Transaksi</h6>
            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambahKategoriModal">
                <i class="fas fa-plus"></i> Tambah Kategori
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>No</th>
                            <th>Tipe Kategori</th>
                            <th>Nama Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; foreach ($kategori as $k) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td>
                                    <?php if ($k['tipe'] == 'Pemasukan'): ?>
                                        <span class="badge badge-success">Pemasukan</span>
                                    <?php else: ?>
                                        <span class="badge badge-danger">Pengeluaran</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= $k['nama_kategori']; ?></td>
                                <td>
                                    <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#editKategoriModal<?= $k['id_kategori']; ?>">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <a href="<?= base_url('kategori/hapus/') . $k['id_kategori']; ?>" class="btn btn-sm btn-danger btn-confirm" data-message="Yakin ingin menghapus kategori ini?">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editKategoriModal<?= $k['id_kategori']; ?>" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Kategori</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <?= form_open('kategori/edit'); ?>
                                            <div class="modal-body">
                                                <input type="hidden" name="id_kategori" value="<?= $k['id_kategori']; ?>">
                                                <div class="form-group">
                                                    <label>Tipe Kategori</label>
                                                    <select name="tipe" class="form-control select2" required>
                                                        <option value="Pemasukan" <?= $k['tipe'] == 'Pemasukan' ? 'selected' : ''; ?>>Pemasukan</option>
                                                        <option value="Pengeluaran" <?= $k['tipe'] == 'Pengeluaran' ? 'selected' : ''; ?>>Pengeluaran</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Nama Kategori</label>
                                                    <input type="text" name="nama_kategori" class="form-control" value="<?= $k['nama_kategori']; ?>" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Tambah Modal -->
<div class="modal fade" id="tambahKategoriModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Kategori Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('kategori/tambah'); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tipe Kategori</label>
                        <select name="tipe" class="form-control select2" required>
                            <option value="">-- Pilih Tipe --</option>
                            <option value="Pemasukan">Pemasukan</option>
                            <option value="Pengeluaran">Pengeluaran</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nama Kategori</label>
                        <input type="text" name="nama_kategori" class="form-control" placeholder="Contoh: Gaji, Makanan, Transportasi" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
