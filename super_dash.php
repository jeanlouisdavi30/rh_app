<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin Dashboard</title>
    <!-- Inclure Bootstrap 4 CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>

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
                <a href="{{ route('products.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> Ajouter un utilisateur</a>
                <table class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th scope="col">S#</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Date Crée</th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>jwood@gmail.com</td>
                            <td>Admin</td>
                            <td>12/12/1985</td>
                            <td>
                                <form action="#" method="post">
                                    

                                    <a href="#" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Show</a>

                                    <a href="#" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>   

                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this product?');"><i class="bi bi-trash"></i> Delete</button>
                                </form>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">2</th>
                            <td>jwood@gmail.com</td>
                            <td>Admin</td>
                            <td>12/12/1985</td>
                            <td>
                                <form action="#" method="post">
                                    

                                    <a href="#" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Show</a>

                                    <a href="#" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>   

                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this product?');"><i class="bi bi-trash"></i> Delete</button>
                                </form>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">3</th>
                            <td>jwood@gmail.com</td>
                            <td>Admin</td>
                            <td>12/12/1985</td>
                            <td>
                                <form action="#" method="post">
                                    

                                    <a href="#" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Show</a>

                                    <a href="#" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>   

                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this product?');"><i class="bi bi-trash"></i> Delete</button>
                                </form>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">4</th>
                            <td>jwood@gmail.com</td>
                            <td>Admin</td>
                            <td>12/12/1985</td>
                            <td>
                                <form action="#" method="post">
                                    

                                    <a href="#" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Show</a>

                                    <a href="#" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>   

                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this product?');"><i class="bi bi-trash"></i> Delete</button>
                                </form>
                            </td>
                        </tr>


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