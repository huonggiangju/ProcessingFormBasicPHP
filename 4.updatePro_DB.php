<?php
$dbName = "product_DB";
$conn = @mysqli_connect("localhost:3307","root","",$dbName);
// Check connection
if (mysqli_connect_errno()) {
    echo "<p>Failed to connect to MySQL" . mysqli_connect_error() . "</p>"; 
}
else {
    echo "<h1>Door Lever Inventory - Part 4</h1>";
    echo "<br /><br />";
    echo "<a href='4.update.php'>Update Product</a>";
    echo "<br /><br />";
    echo "<a href='4.delete.php'>Delete product</a>";
    echo "<br /><br />";
    echo "<a href='5.productEntryForm.php'>Upload picture of product</a>";

    $query = "UPDATE product SET prodCost ='".$newCost."' WHERE id= ".$prodID; 
    $results = mysqli_query($conn,$query);
    $numRowsAffected = mysqli_affected_rows($conn);
    if (!$results)
    {
    echo "<p>Error updating product ID: " . mysqli_error($conn) . "</p>";
    } 
    else {
        if ($numRowsAffected == 0) {
            echo "<p>Error - product ID not found."; }
        else {
            echo "<p>New cost successfully updated for product ID: ".$prodID."</p>"; 
            //Show the updated record
            $query = "SELECT * FROM product WHERE id=".$prodID;
            $results = mysqli_query($conn,$query);
            if ($results) {
                $numRecords=mysqli_num_rows($results); 
                if ($numRecords != 0){
                    
                    //fetch and display results
                    while ($row = mysqli_fetch_array($results)) {
                        echo "<p>Product name: $row[prodName]</p>"; 
                        echo "<p>Product finish: $row[prodFinish]</p>"; 
                        echo "<p>Product usage: $row[prodUsage]</p>"; 
                        echo "<p>Product cost: $row[prodCost]</p>";
                    }   
                    
                }
                else {
                    echo "<p>User ID not found1!</p>"; 
                }
            } else {
                echo "<p>User ID not found2222!</p>"; 
            }             
        }    
    }
}
//Close the connection
mysqli_close($conn); 
?>