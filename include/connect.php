<?php 

/** 
 * Connection parameters for Real_Estate API
 * 
 * PHP version 7.4
 * 
 * @category Libraries
 * @package  Pages
 * @author   Riley Childs <riley.childs@yahoo.com>
 * @license  Attribution-ShareAlike 4.0 International (CC BY-SA 4.0)
 * @link     http://wh963069.ispot.cc/projects/real_estate/include/connect.php
 */

if ($_SERVER['HTTP_HOST'] == 'localhost') {
    $servername = 'localhost';
    $username = 'root';
    $password = 'root';
    $database = 'real_estate';
} else if ($_SERVER['HTTP_HOST'] == 'roc09090.classweb.ccv.edu') {
    $servername = 'localhost';
    $username = 'roc09090';
    $password = 'je5umyju5';
    $database = 'roc09090_wordpress';
} else if ($_SERVER['HTTP_HOST'] == 'wh963069.ispot.cc') {
    $servername = 'wh963069.ispot.cc';
    $username = 'childswe_realEstate';
    $password = 'XXSBVxuc';
    $database = 'childswe_realEstate';
}



 $connection = mysqli_connect($servername, $username, $password, $database);  
if (!$connection) {
     die("Database connection failed");
}


?>