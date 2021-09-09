<?php $pageTitle = 'Home'; ?>
<?php include 'include/header.php';?>
<!--
<h1>Your new dream home awaits...</h1>

-->
<button onclick="changeImage()">TEST</button>

<main>
</main>


<script>
var images = [];

//Stores images for slideshow
images[0] = "glasses-and-hat.jpg";
images[1] = "5-1ANSWERS.png";
images[2] = "5-2ANSWERS.png";
images[3] = "5-3ANSWERS.png";

//Creates elements for each slideshow image
for (let i=0; i<images.length; i++){
    const image = document.createElement("div");
    image.className = "changing-image";
    image.style.backgroundImage = "url(background-images/"+images[i] +")";
    document.getElementsByTagName("main")[0].appendChild(image);  
}

const changeImage = () =>{
  const elem = document.getElementsByClassName("changing-image");
  var vanishPoint = 1400;
  var time = 5;
  var w= [];
  //Initial position of eack element
  var pos = [];
  pos[0] = 0;
  pos[1] = -1000;
  pos[2] = -2000;
  pos[3] = -3000; 
  /////////////////////////////////
  for (let i = 0; i<elem.length; i++){
    //Assignes order for images in slideshow
    elem[i].style.left = pos[i] + "px";
    //Tracks width of images
    w.push(elem[i].offsetWidth);
  }
  setInterval(frame, time);
    function frame(){
      //Makes images dissapear as they move right in the slideshow
      for (let i = 0; i<elem.length; i++){
        //Shrinks images as they move past vanishing point
        if (pos[i] >vanishPoint){
          w[i]--;
          elem[i].style.width = w[i] + "px";
        }
          //Moves images through slideshow
          pos[i]++;
          elem[i].style.left = pos[i] + "px"
      }
    }
}

</script>
<?php include 'include/footer.php'; ?>

</body>
</html>