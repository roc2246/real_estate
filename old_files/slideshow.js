//Stores variables to manage slideshow
var vanishPoint = 0;
var time = 10;
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

//Sets height of "slideshow" div tag
document.getElementById("slideshow").style.height = "600px";

//Creates new image
function newImg (no) {
    const image = document.createElement("div");
    image.className = "changing-image";
    image.style.backgroundImage = "url(background-images/"+images[no] +")";
    image.style.position = "absolute";
    image.style.height = 600 + "px";
    document.getElementById("slideshow").appendChild(image);  
    elem[no].style.width = imgWidth + "px";
}

//Sets images in slideshow
for(let i = 0; i<images.length; i++){
  newImg(i);
}

//Sets timer so slideshow can pause
/* let start = () => {
      var startTime = new Date();
      var startSeconds = startTime.getSeconds();
      return startSeconds;
    }
var initSecs = start();

let myTimer = () => {
      var endTime = new Date();
      var endSeconds = endTime.getSeconds();
      var timeDiff = endSeconds - initSecs;

    document.getElementById("timer").innerHTML = timeDiff;
    return  timeDiff;
    /*Interval here? */
  /* } */ 

//Creates slideshow
const slideshow = () =>{
  let id = setInterval(frame, time);
/*   myTimer();
  let myVar = setInterval(myTimer ,time);
  if(myTimer() == 1){
    alert("TEST");
  } */
}
  
//Creates slideshow animation
const frame = () =>{
  for (let i = 0; i<elem.length; i++){
    w.push(elem[i].offsetWidth);
    elem[i].style.left = pos[i] + "px";
    if (pos[i] >vanishPoint){
      w[i]--;
      elem[i].style.width = w[i] + "px";
      if(w[i] == 0){
        w[i] = imgWidth;
        elem[i].style.width = w[i] + "px";
      }
    }
    if(elem[i].style.left == imgWidth + "px"){ 
      elem[i].style.left = lastPic + "px";
      pos[i] = lastPic;
      pos[i]++;
    } else { 
      pos[i]++;
    }
  }
}

//Initializes slideshow
slideshow();
