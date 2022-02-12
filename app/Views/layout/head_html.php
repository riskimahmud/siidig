<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        <?= (!empty($title)) ? $title . ' - ' : ''; ?>SIIDIG
    </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?= base_url("plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css"); ?>">
    <!-- Toastr -->
    <link rel="stylesheet" href="<?= base_url("plugins/toastr/toastr.min.css"); ?>">
    <!-- datepicker -->
    <link rel="stylesheet" href="<?= base_url("plugins/daterangepicker/daterangepicker.css"); ?>">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url("plugins/datatables-bs4/css/dataTables.bootstrap4.min.css"); ?>">
    <link rel="stylesheet" href="<?= base_url("plugins/datatables-responsive/css/responsive.bootstrap4.min.css"); ?>">

    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/1.13.1/css/OverlayScrollbars.min.css" />
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?= base_url("plugins/select2/css/select2.min.css"); ?>">
    <link rel="stylesheet" href="<?= base_url("plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css"); ?>">
    <!-- icheck-bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.min.css">
    <!-- Datepicker -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css"> -->
    <link rel="stylesheet" href="<?php echo base_url("plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css") ?>">

    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url("assets/css/adminlte.min.css") ?>">

    <script>
        const url = '<?= base_url(); ?>';
    </script>
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url("assets/css/style.css"); ?>">
</head>