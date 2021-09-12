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
var time = 5;
var imgWidth = 1905;
var w= [];//stores width of each image
var pos = [];//stores initial position of each image

//Stores images for slideshow
var images = [];
images[0] = "1.png";
images[1] = "2.png";
images[2] = "3.png";
images[3] = "4.png";



//Creates new image
const newImg = (no) => {
    const image = document.createElement("div");
    image.className = "changing-image";
    image.style.backgroundImage = "url(background-images/"+images[no] +")";
    document.getElementsByTagName("main")[0].appendChild(image);  
    document.getElementsByClassName("changing-image")[no].style.width = imgWidth + "px";
}

//Stores slideshgow image containers
const elem = document.getElementsByClassName("changing-image");

//Sets the first image
//newImg(0);

for(let i = 0; i<images.length; i++){
  newImg(i);
}
          

const changeImage = () =>{
  //Initial position of eack element
  pos[0] = 0;
  pos[1] = -1800;
  pos[2] = -3700;
  pos[3] = -5600; 
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


          
    //Creates new image once previous one starts to dissaspear
  /*  if(elem[i].offsetWidth < imgWidth){
            newImg(1);
          }*/
</script>
<?php include 'include/footer.php'; ?>

</body>
</html>