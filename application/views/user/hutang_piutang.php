<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#tambahCatatanModal">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Catatan Baru
        </a>
    </div>

    <?= $this->session->flashdata('message'); ?>

    <!-- Summary Cards -->
    <div class="row">
        <!-- Total Piutang Card (Uang Kita di Orang) -->
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Piutang (Uang Kita Di Luar)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= number_format($total_piutang, 0, ',', '.'); ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-hand-holding-usd fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Hutang Card (Uang Orang di Kita) -->
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Total Hutang (Uang Orang Kita Bawa)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= number_format($total_hutang, 0, ',', '.'); ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-file-invoice-dollar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- DataTables -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Buku Hutang Piutang</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-primary text-white">
                            <th>Tgl Pinjam</th>
                            <th>Jenis</th>
                            <th>Dompet</th>
                            <th>Nama Pihak</th>
                            <th>Nominal</th>
                            <th>Jatuh Tempo</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($catatan as $c) : ?>
                            <tr>
                                <td><?= date('d M Y', strtotime($c['tanggal_pinjam'])); ?></td>
                                <td>
                                    <?php if ($c['jenis'] == 'Hutang') : ?>
                                        <span class="badge badge-danger">Hutang (Saya Pinjam)</span>
                                    <?php else : ?>
                                        <span class="badge badge-success">Piutang (Saya Meminjamkan)</span>
                                    <?php endif; ?>
                                </td>
                                <td><span class="badge badge-secondary"><?= $c['nama_dompet'] ? $c['nama_dompet'] : 'Utama'; ?></span></td>
                                <td class="font-weight-bold"><?= $c['nama_orang']; ?></td>
                                <td>Rp. <?= number_format($c['nominal'], 0, ',', '.'); ?></td>
                                <td>
                                    <?php if ($c['jatuh_tempo']) : ?>
                                        <?= date('d M Y', strtotime($c['jatuh_tempo'])); ?>
                                    <?php else : ?>
                                        <i class="text-muted">Tidak ada</i>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($c['status'] == 'Belum Lunas') : ?>
                                        <span class="badge badge-warning">Belum Lunas</span>
                                    <?php else : ?>
                                        <span class="badge badge-primary">Lunas</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($c['status'] == 'Belum Lunas') : ?>
                                        <a href="<?= base_url('hutangpiutang/lunas/') . $c['id_hp']; ?>" class="btn btn-sm btn-success btn-confirm" data-message="Tandai sebagai lunas? Saldo Anda akan otomatis disesuaikan dan tercatat di History.">
                                            <i class="fas fa-check"></i> Lunas
                                        </a>
                                    <?php endif; ?>
                                    <a href="<?= base_url('hutangpiutang/hapus/') . $c['id_hp']; ?>" class="btn btn-sm btn-danger btn-confirm" data-message="Hapus catatan ini? Ini tidak akan mengembalikan/memotong saldo utama.">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<!-- Modal Tambah Catatan -->
<div class="modal fade" id="tambahCatatanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Catatan Baru</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('hutangpiutang/tambah'); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Jenis Catatan</label>
                        <select name="jenis" class="form-control select2" required>
                            <option value="Hutang">HUTANG (Saya meminjam uang dari orang)</option>
                            <option value="Piutang">PIUTANG (Saya meminjamkan uang ke orang)</option>
                        </select>
                        <small class="form-text text-danger">*Hutang akan menambah saldo dompet Anda. Piutang akan memotong saldo dompet Anda.</small>
                    </div>
                    <div class="form-group">
                        <label>Pilih Dompet</label>
                        <select name="id_dompet" class="form-control select2" required>
                            <option value="">-- Pilih Dompet --</option>
                            <?php foreach ($list_dompet as $d) : ?>
                                <option value="<?= $d['id_dompet']; ?>"><?= $d['nama_dompet']; ?> (Rp. <?= number_format($d['saldo'], 0, ',', '.'); ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nama Orang / Pihak Lain</label>
                        <input type="text" name="nama_orang" class="form-control" placeholder="Contoh: Budi, Rentenir, Teman Kampus" required>
                    </div>
                    <div class="form-group">
                        <label>Nominal (Rp)</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp.</span>
                            </div>
                            <input type="text" name="nominal" class="form-control input-rupiah" placeholder="Contoh: 50.000" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Pinjam</label>
                                <input type="text" name="tanggal_pinjam" class="form-control datepicker" placeholder="Pilih Tanggal" value="<?= date('Y-m-d'); ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Jatuh Tempo (Opsional)</label>
                                <input type="text" name="jatuh_tempo" class="form-control datepicker" placeholder="Pilih Tanggal">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Catatan</button>
                </div>
            </form>
        </div>
    </div>
</div>
