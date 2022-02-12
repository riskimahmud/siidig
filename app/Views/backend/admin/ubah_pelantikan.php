<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <?= form_open("", ["class" => "form form-horizontal", "autocomplete" => "off"]); ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="no_surat_tim_penilai">No. Surat Tim Penilai</label>
                            <input type="text" name="no_surat_tim_penilai" id="no_surat_tim_penilai" class="form-control <?= ($validation->hasError('no_surat_tim_penilai')) ? 'is-invalid' : ''; ?>" required="required" value="<?= set_value('no_surat_tim_penilai', $data->no_surat_tim_penilai); ?>">
                            <div class="invalid-feedback"><?= $validation->getError('no_surat_tim_penilai'); ?></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="tgl_surat_tim_penilai">Tgl Surat Tim Penilai</label>
                            <input type="text" name="tgl_surat_tim_penilai" id="tgl_surat_tim_penilai" class="form-control <?= ($validation->hasError('tgl_surat_tim_penilai')) ? 'is-invalid' : ''; ?> datepicker" data-toggle="datetimepicker" data-target="#tgl_surat_tim_penilai" value="<?= set_value('tgl_surat_tim_penilai', $data->tgl_surat_tim_penilai); ?>" required="required">
                            <div class="invalid-feedback"><?= $validation->getError('tgl_surat_tim_penilai'); ?></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="no_surat">No. Surat Pelantikan</label>
                            <input type="text" name="no_surat" id="no_surat" class="form-control <?= ($validation->hasError('no_surat')) ? 'is-invalid' : ''; ?>" required="required" value="<?= set_value('no_surat', $data->no_surat); ?>">
                            <div class="invalid-feedback"><?= $validation->getError('no_surat'); ?></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="tgl_surat">Tgl Surat Pelantikan</label>
                            <input type="text" name="tgl_surat" id="tgl_surat" class="form-control <?= ($validation->hasError('tgl_surat')) ? 'is-invalid' : ''; ?> datepicker" data-toggle="datetimepicker" data-target="#tgl_surat" value="<?= set_value('tgl_surat', $data->tgl_surat); ?>" required="required">
                            <div class="invalid-feedback"><?= $validation->getError('tgl_surat'); ?></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="tgl_pelantikan">Tgl Pelantikan</label>
                            <input type="text" name="tgl_pelantikan" id="tgl_pelantikan" class="form-control <?= ($validation->hasError('tgl_pelantikan')) ? 'is-invalid' : ''; ?> datepicker" data-toggle="datetimepicker" data-target="#tgl_pelantikan" value="<?= set_value('tgl_pelantikan', $data->tgl_pelantikan); ?>" required="required">
                            <div class="invalid-feedback"><?= $validation->getError('tgl_pelantikan'); ?></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="tgl_berlaku">Tgl Berlaku</label>
                            <input type="text" name="tgl_berlaku" id="tgl_berlaku" class="form-control <?= ($validation->hasError('tgl_berlaku')) ? 'is-invalid' : ''; ?> datepicker" data-toggle="datetimepicker" data-target="#tgl_berlaku" value="<?= set_value('tgl_berlaku', $data->tgl_berlaku); ?>" required="required">
                            <div class="invalid-feedback"><?= $validation->getError('tgl_berlaku'); ?></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <b class="card-title"><i class="far fa-edit fa-fw"></i> Mengingat</b>
                    <div class="card-tools">
                        <a class="btn btn-primary btn-xs" href="javascript:void(0)" id="addMengingat"><i class="fas fa-plus-circle fa-fw"></i> Tambah</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row" id="box-mengingat">
                        <?php
                        $mengingat = json_decode($data->mengingat);
                        echo "<input type='hidden' id='jumMengingat' value='" . (count($mengingat) + 1) . "'>";
                        $noMengingat = 1;
                        foreach ($mengingat as $meng) :
                        ?>
                            <div class="col-12 d-flex mb-4 align-items-baseline" id="formMengingat<?= $noMengingat; ?>">
                                <i class="fas <?= ($noMengingat == "1") ? 'fa-square-full text-primary' : 'fa-trash-alt text-danger'; ?> <?= ($noMengingat > "1") ? 'hapusMengingat' : '' ?> mr-1" data-input="#formMengingat<?= $noMengingat; ?>" <?= ($noMengingat > "1") ? "style='cursor:pointer'" : ""; ?>></i>
                                <textarea name="mengingat[]" id="mengingat" rows="2" class="form-control" required="required"><?= $meng; ?></textarea>
                            </div>
                        <?php
                            $noMengingat++;
                        endforeach;
                        ?>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <b class="card-title"><i class="far fa-edit fa-fw"></i> Menimbang</b>
                    <div class="card-tools">
                        <a class="btn btn-primary btn-xs" href="javascript:void(0)" id="addMenimbang"><i class="fas fa-plus-circle fa-fw"></i> Tambah</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row" id="box-menimbang">
                        <?php
                        $menimbang = json_decode($data->menimbang);
                        echo "<input type='hidden' id='jumMenimbang' value='" . (count($menimbang) + 1) . "'>";
                        $noMenimbang = 1;
                        foreach ($menimbang as $men) :
                        ?>
                            <div class="col-12 d-flex mb-4 align-items-baseline" id="formMenimbang<?= $noMenimbang; ?>">
                                <i class="fas <?= ($noMenimbang == "1") ? 'fa-square-full text-primary' : 'fa-trash-alt text-danger'; ?> <?= ($noMenimbang > "1") ? 'hapusMenimbang' : '' ?> mr-1" data-input="#formMenimbang<?= $noMenimbang; ?>" <?= ($noMenimbang > "1") ? "style='cursor:pointer'" : ""; ?>></i>
                                <textarea name="menimbang[]" id="menimbang" rows="2" class="form-control" required="required"><?= $men; ?></textarea>
                            </div>
                        <?php
                            $noMenimbang++;
                        endforeach;
                        ?>
                    </div>
                </div>
            </div>

            <div class="form-group mt-4">
                <button name="submit" value="simpan" type="submit" class="btn btn-primary"><i class="fas fa-save fa-fw"></i> Simpan</button>
                <a href="<?= base_url("spt-pelantikan"); ?>" class="btn btn-default ml-2">Kembali</a>
            </div>
        </div>
    </div>
    <?= form_close(); ?>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
    let idMengingat = $("#jumMengingat").val();

    $("#addMengingat").on("click", function() {
        let contentAdd = `
        <div class="col-12 d-flex mb-4 align-items-baseline" id="formMengingat${idMengingat}">
        <i class="far fa-trash-alt text-danger mr-1 hapusMengingat" data-input="#formMengingat${idMengingat}" style="cursor:pointer"></i>
        <textarea name="mengingat[]" id="mengingat" rows="2" class="form-control" required="required"></textarea>
        </div>
        `;
        $("#box-mengingat").append(contentAdd);
        idMengingat++;
    })

    $("#box-mengingat").on("click", ".hapusMengingat", function() {
        let content = $(this).data("input");
        $(content).remove();
    })

    // let idMenimbang = 1;
    let idMenimbang = $("#jumMenimbang").val();

    $("#addMenimbang").on("click", function() {
        let contentAdd = `
        <div class="col-12 d-flex mb-4 align-items-baseline" id="formMenimbang${idMenimbang}">
            <i class="far fa-trash-alt text-danger mr-1 hapusMenimbang" data-input="#formMenimbang${idMenimbang}" style="cursor:pointer"></i>
            <textarea name="menimbang[]" id="menimbang" rows="2" class="form-control" required="required"></textarea>
        </div>
        `;
        $("#box-menimbang").append(contentAdd);
        idMenimbang++;
    })

    $("#box-menimbang").on("click", ".hapusMenimbang", function() {
        let content = $(this).data("input");
        $(content).remove();
    })
</script>
<?= $this->endSection(); ?>