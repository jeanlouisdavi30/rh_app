<?php
    function html_head ($title){
    ?>
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?php echo $title ?></title>
            <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
            <!-- Inclure Bootstrap 4 CSS-->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
            <link rel="stylesheet" type="text/css" href="styles.css">
            
        </head>
    <?php
    }
?>