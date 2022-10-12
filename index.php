<?php

# Constants
define("FOLDER_FUNCTIONS", "commonFunctions/");
define("FILE_FUNCTIONS", FOLDER_FUNCTIONS . "PHPfunctions.php");

require_once FILE_FUNCTIONS;

pageTop("Home Page");

echo "hello";

pageBottom();