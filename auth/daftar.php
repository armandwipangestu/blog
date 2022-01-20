<?php

session_start();

if (!isset($_SESSION['login'])) {
  header("Location: login.php");
}

require_once '../function/functions.php';
require_once '../function/constant.php';

if (isset($_POST['daftar'])) {
  // $daftar = daftar($_POST);
  // var_dump($daftar);
  if (daftar($_POST) > 0) {
    $success = [
      'success' => true,
      'pesan' => 'Admin baru berhasil ditambahkan'
    ];
  } else {
    $error = [
      'error' => true,
      'pesan' => 'Username sudah di gunakan'
    ];
    // header("Location: daftar.php");
  }
}

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
  <title><?= getName(); ?> - Daftar</title>
</head>

<body class="bg-light text-dark">

  <!-- Start Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand custom-font" href="#"><i class="fab fa-github"></i> <?= getName(); ?></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <ul class="nav navbar-nav ms-auto w-100 justify-content-end me-5">
          <a class="nav-link" aria-current="page" href="../index.php"><i class="fas fa-home"></i> Home</a>
          <a class="nav-link" href="../post/index.php"><i class="fas fa-book"></i> Blog</a>
          <a class="nav-link" href="#" id="errorAlert"><i class="fas fa-bookmark"></i> Note</a>
          <a class="nav-link" href="#" id="errorAlert"><i class="fas fa-address-card"></i> About</a>
          <?php if (isset($_SESSION['login'])) : ?>
            <li class="nav-item dropdown mt-2">
              <a class="dropdown-toggle text-white" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="text-decoration: none;"><i class="fas fa-user"></i> <?= $_SESSION['username']; ?></a>
              <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarScrollingDropdown">
                <li><a class="dropdown-item" href="../admin/index.php"><i class="fas fa-plus"></i> Tambah Post</a></li>
                <li><a href="auth/daftar.php" class="dropdown-item"><i class="fas fa-user-plus"></i> Tambah Admin</a></li>
                <li><a class="dropdown-item" href="../pengaturan/index.php?id=<?= $_SESSION["id"]; ?>"><i class="fas fa-cog"></i> Pengaturan</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="logout.php" id="logout"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
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
    </div>
  </nav>
  <!-- End Navbar -->

  <!-- Start Form Daftar -->
  <div class="container form">
    <div class="p-4 mt-4 bg-dark text-white about mb-5" style="border-radius: 15px; margin-top: 5rem !important;">
      <h1 class="text-center">Tambah Admin Baru</h1>
      <?php if (isset($error['error'])) : ?>
        <div class="text-center mt-4 text-danger">
          <i class="fas fa-exclamation-triangle">
            <span><?= $error['pesan']; ?></span>
          </i>
        </div>
      <?php endif; ?>
      <?php if (isset($success['success'])) : ?>
        <div class="text-center mt-4 text-success">
          <i class="fas fa-exclamation-triangle">
            <span><?= $success['pesan']; ?></span>
          </i>
        </div>
      <?php endif; ?>
      <form method="post">
        <div class="row d-flex align-items-center justify-content-center">
          <div class="col-md-6">

            <div class="mt-2 mb-3">
              <label for="username" class="form-label text-secondary mb-2"><i class="fas fa-user"></i> Username</label>
              <input type="text" name="username" id="username" class="form-control" autofocus value="<?= $u["username"]; ?>" required>
            </div>

            <div class="mb-3">
              <label class="form-label text-secondary"><i class="fas fa-lock"></i> Password</label>
              <input type="password" class="form-control" name="password" required>
            </div>

            <div class="text-end">
              <button type="submit" class="btn btn-light" name="daftar"><i class="fas fa-sign-out-alt"></i> Daftar</button>
            </div>

          </div>
        </div>
      </form>
    </div>
  </div>
  <!-- End Form Daftar -->


  <script src="../assets/js/bootstrap/bootstrap.js"></script>
  <script src="../assets/js/highlight/highlight.min.js"></script>
  <script src="../assets/js/highlight/highlightjs-line-numbers.min.js"></script>
  <script src="../assets/js/script.js"></script>
  <script src="../assets/js/sweetalert/sweetalert2.all.min.js"></script>
  <script src="../assets/js/theme.js"></script>
</body>

</html>