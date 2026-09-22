<?php
session_start();

include("../connection.php");
include("heder.php");
include("sidebar.php");

/* ================= CART DATA ================= */

$sql = "SELECT 
            cart.cart_id,
            cart.quantity,
            cart.added_at,

            reg.name,
            reg.email,

            product.product_name,
            product.price,
            product.image

        FROM cart

        INNER JOIN reg
        ON cart.user_id = reg.rid

        INNER JOIN product
        ON cart.product_id = product.pid

        ORDER BY cart.added_at DESC";

$result = mysqli_query($con, $sql);

if(!$result)
{
    die("Database Error: " . mysqli_error($con));
}

?>

<style>

/* ================= ADMIN CART ================= */

.cart-page{
    margin-left:250px;
    padding:25px;
    background:#f7f4f1;
    min-height:100vh;
    font-family:Arial,sans-serif;
}

.cart-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:18px;
}

.cart-header h1{
    margin:0;
    color:#6D4C41;
    font-family:Georgia,serif;
    font-size:28px;
    font-weight:normal;
}

.cart-header p{
    margin:4px 0 0;
    color:#777;
    font-size:13px;
}

.cart-count{
    background:#8B6B61;
    color:white;
    padding:8px 14px;
    border-radius:6px;
    font-size:13px;
}

.cart-box{
    background:#fff;
    border-radius:10px;
    padding:12px;
    box-shadow:0 4px 12px rgba(90,62,43,.10);
    overflow-x:auto;
}

.cart-table{
    width:100%;
    border-collapse:collapse;
    min-width:900px;
}

.cart-table th{
    background:#6D4C41;
    color:#fff;
    padding:10px 8px;
    text-align:center;
    font-size:13px;
    font-weight:normal;
}

.cart-table td{
    padding:9px 8px;
    text-align:center;
    border-bottom:1px solid #eee1db;
    color:#555;
    font-size:13px;
}

.cart-table img{
    width:50px;
    height:50px;
    object-fit:cover;
    border-radius:6px;
}

.user-name{
    color:#6D4C41;
    font-weight:bold;
}

.product-name{
    color:#444;
    font-weight:bold;
}

.quantity{
    display:inline-block;
    min-width:28px;
    padding:4px 7px;
    background:#eee1db;
    color:#6D4C41;
    border-radius:4px;
    font-weight:bold;
}

.total-price{
    color:#6D4C41;
    font-weight:bold;
}

.date{
    color:#777;
    font-size:12px;
}
</style>


<div class="cart-page">

<h1> Cart Details</h1>


<?php

if(mysqli_num_rows($result) > 0)
{

?>

<table class="cart-table">

<tr>

<th>Cart ID</th>

<th>User Name</th>

<th>Email</th>

<th>Product</th>

<th>Image</th>

<th>Price</th>

<th>Quantity</th>

<th>Total</th>

<th>Added At</th>

</tr>


<?php

while($row = mysqli_fetch_assoc($result))
{

    $total = $row['price'] * $row['quantity'];

?>

<tr>

<td>
<?php echo $row['cart_id']; ?>
</td>


<td class="user-name">
<?php echo $row['name']; ?>
</td>


<td>
<?php echo $row['email']; ?>
</td>


<td class="product-name">
<?php echo $row['product_name']; ?>
</td>


<td>

<img src="../images/product/<?php echo $row['image']; ?>">

</td>


<td>
<?php echo number_format($row['price'],0); ?>
</td>


<td>
<?php echo $row['quantity']; ?>
</td>


<td class="total-price">
 <?php echo number_format($total,0); ?>
</td>


<td>
<?php echo $row['added_at']; ?>
</td>

</tr>

<?php

}

?>

</table>

<?php

}
else
{

?>

<div class="empty-cart">

<h2>No Cart Data Found</h2>

<p>
No user has added any product to the cart yet.
</p>

</div>

<?php

}

?>

</div>


