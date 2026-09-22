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

.content{
    margin-left:240px;
    margin-top:70px;
    padding:35px;
    background:#f7f4f1;
    min-height:calc(100vh - 70px);
}

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

.add-btn{
    background:#8B6B61;
    color:white;
    padding:11px 20px;
    text-decoration:none;
    border-radius:7px;
    font-weight:bold;
}

.add-btn:hover{
    background:#6D4C41;
}

.category-table-box{
    background:white;
    padding:20px;
    border-radius:14px;
    box-shadow:0 5px 20px rgba(90,62,43,.12);
    overflow-x:auto;
}

.category-table{
    width:100%;
    border-collapse:separate;
    border-spacing:0;
}

.category-table th{
    background:#8B6B61;
    color:white;
    padding:15px 12px;
    text-align:left;
}

.category-table th:last-child{
    text-align:center;
    width:200px;
}

.category-table th:first-child{
    border-top-left-radius:8px;
}

.category-table th:last-child{
    border-top-right-radius:8px;
}

.category-table td{
    padding:14px 12px;
    border-bottom:1px solid #eee;
    color:#444;
    vertical-align:middle;
}

.category-table tr:hover td{
    background:#faf6f3;
}

.category-img{
    width:85px;
    height:65px;
    object-fit:cover;
    border-radius:9px;
}

.category-name{
    font-weight:bold;
    color:#5a3e2b;
}

.action-buttons{
    display:flex;
    justify-content:center;
    gap:8px;
    white-space:nowrap;
}

.update-btn,
.delete-btn{
    display:inline-flex;
    align-items:center;
    gap:5px;
    padding:8px 13px;
    color:white;
    text-decoration:none;
    border-radius:6px;
    font-size:13px;
}

.update-btn{
    background:#8B6B61;
}

.update-btn:hover{
    background:#6D4C41;
}

.delete-btn{
    background:#B07A6A;
}

.delete-btn:hover{
    background:#8B5E50;
}

.no-category{
    text-align:center;
    padding:40px;
    color:#777;
    font-size:18px;
}

</style>


<div class="content">

    <div class="page-header">

        <h2>
            <i class="fas fa-list"></i>
            Manage Categories
        </h2>

        <a href="category.php" class="add-btn">
            <i class="fas fa-plus"></i>
            Add Category
        </a>

    </div>


    <div class="category-table-box">

        <table class="category-table">

            <tr>

                <th>ID</th>

                <th>Category</th>

                <th>Image</th>

                <th>Action</th>

            </tr>


            <?php

            $result = mysqli_query(
                $con,
                "SELECT * FROM category ORDER BY id ASC"
            );

            if(mysqli_num_rows($result) > 0)
            {

                while($row = mysqli_fetch_assoc($result))
                {

            ?>

            <tr>

                <td>
                    <?php echo $row['id']; ?>
                </td>

                <td class="category-name">
                    <?php echo $row['category_name']; ?>
                </td>

                <td>

                    <img
                        class="category-img"
                        src="../images/category/<?php echo $row['category_image']; ?>"
                    >

                </td>

                <td>

                    <div class="action-buttons">

                        <a
                            href="edit_categroy.php?id=<?php echo $row['id']; ?>"
                            class="update-btn"
                        >
                            <i class="fas fa-pen"></i>
                            Update
                        </a>

                       <a 
    href="delet_category.php?id=<?php echo $row['id']; ?>" 
    class="delete-btn" 
    onclick="return confirm('Are you sure you want to delete this category and all its products?');"
> 
    <i class="fas fa-trash"></i> 
    Delete 
</a>

                    </div>

                </td>

            </tr>

            <?php

                }

            }
            else
            {

            ?>

            <tr>

                <td colspan="4" class="no-category">

                    <i class="fas fa-folder-open"></i>

                    <br><br>

                    No Categories Found

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