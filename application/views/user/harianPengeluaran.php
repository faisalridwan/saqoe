<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
    <?= $this->session->flashdata('message'); ?>

    <?= form_open('user/harianPengeluaran'); ?>

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
                <div class="form-group row justify-content-end">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Submit Pengeluaran</button>
                    </div>
                </div>

    </form>
</div>
</div>
</div>
