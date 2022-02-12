<?= $this->include('layout/head_html'); ?>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark"> CEK SPT</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6 text-right">
                            SIMPATI Kota Gorontalo
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>

            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="d-block mb-3"><i class="far fa-user fa-fw"></i> Pegawai</h5>
                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b>NIP</b> <span class="float-right"><?= $pengajuan->nip; ?></span>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Nama</b> <span class="float-right"><?= $pengajuan->nama; ?></span>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Pangkat</b> <span class="float-right"><?= $pengajuan->pangkat; ?></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="d-block mb-3"><i class="far fa-file-pdf fa-fw"></i> SPT</h5>
                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b>Jabatan</b> <span class="float-right"><?= $pengajuan->nama_jabatan_baru; ?></span>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Unit Kerja</b> <span class="float-right"><?= $pengajuan->unorname_baru; ?></span>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Unit Organisasi</b> <span class="float-right"><?= $pengajuan->unit_organisasi_baru; ?></span>
                                        </li>
                                        <li class="list-group-item">
                                            <b>TMT</b> <span class="float-right"><?= tgl_indonesia($pengajuan->tmt); ?></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?= $this->include('layout/footer_js'); ?>