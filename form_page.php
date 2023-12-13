<?php
require "config/config.php";
require "includes/form_handlers/register_employee_handler.php";
ob_start(); // turns on output buffering
$timezone = date_default_timezone_set("America/New_York");

if(!isset($_SESSION['user_id'])){
	header('Location: login_page.php');
	exit();
}

/*
try
{
  //  $con = mysqli_connect("localhost","enartsht_david", "Wendy30", "enartsht_parc");
	$bdd = new PDO('mysql:host=localhost;dbname=enartsht_muso', 'enartsht_david', 'Wendy30');
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
   
   <?php include_once('entete.php'); ?>



    <div class="containerFormPage">
            <h3  class="formulaireTitle">Informations personnelles</h3>
        
        
        <form id="login" action="form_page.php" method="POST">
            <div class="form-group">
                <label for="nom">Nom de famille</label>
                <input type="text" class="form-control" id="nom" name="emp_lastname" value="<?php if(isset($_SESSION['emp_lastname'])) echo $_SESSION['emp_lastname']; ?>" required>
            </div>
            <div class="form-group">
                <label for="prenom">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="emp_firstname" value="<?php if(isset($_SESSION['emp_firstname'])) echo $_SESSION['emp_firstname']; ?>" required>
            </div>
            <div class="form-group">
                <label for="sexe">Sexe</label>
                <select class="form-control" id="sexe" name="emp_sexe" value="<?php if(isset($_SESSION['emp_sexe'])) echo $_SESSION['emp_sexe']; ?>" required>
                    <option value="M">M</option>
                    <option value="F">F</option>
                </select>
            </div>
            <div class="form-group">
                <label for="nif">NIF</label>
                <input type="text" class="form-control" id="nif" name="emp_nif" value="<?php if(isset($_SESSION['emp_nif'])) echo $_SESSION['emp_nif']; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="emp_birthdate">Date de naissance</label>
                <input type="date" class="form-control" id="emp_birthdate" name="emp_birthdate" value="<?php if(isset($_SESSION['emp_birthdate'])) echo $_SESSION['emp_birthdate']; ?>" required>
            </div>
            <div class="form-group">
                <label for="emp_email">Email</label>
                <input type="text" class="form-control" id="email" name="emp_email" value="<?php if(isset($_SESSION['emp_email'])) echo $_SESSION['emp_email']; ?>">
            </div>
            <div class="form-group">
                <label for="phone">Numéro de téléphone</label>
                <input type="text" class="form-control" id="telephone" name="emp_phone" value="<?php if(isset($_SESSION['emp_phone'])) echo $_SESSION['emp_phone']; ?>" required>
            </div>
            <div class="form-group">
                <label for="address1">Adresse 1</label>
                <input type="text" class="form-control" id="adresse1" name="emp_address1" value="<?php if(isset($_SESSION['emp_address1'])) echo $_SESSION['emp_address1']; ?>" required>
            </div>
            <div class="form-group">
                <label for="address1">Adresse 2</label>
                <input type="text" class="form-control" id="address2" name="emp_address2" value="<?php if(isset($_SESSION['emp_address2'])) echo $_SESSION['emp_address2']; ?>">
            </div>
            <div class="form-group">
                <label for="etatMatrimonial">État matrimonial</label>
                <select class="form-control" id="etatMatrimonial" name="emp_matrimonial" value="<?php if(isset($_SESSION['emp_matrimonial'])) echo $_SESSION['emp_matrimonial']; ?>">
                    <option>Célibataire</option>
                    <option>Marié(e)</option>
                    <option>Divorcé(e)</option>
                    <option>Veuve/Veuf</option>
                    <option>Union libre</option>
                    <option>Préfère ne pa dire</option>
                </select>
            </div>
            <div class="form-group">
                <label for="emp_nbr_enfant">Nombre d'enfant</label>
                <input type="number" class="form-control" id="emp_nbr_enfant" name="emp_nbr_child" value="<?php if(isset($_SESSION['emp_nbr_child'])) echo $_SESSION['emp_nbr_child']; ?>" required>
            </div>
            <div class="form-group">
                <label for="adresse2">Nom de votre banque</label>
                <input type="text" class="form-control" id="adresse2" name="emp_bank_name" value="<?php if(isset($_SESSION['emp_bank_name'])) echo $_SESSION['emp_bank_name']; ?>">
            </div>
            <div class="form-group">
                <label for="adresse2">Numéro de votre compte banque</label>
                <input type="text" class="form-control" id="adresse2" name="emp_bank_number" value="<?php if(isset($_SESSION['emp_bank_number'])) echo $_SESSION['emp_bank_number']; ?>">
            </div> 

           <div class="text-center">
            <button type="submit" class="btn btn-warning" name="register_emp_button">Enregistrer</button>
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
