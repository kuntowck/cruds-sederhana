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

  if (mysqli_num_rows($result) == 1) {
    return mysqli_fetch_assoc($result);
  } else {
    while ($row = mysqli_fetch_assoc($result)) {
      $rows[] = $row;
    }
  }


  return $rows;
}
