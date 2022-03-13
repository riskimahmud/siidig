<?= $this->extend('layout/template'); ?>

<?= $this->section('css'); ?>
<link rel="stylesheet" type="text/css" href="<?= base_url("plugins/trix/trix.css"); ?>">
<script type="text/javascript" src="<?= base_url("plugins/trix/trix.js"); ?>"></script>
<?= $this->endSection() ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <!-- general form elements -->
            <div class="card shadow">
                <div class="card-header">
                    <h1 class="card-title"><?= $title; ?></h1>
                </div>
                <!-- form start -->
                <?= form_open("pelatihan/tambah", ["class" => "form form-horizontal", "autocomplete" => "off", "enctype" => "multipart/form-data"]); ?>
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control <?= ($validation->hasError('title')) ? 'is-invalid' : '' ?>" name="title" id="title" value="<?= old('title'); ?>" placeholder="Title" autofocus>
                        <div class="invalid-feedback"><?= $validation->getError('title') ?></div>
                    </div>
                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input type="text" class="form-control <?= ($validation->hasError('slug')) ? 'is-invalid' : '' ?>" name="slug" id="slug" value="<?= old('slug'); ?>" placeholder="Slug">
                        <div class="invalid-feedback"><?= $validation->getError('slug') ?></div>
                    </div>
                    <div class="form-group">
                        <label for="lokasi">Lokasi</label>
                        <input type="text" class="form-control <?= ($validation->hasError('lokasi')) ? 'is-invalid' : '' ?>" name="lokasi" id="lokasi" value="<?= old('lokasi'); ?>" placeholder="Lokasi">
                        <div class="invalid-feedback"><?= $validation->getError('lokasi') ?></div>
                    </div>
                    <div class="form-group">
                        <label for="tgl_pelaksanaan">Tgl Pelaksanaan</label>
                        <input type="date" class="form-control <?= ($validation->hasError('tgl_pelaksanaan')) ? 'is-invalid' : '' ?>" name="tgl_pelaksanaan" id="tgl_pelaksanaan" value="<?= old('tgl_pelaksanaan'); ?>" placeholder="Tgl Pelaksanaan">
                        <div class="invalid-feedback"><?= $validation->getError('tgl_pelaksanaan') ?></div>
                    </div>
                    <div class="form-group">
                        <label for="body">Deskripsi</label>
                        <input id="body" type="hidden" value="<?= old('body') ?>" name="body">
                        <trix-editor input="body"></trix-editor>
                        <div class="invalid-feedback"><?= $validation->getError('body') ?></div>
                    </div>
                    <div class="form-group">
                        <label for="gambar">Gambar</label>
                        <img src="<?= base_url("uploads/img/no-image.png"); ?>" alt="Gambar" class="d-block mb-2 w-25 img-thumbnail" id="preview">
                        <input type="file" class="form-control <?= ($validation->hasError('gambar')) ? 'is-invalid' : '' ?>" name="gambar" id="gambar" value="<?= old('gambar'); ?>" placeholder="Gambar">
                        <div class="invalid-feedback"><?= $validation->getError('gambar') ?></div>
                        <small class="text-danger">Maksimal 5MB</small>
                    </div>
                </div>
                <div class="card-footer">
                    <!-- <button type="submit" name="submit" value="simpan" class="btn btn-primary"><i class="fa fa-save fa-fw"></i>Simpan</button> -->
                    <div class="btn-group">
                        <button type="submit" name="status" value="publish" class="btn btn-primary"><i class="fa fa-save fa-fw"></i> Publish</button>
                        <button type="button" class="btn btn-primary dropdown-toggle dropdown-icon" data-toggle="dropdown">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu">
                            <button type="submit" name="status" value="draft" class="dropdown-item">Jadikah Draft</button>
                            <button type="submit" name="status" value="hidden" class="dropdown-item">Hidden</button>
                        </div>
                    </div>
                    <a href="/pelatihan" class="btn btn-default">Kembali</a>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('script') ?>
<script>
    const slug = function(str) {
        var $slug = '';
        var trimmed = $.trim(str);
        $slug = trimmed.replace(/[^a-z0-9-]/gi, '-').
        replace(/-+/g, '-').
        replace(/^-|-$/g, '');
        return $slug.toLowerCase();
    }

    $("#title").on('change', function() {
        $("#slug").val(slug($(this).val()));
    })

    const formFile = document.getElementById('gambar');
    formFile.onchange = evt => {
        const [file] = formFile.files
        if (file) {
            document.getElementById("preview").src = URL.createObjectURL(file)
        }
    }
</script>
<?= $this->endSection() ?>