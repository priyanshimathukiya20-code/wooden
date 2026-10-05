<?php
session_start();

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

include("connection.php");

$user_id = $_SESSION['user_id'];

if(!isset($_GET['order_number']) || empty($_GET['order_number']))
{
    echo "<script>
            alert('Invalid Order!');
            window.location='my_order.php';
          </script>";
    exit();
}

$order_number = intval($_GET['order_number']);


/* Get Order Details */
$sql = "SELECT *
        FROM orders
        WHERE order_number='$order_number'
        AND user_id='$user_id'
        ORDER BY id ASC";

$result = mysqli_query($con, $sql);

if(!$result || mysqli_num_rows($result) == 0)
{
    echo "<script>
            alert('Order not found!');
            window.location='my_order.php';
          </script>";
    exit();
}


$orders = [];

while($row = mysqli_fetch_assoc($result))
{
    $orders[] = $row;
}


/* First Order Details */
$first_order = $orders[0];

$customer_name    = $first_order['customer_name'];
$customer_email   = $first_order['customer_email'];
$customer_phone   = $first_order['customer_phone'];
$customer_address = $first_order['customer_address'];
$payment_method   = $first_order['payment_method'];
$order_status     = $first_order['order_status'];
$created_at       = $first_order['created_at'];


/* Calculate Total */
$grand_total = 0;

foreach($orders as $order)
{
    $grand_total += floatval($order['total_amount']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Tax Invoice - Woodisty</title>


<!-- PDF LIBRARIES -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>


<style>

*{
    box-sizing:border-box;
}


body{
    margin:0;

    padding:30px;

    background:#f7f4f1;

    font-family:Arial, Helvetica, sans-serif;

    color:#333;
}


/* MAIN INVOICE */

.invoice-container{

    width:100%;

    max-width:1000px;

    margin:auto;

    background:#ffffff;

    border:1px solid #ddd;

    box-shadow:0 5px 20px rgba(0,0,0,0.10);
}


/* HEADER */

.invoice-header{

    background:#5a3e2b;

    color:white;

    padding:25px 35px;

    display:flex;

    justify-content:space-between;

    align-items:center;
}


/* LOGO */

.logo-section{

    display:flex;

    align-items:center;
}


.woodisty-logo{

    width:120px;

    height:70px;

    object-fit:contain;

    display:block;
}


/* INVOICE TITLE */

.invoice-title{

    text-align:right;
}


.invoice-title h2{

    margin:0;

    font-size:28px;
}


.invoice-title p{

    margin:6px 0 0;

    font-size:14px;
}


/* BODY */

.invoice-body{

    padding:30px 35px;
}


/* CUSTOMER INFORMATION */

.info-section{

    display:grid;

    grid-template-columns:1fr 1fr;

    gap:25px;

    margin-bottom:30px;
}


.info-box{

    background:#f7f4f1;

    border:1px solid #e2d8d2;

    padding:18px;

    border-radius:8px;
}


.info-box h3{

    margin:0 0 12px;

    color:#5a3e2b;

    font-size:18px;

    border-bottom:1px solid #d8ccc5;

    padding-bottom:8px;
}


.info-box p{

    margin:7px 0;

    font-size:14px;

    line-height:1.5;
}


.info-box strong{

    color:#5a3e2b;
}


/* ORDER INFORMATION */

.order-info{

    display:flex;

    justify-content:space-between;

    flex-wrap:wrap;

    background:#f7f4f1;

    border-left:5px solid #8B6B61;

    padding:15px 18px;

    margin-bottom:25px;

    gap:15px;
}


.order-info-item{

    font-size:14px;
}


.order-info-item strong{

    color:#5a3e2b;
}


/* PRODUCT TABLE */

.invoice-table{

    width:100%;

    border-collapse:collapse;

    margin-top:10px;
}


.invoice-table th{

    background:#5a3e2b;

    color:#ffffff;

    padding:13px 10px;

    text-align:left;

    font-size:14px;
}


.invoice-table td{

    padding:13px 10px;

    border-bottom:1px solid #e3ddd8;

    font-size:14px;
}


.invoice-table tr:nth-child(even){

    background:#faf8f6;
}


.invoice-table .text-center{

    text-align:center;
}


.invoice-table .text-right{

    text-align:right;
}


/* TOTAL */

.total-section{

    width:350px;

    max-width:100%;

    margin-left:auto;

    margin-top:25px;
}


.total-row{

    display:flex;

    justify-content:space-between;

    padding:10px 15px;

    border-bottom:1px solid #ddd;

    font-size:15px;
}


.total-row.grand-total{

    background:#5a3e2b;

    color:white;

    font-size:20px;

    font-weight:bold;

    border-radius:6px;

    margin-top:5px;
}


/* PAYMENT */

.payment-box{

    margin-top:25px;

    background:#f7f4f1;

    border:1px solid #e2d8d2;

    border-radius:8px;

    padding:16px;
}


.payment-box h3{

    margin:0 0 8px;

    color:#5a3e2b;

    font-size:17px;
}


.payment-box p{

    margin:0;

    font-size:14px;
}


/* FOOTER */

.invoice-footer{

    margin-top:35px;

    padding-top:20px;

    border-top:1px solid #ddd;

    text-align:center;

    color:#777;

    font-size:13px;
}


.invoice-footer strong{

    color:#5a3e2b;
}


/* BUTTONS */

.button-section{

    max-width:1000px;

    margin:20px auto 0;

    display:flex;

    justify-content:center;

    gap:12px;
}


.invoice-btn{

    border:none;

    background:#5a3e2b;

    color:white;

    padding:11px 25px;

    border-radius:6px;

    font-size:14px;

    cursor:pointer;

    text-decoration:none;

    display:inline-block;
}


.invoice-btn:hover{

    background:#6D4C41;
}


.invoice-btn:disabled{

    opacity:0.7;

    cursor:not-allowed;
}


.back-btn{

    background:#8B6B61;
}


.back-btn:hover{

    background:#6D4C41;
}


/* MOBILE */

@media(max-width:700px){

    body{

        padding:10px;
    }


    .invoice-header{

        display:block;

        text-align:center;
    }


    .logo-section{

        display:flex;

        justify-content:center;

        text-align:center;
    }


    .woodisty-logo{

        width:120px;

        height:70px;

        margin:0 auto;

        object-fit:contain;
    }


    .invoice-title{

        text-align:center;

        margin-top:15px;
    }


    .info-section{

        grid-template-columns:1fr;
    }


    .invoice-body{

        padding:20px 15px;
    }


    .invoice-table{

        font-size:12px;
    }


    .invoice-table th,
    .invoice-table td{

        padding:9px 5px;
    }


    .order-info{

        display:block;
    }


    .order-info-item{

        margin-bottom:8px;
    }

}

</style>

</head>


<body>


<!-- INVOICE -->

<div class="invoice-container" id="invoice">


    <!-- HEADER -->

    <div class="invoice-header">


        <!-- WOODISTY LOGO -->

        <div class="logo-section">

            <img
                src="images/logo.png"
                alt="Woodisty Logo"
                class="woodisty-logo"
            >

        </div>


        <!-- INVOICE TITLE -->

        <div class="invoice-title">

            <h2>
                TAX INVOICE
            </h2>

            <p>
                Order No:
                #<?php echo $order_number; ?>
            </p>

        </div>


    </div>



    <div class="invoice-body">


        <!-- CUSTOMER INFORMATION -->

        <div class="info-section">


            <!-- BILL TO -->

            <div class="info-box">

                <h3>
                    Bill To
                </h3>


                <p>

                    <strong>
                        Name:
                    </strong>

                    <?php
                    echo htmlspecialchars(
                        $customer_name
                    );
                    ?>

                </p>


                <p>

                    <strong>
                        Email:
                    </strong>

                    <?php
                    echo htmlspecialchars(
                        $customer_email
                    );
                    ?>

                </p>


                <p>

                    <strong>
                        Phone:
                    </strong>

                    <?php
                    echo htmlspecialchars(
                        $customer_phone
                    );
                    ?>

                </p>

            </div>



            <!-- SHIPPING ADDRESS -->

            <div class="info-box">

                <h3>
                    Shipping Address
                </h3>


                <p>

                    <?php

                    echo nl2br(
                        htmlspecialchars(
                            $customer_address
                        )
                    );

                    ?>

                </p>

            </div>


        </div>



        <!-- ORDER INFORMATION -->

        <div class="order-info">


            <div class="order-info-item">

                <strong>
                    Order Date:
                </strong>

                <br>

                <?php

                echo date(
                    "d-m-Y",
                    strtotime($created_at)
                );

                ?>

            </div>



            <div class="order-info-item">

                <strong>
                    Order Status:
                </strong>

                <br>

                <?php

                echo htmlspecialchars(
                    $order_status
                );

                ?>

            </div>



            <div class="order-info-item">

                <strong>
                    Payment Method:
                </strong>

                <br>

                <?php

                echo htmlspecialchars(
                    $payment_method
                );

                ?>

            </div>


        </div>



        <!-- PRODUCT TABLE -->

        <table class="invoice-table">


            <thead>

                <tr>

                    <th width="6%">
                        #
                    </th>


                    <th>
                        Product Name
                    </th>


                    <th
                        width="12%"
                        class="text-center"
                    >
                        Qty
                    </th>


                    <th
                        width="18%"
                        class="text-right"
                    >
                        Price
                    </th>


                    <th
                        width="20%"
                        class="text-right"
                    >
                        Total
                    </th>

                </tr>

            </thead>



            <tbody>


            <?php

            $i = 1;

            $subtotal = 0;


            foreach($orders as $order)
            {

                $price =
                    floatval(
                        $order['price']
                    );


                $quantity =
                    intval(
                        $order['quantity']
                    );


                $total =
                    floatval(
                        $order['total_amount']
                    );


                $subtotal += $total;

            ?>


                <tr>


                    <td>

                        <?php
                        echo $i;
                        ?>

                    </td>


                    <td>

                        <?php

                        echo htmlspecialchars(
                            $order['product_name']
                        );

                        ?>

                    </td>


                    <td class="text-center">

                        <?php
                        echo $quantity;
                        ?>

                    </td>


                    <td class="text-right">

                        <?php

                        echo number_format(
                            $price,
                            0
                        );

                        ?>

                    </td>


                    <td class="text-right">

                        <?php

                        echo number_format(
                            $total,
                            0
                        );

                        ?>

                    </td>


                </tr>


            <?php

                $i++;

            }

            ?>


            </tbody>

        </table>



        <!-- TOTAL -->

        <div class="total-section">


            <div class="total-row">

                <span>
                    Subtotal
                </span>


                <span>

                    <?php

                    echo number_format(
                        $subtotal,
                        0
                    );

                    ?>

                </span>

            </div>



            <div class="total-row grand-total">

                <span>
                    Grand Total
                </span>


                <span>

                    <?php

                    echo number_format(
                        $grand_total,
                        0
                    );

                    ?>

                </span>

            </div>


        </div>



        <!-- PAYMENT INFORMATION -->

        <div class="payment-box">


            <h3>
                Payment Information
            </h3>


            <p>

                Payment Method:

                <strong>

                    <?php

                    echo htmlspecialchars(
                        $payment_method
                    );

                    ?>

                </strong>

            </p>


        </div>



        <!-- FOOTER -->

        <div class="invoice-footer">


            <p>

                Thank you for shopping with

                <strong>
                    Woodisty Furniture Store
                </strong>.

            </p>


            <p>

                This is a computer generated invoice.

            </p>


        </div>


    </div>

</div>



<!-- BUTTONS -->

<div class="button-section">


    <!-- DOWNLOAD PDF -->

    <button
        type="button"
        class="invoice-btn"
        id="downloadBtn"
        onclick="downloadInvoicePDF()"
    >
        Download PDF
    </button>



    <!-- BACK -->

    <a
        href="my_order.php"
        class="invoice-btn back-btn"
    >
        Back to My Orders
    </a>


</div>



<script>

async function downloadInvoicePDF()
{

    const { jsPDF } = window.jspdf;


    const invoice =
        document.getElementById("invoice");


    const button =
        document.getElementById("downloadBtn");


    if(!invoice)
    {
        alert("Invoice not found!");
        return;
    }


    button.disabled = true;

    button.innerHTML = "Generating PDF...";


    try
    {

        /*
         * Create invoice image
         */

        const canvas =
            await html2canvas(
                invoice,
                {
                    scale:2,

                    useCORS:true,

                    allowTaint:true,

                    backgroundColor:"#ffffff"
                }
            );


        const imgData =
            canvas.toDataURL(
                "image/png"
            );


        /*
         * Create A4 PDF
         */

        const pdf =
            new jsPDF(
                {
                    orientation:"portrait",

                    unit:"mm",

                    format:"a4"
                }
            );


        const pageWidth = 210;

        const pageHeight = 297;

        const margin = 10;


        const imgWidth =
            pageWidth - (margin * 2);


        const imgHeight =
            (canvas.height * imgWidth)
            / canvas.width;


        let heightLeft =
            imgHeight;


        let position =
            margin;


        /*
         * First page
         */

        pdf.addImage(
            imgData,
            "PNG",

            margin,
            position,

            imgWidth,
            imgHeight
        );


        heightLeft -=
            pageHeight - (margin * 2);


        /*
         * Extra pages
         */

        while(heightLeft > 0)
        {

            position =
                heightLeft - imgHeight + margin;


            pdf.addPage();


            pdf.addImage(
                imgData,
                "PNG",

                margin,
                position,

                imgWidth,
                imgHeight
            );


            heightLeft -=
                pageHeight - (margin * 2);

        }


        /*
         * Download PDF
         */

        pdf.save(
            "Woodisty_Tax_Invoice_<?php echo $order_number; ?>.pdf"
        );

    }

    catch(error)
    {

        console.error(error);

        alert(
            "PDF generate karvama problem aavi."
        );

    }


    button.disabled = false;

    button.innerHTML = "Download PDF";

}

</script>


</body>

</html>