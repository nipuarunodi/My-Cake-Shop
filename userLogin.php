<?php session_start(); ?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>My Cake Shop</title>
    <link rel="stylesheet" type="text/css" href="./styles.css">
</head>

<body>
    <form action="userLogin.php" method="post">
        <table width="100%">
            <tbody>
                <tr>
                    <td>
                        <ul>
                            <li><a href="index.html"> Home</a></li>
                            <li><a href="./viewCakes.php">Buy Cakes</a></li>
                            <!-- <li><a href="./myProducts.php">My Shop</a></li> -->
                            <!-- <li style ="float: right"><a href="./userLogin.php"> Login</a></li> -->
                            <li style ="float: right"><a href="./userRegister.php">Register</a></li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table class="loginTable" width="350" align="center">
                            <tr>
                                <td>
                                    <p class="imgcontainer">
                                        <img src="./images/logo.jpg" alt="Avatar" width="63%" height="195" class="avatar" />
                                        <h2 class="loginHeader">My Cake Shop</h2>
                                    </p>
                                    <div class="container">
                                        <p>
                                            <label style="margin-bottom:10px" for="email"><b>Email</b></label>
                                            <input class="loginInputs" type="text" placeholder="Enter email" name="txtEmail" required>
                                            
                                            <label for="password"><b>Password</b></label>
                                            <input class="loginInputs" type="password" placeholder="Enter Password" name="txtPassword" required>
                                        </p>
                                        <p>
                                        <?php
                                            if(isset($_POST["btnsubmit"])){				
                                            $email = $_POST["txtEmail"];
                                            $password =  $_POST["txtPassword"];
                                            
                                            $con = mysqli_connect("localhost:3308","root","","cakeShopDB");
                                            if(!$con)
                                            {	
                                                die("Database Error");		
                                            }	
                                            $sql = "SELECT * FROM `shops` WHERE `email`='".$email."' AND `password`='".$password."';";
                                            $results = mysqli_query($con,$sql)	;
                                                                    
                                            if(mysqli_num_rows($results)>0)
                                            {
                                                $_SESSION["email"] = $email;
                                                header('Location:myProducts.php');
                                            }
                                            else
                                            { 
                                                echo "Please enter a correct user name and a
                                                password";
                                            }
                                            echo "Pressed";
                                        }
                                            ?>
                                        </p>
                                        <button type="submit" name="btnsubmit" class="loginButton" >Login</button>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</body>

</html>