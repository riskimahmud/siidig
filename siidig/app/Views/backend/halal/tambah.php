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
                <?= form_open("fas-halal/tambah", ["class" => "form form-horizontal", "autocomplete" => "off"]); ?>
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama_perusahaan">Nama Perusahaan</label>
                        <input type="text" name="nama_perusahaan" id="nama_perusahaan" class="form-control <?= ($validation->hasError('nama_perusahaan')) ? 'is-invalid' : ''; ?>" value="<?= set_value('nama_perusahaan') ?>" placeholder="Nama Perusahaan" autofocus>
                        <div class="invalid-feedback"><?= $validation->getError('nama_perusahaan'); ?></div>
                    </div>
                    <div class="form-group">
                        <label for="nama_pemilik">Nama Pemilik</label>
                        <input type="text" name="nama_pemilik" id="nama_pemilik" class="form-control <?= ($validation->hasError('nama_pemilik')) ? 'is-invalid' : ''; ?>" value="<?= set_value('nama_pemilik') ?>" placeholder="Nama Pemilik">
                        <div class="invalid-feedback"><?= $validation->getError('nama_pemilik'); ?></div>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : '' ?>" name="alamat" id="alamat" value="<?= old('alamat'); ?>" placeholder="Alamat">
                        <div class="invalid-feedback"><?= $validation->getError('alamat') ?></div>
                    </div>
                    <div class="form-group">
                        <label for="nomor_sertifikat">Nomor Sertifikat</label>
                        <input type="text" class="form-control <?= ($validation->hasError('nomor_sertifikat')) ? 'is-invalid' : '' ?>" name="nomor_sertifikat" id="nomor_sertifikat" value="<?= old('nomor_sertifikat'); ?>" placeholder="Nomor Sertifikat">
                        <div class="invalid-feedback"><?= $validation->getError('nomor_sertifikat') ?></div>
                    </div>
                    <div class="form-group">
                        <label for="skala_usaha">Skala Usaha</label>
                        <input type="text" class="form-control <?= ($validation->hasError('skala_usaha')) ? 'is-invalid' : '' ?>" name="skala_usaha" id="skala_usaha" value="<?= old('skala_usaha'); ?>" placeholder="Skala Usaha">
                        <div class="invalid-feedback"><?= $validation->getError('skala_usaha') ?></div>
                    </div>
                    <div class="form-group">
                        <label for="tahun">Tahun</label>
                        <input type="text" class="form-control <?= ($validation->hasError('tahun')) ? 'is-invalid' : '' ?>" name="tahun" id="tahun" value="<?= old('tahun'); ?>" placeholder="Tahun">
                        <div class="invalid-feedback"><?= $validation->getError('tahun') ?></div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" name="submit" value="simpan" class="btn btn-primary"><i class="fa fa-save fa-fw"></i>Simpan</button>
                    <a href="/fas-halal" class="btn btn-default">Kembali</a>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>