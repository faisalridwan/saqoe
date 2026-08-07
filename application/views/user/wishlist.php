<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#tambahWishlistModal">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Target Baru
        </a>
    </div>

    <?= $this->session->flashdata('message'); ?>

    <div class="row">
        <?php if (empty($wishlists)) : ?>
            <div class="col-12 text-center mt-5">
                <!-- Streamline-style Empty Target SVG -->
                <svg width="150" height="150" viewBox="0 0 24 24" fill="none" stroke="#b0bfe2" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="mb-4">
                    <circle cx="12" cy="12" r="10"></circle>
                    <circle cx="12" cy="12" r="6"></circle>
                    <circle cx="12" cy="12" r="2"></circle>
                    <path d="M12 2v2"></path>
                    <path d="M12 20v2"></path>
                    <path d="M22 12h-2"></path>
                    <path d="M4 12H2"></path>
                </svg>
                <h5 class="text-gray-500">Belum ada target menabung. Yuk, buat target pertamamu!</h5>
            </div>
        <?php else : ?>
            <?php foreach ($wishlists as $w) : ?>
                <?php 
                    $persen = ($w['saldo_terkumpul'] / $w['harga_target']) * 100; 
                    if($persen > 100) $persen = 100;
                    $bg_color = 'bg-info';
                    if ($persen >= 100) {
                        $bg_color = 'bg-success';
                    } else if ($persen < 30) {
                        $bg_color = 'bg-danger';
                    } else if ($persen < 70) {
                        $bg_color = 'bg-warning';
                    }
                ?>
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-<?= ($w['status'] == 'Tercapai') ? 'success' : 'primary'; ?> shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-<?= ($w['status'] == 'Tercapai') ? 'success' : 'primary'; ?> text-uppercase mb-1">
                                        <?= $w['nama_target']; ?> 
                                        <?php if ($w['deadline']) : ?>
                                            <span class="badge badge-light ml-2"><i class="fas fa-clock"></i> <?= date('d M Y', strtotime($w['deadline'])); ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        Rp. <?= number_format($w['saldo_terkumpul'], 0, ',', '.'); ?> <small class="text-muted">/ Rp. <?= number_format($w['harga_target'], 0, ',', '.'); ?></small>
                                    </div>
                                    <div class="row no-gutters align-items-center mt-3">
                                        <div class="col-auto">
                                            <div class="h6 mb-0 mr-3 font-weight-bold text-gray-800"><?= number_format($persen, 1); ?>%</div>
                                        </div>
                                        <div class="col">
                                            <div class="progress progress-sm mr-2">
                                                <div class="progress-bar <?= $bg_color; ?>" role="progressbar" style="width: <?= $persen; ?>%" aria-valuenow="<?= $persen; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-bullseye fa-2x text-gray-300"></i>
                                </div>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center">
                                <?php if ($w['status'] == 'Belum Tercapai') : ?>
                                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#nabungModal<?= $w['id_wishlist']; ?>">
                                        <i class="fas fa-piggy-bank"></i> Nabung
                                    </button>
                                <?php else : ?>
                                    <span class="badge badge-success px-3 py-2"><i class="fas fa-check-circle"></i> Tercapai!</span>
                                <?php endif; ?>
                                <a href="<?= base_url('wishlist/hapus/') . $w['id_wishlist']; ?>" class="btn btn-sm btn-outline-danger btn-confirm" data-message="Yakin ingin menghapus target ini? Jika ada saldo terkumpul, akan dikembalikan ke Saldo Utama.">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Nabung -->
                <div class="modal fade" id="nabungModal<?= $w['id_wishlist']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Nabung untuk: <?= $w['nama_target']; ?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?= form_open('wishlist/nabung/' . $w['id_wishlist']); ?>
                                <div class="modal-body">
                                    <p class="text-muted">Sisa yang dibutuhkan: <b>Rp. <?= number_format($w['harga_target'] - $w['saldo_terkumpul'], 0, ',', '.'); ?></b></p>
                                    <div class="form-group">
                                        <label>Pilih Dompet Sumber Dana</label>
                                        <select name="id_dompet" class="form-control select2" required style="width: 100%;">
                                            <option value="">-- Pilih Dompet --</option>
                                            <?php foreach ($list_dompet as $d) : ?>
                                                <option value="<?= $d['id_dompet']; ?>"><?= $d['nama_dompet']; ?> (Rp. <?= number_format($d['saldo'], 0, ',', '.'); ?>)</option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Nominal Nabung (Rp)</label>
                                        <input type="text" name="nominal" class="form-control input-rupiah" required>
                                        <small class="form-text text-muted">Total Saldo Utama Anda (Gabungan) saat ini: Rp. <?= number_format($user['saldo'], 0, ',', '.'); ?></small>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Simpan Dana</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

</div>
<!-- /.container-fluid -->

<!-- Modal Tambah Target -->
<div class="modal fade" id="tambahWishlistModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">Buat Target Menabung</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('wishlist/tambah'); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Impian/Target</label>
                        <input type="text" name="nama_target" class="form-control" placeholder="Contoh: Beli Laptop Baru" required>
                    </div>
                    <div class="form-group">
                        <label>Harga Target (Rp)</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp.</span>
                            </div>
                            <input type="text" name="harga_target" class="form-control input-rupiah" placeholder="Contoh: 15.000.000" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Tenggat Waktu / Deadline (Opsional)</label>
                        <input type="text" name="deadline" class="form-control datepicker" placeholder="Pilih Tanggal">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Target</button>
                </div>
            </form>
        </div>
    </div>
</div>
