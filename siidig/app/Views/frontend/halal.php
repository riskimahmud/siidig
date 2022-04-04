<?= $this->extend('layout/top_nav'); ?>

<?= $this->section('content'); ?>
<div class="row">
    <div class="col-md-5">
        <div class="bg-white px-4 py-2 m-2 shadow rounded text-justify">
            <p class="text-justify">
            <ol class="m-0 p-0">
                <li>
                    Halal adalah obyek atau kegiatan yang diijinkan untuk atau dilaksanakan dalam Agama Islam dan digunakan untuk mewujudkan makanan dan minuman yang di ijinkan untuk dikonsumsi menurut syariat Islam.
                </li>
                <li>
                    Fungsi Halal yaitu memberi perlindungan Hukum Hak- Hak Konsumen Muslim terhadap produk yang tidak Halal dan mencegah konsumen Muslim mengkonsumsi produk yang tidak halal dan Bermanfaat memberikan keuntungan terhhadap Konsumen.
                </li>
                <li>
                    Manfaat bagi IKM Pangan mendapatkan Sertifikat Halal adalah ;
                    <ul>
                        <li>Menjalin Kualitas Produk.</li>
                        <li>Produk yang dihasilkan akan memiliki Nilai Jual dan salah satu cara dalam Persaingan Pasar.</li>
                        <li>Dapat memperluas Jangkauan Pasar Global.</li>
                        <li>Memberikan ketenangan terhadap Konsumen.</li>
                    </ul>
                </li>
            </ol>
            </p>

            <p class="text-justify">
                Persyaratan mendapat sertifikat Halal yaitu ;
            <ol>
                <li>Pelaku Usha harus mengikuti Pelatihan Sistim Jaminan Halal (SJH).</li>
                <li>Melakukan Pendaftaran.</li>
                <li>Melakukan monitoring pro-audit dan membayar biaya akad.</li>
                <li>Proses audit.</li>
                <li>Monitoring Pasca Audit.</li>
                <li>Mendapatkan sertfikat Halal.</li>
            </ol>
            </p>
        </div>
    </div>
    <div class="col-md-7">
        <div class="card card-outline card-primary">
            <div class="card-body">
                <h6 class="text-center">Perusahaan Yang Sudah Mendapat Fasilitasi Halal</h6>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Perusahaan</th>
                                <th>Nama Pemilik</th>
                                <th>Produk</th>
                                <th>Ukuran</th>
                                <th>Jenis Kemasan</th>
                                <th>Tahun</th>
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
                                    <td><?= $t['nama_pemilik'] ?></td>
                                    <td width='200'><?= $t['nomor_sertifikat'] ?></td>
                                    <td><?= $t['skala_usaha'] ?></td>
                                    <td><?= $t['alamat'] ?></td>
                                    <td><?= $t['tahun'] ?></td>
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