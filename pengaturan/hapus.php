<?php

require '../function/functions.php';

// jika tidak ada id di url
if (!isset($_GET["id"])) {
  header("Location: ../index.php");
  exit;
}

// mengambil id dari URL
// var_dump($_GET);
// die;
// $id = $_GET["id"];
$id = $_GET["id"];

if (hapusUser($id) > 0) {
  // unlink('img/' . $gambar);
  echo "
        <script>
          alert('data berhasil dihapus');
          document.location.href = '../auth/logout.php';
        </script>
      ";
} else {
  echo "data gagal dihapus";
}
