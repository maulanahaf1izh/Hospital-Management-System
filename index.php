<?php 
  require "functions.php";
  $patients = query("SELECT * FROM patients");

  if (isset($_POST["search"])) {
    $patients = search($_POST["keyword"]);
  }

  if (isset($_POST["filter"])) {
    if (!isset($_POST["gender"])) {
      $patients = query("SELECT * FROM patients");
    } else {
      $gender = $_POST["gender"];

      if (in_array("Male", $gender) && in_array("Female", $gender)) {
        $patients = query("SELECT * FROM patients");
      } else {
        $selectedGender = implode(", ", $gender);
        $patients = filter($selectedGender);
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hospital Management System</title>
</head>
<body>
  <h1>Sistem Manajemen Rumah Sakit</h1>

  <h3>Daftar Pasien</h3>

  <form action="" method="post">
    <input type="text" name="keyword" autofocus placeholder="Masukkan kata kunci pencarian!" autocomplete="off">
    <button type="submit" name="search">Cari</button>
  </form>

  <form action="" method="post">
    <p>Filter berdasarkan gender</p>

    <input type="checkbox" name="gender[]" value="Male" id="Male"><label for="Male">Laki-laki</label>

    <input type="checkbox" name="gender[]" value="Female" id="Female"><label for="Female">Perempuan</label>

    <button type="submit" name="filter">Filter</button>
  </form>

  <a href="addPatient.php">Tambah Pasien</a>

  <table border="1" cellspacing="0" cellpadding="10">
    <tr>
      <th>No</th>
      <th>Foto</th>
      <th>Nama</th>
      <th>Tanggal Lahir</th>
      <th>Jenis Kelamin</th>
      <th>Aksi</th>
    </tr>
    <?php foreach ($patients as $index => $patient) : ?>
      <tr>
        <td><?= $index + 1 ?></td>
        <td>
          <img src="./img/patients-photo/<?= $patient["photo"] ?>" alt="<?= $patient["name"] ?>" width="100">
        </td>
        <td><?= $patient["name"] ?></td>
        <td><?= $patient["birth_date"] ?></td>
        <td><?= $patient["gender"] ?></td>
        <td>
          <a href="editPatient.php?id=<?= $patient["id"] ?>">Edit</a>
          |
          <a href="deletePatient.php?id=<?= $patient["id"] ?>" onclick='return confirm("Yakin menghapus data?")'>Hapus</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
</body>
</html>