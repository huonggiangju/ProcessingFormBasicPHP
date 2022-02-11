<?php
    session_start();
    $conn = @mysqli_connect("localhost:3307", "root", "");
    //check connection
    if(!$conn){
        echo "<p>The connection has failed:".mysqli_error($conn)."</p>";
    }else{
        // echo "<p>Connected to Mysql</p>"; //connect
        $name = $_POST["productName"];
        $finish = $_POST["productFinish"];
        $usage = $_POST["productUsage"];
        $cost  = $_POST["productCost"];

        $dbName = "product_DB";
        // $query = "DROP DATABASE IF EXISTS ".$dbName.";";
        $query = "CREATE DATABASE IF NOT EXISTS ". $dbName;

        if(!mysqli_query($conn, $query)){
            echo "<p>Could not open database: ".mysqli_error($conn)."</p>";           
        }
        else{
            // echo "<p>Connected to product DB</p>";
            if(!mysqli_select_db($conn, $dbName)){
                echo "<p>Could not open database2: ".mysqli_error($conn)."</p>";
            }
            else{
                //create table
                $query = "CREATE TABLE IF NOT EXISTS product(id int not null auto_increment primary key,
                    prodName varchar(30) not null, prodFinish varchar(30) not null, 
                    prodUsage varchar(30) not null, prodCost float(8,2) not null)";

                if(!mysqli_query($conn, $query)){
                    echo "<p>Error create table: ".mysqli_error($conn)."</p>";
                }
                else{
                    // echo "<p>table create Successful</p>";
                    //insert data 
                    $query = "INSERT INTO product(prodName, prodFinish, prodUsage, prodCost)
                             VALUES ('$name', '$finish', '$usage', '$cost')";
                    
                    if(!mysqli_query($conn, $query)){
                        echo "<p>Error inserting data: ".mysqli_error($conn)."</p>";                      
                    }
                    else{
                        // echo "<p>insert data Successful</p>";

                        //auto increment ID
                        $pid = mysqli_insert_id($conn);
                        $_SESSION['prodId'] = $pid;
                        
                        echo "<h1>Door Lever Inventory - Part 2</h1>";
                        echo "Product details successfull added to the database";
                        echo "<br/> The product ID is ".$_SESSION['prodId'];
                        echo "<br /><br />";
                        echo "<a href='4.update.php'>Update Product</a>";
                        echo "<br /><br />";
                        echo "<a href='4.delete.php'>Delete product</a>";

                        
                    }
                }
            }
        }
        
    }
    //close connection
    mysqli_close();


?>