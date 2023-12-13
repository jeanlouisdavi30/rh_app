<?php
session_start();
ob_start(); // turns on output bufferin
$timezone = date_default_timezone_set("America/Chicago");

  $con = mysqli_connect("localhost","root", "rh_fokal", "dbrh");

  if(mysqli_connect_errno()){
    echo "failed to connect" . mysqli_connect_errno();
  }
?>
