<?php
#Revision history:
#
#DEVELOPER              DATE            COMMENTS
#Vithursan Nagalingam   2022-11-27      Created the order class
#Vithursan Nagalingam   2022-11-29      Created the constructor and getters/setters

require_once OBJECT_CONNECTION;

class order
{
    // Constants
    const ID_MAX_LENGHT = 36;
    const QUANTITY_MAX_AMOUNT = 99;
    const COMMENTS_MAX_LENGTH = 200;
    
    // Variables
    private $order_id = "";
    private $customer_id = "";
    private $product_id = "";
    private $quantity = "";
    private $comments = "";
    
    // Constructor
    public function __construct($newCustomer_id = "", $newProduct_id = "", $newQuantity = "", $newComments = "")
    {
        $this->setCustomer_id($newCustomer_id);
        $this->setProduct_id($newProduct_id);
        $this->setQuantity($newQuantity);
        $this->setComments($newComments);
    }
    
    // Getters and Setters
    
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
            if($newQuantity > self::QUANTITY_MAX_AMOUNT)
            {
                return "Quantity cannot be longer than " . self::QUANTITY_MAX_AMOUNT;
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
        if($newComments == "")
        {
            return "Comment cannot be empty";
        }
        else
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
    }
    
    // Methods
    
    
}

