<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include("connection.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>Woodisty - Furniture Store</title>

    <!-- ================= META ================= -->

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <meta name="format-detection"
          content="telephone=no">

    <meta name="apple-mobile-web-app-capable"
          content="yes">

    <meta name="author"
          content="">

    <meta name="keywords"
          content="">

    <meta name="description"
          content="">


    <!-- ================= FAVICON ================= -->

    <link rel="icon"
          type="image/png"
          href="images/logo.png">


    <!-- ================= BOOTSTRAP ================= -->

    <link rel="stylesheet"
          type="text/css"
          href="css/bootstrap.min.css">


    <!-- ================= STYLE ================= -->

    <link rel="stylesheet"
          type="text/css"
          href="style.css">


    <!-- ================= SWIPER ================= -->

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">


    <!-- ================= GOOGLE FONT ================= -->

    <link rel="preconnect"
          href="https://fonts.googleapis.com">

    <link rel="preconnect"
          href="https://fonts.gstatic.com"
          crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700&family=Poppins:wght@200;300;400;500&display=swap"
          rel="stylesheet">


    <!-- ================= MODERNIZR ================= -->

    <script src="js/modernizr.js"></script>


    <!-- ================= HEADER CSS ================= -->

    <style>

        /* ================= LOGO ================= */

        .navbar-brand .logo {
            width: 170px;
            height: 90px;
            object-fit: contain;
        }

        .offcanvas .navbar-brand .logo {
            width: 170px;
            height: 90px;
            object-fit: contain;
        }


        /* ================= HEADER ICONS ================= */

        .user-items ul {
            margin: 0;
            padding: 0;
        }

        .user-items ul li {
            display: flex;
            align-items: center;
        }

        .user-items ul li a {
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            color: #000;
        }


        /* ================= MY ORDER BAG ================= */

        .my-order-icon {
            width: 22px;
            height: 22px;
            object-fit: contain;
            display: block;
        }


        /* ================= CART ================= */

        .cart {
            display: block;
        }


        /* ================= ICON HOVER ================= */

        .user-items ul li a:hover {
            color: #6D4C41;
        }


        /* ================= CATEGORY DROPDOWN ================= */

        .dropdown-menu {
            z-index: 99999 !important;
            border: none;
            border-radius: 0;
            box-shadow: 0 5px 15px rgba(0,0,0,0.12);
            padding: 8px 0;
        }

        .dropdown-menu.show {
            display: block !important;
        }

        .dropdown-item {
            padding: 9px 20px;
            color: #333;
            font-size: 13px;
            text-transform: none;
        }

        .dropdown-item:hover {
            background: #f3eee9;
            color: #6D4C41;
        }

        .dropdown-toggle::after {
            margin-left: 5px;
        }

    </style>

</head>


<body class="bg-body"
      data-bs-spy="scroll"
      data-bs-target="#navbar"
      data-bs-root-margin="0px 0px -40%"
      data-bs-smooth-scroll="true"
      tabindex="0">


<!-- ===================================================== -->
<!-- SVG ICONS -->
<!-- ===================================================== -->

<svg xmlns="http://www.w3.org/2000/svg"
     style="display:none;">


    <!-- ================= CART ================= -->

    <symbol id="cart"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 16 16">

        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0-4 0zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1-1 0z"/>

    </symbol>


    <!-- ================= ARROW LEFT ================= -->

    <symbol id="arrow-left"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 32 32">

        <path fill="currentColor"
              d="m13.281 6.781-8.5 8.5-.687.719.687.719 8.5 8.5 1.438-1.438L7.938 17H28v-2H7.937l6.782-6.781z"/>

    </symbol>


    <!-- ================= ARROW RIGHT ================= -->

    <symbol id="arrow-right"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 32 32">

        <path fill="currentColor"
              d="M18.719 6.781 17.28 8.22 24.063 15H4v2h20.063l-6.782 6.781 1.438 1.438 8.5-8.5.687-.719-.687-.719z"/>

    </symbol>


    <!-- ================= SHIPPING ================= -->

    <symbol id="shipping-fast"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 32 32">

        <path fill="currentColor"
              d="M0 6v2h19v15h-6.156c-.446-1.719-1.992-3-3.844-3-1.852 0-3.398 1.281-3.844 3H4v-5H2v7h3.156c.446 1.719 3.398 3 3.844 3 1.852 0 3.398-1.281 3.844-3h8.312c.446 1.719 1.992 3 3.844 3 1.852 0 3.398-1.281 3.844-3H32v-8.156l-.063-.157-2-6L29.72 10H21V6z"/>

    </symbol>


    <!-- ================= SHOPPING CART ================= -->

    <symbol id="shopping-cart"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 32 32">

        <path fill="currentColor"
              d="M5 7c-.55 0-1 .45-1 1s.45 1 1 1h2.219l2.625 10.5c.222.89 1.02 1.5 1.937 1.5H23.25c.902 0 1.668-.598 1.906-1.469L27.75 10H11l.5 2h13.656l-1.906 7H11.781L9.156 8.5A1.983 1.983 0 0 0 7.22 7z"/>

    </symbol>


    <!-- ================= NAVBAR ================= -->

    <symbol id="navbar-icon"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 16 16">

        <path d="M14 10.5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0 0 1h3a.5.5 0 0 0 .5-.5zm0-3a.5.5 0 0 0-.5-.5h-7a.5.5 0 0 0 0 1h7a.5.5 0 0 0 .5-.5zm0-3a.5.5 0 0 0-.5-.5h-11a.5.5 0 0 0 0 1h11a.5.5 0 0 0 .5-.5z"/>

    </symbol>


    <!-- ================= CLOSE ================= -->

    <symbol id="close"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 16 16">

        <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>

    </symbol>

</svg>


<!-- ===================================================== -->
<!-- PRELOADER -->
<!-- ===================================================== -->

<div id="preloader">

    <span class="loader">

        <span class="loader-inner"></span>

    </span>

</div>


<!-- ===================================================== -->
<!-- HEADER -->
<!-- ===================================================== -->

<header id="header"
        class="site-header text-black">


<nav id="header-nav"
     class="navbar navbar-expand-lg px-3 mb-3">


<div class="container-fluid">


<!-- ================================================= -->
<!-- LOGO -->
<!-- ================================================= -->

<a class="navbar-brand"
   href="index.php">

    <img src="images/logo.png"
         class="logo"
         width="170"
         height="90"
         alt="Woodisty Logo">

</a>


<!-- ================================================= -->
<!-- MOBILE MENU BUTTON -->
<!-- ================================================= -->

<button class="navbar-toggler d-flex d-lg-none order-3 p-2"
        type="button"
        data-bs-toggle="offcanvas"
        data-bs-target="#bdNavbar"
        aria-controls="bdNavbar"
        aria-expanded="false"
        aria-label="Toggle navigation">

    <svg class="navbar-icon"
         width="50"
         height="50">

        <use xlink:href="#navbar-icon"></use>

    </svg>

</button>


<!-- ================================================= -->
<!-- OFFCANVAS -->
<!-- ================================================= -->

<div class="offcanvas offcanvas-end"
     tabindex="-1"
     id="bdNavbar"
     aria-labelledby="bdNavbarOffcanvasLabel">


<!-- ================================================= -->
<!-- OFFCANVAS HEADER -->
<!-- ================================================= -->

<div class="offcanvas-header px-4 pb-0">


<a class="navbar-brand"
   href="index.php">

    <img src="images/logo.png"
         class="logo"
         width="170"
         height="90"
         alt="Woodisty Logo">

</a>


<button type="button"
        class="btn-close btn-close-black"
        data-bs-dismiss="offcanvas"
        aria-label="Close"
        data-bs-target="#bdNavbar">
</button>


</div>


<!-- ================================================= -->
<!-- OFFCANVAS BODY -->
<!-- ================================================= -->

<div class="offcanvas-body">


<ul id="navbar"
    class="navbar-nav text-uppercase justify-content-end align-items-center flex-grow-1 pe-3">


<!-- ================================================= -->
<!-- HOME -->
<!-- ================================================= -->

<li class="nav-item me-4">

    <a class="nav-link"
       href="index.php">

        Home

    </a>

</li>


<!-- ================================================= -->
<!-- ABOUT US -->
<!-- ================================================= -->

<li class="nav-item">

    <a class="nav-link me-4"
       href="about.php">

        About Us

    </a>

</li>


<!-- ================================================= -->
<!-- CATEGORY -->
<!-- ================================================= -->

<li class="nav-item dropdown me-4">

    <a class="nav-link dropdown-toggle"
       href="#"
       id="dropdownProducts"
       role="button"
       data-bs-toggle="dropdown"
       aria-expanded="false">

        Category

    </a>


    <ul class="dropdown-menu"
        aria-labelledby="dropdownProducts">


        <?php

        $category_result = mysqli_query(
            $con,
            "SELECT * FROM category ORDER BY id ASC"
        );

        if($category_result && mysqli_num_rows($category_result) > 0)
        {

            while($category_row = mysqli_fetch_assoc($category_result))
            {

        ?>

        <li>

            <a class="dropdown-item"
               href="category.php?id=<?php echo $category_row['id']; ?>">

                <?php
                echo htmlspecialchars(
                    $category_row['category_name']
                );
                ?>

            </a>

        </li>

        <?php

            }

        }
        else
        {

        ?>

        <li>

            <a class="dropdown-item"
               href="#">

                No Category Found

            </a>

        </li>

        <?php

        }

        ?>


    </ul>

</li>


<!-- ================================================= -->
<!-- CONTACT -->
<!-- ================================================= -->

<li class="nav-item me-4">

    <a class="nav-link"
       href="contact.php">

        Contact

    </a>

</li>


<!-- ================================================= -->
<!-- LOGIN / USER -->
<!-- ================================================= -->

<?php

if(isset($_SESSION['user_name']))
{

?>


<!-- ================================================= -->
<!-- WELCOME USER -->
<!-- ================================================= -->

<li class="nav-item me-4">

    <a class="nav-link">

        Welcome,
        <?php
        echo htmlspecialchars(
            $_SESSION['user_name']
        );
        ?>

    </a>

</li>


<!-- ================================================= -->
<!-- LOGOUT -->
<!-- ================================================= -->

<li class="nav-item me-4">

    <a href="logout.php"
       class="nav-link">

        Logout

    </a>

</li>


<?php

}
else
{

?>


<!-- ================================================= -->
<!-- REGISTRATION -->
<!-- ================================================= -->

<li class="nav-item me-4">

    <a class="nav-link"
       href="regi.php">

        Registration

    </a>

</li>


<!-- ================================================= -->
<!-- LOGIN -->
<!-- ================================================= -->

<li class="nav-item me-4">

    <a href="login.php"
       class="nav-link">

        Login

    </a>

</li>


<?php

}

?>


<!-- ================================================= -->
<!-- ORDER + CART -->
<!-- ================================================= -->

<li class="nav-item">


<div class="user-items ps-5">


<ul class="d-flex justify-content-end align-items-center list-unstyled gap-4">


<!-- ================================================= -->
<!-- MY ORDERS -->
<!-- ================================================= -->

<li>

    <a href="my_order.php"
       title="My Orders">

        <img src="images/shopping-bag.png"
             class="my-order-icon"
             alt="My Orders"
             width="22"
             height="22">

    </a>

</li>


<!-- ================================================= -->
<!-- CART -->
<!-- ================================================= -->

<li>

    <a href="cart.php"
       title="Cart">

        <svg class="cart"
             width="18"
             height="18">

            <use xlink:href="#cart"></use>

        </svg>

    </a>

</li>


</ul>


</div>


</li>


</ul>


</div>


</div>


</div>


</nav>


</header>


<!-- ===================================================== -->
<!-- JAVASCRIPT -->
<!-- ===================================================== -->

<script src="js/jquery-1.11.0.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

<script src="js/bootstrap.bundle.min.js"></script>

<script src="js/plugins.js"></script>

<script src="js/script.js"></script>


<!-- ===================================================== -->
<!-- CATEGORY DROPDOWN FIX -->
<!-- ===================================================== -->

<script>

document.addEventListener("DOMContentLoaded", function () {

    var categoryButton =
        document.getElementById("dropdownProducts");

    if(categoryButton)
    {

        categoryButton.addEventListener("click", function(e)
        {

            e.preventDefault();

            var dropdownMenu =
                this.nextElementSibling;

            if(dropdownMenu)
            {

                dropdownMenu.classList.toggle("show");

                var isOpen =
                    dropdownMenu.classList.contains("show");

                this.setAttribute(
                    "aria-expanded",
                    isOpen ? "true" : "false"
                );

            }

        });

    }


    /* CLOSE DROPDOWN WHEN CLICKING OUTSIDE */

    document.addEventListener("click", function(e)
    {

        var dropdown =
            document.querySelector(".nav-item.dropdown");

        var menu =

            document.querySelector("#dropdownProducts + .dropdown-menu");

        if(dropdown && menu)
        {

            if(!dropdown.contains(e.target))
            {

                menu.classList.remove("show");

                categoryButton.setAttribute(
                    "aria-expanded",
                    "false"
                );

            }

        }

    });

});

</script>


</body>

</html>