<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Saqoe 2019</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?= base_url('auth/logout'); ?>">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>

<script>
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });
</script>

<!-- Page level plugins -->
<script src="<?= base_url('assets/'); ?>vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url('assets/'); ?>js/demo/chart-area-demo.js"></script>
<script src="<?= base_url('assets/'); ?>js/demo/chart-pie-demo.js"></script>

</body>

</html>


<!-- Modal Nambah Event -->
<div class="modal fade" id="TambahEvent" tabindex="-1" role="dialog" aria-labelledby="TambahEvent" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?= form_open('user/event'); ?>
                <div class="modal-header">
                    <h5 class="modal-title">Masukkan Nama Event</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group row">
                        <label for="username" class="col-sm-3 col-form-label">Username</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="username" name="username" value="<?= $user['username']; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">Nama Event</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="namaEvent" name="namaEvent" placeholder="Nama Event">
                            <?= form_error('namaPemasukan', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer center-block">
                    <div class="center-block">
                        <button type="submit" class="btn btn-primary center-block">Tambah Event</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal Pemasukan Event -->
<div class="modal fade" id="EventPemasukan" tabindex="-1" role="dialog" aria-labelledby="EventPemasukan" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="EventPemasukan">Pemasukan Event mana yang mau dipilih ?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open('user/eventPemasukan'); ?>
                    <div class="form-group row">
                        <label for="username" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="username" name="username" value="<?= $user['username']; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <select class="form-control" id="namaEvent" name="namaEvent" required>
                            <?php foreach ($event as $c) { ?>
                                <option value="<?php echo $c->namaEvent; ?>"> <?php echo $c->namaEvent; ?></option>
                            <?php } ?>
                        </select>
                    </div>
            </div>
            <div class="modal-footer center-block">
                <div class="center-block">
                    <button type="submit" class="btn btn-primary center-block">Pilih Event</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Pengeluaran Event -->
<div class="modal fade" id="EventPengeluaran" tabindex="-1" role="dialog" aria-labelledby="EventPengeluaran" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="EventPengeluaran">Pengeluaran Event mana yang mau dipilih ?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open('user/eventPengeluaran'); ?>
                    <div class="form-group row">
                        <label for="username" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="username" name="username" value="<?= $user['username']; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <select class="form-control" id="namaEvent" name="namaEvent" required>
                            <?php foreach ($event as $c) { ?>
                                <option value="<?php echo $c->namaEvent; ?>"> <?php echo $c->namaEvent; ?></option>
                            <?php } ?>
                        </select>
                    </div>
            </div>
            <div class="modal-footer center-block">
                <div class="center-block">
                    <button type="submit" class="btn btn-primary center-block">Pilih Event</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>