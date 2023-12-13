<?php
require "config/config.php";
ob_start(); // turns on output buffering
$timezone = date_default_timezone_set("America/New_York");


    if(!isset($_SESSION['user_id']) AND !isset($_SESSION['utype'])){
        header('Location: login_page.php');
        exit();
    }

    try
    {
      //  $con = mysqli_connect("localhost","enartsht_david", "Wendy30", "enartsht_parc");
        $bdd = new PDO('mysql:host=localhost;dbname=dbrh', 'root', 'rh_fokal');
    }
    catch (Exception $e)
    {
            die('Erreur : ' . $e->getMessage());
    }

    $mat_id = "";
    $name = "";
    $materiel = "";
    $identifiant = "";
    $date_sortie = "";
    $statut = "";
    $date_entree = "";
    $comment = "";
    $livre_par = "";

    
    // Si tout va bien, on peut continuer
    if(isset($_GET['mat_id'])) {
        $mat_id = $_GET['mat_id'];
    }
    
    // On récupère tout le contenu de la table 
    $reponse = $bdd->query("SELECT employees.lastname AS emp_lastname, employees.firstname AS emp_firstname, materiels.id AS mat_id, materiels.id_inventaire AS id_inventaire, materiels.materiel AS materiel, materiels.statut AS mat_status, materiels.delivered_by AS livre_par, materiels.date_sortie AS date_sortie, materiels.date_entree AS date_entree FROM materiels JOIN employees ON materiels.employee_id=employees.id WHERE materiels.id = $mat_id");
    
    // On affiche chaque entrée une à une
    $check_mat_query = mysqli_query($con, "SELECT employees.lastname AS emp_lastname, employees.firstname AS emp_firstname, materiels.id AS mat_id, materiels.id_inventaire AS id_inventaire, materiels.materiel AS materiel, materiels.statut AS mat_status, materiels.delivered_by AS livre_par, materiels.date_sortie AS date_sortie, materiels.date_entree AS date_entree, materiels.comment AS comment FROM materiels JOIN employees ON materiels.employee_id=employees.id WHERE materiels.id = '$mat_id'");
      
          $check_login_query = mysqli_num_rows($check_mat_query);
      
            if($check_login_query  == 1){
              $row = mysqli_fetch_array($check_mat_query);
              
                $mat_id = $row['mat_id'];
                $name = $row['emp_lastname']  . " " . $row['emp_firstname'] ;
                $materiel = $row['materiel'];
                $identifiant = $row['id_inventaire'];
                $date_sortie = $row['date_sortie'];
                $statut = $row['mat_status'];
                $date_entree = $row['date_entree'];              
                $livre_par = $row['livre_par'];
                $comment = $row['comment'];
      
            } else {
          echo "0 results";
        }
        $con->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voir-Emprunt</title>
    <!-- Inclure Bootstrap 4 CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <!-- Entête -->
    <div class="header">
        <img src="images/logo.png" alt="Logo FOKAL" class="logo">
        <ul class="menu">
            
            <li><a href="admin_dash.php">Accueil</a></li>
            <li><a href="materiel_admin.php">Materiels</a></li>
            
            
        </ul>
        <div class="profile-image-container">
            <img src="images/image1.jpg" alt="profile-image" class="profile-image" id="profile-image">
            <div class="popup" id="popup">
                <a href="login.html">Déconnexion</a>
                <a href="" id="changePassword">Change password</a>
            </div>
        </div>
    </div>

    <!--Formulaire à afficher lors du clic sur le lien "Changer le mot de passe"-->
    <div id="modifierMotDePasseContainer" class="hidden">
        <form id="modifierMotDePasseForm">
          <div class="form-group">
            <label for="motDepasseActuel">Saisissez votre mot de passe actuel:</label>
            <input type="password" class="form-control" id="motDepasseActuel" name="motDepasseActuel" required>
          </div>
      
          <div class="form-group">
            <label for="nouveauMotDePasse">Saisissez votre nouveau mot de passe:</label>
            <input type="password" class="form-control" id="nouveauMotDePasse" name="nouveauMotDePasse" required>
          </div>

          <div class="form-group">
            <label for="nouveauMotDePasseConfirmation">Confirmez votre nouveau mot de passe:</label>
            <input type="password" class="form-control" id="nouveauMotDePasseConfirmation" name="nouveauMotDePasseConfirmation" required>
          </div>
      
          <div class="text-center">
            <button type="submit" class="btn btn-outline-warning btn-sm">Changer le mot de passe</button>
          </div>
        </form>
    </div>


    <!-- Section 1 - Details emprunt -->
    <div class="container mt-4 container-section-1">
        <img src="images/logo.png" alt="Logo FOKAL" class="logo">

        <div class="emprunt">

            <h2 class="titre1">Matériel emprunté</h2>
            <div>
                <p><span style="font-weight: bold;" class="attribut">Nom:</span><span class="valeur"><?php echo $name ;?></span></p><br>
                <p><span style="font-weight: bold;" class="attribut">Matériel:</span><span class="valeur"><?php echo $materiel ;?></span></p><br>
                <p><span style="font-weight: bold;" class="attribut">Identifiant:</span><span class="valeur"><?php echo $identifiant ;?></span></p><br>
                <p><span style="font-weight: bold;" class="attribut">Date de sortie:</span><span class="valeur"><?php echo $date_sortie ;?></span></p><br>
                <p><span style="font-weight: bold;" class="attribut">Statut:</span><span class="valeur"><?php echo $statut ;?></span></p><br>
                <p><span style="font-weight: bold;" class="attribut">Date d'entrée:</span><span class="valeur"><?php if($statut == 'LIVRE') {echo 'N/A';} else {echo $date_entree ;}?></span></p><br>
                <p><span style="font-weight: bold;" class="attribut">Commentaire:</span><span class="valeur"><?php echo $comment;?></span></p><br>

            </div>
        </div>
        

        <!-- Signatures-->
        <div class="signature">

            <div class="signatureResponsable">
                <!--<hr class="signature-line">-->
                <p>Signature du responsable</p>
            </div>
    
            <div class="signatureReceveur">
                <!--<hr class="signature-line">-->
                <p>Signature du receveur</p>
            </div>


        </div>

        <p class="separator">------------------------------------------------------------------------------------------------------------------------------------</p>        

        
        <div class="retour">

            <h2 class="titre2">Retour de matériel</h2>
            <div>
                <p><span style="font-weight: bold;" class="attribut">Date d'entrée:</span>_____/_____/_____ <span class="valeur"><!--La date apparaitra ici--></span></p><br>
                

                <!--Le commentaire a ecire a la main-->
                <p><span style="font-weight: bold;" class="commentaireRetour">Commentaire:</span><span>_________________________________________________________________________________________________________________
                <br>_________________________________________________________________________________________________________________________________
                <br>_________________________________________________________________________________________________________________________________
                <br>_________________________________________________________________________________________________________________________________</span></p><br>
                

            </div>

        </div>
        
        <!-- Signatures-->
        <div class="signature">

            <div class="signatureResponsable">
                <!--<hr class="signature-line">-->
                <p>Signature du responsable</p>
            </div>
    
            <div class="signatureReceveur">
                <!--<hr class="signature-line">-->
                <p>Signature du receveur</p>
            </div>


        </div>
    
    

       
        
        
    </div>

    <div class="text-center">
        <button class="btn btn-primary btn-sm" id="printButton">Imprimer</button>
    </div>

    

   
   

    

    

    

    <footer>
        <div class="containerFooter">
            <div class="text-center">
                <p>Copyright © 2023 FOKAL. | Design by: <a href="mailto:informatique@fokal.org">informatique@fokal.org</a></p>
            </div>
        </div>
    </footer>

    <!--Inclure Bootstrap 4 et JavaScript-->
    <!--Ce lien popper JS est mieux que le 2eme en commentaire(génère des erreurs de chargement à la console)-->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <!--<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>-->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        //Pop up pour photo de profil
        var profileImage = document.getElementById("profile-image");
        var popup = document.getElementById("popup");

        profileImage.addEventListener("mouseover", function() {
            popup.style.display = "block";
        });

        profileImage.addEventListener("click", function() {
            popup.style.display = "block";
        });

        popup.addEventListener("click", function(event) {
            event.stopPropagation();
            popup.style.display = "none";
        });

        document.addEventListener("click", function() {
            popup.style.display = "none";
        });

        //Modifier Mot de passe:

        var changePassword = document.getElementById("changePassword");
        var modifierMotDePasseContainer = document.getElementById("modifierMotDePasseContainer");

        changePassword.addEventListener("click",function(){
            
            event.stopPropagation();
            event.preventDefault();
            modifierMotDePasseContainer.style.display = "block";

        });

        document.addEventListener("click",function(event){
            if(event.target !==modifierMotDePasseContainer && !modifierMotDePasseContainer.contains(event.target)){
            
                modifierMotDePasseContainer.style.display="none";
            }

        });


        
        // Fonction pour imprimer seulement la partie "container"
        document.getElementById('printButton').addEventListener('click', function() {
            var container = document.querySelector('.container');
            var otherElements = document.querySelectorAll('body > *:not(.container)');

            // Cacher les éléments indésirables
            otherElements.forEach(function(element) {
                element.style.display = 'none';
            });

            // Imprimer la partie "container"
            window.print();

            // Rétablir l'affichage des éléments
            otherElements.forEach(function(element) {
                element.style.display = '';
            });
        });
        

        

        

    </script>
</body>
</html>
