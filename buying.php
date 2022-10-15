<?php
# Constants
define("FOLDER_FUNCTIONS", "commonFunctions/");
define("FILE_FUNCTIONS", FOLDER_FUNCTIONS . "PHPfunctions.php");

require_once FILE_FUNCTIONS;

pageTop("Buying Page");
?>
<div class="formContainer">
    <form>
        <p>
            <label>Product code</label>
            <input type="text" name="Product code"/>
        </p>

        <p>
            <label>Customer first name</label>
            <input type="text" name="fname"/>
        </p>

        <p>
            <label>Customer last name</label>
            <input type="text" name="lname"/>
        </p>

        <p>
            <label>Customer City</label>
            <input type="text" name="city"/>
        </p>

        <p>
            <label>Comments</label>
            <input type="text" name="comment"/>
        </p>

        <p>
            <label>Price</label>
            <input type="text" name="price"/>
        </p>

        <p>
            <label>Quantity</label>
            <input type="text" name="quantity"/>
        </p>

        <input type="submit" value="Submit" name="buy"/>
    </form>
</div>

<?php
pageBottom();
