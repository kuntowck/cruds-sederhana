<?php 
  require 'functions.php';

  $id = $_GET['id'];
  $w = query("SELECT * FROM menu WHERE id = $id");

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Warkop</title>
</head>
<body>
  <h3>Detail Data Warkop</h3>
  
  <ul>
    <li><img src="img/<?= $w['gambar']; ?>" alt="<?= $w['gambar']; ?>"></li>
    <li>Nama: <?= $w['tempat']; ?></li>
    <li>Alamat: <?= $w['alamat']; ?></li>
    <li>Makanan: <?= $w['makanan']; ?></li>
    <li>Minuman: <?= $w['minuman']; ?></li>
    <li>
      <a href="">Ubah</a> | 
      <a href="">Hapus</a>
    </li>
    <li><a href="index.php">Kembali ke daftar warkop</a></li>
  </ul>
</body>
</html>