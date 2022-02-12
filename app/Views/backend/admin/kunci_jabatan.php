<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <a href="<?= base_url("tambah-kunci-jabatan"); ?>" class="btn btn-primary mb-3"><i class="fas fa-plus-circle fa-fw"></i> Tambah Data</a>

            <div class="card">
                <div class="card-body table-responsive">
                    <table class="table table-hover table-striped text-nowrap" id="dataTable">
                        <thead>
                            <tr>
                                <th width="10">No</th>
                                <th>OPD</th>
                                <th>Jabatan</th>
                                <th>Tgl Kunci</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($data as $d) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $d->unorname; ?></td>
                                    <td><?= $d->nama_jabatan . " - " . $d->jabatan_parent; ?></td>
                                    <td><?= tgl_indonesia($d->create_at); ?></td>
                                    <td>
                                        <a href="<?= base_url("hapus-kunci/" . $d->kunci_jabatan_id); ?>" class="btn btn-info badge delete" title="Hapus Kunci"><i class="fas fa-unlock fa-fw"></i></a>
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