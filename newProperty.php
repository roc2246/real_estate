<?php 
include 'include/connect.php';
include 'functions.php';
createForm('listings', 'uploads', 'post', "enctype='multipart/form-data'", "uploads", "newProperty.php");
?>
<h4>Upload Status</h4>
<?php
uploadRecord('listings');
uploadImage('uploads');
checkTempLocation();
?>
<script src="validate.js"></script>
<script>
//for use in php for debugging purposes    
//onclick='submitForm(uploads, ". "\"newProperty.php\"" .")'

    if (document.readyState === 'complete') { 
        console.log(document.getElementById("submit"));
    }
    
</script>
