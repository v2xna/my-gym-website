<?php
#Revision history:
#
#DEVELOPER               DATE           COMMENTS
#Vithursan Nagalingam    2022-12-02     Created register page
#Vithursan Nagalingam    2022-12-02     Can now register customer in the database

# Constants
define("FOLDER_FUNCTIONS", "commonFunctions/");
define("FILE_FUNCTIONS", FOLDER_FUNCTIONS . "PHPfunctions.php");

const OBJECTS_FOLDER2 = "objects/";
const OBJECT_CUSTOMER2 = OBJECTS_FOLDER2 . "customer.php";
const OBJECT_CUSTOMERS2 = OBJECTS_FOLDER2 . "customers.php";


require_once OBJECT_CUSTOMER2;
require_once OBJECT_CUSTOMERS2;
require_once FILE_FUNCTIONS;


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
    
    // Save customer to database
    $myCustomer = new customer();
    $validationErrorFirstname = $myCustomer->setFirstname($firstname);
    $validationErrorLastname = $myCustomer->setLastname($lastname);
    $validationErrorAddress = $myCustomer->setAddress($address);
    $validationErrorCity = $myCustomer->setCity($city);
    $validationErrorProvince = $myCustomer->setProvince($province);
    $validationErrorPostalcode = $myCustomer->setPostalcode($postalcode);
    $validationErrorUsername = $myCustomer->setUsername($username);
    $validationErrorPassword = $myCustomer->setPassword($user_password);
    
    $myCustomer->save();
}

pageTop("Register Page");
?>

<h2>Register Form</h2>
<span class="redText">* = required</span>
<div class="formContainer">
    <!-- Add new player -->
    <form method="POST" enctype="multipart/form-data">
        
        <p>
            <label>First Name:</label>
            <input type="text" name="firstname"/>
            <span class="redText">*</span>
        </p>
        <p>
            <label>Last Name:</label>
            <input type="text" name="lastname"/>
            <span class="redText">*</span>
        </p>
        <p>
            <label>Address:</label>
            <input type="text" name="address"/>
            <span class="redText">*</span>
        </p>
        <p>
            <label>City:</label>
            <input type="text" name="city"/>
            <span class="redText">*</span>
        </p>
        <p>
            <label>Province:</label>
            <input type="text" name="province"/>
            <span class="redText">*</span>
        </p>
        <p>
            <label>Postal Code:</label>
            <input type="text" name="postalcode"/>
            <span class="redText">*</span>
        </p>
        <p>
            <label>Username:</label>
            <input type="text" name="username"/>
            <span class="redText">*</span>
        </p>
        <p>
            <label>Password:</label>
            <input type="password" name="user_password"/>
            <span class="redText">*</span>
        </p>
        
        <input class="submitbutton" type="submit" name="add_customer" value="Register"/>
        
        
<!--        <br>Screenshot:<input type="file" name="screenshot">-->
    </form>
</div>


<?php

pageBottom();


