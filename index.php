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

  <a href="tambah.php">Tambah data</a>
  <br><br>

  <table border="1" cellspacing="0" cellpadding="10">
    <tr>
      <th>#</th>
      <th>Nama</th>
      <th>Gambar</th>
      <th>Alamat</th>
      <th>Makanan</th>
      <th>Minuman</th>
      <th>Aksi</th>
    </tr>

    <?php $i = 1;
    foreach ($warkop as $w) : ?>
      <tr>
        <td><?= $i++; ?></td>
        <td><?= $w['tempat']; ?></td>
        <td><img width="100" src="img/<?= $w['gambar']; ?>" alt=""></td>
        <td><?= $w['alamat']; ?></td>
        <td><?= $w['makanan']; ?></td>
        <td><?= $w['minuman']; ?></td>
        <td>
          <a href="ubah.php?id=<?= $w['id']; ?>">Ubah</a> | 
          <a href="hapus.php?id=<?= $w['id']; ?>" onclick="return confirm('Apakah Anda yakin?')">Delete</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
</body>

</html>