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