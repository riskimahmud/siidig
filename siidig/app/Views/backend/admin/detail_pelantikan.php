<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12 d-flex mb-3">
            <a href="<?= base_url("spt-pelantikan"); ?>" class="btn btn-default"><i class="fas fa-arrow-left fa-fw"></i> Kembali</a>
            <div class="btn-group ml-auto">
                <?php if ($data->selesai == "") : ?>
                    <a href="<?= base_url("spt-pelantikan/$data->pelantikan_id/selesai"); ?>" class="btn btn-success" id="selesaikan"><i class="far fa-check fa-fw"></i> Selesaikan</a>
                    <a href="<?= base_url("spt-pelantikan/$data->pelantikan_id/ubah"); ?>" class="btn btn-primary ml-1"><i class="far fa-edit fa-fw"></i> Ubah</a>
                    <a href="<?= base_url("spt-pelantikan/$data->pelantikan_id/hapus"); ?>" class="btn btn-danger ml-1 delete"><i class="far fa-trash-alt fa-fw"></i> Hapus</a>
                <?php else : ?>
                    <?php if ($data->sinkron_simpeg == "" && $data->tgl_berlaku <= date("Y-m-d")) : ?>
                        <a href="<?= base_url("spt-pelantikan/$data->pelantikan_id/sinkron"); ?>" class="btn btn-warning"><i class="far fa-sync-alt fa-fw"></i> Sinkron Simpeg</a>
                    <?php endif; ?>
                    <a target="_blank" href="<?= base_url("spt-pelantikan/$data->pelantikan_id/cetak"); ?>" class="btn btn-primary ml-1"><i class="far fa-print fa-fw"></i> Cetak Semua</a>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><i class="fas fa-list fa-fw fa-sm"></i> Data Pelantikan</h5>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>No. Surat Tim Penilai</b> <span class="float-right"><?= $data->no_surat_tim_penilai; ?></span>
                                </li>
                                <li class="list-group-item">
                                    <b>Tgl Surat Tim Penilai</b> <span class="float-right"><?= tgl_indonesia($data->tgl_surat_tim_penilai); ?></span>
                                </li>
                                <li class="list-group-item">
                                    <b>No. Surat Pelantikan</b> <span class="float-right"><?= $data->no_surat; ?></span>
                                </li>
                                <li class="list-group-item">
                                    <b>Tgl Surat Pelantikan</b> <span class="float-right"><?= tgl_indonesia($data->tgl_surat); ?></span>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Tgl Pelantikan</b> <span class="float-right"><?= tgl_indonesia($data->tgl_pelantikan); ?></span>
                                </li>
                                <li class="list-group-item">
                                    <b>Tgl Berlaku</b> <span class="float-right"><?= tgl_indonesia($data->tgl_berlaku); ?></span>
                                </li>
                                <li class="list-group-item">
                                    <?php
                                    if ($data->sinkron_simpeg == "") {
                                        echo "<span class='badge badge-warning'>Belum Sinkron Simpeg</span>";
                                    } else {
                                        echo "<span class='badge badge-success'>Sudah Sinkron Simpeg</span>";
                                    }
                                    ?>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <b>Mengingat</b>
                            <ol>
                                <?php
                                $mengingat    =   json_decode($data->mengingat);
                                foreach ($mengingat as $meng) :
                                ?>
                                    <li><?= $meng; ?></li>
                                <?php endforeach; ?>
                            </ol>
                        </div>
                        <div class="col-md-6">
                            <b>Menimbang</b>
                            <ol class="">
                                <?php
                                $menimbang    =   json_decode($data->menimbang);
                                foreach ($menimbang as $men) :
                                ?>
                                    <li><?= $men; ?></li>
                                <?php endforeach; ?>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><i class="fas fa-users fa-fw fa-sm"></i> Data Pegawai</h5>
                    <?php if ($data->selesai == "") : ?>
                        <div class="card-tools">
                            <a href="<?= base_url("spt-pelantikan/" . $data->pelantikan_id . "/tambah-pegawai"); ?>" class="btn btn-default btn-sm">
                                <i class="fas fa-plus-circle"></i> Tambah Pegawai
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="dataTable">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>NIP / Nama</th>
                                <th>Jabatan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($pegawai as $peg) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td>
                                        <?= $peg->nip . "<br>" . $peg->nama; ?>
                                    </td>
                                    <td>
                                        Lama: <br>
                                        <?= $peg->nama_jabatan_lama; ?><br>
                                        <b><?= $peg->unorname_lama; ?></b>

                                        <br>
                                        <br>

                                        Baru: <br>
                                        <?= $peg->nama_jabatan_baru; ?><br>
                                        <b><?= $peg->unorname_baru; ?></b>
                                    </td>
                                    <td>
                                        <?php if ($data->selesai == "") : ?>
                                            <a href="<?= base_url("spt-pelantikan/" . $data->pelantikan_id . "/ubah-pegawai/" . $peg->pelantikan_detail_id); ?>" class="btn btn-default btn-sm"><i class="far fa-edit fa-fw"></i> Ubah</a>
                                            <a href="<?= base_url("spt-pelantikan/" . $data->pelantikan_id . "/hapus-pegawai/" . $peg->pelantikan_detail_id); ?>" class="btn btn-danger btn-sm delete"><i class="far fa-trash-alt fa-fw"></i> Hapus</a>
                                        <?php else : ?>
                                            <a target="_blank" href="<?= base_url("spt-pelantikan/" . $data->pelantikan_id . "/cetak-petikan/" . $peg->pelantikan_detail_id); ?>" class="btn btn-primary btn-sm"><i class="far fa-print fa-fw"></i> Cetak</a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.modal -->
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
    $("#selesaikan").on("click", function(e) {
        e.preventDefault();
        const link = $(this).attr("href");
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Apabila telah menekan selesai, data tidak dapat diubah atau dihapus lagi.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya. Selesaikan!',
            confirmButtonClass: 'btn btn-warning',
            cancelButtonClass: 'btn btn-danger ml-1',
            cancelButtonText: 'Batal',
            buttonsStyling: false,
        }).then(function(result) {
            if (result.value) {
                document.location.href = link;
            }
        })
    });
</script>
<?= $this->endSection(); ?>