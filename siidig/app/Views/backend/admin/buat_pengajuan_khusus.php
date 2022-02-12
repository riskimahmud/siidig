<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <?= form_open("", ["class" => "form form-horizontal", "autocomplete" => "off", "enctype" => "multipart/form-data"]); ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><i class="far fa-user fa-fw"></i> Data Pegawai</h5>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="unker">SKPD Asal</label>
                        <select name="unker" id="unker" class="form-control select2 <?= ($validation->hasError('unker')) ? 'is-invalid' : ''; ?>" data-placeholder="- Pilih SKPD Asal -" required="required">
                            <option value=""></option>
                            <?php foreach ($skpd_asal as $skp) : ?>
                                <option value="<?= $skp->unorid; ?>"><?= $skp->unorname; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback"><?= $validation->getError('unker'); ?></div>
                    </div>
                    <!-- <?php if (count($unor) > 1) : ?>
                        <div class="form-group">
                            <label for="unker">Unit Kerja</label>
                            <select name="unker" id="unker" class="form-control select2 <?= ($validation->hasError('unker')) ? 'is-invalid' : ''; ?>" data-placeholder="- Pilih Unit Kerja -" required="required">
                                <option value=""></option>
                                <option value="<?= user("unorid"); ?>" selected><?= getFieldSimpeg("unor", "unorname", ["unorid" => user("unorid")]); ?></option>
                                <?php foreach ($unor as $un) : ?>
                                    <option value="<?= $un->unorid; ?>" <?= set_select('unor', $un->unorid, ($un->unorid == user("unorid")) ? TRUE : FALSE); ?>><?= $un->unorname; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"><?= $validation->getError('unker'); ?></div>
                        </div>
                    <?php else : ?>
                        <input type="hidden" name="unker" value="<?= user("unorid"); ?>">
                    <?php endif; ?> -->
                    <div class="form-group" id="formUnor">
                        <label for="unor">Unit Organisasi</label>
                        <select name="unor" id="unor" class="form-control select2 <?= ($validation->hasError('unor')) ? 'is-invalid' : ''; ?>" data-placeholder="- Pilih Unit Organisasi -">
                            <option value=""></option>
                            <?php foreach ($unit_organisasi as $unor) : ?>
                                <option value="<?= $unor->nama; ?>"><?= $unor->nama; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <!-- <input type="text" name="unor" id="unor" class="form-control  <?= ($validation->hasError('unor')) ? 'is-invalid' : ''; ?>" value="<?= set_value('unor', ''); ?>" required="required"> -->
                        <div class="invalid-feedback"><?= $validation->getError('unor'); ?></div>
                    </div>
                    <div class="form-group">
                        <label for="pegawai">Pegawai</label>
                        <select name="pegawai" id="pegawai" class="form-control select2 <?= ($validation->hasError('pegawai')) ? 'is-invalid' : ''; ?>" data-placeholder="- Pilih Pegawai -" required="required">
                            <option value=""></option>
                            <?php foreach ($pegawai as $peg) : if ($peg->eselon != "99") continue; ?>
                                <option value="<?= $peg->newsid; ?>"><?= $peg->nip2 . " - " . $peg->nama; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback"><?= $validation->getError('pegawai'); ?></div>
                    </div>
                    <div class="form-group">
                        <label for="berkas">Surat Pengantar</label>
                        <input type="file" class="form-control" name="syarat[]" id="berkas" required="required">
                        <div class="invalid-feedback"><?= $validation->getError('syarat[]'); ?></div>
                        <span class="text-muted">File PDF, Maksimal 1mb</span>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><i class="far fa-user-tag fa-fw"></i> Data Jabatan Baru</h5>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="jenis">Jenis Jabatan</label>
                        <select name="jenis" id="jenis" class="form-control <?= ($validation->hasError('jenis')) ? 'is-invalid' : ''; ?>" required="required">
                            <option value="">- Pilih Jenis Jabatan -</option>
                            <option value="Administrasi">Administrasi</option>
                            <option value="fungsional">Fungsional</option>
                        </select>
                        <div class="invalid-feedback"><?= $validation->getError('jenis'); ?></div>
                    </div>
                    <div class="form-group">
                        <label for="skpd">SKPD Tujuan</label>
                        <select name="skpd" id="skpd" class="form-control select2 <?= ($validation->hasError('skpd')) ? 'is-invalid' : ''; ?>" data-placeholder="- Pilih SKPD -" required="required">
                            <option value=""></option>
                            <?php foreach ($skpd as $skp) : ?>
                                <option value="<?= $skp->unorid; ?>"><?= $skp->unorname; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback"><?= $validation->getError('skpd'); ?></div>
                    </div>
                    <div class="form-group" id="jabatanBox">
                        <label for="jabatan">Jabatan Kosong</label>
                        <select name="jabatan" id="jabatan" class="form-control select2 <?= ($validation->hasError('jabatan')) ? 'is-invalid' : ''; ?>" data-placeholder="- Pilih Jabatan -" required="required">
                            <option value=""></option>
                        </select>
                        <div class="invalid-feedback"><?= $validation->getError('jabatan'); ?></div>
                    </div>
                </div>
            </div>
            <div class="form-group mt-4">
                <button name="submit" value="simpan" type="submit" class="btn btn-primary"><i class="fas fa-save fa-fw"></i> Simpan</button>
                <a href="<?= base_url("spt"); ?>" class="btn btn-default ml-2">Kembali</a>
            </div>
        </div>
    </div>
    <?= form_close(); ?>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
    $("select#unker").on("change", function() {
        const unor = $(this).val();
        $("#pegawai").empty().trigger('change');
        let data = $.ajax({
            type: 'POST',
            url: url + '/ajax/cari-pegawai',
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
        }).responseJSON;

        var newOption = new Option("", "", false, false);
        $('#pegawai').append(newOption).trigger('change');
        data.data.forEach(e => {
            var newOption = new Option(e.nip2 + ' | ' + e.gelardpn + e.nama + e.gelarblk, e.newsid, false, false);
            $('#pegawai').append(newOption).trigger('change');
        });
    });

    $("#jenis").on("change", function() {
        $("#skpd").val('').trigger('change')
        $("#jabatan").empty().trigger('change')
    });

    $("#skpd").on("change", function() {
        const jenis = $("#jenis").val();
        const unor = $(this).val();
        $("#jabatan").empty().trigger('change')

        if (jenis === "") {
            Swal.fire({
                title: 'Error',
                text: "Pilih Jenis Jabatan Terlebih Dahulu",
                icon: 'error'
            });
            $(this).val("");
        } else {
            let data = $.ajax({
                type: 'POST',
                url: url + '/spt/cari-jabatan',
                async: false,
                dataType: 'json',
                data: {
                    unor: unor,
                    jenis: jenis
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

            console.log(data);

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