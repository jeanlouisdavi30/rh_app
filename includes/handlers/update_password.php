<?php
ob_start(); // turns on output buffering
$timezone = date_default_timezone_set("America/New_York");

    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

$password = "";
$password2 = "";
$updated = date("Y-m-d H:i:s");
$user_id = $_SESSION['user_id'];

$error_array = array();

if(isset($_POST['pass_button'])){


  //password
  $password = strip_tags($_POST['edit_password']);
  $password = str_replace(' ', '', $password);

  //email
  $password2 = strip_tags($_POST['edit_password2']);
  $password2 = str_replace(' ', '', $password2);

  if($password != $password2){
    array_push($error_array, "<span style='color: red'>Les mots de passe ne sont pas identiques<br></span>");
  }


  if(empty($error_array)){


   $password = md5($password); 
   
   $query = "UPDATE users SET password = '$password' WHERE id = $user_id";


   if (mysqli_query($con, $query)) {
    // echo "La mutuelle est enregistré avec succès";
    // envoie de l'email de confirmation a l'email ocinewdescri

    header("Location: profil_page.php");
    exit();

    }else {
    echo "Error: " . $query . "<br>" . $con->error;

  }

  mysqli_close($con);

  array_push($error_array, "<span style='color: #14c800'>You're all set ! Go ahead and login </span>" );


  }

}
