<?php $pageTitle = 'Home'; ?>
<?php include 'include/header.php';?>
<!--
<h1>Your new dream home awaits...</h1>

-->
<button onclick="changeImage()">TEST</button>

<main>
</main>


<script>
//Stores variables to manage slideshow
var vanishPoint = 0;
var time = 1;
var imgWidth = 1905;
var lastPic = -5600;
var w= [];//stores width of each image

//stores initial position of each image
var pos = [];
pos[0] = 0;
pos[1] = -1800;
pos[2] = -3700;
pos[3] = lastPic; 

//Stores images for slideshow
var images = [];
images[0] = "1.png";
images[1] = "2.png";
images[2] = "3.png";
images[3] = "4.png";

//Stores slideshgow image containers
const elem = document.getElementsByClassName("changing-image");

//Creates new image
const newImg = (no) => {
    const image = document.createElement("div");
    image.className = "changing-image";
    image.style.backgroundImage = "url(background-images/"+images[no] +")";
    document.getElementsByTagName("main")[0].appendChild(image);  
    elem[no].style.width = imgWidth + "px";
}

//Sets images in slideshow
for(let i = 0; i<images.length; i++){
  newImg(i);
}
          

const changeImage = () =>{
  for (let i = 0; i<elem.length; i++){
    elem[i].style.left = pos[i] + "px";
    w.push(elem[i].offsetWidth);
  }
  setInterval(frame, time);
  function frame(){
    for (let i = 0; i<elem.length; i++){
      if (pos[i] >vanishPoint){
        w[i]--;
        elem[i].style.width = w[i] + "px";
        //REsets image size one image dissapears
        if(elem[i].style.width == "0px"){
          alert("TEST");//Debugg  
          elem[i].style.width = imgWidth +"px";
        }
      }
        elem[i].style.left = pos[i] + "px";
        if(elem[i].style.left == imgWidth + "px"){ 
          elem[i].style.left = lastPic + "px";
          pos[i] = lastPic;
          pos[i]++;
        } else { 
          pos[i]++;
        }
    }
  }
}        
</script>
<?php include 'include/footer.php'; ?>

</body>
</html>