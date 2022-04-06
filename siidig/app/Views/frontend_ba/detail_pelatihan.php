<?= $this->extend('layout/frontend'); ?>

<?= $this->section('content'); ?>

<?= $this->include('frontend/header'); ?>

<section class="breadcrumb-area banner-2">
    <div class="text-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 v-center">
                    <div class="bread-inner">
                        <div class="bread-title">
                            <h2>Pelatihan</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="portfolio-page pad-tb">
    <div class="container">
        <?php if (empty($data)) : ?>
            <div class="bg-gradient pt60 pb60 mt30 mb30 text-center">
                <h4><i class="fas fa-meh"></i> Maaf. Belum ada pelatihan.</h4>
            </div>
        <?php else : ?>
            <div class="row justify-content-left">
                <!-- <div class="col-12 mb-2">
                    <div class="isotope_item pv-">
                        <div class="item-image">
                            <img src="<?= base_url("uploads/pelatihan/" . $data->gambar); ?>" alt="Pelatihan" class="img-fluid" />
                        </div>
                    </div>
                </div> -->
                <div class="col-lg-7">
                    <div class="common-heading pp p-details">
                        <h1><?= $data->title; ?></h1>
                        <!-- <p> -->
                        <p class="text-justify">
                            <?= $data->body; ?>
                        </p>
                        <!-- </p> -->
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="portfolio-details">
                        <div class="portfolio-meta link-hover">
                            <ul>
                                <li>
                                    <i class="fas fa-map-marker"></i>
                                    <p>Lokasi: <span><?= $data->lokasi; ?></span></p>
                                </li>
                                <li>
                                    <i class="fas fa-calendar-alt"></i>
                                    <p>Waktu: <span><?= tgl_indonesia($data->tgl_pelaksanaan) ?></span></p>
                                </li>
                                <!-- <li><a href="#" target="_blank">Open External Link</a></li> -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 single-card-item">
                    <div class="isotope_item pv-">
                        <div class="item-image">
                            <img src="<?= base_url("uploads/pelatihan/" . $data->gambar); ?>" alt="Pelatihan" class="img-fluid" />
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>


<?= $this->endSection() ?>