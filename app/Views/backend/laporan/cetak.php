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
            <img src="<?= base_url("assets/img/indera.png"); ?>" alt="logo" class="logo">
        </div>
        <div class="title">
            <h3>Laporan</h3>
            <h4>Pembuatan SKCK Polres Gorontalo Kota</h4>
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
                    <th>Pengusul</th>
                    <th>Tgl Pengajuan</th>
                    <th>Satuan Tujuan</th>
                    <th>Keperluan</th>
                    <th>Status</th>
                    <th>Biaya</th>
                </tr>
            </thead>
            <?php
            $no = 1;
            $biaya  =   0;
            foreach ($pengajuan as $p) :
                if ($p->status == "3") {
                    $biaya += 30000;
                }
            ?>
                <tbody>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $p->no_identitas . "<br>" . $p->nama; ?></td>
                        <td><?= tgl_indonesia($p->tgl_pengajuan); ?></td>
                        <td><?= $p->nama_satuan; ?></td>
                        <td><?= $p->keperluan; ?></td>
                        <td><?= statusPengajuan($p->status, false); ?></td>
                        <td>
                            <?= ($p->status == "3") ? 'Rp. 30.000' : ''; ?>
                        </td>
                    </tr>
                </tbody>
            <?php endforeach; ?>
            <tfoot>
                <tr>
                    <td colspan="6">Total</td>
                    <td><?= rupiah($biaya); ?></td>
                </tr>
            </tfoot>
        </table>
    </main>
</body>
<script>
    window.print();
</script>

</html>