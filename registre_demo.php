<?php
$email = "";
$password = "";
$password2 = "";
$utype = "";
$created = date("Y-m-d H:i:s");
$updated = date("Y-m-d H:i:s");

$error_array = array();

if(isset($_POST['user_reg_button'])){

    //Check if the email is in valid format
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
      $email = filter_var($email, FILTER_VALIDATE_EMAIL);

      // check if email already exists
      $e_check = mysqli_query($con, "SELECT email FROM users WHERE email='$email'");

      //count the number of rows returned

      $num_row = mysqli_num_rows($e_check);

      if($num_row > 0 ){
        array_push($error_array, "<span style='color: red'>Ce email est déja enregistré<br></span>" );
      }


    }else{
      array_push($error_array, "<span style='color: red'>Le format d'email n'est pas valid<br></span>" );
    }


  if(empty($error_array)){
    $password = md5($password); 

   $query = "INSERT INTO `users` VALUES (NULL, '$email', '$password', '$utype', '$created', '$updated')";

   if (mysqli_query($con, $query)) {

      $last_id = mysqli_insert_id($con);

    }else {
    echo "Error: " . $query . "<br>" . $con->error;

  }
 }
}