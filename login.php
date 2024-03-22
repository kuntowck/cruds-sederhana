<?php 
session_start();

if (isset($_SESSION['login'])) {
  header('Location: index.php');
  exit;
}

require 'functions.php';

if (isset($_POST['tombol-login'])) {
  $login = login($_POST);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Login</title>
</head>
<body>
  <h3>Login</h3>

  <?php if (isset($login['error'])) : ?>
    <p><?= $login['pesan']; ?></p>
  <?php endif; ?>

  <form method="post" action="">
    <ul>
      <li>
        <label for="username">Username: </label>
        <input type="text" name="username" id="username" required autofocus autocomplete="off">
      </li>
      <li>
        <label for="password">Password: </label>
        <input type="password" name="password" id="password" required>
      </li>
      <li>
        <button type="submit" name="tombol-login">Login</button>
      </li>
    </ul>
  </form>
</body>
</html>