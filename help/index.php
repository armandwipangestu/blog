<?php

session_start();

if (!isset($_SESSION['login'])) {
  header("Location: ../auth/login.php");
}

require_once '../function/functions.php';
require_once '../function/constant.php';
require_once '../lib/functions.php';
require_once '../assets/lib/Parsedown.php';
$help = file_get_contents('help.md');

$parsedown = new Parsedown();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../assets/css/bootstrap/bootstrap.css">
  <link rel="stylesheet" href="../assets/css/fontawesome/all.css">
  <link rel="stylesheet" title="<?= highlightDarkTheme(); ?>" href="../assets/css/highlight/<?= highlightDarkTheme(); ?>.css">
  <link rel="stylesheet" title="<?= highlightLightTheme(); ?>" href="../assets/css/highlight/<?= highlightLightTheme(); ?>.css" disabled="disabled">
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/theme.css">
  <style>
    a {
      text-decoration: none;
    }

  </style>
  <title><?= getName(); ?> - Ubah Postingan</title>
  <link rel="icon" type="image/svg" href="../<?= getFavIcon(); ?>">
</head>

<body class="<?= getDefaultTheme(); ?>">

  <!-- Start Navbar -->
  <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand custom-font" href="../index.php"><img src="../<?= getFavIcon(); ?>" style="width: 30%;"> <?= getName(); ?></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <ul class="nav navbar-nav ms-auto w-100 justify-content-end me-5">
          <a class="nav-link" aria-current="page" href="../index.php"><i class="fas fa-home"></i> Home</a>
          <a class="nav-link" href="../post/index.php"><i class="fas fa-book"></i> Blog</a>
          <a class="nav-link" href="../about/index.php"><i class="fas fa-address-card"></i> About</a>
          <?php if (isset($_SESSION['login'])) : ?>
            <li class="nav-item dropdown mt-2">
            <a class="dropdown-toggle text-white" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="text-decoration: none;"><img src="../assets/img/avatar/<?= $_SESSION['avatar']; ?>" alt="" class="rounded-circle" style="width: 30px;"></a>
              <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarScrollingDropdown">
                <li><a class="dropdown-item" href="../admin/index.php"><i class="fas fa-plus"></i> Tambah Post</a></li>
                <li><a href="../auth/daftar.php" class="dropdown-item"><i class="fas fa-user-plus"></i> Tambah Admin</a></li>
                <li><a class="dropdown-item" href="../pengaturan/index.php?id=<?= $_SESSION["id"]; ?>"><i class="fas fa-cog"></i> Pengaturan</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item logout" href="#" id="logout" data-id="<?= $_SESSION["id"]; ?>"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
              </ul>
            </li>
          <?php endif; ?>
          <?php if (!isset($_SESSION['login'])) : ?>
            <a class="btn btn-light tombol" href="../auth/login.php"><i class="fas fa-user"></i> Login Admin</a>
          <?php endif; ?>
          <div class="text-center ms-3 mt-1">
            <label class="switch">
              <input type="checkbox">
              <span class="slider round toggle-theme"></span>
            </label>
          </div>
      </div>
    </div>
    </div>
  </nav>
  <!-- End Navbar -->

    <div class="container mt-5">
    <div class="row justify-content-md-center">
      <div class="col-lg-7 mt-5">
          <a href="../assets/img/post/default.png" target="_blank">
            <img src="../assets/img/post/default.png" class="card-img-top rounded mb-3 img-fluid" alt="default.png">
          </a>
        <div class="mt-3 mb-3">
          <h2>
            Penulisan Tag Pada Konten
          </h2>
        </div>
        <div class="mt-3">
          <?= $parsedown->text($help); ?>
        </div>

      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-lg-auto">
        <button type="button" class="btn btn-success btn-floating btn-lg rounded-circle" id="btn-back-to-top">
          <i class="fas fa-arrow-up"></i>
        </button>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
  <script src="../assets/js/bootstrap/bootstrap.js"></script>
  <script src="../assets/js/highlight/highlight.min.js"></script>
  <!--<script src="../assets/js/highlight/highlightjs-line-numbers.min.js"></script>-->
  <script src="../assets/js/highlight/highlight-badge.min.js"></script>
  <script src="../assets/js/highlight/highlight-badge-init.js"></script>
  <script src="../assets/js/script.js"></script>
  <script src="../assets/js/sweetalert/sweetalert2.all.min.js"></script>
  <script src="../assets/js/theme.js"></script>
  <script src="../assets/js/previewimage.js"></script>
</body>
</html>