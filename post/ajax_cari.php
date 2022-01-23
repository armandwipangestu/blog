<?php

session_start();

require '../function/functions.php';
require '../assets/lib/Parsedown.php';
$parsedown = new Parsedown();
$data = cari($_GET["keyword"]);
?>

<?php foreach ($data as $d) : ?>
  <div class="card mb-3 rounded">
    <?php if (pathinfo($d["thumbnail"], PATHINFO_EXTENSION) == "svg") : ?>
      <a href="post.php?id=<?= $d['id']; ?>">
        <div class="ratio ratio-16x9">
          <!-- <a href="../assets/img/post/<?= $d['thumbnail']; ?>" target="_blank"> -->
          <img src="../assets/img/post/<?= $d['thumbnail']; ?>" class="card-img-top" alt="<?= $d['thumbnail']; ?>">
        </div>
      </a>
    <?php endif; ?>
    <?php if (pathinfo($d["thumbnail"], PATHINFO_EXTENSION) == "png" || pathinfo($d["thumbnail"], PATHINFO_EXTENSION) == "jpg" || pathinfo($d["thumbnail"], PATHINFO_EXTENSION) == "jpeg") : ?>
      <!-- <a href="../assets/img/post/<?= $d['thumbnail']; ?>" target="_blank"> -->
      <a href="post.php?id=<?= $d['id']; ?>">
        <img src="../assets/img/post/<?= $d['thumbnail']; ?>" class="card-img-top" alt="<?= $d['thumbnail']; ?>">
      </a>
    <?php endif; ?>
    <div class="card-body bg-dark rounded-bottom">
      <a href="post.php?id=<?= $d['id']; ?>" class="link text-white">
        <h5 class="card-title"><?= $d['judul']; ?></h5>
      </a>
      <p class="text-muted">
        Postingan Dibuat: <?= $d['tanggal_dibuat']; ?>
        <br>
        <?php if (cekPerubahan($d['tanggal_diubah'])) : ?>
          Terakhir Diedit: <?= $d['tanggal_diubah']; ?>
        <?php endif; ?>
      </p>
      <!--
      <p>
        <?= potongText($parsedown->text($d['konten']), 300); ?>
      </p>
      -->
      <a href="post.php?id=<?= $d['id']; ?>">
        <?= '<span class="btn btn-light"><i class="fas fa-tag me-1"></i> ' . $d['tag'] . '</span>'; ?>
      </a>
      <br><br>
      <?php if (isset($_SESSION['login'])) : ?>
        <a class="btn btn-danger hapus" data-id="<?= $d["id"]; ?>"><i class="fas fa-trash me-1"></i> Hapus Post</a>
        <a href="ubah.php?id=<?= $d['id']; ?>" class="btn btn-warning"><i class="fas fa-pen me-1"></i> Ubah Post</a>
      <?php endif; ?>
    </div>
  </div>
<?php endforeach; ?>
