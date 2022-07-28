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
  <link rel="stylesheet" href="../assets/css/login.css">
  <title><?= getName(); ?> - Login</title>
  <link rel="icon" type="image/svg" href="../<?= getFavIcon(); ?>">
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
  <div class="d-flex justify-content-center mb-5">
    <div class="mt-5">

      <div class="text-center fs-1">
        <i class="fa fa-boxes"></i>
        <h4 class="pt-3 mb-4">Sign in to blog</h4>
      </div>

      <?php if (isset($login['error'])) : ?>
        <div class="text-center mt-4 text-danger mb-4 border p-1">
          <i class="fas fa-exclamation-triangle">
            <span><?= $login['pesan']; ?></span>
          </i>
        </div>
      <?php endif; ?>

      <form class="rounded pt-2" method="post">

        <div class="mb-3" style="weight: 300px; width: 300px;">
          <label class="form-label">Username</label>
          <input type="text" name="username" class="form-control" id="username" required autofocus />
        </div>

        <div class="mb-3 password-field input-wrapper">
          <label class="form-label">Password</label>
          <input type="password" name="password" class="form-control" id="password" />
          <span id="togglePassword" class="text-muted"
            ><i
              class="fas fa-eye input-icon"
              id="iconTogglePassword"
              style="cursor: pointer"
            ></i
          ></span>
        </div>
        
        <div class="mb-3 ">
          <button
            class="w-100 btn btn-primary mt-2"
            type="submit"
            name="login"
          >
            Sign in
          </button>
        </div>
      </form>

    </div>
  </div>
  <!-- End Form Login -->



  <script
      src="https://code.jquery.com/jquery-3.6.0.js"
      integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
      crossorigin="anonymous">
  </script>
  <script src="../assets/js/bootstrap/bootstrap.js"></script>
  <script src="../assets/js/highlight/highlight.min.js"></script>
  <script src="../assets/js/highlight/highlightjs-line-numbers.min.js"></script>
  <script src="../assets/js/togglePassword.js"></script>
  <script src="../assets/js/script.js"></script>
  <script src="../assets/js/sweetalert/sweetalert2.all.min.js"></script>
  <script src="../assets/js/theme.js"></script>
</body>

</html>
