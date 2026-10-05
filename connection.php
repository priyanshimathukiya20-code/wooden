<?php
$servername="localhost";
$username="root";
$password="";
$dbname="woodisty";
$con=new mysqli($servername,$username,$password,$dbname);
if($con->connect_error)
{
die("error".$con->connect.error);
}