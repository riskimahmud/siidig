<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-body table-responsive">
                    <table class="table table-hover table-striped text-nowrap" id="dataTable">
                        <thead>
                            <tr>
                                <th width="10">No</th>
                                <th>Pegawai</th>
                                <th>Usulan Jabatan</th>
                                <th>TMT</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($data as $d) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td>
                                        <?= $d->nip . "<br>" . $d->nama; ?>
                                        <?= "<b class='d-block'>$d->unorname_lama</b>"; ?>
                                    </td>
                                    <td>
                                        <?= $d->nama_jabatan_baru . "<br><b>" . $d->unorname_baru . "</b>"; ?>
                                        <?= ($d->unit_organisasi_baru != "") ? "<span class='d-block'>($d->unit_organisasi_baru)</span>" : ""; ?>
                                    </td>
                                    <td><?= tgl_indonesia($d->tmt); ?></td>
                                    <td>
                                        <?php if ($d->sinkron_simpeg != "") : ?>
                                            <span class="badge badge-success">Telah Sinkron</span>
                                        <?php else : ?>
                                            <form action="<?= base_url("/sinkron"); ?>" method="POST">
                                                <input type="hidden" name="pengajuan_id" value="<?= $d->pengajuan_id; ?>">
                                                <button type="submit" class="btn btn-primary badge" id="sinkron" title="Sinkron"><i class="far fa-sync fa-fw"></i> Sinkron Simpeg</button>
                                            </form>
                                            <!-- <a href="<?= base_url("tmt/" . $d->pengajuan_id); ?>" class="btn btn-primary badge" title="Sinkron"><i class="far fa-sync fa-fw"></i> Sinkron Simpeg</a> -->
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
<?= $this->endSection(); ?>