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
                <?= form_open("informasi/ubah", ["class" => "form form-horizontal", "autocomplete" => "off", "enctype" => "multipart/form-data"]); ?>
                <input type="hidden" name="id" value="<?= $data['id']; ?>">
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control <?= ($validation->hasError('title')) ? 'is-invalid' : '' ?>" name="title" id="title" value="<?= old('title', $data['title']); ?>" placeholder="Title" autofocus>
                        <div class="invalid-feedback"><?= $validation->getError('title') ?></div>
                    </div>
                    <div class="form-group">
                        <input id="body" type="hidden" value="<?= old('body', $data['body']) ?>" name="body">
                        <trix-editor input="body" style="min-height: 300px;"></trix-editor>
                        <div class="invalid-feedback"><?= $validation->getError('body') ?></div>
                    </div>
                </div>
                <div class="card-footer">
                    <!-- <button type="submit" name="submit" value="simpan" class="btn btn-primary"><i class="fa fa-save fa-fw"></i>Simpan</button> -->
                    <div class="btn-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save fa-fw"></i> Simpan</button>
                    </div>
                    <a href="/informasi" class="btn btn-default">Kembali</a>
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