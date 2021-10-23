<?php $pageTitle = 'listings'; ?>
<?php include 'include/header.php';?>

<main>
<h1>Check Out Our Listings!</h1>    
<script src="async.js"></script>
<script>
loadJSONdata('listings-api.php','GET').then(data => {
        if(typeof data == "string"){
            document.getElementsByTagName("main")[0].innerHTML = data;
        };
}); 

//For debugging purposes
document.getElementsByTagName("main")[0].innerHTML = loadJSONdata('listings-api.php','GET');

</script>

</main>

<?php include 'include/footer.php'; ?>

</body>
</html>