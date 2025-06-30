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
?>