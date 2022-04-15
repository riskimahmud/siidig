<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title"><?= $title; ?></h1>
                    <div class="card-tools">
                        <a href="#" onclick="history.go(-1)" class="btn btn-default btn-xs">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="d-flex justify-content-between border-bottom mb-2">
                                <label>Nama Pemilik</label>
                                <span><?= $data['nama_pemilik'] ?></span>
                            </div>
                            <div class="d-flex justify-content-between border-bottom mb-2">
                                <label>Nama Perusahaan / IKM</label>
                                <span><?= $data['nama_ikm'] ?></span>
                            </div>
                            <div class="d-flex justify-content-between border-bottom mb-2">
                                <label>Alamat</label>
                                <span><?= $data['alamat'] ?></span>
                            </div>
                            <div class="d-flex justify-content-between border-bottom mb-2">
                                <label>Kelurahan / Desa</label>
                                <span><?= $data['keldesa'] ?></span>
                            </div>
                            <div class="d-flex justify-content-between border-bottom mb-2">
                                <label>Kecamatan</label>
                                <span><?= $data['kecamatan'] ?></span>
                            </div>
                            <div class="d-flex justify-content-between border-bottom mb-2">
                                <label>Kabupaten / Kota</label>
                                <span><?= $data['nama_kabkota'] ?></span>
                            </div>
                            <div class="d-flex justify-content-between border-bottom mb-2">
                                <label>Industri</label>
                                <span><?= $data['nama_industri'] ?></span>
                            </div>
                            <div class="d-flex justify-content-between border-bottom mb-2">
                                <label>Telp</label>
                                <span><?= $data['telp'] ?></span>
                            </div>
                            <div class="d-flex justify-content-between border-bottom mb-2">
                                <label>Bentuk Badan Usaha</label>
                                <span><?= $data['bentuk_badan_usaha'] ?></span>
                            </div>
                            <div class="d-flex justify-content-between border-bottom mb-2">
                                <label>Komoditi</label>
                                <span><?= $data['komoditi'] ?></span>
                            </div>
                            <div class="d-flex justify-content-between border-bottom mb-2">
                                <label>Produk</label>
                                <span><?= $data['produk'] ?></span>
                            </div>
                            <div class="d-flex justify-content-between border-bottom mb-2">
                                <label>Tahun Izin</label>
                                <span><?= $data['tahun_izin'] ?></span>
                            </div>
                            <div class="d-flex justify-content-between border-bottom mb-2">
                                <label>Kode KBLI</label>
                                <span><?= $data['kode_kbli'] ?></span>
                            </div>
                            <div class="d-flex justify-content-between border-bottom mb-2">
                                <label>KBLI</label>
                                <span><?= $data['kbli'] ?></span>
                            </div>
                            <div class="d-flex justify-content-between border-bottom mb-2">
                                <label>Tenaga Kerja Laki-laki</label>
                                <span><?= $data['tkl'] ?></span>
                            </div>
                            <div class="d-flex justify-content-between border-bottom mb-2">
                                <label>Tenaga Kerja Perempuan</label>
                                <span><?= $data['tkp'] ?></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex justify-content-between border-bottom mb-2">
                                <label>Nilai Investasi</label>
                                <span><?= angkaInvestasi($data['nilai_investasi'] . '000') ?></span>
                            </div>
                            <div class="d-flex justify-content-between border-bottom mb-2">
                                <label>Jumlah Produksi</label>
                                <span><?= angkaInvestasi($data['jumlah_produksi']) ?></span>
                            </div>
                            <div class="d-flex justify-content-between border-bottom mb-2">
                                <label>Satuan</label>
                                <span><?= $data['satuan'] ?></span>
                            </div>
                            <div class="d-flex justify-content-between border-bottom mb-2">
                                <label>Nilai Produksi</label>
                                <span><?= angkaInvestasi($data['nilai_produksi'] . '000') ?></span>
                            </div>
                            <div class="d-flex justify-content-between border-bottom mb-2">
                                <label>Nilai BB/BP</label>
                                <span><?= angkaInvestasi($data['nilai_bbbp'] . '000') ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>