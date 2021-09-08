<?php $pageTitle = 'Home'; ?>
<?php include 'include/header.php';?>
<!--
<h1>Your new dream home awaits...</h1>

-->
<button onclick="changeImage()">TEST</button>

<main>
<div id="changing-image4">
</div>
<div id="changing-image3">
</div>
<div id="changing-image2">
</div>
<div id="changing-image">
</div>

</main>


<script>
var images = [];
var time = 5;

images[0] = "glasses-and-hat.jpg";
images[1]= "5-1ANSWERS.png";
images[2] = "5-2ANSWERS.png";
images[3] = "5-3ANSWERS.png";

document.getElementById("changing-image").style.backgroundImage = "url(background-images/"+images[0] +")";
document.getElementById("changing-image2").style.backgroundImage = "url(background-images/"+images[1] +")";
document.getElementById("changing-image3").style.backgroundImage = "url(background-images/"+images[2] +")";
document.getElementById("changing-image4").style.backgroundImage = "url(background-images/"+images[3] +")";

 const changeImage = () =>{
    let id=null;
    const elem = document.getElementById("changing-image");
    const elem2 = document.getElementById("changing-image2");
    const elem3 = document.getElementById("changing-image3");
    const elem4 = document.getElementById("changing-image4");
    let pos = 0;
    let pos2 = -500;
    let pos3 = -1000;
    let pos4 = -1500;
    elem2.style.left = pos2 + "px";
    elem3.style.left = pos2 + "px";
    elem4.style.left = pos2 + "px";
    //Tracks width of images
    var w = elem.offsetWidth;
    var w2 = elem2.offsetWidth;
    var w3 = elem3.offsetWidth;
    var w4 = elem4.offsetWidth;
    var vanishPoint = 1527;
   clearInterval(id);
   id = setInterval(frame, time);
    function frame(){
       // if (pos == 2000 && pos2 ==1500 && pos3==1000 && pos4==500) {
    //  clearInterval(id);
   // } else {
      if (pos >vanishPoint){
        w--;
        elem.style.width = w + "px";
        if(w==0){
        elem.remove();
        }
      }
      if (pos2 >vanishPoint){
        w2--;
        elem2.style.width = w2 + "px";
        if(w2==0){
        elem2.remove();
        }
      }
      if (pos3 >vanishPoint){
        w3--;
        elem3.style.width = w3 + "px";
        if(w3==0){
        elem3.remove();
        }
      }
      if (pos4 >vanishPoint){
        w4--;
        elem4.style.width = w4 + "px";
        if(w4==0){
        elem4.remove();
        }
      }
      pos++; 
      pos2++; 
      pos3++; 
      pos4++; 
      //Sets position of each photo
      elem.style.left = pos + "px";
      elem2.style.left = pos2 + "px";
      elem3.style.left = pos3 + "px";
      elem4.style.left = pos4 + "px";
    }

}
 //}


</script>
<?php include 'include/footer.php'; ?>

</body>
</html>