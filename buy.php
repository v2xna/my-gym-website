<?php

#Revision history:
#
#DEVELOPER               DATE           COMMENTS
#Vithursan Nagalingam    2022-12-02     Created buy page

# Constants
define("FOLDER_FUNCTIONS", "commonFunctions/");
define("FILE_FUNCTIONS", FOLDER_FUNCTIONS . "PHPfunctions.php");

const OBJECTS_FOLDER2 = "objects/";
const OBJECT_ORDER2 = OBJECTS_FOLDER2 . "order.php";
const OBJECT_ORDERS2 = OBJECTS_FOLDER2 . "orders.php";


require_once OBJECT_ORDER2;
require_once OBJECT_ORDERS2;
require_once FILE_FUNCTIONS;

$product_id = "";
$comments = "";
$quantity = "";

$validationErrorProductid = "";
$validationErrorQuantity = "";
$validationErrorComments = "";


    
if (isset($_POST["buy_product"]))
{
    $product_id = htmlspecialchars($_POST["product_id"]);
    $comments = htmlspecialchars($_POST["comments"]);
    $quantity = htmlspecialchars($_POST["quantity"]);
    
    $myOrder = new order();
    $validationErrorProductid = $myOrder->setProduct_id($product_id);
    $validationErrorQuantity = $myOrder->setQuantity($quantity);
    $validationErrorComments = $myOrder->setComments($comments);
    
    $myOrder->save();
}


pageTop("Buy Page");
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
