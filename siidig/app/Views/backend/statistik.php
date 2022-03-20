<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <?= form_open('/grafik', ['autocomplete' => 'off', 'method' => 'get']); ?>
    <div class="card">
        <div class="card-header p-2 bg-primary text-center">
            <div class="card-title">
                Sortir Data
            </div>
        </div>
        <div class="card-body p-2 shadow">
            <div class="row">
                <?php if (user('level') == "admin") : ?>
                    <div class="col-md-3">
                        <select name="kabkota" id="kabkota" class="form-control form-control-sm">
                            <option value="">Pilih Kab/Kota</option>
                            <?php foreach ($kabkota as $kk) : ?>
                                <option value="<?= $kk['id'] ?>" <?= (($filter) && ($filter['kabkota'] == $kk['id'])) ? 'selected' : '' ?>><?= $kk['nama_kabkota'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                <?php endif; ?>
                <div class="col-md-3">
                    <select name="dari_tahun" id="dari_tahun" class="form-control form-control-sm">
                        <option value="">Dari Tahun</option>
                        <?php for ($i = date("Y"); $i >= 2016; $i--) : ?>
                            <option value="<?= $i ?>" <?= (($filter) && ($filter['dari_tahun'] == $i)) ? 'selected' : '' ?>>
                                <?= $i ?>
                            </option>
                        <?php endfor ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="sampai_tahun" id="sampai_tahun" class="form-control form-control-sm">
                        <option value="">Sampai Tahun</option>
                        <?php for ($i = date("Y"); $i >= 2016; $i--) : ?>
                            <option value="<?= $i ?>" <?= (($filter) && ($filter['sampai_tahun'] == $i)) ? 'selected' : '' ?>>
                                <?= $i ?>
                            </option>
                        <?php endfor ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fas fa-filter fa-fw"></i> Sortir
                    </button>
                </div>
            </div>
        </div>
    </div>
    <?= form_close(); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div id="canvas"></div>
                </div>
            </div>
        </div>

        <!-- <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div id="industri"></div>
                </div>
            </div>
        </div> -->

        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <div id="tk_unitusaha"></div>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <div id="tenagaKerja"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script'); ?>
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

    // grafik industri
    // Highcharts.chart('industri', {
    //     chart: {
    //         type: 'column'
    //     },
    //     title: {
    //         text: 'Monthly Average Rainfall'
    //     },
    //     subtitle: {
    //         text: 'Source: WorldClimate.com'
    //     },
    //     xAxis: {
    //         categories: [
    //             'Jan',
    //             'Feb',
    //             'Mar',
    //             'Apr',
    //             'May',
    //             'Jun',
    //             'Jul',
    //             'Aug',
    //             'Sep',
    //             'Oct',
    //             'Nov',
    //             'Dec'
    //         ],
    //         crosshair: true
    //     },
    //     yAxis: {
    //         min: 0,
    //         title: {
    //             text: 'Rainfall (mm)'
    //         }
    //     },
    //     tooltip: {
    //         headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
    //         pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
    //             '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
    //         footerFormat: '</table>',
    //         shared: true,
    //         useHTML: true
    //     },
    //     plotOptions: {
    //         column: {
    //             pointPadding: 0.2,
    //             borderWidth: 0
    //         }
    //     },
    //     series: [{
    //         name: 'Tokyo',
    //         data: [49, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6]

    //     }, {
    //         name: 'New York',
    //         data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]

    //     }, {
    //         name: 'London',
    //         data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2]

    //     }, {
    //         name: 'Berlin',
    //         data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]

    //     }]
    // });
</script>
<?= $this->endSection() ?>