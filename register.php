<?php
#Revision history:
#
#DEVELOPER               DATE           COMMENTS
#Vithursan Nagalingam    2022-12-02     Created register page
#Vithursan Nagalingam    2022-12-02     Can now register customer in the database
#Vithursan Nagalingam    2022-12-03     added validation error

# Constants
define("FOLDER_FUNCTIONS", "commonFunctions/");
define("FILE_FUNCTIONS", FOLDER_FUNCTIONS . "PHPfunctions.php");

const OBJECTS_FOLDER2 = "objects/";
const OBJECT_CUSTOMER2 = OBJECTS_FOLDER2 . "customer.php";
const OBJECT_CUSTOMERS2 = OBJECTS_FOLDER2 . "customers.php";


require_once OBJECT_CUSTOMER2;
require_once OBJECT_CUSTOMERS2;
require_once FILE_FUNCTIONS;


// Variables
$firstname = "";
$lastname = "";
$address = "";
$city = "";
$province = "";
$postalcode = "";
$username = "";
$user_password = "";

$validationErrorFirstname = "";
$validationErrorLastname = "";
$validationErrorAddress = "";
$validationErrorCity = "";
$validationErrorProvince = "";
$validationErrorPostalcode = "";
$validationErrorUsername = "";
$validationErrorPassword = "";

$errorsOccured = false;

if (isset($_POST["add_customer"]))
{
    $firstname = htmlspecialchars($_POST["firstname"]);
    $lastname = htmlspecialchars($_POST["lastname"]);
    $address = htmlspecialchars($_POST["address"]);
    $city = htmlspecialchars($_POST["city"]);
    $province = htmlspecialchars($_POST["province"]);
    $postalcode = htmlspecialchars($_POST["postalcode"]);
    $username = htmlspecialchars($_POST["username"]);
    $user_password = htmlspecialchars(password_hash($_POST["user_password"], PASSWORD_DEFAULT));
    //$screenShotFile = null;
    
    // validation for customer
    $myCustomer = new customer();
    $validationErrorFirstname = $myCustomer->setFirstname($firstname);
    $validationErrorLastname = $myCustomer->setLastname($lastname);
    $validationErrorAddress = $myCustomer->setAddress($address);
    $validationErrorCity = $myCustomer->setCity($city);
    $validationErrorProvince = $myCustomer->setProvince($province);
    $validationErrorPostalcode = $myCustomer->setPostalcode($postalcode);
    $validationErrorUsername = $myCustomer->setUsername($username);
    $validationErrorPassword = $myCustomer->setPassword($user_password);
    
    // checking for errors
    if (!($validationErrorFirstname == "" && $validationErrorLastname == "" && $validationErrorAddress == "" && $validationErrorCity == "" && $validationErrorProvince == "" && $validationErrorPostalcode == "" && $validationErrorUsername == "" && $validationErrorPassword == ""))
    {
        $errorsOccured = true;
    }
    
    // if no errors
    if (!($errorsOccured))
    {
        # save customer to database
        $myCustomer->save();
        
        # empty the fields
        $firstname = "";
        $lastname = "";
        $address = "";
        $city = "";
        $province = "";
        $postalcode = "";
        $username = "";
        $user_password = "";
    } 
    
}

pageTop("Register Page");
?>

<h2>Register Form</h2>
<span class="redText">* = required</span>
<div class="formContainer">
    <!-- Add new customer -->
    <form method="POST" enctype="multipart/form-data">
        
        <p>
            <label>First Name:</label>
            <input type="text" name="firstname" value="<?php echo $firstname; ?>"/>
            <span class="redText"><?php echo $validationErrorFirstname; ?>*</span>
        </p>
        <p>
            <label>Last Name:</label>
            <input type="text" name="lastname" value="<?php echo $lastname; ?>"/>
            <span class="redText"><?php echo $validationErrorLastname ?>*</span>
        </p>
        <p>
            <label>Address:</label>
            <input type="text" name="address" value="<?php echo $address; ?>"/>
            <span class="redText"><?php echo $validationErrorAddress; ?>*</span>
        </p>
        <p>
            <label>City:</label>
            <input type="text" name="city" value="<?php echo $city; ?>"/>
            <span class="redText"><?php echo $validationErrorCity; ?>*</span>
        </p>
        <p>
            <label>Province:</label>
            <input type="text" name="province" value="<?php echo $province; ?>"/>
            <span class="redText"><?php echo $validationErrorProvince; ?>*</span>
        </p>
        <p>
            <label>Postal Code:</label>
            <input type="text" name="postalcode" value="<?php echo $postalcode; ?>"/>
            <span class="redText"><?php echo $validationErrorPostalcode; ?>*</span>
        </p>
        <p>
            <label>Username:</label>
            <input type="text" name="username" value="<?php echo $username; ?>"/>
            <span class="redText"><?php echo $validationErrorUsername; ?>*</span>
        </p>
        <p>
            <label>Password:</label>
            <input type="password" name="user_password" value="<?php echo $user_password; ?>"/>
            <span class="redText"><?php echo $validationErrorPassword; ?>*</span>
        </p>
        
        <input class="submitbutton" type="submit" name="add_customer" value="Register"/>
        
        
<!--        <br>Screenshot:<input type="file" name="screenshot">-->
    </form>
</div>


<?php

pageBottom();


