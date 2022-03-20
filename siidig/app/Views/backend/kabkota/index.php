<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><?= $title; ?></h3>

                    <!-- <div class="card-tools">
                        <a href="<?= base_url("/kabkota/tambah"); ?>" class="btn btn-primary btn-sm"> <i class="fas fa-plus-circle fa-fw"></i> Tambah Data</a>
                    </div> -->
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                    <table class="table table-hover text-nowrap" id="dataTable">
                        <thead>
                            <tr>
                                <th width="10">No</th>
                                <th>Nama Kabupaten/Kota</th>
                                <!-- <th>Aksi</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($data as $d) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td>
                                        <?= $d['nama_kabkota']; ?>
                                    </td>
                                    <!-- <td>
                                        <div class="btn-group btn-group-sm">
                                            <a title="Ubah" class="btn btn-default
                                        " href="<?= base_url("kabkota/ubah/" . $d['id']); ?>"><i class="fas fa-edit fa-sm text-info"></i></a>
                                            <a title="Hapus" class="delete btn btn-default
                                        " href="<?= base_url("kabkota/hapus/" . $d['id']); ?>"><i class="fas fa-trash-alt fa-sm text-danger"></i></a>
                                        </div>
                                    </td> -->
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>
<?= $this->endSection(); ?>