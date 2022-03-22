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

<section class="blog-page pad-tb pt40">
    <div class="container">
        <div class="row">
            <?php if (!empty($data)) : ?>
                <?php foreach ($data as $d) : ?>
                    <div class="col-lg-4 col-sm-6 single-card-item">
                        <div class="isotope_item hover-scale">
                            <div class="item-image">
                                <a href="<?= base_url("course/" . $d->slug); ?>"><img src="<?= base_url("uploads/pelatihan/thumb_" . $d->gambar); ?>" alt="pelatihan" class="img-fluid" /> </a>
                                <!-- <span class="category-blog"><a href="#">iOs</a> <a href="#">Android</a></span> -->
                            </div>
                            <div class="item-info blog-info text-center">
                                <div class="entry-blog">
                                    <span class="bypost"><i class="fas fa-map-marker"></i> <?= $d->lokasi; ?></span>
                                    <span class="posted-on">
                                        <i class="fas fa-calendar-alt"></i> <?= tgl_indonesia($d->tgl_pelaksanaan) ?>
                                    </span>
                                    <!-- <span><a href="#"><i class="fas fa-comment-dots"></i> (23)</a></span> -->
                                </div>
                                <h4><a href="<?= base_url("course/" . $d->slug); ?>"><?= $d->title ?></a></h4>
                                <!-- <p></p> -->
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="col-lg-12">
                    <div class="bg-gradient pt60 pb60 mt30 mb30 text-center">
                        <h4><i class="fas fa-meh"></i> Maaf. Belum ada pelatihan.</h4>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>


<?= $this->endSection() ?>