<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak PDF</title>
    <style>
        table {
            width: 100%;
            border: 1px solid black;
            border-collapse: collapse;
        }

        table tr {
            border: 1px solid black;
            border-collapse: collapse;
        }

        table tr th,
        table tr td {
            border: 1px solid black;
        }

        table tbody tr td {
            text-align: center;
        }

        table tbody tr td:nth-child(2) {
            text-align: left;
        }

        td,
        th {
            padding: 2px 4px;
        }
    </style>
</head>

<body>
    <h3><?= strtoupper($title); ?></h3>
    <?php
    if ($id == "investasi") { // untuk investasi
    ?>
        <table class="table table-sm table-bordered table-striped text-center align-items-center">
            <thead>
                <tr>
                    <th rowspan="2">No.</th>
                    <th rowspan="2">Kab / Kota</th>
                    <th colspan="<?= count($tahun_tabel) ?>">Nilai Investasi</th>
                </tr>
                <tr>
                    <?php foreach ($tahun_tabel as $tt) : ?>
                        <th><?= $tt->tahun; ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $no_ti = 1;
                $col_ti = [];
                foreach ($tabel_investasi as $kabkota => $ti) : ?>
                    <?php //d($kabkota); 
                    ?>
                    <tr>
                        <td><?= $no_ti; ?></td>
                        <td class="text-left"><?= $kabkota; ?></td>
                        <?php
                        // $column = 0;
                        foreach ($ti as $ti) {
                            // $col_ti[$column] = $ti;
                        ?>
                            <td><?= angkaInvestasi($ti, false); ?></td>
                        <?php
                            // $column++;
                        }
                        ?>
                    </tr>
                <?php $no_ti++;
                endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="2">Jumlah</th>
                    <?php foreach ($tahun_tabel as $ind => $tt) : ?>
                        <th>
                            <?php echo angkaInvestasi(array_sum(array_column($tabel_investasi, $ind)), false); ?>
                        </th>
                    <?php endforeach; ?>
                </tr>
            </tfoot>
        </table>
    <?php
    } elseif ($id == "produksi") { // untuk produksi
    ?>
        <table class="table table-sm table-bordered table-striped text-center">
            <thead>
                <tr>
                    <th rowspan="2">No.</th>
                    <th rowspan="2">Kab / Kota</th>
                    <th colspan="<?= count($tahun_tabel) ?>">Nilai Produksi</th>
                </tr>
                <tr>
                    <?php foreach ($tahun_tabel as $tt) : ?>
                        <th><?= $tt->tahun; ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $no_ti = 1;
                $col_ti = [];
                foreach ($tabel_produksi as $kabkota => $ti) : ?>
                    <?php //d($kabkota); 
                    ?>
                    <tr>
                        <td><?= $no_ti; ?></td>
                        <td class="text-left"><?= $kabkota; ?></td>
                        <?php
                        // $column = 0;
                        foreach ($ti as $ti) {
                            // $col_ti[$column] = $ti;
                        ?>
                            <td><?= angkaInvestasi($ti, false); ?></td>
                        <?php
                            // $column++;
                        }
                        ?>
                    </tr>
                <?php $no_ti++;
                endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="2">Jumlah</th>
                    <?php foreach ($tahun_tabel as $ind => $tt) : ?>
                        <th>
                            <?php echo angkaInvestasi(array_sum(array_column($tabel_produksi, $ind)), false); ?>
                        </th>
                    <?php endforeach; ?>
                </tr>
            </tfoot>
        </table>
    <?php
    } elseif ($id == "unit_usaha") { // untuk unit usaha
    ?>
        <table class="table table-sm table-bordered table-striped table-condensed text-center">
            <thead>
                <tr>
                    <th rowspan="2">No.</th>
                    <th rowspan="2">Kab / Kota</th>
                    <th colspan="<?= count($tahun_tabel) ?>">Unit Usaha</th>
                </tr>
                <tr>
                    <?php foreach ($tahun_tabel as $tt) : ?>
                        <th><?= $tt->tahun; ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $no_ti = 1;
                $col_ti = [];
                foreach ($tabel_unit_usaha as $kabkota => $ti) : ?>
                    <?php //d($kabkota); 
                    ?>
                    <tr>
                        <td><?= $no_ti; ?></td>
                        <td class="text-left"><?= $kabkota; ?></td>
                        <?php
                        // $column = 0;
                        foreach ($ti as $ti) {
                            // $col_ti[$column] = $ti;
                        ?>
                            <td><?= angkaInvestasi($ti, false); ?></td>
                        <?php
                            // $column++;
                        }
                        ?>
                    </tr>
                <?php $no_ti++;
                endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="2">Jumlah</th>
                    <?php foreach ($tahun_tabel as $ind => $tt) : ?>
                        <th>
                            <?php echo angkaInvestasi(array_sum(array_column($tabel_unit_usaha, $ind)), false); ?>
                        </th>
                    <?php endforeach; ?>
                </tr>
            </tfoot>
        </table>
    <?php
    } elseif ($id == "tenaga_kerja") { // untuk tenaga kerja
    ?>
        <table class="table table-sm table-bordered table-striped table-condensed text-center">
            <thead>
                <tr>
                    <th rowspan="2">No.</th>
                    <th rowspan="2">Kab / Kota</th>
                    <th colspan="<?= count($tahun_tabel) ?>">Tenaga Kerja</th>
                </tr>
                <tr>
                    <?php foreach ($tahun_tabel as $tt) : ?>
                        <th><?= $tt->tahun; ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $no_ti = 1;
                $col_ti = [];
                foreach ($tabel_tk as $kabkota => $ti) : ?>
                    <?php //d($kabkota); 
                    ?>
                    <tr>
                        <td><?= $no_ti; ?></td>
                        <td class="text-left"><?= $kabkota; ?></td>
                        <?php
                        // $column = 0;
                        foreach ($ti as $ti) {
                            // $col_ti[$column] = $ti;
                        ?>
                            <td><?= angkaInvestasi($ti, false); ?></td>
                        <?php
                            // $column++;
                        }
                        ?>
                    </tr>
                <?php $no_ti++;
                endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="2">Jumlah</th>
                    <?php foreach ($tahun_tabel as $ind => $tt) : ?>
                        <th>
                            <?php echo angkaInvestasi(array_sum(array_column($tabel_tk, $ind)), false); ?>
                        </th>
                    <?php endforeach; ?>
                </tr>
            </tfoot>
        </table>
    <?php
    } elseif ($id == "tenaga_kerja_gender") { // untuk tenaga kerja (gender)
    ?>
        <table class="table table-sm table-bordered table-striped table-condensed text-center">
            <thead>
                <tr>
                    <th rowspan="3">No.</th>
                    <th rowspan="3">Kab / Kota</th>
                    <th colspan="<?= count($tahun_tabel) * 2 ?>">Tenaga Kerja</th>
                </tr>
                <tr>
                    <?php foreach ($tahun_tabel as $tt) : ?>
                        <th colspan="2"><?= $tt->tahun; ?></th>
                    <?php endforeach; ?>
                </tr>
                <tr>
                    <?php foreach ($tahun_tabel as $tt) : ?>
                        <th>L</th>
                        <th>P</th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $no_ti = 1;
                $col_ti = [];
                foreach ($tabel_tk_gender as $kabkota => $ti) : ?>
                    <?php //d($kabkota); 
                    ?>
                    <tr>
                        <td><?= $no_ti; ?></td>
                        <td class="text-left"><?= $kabkota; ?></td>
                        <?php
                        // $column = 0;
                        foreach ($ti as $ti) {
                            // $col_ti[$column] = $ti;
                        ?>
                            <td><?= angkaInvestasi($ti, false); ?></td>
                        <?php
                            // $column++;
                        }
                        ?>
                    </tr>
                <?php $no_ti++;
                endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="2">Jumlah</th>
                    <?php for ($i = 0; $i < count($tahun_tabel) * 2; $i++) {
                        # code...
                    ?>
                        <th>
                            <?php echo angkaInvestasi(array_sum(array_column($tabel_tk_gender, $i)), false); ?>
                        </th>
                    <?php } ?>
                </tr>
            </tfoot>
        </table>
    <?php
    }
    ?>
</body>

</html>