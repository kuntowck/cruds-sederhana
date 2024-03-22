<?php
function koneksi()
{
  return mysqli_connect('localhost', 'root', '', 'warkop');
}

function query($query)
{
  $db = koneksi();
  $result = mysqli_query($db, $query);
  $rows = [];

  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }

  return $rows;
}

function tambah($data)
{
  $db = koneksi();

  $tempat = htmlspecialchars($data['tempat']);
  $alamat = htmlspecialchars($data['alamat']);
  $makanan = htmlspecialchars($data['makanan']);
  $minuman = htmlspecialchars($data['minuman']);
  $gambar = $data['gambar'];

  $query = "INSERT INTO menu
              VALUES
            (null, '$tempat', '$makanan', '$minuman', '$alamat', '$gambar');
           ";

  mysqli_query($db, $query) or die(mysqli_error($db));

  return mysqli_affected_rows($db);
}

function hapus($id)
{
  $db = koneksi();

  mysqli_query($db, "DELETE FROM menu WHERE id = $id") or die(mysqli_error($db));

  return mysqli_affected_rows($db);
}

function ubah($data)
{
  $db = koneksi();

  $id = $data['id'];
  $tempat = htmlspecialchars($data['tempat']);
  $alamat = htmlspecialchars($data['alamat']);
  $makanan = htmlspecialchars($data['makanan']);
  $minuman = htmlspecialchars($data['minuman']);
  $gambar = $data['gambar'];

  $query = "UPDATE menu SET
              tempat = '$tempat',
              makanan = '$makanan',
              minuman = '$minuman', 
              alamat = '$alamat',
              gambar = '$gambar'
            WHERE id = '$id'";

  mysqli_query($db, $query) or die(mysqli_error($db));

  return mysqli_affected_rows($db);
}


function cari($keyword)
{
  $db = koneksi();

  $query = "SELECT * FROM menu WHERE
            tempat LIKE '%$keyword%' OR
            alamat LIKE '%$keyword%'";

  $result = mysqli_query($db, $query);

  $rows = [];

  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }

  return $rows;
}

function login($data)
{
  $db = koneksi();

  $username = htmlspecialchars($data['username']);
  $password = htmlspecialchars($data['password']);

  $query = "SELECT * FROM user WHERE username = '$username'";

  if ($result = query($query)[0]) {
    if (password_verify($password, $result['password'])) {
      $_SESSION['login'] = true;
      
      header('Location: index.php');
      exit;
    }
  }

  return ['error' => 'true', 'pesan' => 'Username / Password salah!'];
}

function registrasi($data)
{
  $db = koneksi();

  $username = htmlspecialchars(strtolower($data['username']));
  $kpassword = mysqli_real_escape_string($db, $data['kpassword']);
  $password = mysqli_real_escape_string($db, $data['password']);

  // cek jika username udah terdaftar
  if (query("SELECT * FROM user WHERE username = '$username'")) {
    echo "<script>
            alert('Username sudah terdaftar');
            document.location.href = 'registrasi.php';
          </script>";
    return false;
  }

  // cek konfirmasi password tidak sesuai
  if ($kpassword !== $password) {
    echo "<script>
            alert('Konfirmasi password tidak sesuai');
            document.location.href = 'registrasi.php';
          </script>";
    return false;
  }

  // cek username dan passwrord sesuai
  $password = password_hash($password, PASSWORD_DEFAULT);

  $query = "INSERT INTO user VALUES ('', '$username', '$password')";

  mysqli_query($db, $query) or die(mysqli_error($db));
  return mysqli_affected_rows($db);
}
