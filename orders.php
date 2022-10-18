<?php

# Constants
define("FOLDER_FUNCTIONS", "commonFunctions/");
define("FILE_FUNCTIONS", FOLDER_FUNCTIONS . "PHPfunctions.php");

define("FOLDER_SALES", "sales/");
define("FILE_SALES", FOLDER_SALES . "orders.txt");

require_once FILE_FUNCTIONS;

pageTop("Orders Page");

#<table>
//$myOrders = fopen(FILE_SALES, "r") or die("Unable to open the file");
//
//while(!feof($myOrders))
//{
//
//    $fileLine = fgets($myOrders);
//    json_decode($fileLine);
//    
//    echo "<br>" . $fileLine;
//}
//
//fclose($myOrders);

#<table>

echo "<h2>Orders</h2>";
echo "<table>";

# To prevent crashes
if(file_exists(FILE_SALES))
{
    echo "<table class=tableModify>";
    
    $myOrders = fopen(FILE_SALES, "r") or die("Unable to open the file");
    
    echo "<tr>";
    echo "  <th>Product ID</th>";
    echo "  <th>First name</th>";
    echo "  <th>Last name</th>";
    echo "  <th>City</th>";
    echo "  <th>Comments</th>";
    echo "  <th>Price</th>";
    echo "  <th>Quantity</th>";
    echo "  <th>Subtotal</th>";
    echo "  <th>Taxes</th>";
    echo "  <th>Grand total</th>";
    echo "</tr>";
    
    while(!feof($myOrders))
    {

       $fileLine = fgets($myOrders);
       $jsonArray = json_decode($fileLine);
    
       //echo "<tr><td>" . $jsonArray[0] . "</td><td>" . $jsonArray[1] . "</td><td>" . $jsonArray[2] . "</td><td>" . $jsonArray[3] . "</td></tr>";
       echo "<tr>";
       echo "   <td>" . $jsonArray[0] . "</td>";
       echo "   <td>" . $jsonArray[1] . "</td>";
       echo "   <td>" . $jsonArray[2] . "</td>";
       echo "   <td>" . $jsonArray[3] . "</td>";
       echo "   <td>" . $jsonArray[4] . "</td>";
       echo "   <td>" . $jsonArray[5] . "</td>";
       echo "   <td>" . $jsonArray[6] . "</td>";
       echo "   <td>" . $jsonArray[7] . "</td>";
       echo "   <td>" . $jsonArray[8] . "</td>";
       echo "   <td>" . $jsonArray[9] . "</td>";
       echo "</tr>";
    }

    fclose($myOrders);
    echo "</table>";
} else {
    echo "";
}


?>


<?php



pageBottom();