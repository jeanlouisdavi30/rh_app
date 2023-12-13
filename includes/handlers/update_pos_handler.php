<?php
ob_start(); // turns on output buffering
$timezone = date_default_timezone_set("America/New_York");

    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
  
  $emp_id = "";
  $pos_name = "";
  $description = "";
  $pos_description = "";
  $department = "";
  $date_emp = "";
  $updated = date("Y-m-d H:i:s");
    
  $error_array = array();

  

if(isset($_GET['emp_id'] )){
  $emp_id = $_GET['emp_id'];

  $sql = "SELECT * FROM job WHERE employee_id = $emp_id";

  
  $result = $con->query($sql);

  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      
      $pos_id = $row["id"];
      $pos_name = $row["poste"];
      $pos_description = $row["job_description"];
      $pos_supervisor = $row["supervisor"];
      $pos_department = $row["department"];
      $date_emp = $row["date_embauche"];

    }
  } else {
    echo "0 results";
  }
  $con->close();

}



if(isset($_POST['pos_button'])){

  //poste
  $emp_id = strip_tags($_POST['emp_id']);
  $emp_id = ucfirst(strtolower(($emp_id)));
  $_SESSION['emp_id'] = $emp_id; //

  //poste
  $pos_name = strip_tags($_POST['pos_name']);
  $pos_name = ucfirst(strtolower(($pos_name)));
  $_SESSION['pos_name'] = $pos_name; //

  //description
  $description = strip_tags($_POST['pos_description']);
  $description = ucfirst(strtolower(($description)));
  $_SESSION['pos_description'] = $description; //

  //supervisor
  $supervisor = strip_tags($_POST['pos_supervisor']);
  $_SESSION['pos_supervisor'] = $supervisor; //

  //department 
  $department = strip_tags($_POST['pos_department']);
  $department = ucfirst(strtolower(($department)));
  $_SESSION['pos_department'] = $department; //

  //department 
  $date_emp = strip_tags($_POST['date_emp']);
  $date_emp = ucfirst(strtolower(($date_emp)));
  $_SESSION['date_emp'] = $date_emp; //


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

   $query = "UPDATE job SET poste = '$pos_name', job_description = '$description', supervisor = '$supervisor', department = '$department', date_embauche = '$updated', updated = '$updated' WHERE employee_id = $emp_id";
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

  header("Location: admin_dash.php");
  exit();

  }

}
