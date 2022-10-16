<?php

# Constants
define("FOLDER_CSS", "css/");
define("FILE_CSS", FOLDER_CSS . "styles.css");

define("FOLDER_LOGO", "pictures/");
define("FILE_GYMLOGO", FOLDER_LOGO . "gymlogo.jpg");


function pageTop($title) {
    ?><!DOCTYPE html>

    <html>
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" type="text/css" href="<?php echo FILE_CSS; ?>" />
            <title><?php echo $title ?></title>
        </head>
        <body>
            <img class="gymlogo" src="<?php echo FILE_GYMLOGO; ?>" alt="Gym logo"/>
            <nav>
                <a href="index.php">Home</a> |
                <a href="buying.php">Buying</a> |
                <a href="orders.php">Orders</a>
            </nav>

    <?php
}

function pageBottom() {
    $year = date("Y");
    
    ?>
            <footer>
                <hr>
                <p>Copyright &ltVithursan Nagalingam (2135106)&gt <?php echo $year; ?>. </p>
            </footer>
        </body></html>
    <?php
}


function taxCalculator($price, $quantity) {
    
    $subTotal = $price * $quantity;
    
    # local tax = 16.1%
    $taxes = $subTotal * 0.161;
    
    $grandtotal = $subTotal + $taxes;
    
    return number_format((float)$grandtotal, 2, '.', ''); 
}
