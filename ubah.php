<?php 
session_start();

if (!isset($_SESSION['login'])) {
  header('Location: login.php');
  exit;
}

require 'functions.php';

// cek GET id di URL
if (!isset($_GET['id'])) {
  header('Location: index.php');
  exit;
}

$id = $_GET['id'];

$w = query("SELECT * FROM menu WHERE id = $id")[0];


if (isset($_POST['tombol-ubah'])) {
  if (ubah($_POST) > 0) {
    echo "<script>
            alert('Data berhasil diubah!');
            document.location.href = 'index.php';
          </script>";
  } else {
    echo "data gagal diubah";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Ubah</title>
</head>
<body>
  <h3>Ubah Data Warkop</h3>

  <form method="post" action="" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $w['id'];?> ">
    <ul>
      <li>
        <label for="tempat">Nama: </label>
        <input type="text" name="tempat" id="tempat" autofocus value="<?= $w['tempat']; ?>">
      </li>
      <li>
        <label for="alamat">Alamat: </label>
        <input type="text" name="alamat" id="alamat" value="<?= $w['alamat']; ?>">
      </li>
      <li>
        <label for="makanan">Makanan: </label>
        <input type="text" name="makanan" id="makanan" value="<?= $w['makanan']; ?>">
      </li>
      <li>
        <label for="minuman">Minuman: </label>
        <input type="text" name="minuman" id="minuman" value="<?= $w['minuman']; ?>">
      </li>
      <li>
        <input type="hidden" name="gambar-lama" value="<?= $w['gambar']; ?>">
        <label for="gambar">Gambar: </label>
        <br>
        <img width="100" src="img/<?= $w['gambar']; ?>" alt="<?= $w['gambar']; ?>">
        <br>
        <input type="file" name="gambar" id="gambar">
      </li>
      <li>
        <button type="submit" name="tombol-ubah">Ubah data</button>
      </li>
    </ul>
  </form>
</body>
</html>