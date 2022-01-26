<?php

session_start();
require_once '../function/functions.php';
require_once '../function/constant.php';
require_once '../assets/lib/Parsedown.php';

$conn = koneksi();
$id = $_GET['id'];
$data = query("SELECT * FROM post WHERE id = '$id'");
$tag = $data["tag"];
$parsedown = new Parsedown();
$relateds = relatedPost($data);
$relateds_count = count($relateds);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Open Graph -->
  <meta property="og:title" content="<?= getName(); ?> - <?= $data['judul']; ?>" />
  <meta name="author" content="<?= getName(); ?>" />
  <meta property="og:locale" content="id" />
  <meta name="description" content="<?php potongText($data['konten'], 300); ?>" />
  <meta property="og:description" content="<?php potongText($data['konten'], 300); ?>" />
  <link rel="canonical" href="<?= getLink("Domain"); ?>/post/post.php?id=<?= $id; ?>" />

  <meta property="og:url" content="<?= getLink("Domain"); ?>/post/post.php?id=<?= $id; ?>" />
  <meta property="og:site_name" content="<?= getName(); ?>" />
  <meta property="og:country-name" content="Indonesia" />
  <meta property="og:image" content="<?= getLink("Domain"); ?>/assets/img/post/<?= $data['thumbnail']; ?>" />
  <meta property="og:image:width" content="460" />
  <meta property="og:image:height" content="230" />
  <meta property="og:type" content="<?= getLink("Domain"); ?>/post/post.php?id=<?= $id; ?>" />
  <meta property="og:image:type" content="image/jpeg" />

  <meta property="twitter:card" content="summary_large_image" />
  <meta property="twitter:title" content="<?= getName(); ?> - <?= $data['judul']; ?>" />
  <meta property="twitter:author" content="<?= getName(); ?>" />
  <meta property="twitter:image:src" content="<?= getLink("Domain"); ?>/assets/img/post/<?= $data['thumbnail']; ?>" />

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
  <title><?= getName(); ?> - <?= $data['judul']; ?></title>
  <link rel="icon" type="image/svg" href="../<?= getFavIcon(); ?>">
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
          <h3>
            <?= $parsedown->text($data['judul']); ?>
          </h3>
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

        <?php if(empty($relateds) == false) : ?>

        <div class="recommendation-post mt-5">
          <h4><i class="fas fa-tag"></i> Related Post by Tag</h4>
          <hr>
          <div id="carouselExampleCaptions" class="carousel carousel-fade slide" data-bs-ride="carousel">
            <div class="carousel-indicators">

              <?php
              for ($i = 0; $i < $relateds_count; $i++) {
                if ($i == 0) {
                  echo "
                    <button type='button' data-bs-target='#carouselExampleCaptions' data-bs-slide-to='$i' class='active' aria-current='true' aria-label='Slide $i'></button>
                    ";
                } else {
                  echo "
                    <button type='button' data-bs-target='#carouselExampleCaptions' data-bs-slide-to='$i' aria-label='Slide $i'></button>
                    ";
                }
              }
              ?>

            </div>

            <div class="carousel-inner">

              <?php
              for ($i = 0; $i < $relateds_count; $i++) {
                if ($i == 0) {
                  echo "
                      <div class='carousel-item active' data-mdb-interval='1'>
                        <a href='post.php?id=" . $relateds[$i]["id"] . "'>
                          <div class='ratio ratio-16x9'>
                            <img src='../assets/img/post/" . $relateds[$i]['thumbnail'] . "' class='d-block w-100 img-fluid rounded mx-auto' alt='" . $relateds[$i]['thumbnail'] . "'>
                          </div>
                          <div class='carousel-caption d-sm-block'>
                            <h5>" . $relateds[$i]['judul'] . "</h5>
                            <span class='btn btn-light tag'><i class='fas fa-tag me-1'></i>" . $relateds[$i]['tag'] . "</span> 
                          </div>
                        </a>
                      </div>
                  ";
                } else {
                  echo "
                      <div class='carousel-item' data-mdb-interval='1'>
                        <a href='post.php?id=" . $relateds[$i]["id"] . "'>
                          <div class='ratio ratio-16x9'>
                            <img src='../assets/img/post/" . $relateds[$i]['thumbnail'] . "' class='d-block w-100 img-fluid rounded mx-auto' alt='" . $relateds[$i]['thumbnail'] . "'>
                          </div>
                          <div class='carousel-caption d-sm-block'>
                            <h5>" . $relateds[$i]['judul'] . "</h5>
                            <span class='btn btn-light tag'><i class='fas fa-tag me-1'></i>" . $relateds[$i]['tag'] . "</span> 
                          </div>
                        </a>
                      </div>
                  ";
                }
              }
              ?>

            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        </div>
        <?php endif; ?>

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
