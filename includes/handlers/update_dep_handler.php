<?php
ob_start(); // turns on output buffering
$timezone = date_default_timezone_set("America/New_York");

    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 


if(isset($_GET['mod_dep_id'] )){
  $dep_id = $_GET['mod_dep_id'];

  $sql = "SELECT * FROM dependants WHERE id = $dep_id";

  
  $result = $con->query($sql);

  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      
      $dep_employee_id = $_SESSION['employee_id'];
      $dep_id = $row["id"];
      $dep_lastname = $row["lastname"];
      $dep_firstname = $row["firstname"];
      $dep_sexe = $row["sexe"];
      $dep_birthdate = $row["birthdate"];
      $dep_phone = $row["phone"];
      $dep_email = $row["email"];
      $dep_address = $row["address1"];
      $dep_link = $row["link"];
      $dep_emergency = $row["emergency1"];

    }
  } else {
    echo "0 results";
  }
  $con->close();

}

$employee_id = $_SESSION['employee_id'];
$dep_id = "";
$lastname = "";
$firstname = "";
$sexe = "";
$birthdate = "";
$email = "";
$phone = "";
$address = "";
$link = "";
$emergency = "";
$updated = date("Y-m-d H:i:s");

$error_array = array();

if(isset($_POST['dep_button'])){

  //Lastname
  $dep_id = strip_tags($_POST['dep_id']);
  $dep_id = ucfirst(strtolower(($dep_id)));

  //Lastname
  $lastname = strip_tags($_POST['dep_lastname']);
  $lastname = ucfirst(strtolower(($lastname)));

  //firstname 
  $firstname = strip_tags($_POST['dep_firstname']);
  $firstname = ucfirst(strtolower(($firstname)));

  //sexe 
  $sexe = strip_tags($_POST['dep_sexe']);

  //birthdate 
  $birthdate = strip_tags($_POST['dep_birthdate']);

  // Telephone 
  $phone = strip_tags($_POST['dep_phone']);
  $phone = str_replace(' ', '', $phone);
 

  //email du mutuelle
  $email = strip_tags($_POST['dep_email']);

  //Adresse de la mutuelle
  $address = strip_tags($_POST['dep_address']);

  //Representant du mutuelle
  $link = strip_tags($_POST['dep_link']);
  $link = ucfirst(strtolower(($link)));

  //Representant du mutuelle
  $emergency = strip_tags($_POST['dep_emergency']);


/*
  $date_creation = date("Y-m-d");

    //Check if the email is in valid format
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
      $email = filter_var($email, FILTER_VALIDATE_EMAIL);

      // check if email already exists
      $e_check = mysqli_query($con, "SELECT user_id FROM employees WHERE user_id='$user_id'");

      //count the number of rows returned

      $num_row = mysqli_num_rows($e_check);

      if($num_row > 0 ){
        array_push($error_array, "<span style='color: red'>Les données de cet utilisateur sont déja enregistréés<br></span>" );
      }


    }else{
      array_push($error_array, "<span style='color: red'>Le format d'email n'est pas valid<br></span>" );
    }


  if (strlen($lastname) > 50 || strlen($lastname) < 2 ) {
    array_push($error_array, "<span style='color: red'>Le nom de famille doit contenir entre 2 and 50 charactères au moins <br></span>");
  }

  if (strlen($firstname) > 50 || strlen($firstname) < 2 ) {
    array_push($error_array, "<span style='color: red'>Le prénom doit contenir entre 2 and 50 charactères au moins <br></span>");
  }

  if (strlen($sexe) >= 1 || strlen($sexe) <= 1 ) {
    array_push($error_array, "<span style='color: red'>Le sexe doit contenir entre 1 charactère <br></span>");
  }

  if (strlen($nif) > 50 || strlen($nif) < 2 ) {
    array_push($error_array, "<span style='color: red'>Le nif doit contenir entre 2 and 50 character<br></span>");
  }

  if (strlen($phone) > 15 || strlen($phone) < 8 ) {
    array_push($error_array, "<span style='color: red'>Votre numéro de téléphone n'est pas valid<br></span>");
  }

  if (strlen($address1) > 200 || strlen($address1) < 2 ) {
    array_push($error_array, "<span style='color: red'>l'adresse doit contenir entre 2 and 200 charactères<br></span>");
  }

  if (strlen($address1) > 200 || strlen($address1) < 2 ) {
    array_push($error_array, "<span style='color: red'>le second adresse doit contenir entre 2 and 200 charactères<br></span>");
  }

  if (strlen($matrimonial) > 100 || strlen($matrimonial) < 2 ) {
    array_push($error_array, "<span style='color: red'>Le statut matrimonial doit  contenir entre 2 à 100 charactères<br></span>");
  }

  if (strlen($nbr_child) >= 10 || strlen($nbr_child) <= 1 ) {
    array_push($error_array, "<span style='color: red'>Le nombre doit ètre entre 2 and 25 charactères<br></span>");
  }

  if (strlen($bank_name) > 25 || strlen($bank_name) < 2 ) {
    array_push($error_array, "<span style='color: red'>Le nom du département doit contenir entre 2 and 25 charactères<br></span>");
  }

  if (strlen($bank_number) > 25 || strlen($bank_number) < 2 ) {
    array_push($error_array, "<span style='color: red'>Le numéro du compte doit contenir entre 2 and 25 charactères<br></span>");
  }

*/

  if(empty($error_array)){
   // $password = md5($password); //Encript the password before insert it into the SQLiteDatabase

    //generate username by caractere first name and lastname
    /*
    $username = strtolower($fname . "_" . $lname);
    $check_user_name_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");

    $i = 0; */

    //if email exists add number to $username
    /*
    while(mysqli_num_rows($check_user_name_query) != 0){
      $i++; // ad 1 to i
      $username = $username . "_" . $i;
      $check_user_name_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
    } */

    //profile pic
    /*
    $rand = rand(1, 2);

    if($rand == 1){
      $profile_pic = "assets/images/profil_pics/default/head_alizarin.png";
    }else {
      $profile_pic = "assets/images/profil_pics/default/head_belize_hole.png";
    } */

   $query = "UPDATE dependants SET lastname = '$lastname', firstname = '$firstname', birthdate = '$birthdate', sexe = '$sexe', phone = '$phone', email = '$email', address1 = '$address', link = '$link', emergency1 = '$emergency', updated = '$updated' WHERE id = $dep_id ";
/*

$user_id = $_SESSION['user_id'];
$lastname = "";
$firstname = "";
$sexe = "";
$nif ="";
$birthdate ="";
$email = "";
$phone = "";
$address1 = "";
$address2 = "";
$matrimonial = "";
$nbr_child = "";
$bank_name = "";
$bank_number = "";
$picture = "";
$created = date("Y-m-d H:i:s");
$updated = date("Y-m-d H:i:s");








   $last_id = mysqli_insert_id($con);

   $to = $email;
   $subject = "Musomobil, validation de compte";
   $message="<html><head>";
   $message .= "<title>Validation de votre compte musomobil</title>";
   $message .= "</head><body>";
   $message .= "<h3><img src=\"http://musomobil.org/logo-muso-mobil2.png/\" height=\"20px\"> MUSOMOBIL <br></h3>";
   $message .= "<h3>Valider votre compte musomobil en cliquant sur ce lien: <br></h3>";
   $message .= "<a href=\"https://musomobil.org/valider_email.php?id_valid=$last_id\">Valider votre compte musomobil</a>";
   $message .= "</body></html>";
   $headers  = "MIME-Version: 1.0" . "\r\n";
   $headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";
   $headers .= "From: info@musomobil.org" . "\r\n";
   $headers .= 'Bcc:jeanlouisdavi30@yahoo.fr';

   mail($to, $subject, $message, $headers);
*/

   if (mysqli_query($con, $query)) {
    // echo "La mutuelle est enregistré avec succès";
    // envoie de l'email de confirmation a l'email ocinewdescrit
      $last_id = mysqli_insert_id($con);

      $to = $email;
      $subject = "Musomobil, validation de compte";
      $message="<html><head>";
      $message .= "<title>Validation de votre compte musomobil</title>";
      $message .= "</head><body>";
      $message .= "<h3><img src=\"http://musomobil.org/logo-muso-mobil2.png\" height=\"20px\"> MUSOMOBIL <br></h3>";
      $message .= "<h3>Valider votre compte musomobil en cliquant sur ce lien: <br></h3>";
      $message .= "<a href=\"https://musomobil.org/valider_email.php?id_valid=$last_id\">Valider votre compte musomobil</a>";
      $message .= "</body></html>";
      $headers  = "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n"; //Content-type: text/html; charset=UTF-8
      $headers .= "From: info@musomobil.org" . "\r\n";
      $headers .= 'Bcc:jeanlouisdavi30@yahoo.fr';

      mail($to, $subject, $message, $headers);


    }else {
    echo "Error: " . $query . "<br>" . $con->error;

  }

  mysqli_close($con);

  array_push($error_array, "<span style='color: #14c800'>You're all set ! Go ahead and login </span>" );

  header("Location: profil_page.php");
  exit();

  }

}
