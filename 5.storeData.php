<?php
$conn = @mysqli_connect("localhost:3307", "root", "", "product_DB1");

$name = $_POST["productName"];
$finish = $_POST["productFinish"];
$usage = $_POST["productUsage"];
$cost  = $_POST["productCost"];
$image = $_POST["userfile"];

$fileUpload = $_FILES['userfile']['name'];
$fileType = $_FILES['userfile']['type'];
$fileSize = $_FILES['userfile']['size'];
$tempName = $_FILES['userfile']['tmp_name'];
$fileLocation = 'images/'.$fileUpload;

if($fileUpload ==""){
    echo "<p> you must enter a filename </p>";
}
else if(!(($fileType =="image/jpg") or ($fileType=="image/gif") or ($fileType=="image/png")
        or ($fileType=="image/jpeg"))){
    echo "<p> you must upload jpg/gif/png/jpeg file </p>";
}   
else{
    if(!move_uploaded_file($tempName, $fileLocation)){
        switch ($_FILES['userfile']['error']){
            case UPLOAD_ERR_INI_SIZE:
                echo "<p>Error: File exceeds the maximum size limit set by the server</p>";
                break;
            case UPLOAD_ERR_FORM_SIZE: 
                echo "<p>Error: File exceeds the maximum size limit set by the browser</p>";
                break;
            case UPLOAD_ERR_NO_FILE:
                echo "<p>Error: No file uploaded</p>";
                break;
            default:
                echo "<p>File can not uploaded</p>";
        }
    }else{

        // =======multiple query======
        // create  database
        $dbName = "product_DB1";
        $query = "DROP DATABASE IF EXISTS ".$dbName.";";
        $query.= "CREATE DATABASE IF NOT EXISTS ". $dbName.";";
        $query.= "USE ".$dbName.";";
        $query.= "CREATE TABLE IF NOT EXISTS product(id int not null auto_increment primary key,
                    prodName varchar(30) not null, prodFinish varchar(30) not null, 
                    prodUsage varchar(30) not null, prodCost float(8,2) not null, 
                    imageurl varchar(100) not null);";
         $query.= "INSERT INTO product(prodName, prodFinish, prodUsage, prodCost, imageurl)
         VALUES ('$name', '$finish', '$usage', '$cost', '$fileLocation')";

        if(!mysqli_multi_query($conn, $query)){ //if connection is successful, it will excute $query
            echo "<p>Error: ".mysqli_error($conn)."</p>";
            
        }else{
            
            do{ //through and process each query
                mysqli_next_result($conn);
            }while (mysqli_more_results($conn));

            //auto increment ID
            $pid = mysqli_insert_id($conn);
            $_SESSION['prodId'] = $pid;
            
            echo "<h1>Door Lever Inventory - Part 5</h1>";
            echo "Product details successfull added to the database";
            echo "<br/> The product ID is ".$_SESSION['prodId'];  
            echo"<p><img src='$fileLocation' height='500' width='500'></p>"; 
            echo "<br /><br />";
            echo "<a href='3.LoginForm.php'>Back to login page</a>";
        }

    }
}

//close connection
mysqli_close($conn);









?>