<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan</title>
    <link rel="stylesheet" href="<?= base_url("assets/css/laporan.css"); ?>">
</head>

<body>
    <header>
        <div class="logo">
            <img src="<?= base_url("assets/img/logo-gorontalokota.png"); ?>" alt="logo" class="logo">
        </div>
        <div class="title">
            <h3>Laporan</h3>
            <h4>Pembuatan SPT di SimPATI Kota GOrontalo</h4>
        </div>
        <div class="logo">
            <!-- <img src="<?= base_url("assets/img/indera.png"); ?>" alt="logo" class="logo"> -->
        </div>
    </header>

    <main>
        <h5 class="title">
            Dicetak pada tanggal : <?= tgl_indonesia(date("Y-m-d")); ?>
        </h5>

        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Pegawai</th>
                    <th>Asal</th>
                    <th>Tujuan</th>
                    <th>Tgl Pengajuan / TMT</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($data as $d) :
                ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td>
                            <?= $d->nip; ?><br>
                            <?= $d->nama; ?><br>
                            <?= $d->pangkat; ?>
                        </td>
                        <td>
                            <?= $d->nama_jabatan_lama; ?><br>
                            <?= $d->unorname_lama; ?><br>
                            <?= $d->unit_organisasi_lama; ?>
                        </td>
                        <td>
                            <?= $d->nama_jabatan_baru; ?><br>
                            <?= $d->unorname_baru; ?><br>
                            <?= $d->unit_organisasi_baru; ?>
                        </td>
                        <td>
                            <?= tgl_indonesia($d->tgl_pengajuan); ?><br>
                            <?= tgl_indonesia($d->tmt); ?>
                        </td>
                        <td>
                            <?= statusPengajuan($d->status, $d->tolak, FALSE); ?>
                        </td>
                    </tr>
                <?php endforeach;
                ?>
            </tbody>
        </table>
    </main>
</body>
<script>
    window.print();
</script>

</html>