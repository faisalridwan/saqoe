<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-12">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <!-- Tambah Dompet -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Dompet & Rekening</h6>
            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambahDompetModal">
                <i class="fas fa-plus"></i> Tambah Dompet
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>No</th>
                            <th>Nama Dompet / Rekening</th>
                            <th>Saldo (Rp)</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; foreach ($dompet as $d) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $d['nama_dompet']; ?></td>
                                <td class="font-weight-bold">Rp. <?= number_format($d['saldo'], 0, ',', '.'); ?></td>
                                <td>
                                    <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#editDompetModal<?= $d['id_dompet']; ?>">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <a href="<?= base_url('dompet/hapus/') . $d['id_dompet']; ?>" class="btn btn-sm btn-danger btn-confirm" data-message="Yakin ingin menghapus dompet ini? Transaksi yang terhubung ke dompet ini mungkin akan kehilangan referensi.">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editDompetModal<?= $d['id_dompet']; ?>" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Dompet</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <?= form_open('dompet/edit'); ?>
                                            <div class="modal-body">
                                                <input type="hidden" name="id_dompet" value="<?= $d['id_dompet']; ?>">
                                                <div class="form-group">
                                                    <label>Nama Dompet</label>
                                                    <input type="text" name="nama_dompet" class="form-control" value="<?= $d['nama_dompet']; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Saldo (Rp)</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Rp.</span>
                                                        </div>
                                                        <input type="text" name="saldo" class="form-control input-rupiah" value="<?= number_format($d['saldo'], 0, '', ''); ?>" required>
                                                    </div>
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
<div class="modal fade" id="tambahDompetModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Dompet Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('dompet/tambah'); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Dompet / Rekening</label>
                        <input type="text" name="nama_dompet" class="form-control" placeholder="Contoh: BCA, GoPay, Tunai" required>
                    </div>
                    <div class="form-group">
                        <label>Saldo Awal (Rp)</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp.</span>
                            </div>
                            <input type="text" name="saldo" class="form-control input-rupiah" placeholder="Contoh: 100000" required>
                        </div>
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
