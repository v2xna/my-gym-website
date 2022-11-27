<?php
#Revision history:
#
#DEVELOPER              DATE            COMMENTS
#Vithursan Nagalingam   2022-11-27      Created the collection class

class collection
{
    public $items = array();
    // note that all these functions are done in memory, not in the database
    #                   customer_id    customer/product/order
    public function add($primary_key, $item)
    {
        # items["c1c1f44a-6d0e-11ed-adfb-4c72b99d23dd"] = customer/products/orders
        $this->items[$primary_key] = $item;
    }
    
    # Remove specific customer/product/order
    public function remove($primary_key, $item)
    {
        if(isset($this->items[$primary_key]))
        {
            #remove from memory
            unset($this->items[$primary_key]);
        }
    }
    
    public function get($primary_key)
    {
        if(isset($this->items[$primary_key]))
        {
            return ($this->items[$primary_key]);
        }
    }
    
    # Displays the total count of customers/products/orders
    public function count()
    {
        return count($this->items);
    }
}

