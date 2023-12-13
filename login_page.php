<?php
require "config/config.php";
require "includes/form_handlers/user_reg_handler.php";
require "includes/form_handlers/user_log_handler.php";
require "html_head.php";

?>

<?php html_head("Connexion"); ?>

<body class="loginBodyPage">
    <div class="conteneurs">
        <div class="row justify-content-center">
            <div class="col-md-4 login-container">
                <div class="card">
                    <div class="card-header">
                        <!-- Titre retiré -->
                    </div>
                    <div class="card-body">
                        <form id="login" action="login_page.php" method="post">
                            <div class="mb-3">
                                <label for="email" class="form-label" >Email</label>
                                <input type="email" class="form-control" id="email" name="log_email" value="<?php if(isset($_SESSION['log_email'])) echo $_SESSION['log_email']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Mot de passe</label>
                                <input type="password" class="form-control" id="password" name="log_password" required>
                            </div>
                            <?php if(in_array("<span style='color:red'>l'email ou le mot de passe n'est pas correct <br> Ou l'email n'est pas encore validé<br></span>", $error_array )){
                            echo "<span style='color:red'>l'email ou le mot de passe n'est pas correct <br> Ou l'email n'est pas encore validé<br></span>";
                            }?>
                            <div class="text-center">
                                <button type="submit" name="log_button" class="btn btn-primary">Se connecter</button>
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