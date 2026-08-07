<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
    <?= $this->session->flashdata('message'); ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Riwayat Transaksi Event</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Nama Event</th>
                            <th>Kategori</th>
                            <th>Pemasukan</th>
                            <th>Pengeluaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; foreach($history as $h): ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $h['tanggal']; ?></td>
                            <td><?= $h['jam']; ?></td>
                            <td><?= $h['namaEvent']; ?></td>
                            <td>
                                <?php if($h['kategoriEvent'] == 'Pemasukan'): ?>
                                    <span class="badge badge-success"><?= $h['kategoriEvent']; ?></span>
                                <?php else: ?>
                                    <span class="badge badge-warning"><?= $h['kategoriEvent']; ?></span>
                                <?php endif; ?>
                            </td>
                            <td>Rp. <?= number_format($h['pemasukan'], 0, ',', '.'); ?></td>
                            <td>Rp. <?= number_format($h['pengeluaran'], 0, ',', '.'); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

