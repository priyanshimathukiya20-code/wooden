<?php
session_start();
include("../connection.php");

if(isset($_POST['login']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM reg WHERE email='$email' AND pwd='$password' AND utype='admin'";
    $result = mysqli_query($con,$sql);

    if(mysqli_num_rows($result)>0)
    {
        $_SESSION['admin']=$email;
        header("Location: dashboard.php");
        exit();
    }
    else
    {
        echo "<script>alert('Invalid email or Password');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Woodisty Admin Login</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial, Helvetica, sans-serif;
}

body{
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:linear-gradient(135deg,#f5efe6,#d6ccc2,#b7a99a);
}
.login-box{

    width:380px;
    background:#fff;
    padding:35px;
    border-radius:15px;
    box-shadow:0px 10px 30px rgba(0,0,0,.3);

}

.login-box h2{

    text-align:center;
    margin-bottom:30px;
    color:#5d4037;

}

input{

    width:100%;
    padding:12px;
    margin-top:8px;
    margin-bottom:20px;
    border:1px solid #ccc;
    border-radius:8px;
    outline:none;
    font-size:15px;

}

input:focus{

    border:1px solid #8d6e63;

}

button{
    width:100%;
    padding:12px;
    border:none;
    background:#8B6B61;   /* Button Color */
    color:white;
    font-size:17px;
    font-weight:bold;
    border-radius:8px;
    cursor:pointer;
    transition:0.3s;
    box-shadow:0 4px 10px rgba(0,0,0,0.2);
}

button:hover{
    background:#6D4C41;   /* Hover Color */
    transform:translateY(-2px);
}
.logo{

    text-align:center;
    font-size:35px;
    margin-bottom:10px;

}

</style>

</head>

<body>

<div class="login-box">

<div class="logo"><img src="../images/logo.png" height="120px;" width="220px;"></div>

<h2>Woodisty Admin</h2>

<form method="POST">

<label>Username</label>

<input type="text" name="email" placeholder="Enter email" required>

<label>Password</label>

<input type="password" name="password" placeholder="Enter Password" required>

<button type="submit" name="login">Login</button>

</form>

</div>

</body>
</html>