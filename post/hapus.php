<?php

require_once '../function/functions.php';

if (!isset($_GET['id'])) {
  header('Location: index.php');
  exit;
}

$id = $_GET['id'];

if (hapusPost($id) > 0) {
  echo "
  <script>
    alert('data berhasil dihapus');
    document.location.href = 'index.php';
  </script>
";
} else {
  echo "data gagal dihapus";
}
