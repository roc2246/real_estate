<?php $pageTitle = 'Home'; ?>
<?php include 'include/header.php';?>

<main>
    <h1>Contact Me</h1>
<div id="contact-info">

<div id="phone-adress">
<p>Riley Childs</p>  
<p>46 Snow Vidda Loop</p>  
<p>PO Box 1607</p>  
<p>West Dover, Vermont</p>  
<p>05356</p>  
</div>

<form name="contact" method="post">


<label for="email">Email</label>
<input type="email" name="email">
<br>
<label for="subject">Subject</label>
<input type="textbox" name="subject">
<br>
<label for="message">Message</label>
<br>
<textarea rows="15" cols="45" name="message"></textarea>
<br>
<button type="submit" value="Submit" name="submit" onclick="submitForm()">Submit</button>
<h4 id="sendMssg"></h4>
<?php 
if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $msg = $_POST['message']; 
    $msg = wordwrap($msg, 70);    

    $mailTo = "riley.childs@yahoo.com";
    $headers = "From: ". $email . "\r\n";

    mail($mailTo, $subject, $msg, $headers);
    echo "<h4 id='sent'>Email Sent</h4>";
}
?>
</form>
</div>
</main>
<script src = "validate.js"></script>
<?php include 'include/footer.php'; ?>

</body>
</html>