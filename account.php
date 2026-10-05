<?php
session_start();
include("connection.php");

// User Login ???
if (!isset($_SESSION['user_id'])) {
    header("Location: regi.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$query = mysqli_query($con, "SELECT * FROM reg WHERE rid='$user_id'");
$user = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>My Account</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial,sans-serif;
}

body{
    background:#f5f5f5;
}

.container{
    width:90%;
    max-width:1000px;
    margin:40px auto;
}

.account-box{
    background:#fff;
    border-radius:15px;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);
    overflow:hidden;
}

.header{
    background:#8B5E3C;
    color:#fff;
    padding:30px;
    text-align:center;
}

.header img{
    width:120px;
    height:120px;
    border-radius:50%;
    border:4px solid white;
    object-fit:cover;
    margin-bottom:10px;
}

.content{
    padding:30px;
}

.info{
    display:grid;
    grid-template-columns:180px 1fr;
    gap:15px;
    margin-bottom:15px;
    border-bottom:1px solid #ddd;
    padding-bottom:10px;
}

.label{
    font-weight:bold;
    color:#555;
}

.value{
    color:#333;
}

.cards{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(200px,1fr));
    gap:20px;
    margin-top:30px;
}

.card{
    background:#fafafa;
    padding:25px;
    text-align:center;
    border-radius:10px;
    box-shadow:0 2px 8px rgba(0,0,0,.1);
    transition:.3s;
}

.card:hover{
    transform:translateY(-5px);
}

.card a{
    text-decoration:none;
    color:#8B5E3C;
    font-weight:bold;
}

.buttons{
    margin-top:30px;
    text-align:center;
}

.btn{
    display:inline-block;
    padding:12px 25px;
    margin:8px;
    text-decoration:none;
    color:white;
    border-radius:5px;
}

.edit{
    background:#0d6efd;
}

.password{
    background:#198754;
}

.logout{
    background:#dc3545;
}

.btn:hover{
    opacity:0.9;
}
</style>

</head>
<body>

<div class="container">

<div class="account-box">

<div class="header">



<img src="images/user.png">

<h2><?php echo $user['name']; ?></h2>

</div>

<div class="content">

<div class="info">
<div class="label">Name</div>
<div class="value"><?php echo $user['name']; ?></div>
</div>

<div class="info">
<div class="label">Email</div>
<div class="value"><?php echo $user['email']; ?></div>
</div>

<div class="info">
<div class="label">phone</div>
<div class="value"><?php echo $user['phone']; ?></div>
</div>

<div class="info">
<div class="label">Address</div>
<div class="value"><?php echo $user['address']; ?></div>
</div>

<div class="cards">

<div class="card">
<h3>?? My Orders</h3>
<br>
<a href="orders.php">View Orders</a>
</div>

<div class="card">
<h3>?? Wishlist</h3>
<br>
<a href="wishlist.php">View Wishlist</a>
</div>

<div class="card">
<h3>?? Address</h3>
<br>
<a href="address.php">Manage Address</a>
</div>

</div>

<div class="buttons">

<a href="edit_profile.php" class="btn edit">Edit Profile</a>

<a href="change_password.php" class="btn password">Change Password</a>

<a href="logout.php" class="btn logout">Logout</a>

</div>

</div>

</div>

</div>

</body>
</html>
