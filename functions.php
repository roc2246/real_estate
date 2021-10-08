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
                echo "<label>" . $columns[$i] . "</label><br>";
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

/* <form name="uploads"  method="post" autocomplete="off">
       <label>Brand:</label>
        <input type="text" name="brand"><br><br>
       <label>Model:</label>
        <input type="text" name="model"><br><br>
       <label>Price:</label>
        <input type="text" name="price"><br><br>
       <label>Size:</label>
        <input type="text" name="size"><br><br>
       <label>Product Image:</label>
       <?php enableUpload();?>
<button type="submit" value="submit" name="submit">submit</button>
 
<div id="concept">
<h4>Upload Status</h4>
<?php invenProd(); checkTempLocation(); ?>
</div>

    </form> */
    ////


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