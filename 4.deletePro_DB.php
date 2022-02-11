<?php
$dbName = "product_DB";
$conn = @mysqli_connect("localhost:3307","root","",$dbName);
// Check connection
if (mysqli_connect_errno()) {
    echo "<p>Failed to connect to MySQL " . mysqli_connect_error() . "</p>"; }
else {
    echo "<h1>Door Lever Inventory - Part 4</h1>";
    echo "<br /><br />";
    echo "<a href='4.update.php'>Update Product</a>";
    echo "<br /><br />";
    echo "<a href='4.delete.php'>Delete product</a>";
    echo "<br /><br />";
    echo "<a href='5.productEntryForm.php'>Upload picture of product</a>";

    $query = "DELETE FROM product WHERE id= ".$prodID; 
    $results = mysqli_query($conn,$query); 
    $numRowsAffected = mysqli_affected_rows($conn);
    if (!$results)
    {
        echo "<p>Error deleting product ID: " . mysqli_error($conn) . "</p>";
    } else {
        if ($numRowsAffected == 0) {
            echo "<p>Error - product ID not found."; }
        else {
            echo "<p>product ID ".$prodID." successfully deleted</p>"; 
            
        }
    } 
}

//close connection
mysqli_close($conn);
?>