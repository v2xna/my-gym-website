<?php
#Revision history:
#
#DEVELOPER              DATE            COMMENTS
#Vithursan Nagalingam   2022-11-22      Created the class for customer
#Vithursan Nagalingam   2022-11-22      Created the constants and variables for the customer class
#Vithursan Nagalingam   2022-11-23      Created the constructor and getters/setters


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
    private $password = "";
    
    // Constructor
    public function __construct($newFirstname = "", $newLastname = "", $newAddress = "", $newCity = "", $newProvince = "", $newPostalcode = "", $newUsername = "", $newPassword = "")
    {
        $this->setFirstname($newFirstname);
        $this->setLastname($newLastname);
        $this->setAddress($newAddress);
        $this->setCity($newCity);
        $this->setProvince($newProvince);
        $this->setPostalcode($newPostalcode);
        $this->setUsername($newUsername);
        $this->setPassword($newPassword);
    }
    
    // Getters and Setters
    
    // FirstName
    public function getFirstname()
    {
        return $this->firstname;
    }
    
    public function setFirstname()
    {
        if($newFirstname == "")
        {
            return "First name cannot be empty";
        }
        else
        {
            if(mb_strlen($newFirstname) > self::NAME_MAX_LENGTH)
            {
                return "First name cannot be longer than " . self::NAME_MAX_LENGTH . " characters";
            }
            else
            {
                $this->firstname = $newFirstname;
            }
        }
    }
    
    // LastName
    public function getLastname()
    {
        return $this->lastname;
    }
    
    public function setLastname()
    {
        if($newLastname == "")
        {
            return "Last name cannot be empty";
        }
        else
        {
            if(mb_strlen($newLastname) > self::NAME_MAX_LENGTH)
            {
                return "Last name cannot be longer than " . self::NAME_MAX_LENGTH . " characters";
            }
            else
            {
                $this->lastname = $newLastname;
            }
        }
    }
    
    // Address
    public function getAddress()
    {
        return $this->address;
    }
    
    public function setAddress()
    {
        if($newAddress == "")
        {
            return "Address cannot be empty";
        }
        else
        {
            if(mb_strlen($newAddress) > self::ADDRESS_MAX_LENGTH)
            {
                return "Address cannot be longer than " . self::ADDRESS_MAX_LENGTH . " characters";
            }
            else
            {
                $this->address = $newAddress;
            }
        }
    }
    
    // City
    public function getCity()
    {
        return $this->city;
    }
    
    public function setCity()
    {
        if($newCity == "")
        {
            return "City cannot be empty";
        }
        else
        {
            if(mb_strlen($newCity) > self::ADDRESS_MAX_LENGTH)
            {
                return "City cannot be longer than " . self::ADDRESS_MAX_LENGTH . " characters";
            }
            else
            {
                $this->city = $newCity;
            }
        }
    }
    
    // Province
    public function getProvince()
    {
        return $this->province;
    }
    
    public function setProvince()
    {
        if($newProvince == "")
        {
            return "Province cannot be empty";
        }
        else
        {
            if(mb_strlen($newProvince) > self::ADDRESS_MAX_LENGTH)
            {
                return "Province cannot be longer than " . self::ADDRESS_MAX_LENGTH . " characters";
            }
            else
            {
                $this->province = $newProvince;
            }
        }
    }
    
    // Postal code
    public function getPostalcode()
    {
        return $this->postalcode;
    }
    
    public function setPostalcode()
    {
        if($newPostalcode == "")
        {
            return "Postal code cannot be empty";
        }
        else
        {
            if(mb_strlen($newPostalcode) > self::POSTALCODE_MAX_LENGTH)
            {
                return "Postal code cannot be longer than " . self::POSTALCODE_MAX_LENGTH . " characters";
            }
            else
            {
                $this->postalcode = $newPostalcode;
            }
        }
    }
    
    // Username
    public function getUsername()
    {
        return $this->username;
    }
    
    public function setUsername()
    {
        if($newUsername == "")
        {
            return "Username cannot be empty";
        }
        else
        {
            if(mb_strlen($newUsername) > self::USERNAME_MAX_LENGTH)
            {
                return "Username cannot be longer than " . self::USERNAME_MAX_LENGTH . " characters";
            }
            else
            {
                $this->username = $newUsername;
            }
        }
    }
    
    // Password
    public function getPassword()
    {
        return $this->password;
    }
    
    public function setPassword()
    {
        if($newPassword == "")
        {
            return "Password cannot be empty";
        }
        else
        {
            if(mb_strlen($newPassword) > self::PASSWORD_MAX_LENGTH)
            {
                return "Password cannot be longer than " . self::PASSWORD_MAX_LENGTH . " characters";
            }
            else
            {
                $this->password = $newPassword;
            }
        }
    }
    
    // Methods
}


