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
    $category = $_POST['category_id'];
    $name = $_POST['product_name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $image = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    move_uploaded_file($tmp,"../images/product/".$image);

    $sql = "INSERT INTO product(category_id,product_name,price,description,image)
    VALUES('$category','$name','$price','$description','$image')";

    mysqli_query($con,$sql);

    echo "<script>alert('Product Added Successfully');</script>";
}

include("heder.php");
include("sidebar.php");
?>
<div class="content">

<h2 style="color:#6D4C41;">Add Product</h2>

<br>

<form method="POST" enctype="multipart/form-data"
style="background:#fff;padding:20px;border-radius:10px;box-shadow:0 3px 10px rgba(0,0,0,.1);width:500px;">

<label><b>Category</b></label><br><br>

<select name="category_id"
required
style="width:100%;padding:10px;border:1px solid #ccc;border-radius:5px;">

<option value="">Select Category</option>

<?php
$cat = mysqli_query($con,"SELECT * FROM category");

while($c = mysqli_fetch_assoc($cat))
{
?>
<option value="<?php echo $c['id']; ?>">
<?php echo $c['category_name']; ?>
</option>
<?php
}
?>

</select>

<br><br>

<label><b>Product Name</b></label><br><br>

<input type="text"
name="product_name"
required
style="width:100%;padding:10px;border:1px solid #ccc;border-radius:5px;">

<br><br>

<label><b>Product Price</b></label><br><br>

<input type="number"
name="price"
required
style="width:100%;padding:10px;border:1px solid #ccc;border-radius:5px;">

<br><br>

<label><b>Product Description</b></label><br><br>

<textarea
name="description"
rows="5"
required
style="width:100%;padding:10px;border:1px solid #ccc;border-radius:5px;"></textarea>

<br><br>

<label><b>Product Image</b></label><br><br>

<input type="file"
name="image"
required>

<br><br>

<button
type="submit"
name="submit"
style="background:#8B6B61;color:white;border:none;padding:10px 20px;border-radius:5px;cursor:pointer;">
Add Product
</button>

</form>




</table>

</div>

</body>
</html>