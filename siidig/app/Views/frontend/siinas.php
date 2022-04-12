<?= $this->extend('layout/top_nav'); ?>

<?= $this->section('content'); ?>
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card card-outline card-purple">
            <div class="card-body">
                <!-- <h6 class="text-center">Perusahaan Yang Terdaftar di SIINAS</h6> -->
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Perusahaan</th>
                                <th>Alamat Kantor</th>
                                <th>Alamat Pabrik</th>
                                <th>Kode KBLI</th>
                                <th>Bidang Usaha</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($data as $t) {
                            ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $t['nama_perusahaan'] ?></td>
                                    <td><?= $t['alamat_kantor'] ?></td>
                                    <td><?= $t['alamat_pabrik'] ?></td>
                                    <td><?= $t['kode_kbli'] ?></td>
                                    <td><?= $t['bidang_usaha'] ?></td>
                                </tr>
                            <?php
                                $no++;
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>