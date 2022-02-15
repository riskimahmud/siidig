<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- <h1>Laporan Investasi</h1> -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><?= $title; ?></h3>
                    <div class="card-tools">
                        <a href="<?= base_url($base . "/import"); ?>" class="btn btn-success btn-sm"> <i class="fas fa-file-excel fa-fw"></i> Import Data</a>
                        <a href="<?= base_url($base . "/tambah"); ?>" class="btn btn-primary btn-sm"> <i class="fas fa-plus-circle fa-fw"></i> Tambah Data</a>
                    </div>
                </div>
                <div class="card-header">
                    <div class="card-title">

                        <?= form_open('/investasi', ['autocomplete' => 'off', 'method' => 'get']); ?>
                        <div class="input-group input-group-sm">
                            <label for="tahun" class="font-weight-normal mr-2 text-md">Masukkan Tahun </label>
                            <input type="text" class="form-control" style="width: 70px;" name="tahun" list="tahun" placeholder="Masukkan Tahun" value="<?= $tahun ?>">
                            <datalist id="tahun">
                                <?php for ($i = date("Y"); $i >= 2016; $i--) : ?>
                                    <option value="<?= $i ?>"><?= $i ?></option>
                                <?php endfor ?>
                            </datalist>
                            <!-- <select name="tahun" id="tahun" class="form-control">
                                <option value="2022">2022</option>
                            </select> -->
                            <span class="input-group-append">
                                <button type="submit" class="btn btn-info btn-flat">Cari</button>
                            </span>
                        </div>
                        <?= form_close(); ?>
                    </div>
                </div>
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
                                        <a title="detail" href="<?= base_url($base . "/" . $d['id']); ?>" class="btn btn-primary btn-xs">
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
</div>
<?= $this->endSection(); ?>