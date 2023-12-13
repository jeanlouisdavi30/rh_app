<?php
   // Démarrage ou reprise de session
   session_start();

   // Cas où l'utilisateur a demandé une nouvelle partie :
   // on détruit la variable de session indiquant une partie en cours
   if (isset($_GET['nouvelle_partie']))
      unset($_SESSION['partie_en_cours']);
?>
<!doctype html>
<html lang="fr">
    <head>
		<meta charset="utf-8">
		<title>Cache-Cash</title>
		<style>
			table { border-collapse:collapse; }
			table,td { border:1px solid black; }
			td { padding:10px; }
		</style>
    </head>
    <body>
		<h2>Jeu du plus ou moins ! </h2>

<?php

/************************ CONSTANTES *************************/

// Question 1
const NOMBRE_MIN = 1;
const NOMBRE_MAX = 100;
const NOMBRE_ESSAIE_MAX = 6;
const RAND_MIN = 1;
const RAND_MAX = 100;
const PLUS = "c'est plus";
const MOINS = "c'est moins";
const EXACT = "c'est exact !";
const RECOMMENCER = "Commencer une nouvelle partie";
const TEXT_TIRAGE = "Tam, L'ordinateur vient de tirer un nombre entre 1 à 100. Essayer de trouver le nombre ... Si tu trouves le nombres tu découvrira un message secret de David ! ";


/************************ FONCTIONS *************************/

// FONCTION ECRIRE Formulaires

function ecrire_formulaire(){
  echo "<form method=\"post\">";
  echo    "<p>";
  echo        "<label>Quel nombre proposez-vous? </label>";
  echo        "<input type=\"number\" name=\"nombre\" value=\"\">";
  echo    "</p>";
  echo    "<p>";
  echo        "<input type=\"submit\" name=\"validation\" value=\"Valider\">";
  echo    "</p>";
  echo "</form>";
}

// fonction saisie Valider

function saisie_valide($chaîne){
  if (isset($chaîne) && ctype_digit($chaîne) && $chaîne >= NOMBRE_MIN && $chaîne <= NOMBRE_MAX )
      return true;
  else
      return false;
}

// fonction initialiser partie

function initialise_partie(){
  unset($_SESSION["historique_essais"]);
  $_SESSION["historique_essais"][] = "";
  $_SESSION["partie_en_cours"] = true;
  $_SESSION["coup_restant"] = 6;
  $_SESSION["nombre_à_trouver"] = rand(RAND_MIN, RAND_MAX);
  $_SESSION["nombre_essais"] = 0;

}

// fonction texte_résultat_essai($nombre_à_trouver, $nombre_proposé)

function texte_résultat_essai($nombre_à_trouver, $nombre_proposé){
  echo "<ol type=\"1\">";
  if($nombre_à_trouver < $nombre_proposé){
    $_SESSION["historique_essais"][] = $_SESSION["nombre_essais"] . ") " . $nombre_proposé . " : " .MOINS. " ... <br>";
  }else if($nombre_à_trouver > $nombre_proposé){
    $_SESSION["historique_essais"][] = $_SESSION["nombre_essais"] . ") ". $nombre_proposé . " : " .PLUS. " ... <br>";
  }else if($nombre_à_trouver == $nombre_proposé){
    $_SESSION["historique_essais"][] = $_SESSION["nombre_essais"] . ") ". $nombre_proposé . " : " .EXACT. " ... <br>";
  }
  echo "</ol>";
}



function essai_gagnant($nombre_à_trouver, $nombre_proposé){
  if($nombre_à_trouver == $nombre_proposé){
    return true;
  }else{
    return false;
  }
}

// fonction Ecrire historique essaie

function écrit_historique_essais(){
  foreach ($_SESSION["historique_essais"] as $value) {
    echo $value, "<br>";
  }
}



/************************* PROGRAMME PRINCIPAL *************************/

// Question 7 + code PHP et HTML en début de fichier
if(isset($_SESSION["nombre_à_trouver"])){
  $nombre_à_trouver = $_SESSION["nombre_à_trouver"];
}


if(isset($_POST["nombre"])){
  if(saisie_valide($_POST["nombre"])){
    $nombre_proposé = $_POST["nombre"];
  }
}
//if(saisie_valide($nombre_proposé) == true)
  //$validation = saisie_valide($nombre_proposé);

if(!isset($_POST["validation"]) || $_SESSION["nombre_essais"] >= NOMBRE_ESSAIE_MAX ){
  initialise_partie();
}


echo TEXT_TIRAGE, "<br>";


if(!empty($nombre_proposé) && isset($nombre_à_trouver)){
  $_SESSION["coup_restant"]--;
  $_SESSION["nombre_essais"]++;
  echo "<p>Vous disposez encore de ". $_SESSION["coup_restant"]. " essaies. <p>";
  texte_résultat_essai($nombre_à_trouver, $nombre_proposé);
  echo " <h4>Valeurs proposees : </h4> ";
  écrit_historique_essais();

  if($nombre_à_trouver == $nombre_proposé ){
    echo " <h2>Tu as Gagné ! Je t'aime Beaucoup, Tam ! de mon coeur, Tu me manque !!!</h2>";
    initialise_partie();
  }else if($_SESSION["nombre_essais"] < NOMBRE_ESSAIE_MAX){
    echo " <h3>Essayez de nouveau !</h3>";
  }else if($_SESSION["nombre_essais"] >= NOMBRE_ESSAIE_MAX){
    echo " <h3>Vous avez perdu ! </h3>";
    initialise_partie() ;
  }
}else{
    écrit_historique_essais();
    echo "<b>Vous devez entrer un nombre entier entre 1 et 100 ! </b><br>";
}

ecrire_formulaire();
