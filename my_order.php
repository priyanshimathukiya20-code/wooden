<?php

session_start();

include("connection.php");


/* =====================================================
   USER LOGIN CHECK
   ===================================================== */

if(!isset($_SESSION['user_id']))
{
    echo "<script>
            alert('Please login first');
            window.location='login.php';
          </script>";
    exit();
}

$user_id = $_SESSION['user_id'];


/* =====================================================
   USER DETAILS
   ===================================================== */

$user_name = isset($_SESSION['user_name'])
             ? $_SESSION['user_name']
             : '';

$user_email = isset($_SESSION['user_email'])
              ? $_SESSION['user_email']
              : '';


/* =====================================================
   CANCEL ORDER
   ===================================================== */

if(isset($_POST['cancel_order']))
{
    $order_number = intval($_POST['order_number']);

    $check = mysqli_query(
        $con,
        "SELECT id
         FROM orders
         WHERE order_number='$order_number'
         AND user_id='$user_id'
         AND order_status IN ('Pending','Processing')"
    );

    if(mysqli_num_rows($check) > 0)
    {
        mysqli_query(
            $con,
            "UPDATE orders
             SET order_status='Cancelled'
             WHERE order_number='$order_number'
             AND user_id='$user_id'"
        );

        echo "<script>
                alert('Order Cancelled Successfully');
                window.location='my_order.php';
              </script>";
        exit();
    }
}


/* =====================================================
   RETURN ORDER
   ===================================================== */

if(isset($_POST['return_order']))
{
    $order_number = intval($_POST['order_number']);

    $check = mysqli_query(
        $con,
        "SELECT id
         FROM orders
         WHERE order_number='$order_number'
         AND user_id='$user_id'
         AND order_status='Delivered'"
    );

    if(mysqli_num_rows($check) > 0)
    {
        mysqli_query(
            $con,
            "UPDATE orders
             SET order_status='Return Requested'
             WHERE order_number='$order_number'
             AND user_id='$user_id'"
        );

        echo "<script>
                alert('Return Request Sent Successfully');
                window.location='my_order.php';
              </script>";
        exit();
    }
}


/* =====================================================
   GET USER ORDERS
   ===================================================== */

$sql = "SELECT *
        FROM orders
        WHERE user_id='$user_id'
        AND order_number > 0
        ORDER BY order_number DESC, id ASC";

$result = mysqli_query($con, $sql);

if(!$result)
{
    die("Order Query Error: " . mysqli_error($con));
}


/* =====================================================
   GROUP PRODUCTS BY ORDER NUMBER
   ===================================================== */

$orders = array();

while($row = mysqli_fetch_assoc($result))
{
    $order_no = $row['order_number'];

    if(!isset($orders[$order_no]))
    {
        $orders[$order_no] = array();
    }

    $orders[$order_no][] = $row;
}

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>My Orders - Woodisty</title>


<style>

/* =====================================================
   RESET
   ===================================================== */

*{
    box-sizing:border-box;
}

html{
    scroll-behavior:smooth;
}

body{
    margin:0;
    font-family:Arial, sans-serif;
    background:#f3eee9;
    color:#333;
}


/* =====================================================
   MAIN PAGE
   ===================================================== */

.orders-page{
    width:96%;
    max-width:1450px;
    margin:35px auto 60px;
}


/* =====================================================
   PAGE TITLE
   ===================================================== */

.heading-area{
    text-align:center;
    margin-bottom:25px;
}

.heading-line{
    width:55px;
    height:4px;
    background:#9b7765;
    border-radius:20px;
    margin:0 auto 10px;
}

.orders-title{
    margin:0;
    color:#4b3023;
    font-family:Georgia,serif;
    font-size:36px;
    font-weight:600;
    letter-spacing:.5px;
}

.orders-subtitle{
    margin:7px 0 0;
    color:#81756e;
    font-size:13px;
}


/* =====================================================
   USER INFORMATION
   ===================================================== */

.user-box{
    background:linear-gradient(
        135deg,
        #fffdfb,
        #f8f0e9
    );

    border:1px solid #dfd0c5;

    border-radius:15px;

    padding:16px 22px;

    margin-bottom:24px;

    box-shadow:
        0 5px 18px rgba(82,54,40,.08);

    display:flex;

    justify-content:space-between;

    align-items:center;

    flex-wrap:wrap;

    gap:10px;
}

.user-left h3{
    margin:0;

    color:#4b3023;

    font-family:Georgia,serif;

    font-size:20px;
}

.user-left p{
    margin:4px 0 0;

    color:#776b64;

    font-size:12px;
}

.user-label{
    display:inline-block;

    background:#eaded5;

    color:#684938;

    padding:7px 12px;

    border-radius:20px;

    font-size:10px;

    font-weight:bold;

    text-transform:uppercase;

    letter-spacing:.5px;
}


/* =====================================================
   ORDERS LIST
   ===================================================== */

.orders-list{
    display:flex;

    flex-direction:column;

    gap:18px;

    width:100%;
}


/* =====================================================
   ORDER CARD
   ===================================================== */

.order-card{
    width:100%;

    background:#ffffff;

    border:1px solid #dfd2c9;

    border-radius:15px;

    overflow:hidden;

    box-shadow:
        0 6px 20px rgba(73,48,36,.08);

    transition:
        transform .2s ease,
        box-shadow .2s ease;
}

.order-card:hover{
    transform:translateY(-2px);

    box-shadow:
        0 10px 28px rgba(73,48,36,.12);
}


/* =====================================================
   ORDER HEADER
   ===================================================== */

.order-top{
    min-height:65px;

    background:#4b3023;

    color:#ffffff;

    padding:12px 18px;

    display:flex;

    justify-content:space-between;

    align-items:center;

    gap:15px;
}

.order-header-left{
    display:flex;

    align-items:center;

    flex-wrap:wrap;

    gap:10px;
}

.order-number{
    display:inline-block;

    background:#765546;

    color:#ffffff;

    padding:7px 13px;

    border-radius:8px;

    font-size:13px;

    font-weight:bold;

    border:1px solid #967666;
}

.order-date{
    color:#f0e5de;

    font-size:12px;

    font-weight:500;
}


/* =====================================================
   STATUS
   SAME SOFT COLORS AS ADMIN ORDER
   ===================================================== */

.status{
    display:inline-block;

    padding:6px 12px;

    border-radius:20px;

    font-size:9px;

    font-weight:bold;

    text-transform:uppercase;

    letter-spacing:.4px;

    white-space:nowrap;
}


/* Pending - Soft Yellow */

.status-pending{
    background:#f6e7b5;

    border:1px solid #ead58f;

    color:#795f20;
}


/* Processing - Soft Blue */

.status-processing{
    background:#d9e6f5;

    border:1px solid #b9cfe5;

    color:#4b6680;
}


/* Shipped - Soft Purple */

.status-shipped{
    background:#e5d9ee;

    border:1px solid #ccb9db;

    color:#6b5478;
}


/* Delivered - Soft Green */

.status-delivered{
    background:#dcebdc;

    border:1px solid #bdd7bd;

    color:#4f704f;
}


/* Cancelled - Soft Red */

.status-cancelled{
    background:#f1d8d5;

    border:1px solid #dfbbb7;

    color:#87534e;
}


/* Return Status - Soft Brown */

.status-return{
    background:#ebe0d9;

    border:1px solid #d1bdb1;

    color:#654b3d;

    white-space:normal;
}


/* =====================================================
   ORDER BODY
   ===================================================== */

.order-body{
    padding:16px 18px 17px;
}


/* =====================================================
   SECTION TITLE
   ===================================================== */

.products-title{
    display:flex;

    align-items:center;

    gap:8px;

    color:#765546;

    font-size:10px;

    font-weight:bold;

    text-transform:uppercase;

    letter-spacing:.7px;

    margin-bottom:8px;
}

.products-title:before{
    content:"";

    width:5px;

    height:15px;

    background:#a17c68;

    border-radius:5px;
}


/* =====================================================
   PRODUCT ROW
   ===================================================== */

.product-row{
    display:flex;

    justify-content:space-between;

    align-items:center;

    background:#faf7f4;

    border:1px solid #eadfd8;

    border-radius:10px;

    padding:10px 13px;

    margin-bottom:6px;

    transition:.2s;
}

.product-row:hover{
    background:#f6eee8;

    border-color:#d8c5b9;
}

.product-left{
    flex:1;

    min-width:0;
}


/* PRODUCT NAME */

.product-name{
    color:#2f211b;

    font-size:15px;

    font-weight:700;

    margin-bottom:4px;
}


/* PRODUCT QTY */

.product-qty{
    color:#4f4742;

    font-size:11px;

    font-weight:500;
}


/* PRODUCT PRICE */

.product-price{
    color:#2f211b;

    font-size:15px;

    font-weight:700;

    white-space:nowrap;

    margin-left:15px;
}


/* =====================================================
   DETAILS GRID
   ===================================================== */

.order-details{
    display:grid;

    grid-template-columns:repeat(3,1fr);

    gap:8px;

    margin-top:12px;
}


/* DETAIL BOX */

.detail-box{
    background:#fffdfb;

    border:1px solid #eadfd8;

    border-radius:9px;

    padding:10px 11px;

    min-height:56px;
}


/* DETAIL TITLE */

.detail-box strong{
    display:block;

    color:#765546;

    font-size:9px;

    font-weight:700;

    text-transform:uppercase;

    letter-spacing:.5px;

    margin-bottom:5px;
}


/* DETAIL VALUE */

.detail-box span{
    color:#2f2925;

    font-size:11px;

    font-weight:600;

    line-height:1.45;

    word-break:break-word;
}

.detail-box .status{
    margin-top:-2px;
}


/* =====================================================
   RETURN APPROVED MESSAGE
   ===================================================== */

.return-approved-message{
    margin-top:7px;

    color:#5a3e2b;

    font-size:10px;

    font-weight:normal;

    line-height:1.5;

    text-transform:none;

    letter-spacing:0;

    white-space:normal;
}


/* =====================================================
   RETURN REJECTED MESSAGE
   ===================================================== */

.return-rejected-message{
    margin-top:7px;

    color:#8b3027;

    font-size:10px;

    font-weight:normal;

    line-height:1.5;

    text-transform:none;

    letter-spacing:0;

    white-space:normal;
}


/* =====================================================
   DELIVERY
   ===================================================== */

.delivery-row{
    display:grid;

    grid-template-columns:repeat(2,1fr);

    gap:8px;

    margin-top:8px;
}

.delivery-box{
    background:#f7f1ec;

    border:1px solid #e5d7ce;

    border-radius:9px;

    padding:10px 11px;
}

.delivery-box strong{
    display:block;


    color:#765546;

    font-size:9px;

    font-weight:700;

    text-transform:uppercase;

    letter-spacing:.5px;

    margin-bottom:5px;
}

.delivery-box span{
    color:#2f2925;

    font-size:12px;

    font-weight:600;
}


/* =====================================================
   BOTTOM AREA
   ===================================================== */

.order-bottom{
    margin-top:13px;

    padding-top:12px;

    border-top:1px solid #e8ddd7;

    display:flex;

    justify-content:space-between;

    align-items:center;

    gap:15px;
}

.total-label{
    color:#665b55;

    font-size:10px;

    font-weight:600;

    text-transform:uppercase;

    letter-spacing:.5px;
}

.total-amount{
    color:#2f211b;

    font-size:24px;

    font-weight:700;

    margin-top:2px;
}


/* =====================================================
   BUTTONS
   ===================================================== */

.order-actions{
    display:flex;

    align-items:center;

    justify-content:flex-end;

    flex-wrap:wrap;

    gap:7px;
}

.order-actions form{
    margin:0;
}

.order-btn{
    display:inline-block;

    border:none;

    border-radius:7px;

    padding:8px 13px;

    font-size:10px;

    font-weight:bold;

    cursor:pointer;

    text-decoration:none;

    transition:.2s;

    font-family:Arial,sans-serif;
}

.order-btn:hover{
    opacity:.85;

    transform:translateY(-1px);
}


/* =====================================================
   TAX INVOICE
   ===================================================== */

.invoice-btn{
    background:#eee3dc;

    color:#5a3e2b;

    border:1px solid #d5c1b5;
}


/* =====================================================
   BUY AGAIN
   ===================================================== */

.buy-btn{
    background:#5a3e2b;

    color:#ffffff;

    border:1px solid #5a3e2b;
}


/* =====================================================
   CANCEL
   ===================================================== */

.cancel-btn{
    background:#f3d9d4;

    color:#982f24;

    border:1px solid #e4b8b0;
}


/* =====================================================
   RETURN
   ===================================================== */

.return-btn{
    background:#e9ddd6;

    color:#5a3e2b;

    border:1px solid #cdb9ad;
}


/* =====================================================
   NO ORDERS
   ===================================================== */

.no-orders{
    background:#ffffff;

    border:1px solid #dfd2c9;

    border-radius:15px;

    text-align:center;

    padding:60px 20px;

    box-shadow:0 5px 18px rgba(73,48,36,.07);
}

.no-orders h2{
    color:#4b3023;

    margin:0 0 8px;

    font-family:Georgia,serif;
}

.no-orders p{
    color:#81756e;

    margin:0 0 20px;

    font-size:13px;
}

.shop-btn{
    display:inline-block;

    padding:10px 22px;

    background:#5a3e2b;

    color:#ffffff;

    text-decoration:none;

    border-radius:7px;

    font-size:11px;

    font-weight:bold;

    transition:.2s;
}

.shop-btn:hover{
    background:#765546;

    color:#ffffff;
}


/* =====================================================
   TABLET
   ===================================================== */

@media(max-width:850px){

    .orders-page{
        width:94%;
    }

    .order-details{
        grid-template-columns:repeat(2,1fr);
    }

    .order-top{
        align-items:flex-start;
    }

}


/* =====================================================
   MOBILE
   ===================================================== */

@media(max-width:600px){

    .orders-page{
        width:94%;

        margin:25px auto 45px;
    }

    .orders-title{
        font-size:30px;
    }

    .orders-subtitle{
        font-size:12px;
    }

    .user-box{
        padding:14px;
    }

    .user-left h3{
        font-size:18px;
    }

    .order-top{
        padding:11px 12px;

        flex-direction:column;

        align-items:flex-start;
    }

    .order-header-left{
        width:100%;
    }

    .order-top > .status{
        align-self:flex-start;
    }

    .order-body{
        padding:13px;
    }

    .product-row{
        align-items:flex-start;
    }

    .product-name{
        font-size:12px;

        font-weight:700;
    }

    .product-qty{
        font-size:9px;

        font-weight:500;
    }

    .product-price{
        font-size:12px;

        font-weight:700;
    }

    .order-details{
        grid-template-columns:repeat(2,1fr);
    }

    .delivery-row{
        grid-template-columns:1fr;
    }

    .delivery-box span{
        font-size:11px;

        font-weight:600;
    }

    .detail-box span{
        font-size:10px;

        font-weight:600;
    }

    .order-bottom{
        display:block;
    }

    .order-actions{
        justify-content:flex-start;

        margin-top:12px;
    }

}


/* =====================================================
   SMALL MOBILE
   ===================================================== */

@media(max-width:420px){

    .orders-title{
        font-size:27px;
    }

    .order-details{
        grid-template-columns:1fr;
    }

    .order-number{
        font-size:11px;

        padding:6px 9px;
    }

    .order-date{
        font-size:10px;
    }

    .product-row{
        padding:9px;
    }

    .product-name{
        font-size:12px;

        font-weight:700;
    }

    .product-qty{
        font-size:9px;

        font-weight:500;
    }

    .product-price{
        font-size:11px;

        font-weight:700;

        margin-left:8px;
    }

    .detail-box strong{
        font-size:9px;
    }

    .detail-box span{
        font-size:10px;

        font-weight:600;
    }

    .delivery-box span{
        font-size:10px;

        font-weight:600;
    }

    .return-approved-message,
    .return-rejected-message{
        font-size:10px;
    }

    .total-amount{
        font-size:21px;

        font-weight:700;
    }

    .order-btn{
        padding:7px 9px;

        font-size:9px;
    }

}

</style>

</head>


<body>


<?php include("header.php"); ?>

<div class="orders-page">


    <!-- =================================================
         TITLE
         ================================================= -->

    <div class="heading-area">

        <div class="heading-line"></div>

        <h1 class="orders-title">
            My Orders
        </h1>

        <p class="orders-subtitle">
            View and manage all your previous orders
        </p>

    </div>


    <!-- =================================================
         USER INFORMATION
         ================================================= -->

    <div class="user-box">

        <div class="user-left">

            <h3>
                <?php
                echo htmlspecialchars($user_name);
                ?>
            </h3>

            <p>
                Email:
                <?php
                echo htmlspecialchars($user_email);
                ?>
            </p>

        </div>

        <div class="user-label">
            My Account
        </div>

    </div>


<?php

if(count($orders) > 0)

{

?>

    <!-- =================================================
         ORDERS LIST
         ================================================= -->

    <div class="orders-list">

<?php

foreach($orders as $order_number => $order_items)

{

    /* FIRST PRODUCT */

    $first = $order_items[0];


    /* CURRENT STATUS */

    $current_status = $first['order_status'];


    /* =================================================
       TOTAL
       ================================================= */

    $order_total = 0;

    foreach($order_items as $item)
    {
        $order_total += $item['total_amount'];
    }


    /* =================================================
       ORDER DATE
       ================================================= */

    $order_date = '';

    if(!empty($first['created_at']))
    {
        $order_date = date(
            "d M Y, h:i A",
            strtotime($first['created_at'])
        );
    }


    /* =================================================
       EXPECTED DELIVERY
       ================================================= */

    $expected_delivery = '';

    if(!empty($first['created_at']))
    {
        $expected_delivery = date(
            "d M Y",
            strtotime(
                $first['created_at'] . " +5 days"
            )
        );
    }


    /* =================================================
       STATUS CLASS
       ================================================= */

    $status_class = 'status-pending';


    if($current_status == 'Processing')
    {
        $status_class = 'status-processing';
    }

    elseif($current_status == 'Shipped')
    {
        $status_class = 'status-shipped';
    }

    elseif($current_status == 'Delivered')
    {
        $status_class = 'status-delivered';
    }

    elseif($current_status == 'Cancelled')
    {
        $status_class = 'status-cancelled';
    }

    elseif(
        $current_status == 'Return Requested' ||
        $current_status == 'Returned' ||
        $current_status == 'Return Approved' ||
        $current_status == 'Return Rejected'
    )
    {
        $status_class = 'status-return';
    }

?>

        <!-- =================================================
             ORDER CARD
             ================================================= -->

        <div class="order-card">


            <!-- =================================================
                 ORDER HEADER
                 ================================================= -->

            <div class="order-top">

                <div class="order-header-left">

                    <span class="order-number">

                        Order #

                        <?php
                        echo $order_number;
                        ?>

                    </span>


                    <span class="order-date">

                        <?php
                        echo $order_date;
                        ?>

                    </span>

                </div>


                <span class="status <?php echo $status_class; ?>">

                    <?php
                    echo htmlspecialchars(
                        $current_status
                    );
                    ?>

                </span>

            </div>


            <!-- =================================================
                 ORDER BODY
                 ================================================= -->

            <div class="order-body">


                <!-- =================================================
                     PRODUCTS
                     ================================================= -->

                <div class="products-title">

                    Products in this order

                </div>


<?php

foreach($order_items as $item)

{

?>

                <div class="product-row">

                    <div class="product-left">

                        <div class="product-name">

                            <?php
                            echo htmlspecialchars(
                                $item['product_name']
                            );
                            ?>

                        </div>


                        <div class="product-qty">

                            Unit:

                            ₹<?php
                            echo number_format(
                                $item['price'],
                                0
                            );
                            ?>

                            &nbsp; • &nbsp;

                            Qty:

                            <?php
                            echo $item['quantity'];
                            ?>

                        </div>

                    </div>


                    <div class="product-price">

                        ₹<?php
                        echo number_format(
                            $item['total_amount'],
                            0
                        );
                        ?>

                    </div>

                </div>


<?php

}

?>


                <!-- =================================================
                     CUSTOMER DETAILS
                     ================================================= -->

                <div class="order-details">


                    <!-- CUSTOMER -->

                    <div class="detail-box">

                        <strong>
                            Customer
                        </strong>

                        <span>

                            <?php
                            echo htmlspecialchars(
                                $first['customer_name']
                            );
                            ?>

                        </span>

                    </div>


                    <!-- PHONE -->

                    <div class="detail-box">

                        <strong>
                            Phone
                        </strong>

                        <span>

                            <?php
                            echo htmlspecialchars(
                                $first['customer_phone']
                            );
                            ?>

                        </span>

                    </div>


                    <!-- EMAIL -->

                    <div class="detail-box">

                        <strong>
                            Email
                        </strong>

                        <span>

                            <?php
                            echo htmlspecialchars(
                                $first['customer_email']
                            );
                            ?>

                        </span>

                    </div>


                    <!-- PAYMENT -->

                    <div class="detail-box">

                        <strong>
                            Payment
                        </strong>

                        <span>

                            <?php
                            echo htmlspecialchars(
                                $first['payment_method']
                            );
                            ?>

                        </span>

                    </div>


                    <!-- ADDRESS -->

                    <div class="detail-box">

                        <strong>
                            Address
                        </strong>

                        <span>

                            <?php
                            echo htmlspecialchars(
                                $first['customer_address']
                            );
                            ?>

                        </span>

                    </div>


                    <!-- STATUS -->

                    <div class="detail-box">

                        <strong>
                            Status
                        </strong>

                        <span class="status <?php echo $status_class; ?>">

                            <?php
                            echo htmlspecialchars(
                                $current_status
                            );
                            ?>

                        </span>


                        <?php if($current_status == 'Return Approved') { ?>

                            <div class="return-approved-message">

                                Your return request has been approved successfully.

                                You can now choose another product in place of your returned product.

                            </div>

                        <?php } ?>


                        <?php if($current_status == 'Return Rejected') { ?>

                            <div class="return-rejected-message">

                                Sorry, your return request could not be approved.

                            </div>

                        <?php } ?>

                    </div>

                </div>


<?php

if(
    $current_status != 'Cancelled' &&
    $current_status != 'Return Requested' &&
    $current_status != 'Returned' &&
    $current_status != 'Return Approved' &&
    $current_status != 'Return Rejected'
)

{

?>


                <!-- =================================================
                     DELIVERY
                     ================================================= -->

                <div class="delivery-row">

                    <div class="delivery-box">

                        <strong>
                            Order Placed
                        </strong>

                        <span>

                            <?php
                            echo date(
                                "d M Y",
                                strtotime(
                                    $first['created_at']
                                )
                            );
                            ?>

                        </span>

                    </div>


                    <div class="delivery-box">

                        <strong>
                            Expected Delivery
                        </strong>

                        <span>

                            <?php
                            echo $expected_delivery;
                            ?>

                        </span>

                    </div>

                </div>


<?php

}

?>


                <!-- =================================================
                     ORDER BOTTOM
                     ================================================= -->

                <div class="order-bottom">


                    <div>

                        <div class="total-label">

                            Grand Total

                        </div>


                        <div class="total-amount">

                            ₹<?php
                            echo number_format(
                                $order_total,
                                0
                            );
                            ?>

                        </div>

                    </div>


                    <!-- =================================================
                         ACTION BUTTONS
                         ================================================= -->

                    <div class="order-actions">


                        <!-- TAX INVOICE -->

                        <a
                            href="tax.php?order_number=<?php echo $order_number; ?>"
                            class="order-btn invoice-btn"
                        >

                            Tax Invoice

                        </a>


<?php

if(
    $current_status == 'Pending' ||
    $current_status == 'Processing'
)

{

?>

                        <!-- CANCEL ORDER -->

                        <form method="post">

                            <input
                                type="hidden"
                                name="order_number"
                                value="<?php
                                echo $order_number;
                                ?>"
                            >

                            <button
                                type="submit"
                                name="cancel_order"
                                class="order-btn cancel-btn"
                                onclick="return confirm('Are you sure you want to cancel this order?');"
                            >

                                Cancel Order

                            </button>

                        </form>


<?php

}

?>


<?php

if($current_status == 'Delivered')

{

?>

                        <!-- RETURN ORDER -->

                        <form method="post">

                            <input
                                type="hidden"
                                name="order_number"
                                value="<?php
                                echo $order_number;
                                ?>"
                            >

                            <button
                                type="submit"
                                name="return_order"
                                class="order-btn return-btn"
                                onclick="return confirm('Are you sure you want to return this order?');"
                            >

                                Return Order

                            </button>

                        </form>


<?php

}

?>


                        <!-- BUY AGAIN -->

                        <button
                            type="button"
                            class="order-btn buy-btn"
                            onclick="window.location='index.php'"
                        >

                            Buy Again

                        </button>


                    </div>

                </div>


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


    <!-- =================================================
         NO ORDERS
         ================================================= -->

    <div class="no-orders">

        <h2>
            No Orders Yet
        </h2>

        <p>
            You have not placed any orders yet.
        </p>

        <a
            href="index.php"
            class="shop-btn"
        >

            Continue Shopping

        </a>

    </div>


<?php

}

?>


</div>


</body>

</html>