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
    <!--Listings data will go here once the API is fetched-->
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
        if(typeof data[x] == 'undefined'){
          listings.innerHTML = '';
        }else{
        listings.innerHTML += "<div class='listing'>"+
                              "<img class='listing-photo' width='100px' height='100px' src='uploads/" + data[x].image + "'><br>"+                   
                              "<p class='info'>"+ "<span class='key'>"+keys[0]+"</span>"+": " + data[x].adress+ "</p>" +
                              "<p class='info'>"+  "<span class='key'>"+keys[1] +"</span>"+": $" + data[x].price+ "</p>"+
                              "<p class='listing-manage' onMouseOver=\"this.style.color='red'\"  onMouseOut=\"this.style.color='blue'\" style ='color:blue;cursor: pointer' onclick = 'edit()' >Edit</p>"+
                              "<p class='listing-manage' onMouseOver=\"this.style.color='red'\"  onMouseOut=\"this.style.color='blue'\" style ='color:blue;cursor: pointer' onclick='youSure("+data[x].id+");'>Delete</p>"+
                              "</div>";                 
       }
      }
   }); 
</script>
<button id="open-new-property">Add New Property</button>

<!--Add new property form -->
<div id="new-property">
  <div id="new-property-form">
    <div id="new-property-upper">
      <span id="close-new-property" >&times;</span>
      <h1>Upload A New Property</h1>
    </div>
    <div id="new-property-center">
      <form name='uploads'  method='post' autocomplete='off' enctype='multipart/form-data'>
      <label>Image</label><br>
        <?php enableUpload();?>
      <label>Adress</label><br>
        <input type='text' name='adress'><br><br>
      <label>Price</label><br>
          <input type='text' name='price'><br><br>
      <button class='center-btn' type='submit' value='submit' name='submit' onclick='submitForm(uploads, "index.php")'>submit</button>
    </form>
  <h4>Upload Status</h4>
  <?php uploadRecord('listings'); uploadImage('uploads'); checkTempLocation(); ?>
 </div>
  </div>
</div>

<!--For Updating Listings-->
<div id="update-listing" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <form name='editListing'  method='post' autocomplete='off' enctype='multipart/form-data'>
      <input type='text' name='id' hidden><br>
    <label>Image</label><br>
      <?php enableUpload();?>
    <label>Adress</label><br>
      <input type='text' name='adress'><br><br>
    <label>Price</label><br>
      <input type='text' name='price'><br><br>
    <button type='submit' value='submit' name='submit2' onclick='submitForm(editListing, "index.php")'>submit</button></form>
    <?php updateRecords('listings', 'index.php'); checkTempLocation();?>
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
  //Pulls up a confirm box if the delete button is clicked
  function youSure(url){
    const confirmBox = confirm("Are you sure you want to delete this listing?");
      if (confirmBox==true){
        location.replace('delete.php?id=' + url);
      }
  }

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