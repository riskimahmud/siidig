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
                <?= form_hidden('tahun', date("Y")); ?>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 order-1 order-md-0">
                            <?= form_open($base . "/import", ["class" => "form form-horizontal", "autocomplete" => "", "enctype" => "multipart/form-data"]); ?>
                            <div class="form-group">
                                <select name="tahun" id="tahun" class="form-control <?= ($validation->hasError('tahun')) ? 'is-invalid' : ''; ?>">
                                    <option value="">Pilih Tahun</option>
                                    <?php for ($i = date("Y"); $i >= 2016; $i--) : ?>
                                        <option value="<?= $i; ?>" <?= set_select('tahun', $i, ($i == old('tahun')) ? true : false); ?>><?= $i ?></option>
                                    <?php endfor; ?>
                                </select>
                                <div class="invalid-feedback"><?= $validation->getError('tahun'); ?></div>
                            </div>
                            <div class="form-group">
                                <select name="industri" id="industri" class="form-control <?= ($validation->hasError('industri')) ? 'is-invalid' : ''; ?>">
                                    <option value="">Pilih Industri</option>
                                    <?php foreach ($industri as $ind) : ?>
                                        <option value="<?= $ind['id']; ?>" <?= set_select('industri', $ind['id'], ($ind['id'] == old('industri')) ? true : false); ?>><?= $ind['nama_industri']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback"><?= $validation->getError('industri'); ?></div>
                            </div>
                            <div class="form-group">
                                <label for="excel">Pilih File</label>
                                <input type="file" class="form-control <?= ($validation->hasError('excel')) ? 'is-invalid' : ''; ?>" id="excel" name="excel">
                                <div class="invalid-feedback"><?= $validation->getError('excel'); ?></div>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="submit" value="simpan" class="btn btn-primary"><i class="fa fa-save fa-fw"></i>Simpan</button>
                                <a href="<?= base_url($base); ?>" class="btn btn-default">Kembali</a>
                            </div>
                            <?= form_close(); ?>
                        </div>
                        <div class="col-md-8 p-2 order-0 order-md-1 mb-2">
                            <div class="border border-warning p-2 rounded shadow">
                                <strong class="d-block">Catatan:</strong>
                                <ul>
                                    <li>Pilih tahun untuk menentukan data yang di inputkan</li>
                                    <li>Pilih industri untuk menentukan data yang di inputkan</li>
                                    <li>File excel berformat <span class="font-weight-bold">Xlsx</span> dengan kapasitas max 1mb</li>
                                    <li>Format file excel harus sesuai.
                                        <?= form_open('/download-template-investasi', ['autocomplete' => 'off', 'target' => '_blank']); ?>
                                        <button type="submit" class="badge badge-primary d-block p-1 border-0">Download Format</button>
                                        <!-- <a href="#" class="badge badge-primary d-block p-1">Download format</a> -->
                                        <?= form_close(); ?>
                                    </li>
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
            <!-- <div class="card-footer">
                
            </div> -->
            <!-- <?= form_close(); ?> -->
        </div>
    </div>
</div>
</div>
<?= $this->endSection() ?>