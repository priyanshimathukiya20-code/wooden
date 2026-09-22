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

?>


<style>

/* ============================= */
/* MAIN CONTENT */
/* ============================= */

.content{

    margin-left:240px;

    margin-top:70px;

    padding:35px;

    background:#f7f4f1;

    min-height:calc(100vh - 70px);

}


/* ============================= */
/* PAGE HEADER */
/* ============================= */

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


/* ============================= */
/* TABLE BOX */
/* ============================= */

.contact-table-box{

    background:white;

    padding:20px;

    border-radius:14px;

    box-shadow:
    0 5px 20px rgba(90,62,43,.12);

    overflow-x:auto;

}


/* ============================= */
/* TABLE */
/* ============================= */

.contact-table{

    width:100%;

    border-collapse:separate;

    border-spacing:0;

}


/* ============================= */
/* TABLE HEADER */
/* ============================= */

.contact-table th{

    background:#8B6B61;

    color:white;

    padding:15px 12px;

    text-align:left;

    font-size:14px;

    letter-spacing:.3px;

}


.contact-table th:first-child{

    border-top-left-radius:8px;

}


.contact-table th:last-child{

    border-top-right-radius:8px;

}


/* ============================= */
/* TABLE DATA */
/* ============================= */

.contact-table td{

    padding:14px 12px;

    border-bottom:1px solid #eee;

    color:#444;

    vertical-align:middle;

}


/* ============================= */
/* ROW HOVER */
/* ============================= */

.contact-table tr:hover td{

    background:#faf6f3;

}


/* ============================= */
/* ID */
/* ============================= */

.contact-id{

    font-weight:bold;

    color:#6D4C41;

}


/* ============================= */
/* RATING */
/* ============================= */

.rating{

    white-space:nowrap;

    color:#d4a017;

    font-size:20px;

    letter-spacing:2px;

}


/* ============================= */
/* RATING NUMBER */
/* ============================= */

.rating-number{

    color:#777;

    font-size:12px;

    margin-left:5px;

    letter-spacing:0;

}


/* ============================= */
/* EMAIL */
/* ============================= */

.email{

    color:#555;

    font-size:14px;

}


/* ============================= */
/* SUBJECT */
/* ============================= */

.subject{

    font-weight:bold;

    color:#6D4C41;

}


/* ============================= */
/* MESSAGE */
/* ============================= */

.message{

    max-width:350px;

    line-height:21px;

    color:#666;

}


/* ============================= */
/* DELETE BUTTON */
/* ============================= */

.delete-btn{

    display:inline-flex;

    align-items:center;

    gap:5px;

    padding:8px 12px;

    background:#B07A6A;

    color:white;

    text-decoration:none;

    border-radius:6px;

    font-size:13px;

    font-weight:500;

}


.delete-btn:hover{

    background:#8B5E50;

}


/* ============================= */
/* NO CONTACT */
/* ============================= */

.no-contact{

    text-align:center;

    padding:50px;

    color:#777;

    font-size:18px;

}


/* ============================= */
/* RESPONSIVE */
/* ============================= */

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


<!-- ============================= -->
<!-- MAIN CONTENT -->
<!-- ============================= -->

<div class="content">


<!-- ============================= -->
<!-- PAGE HEADER -->
<!-- ============================= -->

<div class="page-header">

    <h2>

        <i class="fas fa-envelope"></i>

        Manage Contacts

    </h2>

</div>


<!-- ============================= -->
<!-- CONTACT TABLE -->
<!-- ============================= -->

<div class="contact-table-box">


<table class="contact-table">


<tr>

    <th>ID</th>

    <th>Rating</th>

    <th>Email</th>

    <th>Subject</th>

    <th>Message</th>

    <th>Action</th>

</tr>


<?php

$result = mysqli_query(
    $con,
    "SELECT * FROM contact ORDER BY id DESC"
);


if(!$result)
{
    die("Database Error: " . mysqli_error($con));
}


if(mysqli_num_rows($result) > 0)
{

    while($row = mysqli_fetch_assoc($result))
    {

?>


<tr>


<!-- ============================= -->
<!-- ID -->
<!-- ============================= -->

<td class="contact-id">

    <?php echo $row['id']; ?>

</td>


<!-- ============================= -->
<!-- RATING -->
<!-- ============================= -->

<td class="rating">

    <?php

    $rating = intval($row['rating']);

    for($i = 1; $i <= 5; $i++)
    {

        if($i <= $rating)
        {
            echo "&#9733;";
        }
        else
        {
            echo "&#9734;";
        }

    }

    ?>

    <span class="rating-number">

        (<?php echo $rating; ?>/5)

    </span>

</td>


<!-- ============================= -->
<!-- EMAIL -->
<!-- ============================= -->

<td class="email">

    <?php echo htmlspecialchars($row['email']); ?>

</td>


<!-- ============================= -->
<!-- SUBJECT -->
<!-- ============================= -->

<td class="subject">

    <?php echo htmlspecialchars($row['subject']); ?>

</td>


<!-- ============================= -->
<!-- MESSAGE -->
<!-- ============================= -->

<td class="message">

    <?php echo htmlspecialchars($row['message']); ?>

</td>


<!-- ============================= -->
<!-- ACTION -->
<!-- ============================= -->

<td>

    <a
        href="delet_contact.php?id=<?php echo $row['id']; ?>"
        class="delete-btn"

        onclick="return confirm('Are you sure you want to delete this contact message?');"
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

    <td colspan="6" class="no-contact">

        <i class="fas fa-envelope-open"></i>

        <br><br>

        No Contact Messages Found

    </td>

</tr>


<?php

}

?>


</table>


</div>


</div>


</body>

</html>