<?php

session_start();
require_once '../function/functions.php';
require_once '../function/constant.php';
require_once '../assets/lib/Parsedown.php';

$conn = koneksi();
$data = mysqli_query($conn, "SELECT * FROM post");
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
  <link rel="stylesheet" href="../assets/css/highlight/atom-one-dark.css">
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/theme.css">
  <title><?= getName(); ?> - Post</title>
  <link rel="icon" type="image/svg" href="../<?= getFavIcon(); ?>">
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

    /* .card-img-top {
      width: 100%;
      height: 15vw;
      object-fit: cover;
    } */
  </style>
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
          <a class="nav-link" href=""><i class="fas fa-book"></i> Blog</a>
          <a class="nav-link" href="../about/index.php"><i class="fas fa-address-card"></i> About</a>
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
        <label for="search" class="form-label mt-5"><i class="fas fa-search" style="font-size: .800rem;"></i> Search</label>
        <input type="text" class="form-control search" placeholder="Masukan keyword pencarian" style="border-radius: 20px; font-size: .800rem; border-color: #a4a6a8;">
        <div class="container-post mt-4">
          <?php foreach ($data as $d) : ?>
            <div class="col mb-5 rounded">
              <div class="card h-100" style="border-color: #a4a6a8;">
                <div class="ratio ratio-16x9">
                  <img class="card-img-top" src="../assets/img/post/<?= $d['thumbnail']; ?>" alt="<?= $d['thumbnail']; ?>">
                </div>
                <div class="card-body bg-light text-dark">
                  <h5 class="card-title"><?= $d['judul']; ?></h5>
                  <!-- <p class="card-text"><?= potongText($d['konten'], 5); ?></p> -->
                  <span class="card-text tag"><i class="fas fa-tags me-1"></i> <?= $d['tag']; ?></span><br>
                  <small class="text-muted" style="font-size: .675rem;">Created <?= $d['tanggal_dibuat']; ?></small><br>
                  <?php if (cekPerubahan($d['tanggal_diubah'])) : ?>
                    <small class="text-muted" style="font-size: .675rem;">Last updated <?= $d['tanggal_diubah']; ?></small>
                  <?php endif; ?>
                </div>
                <div class="card-footer bg-light text-dark" style="border: none;">
                  <div class="text-end mb-3">
                    <a href="post.php?id=<?= $d['id']; ?>" class="btn btn-primary text-end" style="font-size: .700rem;">
                      Read More <i class="fas fa-sign-in-alt"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>

  <div class="container text-white">
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
  <script src="../assets/js/sweetalert/sweetalert2.all.min.js"></script>
  <script src="../assets/js/theme.js"></script>
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

      const hapus = document.querySelectorAll('.hapus');
      hapus.forEach(hps => {
        hps.addEventListener("click", function() {
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
      })
    </script>
  <?php endif; ?>
  <script>
    const search = document.querySelector(".search");
    const containerPost = document.querySelector(".container-post");
    search.addEventListener("keyup", function() {
      fetch("ajax_cari.php?keyword=" + search.value)
        .then(response => response.text())
        .then(response => (containerPost.innerHTML = response));
    });
  </script>
</body>

</html>
