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
                <?= form_open("fas-kemasan/ubah", ["class" => "form form-horizontal", "autocomplete" => "off"]); ?>
                <input type="hidden" name="id" value="<?= $data['id']; ?>">
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama_perusahaan">Nama Perusahaan</label>
                        <input type="text" name="nama_perusahaan" id="nama_perusahaan" class="form-control <?= ($validation->hasError('nama_perusahaan')) ? 'is-invalid' : ''; ?>" value="<?= old('nama_perusahaan', $data['nama_perusahaan']) ?>" placeholder="Nama Perusahaan" autofocus>
                        <div class="invalid-feedback"><?= $validation->getError('nama_perusahaan'); ?></div>
                    </div>
                    <div class="form-group">
                        <label for="nama_pemilik">Nama Pemilik</label>
                        <input type="text" name="nama_pemilik" id="nama_pemilik" class="form-control <?= ($validation->hasError('nama_pemilik')) ? 'is-invalid' : ''; ?>" value="<?= old('nama_pemilik', $data['nama_pemilik']) ?>" placeholder="Nama Pemilik">
                        <div class="invalid-feedback"><?= $validation->getError('nama_pemilik'); ?></div>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : '' ?>" name="alamat" id="alamat" value="<?= old('alamat', $data['alamat']); ?>" placeholder="Alamat">
                        <div class="invalid-feedback"><?= $validation->getError('alamat') ?></div>
                    </div>
                    <div class="form-group">
                        <label for="produk">Produk</label>
                        <input type="text" class="form-control <?= ($validation->hasError('produk')) ? 'is-invalid' : '' ?>" name="produk" id="produk" value="<?= old('produk', $data['produk']); ?>" placeholder="Produk">
                        <div class="invalid-feedback"><?= $validation->getError('produk') ?></div>
                    </div>
                    <div class="form-group">
                        <label for="no_telp">No. Telp</label>
                        <input type="text" class="form-control <?= ($validation->hasError('no_telp')) ? 'is-invalid' : '' ?>" name="no_telp" id="no_telp" value="<?= old('no_telp', $data['no_telp']); ?>" placeholder="No. Telp">
                        <div class="invalid-feedback"><?= $validation->getError('no_telp') ?></div>
                    </div>
                    <div class="form-group">
                        <label for="ukuran">Ukuran</label>
                        <input type="text" class="form-control <?= ($validation->hasError('ukuran')) ? 'is-invalid' : '' ?>" name="ukuran" id="ukuran" value="<?= old('ukuran', $data['ukuran']); ?>" placeholder="Ukuran">
                        <div class="invalid-feedback"><?= $validation->getError('ukuran') ?></div>
                    </div>
                    <div class="form-group">
                        <label for="jenis_kemasan">Jenis Kemasan</label>
                        <input type="text" class="form-control <?= ($validation->hasError('jenis_kemasan')) ? 'is-invalid' : '' ?>" name="jenis_kemasan" id="jenis_kemasan" value="<?= old('jenis_kemasan', $data['jenis_kemasan']); ?>" placeholder="Jenis Kemasan">
                        <div class="invalid-feedback"><?= $validation->getError('jenis_kemasan') ?></div>
                    </div>
                    <div class="form-group">
                        <label for="tahun">Tahun</label>
                        <input type="text" class="form-control <?= ($validation->hasError('tahun')) ? 'is-invalid' : '' ?>" name="tahun" id="tahun" value="<?= old('tahun', $data['tahun']); ?>" placeholder="Tahun">
                        <div class="invalid-feedback"><?= $validation->getError('tahun') ?></div>
                    </div>
                    <div class="form-group">
                        <label for="kabkota">Kab/Kota</label>
                        <select name="kabkota" id="kabkota" class="form-control <?= ($validation->hasError('kabkota')) ? 'is-invalid' : '' ?>">
                            <option value="">Pilih</option>
                            <?php foreach ($kabkota as $kk) : ?>
                                <option value="<?= $kk['nama_kabkota'] ?>" <?= (old('kabkota', $data['kabkota']) == $kk['nama_kabkota']) ? 'selected' : '' ?>><?= $kk['nama_kabkota'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback"><?= $validation->getError('kabkota') ?></div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" name="submit" value="simpan" class="btn btn-primary"><i class="fa fa-save fa-fw"></i>Simpan</button>
                    <a href="/fas-kemasan" class="btn btn-default">Kembali</a>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>