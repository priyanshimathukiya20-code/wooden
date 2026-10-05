<?php

session_start();

include("connection.php");


/* =========================================================
   ADD TO CART
========================================================= */

if(isset($_GET['id']))
{
    $product_id = intval($_GET['id']);

    if(!isset($_SESSION['user_id']))
    {
        echo "<script>
                window.location='cart.php';
              </script>";
        exit();
    }

    $user_id = $_SESSION['user_id'];

    $check = mysqli_query(
        $con,
        "SELECT *
         FROM cart
         WHERE user_id='$user_id'
         AND product_id='$product_id'"
    );

    if(mysqli_num_rows($check) > 0)
    {
        mysqli_query(
            $con,
            "UPDATE cart
             SET quantity = quantity + 1
             WHERE user_id='$user_id'
             AND product_id='$product_id'"
        );
    }
    else
    {
        mysqli_query(
            $con,
            "INSERT INTO cart
            (user_id, product_id, quantity)
            VALUES
            ('$user_id','$product_id','1')"
        );
    }

    header("Location:cart.php");
    exit();
}


/* =========================================================
   REMOVE PRODUCT
========================================================= */

if(isset($_GET['remove']))
{
    if(isset($_SESSION['user_id']))
    {
        $cart_id = intval($_GET['remove']);

        $user_id = $_SESSION['user_id'];

        mysqli_query(
            $con,
            "DELETE FROM cart
             WHERE cart_id='$cart_id'
             AND user_id='$user_id'"
        );
    }

    header("Location:cart.php");
    exit();
}


/* =========================================================
   AJAX UPDATE QUANTITY
   IMPORTANT:
   Aa block header.php karta pela che,
   etle JSON response perfect aavshe.
========================================================= */

if(isset($_POST['ajax_update_quantity']))
{
    header('Content-Type: application/json');

    if(!isset($_SESSION['user_id']))
    {
        echo json_encode([
            "success" => false
        ]);

        exit();
    }

    $cart_id  = intval($_POST['cart_id']);
    $quantity = intval($_POST['quantity']);
    $user_id  = $_SESSION['user_id'];


    if($quantity < 1)
    {
        $quantity = 1;
    }


    /* UPDATE QUANTITY */

    $update = mysqli_query(
        $con,
        "UPDATE cart
         SET quantity='$quantity'
         WHERE cart_id='$cart_id'
         AND user_id='$user_id'"
    );


    if(!$update)
    {
        echo json_encode([
            "success" => false
        ]);

        exit();
    }


    /* GET CURRENT PRODUCT TOTAL */

    $item = mysqli_query(
        $con,
        "SELECT
            cart.quantity,
            product.price

         FROM cart

         INNER JOIN product
         ON cart.product_id = product.pid

         WHERE cart.cart_id='$cart_id'
         AND cart.user_id='$user_id'"
    );


    $item_row = mysqli_fetch_assoc($item);


    $item_total =
        $item_row['price']
        *
        $item_row['quantity'];


    /* GET GRAND TOTAL */

    $grand = mysqli_query(
        $con,
        "SELECT
            SUM(product.price * cart.quantity) AS grand_total

         FROM cart

         INNER JOIN product
         ON cart.product_id = product.pid

         WHERE cart.user_id='$user_id'"
    );


    $grand_row =
        mysqli_fetch_assoc($grand);


    echo json_encode([

        "success" => true,

        "quantity" =>
            (int)$item_row['quantity'],

        "item_total" =>
            number_format(
                $item_total,
                0
            ),

        "grand_total" =>
            number_format(
                (float)$grand_row['grand_total'],
                0
            )
    ]);

    exit();
}


/* =========================================================
   HEADER
========================================================= */

include("header.php");

?>


<!-- =========================================================
     FONT AWESOME
========================================================= -->

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">


<style>

/* =========================================================
   CART SECTION
========================================================= */

.cart-section{

    width:90%;

    margin:60px auto;
}


/* =========================================================
   CART TITLE
========================================================= */

.cart-title{

    text-align:center;

    color:#5a3e2b;

    font-size:40px;

    margin-bottom:40px;
}


/* =========================================================
   LOGIN BOX
========================================================= */

.login-display-box{

    width:100%;

    max-width:520px;

    margin:0 auto 50px;

    padding:35px 30px;

    box-sizing:border-box;

    text-align:center;

    background:#ead5c8;

    border:1px solid #c8a18e;

    border-radius:14px;

    box-shadow:
        0 8px 25px
        rgba(90,62,43,.12);
}


/* =========================================================
   LOGIN ICON
========================================================= */

.login-display-icon{

    width:62px !important;

    height:62px !important;

    margin:0 auto 18px !important;

    border-radius:50% !important;

    background:#d2aa97 !important;

    border:2px solid #a97b65 !important;

    display:flex !important;

    align-items:center !important;

    justify-content:center !important;

    box-sizing:border-box !important;
}


.login-display-icon i{

    color:#17110e !important;

    font-size:22px !important;

    line-height:1 !important;

}


/* =========================================================
   LOGIN HEADING
========================================================= */

.login-display-box h2{

    margin:0 0 12px;

    color:#624434;

    font-family:Georgia,serif;

    font-size:27px;

    font-weight:normal;
}


/* =========================================================
   LOGIN TEXT
========================================================= */

.login-display-box p{

    margin:0 auto 22px;

    max-width:390px;

    color:#735f55;

    font-size:14px;

    line-height:1.6;
}


/* =========================================================
   LOGIN BUTTON
========================================================= */

.login-display-btn{

    display:inline-block;

    padding:11px 32px;

    background:#76513f;

    color:#fff;

    text-decoration:none;

    border-radius:6px;

    font-size:14px;

    transition:.3s;
}


.login-display-btn:hover{

    background:#5d3e30;

    transform:translateY(-2px);
}


/* =========================================================
   CART TABLE
========================================================= */

.cart-table{

    width:100%;

    border-collapse:collapse;

    background:white;

    box-shadow:
        0 5px 15px
        rgba(0,0,0,.1);
}


/* =========================================================
   TABLE HEADER
========================================================= */

.cart-table th{

    background:#5a3e2b;

    color:white;

    padding:16px 15px;

    text-align:center;

    vertical-align:middle;

    font-family:Arial,sans-serif;

    font-size:16px;

    font-weight:bold;
}


/* =========================================================
   TABLE DATA
========================================================= */

.cart-table td{

    padding:15px;

    text-align:center;

    border-bottom:1px solid #ddd;

    font-size:15px;
}


.cart-table td b{

    font-size:15px;
}


.cart-table img{

    width:100px;

    height:100px;

    object-fit:cover;

    border-radius:8px;
}


/* =========================================================
   QUANTITY BOX
========================================================= */

.quantity-box{

    display:flex;

    align-items:center;

    justify-content:center;

    gap:0;
}


/* =========================================================
   PLUS MINUS
========================================================= */

.quantity-btn{

    width:32px;

    height:32px;

    border:1px solid #d8c2b5;

    background:#f5ecdf;

    color:#6d4c41;

    font-size:18px;

    font-weight:bold;

    cursor:pointer;

    display:flex;

    align-items:center;

    justify-content:center;

    transition:.2s;
}


.quantity-btn:first-child{

    border-radius:6px 0 0 6px;
}


.quantity-btn:last-child{

    border-radius:0 6px 6px 0;
}


.quantity-btn:hover{

    background:#e8d7c8;
}


.quantity-btn:disabled{

    opacity:.5;

    cursor:not-allowed;
}


/* =========================================================
   QUANTITY NUMBER
========================================================= */

.quantity-number{

    width:42px;

    height:32px;

    border-top:1px solid #d8c2b5;

    border-bottom:1px solid #d8c2b5;

    background:#fff;

    color:#5a3e2b;

    font-size:14px;

    font-weight:bold;

    display:flex;

    align-items:center;

    justify-content:center;
}


/* =========================================================
   REMOVE BUTTON
========================================================= */

.remove-btn{

    background:#b22222;

    color:white;

    padding:8px 15px;

    text-decoration:none;

    border-radius:5px;

    cursor:pointer;

    display:inline-block;

    font-size:14px;
}


.remove-btn:hover{

    background:#8f1b1b;
}


/* =========================================================
   REMOVE POPUP
========================================================= */

.remove-popup-overlay{

    position:fixed;

    top:0;

    left:0;

    width:100%;

    height:100%;

    background:rgba(55,40,30,.55);

    display:none;

    align-items:center;

    justify-content:center;

    z-index:999999;
}


.remove-popup-box{

    width:390px;

    max-width:90%;

    background:#fffdfb;

    padding:35px 30px;

    text-align:center;

    border-radius:16px;

    border:1px solid #e2d2c0;

    box-shadow:
        0 15px 45px
        rgba(90,62,43,.25);

    animation:removePopupShow .3s ease;
}


.remove-popup-icon{

    width:65px;

    height:65px;

    margin:0 auto 18px;

    border-radius:50%;

    background:#f5ecdf;

    border:2px solid #8b5e34;

    display:flex;

    align-items:center;

    justify-content:center;
}


.remove-popup-icon i{

    font-size:27px;

    color:#8b5e34;
}


.remove-popup-box h2{

    margin:0 0 10px;

    color:#5a3e2b;

    font-family:Georgia,serif;

    font-size:27px;

    font-weight:normal;
}


.remove-popup-box p{

    margin:0 0 25px;

    color:#746b64;

    font-size:14px;

    line-height:1.6;
}


.remove-popup-buttons{

    display:flex;

    justify-content:center;

    gap:12px;
}


.remove-cancel-btn,
.remove-confirm-btn{

    width:110px;

    padding:11px 15px;

    border-radius:7px;

    font-size:14px;

    cursor:pointer;
}


.remove-cancel-btn{

    background:#eee5df;

    color:#6d4c41;

    border:1px solid #d8c8bf;
}


.remove-confirm-btn{

    background:#8b5e34;

    color:white;

    border:1px solid #8b5e34;
}


@keyframes removePopupShow{

    from{

        opacity:0;

        transform:scale(.85);

    }

    to{

        opacity:1;

        transform:scale(1);

    }

}


/* =========================================================
   TOTAL BOX
========================================================= */

.total-box{

    margin-top:30px;

    text-align:right;

    background:white;

    padding:25px;

    box-shadow:
        0 5px 15px
        rgba(0,0,0,.1);
}


.total-box h2{

    color:#5a3e2b;

    font-size:30px;
}


/* =========================================================
   CHECKOUT
========================================================= */

.checkout-btn{

    display:inline-block;

    margin-top:15px;

    background:#5a3e2b;

    color:white;

    padding:15px 30px;

    text-decoration:none;

    border-radius:5px;
}


.checkout-btn:hover{

    background:#432d21;
}


/* =========================================================
   EMPTY CART
========================================================= */

.empty-cart{

    text-align:center;

    padding:60px;

    background:white;
}


.empty-cart h2{

    color:#5a3e2b;

    font-family:Georgia,serif;

    font-size:30px;

    font-weight:normal;
}


.empty-cart p{

    color:#746b64;

    font-size:15px;
}


/* =========================================================
   MOBILE
========================================================= */

@media(max-width:600px){

    .cart-section{

        width:92%;
    }


    .cart-title{

        font-size:32px;
    }


    .cart-table th{

        font-size:13px;

        padding:10px 5px;
    }


    .cart-table td{

        font-size:12px;

        padding:8px;
    }


    .cart-table td b{

        font-size:12px;
    }


    .cart-table img{

        width:70px;

        height:70px;
    }


    .quantity-btn{

        width:28px;

        height:28px;
    }


    .quantity-number{

        width:36px;

        height:28px;
    }

}

</style>


<!-- =========================================================
     CART SECTION
========================================================= -->

<section class="cart-section">


<h1 class="cart-title">

    My Shopping Cart

</h1>


<?php

if(!isset($_SESSION['user_id']))
{

?>


<div class="login-display-box">


    <div class="login-display-icon">

        <i class="fas fa-lock"></i>

    </div>


    <h2>

        Please Login First

    </h2>


    <p>

        Please login to your Woodisty account
        to view your shopping cart and continue
        your furniture shopping.

    </p>


    <a
        href="login.php"
        class="login-display-btn"
    >

        Login

    </a>


</div>


<?php

}
else
{

    $user_id =
        $_SESSION['user_id'];


    $sql = "

        SELECT

            cart.cart_id,

            cart.quantity,

            product.pid,

            product.product_name,

            product.price,

            product.image

        FROM cart

        INNER JOIN product

        ON cart.product_id = product.pid

        WHERE cart.user_id='$user_id'

    ";


    $result =
        mysqli_query(
            $con,
            $sql
        );


    $grand_total = 0;


    if(mysqli_num_rows($result) > 0)
    {

?>


<table class="cart-table">


<tr>

    <th>Product</th>

    <th>Image</th>

    <th>Price</th>

    <th>Quantity</th>

    <th>Total</th>

    <th>Action</th>

</tr>


<?php

        while(
            $row =
            mysqli_fetch_assoc($result)
        )
        {

            $total =
                $row['price']
                *
                $row['quantity'];


            $grand_total +=
                $total;

?>


<tr>


<td>

    <b>

        <?php

        echo htmlspecialchars(
            $row['product_name']
        );

        ?>

    </b>

</td>


<td>

    <img
        src="images/product/<?php

        echo htmlspecialchars(
            $row['image']
        );

        ?>"
    >

</td>


<td>

    <?php

    echo number_format(
        $row['price'],
        0
    );

    ?>


</td>


<td>


<div class="quantity-box">


    <button
        type="button"
        class="quantity-btn"

        onclick="
            changeQuantity(
                <?php echo $row['cart_id']; ?>,
                -1,
                this
            )
        "
    >

        -

    </button>


    <div
        class="quantity-number"
        id="quantity-<?php echo $row['cart_id']; ?>"
    >

        <?php

        echo $row['quantity'];

        ?>

    </div>


    <button
        type="button"
        class="quantity-btn"

        onclick="
            changeQuantity(
                <?php echo $row['cart_id']; ?>,
                1,
                this
            )
        "
    >

        +

    </button>


</div>


</td>


<td>

    <b
        id="item-total-<?php echo $row['cart_id']; ?>"
    >

        <?php

        echo number_format(
            $total,
            0
        );

        ?>

    </b>

</td>


<td>

<a
    href="#"
    class="remove-btn"

    onclick="
        openRemovePopup(
            <?php echo $row['cart_id']; ?>
        );

        return false;
    "
>

    Remove

</a>

</td>


</tr>


<?php

        }

?>


</table>


<div class="total-box">


<h2>

    Grand Total :

    <span id="grand-total">

        <?php

        echo number_format(
            $grand_total,
            0
        );

        ?>

    </span>

</h2>


<a
    href="checkout.php"
    class="checkout-btn"
>

    Proceed To ordered

</a>


</div>


<?php

    }
    else
    {

?>


<div class="empty-cart">


    <h2>

        Your Cart Is Empty

    </h2>


    <p>

        Add some products to your cart.

    </p>


    <a
        href="category.php?id=17"
        class="checkout-btn"
    >

        Continue Shopping

    </a>


</div>


<?php

    }

}

?>


</section>


<!-- =========================================================
     REMOVE POPUP
========================================================= -->

<div
    class="remove-popup-overlay"
    id="removePopup"
>

    <div class="remove-popup-box">


        <div class="remove-popup-icon">

            <i class="fas fa-trash"></i>

        </div>


        <h2>

            Remove Product?

        </h2>


        <p>

            Are you sure you want to remove
            this product from your cart?

        </p>


        <div class="remove-popup-buttons">


            <button
                type="button"
                class="remove-cancel-btn"

                onclick="
                    closeRemovePopup()
                "
            >

                Cancel

            </button>


            <button
                type="button"
                class="remove-confirm-btn"

                onclick="
                    confirmRemove()
                "
            >

                Remove

            </button>


        </div>


    </div>

</div>


<!-- =========================================================
     QUANTITY + REMOVE JAVASCRIPT
========================================================= -->

<script>


/* =========================================================
   QUANTITY
========================================================= */

function changeQuantity(
    cartId,
    change,
    button
)
{

    let quantityBox =
        button.parentElement;


    let quantityNumber =
        quantityBox.querySelector(
            ".quantity-number"
        );


    let currentQuantity =
        parseInt(
            quantityNumber.innerText
        );


    let newQuantity =
        currentQuantity + change;


    if(newQuantity < 1)
    {
        newQuantity = 1;
    }


    let buttons =
        quantityBox.querySelectorAll(
            ".quantity-btn"
        );


    buttons.forEach(
        function(btn)
        {
            btn.disabled = true;
        }
    );


    let formData =
        new FormData();


    formData.append(
        "ajax_update_quantity",
        "1"
    );


    formData.append(
        "cart_id",
        cartId
    );


    formData.append(
        "quantity",
        newQuantity
    );


    fetch(
        "cart.php",
        {
            method:"POST",
            body:formData
        }
    )

    .then(
        function(response)
        {
            return response.json();
        }
    )

    .then(
        function(data)
        {

            if(data.success)
            {

                document.getElementById(
                    "quantity-" + cartId
                ).innerText =
                    data.quantity;


                document.getElementById(
                    "item-total-" + cartId
                ).innerText =
                    data.item_total;


                document.getElementById(
                    "grand-total"
                ).innerText =
                    data.grand_total;

            }

        }
    )

    .catch(
        function(error)
        {
            console.log(error);
        }
    )

    .finally(
        function()
        {

            buttons.forEach(
                function(btn)
                {
                    btn.disabled = false;
                }
            );

        }
    );

}


/* =========================================================
   REMOVE POPUP
========================================================= */

let removeCartId = 0;


function openRemovePopup(cartId)
{

    removeCartId =
        cartId;


    document.getElementById(
        "removePopup"
    ).style.display =
        "flex";

}


function closeRemovePopup()
{

    document.getElementById(
        "removePopup"
    ).style.display =
        "none";


    removeCartId = 0;

}


function confirmRemove()
{

    if(removeCartId > 0)
    {

        window.location =
            "cart.php?remove="
            +
            removeCartId;

    }

}


window.addEventListener(
    "click",
    function(event)
    {

        let popup =
            document.getElementById(
                "removePopup"
            );


        if(event.target === popup)
        {
            closeRemovePopup();
        }

    }
);

</script>


<?php

include("footer.php");

?>

</body>

</html>