<!DOCTYPE html>
<?php
    //check input function
    function checkinput($inputData){
        $inputData = trim($inputData);
        $inputData = stripslashes($inputData);
        $inputData = htmlspecialchars($inputData);
        return $inputData;
    }
    $errMessageUserName = $errMessageUserPassword = "required field";
    $userName  = "";
    $password = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        //reset page
        if(isset($_POST["reset"])){
            header("Refesh:0");
            exit();
        }
        $userName = checkinput($_POST["userName"]);
        $userPassword = checkInput($_POST["userPassword"]);
        $errMessageUserName=""; 
        $errMessageUserPassword="";

        $validData = true;

        if($userName == "") {
            $errMessageUserName="User Name must not be blank"; 
            $validData = false;
        }
        if($userPassword == "") { 
            $errMessageUserPassword="Password must not be blank"; 
            $validData = false;
        }
        if ($validData) { 
            include("3.LoginDetails_Verify.php"); 
            exit();
        }

    }
?>




<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel='stylesheet' type='text/css' href='style.css'>
</head>
<body>
    <h1>Login Details</h1>
    <h3>Enter your login detail and when you are ready, click the submit button</h3>
    <p>NOTE: * required entry</p>
    <form method="post" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>>
        <label for="userName">Username:</label>
        <input type="text" id="userName" name="userName" size="20" value="<?php echo $userName;?>">
        <span class="error">* <?php echo $errMessageUserName;?></span>
        <br /><br />

        <label for="userPassword">Password:</label>
        <input type="password" id="userPassword" name="userPassword" size="20" value="">
        <span class="error">* <?php echo $errMessageUserPassword;?></span>
        <br /><br /> 
        <input type="submit" name="submit" value="Submit">
        <input type="submit" name="reset" value="Reset" title="Reset Form">
    </form>
    
</body>
</html>