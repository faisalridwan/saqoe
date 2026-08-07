<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
    <?= $this->session->flashdata('message'); ?>

    <?= form_open('user/eventPemasukan'); ?>

        <div class="row">
            <div class="col-lg-8">

                <div class="form-group row">
                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="username" name="username" value="<?= $user['username']; ?>" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="username" class="col-sm-2 col-form-label">Saldo Sekarang</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="saldo" name="saldo" value="<?= $user['saldo']; ?>" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="username" class="col-sm-2 col-form-label">Nama Event</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="namaEvent" name="namaEvent" value="<?= $eventt['namaEvent'] ?>" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="username" class="col-sm-2 col-form-label">Budget Sekarang</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="budgetSekarang" name="budgetSekarang" value="<?= $eventt['budget'] ?>" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Nama Budget</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="namaPemasukan" name="namaPemasukan" placeholder="Nama Budget">
                        <?= form_error('namaPemasukan', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Besar Budget Pemasukan</label>
                    <div class="col-sm-10">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Rp.</span>
                            </div>
                            <input type="text" class="form-control" id="budget" name="budget" placeholder="Besar Budget Pemasukan">
                        </div>
                    </div>
                </div>
                <div class="form-group row justify-content-end">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Submit Budget</button>
                    </div>
                </div>

    </form>


</div>
</div>
</div>
</div>