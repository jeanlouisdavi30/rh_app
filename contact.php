<?php
require "config/config.php";
//require "includes/form_handlers/register_handler.php";
//require "includes/form_handlers/login_handler.php";

  $nb_muso = mysqli_query($con, "SELECT COUNT(*) AS nbr_muso FROM muso");
  $nb_membre = mysqli_query($con, "SELECT COUNT(id) AS nbr_membre FROM membres");

	$check_nb = mysqli_num_rows($nb_muso);
	$check_nbm = mysqli_num_rows($nb_membre);

	if($check_nb >= 1){
    $row = mysqli_fetch_array($nb_muso);
	}

	if($check_nbm >= 1){
    $row_m = mysqli_fetch_array($nb_membre);
	}

?>


<!DOCTYPE html>
<html>

<head>
	<title>Musomobil, un outil de gestion de Mutuelle Solidarité</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
	<link rel="stylesheet" href="style4.css" >
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<!--Coded with love by Mutiullah Samim-->
<body>
	<nav class="navbar navbar-light" style="margin: auto; display: flex; background-color:rgba(24, 67, 12, 0.8); height:70px; width: 100%; font-weight: bold; text-decoration: none;">

	  <span style="color:white; margin-top: -50px"><img src="logo-muso-mobil2.png" class="brand_logo" alt="Logo" /></span>
	  <span style="color:white; margin-left: 30px"> MUSOMOBIL </span>
	  <span><a href="index.php" style="color:white;">ACCUEIL </a></span> 
	  <span><a href="contact.php" style="color:white;"> CONTACT </a></span> 
	  <!-- &nbsp; &nbsp; &nbsp; MUSO : <?php echo $row['nbr_muso'] ; ?> &nbsp; &nbsp; &nbsp; | &nbsp; &nbsp; &nbsp; MEMBRES : <?php echo $row_m['nbr_membre'] ; ?> -->
		
	  <span><a href="login.php" id="signin" class="signin" style="color:white; float: right; padding: 10px"><button style="color:white; float: right;" class="btn btn-primary float-right">Se connecter</button></a></span>
	  <span><a href="register.php" id="register" class="signin" style="color:white; float: right; padding: 10px"><button style="color:white; float: right;" class="btn btn-success float-right">S'inscrire</button></a></span>
		
	</nav>
	
    <div style="color:white; padding: 5%; margin:5%; border-radius:10px; text-align: justify; background:rgba(24, 67, 12, 0.8);">

			<h4>CONTACTS</h4> <P/>
		      <h5>MUSOMOBIL / KOFIP <p/> <p/> Adresse: 10, Rue Audant, Impasse la paix / Route de Frères, <br/> Pétion-Ville, Haiti <p/> Tel - (509) 28170088 Fax - (509) 37934470 <p/>Email: kofip98@yahoo.fr / info@musomobil.org</h5>

		</div>
    

	<!-- Footer -->
<footer class="page-footer font-small blue">

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3" style="color:white; padding: 5%; margin:5%; border-radius:10px; text-align: justify; background:rgba(24, 67, 12, 0.8);"> © 2021 Copyright:
    <a href="https://musomobil.org/">MUSOMOBIL / </a>
    KOFIP
    10, Rue Audant, Impasse la paix / Route de Frères, Pétion-Ville, Haiti
    Tel - (509) 28170088
    Fax - (509) 37934470
    Email - kofip98@yahoo.fr
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->

</body>
</html>
