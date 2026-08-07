<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#tambahRutinModal">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Transaksi Rutin
        </a>
    </div>

    <?= $this->session->flashdata('message'); ?>

    <!-- DataTables -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Transaksi Rutin Bulanan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Tgl Eksekusi</th>
                            <th>Judul</th>
                            <th>Jenis</th>
                            <th>Kategori</th>
                            <th>Dompet</th>
                            <th>Nominal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rutin as $r) : ?>
                            <tr>
                                <td class="font-weight-bold text-center">Tiap Tanggal <?= $r['tanggal_eksekusi']; ?></td>
                                <td><?= $r['judul']; ?></td>
                                <td>
                                    <?php if ($r['jenis'] == 'Pemasukan') : ?>
                                        <span class="badge badge-success">Pemasukan</span>
                                    <?php else : ?>
                                        <span class="badge badge-warning">Pengeluaran</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= $r['kategori']; ?></td>
                                <td><span class="badge badge-secondary"><?= $r['nama_dompet'] ? $r['nama_dompet'] : 'Utama'; ?></span></td>
                                <td>Rp. <?= number_format($r['nominal'], 0, ',', '.'); ?></td>
                                <td>
                                    <?php if ($r['status_aktif'] == 1) : ?>
                                        <span class="badge badge-primary">Aktif</span>
                                    <?php else : ?>
                                        <span class="badge badge-danger">Nonaktif</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($r['status_aktif'] == 1) : ?>
                                        <a href="<?= base_url('transaksirutin/toggle/') . $r['id_tr']; ?>" class="btn btn-sm btn-warning btn-confirm" data-message="Nonaktifkan transaksi rutin ini?">
                                            <i class="fas fa-power-off"></i> Off
                                        </a>
                                    <?php else : ?>
                                        <a href="<?= base_url('transaksirutin/toggle/') . $r['id_tr']; ?>" class="btn btn-sm btn-success btn-confirm" data-message="Aktifkan kembali transaksi rutin ini?">
                                            <i class="fas fa-power-off"></i> On
                                        </a>
                                    <?php endif; ?>
                                    <a href="<?= base_url('transaksirutin/hapus/') . $r['id_tr']; ?>" class="btn btn-sm btn-danger btn-confirm" data-message="Hapus transaksi rutin ini secara permanen?">
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

<!-- Modal Tambah Rutin -->
<div class="modal fade" id="tambahRutinModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Tambah Transaksi Rutin</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('transaksirutin/tambah'); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Judul Transaksi</label>
                        <input type="text" name="judul" class="form-control" placeholder="Contoh: Bayar Kos, Gaji Bulanan, dll" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Jenis Transaksi</label>
                        <select name="jenis" id="jenis_transaksi" class="form-control select2" required>
                            <option value="Pengeluaran">Pengeluaran</option>
                            <option value="Pemasukan">Pemasukan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="kategori" id="kategori_transaksi" class="form-control select2" required>
                            <!-- Diisi via JS berdasar jenis -->
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Pilih Dompet</label>
                        <select name="id_dompet" class="form-control select2" required>
                            <option value="">-- Pilih Dompet --</option>
                            <?php foreach ($list_dompet as $d) : ?>
                                <option value="<?= $d['id_dompet']; ?>"><?= $d['nama_dompet']; ?> (Saldo: Rp. <?= number_format($d['saldo'], 0, ',', '.'); ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Nominal (Rp)</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp.</span>
                            </div>
                            <input type="text" name="nominal" class="form-control input-rupiah" placeholder="Contoh: 500.000" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Dieksekusi Setiap Tanggal (1 - 31)</label>
                        <input type="number" name="tanggal_eksekusi" class="form-control" placeholder="1-31" min="1" max="31" required>
                        <small class="text-info">*Transaksi ini akan otomatis ditambahkan ke Riwayat Transaksi setiap bulan pada tanggal ini ketika Anda login.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Transaksi Rutin</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const jenisSelect = document.getElementById('jenis_transaksi');
    const kategoriSelect = document.getElementById('kategori_transaksi');

    const katPemasukan = <?= json_encode($kategori_pemasukan); ?>;
    const katPengeluaran = <?= json_encode($kategori_pengeluaran); ?>;

    function renderKategori() {
        const selectedJenis = jenisSelect.value;
        const options = selectedJenis === 'Pemasukan' ? katPemasukan : katPengeluaran;
        
        kategoriSelect.innerHTML = '';
        options.forEach(opt => {
            const newOption = new Option(opt.nama_kategori, opt.nama_kategori, false, false);
            kategoriSelect.append(newOption);
        });
        $('#kategori_transaksi').trigger('change');
    }

    $('#jenis_transaksi').on('change', renderKategori);
    renderKategori();
});
</script>
