<?php
#Revision history:
#
#DEVELOPER              DATE            COMMENTS
#Vithursan Nagalingam   2022-11-22      Created the code for connecting to the database


// Constants
define("serverName", "mysql:host=localhost;dbname=database2135106");
define("serverUser", "root");
define("serverPassword", "1234");

// Connection to the database
$connection = new PDO(serverName, serverUser, serverPassword);

// Make sure all unexpected problem throws expections (....handlers)
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// protect against SQL injections
$connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);


