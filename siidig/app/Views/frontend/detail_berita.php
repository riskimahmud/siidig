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

<section class="blog-page pad-tb">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="blog-header">
                    <h1><?= $data->title; ?></h1>
                    <div class="row mt20 mb20">
                        <div class="col-md-8 col-12">
                            <div class="media">
                                <div class="user-image bdr-radius"><img src="<?= base_url("assets_front/images/custom/avatar.png"); ?>" alt="avatar" class="img-fluid" /></div>
                                <div class="media-body user-info">
                                    <h5>By <?= $data->penulis ?></h5>
                                    <p><?= tgl_indonesia_full($data->created_at) ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-3">
                            <div class="postwatch"><i class="far fa-eye"></i> <?= $data->hits; ?></div>
                        </div>
                    </div>
                </div>
                <div class="image-set"><img src="<?= base_url("uploads/berita/" . $data->gambar); ?>" alt="blog images" class="img-fluid" /></div>
                <div class="blog-content mt30">
                    <?= $data->body ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>