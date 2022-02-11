<?php
session_start();
$conn = @mysqli_connect("localhost:3307", "root", "");

if(!$conn){
    echo "<p>The connection has failed:".mysqli_error($conn)."</p>";
}else{

    $userName = $_POST["userName"];
    $password = $_POST["userPassword"];

    // create  database
    $dbName = "cust_DB";
    $query = "DROP DATABASE IF EXISTS ".$dbName;
    $query = "CREATE DATABASE IF NOT EXISTS ". $dbName;
    $query = "USE ".$dbName;
    
                
    // $query.= "INSERT INTO custLogin(userName, userPassword)
    // VALUES ('$userName', '$password')";

    if(!mysqli_query($conn, $query)){ //if connection is successful, it will excute $query  
        echo "<p>Error: ".mysqli_error($conn)."</p>";

    }else{
        if(!mysqli_select_db($conn, $dbName)){
            echo "<p>Could not open database2: ".mysqli_error($conn)."</p>";
        }
        else{
            $query = "CREATE TABLE IF NOT EXISTS custLogin(id int not null auto_increment primary key,
            userName varchar(50) not null, userPassword varchar(255) not null)";                

        if(!mysqli_query($conn, $query)){
            echo "<p>Error create table: ".mysqli_error($conn)."</p>";
        }else{

            $query = "SELECT * FROM custLogin WHERE userName = '".$userName."'";
            $result = mysqli_query($conn, $query);

            if($result){
                $numRecords = mysqli_num_rows($result);
                if ($numRecords!=0){
                    //verify user - check the password
                    $row = mysqli_fetch_array($result);
                    $hashedPassword = $row['userPassword'];
                    $passwordsAreTheSame = password_verify($password, $hashedPassword);

                    if($passwordsAreTheSame == true){
                        echo "<p>Login successfull</p>";
                        echo "<a href = 1.productForm.php> Click here to go to Product Form </a>";
                    }
                    else{
                        echo "<p>Username exists but the Password does not match</p>";
                    }
                }else{
                    echo "<p>This user does not exits in the table </p>";
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                    //insert database
                    $insert = "INSERT INTO custLogin(userName, userPassword)
                            VALUES ('$userName', '$hashedPassword')";

                    if(mysqli_query($conn, $insert)){
                        echo "<p>New user added</p>";
                    }else{
                        echo "<p>insert Error: ".mysqli_error($conn)."</p>";
                    }
                }
            }else{
                echo "<p>Error locating customer detail</p>";
            }
        }

        } 
    }
}

 //close connection
 mysqli_close();

?>
