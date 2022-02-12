<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <?= form_open("", ["class" => "form form-horizontal", "autocomplete" => "off", "enctype" => "multipart/form-data"]); ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><i class="far fa-user fa-fw"></i> Pilih Pegawai</h5>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="skpd_asal">SKPD Asal</label>
                        <input type="text" value="<?= $detail->unorname_lama; ?>" class="form-control" disabled="disabled">
                    </div>
                    <div class="form-group" id="jabatanBox">
                        <label for="pegawai">Pegawai</label>
                        <input type="text" value="<?= $detail->nip . " | " . $detail->nama; ?>" class="form-control" disabled="disabled">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><i class="far fa-user-tie fa-fw"></i> Pilih Jabatan Baru</h5>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="eselon">Eselon</label>
                        <select name="eselon" id="eselon" class="form-control <?= ($validation->hasError('eselon')) ? 'is-invalid' : ''; ?>" required="required">
                            <option value="">- Pilih Eselon -</option>
                            <?php foreach ($eselon as $es) : ?>
                                <option value="<?= $es->nmeselon; ?>" <?= set_select('eselon', $es->nmeselon, ($es->nmeselon == $detail->eselon_baru) ? TRUE : FALSE); ?>><?= $es->nmeselon; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback"><?= $validation->getError('jenis'); ?></div>
                    </div>
                    <div class="form-group">
                        <label for="skpd">SKPD Tujuan</label>
                        <select name="skpd" id="skpd" class="form-control select2 <?= ($validation->hasError('skpd')) ? 'is-invalid' : ''; ?>" data-placeholder="- Pilih SKPD -" required="required">
                            <option value=""></option>
                            <?php foreach ($skpd as $skp) : ?>
                                <option value="<?= $skp->unorid; ?>" <?= set_select('skpd', $skp->unorid, ($skp->unorid == $detail->unorid_baru) ? TRUE : FALSE); ?>><?= $skp->unorname; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback"><?= $validation->getError('skpd'); ?></div>
                    </div>
                    <div class="form-group" id="jabatanBox">
                        <label for="jabatan">Jabatan</label>
                        <select name="jabatan" id="jabatan" class="form-control select2 <?= ($validation->hasError('jabatan')) ? 'is-invalid' : ''; ?>" data-placeholder="- Pilih Jabatan -" required="required">
                            <option value="<?= $detail->id_jabatan_baru; ?>"><?= $detail->nama_jabatan_baru; ?></option>
                        </select>
                        <div class="invalid-feedback"><?= $validation->getError('jabatan'); ?></div>
                    </div>
                    <div class="form-group">
                        <label for="jenis_jabatan_baru">Jenis Jabatan Baru</label>
                        <select name="jenis_jabatan_baru" id="jenis_jabatan_baru" class="form-control <?= ($validation->hasError('jenis_jabatan_baru')) ? 'is-invalid' : ''; ?>" required="required">
                            <option value="">- Pilih Jenis Jabatan -</option>
                            <?php foreach ($jenis_jabatan as $jj) : ?>
                                <option value="<?= $jj->idjabatan; ?>" <?= set_select('jenis_jabatan_baru', $jj->idjabatan, ($jj->idjabatan == $detail->jenis_jabatan_baru) ? TRUE : FALSE); ?>>
                                    <?= $jj->jabatanjns . " - " . $jj->nmjabatan; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback"><?= $validation->getError('jenis'); ?></div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="no_surat_mutasi">No. Surat Mutasi</label>
                            <input type="text" name="no_surat_mutasi" id="no_surat_mutasi" class="form-control <?= ($validation->hasError('no_surat_mutasi')) ? 'is-invalid' : ''; ?>" value="<?= $detail->no_surat_mutasi; ?>" required="required">
                            <div class="invalid-feedback"><?= $validation->getError('no_surat_mutasi'); ?></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="tgl_surat_mutasi">Tgl Surat Mutasi</label>
                            <input type="text" name="tgl_surat_mutasi" id="tgl_surat_mutasi" class="form-control <?= ($validation->hasError('tgl_surat_mutasi')) ? 'is-invalid' : ''; ?> datepicker" data-toggle="datetimepicker" data-target="#tgl_surat_mutasi" value="<?= $detail->tgl_surat_mutasi; ?>" required="required">
                            <div class="invalid-feedback"><?= $validation->getError('tgl_surat_mutasi'); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="form-group">
                <button name="submit" value="simpan" type="submit" class="btn btn-primary"><i class="fas fa-user-edit fa-fw"></i> Ubah Pegawai</button>
                <a href="<?= base_url("spt-pelantikan/$pelantikan->pelantikan_id"); ?>" class="btn btn-default ml-2">Kembali</a>
            </div>
        </div>
    </div>
    <?= form_close(); ?>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
    $("#skpd_asal").on("change", function() {
        let unor = $(this).val();
        $("#pegawai").empty().trigger('change')

        let data = $.ajax({
            type: 'POST',
            url: url + '/ajax/cari-pegawai-by-skpd',
            async: false,
            dataType: 'json',
            data: {
                unor: unor,
            },
            done: function(results) {
                // Uhm, maybe I don't even need this?
                JSON.parse(results);
                return results;
            },
            fail: function(jqXHR, textStatus, errorThrown) {
                console.log('Could not get posts, server response: ' + textStatus + ': ' + errorThrown);
            }
        }).responseJSON; // <-- this instead of .responseText

        // console.log(data);

        var newOption = new Option("", "", false, false);
        $('#pegawai').append(newOption).trigger('change');
        data.data.forEach(e => {
            var newOption = new Option(e.nip2 + ' | ' + e.nama, e.newsid, false, false);
            $('#pegawai').append(newOption).trigger('change');
        });
    })

    $("#eselon").on("change", function() {
        $("#skpd").val('').trigger('change')
        $("#jabatan").empty().trigger('change')
    });

    $("#skpd").on("change", function() {
        const eselon = $("#eselon").val();
        const unor = $(this).val();
        $("#jabatan").empty().trigger('change')

        if (eselon === "") {
            Swal.fire({
                title: 'Error',
                text: "Pilih Eselon Terlebih Dahulu",
                icon: 'error'
            });
            $(this).val("");
        } else {
            let data = $.ajax({
                type: 'POST',
                url: url + '/ajax/cari-jabatan-by-skpd',
                async: false,
                dataType: 'json',
                data: {
                    unor: unor,
                    eselon: eselon
                },
                done: function(results) {
                    // Uhm, maybe I don't even need this?
                    JSON.parse(results);
                    return results;
                },
                fail: function(jqXHR, textStatus, errorThrown) {
                    console.log('Could not get posts, server response: ' + textStatus + ': ' + errorThrown);
                }
            }).responseJSON; // <-- this instead of .responseText

            // console.log(data);

            var newOption = new Option("", "", false, false);
            $('#jabatan').append(newOption).trigger('change');
            data.data.forEach(e => {
                var newOption = new Option(e.text, e.id, false, false);
                $('#jabatan').append(newOption).trigger('change');
            });
        }
    })
</script>
<?= $this->endSection(); ?>