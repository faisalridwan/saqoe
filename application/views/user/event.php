<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-12">
            <?= $this->session->flashdata('message'); ?>
            <?= form_error('namaEvent', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
        </div>
    </div>

    <!-- Tambah Event -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Event / Kegiatan</h6>
            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambahEventModal">
                <i class="fas fa-plus"></i> Tambah Event
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>No</th>
                            <th>Nama Event</th>
                            <th>Budget</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; foreach ($event as $e) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= htmlspecialchars($e['namaEvent']); ?></td>
                                <td>Rp. <?= number_format($e['budget'], 0, ',', '.'); ?></td>
                                <td>
                                    <!-- Use str_replace for ID since event name might contain spaces -->
                                    <?php $modalId = preg_replace('/[^A-Za-z0-9\-]/', '', $e['namaEvent']); ?>
                                    <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#editEventModal<?= $modalId; ?>">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <a href="<?= base_url('event/hapus/') . urlencode($e['namaEvent']); ?>" class="btn btn-sm btn-danger btn-confirm" data-message="Yakin ingin menghapus Event ini? Seluruh transaksi terkait event ini juga akan terhapus.">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editEventModal<?= $modalId; ?>" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Event</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <?= form_open('event/edit'); ?>
                                            <div class="modal-body">
                                                <input type="hidden" name="namaEventLama" value="<?= htmlspecialchars($e['namaEvent']); ?>">
                                                
                                                <div class="form-group">
                                                    <label>Nama Event</label>
                                                    <input type="text" name="namaEvent" class="form-control" value="<?= htmlspecialchars($e['namaEvent']); ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Budget</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Rp.</span>
                                                        </div>
                                                        <input type="text" name="budget" class="form-control format-rupiah" value="<?= number_format($e['budget'], 0, ',', '.'); ?>" required>
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
<div class="modal fade" id="tambahEventModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Event Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('event/tambah'); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Event</label>
                        <input type="text" name="namaEvent" class="form-control" placeholder="Contoh: Liburan Bali" required>
                    </div>
                    <div class="form-group">
                        <label>Budget</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp.</span>
                            </div>
                            <input type="text" name="budget" class="form-control format-rupiah" placeholder="0" required>
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

<script>
// Auto-format rupiah in input fields
document.addEventListener('DOMContentLoaded', function() {
    var rupiahInputs = document.querySelectorAll('.format-rupiah');
    rupiahInputs.forEach(function(input) {
        input.addEventListener('keyup', function(e) {
            input.value = formatRupiah(this.value);
        });
    });

    function formatRupiah(angka) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split   = number_string.split(','),
            sisa    = split[0].length % 3,
            rupiah  = split[0].substr(0, sisa),
            ribuan  = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return rupiah;
    }
});
</script>
