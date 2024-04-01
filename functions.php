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

  $gambar = upload();
  if (!$gambar) {
    return false;
  }

  $query = "INSERT INTO menu
              VALUES
            (null, '$tempat', '$makanan', '$minuman', '$alamat', '$gambar');
           ";

  mysqli_query($db, $query) or die(mysqli_error($db));

  return mysqli_affected_rows($db);
}

function upload()
{
  $namaFile = $_FILES['gambar']['name'];
  $tipeFile = $_FILES['gambar']['type'];
  $ukuranFile = $_FILES['gambar']['size'];
  $error = $_FILES['gambar']['error'];
  $tmpFile = $_FILES['gambar']['tmp_name'];

  // cek validasi gambar jika user tidak upload
  if ($error === 4) {
    echo "<script>
            alert('Upload gambar dahulu.')
          </script>";

    return false;
  }

  // cek ekstensi file
  $daftarEkstensi = ['jpg', 'jpeg', 'png'];
  $ekstensiFile = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));
  if (!in_array($ekstensiFile, $daftarEkstensi)) {
    echo "<script>
            alert('Apa yang Anda upload bukan gambar.')
          </script>";

    return false;
  }

  // cek type file
  if ($tipeFile != 'image/jpeg' && $tipeFile != 'image/png') {
    echo "<script>
            alert('Apa yang Anda upload bukan gambar.')
          </script>";

    return false;
  }

  // cek ukuran file
  if ($ukuranFile > 5000000) {
    echo "<script>
            alert('Ukuran file terlalu besar (Maks. 5 MB)')
          </script>";

    return false;
  }

  // generate nama file baru
  $namaFileBaru = uniqid();
  $namaFileBaru .= '.';
  $namaFileBaru .= $ekstensiFile;

  // upload file
  move_uploaded_file($tmpFile, 'img/' . $namaFileBaru);

  return $namaFileBaru;
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
