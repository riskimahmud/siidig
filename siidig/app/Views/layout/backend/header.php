<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <!-- <li class="nav-item d-none d-sm-inline-block">
      <a href="#" class="nav-link">Home</a>
    </li> -->
  </ul>


  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown">
      <a class="nav-link" href="/kontak" title="Pesan Masuk">
        <i class="far fa-bell fa-lg"></i>
        <?php if (getKontak() > 0) { ?>
          <span class="badge badge-danger navbar-badge"><?= getKontak() ?></span>
        <?php } ?>
      </a>
    </li>
    <li class="nav-item dropdown user-menu">
      <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
        <img src="<?= base_url("avatar/default.png"); ?>" class="user-image img-circle" alt="User Image">
        <span class="d-none d-md-inline"><?= user("nama") ?></span>
      </a>
      <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <!-- User image -->
        <li class="user-header bg-primary">
          <img src="<?= base_url("avatar/default.png"); ?>" class="img-circle" alt="User Image">

          <p>
            <?= user("nama") ?>
          </p>
        </li>
        <!-- Menu Footer-->
        <li class="user-footer">
          <a href="<?= base_url("profil"); ?>" class="btn btn-default btn-flat">Profile</a>
          <a href="<?= base_url("logout"); ?>" class="btn btn-default btn-flat float-right keluar">Sign out</a>
        </li>
      </ul>
    </li>


  </ul>

</nav>