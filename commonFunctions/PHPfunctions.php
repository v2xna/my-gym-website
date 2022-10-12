<?php

# Constants
define("FOLDER_CSS", "css/");
define("FILE_CSS", FOLDER_CSS . "styles.css");

function pageTop($title) {
    ?><!DOCTYPE html>

    <html>
        <head>
            <meta charset="UTF-8">

            <link rel="stylesheet" type="text/css" href="<?php echo FILE_CSS ?>" />

            <title><?php echo $title ?></title>
        </head>
        <body>

    <?php
}

function pageBottom() {
    
    ?>
        </body></html>
    <?php
}
