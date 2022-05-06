<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body pt-2 pb-0">
                <?= form_open('', ['autocomplete' => 'off', 'method' => 'get']); ?>
                <div class="row">
                    <div class="col-sm-6 col-md-3 mb-0">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-left text-md-right">Kab / Kota</label>
                            <select name="kabkota" id="kabkota" class="form-control form-control-sm col-sm-8" required="required">
                                <option value="">Pilih</option>
                                <?php foreach ($kabkota as $kk) : ?>
                                    <option value="<?= $kk['id'] ?>" <?= (isset($filter['kabkota']) && ($kk['id'] == $filter['kabkota'])) ? 'selected' : ''; ?>>
                                        <?= $kk['nama_kabkota'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3 mb-0">
                        <div class="form-group row">
                            <label for="industri" class="col-sm-4 col-form-label text-left text-md-right">
                                Industri
                            </label>
                            <select name="industri" id="industri" class="form-control form-control-sm col-sm-8" required="required">
                                <option value="">Semua</option>
                                <?php foreach ($industri as $in) : ?>
                                    <option value="<?= $in['id'] ?>" <?= (isset($filter['industri']) && ($in['id'] == $filter['industri'])) ? 'selected' : ''; ?>>
                                        <?= $in['nama_industri'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3 mb-0">
                        <div class="form-group row">
                            <label for="tahun" class="col-sm-4 col-form-label text-left text-md-right">Tahun </label>
                            <select name="tahun" id="tahun" class="form-control form-control-sm col-sm-8" required="required">
                                <?php for ($i = date("Y"); $i >= 2016; $i--) : ?>
                                    <option value="<?= $i ?>" <?= ($i == $filter['tahun']) ? 'selected' : ''; ?>><?= $i ?></option>
                                <?php endfor ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 text-right">
                        <!-- <button type="submit" name="cari" value="cari" class="btn btn-info btn-sm"><i class="fas fa-search fa-fw fa-sm"></i> Cari</button> -->
                        <button type="submit" name="hapus" value="hapus" id="hapus" class="btn btn-danger btn-sm "><i class="fas fa-trash fa-fw fa-sm"></i> Hapus</button>
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <?= $pesan; ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<?= $this->endSection(); ?>