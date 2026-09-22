<!DOCTYPE html>
<html>
<head>
<title>Woodisty Admin Panel</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

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

.header{
    width:100%;
    height:70px;
    background:#6D4C41;
    color:white;
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:0 25px;
    box-shadow:0 3px 10px rgba(0,0,0,.2);
}

.logo{
    display:flex;
    align-items:center;
    gap:12px;
}

.logo i{
    font-size:28px;
}

.logo h2{
    font-size:24px;
    letter-spacing:1px;
}

.right{
    display:flex;
    align-items:center;
    gap:15px;
}

.admin-name{
    font-size:16px;
    font-weight:bold;
}

.header a{
    color:white;
    text-decoration:none;
    background:#8B6B61;
    padding:10px 18px;
    border-radius:6px;
    transition:.3s;
}

.header a:hover{
    background:#5D4037;
}

</style>

</head>
<body>

<div class="header">

    <div class="logo">
	
        <i class="fas fa-couch"></i>
        <h2>WOODISTY ADMIN</h2>
    </div>

    <div class="right">
        <span class="admin-name">
            <i class="fas fa-user-circle"></i> Admin
        </span>

        <a href="logout.php">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </div>

</div>