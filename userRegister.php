<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>My Cake Shop</title>
    <link rel="stylesheet" type="text/css" href="./styles.css">
    <style>
        .body{
            font-family:Arial, Helvetica, sans-serif;
        }
    </style>

</head>

<body>
    <table width="100%">
        <tbody>
            <tr>
                <td>
                    <ul>
                        <li><a href="index.html"> Home</a></li>
                        <li><a href="./viewCakes.php">Buy Cakes</a></li>
                        <!-- <li><a href="./myProducts.php">My Shop</a></li> -->
                        <li style ="float: right"><a href="./userLogin.php"> Login</a></li>
                        <!-- <li style ="float: right"><a href="./userRegister.php">Register</a></li> -->
                    </ul>
                </td>
            </tr>
            <tr>
                <form action="userRegister.php" method="post">
		            <table class="registerTable" border="0" align="center">
		                <tr>
                            <td class="inputFields" colspan="2" bgcolor="#FFFFFF">
                                 <p class="imgcontainer" style="margin:0">
                                    <img src="./images/logo.jpg" alt="Avatar" width="30%" height="195" class="avatar" />
                                </p>
                                <h1 class="registerHeader">Shop Registration</h1>
                            </td>
                        </tr>
                        <tr>
                            <td class="inputFields" width="200">Shop Name :</td>
                            <td class="inputFields" width="500"><input type="text" name="txtShopName" id="txtShopName" /></td>
                        </tr>
                        <tr>
                            <td class="inputFields">Shop Address :</td>
                            <td class="inputFields" ><input type="text" name="txtShopAddress" id="txtShopAddress" /></td>
                        </tr>
                        <tr>
                            <td class="inputFields" >Owner Name :</td>
                            <td class="inputFields" ><input type="text" name="txtOwnerName" id="txtOwnerName" /></td>
                        </tr>
                        <tr>
                            <td class="inputFields">Email Address:</td>
                            <td class="inputFields"><input type="text" name="txtEmail" id="txtEmail" /></td>
                        </tr>
                        <tr>
                            <td class="inputFields">Contact Number:</td>
                            <td class="inputFields"><input type="text" name="txtContact" id="txtContact" /></td>
                        </tr>
                        <tr>
                            <td class="inputFields">Password:</td>
                            <td class="inputFields"><input type="password" name="txtPassword" id="txtPassword" class="passwordInput" /></td>
                        </tr>
                        <tr>
                            <td class="inputFields">Confirm Password</td>
                            <td class="inputFields"><input type="password" name="txtConfirmPassword" id="txtConfirmPassword" class="passwordInput" /></td>
                        </tr>
                        <tr>
                            <td class="inputFields" colspan="2">
                                <blockquote>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
                                    <input name="btnSubmit" type="submit" class="button" id="btnSubmit" value="Register"   />
                                    <input name="btnReset" type="reset" class="button" id="btnReset" value="Reset"   />
                                </blockquote>
                            </td>
                        </tr>
                    </table>
                </form>
            </tr>
        </tbody>
    </table>
</body>
<?php
    if(isset($_POST["btnSubmit"]))
    {
        $shopName = $_POST["txtShopName"];
        $shopAddress = $_POST["txtShopAddress"];
        $ownerName = $_POST["txtOwnerName"];
        $email = $_POST["txtEmail"];
        $contactNumber = $_POST["txtContact"];
        $password = $_POST["txtPassword"];
      
        $dbname = "cakeShopDB";
        
        $con = mysqli_connect("localhost:3308","root","");

        if(!$con)
        {	
            die("Connection Faild : ".mysqli_connect_error());		
        }	

        $sql = "CREATE DATABASE IF NOT EXISTS $dbname";

        if(mysqli_query($con,$sql)){
            $con = mysqli_connect("localhost:3308","root","", $dbname);

            $sql = "CREATE TABLE IF NOT EXISTS shops(
                id INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                shopName VARCHAR(100) NOT NULL,
                shopAddress VARCHAR(200) NOT NULL,
                ownerName VARCHAR(100) NOT NULL,
                email VARCHAR(200) NOT NULL UNIQUE,
                contactNumber INT(10) NOT NULL,
                password VARCHAR(100) NOT NULL
            )";

            if(mysqli_query($con,$sql)){
                echo "Table Created";
            }else{
                echo "Can not Create Table";
            }
        }else{
            echo "Error while Creating Database";
        }

        $sql = "INSERT INTO `shops` (`email`, `shopName`, `shopAddress`, `ownerName`, `contactNumber`, `password`) 
                         VALUES ('".$email."', '".$shopName."', '".$shopAddress."', '".$ownerName."', '".$contactNumber."', '".$password."');";
        
        mysqli_query($con,$sql)	;
        
        mysqli_close($con);

        header('Location:userLogin.php');
        
    }
	
	?>
</html>