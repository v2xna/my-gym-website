<?php

# Constants
define("FOLDER_FUNCTIONS", "commonFunctions/");
define("FILE_FUNCTIONS", FOLDER_FUNCTIONS . "PHPfunctions.php");

define("FOLDER_PICTURES", "pictures/");
define("FILE_BLENDER", FOLDER_PICTURES . "blender.jpg");
define("FILE_GYMMAT", FOLDER_PICTURES . "gymmat.jpg");
define("FILE_GYMSET", FOLDER_PICTURES . "gymset.jpg");
define("FILE_PROTEINSHAKE", FOLDER_PICTURES . "proteinshake.jpg");
define("FILE_TANKTOP", FOLDER_PICTURES . "tanktop.jpg");

require_once FILE_FUNCTIONS;


pageTop("Home Page");

$pictures = array(FILE_BLENDER, FILE_GYMMAT, FILE_GYMSET, FILE_PROTEINSHAKE, FILE_TANKTOP);

# Randomizes the pictures
shuffle($pictures);

?>


<p>
    <h1>Gym Is Life</h1>
    
    <strong>Gym Is Life</strong> is a company where it encourages its customers to live a healthy lifestyle. 
    The company sells different type of products such as gym equipments, protein shakes and all gym related accessories.
    We want our clients to exercises everyday so they can live for a long time.
</p>

<section>
    <h2>Advertising</h2>
    <a href="https://www.google.com/"><img class="productImages" src="<?php echo $pictures[0]; ?>" alt="Random products"/></a>
</section>

<?php


pageBottom();