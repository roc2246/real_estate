<?php 
$pageTitle = "New Property";
include 'include/header.php';
include 'include/connect.php';
include 'functions.php';
?>
<main>
    <h1>Upload A New Property</h1>
<?php 
createForm('listings', 'uploads', 'post', 
"enctype='multipart/form-data'", "uploads", 
"newProperty.php");
?>
<h4>Upload Status</h4>
<?php
uploadRecord('listings');
uploadImage('uploads');
checkTempLocation();
?>
</main>

<script src="validate.js"></script>
<?php include 'include/footer.php';?>
