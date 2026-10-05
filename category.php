<?php

include("connection.php");
include("header.php");


/* =========================
   CATEGORY ID
========================= */

if(isset($_GET['id']))
{
    $id = intval($_GET['id']);
}
else
{
    die("Category Not Found");
}


/* =========================
   CATEGORY DATA
========================= */

$cat = mysqli_query(
    $con,
    "SELECT * FROM category WHERE id='$id'"
);

$category = mysqli_fetch_assoc($cat);


if(!$category)
{
    die("Category Not Found");
}


/* =========================
   PRODUCT DATA
========================= */

$product = mysqli_query(
    $con,
    "SELECT * FROM product WHERE category_id='$id'"
);

?>

<style>

/* =========================
   PAGE
========================= */

body{
    background:#f8f8f8;
}


/* =========================
   BANNER
========================= */

.banner{

    background:#5a3e2b;

    color:white;

    text-align:center;

    padding:60px 20px;

}


.banner h1{

    font-size:45px;

    margin:0;

    font-family:Georgia,serif;

    font-weight:normal;

}


/* =========================
   PRODUCT SECTION
========================= */

.product-section{

    width:90%;

    max-width:1200px;

    margin:50px auto;

}


/* =========================
   PRODUCT GRID
   4 PRODUCTS IN ONE ROW
========================= */

.product-box{

    display:grid;

    grid-template-columns:repeat(4,1fr);

    gap:30px;

    align-items:stretch;

}


/* =========================
   PRODUCT CARD
========================= */

.card{

    background:white;

    border-radius:10px;

    overflow:hidden;

    box-shadow:
    0 5px 15px rgba(0,0,0,.10);

    text-align:center;

    transition:.4s;

    display:flex;

    flex-direction:column;

    min-height:470px;

}


.card:hover{

    transform:translateY(-8px);

    box-shadow:
    0 10px 25px rgba(90,62,43,.18);

}


/* =========================
   PRODUCT IMAGE
========================= */

.card img{

    width:100%;

    height:250px;

    object-fit:cover;

    display:block;

}


/* =========================
   PRODUCT NAME
========================= */

.card h3{

    margin:18px 15px 8px;

    color:#333;

    font-size:21px;

    line-height:1.25;

    min-height:55px;

    display:flex;

    align-items:center;

    justify-content:center;

}


/* =========================
   PRICE
========================= */

.card p{

    color:#5a3e2b;

    font-weight:bold;

    font-size:18px;

    margin:0 0 15px;

}


/* =========================
   VIEW PRODUCT BUTTON
========================= */

.card a{

    display:flex;

    align-items:center;

    justify-content:center;

    width:calc(100% - 40px);

    height:46px;

    margin:auto 20px 20px;

    padding:0;

    box-sizing:border-box;

    background:#5a3e2b;

    color:white;

    text-decoration:none;

    border-radius:5px;

    font-size:16px;

    transition:.3s;

}


.card a:hover{

    background:#3f2a1d;

}


/* =========================
   NO PRODUCT
========================= */

.no-product{

    grid-column:1/-1;

    text-align:center;

    background:white;

    padding:50px;

    border-radius:10px;

    color:#777;

    font-size:18px;

}


/* =========================
   RESPONSIVE
========================= */

/* TABLET */

@media(max-width:1000px){

    .product-box{

        grid-template-columns:repeat(2,1fr);

    }

}


/* MOBILE */

@media(max-width:600px){

    .product-section{

        width:92%;

        margin:35px auto;

    }


    .product-box{

        grid-template-columns:1fr;

    }


    .card{

        min-height:460px;

    }


    .banner{

        padding:45px 15px;

    }


    .banner h1{

        font-size:35px;

    }

}

</style>


<!-- =========================
     CATEGORY BANNER
========================= -->

<section class="banner">

    <h1>

        <?php

        echo htmlspecialchars(
            $category['category_name']
        );

        ?>

    </h1>

</section>


<!-- =========================
     PRODUCT SECTION
========================= -->

<section class="product-section">


    <div class="product-box">


<?php

if(mysqli_num_rows($product) > 0)
{

    while($row = mysqli_fetch_assoc($product))
    {

?>


        <!-- =====================
             PRODUCT CARD
        ====================== -->

        <div class="card">


            <!-- PRODUCT IMAGE -->

            <img
                src="images/product/<?php echo htmlspecialchars($row['image']); ?>"
                alt="<?php echo htmlspecialchars($row['product_name']); ?>"
            >


            <!-- PRODUCT NAME -->

            <h3>

                <?php

                echo htmlspecialchars(
                    $row['product_name']
                );

                ?>

            </h3>


            <!-- PRODUCT PRICE -->

            <p>

                <?php

                echo number_format(
                    $row['price'],
                    0
                );

                ?>

            </p>


            <!-- VIEW PRODUCT BUTTON -->

            <a
                href="product_detail.php?id=<?php echo $row['pid']; ?>"
            >

                View Product

            </a>


        </div>


<?php

    }

}
else
{

?>


        <!-- NO PRODUCT -->

        <div class="no-product">

            No Products Available In This Category.

        </div>


<?php

}

?>


    </div>


</section>


<?php

include("footer.php");

?>