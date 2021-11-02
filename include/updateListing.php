<form name='editListing'  method='post' autocomplete='off' enctype='multipart/form-data'>
    <input type='hidden' name='id'><br><br>
<label>Image</label><br>
<input type='file' name='image'><br><br>
<label>Adress</label><br>
<input type='text' name='adress'><br><br>
<label>Price</label><br>
<input type='text' name='price'><br><br>

<button type='submit' value='submit' name='submit2' onclick='submitForm(editListing, "index.php")'>submit</button></form>
<script src="validate.js"></script>
<?php 
updateRecords('listings', 'index.php');
?>

