<?php 
include 'include/connect.php';
include 'functions.php';
createForm('listings', 'post', "enctype='multipart/form-data'");
?>
<h4>Upload Status</h4>
<?php
uploadRecord('listings');
uploadImage('uploads');
checkTempLocation();
?>