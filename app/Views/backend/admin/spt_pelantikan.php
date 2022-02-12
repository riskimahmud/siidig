<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <a href="<?= base_url("spt-pelantikan/buat"); ?>" class="btn btn-primary mb-3"><i class="fas fa-plus-circle fa-fw"></i> Buat SPT</a>

            <div class="card">
                <div class="card-body table-responsive">
                    <table class="table table-hover table-striped text-nowrap" id="dataTable">
                        <thead>
                            <tr>
                                <th width="10">No</th>
                                <th>No. Surat</th>
                                <th>Tgl Surat</th>
                                <th>Tgl Pelantikan</th>
                                <th>Tgl Berlaku</th>
                                <th>Status</th>
                                <th>Sinkron<br>SimPeg</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($data as $d) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $d->no_surat; ?></td>
                                    <td><?= tgl_indonesia($d->tgl_surat); ?></td>
                                    <td><?= tgl_indonesia($d->tgl_pelantikan); ?></td>
                                    <td><?= tgl_indonesia($d->tgl_berlaku); ?></td>
                                    <td>
                                        <?= ($d->selesai == "1") ? generateBadge("success", "Selesai") : generateBadge("warning", "Proses"); ?>
                                    </td>
                                    <td>
                                        <?= ($d->sinkron_simpeg == "1") ? generateBadge("success", "Sudah") : generateBadge("danger", "Belum"); ?>
                                    </td>
                                    <td>
                                        <a href="<?= base_url("spt-pelantikan/" . $d->pelantikan_id); ?>" class="btn btn-info badge" title="Detail"><i class="fas fa-list fa-fw"></i></a>
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