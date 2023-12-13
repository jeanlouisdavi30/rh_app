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


    // Quand on est venu de l'admin page

    if(isset($_GET['view_emp_id'] )){
        $emp_id = $_GET['view_emp_id'];
      
        $sql = "SELECT * FROM employees WHERE id = $emp_id";
      
        
        $result = $con->query($sql);
      
        if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
            
          $_SESSION['employee_id'] = $row['id'];
          $_SESSION['emp_lastname'] = $row['lastname'];
          $_SESSION['emp_firstname'] = $row['firstname'];
          $_SESSION['emp_nif'] = $row['nif'];
          $_SESSION['emp_sexe'] = $row['sexe'];
          $_SESSION['emp_birthdate'] = $row['birthdate'];
          $_SESSION['emp_email'] = $row['email'];
          $_SESSION['emp_phone'] = $row['phone'];
          $_SESSION['emp_address1'] = $row['address1'];
          $_SESSION['emp_address2'] = $row['address2'];
          $_SESSION['emp_matrimonial'] = $row['matrimonial'];
          $_SESSION['emp_nbr_child'] = $row['nbr_child'];
          $_SESSION['emp_bank_name'] = $row['bank_name'];
          $_SESSION['emp_bank_number'] = $row['bank_number'];
          $_SESSION['emp_picture'] = $row['pic'];
      
          $check_job_query = mysqli_query($con, "SELECT * FROM job WHERE employee_id = '$emp_id'");
      
          $check_login_query = mysqli_num_rows($check_job_query);
      
            if($check_login_query  == 1){
              $row = mysqli_fetch_array($check_job_query);
              
              $_SESSION['job_id'] = $row['id']; 
              $_SESSION['job_title'] = $row['poste']; 
              $_SESSION['job_description'] = $row['job_description']; 
              $_SESSION['department'] = $row['department']; 
              $_SESSION['supervisor'] = $row['supervisor']; 
              $_SESSION['date_embauche'] = $row['date_embauche']; 
      
            }
      
          }
        } else {
          echo "0 results";
        }
        $con->close();
      
      }


    
    // Si tout va bien, on peut continuer
    
    // On récupère tout le contenu de la table 
    $reponse = $bdd->query("SELECT * FROM dependants WHERE employee_id='".$_SESSION['employee_id']."' ");
    
    // On affiche chaque entrée une à une
   

    require "html_head.php";

    ?>
    
    <?php html_head("Profil"); ?>

<body>
    <!-- Entête -->
    <?php include_once('entete.php'); ?>

    
    
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

    <div class="containerProfilPage">
        <div class="section-box">
        
        <?php 
        if( $_SESSION['utype'] == 'admin'){
            echo "<p><center><a href='admin_dash.php' class='btn btn-warning btn-sm'> Retourner au panneau d'administration </a> </center><br><p>";
            }
        ?>
            <section class="sec1">
                <h2 class="section-title">Informations personnelles</h2>
                <div class="info-container">
                    <div class="text-content">
                        
                        <table class="tableProfilPage" id="infoPersonnelleTable">
                            <tr>
                                <td style="font-weight: bold;">Nom:</td>
                                <td><?php echo $_SESSION['emp_lastname']; ?></td>
                                
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">Prénom :</td>
                                <td><?php echo $_SESSION['emp_firstname']; ?></td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">NIF :</td>
                                <td><?php echo $_SESSION['emp_nif']; ?></td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">Sexe :</td>
                                <td><?php echo $_SESSION['emp_sexe']; ?></td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">Birthdate:</td>
                                <td><?php echo $_SESSION['emp_birthdate']; ?></td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">Email :</td>
                                <td><?php echo $_SESSION['emp_email']; ?></td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">Téléphone :</td>
                                <td><?php echo $_SESSION['emp_phone']; ?></td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">Adresse 1 :</td>
                                <td><?php echo $_SESSION['emp_address1']; ?></td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">Adresse 2 :</td>
                                <td><?php echo $_SESSION['emp_address2']; ?></td>
                            </tr>
                            
                            <tr>
                                <td style="font-weight: bold;">État matrimonial:</td>
                                <td><?php echo $_SESSION['emp_matrimonial']; ?></td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">Nombre d'enfants  :</td>
                                <td><?php echo $_SESSION['emp_nbr_child']; ?></td>
                            </tr>
                        </table>
                        <div>
                            <a href="edit_emp_page.php" type="button" class="btn btn-warning btn-sm modifierSec1">Modifier</a>
                        </div>
                    </div>
                    <div class="image-content">
                        <div>
                        <img src="<?php if(isset($_SESSION['emp_picture'])) echo $_SESSION['emp_picture']; ?>" alt="Image de la section Info">
                        </div>
                        <div>
                            <a href="photo_upload.php" class="btn btn-warning btn-sm uploadImg">Ajouter/Modifier</a>
                        </div>
                    </div>
                
            </section>
        </div>

        <div class="section-box">
            <section class="sec4">
                <h2 class="section-title">Informations Bancaires</h2>
                <table class="tableProfilPage">
                    <tr>
                        <td style="font-weight: bold;">Nom de la banque:</td>
                        <td><?php echo $_SESSION['emp_bank_name']; ?></td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Numéro du compte:</td>
                        <td><?php echo $_SESSION['emp_bank_number']; ?></td>
                    </tr>
                </table>
                <div>
                <a href="edit_emp_page.php" type="button" class="btn btn-warning btn-sm modifierSec1">Modifier</a>

                    <!--Formulaire à afficher lors d'un clic sur le bouton "Supprimer" de la section "Informations bancaires"-->
                    <div id="sec4FormContainer" class="hidden">
                        <form id="sec4Form">
                          <div class="form-group">
                            <label for="nomBanque">Nom de la banque :</label>
                            <input type="text" class="form-control" id="nomBanque" name="nomBanque" required>
                          </div>
                      
                          <div class="form-group">
                            <label for="numeroCompte">Numéro du compte :</label>
                            <input type="text" class="form-control" id="numeroCompte" name="numeroCompte" required>
                          </div>
                      
                          <div class="text-center">
                            <a href="edit_emp_page.php" type="button" class="btn btn-warning btn-sm modifierSec1">Modifier</a>
                          </div>
                        </form>
                    </div>
                      
                </div>
            </section>
        </div>
        
    
        <div class="section-box">
            <section class="sec2">
                <h2 class="section-title">Dépendants</h2>
                <div class="text-center">
                    <!-- <button type="button" class="btn btn-outline-warning" id="ajouterDependant">Ajouter un(e) dépendant(e)</button> -->
                    <a href="create_dep_page.php" type="button" class="btn btn-outline-warning">Ajouter un(e) dépendant(e)</a> <!-- btn-sm modifierSec1 -->
                </div>
                <hr/>
                

                <div id="formContainer" class="hidden">
                    <form id="dependantForm">
                      <div class="form-group">
                        <label for="nomDependant">Nom :</label>
                        <input type="text" class="form-control" id="nomDependant" name="nomDependant" required>
                      </div>

                      <div class="form-group">
                        <label for="prenomDependant">Prénom :</label>
                        <input type="text" class="form-control" id="prenomDependant" name="prenomDependant" required>
                      </div>
              
                      <div class="form-group">
                        <label for="dateNaissanceDependant">Date de naissance :</label>
                        <input type="date" class="form-control" id="dateNaissanceDependant" name="dateNaissanceDependant" required>
                      </div>

                      <div class="form-group">
                        <label for="lienParenteDependant">Lien de parenté:</label>
                        <input type="text" class="form-control" id="lienParenteDependant" name="lienParenteDependant" required>
                      </div>
              
                      <div class="form-group">
                        <label for="numeroTelDependant">Numéro de téléphone :</label>
                        <input type="tel" class="form-control" id="numeroTelDependant" name="numeroTelDependant" required>
                      </div>
              
                      <div class="text-center">
                        <button type="submit" class="btn btn-outline-warning btn-sm">Ajouter</button>
                      </div>
                    </form>
                </div>


                <?php
                    while ($donnees = $reponse->fetch())
    					{
    			?>
                <div class="dependant">
                    <table class="tableProfilPage">
                    
                   
                        <tr>
                            <td style="font-weight: bold;">Nom de famille :</td>
                            <td><?php echo $donnees['lastname']; ?></td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;">Prénom :</td>
                            <td><?php echo $donnees['firstname']; ?></td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;">Sexe:</td>
                            <td><?php echo $donnees['sexe']; ?></td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;">Date de naissance:</td>
                            <td><?php echo $donnees['birthdate']; ?></td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;">Téléphone :</td>
                            <td><?php echo $donnees['phone']; ?></td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;">Email :</td>
                            <td><?php echo $donnees['email']; ?></td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;">Adresse :</td>
                            <td><?php echo $donnees['address1']; ?></td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;">Lien :</td>
                            <td><?php echo $donnees['link']; ?></td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;">Contact pour urgence :</td>
                            <td><?php echo $donnees['emergency1']; ?></td>
                        </tr>
                    </table>
                    <div class="btnSec2">
                        <a href="edit_dep_page.php?mod_dep_id=<?php echo $donnees['id']; ?>" class="btn btn-warning btn-sm">Modifier</a> <!-- modifierDependant -->
                        <a href="profil_page.php?dep_id=<?php echo $donnees['id']; ?>" class="btn btn-danger btn-sm">Supprimer</a> 
                    </div>
                    <hr/>
                </div>
                <?php
    				}
    				$reponse->closeCursor(); // Termine le traitement de la requête

    			?>
                

                <!--Formulaire à afficher lors du clic sur un bouton "Modifier" de la section "Dépendant"-->
                <div id="modifierDependantContainer" class="hidden">
                    <form id="modifierDependantFormulaire">
                        <div class="form-group">
                            <label for="nom">Nom :</label>
                            <input type="text" class="form-control" id="nom" name="nom" required>
                        </div>

                        <div class="form-group">
                            <label for="prenom">Prénom :</label>
                            <input type="text" class="form-control" id="prenom" name="prenom" required>
                        </div>
          
                        <div class="form-group">
                            <label for="dateNaissance">Date de naissance :</label>
                            <input type="date" class="form-control" id="dateNaissance" name="dateNaissance" required>
                        </div>

                        <div class="form-group">
                            <label for="lienParente">Lien de parenté:</label>
                            <input type="text" class="form-control" id="lienParente" name="lienParente" required>
                        </div>
          
                        <div class="form-group">
                            <label for="numeroTel">Numéro de téléphone :</label>
                            <input type="tel" class="form-control" id="numeroTel" name="numeroTel" required>
                        </div>
          
                        <div class="text-center">
                            <button type="submit" class="btn btn-outline-warning btn-sm">Modifier</button>
                        </div>
                    </form>
                </div>

                <!--Popup à afficher lors d'un clic sur un bouton "Supprimer" de la section Dependant-->
                <div class="popupSuppressionDependant" id="popupSuppressionDependant">
                    <p>Voulez-vous vraiment supprimer ce/cette dépendant(e)?</p>

                    <div class="text-center">
                        <button type="submit" class="btn btn-danger btn-sm">OUI</button>
                        <button type="submit" class="btn btn-outline-warning btn-sm">NON</button>
                    </div>

                </div>
            </section>

                
        </div>
    
        
        
        <div class="section-box">
            <section class="sec3">
                <h2 class="section-title">Informations sur le poste</h2>
                <table class="tableProfilPage">
                    <tr class="border-bottom">
                        <td style="font-weight: bold;">Département :</td>
                        <td><?php if(isset($_SESSION['department'])) echo $_SESSION['department']; ?></td>
                    </tr>
                    <tr class="border-bottom">
                        <td style="font-weight: bold;">Superviseur :</td>
                        <td><?php if(isset($_SESSION['supervisor'])) echo $_SESSION['supervisor']; ?></td>
                    </tr>
                    <tr class="border-bottom">
                        <td style="font-weight: bold;">Intitulé du poste :</td>
                        <td><?php if(isset($_SESSION['job_title'])) echo $_SESSION['job_title']; ?></td>
                    </tr>          
                    <tr class="border-bottom">
                        <td style="font-weight: bold;">Description de poste :</td>
                        <td><?php if(isset($_SESSION['job_description'])) echo $_SESSION['job_description']; ?></td>
                    </tr>
                    <tr class="border-bottom">
                        <td style="font-weight: bold;">Date d'embauche :</td>
                        <td><?php if(isset($_SESSION['date_embauche'])) echo $_SESSION['date_embauche']; ?></td>
                    </tr>
                </table>
    
                <div>
                    
                </div>
            </section>
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
