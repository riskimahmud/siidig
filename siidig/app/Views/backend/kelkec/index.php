<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title"><?= $title ?></h1>

                    <div class="card-tools">
                        <a href="<?= base_url($base . "/tambah"); ?>" class="btn btn-primary btn-sm"> <i class="fas fa-plus-circle fa-fw"></i> Tambah Data</a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                    <table class="table table-hover text-nowrap" id="dataTable">
                        <thead>
                            <tr>
                                <th width="10">No</th>
                                <th>Nama Kelurahan / Kecamatan</th>
                                <th>Parent</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($data as $d) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $d['nama_kelkec']; ?></td>
                                    <td>
                                        <?= $d['parent']; ?>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-xs">
                                            <a title="Ubah" class="btn btn-default btn-xs
                                        " href="<?= base_url($base . "/ubah/" . $d['id']); ?>"><i class="fas fa-edit fa-sm text-info"></i></a>
                                            <a title="Hapus" class="delete btn btn-default btn-xs
                                        " href="<?= base_url($base . "/hapus/" . $d['id']); ?>"><i class="fas fa-trash-alt fa-sm text-danger"></i></a>
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
<?= $this->section('script'); ?>
<script>
    $('.reset').on('click', function(e) {
        e.preventDefault();
        const link = $(this).attr("href");
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Password akan diubah menjadi 12345678",
            icon: 'warning',
            showCancelButton: true,
            //   confirmButtonColor: '#fff',
            //   cancelButtonColor: '#d33',
            confirmButtonText: 'Ya. Reset Password!',
            confirmButtonClass: 'btn btn-primary',
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