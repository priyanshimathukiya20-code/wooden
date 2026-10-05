<?php

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

include("connection.php");


/* =========================================================
   USER LOGIN CHECK
========================================================= */

if(!isset($_SESSION['user_id']))
{
    echo "<script>
            alert('Please login first');
            window.location='login.php';
          </script>";
    exit();
}

$user_id = $_SESSION['user_id'];


/* =========================================================
   VARIABLES
========================================================= */

$order_success = false;

$order_numbers_text = "";

$display_items = array();

$display_total = 0;

$display_payment_method = "";


/* =========================================================
   PLACE ORDER
========================================================= */

if(isset($_POST['place_order']))
{

    $customer_name =
        mysqli_real_escape_string(
            $con,
            $_POST['customer_name']
        );

    $customer_email =
        mysqli_real_escape_string(
            $con,
            $_POST['customer_email']
        );

    $customer_phone =
        mysqli_real_escape_string(
            $con,
            $_POST['customer_phone']
        );

    $customer_address =
        mysqli_real_escape_string(
            $con,
            $_POST['customer_address']
        );

    $state =
        mysqli_real_escape_string(
            $con,
            $_POST['state']
        );

    $payment_method =
        mysqli_real_escape_string(
            $con,
            $_POST['payment_method']
        );


    $display_payment_method = $payment_method;


    /* =====================================================
       GET CART
    ===================================================== */

    $cart_sql = "
        SELECT
            cart.cart_id,
            cart.quantity,
            product.pid,
            product.product_name,
            product.price,
            product.category_id,
            category.category_name

        FROM cart

        INNER JOIN product
            ON cart.product_id = product.pid

        LEFT JOIN category
            ON product.category_id = category.id

        WHERE cart.user_id='$user_id'

        ORDER BY
            product.category_id ASC,
            cart.cart_id ASC
    ";

    $cart_result = mysqli_query(
        $con,
        $cart_sql
    );


    if(!$cart_result)
    {
        die(
            "Cart Database Error : "
            . mysqli_error($con)
        );
    }


    /* =====================================================
       CHECK CART EMPTY
    ===================================================== */

    if(mysqli_num_rows($cart_result) == 0)
    {
        echo "<script>
                alert('Your cart is empty!');
                window.location='cart.php';
              </script>";

        exit();
    }


    /* =====================================================
       STORE CART PRODUCTS
    ===================================================== */

    $category_orders = array();


    while($cart = mysqli_fetch_assoc($cart_result))
    {

        $category_id = $cart['category_id'];


        $item_total =
            (float)$cart['price']
            *
            (int)$cart['quantity'];


        $display_items[] = array(

            "product_name" =>
                $cart['product_name'],

            "quantity" =>
                $cart['quantity'],

            "price" =>
                $cart['price'],

            "item_total" =>
                $item_total
        );


        $display_total += $item_total;


        if(!isset($category_orders[$category_id]))
        {
            $category_orders[$category_id] = array();
        }


        $category_orders[$category_id][] = $cart;
    }


    /* =====================================================
       GET LAST ORDER NUMBER
    ===================================================== */

    $number_sql = "
        SELECT MAX(order_number) AS last_order

        FROM orders

        WHERE user_id='$user_id'
    ";


    $number_result = mysqli_query(
        $con,
        $number_sql
    );


    if(!$number_result)
    {
        die(
            "Order Number Error : "
            . mysqli_error($con)
        );
    }


    $number_row =
        mysqli_fetch_assoc(
            $number_result
        );


    if($number_row['last_order'] == NULL)
    {
        $next_order_number = 1;
    }
    else
    {
        $next_order_number =
            (int)$number_row['last_order']
            + 1;
    }


    /* =====================================================
       FULL ADDRESS
    ===================================================== */

    $full_address =
        $customer_address
        . ", "
        . $state;


    /* =====================================================
       CREATE SEPARATE ORDER FOR EACH CATEGORY
    ===================================================== */

    $created_order_numbers = array();


    foreach(
        $category_orders
        as $category_id => $products
    )
    {

        $order_number =
            $next_order_number;


        $created_order_numbers[] =
            $order_number;


        $next_order_number++;


        foreach($products as $cart)
        {

            $product_name =
                mysqli_real_escape_string(
                    $con,
                    $cart['product_name']
                );


            $quantity =
                (int)$cart['quantity'];


            $price =
                (float)$cart['price'];


            $total_amount =
                $price * $quantity;


            $order_sql = "
                INSERT INTO orders
                (
                    order_number,
                    user_id,
                    customer_name,
                    customer_email,
                    customer_phone,
                    customer_address,
                    product_name,
                    quantity,
                    price,
                    total_amount,
                    payment_method,
                    order_status
                )

                VALUES
                (
                    '$order_number',
                    '$user_id',
                    '$customer_name',
                    '$customer_email',
                    '$customer_phone',
                    '$full_address',
                    '$product_name',
                    '$quantity',
                    '$price',
                    '$total_amount',
                    '$payment_method',
                    'Pending'
                )
            ";


            if(!mysqli_query($con, $order_sql))
            {
                die(
                    "Order Insert Error : "
                    . mysqli_error($con)
                );
            }

        }

    }


    /* =====================================================
       REMOVE CART
    ===================================================== */

    $delete_cart = "
        DELETE FROM cart
        WHERE user_id='$user_id'
    ";


    if(!mysqli_query($con, $delete_cart))
    {
        die(
            "Cart Delete Error : "
            . mysqli_error($con)
        );
    }


    /* =====================================================
       SUCCESS
    ===================================================== */

    $order_success = true;


    $order_numbers_text =
        implode(
            ", #",
            $created_order_numbers
        );

}


/* =========================================================
   HEADER
========================================================= */

include("header.php");

?>


<!DOCTYPE html>

<html>

<head>

<title>Checkout - Woodisty</title>


<style>

/* =========================================================
   BODY
========================================================= */

body{

    margin:0;

    background:#f5f5f5;

    font-family:Arial,sans-serif;

}


/* =========================================================
   CHECKOUT BANNER
========================================================= */

.checkout-banner{

    background:#5a3e2b;

    color:#fff;

    text-align:center;

    padding:60px 20px;

}


.checkout-banner h1{

    font-family:Georgia,serif;

    font-size:45px;

    margin:0;

}


.checkout-banner p{

    margin-top:10px;

    font-size:18px;

}


/* =========================================================
   CHECKOUT CONTAINER
========================================================= */

.checkout-container{

    width:90%;

    max-width:1250px;

    margin:60px auto;

    display:grid;

    grid-template-columns:2fr 1fr;

    gap:35px;

}


/* =========================================================
   CHECKOUT BOX
========================================================= */

.checkout-form,
.order-summary{

    background:#fff;

    padding:30px;

    border-radius:10px;

    box-shadow:
        0 5px 15px
        rgba(0,0,0,.10);

}


.checkout-form h2,
.order-summary h2{

    color:#5a3e2b;

    font-family:Georgia,serif;

    margin-top:0;

    margin-bottom:25px;

    text-transform:uppercase;

    letter-spacing:1px;

}


/* =========================================================
   INPUTS
========================================================= */

.checkout-form input,
.checkout-form textarea,
.checkout-form select{

    width:100%;

    padding:14px;

    margin-bottom:18px;

    border:1px solid #ccc;

    border-radius:5px;

    outline:none;

    font-size:15px;

    box-sizing:border-box;

}


.checkout-form input:focus,
.checkout-form textarea:focus,
.checkout-form select:focus{

    border-color:#8B5A2B;

    box-shadow:
        0 0 0 3px
        rgba(139,90,43,.08);

}


.checkout-form textarea{

    height:120px;

    resize:none;

}


/* =========================================================
   PLACE ORDER BUTTON
========================================================= */

.place-order{

    margin-top:10px;

    background:#5a3e2b;

    color:#fff;

    border:none;

    padding:15px;

    width:100%;

    font-size:18px;

    border-radius:6px;

    cursor:pointer;

    transition:.3s;

}


.place-order:hover{

    background:#3e2a1d;

    transform:translateY(-1px);

}


/* =========================================================
   ORDER SUMMARY
========================================================= */

.summary-box{

    border-bottom:1px solid #ddd;

    padding:15px 0;

    display:flex;

    justify-content:space-between;

    align-items:center;

    gap:20px;

    font-size:15px;

}


.summary-box:first-of-type{

    padding-top:5px;

}


.product-name{

    color:#222;

    line-height:1.5;

}


.product-price{

    color:#222;

    white-space:nowrap;

}


.total{

    font-size:22px;

    font-weight:bold;

    color:#5a3e2b;

    border-bottom:none;

    padding-top:20px;

}


.payment-row{

    color:#444;

    font-size:15px;

}


/* =========================================================
   SUCCESS POPUP OVERLAY

   NOTE:
   AHI OVERLAY NO COLOR SAME RAKHYO CHE
========================================================= */

.popup{

    display:none;

    position:fixed;

    left:0;

    top:0;

    width:100%;

    height:100%;

    background:rgba(70,55,45,.50);

    justify-content:center;

    align-items:center;

    z-index:99999;

    padding:20px;

    box-sizing:border-box;

}


/* =========================================================
   POPUP BOX
   ONLY BOX COLOR CHANGED
========================================================= */

.popup-content{

    /*
       LIGHT WARM BROWN / CREAM
       WOODISTY MATCHING COLOR
    */

    background:#f3e7d8;

    width:420px;

    max-width:100%;

    padding:38px 40px;

    border-radius:16px;

    text-align:center;

    border:1px solid #d8c4ad;

    box-shadow:
        0 20px 60px
        rgba(90,62,43,.28);

    animation:
        popupShow .35s ease;

}


@keyframes popupShow{

    from{

        opacity:0;

        transform:
            translateY(-20px)
            scale(.96);

    }

    to{

        opacity:1;

        transform:
            translateY(0)
            scale(1);

    }

}


/* =========================================================
   POPUP TITLE
========================================================= */

.popup-content h2{

    color:#6d4c41;

    font-family:Georgia,serif;

    font-size:32px;

    line-height:1.15;

    text-transform:uppercase;

    letter-spacing:1px;

    margin:0 0 20px;

}


/* =========================================================
   POPUP TEXT
========================================================= */

.popup-content p{

    color:#746b64;

    font-size:16px;

    line-height:1.7;

    margin:0;

}


.popup-content strong{

    color:#6d4c41;

}


/* =========================================================
   ORDER NUMBER
========================================================= */

.order-number{

    color:#8b5e34;

    font-size:19px;

    font-weight:bold;

}


/* =========================================================
   POPUP BUTTON
========================================================= */

.popup-content button{

    margin-top:25px;

    background:#8b6b61;

    color:#fff;

    border:none;

    padding:14px 30px;

    border-radius:7px;

    cursor:pointer;

    font-size:16px;

    transition:.3s;

}


.popup-content button:hover{

    background:#6d4c41;

    transform:translateY(-1px);

    box-shadow:
        0 5px 15px
        rgba(90,62,43,.20);

}


/* =========================================================
   RESPONSIVE
========================================================= */

@media(max-width:768px){

    .checkout-container{

        grid-template-columns:1fr;

        width:92%;

        margin:35px auto;

    }


    .checkout-banner{

        padding:45px 15px;

    }


    .checkout-banner h1{

        font-size:34px;

    }


    .checkout-form,
    .order-summary{

        padding:22px;

    }


    .popup-content{

        padding:30px 25px;

    }


    .popup-content h2{

        font-size:27px;

    }

}

</style>

</head>


<body>


<!-- =========================================================
     BANNER
========================================================= -->

<section class="checkout-banner">

    <h1>
        Place Order
    </h1>

    <p>
        Complete your order securely.
    </p>

</section>



<!-- =========================================================
     CHECKOUT
========================================================= -->

<section class="checkout-container">


    <!-- =====================================================
         BILLING DETAILS
    ====================================================== -->

    <div class="checkout-form">

        <h2>
            Billing Details
        </h2>


        <form method="POST">


            <input
                type="text"
                name="customer_name"
                placeholder="Full Name"
                required
            >


            <input
                type="email"
                name="customer_email"
                placeholder="Email Address"
                required
            >


            <input
                type="text"
                name="customer_phone"
                placeholder="Mobile Number"
                maxlength="10"
                pattern="[6-9][0-9]{9}"
                title="Enter a valid 10-digit mobile number starting with 6, 7, 8 or 9"
                required
            >


            <textarea
                name="customer_address"
                placeholder="Full Address"
                required
            ></textarea>


            <input
                type="text"
                name="state"
                placeholder="State"
                required
            >


            <select
                name="payment_method"
                required
            >

                <option value="">
                    Select Payment Method
                </option>

                <option value="Cash On Delivery">
                    Cash On Delivery
                </option>

            </select>


            <button
                type="submit"
                name="place_order"
                class="place-order"
            >

                Place Order

            </button>


        </form>

    </div>



    <!-- =====================================================
         ORDER SUMMARY
    ====================================================== -->

    <div class="order-summary">

        <h2>
            Order Summary
        </h2>


<?php

if($order_success)
{

    foreach($display_items as $item)
    {

?>

        <div class="summary-box">

            <span class="product-name">

                <?php

                echo htmlspecialchars(
                    $item['product_name']
                );

                ?>

                <small>


                    <?php

                    echo $item['quantity'];

                    ?>

                </small>

            </span>


            <span class="product-price">

                <?php

                echo number_format(
                    $item['item_total'],
                    0
                );

                ?>

            </span>

        </div>

<?php

    }

}
else
{

    $summary_sql = "

        SELECT

            product.product_name,

            product.price,

            cart.quantity

        FROM cart

        INNER JOIN product

            ON cart.product_id = product.pid

        WHERE cart.user_id='$user_id'

        ORDER BY cart.cart_id ASC

    ";


    $summary_result =
        mysqli_query(
            $con,
            $summary_sql
        );


    if(!$summary_result)
    {
        die(
            "Summary Error : "
            . mysqli_error($con)
        );
    }


    $grand_total = 0;


    while(
        $item =
        mysqli_fetch_assoc(
            $summary_result
        )
    )
    {

        $item_total =
            $item['price']
            *
            $item['quantity'];


        $grand_total +=
            $item_total;

?>

        <div class="summary-box">

            <span class="product-name">

                <?php

                echo htmlspecialchars(
                    $item['product_name']
                );

                ?>

                <small>

                    

                    <?php

                    echo $item['quantity'];

                    ?>

                </small>

            </span>


            <span class="product-price">

                <?php

                echo number_format(
                    $item_total,
                    0
                );

                ?>

            </span>

        </div>

<?php

    }


    $display_total =
        $grand_total;

}

?>


        <div class="summary-box">

            <span>
                Shipping
            </span>

            <span>
                Free
            </span>

        </div>


<?php

if(

    $order_success
    &&
    $display_payment_method != ""
)
{

?>

        <div class="summary-box payment-row">

            <span>
                Payment
            </span>

            <span>

                <?php

                echo htmlspecialchars(
                    $display_payment_method
                );

                ?>

            </span>

        </div>

<?php

}

?>


        <div class="summary-box total">

            <span>
                Total
            </span>

            <span>

                <?php

                echo number_format(
                    $display_total,
                    0
                );

                ?>

            </span>

        </div>


    </div>

</section>



<!-- =========================================================
     SUCCESS POPUP
========================================================= -->

<div

    id="successPopup"

    class="popup"

    style="<?php

        echo $order_success
        ? 'display:flex;'
        : '';

    ?>"

>


    <div class="popup-content">


        <h2>

            Order Placed

            <br>

            Successfully!

        </h2>


        <p>

            Thank you for shopping with

            <strong>
                Woodisty
            </strong>.

            <br><br>

            Your Order Number(s) are:

            <br>

            <span class="order-number">

                #

                <?php

                echo $order_numbers_text;

                ?>

            </span>

            <br><br>

            Products from different categories

            have been placed in separate orders.

        </p>


        <button

            type="button"

            onclick="continueShopping()"

        >

            Continue Shopping

        </button>


    </div>

</div>



<script>

function continueShopping()
{
    window.location.href = "index.php";
}

</script>



<?php

include("footer.php");

?>


</body>

</html>