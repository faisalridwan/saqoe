                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

                    <div class="card mb-5" style="max-width: 540px;">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="card-img">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h4 class="card-title"><?= $user['name']; ?></h4>
                                    <p class="card-text">
                                        <h6>Username : </h6><?= $user['username']; ?>
                                    </p>
                                    <p class="card-text">
                                        <h6>Email : </h6><?= $user['email']; ?>
                                    </p>
                                    <p class="card-text">
                                        <h6>Phone Number : </h6><?= $user['phoneNumber']; ?>
                                    </p>
                                    <p class="card-text">
                                        <h6>Address : </h6><?= $user['address']; ?>
                                    </p>
                                    <p class="card-text"><small class="text-muted">Member since <?= date('d F Y', $user['datecreated']); ?></small></p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

                
                <!-- End of Main Content -->