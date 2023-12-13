<?php
require "config/config.php";
require "includes/handlers/delete_dep.php";
require "html_head.php";
ob_start(); // turns on output buffering
$timezone = date_default_timezone_set("America/New_York");

    $_SESSION['employee_id'] = "";
    $_SESSION['emp_lastname'] = "";
    $_SESSION['emp_firstname'] = "";
    $_SESSION['emp_nif'] = "";
    $_SESSION['emp_sexe'] = "";
    $_SESSION['emp_birthdate'] = "";
    $_SESSION['emp_email'] = "";
    $_SESSION['emp_phone'] = "";
    $_SESSION['emp_address1'] = "";
    $_SESSION['emp_address2'] = "";
    $_SESSION['emp_matrimonial'] = "";
    $_SESSION['emp_nbr_child'] = "";
    $_SESSION['emp_bank_name'] = "";
    $_SESSION['emp_bank_number'] = "";
    $_SESSION['emp_picture'] = "";

    $_SESSION['job_id'] = ""; 
    $_SESSION['job_title'] = ""; 
    $_SESSION['job_description'] = "";
    $_SESSION['department'] = "";
    $_SESSION['supervisor'] = ""; 
    $_SESSION['date_embauche'] = "";

    $_SESSION['job_id'] = "";
    $_SESSION['job_title'] = "";
    $_SESSION['job_description'] = "";
    $_SESSION['department'] = "";
    $_SESSION['supervisor'] = "";
    $_SESSION['date_embauche'] = "";


    if(!isset($_SESSION['user_id'])){
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
    $reponse = $bdd->query("SELECT * FROM employees");
    
    // On affiche chaque entrée une à une

?>
    
    <?php html_head("Admin dashboard"); ?>

<body>
    <!-- Entête -->
    <?php include_once('entete_admin.php'); ?>
    
    
    <div class="containerProfilPage">
    <div class="row justify-content-center mt-3">
    <div class="col-md-12">

       
            <div class="alert alert-success" role="alert">
                
            </div>
        

        <div class="card">
            <div class="card-header">Employés</div>
            <div class="card-body">
                <a href="register_employee.php" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> Ajouter un nouveau employé</a> <a href="register_page.php" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i>Créer un compte pour un employé</a>
                <table class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <!-- <th scope="col">S#</th> -->
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <!-- <th scope="col">Téléphone</th> -->
                        <th scope="col">Date de naissance</th>
                        <!-- <th scope="col">email</th> -->
                        <!-- <th scope="col">Sexe</th> -->
                      </tr>
                    </thead>
                    <tbody>

                    <?php
                        while ($donnees = $reponse->fetch())
    					{
    			    ?>    
                        <tr>
                            <!-- <th scope="row"><?php // echo $donnees['id']; ?></th> -->
                            <td><?php echo $donnees['lastname']; ?></td>
                            <td><?php echo $donnees['firstname']; ?></td>
                            <!-- <td><?php //echo $donnees['phone']; ?></td> -->
                            <td><?php echo $donnees['birthdate']; ?></td>
                            <!-- <td><?php //echo $donnees['email']; ?></td> -->
                            <!-- <td><?php //echo $donnees['sexe']; ?></td> -->
                            <td>
                                <form action="#" method="post">
                                    

                                    <a href="profil_page.php?view_emp_id=<?php echo $donnees['id']; ?>" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i>Afficher</a>

                                    <a href="edit_emp_page.php?mod_emp_id=<?php echo $donnees['id']; ?>" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i>modifier</a>
                                    <a href="create_mat_page.php?emp_id=<?php echo $donnees['id']; ?>" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i>Ajouter materiel</a>  
                                    <a href="create_pos_page.php?emp_id=<?php echo $donnees['id']; ?>" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Poste</a> 

                                    <a href="admin_dash.php?del_emp_id=<?php echo $donnees['id']; ?>" class="btn btn-danger btn-sm">Supprimer</a> 
                                </form>
                            </td>
                        </tr>
                    
                    <?php
    				    }
    				    $reponse->closeCursor(); // Termine le traitement de la requête
                    ?>


                        <!--
                            <td colspan="6">
                                <span class="text-danger">
                                    <strong>No Product Found!</strong>
                                </span>
                            </td>
                        -->
                    </tbody>
                  </table>

                  

            </div>
        </div>
    </div>    
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

        //Gestion de l'événement sur la photo de profil:
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

        //Ajouter un nouveau dependant:
        var ajouterDependantBtn = document.getElementById("ajouterDependant");
        var formContainer = document.getElementById("formContainer");

        //Gestionnaire d'événement de clic au bouton
        ajouterDependantBtn.addEventListener("click", function() {
            formContainer.style.display = "block";
        });

        

        // Ajoutez un gestionnaire d'événement de clic au document pour masquer le formulaire quand on clic au dehors
        document.addEventListener("click", function(event) {
                if (!dependantForm.contains(event.target) && event.target !== ajouterDependantBtn) {
                  formContainer.style.display = "none";
                }
        });

        //Modifier infos bancaires:
        var modifierSec4Btn = document.getElementById("modifierSec4");
        var sec4FormContainer = document.getElementById("sec4FormContainer");

        modifierSec4Btn.addEventListener("click", function() {
            sec4FormContainer.style.display = "block";
            
        });

        
        document.addEventListener("click", function(event) {
            if (!sec4FormContainer.contains(event.target) && event.target !== modifierSec4Btn) {
                sec4FormContainer.style.display = "none";
        }
        });


        //Modifier un dependant:
        var modifierDependantBtns = document.getElementsByClassName("modifierDependant"); //renvoit une liste
        var modifierDependantContainer = document.getElementById("modifierDependantContainer");

        //Boucle permettant de récupérer chaque bouton avec la classe en question dans la liste renvoyée
	    for (var i = 0; i < modifierDependantBtns.length; i++) {

    		var modifierDependantBtn = modifierDependantBtns[i];

		    //Gestionnaire d'événement de clic sur chaque bouton
        	modifierDependantBtn.addEventListener("click", function() {
                event.stopPropagation();
            	modifierDependantContainer.style.display = "block";
                //console.log("Code JavaScript chargé");
        	});
    		
	    }

 
        //Gestionnaire d'événement de clic au document pour cacher le formulaire lors d'un clic à l'extérieur
        document.addEventListener("click", function(event) {
            if (event.target !== modifierDependantContainer && !modifierDependantContainer.contains(event.target)) {
                modifierDependantContainer.style.display = "none";
                
            }
        });

        

        //Supprimer un dépendant:

        var supprimerDependantBtns = document.getElementsByClassName("supprimerDependant"); 
        var popupSuppressionDependant = document.getElementById("popupSuppressionDependant");

        for (var i = 0; i < supprimerDependantBtns.length; i++) {

            var supprimerDependantBtn = supprimerDependantBtns[i];

            // Ajouter un gestionnaire d'événement de clic sur chaque bouton
            supprimerDependantBtn.addEventListener("click", function() {
                event.stopPropagation();
                popupSuppressionDependant.style.display = "block";
                //console.log("Code JavaScript chargé");
            });

        }


        //Gestionnaire d'événement de clic au document pour cacher le formulaire lors d'un clic à l'extérieur
        document.addEventListener("click", function(event) {
            if (event.target !== popupSuppressionDependant && !popupSuppressionDependant.contains(event.target)) {
                popupSuppressionDependant.style.display = "none";
                
            }
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

        





        

        






    </script>
    
</body>
</html>
