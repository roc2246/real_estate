<?php 
if ($_SERVER['HTTP_HOST'] == 'localhost'){
  $servername = 'localhost';
  $username = 'root';
  $password = 'root';
  $database = 'real_estate';
} else if ($_SERVER['HTTP_HOST'] == 'roc09090.classweb.ccv.edu'){
  $servername = 'localhost';
  $username = 'roc09090';
  $password = 'je5umyju5';
  $database = 'roc09090_wordpress';
} else {
  $servername = 'localhost';
  $username = 'rChilds';
  $password = 'XXSBVxuc';
  $database = 'childswe_realEstate';
}



 $connection = mysqli_connect($servername, $username, $password, $database);  
 if(!$connection) {
     die("Database connection failed");
 }


?>