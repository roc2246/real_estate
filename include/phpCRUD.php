<?php 
include 'include/connect.php';
global $connection;

//Callback functions for CRUD operations
function getFieldNames($table){
  global $connection;
  $sql = "SELECT * FROM $table";
  $result = mysqli_query($connection, $sql);
  $row = mysqli_fetch_assoc($result);
  if(count($row) >= 0){
    $query = "SHOW COLUMNS FROM $table";
    $res2 = mysqli_query($connection, $query);
    $fieldNames = array();
    while($row = mysqli_fetch_assoc($res2)){
      if ($row['Field'] == 'id'){
        continue;
      }else{
        array_push($fieldNames, $row['Field']);
        }
    }
    return implode(",", $fieldNames);
  }
}
  
function getFieldValues($table){
  global $connection;
  $sql = "SELECT * FROM $table";
  $result = mysqli_query($connection, $sql);
  $row = mysqli_fetch_assoc($result);
  if(count($row) >= 0){
    $query = "SHOW COLUMNS FROM $table";
    $res2 = mysqli_query($connection, $query);
    $values = array();
    $fieldNames = explode(",",getFieldNames($table));
    while($row = mysqli_fetch_assoc($res2)){
      if ($row['Field'] == 'image'){
      array_push($values, $_FILES["image"]["name"]);
      }
    }
  }
  for($i=0; $i<count($fieldNames); $i++){
    if($fieldNames[$i]=='image'){
      continue;
    }else{
      array_push($values, $_POST[$fieldNames[$i]]);
    }
  }
  $values = implode("','", $values);
  return $values;
}
/////////////////////////////////////////////////////

function uploadRecord($table){
  if(isset($_POST['submit'])) {
  global $connection;
  $query = "INSERT INTO $table(".getFieldNames($table).") VALUES ('".getFieldValues($table)."')";
  if (mysqli_query($connection, $query)) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $query . "<br><br>" . mysqli_error($connection)."<br><br>";
  }
  }
}
  
function updateRecords($table, $redirect) {
  if(isset($_POST['submit2'])) {  
    global $connection;
    getFieldNames($table);
    getFieldValues($table);
      
    $fieldNames = explode(",", getFieldNames($table));
    $fieldValues = explode(",", getFieldValues($table));
  
    $ID = $_POST['id'];
    
    $query = "UPDATE $table SET ";
    for($i=0; $i<count($fieldNames); $i++){
      if($fieldNames[$i] == end($fieldNames)){
        $query .= "$fieldNames[$i] = $fieldValues[$i]'  ";
      }else if($i == 0){
        $query .= "$fieldNames[$i] = '$fieldValues[$i],  ";
      }else{
        $query .= "$fieldNames[$i] = $fieldValues[$i], ";
      }
    }
    $query .= "WHERE id = '$ID'";
  
    $result = mysqli_query($connection, $query);
      if(!$result) {
        die("QUERY FAILED" . mysqli_error($connection)); 
      }else {
        header('location:'.  $redirect);
      }
    }   
}
  
  
function deleteRows($table, $redirect) {
  global $connection;
  $ID = $_GET['id'];
  $query = "DELETE FROM $table WHERE id = '$ID' ";
  $result = mysqli_query($connection, $query);
    if(!$result) {
      die("QUERY FAILED" . mysqli_error($connection));    
    }else {
      echo "Record Deleted"; 
      header('location:'.  $redirect);
    }
}
  
  
  function getapi($table){
      header('Content-type: application/json');
      global $connection;
      $sql = "SELECT * FROM $table";
      $result = mysqli_query($connection, $sql);
        if($result){
          header("Content");
          $json =  "[";
          while($row = mysqli_fetch_assoc($result)){
              $response = array();
               $columns =  array_keys($row);
              for($i = 0; $i<count($row); $i++){
                  $response[$columns[$i]] = $row[$columns[$i]];
              }
              $json .= json_encode($response, JSON_PRETTY_PRINT) . ",";
              
          }
          $json = rtrim($json, ",");
          $json .= "]";
    }
    echo $json;
  }
  


  //Callback for createForm()
  function enableUpload(){
    if(sys_get_temp_dir() != '/tmp'){
      echo "<input type='file' name='image'><br><br>";
       } else {
      echo "<input type='file' name='image' disabled><br><br>";
       }
  }

  function createForm($table, $name, $method, $other_attributes, $formName, $refreshTo){
    global $connection;
    $sql = "SELECT * FROM $table";
    $result = mysqli_query($connection, $sql);
      if($result){
        header("Content");
        $row = mysqli_fetch_assoc($result);
        if(count($row) >= 0){
          $query = "SHOW COLUMNS FROM $table";
          $res2 = mysqli_query($connection, $query);
          $fieldNames = array();
          while($row = mysqli_fetch_assoc($res2)){
            array_push($fieldNames, $row['Field']);
            
        }
        echo "<form name='".$name."'  method='".$method."' autocomplete='off' $other_attributes>";
        for($i = 1; $i<count($fieldNames); $i++){
          echo "<label>" . ucfirst($fieldNames[$i]) . "</label><br>";
          if($fieldNames[$i] == 'image'){
            enableUpload();
          } else {
            echo "<input type='text' name='" .$fieldNames[$i] . "'><br><br>";
          }
        }
        echo "<button type='submit' value='submit' name='submit' onclick='submitForm(". $formName. ", ". "\"".$refreshTo."\"" .")'>submit</button>";
        echo "</form>";
        } 
      }else{
          echo "<h1>ERROR</h1>";
      }

  }

//IMAGES
  function uploadImage($folder){
    $target_dir = "$folder/";
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

function checkTempLocation(){
    if (sys_get_temp_dir() == '/tmp'){
      echo "<h4>Sorry, image uploading is down for maintenance.</h4>";
    }
  }
  

?>