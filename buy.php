<?php

#Revision history:
#
#DEVELOPER               DATE           COMMENTS
#Vithursan Nagalingam    2022-12-03     Created buy page
#Vithursan Nagalingam    2022-12-05     Fixed bugged where I had to use SESSION variable to get the customer_id 

# Constants
define("FOLDER_FUNCTIONS", "commonFunctions/");
define("FILE_FUNCTIONS", FOLDER_FUNCTIONS . "PHPfunctions.php");

const OBJECTS_FOLDER2 = "objects/";
const OBJECT_ORDER2 = OBJECTS_FOLDER2 . "order.php";
const OBJECT_ORDERS2 = OBJECTS_FOLDER2 . "orders.php";


require_once OBJECT_ORDER2;
require_once OBJECT_ORDERS2;
require_once FILE_FUNCTIONS;

global $loggedUser;
$customer_id = "";
$product_id = "";
$comments = "";
$quantity = "";

$validationErrorProductid = "";
$validationErrorQuantity = "";
$validationErrorComments = "";

$errorsOccured = false;
    
if (isset($_POST["buy_product"]))
{
    $customer_id = htmlspecialchars($_SESSION["loggedUser"]);
    $product_id = htmlspecialchars($_POST["product_id"]);
    $comments = htmlspecialchars($_POST["comments"]);
    $quantity = htmlspecialchars($_POST["quantity"]);
    
    $myOrder = new order();
    $myOrder->setCustomer_id($customer_id);
    $validationErrorProductid = $myOrder->setProduct_id($product_id);
    $validationErrorQuantity = $myOrder->setQuantity($quantity);
    $validationErrorComments = $myOrder->setComments($comments);
    
    if(!($validationErrorProductid == "" && $validationErrorQuantity == "" && $validationErrorComments == ""))
    {
        $errorsOccured = true;
    }
    
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
                    echo "<br><br>" . $row["product_code"] . "-" . $row["product_description"] . " (" . $row["product_price"] . "$)";
                    echo "</option>";
                }
            }
                
                ?>
            </select>
        </p>
        <p>
            <label>Comments:</label>
            <input type="text" name="comments" value="<?php echo $comments; ?>"/>
            <span class="redText"><?php echo $validationErrorComments ?>*</span>
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
