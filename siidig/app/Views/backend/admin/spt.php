<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <a href="<?= base_url("spt/buat"); ?>" class="btn btn-primary mb-3"><i class="fas fa-plus-circle fa-fw"></i> Buat SPT</a>
            <a href="<?= base_url("spt/buat-khusus"); ?>" class="btn btn-success mb-3"><i class="fas fa-user-lock fa-fw"></i> Buat SPT Khusus</a>

            <form action="<?= base_url("spt/filter"); ?>" method="POST">
                <div class="row mb-3">
                    <div class="col-12 col-md-8 mb-1">
                        <select name="skpd" id="skpd" class="form-control select2" data-placeholder="Filter Berdasarkan OPD Tujuan" required="required">
                            <option value=""></option>
                            <?php foreach ($skpd as $s) : ?>
                                <option value="<?= $s->unorid; ?>" <?= set_select("skpd", $s->unorid, (cekSession("filter_skpd") && (getSession("filter_skpd") == $s->unorid)) ? TRUE : FALSE) ?>><?= $s->unorname; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-6 col-md-2">
                        <button type="submit" class="btn btn-primary btn-block">
                            <div class="far fa-filter fa-fw"></div> Filter
                        </button>
                    </div>
                    <div class="col-6 col-md-2">
                        <a href="<?= base_url("spt/hapus_filter"); ?>" class="btn btn-default btn-block <?php echo (cekSession("filter_skpd")) ? "" : "disabled"; ?>">
                            <i class="far fa-trash fa-fw"></i> Hapus Filter
                        </a>
                    </div>
                </div>
            </form>

            <div class="card card-primary card-tabs">
                <div class="card-body table-responsive">
                    <table class="table table-hover table-striped text-nowrap" id="dataTable">
                        <thead>
                            <tr>
                                <th width="10">No</th>
                                <th>Jabatan Tujuan</th>
                                <th>Pegawai</th>
                                <th>Status</th>
                                <th>Wkt Pengajuan</th>
                                <th>Dibuat Oleh</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($data as $d) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td>
                                        <?= $d->nama_jabatan_baru . " <i>($d->jenis_pengajuan)</i><br><b>" . $d->unorname_baru . "</b>"; ?>
                                        <?= ($d->unit_organisasi_baru != "") ? "<span class='d-block'>($d->unit_organisasi_baru)</span>" : ""; ?>
                                    </td>
                                    <td>
                                        <?= $d->nip . "<br>" . $d->nama; ?>
                                        <?= "<b class='d-block'>$d->unorname_lama</b>"; ?>
                                    </td>
                                    <td>
                                        <?= statusPengajuan($d->status, $d->tolak); ?>
                                    </td>
                                    <td><?= tgl_indonesia_full_short($d->create_at); ?></td>
                                    <td>
                                        <?= $d->create_by; ?>
                                    </td>
                                    <td>
                                        <a href="<?= base_url("spt/" . $d->pengajuan_id); ?>" class="btn btn-info badge" title="Detail"><i class="fas fa-list fa-fw"></i></a>
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