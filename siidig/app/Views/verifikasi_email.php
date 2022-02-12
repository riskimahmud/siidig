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

        <div class="alert alert-<?= $alert; ?> alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5>
                <?php if ($status == "1") { ?>
                    <i class="fas fa-check-circle"></i> Berhasil!
                <?php } else { ?>
                    <i class="fas fa-times-circle"></i> Gagal!
                <?php } ?>
            </h5>
            <?= $msg; ?>
        </div>

        <a href="<?= base_url(); ?>" class="btn btn-dark btn-block"><i class="fas fa-arrow-left fa-fw"></i> Kembali</a>

    </div>
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url("dist/js/adminlte.min.js"); ?>"></script>

</body>

</html>