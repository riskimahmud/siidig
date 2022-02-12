    <div class="col-12">
        <div class="alert alert-info">
            <i class="fas fa-info-circle fa-fw"></i> <?= count($data); ?> Jabatan Kosong
        </div>
    </div>
    <div class="col-12">
        <div class="card" id="dataJabatanKosong">
            <div class="card-body table-responsive">
                <table class="table table-hover table-striped text-nowrap" id="dataTable">
                    <thead>
                        <tr>
                            <th width="10">No</th>
                            <th>Jabatan</th>
                            <th>Jenis</th>
                            <th>Unit Kerja</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($data as $d) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td>
                                    <?php
                                    if ($d->pelaksana != "00.00.000") {
                                        echo $d->nmpelaksana;
                                    }

                                    if ($d->fungsional != "0") {
                                        echo $d->nmfungsional;
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($d->pelaksana != "00.00.000") {
                                        echo "Administrasi";
                                    }

                                    if ($d->fungsional != "0") {
                                        echo "Fungsional";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?= getFieldSimpeg("unor", "unorname", ["unorid" => $d->unor]); ?>
                                </td>
                                <td>
                                    <a target="_blank" href="<?= base_url("detail-jabatan/" . $d->id); ?>" class="btn btn-info badge" title="Detail">
                                        <i class="fas fa-list fa-fw"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>