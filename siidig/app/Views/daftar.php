<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Daftar | e-skck POLRES GORONTALO KOTA</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url("plugins/fontawesome-free/css/all.min.css"); ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url("plugins/icheck-bootstrap/icheck-bootstrap.min.css"); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <link rel="stylesheet" href="<?= base_url("assets/css/style.css"); ?>">

    <script>
        const url = '<?= base_url(); ?>';
    </script>
</head>

<body class="hold-transition register-page">
    <div class="register-box">
        <div class="register-logo mb-0">
            <a class="font-weight-bolder" href="<?= base_url(); ?>">E-<b>SKCK</b></a>
        </div>
        <span class="d-block text-center mt-0 mb-4">POLRES GORONTALO KOTA</span>
        <!-- /.login-logo -->
        <?php if (session()->getFlashdata("notifikasi")) { ?>
            <div class="alert alert-<?= session()->getFlashdata("notifikasi")["status"] ?> alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5>
                    <?php if (session()->getFlashdata("notifikasi")["status"] == "success") { ?>
                        <i class="fas fa-check-circle"></i> Berhasil!
                    <?php } else { ?>
                        <i class="fas fa-times-circle"></i> Gagal!
                    <?php } ?>
                </h5>
                <?= session()->getFlashdata("notifikasi")["msg"]; ?>
            </div>
            <!-- <div class="alert alert-<?= session()->getFlashdata("notifikasi")["status"] ?> alert-dismissible mb-2" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="d-flex align-items-center">
                    <?php if (session()->getFlashdata("notifikasi")["status"] == "success") { ?>
                        <i class="fas fa-check-circle"></i>
                    <?php } else { ?>
                        <i class="fas fa-times-circle"></i>
                    <?php } ?>
                    <span>
                        <?= session()->getFlashdata("notifikasi")["msg"]; ?>
                    </span>
                </div>
            </div> -->
        <?php } ?>
        <div class="card shadow-lg">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Mendaftar</p>
                <form action="" method="POST" autocomplete="off">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control <?= ($validation->hasError('no_identitas')) ? 'is-invalid' : ''; ?>" name="no_identitas" placeholder="No. Identitas" value="<?= set_value('no_identitas', ''); ?>" autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-id-card"></span>
                            </div>
                        </div>
                        <div class="invalid-feedback"><?= $validation->getError('no_identitas'); ?></div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" name="nama" placeholder="Nama" value="<?= set_value('nama', ''); ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        <div class="invalid-feedback"><?= $validation->getError('nama'); ?></div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" name="username" placeholder="Username" value="<?= set_value('username', ''); ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user-lock"></span>
                            </div>
                        </div>
                        <div class="invalid-feedback"><?= $validation->getError('username'); ?></div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" name="email" placeholder="Email" value="<?= set_value('email', ''); ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        <div class="invalid-feedback"><?= $validation->getError('email'); ?></div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" name="password" placeholder="Password" value="<?= set_value('password', ''); ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <div class="invalid-feedback"><?= $validation->getError('password'); ?></div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control <?= ($validation->hasError('ulangi_password')) ? 'is-invalid' : ''; ?>" name="ulangi_password" placeholder="Ulangi password" value="<?= set_value('ulangi_password', ''); ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <div class="invalid-feedback"><?= $validation->getError('ulangi_password'); ?></div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="agreeTerms" name="terms" value="agree" required <?= set_checkbox('terms', 'agree'); ?>>
                                <label for="agreeTerms">
                                    Saya setuju dengan <a href="#">SKB</a>
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" name="submit" value="Daftar" class="btn btn-primary btn-block">Daftar</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <!-- /.social-auth-links -->

                <hr>
                <p class="mb-0">
                    <a href="<?= base_url(); ?>" class="text-center">Masuk</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url("dist/js/adminlte.min.js"); ?>"></script>

</body>

</html>