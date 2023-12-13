<?php
require "config/config.php";
require "includes/handlers/delete_dep.php";
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
    
    // Si tout va bien, on peut continuer
    
    // On récupère tout le contenu de la table 
    $reponse = $bdd->query("SELECT employees.lastname AS emp_lastname, employees.firstname AS emp_firstname, materiels.id AS mat_id, materiels.id_inventaire AS id_inventaire, materiels.materiel AS materiel, materiels.statut AS mat_status, materiels.delivered_by AS livre_par, materiels.date_sortie AS date_sortie, materiels.date_entree AS date_entree FROM materiels JOIN employees ON materiels.employee_id=employees.id");
    
    // On affiche chaque entrée une à une
   

?>


<!DOCTYPE html>
<meta charset="ISO-8859-1">
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logistique-Admin</title>
    <!-- Inclure Bootstrap 4 CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    

    <!-- Entête -->
    <!-- Entête -->
    <?php include_once('entete_admin.php'); ?>




    <!--Formulaire à afficher lors du clic sur le lien "Changer le mot de passe"-->
    <div id="modifierMotDePasseContainer" class="hidden">
        <form id="modifierMotDePasseForm">____
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

    <div>
        <p>
    </div>

    <!--Ajouter un nouvel emprunt-->

    <div id="formContainerNouvelEmprunt" class="hidden">
        <form id="nouvelEmpruntForm">
            <div class="form-group">
                <label for="nomEmprunteur">Nom:</label>
                <input type="text" class="form-control" id="nomEmprunteur" name="nomEmprunteur" required>
            </div>

            <div class="form-group">
                <label for="materielEmprunte">Matériel :</label>
                <input type="text" class="form-control" id="materielEmprunte" name="materielEmprunte" required>
            </div>
  
            <div class="form-group">
                <label for="identifiantMateriel">Identifiant :</label>
                <input type="text" class="form-control" id="identifiantMateriel" name="identifiantMateriel" required>
            </div>

            <div class="form-group">
                <label for="dateSortieMateriel">Date de sortie:</label>
                <input type="date" class="form-control" id="dateSortieMateriel" name="dateSortieMateriel" required>
            </div>

            <div class="form-group">
                <label for="commentaireNouvelEmprunt">Commentaire:</label>
                <textarea type="text" class="form-control" id="commentaireNouvelEmprunt" name="commentaireNouvelEmprunt"></textarea>
            </div>
  
          
            <div class="text-center">
                <a href="" class="btn btn-outline-warning btn-sm">Ajouter</a>
            </div>
        </form>
    </div>

   

    <!-- Section 2 - Liste des matériels -->
    <div class="containers mt-4 container-sections">
        <h2 class="titres">Matériels empruntés</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Matériel</th>
                    <th>Identifiant</th>
                    <th>Date de sortie</th>
                    <th>Statut</th>
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
                    <td><?php echo $donnees['emp_lastname'] . " " . $donnees['emp_firstname'] ; ?></td>
                    <td><?php echo $donnees['materiel']; ?></td>
                    <td><?php echo $donnees['id_inventaire']; ?></td>
                    <td><?php echo $donnees['date_sortie']; ?></td>
                    <td><?php echo $donnees['mat_status']; ?></td>
                    <td>
                        <a href="show_materiel.php?mat_id=<?php echo $donnees['mat_id']; ?>" class="btn btn-outline-warning btn-sm voirEmprunt">Afficher</a>
                        <a href="edit_mat_page.php?mat_id=<?php echo $donnees['mat_id']; ?>" class="btn btn-outline-warning btn-sm voirEmprunt">Modifier</a>
                        <a href="materiel_admin.php?del_mat_id=<?php echo $donnees['mat_id']; ?>" class="btn btn-danger btn-sm">Supprimer</a>
                    </td>
                </tr>
            <?php
    			}
    			$reponse->closeCursor(); // Termine le traitement de la requête

    		?>

            </tbody>
        </table>
    </div>

    <!--Modifier un emprunt-->

    <div id="formContainerModifierEmprunt" class="hidden">
        <form id="modifierEmpruntForm">
            <div class="form-group">
                <label for="nom">Nom:</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>

            <div class="form-group">
                <label for="materiel">Matériel :</label>
                <input type="text" class="form-control" id="materiel" name="materiel" required>
            </div>
  
            <div class="form-group">
                <label for="identifiant">Identifiant :</label>
                <input type="text" class="form-control" id="identifiant" name="identifiant" required>
            </div>

            <div class="form-group">
                <label for="dateSortie">Date de sortie:</label>
                <input type="date" class="form-control" id="dateSortie" name="dateSortie" required>
            </div>

            <div class="form-group">
                <label for="statut">Statut</label>
                <select class="form-control" id="statut">
                    <option value="Non-remis">Non-remis</option>
                    <option value="Remis">Remis</option>
                </select>
            </div>

            <div class="form-group">
                <label for="dateEntree">Date d'entrée:</label>
                <input type="date" class="form-control" id="dateEntree" name="dateEntree" required>
            </div>

            <div class="form-group">
                <label for="commentaire">Commentaire:</label>
                <textarea type="text" class="form-control" id="commentaire" name="commentaire"></textarea>
            </div>
  
          
            <div class="text-center">
                <button type="submit" class="btn btn-outline-warning btn-sm">Modifier</button>
            </div>
        </form>
    </div>

    <!--Popup à afficher lors d'un clic sur un bouton "Supprimer"-->
    <div class="popupSuppressionMateriel" id="popupSuppressionMateriel">
        <p>Voulez-vous vraiment supprimer ce matériel?</p>

        <div class="text-center">
            <button type="submit" class="btn btn-danger btn-sm">OUI</button>
            <button type="submit" class="btn btn-outline-warning btn-sm">NON</button>
        </div>

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

        //Créer un nouvel emprunt

        var nouvelEmprunt = document.getElementById("nouvelEmprunt");
        var formContainerNouvelEmprunt = document.getElementById("formContainerNouvelEmprunt");

        nouvelEmprunt.addEventListener("click",function(){

            event.stopPropagation();
            formContainerNouvelEmprunt.style.display = "block";

        });

        document.addEventListener("click",function(event){
            if(event.target !==formContainerNouvelEmprunt && !formContainerNouvelEmprunt.contains(event.target)){
            
                formContainerNouvelEmprunt.style.display="none";
            }

        });

        //Modifier un emprunt
        
        var modifierEmpruntBtns = document.getElementsByClassName("modifierEmprunt"); //renvoit une liste
        var formContainerModifierEmprunt = document.getElementById("formContainerModifierEmprunt");

        //Boucle permettant de récupérer chaque bouton avec la classe en question dans la liste renvoyée
	    for (var i = 0; i < modifierEmpruntBtns.length; i++) {

    		var modifierEmpruntBtn = modifierEmpruntBtns[i];

		    //Gestionnaire d'événement de clic sur chaque bouton
        	modifierEmpruntBtn.addEventListener("click", function() {
                event.stopPropagation();
            	formContainerModifierEmprunt.style.display = "block";
                
        	});
    		
	    }

 
        //Gestionnaire d'événement de clic au document pour cacher le formulaire lors d'un clic à l'extérieur
        document.addEventListener("click", function(event) {
            if (event.target !== formContainerModifierEmprunt && !formContainerModifierEmprunt.contains(event.target)) {
                formContainerModifierEmprunt.style.display = "none";
                
            }
        });

        //Supprimer un materiel:

        var supprimerEmpruntBtns = document.getElementsByClassName("supprimerEmprunt"); 
        var popupSuppressionMateriel = document.getElementById("popupSuppressionMateriel");

        for (var i = 0; i < supprimerEmpruntBtns.length; i++) {

            var supprimerEmpruntBtn = supprimerEmpruntBtns[i];

            // Ajouter un gestionnaire d'événement de clic sur chaque bouton
            supprimerEmpruntBtn.addEventListener("click", function() {
                event.stopPropagation();
                popupSuppressionMateriel.style.display = "block";
                //console.log("Code JavaScript chargé");
            });

        }


        //Gestionnaire d'événement de clic au document pour cacher le formulaire lors d'un clic à l'extérieur
        document.addEventListener("click", function(event) {
            if (event.target !== popupSuppressionMateriel && !popupSuppressionMateriel.contains(event.target)) {
                popupSuppressionMateriel.style.display = "none";
                
            }
        });

        

        


    </script>
</body>
</html>
