<?php 
include 'include/connect.php';
include 'functions.php';
?>
<div id="new-property-form">
    <h1>Upload A New Property</h1>
<?php 
createForm('listings', 'uploads', 'post', 
"enctype='multipart/form-data'", "uploads", 
"index.php");
?>
<h4>Upload Status</h4>
<?php
uploadRecord('listings');
uploadImage('uploads');
checkTempLocation();
?>
</div>

<script src="validate.js"></script>
