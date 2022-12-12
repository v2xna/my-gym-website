<?php
#Revision history:
#
#DEVELOPER              DATE            COMMENTS
#Vithursan Nagalingam   2022-11-22      Created the class for customer
#Vithursan Nagalingam   2022-11-22      Created the constants and variables for the customer class
#Vithursan Nagalingam   2022-11-23      Created the constructor and getters/setters
#Vithursan Nagalingam   2022-11-26      Created the methods for load/save/delete a customer
#Vithursan Nagalingam   2022-12-04      forgot to add getter/setter for customer_id


// Constants
//const OBJECTS_FOLDER = "objects/";
//const OBJECT_CONNECTION = OBJECTS_FOLDER . "DBconnection.php";

//require_once OBJECT_CONNECTION;

class customer
{
    // Constants
    const ID_MAX_LENGTH = 36;
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
    
    // Customer Id
    public function getCustomerId()
    {
        return $this->customer_id;
    }
    
    public function setCustomerId($newCustomerId)
    {
        if($newCustomerId == "")
        {
            return "Customer id cannot be empty";
        }
        else
        {
            if(mb_strlen($newCustomerId) > self::ID_MAX_LENGTH)
            {
                return "Customer id cannot be longer than " . self::ID_MAX_LENGTH . " characters";
            }
            else
            {
                $this->customer_id = $newCustomerId;
            }
        }
    }
    
    // FirstName
    public function getFirstname()
    {
        return $this->firstname;
    }
    
    public function setFirstname($newFirstname)
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
    
    public function setLastname($newLastname)
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
    
    public function setAddress($newAddress)
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
    
    public function setCity($newCity)
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
    
    public function setProvince($newProvince)
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
    
    public function setPostalcode($newPostalcode)
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
    
    public function setUsername($newUsername)
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
    
    public function setPassword($newPassword)
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
    
    # Load a customer
    function load($customer_id)
    {
        global $connection;
        
        $SQLQuery = 'CALL customers_select_one_row(:customer_id)';
        
        $rows = $connection->prepare($SQLQuery);
        
        $rows->bindParam(":customer_id", $customer_id);

        if ($rows->execute()) 
        {
            if($row = $rows->fetch(PDO::FETCH_ASSOC))
            {
                $this->customer_id = $row["customer_id"];
                $this->firstname = $row["firstname"];
                $this->lastname = $row["lastname"];
                $this->address = $row["address"];
                $this->city = $row["city"];
                $this->province = $row["province"];
                $this->postalcode = $row["postalcode"];
                $this->username = $row["username"];
                
                return true;
            }
        }
    }
    
    # INSERT AND UPDATE a customer
    function save()
    {
        global $connection;
        
        if($this->customer_id == "")
        {
            $SQLQuery = "CALL customers_insert(:firstname, :lastname, :address, :city, :province, :postalcode, :username, :user_password)";

            $rows = $connection->prepare($SQLQuery);

            $rows->bindParam(":firstname", $this->firstname, PDO::PARAM_STR);
            $rows->bindParam(":lastname", $this->lastname);
            $rows->bindParam(":address", $this->address);
            $rows->bindParam(":city", $this->city);
            $rows->bindParam(":province", $this->province);
            $rows->bindParam(":postalcode", $this->postalcode);
            $rows->bindParam(":username", $this->username);
            $rows->bindParam(":user_password", $this->password);

            if ($rows->execute()) {
                echo "You have registred successfully!";
            }
        }
        else
        {
            $SQLQuery = "CALL customers_update(:customer_id, :firstname, :lastname, :address, :city, :province, :postalcode, :username, :user_password)";

            $rows = $connection->prepare($SQLQuery);

            $rows->bindParam(":customer_id", $this->customer_id, PDO::PARAM_STR);
            $rows->bindParam(":firstname", $this->firstname);
            $rows->bindParam(":lastname", $this->lastname);
            $rows->bindParam(":address", $this->address);
            $rows->bindParam(":city", $this->city);
            $rows->bindParam(":province", $this->province);
            $rows->bindParam(":postalcode", $this->postalcode);
            $rows->bindParam(":username", $this->username);
            $rows->bindParam(":user_password", $this->password);

            if ($rows->execute()) {
                return $rows->rowCount() . " Customer was updated!";
            }
        }   
    }
    
    # Delete a customer
    function delete()
    {
        global $connection;
        
        $SQLQuery = "CALL customers_delete(:customer_id)";

        $rows = $connection->prepare($SQLQuery);

        $rows->bindParam(":customer_id", $this->customer_id, PDO::PARAM_STR);

        if ($rows->execute()) {
            
            echo $rows->rowCount() . " player was deleted.";
        }
    }
    
}


