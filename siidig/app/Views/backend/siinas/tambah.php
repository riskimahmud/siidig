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
                <?= form_open("siinas/tambah", ["class" => "form form-horizontal", "autocomplete" => "off"]); ?>
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama_perusahaan">Nama Perusahaan</label>
                        <input type="text" name="nama_perusahaan" id="nama_perusahaan" class="form-control <?= ($validation->hasError('nama_perusahaan')) ? 'is-invalid' : ''; ?>" value="<?= set_value('nama_perusahaan') ?>" placeholder="Nama Perusahaan" autofocus>
                        <div class="invalid-feedback"><?= $validation->getError('nama_perusahaan'); ?></div>
                    </div>
                    <div class="form-group">
                        <label for="alamat_kantor">Alamat Kantor</label>
                        <input type="text" class="form-control <?= ($validation->hasError('alamat_kantor')) ? 'is-invalid' : '' ?>" name="alamat_kantor" id="alamat_kantor" value="<?= old('alamat_kantor'); ?>" placeholder="Alamat Kantor">
                        <div class="invalid-feedback"><?= $validation->getError('alamat_kantor') ?></div>
                    </div>
                    <div class="form-group">
                        <label for="alamat_pabrik">Alamat Pabrik</label>
                        <input type="text" class="form-control <?= ($validation->hasError('alamat_pabrik')) ? 'is-invalid' : '' ?>" name="alamat_pabrik" id="alamat_pabrik" value="<?= old('alamat_pabrik'); ?>" placeholder="Alamat Pabrik">
                        <div class="invalid-feedback"><?= $validation->getError('alamat_pabrik') ?></div>
                    </div>
                    <div class="form-group">
                        <label for="kode_kbli">Kode KBLI</label>
                        <input type="text" class="form-control <?= ($validation->hasError('kode_kbli')) ? 'is-invalid' : '' ?>" data-role="tagsinput" name="kode_kbli" id="kode_kbli" value="<?= old('kode_kbli'); ?>" placeholder="Kode KBLI">
                        <span class="text-muted text-xs">Tekan <code>,</code> untuk beberapa Kode KBLI</span>
                        <div class="invalid-feedback"><?= $validation->getError('kode_kbli') ?></div>
                    </div>
                    <div class="form-group">
                        <label for="bidang_usaha">Bidang Usaha</label>
                        <input type="text" class="form-control <?= ($validation->hasError('bidang_usaha')) ? 'is-invalid' : '' ?>" name="bidang_usaha" id="bidang_usaha" value="<?= old('bidang_usaha'); ?>" placeholder="Bidang Usaha">
                        <span class="text-muted text-xs">Tekan <code>,</code> untuk beberapa Bidang Usaha</span>
                        <div class="invalid-feedback"><?= $validation->getError('bidang_usaha') ?></div>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_registrasi">Tanggal Registrasi</label>
                        <input type="datetime-local" class="form-control <?= ($validation->hasError('tanggal_registrasi')) ? 'is-invalid' : '' ?>" name="tanggal_registrasi" id="tanggal_registrasi" value="<?= old('tanggal_registrasi'); ?>" placeholder="Tanggal Registrasi">
                        <div class="invalid-feedback"><?= $validation->getError('tanggal_registrasi') ?></div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" name="submit" value="simpan" class="btn btn-primary"><i class="fa fa-save fa-fw"></i>Simpan</button>
                    <a href="/siinas" class="btn btn-default">Kembali</a>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('css') ?>
<link rel="stylesheet" href="/plugins/bootstrap-tags-input/tagsinput.css">
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="/plugins/bootstrap-tags-input/tagsinput.js"></script>
<script>
    $('#kode_kbli').tagsinput({
        maxChars: 5
    });
    $('#bidang_usaha').tagsinput();
</script>
<?= $this->endSection() ?>