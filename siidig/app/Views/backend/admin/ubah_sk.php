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
                                    <li class="list-group-item">
                                        <b>Unit Organisasi</b> <span class="float-right"><?= $data->unit_organisasi_baru; ?></span>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-12">
                                <div class="form-group mb-3" id="formDasar">
                                    <label for="dasar">Dasar Keputusan</label>
                                    <?php if ($data->dasar == "") { ?>
                                        <div class="input-group mb-1" id="formDasar1">
                                            <input type="text" class="form-control" name="dasar[]" id="dasar1" value="" required="required">
                                            <span class="input-group-append">
                                                <button type="button" id="addDasar" class="btn btn-primary btn-flat" data-nomor="1" data-inputdasar="#formDasar1"><i class="fas fa-plus"></i></button>
                                            </span>
                                        </div>
                                        <?php
                                    } else {
                                        $dasar = json_decode($data->dasar);
                                        echo "<input type='hidden' id='jumDasar' value='" . (count($dasar) + 1) . "'>";
                                        $noDasar = 1;
                                        foreach ($dasar as $d) :
                                        ?>
                                            <div class="input-group mb-1" id="formDasar<?= $noDasar; ?>">
                                                <input type="text" class="form-control" name="dasar[]" id="dasar<?= $noDasar; ?>" value="<?= $d; ?>" required="required">
                                                <span class="input-group-append">
                                                    <button type="button" id="<?= ($noDasar == "1") ? 'addDasar' : '' ?>" class="btn <?= ($noDasar == "1") ? 'btn-primary' : 'btn-danger'; ?> btn-flat <?= ($noDasar > "1") ? 'hapusDasar' : '' ?>" data-nomor="<?= $noDasar; ?>" data-inputdasar="#formDasar<?= $noDasar; ?>"><i class="<?= ($noDasar == "1") ? 'fas fa-plus' : 'far fa-trash-alt'; ?>"></i></button>
                                                </span>
                                            </div>
                                    <?php $noDasar++;
                                        endforeach;
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="tmt">TMT</label>
                                    <input name="tmt" type="text" class="form-control datetimepicker-input" id="tmt" data-toggle="datetimepicker" data-target="#tmt" required="required" value="<?= $data->tmt; ?>" />
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="jenis_jabatan_baru">Jenis Jabatan Baru</label>
                                    <select name="jenis_jabatan_baru" id="jenis_jabatan_baru" class="form-control" required="required">
                                        <option value="">- Pilih -</option>
                                        <?php foreach ($jenis_jabatan as $jj) : ?>
                                            <option value="<?= $jj->idjabatan; ?>" <?= set_select('jenis_jabatan_baru', $jj->idjabatan, ($jj->idjabatan == $data->jenis_jabatan_baru) ? TRUE : FALSE); ?>>
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
                                            <option value="<?= $t->nama; ?>" <?= set_select('tugas_sebagai', $t->nama, ($t->nama == $data->tugas_sebagai) ? TRUE : FALSE) ?>><?= $t->nama; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <?php
                                $cek_unor   =   [];
                                foreach ($unor as $u) {
                                    $cek_unor[] =   $u->nama;
                                }
                                ?>
                                <div class="form-group">
                                    <label for="unor_baru">Unit Organisasi Baru</label>
                                    <select name="unor_baru" id="unor_baru" class="form-control select2" data-placeholder="Pilih Unit Organisasi Baru" required="required">
                                        <option value=""></option>
                                        <?php if (in_array_r($data->unit_organisasi_baru, $cek_unor)) : ?>
                                        <?php else : ?>
                                            <option value="<?= $data->unit_organisasi_baru; ?>" selected><?= $data->unit_organisasi_baru; ?></option>
                                        <?php endif; ?>
                                        <?php foreach ($unor as $t) : ?>
                                            <option value="<?= $t->nama; ?>" <?= set_select('unor_baru', $t->nama, ($t->nama == $data->unit_organisasi_baru) ? TRUE : FALSE); ?>><?= $t->nama; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="sk_nomor">Nomor Surat</label>
                                    <input type="text" class="form-control" name="sk_nomor" id="sk_nomor" value="<?= set_value('sk_nomor', $data->sk_nomor); ?>" required="required">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="sk_tgl">Tgl Surat</label>
                                    <input type="text" class="form-control" name="sk_tgl" id="sk_tgl" data-toggle="datetimepicker" data-target="#sk_tgl" value="<?= set_value('sk_tgl', $data->sk_tgl); ?>" required="required">
                                </div>
                            </div>
                            <!-- <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="sk_jabatan_ttd">Jabatan Penandatangan Surat</label>
                                    <input type="text" class="form-control" name="sk_jabatan_ttd" id="sk_jabatan_ttd" value="<?= set_value('sk_jabatan_ttd', $data->sk_jabatan_ttd); ?>" required="required" placeholder="Contoh: an. Walikota Gorontalo \n Nama Jabatan">
                                    <span class="text-muted">Gunakan <code>\n</code> Untuk Baris Baru</span>
                                </div>
                            </div> -->

                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="sk_jabatan_ttd">Pejabat Yang Bertanda Tangan</label>
                                    <select name="sk_jabatan_ttd" id="sk_jabatan_ttd" class="form-control select2" data-placeholder="Pilih Tugas " required="required">
                                        <option value=""></option>
                                        <?php foreach ($pejabat as $t) : ?>
                                            <option value="<?= $t->pejabat_id; ?>" <?= set_select('sk_jabatan_ttd', $t->pejabat_id, ($data->pejabat_id == $t->pejabat_id) ? TRUE : FALSE) ?>><?= $t->nama . " (" . $t->jabatan . ")"; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 mt-1 border-top border-bottom py-2 d-flex">
                                <b class="h6 d-inline">Tembusan</b>
                                <a href="javascript:void(0)" class="ml-auto btn btn-default btn-sm p-1" id="addTembusan"><i class="fas fa-plus-circle fa-fw"></i> Tambah Tembusan</a>
                            </div>

                            <div class="container">
                                <div class="row" id="boxTembusan">
                                    <?php
                                    if ($data->sk_tembusan != "") :
                                        $tembusan = explode(";", $data->sk_tembusan);
                                        echo "<input type='hidden' value='" . (count($tembusan) + 1) . "' id='jumTembusan'>";
                                        $noTembusan = "1";
                                        foreach ($tembusan as $tem) :
                                    ?>
                                            <div class="col-4 my-1">
                                                <div class="input-group mb-1" id="formTembusan<?= $noTembusan; ?>">
                                                    <input type="text" class="form-control" name="tembusan[]" id="dasar<?= $noTembusan; ?>" value="<?= $tem; ?>" required="required">
                                                    <span class="input-group-append">
                                                        <button type="button" id="" class="btn btn-danger btn-flat hapusTembusan" data-inputtembusan="#formTembusan<?= $noTembusan; ?>"><i class="far fa-trash-alt"></i></button>
                                                    </span>
                                                </div>
                                            </div>
                                    <?php
                                            $noTembusan++;
                                        endforeach;
                                    else :
                                        echo "<input type='hidden' value='1' id='jumTembusan'>";
                                    endif;
                                    ?>
                                </div>
                            </div>

                            <div class="col-12 mt-4">
                                <button name="submit" value="setujui" type="submit" class="btn btn-success"><i class="fas fa-save fa-fw"></i> Simpan</button>
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
    let idDasar = $("#jumDasar").val();
    let idTembusan = $("#jumTembusan").val();

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

    $("#addTembusan").on("click", function() {
        let contentAdd = `
        <div class="col-4 my-1" id="formTembusan${idTembusan}">
            <div class="input-group mb-1">
                <input type="text" class="form-control" name="tembusan[]" id="tembusan${idTembusan}" required="required">
                <span class="input-group-append">
                    <button type="button" data-inputtembusan="#formTembusan${idTembusan}" class="btn btn-danger btn-flat hapusTembusan"><i class="far fa-trash-alt"></i></button>
                </span>
            </div>
        </div>
        `;
        $("#boxTembusan").append(contentAdd);
        idTembusan++;
    })

    $("#boxTembusan").on("click", ".hapusTembusan", function() {
        let content = $(this).data("inputtembusan");
        // alert(content);
        $(content).remove();
    })

    const tmt = moment($('#tmt').val(), 'YYYY-MM-DD').toDate();
    const skTgl = moment($('#sk_tgl').val(), 'YYYY-MM-DD').toDate();
    $('#tmt').datetimepicker({
        format: 'YYYY-MM-DD',
        date: tmt
    });
    $('#sk_tgl').datetimepicker({
        format: 'YYYY-MM-DD',
        date: skTgl
    });
</script>
<?= $this->endSection(); ?>