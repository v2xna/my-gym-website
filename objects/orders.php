<?php
#Revision history:
#
#DEVELOPER              DATE            COMMENTS
#Vithursan Nagalingam   2022-11-30      Created the orders class (plural class)


// Constants

const OBJECT_ORDER = OBJECTS_FOLDER . "order.php";
const OBJECT_COLLECTION = OBJECTS_FOLDER . "collection.php";

require_once OBJECT_CONNECTION;
require_once OBJECT_ORDER;
require_once OBJECT_COLLECTION;

class orders extends collection
{
    function __construct()
    {
        global $connection;
        
        $SQLQuery = "CALL orders_select_all()";
        
        $rows = $connection->prepare($SQLQuery);
        
        if($rows->execute())
        {
            while ($row = $rows->fetch())
            {
                $order = new order($row["order_id"], $row["customer_id"]);
                
                $this->add($row["order_id"], $order);
            }
        }
    }
}

