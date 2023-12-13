
<div class="header">
    <img src="images/logo.png" alt="Logo FOKAL" class="logo">
    <ul class="menu">
        <li><a href="profil_page.php">Accueil</a></li>
        <li><a href="file_page.php">Fichiers</a></li>
        <li><a href="materiel_page.php">Matériels</a></li>
        <!-- <li><a href="#" id="changePassword">Changer mot de passe</a></li> -->
    </ul>
    <div class="profile-image-container">
        <img src="<?php if(isset($_SESSION['emp_picture'])) echo $_SESSION['emp_picture']; ?>" alt="profile-image" class="profile-image" id="profile-image">
        <div class="popup" id="popup">
            <a href="logout.php">Déconnexion</a></li>
            <a href="edit_pass_page.php" >Changer mot de passe</a>
        </div>
    </div>
</div>

