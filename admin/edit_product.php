<?php

session_start();

if(!isset($_SESSION['admin']))
{
    header("Location:login.php");
    exit();
}

include("../connection.php");


/* ================= UPDATE PRODUCT ================= */

if(!isset($_GET['id']))
{
    die("Product Not Found");
}

$id = intval($_GET['id']);


/* ================= GET PRODUCT ================= */

$result = mysqli_query(
    $con,
    "SELECT * FROM product WHERE pid='$id'"
);

$product = mysqli_fetch_assoc($result);

if(!$product)
{
    die("Product Not Found");
}


/* ================= UPDATE PRODUCT ================= */

if(isset($_POST['update']))
{

    $category_id =
        mysqli_real_escape_string(
            $con,
            $_POST['category_id']
        );

    $product_name =
        mysqli_real_escape_string(
            $con,
            $_POST['product_name']
        );

    $price =
        mysqli_real_escape_string(
            $con,
            $_POST['price']
        );

    $description =
        mysqli_real_escape_string(
            $con,
            $_POST['description']
        );


    /* ================= NEW IMAGE ================= */

    if(
        isset($_FILES['image']) &&
        $_FILES['image']['name'] != ""
    )
    {

        $image =
            $_FILES['image']['name'];

        $tmp =
            $_FILES['image']['tmp_name'];


        move_uploaded_file(
            $tmp,
            "../images/product/".$image
        );


        $sql = "
            UPDATE product SET

                category_id='$category_id',

                product_name='$product_name',

                price='$price',

                description='$description',

                image='$image'

            WHERE pid='$id'
        ";

    }
    else
    {

        $sql = "
            UPDATE product SET

                category_id='$category_id',

                product_name='$product_name',

                price='$price',

                description='$description'

            WHERE pid='$id'
        ";

    }


    /* ================= EXECUTE UPDATE ================= */

    if(mysqli_query($con,$sql))
    {
        $success = true;
    }
    else
    {
        $error = mysqli_error($con);
    }

}


include("heder.php");
include("sidebar.php");

?>


<style>

/* =====================================================
   CONTENT
===================================================== */

.content{

    margin-left:240px;

    margin-top:70px;

    padding:35px;

    background:#f7f4f1;

    min-height:calc(100vh - 70px);

}


/* =====================================================
   FORM
===================================================== */

.update-form{

    background:#fff;

    padding:25px;

    border-radius:12px;

    box-shadow:
        0 5px 20px
        rgba(90,62,43,.12);

    width:500px;

}


.update-form label{

    color:#5a3e2b;

    font-weight:bold;

}


.update-form input,
.update-form textarea{

    width:100%;

    padding:11px;

    border:1px solid #ccc;

    border-radius:6px;

    outline:none;

    box-sizing:border-box;

    font-family:Arial,sans-serif;

}


.update-form input:focus,
.update-form textarea:focus{

    border-color:#8b5e34;

    box-shadow:
        0 0 0 2px
        rgba(139,94,52,.10);

}


.update-form textarea{

    height:110px;

    resize:none;

}


/* =====================================================
   UPDATE BUTTON
===================================================== */

.update-btn{

    background:#8b5e34;

    color:white;

    border:none;

    padding:11px 22px;

    border-radius:6px;

    cursor:pointer;

    font-weight:bold;

    transition:.3s;

}


.update-btn:hover{

    background:#6d4c41;

    transform:translateY(-1px);

}


/* =====================================================
   SUCCESS POPUP
   WOODISTY BROWN + CREAM
===================================================== */

.success-popup{

    position:fixed;

    top:0;

    left:0;

    width:100%;

    height:100%;

    background:rgba(55,40,30,.55);

    display:flex;

    justify-content:center;

    align-items:center;

    z-index:999999;

}


/* =====================================================
   SUCCESS BOX
===================================================== */

.success-box{

    width:390px;

    max-width:90%;

    background:#fffdfb;

    padding:35px 30px;

    border-radius:16px;

    text-align:center;

    border:1px solid #e2d2c0;

    box-shadow:
        0 15px 45px
        rgba(90,62,43,.25);

    animation:popupShow .3s ease;

}


/* =====================================================
   CHECK ICON CIRCLE
===================================================== */

.success-icon{

    width:65px;

    height:65px;

    margin:0 auto 18px;

    background:#f5ecdf;

    color:#8b5e34;

    border:2px solid #8b5e34;

    border-radius:50%;

    display:flex;

    align-items:center;

    justify-content:center;

    box-sizing:border-box;

}


.success-icon i{

    font-size:28px;

    color:#8b5e34;

    line-height:1;

}


/* =====================================================
   POPUP TITLE
===================================================== */

.success-box h2{

    color:#5a3e2b;

    margin:0 0 10px;

    font-family:Georgia,serif;

    font-size:27px;

    font-weight:normal;

}


/* =====================================================
   POPUP TEXT
===================================================== */

.success-box p{

    color:#6f625b;

    margin:0 0 25px;

    font-size:14px;

    line-height:1.6;

}


/* =====================================================
   OK BUTTON
===================================================== */

.success-ok{

    width:120px;

    background:#8b5e34;

    color:white;

    border:none;

    padding:11px 20px;

    border-radius:7px;

    cursor:pointer;

    font-size:15px;

    transition:.3s;

}


.success-ok:hover{

    background:#6d4c41;

    transform:translateY(-2px);

    box-shadow:
        0 5px 12px
        rgba(90,62,43,.18);

}


/* =====================================================
   POPUP ANIMATION
===================================================== */

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
   ERROR POPUP
===================================================== */

.error-popup .success-icon{

    background:#f8eeee;

    border-color:#a94442;

}


.error-popup .success-icon i{

    color:#a94442;

}


.error-popup h2{

    color:#8b3027;

}


/* =====================================================
   MOBILE
===================================================== */

@media(max-width:700px){

    .content{

        margin-left:0;

        margin-top:70px;

        padding:20px;

    }


    .update-form{

        width:100%;

    }

}

</style>


<div class="content">


    <!-- =========================
         PAGE TITLE
    ========================= -->

    <h2 style="color:#6D4C41;">

        <i class="fas fa-pen"></i>

        Update Product

    </h2>


    <br>


    <!-- =========================
         UPDATE FORM
    ========================= -->

    <form
        method="POST"
        enctype="multipart/form-data"
        class="update-form"
    >


        <!-- CATEGORY ID -->

        <label>
            Category ID
        </label>

        <br><br>

        <input
            type="text"
            name="category_id"
            value="<?php
                echo htmlspecialchars(
                    $product['category_id']
                );
            ?>"
            required
        >

        <br><br>


        <!-- PRODUCT NAME -->

        <label>
            Product Name
        </label>

        <br><br>

        <input
            type="text"
            name="product_name"
            value="<?php
                echo htmlspecialchars(
                    $product['product_name']
                );
            ?>"
            required
        >

        <br><br>


        <!-- PRICE -->

        <label>
            Price
        </label>

        <br><br>

        <input
            type="number"
            step="0.01"
            name="price"
            value="<?php
                echo htmlspecialchars(
                    $product['price']
                );
            ?>"
            required
        >

        <br><br>


        <!-- DESCRIPTION -->

        <label>
            Description
        </label>

        <br><br>

        <textarea
            name="description"
            required
        ><?php
            echo htmlspecialchars(
                $product['description']
            );
        ?></textarea>

        <br><br>


        <!-- CURRENT IMAGE -->

        <label>
            Current Image
        </label>

        <br><br>

        <img
            src="../images/product/<?php
                echo htmlspecialchars(
                    $product['image']
                );
            ?>"
            width="150"
            style="
                border-radius:8px;
                border:1px solid #dfd2c9;
                padding:4px;
                background:#fff;
            "
        >

        <br><br>


        <!-- CHANGE IMAGE -->

        <label>
            Change Image
        </label>

        <br><br>

        <input
            type="file"
            name="image"
            accept="image/*"
        >

        <br><br>


        <!-- UPDATE BUTTON -->

        <button
            type="submit"
            name="update"
            class="update-btn"
        >

            Update Product

        </button>


    </form>


</div>


<?php

/* =====================================================
   SUCCESS POPUP
===================================================== */

if(isset($success) && $success == true)
{

?>

<div class="success-popup">

    <div class="success-box">


        <!-- CHECK ICON -->

        <div class="success-icon">

            <i class="fas fa-check"></i>

        </div>


        <!-- TITLE -->

        <h2>

            Product Updated Successfully!

        </h2>


        <!-- MESSAGE -->

        <p>

            Your product details have been
            updated successfully.

        </p>


        <!-- OK -->

        <button
            type="button"
            class="success-ok"
            onclick="goToProducts()"
        >

            OK

        </button>


    </div>

</div>


<script>

function goToProducts()
{
    window.location.href =
        "manage_product.php";
}

</script>

<?php

}

?>


<?php

/* =====================================================
   ERROR POPUP
===================================================== */

if(isset($error))
{

?>

<div class="success-popup">

    <div class="success-box error-popup">


        <div class="success-icon">

            <i class="fas fa-times"></i>

        </div>


        <h2>

            Update Failed

        </h2>


        <p>

            Product could not be updated.
            Please try again.

        </p>


        <button
            type="button"
            class="success-ok"
            onclick="window.location='edit_product.php?id=<?php echo $id; ?>'"
        >

            OK

        </button>


    </div>

</div>

<?php

}

?>


</body>

</html>