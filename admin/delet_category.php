<?php

include("../connection.php");

if(isset($_GET['id']))
{
    $id = intval($_GET['id']);

    // Category ni information levani
    $result = mysqli_query($con, "SELECT * FROM category WHERE id='$id'");
    $row = mysqli_fetch_assoc($result);

    if($row)
    {
        // Category image delete
        $image = "../images/category/" . $row['category_image'];

        if(file_exists($image))
        {
            unlink($image);
        }

        // Pela category na badha products delete
        mysqli_query($con, "DELETE FROM product WHERE category_id='$id'");

        // Pachhi category delete
        mysqli_query($con, "DELETE FROM category WHERE id='$id'");

        // Delete pachi Manage Category page par refresh
        header("Location: manage_category.php");
        exit();
    }
    else
    {
        // Category na male to pan Manage Category par pacha javanu
        header("Location: manage_category.php");
        exit();
    }
}

?>