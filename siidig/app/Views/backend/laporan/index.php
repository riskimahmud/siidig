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
                            <select name="kabkota" id="kabkota" class="form-control form-control-sm col-sm-8">
                                <option value="">Semua</option>
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
                            <select name="industri" id="industri" class="form-control form-control-sm col-sm-8">
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
                            <select name="tahun" id="tahun" class="form-control form-control-sm col-sm-8">
                                <?php for ($i = date("Y"); $i >= 2016; $i--) : ?>
                                    <option value="<?= $i ?>" <?= ($i == $filter['tahun']) ? 'selected' : ''; ?>><?= $i ?></option>
                                <?php endfor ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3 mb-0">
                        <div class="form-group row">
                            <label for="bentuk_badan_usaha" class="col-sm-6 col-form-label text-left text-md-right">Badan Usaha</label>
                            <select name="bentuk_badan_usaha" id="bentuk_badan_usaha" class="form-control form-control-sm col-sm-6">
                                <option value="">Semua</option>
                                <?php foreach ($badan_usaha as $bu) : ?>
                                    <option value="<?= $bu ?>" <?= (isset($filter['bentuk_badan_usaha']) && ($bu == $filter['bentuk_badan_usaha'])) ? 'selected' : ''; ?>>
                                        <?= $bu ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3 mb-0">
                        <div class="form-group row">
                            <label for="komoditi" class="col-sm-4 col-form-label text-left text-md-right">Komoditi</label>
                            <input name="komoditi" id="komoditi" class="form-control form-control-sm col-sm-8" type="text" value="<?= (isset($filter['komoditi'])) ? $filter['komoditi'] : ''; ?>">
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3 mb-0">
                        <div class="form-group row">
                            <label for="produk" class="col-sm-4 col-form-label text-left text-md-right">Produk</label>
                            <input name="produk" id="produk" class="form-control form-control-sm col-sm-8" type="text" value="<?= (isset($filter['produk'])) ? $filter['produk'] : ''; ?>">
                        </div>
                    </div>
                    <div class="col-md-6 text-right">
                        <button type="submit" name="cari" value="cari" class="btn btn-info btn-sm"><i class="fas fa-search fa-fw fa-sm"></i> Cari</button>
                        <button type="submit" name="cetak" value="cetak" id="cetak" class="btn btn-success btn-sm"><i class="fas fa-print fa-fw fa-sm"></i> Cetak</button>
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body table-responsive">
                <table class="table table-hover text-nowrap" id="dataTable">
                    <thead>
                        <tr>
                            <th width="10">No</th>
                            <th>Nama Pemilik</th>
                            <th>Nama IKM</th>
                            <th>Produk</th>
                            <th>Nilai Investasi (000)</th>
                            <th>Jumlah Produksi</th>
                            <th>Satuan</th>
                            <th>Nilai Produksi (000)</th>
                            <th>Nilai BB/BP (000)</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($data as $d) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $d['nama_pemilik'] ?></td>
                                <td><?= $d['nama_ikm'] ?></td>
                                <td><?= $d['produk'] ?></td>
                                <td><?= angkaInvestasi($d['nilai_investasi']) ?></td>
                                <td><?= angkaInvestasi($d['jumlah_produksi']) ?></td>
                                <td><?= $d['satuan'] ?></td>
                                <td><?= angkaInvestasi($d['nilai_produksi']) ?></td>
                                <td><?= angkaInvestasi($d['nilai_bbbp']) ?></td>
                                <td>
                                    <a title="detail" href="<?= base_url("laporan/" . $d['id']); ?>" class="btn btn-primary btn-xs">
                                        <i class="fas fa-list"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
    $("#kabkota").on("change", function(e) {
        const val = $(this).val();
        $("#kabkota_cetak").val(val);
    })
    $("#tahun").on("change", function(e) {
        const val = $(this).val();
        $("#tahun_cetak").val(val);
    })
</script>
<?= $this->endSection(); ?>