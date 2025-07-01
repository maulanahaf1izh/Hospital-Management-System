<?php 
  $conn = mysqli_connect("localhost", "root", "", "hospital-management-system");

  function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $patients = [];
    while ($patient = mysqli_fetch_assoc($result)) {
      $patients[] = $patient;
    }

    return $patients;
  }

  function addPatient($data) {
    global $conn;
    $name = htmlspecialchars($data["name"]);
    $birth_date = htmlspecialchars($data["birth_date"]);
    $gender = htmlspecialchars($data["gender"]);
    $photo = htmlspecialchars($data["photo"]);
    $query = "INSERT INTO patients VALUES('', '$name', '$birth_date', '$gender', '$photo')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
  }

  function deletePatient($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM patients WHERE id = $id");

    return mysqli_affected_rows($conn);
  }

  function editPatient($data) {
    global $conn;

    $id = $data["id"];
    $name = htmlspecialchars($data["name"]);
    $birth_date = htmlspecialchars($data["birth_date"]);
    $gender = htmlspecialchars($data["gender"]);
    $photo = htmlspecialchars($data["photo"]);
    $query = "UPDATE patients SET
      name = '$name',
      birth_date = '$birth_date',
      gender = '$gender',
      photo = '$photo'
      WHERE id = $id
    ";
    mysqli_query($conn, $query);

   return mysqli_affected_rows($conn);
  }
?>