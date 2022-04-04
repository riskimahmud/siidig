<?= $this->extend('layout/top_nav'); ?>

<?= $this->section('content'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-red">
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
            <div class="card card-outline card-primary">
                <div class="card-body">
                    <div id="canvas"></div>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="card card-outline card-info">
                <div class="card-body">
                    <div id="tk_unitusaha"></div>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card card-outline card-dark">
                <div class="card-body">
                    <div id="tenagaKerja"></div>
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
</script>
<?= $this->endSection() ?>