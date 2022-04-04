<?= $this->extend('layout/top_nav'); ?>

<?= $this->section('content'); ?>
<div class="row">
    <div class="col-md-5">
        <div class="bg-white p-2 m-2 shadow rounded text-justify">
            <p class="">
            <ol class="pl-4">
                <li>
                    Pengertian kemasan produk secara umum adalah suatu wadah ataupun pembungkus yang memiliki fungsi untuk mencegah ataupun meminimalisir terjadinya kerusakan pada produk yang dikemas.
                </li>
                <li>
                    Fungsi protektif dalam hal ini berfungsi sebagai sesuatu pelindung ataupun keamanan produk dari berbagai hal yang mampu merusak produk seperti cuaca, proses pengiriman, dll. Kemasan yang melindungi produk mampu mencegah atau meminimalisir adanya kerusakan dan risiko cacar yang mampu merugikan pihak pembeli atau penjual.
                </li>
                <li>
                    Fungsi protektif dalam hal ini berfungsi sebagai sesuatu pelindung ataupun keamanan produk dari berbagai hal yang mampu merusak produk seperti cuaca, proses pengiriman, dll. Kemasan yang melindungi produk mampu mencegah atau meminimalisir adanya kerusakan dan risiko cacar yang mampu merugikan pihak pembeli atau penjual.
                </li>
                <li>
                    Tips Membuat Kemasan yang Menarik.
                    <ul>
                        <li>
                            <span class="font-weight-bold d-block">Membuat Desain Kemasan yang Unik</span>
                            Salah satu hal terpenting dalam membentuk kemasan adalah Anda harus mendesain kemasan tersebut secara lebih unik, inovatif, dan juga berbeda dari produk lain. Dengan membuat kemasan yang unik, maka minat masyarakat untuk membeli produk Anda akan meningkat.Contoh sederhananya jika Anda berbelanja di supermarket dan melihat adanya deretan kemasan produk kotak dalam satu rak, lalu Anda melihat ada satu kemasan yang bentuknya bulat. Bisa dipastikan Anda akan penasaran dengan isi yang ada di dalamnya.
                        </li>
                        <li>
                            <span class="font-weight-bold d-block">Desain Kemasan Sesuai Target Market</span>
                            Usahakanlah untuk mendesain kemasan produk sesuai dengan target pasarnya. Jadi, jika target pasar Anda adalah mereka yang baru berusia 5-12 tahun, maka usahakanlah untuk membuat kemasan produk yang ditambahkan dengan tokoh atau gambar kartun yang digemari oleh anak-anak, atau Anda bisa membentuk kemasan tersebut seperti mainan.
                        </li>
                        <li>
                            <span class="font-weight-bold d-block">Membuat Kemasan dengan Beberapa Ukuran</span>
                            Jika produk yang Anda jual adalah produk yang tergolong baru, maka usahakanlah untuk membuat kemasan produk dalam berbagai variasi ukuran, seperti small, medium atau large. Masyarakat akan lebih cenderung untuk membeli kemasan yang lebih kecil dalam membeli produk baru.
                        </li>
                        <li>
                            <span class="font-weight-bold d-block">Mencantumkan Informasi Produk Secara Lengkap</span>
                            Usahakan juga untuk mencantumkan informasi produk di setiap kemasannya. Seperti komposisi produk, jenis, cara konsumsi, hingga tanggal kadaluarsa. Buatlah informasi yang jelas, padat dan singkat.
                        </li>
                    </ul>
                </li>
            </ol>
            </p>
        </div>
    </div>
    <div class="col-md-7">
        <div class="card card-outline card-primary">
            <div class="card-body">
                <h6 class="text-center">Perusahaan Yang Sudah Mendapat Fasilitasi Kemasan</h6>
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
                                    <td><?= $t['produk'] ?></td>
                                    <td><?= $t['ukuran'] ?></td>
                                    <td><?= $t['jenis_kemasan'] ?></td>
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