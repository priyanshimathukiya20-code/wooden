<?php

include("connection.php");
include("header.php");

?>

<style>

.search-page{
    width:90%;
    margin:50px auto;
}

.search-page h2{
    color:#5a3e2b;
    font-family:Georgia,serif;
    margin-bottom:30px;
}

.search-products{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:25px;
}

.search-product{
    background:#fff;
    border-radius:10px;
    padding:15px;
    box-shadow:0 5px 15px rgba(0,0,0,.1);
}

.search-product img{
    width:100%;
    height:220px;
    object-fit:cover;
    border-radius:8px;
}

.search-product h3{
    color:#5a3e2b;
    margin:12px 0 8px;
}

.search-product p{
    color:#777;
}

.search-price{
    color:#b22222;
    font-weight:bold;
    margin-top:8px;
}

.no-result{
    text-align:center;
    color:#777;
    font-size:18px;
}

@media(max-width:900px){

    .search-products{
        grid-template-columns:repeat(2,1fr);
    }

}

@media(max-width:600px){

    .search-products{
        grid-template-columns:1fr;
    }

}

</style>


<div class="search-page">

<?php

if(isset($_GET['search']) && $_GET['search'] != "")
{

    $search = mysqli_real_escape_string($con,$_GET['search']);

    echo "<h2>Search Result For: ".$search."</h2>";

    $sql = "SELECT * FROM product
            WHERE product_name LIKE '%$search%'
            ORDER BY pid DESC";

    $result = mysqli_query($con,$sql);

    if(mysqli_num_rows($result) > 0)
    {

?>

<div class="search-products">

<?php

while($row = mysqli_fetch_assoc($result))
{

?>

<div class="search-product">

<img src="images/product/<?php echo $row['image']; ?>">

<h3>
<?php echo $row['product_name']; ?>
</h3>

<p>
<?php echo $row['description']; ?>
</p>

<div class="search-price">
Rs. <?php echo $row['price']; ?>
</div>

</div>

<?php

}

?>

</div>

<?php

}
else
{

?>

<div class="no-result">

No Product Found.

</div>

<?php

}

}
else
{

?>

<h2>Search Products</h2>

<div class="no-result">

Please enter a product name in the search box.

</div>

<?php

}

?>

</div>


<?php include("footer.php"); ?>