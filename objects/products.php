<?php
#Revision history:
#
#DEVELOPER              DATE            COMMENTS
#Vithursan Nagalingam   2022-11-27      Created the products class (plural class)


const OBJECT_PRODUCT = OBJECTS_FOLDER . "product.php";

require_once OBJECT_CONNECTION;
require_once OBJECT_COLLECTION;
require_once OBJECT_PRODUCT;

class products extends collection
{
    function __construct()
    {
        global $connection;
        
        $SQLQuery = "CALL products_select_all()";
        
        $rows = $connection->prepare($SQLQuery);
        
        if($rows->execute())
        {
            while ($row = $rows->fetch())
            {
                $product = new product($row["product_id"], $row["product_code"]);
                
                $this->add($row["product_id"], $product);
            }
        }
    }
}


