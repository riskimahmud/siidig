<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="card shadow">
                <div class="card-header">
                    <h1 class="card-title"><?= $title; ?></h1>
                </div>
                <!-- form start -->
                <?= form_open($base . "/verifikasi_import", ["class" => "form form-horizontal", "autocomplete" => "", "enctype" => "multipart/form-data"]); ?>
                <div class="card-body">
                    <?php d($data); ?>
                    <table class="table table-sm">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Umur</th>
                            <th>Hobi</th>
                        </tr>
                        <?php $no = 1;
                        foreach ($data as $d) : ?>
                            <tr class="red-tooltip <?= (isset($d['error'])) ? 'bg-red' : '' ?>" <?php if (isset($d['error'])) : ?> data-toggle="tooltip" data-placement="top" title="Some tooltip text!" <?php endif; ?>>
                                <td><?= $no++; ?></td>
                                <td><?= $d['nama']; ?></td>
                                <td><?= $d['umur']; ?></td>
                                <td><?= $d['hobi']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" name="submit" value="simpan" class="btn btn-primary"><i class="fa fa-save fa-fw"></i>Simpan</button>
                <a href="<?= base_url($base); ?>" class="btn btn-default">Kembali</a>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script'); ?>
<script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
<?= $this->endSection(); ?>