<?php

session_start();


/* =========================
   ADMIN LOGIN CHECK
========================= */

if(!isset($_SESSION['admin']))
{
    header("Location:login.php");
    exit();
}


/* =========================
   DATABASE
========================= */

include("../connection.php");


/* =========================
   CONTACT ID CHECK
========================= */

if(!isset($_GET['id']) || empty($_GET['id']))
{
    header("Location:contact.php");
    exit();
}


$id = intval($_GET['id']);


/* =========================
   CHECK CONTACT EXISTS
========================= */

$check_sql = "
    SELECT *
    FROM contact
    WHERE id='$id'
";


$check_result = mysqli_query(
    $con,
    $check_sql
);


if(!$check_result)
{
    die(
        "Database Error: "
        . mysqli_error($con)
    );
}


if(mysqli_num_rows($check_result) == 0)
{
    echo "<script>

            alert('Contact Not Found');

            window.location='contact.php';

          </script>";

    exit();
}


/* =========================
   DELETE CONTACT
========================= */

$delete_sql = "
    DELETE FROM contact
    WHERE id='$id'
";


if(mysqli_query($con, $delete_sql))
{
    echo "<script>

            alert('Contact Deleted Successfully');

            window.location='contact.php';

          </script>";

    exit();
}
else
{
    echo "<script>

            alert('Contact Delete Failed');

            window.location='contact.php';

          </script>";

    exit();
}

?>