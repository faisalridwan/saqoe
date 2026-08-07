<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
    <?= $this->session->flashdata('message'); ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Riwayat Transaksi Harian</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Nama</th>
                            <th>Tipe</th>
                            <th>Kategori</th>
                            <th>Dompet</th>
                            <th>Pemasukan</th>
                            <th>Pengeluaran</th>
                            <th>Struk</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; foreach($history as $h): ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $h['tanggal']; ?></td>
                            <td><?= $h['jam']; ?></td>
                            <td><?= $h['nama']; ?></td>
                            <td>
                                <?php if($h['tipe'] == 'Pemasukan'): ?>
                                    <span class="badge badge-success"><?= $h['tipe']; ?></span>
                                <?php else: ?>
                                    <span class="badge badge-warning"><?= $h['tipe']; ?></span>
                                <?php endif; ?>
                            </td>
                            <td><?= $h['kategori'] ?? '-'; ?></td>
                            <td><?= $h['dompet_nama'] ?? '-'; ?></td>
                            <td>Rp. <?= number_format($h['pemasukan'], 0, ',', '.'); ?></td>
                            <td>Rp. <?= number_format($h['pengeluaran'], 0, ',', '.'); ?></td>
                            <td>
                                <?php if (!empty($h['struk_img'])) : ?>
                                    <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#strukModal<?= $i; ?>">
                                        <i class="fas fa-image"></i> Lihat
                                    </button>
                                    
                                    <!-- Modal Struk -->
                                    <div class="modal fade" id="strukModal<?= $i; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Struk Transaksi</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <img src="<?= base_url('assets/img/struk/') . $h['struk_img']; ?>" class="img-fluid" alt="Struk Transaksi">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php else : ?>
                                    <span class="text-muted small">-</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

