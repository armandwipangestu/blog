<?php

require_once 'Parsedown.php';

$parsedown = new Parsedown();

$text = file_get_contents('file.txt');

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../assets/css/highlight/dracula.css">
  <title>Parsing Markdown</title>
</head>

<body>
  <?= $parsedown->text($text);; ?>
  <script src="../assets/js/highlight/highlight.min.js"></script>
  <script src="../assets/js/highlight/highlightjs-line-numbers.min.js"></script>
  <script src="../assets/js/script.js"></script>
</body>

</html>