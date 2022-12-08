<?php
#Revision history:
#
#DEVELOPER               DATE           COMMENTS
#Vithursan Nagalingam    2022-12-07     Created orders page
#Vithursan Nagalingam    2022-12-07     Created order html table
#Vithursan Nagalingam    2022-12-07     Added subtotal/taxesAmount/total into the table
#Vithursan Nagalingam    2022-12-07     Tried to implement search function


# Constants
define("FOLDER_FUNCTIONS", "commonFunctions/");
define("FILE_FUNCTIONS", FOLDER_FUNCTIONS . "PHPfunctions.php");

require_once FILE_FUNCTIONS;

 
$loggedUser = $_SESSION["loggedUser"];

if (isset($_POST["delete_order"]))
{
    $order_id = htmlspecialchars($_POST["order_id"]);

    $SQLQuery = "CALL orders_delete(:order_id)";
        
    $rows = $connection->prepare($SQLQuery);
    
    $rows->bindParam(":order_id", $order_id, PDO::PARAM_STR);
    
    if ($rows->execute())
    {
        echo $rows->rowCount() . " order has been deleted!";
    }
}



pageTop("Customer Orders");

loginAndLogout();

echo "<h2>Orders</h2>";

?>

<div>
    <label>Show orders made on this date or later:</label>
    <input type="text" id="searchedPlayerName">
    <button onclick="searchPlayers()">Search</button>
</div>


<table class="tableModify">
    <tr>
        <th>Delete</th>
        <th>Date</th>
        <th>Product code</th>
        <th>First name</th>
        <th>Last name</th>
        <th>City</th>
        <th>Comments</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Subtotal</th>
        <th>Taxes Amount</th>
        <th>Total</th>
    </tr>
    
    <tr>
        
    

<?php

if (isset($_POST["searchedPlayer"]))
{
    
}

// Select orders of a specific customer from my view table
$SQLQuery = " SELECT * FROM orders_customers_products_view WHERE customer_id = '{$loggedUser}'";

$rows = $connection->prepare($SQLQuery);

if ($rows->execute()) {
    while ($row = $rows->fetch()) {
        
        echo "<tr>";
        echo "  <td>" ?>
        <form method ="POST">
        <input type="hidden" name="order_id" value="<?php echo $row["order_id"] ?>">
        <input type='submit' name='delete_order' value='Delete this order'></form> <?php "</td>";
        echo "  <td>" . $row["creation_datetime"] . "</td>";
        echo "  <td>" . $row["product_code"] . "</td>";
        echo "  <td>" . $row["firstname"] . "</td>";
        echo "  <td>" . $row["lastname"] . "</td>";
        echo "  <td>" . $row["city"] . "</td>";
        echo "  <td>" . $row["comments"] . "</td>";
        echo "  <td>" . $row["product_price"] . "$</td>";
        echo "  <td>" . $row["quantity"] . "</td>";
        echo "  <td>" . $row["subtotal"] . "$</td>";
        echo "  <td>" . $row["taxes_amount"] . "$</td>";
        echo "  <td>" . $row["total"] . "$</td>";
        echo "</tr>";
        
        
        ?>

    


           
        <?php
    }
}
echo "</table>";


?>



<?php
pageBottom();
