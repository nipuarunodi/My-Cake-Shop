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
                            <li><a href="./viewCakes.php">Buy Cakes</a></li>
                            <li><a href="./myProducts.php">My Shop</a></li>
                            <li style ="float: right"><a href="./userLogin.php"> Login</a></li>
                            <li style ="float: right"><a href="./userRegister.php">Register</a></li>
                            <!-- <li style ="float: right"><a href="./userLogout.php">Logout</a></li> -->
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><form action="" method="post">
                        <table width="814" height="268" border="0" align="center">
                            <tr>
                                <td width="534" colspan="2" bgcolor="#FFFFFF">
                                    <h1 class="loginHeader">Available Cake List</h1>
				                        <?php 
                                         $con = mysqli_connect("localhost:3308","root","","cakeShopDB");
                                        if(!$con) {	
                                            die("Cannot connect to DB server");		
                                        }
                                        $sql ="SELECT * FROM `cakes`";	
                                            
                                        $result = mysqli_query($con,$sql);
                                        if(mysqli_num_rows($result)> 0){
                                            while($row = mysqli_fetch_assoc($result))
                                        {                                                    
                                         ?>
			                        <div class="listImage" style="width:49%; border:1px solid #000000; padding: 10px">
                                        <a href="<?php echo $row['imageName'];?>">
                                            <img src="<?php echo $row['imageName'];?>" width="134" height="128">
                                        </a>
                                            <p class="listLabels"><b>Name: </b><?php echo $row['name'];?>  </p>
                                            <p class="listLabels"><b>Price: </b><?php echo $row['price'];?>  </p>
                                            <p class="listLabels"><b>Description: </b><?php echo $row['description'];?>  </p>

                                            <br>
                                            <div style="margin-top:20px">
                                            <a class="cardButton" style="background-color: #119e40;" href="buyCake.php?id=<?php echo $row['id']; ?>">BUY</a>  
                                            </div>
                                        </div>		
				                    </div>                                      
				                    <?php
			                            }
		                                }
				                        mysqli_close($con);
				                    ?>               
			                    </td>
                            </tr>
                            <tr></tr>
                        </table>
                    </form>
                </td>
                </tr>
            </tbody>
        </table>
    </body>

</html>