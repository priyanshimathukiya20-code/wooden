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

/* PAGE HEADER */

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

/* TABLE BOX */

.user-table-box{
    background:#fff;
    padding:20px;
    border-radius:14px;
    box-shadow:0 5px 20px rgba(90,62,43,.12);
    overflow-x:auto;
}

/* TABLE */

.user-table{
    width:100%;
    border-collapse:separate;
    border-spacing:0;
}

.user-table th{
    background:#8B6B61;
    color:#fff;
    padding:15px 12px;
    text-align:left;
    font-size:14px;
}

.user-table th:first-child{
    border-top-left-radius:8px;
}

.user-table th:last-child{
    border-top-right-radius:8px;
}

.user-table td{
    padding:14px 12px;
    border-bottom:1px solid #eee;
    color:#444;
}

.user-table tr:hover td{
    background:#faf6f3;
}

/* TEXT */

.user-id{
    font-weight:bold;
    color:#6D4C41;
}

.user-name{
    font-weight:bold;
    color:#5a3e2b;
}

.address{
    max-width:220px;
    line-height:20px;
}

.gender-badge{
    background:#eee1db;
    color:#6D4C41;
    padding:6px 12px;
    border-radius:20px;
    font-size:13px;
}

.no-user{
    text-align:center;
    padding:50px;
    color:#777;
    font-size:18px;
}

</style>


<div class="content">

    <div class="page-header">

        <h2>
            <i class="fas fa-users"></i>
            Manage Users
        </h2>

    </div>


    <div class="user-table-box">

        <table class="user-table">

            <tr>

                <th>ID</th>

                <th>Name</th>

                <th>Email</th>

                <th>City</th>

                <th>Address</th>

                <th>Phone</th>

                <th>Gender</th>

            </tr>


            <?php

            $result = mysqli_query($con,
            "SELECT * FROM reg
             WHERE utype='user'
             ORDER BY rid ASC");

            if(mysqli_num_rows($result)>0)
            {

                while($row=mysqli_fetch_assoc($result))
                {

            ?>

            <tr>

                <td class="user-id">

                    <?php echo $row['rid']; ?>

                </td>


                <td class="user-name">

                    <?php echo $row['name']; ?>

                </td>


                <td>

                    <?php echo $row['email']; ?>

                </td>


                <td>

                    <?php echo $row['city']; ?>

                </td>


                <td class="address">

                    <?php echo $row['address']; ?>

                </td>


                <td>

                    <?php echo $row['phone']; ?>

                </td>


                <td>

                    <span class="gender-badge">

                        <?php echo $row['gender']; ?>

                    </span>

                </td>

            </tr>

            <?php

                }

            }
            else
            {

            ?>

            <tr>

                <td colspan="7" class="no-user">

                    No Users Found

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