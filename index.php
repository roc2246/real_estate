<?php $pageTitle = 'Home'; ?>
<?php include 'include/header.php';?>
<main>
<br>
<script src="async.js"></script>
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
                "<img width='100px' height='100px' src='uploads/" + data[x].image + "'><br>"+
                  "<p>"+ keys[0]+": " + data[x].adress+ "</p>" +
                  "<p>"+ keys[1] +": $" + data[x].price+ "</p>"+
                  "</div>";
            }

            console.log(keys);
}); 

</script>
<button id="button">Add New Property</button>

<div id="new-property">

  <?php include 'include/newProperty.php' ?>
  <script>
    const form = document.getElementById("new-property-form");
    form.style.display = "none";
    document.getElementById("button").onclick = ()=>{
      form.style.display = "block";
    }
  </script>
</div>
</main>


<?php include 'include/footer.php'; ?>

</body>
</html>