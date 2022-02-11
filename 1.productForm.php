<!DOCTYPE html>
<?php

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Form</title>
    <link rel='stylesheet' type='text/css' href='style.css'>
</head>
<body>
<?php
    $errMessageCost = "required field";
    $errMessageFinish = "required field";
    $errMessageName ="required field";
    $errMessageUsage = "required field";

    $productName ="";
    $productFinish ="";
    $productUsage ="";
    $productCost ="";

    //check input function
    function checkinput($inputData){
        $inputData = trim($inputData);
        $inputData = stripslashes($inputData);
        $inputData = htmlspecialchars($inputData);
        return $inputData;
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        //reset page
        if(isset($_POST["reset"])){
            header("Refesh:0");
            exit();
        }

        $productName = checkinput($_POST["productName"]);
        $productFinish = checkinput($_POST["productFinish"]);
        $productUsage = checkinput($_POST["productUsage"]);
        $productCost = checkinput($_POST["productCost"]);

        $validData = true;

        //validate product name
        if($productName==""){
            $errMessageName = "Product name is not blank";
            $validData = false;
        }
        if($productFinish ==""){
            $errMessageFinish = "Product finish is not blank";
            $validData = false;
        }
        if($productUsage ==""){
            $errMessageUsage = "Product usage is not blank";
            $validData = false;
        }
        if($productCost ==""){
            $errMessageCost = "Product cost is not blank";
            $validData = false;
        }
        if($validData){
            include("1.createDB.php");
            exit();
        }
    }

?>
    <h1>Door Lever Inventory - Part 1</h1>
    <h2>Product Entry Form</h2>
    <h3>Enter thr Door Lever product details into the form and when you are ready, <br>
        click the submit button.</h3>
    <h3>Note: * required entry</h3>

    <form method="post" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>>
        <label for="productName">Product Name</label>
        <input type="text" id="productName" name="productName"
        size="20" value="<?php echo $productName;?>">
        <span class="error">* <?php echo $errMessageName;?></span>
        <br /><br />

        <label for="productFinish">Product Finish</label>
        <input type="text" id="productFinish" name="productFinish"
        size="20" value="<?php echo $productFinish;?>">
        <span class="error">* <?php echo $errMessageFinish;?></span>
        <br /><br />

        <label for="productUsage">Product Usage</label>
        <input type="text" id="productUsage" name="productUsage"
        size="20" value="<?php echo $productUsage;?>">
        <span class="error">* <?php echo $errMessageUsage;?></span>
        <br /><br />

        <label for="productCost">Product Cost</label>
        <input type="text" id="productCost" name="productCost"
        size="20" value="<?php echo $productCost;?>">
        <span class="error">* <?php echo $errMessageCost;?></span>
        <br /><br />

        <input type="submit" name="submit" value="Submit">

        <input type="submit" name="reset" value="Reset" title="Reset Form">
    </form>
</body>
</html>