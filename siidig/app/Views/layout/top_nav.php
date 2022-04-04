<?= $this->include('layout/backend/head_html'); ?>

<body class="hold-transition layout-top-nav layout-navbar-fixed">
    <div class="wrapper">

        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
            <div class="container">
                <a href="/" class="navbar-brand">
                    <img src="/assets/img/logo-small.png" alt="AdminLTE Logo" class="brand-image" style="opacity: .8">
                    <!-- <span class="brand-text font-weight-light">AdminLTE 3</span> -->
                </a>

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3 justify-content-center" id="navbarCollapse">
                    <!-- Left navbar links -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="/" class="nav-link">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a href="/course" class="nav-link">Pelatihan</a>
                        </li>
                        <li class="nav-item">
                            <a href="/info-halal" class="nav-link">Fasilitasi Halal</a>
                        </li>
                        <li class="nav-item">
                            <a href="/info-kemasan" class="nav-link">Fasilitasi Kemasan</a>
                        </li>
                        <!-- <li class="nav-item dropdown">
                            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Informasi</a>
                            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                                <li><a href="/info-halal" class="dropdown-item">Fasilitasi Halal </a></li>
                                <li><a href="/info-kemasan" class="dropdown-item">Fasilitasi Kemasan</a></li>
                                <li><a href="#" class="dropdown-item">Perusahaan SIINAS</a></li>
                    </ul>
                    </li> -->
                        <!-- <li class="nav-item">
                            <a href="/login" class="nav-link">Login</a>
                        </li> -->
                    </ul>
                </div>

                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/login">
                            Login <i class="fas fa-sign-in"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- /.navbar -->

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark"><?= $title; ?></h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <!-- <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">Layout</a></li>
                                <li class="breadcrumb-item active">Top Navigation</li>
                            </ol> -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <div class="content">
                <div class="container">
                    <?= $this->renderSection('content'); ?>
                </div>
            </div>
        </div>

        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                V 1.0.0
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2022 <a href="https://diskumperindag.gorontaloprov.go.id/">Perindag Provinsi Gorontalo</a>.</strong> All rights reserved.
        </footer>
    </div>

    <?= $this->include('layout/backend/footer_js'); ?>
    <?= $this->renderSection('script'); ?>
</body>