<?php 
include 'include/connect.php';
include 'include/phpCRUD.php';
include 'include/images.php';
global $connection;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="#">
    <title>Listings</title>
    <script src="async.js"></script>
</head>
<body>

<header>
  <h1>Check Out Our Listings!</h1>    
</header>

<main>
  <div id="listings">
  </div>
  <script>
    loadJSONdata('listings-api.php','GET').then(data => {
      let keys = [];
      function ObjectKey(object){
        Object.keys(object).forEach(key => {
          if(typeof object[key] === 'object'){
            ObjectKey(object[key]); 
          } else {
            if(key ==='id' || key==='image'){
              return;
            }else{
              keys.push(key.charAt(0).toUpperCase() + key.slice(1));
            }
          }
        });
      }

      ObjectKey(data);

      const listings = document.getElementById("listings");
          
      for(let x in data){
        listings.innerHTML += "<div class='listing'>"+
                              "<img width='100px' height='100px' src='uploads/" +
                              data[x].image + 
                              "'><br>"+
                              <?php
                                $sql = "SELECT * FROM listings";
                                $records = mysqli_query($connection ,$sql); 
                                while($results = mysqli_fetch_array($records)){
                              ?>
                              "<p>"+ keys[0]+": " + data[x].adress+ "</p>" +
                              "<p>"+ keys[1] +": $" + data[x].price+ "</p>"+
                              "<p style ='color:blue;cursor: pointer' onclick = 'edit()' >Edit</p>"+
                              "<p><a href = 'delete.php?id=" + data[x].id +"'>Delete</a>"+
                              "</div>";
                              <?php
                                }
                              ?>
       }
   }); 
</script>
<button id="open-new-property">Add New Property</button>

<div id="new-property">

<div id="new-property-form">
<span id="close-new-property" >&times;</span>
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

<!--For Updating Listings-->
<div id="update-listing" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <?php include 'include/updateListing.php'?>
    <script>
    loadJSONdata('listings-api.php','GET').then(data => {
      for(let i=0; i<data.length; i++){  
        const listing = document.getElementsByClassName("listing");
          listing[i].addEventListener("click", ()=>{
          document.editListing.id.value = data[i].id;
          document.editListing.adress.value = data[i].adress;
          document.editListing.price.value = data[i].price;
        });
      }
    });
    </script>
  </div> 
</div>

<script>
  //Prevents A new listing from being creaqted upon submission
  if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }

  //For use with 'new property' form
  const form = document.getElementById("new-property-form");
  const openNewProperty = document.getElementById("open-new-property");
  const span2 = document.getElementById("close-new-property");
  form.style.display = "none";
  openNewProperty.onclick = ()=>{
      form.style.display = "block";
      openNewProperty.style.display = "none";
      }
  span2.onclick =()=> {
    form.style.display = "none";
    openNewProperty.style.display = "block";
  }

  //For use with 'edit listing' popup window
  const updateListing = document.getElementById("update-listing");
  const span = document.getElementsByClassName("close")[0];

  function edit() {
    updateListing.style.display = "block";
  }

  span.onclick =()=> {
    updateListing.style.display = "none";
  }

  window.onclick =(event)=> {
    if (event.target == updateListing) {
      updateListing.style.display = "none";
    }
  }
</script>

</main>

<footer>
  <!--Insert Footer Here-->
</footer>
<script src="validate.js"></script>

</body>
</html>