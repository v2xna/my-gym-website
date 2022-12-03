<?php
#Revision history:
#
#DEVELOPER               DATE           COMMENTS
#Vithursan Nagalingam    2022-10-12     Started first by creating the basic look of the form
#Vithursan Nagalingam    2022-10-14     Added validations to the form
#Vithursan Nagalingam    2022-10-15     Created a function for tax calculator
#Vithursan Nagalingam    2022-10-21     Made an array to use json encode to save all the data into a file (write)


# Constants
define("FOLDER_FUNCTIONS", "commonFunctions/");
define("FILE_FUNCTIONS", FOLDER_FUNCTIONS . "PHPfunctions.php");

define("FOLDER_SALES", "sales/");
define("FILE_SALES", FOLDER_SALES . "orders.txt");

require_once FILE_FUNCTIONS;

// declare variables
$productCode = "";
$cFirstName = "";
$cLastName = "";
$cCity = "";
$comments = "";
$price = "";
$quantity = "";

$validateErrorProductCode = "";
$validateErrorFirstName = "";
$validateErrorLastName = "";
$validateErrorCity = "";
$validateErrorComments = "";
$validateErrorPrice = "";
$validateErrorQuantity = "";

$subTotal = "";
$taxes = "";
$grandTotal = "";

$order = array();

$errorsOccured = false;
$orderConfirmation = "";

if (isset($_POST["buy"])) {
    # Get all the values from the user
    $productCode = htmlspecialchars($_POST["productcode"]);
    $cFirstName = htmlspecialchars($_POST["firstname"]);
    $cLastName = htmlspecialchars($_POST["lastname"]);
    $cCity = htmlspecialchars($_POST["city"]);
    $comments = htmlspecialchars($_POST["comments"]);
    $price = htmlspecialchars($_POST["price"]);
    $quantity = htmlspecialchars($_POST["quantity"]);

    # Validation for product code
    if ($productCode == "") {
        $validateErrorProductCode = "*";
        $errorsOccured = true; 
    } else {

        if (strlen($productCode) >= 25) {
            $validateErrorProductCode = "The product code cannot be longer than 25 characters";
            $errorsOccured = true; 
        }

        if (str_contains(strtolower($productCode), 'prd') == false) {
            $validateErrorProductCode = "must contain the letters PRD";
            $errorsOccured = true; 
        }
    }

    # Validation for first name
    if ($cFirstName == "") {
        $validateErrorFirstName = "*";
        $errorsOccured = true; 
    } else {

        if (strlen($cFirstName) >= 20) {
            $validateErrorFirstName = "The first name cannot be longer than 20 characters";
            $errorsOccured = true; 
        }
    }

    # Validation for last name
    if ($cLastName == "") {
        $validateErrorLastName = "*";
        $errorsOccured = true; 
    } else {

        if (strlen($cLastName) >= 20) {
            $validateErrorLastName = "The last name cannot be longer than 20 characters";
            $errorsOccured = true; 
        }
    }

    # Validation for city
    if ($cCity == "") {
        $validateErrorCity = "*";
        $errorsOccured = true; 
    } else {

        if (strlen($cCity) >= 30) {
            $validateErrorCity = "The city cannot be longer than 30 characters";
            $errorsOccured = true; 
        }
    }

    # Validation for comments
    if (strlen($comments) >= 200) {
        $validateErrorComments = "can only enter 0 to 200 characters";
        $errorsOccured = true; 
    }

    # Validation for price

    if ($price == "") {
        $validateErrorPrice = "*";
        $errorsOccured = true; 
    } else {

        if (is_numeric($price) == false) {
            $validateErrorPrice = "must be a numeric value!";
            $errorsOccured = true; 
        }

        if (is_numeric($price) && $price < 0) {
            $validateErrorPrice = "cannot be a negative number";
            $errorsOccured = true; 
        }

        if (is_numeric($price) && $price >= 10000) {
            $validateErrorPrice = "cannot be higher than 10,000.00$";
            $errorsOccured = true; 
        }
        
    }

    # Validation for quantity

    if ($quantity == "") {
        $validateErrorQuantity = "*";
        $errorsOccured = true; 
    } else {

        if (is_numeric($quantity) == false) {

            $validateErrorQuantity = "must be a numeric value!";
            $errorsOccured = true; 
        } else {
            
            if ((float) $quantity != (int) $quantity) {
                $validateErrorQuantity = "cannot enter a decimal number";
                $errorsOccured = true; 
            } else {

                if (!($quantity >= 1 && $quantity <= 99)) {
                    $validateErrorQuantity = "Number of quantities must be between 1 and 99";
                    $errorsOccured = true; 
                }
            }
        }
    }
    
    # if no errors occured
    if(!($errorsOccured)) {
        
        # Calculations
        $subTotal = $price * $quantity;
        $subTotal = number_format($subTotal, 2);
        
        $taxes = $subTotal * 0.161;
        $taxes = number_format($taxes, 2);
        
        $grandTotal = taxCalculator($price, $quantity);
        
        # Storing everything in an array
        $order = array($productCode, $cFirstName, $cLastName, $cCity, $comments, $price, $quantity, $subTotal, $taxes, $grandTotal);
        
        # File write
        $jsonString = json_encode($order);
        file_put_contents(FILE_SALES, $jsonString . "\r\n", FILE_APPEND);
        
        
        # Confirmation message
        $orderConfirmation = "Your order for '" . $productCode . "' has been placed!";
        
        # empty the fields
        $productCode = "";
        $cFirstName = "";
        $cLastName = "";
        $cCity = "";
        $comments = "";
        $price = "";
        $quantity = "";
    }
}


//loginAndLogout();

pageTop("Buying Page");
?>
<h2>Buying Form</h2>
<span class="redText">* = required</span>
<div class="formContainer">
    <form action="buying.php" method="POST">
        <p>
            <label>Product code:</label>
            <input type="text" name="productcode" value="<?php echo $productCode; ?>"/>
            <span class="redText"><?php echo $validateErrorProductCode; ?></span>
        </p>

        <p>
            <label>First Name:</label>
            <input type="text" name="firstname" value="<?php echo $cFirstName; ?>"/>
            <span class="redText"><?php echo $validateErrorFirstName; ?></span>
        </p>

        <p>
            <label>Last Name:</label>
            <input type="text" name="lastname" value="<?php echo $cLastName; ?>"/>
            <span class="redText"><?php echo $validateErrorLastName; ?></span>
        </p>

        <p>
            <label>City:</label>
            <input type="text" name="city" value="<?php echo $cCity; ?>"/>
            <span class="redText"><?php echo $validateErrorCity; ?></span>
        </p>

        <p>
            <label>Comments:</label>
            <input type="text" name="comments" value="<?php echo $comments; ?>"/>
            <span class="redText"><?php echo $validateErrorComments; ?></span>
        </p>

        <p>
            <label>Price:</label>
            <input type="text" name="price" value="<?php echo $price; ?>"/>
            <span class="redText"><?php echo $validateErrorPrice; ?></span>
        </p>

        <p>
            <label>Quantity:</label>
            <input type="text" name="quantity" value="<?php echo $quantity; ?>"/>
            <span class="redText"><?php echo $validateErrorQuantity; ?></span>
        </p>

        <input class="submitbutton" type="submit" value="Submit" name="buy"/>
    </form>
    
    <p class="greenText"><?php echo $orderConfirmation; ?></p>
</div>

<?php



pageBottom();
