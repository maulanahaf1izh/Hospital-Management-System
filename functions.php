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
    $date = htmlspecialchars($data["date"]);
    $gender = htmlspecialchars($data["gender"]);
    $photo = htmlspecialchars($data["photo"]);
    $query = "INSERT INTO patients VALUES('', '$name', '$date', '$gender', '$photo')";
    mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
  }

  function deletePatient($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM patients WHERE id = $id");

    return mysqli_affected_rows($conn);
  }
?>