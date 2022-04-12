<?= $this->include('layout/backend/head_html'); ?>

<body class="hold-transition layout-top-nav layout-navbar-fixed">
    <div class="wrapper">

        <nav class="main-header navbar navbar-expand-md navbar-dark navbar-purple">
            <div class="container">
                <a href="/" class="navbar-brand">
                    <img src="/assets/img/logo-white.png" alt="AdminLTE Logo" class="brand-image" style="opacity: .8">
                    <!-- <span class="brand-text font-weight-light">AdminLTE 3</span> -->
                </a>

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3 justify-content-center" id="navbarCollapse">
                    <!-- Left navbar links -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="/home" class="nav-link">Beranda</a>
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
                        <li class="nav-item">
                            <a href="/info-siinas" class="nav-link">SIINAS</a>
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

        <div class="content-wrapper bg-light">
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

                <?php
                $aplikasi = getAplikasi();
                if (!empty($aplikasi)) :
                ?>
                    <div class="container mt-5 pt-5 pb-3">
                        <h6 class="text-purple text-bold display-5 text-lg text-center mb-2">Aplikasi Terkait</h6>
                        <div class="row justify-content-center">
                            <?php foreach ($aplikasi as $apl) : ?>
                                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                    <a href="<?= $apl['link'] ?>" class="text-decoration-none" target="_blank">
                                        <div class="card shadow" style="height: 100px;">
                                            <div class="card-body p-0 overflow-hidden rounded-top text-center" style="background-image: url('/uploads/aplikasi/<?= $apl['gambar']; ?>'); background-repeat: no-repeat; background-position: center; background-size: cover;">
                                                <!-- <img src="/uploads/aplikasi/<?= $apl['gambar']; ?>" alt="" class=""> -->
                                            </div>
                                            <div class="card-footer text-center text-decoration-none text-secondary p-1 text-truncate">
                                                <?= $apl['nama_aplikasi'] ?>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                V 1.0.0
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2022 <a class="text-purple" href="https://diskumperindag.gorontaloprov.go.id/">Perindag Provinsi Gorontalo</a>.</strong> All rights reserved.
        </footer>
    </div>

    <?= $this->include('layout/backend/footer_js'); ?>
    <?= $this->renderSection('script'); ?>
</body>