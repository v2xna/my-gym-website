<?php
#Revision history:
#
#DEVELOPER               DATE           COMMENTS
#Vithursan Nagalingam    2022-10-12     Made the basic look of the order page
#Vithursan Nagalingam    2022-10-14     Made a table to display all the orders
#Vithursan Nagalingam    2022-10-15     Used json decode to bring data from the buying page to order page (insert data into the table)
#Vithursan Nagalingam    2022-10-29     Added my php cheat sheet

# Constants
define("FOLDER_FUNCTIONS", "commonFunctions/");
define("FILE_FUNCTIONS", FOLDER_FUNCTIONS . "PHPfunctions.php");

define("FOLDER_SALES", "sales/");
define("FILE_SALES", FOLDER_SALES . "orders.txt");
define("File_PHPCheatSheet", FOLDER_SALES . "PHP_Cheat_Sheet.docx");



require_once FILE_FUNCTIONS;


pageTop("Orders Page");

echo "<h2>Orders</h2>";
echo "<table>";

# To prevent crashes
if(file_exists(FILE_SALES))
{
    echo "<p><a href='./sales/PHP_Cheat_Sheet.docx' download>Download my PHP cheat sheet</a></p>";
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
    
       echo "<tr>";
       echo "   <td>" . $jsonArray[0] . "</td>";
       echo "   <td>" . $jsonArray[1] . "</td>";
       echo "   <td>" . $jsonArray[2] . "</td>";
       echo "   <td>" . $jsonArray[3] . "</td>";
       echo "   <td>" . $jsonArray[4] . "</td>";
       echo "   <td>" . $jsonArray[5] . "$" . "</td>";
       echo "   <td>" . $jsonArray[6] . "</td>";
       echo "   <td>" . $jsonArray[7] . "$" . "</td>";
       echo "   <td>" . $jsonArray[8] . "$" . "</td>";
       echo "   <td>" . $jsonArray[9] . "$" . "</td>";
       echo "</tr>";
    }

    fclose($myOrders);
    echo "</table>";
    
} else {
    echo "";
}


?>


<?php

# Having issues with my pageBottom() function, doesn't display my footer
pageBottom();
