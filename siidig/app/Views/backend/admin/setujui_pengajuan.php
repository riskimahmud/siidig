<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <a href="<?= base_url("pengajuan/" . $data->pengajuan_id); ?>" class="btn btn-default mb-3"><i class="fas fa-arrow-left fa-fw"></i> Kembali</a>
        </div>

        <div class="col-12">
            <div id="accordion">
                <div class="card">
                    <div class="card-header d-flex">
                        <h5 class="card-title d-block w-75" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" style="cursor: pointer;">
                            <i class="fas fa-list fa-fw fa-sm"></i> Data Pengajuan
                        </h5>
                        <div class="ml-auto text-right w-25">
                            Status : <?= statusPengajuan($data->status, $data->tolak); ?>
                        </div>
                    </div>
                    <div class="panel-collapse collapse in" id="collapseOne">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b>NIP</b> <span class="float-right"><?= $data->nip; ?></span>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Nama</b> <span class="float-right"><?= $data->nama; ?></span>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Pangkat</b> <span class="float-right"><?= $data->pangkat; ?></span>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Jabatan Sekarang</b> <span class="float-right"><?= $data->nama_jabatan_lama; ?></span>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Unit Kerja Sekarang</b> <span class="float-right"><?= $data->unorname_lama; ?></span>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Unit Organisasi</b> <span class="float-right"><?= $data->unit_organisasi_lama; ?></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="container">
                        <?= form_open("", ["autocomplete" => "off"]); ?>
                        <?= form_hidden('pengajuan_id', $data->pengajuan_id); ?>
                        <div class="row">
                            <div class="col-12">
                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Jenis Pengajuan</b> <span class="float-right"><?= $data->jenis_pengajuan; ?></span>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Usulan Jabatan</b> <span class="float-right"><?= $data->nama_jabatan_baru; ?></span>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Unit Kerja</b> <span class="float-right"><?= $data->unorname_baru; ?></span>
                                    </li>
                                    <?php if ($data->unit_organisasi_baru != "") : ?>
                                        <li class="list-group-item">
                                            <b>Unit Organisasi</b> <span class="float-right"><?= $data->unit_organisasi_baru; ?></span>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                            <div class="col-12">
                                <div class="form-group mb-3" id="formDasar">
                                    <label for="dasar">Dasar Keputusan</label>
                                    <div class="input-group mb-1">
                                        <input type="text" class="form-control" name="dasar[]" id="dasar1" required="required">
                                        <span class="input-group-append">
                                            <button type="button" id="addDasar" class="btn btn-primary btn-flat"><i class="fas fa-plus"></i></button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="tmt">TMT</label>
                                    <input name="tmt" type="text" class="form-control datepicker datetimepicker-input" id="datetimepicker5" data-toggle="datetimepicker" data-target="#datetimepicker5" required="required" />
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="jenis_jabatan_baru">Jenis Jabatan Baru</label>
                                    <select name="jenis_jabatan_baru" id="jenis_jabatan_baru" class="form-control" required="required">
                                        <option value="">- Pilih -</option>
                                        <?php foreach ($jenis_jabatan as $jj) : ?>
                                            <option value="<?= $jj->idjabatan; ?>">
                                                <?= $jj->jabatanjns . " | " . $jj->nmjabatan; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="tugas_sebagai">Tugas Sebagai</label>
                                    <select name="tugas_sebagai" id="tugas_sebagai" class="form-control select2" data-placeholder="Pilih Tugas Baru" required="required">
                                        <option value=""></option>
                                        <?php foreach ($tugas as $t) : ?>
                                            <option value="<?= $t->nama; ?>"><?= $t->nama; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <?php if ($data->unit_organisasi_baru == "") : ?>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="unor_baru">Unit Organisasi Baru</label>
                                        <select name="unor_baru" id="unor_baru" class="form-control select2" data-placeholder="Pilih Unit Organisasi Baru" required="required">
                                            <option value=""></option>
                                            <?php foreach ($unor as $t) : ?>
                                                <option value="<?= $t->nama; ?>"><?= $t->nama; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            <?php else : ?>
                                <input type="hidden" name="unor_baru" value="<?= $data->unit_organisasi_baru; ?>">
                            <?php endif; ?>
                            <div class="col-12 mt-4">
                                <button name="submit" value="setujui" type="submit" class="btn btn-success btn-lg"><i class="far fa-check-circle fa-fw"></i> Setujui</button>
                            </div>
                        </div>
                        <?= form_close(); ?>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
    let idDasar = 2;
    $("#addDasar").on("click", function() {
        let contentAdd = `
        <div class="input-group mb-1" id="formDasar${idDasar}">
            <input type="text" class="form-control" name="dasar[]" id="dasar${idDasar}" required="required">
            <span class="input-group-append">
                <button type="button" data-nomor="${idDasar}" data-inputdasar="#formDasar${idDasar}" class="btn btn-danger btn-flat hapusDasar"><i class="far fa-trash-alt"></i></button>
            </span>
        </div>
        `;
        $("#formDasar").append(contentAdd);
        idDasar++;
    })

    $(".form-group").on("click", ".hapusDasar", function() {
        let nomor = $(this).data("nomor");
        let content = $(this).data("inputdasar");
        $(content).remove();
    })
</script>
<?= $this->endSection(); ?>