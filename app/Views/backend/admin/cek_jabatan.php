<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-2">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <select name="unor" id="unor" class="form-control select2">
                                    <?php foreach ($unor as $un) : ?>
                                        <option value="<?= $un->unorid; ?>" <?= set_select('unor', $un->unorid, ($un->unorid == user("unorid")) ? TRUE : FALSE); ?>><?= $un->unorname; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <a href="javascript:void(0)" id="cariJabatan" class="btn btn-primary btn-sm"><i class="fas fa-search fa-fw"></i> Cari</a>
                            <a href="<?= base_url("cek-jabatan-opd"); ?>" id="reload" class="btn btn-default btn-sm"><i class="fas fa-history fa-fw"></i> Reload</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row" id="box">
        <div class="col-12">
            <div class="alert alert-info">
                <i class="fas fa-info-circle fa-fw"></i> <?= count($data); ?> Jabatan Kosong
            </div>
        </div>
        <div class="col-12">
            <div class="card" id="dataJabatanKosong">
                <div class="card-body table-responsive">
                    <table class="table table-hover table-striped text-nowrap" id="dataTable">
                        <thead>
                            <tr>
                                <th width="10">No</th>
                                <th>Jabatan</th>
                                <th>Jenis</th>
                                <th>Unit Kerja</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($data as $d) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td>
                                        <?php
                                        if ($d->pelaksana != "00.00.000") {
                                            echo $d->nmpelaksana;
                                        }

                                        if ($d->fungsional != "0") {
                                            echo $d->nmfungsional;
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($d->pelaksana != "00.00.000") {
                                            echo "Administrasi";
                                        }

                                        if ($d->fungsional != "0") {
                                            echo "Fungsional";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?= getFieldSimpeg("unor", "unorname", ["unorid" => $d->unor]); ?>
                                    </td>
                                    <td>
                                        <a target="_blank" href="<?= base_url("detail-jabatan/" . $d->id); ?>" class="btn btn-info badge" title="Detail">
                                            <i class="fas fa-list fa-fw"></i>
                                        </a>
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

<?= $this->section('script'); ?>
<script>
    $("#cariJabatan").on("click", function(e) {
        const unor = $("#unor").val();
        $.ajax({
            type: 'POST',
            url: url + '/cari-jabatan-opd',
            dataType: 'html',
            data: {
                unor: unor
            },
            beforeSend: function() {
                // setting a timeout
                $(".alert-info").html(`<i class="fas fa-spinner fa-spin fa-fw"></i> Mengambil Data`);
                $("#dataJabatanKosong").html("");
            },
            success: function(response) {
                $("#box").html(response);
                $("#dataTable").DataTable({
                    "responsive": true,
                    "autoWidth": false,
                });
                // console.log(response);

            }
        });
    })
</script>
<?= $this->endSection(); ?>