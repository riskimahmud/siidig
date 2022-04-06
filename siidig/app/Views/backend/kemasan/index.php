<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><?= $title; ?></h3>

                    <div class="card-tools">
                        <a href="<?= base_url("/fas-kemasan/tambah"); ?>" class="btn btn-primary btn-sm"> <i class="fas fa-plus-circle fa-fw"></i> Tambah Data</a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                    <table class="table table-hover text-nowrap" id="dataTable">
                        <thead>
                            <tr>
                                <th width="10">No</th>
                                <th>Nama Perusahaan</th>
                                <th>Pemilik</th>
                                <th>Produk</th>
                                <th>Ukuran/ <br> Jenis Kemasan</th>
                                <th>Tahun</th>
                                <th>Kab/Kota</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($data as $d) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $d['nama_perusahaan']; ?><br><span class="badge badge-info"><?= $d['alamat'] ?></span></td>
                                    <td><?= $d['nama_pemilik']; ?> <br> <small class="text-muted"><?= $d['no_telp'] ?></small> </td>
                                    <td><?= $d['produk'] ?></td>
                                    <td><?= $d['ukuran'] ?> <br> <?= $d['jenis_kemasan'] ?></td>
                                    <td><?= $d['tahun'] ?></td>
                                    <td><?= $d['kabkota'] ?></td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a title="Ubah" class="btn btn-default" href="<?= base_url("fas-kemasan/ubah/" . $d['id']); ?>">
                                                <i class="fas fa-edit fa-sm text-info"></i>
                                            </a>
                                            <?= form_open('/fas-kemasan/' . $d['id'], ['class' => '']); ?>
                                            <?= form_hidden('_method', 'DELETE'); ?>
                                            <button class="btn btn-default btn-sm delete" type="submit">
                                                <i class="fas fa-trash-alt fa-sm text-danger"></i>
                                            </button>
                                            <?= form_close(); ?>
                                        </div>
                                    </td>
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