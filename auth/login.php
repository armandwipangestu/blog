<?php

session_start();

if (isset($_SESSION['login'])) {
  header("Location: ../admin/index.php");
}

require_once '../function/functions.php';
require_once '../function/constant.php';

if (isset($_POST['login'])) {
  $login = login($_POST);
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
  <title><?= getName(); ?> - Login</title>
</head>

<body class="bg-dark text-white">

  <!-- Start Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand custom-font" href="#"><i class="fab fa-github"></i> <?= getName(); ?></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ms-auto w-100 justify-content-end me-5">
          <a class="nav-link" aria-current="page" href="../index.php"><i class="fas fa-home"></i> Home</a>
          <a class="nav-link" href="../post/index.php"><i class="fas fa-book"></i> Blog</a>
          <a class="nav-link" href="../about/index.php"><i class="fas fa-address-card"></i> About</a>
          <a class="btn btn-light tombol" href="#"><i class="fas fa-user"></i> Login Admin</a>
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

  <!-- Start Form Login -->
  <div class="container">
    <div class="row justify-content-md-center">
      <div class="col-lg-7 mt-2 mb-5">
        <div class="container form">
          <div class="p-4 bg-dark text-white about mb-5" style="border-radius: 15px; margin-top: 5rem !important;">
            <h2 class="text-center">Login Administrator</h2>
            <?php if (isset($login['error'])) : ?>
              <div class="text-center mt-4 text-danger">
                <i class="fas fa-exclamation-triangle">
                  <span><?= $login['pesan']; ?></span>
                </i>
              </div>
            <?php endif; ?>
            <form method="post">
              <div class="row d-flex align-items-center justify-content-center">
                <div class="col-md-6">
                  <div class="text-secondary">
                    <div class="mt-4 mb-3">
                      <label class="form-label"><i class="fas fa-user"></i> Username</label>
                      <input type="text" class="form-control" name="username" autofocus autocomplete="off" required>
                    </div>
                    <div class="mb-3">
                      <label class="form-label"><i class="fas fa-lock"></i> Password</label>
                      <input type="password" class="form-control" name="password" required>
                    </div>
                    <div class="text-end">
                      <button type="submit" class="btn btn-success" name="login">Login <i class="fas fa-sign-out-alt"></i></button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Form Login -->


  <script src="../assets/js/bootstrap/bootstrap.js"></script>
  <script src="../assets/js/highlight/highlight.min.js"></script>
  <script src="../assets/js/highlight/highlightjs-line-numbers.min.js"></script>
  <script src="../assets/js/script.js"></script>
  <script src="../assets/js/sweetalert/sweetalert2.all.min.js"></script>
  <script src="../assets/js/theme.js"></script>
</body>

</html>
