<?php $pageTitle = 'Home'; ?>
<?php include 'include/header.php';?>

<main>

<h1>Your new dream home awaits...</h1>
<p id="test">TEST</p>
</main>


<script>
 window.setInterval("changeImage()", 2500);
 let images=["1", "2", "3", "4"];
 const changeImage = () =>{
    document.getElementById("test").innerHTML = images[Math.floor(Math.random() * images.length)];
 
}
</script>
<?php include 'include/footer.php'; ?>

</body>
</html>