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
    
    $photo = photoUpload();
    if (!$photo) {
      return false;
    }

    $query = "INSERT INTO patients VALUES('', '$name', '$birth_date', '$gender', '$photo')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
  }

  function photoUpload() {
    $photoName = $_FILES["photo"]["name"];
    $photoSize = $_FILES["photo"]["size"];
    $error = $_FILES["photo"]["error"];
    $photoTmpName = $_FILES["photo"]["tmp_name"];

    if ($error === 4) {
      echo "<script>
        alert('Pilih gambar dahulu');
      </script>";

      return false;
    }

    $validPhotoExtension = ["jpg", "jpeg", "png"];
    $photoExtension = explode(".", $photoName);
    $photoExtension = strtolower(end($photoExtension));
    if (!in_array($photoExtension, $validPhotoExtension)) {
      echo "<script>
        alert('Yang Anda upload bukan gambar bertipe jpg/jpeg/png');
      </script>";
    }

    if ($photoSize > 1000000) {
      echo "<script>
        alert('Ukuran gambar terlalu besar');
      </script>";
    }

    $newPhotoName = uniqid();
    $newPhotoName .= ".";
    $newPhotoName .= $photoExtension;
    move_uploaded_file($photoTmpName, "./img/patients-photo/" . $newPhotoName);

    return $newPhotoName;
  }

  function deletePatient($id) {
    global $conn;
    
    $photoFile = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM patients WHERE id='$id'"));
    unlink("./img/patients-photo/" . $photoFile["photo"]);
    mysqli_query($conn, "DELETE FROM patients WHERE id='$id'");
    return mysqli_affected_rows($conn);
  }

  function editPatient($data) {
    global $conn;

    $id = $data["id"];
    $name = htmlspecialchars($data["name"]);
    $birth_date = htmlspecialchars($data["birth_date"]);
    $gender = htmlspecialchars($data["gender"]);
    $oldPhoto = htmlspecialchars($data["oldPhoto"]);
    
    if ($_FILES["photo"]["error"] === 4) {
      $photo = $oldPhoto;
    } else {
      $photoFile = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM patients WHERE id='$id'"));
      unlink("./img/patients-photo/" . $photoFile["photo"]);
      
      $photo = photoUpload();
    }

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

  function search($keyword) {
    $query = "SELECT * FROM patients WHERE name LIKE '%$keyword%' OR birth_date LIKE '%$keyword%'";

    return query($query);
  }

  function filter($selectedGender) {
    $query = "SELECT * FROM patients WHERE gender = '$selectedGender'";

    return query($query);
  }
?>