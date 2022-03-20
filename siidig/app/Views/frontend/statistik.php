<?= $this->extend('layout/frontend'); ?>

<?= $this->section('content'); ?>

<?= $this->include('frontend/header'); ?>

<section class="breadcrumb-area banner-2">
    <div class="text-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 v-center">
                    <div class="bread-inner">
                        <div class="bread-title">
                            <h2>Statistik</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- <div class="statistics-wrap bg-gradient5">
    <div class="container">
        <div class="row small t-ctr mt0">
            <div class="col-lg-3 col-sm-6">
                <div class="statistics">
                    <div class="statistics-img">
                        <img src="/assets_front/images/icons/house.svg" alt="happy" class="img-fluid">
                    </div>
                    <div class="statnumb">
                        <span class="counter"><?= round(singkat_angka($count->unit_usaha, 'angka')); ?></span><span><?= singkat_angka($count->unit_usaha, 'simbol'); ?></span>
                        <p>Unit Usaha</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="statistics">
                    <div class="statistics-img">
                        <img src="/assets_front/images/icons/teama.svg" alt="project" class="img-fluid">
                    </div>
                    <div class="statnumb counter-number">
                        <span class="counter"><?= round(singkat_angka($count->tenaga_kerja, 'angka')); ?></span><span><?= singkat_angka($count->tenaga_kerja, 'simbol'); ?></span>
                        <p>Tenaga Kerja</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="statistics">
                    <div class="statistics-img">
                        <img src="/assets_front/images/icons/money.svg" alt="work" class="img-fluid">
                    </div>
                    <div class="statnumb">
                        <span class="counter"><?= round(singkat_angka($count->nilai_investasi . "000", 'angka')); ?></span><span><?= singkat_angka($count->nilai_investasi . "000", 'simbol'); ?></span>
                        <p>Nilai Investasi</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="statistics mb0">
                    <div class="statistics-img">
                        <img src="/assets_front/images/icons/money-growth.svg" alt="support" class="img-fluid">
                    </div>
                    <div class="statnumb">
                        <span class="counter"><?= round(singkat_angka($count->nilai_produksi . "000", 'angka')); ?></span><span><?= singkat_angka($count->nilai_produksi . "000", 'simbol'); ?></span>
                        <p>Nilai Produksi</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->

<section class="service-block pad-tb light-dark">
    <div class="container">
        <!-- <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="common-heading ptag"> -->
        <!-- <h2>Statistik Industri</h2> -->
        <!-- <p>Our design process follows a proven approach. We begin with a deep understanding of your needs and create a planning template.</p> -->
        <!-- </div>
            </div>
        </div> -->

        <?= form_open('', ['autocomplete' => 'off', 'method' => 'get']); ?>
        <div class="row upset link-hover">
            <div class="col-lg-12 text-center">
                <h4>
                    Filter Data Industri
                </h4>
            </div>
            <div class="col-lg-4 col-md-12 mt10">
                <div class="form-floating mb-3">
                    <select name="kabkota" class="form-select" id="floatingSelect" aria-label="Floating label select example">
                        <option value="" selected>Semua</option>
                        <?php foreach ($kabkota as $kk) : ?>
                            <option value="<?= $kk['id'] ?>" <?= (($filter) && ($filter['kabkota'] == $kk['id'])) ? 'selected' : '' ?>>
                                <?= $kk['nama_kabkota'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <label for="floatingSelect">Kab / Kota</label>
                </div>
            </div>
            <div class="col-lg-3 col-md-12 mt10">
                <div class="form-floating mb-3">
                    <select name="dari_tahun" class="form-select" id="floatingSelect" aria-label="Floating label select example">
                        <option value="" selected>Pilih</option>
                        <?php for ($i = date("Y"); $i >= 2016; $i--) : ?>
                            <option value="<?= $i ?>" <?= (($filter) && ($filter['dari_tahun'] == $i)) ? 'selected' : '' ?>>
                                <?= $i ?>
                            </option>
                        <?php endfor ?>
                    </select>
                    <label for="floatingSelect">Dari Tahun</label>
                </div>
            </div>
            <div class="col-lg-3 col-md-12 mt10">
                <div class="form-floating mb-3">
                    <select name="sampai_tahun" class="form-select" id="floatingSelect" aria-label="Floating label select example">
                        <option value="" selected>Pilih</option>
                        <?php for ($i = date("Y"); $i >= 2016; $i--) : ?>
                            <option value="<?= $i ?>" <?= (($filter) && ($filter['sampai_tahun'] == $i)) ? 'selected' : '' ?>>
                                <?= $i ?>
                            </option>
                        <?php endfor ?>
                    </select>
                    <label for="floatingSelect">Sampai Tahun</label>
                </div>
            </div>
            <div class="col-lg-2 mt10">
                <button type="submit" class="niwax-btn3">Cari</button>
            </div>
        </div>
    </div>
    <?= form_close(); ?>

    <div class="container">
        <?php if (!empty($data)) : ?>
            <div class="row justify-content-center mb-5">
                <div class="col-lg-12 mt30">
                    <div class="s-block bd-hor-base">
                        <div class="nn-card-set">
                            <div id="canvas"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-7">
                    <div class="s-block bd-hor-base px-1 py-1 m-0">
                        <div class="nn-card-set">
                            <div class="p-0 m-0" id="tk_unitusaha"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="s-block bd-hor-base px-1 py-1 m-0">
                        <div class="nn-card-set">
                            <div class="p-0 m-0" id="tenagaKerja"></div>
                        </div>
                    </div>
                </div>
            </div>
        <?php else : ?>
            <div class="alert alert-info mt-4 text-center" role="alert">
                <h4 class="alert-heading"><i class="fas fa-meh fa-fw"></i> Maaf!</h4>
                <p>Data investasi belum tersedia.</p>
            </div>
            <!-- <div class="bg-gradient2 pt60 pb60 mt30 mb30 text-w">
                <h4>Maaf. Data belum ada. <i class="fas fa-meh"></i></h4>
            </div> -->
        <?php endif; ?>
    </div>
</section>
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