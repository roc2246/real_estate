<?php 
/* include 'include/connect.php';
include 'functions.php'; */
?>
<!--Form -->
<form name='uploads'  method='post' autocomplete='off' enctype='multipart/form-data'>
<label>Image</label><br>
<input type='file' name='image'><br><br>
<?php

include "include/connect.php"; // Using database connection file here
global $connection;
$sql = "SELECT * from listings";
$records = mysqli_query($connection, $sql); // fetch data from database

while($data = mysqli_fetch_array($records))
{
?>
<?php echo $data['id'] . "<br><br>";?>
<label>Adress</label><br><input type='text' name='adress' value='<?php echo $data['adress']; ?>'><br><br>
<label>Price</label><br><input type='text' name='price' value='<?php echo $data['price']; ?>'><br><br>
<?php 
break;
}
?>
<button type='submit' value='submit' name='submit' onclick='submitForm(uploads, "updateListing.php")'>submit</button></form>
<?php 
updateRecords('listings', 'index.php');
?>

