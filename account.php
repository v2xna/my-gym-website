<?php
#Revision history:
#
#DEVELOPER               DATE           COMMENTS
#Vithursan Nagalingam    2022-12-09     Created account page
#Vithursan Nagalingam    2022-12-09     Added functionality that you must login to update the account
#Vithursan Nagalingam    2022-12-09     Added a pop up message if update was succesful


# Constants
define("FOLDER_FUNCTIONS", "commonFunctions/");
define("FILE_FUNCTIONS", FOLDER_FUNCTIONS . "PHPfunctions.php");

const OBJECTS_FOLDER2 = "objects/";
const OBJECT_CUSTOMER2 = OBJECTS_FOLDER2 . "customer.php";


require_once OBJECT_CUSTOMER2;
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
$updateConfirmation = "";

$errorsOccured = false;

pageTop("Update Account Page");

if(isset($_SESSION["loggedUser"]))
{
    $myCustomer = new customer();
$myCustomer->load($_SESSION["loggedUser"]);


if (isset($_POST["update_customer"]))
{
    $firstname = htmlspecialchars($_POST["firstname"]);
    $lastname = htmlspecialchars($_POST["lastname"]);
    $address = htmlspecialchars($_POST["address"]);
    $city = htmlspecialchars($_POST["city"]);
    $province = htmlspecialchars($_POST["province"]);
    $postalcode = htmlspecialchars($_POST["postalcode"]);
    $username = htmlspecialchars($_POST["username"]);
    $user_password = htmlspecialchars(password_hash($_POST["user_password"], PASSWORD_DEFAULT));
    
    
    // updating my customer object
    $myCustomer->setCustomerId($_SESSION["loggedUser"]);
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
        
        # update message
        $updateConfirmation = "Your account info has been updated!";
        
        # empty the fields
        $user_password = "";
    } 
    
}


?>
<h2 class="h2Form">Update Account</h2>
<span class="requiredText">* = required</span>
<div class="formContainer">
    <form method="POST" enctype="multipart/form-data">
        
        <p>
            <label>First Name:</label>
            <input type="text" name="firstname" value="<?php echo $myCustomer->getFirstname(); ?>"/>
            <span class="redText"><?php echo $validationErrorFirstname; ?>*</span>
        </p>
        <p>
            <label>Last Name:</label>
            <input type="text" name="lastname" value="<?php echo $myCustomer->getLastname(); ?>"/>
            <span class="redText"><?php echo $validationErrorLastname ?>*</span>
        </p>
        <p>
            <label>Address:</label>
            <input type="text" name="address" value="<?php echo $myCustomer->getAddress(); ?>"/>
            <span class="redText"><?php echo $validationErrorAddress; ?>*</span>
        </p>
        <p>
            <label>City:</label>
            <input type="text" name="city" value="<?php echo $myCustomer->getCity(); ?>"/>
            <span class="redText"><?php echo $validationErrorCity; ?>*</span>
        </p>
        <p>
            <label>Province:</label>
            <input type="text" name="province" value="<?php echo $myCustomer->getProvince(); ?>"/>
            <span class="redText"><?php echo $validationErrorProvince; ?>*</span>
        </p>
        <p>
            <label>Postal Code:</label>
            <input type="text" name="postalcode" value="<?php echo $myCustomer->getPostalcode(); ?>"/>
            <span class="redText"><?php echo $validationErrorPostalcode; ?>*</span>
        </p>
        <p>
            <label>Username:</label>
            <input type="text" name="username" value="<?php echo $myCustomer->getUsername(); ?>"/>
            <span class="redText"><?php echo $validationErrorUsername; ?>*</span>
        </p>
        <p>
            <label>Password:</label>
            <input type="password" name="user_password" value="<?php echo $user_password; ?>"/>
            <span class="redText"><?php echo $validationErrorPassword; ?>*</span>
        </p>
        
        <input class="submitbutton" type="submit" name="update_customer" value="Update info"/>
        
    </form>
    <p class="greenText"><?php echo $updateConfirmation; ?></p>
</div>
<?php
}
else
{
    loginAndLogout();
}



pageBottom();