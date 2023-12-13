<?php
require "config/config.php";
require "includes/handlers/update_pos_handler.php";
ob_start(); // turns on output buffering
$timezone = date_default_timezone_set("America/New_York");

if(!isset($_SESSION['user_id']) AND !isset($_SESSION['employee_id'])){
	header('Location: login_page.php');
	exit();
}

/*
try
{
  //  $con = mysqli_connect("localhost","enartsht_david", "Wendy30", "enartsht_parc");
	$bdd = new PDO('mysql:host=localhost;dbname=enartsht_muso;charset=utf8', 'enartsht_david', 'Wendy30');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

// On récupère tout le contenu de la table muso
$req = $bdd->query("SELECT * FROM muso WHERE id='".$_SESSION['muso_id']."' ");
$data = $req->fetch();

// Si tout va bien, on peut continuer

// On récupère tout le contenu de la table membres
$reponse = $bdd->query("SELECT * FROM membres WHERE id_muso='".$_SESSION['muso_id']."' ");

// On affiche chaque entrée une à une
*/


//require "includes/form_handlers/user_log_handler.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire-InfosPersonnelles</title>
    <!-- Inclure Bootstrap 4 CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
   <!-- Entête -->
   
   <?php include_once('entete_admin.php'); ?>



   <div class="containerFormPage">
            <h3  class="formulaireTitle">Informations sur poste</h3>

        
        <form id="login" action="edit_pos_page.php" method="POST">
            <div class="form-group">
                <input type="hidden" class="form-control" id="emp_id" name="emp_id" value="<?php if(isset($emp_id)) echo $emp_id; ?>">
            </div>
            <div class="form-group">
                <label for="nom">Poste</label>
                <input type="text" class="form-control" id="pos_name" name="pos_name" value="<?php if(isset($pos_name)) echo $pos_name; ?>">
            </div>
            <div class="form-group">
                <label for="emp_birthdate">Supervisor</label>
                <input type="text" class="form-control" id="pos_supervisor" name="pos_supervisor" value="<?php if(isset($pos_supervisor)) echo $pos_supervisor; ?>">
            </div>
            <div class="form-group">
                <label for="phone">Départment</label>
                <input type="text" class="form-control" id="pos_department" name="pos_department" value="<?php if(isset($pos_department)) echo $pos_department; ?>">
            </div>
            <div class="form-group">
                <label for="phone">date d'embauche</label>
                <input type="date" class="form-control" id="date_emp" name="date_emp" value="<?php if(isset($date_emp)) echo $date_emp; ?>">
            </div>
            <div class="form-group">
                <label for="prenom">Description</label>
                <textarea id="pos_description" class="form-control" rows="4" cols="50" name="pos_description" value="<?php if(isset($pos_description)) echo $pos_description; ?>">
                <?php if(isset($pos_description)) echo $pos_description; ?>
                </textarea>
            </div>

           <div class="text-center">
            <button type="submit" class="btn btn-warning" name="pos_button">Enregistrer</button>
           </div>
        </form>


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
        //Image preview
        function previewImage(input) {
            var imagePreview = document.getElementById('imagePreview');
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    imagePreview.style.display = 'block';
                    imagePreview.src = e.target.result;
                };

                reader.readAsDataURL(input.files[0]);
            } else {
                imagePreview.style.display = 'none';
            }
        }
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
        var modifierMotDePassecontainer = document.getElementById("modifierMotDePassecontainer");

        changePassword.addEventListener("click",function(){
            
            event.stopPropagation();
            event.preventDefault();
            modifierMotDePassecontainer.style.display = "block";

        });

        document.addEventListener("click",function(event){
            if(event.target !==modifierMotDePassecontainer && !modifierMotDePassecontainer.contains(event.target)){
            
                modifierMotDePassecontainer.style.display="none";
            }

        });
    </script>
</body>
</html>
