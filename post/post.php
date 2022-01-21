<?php

session_start();
require_once '../function/functions.php';
require_once '../function/constant.php';
require_once '../assets/lib/Parsedown.php';

$conn = koneksi();
$id = $_GET['id'];
$data = query("SELECT * FROM post WHERE id = '$id'");
$parsedown = new Parsedown();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Start Open Graph -->
  <!-- <meta property="og:title" content="xShin Blog" />
  <meta name=" author" content="xShin" />
  <meta property="og:locale" content="en" />
  <meta name="description" content="Blog ini dibuat menggunakan Sistem Operasi Arch Linux. Source code dan artikel-artikel ditulis menggunakan Text Editor Visual Studio Code & Neovim. Dihosting menggunakan GitHub Pages." />
  <meta property="og:description" content="Blog ini dibuat menggunakan Sistem Operasi Arch Linux. Source code dan artikel-artikel ditulis menggunakan Text Editor Visual Studio Code & Neovim. Dihosting menggunakan GitHub Pages." />
  <link rel="canonical" href="http://xshin.rf.gd/blog/index.php" />
  <meta property="og:url" content="http://xshin.rf.gd/blog/index.php" />
  <meta property="og:site_name" content="xShin" />

  <meta property="og:country-name" content="Indonesia" />
  <meta property="og:image" content="assets/img/post/default.png" />
  <meta property="og:image:width" content="460" />
  <meta property="og:image:height" content="230" />

  <meta property="twitter:card" content="summary_large_image" />
  <meta property="twitter:title" content="xShin Blog" />
  <meta property=" twitter:author" content="xShin" />
  <meta property="twitter:image:src" content="assets/img/post/default.png" /> -->
  <!-- End Open Graph -->

  <link rel="stylesheet" href="../assets/css/bootstrap/bootstrap.css">
  <link rel="stylesheet" href="../assets/css/fontawesome/all.css">
  <link rel="stylesheet" href="../assets/css/highlight/<?= highlightTheme(); ?>.css">
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/theme.css">
  <style>
    .container .row .preview {
      margin-top: 3rem;
    }

    @media (min-width: 992px) {
      .container .row .preview {
        margin-top: -0rem;
      }
    }

    .link {
      text-decoration: none;
    }

    a {
      text-decoration: none;
    }

    code {
      border-radius: 5px;
    }
  </style>
  <title><?= getName(); ?> - <?= $parsedown->text($data['judul']); ?></title>
</head>

<body class="bg-dark text-white">

  <!-- Start Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand custom-font" href="../index.php"><i class="fab fa-github me-1"></i> <?= getName(); ?></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <ul class="nav navbar-nav ms-auto w-100 justify-content-end me-5">
          <a class="nav-link" aria-current="page" href="../index.php"><i class="fas fa-home"></i> Home</a>
          <a class="nav-link" href="index.php"><i class="fas fa-book"></i> Blog</a>
          <a class="nav-link" href="#" id="errorAlert"><i class="fas fa-bookmark"></i> Note</a>
          <a class="nav-link" href="#" id="errorAlert"><i class="fas fa-address-card"></i> About</a>
          <?php if (isset($_SESSION['login'])) : ?>
            <li class="nav-item dropdown mt-2">
              <a class="dropdown-toggle text-white" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="text-decoration: none;"><i class="fas fa-user"></i> <?= $_SESSION['username']; ?></a>
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

  <div class="container">
    <div class="row justify-content-md-center">
      <div class="col-lg-7 mt-5">
        <?php if (pathinfo($data["thumbnail"], PATHINFO_EXTENSION) == "svg") : ?>
          <a href="../assets/img/post/<?= $data['thumbnail']; ?>" target="_blank">
            <div class="ratio ratio-16x9">
              <!-- <a href="../assets/img/post/<?= $d['thumbnail']; ?>" target="_blank"> -->
              <img src="../assets/img/post/<?= $data['thumbnail']; ?>" class="card-img-top rounded mb-3 img-fluid bg-light" alt="<?= $data['thumbnail']; ?>">
            </div>
          </a>
        <?php endif; ?>
        <?php if (pathinfo($data["thumbnail"], PATHINFO_EXTENSION) == "png" || pathinfo($data["thumbnail"], PATHINFO_EXTENSION) == "jpg" || pathinfo($data["thumbnail"], PATHINFO_EXTENSION) == "jpeg") : ?>
          <!-- <a href="../assets/img/post/<?= $d['thumbnail']; ?>" target="_blank"> -->
          <a href="../assets/img/post/<?= $data['thumbnail']; ?>" target="_blank">
            <img src="../assets/img/post/<?= $data['thumbnail']; ?>" class="card-img-top rounded mb-3 img-fluid bg-light" alt="<?= $data['thumbnail']; ?>">
          </a>
        <?php endif; ?>
        <div class="mt-4">
          <?= $parsedown->text($data['judul']); ?>
        </div>
        <p class="text-muted">
          Postingan Dibuat: <?= $data['tanggal_dibuat']; ?>
          <br>
          <?php if (cekPerubahan($data['tanggal_diubah'])) : ?>
            Terakhir Diedit: <?= $data['tanggal_diubah']; ?>
          <?php endif; ?>
        </p>
        <?= $parsedown->text('<span class="btn btn-light tag"><i class="fas fa-tag me-1"></i> ' . $data['tag'] . '</span>'); ?>
        <?php if (isset($_SESSION["login"])) : ?>
          <div class="action mb-3">
            <a class="btn btn-danger hapus" data-id="<?= $data["id"]; ?>"><i class="fas fa-trash me-1"></i> Hapus Post</a>
            <a href="ubah.php?id=<?= $data['id']; ?>" class="btn btn-warning"><i class="fas fa-pen me-1"></i> Ubah Post</a>
          </div>
        <?php endif; ?>
        <?= $parsedown->text($data['konten']); ?>
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

  <script src="../assets/js/bootstrap/bootstrap.js"></script>
  <script src="../assets/js/highlight/highlight.min.js"></script>
  <script src="../assets/js/script.js"></script>
  <script src="../assets/js/theme.js"></script>
  <script src="../assets/js/sweetalert/sweetalert2.all.min.js"></script>
  <?php if (isset($_SESSION["login"])) : ?>
    <script>
      const logout = document.querySelector('.logout');
      logout.addEventListener("click", function() {
        const dataid = this.dataset.id;
        Swal.fire({
          icon: 'warning',
          title: 'Apakah anda yakin ingin keluar',
          showCancelButton: true,
          confirmButtonColor: '#d9534f',
          cancelButtonColor: '#5cb85c',
          confirmButtonText: `Ya`,
          cancelButtonText: `Tidak`,
        }).then((result) => {
          if (result.isConfirmed) {
            location.href = `../auth/logout.php?id=${dataid}`
          }
        })
      });
      const hapus = document.querySelector('.hapus');
      hapus.addEventListener("click", function() {
        const dataid = this.dataset.id;
        Swal.fire({
          icon: 'warning',
          title: 'Apakah anda yakin ingin menghapus post ini?',
          showCancelButton: true,
          confirmButtonColor: '#d9534f',
          cancelButtonColor: '#5cb85c',
          confirmButtonText: `Ya`,
          cancelButtonText: `Tidak`,
        }).then((result) => {
          if (result.isConfirmed) {
            location.href = `hapus.php?id=${dataid}`
          }
        })
      })
    </script>
  <?php endif; ?>
</body>

</html>
