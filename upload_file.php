<?php
require "config/config.php";
$target_dir = "images/uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

$nom_fichier = basename($_FILES["fileToUpload"]["name"]); 
$description = "Description du fichier";
$chemin = "";
$created = date("Y-m-d H:i:s");
$updated = date("Y-m-d H:i:s");


// Check if image file is a actual image or fake image
if(isset($_POST["submit_file"]) && isset($_POST["fileToUpload"])) {
  $uploadOk = 1;
  $nom_fichier = $_POST["fileToUpload"]; 

}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" && $imageFileType != "pdf" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF & PDF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0 ) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

    $employee_id = $_SESSION['employee_id'];
    $filename = "images/uploads/" . htmlspecialchars( basename( $_FILES["fileToUpload"]["name"]));

    //$_SESSION['emp_picture'] = $filename;

    $description = $_POST['file_description'];

    $nom_fichier = htmlspecialchars( basename( $_FILES["fileToUpload"]["name"]));

    $query = "INSERT INTO files VALUES (NULL, '$employee_id', '$nom_fichier', '$description', '$filename', '$created', '$updated')";

    

    if (mysqli_query($con, $query)) {
    
    }else {
    echo "Error: " . $query . "<br>" . $con->error;

    }

    mysqli_close($con);

    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
    header('Location: file_page.php');
	exit();

  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
?>