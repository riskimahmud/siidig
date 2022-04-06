<?= $this->extend('layout/top_nav'); ?>

<?= $this->section('content'); ?>
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="row">
            <div class="col-12 col-sm-6 order-2 order-lg-2">
                <div class="info-box bg-light">
                    <div class="info-box-content">
                        <span class="info-box-text text-center text-muted">Lokasi</span>
                        <span class="info-box-number text-center text-muted mb-0"><?= $data->lokasi; ?></span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 order-3 order-lg-2">
                <div class="info-box bg-light">
                    <div class="info-box-content">
                        <span class="info-box-text text-center text-muted">Tanggal Pelaksanaan</span>
                        <span class="info-box-number text-center text-muted mb-0"><?= $data->tgl_pelaksanaan; ?></span>
                    </div>
                </div>
            </div>

            <div class="col-12 order-1 order-lg-3">
                <img src="<?= base_url("uploads/pelatihan/" . $data->gambar); ?>" alt="Pelatihan" class="img-fluid" />
            </div>

            <div class="col-12 col-sm-12 order-4 order-lg-4">
                <p class="text-justify">
                    <?= $data->body; ?>
                </p>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>