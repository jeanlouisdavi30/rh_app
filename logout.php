<?php
session_start();

session_unset();
session_destroy();

header("Location: login_page.php?page=home");
exit();

?>
