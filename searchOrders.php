<?php
//Revision history:
//
//DEVELOPER               DATE           COMMENTS
//Vithursan Nagalingam    2022-12-12     Fixed ajax search function

define("FOLDER_FUNCTIONS", "commonFunctions/");
define("FILE_FUNCTIONS", FOLDER_FUNCTIONS . "PHPfunctions.php");

require_once FILE_FUNCTIONS;


if(isset($_POST["searchedOrder"]))
{  
    $loggedUser = $_SESSION["loggedUser"];
    $searchedDate = htmlspecialchars($_POST["searchedOrder"]);
    
    $SQLQuery = "CALL orders_search(:customer_id, :creation_datetime)";
    
    $rows = $connection->prepare($SQLQuery);
    $rows->bindParam(":customer_id", $loggedUser);
    $rows->bindParam(":creation_datetime", $searchedDate);

    ?>
    <table class="tableModify">
        <tr>
            <th>Date</th>
            <th>Product code</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Subtotal</th>
            <th>Taxes Amount</th>
            <th>Total</th>
        </tr>
        
        <tr>          
    <?php

    if ($rows->execute()) {
        while ($row = $rows->fetch()) {

            echo "<tr>";
            echo "  <td>" . $row["creation_datetime"] . "</td>";
            echo "  <td>" . $row["product_code"] . "</td>";
            echo "  <td>" . $row["product_price"] . "$</td>";
            echo "  <td>" . $row["quantity"] . "</td>";
            echo "  <td>" . $row["subtotal"] . "$</td>";
            echo "  <td>" . $row["taxes_amount"] . "$</td>";
            echo "  <td>" . $row["total"] . "$</td>";
            echo "</tr>";
        }
    }
    echo "</table>";
}
