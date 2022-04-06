<?= $this->extend('layout/top_nav'); ?>

<?= $this->section('content'); ?>
<?php if (!empty($data)) : ?>
    <!-- <div class="row"> -->
    <div class="card-deck row-cols-lg-3">
        <?php foreach ($data as $d) : ?>
            <a class="text-decoration-none" href="<?= base_url("course/" . $d->slug); ?>">
                <div class="card shadow">
                    <img class="card-img-top" src="<?= base_url("uploads/pelatihan/thumb_" . $d->gambar); ?>" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><?= $d->title ?></h5>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <small class="text-muted"><i class="fas fa-fw fa-calendar"></i> <?= tgl_indonesia($d->tgl_pelaksanaan) ?></small>
                        <small class="text-muted"><i class="fas fa-fw fa-map-marker"></i> <?= $d->lokasi ?></small>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
    <!-- </div> -->
<?php else : ?>
    <div class="alert alert-info text-center" role="alert">
        <h4 class="alert-heading"><i class="fas fa-meh fa-fw"></i> Maaf!</h4>
        <p>Data pelatihan belum tersedia.</p>
    </div>
<?php endif; ?>
<?= $this->endSection() ?>