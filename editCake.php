<?php session_start(); 
if (!isset($_SESSION["email"]))
{
	header('Location:myProducts.php');

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
                <?php
                    $con = mysqli_connect("localhost:3308","root","","cakeShopDB");
                    if(!$con)
                    {	
                        die("Cannot connect to DB server");		
                    }
                    $sql ="SELECT * FROM `cakes` WHERE `id`='".$_GET['id']."'";	
                    $image="";		
                    $result = mysqli_query($con,$sql);
                    if(mysqli_num_rows($result)> 0)
                    {
                        $row = mysqli_fetch_assoc($result);
                        $image  = $row['imageName'];	
                    ?>
                    <td colspan="2">
                        <form action="editCake.php?id=<?php echo $_GET['id'];?>"  method="post" enctype="multipart/form-data">
                            <table class="loginTable" style="padding: 20px" width="500" align="center">
                                <tr>
                                    <td colspan="2" bgcolor="#FFFFFF">
                                    <h1 class="loginHeader">Edit Cake</h1>

                                        <div align="center">
                                            <img src="<?php echo $row['imageName'];?>" width="165" height="166" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="inputFields" width="146">Name :</td>
                                    <td width="282"><input type="text" name="txtTitle" id="txtTitle" value= "<?php echo $row['name'];?>"/></td>
                                </tr>
                                <tr>
                                    <td class="inputFields">Description :</td>
                                    <td><input type="text" name="txtDescription" id="txtDescription" value= "<?php echo $row['description'];?>" /></td>
                                </tr>
                                <tr>
                                    <td class="inputFields">Price :</td>
                                    <td><input type="number" name="txtPrice" id="txtPrice" value= "<?php echo $row['price'];?>"/></td>
                                </tr>
                                <tr>
                                    <td class="inputFields">Image : </td>
                                    <td><input type="file" name="fileImage" id="fileImage" /></td>
                                </tr>

                                <tr>
                                    <td style="text-align:center" colspan="2"><blockquote> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input name="btnSubmit" type="submit" class="button" id="btnSubmit" value="Update"   />
                                    
                                    <?php
                                    if(isset($_POST["btnSubmit"])){
                                        $name = $_POST["txtTitle"];
                                        $description = $_POST["txtDescription"];
                                        $price = $_POST["txtPrice"]; 
                                        if(is_uploaded_file($_FILES['fileImage']['tmp_name']))
                                        {
                                        $image = "uploads/".basename($_FILES["fileImage"]["name"]);
                                        move_uploaded_file($_FILES["fileImage"]["tmp_name"],$image);
                                        }  
                                    
                                        $con = mysqli_connect("localhost:3308","root","","cakeShopDB");
                                        if(!$con){	
                                            die("Cannot upload the file, Please choose another file");		
                                        }
                                  
                                        $sql = "UPDATE `cakes`SET
                                         `name` = '".$name."', `description` = '".$description."', `price` = '".$price."', `imageName` = '".$image."' WHERE `cakes`.`id` = ".$_GET['id'].";";                    
                                        if(mysqli_query($con,$sql)){
                                        }
                                        else{
                                            echo "Opps something is wrong, Please select the file again";
                                        }
                                        header('Location:myProducts.php');
                                    }
                                    ?>
                                    </blockquote>
                                    </td>
                                    <?php }
		?>
                                </tr>
                            </table>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
    </body>
</html>		
