<?php 
include("connection.php"); 
include("header.php"); 
?> 
 
<style> 
 
body{ 
    background:#f8f8f8; 
} 
 
/* Banner */ 
.page-title{ 
    background:#5a3e2b; 
    color:#fff; 
    text-align:center; 
    padding:60px 20px; 
} 
 
.page-title h1{ 
    font-size:45px; 
    margin-bottom:10px; 
} 
 
.page-title p{ 
    font-size:18px; 
} 
 
/* Categories */ 
 
.category-section{ 
    width:90%; 
    margin:60px auto; 
} 
 
.category-section h2{ 
    text-align:center; 
    margin-bottom:40px; 
    color:#5a3e2b; 
} 
 
.category-box{ 
    display:grid; 
    grid-template-columns:repeat(3, 1fr); 
    gap:30px; 
} 
 
.card{ 
    background:#fff; 
    border-radius:15px; 
    overflow:hidden; 
    box-shadow:0 10px 25px rgba(0,0,0,.1); 
    transition:.4s; 
    text-align:center; 
} 
 
.card:hover{ 
    transform:translateY(-10px); 
} 
 
.card img{ 
    width:100%; 
    height:250px; 
    object-fit:cover; 
} 
 
.card h3{ 
    margin:20px 0; 
    color:#333; 
} 
 
.card a{ 
    display:inline-block; 
    margin-bottom:25px; 
    background:#5a3e2b; 
    color:#fff; 
    padding:12px 30px; 
    text-decoration:none; 
    border-radius:6px; 
} 
 
.card a:hover{ 
    background:#3c2719; 
} 

/* Mobile */
@media(max-width:768px){
    .category-box{
        grid-template-columns:1fr;
    }
}

</style> 
 
<section class="page-title"> 
 
<h1>Our Furniture Collection</h1> 
 
<p>Select Your Favourite Category</p> 
 
</section> 
 
<section class="category-section"> 
 
<h2>Shop By Category</h2> 
 
<div class="category-box"> 
 
<?php 
 
$result = mysqli_query($con,"SELECT * FROM category"); 
 
while($row=mysqli_fetch_assoc($result)) 
{ 
?> 
 
<div class="card"> 
 
<img src="images/category/<?php echo $row['category_image']; ?>" alt="Category Image"> 
 
<h3><?php echo $row['category_name']; ?></h3> 
 
<a href="category.php?id=<?php echo $row['id']; ?>"> 
Explore 
</a> 
 
</div> 
 
<?php 
} 
?> 
 
</div> 
 
</section> 
 
<?php include("footer.php"); ?>