<?php
#Revision history:
#
#DEVELOPER              DATE            COMMENTS
#Vithursan Nagalingam   2022-11-27      Created the class for product
#Vithursan Nagalingam   2022-11-27      Created the constructors, getters and setters and methods for product class


require_once OBJECT_CONNECTION;

class product
{
    // Constants
    const PRODUCT_CODE_MAX_LENGTH = 12;
    const PRODUCT_DESCRIPTION_MAX_LENGTH = 100;
    const PRODUCT_PRICE_MAX_AMOUNT = 10000;
    
    // Variables
    private $product_id = "";
    private $product_code = "";
    private $product_description = "";
    private $product_price = "";
    
    // Constructor
    public function __construct($newProductcode = "", $newProductdescription = "", $newProductprice = "")
    {
        $this->setProductcode($newProductcode);
        $this->setProductdescription($newProductdescription);
        $this->setProductprice($newProductprice);
    }
    
    // Getters and Setters
    
    # Product Code
    public function getProductcode()
    {
        return $this->product_code;
    }
    
    public function setProductcode($newProductcode)
    {
        if($newProductcode == "")
        {
            return "Product code cannot be empty";
        }
        else
        {
            if(mb_strlen($newProductcode) > self::PRODUCT_CODE_MAX_LENGTH)
            {
                return "Product code cannot be longer than " . self::PRODUCT_CODE_MAX_LENGTH . " characters";
            }
            else
            {
                $this->product_code = $newProductcode;
            }
        }
    }
    
    # Product Description
    public function getProductdescription()
    {
        return $this->product_description;
    }
    
    public function setProductdescription($newProductdescription)
    {
        if($newProductdescription == "")
        {
            return "Product description cannot be empty";
        }
        else
        {
            if(mb_strlen($newProductdescription) > self::PRODUCT_DESCRIPTION_MAX_LENGTH)
            {
                return "Product description cannot be longer than " . self::PRODUCT_DESCRIPTION_MAX_LENGTH . " characters";
            }
            else
            {
                $this->product_description = $newProductdescription;
            }
        }
    }
    
    # Product Price
    public function getProductprice()
    {
        return $this->product_price;
    }
    
    public function setProductprice($newProductprice)
    {
        if($newProductprice == "")
        {
            return "Product price cannot be empty";
        }
        else
        {
            if($newProductprice > self::PRODUCT_PRICE_MAX_AMOUNT)
            {
                return "Product price cannot be higher than " . self::PRODUCT_CODE_MAX_LENGTH . " $";
            }
            else
            {
                $this->product_price = $newProductprice;
            }
        }
    }
    
    // Methods
    
    # Load a product
    function load($product_id)
    {
        global $connection;
        
        $SQLQuery = 'CALL products_select_one_row(:product_id)';
        
        $rows = $connection->prepare($SQLQuery);
        
        $rows->bindParam(":product_id", $product_id);

        if ($rows->execute()) 
        {
            if($row = $rows->fetch(PDO::FETCH_ASSOC))
            {
                $this->product_id = $row["product_id"];
                $this->product_code = $row["product_code"];
                $this->product_description = $row["product_description"];
                $this->product_price = $row["product_price"];
                
                return true;
            }
        }
    }
    
    # INSERT AND UPDATE a product
    function save()
    {
        global $connection;
        
        if($this->product_id == "")
        {
            $SQLQuery = "CALL products_insert(:product_code, :product_description, :product_price)";

            $rows = $connection->prepare($SQLQuery);

            $rows->bindParam(":product_code", $this->product_code, PDO::PARAM_STR);
            $rows->bindParam(":product_description", $this->product_description);
            $rows->bindParam(":product_price", $this->product_price);

            if ($rows->execute()) {
                echo $rows->rowCount() . " product was added!";
            }
        }
        else
        {
            $SQLQuery = "CALL products_update(:product_id, :product_code, :product_description, :product_price)";

            $rows = $connection->prepare($SQLQuery);

            $rows->bindParam(":product_id", $this->product_id, PDO::PARAM_STR);
            $rows->bindParam(":product_code", $this->product_code);
            $rows->bindParam(":product_description", $this->product_description);
            $rows->bindParam(":product_price", $this->product_price);

            if ($rows->execute()) {
                return $rows->rowCount() . " product was updated!";
            }
        }   
    }
    
    # Delete a product
    function delete()
    {
        global $connection;
        
        $SQLQuery = "CALL products_delete(:product_id)";

        $rows = $connection->prepare($SQLQuery);

        $rows->bindParam(":product_id", $this->product_id, PDO::PARAM_STR);

        if ($rows->execute()) {
            
            echo $rows->rowCount() . " product was deleted.";
        }
    }
}

