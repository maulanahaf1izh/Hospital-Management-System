<?php 
  require "functions.php";
  if (isset($_POST["submit"])) {
    if (addPatient($_POST) > 0) {
      echo "<script>
        alert('Data berhasil ditambahkan');
        document.location.href = 'index.php';
      </script>";
    } else {
      echo "<script>
        alert('Data gagal ditambahkan);
        document.location.href = 'index.php';
      </script>";
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Patient</title>
</head>
<body>
  <h1>Tambah Data Pasien</h1>

  <a href="index.php">Kembali</a>

  <form action="" method="post">
    <div>
      <label for="name">Nama Pasien</label>
      <input type="text" id="name" name="name" placeholder="Masukkan nama pasien" required>
    </div>
    <div>
      <label for="date">Tanggal Lahir Pasien</label>
      <input type="date" id="date" name="date" placeholder="Masukkan nama pasien" required>
    </div>
    <div>
      <label>Jenis Kelamin Pasien</label>
      <br>
      <input type="radio" id="laki-laki" name="gender" value="laki-laki" required><label for="laki-laki">Laki-laki</label>
      <input type="radio" id="perempuan" name="gender" value="perempuan"><label for="perempuan">Perempuan</label>
    </div>
    <div>
      <label for="photo">Foto Pasien</label>
      <input type="text" id="photo" name="photo" required>
    </div>
    <button type="submit" name="submit">Tambah</button>
  </form>
</body>
</html>