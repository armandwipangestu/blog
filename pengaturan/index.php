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

  if (ubahUser($_POST) > 0) {
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
  <title><?= getName(); ?> - Pengaturan</title>
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
                <li><a class="dropdown-item" href="index.php?id=<?= $_SESSION["id"]; ?>"><i class="fas fa-cog"></i> Pengaturan</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li>
                  <a class="dropdown-item logout" href="#" id="logout" data-id="<?= $_SESSION["id"]; ?>"><i class="fas fa-sign-out-alt"></i> 
                    Keluar
                  </a>
                </li>
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
          <i class="fas fa-cog"></i> Pengaturan
        </h1>

        <form class="ubah" onsubmit="return submitForm(this);" action="" method="post" enctype="multipart/form-data">
          <fieldset disabled>

            <div class="input-group">
              <input type="hidden" name="id" id="id" class="form-control" value="<?= $u["id"]; ?>">
            </div>

            <div class="mt-2 text-center">
              <img src="../assets/img/avatar/<?= $u["avatar"]; ?>" alt="" class="rounded-circle img-preview" style="width: 200px;">
              <div class="input-group mt-3 mb-3">
                  <input class="form-control" type="hidden" name="gambar_lama" value="<?= $u["avatar"]; ?>">
                  <input class="form-control gambar-preview mt-3" type="file" name="gambar" style="border: none;" onchange="previewImage()">
              </div>
            </div>

            <div class="mt-2">
              <label for="username" class="form-label text-secondary mb-2"><i class="fas fa-user"></i> Username</label>
              <input type="text" name="username" id="username" class="form-control" autofocus value="<?= $u["username"]; ?>" required>
            </div>

            <div class="mt-4">
              <label for="passwordverify" class="form-label text-secondary"><i class="fas fa-lock"></i> Verifikasi Password</label>
              <input type="hidden" name="password" id="password" class="form-control" value="<?= $u["password"]; ?>">
              <input type="password" name="passwordverify" id="passwordverify" class="form-control" placeholder="Verifikas Password">
            </div>

          </fieldset>

          <div class="container mt-5 text-end">
            <button type="submit" name="submit" value="submit" class="btn btn-warning newButton mb-15 text-dark" style="display: none;">
              <i class="fas fa-save"></i> Save
            </button>
          </div>

        </form>

        <div class="container mt-3 text-end mb-5">
          <div class="button">

            <button class="btn btn-primary">
              <a class="text-white toggle-btn" onclick="showNewButton()"><i class="fas fa-user-edit"></i> Ubah</a>
            </button>

            <button class="btn btn-danger">
              <a href="resetpass.php?id=<?= $u["id"]; ?>" class="text-white toggle-btn"><i class="fas fa-lock"></i> Reset Password</a>
            </button>

            <button class="btn btn-danger hapus" id="hapus" data-hapus="<?= $u["id"]; ?>" data-username="<?= $u["username"]; ?>" style="display: none;">
              <i class="fas fa-trash"></i> Hapus
            </button>

            <button class="btn btn-success">
              <a href="../index.php" class="text-white"><i class="fas fa-sign-in-alt"></i> Kembali</a>
            </button>

          </div>
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

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
  <script src="../assets/js/previewimage.js"></script>
  <script src="../assets/js/highlight/highlight.min.js"></script>
  <script src="../assets/js/script.js"></script>
  <script src="../assets/js/sweetalert/sweetalert2.all.min.js"></script>
  <script src="../assets/js/bootstrap/bootstrap.min.js"></script>
  <script src="../assets/js/theme.js"></script>
  <script>
    const hapus = document.querySelector(".hapus");
    hapus.addEventListener("click", function() {
      const dataID = this.dataset.hapus;
      const dataNama = this.dataset.username;
      Swal.fire({
        icon: 'warning',
        title: 'Apakah anda yakin ingin menghapus user',
        html: `<b><u>${dataNama}</u> ?</b>`,
        showCancelButton: true,
        confirmButtonColor: '#d9534f',
        cancelButtonColor: '#5cb85c',
        confirmButtonText: `Ya`,
        cancelButtonText: `Tidak`,
      }).then((result) => {
        if (result.isConfirmed) {
          location.href = `hapus.php?id=${dataID}`
        }
      })
    });

    const ubah = document.querySelector(".toggle-btn");
    ubah.addEventListener("click", function() {
      const fieldset = document.querySelector("fieldset");
      fieldset.toggleAttribute("disabled");
    });

    function showNewButton() {
      const tButton = document.querySelector(".toggle-btn");
      if (tButton.innerHTML === '<i class="fas fa-user-edit"></i> Ubah') {
        tButton.innerHTML = '<i class="fas fa-user-edit"></i> Batal';
      } else {
        tButton.innerHTML = '<i class="fas fa-user-edit"></i> Ubah';
      }
      const newButton = document.querySelector(".newButton");
      if (newButton.style.display === "none") {
        newButton.style.display = "";
      } else {
        newButton.style.display = "none";
      }
      const hapus = document.querySelector(".hapus");
      if (hapus.style.display === "none") {
        hapus.style.display = "";
      } else {
        hapus.style.display = "none";
      }
    }

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
