<?php

session_start();

if(!isset($_SESSION['admin']))
{
    header("Location:login.php");
    exit();
}

include("../connection.php");


/* =====================================================
   POPUP VARIABLES
===================================================== */

$show_success = false;
$success_message = "";


/* =====================================================
   UPDATE NORMAL ORDER STATUS
===================================================== */

if(isset($_POST['update_status']))
{
    $order_id = intval($_POST['order_id']);

    $order_status = mysqli_real_escape_string(
        $con,
        $_POST['order_status']
    );

    $get_order = mysqli_query(
        $con,
        "SELECT order_number, user_id
         FROM orders
         WHERE id='$order_id'"
    );

    if(!$get_order)
    {
        die("Order Error: " . mysqli_error($con));
    }

    $order_data = mysqli_fetch_assoc($get_order);

    if($order_data)
    {
        $order_number = $order_data['order_number'];
        $user_id      = $order_data['user_id'];

        if($order_number > 0 && !empty($user_id))
        {
            $update_sql = "
                UPDATE orders
                SET order_status='$order_status'
                WHERE order_number='$order_number'
                AND user_id='$user_id'
            ";
        }
        else
        {
            $update_sql = "
                UPDATE orders
                SET order_status='$order_status'
                WHERE id='$order_id'
            ";
        }

        if(!mysqli_query($con, $update_sql))
        {
            die(
                "Status Update Error: "
                . mysqli_error($con)
            );
        }

        $show_success = true;
        $success_message = "Order Status Updated Successfully";
    }
}


/* =====================================================
   APPROVE RETURN
===================================================== */

if(isset($_POST['approve_return']))
{
    $order_id = intval($_POST['order_id']);

    $check = mysqli_query(
        $con,
        "SELECT order_number, user_id
         FROM orders
         WHERE id='$order_id'
         AND order_status='Return Requested'"
    );

    if(!$check)
    {
        die(
            "Return Check Error: "
            . mysqli_error($con)
        );
    }

    if(mysqli_num_rows($check) > 0)
    {
        $order_data = mysqli_fetch_assoc($check);

        $order_number = $order_data['order_number'];
        $user_id      = $order_data['user_id'];

        if($order_number > 0 && !empty($user_id))
        {
            $update_return = mysqli_query(
                $con,
                "UPDATE orders
                 SET order_status='Return Approved'
                 WHERE order_number='$order_number'
                 AND user_id='$user_id'"
            );
        }
        else
        {
            $update_return = mysqli_query(
                $con,
                "UPDATE orders
                 SET order_status='Return Approved'
                 WHERE id='$order_id'"
            );
        }

        if(!$update_return)
        {
            die(
                "Return Approval Error: "
                . mysqli_error($con)
            );
        }

        $show_success = true;
        $success_message = "Return Approved Successfully";
    }
}


/* =====================================================
   REJECT RETURN
===================================================== */

if(isset($_POST['reject_return']))
{
    $order_id = intval($_POST['order_id']);

    $check = mysqli_query(
        $con,
        "SELECT order_number, user_id
         FROM orders
         WHERE id='$order_id'
         AND order_status='Return Requested'"
    );

    if(!$check)
    {
        die(
            "Return Check Error: "
            . mysqli_error($con)
        );
    }

    if(mysqli_num_rows($check) > 0)
    {
        $order_data = mysqli_fetch_assoc($check);

        $order_number = $order_data['order_number'];
        $user_id      = $order_data['user_id'];

        if($order_number > 0 && !empty($user_id))
        {
            $update_return = mysqli_query(
                $con,
                "UPDATE orders
                 SET order_status='Return Rejected'
                 WHERE order_number='$order_number'
                 AND user_id='$user_id'"
            );
        }
        else
        {
            $update_return = mysqli_query(
                $con,
                "UPDATE orders
                 SET order_status='Return Rejected'
                 WHERE id='$order_id'"
            );
        }

        if(!$update_return)
        {
            die(
                "Return Rejection Error: "
                . mysqli_error($con)
            );
        }

        $show_success = true;
        $success_message = "Return Request Rejected";
    }
}

?>


<?php

include("heder.php");
include("sidebar.php");

?>


<!-- =====================================================
     FONT AWESOME
===================================================== -->

<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
>


<style>

/* =====================================================
   MAIN CONTENT
===================================================== */

.content{

    margin-left:240px;

    margin-top:70px;

    padding:25px;

    background:#f7f4f1;

    min-height:calc(100vh - 70px);

}


/* =====================================================
   PAGE HEADER
===================================================== */

.page-header{

    margin-bottom:20px;

}


.page-header h2{

    margin:0;

    color:#5a3e2b;

    font-size:27px;

    font-family:Georgia,serif;

}


/* =====================================================
   RETURN INFORMATION
===================================================== */

.return-info{

    background:#f3ebe6;

    border-left:5px solid #8B6B61;

    padding:13px 16px;

    margin-bottom:20px;

    border-radius:8px;

    color:#5a3e2b;

    font-size:13px;

}


.return-info strong{

    color:#6D4C41;

}


/* =====================================================
   TABLE BOX
===================================================== */

.order-table-box{

    background:#fff;

    padding:10px;

    border-radius:14px;

    box-shadow:
        0 5px 20px rgba(90,62,43,.12);

    width:100%;

    overflow:hidden;

}


/* =====================================================
   TABLE
===================================================== */

.order-table{

    width:100%;

    table-layout:fixed;

    border-collapse:collapse;

}


/* =====================================================
   TABLE HEADER
===================================================== */

.order-table th{

    background:#8B6B61;

    color:#fff;

    padding:10px 4px;

    text-align:center;

    font-size:10px;

    font-weight:bold;

    word-break:break-word;

}


/* =====================================================
   TABLE DATA
===================================================== */

.order-table td{

    padding:9px 4px;

    border-bottom:1px solid #eee;

    color:#444;

    vertical-align:middle;

    text-align:center;

    font-size:10px;

    word-break:break-word;

    overflow-wrap:anywhere;

}


/* =====================================================
   HOVER
===================================================== */

.order-table tr:hover td{

    background:#faf6f3;

}


/* =====================================================
   ORDER NUMBER
===================================================== */

.order-id{

    font-weight:bold;

    color:#6D4C41;

    font-size:12px !important;

}


/* =====================================================
   CUSTOMER
===================================================== */

.customer-name{

    font-weight:bold;

    color:#5a3e2b;

}


.customer-email{

    color:#555;

    word-break:break-all;

}


.customer-phone{

    word-break:break-word;

}


/* =====================================================
   ADDRESS
===================================================== */

.customer-address{

    line-height:15px;

    color:#666;

}


/* =====================================================
   PRODUCT
===================================================== */

.product-name{

    font-weight:bold;

    color:#5a3e2b;

}


/* =====================================================
   QUANTITY
===================================================== */

.quantity{

    text-align:center !important;

    font-weight:bold;

}


/* =====================================================
   PRICE
===================================================== */

.price{

    color:#555;

}


/* =====================================================
   TOTAL
===================================================== */

.total{

    color:#8B4F3F;

    font-weight:bold;

}


/* =====================================================
   PAYMENT
===================================================== */

.payment{

    background:#eee1db;

    color:#6D4C41;

    padding:4px 5px;

    border-radius:15px;

    font-size:9px;

    display:inline-block;

    word-break:break-word;

}


/* =====================================================
   STATUS BOX
===================================================== */

.status-box{

    display:flex;

    flex-direction:column;

    align-items:center;

    gap:5px;

}


/* =====================================================
   STATUS SELECT - SOFT COLORS
===================================================== */

.status-select{

    width:100px;

    padding:5px 4px;

    border-radius:6px;

    font-size:9px;

    font-weight:bold;

    cursor:pointer;

    outline:none;

    text-align:center;

}


/* =====================================================
   PENDING - SOFT YELLOW
===================================================== */

.status-select.pending{

    background:#f6e7b5;

    border:1px solid #ead58f;

    color:#795f20;

}


/* =====================================================
   PROCESSING - SOFT BLUE
===================================================== */

.status-select.processing{

    background:#d9e6f5;

    border:1px solid #b9cfe5;

    color:#4b6680;

}


/* =====================================================
   SHIPPED - SOFT PURPLE
===================================================== */

.status-select.shipped{

    background:#e5d9ee;

    border:1px solid #ccb9db;

    color:#6b5478;

}


/* =====================================================
   DELIVERED - SOFT GREEN
===================================================== */

.status-select.delivered{

    background:#dcebdc;

    border:1px solid #bdd7bd;

    color:#4f704f;

}


/* =====================================================
   CANCELLED - SOFT RED
===================================================== */

.status-select.cancelled{

    background:#f1d8d5;

    border:1px solid #dfbbb7;

    color:#87534e;

}


.status-select:focus{

    box-shadow:
        0 0 0 2px
        rgba(139,107,97,.12);

}


/* =====================================================
   DROPDOWN OPTION COLORS
===================================================== */

.status-select option[value="Pending"]{

    background:#f6e7b5;

    color:#795f20;

}


.status-select option[value="Processing"]{

    background:#d9e6f5;

    color:#4b6680;

}


.status-select option[value="Shipped"]{

    background:#e5d9ee;

    color:#6b5478;

}


.status-select option[value="Delivered"]{

    background:#dcebdc;

    color:#4f704f;

}


.status-select option[value="Cancelled"]{

    background:#f1d8d5;

    color:#87534e;

}


/* =====================================================
   UPDATE BUTTON
===================================================== */

.update-btn{

    width:100px;

    padding:5px 4px;

    border:none;

    border-radius:6px;

    background:#5a3e2b;

    color:#fff;

    font-size:9px;

    font-weight:bold;

    cursor:pointer;

}


.update-btn:hover{

    background:#6D4C41;

}


/* =====================================================
   RETURN REQUESTED
===================================================== */

.return-request{

    display:inline-block;

    background:#f1e6df;

    color:#6D4C41;

    border:1px solid #d6c0b5;

    padding:5px 8px;

    border-radius:6px;

    font-size:9px;

    font-weight:bold;

    line-height:13px;

}


/* =====================================================
   RETURN PENDING
===================================================== */

.return-pending{

    color:#8B6B61;

    font-size:8px;

    font-weight:bold;

    letter-spacing:.3px;

}


/* =====================================================
   APPROVE RETURN BUTTON
===================================================== */

.approve-btn{

    width:105px;

    padding:6px 4px;

    border:none;

    border-radius:6px;

    background:#8B6B61;

    color:#fff;

    font-size:9px;

    font-weight:bold;

    cursor:pointer;

}


.approve-btn:hover{

    background:#6D4C41;

}


/* =====================================================
   REJECT RETURN BUTTON
===================================================== */

.reject-btn{

    width:105px;

    padding:6px 4px;

    border:none;

    border-radius:6px;

    background:#b08b7d;

    color:#fff;

    font-size:9px;

    font-weight:bold;

    cursor:pointer;

}


.reject-btn:hover{

    background:#8B6B61;

}


/* =====================================================
   RETURN APPROVED
===================================================== */

.return-approved{

    display:inline-block;

    background:#e9dfd9;

    color:#5a3e2b;

    border:1px solid #cdb9ad;

    padding:5px 7px;

    border-radius:6px;

    font-size:9px;

    font-weight:bold;

}


/* =====================================================
   RETURN REJECTED
===================================================== */

.return-rejected{

    display:inline-block;

    background:#eee4df;

    color:#795548;

    border:1px solid #d2beb3;

    padding:5px 7px;

    border-radius:6px;

    font-size:9px;

    font-weight:bold;

}


/* =====================================================
   DATE
===================================================== */

.order-date{

    color:#666;

    font-size:9px !important;

    word-break:break-word;

    line-height:14px;

}


/* =====================================================
   NO ORDER
===================================================== */

.no-order{

    text-align:center !important;

    padding:40px;

    color:#777;

    font-size:16px !important;

}


/* =====================================================
   COLUMN WIDTH
===================================================== */

.order-table th:nth-child(1),
.order-table td:nth-child(1){

    width:6%;

}


.order-table th:nth-child(2),
.order-table td:nth-child(2){

    width:9%;

}


.order-table th:nth-child(3),
.order-table td:nth-child(3){

    width:10%;

}


.order-table th:nth-child(4),
.order-table td:nth-child(4){

    width:7%;

}


.order-table th:nth-child(5),
.order-table td:nth-child(5){

    width:11%;

}


.order-table th:nth-child(6),
.order-table td:nth-child(6){

    width:11%;

}


.order-table th:nth-child(7),
.order-table td:nth-child(7){

    width:5%;

}


.order-table th:nth-child(8),
.order-table td:nth-child(8){

    width:8%;

}


.order-table th:nth-child(9),
.order-table td:nth-child(9){

    width:8%;

}


.order-table th:nth-child(10),
.order-table td:nth-child(10){

    width:8%;

}


.order-table th:nth-child(11),
.order-table td:nth-child(11){

    width:9%;

}


.order-table th:nth-child(12),
.order-table td:nth-child(12){

    width:8%;

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

@media(max-width:1100px){

    .content{

        margin-left:240px;

        padding:15px;

    }


    .order-table th{

        font-size:9px;

        padding:8px 3px;

    }


    .order-table td{

        font-size:9px;

        padding:8px 3px;

    }

}

</style>


<!-- =====================================================
     MAIN CONTENT
===================================================== -->

<div class="content">


    <div class="page-header">

        <h2>

            <i class="fas fa-shopping-bag"></i>

            Manage Orders

        </h2>

    </div>


    <div class="order-table-box">

        <table class="order-table">


            <tr>

                <th>Order No.</th>

                <th>Customer</th>

                <th>Email</th>

                <th>Phone</th>

                <th>Address</th>

                <th>Product</th>

                <th>Qty</th>

                <th>Price</th>

                <th>Total</th>

                <th>Payment</th>

                <th>Status</th>

                <th>Date</th>

            </tr>


<?php

$result = mysqli_query(

    $con,

    "SELECT *
     FROM orders
     ORDER BY created_at ASC, id ASC"

);


if(!$result)
{
    die(
        "Database Error: "
        . mysqli_error($con)
    );
}


$order_display_number = 1;


if(mysqli_num_rows($result) > 0)
{

    while($row = mysqli_fetch_assoc($result))
    {

?>

            <tr>


                <td class="order-id">

                    <?php

                    echo $order_display_number;

                    ?>

                </td>


                <td class="customer-name">

                    <?php

                    echo htmlspecialchars(
                        $row['customer_name']
                    );

                    ?>

                </td>


                <td class="customer-email">

                    <?php

                    echo htmlspecialchars(
                        $row['customer_email']
                    );

                    ?>

                </td>


                <td class="customer-phone">

                    <?php

                    echo htmlspecialchars(
                        $row['customer_phone']
                    );

                    ?>

                </td>


                <td class="customer-address">

                    <?php

                    echo htmlspecialchars(
                        $row['customer_address']
                    );

                    ?>

                </td>


                <td class="product-name">

                    <?php

                    echo htmlspecialchars(
                        $row['product_name']
                    );

                    ?>

                </td>


                <td class="quantity">

                    <?php

                    echo $row['quantity'];

                    ?>

                </td>


                <td class="price">

                    RS.

                    <?php

                    echo number_format(
                        $row['price'],
                        0
                    );

                    ?>

                </td>


                <td class="total">

                    RS.

                    <?php

                    echo number_format(
                        $row['total_amount'],
                        0
                    );

                    ?>

                </td>


                <td>

                    <span class="payment">

                        <?php

                        echo htmlspecialchars(
                            $row['payment_method']
                        );

                        ?>

                    </span>

                </td>


                <td>


<?php

if($row['order_status'] == 'Return Requested')
{

?>

                    <div style="
                        display:flex;
                        flex-direction:column;
                        align-items:center;
                        gap:5px;
                    ">


                        <span class="return-request">

                            <i class="fas fa-undo"></i>

                            Return Requested

                        </span>


                        <small class="return-pending">

                            PENDING

                        </small>


                        <form method="POST">

                            <input
                                type="hidden"
                                name="order_id"
                                value="<?php echo $row['id']; ?>"
                            >

                            <button
                                type="submit"
                                name="approve_return"
                                class="approve-btn"
                            >

                                Approve Return

                            </button>

                        </form>


                        <form method="POST">

                            <input
                                type="hidden"
                                name="order_id"
                                value="<?php echo $row['id']; ?>"
                            >

                            <button
                                type="submit"
                                name="reject_return"
                                class="reject-btn"
                            >

                                Reject Return

                            </button>

                        </form>


                    </div>


<?php

}

elseif($row['order_status'] == 'Return Approved')
{

?>

                    <span class="return-approved">

                        <i class="fas fa-check-circle"></i>

                        Return Approved

                    </span>


<?php

}

elseif($row['order_status'] == 'Return Rejected')
{

?>

                    <span class="return-rejected">

                        <i class="fas fa-times-circle"></i>

                        Return Rejected

                    </span>


<?php

}

else
{

    $status_class = strtolower(
        $row['order_status']
    );

?>

                    <form
                        method="POST"
                        class="status-box"
                    >

                        <input
                            type="hidden"
                            name="order_id"
                            value="<?php echo $row['id']; ?>"
                        >


                        <select
                            name="order_status"
                            class="status-select <?php echo $status_class; ?>"
                            required
                        >


                            <option
                                value="Pending"

                                <?php

                                if(
                                    $row['order_status']
                                    ==
                                    'Pending'
                                )
                                {
                                    echo 'selected';
                                }

                                ?>

                            >

                                Pending

                            </option>


                            <option
                                value="Processing"

                                <?php

                                if(
                                    $row['order_status']
                                    ==
                                    'Processing'
                                )
                                {
                                    echo 'selected';
                                }

                                ?>

                            >

                                Processing

                            </option>


                            <option
                                value="Shipped"

                                <?php

                                if(
                                    $row['order_status']
                                    ==
                                    'Shipped'
                                )
                                {
                                    echo 'selected';
                                }

                                ?>

                            >

                                Shipped

                            </option>


                            <option
                                value="Delivered"

                                <?php

                                if(
                                    $row['order_status']
                                    ==
                                    'Delivered'
                                )
                                {
                                    echo 'selected';
                                }

                                ?>

                            >

                                Delivered

                            </option>


                            <option
                                value="Cancelled"

                                <?php

                                if(
                                    $row['order_status']
                                    ==
                                    'Cancelled'
                                )
                                {
                                    echo 'selected';
                                }

                                ?>

                            >

                                Cancelled

                            </option>


                        </select>


                        <button
                            type="submit"
                            name="update_status"
                            class="update-btn"
                        >

                            Update

                        </button>


                    </form>


<?php

}

?>


                </td>


                <td class="order-date">

                    <?php

                    echo date(
                        "d-m-Y",
                        strtotime(
                            $row['created_at']
                        )
                    );

                    ?>

                    <br>

                    <?php

                    echo date(
                        "h:i A",
                        strtotime(
                            $row['created_at']
                        )
                    );

                    ?>

                </td>


            </tr>


<?php

        $order_display_number++;

    }

}

else

{

?>

            <tr>

                <td
                    colspan="12"
                    class="no-order"
                >

                    <i class="fas fa-box-open"></i>

                    <br><br>

                    No Orders Found

                </td>

            </tr>


<?php

}

?>


        </table>

    </div>


</div>


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
            onclick="window.location='order.php'"
        >

            OK

        </button>

    </div>

</div>

<?php } ?>


</body>

</html>