<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <?= form_open("", ["class" => "form form-horizontal", "autocomplete" => "off"]); ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><i class="far fa-user fa-fw"></i> Data Pegawai</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="nama">Nama Pegawai</label>
                            <input type="text" name="nama" id="nama" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" required="required">
                            <div class="invalid-feedback"><?= $validation->getError('nama'); ?></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="nip">NIP Pegawai</label>
                            <input type="text" name="nip" id="nip" class="form-control <?= ($validation->hasError('nip')) ? 'is-invalid' : ''; ?>" required="required">
                            <div class="invalid-feedback"><?= $validation->getError('nip'); ?></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="pangkat">Pangkat</label>
                            <select name="pangkat" id="pangkat" class="form-control <?= ($validation->hasError('pangkat')) ? 'is-invalid' : ''; ?>">
                                <option value="">- Pilih -</option>
                                <?php foreach ($pangkat as $pan) : ?>
                                    <option value="<?= $pan->idgolruang; ?>"><?= $pan->idgolruang . " - " . $pan->nmgolruang; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"><?= $validation->getError('pangkat'); ?></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="jabatan_lama">Jabatan Lama</label>
                            <input type="text" name="jabatan_lama" id="jabatan_lama" class="form-control <?= ($validation->hasError('jabatan_lama')) ? 'is-invalid' : ''; ?>" required="required">
                            <div class="invalid-feedback"><?= $validation->getError('jabatan_lama'); ?></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="unorname_lama">Unit Kerja Lama</label>
                            <input type="text" name="unorname_lama" id="unorname_lama" class="form-control <?= ($validation->hasError('unorname_lama')) ? 'is-invalid' : ''; ?>" required="required">
                            <div class="invalid-feedback"><?= $validation->getError('unorname_lama'); ?></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="unit_organisasi_lama">Unit Organisasi Lama</label>
                            <input type="text" name="unit_organisasi_lama" id="unit_organisasi_lama" class="form-control <?= ($validation->hasError('unit_organisasi_lama')) ? 'is-invalid' : ''; ?>" required="required">
                            <div class="invalid-feedback"><?= $validation->getError('unit_organisasi_lama'); ?></div>
                        </div>
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