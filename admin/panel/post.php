<?php

session_start();

if (!isset($_SESSION['login'])) {
  header("Location: ../../auth/login.php");
}

require_once '../../function/functions.php';
require_once '../../function/constant.php';
require_once '../../lib/functions.php';
require_once '../../assets/lib/Parsedown.php';

$parsedown = new Parsedown();

if (isset($_POST['preview'])) {
  $preview = preview($_POST);
  // var_dump($_POST);
  // var_dump($_FILES["gambar"]);
  // die;
}

if (isset($_POST['upload'])) {
  if (tambahPost($_POST) > 0) {
    $id = query("SELECT max(id) FROM post");
    echo "
      <script>
        alert('Data berhasil ditambahkan');
        document.location.href = '../../post/post.php?id=" . $id["max(id)"] . "';
      </script>
    ";
  } else {
    echo "
    <script>
      alert('Data gagal ditambahkan');
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
  <link rel="stylesheet" href="../../assets/css/bootstrap/bootstrap.css">
  <link rel="stylesheet" href="../../assets/css/fontawesome/all.css">
  <link rel="stylesheet" href="../../assets/css/highlight/<?= highlightTheme(); ?>.css">
  <link rel="stylesheet" href="../../assets/css/style.css">
  <link rel="stylesheet" href="../../assets/css/theme.css">
  <style>
    a {
      text-decoration: none;
    }

    code {
      border-radius: 5px;
    }
  </style>
  <title><?= getName(); ?> - Membuat Postingan</title>
  <link rel="icon" type="image/svg" href="../../<?= getFavIcon(); ?>">
</head>

<body class="bg-dark text-white">

  <!-- Start Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand custom-font" href="../../index.php"><i class="fab fa-github me-1"></i> <?= getName(); ?></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <ul class="nav navbar-nav ms-auto w-100 justify-content-end me-5">
          <a class="nav-link" aria-current="page" href="../index.php"><i class="fas fa-home"></i> Home</a>
          <a class="nav-link" href="../../post/index.php"><i class="fas fa-book"></i> Blog</a>
          <a class="nav-link" href="../../about/index.php"><i class="fas fa-address-card"></i> About</a>
          <li class="nav-item dropdown mt-2">
            <a class="dropdown-toggle text-white" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="text-decoration: none;"><i class="fas fa-user"></i> <?= $_SESSION['username']; ?></a>
            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarScrollingDropdown">
              <li><a class="dropdown-item" href="../index.php"><i class="fas fa-plus"></i> Tambah Post</a></li>
              <li><a href="../../auth/daftar.php" class="dropdown-item"><i class="fas fa-user-plus"></i> Tambah Admin</a></li>
              <li><a class="dropdown-item" href="../../pengaturan/index.php?id=<?= $_SESSION["id"]; ?>"><i class="fas fa-cog"></i> Pengaturan</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item logout" href="#" id="logout" data-id="<?= $_SESSION["id"]; ?>"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
            </ul>
          </li>
          <div class="text-center ms-3 mt-1">
            <label class="switch">
              <input type="checkbox">
              <span class="slider round toggle-theme"></span>
            </label>
          </div>
        </ul>
      </div>
    </div>
  </nav>
  <!-- End Navbar -->

  <!-- Start Form Tambah Post -->
  <div class="container mt-2 p-5">
    <div class="row">
      <div class="col-lg me-5 mb-5">
        <h4><i class="fab fa-markdown"></i> Markdown</h4>
        <form onsubmit="return submitForm(this);" action="" class="mt-4" method="POST" enctype="multipart/form-data">
          <?php if (isset($preview)) : ?>
            <div class="judul mb-4">
              <label class="form-label"><i class="fas fa-calendar-plus"></i> Judul</label>
              <textarea type="text" class="form-control bg-dark text-white" name="judul"><?= $preview['judul']; ?></textarea>
              <div class="form-text fst-italic">* Digunakan untuk judul pada postingan</div>
            </div>
            <div class="tags mb-4">
              <label class="form-label"><i class="fas fa-tags"></i> Tags</label>
              <textarea type="text" class="form-control bg-dark text-white" name="tags"><?= $preview['tags']; ?></textarea>
              <div class="form-text fst-italic">* Digunakan untuk tag pada postingan</div>
            </div>
            <div class="konten mb-4">
              <label class="form-label"><i class="fas fa-book"></i> Konten</label>
              <textarea class="form-control bg-dark text-white" rows="35" placeholder="Something Text here . . ." name="konten"><?= $preview['konten']; ?></textarea>
              <div class="form-text fst-italic">
                * Digunakan untuk konten (isi) pada postingan
                <br>
                * Note Penulisan untuk gambar (hapus tanda petik dua setelah <): <br>
                  <"a href="..." target="_blank">
                    <br>
                    <"img src="..." alt="..." class="img-fluid rounded mx-auto d-block" "/>
                    <br>
                  <" /a>
              </div>
            </div>
            <div class="gambar mb-4">
              <label class="form-label"><i class="fas fa-image"></i> Thumbnail</label>
              <img src="../../assets/img/post/default.png" class="img-preview img-fluid rounded">
              <input class="form-control gambar-preview bg-dark text-white mt-3" type="file" name="gambar" style="border: none;" value="<?= $_FILES["gambar"]; ?>" onchange="previewImage()">
            </div>
            <div class="button text-end">
              <button type="submit" class="btn btn-primary" name="preview"><i class="fas fa-eye"></i> Preview</button>
              <button type="submit" class="btn btn-success" name="upload"><i class="fas fa-upload"></i> Upload</button>
            </div>
          <?php endif; ?>
          <?php if (!isset($preview)) : ?>
            <div class="judul mb-4">
              <label class="form-label"><i class="fas fa-calendar-plus"></i> Judul</label>
              <textarea type="text" class="form-control bg-dark text-white" name="judul"></textarea>
              <div class="form-text fst-italic">* Digunakan untuk judul pada postingan</div>
            </div>
            <div class="tags mb-4">
              <label class="form-label"><i class="fas fa-tags"></i> Tags</label>
              <textarea type="text" class="form-control bg-dark text-white" name="tags"></textarea>
              <div class="form-text fst-italic">* Digunakan untuk tag pada postingan</div>
            </div>
            <div class="konten mb-4">
              <label class="form-label"><i class="fas fa-book"></i> Konten</label>
              <textarea class="form-control bg-dark text-white" rows="35" placeholder="Something Text here . . ." name="konten"></textarea>
              <div class="form-text fst-italic">
                * Digunakan untuk konten (isi) pada postingan
                <br>
                * Note Penulisan untuk gambar (hapus tanda petik dua setelah <): <br>
                  <"a href="..." target="_blank">
                    <br>
                    <"img src="..." alt="..." class="img-fluid rounded mx-auto d-block" "/>
                    <br>
                  <" /a>
              </div>
            </div>
            <div class="gambar mb-4">
              <label class="form-label"><i class="fas fa-image"></i> Thumbnail</label><br>
              <a href="../../assets/img/post/default.png" target="_blank">
                <img src="../../assets/img/post/default.png" class="img-preview img-fluid rounded">
              </a>
              <input class="form-control bg-dark text-white mt-3 gambar-preview" type="file" name="gambar" style="border: none;" onchange="previewImage()">
            </div>
            <div class="button text-end">
              <button type="submit" class="btn btn-primary" name="preview"><i class="fas fa-eye"></i> Preview</button>
              <button type="submit" class="btn btn-success" name="upload"><i class="fas fa-upload"></i> Upload</button>
            </div>
          <?php endif; ?>
        </form>
      </div>
      <div class="col-lg">
        <h4 class="preview"><i class="fas fa-eye"></i> Preview</h4>
        <div class="container mt-4">
          <?php if (isset($preview)) : ?>
            <?= $parsedown->text($preview['judul']); ?>
            <?= $parsedown->text('<span class="btn btn-light tag"><i class="fas fa-tag me-1"></i> ' . $preview['tags'] . '</span>'); ?>
            <?= $parsedown->text($preview['konten']); ?>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
  <!-- End Form Tambah Post -->


  <div class="container text-white">
    <div class="row">
      <div class="col-lg-auto">
        <button type="button" class="btn btn-success btn-floating btn-lg rounded-circle" id="btn-back-to-top">
          <i class="fas fa-arrow-up"></i>
        </button>
      </div>
    </div>
  </div>


  <script src="../../assets/js/bootstrap/bootstrap.js"></script>
  <script src="../../assets/js/highlight/highlight.min.js"></script>
  <!-- <script src="../../assets/js/highlight/highlightjs-line-numbers.min.js"></script> -->
  <script src="../../assets/js/script.js"></script>
  <script src="../../assets/js/sweetalert/sweetalert2.all.min.js"></script>
  <script src="../../assets/js/theme.js"></script>
  <script src="../../assets/js/previewimage.js"></script>
  <script>
    function submitForm() {
      return confirm('Apakah anda yakin?');
    };

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
          location.href = `../../auth/logout.php?id=${dataid}`
        }
      })
    });
  </script>
</body>

</html>
