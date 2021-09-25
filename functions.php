<?php
include 'include/connect.php';

function api($table){
    global $connection;
    $sql = "select * from" . $table;
    $response = array();
    $result = mysqli_query($connection, $sql);
    if($result){
        header("Content");
        $i = 0;
        while($row = mysqli_fetch_assoc($result)){
        $response[$i]['id'];
        //Insert more columns here
        }
        echo json_encode($response, JSON_PRETTY_PRINT);
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