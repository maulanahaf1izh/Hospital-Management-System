<?php 
  require "functions.php";

  $id = $_GET["id"];
  $patient = query("SELECT * FROM patients WHERE id = $id")[0];

  if (isset($_POST["submit"])) {
    if (editPatient($_POST) > 0) {
      echo "<script>
        alert('Data berhasil diedit');
        document.location.href = 'index.php';
      </script>";
    } else {
      echo "<script>
        alert('Data gagal diedit);
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
  <title>Edit Patient</title>
</head>
<body>
  <h1>Edit Data Pasien</h1>

  <a href="index.php">Kembali</a>

  <form action="" method="post">
    <input type="hidden" name="id" value="<?= $patient["id"] ?>">
    <div>
      <label for="name">Nama Pasien</label>
      <input type="text" id="name" name="name" placeholder="Masukkan nama pasien" required value=<?= $patient["name"] ?>>
    </div>
    <div>
      <label for="birth_date">Tanggal Lahir Pasien</label>
      <input type="date" id="birth_date" name="birth_date" placeholder="Masukkan nama pasien" required value=<?= $patient["birth_date"] ?>>
    </div>
    <div>
      <label>Jenis Kelamin Pasien</label>
      <br>
      <input type="radio" id="male" name="gender" value="Male" required <?php if ($patient["gender"] == "Male") {
        echo "checked";
      } ?>><label for="male">Laki-laki</label>
      <input type="radio" id="female" name="gender" value="Female" <?php if ($patient["gender"] == "Female") {
        echo "checked";
      } ?>><label for="female">Perempuan</label>
    </div>
    <div>
      <label for="photo">Foto Pasien</label>
      <input type="text" id="photo" name="photo" required value=<?= $patient["photo"] ?>>
    </div>
    <button type="submit" name="submit">Tambah</button>
  </form>
</body>
</html>