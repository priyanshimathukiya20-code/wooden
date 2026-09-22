<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>

.sidebar{
    width:240px;
    height:calc(100vh - 70px);
    background:#8B6B61;
    position:fixed;
    left:0;
    top:70px;
    overflow:auto;
}

.sidebar h3{
    color:#fff;
    text-align:center;
    padding:20px 0;
    border-bottom:1px solid rgba(255,255,255,.2);
    font-size:18px;
}

.sidebar a{
    display:block;
    padding:16px 20px;
    text-decoration:none;
    color:#fff;
    font-size:16px;
    transition:.3s;
}

.sidebar a i{
    width:25px;
}

.sidebar a:hover{
    background:#6D4C41;
    padding-left:30px;
}

.content{
    margin-left:240px;
    margin-top:70px;
    padding:30px;
}

</style>

<div class="sidebar">

<h3>MENU</h3>

<a href="dashboard.php">
    <i class="fas fa-house"></i> Dashboard
</a>

<a href="category.php">
    <i class="fas fa-list"></i> Category
</a>
<a href="manage_category.php" class="manage-btn">
    <i class="fas fa-list"></i>
    Manage Categories
</a>
<a href="add_product.php">
    <i class="fas fa-couch"></i> Product
</a>

<a href="manage_product.php">
    <i class="fas fa-couch"></i>  Manage Product
</a>
<a href="user.php">
    <i class="fas fa-users"></i> Users
</a>

<a href="order.php">
    <i class="fas fa-cart-shopping"></i> Orders
</a>

<a href="contact.php">
    <i class="fas fa-envelope"></i> Contact
</a>

<a href="add_cart.php">
    <i class="fas fa-comments"></i> cart
</a>

</div>