<?php

#Revision history:
#
#DEVELOPER               DATE           COMMENTS
#Vithursan Nagalingam    2022-12-03     Created buy page
#Vithursan Nagalingam    2022-12-05     Fixed bugged where I had to use SESSION variable to get the customer_id
#Vithursan Nagalingam    2022-12-07     Added subtotal/taxes_amount/total fields..
#Vithursan Nagalingam    2022-12-07     Method to calculate a product

# Constants
define("FOLDER_FUNCTIONS", "commonFunctions/");
define("FILE_FUNCTIONS", FOLDER_FUNCTIONS . "PHPfunctions.php");

const OBJECTS_FOLDER = "objects/";
const OBJECT_ORDER = OBJECTS_FOLDER . "order.php";
const OBJECT_ORDERS = OBJECTS_FOLDER . "orders.php";
const OBJECT_COLLECTION = OBJECTS_FOLDER . "collection.php";
const OBJECT_PRODUCT = OBJECTS_FOLDER . "product.php";

require_once OBJECT_COLLECTION;
require_once OBJECT_ORDER;
require_once OBJECT_ORDERS;
require_once OBJECT_PRODUCT;
require_once FILE_FUNCTIONS;

global $loggedUser;
$customer_id = "";
$product_id = "";
$comments = "";
$quantity = "";
$subtotal = "";
$taxes_amount = "";
$total = "";
const TAX_RATE = 0.137;

$validationErrorProductid = "";
$validationErrorQuantity = "";
$validationErrorComments = "";

$errorsOccured = false;
    
if (isset($_POST["buy_product"]))
{
    // Variables
    $customer_id = htmlspecialchars($_SESSION["loggedUser"]);
    $product_id = htmlspecialchars($_POST["product_id"]);
    $comments = htmlspecialchars($_POST["comments"]);
    $quantity = htmlspecialchars($_POST["quantity"]);
    
    // Get product price
    $myProduct = new product();
    $myProduct->load($product_id);
    
    // Caculations of the product
    $price = $myProduct->getProductprice();
    $subtotal = $price * $quantity;
    $taxes_amount = $subtotal * TAX_RATE;
    $total = $subtotal + $taxes_amount;
    
    // My order object
    $myOrder = new order();
    $myOrder->setCustomer_id($customer_id);
    $validationErrorProductid = $myOrder->setProduct_id($product_id);
    $validationErrorQuantity = $myOrder->setQuantity($quantity);
    $validationErrorComments = $myOrder->setComments($comments);
    $myOrder->setSubtotal($subtotal);
    $myOrder->setTaxesAmount($taxes_amount);
    $myOrder->setTotal($total);
    
    // Checking for errors
    if(!($validationErrorProductid == "" && $validationErrorQuantity == "" && $validationErrorComments == ""))
    {
        $errorsOccured = true;
    }
    
    // if no errors
    if(!($errorsOccured))
    {
        # save order into database
        $myOrder->save();
        
        # Empty the fields after ordering
        $comments = "";
        $quantity = "";
        
    }
    
    
}


pageTop("Buy Page");
loginAndLogout();
?>

<h2>Buy</h2>
<span class="redText">* = required</span>
<div class="formContainer">
    <!-- Add new player -->
    <form method="POST" enctype="multipart/form-data">
        
        <p>
            <label>Product:</label>
            <select name="product_id">
                <?php
                
                $SQLQuery = "CALL products_select_all()";
                $rows = $connection->prepare($SQLQuery);
                
                if ($rows->execute()) {
            
                while ($row = $rows->fetch()) {
                    echo "<option value='" . $row["product_id"] . "'>";
                    echo "<br><br>" . $row["product_code"] . " - " . $row["product_description"] . " (" . $row["product_price"] . "$)";
                    echo "</option>";
                }
            }
                
                ?>
            </select>
        </p>
        <p>
            <label>Comments:</label>
            <input type="text" name="comments" value="<?php echo $comments; ?>"/>
            <span class="redText"><?php echo $validationErrorComments; ?></span>
        </p>
        <p>
            <label>Quantity:</label>
            <input type="text" name="quantity" value="<?php echo $quantity; ?>"/>
            <span class="redText"><?php echo $validationErrorQuantity; ?>*</span>
        </p>
        
        <input class="submitbutton" type="submit" name="buy_product" value="Buy"/>
        
    </form>
</div>

<?php

pageBottom();
