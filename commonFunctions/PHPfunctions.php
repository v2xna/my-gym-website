<?php
#Revision history:
#
#DEVELOPER              DATE            COMMENTS
#Vithursan Nagalingam    2022-10-12     Created common Functions file, css file, pictures folder and declared some constants
#Vithursan Nagalingam    2022-10-14     Added the footer with current date of the server and made a function to calculate taxes
#Vithursan Nagalingam    2022-10-15     Made the actions for print to save ink when printing
#Vithursan Nagalingam    2022-10-21     Added the error handlers and headers
#Vithursan Nagalingam    2022-11-22     Created HTTPS with the certificate and key
#Vithursan Nagalingam    2022-12-05     Fixed my login function and started creating my SESSION variable
#Vithursan Nagalingam    2022-12-07     trying to add ajax => search function
#Vithursan Nagalingam    2022-12-11     adding css to my login form
#Vithursan Nagalingam    2022-12-11     removed page links(<a>) of midterm pages

const OBJECTS_FOLDER3 = "objects/";
const OBJECT_CONNECTION2 = OBJECTS_FOLDER3 . "DBconnection.php";
const OBJECT_CUSTOMER = OBJECTS_FOLDER3 . "customer.php";

const JAVASCRIPT_FOLDER = "JavaScript/";
const JAVASCRIPT_AJAX = JAVASCRIPT_FOLDER . "ajax.js";

require_once OBJECT_CONNECTION2;
require_once OBJECT_CUSTOMER;

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
define("DEBUGGING", true);

// HTTPS
if( !isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != 'on')
{
    header('Location: https://' . str_replace("8088", "4433", $_SERVER["HTTP_HOST"]) . $_SERVER["REQUEST_URI"]);
    exit();
}

// Cookie
session_start();

$loggedUser = "";


function deleteCookie() {
    session_destroy();
    
    header('location: buy.php');
    exit();
}

function readCookie(){
    
    global $loggedUser;
    
    if(isset($_SESSION["loggedUser"])){
        $loggedUser = $_SESSION["loggedUser"];
        
    }
}

function createCookie($customer_id){
    
    $_SESSION["loggedUser"] = $customer_id;
    
    # make sure the browser supports cookies
    header("location: buy.php");
    exit();
}


// Handling errors
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
            <script language="javascript" type="text/javascript" src="<?php echo JAVASCRIPT_AJAX; ?>"></script>
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
            <nav class="navbar">
                <img class="<?php
                               if (isset($_GET["action"]) && strtoupper(htmlspecialchars($_GET["action"])) == strtoupper("print")) {
                                   echo "gymlogoLessOpacity";
                               }
                               else {
                                   echo "gymlogo";
                               }

                            ?>" src="<?php echo FILE_GYMLOGO; ?>" alt="Gym logo"/>
                <ul class="nav">
                    <li>
                        <a href="index.php">Home</a> 
                    </li>
                    <li>
                        <a href="buy.php">Buy</a>
                    </li>
                    <li>
                        <a href="orders2.php">Your Orders</a>
                    </li>
                    <li>
                        <a href="account.php">Update Account</a>
                    </li>
                </ul>
            
                
<!--                <a href="buying.php">Buying</a> 
                <a href="orders.php">Orders</a> -->
                 
                 
                
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




function loginAndLogout() {
    
    global $connection;
    $displayMessage = "";
    
    if (isset($_POST["login"])) {
        
        $errorLoginMsg = "";
        
        $username = htmlspecialchars($_POST["user"]);
        $password = htmlspecialchars($_POST["password"]);
        
        $SQLQuery = "CALL customers_login(:username)";
        
        $rows = $connection->prepare($SQLQuery);
                                                        
        $rows->bindParam(":username", $username, PDO::PARAM_STR);
        
        if ($rows->execute())
        {
            //echo "passwordhashis" . password_hash("123", PASSWORD_DEFAULT);
            //var_dump($username);
            //var_dump($password);
            while($row = $rows->fetch()) {
                
                if(password_verify($password, $row["user_password"]))
                {
                    createCookie($row["customer_id"]);
                }
                else
                {
                    $displayMessage = "Invalid username or password.";
                }
            }
        }
        
    } else {
        if (isset($_POST["logout"])) {
            deleteCookie();
        } else {
            readCookie();
        }
    }
    
    global $loggedUser;
    
    if($loggedUser != ""){

        $myCustomer = new customer();
        $myCustomer->load($_SESSION["loggedUser"]);

        $displayMessage = "Welcome " . $myCustomer->getFirstname() . " " . $myCustomer->getLastname();

        ?>
            <form action="buy.php" method="POST">
                <h3><?php echo $displayMessage; ?></h3>
                <input type="submit" name="logout" value="Logout"/>
            </form>

        <?php
    }
    else
    {

        ?>
        
        <form action="buy.php" method="POST">
            Username:<input type="text" name="user"/>
            <br>Password:<input type="password" name="password"/>
            <br><input type="submit" name="login" value="Login"/>
            <br><p>Need a user account? <a href="register.php">Register</a></p>
            <p class="redText"><?php echo $displayMessage; ?></p>
        </form>
        <?php
    }

}
