<?php 

$employee_id = $_SESSION['employee_id'];

$result = mysqli_query($con, "SELECT * FROM dependants WHERE employee_id = '$employee_id'");


    
?>