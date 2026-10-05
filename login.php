<?php

session_start();
include("connection.php");

$error = "";

if(isset($_POST['login']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    /* =========================
       FIRST CHECK EMAIL
    ========================= */

    $email_check = mysqli_query(
        $con,
        "SELECT * FROM reg WHERE email='$email'"
    );

    if(mysqli_num_rows($email_check) > 0)
    {
        $row = mysqli_fetch_assoc($email_check);

        /* =========================
           CHECK PASSWORD
        ========================= */

        if($row['pwd'] == $password)
        {
            /* ================= ADMIN ================= */

            if($row['utype'] == "admin")
            {
                $_SESSION['admin'] = $row['email'];

                header("Location: admin/dashboard.php");
                exit();
            }

            /* ================= USER ================= */

            else
            {
                $_SESSION['user_id'] = $row['rid'];
                $_SESSION['user_name'] = $row['name'];
                $_SESSION['user_email'] = $row['email'];

                header("Location: index.php");
                exit();
            }
        }
        else
        {
            /* ONLY PASSWORD ERROR */

            $error = "Invalid Password";
        }
    }
    else
    {
        /* ONLY EMAIL ERROR */

        $error = "Invalid Email";
    }
}

?>

<!DOCTYPE html>
<html>

<head>

<title>Login - Woodisty</title>

<style>

*{
    box-sizing:border-box;
}

body{
    margin:0;
    font-family:Arial,sans-serif;
}


/* =========================
   LOGIN SECTION
========================= */

.login-section{

    min-height:calc(100vh - 180px);

    background:
        linear-gradient(
            rgba(45,28,15,0.75),
            rgba(45,28,15,0.75)
        ),
        url("images/banner-image1.jpg");

    background-size:cover;
    background-position:center;

    display:flex;
    justify-content:center;
    align-items:center;

    padding:50px 20px;
}


/* =========================
   LOGIN CARD
========================= */

.login-card{

    width:900px;
    max-width:100%;

    min-height:530px;

    background:#fff;

    border-radius:25px;

    overflow:hidden;

    display:flex;

    box-shadow:
        0 25px 70px rgba(0,0,0,0.35);
}


/* =========================
   LEFT SIDE
========================= */

.login-left{

    width:45%;

    background:
        linear-gradient(
            rgba(74,45,24,0.82),
            rgba(74,45,24,0.82)
        ),
        url("images/banner-image1.jpg");

    background-size:cover;
    background-position:center;

    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;

    text-align:center;

    color:white;

    padding:40px;
}


.login-left img{

    width:220px;

    height:auto;

    background:transparent;

    margin-bottom:30px;
}


.login-left h1{

    font-family:Georgia,serif;

    font-size:36px;

    letter-spacing:2px;

    margin:0 0 12px;
}


.login-left h1 span{

    color:#e4bd8b;
}


.wood-line{

    width:70px;

    height:3px;

    background:#e1bb89;

    border-radius:10px;

    margin:8px auto 20px;
}


.login-left p{

    color:#f4ebe2;

    font-size:14px;

    line-height:1.8;

    max-width:290px;
}


/* =========================
   RIGHT SIDE
========================= */

.login-right{

    width:55%;

    padding:55px 65px;

    background:#fff;

    display:flex;

    flex-direction:column;

    justify-content:center;
}


/* =========================
   TITLE
========================= */

.login-title{

    text-align:center;

    margin-bottom:25px;
}


.login-title h2{

    font-family:Georgia,serif;

    font-size:30px;

    color:#51331f;

    margin:0;
}


.login-title p{

    color:#888;

    font-size:13px;

    margin-top:8px;
}


/* =========================
   ERROR BOX
========================= */

.error-box{

    width:100%;

    background:#fdf0ef;

    color:#b22222;

    border:1px solid #e5b8b3;

    border-left:4px solid #b22222;

    padding:13px 15px;

    border-radius:8px;

    margin-bottom:20px;

    text-align:center;

    font-size:14px;

    font-weight:bold;
}


/* =========================
   INPUT GROUP
========================= */

.input-group{

    margin-bottom:17px;
}


.input-group label{

    display:block;

    font-size:13px;

    font-weight:bold;

    color:#51331f;

    margin-bottom:7px;
}


.input-group input{

    width:100%;

    height:48px;

    border:1px solid #ddd;

    border-radius:10px;

    padding:0 15px;

    font-size:14px;

    background:#fafafa;

    outline:none;

    transition:0.3s;
}


.input-group input:focus{

    border-color:#8B5A2B;

    background:#fff;

    box-shadow:
        0 0 0 3px rgba(139,90,43,0.10);
}


/* =========================
   SHOW PASSWORD
========================= */

.show-password{

    font-size:13px;

    color:#777;

    margin-top:-5px;

    margin-bottom:12px;
}


.show-password input{

    accent-color:#8B5A2B;

    margin-right:5px;
}


/* =========================
   LOGIN BUTTON
========================= */

.login-btn{

    width:100%;

    height:50px;

    background:
        linear-gradient(
            135deg,
            #8B5A2B,
            #5d3a1a
        );

    color:white;

    border:none;

    border-radius:10px;

    font-family:Georgia,serif;

    font-size:17px;

    letter-spacing:1px;

    cursor:pointer;

    box-shadow:
        0 8px 18px rgba(93,58,26,0.25);

    transition:0.3s;
}


.login-btn:hover{

    transform:translateY(-2px);

    box-shadow:
        0 12px 25px rgba(93,58,26,0.35);

    background:
        linear-gradient(
            135deg,
            #6d421f,
            #432810
        );
}


/* =========================
   REGISTER
========================= */

.register-text{

    text-align:center;

    color:#777;

    font-size:14px;

    margin-top:20px;
}


.register-text a{

    color:#8B5A2B;

    font-weight:bold;

    text-decoration:none;
}


.register-text a:hover{

    text-decoration:underline;
}


/* =========================
   MOBILE
========================= */

@media(max-width:750px){

    .login-card{

        width:500px;
    }

    .login-left{

        display:none;
    }

    .login-right{

        width:100%;

        padding:45px 35px;
    }

}


@media(max-width:450px){

    .login-section{

        padding:30px 12px;
    }

    .login-right{

        padding:35px 22px;
    }

}

</style>

</head>


<body>


<!-- =========================
     HEADER
========================= -->

<?php include("header.php"); ?>


<!-- =========================
     LOGIN SECTION
========================= -->

<section class="login-section">

<div class="login-card">


    <!-- =====================
         LEFT SIDE
    ====================== -->

    <div class="login-left">

        <img src="images/logo.png">

        <h1>
            Welcome to <span>Woodisty</span>
        </h1>

        <div class="wood-line"></div>

        <p>
            Step into a world of timeless wooden furniture,
            crafted with elegance, comfort and style.
        </p>

        <p>
            Login to explore our beautiful collection.
        </p>

    </div>


    <!-- =====================
         RIGHT SIDE
    ====================== -->

    <div class="login-right">


        <div class="login-title">

            <h2>
                Welcome Back
            </h2>

            <p>
                Login to your Woodisty account
            </p>

        </div>


        <!-- =====================
             ERROR
        ====================== -->

        <?php if($error != "") { ?>

            <div class="error-box">

                <?php echo $error; ?>

            </div>

        <?php } ?>


        <!-- =====================
             LOGIN FORM
        ====================== -->

        <form method="post" autocomplete="off">


            <!-- EMAIL -->

            <div class="input-group">

                <label>
                    Email Address
                </label>

                <input
                    type="email"
                    name="email"
                    placeholder="Enter your email"

                    value="<?php
                        if(isset($_POST['login']))
                        {
                            echo htmlspecialchars($_POST['email']);
                        }
                    ?>"

                    autocomplete="new-password"
                    autocapitalize="none"
                    spellcheck="false"

                    required
                >

            </div>


            <!-- PASSWORD -->

            <div class="input-group">

                <label>
                    Password
                </label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Enter your password"

                    value=""

                    autocomplete="new-password"

                    required
                >

            </div>


            <!-- SHOW PASSWORD -->

            <div class="show-password">

                <label>

                    <input
                        type="checkbox"
                        onclick="showPassword()"
                    >

                    Show Password

                </label>

            </div>


            <!-- LOGIN BUTTON -->

            <button
                type="submit"
                name="login"
                class="login-btn"
            >

                Login to Account

            </button>


            <!-- REGISTER -->

            <div class="register-text">

                Don't have an account?

                <a href="regi.php">
                    Create Account
                </a>

            </div>


        </form>


    </div>

</div>

</section>


<!-- =========================
     FOOTER
========================= -->

<?php include("footer.php"); ?>


<!-- =========================
     SHOW PASSWORD
========================= -->

<script>

function showPassword()
{
    var x = document.getElementById("password");

    if(x.type === "password")
    {
        x.type = "text";
    }
    else
    {
        x.type = "password";
    }
}

</script>


</body>

</html>