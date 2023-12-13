<?php

require "config/config.php";
require "includes/form_handlers/user_reg_handler.php";
require "includes/form_handlers/user_log_handler.php";

if(!isset($_SESSION['user_id']) AND !isset($_SESSION['utype'])){
    header('Location: login_page.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enregistrement</title>
    <!-- Inclure Bootstrap 4 CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="styles.css">
    
</head>
<body class="registerBodyPage">
    <div class="conteneurs">
        <div class="row justify-content-center">
            <div class="col-md-4 registration-container">
                <div class="card">
                    <div class="card-header">
                        <!-- Titre retiré -->
                    </div>
                    <div class="card-body">
                    <form id="login" action="register_page.php" method="post">
                            <div class="mb-3">
                                <label for="email" class="form-label" >Email</label>
                                <input type="email" class="form-control small-input" id="user_reg_email" name="user_reg_email" value="<?php if(isset($_SESSION['reg_email'])) echo $_SESSION['reg_email']; ?>" required>
                                <?php if(in_array("<span style='color: red'>Ce email est déja enregistré<br></span>", $error_array )) echo "<span style='color: red'>Ce email est déja enregistré<br></span>"; ?>
                                <?php if(in_array("<span style='color: red'>Le format d'email n'est pas valid<br></span>", $error_array )) echo "<span style='color: red'>Le format d'email n'est pas valid<br></span>"; ?>
                            </div>
                            <div class="mb-3">
                                <label for="ser_reg_utype" class="form-label">Type de compte</label>
                                <input type="text" class="form-control small-input" id="ser_reg_utype" name="user_reg_utype" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Mot de passe</label>
                                <input type="password" class="form-control small-input" id="user_reg_password" name="user_reg_password" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirmPassword" class="form-label">Confirmer le mot de passe</label>
                                <input type="password" class="form-control small-input" id="confirmPassword" name="user_reg_password2" required>
                            </div>
                            <?php if(in_array("<span style='color: red'>Les mots de passe ne sont pas identiques<br></span>", $error_array )) echo "<span style='color: red'>Les mots de passe ne sont pas identiques<br></span>";
                             else if(in_array("<span style='color: red'>Le mot de passe peut contenir que des lettres et des nombres<br></span>", $error_array )) echo "<span style='color: red'>Le mot de passe peut contenir que des lettres et des nombres<br></span>";
                             else if(in_array("<span style='color: red'>le mot de passe doit contenir entre 5 à 30 charactères au moins<br></span>", $error_array )) echo "<span style='color: red'>le mot de passe doit contenir entre 5 à 30 charactères au moins<br></span>";
                            ?>
                            <div class="d-flex justify-content-center align-items-center">
                            <button type="submit" name="user_reg_button" value="register" class="btn login_btn">Enregistrer</button>

                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

   <!--Inclure Bootstrap 4 et JavaScript-->
    <!--Ce lien popper JS est mieux que le 2eme en commentaire(génère des erreurs de chargement à la console)-->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <!--<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>-->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>