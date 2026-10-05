<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include("connection.php");
include("header.php");

if(!isset($_GET['id']))
{
    die("Product ID Not Found");
}

$id = intval($_GET['id']);

$sql = "SELECT * FROM product WHERE pid='$id'";

$result = mysqli_query($con, $sql);

if(!$result)
{
    die("Database Error: " . mysqli_error($con));
}

if(mysqli_num_rows($result) == 0)
{
    die("Product Not Found");
}

$row = mysqli_fetch_assoc($result);

?>

<style>

/* ===============================
   PRODUCT DETAIL PAGE
================================ */

.product-section{
    width:90%;
    max-width:1200px;
    margin:70px auto 100px;
}


/* Main Box */

.product-container{
    display:flex;
    gap:70px;
    align-items:center;
    background:#f8f5f1;
    padding:45px;
    border-radius:20px;
    box-shadow:0 10px 35px rgba(90,62,43,0.12);
}


/* ===============================
   LEFT IMAGE
================================ */

.product-image{
    flex:1;
    position:relative;
}

.product-image img{
    width:100%;
    max-width:520px;
    height:500px;
    object-fit:cover;
    border-radius:15px;
    display:block;
}


/* Small label over image */

.image-label{
    position:absolute;
    top:20px;
    left:20px;
    background:#ffffff;
    color:#5a3e2b;
    padding:9px 18px;
    border-radius:30px;
    font-size:13px;
    letter-spacing:1px;
    text-transform:uppercase;
    box-shadow:0 4px 12px rgba(0,0,0,0.10);
}


/* ===============================
   RIGHT DETAILS
================================ */

.product-details{
    flex:1;
    padding:10px 15px;
}


/* Small heading */

.product-small-title{
    font-size:13px;
    letter-spacing:3px;
    color:#9b8173;
    text-transform:uppercase;
    margin-bottom:15px;
}


/* Product Name */

.product-details h1{
    font-size:44px;
    line-height:1.15;
    color:#4d3527;
    margin:0 0 20px;
    font-weight:500;
}


/* Price */

.price{
    font-size:29px;
    color:#8B6B61;
    font-weight:bold;
    margin-bottom:25px;
}


/* Line */

.detail-line{
    width:70px;
    height:3px;
    background:#8B6B61;
    margin-bottom:25px;
}


/* Description */

.product-details p{
    line-height:30px;
    color:#666;
    font-size:16px;
    margin-bottom:30px;
    max-width:500px;
}


/* Product information */

.product-info{
    display:flex;
    gap:35px;
    margin-bottom:30px;
}

.info-item{
    color:#777;
    font-size:14px;
}

.info-item strong{
    display:block;
    color:#5a3e2b;
    font-size:15px;
    margin-bottom:5px;
}


/* ===============================
   ADD TO CART
================================ */

.cart-area{
    display:flex;
    align-items:center;
    gap:15px;
}


/* Quantity */

.quantity-box{
    width:55px;
    height:48px;
    border:1px solid #d6cbc4;
    background:white;
    border-radius:5px;
    display:flex;
    justify-content:center;
    align-items:center;
    color:#5a3e2b;
    font-weight:bold;
}


/* Add Cart Button */

.add-cart-btn{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    min-width:190px;
    height:48px;
    background:#5a3e2b;
    color:white;
    text-decoration:none;
    border-radius:5px;
    font-size:15px;
    letter-spacing:1px;
    transition:0.3s;
}

.add-cart-btn:hover{
    background:#8B6B61;
    color:white;
    transform:translateY(-2px);
}


/* Back Button */

.back-shop{
    display:inline-block;
    margin-top:25px;
    color:#7b665a;
    text-decoration:none;
    font-size:14px;
    border-bottom:1px solid #b9aaa1;
    padding-bottom:3px;
}

.back-shop:hover{
    color:#5a3e2b;
}


/* ===============================
   RESPONSIVE
================================ */

@media(max-width:900px){

    .product-container{
        flex-direction:column;
        padding:25px;
        gap:35px;
    }

    .product-image,
    .product-details{
        width:100%;
    }

    .product-image img{
        max-width:100%;
        height:400px;
    }

    .product-details h1{
        font-size:35px;
    }

}

</style>


<section class="product-section">

    <div class="product-container">


        <!-- =========================
             PRODUCT IMAGE
        ========================== -->

        <div class="product-image">

            <div class="image-label">
                Woodisty Collection
            </div>

            <?php

            if(isset($_GET['image']) && !empty($_GET['image']))
            {
                $product_image = $_GET['image'];
            }
            else
            {
                $product_image = $row['image'];
            }

            ?>

            <img
                src="images/<?php echo htmlspecialchars($product_image); ?>"
                alt="<?php echo htmlspecialchars($row['product_name']); ?>"
            >

        </div>



        <!-- =========================
             PRODUCT DETAILS
        ========================== -->

        <div class="product-details">

           

            <h1>
                <?php echo htmlspecialchars($row['product_name']); ?>
            </h1>


            <div class="price">
                RS. <?php echo number_format($row['price'], 0); ?>
            </div>


            <div class="detail-line"></div>


            <p>
                <?php echo nl2br(htmlspecialchars($row['description'])); ?>
            </p>


            <!-- Extra Information -->

            <div class="product-info">

                <div class="info-item">
                    <strong>Material</strong>
                    Premium Wood
                </div>

                <div class="info-item">
                    <strong>Quality</strong>
                    Premium
                </div>

                <div class="info-item">
                    <strong>Delivery</strong>
                    Available
                </div>

            </div>


           

<div>
                <a
                    href="cart.php?id=<?php echo $row['pid']; ?>"
                    class="add-cart-btn"
                >
                    Add To Cart
                </a>

            </div>

<div>

            <a href="index.php" class="back-shop">
                 Continue Shopping
            </a>

        </div>

    </div>

</section>


<?php include("footer.php"); ?>