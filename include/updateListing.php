<?php 
include 'include/connect.php';
include 'functions.php';
?>
<!--Form -->
<?php 
createForm('listings', 'uploads', 'post', 
"enctype='multipart/form-data'", "uploads", 
"updateListing.php");
updateRecords('listings', 'updateListing.php');
?>


<script src="validate.js"></script>
