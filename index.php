<?php $pageTitle = 'Home'; ?>
<?php include 'include/header.php';?>
<!--
  Elements used for later or debugging
<button onclick="slideshow()">TEST</button>
<p id="timer"></p>

-->
<main>
<h1>Your new dream home awaits...</h1>
<!------------------------------------------->
<div id="slideshow"></div>
<script src="slideshow.js"></script>

<!-------------------------------------------->
<div id="listings">
<h1>Check Out Our Listings!</h1>    
<script src="async.js"></script>
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
              if("image" in data[x]){  
                listings.innerHTML += 
                "<img width='100px' height='100px' src='uploads/" + data[x].image + "'><br>";
              }
               for(let i =0; i<=keys.length; i++){
                  listings.innerHTML += 
                  "<p>"+ keys[i]+": " + data[x].adress+ "</p>" +
                  "<p>"+ keys[i+1] +": $" + data[x].price+ "</p>";
                  break;
                }
            }
            
}); 

</script>
</div>
<!--------------------------------------------->
<div id="contact">
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
  <button type="submit" value="Submit" name="submit" onclick="submitForm(contact, 'contact.php')">Submit</button>
  <?php 
    include 'functions.php';
    $userEmail = "riley.childs@yahoo.com";
    sendEmail($userEmail);
  ?>
</form>
</div>
<script src = "validate.js"></script>
</div>
<!--------------------------------------------->
</main>


<?php include 'include/footer.php'; ?>

</body>
</html>