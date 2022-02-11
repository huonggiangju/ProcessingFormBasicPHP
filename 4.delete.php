<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Form</title>
    <link rel='stylesheet' type='text/css' href='style.css'>
</head>
<body>

<?php
 
 $errMessage="required field";
 $prodID ="";
 if ($_SERVER["REQUEST_METHOD"] == "POST") { //User has pressed the submit button
     if(isset($_POST["reset"])){ 
         header("Refresh:0"); 
         exit();
     }
     $prodID = $_POST["prodId"];
     if($prodID == "") {
         $errMessage="ProductID must not be blank";
     }
     elseif (!is_numeric($prodID)){ 
         $errMessage="ProductID must be numeric only";
     }
     
     else {
         include('4.deletePro_DB.php');
         exit();
     }
 }


?>

    <h1>Door Lever Inventory - Part 4</h1>  
    <ul class="navigation">
        <li><a href="4.add.php">Add product</a></li>
        <li><a href="4.update.php">Update Product</a></li>
        <li><a href="4.delete.php">Delete product</a></li>
    </ul>

    <h2>Delete Product Form</h2>
    <h3>Enter thr Door Lever product ID into the form and when you are ready, <br>
        click the submit button.</h3>
    <h3>Note: * required entry</h3>


    <form method="post" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>>
        <label for="prodId">Product ID: </label>
        <input type="text" id="prodId" name="prodId" size="20" value="<?php echo $prodID;?>">
        <span class="error">* <?php echo $errMessage;?></span>
        
        <br /><br /> 
        <input type="submit" name="submit" value="Submit">
        <input type="submit" name="reset" value="Reset" title="Reset Form">
    </form>


    


</body>
</html>