<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
    <?= $this->session->flashdata('message'); ?>

    <?= form_open('user/eventPemasukan'); ?>

        <div class="row">
            <div class="col-lg-8">



                <div class="form-group row">
                    <label for="username" class="col-sm-2 col-form-label">Saldo Sekarang</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Rp.</span>
                            </div>
                            <input type="text" class="form-control" id="saldo" name="saldo" value="<?= number_format($user['saldo'], 0, ',', '.'); ?>" readonly>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="namaEvent" class="col-sm-2 col-form-label">Nama Event</label>
                    <div class="col-sm-10">
                        <select name="namaEvent" id="namaEvent" class="form-control select2" required onchange="document.getElementById('budgetSekarang').value = this.options[this.selectedIndex].getAttribute('data-budget');">
                            <option value="" data-budget="0">-- Pilih Event --</option>
                            <?php foreach ($events as $e) : ?>
                                <option value="<?= $e['namaEvent']; ?>" data-budget="<?= number_format($e['budget'], 0, ',', '.'); ?>"><?= $e['namaEvent']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?= form_error('namaEvent', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="budgetSekarang" class="col-sm-2 col-form-label">Budget Sekarang</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Rp.</span>
                            </div>
                            <input type="text" class="form-control" id="budgetSekarang" name="budgetSekarang" value="0" readonly>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                    <div class="col-sm-10">
                        <select name="kategori" id="kategori" class="form-control select2" required>
                            <option value="">-- Pilih Kategori --</option>
                            <?php foreach ($kategori_pemasukan as $k) : ?>
                                <option value="<?= $k['nama_kategori']; ?>"><?= $k['nama_kategori']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?= form_error('kategori', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Nama Pemasukan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="namaPemasukan" name="namaPemasukan" placeholder="Nama Pemasukan">
                        <?= form_error('namaPemasukan', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="budget" class="col-sm-2 col-form-label">Besar Pemasukan</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Rp.</span>
                            </div>
                            <input type="text" class="form-control input-rupiah" id="budget" name="budget" placeholder="Besar Pemasukan">
                        </div>
                    </div>
                </div>
                <div class="form-group row justify-content-end">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Submit Pemasukan</button>
                    </div>
                </div>

    </form>


</div>
</div>
</div>
