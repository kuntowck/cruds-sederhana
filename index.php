<?php
require 'functions.php';

$warkop = query("SELECT * FROM menu");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Warkop</title>
</head>

<body>
  <h3>Daftar Warkop</h3>

  <table border="1" cellspacing="0" cellpadding="10">
    <tr>
      <th>No.</th>
      <th>Nama</th>
      <th>Gambar</th>
      <th>Aksi</th>
    </tr>

    <?php $i = 1;
    foreach ($warkop as $w) : ?>
      <tr>
        <td><?= $i++; ?></td>
        <td><?= $w['tempat']; ?></td>
        <td><img src="img/<?= $w['gambar']; ?>" alt="<?= $w['gambar']; ?>" width="100"></td>
        <td><a href="detail.php?id=<?= $w['id']; ?>">Lihat detail</a></td>
      </tr>
    <?php endforeach; ?>
  </table>
</body>

</html>