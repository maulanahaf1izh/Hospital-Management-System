<?php 
  require "functions.php";
  $patients = query("SELECT * FROM patients");
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
          <img src="./img/patients-photo/<?= $patient["photo"] ?>" alt="<?= $patient["name"] ?>">
        </td>
        <td><?= $patient["name"] ?></td>
        <td><?= $patient["birth_date"] ?></td>
        <td><?= $patient["gender"] ?></td>
        <td>
          <a href="deletePatient.php?id=<?= $patient["id"] ?>" onclick='return confirm("Yakin menghapus data?")'>Hapus</a>
          |
          <a href="editPatient.php?id=<?= $patient["id"] ?>">Edit</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
</body>
</html>