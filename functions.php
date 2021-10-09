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
                $response[$columns[$i]] = $row[$columns[$i]];
            }
        echo json_encode($response, JSON_PRETTY_PRINT) . "<br>"; 
        }
  }
}

//Add to ASSETS later
function createForm($table){
    global $connection;
    $sql = "SELECT * FROM $table";
    $result = mysqli_query($connection, $sql);
      if($result){
        header("Content");
        while($row = mysqli_fetch_assoc($result)){
             $columns =  array_keys($row);
             echo "<form name='uploads'  method='post' autocomplete='off'>";
            for($i = 1; $i<count($columns); $i++){
                echo "<label>" . ucfirst($columns[$i]) . "</label><br>";
                if($columns[$i] == 'image'){
                    enableUpload();
                } else {
                    echo "<input type='text' name='" .$columns[$i] . "'><br><br>";
                }
            }
            echo "<button type='submit' value='submit' name='submit'>submit</button>";
            echo "</form>";
            break;
        }
  }
}

function enableUpload(){
    if(sys_get_temp_dir() != '/tmp'){
      echo "<input type='file' name='image'><br><br>";
       } else {
      echo "<input type='file' name='image' disabled><br><br>";
       }
  }

    function uploadImage(){
        $target_dir = "uploads/";//create 'uploads' folder
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
          $check = getimagesize($_FILES["image"]["tmp_name"]);
        if($check !== false) {
          echo "<br><br>File is an image - " . $check["mime"] . ".<br><br>";
          $uploadOk = 1;
        } else {
          echo "File is not an image.<br><br>";
          $uploadOk = 0;
      
          }
        }
      
        // Check file size
        if ($_FILES["image"]["size"] > 500000) {
          echo "Sorry, your file is too large.<br><br>";
          $uploadOk = 0;
        }
      
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" && isset($_POST['image'])) {
          echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br><br>";
          $uploadOk = 0;
        }
      
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
          echo "Sorry, your file was not uploaded.<br><br>";
        // if everything is ok, try to upload file
        } else {
          if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
          echo "The file ". htmlspecialchars( basename( $_FILES["image"]["name"])). " has been uploaded.<br><br>";
        } else if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file) && isset($_POST['image'])){
          echo "Sorry, there was an error uploading your file.<br><br>";
          }
        }
    }

    function uploadRecord($table){
        if(isset($_POST['submit'])) {
        global $connection;
        
        //For use in query
        function getFieldNames($table){
          global $connection;
          $sql = "SELECT * FROM $table";
          $result = mysqli_query($connection, $sql);
          while($row = mysqli_fetch_assoc($result)){
            $columns =  array_keys($row);
            $fieldNames = array();
          }
          for($i = 1; $i<count($columns); $i++){
           array_push($fieldNames, $columns[$i]);
        }
        return implode(",", $fieldNames);
    }
        //For use in query
        function getFieldValues($table){
          global $connection;
          $sql = "SELECT * FROM $table";
          $result = mysqli_query($connection, $sql);
          while($row = mysqli_fetch_assoc($result)){
            $columns =  array_keys($row);
            $values = array();
          }
          for($i = 1; $i<count($columns); $i++){
           if ($columns[$i] == 'image'){
            array_push($values, '\'".$_FILES["image"]["name"]."\'');
           }else{
             array_push($values, '\'".$_POST["'.$columns[$i].'"]."\'');
           }
        }
        return implode(",", $values);
    }
   echo getFieldValues($table) . "<br><br>";
      //THIS WORKS
//'".$_FILES["image"]["name"]."','".$_POST["adress"]."','".$_POST["price"]."'

//COMPARE TO
//'".$_FILES["image"]["name"]."','".$_POST["adress"]."','".$_POST["price"]."'
//VALUES ('".$_FILES["image"]["name"]."','".$_POST["adress"]."','".$_POST["price"]."')


   // $striceMode = "SET SESSION sql_mode = ''";

      $query = "INSERT INTO $table(" . getFieldNames($table) .") VALUES (".getFieldValues($table).")";
            if (mysqli_query($connection, $query)) {
              echo "New record created successfully";
            } else {
              echo "Error: " . $query . "<br>" . mysqli_error($connection);
            }

          }
        }

    //////////////////////


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