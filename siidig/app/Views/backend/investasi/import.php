<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="card shadow">
                <div class="card-header">
                    <h1 class="card-title"><?= $title; ?></h1>
                </div>
                <!-- form start -->
                <?= form_open($base . "/import", ["class" => "form form-horizontal", "autocomplete" => "", "enctype" => "multipart/form-data"]); ?>
                <?= form_hidden('tahun', date("Y")); ?>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 order-1 order-md-0">
                            <div class="form-group">
                                <select name="tahun" id="tahun" class="form-control">
                                    <option value="">Pilih Tahun</option>
                                    <?php for ($i = date("Y"); $i >= 2016; $i--) : ?>
                                        <option value="<?= $i; ?>"><?= $i ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="industri" id="industri" class="form-control">
                                    <option value="">Pilih Industri</option>
                                    <?php foreach ($industri as $ind) : ?>
                                        <option value="<?= $ind['id']; ?>"><?= $ind['nama_industri']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="excel">Pilih File</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input <?= ($validation->hasError('excel')) ? 'is-invalid' : ''; ?>" id="excel" name="excel">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                    <div class="invalid-feedback"><?= $validation->getError('excel'); ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 p-2 order-0 order-md-1 mb-2">
                            <div class="border border-warning p-2 rounded shadow">
                                <strong class="d-block">Catatan:</strong>
                                <ul>
                                    <li>Pilih tahun untuk menentukan data yang di inputkan</li>
                                    <li>Pilih industri untuk menentukan data yang di inputkan</li>
                                    <li>File excel berformat <span class="font-weight-bold">Xlsx</span> dengan kapasitas max 1mb</li>
                                    <li>Format file excel harus sesuai. <a href="#" class="badge badge-primary d-block p-1">Download format</a></li>
                                </ul>
                                <p>

                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="row">
                        <input type="file" name="excel" id="excel" class="form-control form-control-sm">
                    </div> -->
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
<?= $this->endSection() ?>