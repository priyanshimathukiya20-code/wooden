<?php

session_start();

if(!isset($_SESSION['admin']))
{
    header("Location:login.php");
    exit();
}

include("../connection.php");

include("heder.php");
include("sidebar.php");


/* =====================================================
   POPUP MESSAGE
   ===================================================== */

$show_success = false;
$success_message = "";

if(isset($_SESSION['product_success']))
{
    $show_success = true;

    $success_message = $_SESSION['product_success'];

    unset($_SESSION['product_success']);
}

?>

<style>

/* =====================================================
   MAIN CONTENT
   ===================================================== */

.content{
    margin-left:240px;
    margin-top:70px;
    padding:35px;
    background:#f7f4f1;
    min-height:calc(100vh - 70px);
}


/* =====================================================
   PAGE HEADER
   ===================================================== */

.page-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:25px;
}

.page-header h2{
    margin:0;
    color:#5a3e2b;
    font-size:28px;
}


/* =====================================================
   ADD BUTTON
   ===================================================== */

.add-btn{
    background:#8B6B61;
    color:white;
    padding:11px 20px;
    text-decoration:none;
    border-radius:7px;
    font-weight:bold;
    transition:.3s;
}

.add-btn:hover{
    background:#6D4C41;
}


/* =====================================================
   PRODUCT TABLE BOX
   ===================================================== */

.product-table-box{
    background:white;
    padding:20px;
    border-radius:14px;
    box-shadow:0 5px 20px rgba(90,62,43,.12);
    overflow-x:auto;
}


/* =====================================================
   PRODUCT TABLE
   ===================================================== */

.product-table{
    width:100%;
    border-collapse:separate;
    border-spacing:0;
}


/* =====================================================
   TABLE HEADER
   ===================================================== */

.product-table th{
    background:#8B6B61;
    color:white;
    padding:15px 12px;
    text-align:left;
    font-size:14px;
    letter-spacing:.3px;
}

.product-table th:last-child{
    text-align:center;
    width:190px;
}

.product-table th:first-child{
    border-top-left-radius:8px;
}

.product-table th:last-child{
    border-top-right-radius:8px;
}


/* =====================================================
   TABLE DATA
   ===================================================== */

.product-table td{
    padding:14px 12px;
    border-bottom:1px solid #eee;
    color:#444;
    vertical-align:middle;
}

.product-table tr:hover td{
    background:#faf6f3;
}


/* =====================================================
   PRODUCT IMAGE
   ===================================================== */

.product-img{
    width:80px;
    height:65px;
    object-fit:cover;
    border-radius:9px;
    box-shadow:0 2px 8px rgba(0,0,0,.12);
}


/* =====================================================
   PRODUCT NAME
   ===================================================== */

.product-name{
    font-weight:bold;
    color:#5a3e2b;
}


/* =====================================================
   PRICE
   ===================================================== */

.price{
    color:#b22222;
    font-weight:bold;
    white-space:nowrap;
}


/* =====================================================
   DESCRIPTION
   ===================================================== */

.description{
    max-width:280px;
    line-height:20px;
    color:#666;
}


/* =====================================================
   UPDATE + DELETE BUTTON
   ===================================================== */

.update-btn,
.delete-btn{
    display:inline-flex;
    align-items:center;
    gap:5px;
    padding:8px 12px;
    color:white;
    text-decoration:none;
    border-radius:6px;
    font-size:13px;
    font-weight:500;
    margin-right:5px;
}


/* =====================================================
   UPDATE
   ===================================================== */

.update-btn{
    background:#8B6B61;
}

.update-btn:hover{
    background:#6D4C41;
}


/* =====================================================
   DELETE
   ===================================================== */

.delete-btn{
    background:#B07A6A;
}

.delete-btn:hover{
    background:#8B5E50;
}


/* =====================================================
   NO PRODUCT
   ===================================================== */

.no-product{
    text-align:center;
    padding:40px;
    color:#777;
    font-size:18px;
}


/* =====================================================
   SUCCESS POPUP
   ===================================================== */

.popup-overlay{
    position:fixed;

    top:0;
    left:0;

    width:100%;
    height:100%;

    background:rgba(55,40,30,.55);

    display:flex;

    align-items:center;
    justify-content:center;

    z-index:999999;
}


.popup-box{
    width:390px;

    max-width:90%;

    background:#fff;

    padding:35px 30px;

    text-align:center;

    border-radius:16px;

    border:1px solid #e2d2c0;

    box-shadow:
        0 15px 45px rgba(90,62,43,.25);

    animation:popupShow .3s ease;
}


.popup-icon{
    width:65px;
    height:65px;

    margin:0 auto 18px;

    border-radius:50%;

    background:#f5ecdf;

    border:2px solid #8b5e34;

    display:flex;

    align-items:center;
    justify-content:center;

    box-sizing:border-box;
}


.popup-icon i{
    font-size:28px;

    color:#8b5e34;

    line-height:1;
}


.popup-box h2{
    margin:0 0 10px;

    color:#5a3e2b;

    font-family:Georgia,serif;

    font-size:27px;

    font-weight:normal;
}


.popup-box p{
    margin:0 0 25px;

    color:#777;

    font-size:14px;

    line-height:1.6;
}


.popup-box button{
    width:120px;

    padding:11px 20px;

    background:#8b5e34;

    color:#fff;

    border:none;

    border-radius:7px;

    font-size:15px;

    cursor:pointer;

    transition:.3s;
}


.popup-box button:hover{
    background:#6d4c41;

    transform:translateY(-2px);

    box-shadow:
        0 5px 12px rgba(90,62,43,.18);
}


@keyframes popupShow{

    from{
        opacity:0;
        transform:scale(.85);
    }

    to{
        opacity:1;
        transform:scale(1);
    }

}


/* =====================================================
   RESPONSIVE
   ===================================================== */

@media(max-width:900px){

    .content{
        margin-left:240px;
        padding:20px;
    }

    .page-header{
        flex-direction:column;
        align-items:flex-start;
        gap:15px;
    }

}

</style>


<div class="content">


<div class="page-header">

    <h2>

        <i class="fas fa-couch"></i>

        Manage Products

    </h2>


    <a href="add_product.php" class="add-btn">

        <i class="fas fa-plus"></i>

        Add Product

    </a>

</div>


<div class="product-table-box">


<table class="product-table">


<tr>

    <th>ID</th>

    <th>Image</th>

    <th>Product Name</th>

    <th>Price</th>

    <th>Description</th>

    <th style="text-align:center; width:190px;">

        Action

    </th>

</tr>


<?php

$result = mysqli_query(

    $con,

    "SELECT *
     FROM product
     ORDER BY pid ASC"

);


if(!$result)
{
    die(
        "Product Query Error : "
        . mysqli_error($con)
    );
}


if(mysqli_num_rows($result) > 0)
{

    while($row = mysqli_fetch_assoc($result))
    {

?>

<tr>


<!-- =================================================
     ID
     ================================================= -->

<td>

    <?php

    echo $row['pid'];

    ?>

</td>


<!-- =================================================
     IMAGE
     ================================================= -->

<td>

    <img

        class="product-img"

        src="../images/product/<?php echo $row['image']; ?>"

        alt="<?php echo htmlspecialchars($row['product_name']); ?>"

    >

</td>


<!-- =================================================
     PRODUCT NAME
     ================================================= -->

<td class="product-name">

    <?php

    echo htmlspecialchars(
        $row['product_name']
    );

    ?>

</td>


<!-- =================================================
     PRICE
     ================================================= -->

<td class="price">

    RS.

    <?php

    echo number_format(
        $row['price'],
        0
    );

    ?>

</td>


<!-- =================================================
     DESCRIPTION
     ================================================= -->

<td class="description">

    <?php

    echo htmlspecialchars(
        $row['description']
    );

    ?>

</td>


<!-- =================================================
     ACTION
     ================================================= -->

<td style="white-space:nowrap;">


    <!-- UPDATE -->

    <a

        href="edit_product.php?id=<?php echo $row['pid']; ?>"

        class="update-btn"

    >

        <i class="fas fa-pen"></i>

        Update

    </a>


    <!-- DELETE -->

    <a

        href="delete_product.php?id=<?php echo $row['pid']; ?>"

        class="delete-btn"

        onclick="return confirm('Are you sure you want to delete this product?');"

    >

        <i class="fas fa-trash"></i>

        Delete

    </a>


</td>


</tr>


<?php

    }

}

else

{

?>


<tr>

    <td
        colspan="6"
        class="no-product"
    >

        <i class="fas fa-box-open"></i>

        <br><br>

        No Products Found

    </td>

</tr>


<?php

}

?>


</table>


</div>


</div>


<!-- =====================================================
     SUCCESS POPUP
     ===================================================== -->

<?php if($show_success){ ?>

<div class="popup-overlay">

    <div class="popup-box">


        <div class="popup-icon">

            <i class="fas fa-check"></i>

        </div>


        <h2>

            Success!

        </h2>


        <p>

            <?php

            echo htmlspecialchars(
                $success_message
            );

            ?>

        </p>


        <button
            type="button"
            onclick="window.location='manage_product.php'"
        >

            OK

        </button>


    </div>

</div>

<?php } ?>


</body>

</html>