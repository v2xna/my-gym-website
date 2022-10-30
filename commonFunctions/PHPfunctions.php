<?php
#Revision history:
#
#DEVELOPER              DATE            COMMENTS
#Vithursan Nagalingam    2022-10-12     Created common Functions file, css file, pictures folder and declared some constants
#Vithursan Nagalingam    2022-10-14     Added the footer with current date of the server and made a function to calculate taxes
#Vithursan Nagalingam    2022-10-15     Made the actions for print to save ink when printing
#Vithursan Nagalingam    2022-10-21     Added the error handlers and headers


# Error handlers
error_reporting(E_ALL);
set_error_handler("manageError");
set_exception_handler("manageException");

# send headers
header("Content-type: text/html; charset=utf-8");
header("Expires: Tue, 29 Nov 1994 13:00 GMT");
header("Cache-Control: no-cache");
header("Pragma: no-cache");


# Constants
define("FOLDER_CSS", "css/");
define("FILE_CSS", FOLDER_CSS . "styles.css");

define("FOLDER_LOGO", "pictures/");
define("FILE_GYMLOGO", FOLDER_LOGO . "gymlogo.jpg");

define("FOLDER_ERRORS", "errors/");
define("FILE_ERRORS", FOLDER_ERRORS . "errorLog.txt");

# If debugging keep it true
define("DEBUGGING", false);

function manageError($errorNumber, $errorString, $errorFile, $errorLineNumber)
{
    $date = date('Y/m/d H:i:s');
    
    if(DEBUGGING)
    {
        echo "An error occured on the line $errorLineNumber of the file $errorFile: " . "$errorString($errorNumber)";
    }
    else
    {
        echo "An error occured.... Technical team is on the way";
    }
    
    #save detailed error into the file
    file_put_contents(FILE_ERRORS, "An error occured on the line $errorLineNumber of the file $errorFile: " . "$errorString($errorNumber) at $date \r\n", FILE_APPEND);
    
    die();
}

function manageException($errorObject)
{
    $date = date('Y/m/d H:i:s');
    
    echo "An exception occured on the line " . $errorObject->getLine() 
            . " of the file " . $errorObject->getFile() . ": " . $errorObject->getMessage() . "("
            . $errorObject->getCode() . ")";
    
    #save detailed error into the file
    file_put_contents(FILE_ERRORS, "An exception occured on the line " . $errorObject->getLine() 
            . " of the file " . $errorObject->getFile() . ": " . $errorObject->getMessage() . "("
            . $errorObject->getCode() . ") on $date \r\n", FILE_APPEND);
    
    die();
}


function pageTop($title) {
    ?><!DOCTYPE html>

    <html>
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" type="text/css" href="<?php echo FILE_CSS; ?>" />
            <title><?php echo $title ?></title>
        </head>
        <body class="<?php
                        # Action
                        if (isset($_GET["action"]) && strtoupper(htmlspecialchars($_GET["action"])) == strtoupper("print")) {
                            echo "whiteBackground";
                        }
                        else {
                            echo "grayBackground";
                        }
        
                     ?>">
            <img class="<?php
                           if (isset($_GET["action"]) && strtoupper(htmlspecialchars($_GET["action"])) == strtoupper("print")) {
                               echo "gymlogoLessOpacity";
                           }
                           else {
                               echo "gymlogo";
                           }
                           
                        ?>" src="<?php echo FILE_GYMLOGO; ?>" alt="Gym logo"/>
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
