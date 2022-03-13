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
                <?= form_open("header/ubah", ["class" => "form form-horizontal", "autocomplete" => "off", "enctype" => "multipart/form-data"]); ?>
                <input type="hidden" name="id" value="<?= $data['id']; ?>">
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control <?= ($validation->hasError('title')) ? 'is-invalid' : '' ?>" name="title" id="title" value="<?= old('title', $data['title']); ?>" placeholder="Title" autofocus>
                        <div class="invalid-feedback"><?= $validation->getError('title') ?></div>
                    </div>
                    <div class="form-group">
                        <label for="subtitle">Sub Title</label>
                        <input type="text" class="form-control <?= ($validation->hasError('subtitle')) ? 'is-invalid' : '' ?>" name="subtitle" id="subtitle" value="<?= old('subtitle', $data['subtitle']); ?>" placeholder="Sub Title">
                        <div class="invalid-feedback"><?= $validation->getError('subtitle') ?></div>
                    </div>
                    <div class="form-group">
                        <label for="link">Link</label>
                        <input type="url" class="form-control <?= ($validation->hasError('link')) ? 'is-invalid' : '' ?>" name="link" id="link" value="<?= old('link', $data['link']); ?>" placeholder="Link">
                        <div class="invalid-feedback"><?= $validation->getError('link') ?></div>
                    </div>
                    <div class="form-group">
                        <label for="gambar">Gambar</label>
                        <img src="<?= base_url("uploads/header/" . $data['gambar']); ?>" alt="Gambar" class="d-block mb-2 w-25 img-thumbnail" id="preview">
                        <input type="file" class="form-control <?= ($validation->hasError('gambar')) ? 'is-invalid' : '' ?>" name="gambar" id="gambar" value="<?= old('gambar'); ?>" placeholder="Gambar">
                        <div class="invalid-feedback"><?= $validation->getError('gambar') ?></div>
                        <small class="text-danger">Maksimal 5MB</small>
                        <small class="text-muted"> | Kosongkan Jika Tidak Ingin Mengganti</small>
                    </div>
                </div>
                <div class="card-footer">
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
                    <a href="/header" class="btn btn-default">Kembali</a>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('script') ?>
<script>
    const formFile = document.getElementById('gambar');
    formFile.onchange = evt => {
        const [file] = formFile.files
        if (file) {
            document.getElementById("preview").src = URL.createObjectURL(file)
        }
    }
</script>
<?= $this->endSection() ?>