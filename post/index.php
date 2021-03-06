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
  <link rel="stylesheet" title="<?= highlightDarkTheme(); ?>" href="../assets/css/highlight/<?= highlightDarkTheme(); ?>.css" disabled="disabled">
  <link rel="stylesheet" title="<?= highlightLightTheme(); ?>" href="../assets/css/highlight/<?= highlightLightTheme(); ?>.css">
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

  <div style="margin: 6rem 2rem 2rem 2rem;">
    <input type="text" class="form-control search bg-dark text-light text-center" placeholder="Masukan keyword pencarian" style="border-radius: 20px; font-size: 1rem; border-color: #a4a6a8;">
  </div>
  <div class="row row-cols-1 row-cols-md-4 g-4 ms-4 me-4 mb-5 container-post">
    <?php foreach ($data as $d) : ?>
      <div class="col rounded">
        <div class="card h-100 bg-dark text-light" style="border-color: #a4a6a8;">
          <div class="ratio ratio-16x9">
            <img src="../assets/img/post/<?= $d['thumbnail']; ?>" alt="<?= $d['thumbnail']; ?>" class="card-img-top img-fluid" />
          </div>
          <div class="card-body bg-dark text-light">
            <h5 class="card-title"><?= $d['judul']; ?></h5>
            <?php
            $tags = $d["tag"];
            $tag = explode(" ", $tags);
            foreach ($tag as $t) :
            ?>
              <span class="card-text tag"><i class="fas fa-tags me-1"></i> <?= $t; ?></span>
            <?php endforeach; ?>
            <br><small class="text-muted" style="font-size: 0.8rem;">Created <?= $d['tanggal_dibuat']; ?></small><br>
            <?php if (cekPerubahan($d['tanggal_diubah'])) : ?>
              <small class="text-muted" style="font-size: 0.8rem;">Last updated <?= $d['tanggal_diubah']; ?></small>
            <?php endif; ?>
          </div>
          <div class="card-footer bg-dark text-light text-end">
            <a href="post.php?id=<?= $d['id']; ?>" class="btn btn-primary text-end">
              Read More
              <i class="fas fa-sign-in-alt ms-1"></i>
            </a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
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
        .then(response => ( containerPost.innerHTML = response));
    });
  </script>
  <script>
    toggleTheme.addEventListener("click", function() {
      const bodyTheme = document.getElementsByTagName("BODY")[0].className;
      if(bodyTheme == "bg-dark text-light") {
        searchBar.className = "form-control search bg-dark text-light mt-5 text-center";
      } else if (bodyTheme == "bg-light text-dark") {
        searchBar.className = "form-control search bg-light text-dark mt-5 text-center";
      }
    });
   </script>
</body>

</html>
