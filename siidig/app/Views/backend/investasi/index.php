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
                <div class="card-header pb-0">

                    <?= form_open('/investasi', ['autocomplete' => 'off', 'method' => 'get', 'class' => 'form-horizontal']); ?>
                    <div class="row">
                        <div class="col-sm-3 mb-0">
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

                        <div class="col-sm-2 mb-0">
                            <div class="form-group row">
                                <label for="tahun" class="col-sm-4 col-form-label text-left text-md-right">Tahun </label>
                                <select name="tahun" id="tahun" class="form-control form-control-sm col-sm-8">
                                    <?php for ($i = date("Y"); $i >= 2016; $i--) : ?>
                                        <option value="<?= $i ?>" <?= ($i == $filter['tahun']) ? 'selected' : ''; ?>><?= $i ?></option>
                                    <?php endfor ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-3 mb-0">
                            <div class="form-group row">
                                <label for="kecamatan" class="col-sm-4 col-form-label text-left text-md-right">Kecamatan </label>
                                <select name="kecamatan" id="kecamatan" class="form-control form-control-sm col-sm-8">
                                    <option value="">Semua</option>
                                    <?php foreach ($kecamatan as $kec) : ?>
                                        <option value="<?= $kec['nama_kelkec'] ?>" <?= (isset($filter['kecamatan']) && ($kec['nama_kelkec'] == $filter['kecamatan'])) ? 'selected' : ''; ?>>
                                            <?= $kec['nama_kelkec'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-3 mb-0">
                            <div class="form-group row">
                                <label for="kelurahan" class="col-sm-4 col-form-label text-left text-md-right">Kelurahan </label>
                                <select name="kelurahan" id="kelurahan" class="form-control form-control-sm col-sm-8">
                                    <option value="">Semua</option>
                                    <?php foreach ($kelurahan as $kec) : ?>
                                        <option value="<?= $kec['nama_kelkec'] ?>" <?= (isset($filter['kelurahan']) && ($kec['nama_kelkec'] == $filter['kelurahan'])) ? 'selected' : ''; ?>>
                                            <?= $kec['nama_kelkec'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-3 mb-0">
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

                        <div class="col-sm-3 mb-0">
                            <div class="form-group row">
                                <label for="komoditi" class="col-sm-4 col-form-label text-left text-md-right">Komoditi</label>
                                <input name="komoditi" id="komoditi" class="form-control form-control-sm col-sm-8" type="text" value="<?= (isset($filter['komoditi'])) ? $filter['komoditi'] : ''; ?>">
                            </div>
                        </div>

                        <div class="col-sm-3 mb-0">
                            <div class="form-group row">
                                <label for="produk" class="col-sm-4 col-form-label text-left text-md-right">Produk</label>
                                <input name="produk" id="produk" class="form-control form-control-sm col-sm-8" type="text" value="<?= (isset($filter['produk'])) ? $filter['produk'] : ''; ?>">
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-2">
                            <button type="submit" class="btn btn-info btn-sm btn-block"><i class="fas fa-search fa-fw fa-sm"></i> Cari</button>
                        </div>
                        <?= form_close(); ?>
                        <div class="col-sm-12 col-md-2">
                            <?= form_open('/hapus-investasi', ['autocomplete' => 'off']); ?>
                            <input type="hidden" name="industri" id="industri_hapus">
                            <input type="hidden" name="tahun" id="tahun_hapus">
                            <!-- <button type="submit" class="btn btn-danger btn-sm btn-block deleteSemua"><i class="fas fa-trash-alt fa-fw fa-sm"></i> Hapus Semua</button> -->
                            <?= form_close(); ?>
                        </div>
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

<?= $this->section('script') ?>
<script>
    $("#kecamatan").on("change", function(e) {
        const kec = $(this).val();
        $("#kelurahan").html(`<option value="">Semua</option>`);
        $.ajax({
            url: url + '/getKelurahan',
            data: {
                kec: kec
            },
            type: 'POST',
            dataType: 'JSON',
            success: function(response) {
                let option = `<option value="">Semua</option>`;
                response.data.forEach(e => {
                    option += `<option value="${e.nama_kelkec}">${e.nama_kelkec}</option>`
                });
                $("#kelurahan").html(option);
                // console.log(response)
            }
        })
    })

    $('form button.deleteSemua').on("click", function(e) {
        e.preventDefault();
        const form = $(this).parents('form');
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Ingin mengapus semua data yang ada pada tabel ini?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya. Hapus data!',
            confirmButtonClass: 'btn btn-warning',
            cancelButtonClass: 'btn btn-danger ml-1',
            cancelButtonText: 'Batal',
            buttonsStyling: false,
        }).then(function(result) {
            if (result.value) {
                form.submit();
            }
        })
    })
</script>
<?= $this->endSection() ?>