<?php
session_start();
include("connection.php");

$show_popup = false;
$popup_title = "";
$popup_message = "";
$popup_type = "success";

if(isset($_POST['submit']))
{
    $nm = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['pwd'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];

    // Check already registered
    $check = "SELECT * FROM reg WHERE email='$email'";
    $result = mysqli_query($con,$check);

    if(mysqli_num_rows($result) > 0)
    {
        $show_popup = true;
        $popup_title = "Already Registered";
        $popup_message = "You are already registered. Please login.";
        $popup_type = "error";
    }
    else
    {
        $sql = "INSERT INTO reg(name,email,pwd,city,address,phone,gender,utype)
        VALUES('$nm','$email','$password','$city','$address','$phone','$gender','user')";

        if(mysqli_query($con,$sql))
        {
            $show_popup = true;
            $popup_title = "Registration Successful";
            $popup_message = "Your Woodisty account has been created successfully.";
            $popup_type = "success";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Registration - Woodisty</title>

<style>

/* =========================
   REGISTRATION PAGE
========================= */

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial,sans-serif;
}

.register-section{
    min-height:780px;
    padding:70px 20px;

    background:
        linear-gradient(rgba(48,30,17,0.72),rgba(48,30,17,0.72)),
        url("images/banner-image1.jpg");

    background-size:cover;
    background-position:center;

    display:flex;
    align-items:center;
    justify-content:center;
}


/* =========================
   MAIN CARD
========================= */

.register-card{
    width:950px;
    max-width:100%;
    min-height:570px;

    display:flex;

    background:#fff;
    border-radius:25px;
    overflow:hidden;

    box-shadow:0 25px 70px rgba(0,0,0,0.30);
}


/* =========================
   LEFT SIDE
========================= */

.register-left{
    width:42%;

    background:
        linear-gradient(rgba(73,45,25,0.80),rgba(73,45,25,0.80)),
        url("images/banner-image1.jpg");

    background-size:cover;
    background-position:center;

    color:white;

    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;

    text-align:center;

    padding:45px 35px;
}

.register-left img{
    width:145px;
    height:auto;
    margin-bottom:30px;

    background:white;
    padding:12px 18px;
    border-radius:12px;
}

.register-left h1{
    font-family:Georgia,serif;
    font-size:36px;
    letter-spacing:2px;
    margin-bottom:15px;
}

.register-left h1 span{
    color:#e8c79c;
}

.register-left p{
    font-size:15px;
    line-height:1.8;
    color:#f5eee7;
    max-width:280px;
}

.wood-line{
    width:70px;
    height:3px;
    background:#e1bb89;
    margin:15px auto 20px;
    border-radius:10px;
}


/* =========================
   RIGHT SIDE
========================= */

.register-right{
    width:58%;
    padding:40px 50px;
    background:#fff;
}

.register-title{
    text-align:center;
    margin-bottom:25px;
}

.register-title h2{
    font-family:Georgia,serif;
    font-size:30px;
    color:#51331f;
    margin:0;
}

.register-title p{
    margin-top:7px;
    color:#888;
    font-size:13px;
}


/* =========================
   FORM
========================= */

.form-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:16px;
}

.form-group{
    position:relative;
}

.form-group.full{
    grid-column:1 / 3;
}

.form-control{
    width:100%;
    height:46px;

    border:1px solid #ddd;
    border-radius:10px;

    padding:0 15px;

    font-family:Arial,sans-serif;
    font-size:14px;
    color:#444;

    background:#fafafa;
    outline:none;

    box-sizing:border-box;
    transition:0.3s;
}

textarea.form-control{
    height:75px;
    padding-top:13px;
    resize:none;
}

.form-control:focus{
    border-color:#9b6b43;
    background:#fff;
    box-shadow:0 0 0 3px rgba(139,90,43,0.10);
}

.form-control::placeholder{
    color:#999;
}


/* =========================
   PHONE
========================= */

.form-grid > input[name="phone"]{
    width:100%;
    height:46px;

    border:1px solid #ddd;
    border-radius:10px;

    padding:0 15px;

    font-family:Arial,sans-serif;
    font-size:14px;
    color:#444;

    background:#fafafa;
    outline:none;

    box-sizing:border-box;
    transition:0.3s;
}

.form-grid > input[name="phone"]:focus{
    border-color:#9b6b43;
    background:#fff;
    box-shadow:0 0 0 3px rgba(139,90,43,0.10);
}

.form-grid > input[name="phone"]::placeholder{
    color:#999;
}


/* =========================
   GENDER
========================= */

.gender-box{
    grid-column:1 / 3;

    padding:13px 15px;

    background:#faf7f3;
    border:1px solid #eee0d2;
    border-radius:10px;

    display:flex;
    align-items:center;
    gap:18px;

    font-family:Arial,sans-serif;
    font-size:14px;
    color:#555;
}

.gender-title{
    font-family:Arial,sans-serif;
    font-weight:bold;
    color:#51331f;
    margin-right:5px;
}

.gender-box label{
    cursor:pointer;
    font-family:Arial,sans-serif;
}

.gender-box input{
    accent-color:#8B5A2B;
    margin-right:5px;
}


/* =========================
   REGISTER BUTTON
========================= */

.btn-register{
    grid-column:1 / 3;

    width:100%;
    height:50px;

    background:linear-gradient(135deg,#8B5A2B,#5d3a1a);

    color:white;
    border:none;
    border-radius:10px;

    font-family:Georgia,serif;
    font-size:17px;
    letter-spacing:1px;

    cursor:pointer;

    box-shadow:0 8px 18px rgba(93,58,26,0.25);

    transition:0.3s;
}

.btn-register:hover{
    transform:translateY(-2px);

    box-shadow:0 12px 25px rgba(93,58,26,0.35);

    background:linear-gradient(135deg,#6d421f,#432810);
}


/* =========================
   LOGIN TEXT
========================= */

.login-text{
    text-align:center;
    margin-top:18px;

    font-family:Arial,sans-serif;
    color:#777;
    font-size:14px;
}

.login-text a{
    font-family:Arial,sans-serif;
    color:#8B5A2B;
    font-weight:bold;
    text-decoration:none;
}

.login-text a:hover{
    text-decoration:underline;
}


/* =========================
   SIMPLE POPUP
========================= */

.registration-popup-overlay{
    position:fixed;
    top:0;
    left:0;

    width:100%;
    height:100%;

    background:rgba(55,40,30,.45);

    display:flex;
    align-items:center;
    justify-content:center;

    z-index:999999;
}

.registration-popup-box{
    width:400px;
    max-width:90%;

    background:#fff;

    padding:35px 30px;

    text-align:center;

    border-radius:12px;

    border:1px solid #e2d2c0;

    box-shadow:0 10px 30px rgba(90,62,43,.18);

    animation:popupShow .25s ease;
}

.registration-popup-box h2{
    margin:0 0 12px;

    color:#5a3e2b;

    font-family:Georgia,serif;

    font-size:26px;

    font-weight:normal;
}

.registration-popup-box p{
    margin:0 0 25px;

    color:#666;

    font-size:14px;

    line-height:1.6;
}

.registration-popup-btn{
    display:inline-block;

    padding:10px 28px;

    background:#76513f;

    color:#fff;

    text-decoration:none;

    border-radius:6px;

    font-size:14px;

    transition:.3s;
}

.registration-popup-btn:hover{
    background:#5d3e30;

    transform:translateY(-1px);
}

.registration-popup-box.error-popup h2{
    color:#8b3027;
}

.registration-popup-box.error-popup .registration-popup-btn{
    background:#76513f;
}

@keyframes popupShow{

    from{
        opacity:0;
        transform:scale(.95);
    }

    to{
        opacity:1;
        transform:scale(1);
    }

}


/* =========================
   RESPONSIVE
========================= */

@media(max-width:800px){

    .register-card{
        width:600px;
    }

    .register-left{
        display:none;
    }

    .register-right{
        width:100%;
        padding:35px 30px;
    }

}

@media(max-width:550px){

    .register-section{
        padding:35px 12px;
    }

    .register-right{
        padding:30px 20px;
    }

    .form-grid{
        grid-template-columns:1fr;
    }

    .form-group.full,
    .gender-box,
    .btn-register{
        grid-column:1;
    }

    .gender-box{
        flex-wrap:wrap;
        gap:10px;
    }

}

</style>

</head>


<body>


<?php include('header.php'); ?>


<section class="register-section">

<div class="register-card">


    <!-- LEFT SIDE -->

    <div class="register-left">

        <img src="images/logo.png">

        <h1>Welcome to <span>Woodisty</span></h1>

        <div class="wood-line"></div>

        <p>
            Discover timeless wooden furniture,
            crafted with elegance, comfort and style.
        </p>

        <p>
            Create your account and start your
            beautiful furniture journey with us.
        </p>

    </div>


    <!-- RIGHT SIDE -->

    <div class="register-right">

        <div class="register-title">

            <h2>Create Your Account</h2>

            <p>
                Register now to explore the Woodisty collection
            </p>

        </div>


        <form method="post">

        <div class="form-grid">


            <!-- NAME -->

            <div class="form-group">

                <input
                type="text"
                name="name"
                class="form-control"
                placeholder="Full Name"
                required
                pattern="[A-Za-z\s]+"
                oninput="this.value=this.value.replace(/[^A-Za-z\s]/g,'');">

            </div>


            <!-- EMAIL -->

            <div class="form-group">

                <input
                type="email"
                name="email"
                class="form-control"
                placeholder="Email Address"
                required>

            </div>


            <!-- PASSWORD -->

            <div class="form-group">

                <input
                type="password"
                name="pwd"
                class="form-control"
                placeholder="Password"
                required>

            </div>


            <!-- PHONE -->

            <input
                type="text"
                name="phone"
                placeholder="Mobile Number"
                maxlength="10"
                pattern="[6-9][0-9]{9}"
                title="Enter a valid 10-digit mobile number starting with 6, 7, 8 or 9"
                required
            >


            <!-- CITY -->

            <div class="form-group">

                <input
                type="text"
                name="city"
                class="form-control"
                placeholder="City"
                required>

            </div>


            <!-- ADDRESS -->

            <div class="form-group">

                <input
                type="text"
                name="address"
                class="form-control"
                placeholder="Address"
                required>

            </div>


            <!-- GENDER -->

            <div class="gender-box">

                <span class="gender-title">Gender :</span>

                <label>
                    <input
                    type="radio"
                    name="gender"
                    value="Male"
                    required>
                    Male
                </label>

                <label>
                    <input
                    type="radio"
                    name="gender"
                    value="Female">
                    Female
                </label>

                <label>
                    <input
                    type="radio"
                    name="gender"
                    value="Other">
                    Other
                </label>

            </div>


            <!-- BUTTON -->

            <input
            type="submit"
            name="submit"
            value="Create Account"
            class="btn-register">


        </div>

        </form>


        <div class="login-text">

            Already have an account?

            <a href="login.php">Login Here</a>

        </div>


    </div>

</div>

</section>


<?php include('footer.php'); ?>


<!-- =========================
     SIMPLE REGISTRATION POPUP
========================= -->

<?php if($show_popup){ ?>

<div class="registration-popup-overlay">

    <div class="registration-popup-box <?php
        if($popup_type == 'error'){
            echo 'error-popup';
        }
    ?>">

        <h2>
            <?php echo htmlspecialchars($popup_title); ?>
        </h2>

        <p>
            <?php echo htmlspecialchars($popup_message); ?>
        </p>

        <a href="login.php" class="registration-popup-btn">
            Login Now
        </a>

    </div>

</div>

<?php } ?>


</body>
</html>