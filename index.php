<?php
#Revision history:
#
#DEVELOPER               DATE           COMMENTS
#Vithursan Nagalingam    2022-10-12     Made basic html for the index page 
#Vithursan Nagalingam    2022-10-14     Brief description of the company and added the logo of the company and the product pictures
#Vithursan Nagalingam    2022-10-15     Made an array to randomizes the pictures 
#Vithursan Nagalingam    2022-10-21     Made one of the pictures be twice the size and have a green border
#Vithursan Nagalingam    2022-12-18     Added my updated php cheat sheet version


# Constants
define("FOLDER_FUNCTIONS", "commonFunctions/");
define("FILE_FUNCTIONS", FOLDER_FUNCTIONS . "PHPfunctions.php");

define("FOLDER_PICTURES", "pictures/");
define("FILE_BLENDER", FOLDER_PICTURES . "blender.jpg");
define("FILE_GYMMAT", FOLDER_PICTURES . "gymmat.jpg");
define("FILE_GYMSET", FOLDER_PICTURES . "gymset.jpg");
define("FILE_PROTEINSHAKE", FOLDER_PICTURES . "proteinshake.jpg");
define("FILE_TANKTOP", FOLDER_PICTURES . "tanktop.jpg");

define("FOLDER_SALES", "sales/");
define("File_PHPCheatSheet", FOLDER_SALES . "PHP_Cheat_Sheet.docx");


require_once FILE_FUNCTIONS;

pageTop("Home Page");

$pictures = array(FILE_BLENDER, FILE_GYMMAT, FILE_GYMSET, FILE_PROTEINSHAKE, FILE_TANKTOP);

# Randomizes the pictures
shuffle($pictures);

$picture2x = $pictures[0] == FILE_GYMSET ? 'productImg2xSize':'productImages';

?>


<p>
    <h1>Gym Expert</h1>
    
    <strong>Gym Expert</strong> is a company where it encourages its customers to live a healthy lifestyle. 
    The company sells different type of products such as gym equipments, protein shakes and all gym related accessories.
    We want our clients to exercises everyday so they can live for a very long time.
</p>

<section>
    <h2>Advertising</h2>
    <a href="https://www.google.com/"><img class="<?php
    
                                                     if (isset($_GET["action"]) && strtoupper(htmlspecialchars($_GET["action"])) == strtoupper("print")) {
                                                         echo "productImagesLessOpacity";
                                                     }
                                                     else {
                                                         echo $picture2x;
                                                     }
                                                        
                                                  ?>" src="<?php echo $pictures[0]; ?>" alt="Random products"/></a>
</section>

<p><a href="<?php echo File_PHPCheatSheet; ?>" download>Download my PHP cheat sheet</a></p>

<?php


pageBottom();