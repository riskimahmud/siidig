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

    <div class="col-12">
      <div class="p-4 rounded-lg bg-white shadow" id="container"></div>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
  Highcharts.chart('container', {

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

    series: <?= json_encode($series); ?>,

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