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
	<img src="bannerWebExpo1.png" width="100%" />
	<p></p>
	
	<div class="video_muso">
	    <center><iframe width="75%" height="360" src="https://www.youtube.com/embed/WAYfUrqCd3Y" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></iframe></center>
	</div>

	<div class="row">
	  <div class="column">
			<div class="d-flex justify-content-center form_container">
				<img src="logo-muso-mobil2.png" width="70%"><p>
			</div>
			<div style="color:white; padding: 5%; margin:5%; border-radius:10px; text-align: justify; background:rgba(24, 67, 12, 0.8);">

				<h4>Une MUSO</h4>
				Une Mutuelle de Solidarité (MUSO) est un groupe d’épargne et de crédit autogéré par les membres qui bénéficient de services financiers répondant à leurs besoins et adaptés à leur capacité. Le but ultime est d’aider les familles à vivre mieux, à être plus victimes de la soudure, d’aller plus chez l’usurier, n’avoir plus peur du lendemain et d’aider à la structuration du milieu. Une MUSO s’articule autour de trois caisses clairement identifiées : une caisse verte recueille les cotisations dont le montant accumulé constitue le fonds de crédit. Cette épargne est récupérable, notamment au moment de la retraite. Une caisse rouge recueille des cotisations non récupérables et sert de fonds de secours (incendie, maladie…). Une caisse bleue peut, entre autres, accueillir des financements de l’extérieur. Les règles financières et les règles d’organisation sont fixées par les acteurs eux-mêmes et ce principe est au cœur même de l’idée de mutuelle de solidarité.<p>

			</div>
		</div>
	  <div class="column">
			<div style="color:white; padding: 5%; margin:5%; border-radius:10px; text-align: justify; background:rgba(24, 67, 12, 0.8);">
							<h4>MUSOMOBIL</h4>
							Musomobil est une plateforme de gestion des mutuelles de solidarité (MUSO) et d’autres Associations de Base de
							Cotisations et de Prêts communément appelées ABCP. <br>
							Ce projet est initié par KOFIP (Kolektif Finansman Popilè), en partenariat avec d’autres  organisations locales et internationales. <p>

							Cette plateforme a pour objectif de doter les MUSO et les ABCP d’un outil leur permettant de gérer l’ensemble de leurs activités.<br>
							- Dans un premier temps, la gestion des infos de base de la mutuelle et de ses membres.<br>
							- Ensuite, la gestion des différentes caisses (Verte, Rouge, Bleue).<br>
							- Pour aboutir à la gestion des prêts individuels des membres et la gestion des financements externes.<br>

							Musomobil veut être un outil complet, robuste, sécuritaire et évolutif pour la gestion des Mutuelles de Solidarité et des ABCP, afin de participer à l’émancipation de ces dernières.<p>
		</div>

		<div style="color:white; padding: 5%; margin:5%; border-radius:10px; text-align: justify; background:rgba(24, 67, 12, 0.8);">

			<h4>Le KOFIP</h4>
			Le Collectif du Financement Populaire (KOFIP) fondé en juillet 1997 est un réseau de plus de 1300 Mutuelles de Solidarité. Sa mission est de promouvoir un système de financement décentralisé à travers tout le pays permettant l’inclusion de toutes les couches sociales. Il est guidé par la problématique de la mise en place d’un système de financement populaire. Lequel consiste à l’organisation du maillage du territoire en structures de financement de trois niveaux, à savoir la Mutuelle de Solidarité (MUSO), la Caisse Mutuelle Communautaire (CMC) et la Banque Alternative (BA), de manière à ce que tous les producteurs, où qu’ils soient et quel que soit leur niveau économique, puissent avoir accès à des outils financiers et des crédits leur permettant d’accroître leur potentiel de production. <p>


		</div>

		</div>
	</div>

	<!-- Footer -->
<footer class="page-footer font-small blue">

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3" style="color:white; padding: 5%; margin:5%; border-radius:10px; text-align: justify; background:rgba(24, 67, 12, 0.8);">© 2020 Copyright:
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
