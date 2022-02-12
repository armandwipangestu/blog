<?php

session_start();

require '../function/functions.php';
require '../assets/lib/Parsedown.php';
$parsedown = new Parsedown();
$data = cari($_GET["keyword"]);
?>

<?php foreach ($data as $d) : ?>
  <div class="col mb-5 rounded">
    <div class="card h-100" style="border-color: #a4a6a8;">
      <div class="ratio ratio-16x9">
        <img class="card-img-top" src="../assets/img/post/<?= $d['thumbnail']; ?>" alt="<?= $d['thumbnail']; ?>">
      </div>
      <div class="card-body bg-light text-dark">
        <h5 class="card-title"><?= $d['judul']; ?></h5>
        <!-- <p class="card-text"><?= potongText($d['konten'], 5); ?></p> -->
        <span class="card-text tag"><i class="fas fa-tags me-1"></i> <?= $d['tag']; ?></span><br>
        <small class="text-muted" style="font-size: .675rem;">Created <?= $d['tanggal_dibuat']; ?></small><br>
        <?php if (cekPerubahan($d['tanggal_diubah'])) : ?>
          <small class="text-muted" style="font-size: .675rem;">Last updated <?= $d['tanggal_diubah']; ?></small>
        <?php endif; ?>
      </div>
      <div class="card-footer bg-light text-dark" style="border: none;">
        <div class="text-end mb-3">
          <a href="post.php?id=<?= $d['id']; ?>" class="btn btn-primary text-end" style="font-size: .700rem;">
            Read More <i class="fas fa-sign-in-alt"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>
