<?php
include 'include/connect.php';

function getapi($table){
    global $connection;
    $sql = "SELECT * FROM $table";
    $response = array();
    $result = mysqli_query($connection, $sql);
      if($result){
        header("Content");
        $i = -1;
        while($row = mysqli_fetch_assoc($result) 
        && $fieldinfo = mysqli_fetch_field($result)){
            $i++;

            $fieldName = printf("%s\n", $fieldinfo -> name);
            //echo $fieldName;
            //echo $fieldinfo;
            $response[$fieldinfo[$i]] = $row['id'];  

           // echo $fieldinfo[$i];
            print_r(array_values($response));

            //Place $response in this while loop?

         //array_push($response, $row['id'], $row['image'], $row['adress'], $row['price']);
        //Insert more columns here
        }
        //echo json_encode($response, JSON_PRETTY_PRINT); 

    
   /*  if ($result) {
        // Get field information for all fields
        while ($fieldinfo = mysqli_fetch_field($result)) {
          printf("Name: %s\n", $fieldinfo -> name);
          echo "<br>";
          printf("Table: %s\n", $fieldinfo -> table);
          echo "<br>";
          printf("max. Len: %d\n", $fieldinfo -> max_length);
          echo "<br>";
        }
        mysqli_free_result($result);
      } */
    }
}


function sendEmail($mailTo){
    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $msg = $_POST['message']; 
        $msg = wordwrap($msg, 70);    
    
        $headers = "From: ". $email . "\r\n";
    
        mail($mailTo, $subject, $msg, $headers);
        echo "<h4 id='sent'>Email Sent</h4>";
    }
}

?>