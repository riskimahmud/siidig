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
                            <h2>Berita</h2>
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

            <?php foreach ($data as $d) : ?>
                <div class="col-lg-4 mt60">
                    <div class="single-blog-post- shdo">
                        <div class="single-blog-img-">
                            <a href="<?= base_url("/berita/" . $d->slug); ?>"><img src="<?= base_url("uploads/berita/thumb_" . $d->gambar); ?>" alt="girl" class="img-fluid"></a>
                            <div class="entry-blog-post dg-bg2">
                                <span class="bypost-"><a href="javascript:void(0)"><i class="fas fa-fw fa-user-edit"></i> <?= $d->penulis ?></a></span>
                                <span class="posted-on-">
                                    <a href="javascript:void(0)"><i class="fas fa-fw fa-clock"></i> <?= tgl_indonesia($d->created_at) ?></a>
                                </span>
                            </div>
                        </div>
                        <div class="blog-content-tt">
                            <div class="single-blog-info-">
                                <h4><a href="<?= base_url("/berita/" . $d->slug); ?>"><?= $d->title; ?></a></h4>
                                <p><?= $d->excerpt; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<?= $this->endSection() ?>