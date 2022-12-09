<?php
#Revision history:
#
#DEVELOPER              DATE            COMMENTS
#Vithursan Nagalingam   2022-11-27      Created the customers class (plural class)
#Vithursan Nagalingam   2022-12-09      Added rest of the plural rows..
#Vithursan Nagalingam   2022-12-09      had issues with constants..


// Constants
const OBJECTS_FOLDER = "objects/";
//const OBJECT_CUSTOMER = OBJECTS_FOLDER . "customer.php";
const OBJECT_COLLECTION = OBJECTS_FOLDER . "collection.php";

//require_once OBJECT_CONNECTION;
//require_once OBJECT_CUSTOMER;
require_once OBJECT_COLLECTION;

class customers extends collection
{
    function __construct()
    {
        global $connection;
        
        $SQLQuery = "CALL customers_select_all()";
        
        $rows = $connection->prepare($SQLQuery);
        
        if($rows->execute())
        {
            while ($row = $rows->fetch())
            {
                $customer = new customer($row["customer_id"], $row["firstname"], $row["lastname"], $row["address"], $row["city"],
                                         $row["province"], $row["postalcode"], $row["username"]);
                
                $this->add($row["customer_id"], $customer);
            }
        }
    }
}

