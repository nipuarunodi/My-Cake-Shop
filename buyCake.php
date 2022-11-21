<?php session_start(); 

?>
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
            <?php
                $con = mysqli_connect("localhost:3308","root","","cakeShopDB");
                if(!$con)
                {	
                    die("Cannot connect to DB server");		
                }
                $sql ="SELECT * FROM `cakes` WHERE `id`='".$_GET['id']."'";	
                $result = mysqli_query($con,$sql);
                if(mysqli_num_rows($result)> 0)
                {
                    $row = mysqli_fetch_assoc($result);
                    $image  = $row['imageName'];	
                }
                if(isset($_POST["btnSubmit"])){
                    $receiverName = $_POST["txtName"];
                    $address = $_POST["txtAddress"];
                    $city = $_POST["txtCity"]; 
                    $province = $_POST["txtProvince"]; 
                    $contact = $_POST["txtContact"]; 
                    $email = $_POST["txtEmail"]; 
                
                    $con = mysqli_connect("localhost:3308","root","","cakeShopDB");
                    if(!$con)
                    {	
                        die("Cannot upload the file, Please choose another file");		
                    }

                    $sql = "CREATE TABLE IF NOT EXISTS orders(
                        id INT(10) NOT NULL AUTO_INCREMENT,
                        receiverName VARCHAR(100),
                        address VARCHAR(1000),
                        city VARCHAR (200),
                        province VARCHAR(200),
                        contact VARCHAR (200),
                        email VARCHAR(200),
                        itemId INT(10) NOT NULL,
                        PRIMARY KEY (id),
                        FOREIGN KEY (itemId) REFERENCES cakes(id)
                    )";
        
                    if(mysqli_query($con,$sql)){

                    } else
                    {
                        echo "Cant Create Table";
                    }

                    $sql = "INSERT INTO `orders` (`receiverName`, `address`, `itemId`, `city`, `province`, `contact`, `email`) 
                    VALUES ('".$receiverName."', '".$address."', '".$_GET['id']."', '".$city."', '".$province."', '".$contact."', '".$email."');";
            
                    if(mysqli_query($con,$sql)){
                    }
                    else{
                        echo "Opps something is wrong, Please select the file again";
                    }
                    header('Location:viewCakes.php');
                }
                ?>
                <form action="buyCake.php?id=<?php echo $_GET['id'];?>" method="post" enctype="multipart/form-data">
		            <table class="registerTable" border="0" align="center">
		                <tr>
                            <td class="inputFields" colspan="2" bgcolor="#FFFFFF">
                                <h1 class="registerHeader">CHECKOUT</h1>
                            </td>
                        </tr>
                        <tr>
                            <td class="inputFields" width="200">Item Name :</td>
                            <td class="inputFields" width="500"><?php echo $row['name'];?></td>
                        </tr>
                        <tr>
                            <td class="inputFields" width="200">Amount :</td>
                            <td class="inputFields" width="500"><?php echo $row['price'];?> LKR</td>
                        </tr>
                        <tr>
                            <td class="inputFields" width="200">Receiver Name :</td>
                            <td class="inputFields" width="500"><input type="text" name="txtName" id="txtName" /></td>
                        </tr>
                        <tr>
                            <td class="inputFields">Delivery Address :</td>
                            <td class="inputFields" ><input type="text" name="txtAddress" id="txtAddress" /></td>
                        </tr>
                        <tr>
                            <td class="inputFields" >City :</td>
                            <td class="inputFields" ><input type="text" name="txtCity" id="txtCity" /></td>
                        </tr>
                        <tr>
                            <td class="inputFields">Province:</td>
                            <td class="inputFields"><input type="text" name="txtProvince" id="txtProvince" /></td>
                        </tr>
                        <tr>
                            <td class="inputFields">Contact Number:</td>
                            <td class="inputFields"><input type="text" name="txtContact" id="txtContact" /></td>
                        </tr>
                        <tr>
                            <td class="inputFields">Email:</td>
                            <td class="inputFields"><input type="text" name="txtEmail" id="txtEmail" /></td>
                        </tr>
                        <tr>
                            <td class="inputFields">Card Type:</td>
                            <td class="inputFields">
                                <select name="cardTypes" id="cardTypes">
                                    <option value="visa">VISA</option>
                                    <option value="master">MASTER</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="inputFields">Card Number:</td>
                            <td class="inputFields"><input type="number" name="txtCardnumber" id="txtCardnumber" /></td>
                        </tr>
                        <tr>
                            <td class="inputFields">CSV:</td>
                            <td class="inputFields"><input type="number" name="txtCSV" id="txtCSV" /></td>
                        </tr>
                        <tr>
                            <td class="inputFields">Expire Date:</td>
                            <td class="inputFields"><input type="date" name="txtExpDate" id="txtExpDate" /></td>
                        </tr>

                        <tr>
                            <td class="inputFields" colspan="2">
                                <blockquote>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
                                    <input name="btnSubmit" type="submit" class="button" id="btnSubmit" value="Confirm"/>
                                </blockquote>
                            </td>
                        </tr>
                    </table>
                </form>
            </tr>
        </tbody>
    </table>
</body>
</html>