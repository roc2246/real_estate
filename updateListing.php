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
<!--Select Data to Update-->
<select id="ID" name="ID">
    <?php showAllData('listings');?>
  </select>
<!--Assign Data to fields to update-->

<script>
  //For assigning values to textboxes
  let totalOptions = document.getElementById("ID").options;
    function option(optNo, strNo){
    return totalOptions.item(optNo).text.split(" - ")[strNo];
    }

  function displayOption(opt){
    document.uploads.adress.value = option(opt, 1);
    document.uploads.price.value = option(opt, 2);
  }


 document.getElementById("ID").onchange = () => {
     displayOption(document.getElementById("ID").selectedIndex);
 }
</script>
<!--Form Validation-->
<script src="validate.js"></script>
