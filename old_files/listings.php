<?php $pageTitle = 'listings'; ?>
<?php include 'include/header.php';?>

<main>
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
            const main = document.getElementsByTagName("main")[0];
          
            for(let x in data){
              if("image" in data[x]){  
                main.innerHTML += 
                "<img width='100px' height='100px' src='uploads/" + data[x].image + "'><br>";
              }
               for(let i =0; i<=keys.length; i++){
                  main.innerHTML += 
                  "<p>"+ keys[i]+": " + data[x].adress+ "</p>" +
                  "<p>"+ keys[i+1] +": $" + data[x].price+ "</p>";
                  break;
                }
            }
            
}); 

</script>

</main>

<?php include 'include/footer.php'; ?>

</body>
</html>