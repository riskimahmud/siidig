<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="card shadow">
                <div class="card-header">
                    <h1 class="card-title"><?= $title; ?></h1>
                </div>
                <!-- form start -->
                <?= form_open($base . "/tambah", ["class" => "form form-horizontal", "autocomplete" => "off"]); ?>
                <?= form_hidden('kabkota_id', user("kabkota_id")); ?>
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama_kelkec">Nama Kelurahan / Kecamatan</label>
                        <input type="text" name="nama_kelkec" id="nama_kelkec" class="form-control <?= ($validation->hasError('nama_kelkec')) ? 'is-invalid' : ''; ?>" value="<?= set_value('nama_kelkec') ?>" placeholder="Nama Kelurahan / Kecamatan" autofocus>
                        <div class="invalid-feedback"><?= $validation->getError('nama_kelkec'); ?></div>
                    </div>
                    <div class="form-group">
                        <label for="parent">Parent (Kecamatan)</label>
                        <select name="parent" id="parent" class="form-control <?= ($validation->hasError('parent')) ? 'is-invalid' : ''; ?>" placeholder="Pilih Kabupaten/Kota">
                            <option value="">Pilih</option>
                            <?php
                            foreach ($parent as $par) :
                            ?>
                                <option value="<?= $par['nama_kelkec']; ?>" <?= set_select('parent', $par['nama_kelkec']); ?>><?= $par['nama_kelkec']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback"><?= $validation->getError('parent'); ?></div>
                        <div class="form-check">
                            <input type="checkbox" value="1" name="tanpa_parent" class="form-check-input" id="exampleCheck1" <?= set_checkbox('tanpa_parent', 1, old('tanpa_parent') ? true : false); ?>>
                            <label class="form-check-label" for="exampleCheck1">Tanpa Parent</label>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" name="submit" value="simpan" class="btn btn-primary"><i class="fa fa-save fa-fw"></i>Simpan</button>
                    <a href="<?= base_url($base); ?>" class="btn btn-default">Kembali</a>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
    // $(document).ready(function() {
    //     bsCustomFileInput.init();
    // });

    $("#togglePassword").click(function() {
        $(this).find(".fas").toggleClass("fa-eye fa-eye-slash");
        showPassword();
    });

    function showPassword() {
        const x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }

    const unor = $("#unorid").val();
    if (unor !== "") {
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
    }

    $("#unorid").on("change", function() {
        const unor = $(this).val();
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
</script>
<?= $this->endSection(); ?>