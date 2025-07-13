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

  <form action="" method="post" enctype="multipart/form-data">
    <div>
      <label for="name">Nama Pasien</label>
      <input type="text" id="name" name="name" placeholder="Masukkan nama pasien" required>
    </div>
    <div>
      <label for="birth_date">Tanggal Lahir Pasien</label>
      <input type="date" id="birth_date" name="birth_date" placeholder="Masukkan nama pasien" required>
    </div>
    <div>
      <label>Jenis Kelamin Pasien</label>
      <br>
      <input type="radio" id="male" name="gender" value="Male" required><label for="male">Laki-laki</label>
      <input type="radio" id="female" name="gender" value="Female"><label for="female">Perempuan</label>
    </div>
    <div>
      <label for="photo">Foto Pasien</label>
      <input type="file" id="photo" name="photo" required>
    </div>
    <button type="submit" name="submit">Tambah</button>
  </form>
</body>
</html>