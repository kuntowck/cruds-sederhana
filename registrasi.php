<?php
session_start();

require 'functions.php';

if (isset($_POST['tombol-regis'])) {
  if (registrasi($_POST) > 0) {
    echo "<script>
            alert('User berhasil dibuat! Silakan login.')
            document.location.href = 'login.php';
          </script>";
  } else { 
    echo "<script>
            alert('User gagal dibuat.')
            document.location.href = 'registrasi.php';
          </script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Registrasi</title>
</head>

<body>
  <h3>Form Registrasi</h3>

  <form method="post" action="">
    <ul>
      <li>
        <label for="username">Username: </label>
        <input type="text" name="username" id="username" required autocomplete="off" autofocus>
      </li>
      <li>
        <label for="kpassword">Konfirmasi Password: </label>
        <input type="password" name="kpassword" id="kpassword" required>
      </li>
      <li>
        <label for="password">Password: </label>
        <input type="password" name="password" id="password" required>
      </li>
      <li>
        <button type="submit" name="tombol-regis">Submit</button>
      </li>
    </ul>
  </form>
</body>

</html>