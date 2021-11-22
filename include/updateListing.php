<?php 

/** 
 * A form used to update real estate listings
 * 
 * PHP version 7.4
 * 
 * @category Libraries
 * @package  Components
 * @author   Riley Childs <riley.childs@yahoo.com>
 * @license  Attribution-ShareAlike 4.0 International (CC BY-SA 4.0)
 * @link     http://wh963069.ispot.cc/projects/real_estate/include/updateListing.php
 */

require 'include/connect.php';
require 'functions.php';
?>
<!--Form -->
<?php 
createForm(
    'listings', 'uploads', 'post', 
    "enctype='multipart/form-data'", "updateListing.php"
);
updateRecords('listings', 'updateListing.php');
?>


<script src="validate.js"></script>
