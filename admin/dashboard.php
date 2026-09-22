<?php
session_start();

if(!isset($_SESSION['admin']))
{
    header("Location:login.php");
    exit();
}

include("heder.php");
include("sidebar.php");

include("../connection.php");
// Total Users
$user_sql = "SELECT COUNT(*) AS total_user FROM reg WHERE utype='user'";
$user_result = mysqli_query($con, $user_sql);
$user_row = mysqli_fetch_assoc($user_result);

$total_user = $user_row['total_user'];

// Total Categories
$count_sql = "SELECT COUNT(*) AS total_category FROM category";
$count_result = mysqli_query($con, $count_sql);
$count_row = mysqli_fetch_assoc($count_result);

$total_category = $count_row['total_category'];
// Total Products
$product_sql = "SELECT COUNT(*) AS total_product FROM product";
$product_result = mysqli_query($con, $product_sql);
$product_row = mysqli_fetch_assoc($product_result);

$total_product = $product_row['total_product'];


// Total Cart
$cart_sql = "SELECT COUNT(*) AS total_cart FROM cart";
$cart_result = mysqli_query($con, $cart_sql);
$cart_row = mysqli_fetch_assoc($cart_result);
$total_cart = $cart_row['total_cart'];


// Total Contacts
$contact_sql = "SELECT COUNT(*) AS total_contact FROM contact";
$contact_result = mysqli_query($con, $contact_sql);
$contact_row = mysqli_fetch_assoc($contact_result);

$total_contact = $contact_row['total_contact'];
// Total Orders
$order_sql = "SELECT COUNT(*) AS total_order FROM orders";
$order_result = mysqli_query($con, $order_sql);
$order_row = mysqli_fetch_assoc($order_result);

$total_order = $order_row['total_order'];
?>

<div class="content">

<h1 style="color:#6D4C41;">Welcome, Admin </h1>
<p style="margin-top:8px;color:#555;">
Manage your Woodisty Furniture Store from here.
</p>

<br>

<div style="display:flex;flex-wrap:wrap;gap:20px;">

    <div style="width:220px;background:#ffffff;padding:20px;border-radius:12px;box-shadow:0 4px 12px rgba(0,0,0,.1);border-left:6px solid #8B6B61;">
        <h3> Categories</h3>
	<h1 style="margin-top:10px;color:#6D4C41;">	 <?php echo $total_category; ?></h1>
		
    </div>

    <div style="width:220px;background:#ffffff;padding:20px;border-radius:12px;box-shadow:0 4px 12px rgba(0,0,0,.1);border-left:6px solid #5B7DB1;">
        <h3>Products</h3>
        <h1 style="margin-top:10px;color:#5B7DB1;"> <?php echo $total_product; ?></h1>
    </div>

    <div style="width:220px;background:#ffffff;padding:20px;border-radius:12px;box-shadow:0 4px 12px rgba(0,0,0,.1);border-left:6px solid #4CAF50;">
        <h3> Users</h3>
        <h1 style="margin-top:10px;color:#4CAF50;"><?php echo $total_user; ?></h1>
    </div>

    <div style="width:220px;background:#ffffff;padding:20px;border-radius:12px;box-shadow:0 4px 12px rgba(0,0,0,.1);border-left:6px solid #FF9800;">
        <h3>Orders</h3>
        <h1 style="margin-top:10px;color:#FF9800;">  <?php echo $total_order; ?></h1>
    </div>

    <div style="width:220px;background:#ffffff;padding:20px;border-radius:12px;box-shadow:0 4px 12px rgba(0,0,0,.1);border-left:6px solid #E91E63;">
        <h3>Contacts</h3>
        <h1 style="margin-top:10px;color:#E91E63;"> <?php echo $total_contact; ?> </div></h1>  
    

    <div style="width:220px;background:#ffffff;padding:20px;border-radius:12px;box-shadow:0 4px 12px rgba(0,0,0,.1);border-left:6px solid #9C27B0;">
        <h3>Cart</h3>
        <h1 style="margin-top:10px;color:#9C27B0;"><?php echo $total_cart;?></h1>
    </div>

</div>

<br><br>

<div style="background:#fff;padding:20px;border-radius:12px;box-shadow:0 4px 12px rgba(0,0,0,.1);">

<h3 style="color:#6D4C41;">Quick Actions</h3>

<br>

<a href="category.php" style="background:#8B6B61;color:#fff;text-decoration:none;padding:10px 20px;border-radius:6px;margin-right:10px;">
 Add Category
</a>

<a href="add_product.php" style="background:#5B7DB1;color:#fff;text-decoration:none;padding:10px 20px;border-radius:6px;margin-right:10px;">
 Add Product
</a>

<a href="user.php" style="background:#4CAF50;color:#fff;text-decoration:none;padding:10px 20px;border-radius:6px;">
View Users
</a>

</div>

<br>

<div style="background:#fff;padding:20px;border-radius:12px;box-shadow:0 4px 12px rgba(0,0,0,.1);">

<?php
date_default_timezone_set("Asia/Kolkata");
?>

<p><b> Date :</b> <?php echo date("d-m-Y"); ?></p>

<p><b> Time :</b> <?php echo date("h:i A"); ?></p>

</div>

</div>

</body>
</html>