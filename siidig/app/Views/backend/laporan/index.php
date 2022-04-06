<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body p-2">
                <?= form_open('', ['autocomplete' => 'off', 'method' => 'get']); ?>
                <div class="row">
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label>Kabupaten / Kota</label>
                            <select name="kabkota" id="kabkota" class="form-control">
                                <option value="">Semua</option>
                                <?php foreach ($kabkota as $kk) : ?>
                                    <option value="<?= $kk['id'] ?>" <?= (($filter) && ($filter['kabkota'] == $kk['id'])) ? 'selected' : '' ?>>
                                        <?= $kk['nama_kabkota'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label>Tahun</label>
                            <select name="tahun" id="satuan" class="form-control" <?= (user("level") == "operator") ? 'disabled="disabled"' : ''; ?>>
                                <option value="">Pilih Tahun</option>
                                <?php for ($i = date("Y"); $i >= 2016; $i--) : ?>
                                    <option value="<?= $i; ?>" <?= (($filter) && ($filter['tahun'] == $i)) ? 'selected' : '' ?>>
                                        <?= $i ?>
                                    </option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <label for="">&nbsp;</label>
                        <button type="submit" class="btn btn-primary d-block"><i class="fas fa-filter fa-fw"></i> Sortir</button>
                    </div>
                    <?= form_close(); ?>
                    <div class="col-md-1">
                        <?= form_open('', ['autocomplete' => 'off', 'target' => '_blank']); ?>
                        <input type="hidden" name="kabkota" id="kabkota_cetak">
                        <input type="hidden" name="tahun" id="tahun_cetak">
                        <label for="">&nbsp;</label>
                        <button target="_blank" type="submit" name="cetak" value="cetak" class="btn btn-success d-block"><i class="fas fa-print fa-fw"></i> Cetak</button>
                        <?= form_close(); ?>
                    </div>
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
                            <th>Nilai Investasi</th>
                            <th>Jumlah Produksi</th>
                            <th>Satuan</th>
                            <th>Nilai Produksi</th>
                            <th>Nilai BB/BP</th>
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