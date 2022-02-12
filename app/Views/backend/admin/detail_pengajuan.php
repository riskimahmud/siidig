<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <a href="<?= base_url("pengajuan"); ?>" class="btn btn-default mb-3"><i class="fas fa-arrow-left fa-fw"></i> Kembali</a>
        </div>

        <div class="col-12 col-md-9">
            <div class="card">
                <div class="card-header d-flex">
                    <h5 class="card-title"><i class="fas fa-list fa-fw fa-sm"></i> Data Pengajuan</h5>
                    <div class="ml-auto text-right">
                        Status : <?= statusPengajuan($data->status, $data->tolak); ?>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            if ($data->status == "3") :
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
                                    <b>Pangkat</b> <span class="float-right"> <?= getFieldSimpeg('t_golruang', 'nmgolruang', ['idgolruang' => $data->pangkat]); ?> - <?= $data->pangkat; ?></span>
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
                                <a href="<?= base_url("pengajuan/" . $data->pengajuan_id . "/ubah-data-sk"); ?>" class="btn btn-link btn-xs btn-flat">
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
                                        $dasar = json_decode($data->dasar);
                                        echo "<ol>";
                                        foreach ($dasar as $d) :
                                            echo "<li>$d</li>";
                                        endforeach;
                                        echo "</ol>";
                                        ?>

                                    </dd>
                                    <dt>TMT</dt>
                                    <dd><?= tgl_indonesia($data->tmt); ?></dd>
                                    <dt>Jenis Jabatan Baru</dt>
                                    <dd>
                                        <?php
                                        $jenis_jabatan_baru = getDataSimpeg("t_jabatankategori", ["idjabatan" => $data->jenis_jabatan_baru]);
                                        echo $jenis_jabatan_baru->jabatanjns . " | " . $jenis_jabatan_baru->nmjabatan;
                                        ?>
                                    </dd>
                                    <dt>Tugas Sebagai</dt>
                                    <dd><?= $data->tugas_sebagai; ?></dd>
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


            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><i class="fas fa-file fa-fw fa-sm"></i> Syarat</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Syarat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($data->status >= "1") : ?>
                                <?php
                                $no = 1;
                                foreach ($syarat_awal as $s) :
                                    $cek    =   ambil_data("upload_syarat", "getRow", [
                                        "syarat_id"   =>  $s->syarat_id,
                                        "pengajuan_id" =>  $data->pengajuan_id
                                    ]);
                                ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $s->nama_syarat; ?></td>
                                        <td>
                                            <?php if ($cek) : ?>
                                                <a href="<?= base_url("upload/syarat/" . $cek->file); ?>" class="btn btn-primary btn-xs lihatFile">Lihat</a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            <?php endif; ?>
                            <?php if ($data->status > "1") : ?>
                                <?php
                                foreach ($syarat as $s) :
                                    $cek    =   ambil_data("upload_syarat", "getRow", [
                                        "syarat_id"   =>  $s->syarat_id,
                                        "pengajuan_id" =>  $data->pengajuan_id
                                    ]);
                                ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $s->nama_syarat; ?></td>
                                        <td>
                                            <?php if ($cek) : ?>
                                                <a href="<?= base_url("upload/syarat/" . $cek->file); ?>" class="btn btn-primary btn-xs lihatFile">Lihat</a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class="d-flex justify-content-between">
                <?php if (($data->status == "1" && $data->tolak == "0") || ($data->status == "1" && $data->tolak == "1" && $data->edit_data == "1")) : ?>
                    <a href="<?= base_url("pengajuan/" . $data->pengajuan_id . "/proses-pengajuan"); ?>" class="btn btn-outline-success mb-4 flex-fill" id="prosesPengajuan"><i class="fas fa-check-circle fa-fw"></i> Proses</a>
                    <a href="javascript:void(0)" class="btn btn-outline-danger mb-4 flex-fill mx-1" id="tolakPengajuan"><i class="fas fa-times-circle fa-fw"></i> Tolak</a>
                <?php endif; ?>

                <?php if (($data->status == "2" && $data->tolak == "0") || ($data->status == "2" && $data->tolak == "1" && $data->edit_data == "1")) : ?>
                    <a href="<?= base_url("pengajuan/" . $data->pengajuan_id . "/proses-pengajuan"); ?>" class="btn btn-outline-success mb-4 flex-fill" id="prosesPengajuan"><i class="fas fa-check-circle fa-fw"></i> Setujui</a>
                    <a href="javascript:void(0)" class="btn btn-outline-danger mb-4 flex-fill mx-1" id="tolakPengajuan"><i class="fas fa-times-circle fa-fw"></i> Tolak</a>
                <?php endif; ?>

                <?php if ($data->status == "3") : ?>
                    <a href="<?= base_url("pengajuan/" . $data->pengajuan_id . "/selesai"); ?>" class="btn btn-outline-success mb-4 flex-fill" id="selesai"><i class="fas fa-print fa-fw"></i> Cetak & Selesaikan</a>
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

            <div class="tab-pane mt-4" id="timeline">
                <!-- The timeline -->
                <div class="timeline timeline-inverse">
                    <?php foreach ($riwayat_status as $rs) : ?>

                        <div>
                            <i class="fas fa-circle fa-sm bg-primary"></i>

                            <div class="timeline-item">
                                <span class="time"><i class="far fa-clock"></i> <?= jam($rs->create_at); ?></span>
                                <span class="time"><i class="far fa-calendar"></i> <?= tgl_indonesia_short($rs->create_at); ?></span>

                                <h6 class="timeline-header"><?= statusPengajuan($rs->status, $rs->tolak); ?></h6>

                                <div class="timeline-body">
                                    <?= $rs->keterangan; ?>
                                </div>

                                <div class="timeline-footer">
                                    <small class="text-muted"><i class="far fa-user fa-fw"></i> <?= $rs->create_by; ?></small>
                                </div>
                            </div>
                        </div>
                        <!-- END timeline item -->

                    <?php endforeach; ?>
                </div>
            </div>
            <!-- /.tab-pane -->
        </div>
    </div>
</div>

<div class="modal fade" id="modal-tolak" tabindex='-1'>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Alasan Anda Menolak?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open("pengajuan/tolak-pengajuan"); ?>
            <?= form_hidden('pengajuan_id', $data->pengajuan_id); ?>
            <div class="modal-body">
                <textarea name="alasan" id="alasanTolak" rows="4" class="form-control" placeholder="Masukkan Alasan Penolakan Disini." required></textarea>
                <?php if ($data->status <= "2") : ?>
                    <div class="custom-control custom-checkbox">
                        <input name="ubah_berkas" value="1" class="custom-control-input" type="checkbox" id="customCheckbox2" checked>
                        <label for="customCheckbox2" class="custom-control-label">Ubah Berkas?</label>
                    </div>
                <?php endif; ?>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            <?= form_close(); ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
    $(".pilihFile").on("click", function() {
        $(".formSpt").find(".my_file").click();
    })

    $('input[type=file]').change(function(e) {
        $(this).parent().submit();
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

    $("#tolakPengajuan").on("click", function(e) {
        e.preventDefault();
        const modalTolak = $("#modal-tolak");
        modalTolak.modal('show');
    })

    $('#modal-tolak').on('shown.bs.modal', function() {
        $('#alasanTolak').focus();
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