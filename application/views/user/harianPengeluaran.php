<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
    <?= $this->session->flashdata('message'); ?>

    <?= form_open_multipart('user/harianPengeluaran'); ?>

        <div class="row">
            <div class="col-lg-8">



                <div class="form-group row">
                    <label for="id_dompet" class="col-sm-2 col-form-label">Dompet Utama</label>
                    <div class="col-sm-10">
                        <select name="id_dompet" id="id_dompet" class="form-control select2" required>
                            <option value="">-- Pilih Dompet --</option>
                            <?php foreach ($list_dompet as $d) : ?>
                                <option value="<?= $d['id_dompet']; ?>"><?= $d['nama_dompet']; ?> (Rp. <?= number_format($d['saldo'], 0, ',', '.'); ?>)</option>
                            <?php endforeach; ?>
                        </select>
                        <?= form_error('id_dompet', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-10">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="kombinasi_dompet" name="kombinasi_dompet" value="1">
                            <label class="custom-control-label" for="kombinasi_dompet">Kombinasi dengan Dompet ke-2?</label>
                        </div>
                    </div>
                </div>

                <div id="dompet_2_container" style="display: none; padding: 15px; background: #f8f9fc; border-radius: 5px; margin-bottom: 15px;">
                    <div class="form-group row">
                        <label for="id_dompet_2" class="col-sm-3 col-form-label">Dompet ke-2</label>
                        <div class="col-sm-9">
                            <select name="id_dompet_2" id="id_dompet_2" class="form-control select2">
                                <option value="">-- Pilih Dompet ke-2 --</option>
                                <?php foreach ($list_dompet as $d) : ?>
                                    <option value="<?= $d['id_dompet']; ?>"><?= $d['nama_dompet']; ?> (Rp. <?= number_format($d['saldo'], 0, ',', '.'); ?>)</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nominal_dompet_1" class="col-sm-3 col-form-label">Dipotong dari Dompet Utama</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp.</span>
                                </div>
                                <input type="text" class="form-control input-rupiah" id="nominal_dompet_1" name="nominal_dompet_1" placeholder="Nominal dipotong dari Dompet Utama">
                            </div>
                            <small class="form-text text-muted">Sisa total pengeluaran akan otomatis memotong Dompet ke-2.</small>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                    <div class="col-sm-10">
                        <select name="kategori" id="kategori" class="form-control select2" required>
                            <option value="">-- Pilih Kategori --</option>
                            <?php foreach ($kategori_pengeluaran as $k) : ?>
                                <option value="<?= $k['nama_kategori']; ?>"><?= $k['nama_kategori']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?= form_error('kategori', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Nama Pengeluaran</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="namaPengeluaran" name="namaPengeluaran" placeholder="Nama Pengeluaran">
                        <?= form_error('namaPengeluaran', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Besar Pengeluaran</label>
                    <div class="col-sm-10">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Rp.</span>
                            </div>
                            <input type="text" class="form-control input-rupiah" id="besarPengeluaran" name="besarPengeluaran" placeholder="Besar Pengeluaran">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="struk" class="col-sm-2 col-form-label">Bukti Pengeluaran (Opsional)</label>
                    <div class="col-sm-10">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="struk" name="struk" accept="image/*">
                            <label class="custom-file-label" for="struk">Pilih Gambar (Struk)</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row justify-content-end">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Submit Pengeluaran</button>
                    </div>
                </div>

    </form>
</div>
</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const cbKombinasi = document.getElementById('kombinasi_dompet');
    const containerDompet2 = document.getElementById('dompet_2_container');
    const inputIdDompet2 = document.getElementById('id_dompet_2');
    const inputNominal1 = document.getElementById('nominal_dompet_1');

    cbKombinasi.addEventListener('change', function() {
        if (this.checked) {
            containerDompet2.style.display = 'block';
            inputIdDompet2.setAttribute('required', 'required');
            inputNominal1.setAttribute('required', 'required');
        } else {
            containerDompet2.style.display = 'none';
            inputIdDompet2.removeAttribute('required');
            inputNominal1.removeAttribute('required');
        }
    });
});
</script>
