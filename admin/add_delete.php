<?php

session_start();

if(!isset($_SESSION['admin']))
{
    header("Location:login.php");
    exit();
}

include("../connection.php");

if(isset($_GET['id']))
{
    $id = $_GET['id'];

    mysqli_query($con,"DELETE FROM product WHERE pid='$id'");
}

header("Location:product.php");
exit();

?>