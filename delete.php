<?php
function deleteRows($table) {
  global $connection;
     $ID = $_GET['id'];
     $query = "DELETE FROM $table WHERE id = '$ID' ";
    $result = mysqli_query($connection, $query);
        if(!$result) {
          die("QUERY FAILED" . mysqli_error($connection));    
        }else {
           echo "Record Deleted"; 
       header('Refresh: 1');
       }
  }
  ?>