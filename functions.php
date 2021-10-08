<?php
include 'include/connect.php';

function getapi($table){
    global $connection;
    $sql = "SELECT * FROM $table";
    $result = mysqli_query($connection, $sql);
      if($result){
        header("Content");
        while($row = mysqli_fetch_assoc($result)){
            $response = array();
             $columns =  array_keys($row);
            for($i = 0; $i<count($row); $i++){
<<<<<<< HEAD
                $response[$columns[$i]] = $row[$columns[$i]];
            }
        echo json_encode($response, JSON_PRETTY_PRINT) . "<br>"; 
=======
                array_push($response, $row[$columns[$i]]);
            }
>>>>>>> 59be3fb7d0486a0cfe1f7b87635a275a3f32645d
        }
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