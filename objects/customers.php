<?php
#Revision history:
#
#DEVELOPER              DATE            COMMENTS
#Vithursan Nagalingam   2022-11-27      Created the customers class (plural class)


// Constants
const OBJECT_CUSTOMER = OBJECTS_FOLDER . "customer.php";
const OBJECT_COLLECTION = OBJECTS_FOLDER . "collection.php";

require_once OBJECT_CONNECTION;
require_once OBJECT_CUSTOMER;
require_once OBJECT_COLLECTION;

class players extends collection
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
                $customer = new customer($row["customer_id"], $row["firstname"]);
                
                $this->add($row["customer_id"], $customer);
            }
        }
    }
}

