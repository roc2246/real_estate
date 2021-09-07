<?php $pageTitle = 'Home'; ?>
<?php include 'include/header.php';?>

<main>

<h1>Your new dream home awaits...</h1>
<p id="test">TEST</p>
</main>


<script>
    //Use promises
 window.setInterval("changeImage()", 3000);
 let images=["1", "2", "3", "4"];
 let changeImage = () =>{
    document.getElementById("test").innerHTML = images[Math.floor(Math.random() * images.length)];
 
}
</script>
<?php include 'include/footer.php'; ?>

</body>
</html>