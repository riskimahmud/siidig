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
                <?= form_open($base . "/tambah", ["class" => "form form-horizontal", "autocomplete" => ""]); ?>
                <?= form_hidden('user_id', user("user_id")); ?>
                <?= form_hidden('kabkota_id', user("kabkota_id")); ?>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="industri_id">Jenis Industri</label>
                                        <select name="industri_id" id="industri_id" class="form-control <?= ($validation->hasError('industri_id')) ? 'is-invalid' : ''; ?>" autofocus>
                                            <option value="">Pilih</option>
                                            <?php
                                            foreach ($industri as $in) :
                                            ?>
                                                <option value="<?= $in['id']; ?>" <?= set_select('industri_id', $in['id']); ?>><?= $in['nama_industri']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback"><?= $validation->getError('industri_id'); ?></div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="tahun">Tahun</label>
                                        <input type="text" class="form-control <?= ($validation->hasError('tahun')) ? 'is-invalid' : '' ?>" name="tahun" id="tahun" value="<?= old('tahun', date("Y")); ?>" placeholder="Tahun">
                                        <div class="invalid-feedback"><?= $validation->getError('tahun') ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nama_pemilik">Nama Pemilik</label>
                                <input type="text" name="nama_pemilik" id="nama_pemilik" class="form-control <?= ($validation->hasError('nama_pemilik')) ? 'is-invalid' : ''; ?>" value="<?= set_value('nama_pemilik') ?>" placeholder="Nama Pemilik">
                                <div class="invalid-feedback"><?= $validation->getError('nama_pemilik'); ?></div>
                            </div>
                            <div class="form-group">
                                <label for="nama_ikm">Nama Perusahaan</label>
                                <input type="text" name="nama_ikm" id="nama_ikm" class="form-control <?= ($validation->hasError('nama_ikm')) ? 'is-invalid' : ''; ?>" value="<?= set_value('nama_ikm') ?>" placeholder="Nama Perusahaan">
                                <div class="invalid-feedback"><?= $validation->getError('nama_ikm'); ?></div>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text" name="alamat" id="alamat" class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>" value="<?= set_value('alamat') ?>" placeholder="Alamat">
                                <div class="invalid-feedback"><?= $validation->getError('alamat'); ?></div>
                            </div>
                            <div class="form-group">
                                <label for="kelkec">Kelurahan / Kecamatan</label>
                                <select name="kelkec" id="kelkec" class="form-control select2 <?= ($validation->hasError('kelkec')) ? 'is-invalid' : ''; ?>" data-placeholder="Pilih">
                                    <option value=""></option>
                                    <?php
                                    foreach ($kelkec as $kk) :
                                    ?>
                                        <option value="<?= $kk['id']; ?>" <?= set_select('kelkec', $kk['id']); ?>><?= $kk['nama_kelkec'] . ' / ' . $kk['parent']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback"><?= $validation->getError('kelkec'); ?></div>
                            </div>
                            <div class="form-group">
                                <label for="telp">Telp</label>
                                <input type="text" name="telp" id="telp" class="form-control <?= ($validation->hasError('telp')) ? 'is-invalid' : ''; ?>" value="<?= set_value('telp') ?>" placeholder="Telp">
                                <div class="invalid-feedback"><?= $validation->getError('telp'); ?></div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="komoditi">Komoditi</label>
                                        <input type="text" name="komoditi" id="komoditi" class="form-control <?= ($validation->hasError('komoditi')) ? 'is-invalid' : ''; ?>" value="<?= set_value('komoditi') ?>" placeholder="Komoditi">
                                        <div class="invalid-feedback"><?= $validation->getError('komoditi'); ?></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="produk">Produk</label>
                                        <input type="text" name="produk" id="produk" class="form-control <?= ($validation->hasError('produk')) ? 'is-invalid' : ''; ?>" value="<?= set_value('produk') ?>" placeholder="Produk">
                                        <div class="invalid-feedback"><?= $validation->getError('produk'); ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="bentuk_badan_usaha">Bentuk Badan Usaha</label>
                                        <input type="text" name="bentuk_badan_usaha" id="bentuk_badan_usaha" class="form-control <?= ($validation->hasError('bentuk_badan_usaha')) ? 'is-invalid' : ''; ?>" value="<?= set_value('bentuk_badan_usaha') ?>" placeholder="Bentuk Badan Usaha">
                                        <div class="invalid-feedback"><?= $validation->getError('bentuk_badan_usaha'); ?></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tahun_izin">Tahun Izin</label>
                                        <input type="text" name="tahun_izin" id="tahun_izin" class="form-control <?= ($validation->hasError('tahun_izin')) ? 'is-invalid' : ''; ?>" value="<?= set_value('tahun_izin') ?>" placeholder="Tahun Izin">
                                        <div class="invalid-feedback"><?= $validation->getError('tahun_izin'); ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kode_kbli">Kode KBLI</label>
                                        <input type="text" name="kode_kbli" id="kode_kbli" class="form-control <?= ($validation->hasError('kode_kbli')) ? 'is-invalid' : ''; ?>" value="<?= set_value('kode_kbli') ?>" placeholder="Kode KBLI">
                                        <div class="invalid-feedback"><?= $validation->getError('kode_kbli'); ?></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kbli">KBLI</label>
                                        <input type="text" name="kbli" id="kbli" class="form-control <?= ($validation->hasError('kbli')) ? 'is-invalid' : ''; ?>" value="<?= set_value('kbli') ?>" placeholder="KBLI">
                                        <div class="invalid-feedback"><?= $validation->getError('kbli'); ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Tenaga Kerja</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <input type="text" class="form-control <?= ($validation->hasError('tkl')) ? 'is-invalid' : ''; ?>" name="tkl" placeholder="0" value="<?= set_value('tkl') ?>">
                                                <div class="input-group-append">
                                                    <span class="input-group-text text-lg p-1">
                                                        <ion-icon name="man"></ion-icon>
                                                    </span>
                                                </div>
                                                <div class="invalid-feedback"><?= $validation->getError('tkl'); ?></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <input type="text" class="form-control <?= ($validation->hasError('tkp')) ? 'is-invalid' : ''; ?>" name="tkp" placeholder="0" value="<?= set_value('tkp') ?>">
                                                <div class="input-group-append">
                                                    <span class="input-group-text text-lg p-1">
                                                        <ion-icon name="woman"></ion-icon>
                                                    </span>
                                                </div>
                                                <div class="invalid-feedback"><?= $validation->getError('tkp'); ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nilai_investasi">Nilai Investasi</label>
                                        <div class="input-group">
                                            <input type="text" name="nilai_investasi" id="nilai_investasi" class="form-control <?= ($validation->hasError('nilai_investasi')) ? 'is-invalid' : ''; ?>" value="<?= set_value('nilai_investasi') ?>" placeholder="Masukkan angka">
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    .000
                                                </span>
                                            </div>
                                            <div class="invalid-feedback"><?= $validation->getError('nilai_investasi'); ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="jumlah_produksi">Jumlah Kapasitas Produksi</label>
                                                <input type="text" name="jumlah_produksi" id="jumlah_produksi" class="form-control <?= ($validation->hasError('jumlah_produksi')) ? 'is-invalid' : ''; ?>" value="<?= set_value('jumlah_produksi') ?>" placeholder="Masukkan angka">
                                                <div class="invalid-feedback"><?= $validation->getError('jumlah_produksi'); ?></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="satuan">Satuan</label>
                                                <input type="text" name="satuan" id="satuan" class="form-control <?= ($validation->hasError('satuan')) ? 'is-invalid' : ''; ?>" value="<?= set_value('satuan') ?>" placeholder="KG, dll">
                                                <div class="invalid-feedback"><?= $validation->getError('satuan'); ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nilai_produksi">Nilai Produksi</label>
                                                <div class="input-group">
                                                    <input type="text" name="nilai_produksi" id="nilai_produksi" class="form-control <?= ($validation->hasError('nilai_produksi')) ? 'is-invalid' : ''; ?>" value="<?= set_value('nilai_produksi') ?>" placeholder="Masukkan angka">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            .000
                                                        </span>
                                                    </div>
                                                    <div class="invalid-feedback"><?= $validation->getError('nilai_produksi'); ?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nilai_bbbp">Nilai BB/BP</label>
                                                <div class="input-group">
                                                    <input type="text" name="nilai_bbbp" id="nilai_bbbp" class="form-control <?= ($validation->hasError('nilai_bbbp')) ? 'is-invalid' : ''; ?>" value="<?= set_value('nilai_bbbp') ?>" placeholder="Masukkan angka">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            .000
                                                        </span>
                                                    </div>
                                                    <div class="invalid-feedback"><?= $validation->getError('nilai_bbbp'); ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<?= $this->endSection() ?>