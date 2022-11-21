<?php
session_start(); 
if (!isset($_SESSION["email"]))
{
	header('Location:userLogin.php');

}
$con = mysqli_connect("localhost:3308","root","","cakeShopDB");
if(!$con)
{	
    die("Cannot upload the file, Please choose another file");		
}
$sql = "DELETE FROM `cakes` WHERE `cakes`.`id` = ".$_GET["id"];

mysqli_query($con,$sql);	
header('Location:myProducts.php');

?>
