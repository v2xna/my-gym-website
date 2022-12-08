<?php
#Revision history:
#
#DEVELOPER              DATE            COMMENTS
#Vithursan Nagalingam   2022-11-27      Created the order class
#Vithursan Nagalingam   2022-11-29      Created the constructor and getters/setters
#Vithursan Nagalingam   2022-11-30      Created the methods for order class
#Vithursan Nagalingam   2022-12-04      forgot to add getter/setter for order_id
#Vithursan Nagalingam   2022-12-05      added extra validations for quantity
#Vithursan Nagalingam   2022-12-07      comments can now be optional instead of required field
#Vithursan Nagalingam   2022-12-07      Added subtotal/taxes/total fields
#Vithursan Nagalingam   2022-12-07      Modified the methods for subtotal/taxes/total

//const OBJECTS_FOLDER = "objects/";
//const OBJECT_CONNECTION = OBJECTS_FOLDER . "DBconnection.php";

//require_once OBJECT_CONNECTION;

class order
{
    // Constants
    const ORDER_ID_MAX_LENGHT = 12;
    const ID_MAX_LENGHT = 36;
    const QUANTITY_MAX_AMOUNT = 99;
    const COMMENTS_MAX_LENGTH = 200;
    
    // Variables
    private $order_id = "";
    private $customer_id = "";
    private $product_id = "";
    private $quantity = "";
    private $comments = "";
    private $subtotal = "";
    private $taxes_amount = "";
    private $total = "";
    
    // Constructor
    public function __construct($newCustomer_id = "", $newProduct_id = "", $newQuantity = "", $newComments = "")
    {
        $this->setCustomer_id($newCustomer_id);
        $this->setProduct_id($newProduct_id);
        $this->setQuantity($newQuantity);
        $this->setComments($newComments);
    }
    
    // Getters and Setters
    
    // Order Id
    public function getOrderId()
    {
        return $this->order_id;
    }
    
    public function setOrderId($newOrderId)
    {
        if($newOrderId == "")
        {
            return "Order id cannot be empty";
        }
        else
        {
            if(mb_strlen($newOrderId) > self::ORDER_ID_MAX_LENGHT)
            {
                return "Order id cannot be longer than " . self::ORDER_ID_MAX_LENGHT . " characters";
            }
            else
            {
                $this->order_id = $newOrderId;
            }
        }
    }
    
    // customer_id
    public function getCustomer_id()
    {
        return $this->customer_id;
    }
    
    public function setCustomer_id($newCustomer_id)
    {
        if($newCustomer_id == "")
        {
            return "Customer id cannot be empty";
        }
        else
        {
            if(mb_strlen($newCustomer_id) > self::ID_MAX_LENGHT)
            {
                return "Customer id cannot be longer than " . self::ID_MAX_LENGHT . " characters";
            }
            else
            {
                $this->customer_id = $newCustomer_id;
            }
        }
    }
    
    // product_id
    public function getProduct_id()
    {
        return $this->product_id;
    }
    
    public function setProduct_id($newProduct_id)
    {
        if($newProduct_id == "")
        {
            return "Product id cannot be empty";
        }
        else
        {
            if(mb_strlen($newProduct_id) > self::ID_MAX_LENGHT)
            {
                return "Product id cannot be longer than " . self::ID_MAX_LENGHT . " characters";
            }
            else
            {
                $this->product_id = $newProduct_id;
            }
        }
    }
    
    // quantity
    public function getQuantity()
    {
        return $this->quantity;
    }
    
    public function setQuantity($newQuantity)
    {
        if($newQuantity == "")
        {
            return "Quantity cannot be empty";
        }
        else
        {
            if (is_numeric($newQuantity) == false) 
            {
                return "Quantity must be a numeric value!";
            }
            elseif((float)$newQuantity != (int)$newQuantity)
            {
                return "Quantity cannot be a decimal number";
            }
            elseif($newQuantity > self::QUANTITY_MAX_AMOUNT)
            {
                return "Quantity needs to be between 1 and " . self::QUANTITY_MAX_AMOUNT;
            }
            else
            {
                $this->quantity = $newQuantity;
            }
        }
    }
    
    // comments
    public function getComments()
    {
        return $this->comments;
    }
    
    public function setComments($newComments)
    {
        
        
        if(mb_strlen($newComments) > self::COMMENTS_MAX_LENGTH)
        {
            return "Comment cannot be longer than " . self::COMMENTS_MAX_LENGTH . " characters";
        }
        else
        {
            $this->comments = $newComments;
        }
        
    }
    
    // Subtotal
    public function getSubtotal()
    {
        return $this->subtotal;
    }
    public function setSubtotal($newSubtotal)
    {
        return $this->subtotal = $newSubtotal;
    }
    
    // Taxes
    public function getTaxesAmount()
    {
        return $this->taxes_amount;
    }
    public function setTaxesAmount($newTaxesAmount)
    {
        return $this->taxes_amount = $newTaxesAmount;
    }
    
    // Total
    public function getTotal()
    {
        return $this->total;
    }
    public function setTotal($newTotal)
    {
        return $this->total = $newTotal;
    }
    
    
    // Methods
    
    # Select a order
    function load($order_id)
    {
        global $connection;
        
        $SQLQuery = 'CALL orders_select_one_row(:order_id)';
        
        $rows = $connection->prepare($SQLQuery);
        
        $rows->bindParam(":order_id", $order_id);

        if ($rows->execute()) 
        {
            if($row = $rows->fetch(PDO::FETCH_ASSOC))
            {
                $this->order_id_id = $row["order_id"];
                $this->customer_id = $row["customer_id"];
                $this->product_id = $row["product_id"];
                $this->quantity = $row["quantity"];
                $this->comments = $row["comments"];
                $this->subtotal = $row["subtotal"];
                $this->taxes_amount = $row["taxes_amount"];
                $this->total = $row["total"];
                
                return true;
            }
        }
    }
    
    # INSERT AND UPDATE a order
    function save()
    {
        global $connection;
        
        if($this->order_id == "")
        {
            $SQLQuery = "CALL orders_insert(:customer_id, :product_id, :quantity, :comments, :subtotal, :taxes_amount, :total)";

            $rows = $connection->prepare($SQLQuery);

            $rows->bindParam(":customer_id", $this->customer_id, PDO::PARAM_STR);
            $rows->bindParam(":product_id", $this->product_id);
            $rows->bindParam(":quantity", $this->quantity);
            $rows->bindParam(":comments", $this->comments);
            $rows->bindParam(":subtotal", $this->subtotal);
            $rows->bindParam(":taxes_amount", $this->taxes_amount);
            $rows->bindParam(":total", $this->total);
            

            if ($rows->execute()) {
                echo $rows->rowCount() . " order was added!";
            }
        }
        else
        {
            $SQLQuery = "CALL orders_update(:order_id, :customer_id, :product_id, :quantity, :comments, :subtotal, :taxes_amount, :total)";

            $rows = $connection->prepare($SQLQuery);

            $rows->bindParam(":order_id", $this->order_id, PDO::PARAM_STR);
            $rows->bindParam(":customer_id", $this->customer_id);
            $rows->bindParam(":product_id", $this->product_id);
            $rows->bindParam(":quantity", $this->quantity);
            $rows->bindParam(":comments", $this->comments);
            $rows->bindParam(":subtotal", $this->subtotal);
            $rows->bindParam(":taxes_amount", $this->taxes_amount);
            $rows->bindParam(":total", $this->total);

            if ($rows->execute()) {
                return $rows->rowCount() . " order was updated!";
            }
        }   
    }
    
    
    # Delete a order
    function delete()
    {
        global $connection;
        
        $SQLQuery = "CALL orders_delete(:order_id)";

        $rows = $connection->prepare($SQLQuery);

        $rows->bindParam(":order_id", $this->order_id, PDO::PARAM_STR);

        if ($rows->execute()) {
            
            echo $rows->rowCount() . " order was deleted.";
        }
    }
}

