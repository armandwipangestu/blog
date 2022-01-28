<?php

session_start();

if (!isset($_SESSION['login'])) {
  header("Location: ../auth/login.php");
}

require '../function/functions.php';
require '../function/constant.php';

$id = $_GET["id"];

$u = query("SELECT * FROM admin WHERE id = $id");

if (isset($_POST["submit"])) {

  if (resetpass($_POST) > 0) {
    echo "
          <script>
              alert('data berhasil diubah !');
              document.location.href = 'index.php?id=" . $u["id"] . "';
          </script>
      ";
  } else {
    echo "
      <script>
          alert('data tidak berhasil diubah !');
          document.location.href = '';
      </script>
  ";
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <meta name=”viewport” content=”width=device-width, initial-scale=1.0"> -->
  <link rel="stylesheet" href="../assets/css/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/css/fontawesome/all.css">
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/theme.css">
  <title><?= getName(); ?> - Reset Password</title>
  <link rel="icon" type="image/svg" href="../<?= getFavIcon(); ?>">
  <style>
    a {
      text-decoration: none;
    }

    ul {
      list-style-type: none;
    }

    .avatar {
      vertical-align: middle;
      width: 30px;
      height: 30px;
      border-radius: 50%;
    }
  </style>
</head>

<body class="<?= getDefaultTheme(); ?>">

  <!-- Start Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand custom-font" href=""><i class="fab fa-github me-1"></i> <?= getName(); ?></a>
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
              <a class="dropdown-toggle text-white" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="text-decoration: none;"><i class="fas fa-user"></i> <?= $_SESSION['username']; ?></a>
              <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarScrollingDropdown">
                <li><a class="dropdown-item" href="../admin/index.php"><i class="fas fa-plus"></i> Tambah Post</a></li>
                <li><a href="../auth/daftar.php" class="dropdown-item"><i class="fas fa-user-plus"></i> Tambah Admin</a></li>
                <li><a class="dropdown-item" href="index.php?id=<?= $_SESSION["id"]; ?>"><i class="fas fa-cog"></i> Pengaturan</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item logout" href="#" id="logout" data-id="<?= $_SESSION["id"]; ?>"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
              </ul>
            </li>
          <?php endif; ?>
          <?php if (!isset($_SESSION['login'])) : ?>
            <a class="btn btn-light tombol" href="auth/login.php"><i class="fas fa-user"></i> Login Admin</a>
          <?php endif; ?>
          <div class="text-center ms-3 mt-1">
            <label class="switch">
              <input type="checkbox">
              <span class="slider round toggle-theme"></span>
            </label>
          </div>
      </div>
    </div>
  </nav>
  <!-- End Navbar -->

  <div class="container">
    <div class="row justify-content-md-center">
      <div class="col-lg-5 mt-5">

        <h1 class="text-center mb-4">
          <i class="fas fa-cog"></i> Reset Password
        </h1>

        <form class="ubah" onsubmit="return submitForm(this);" action="" method="post" enctype="multipart/form-data">
          <div class="input-group">
            <input type="hidden" name="id" id="id" class="form-control" value="<?= $u["id"]; ?>">
          </div>

          <div class="mt-4">
            <label for="passwordlama" class="form-label text-secondary"><i class="fas fa-lock"></i> Password Lama</label>
            <input type="hidden" name="password" id="password" class="form-control" value="<?= $u["password"]; ?>">
            <input type="password" name="passwordlama" id="passwordlama" class="form-control">
          </div>

          <div class="mt-4">
            <label for="passwordbaru" class="form-label text-secondary"><i class="fas fa-user-lock"></i> Password Baru</label>
            <input type="password" name="passwordbaru" id="passwordbaru" class="form-control">
          </div>

          <div class="mt-4">
            <label for="konfirmasipassword" class="form-label text-secondary"><i class="fas fa-user-lock"></i> Konfirmasi Password Baru</label>
            <input type="password" name="konfirmasipassword" id="konfirmasipassword" class="form-control">
          </div>

          <div class="container mt-5 text-center mb-5">

            <button type="submit" name="submit" value="submit" class="btn btn-danger mb-15">
              Reset Password <i class="fas fa-save"></i>
            </button>

            <button class="btn btn-success">
              <a href="index.php?id=<?= $u["id"]; ?>" class="text-white">
                Kembali <i class="fas fa-sign-in-alt"></i>
              </a>
            </button>

          </div>
        </form>
      </div>
    </div>
  </div>
  </div>

  <script src="../assets/js/highlight/highlight.min.js"></script>
  <script src="../assets/js/script.js"></script>
  <script src="../assets/js/sweetalert/sweetalert2.all.min.js"></script>
  <script src="../assets/js/bootstrap/bootstrap.min.js"></script>
  <script src="../assets/js/theme.js"></script>
  <script>
    function submitForm() {
      return confirm('Apakah anda yakin ingin mengubah nya?');
    };

    const logout = document.querySelector(".logout");
    logout.addEventListener("click", function() {

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
          location.href = `../auth/logout.php`;
        }
      })
    });
  </script>

</body>

</html>
