<?php 
if ($_SERVER['HTTP_HOST'] == 'localhost'){
  $servername = 'localhost';
  $username = 'root';
  $password = 'root';
  $database = 'ecommerce';
} else if ($_SERVER['HTTP_HOST'] == 'roc09090.classweb.ccv.edu'){
  $servername = 'localhost';
  $username = 'roc09090';
  $password = 'je5umyju5';
  $database = 'roc09090_wordpress';
} else {
  $servername = '';
  $username = '';
  $password = '';
  $database = '';
}



 $connection = mysqli_connect($servername, $username, $password, $database);  
 if(!$connection) {
     die("Database connection failed");
 }


?>