<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <form target="_blank" action="<?= base_url("cari_laporan"); ?>" method="POST" autocomplete="off">
                <div class="row mb-3">
                    <div class="col-12 col-md-6 mb-2">
                        <label for="skpd_asal">OPD Asal</label>
                        <select name="skpd_asal" id="skpd_asal" class="form-control select2-alt" data-placeholder="Filter Berdasarkan OPD Pengusul">
                            <option value=""></option>
                            <?php foreach ($skpd as $s) : ?>
                                <option value="<?= $s->unorid; ?>" <?= set_select("skpd", $s->unorid, (cekSession("filter_skpd") && (getSession("filter_skpd") == $s->unorid)) ? TRUE : FALSE) ?>><?= $s->unorname; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-12 col-md-6 mb-2">
                        <label for="skpd_tujuan">OPD Tujuan</label>
                        <select name="skpd_tujuan" id="skpd_tujuan" class="form-control select2-alt" data-placeholder="Filter Berdasarkan OPD Tujuan">
                            <option value=""></option>
                            <?php foreach ($skpd as $s) : ?>
                                <option value="<?= $s->unorid; ?>" <?= set_select("skpd", $s->unorid, (cekSession("filter_skpd") && (getSession("filter_skpd") == $s->unorid)) ? TRUE : FALSE) ?>><?= $s->unorname; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-12 col-md-4 mb-2">
                        <label for="status">Status Pengajuan</label>
                        <select name="status" id="status" class="form-control" required="required">
                            <?php foreach ($status as $ind => $val) : ?>
                                <option value="<?= $ind; ?>"><?= $val ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-12 col-md-4 mb-2">
                        <label for="tgl_pengajuan">Tgl Pengajuan</label>
                        <input type="text" name="tgl_pengajuan" id="tgl_pengajuan" class="form-control datepicker" data-toggle="datetimepicker" data-target="#tgl_pengajuan" placeholder="Tgl Pengajuan">
                    </div>
                    <div class="col-12 col-md-4 mb-2">
                        <label for="tgl_tmt">Tgl TMT</label>
                        <input type="text" name="tgl_tmt" id="tgl_tmt" class="form-control datepicker" data-toggle="datetimepicker" data-target="#tgl_tmt" placeholder="Tgl TMT">
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">
                            <div class="far fa-search fa-fw"></div> Cari
                        </button>
                    </div>
                </div>
            </form>

            <div class="card card-primary card-tabs">

            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>