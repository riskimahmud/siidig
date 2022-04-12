<?= $this->extend('layout/top_nav'); ?>

<?= $this->section('content'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-purple shadow-lg">
            <div class="card-body">
                <?= form_open('', ['autocomplete' => 'off', 'method' => 'get', 'class' => 'form-horizontal']); ?>
                <div class="row">


                    <div class="col-md-3">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label text-left text-md-right">Kab/Kota</label>
                            <div class="col-sm-8">
                                <select name="kabkota" class="custom-select">
                                    <option value="">Semua</option>
                                    <?php foreach ($kabkota as $kk) : ?>
                                        <option value="<?= $kk['id'] ?>" <?= (($filter) && ($filter['kabkota'] == $kk['id'])) ? 'selected' : '' ?>>
                                            <?= $kk['nama_kabkota'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label text-left text-md-right">Dari</label>
                            <div class="col-sm-8">
                                <select name="dari_tahun" class="custom-select">
                                    <option value="">Pilih</option>
                                    <?php for ($i = date("Y"); $i >= 2016; $i--) : ?>
                                        <option value="<?= $i ?>" <?= (($filter) && ($filter['dari_tahun'] == $i)) ? 'selected' : '' ?>>
                                            <?= $i ?>
                                        </option>
                                    <?php endfor ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label text-left text-md-right">Sampai</label>
                            <div class="col-sm-8">
                                <select name="sampai_tahun" class="custom-select">
                                    <option value="">Pilih</option>
                                    <?php for ($i = date("Y"); $i >= 2016; $i--) : ?>
                                        <option value="<?= $i ?>" <?= (($filter) && ($filter['dari_tahun'] == $i)) ? 'selected' : '' ?>>
                                            <?= $i ?>
                                        </option>
                                    <?php endfor ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search fa-fw"></i> Cari
                        </button>
                    </div>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>

<?php if (!empty($data)) : ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card bg-transparent">
                <div class="card-header p-0 border-bottom-0 text-md">
                    <ul class="nav nav-tabs" id="custom-tabs-investasi-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-investasi-home-tab" data-toggle="pill" href="#custom-tabs-investasi-home" role="tab" aria-controls="custom-tabs-investasi-home" aria-selected="true">Grafik</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-investasi-profile-tab" data-toggle="pill" href="#custom-tabs-investasi-profile" role="tab" aria-controls="custom-tabs-investasi-profile" aria-selected="false">Tabel</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="tab-content" id="custom-tabs-investasi-tabContent">
                <div class="tab-pane fade show active" id="custom-tabs-investasi-home" role="tabpanel" aria-labelledby="custom-tabs-investasi-home-tab">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-outline card-purple card-tabs shadow-lg">
                                <div class="card-body">
                                    <div id="canvas"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-7">
                            <div class="card card-outline card-purple shadow-lg">
                                <div class="card-body">
                                    <div id="tk_unitusaha"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="card card-outline card-purple shadow-lg">
                                <div class="card-body">
                                    <div id="tenagaKerja"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="card card-outline card-purple shadow-lg">
                                <div class="card-body">
                                    <div id="industri"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="custom-tabs-investasi-profile" role="tabpanel" aria-labelledby="custom-tabs-investasi-profile-tab">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Nilai Investasi Start-->
                            <div class="card card-outline card-purple mb-5">
                                <div class="card-header p-1">
                                    <h6 class="text-center display-5 p-2 text-bold">Rekap Nilai Investasi</h6>
                                </div>
                                <div class="card-body table-responsive p-0">
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
                                </div>
                            </div>
                            <!-- Nilai Investasi End -->

                            <!-- Nilai Produksi Start -->
                            <div class="card card-outline card-purple mb-5">
                                <div class="card-header p-1">
                                    <h6 class="text-center display-5 p-2 text-bold">Rekap Nilai Produksi</h6>
                                </div>
                                <div class="card-body table-responsive p-0">

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
                                </div>
                            </div>
                            <!-- Nilai Produksi End -->

                            <!-- Unit Usaha Start -->
                            <div class="card card-outline card-purple mb-5">
                                <div class="card-header p-1">
                                    <h6 class="text-center display-5 p-2 text-bold mb-2">Rekap Unit Usaha</h6>
                                </div>
                                <div class="card-body table-responsive p-0">

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
                                </div>
                            </div>
                            <!-- Unit Usaha End -->

                            <!-- Tenaga Kerja Start -->
                            <div class="card card-outline card-purple mb-5">
                                <div class="card-header p-1">
                                    <h6 class="text-center display-5 p-2 text-bold mb-2">Rekap Tenaga Kerja</h6>
                                </div>
                                <div class="card-body table-responsive p-0">

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
                                </div>
                            </div>
                            <!-- Tenaga Kerja End -->

                            <!-- Tenaga Kerja Gender Start -->
                            <div class="card card-outline card-purple mb-5">
                                <div class="card-header p-1">
                                    <h6 class="text-center display-5 p-2 text-bold mb-2">Rekap Tenaga Kerja (Gender)</h6>
                                </div>
                                <div class="card-body table-responsive p-0">

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
                                </div>
                            </div>
                            <!-- Tenaga Kerja Gender End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php else : ?>
    <div class="alert alert-info text-center" role="alert">
        <h4 class="alert-heading"><i class="fas fa-meh fa-fw"></i> Maaf!</h4>
        <p>Data investasi belum tersedia.</p>
    </div>
<?php endif; ?>

<?= $this->endSection() ?>

<?= $this->section('css') ?>
<style>
    .hijau {
        color: green;
        font-weight: bold;
        font-size: large;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
    Highcharts.setOptions({
        lang: {
            thousandsSep: '.'
        }
    });

    Highcharts.chart('canvas', {

        title: {
            text: '<?= $title_chart; ?>'
        },

        subtitle: {
            // text: 'Sumber data: SIIDIG (Sistem Informasi Industri Gorontalo)'
            text: 'Semua data di grafik belum ditambah (.000)'
        },

        tooltip: {
            useHTML: true,
            valuePrefix: 'Rp. ',
            // pointFormat: '{point.y:,.0f}'
            backgroundColor: {
                linearGradient: [0, 0, 0, 60],
                stops: [
                    [0, '#FFFFFF'],
                    [1, '#E0E0E0']
                ]
            },
            borderWidth: 1,
            borderColor: '#AAA',
            formatter: function() {
                var prevPoint = this.point.x == 0 ? null : this.series.data[this.point.x - 1];
                var rV = `<i class="fas fa-circle" style="color:${this.series.color}"></i> <b>${this.series.name}</b>: <span class="fs-6">Rp. ${Highcharts.numberFormat(this.point.y, 0)}</span>`;
                if (prevPoint) {
                    const perkembangan = this.y - prevPoint.y;
                    if (perkembangan > 0) {
                        rV += '<br><i class="fas fa-long-arrow-alt-up fa-2x text-success"></i> Rp.' + Highcharts.numberFormat(Math.abs(perkembangan.toFixed(1)), 0);
                    } else if (perkembangan < 0) {
                        rV += '<br><i class="fas fa-long-arrow-alt-down fa-2x text-danger"></i> Rp.' + Highcharts.numberFormat(Math.abs(perkembangan.toFixed(1)), 0);
                    }
                }
                return rV;
            },
        },
        plotOptions: {
            scatter: {
                marker: {
                    radius: 5
                }
            }
        },

        yAxis: {
            title: {
                text: 'Dalam Rupiah'
            }
        },

        xAxis: {
            categories: <?= json_encode($xaxis); ?>
        },

        legend: {
            layout: 'horizontal',
            align: 'center',
            verticalAlign: 'bottom'
        },

        series: <?= json_encode($series, JSON_NUMERIC_CHECK) ?>,

        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        },
        credits: {
            text: 'SIIDIG',
            // href: 'http://www.yourcompany.com'
        }
    });

    Highcharts.chart('tk_unitusaha', {

        title: {
            text: 'Statistik Tenaga Kerja dan Unit Usaha'
        },

        tooltip: {
            useHTML: true,
            valuePrefix: 'Rp. ',
            // pointFormat: '{point.y:,.0f}'
            backgroundColor: {
                linearGradient: [0, 0, 0, 60],
                stops: [
                    [0, '#FFFFFF'],
                    [1, '#E0E0E0']
                ]
            },
            borderWidth: 1,
            borderColor: '#AAA',
            formatter: function() {
                var prevPoint = this.point.x == 0 ? null : this.series.data[this.point.x - 1];
                var rV = `<i class="fas fa-circle" style="color:${this.series.color}"></i> <b>${this.series.name}</b>: <span class="fs-6">${Highcharts.numberFormat(this.point.y, 0)}</span>`;
                if (prevPoint) {
                    const perkembangan = this.y - prevPoint.y;
                    if (perkembangan > 0) {
                        rV += '<br><i class="fas fa-long-arrow-alt-up fa-2x text-success"></i>' + Highcharts.numberFormat(Math.abs(perkembangan.toFixed(1)), 0);
                    } else if (perkembangan < 0) {
                        rV += '<br><i class="fas fa-long-arrow-alt-down fa-2x text-danger"></i>' + Highcharts.numberFormat(Math.abs(perkembangan.toFixed(1)), 0);
                    }
                }
                return rV;
            },
        },
        plotOptions: {
            scatter: {
                marker: {
                    radius: 5
                }
            }
        },

        yAxis: {
            title: {
                text: ''
            }
        },

        xAxis: {
            categories: <?= json_encode($xaxis); ?>
        },

        legend: {
            layout: 'horizontal',
            align: 'center',
            verticalAlign: 'bottom'
        },

        series: <?= json_encode($series_tk_unitusaha, JSON_NUMERIC_CHECK) ?>,

        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        },
        credits: {
            text: 'SIIDIG',
            // href: 'http://www.yourcompany.com'
        }
    });

    // pie chart
    Highcharts.chart('tenagaKerja', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Jumlah Tenaga Kerja'
        },
        tooltip: {
            pointFormat: '{point.y} Orang<br><b>{point.percentage:.1f}%</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                }
            }
        },
        series: [{
            name: '',
            colorByPoint: true,
            data: <?= json_encode($series_tk_now, JSON_NUMERIC_CHECK) ?>
        }],
        credits: {
            text: 'SIIDIG',
            // href: 'http://www.yourcompany.com'
        }
    });

    Highcharts.chart('industri', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Nilai Investasi Berdasarkan Jenis Industri'
        },
        subtitle: {
            // text: 'Source: WorldClimate.com'
        },
        xAxis: {
            categories: <?= json_encode($xaxis); ?>,
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Rupiah'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>Rp.{point.y}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: <?= json_encode($series_industri, JSON_NUMERIC_CHECK) ?>,
        credits: {
            text: 'SIIDIG',
            // href: 'http://www.yourcompany.com'
        }
    });
</script>
<?= $this->endSection() ?>