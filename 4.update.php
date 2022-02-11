<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Form</title>
    <link rel='stylesheet' type='text/css' href='style.css'>
</head>
<body>
<?php
        $errMessageID="required field"; 
        $errMessageCost="required field";
        $prodID =""; 
        $newCost ="";

        if ($_SERVER["REQUEST_METHOD"] == "POST") { 
            if(isset($_POST["reset"])){ 
                header("Refresh:0"); 
                exit();
            }
            $prodID = $_POST["prodId"];
            $newCost = $_POST["cost"];
            if($newCost == "") {
                $errMessageName="Cost must not be blank";
            }
            elseif($prodID == "") {
                $errMessageID="Product ID must not be blank";
            }
            elseif (!is_numeric($prodID)){
                $errMessageID="Product ID must be numeric only"; 
            }
            else { 
                include('4.updatePro_DB.php');
                exit();
            } 
        }
    ?>
    
    <h1>Door Lever Inventory - Part 4</h1>
    <ul class="navigation">
        <li><a href="1.productForm.php">Add product</a></li>
        <li><a href="4.update.php">Update Product</a></li>
        <li><a href="4.delete.php">Delete product</a></li>
    </ul>

    <h2>Update Product Cost Form</h2>
    <h4>Enter thr Door Lever product ID into the form and when you are ready, <br>
        click the submit button.</h4>
    <h4>Note: * required entry</h4>

    <form method="post" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>>
        <label for="prodId">Product ID: </label>
        <input type="text" id="prodId" name="prodId" size="20" value="<?php echo $prodID;?>">
        <span class="error">* <?php echo $errMessage;?></span>
        <br /><br />

        <label for="cost">Product cost: </label>
        <input type="text" id="cost" name="cost" size="20" value="<?php echo $newCost;?>">
        <span class="error">* <?php echo $errMessageCost;?></span>
        <br /><br/>

        <input type="submit" name="submit" value="Submit">
        <input type="submit" name="reset" value="Reset" title="Reset">
    </form>
    

</body>
</html>