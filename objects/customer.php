<?php
#Revision history:
#
#DEVELOPER              DATE            COMMENTS
#Vithursan Nagalingam   2022-11-22      Created the class for customer
#Vithursan Nagalingam   2022-11-22      Created the constants and variables for the customer class

// Constants
const OBJECTS_FOLDER = "objects/";
const OBJECT_CONNECTION = OBJECTS_FOLDER . "DBconnection.php";

require_once OBJECT_CONNECTION;

class customer
{
    // Constants
    const NAME_MAX_LENGTH = 20;
    const ADDRESS_MAX_LENGTH = 25;
    const POSTALCODE_MAX_LENGTH = 7;
    const USERNAME_MAX_LENGTH = 15;
    const PASSWORD_MAX_LENGTH = 255;
    
    // Variables
    private $customer_id = "";
    private $firstname = "";
    private $lastname = "";
    private $address = "";
    private $city = "";
    private $province = "";
    private $postalcode = "";
    private $username = "";
    private $user_password = "";
    
    // Constructor
    
}


