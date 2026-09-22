<?php

session_start();

if(!isset($_SESSION['admin']))
{
    header("Location:login.php");
    exit();
}

include("../connection.php");


/* =========================
   GET CATEGORY ID
========================= */

if(!isset($_GET['id']) || empty($_GET['id']))
{
    header("Location:manage_category.php");
    exit();
}

$id = intval($_GET['id']);


/* =========================
   GET CATEGORY DATA
========================= */

$sql = "SELECT * FROM category WHERE id='$id'";

$result = mysqli_query($con, $sql);

if(mysqli_num_rows($result) == 0)
{
    echo "<script>
            alert('Category Not Found');
            window.location='manage_category.php';
          </script>";
    exit();
}

$row = mysqli_fetch_assoc($result);


/* =========================
   POPUP VARIABLES
========================= */

$show_success = false;
$show_error   = false;

$success_message = "";
$error_message   = "";


/* =========================
   UPDATE CATEGORY
========================= */

if(isset($_POST['update_category']))
{

    $category_name = mysqli_real_escape_string(
        $con,
        $_POST['category_name']
    );


    $old_image = $row['category_image'];


    /* =========================
       NEW IMAGE
    ========================= */

    if(
        isset($_FILES['category_image']) &&
        $_FILES['category_image']['name'] != ""
    )
    {

        $image_name =
            $_FILES['category_image']['name'];

        $tmp_name =
            $_FILES['category_image']['tmp_name'];


        $upload_path =
            "../images/cetegory/"
            . $image_name;


        if(move_uploaded_file(
            $tmp_name,
            $upload_path
        ))
        {

            /* DELETE OLD IMAGE */

            if(
                $old_image != "" &&
                file_exists(
                    "../images/cetegory/"
                    . $old_image
                )
            )
            {
                unlink(
                    "../images/cetegory/"
                    . $old_image
                );
            }


            $update_sql = "
                UPDATE category
                SET
                    category_name='$category_name',
                    category_image='$image_name'
                WHERE id='$id'
            ";

        }
        else
        {

            $show_error = true;

            $error_message =
                "Image Upload Failed";

            $update_sql = "";

        }

    }
    else
    {

        /* =========================
           UPDATE WITHOUT IMAGE
        ========================= */

        $update_sql = "
            UPDATE category
            SET
                category_name='$category_name'
            WHERE id='$id'
        ";

    }


    /* =========================
       EXECUTE UPDATE
    ========================= */

    if($update_sql != "")
    {

        if(mysqli_query($con, $update_sql))
        {

            /*
             * SUCCESS POPUP
             */

            $show_success = true;

            $success_message =
                "Category Updated Successfully";

        }
        else
        {

            $show_error = true;

            $error_message =
                "Category Update Failed";

        }

    }

}


include("heder.php");
include("sidebar.php");

?>


<!DOCTYPE html>

<html>

<head>

<title>Edit Category - Woodisty</title>


<!-- FONT AWESOME -->

<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
>


<style>


/* =====================================================
   PAGE
===================================================== */

body{

    margin:0;

    background:#f7f4f2;

    font-family:Arial,sans-serif;

}


/* =====================================================
   CONTENT
===================================================== */

.content{

    margin-left:240px;

    margin-top:70px;

    padding:35px;

    min-height:calc(100vh - 70px);

    background:#f7f4f2;

}


/* =====================================================
   TITLE
===================================================== */

.page-title{

    color:#6D4C41;

    font-size:26px;

    margin:0 0 20px 0;

    font-weight:bold;

}

.page-title i{

    margin-right:8px;

}


/* =====================================================
   FORM CARD
===================================================== */

.form-card{

    width:500px;

    max-width:100%;

    background:#ffffff;

    padding:25px;

    border-radius:12px;

    box-shadow:
        0 5px 20px
        rgba(0,0,0,.10);

}


/* =====================================================
   LABEL
===================================================== */

.form-card label{

    display:block;

    margin-bottom:8px;

    color:#5a3724;

    font-size:15px;

    font-weight:bold;

}


/* =====================================================
   TEXT INPUT
===================================================== */

.form-card input[type="text"]{

    width:100%;

    height:40px;

    padding:0 12px;

    border:1px solid #ccc;

    border-radius:6px;

    font-size:14px;

    margin-bottom:18px;

    box-sizing:border-box;

    outline:none;

}


.form-card input[type="text"]:focus{

    border-color:#8B6B61;

    box-shadow:
        0 0 0 2px
        rgba(139,107,97,.10);

}


/* =====================================================
   FILE INPUT
===================================================== */

.form-card input[type="file"]{

    width:100%;

    padding:10px;

    border:1px solid #ccc;

    border-radius:6px;

    margin-bottom:10px;

    box-sizing:border-box;

    background:#fafafa;

}


/* =====================================================
   BUTTON AREA
===================================================== */

.button-area{

    display:flex;

    gap:10px;

    margin-top:8px;

}


/* =====================================================
   UPDATE BUTTON
===================================================== */

.update-btn{

    background:#6D4C41;

    color:#fff;

    border:none;

    padding:11px 22px;

    border-radius:6px;

    font-size:14px;

    cursor:pointer;

    text-decoration:none;

    transition:.3s;

}


.update-btn:hover{

    background:#51382f;

}


/* =====================================================
   POPUP OVERLAY
===================================================== */

.success-popup{

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


/* =====================================================
   POPUP BOX
===================================================== */

.success-box{

    width:380px;

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
   POPUP ICON CIRCLE
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

    font-size:28px;

    box-sizing:border-box;

}


/* =====================================================
   POPUP TITLE
===================================================== */

.success-box h2{

    margin:0 0 10px;

    color:#5a3e2b;

    font-family:Georgia,serif;

    font-size:27px;

    font-weight:normal;

}


/* =====================================================
   POPUP TEXT
===================================================== */

.success-box p{

    margin:0 0 25px;

    color:#6f625b;

    font-size:14px;

    line-height:1.6;

}


/* =====================================================
   OK BUTTON
===================================================== */

.success-ok{

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


.success-ok:hover{

    background:#6d4c41;

    transform:translateY(-2px);

    box-shadow:
        0 5px 12px
        rgba(90,62,43,.18);

}


/* =====================================================
   ERROR POPUP
===================================================== */

.error-popup{

    width:380px;

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


.error-icon{

    width:65px;

    height:65px;

    margin:0 auto 18px;

    background:#f8eeee;

    color:#a94442;

    border:2px solid #a94442;

    border-radius:50%;

    display:flex;

    align-items:center;

    justify-content:center;

    font-size:28px;

}


.error-popup h2{

    margin:0 0 10px;

    color:#8b3027;

    font-family:Georgia,serif;

    font-size:27px;

    font-weight:normal;

}


.error-popup p{

    margin:0 0 25px;

    color:#6f625b;

    font-size:14px;

    line-height:1.6;

}


.error-ok{

    width:120px;

    padding:11px 20px;

    background:#8b3027;

    color:#fff;

    border:none;

    border-radius:7px;

    font-size:15px;

    cursor:pointer;

}


.error-ok:hover{

    background:#6d2721;

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
   MOBILE
===================================================== */

@media(max-width:700px){

    .content{

        margin-left:0;

        margin-top:70px;

        padding:20px;

    }


    .form-card{

        width:100%;

    }

}

</style>

</head>


<body>


<!-- =====================================================
     MAIN CONTENT
===================================================== -->

<div class="content">


    <!-- TITLE -->

    <h2 class="page-title">

        <i class="fas fa-pen"></i>

        Update Category

    </h2>


    <!-- FORM CARD -->

    <div class="form-card">


        <form
            method="POST"
            enctype="multipart/form-data"
        >


            <!-- CATEGORY NAME -->

            <label>

                Category Name

            </label>


            <input
                type="text"
                name="category_name"
                value="<?php

                    echo htmlspecialchars(
                        $row['category_name']
                    );

                ?>"
                required
            >


            <!-- CHANGE IMAGE -->

            <label>

                Change Image

            </label>


            <input
                type="file"
                name="category_image"
                accept="image/*"
            >


            <!-- BUTTON -->

            <div class="button-area">


                <button
                    type="submit"
                    name="update_category"
                    class="update-btn"
                >

                    Update Category

                </button>


            </div>


        </form>


    </div>


</div>


<!-- =====================================================
     SUCCESS POPUP
===================================================== -->

<?php

if($show_success)
{

?>

<div class="success-popup">

    <div class="success-box">


        <div class="success-icon">

            <i class="fas fa-check"></i>

        </div>


        <h2>

            Category Updated Successfully!

        </h2>


        <p>

            Your category details have been
            updated successfully.

        </p>


        <button
            type="button"
            class="success-ok"
            onclick="goToCategory()"
        >

            OK

        </button>


    </div>

</div>


<script>

function goToCategory()
{

    window.location.href =
        "manage_category.php";

}

</script>

<?php

}

?>


<!-- =====================================================
     ERROR POPUP
===================================================== -->

<?php

if($show_error)
{

?>

<div class="success-popup">

    <div class="error-popup">


        <div class="error-icon">

            <i class="fas fa-times"></i>

        </div>


        <h2>

            Error!

        </h2>


        <p>

            <?php

            echo htmlspecialchars(
                $error_message
            );

            ?>

        </p>


        <button
            type="button"
            class="error-ok"
            onclick="window.location='edit_category.php?id=<?php echo $id; ?>'"
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