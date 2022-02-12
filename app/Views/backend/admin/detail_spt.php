<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <a href="<?= base_url("spt"); ?>" class="btn btn-default mb-3"><i class="fas fa-arrow-left fa-fw"></i> Kembali</a>
        </div>

        <div class="col-12 col-md-9">
            <div class="card">
                <div class="card-header d-flex">
                    <h5 class="card-title"><i class="fas fa-list fa-fw fa-sm"></i> Data Pengajuan</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            if ($data->status == "3" && $data->tmt !== NULL) :
                                if ($data->tmt > date("Y-m-d")) :
                            ?>
                                    <h5 class="bg-warning p-1">TMT : <?= time_togo_string($data->tmt . " 00:00:00"); ?></h5>
                                <?php else : ?>
                                    <h5 class="bg-primary p-1">Sudah Masuk Waktu TMT</h5>
                                <?php endif; ?>
                            <?php endif; ?>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>NIP</b> <span class="float-right"><?= $data->nip; ?></span>
                                </li>
                                <li class="list-group-item">
                                    <b>Nama</b> <span class="float-right"><?= $data->nama; ?></span>
                                </li>
                                <li class="list-group-item">
                                    <b>Pangkat</b> <span class="float-right"><?= $data->pangkat; ?></span>
                                </li>
                                <li class="list-group-item">
                                    <b>Jabatan Sekarang</b> <span class="float-right"><?= $data->nama_jabatan_lama; ?></span>
                                </li>
                                <li class="list-group-item">
                                    <b>Unit Kerja Sekarang</b> <span class="float-right"><?= $data->unorname_lama; ?></span>
                                </li>
                                <li class="list-group-item">
                                    <b>Unit Organisasi Lama</b> <span class="float-right"><?= $data->unit_organisasi_lama; ?></span>
                                </li>
                                <li class="list-group-item mt-4">
                                    <b>Jenis Pengajuan</b> <span class="float-right"><?= $data->jenis_pengajuan; ?></span>
                                </li>
                                <li class="list-group-item">
                                    <b>Usulan Jabatan</b> <span class="float-right"><?= $data->nama_jabatan_baru; ?></span>
                                </li>
                                <li class="list-group-item">
                                    <b>Unit Kerja</b> <span class="float-right"><?= $data->unorname_baru; ?></span>
                                </li>
                                <li class="list-group-item">
                                    <b>Unit Organisasi</b> <span class="float-right"><?= $data->unit_organisasi_baru; ?></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <?php if ($data->status >= 3) : ?>
                <div class="card">
                    <div class="card-header d-flex">
                        <h5 class="card-title"><i class="fas fa-file-word fa-fw fa-sm"></i> Data Surat Tugas</h5>
                        <?php if ($data->status == 3) : ?>
                            <div class="ml-auto text-right">
                                <a href="<?= base_url("spt/" . $data->pengajuan_id . "/ubah-data-sk"); ?>" class="btn btn-link btn-xs btn-flat">
                                    <div class="far fa-edit fa-fw"></div> Ubah
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <dl>
                                    <dt>Dasar Keputusan</dt>
                                    <dd>
                                        <?php
                                        if ($data->dasar != "") {
                                            $dasar = json_decode($data->dasar);
                                            echo "<ol>";
                                            foreach ($dasar as $d) :
                                                echo "<li>$d</li>";
                                            endforeach;
                                            echo "</ol>";
                                        } else {
                                            echo "-";
                                        }
                                        ?>

                                    </dd>
                                    <dt>TMT</dt>
                                    <dd><?= tgl_indonesia($data->tmt); ?></dd>
                                    <dt>Jenis Jabatan Baru</dt>
                                    <dd>
                                        <?php
                                        if ($data->jenis_jabatan_baru != "") {
                                            $jenis_jabatan_baru = getDataSimpeg("t_jabatankategori", ["idjabatan" => $data->jenis_jabatan_baru]);
                                            echo $jenis_jabatan_baru->jabatanjns . " | " . $jenis_jabatan_baru->nmjabatan;
                                        } else {
                                            echo "-";
                                        }
                                        ?>
                                    </dd>
                                    <dt>Tugas Sebagai</dt>
                                    <dd><?= ($data->tugas_sebagai == "") ? '-' : $data->tugas_sebagai; ?></dd>
                                    <dt>Nomor Surat</dt>
                                    <dd><?= ($data->sk_nomor == "") ? '-' : $data->sk_nomor; ?></dd>
                                    <dt>Tgl Surat</dt>
                                    <dd><?= tgl_indonesia($data->sk_tgl); ?></dd>
                                    <dt>Jabatan Penandatangan</dt>
                                    <dd><?= ($data->sk_jabatan_ttd) ? $data->sk_jabatan_ttd : '-'; ?></dd>
                                    <dt>Penandatangan</dt>
                                    <dd>
                                        <?php
                                        if ($data->sk_ttd == "") {
                                            echo "-";
                                        } else {
                                            echo "<ul>";
                                            $ttd = explode(";", $data->sk_ttd);
                                        ?>
                                            <li>Nama : <?= $ttd[0]; ?></li>
                                            <li>Pangkat : <?= $ttd[1]; ?></li>
                                            <li>NIP : <?= $ttd[2]; ?></li>
                                        <?php
                                            echo "</ul>";
                                        }
                                        ?>
                                    </dd>
                                    <dt>Tembusan</dt>
                                    <dd>
                                        <?php
                                        if ($data->sk_tembusan == "") {
                                            echo "-";
                                        } else {
                                            $tembusan = explode(";", $data->sk_tembusan);
                                            echo "<ul>";
                                            foreach ($tembusan as $tem) :
                                        ?>
                                                <li><?= $tem; ?></li>
                                        <?php
                                            endforeach;
                                            echo "</ul>";
                                        }
                                        ?>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <div class="col-12 col-md-3">
            <div class="d-flex justify-content-between">
                <?php if ($data->status == "3") : ?>
                    <a href="<?= base_url("pengajuan/" . $data->pengajuan_id . "/selesai"); ?>" class="btn btn-outline-success mb-4 flex-fill <?= ($data->sk_nomor == "") ? "disabled" : ""; ?>" id="selesai"><i class="fas fa-print fa-fw"></i> Cetak & Selesaikan</a>
                <?php endif; ?>
                <?php if ($data->status == "4") : ?>
                    <a target="_blank" href="<?= base_url("pengajuan/" . $data->pengajuan_id . "/print"); ?>" class="btn btn-outline-success mb-1 flex-fill"><i class="fas fa-print fa-fw"></i> Cetak</a>

                    <?php
                    if ($data->file_spt == "") {
                        $labelPilih =   'Upload SPT';
                    } else {
                        $labelPilih =   'Ganti SPT';
                    } ?>

                    <button class="btn btn-outline-dark mb-1 mx-1 flex-fill pilihFile"><i class="fas fa-upload fa-fw"></i> <?= $labelPilih; ?></button>

                    <form action="<?= base_url("pengajuan/unggah-spt"); ?>" method="POST" enctype="multipart/form-data" class="formSpt">
                        <input type="file" name="file_syarat" class="d-none my_file">
                        <input type="hidden" name="pengajuan_id" value="<?= $data->pengajuan_id; ?>">
                    </form>
                <?php endif; ?>
            </div>

            <?php
            if ($data->status == "4") :
                if ($data->file_spt != "") :
            ?>
                    <a href="<?= base_url("upload/spt/" . $data->file_spt); ?>" class="btn btn-danger btn-block lihatFile"><i class="far fa-file-pdf fa-fw"></i> Lihat SPT</a>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
    $(".pilihFile").on("click", function() {
        $(".formSpt").find(".my_file").click();
    })

    $('input[type=file]').change(function(e) {
        $(this).parent().submit();
    });

    $(".lihatFile").on("click", function(e) {
        e.preventDefault();
        const urlFile = $(this).attr("href");
        const modal = $("#modal");
        const tempatFile = modal.find(".modal-body");
        const options = {
            height: "600px",
            // pdfOpenParams: {
            //     view: 'FitV',
            //     page: '2'
            // }
        };
        modal.modal('show');
        PDFObject.embed(urlFile, tempatFile, options);
    });

    $("#prosesPengajuan").on("click", function(e) {
        e.preventDefault();
        const link = $(this).attr("href");

        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Memproses Pengajuan Ini.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya. Proses!',
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-danger ml-1',
            cancelButtonText: 'Batal',
            buttonsStyling: false,
        }).then(function(result) {
            if (result.value) {
                document.location.href = link;
            }
        })
    })

    $("#selesai").on("click", function(e) {
        e.preventDefault();
        const link = $(this).attr("href");

        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Apablia pengajuan telah selesai, tidak dapat kembali mengubah data Surat Tugas",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya. Selesaikan!',
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-danger ml-1',
            cancelButtonText: 'Batal',
            buttonsStyling: false,
        }).then(function(result) {
            if (result.value) {
                // document.location.href = link;
                window.open(link, '_blank');
                setTimeout(function() {
                    location.reload();
                }, 5000);
            }
        })
    })
</script>
<?= $this->endSection(); ?>