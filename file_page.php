<?php
require "config/config.php";
require "includes/handlers/delete_dep.php";
ob_start(); // turns on output buffering
$timezone = date_default_timezone_set("America/New_York");


    if(!isset($_SESSION['user_id']) AND !isset($_SESSION['employee_id'])){
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
    
    // Si tout va bien, on peut continuer
    
    // On récupère tout le contenu de la table 
    $reponse = $bdd->query("SELECT * FROM files WHERE employee_id='".$_SESSION['employee_id']."' ");
    
    // On affiche chaque entrée une à une
   

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FilePage</title>
    <!-- Inclure Bootstrap 4 CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
</head>
<body>
    <!-- Entête -->
    <?php include_once('entete.php'); ?>


    <!-- Section 1 - Mes Fichiers -->
    <div class="containers mt-4 container-sections">
        <?php 
        if( $_SESSION['utype'] == 'admin'){
            echo "<p><center><a href='admin_dash.php' class='btn btn-warning btn-sm'> Retourner au paneeau d'adminiatration </a> </center><br><p>";
            }
        ?>
        
            <h2 class="titres">Téléverser un fichier</h2>
        
            <form action="upload_file.php" class="form1" method="post" enctype="multipart/form-data">
            <div class="form-group">
                
                <input type="file" class="form-control-file" name="fileToUpload" id="fileUpload" >
            </div>
            <div class="form-group">
                <label for="fileDescription">Description:</label>
                <input type="text" class="form-control description-input" name="file_description">
            </div>
            <button type="submit" name="submit_file" value="Upload Image" class="btn btn-warning btn-sm" id="validerFichier">Valider</button>
        </form>
    </div>

    <!-- Section 2 - Liste des Fichiers -->
    <div class="containers mt-4 container-sections">
        <h2 class="titres">Fichiers téléversés</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Nom du fichier</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Ligne 1 (Exemple fictif) -->
            <?php
                while ($donnees = $reponse->fetch())
                {
    		?>
                <tr>
                    <td><a href="<?php echo $donnees['chemin']; ?>" target="_blank"><?php echo $donnees['nom_fichier']; ?></a></td>
                    <td><?php echo $donnees['description']; ?></td>
                    <td><?php echo $donnees['created']; ?></td>
                    <td><a href="file_page.php?file_id=<?php echo $donnees['id']; ?>" class="btn btn-danger btn-sm supprimerFichier">Supprimer</a></td>
                </tr>
            <?php
    			}
    			$reponse->closeCursor(); // Termine le traitement de la requête

    		?>
            </tbody>
        </table>
    </div>

    <!--Popup à afficher lors d'un clic sur un bouton "Supprimer"-->
    <div class="popupSuppressionFichier" id="popupSuppressionFichier">
        <p>Voulez-vous vraiment supprimer ce fichier?</p>

        <div class="text-center">
            <button type="submit" class="btn btn-danger btn-sm">OUI</button>
            <button type="submit" class="btn btn-outline-warning btn-sm">NON</button>
        </div>

    </div>

    <!-- Footer -->
    <?php include_once('footer.php'); ?>
    

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

        //Supprimer un fichier:

        var supprimerFichierBtns = document.getElementsByClassName("supprimerFichier"); 
        var popupSuppressionFichier = document.getElementById("popupSuppressionFichier");

        for (var i = 0; i < supprimerFichierBtns.length; i++) {

            var supprimerFichierBtn = supprimerFichierBtns[i];

            // Ajouter un gestionnaire d'événement de clic sur chaque bouton
            supprimerFichierBtn.addEventListener("click", function() {
                event.stopPropagation();
                popupSuppressionFichier.style.display = "block";
                //console.log("Code JavaScript chargé");
            });

        }


        //Gestionnaire d'événement de clic au document pour cacher le formulaire lors d'un clic à l'extérieur
        document.addEventListener("click", function(event) {
            if (event.target !== popupSuppressionFichier && !popupSuppressionFichier.contains(event.target)) {
                popupSuppressionFichier.style.display = "none";
                
            }
        });

        setTimeout(function () {

            // Closing the alert
            $('#alert').alert('close');
        }, 5000);
    </script>
</body>
</html>
