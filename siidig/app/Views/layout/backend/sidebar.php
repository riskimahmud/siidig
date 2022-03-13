<div class="sidebar">
  <!-- Sidebar user panel (optional) -->
  <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
    <div class="image">
      <img src="<?= base_url("avatar/default.png"); ?>" class="img-circle elevation-2" alt="User Image">
    </div>
    <div class="info">
      <span href="#" class="d-block h6 mb-0 text-light text-wrap"><?= user("nama") ?></span>
      <small class="text-white d-block my-1">
        <?php
        if (user("level") == "admin") {
          echo "ADMIN";
        } else {
          echo "OPERATOR KAB/KOTA";
          // echo "";
        }
        ?>
      </small>
      <?php if (user("level") == "user") : ?>
        <small class="badge badge-light text-wrap">
          <?= user("nama_kabkota")[0]; ?>
        </small>
      <?php endif; ?>
    </div>
  </div>

  <div class="">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="/" class="nav-link">
            <i class="nav-icon fas fa-tachometer fa-fw-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <?php if (user("level") == "user") { ?>
          <li class="nav-header pt-1">MASTER</li>
          <li class="nav-item">
            <a href="<?= base_url("kelkec"); ?>" class="nav-link">
              <i class="nav-icon fas fa-map-marked fa-fw"></i>
              <p>
                Kelurahan / Kecamatan
              </p>
            </a>
          </li>
          <li class="nav-header pt-1">UTAMA</li>
          <li class="nav-item">
            <a href="<?= base_url("investasi"); ?>" class="nav-link">
              <i class="nav-icon fas fa-briefcase fa-fw"></i>
              <p>
                Laporan Investasi
              </p>
            </a>
          </li>
        <?php } else if (user("level") == "admin") { // admin
        ?>
          <li class="nav-header pt-1">MASTER</li>
          <li class="nav-item">
            <a href="<?= base_url("kabkota"); ?>" class="nav-link">
              <i class="nav-icon fas fa-map-marked fa-fw"></i>
              <p>
                Kabupaten / Kota
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url("users"); ?>" class="nav-link">
              <i class="nav-icon fas fa-users fa-fw"></i>
              <p>
                User
              </p>
            </a>
          </li>
          <li class="nav-header pt-1">Informasi</li>
          <li class="nav-item">
            <a href="<?= base_url("header"); ?>" class="nav-link">
              <i class="nav-icon fas fa-image fa-fw"></i>
              <p>
                Header
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url("blog"); ?>" class="nav-link">
              <i class="nav-icon fas fa-newspaper fa-fw"></i>
              <p>
                Berita
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url("pelatihan"); ?>" class="nav-link">
              <i class="nav-icon fas fa-user-graduate fa-fw"></i>
              <p>
                Pelatihan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url("aplikasi"); ?>" class="nav-link">
              <i class="nav-icon fas fa-globe fa-fw"></i>
              <p>
                Aplikasi
              </p>
            </a>
          </li>
        <?php } else if (user("level") == "operator") { // operator
        ?>
          <!-- <li class="nav-item">
            <a href="<?= base_url("pengajuan"); ?>" class="nav-link">
              <i class="nav-icon fas fa-list fa-fw"></i>
              <p>
                Pengajuan
              </p>
            </a>
          </li> -->
        <?php }
        ?>

        <?php if (user("level") == "admin") : ?>
          <li class="nav-header pt-1">UTAMA</li>
          <li class="nav-item">
            <a href="<?= base_url("siinas"); ?>" class="nav-link">
              <i class="nav-icon fas fa-building fa-fw"></i>
              <p>
                Perusahaan SIINAS
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url("laporan"); ?>" class="nav-link">
              <i class="nav-icon fas fa-briefcase fa-fw"></i>
              <p>
                Laporan Inverstasi
              </p>
            </a>
          </li>
        <?php endif; ?>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>