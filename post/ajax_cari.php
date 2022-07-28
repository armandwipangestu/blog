<?php

session_start();

require '../function/functions.php';
require '../assets/lib/Parsedown.php';
$parsedown = new Parsedown();
$data = cari($_GET["keyword"]);
?>

<?php foreach ($data as $d) : ?>

  <div class="col-md-3 p-2 mb-3">
      <div class="card p-3 mb-2 bg-dark text-light" style="border: 1px solid #a4a6a8; cursor: pointer;" data-id="<?= $d["id"]; ?>">
          <div class="d-flex justify-content-between">
              <div class="d-flex flex-row align-items-center ratio ratio-16x9">
                <a href="post.php?id=<?= $d["id"] ?>" style="text-decoration: none; color: inherit;">
                  <img src="../assets/img/post/<?= $d['thumbnail']; ?>" alt="<?= $d['thumbnail']; ?>" class="card-img-top img-fluid" style="border-radius: 10px 10px 0 0;" />
                </a>
              </div>
          </div>
          <div class="mt-4 ms-3">
            <a href="post.php?id=<?= $d["id"] ?>" style="text-decoration: none; color: inherit;"><h5 class="heading"><?= $d['judul']; ?></h5></a>
              <?php
                $tags = $d["tag"];
                $tag = explode(" ", $tags);
                foreach ($tag as $t) :
              ?>

                <span class="card-text tag mt-2"><i class="fas fa-tags me-1"></i><?= $t; ?></span>
              <?php endforeach; ?>
              <br><small class="text-muted" style="font-size: 0.8rem;"><?= timeAgo($d["tanggal_dibuat"]); ?></small><br>
          </div>
      </div>
  </div>
<?php endforeach; ?>