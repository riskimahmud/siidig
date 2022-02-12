<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <a href="<?= base_url("pengajuan/buat"); ?>" class="btn btn-primary mb-3"><i class="fas fa-plus-circle fa-fw"></i> Buat Pengajuan</a>

            <form action="<?= base_url("pengajuan/filter"); ?>" method="POST">
                <div class="row mb-3">
                    <div class="col-12 col-md-8 mb-1">
                        <select name="skpd" id="skpd" class="form-control select2" data-placeholder="Filter Berdasarkan OPD Pengusul" required="required">
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
                        <a href="<?= base_url("pengajuan/hapus_filter"); ?>" class="btn btn-default btn-block <?php echo (cekSession("filter_skpd")) ? "" : "disabled"; ?>">
                            <i class="far fa-trash fa-fw"></i> Hapus Filter
                        </a>
                    </div>
                </div>
            </form>

            <div class="card card-primary card-tabs">
                <div class="card-header p-0 pt-1">
                    <ul class="nav nav-tabs px-2">
                        <!-- <li class="pt-2 px-3">
                            <h3 class="card-title">Status Pengajuan</h3>
                        </li> -->
                        <li class="nav-item">
                            <a class="nav-link <?= ($status == "0") ? "active" : "";  ?>" href="<?= base_url("pengajuan"); ?>">Semua</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($status == "menunggu") ? "active" : "";  ?>" href="<?= base_url("pengajuan/menunggu"); ?>">Menunggu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($status == "proses") ? "active" : "";  ?>" href="<?= base_url("pengajuan/proses"); ?>">Proses</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($status == "disetujui") ? "active" : "";  ?>" href="<?= base_url("pengajuan/disetujui"); ?>">Disetujui</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($status == "selesai") ? "active" : "";  ?>" href="<?= base_url("pengajuan/selesai"); ?>">Selesai</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($status == "tolak") ? "active" : "";  ?>" href="<?= base_url("pengajuan/tolak"); ?>">Tolak</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($status == "batalkan") ? "active" : "";  ?>" href="<?= base_url("pengajuan/batalkan"); ?>">Dibatalkan</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-hover table-striped text-nowrap" id="dataTable">
                        <thead>
                            <tr>
                                <th width="10">No</th>
                                <th>Pegawai</th>
                                <th>Usulan Jabatan</th>
                                <th>Status</th>
                                <th>Wkt Pengajuan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($data as $d) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td>
                                        <?= $d->nip . "<br>" . $d->nama; ?>
                                        <?= "<b class='d-block'>$d->unorname_lama</b>"; ?>
                                    </td>
                                    <td>
                                        <?= $d->nama_jabatan_baru . "<br><b>" . $d->unorname_baru . "</b>"; ?>
                                        <?= ($d->unit_organisasi_baru != "") ? "<span class='d-block'>($d->unit_organisasi_baru)</span>" : ""; ?>
                                    </td>
                                    <td>
                                        <?= statusPengajuan($d->status, $d->tolak); ?>
                                    </td>
                                    <td><?= tgl_indonesia_full_short($d->create_at); ?></td>
                                    <td>
                                        <a href="<?= base_url("pengajuan/" . $d->pengajuan_id); ?>" class="btn btn-info badge" title="Detail"><i class="fas fa-list fa-fw"></i></a>
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