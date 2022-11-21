<?php session_start(); 
if (!isset($_SESSION["email"]))
{
	header('Location:userLogin.php');

}
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>My Cake Shop</title>
        <link rel="stylesheet" type="text/css" href="./styles.css">
    </head>

    <body>
        <table width="100%">
            <tbody>
                <tr>
                    <td>
                        <ul>
                            <li><a href="index.html"> Home</a></li>
                            <!-- <li><a href="./viewCakes.php">Buy Cakes</a></li> -->
                            <li><a href="./myProducts.php">My Shop</a></li>
                            <!-- <li style ="float: right"><a href="./userLogin.php"> Login</a></li>
                            <li style ="float: right"><a href="./userRegister.php">Register</a></li> -->
                            <li style ="float: right"><a href="./userLogout.php">Logout</a></li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <form action="addCake.php" method="post" enctype="multipart/form-data">
                            <table class="loginTable" style="padding: 20px" width="500" align="center">
                                <tr>
                                    <td colspan="2" bgcolor="#FFFFFF">
                                        <div align="center">
                                            <img src="./images/logo.jpg" width="165" height="166" />
                                        </div>
                                        <h1 class="loginHeader">Add New Cake</h1>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="inputFields" width="146">Name :</td>
                                    <td width="282"><input type="text" name="txtTitle" id="txtTitle" /></td>
                                </tr>
                                <tr>
                                    <td class="inputFields">Description :</td>
                                    <td><input type="text" name="txtDescription" id="txtDescription" /></td>
                                </tr>
                                <tr>
                                    <td class="inputFields">Price :</td>
                                    <td><input type="number" name="txtPrice" id="txtPrice" /></td>
                                </tr>
                                <tr>
                                    <td class="inputFields">Image : </td>
                                    <td><input type="file" name="fileImage" id="fileImage" /></td>
                                </tr>
                                <tr>
                                    <td style="text-align:center" colspan="2"><blockquote> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input name="btnSubmit" type="submit" class="button" id="btnSubmit" value="Add Now"   />
                                    <input name="btnReset" type="reset" class="button" id="btnReset" value="Cancel"   />
                                    
                                    <?php
                                    if(isset($_POST["btnSubmit"])){
                                        $name = $_POST["txtTitle"];
                                        $description = $_POST["txtDescription"];
                                        $price = $_POST["txtPrice"]; 
                                        $imageName = "uploads/".basename($_FILES["fileImage"]["name"]);
                                        
                                        move_uploaded_file($_FILES["fileImage"]["tmp_name"],$imageName);
                                    
                                        $con = mysqli_connect("localhost:3308","root","","cakeShopDB");
                                        if(!$con)
                                        {	
                                            die("Cannot upload the file, Please choose another file");		
                                        }

                                        $sql = "CREATE TABLE IF NOT EXISTS cakes(
                                            id INT(10) NOT NULL AUTO_INCREMENT,
                                            name VARCHAR(100) NOT NULL,
                                            description VARCHAR(1000),
                                            shopEmail VARCHAR (200) NOT NULL,
                                            price FLOAT NOT NULL,
                                            imageName VARCHAR(200) NOT NULL,
                                            PRIMARY KEY (id),
                                            FOREIGN KEY (shopEmail) REFERENCES shops(email)
                                        )";
                            
                                        if(mysqli_query($con,$sql)){

                                        } else
                                        {
                                            echo "Cant Create Table";
                                        }

                                        $sql = "INSERT INTO `cakes` (`name`, `description`, `shopEmail`, `price`, `imageName`) 
                                        VALUES ('".$name."', '".$description."', '".$_SESSION["email"]."', '".$price."', '".$imageName."');";
                                
                                        if(mysqli_query($con,$sql)){
                                            echo "Opps something is wrong, Please select the file again";
                                        }
                                        
                                        else{
                                            echo "Opps something is wrong, Please select the file again";
                                        }
                                        header('Location:myProducts.php');
                                    }
                                    ?>
                                    </blockquote>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
    </body>
</html>		
