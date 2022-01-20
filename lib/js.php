<?php

require_once 'functions.php';
require_once 'Parsedown.php';

$parsedown = new Parsedown();

// if (isset($_POST['tombol'])) {
//   $preview = preview($_POST);
// }

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
  <title>Markdown</title>
  <style>
    .container .row .preview {
      margin-top: 3rem;
    }

    @media (min-width: 992px) {
      .container .row .preview {
        margin-top: -0rem;
      }
    }
  </style>
</head>

<body class="bg-dark text-white">

  <!-- Start Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand custom-font" href="#"><i class="fab fa-github"></i></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ms-auto w-100 justify-content-end me-5">
          <a class="nav-link" aria-current="page" href="#"><i class="fas fa-cog"></i> Demo</a>
        </div>
      </div>
    </div>
  </nav>
  <!-- End Navbar -->

  <div class="container mt-2 p-5">
    <div class="row">
      <div class="col-lg me-5">
        <h4><i class="fab fa-markdown"></i> Markdown</h4>
        <!-- <form action="" class="mt-4" method="POST"> -->
        <div class="judul mb-4">
          <label class="form-label"><i class="fas fa-calendar-plus"></i> Judul</label>
          <textarea type="text" class="form-control bg-dark text-muted judul-input" name="judul"></textarea>
          <div class="form-text fst-italic">* Digunakan untuk judul pada postingan</div>
        </div>
        <div class="tag mb-4">
          <label class="form-label"><i class="fas fa-tags"></i> Tags</label>
          <textarea type="text" class="form-control bg-dark text-muted" name="tags"></textarea>
          <div class="form-text fst-italic">* Digunakan untuk tag pada postingan</div>
        </div>
        <div class="konten mb-4">
          <label class="form-label"><i class="fas fa-book"></i> Konten</label>
          <textarea class="form-control bg-dark text-muted" rows="3" placeholder="Something Text here . . ." name="konten"></textarea>
          <div class="form-text fst-italic">* Digunakan untuk konten (isi) pada postingan</div>
        </div>
        <div class="button text-end">
          <button type="submit" class="btn btn-light" name="tombol"><i class="fas fa-eye"></i> Preview</button>
        </div>
        <!-- </form> -->
      </div>
      <div class="col-lg">
        <h4 class="preview"><i class="fas fa-eye"></i> Preview</h4>
        <div class="container mt-4 preview-colom">
          <!-- <?php if (isset($preview)) : ?>
            <?= $parsedown->text($preview['judul']); ?>
            <?= $parsedown->text('<i class="fas fa-tag text-primary"> ' . $preview['tags']) . '</i>'; ?>
            <?= $parsedown->text($preview['konten']); ?>
          <?php endif; ?> -->
        </div>
      </div>
    </div>
  </div>

  <!-- <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script> -->
  <script src="../assets/js/bootstrap/bootstrap.js"></script>
  <script src="../assets/js/highlight/highlight.min.js"></script>
  <script src="../assets/js/highlight/highlightjs-line-numbers.min.js"></script>
  <script src="../assets/js/script.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/markdown-it/12.0.6/markdown-it.min.js" integrity="sha512-7U8vY7c6UQpBNQOnBg3xKX502NAckvk70H1nWvh6W7izA489jEz+RCN3ntT1VMdXewaSKkOrEBegp/h6SPXrjw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="marked.min.js"></script>
  <script src="script.js"></script>
</body>

</html>