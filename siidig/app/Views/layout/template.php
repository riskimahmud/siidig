    <?= $this->include('layout/backend/head_html'); ?>
    <!-- Site wrapper -->

    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">

            <?= $this->include('layout/backend/header'); ?>

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">

                <!-- Brand Logo -->
                <a href="<?= base_url(); ?>" class="brand-link">
                    <img src="<?php echo base_url("assets/img/logo-provinsi.png"); ?>" alt="AdminLTE Logo" class="brand-image">
                    <span class="brand-text font-weight-bold text-center">
                        <!-- SIIDIG -->
                        <img src="<?php echo base_url("assets/img/logo-small.png"); ?>" style="height:1.6em;">
                    </span>
                </a>

                <!-- Sidebar -->
                <?= $this->include('layout/backend/sidebar'); ?>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper pb-2">

                <!-- Content Header (Page header) -->
                <?= $this->include("layout/backend/breadcrumb.php") ?>
                <!-- /.content-header -->
                <!-- Main content -->
                <section class="content">
                    <?= $this->renderSection('content'); ?>

                    <div class="modal fade" id="modal" tabindex='-1'>
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title"></h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.modal -->
                </section>
                <!-- /.content -->
                <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
                    <i class="fas fa-chevron-up"></i>
                </a>
            </div>


            <?= $this->include('layout/backend/footer'); ?>
            <!-- /.control-sidebar -->

            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
        </div>
        <?= $this->include('layout/backend/footer_js'); ?>
        <?= $this->renderSection('script'); ?>
        <?= $this->include('layout/backend/foot_html'); ?>
    </body>

    </html>