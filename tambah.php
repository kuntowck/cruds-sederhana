<?php
session_start();

if (!isset($_SESSION['login'])) {
  header('Location: login.php');
  exit;
}

require 'functions.php';

if (isset($_POST['tombol-tambah'])) {
  if (tambah($_POST) > 0) {
    echo "<script>
            alert('Data berhasil ditambahkan!');
            document.location.href = 'index.php';
          </script>";
  } else {
    echo "data gagal ditambahkan";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Data Warkop</title>
</head>

<body>
  <h3>Tambah Data Warkop</h3>
  <form method="post" action="" enctype="multipart/form-data">
    <li>
      <label for="tempat">Nama: </label>
      <input type="text" name="tempat" id="tempat" autofocus required>
    </li>
    <li>
      <label for="alamat">Alamat: </label>
      <input type="text" name="alamat" id="alamat" required>
    </li>
    <li>
      <label for="makanan">Makanan: </label>
      <input type="text" name="makanan" id="makanan" required>
    </li>
    <li>
      <label for="minuman">Minuman: </label>
      <input type="text" name="minuman" id="minuman" required>
    </li>
    <li>
      <label for="gambar">Gambar: </label>
      <input type="file" name="gambar" id="gambar" class="gambar" onchange="previewImage()">
      <img src="img/noimage.jpg" alt="No image" width="100" style="display: block;" class="image-preview">
    </li>
    <li>
      <button type="submit" name="tombol-tambah">Tambah data</button>
    </li>
  </form>

<script src="js/script.js"></script>
</body>

</html>