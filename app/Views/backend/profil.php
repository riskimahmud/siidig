<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="card shadow">
                <!-- /.card-header -->
                <!-- form start -->
                <?= form_open("", ["class" => "form form-horizontal", "autocomplete" => "off"]); ?>
                <input type="hidden" name="id" value="<?= $data['id']; ?>">
                <div class="card-body">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" value="<?= set_value('username', $data['username']); ?>" placeholder="Username" autofocus>
                        <div class="invalid-feedback"><?= $validation->getError('username'); ?></div>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" name="password" id="password" value="<?= set_value('password') ?>" placeholder="Password">
                            <div class="input-group-append">
                                <span class="input-group-text" id="togglePassword"><i class="fas fa-eye"></i></span>
                            </div>
                            <div class="invalid-feedback"><?= $validation->getError('password'); ?></div>
                        </div>
                        <small class="text-muted">Kosongkan jika tidak ingin mengganti</small>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" value="<?= set_value('nama', $data['nama']); ?>" placeholder="Nama">
                        <div class="invalid-feedback"><?= $validation->getError('nama'); ?></div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" value="<?= set_value('email', $data['email']); ?>" placeholder="Email">
                        <div class="invalid-feedback"><?= $validation->getError('email'); ?></div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" name="submit" value="simpan" class="btn btn-primary"><i class="fa fa-save fa-fw"></i>Simpan</button>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
    $("#togglePassword").click(function() {
        $(this).find(".fas").toggleClass("fa-eye fa-eye-slash");
        showPassword();
    });

    function showPassword() {
        const x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
<?= $this->endSection(); ?>