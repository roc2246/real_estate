<?php 

/** 
 * A page used to delete records
 * 
 * PHP version 7.4
 * 
 * @category Libraries
 * @package  Components
 * @author   Riley Childs <riley.childs@yahoo.com>
 * @license  Attribution-ShareAlike 4.0 International (CC BY-SA 4.0)
 * @link     http://wh963069.ispot.cc/projects/real_estate/include/delete.php
 */

require 'include/connect.php';
require 'include/phpCRUD.php';

deleteRows('listings', 'index.php');

?>

