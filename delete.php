<?php
include "include/connect.php"; // Using database connection file here
global $connection;

$id = $_GET['id']; // get id through query string
$sql = "DELETE FROM listings WHERE id = '$id'";
$results = mysqli_query($connection,$sql); // delete query

if($results)
{
    mysqli_close($connect); // Close connection
    header("location:index.php"); // redirects to all records page
    exit;	
}
else
{
    echo "Error deleting record"; // display error message if not delete
}
?>