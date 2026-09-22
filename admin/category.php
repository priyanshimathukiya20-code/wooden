<?php
session_start();

if(!isset($_SESSION['admin']))
{
    header("Location:login.php");
    exit();
}

include("../connection.php");


if(isset($_POST['submit']))
{
    $name = $_POST['category_name'];

    $image = $_FILES['category_image']['name'];
    $tmp = $_FILES['category_image']['tmp_name'];

    move_uploaded_file($tmp,"../images/category/".$image);

    $sql = "INSERT INTO category(category_name,category_image)
            VALUES('$name','$image')";

    mysqli_query($con,$sql);

    echo "<script>alert('Category Added Successfully');</script>";
}

include("heder.php");
include("sidebar.php");
?>

<div class="content">

<h2 style="color:#6D4C41;">Add Category</h2>

<br>

<form method="POST" enctype="multipart/form-data"
style="background:#fff;padding:20px;border-radius:10px;box-shadow:0 3px 10px rgba(0,0,0,.1);width:500px;">

<label><b>Category Name</b></label><br><br>

<input type="text"
name="category_name"
required
style="width:100%;padding:10px;border:1px solid #ccc;border-radius:5px;">

<br><br>

<label><b>Category Image</b></label><br><br>

<input type="file"
name="category_image"
required>

<br><br>

<button type="submit"
name="submit"
style="background:#8B6B61;color:white;border:none;padding:10px 20px;border-radius:5px;cursor:pointer;">
Add Category
</button>

</form>



<?php

$result=mysqli_query($con,"SELECT * FROM category");

while($row=mysqli_fetch_assoc($result))
{

?>



<?php
}
?>

</table>

</div>

</body>
</html>