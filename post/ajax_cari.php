<?php

session_start();

require '../function/functions.php';
require '../assets/lib/Parsedown.php';
$parsedown = new Parsedown();
$data = cari($_GET["keyword"]);
?>

<?php foreach ($data as $d) : ?>
	<div class="col rounded">
    <div class="card h-100 bg-dark text-light" style="border-color: #a4a6a8;">
      <div class="ratio ratio-16x9">
        <img src="../assets/img/post/<?= $d['thumbnail']; ?>" alt="<?= $d['thumbnail']; ?>" class="card-img-top img-fluid" />
      </div>
      <div class="card-body bg-dark text-light">
        <h5 class="card-title"><?= $d['judul']; ?></h5>
        <?php
          $tags = $d["tag"];
          $tag = explode(" ", $tags);
          foreach ($tag as $t) :
        ?>
          <span class="card-text tag"><i class="fas fa-tags me-1"></i> <?= $t; ?></span>
        <?php endforeach; ?>
        <br><small class="text-muted" style="font-size: 0.8rem;">Created <?= $d['tanggal_dibuat']; ?></small><br>
        <?php if (cekPerubahan($d['tanggal_diubah'])) : ?>
          <small class="text-muted" style="font-size: 0.8rem;">Last updated <?= $d['tanggal_diubah']; ?></small>
        <?php endif; ?>
      </div>
      <div class="card-footer bg-dark text-light text-end">
        <a href="post.php?id=<?= $d['id']; ?>" class="btn btn-primary text-end">
          Read More
          <i class="fas fa-sign-in-alt ms-1"></i>
        </a>
      </div>
    </div>
  </div>
<?php endforeach; ?>