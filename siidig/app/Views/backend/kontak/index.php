<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
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
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Telp</th>
                                <th>Tgl Kirim</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($data as $d) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $d->nama; ?></td>
                                    <td><?= $d->email; ?></td>
                                    <td><?= $d->telp; ?></td>
                                    <td><?= tgl_indonesia_full($d->created_at); ?></td>
                                    <td>
                                        <a href="javascript:void(0)" class="btn btn-primary btn-xs detailPesan" data-id="<?= $d->id ?>">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <?php if ($d->status == "0") : ?>
                                            <span class="text-danger ml-2 text-sm" id="<?= $d->id; ?>">Baru!</span>
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

<div class="modal fade" id="modal-default" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Pesan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    $(".table-hover").on("click", ".detailPesan", function(e) {
        $(".modal-body").html('');
        const id = $(this).data("id");
        $("#" + id).fadeOut(500);
        // alert(id);
        console.log(id);
        $.ajax({
            url: url + '/get-kontak/' + id,
            type: "GET",
            dataType: "JSON",
            success: function(response) {
                console.log(response);
                if (response.status === true) {
                    let content = `
                        <div class="d-flex flex-column flex-md-row p-2 justify-content-between border-bottom">
                            <span>Nama</span>
                            <strong>${response.data.nama}</strong>
                        </div>
                        <div class="d-flex flex-column flex-md-row p-2 justify-content-between border-bottom">
                            <span>Email</span>
                            <strong>${response.data.email}</strong>
                        </div>
                        <div class="d-flex flex-column flex-md-row p-2 justify-content-between border-bottom">
                            <span>Telp</span>
                            <strong>${response.data.telp}</strong>
                        </div>
                        <div class="p-2 text-justify">
                            ${response.data.pesan}
                        </div>
                    `;
                    $(".modal-body").html(content);
                } else {
                    $(".modal-body").html(`<div class="alert alert-danger">Pesan tidak ditemukan</div>`);
                }
                $("#modal-default").modal('toggle');
            }
        })
    })
</script>
<?= $this->endSection() ?>