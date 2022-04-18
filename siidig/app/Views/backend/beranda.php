<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-6">
      <div class="bg-gradient-purple px-3 py-2 mb-2 rounded-lg shadow-lg text-lg">
        Selamat Datang di <span class="text-bold">
          SIIDIG (Sistem Informasi Industri Daerah Gorontalo)
        </span>
      </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
      <div class="info-box">
        <span class="info-box-icon bg-teal"><i class="fas fa-users"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Tenaga Kerja</span>
          <span class="info-box-number text-lg"><?= ($statistik_all) ? $statistik_all->tenaga_kerja : 0; ?></span>
        </div>
      </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
      <div class="info-box">
        <span class="info-box-icon bg-cyan"><i class="fas fa-building"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Unit Usaha</span>
          <span class="info-box-number text-lg"><?= ($statistik_all) ? $statistik_all->unit_usaha : 0 ?></span>
        </div>
      </div>
    </div>
    <?php if ($statistik_all && $statistik_all->tahun != date("Y")) : ?>
      <div class="col-12 col-md-6 mb-2">
        <div class="border border-danger px-3 py-2 rounded">
          <span class="text-danger font-weight-bold">
            <i class="fas fa-info-circle fa-fw"></i> ANDA BELUM MENGINPUT DATA INVESTASI TAHUN INI
          </span>
        </div>
      </div>
      <div class="col-12 col-md-6 mb-2">
        <div class="border border-primary px-3 py-2 rounded">
          <span class="text-primary font-weight-bold">
            <i class="fas fa-info-circle fa-fw"></i>
            YANG DITAMPILKAN DI STATISTIK ADALAH DATA TAHUN <?= $statistik_all->tahun; ?>
          </span>
        </div>
      </div>
    <?php endif; ?>
    <div class="col-12 mb-2 text-center">
      <div class="border border-info px-3 py-2 rounded">
        <span class="text-black font-weight-bold">
          <i class="fas fa-info-circle fa-fw"></i>
          Tambahkan <span class="text-primary font-weight-bolder">(000)</span> Untuk Statistik dibawah Ini. Kecuali Unit Usaha dan Tenaga Kerja
        </span>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-12">
      <!-- small card -->
      <div class="small-box bg-gradient-info shadow-sm">
        <div class="inner">
          <h3 class="mb-1"><?= ($statistik_all) ? angkaInvestasi($statistik_all->nilai_investasi) : 0; ?></h3>
          <p>Nilai Investasi</p>
        </div>
        <div class="icon">
          <i class="fas fa-business-time"></i>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-12">
      <!-- small card -->
      <div class="small-box bg-gradient-primary shadow-sm">
        <div class="inner">
          <h3 class="mb-1"><?= ($statistik_all) ? angkaInvestasi($statistik_all->jumlah_produksi) : 0; ?></h3>
          <p>Jumlah Produksi</p>
        </div>
        <div class="icon">
          <i class="fas fa-truck"></i>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-12">
      <!-- small card -->
      <div class="small-box bg-gradient-success shadow-sm">
        <div class="inner">
          <h3 class="mb-1"><?= ($statistik_all) ? angkaInvestasi($statistik_all->nilai_produksi) : 0; ?></h3>
          <p>Nilai Produksi</p>
        </div>
        <div class="icon">
          <i class="fas fa-coins"></i>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-12">
      <!-- small card -->
      <div class="small-box bg-gradient-red shadow-sm">
        <div class="inner">
          <h3 class="mb-1"><?= ($statistik_all) ? angkaInvestasi($statistik_all->nilai_bbbp) : 0; ?></h3>
          <p>Nilai BB/BP</p>
        </div>
        <div class="icon">
          <i class="fas fa-file-invoice"></i>
        </div>
      </div>
    </div>

    <div class="col-md-7">
      <div class="p-4 rounded-lg bg-white shadow" id="container"></div>
    </div>
    <div class="col-md-5">
      <div class="p-4 rounded-lg bg-white shadow" id="container2"></div>
    </div>

    <!-- tabel untuk user -->
    <?php if (user("level") == "user") : ?>
      <div class="col-md-12 mt-3">
        <!-- Nilai Investasi Start-->
        <div class="card card-outline card-purple mb-4 shadow">
          <div class="card-header p-1">
            <h6 class="text-center display-5 p-2 text-bold">Rekap Nilai Investasi</h6>
          </div>
          <div class="card-body table-responsive p-0">
            <table class="table table-sm table-bordered table-striped text-center align-items-center">
              <thead>
                <tr>
                  <th rowspan="2">No.</th>
                  <th rowspan="2">Kecamatan</th>
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
        <div class="card card-outline card-purple mb-4 shadow">
          <div class="card-header p-1">
            <h6 class="text-center display-5 p-2 text-bold">Rekap Nilai Produksi</h6>
          </div>
          <div class="card-body table-responsive p-0">

            <table class="table table-sm table-bordered table-striped text-center">
              <thead>
                <tr>
                  <th rowspan="2">No.</th>
                  <th rowspan="2">Kecamatan</th>
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
        <div class="card card-outline card-purple mb-4 shadow">
          <div class="card-header p-1">
            <h6 class="text-center display-5 p-2 text-bold mb-2">Rekap Unit Usaha</h6>
          </div>
          <div class="card-body table-responsive p-0">

            <table class="table table-sm table-bordered table-striped table-condensed text-center">
              <thead>
                <tr>
                  <th rowspan="2">No.</th>
                  <th rowspan="2">Kecamatan</th>
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
        <div class="card card-outline card-purple mb-4 shadow">
          <div class="card-header p-1">
            <h6 class="text-center display-5 p-2 text-bold mb-2">Rekap Tenaga Kerja</h6>
          </div>
          <div class="card-body table-responsive p-0">

            <table class="table table-sm table-bordered table-striped table-condensed text-center">
              <thead>
                <tr>
                  <th rowspan="2">No.</th>
                  <th rowspan="2">Kecamatan</th>
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
        <div class="card card-outline card-purple mb-4 shadow">
          <div class="card-header p-1">
            <h6 class="text-center display-5 p-2 text-bold mb-2">Rekap Tenaga Kerja (Gender)</h6>
          </div>
          <div class="card-body table-responsive p-0">

            <table class="table table-sm table-bordered table-striped table-condensed text-center">
              <thead>
                <tr>
                  <th rowspan="3">No.</th>
                  <th rowspan="3">Kecamatan</th>
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
    <?php endif; ?>
  </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
  Highcharts.setOptions({
    lang: {
      thousandsSep: '.'
    }
  })

  Highcharts.chart('container', {

    title: {
      text: 'Statistik Perkembangan Tiap Tahun'
    },

    subtitle: {
      text: 'Semua data di grafik belum ditambah (.000)'
    },

    yAxis: {
      title: {
        text: ''
      }
    },

    xAxis: {
      categories: <?= json_encode($xaxis); ?>,
    },

    tooltip: {
      valuePrefix: 'Rp. ',
    },

    legend: {
      layout: 'vertical',
      align: 'right',
      verticalAlign: 'middle'
    },

    series: <?= json_encode($series1); ?>,

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

  Highcharts.chart('container2', {

    title: {
      text: 'Statistik Perkembangan Tiap Tahun'
    },

    subtitle: {
      text: 'Source: SIIDIG'
    },

    yAxis: {
      title: {
        text: ''
      }
    },

    xAxis: {
      categories: <?= json_encode($xaxis); ?>,
    },


    legend: {
      layout: 'vertical',
      align: 'right',
      verticalAlign: 'middle'
    },

    series: <?= json_encode($series2); ?>,

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
      text: 'Pemprov',
      // href: 'http://www.yourcompany.com'
    }

  });
</script>
<?= $this->endSection(); ?>