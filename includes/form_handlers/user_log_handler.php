<?php
ob_start(); // turns on output buffering
$timezone = date_default_timezone_set("America/New_York");

    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 


if(isset($_POST['log_button'])){
  $email = filter_var($_POST['log_email'], FILTER_SANITIZE_EMAIL);

  $_SESSION['log_email'] = $email;

  $password = md5($_POST['log_password']);

  $check_database_query = mysqli_query($con, "SELECT * FROM users WHERE email = '$email' AND password = '$password'");

  $check_login_query = mysqli_num_rows($check_database_query);

  if($check_login_query == 1){
    $row = mysqli_fetch_array($check_database_query);
    $user_id = $row['id'];
    $email = $row['email'];
    $utype = $row['utype'];
/*
  $user_closed_query = mysqli_query($con, "SELECT * FROM users WHERE email = '$email'");

   if(mysqli_num_rows($user_closed_query) == 1){
    $reopen_account = mysqli_query($con, "UPDATE muso SET valider='yes' WHERE email='$email'");
   }
*/
  $_SESSION['user_id'] = $user_id;
	$_SESSION['email'] = $email;
  $_SESSION['utype'] = $utype;

	$_SESSION['log'] = "<a href=\"logout.php\">Deconnexion</a>";

  if($_SESSION['utype'] === "admin"){
    
    header('Location: admin_dash.php');
	  exit();
  }

  if($_SESSION['utype'] === "super"){
    header('Location: super_dash.php');
	  exit();
  }
	
  $check_employee_query = mysqli_query($con, "SELECT * FROM employees WHERE user_id = '$user_id'");

  $check_login_query = mysqli_num_rows($check_employee_query);

  if($check_login_query  == 1){
    $row = mysqli_fetch_array($check_employee_query);
    
    $employee_id = $row['id'];

    $_SESSION['employee_id'] = $employee_id;
    $_SESSION['emp_lastname'] = $row['lastname'];
    $_SESSION['emp_firstname'] = $row['firstname'];
    $_SESSION['emp_nif'] = $row['nif'];
    $_SESSION['emp_sexe'] = $row['sexe'];
    $_SESSION['emp_birthdate'] = $row['birthdate'];
    $_SESSION['emp_email'] = $row['email'];
    $_SESSION['emp_phone'] = $row['phone'];
    $_SESSION['emp_address1'] = $row['address1'];
    $_SESSION['emp_address2'] = $row['address2'];
    $_SESSION['emp_matrimonial'] = $row['matrimonial'];
    $_SESSION['emp_nbr_child'] = $row['nbr_child'];
    $_SESSION['emp_bank_name'] = $row['bank_name'];
    $_SESSION['emp_bank_number'] = $row['bank_number'];
    $_SESSION['emp_picture'] = $row['pic'];

    $check_job_query = mysqli_query($con, "SELECT * FROM job WHERE employee_id = '$employee_id'");

    $check_login_query = mysqli_num_rows($check_job_query);

      if($check_login_query  == 1){
        $row = mysqli_fetch_array($check_job_query);
        
        $_SESSION['job_id'] = $row['id']; 
        $_SESSION['job_title'] = $row['poste']; 
        $_SESSION['job_description'] = $row['job_description']; 
        $_SESSION['department'] = $row['department']; 
        $_SESSION['supervisor'] = $row['supervisor']; 
        $_SESSION['date_embauche'] = $row['date_embauche']; 

      }

    header('Location: profil_page.php');
	  exit();

    }else{

      header('Location: form_page.php');
	    exit();

    }

  }else{
    array_push($error_array, "<span style='color:red'>l'email ou le mot de passe n'est pas correct <br> Ou l'email n'est pas encore validé<br></span>");
 }


}

?>
