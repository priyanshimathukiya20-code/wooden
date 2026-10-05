<?php

session_start();

include("connection.php");


/* =========================
   CONTACT FORM SUBMIT
========================= */

$show_success = false;
$show_error = false;

if(isset($_POST['submit']))
{
    $email   = mysqli_real_escape_string($con, $_POST['email']);
    $subject = mysqli_real_escape_string($con, $_POST['subject']);
    $message = mysqli_real_escape_string($con, $_POST['message']);
    $rating  = intval($_POST['rating']);


    $sql = "INSERT INTO contact
            (email, subject, message, rating)
            VALUES
            ('$email', '$subject', '$message', '$rating')";


    if(mysqli_query($con, $sql))
    {
        $show_success = true;
    }
    else
    {
        $show_error = true;
    }
}


include("header.php");

?>


<!-- =========================
     FONT AWESOME
========================= -->

<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">


<style>

/* =========================
   CONTACT PAGE
========================= */

.contact-page{

    background:#f7f4f1;

    color:#333;

    font-family:Arial,sans-serif;

    min-height:100vh;

}


/* =========================
   PAGE HEADING
========================= */

.contact-heading{

    text-align:center;

    padding:50px 20px 30px;

}


.heading-line{

    width:55px;

    height:4px;

    background:#8B6B61;

    margin:0 auto 12px;

    border-radius:3px;

}


.contact-heading h1{

    margin:0;

    color:#5a3e2b;

    font-family:Georgia,serif;

    font-size:42px;

    font-weight:normal;

    letter-spacing:.5px;

}


.contact-heading p{

    margin:10px 0 0;

    color:#8B6B61;

    font-size:14px;

    letter-spacing:.3px;

}


/* =========================
   MAIN CONTAINER
========================= */

.contact-container{

    width:88%;

    max-width:1150px;

    margin:20px auto 60px;

}


/* =========================
   CONTACT GRID
========================= */

.contact-grid{

    display:grid;

    grid-template-columns:1fr 1fr;

    gap:35px;

}


/* =========================
   CONTACT BOX
========================= */

.contact-box{

    background:#fff;

    padding:35px;

    border-radius:14px;

    box-shadow:
    0 6px 25px rgba(90,62,43,.10);

    border:1px solid #eee4de;

}


/* =========================
   BOX HEADING
========================= */

.contact-box h2{

    color:#5a3e2b;

    font-family:Georgia,serif;

    font-size:30px;

    font-weight:normal;

    margin:0 0 10px;

}


.small-line{

    width:55px;

    height:2px;

    background:#8B6B61;

    margin-bottom:20px;

}


/* =========================
   LET'S CONNECT MESSAGE
========================= */

.connect-message{

    color:#777;

    font-size:14px;

    line-height:1.7;

    margin-bottom:25px;

}


/* =========================
   INFORMATION BOX
========================= */

.info-box{

    display:flex;

    align-items:flex-start;

    gap:15px;

    margin-bottom:17px;

    padding:16px;

    background:#faf8f6;

    border-radius:10px;

    border:1px solid #eee5df;

    transition:.3s;

}


.info-box:hover{

    transform:translateX(4px);

    box-shadow:
    0 5px 15px rgba(90,62,43,.08);

}


/* =========================
   INFO ICON
========================= */

.info-icon{

    min-width:42px;

    height:42px;

    border-radius:50%;

    background:#8B6B61;

    color:#fff;

    display:flex;

    align-items:center;

    justify-content:center;

    font-size:17px;

}


/* =========================
   INFO CONTENT
========================= */

.info-content{

    padding-top:1px;

}


.info-content h4{

    margin:0 0 5px;

    color:#6D4C41;

    font-size:14px;

    text-transform:uppercase;

    letter-spacing:.5px;

}


.info-content p{

    margin:0;

    color:#666;

    line-height:1.6;

    font-size:14px;

}


/* =========================
   FORM LABEL
========================= */

.form-label{

    display:block;

    color:#6D4C41;

    font-size:14px;

    font-weight:bold;

    margin-bottom:7px;

}


/* =========================
   FORM INPUT
========================= */

.contact-form input,
.contact-form textarea{

    width:100%;

    padding:13px 15px;

    margin-bottom:17px;

    border:1px solid #ddd5d0;

    border-radius:7px;

    outline:none;

    font-size:14px;

    font-family:Arial,sans-serif;

    background:#faf9f7;

    box-sizing:border-box;

    transition:.3s;

}


.contact-form input:focus,
.contact-form textarea:focus{

    border-color:#8B6B61;

    background:#fff;

    box-shadow:
    0 0 0 3px rgba(139,107,97,.08);

}


/* =========================
   TEXTAREA
========================= */

.contact-form textarea{

    height:135px;

    resize:none;

}


/* =========================
   RATING
========================= */

.rating-title{

    color:#6D4C41;

    font-size:15px;

    font-weight:bold;

    margin-bottom:8px;

}


.rating{

    display:flex;

    flex-direction:row-reverse;

    justify-content:flex-end;

    width:max-content;

    margin-bottom:22px;

}


.rating input{

    display:none;

}


.rating label{

    font-size:34px;

    color:#ddd;

    cursor:pointer;

    padding:0 3px;

    transition:.2s;

}


/* SELECTED STARS */

.rating input:checked ~ label{

    color:#d4a017;

}


/* HOVER STARS */

.rating label:hover,
.rating label:hover ~ label{

    color:#d4a017;

}


/* =========================
   SEND BUTTON
========================= */

.contact-btn{

    display:inline-flex;

    align-items:center;

    gap:8px;

    padding:13px 27px;

    background:#8B6B61;

    color:#fff;

    border:none;

    text-decoration:none;

    border-radius:7px;

    font-size:15px;

    cursor:pointer;

    transition:.3s;

}


.contact-btn:hover{

    background:#6D4C41;

    transform:translateY(-2px);

    box-shadow:
    0 6px 15px rgba(90,62,43,.18);

}


/* =========================
   LOCATION SECTION
========================= */

.location-section{

    width:88%;

    max-width:1150px;

    margin:0 auto 70px;

}


.location-heading{

    text-align:center;

    margin-bottom:28px;

}


.location-heading h2{

    color:#5a3e2b;

    font-family:Georgia,serif;

    font-size:34px;

    font-weight:normal;

    margin:0 0 9px;

}


.location-heading p{

    color:#777;

    margin:0;

    font-size:14px;

}


/* =========================
   MAP
========================= */

.location-map{

    background:#fff;

    padding:12px;

    border-radius:14px;

    box-shadow:
    0 6px 25px rgba(90,62,43,.10);

}


.location-map iframe{

    width:100%;

    height:350px;

    border:0;

    border-radius:9px;

    display:block;

}


/* =================================================
   CUSTOM POPUP
================================================= */

.popup-overlay{

    position:fixed;

    top:0;
    left:0;

    width:100%;
    height:100%;

    background:rgba(55,40,30,.55);

    display:flex;

    align-items:center;

    justify-content:center;

    z-index:999999;

}


.popup-box{

    width:390px;

    max-width:90%;

    background:#fff;

    padding:35px 30px;

    text-align:center;

    border-radius:16px;

    border:1px solid #e2d2c0;

    box-shadow:
    0 15px 45px rgba(90,62,43,.25);

    animation:popupShow .3s ease;

}


.popup-icon{

    width:65px;

    height:65px;

    margin:0 auto 18px;

    border-radius:50%;

    background:#f5ecdf;

    border:2px solid #8b5e34;

    display:flex;

    align-items:center;

    justify-content:center;

    box-sizing:border-box;

}


.popup-icon i{

    font-size:28px;

    color:#8b5e34;

    line-height:1;

}


.popup-box h2{

    margin:0 0 10px;

    color:#5a3e2b;

    font-family:Georgia,serif;

    font-size:27px;

    font-weight:normal;

}


.popup-box p{

    margin:0 0 25px;

    color:#777;

    font-size:14px;

    line-height:1.6;

}


.popup-box button{

    width:120px;

    padding:11px 20px;

    background:#8b5e34;

    color:#fff;

    border:none;

    border-radius:7px;

    font-size:15px;

    cursor:pointer;

    transition:.3s;

}


.popup-box button:hover{

    background:#6d4c41;

    transform:translateY(-2px);

    box-shadow:
    0 5px 12px rgba(90,62,43,.18);

}


/* =========================
   ERROR POPUP
========================= */

.error-popup .popup-icon{

    background:#f8eeee;

    border-color:#a94442;

}


.error-popup .popup-icon i{

    color:#a94442;

}


.error-popup h2{

    color:#8b3027;

}


/* =========================
   POPUP ANIMATION
========================= */

@keyframes popupShow{

    from{

        opacity:0;

        transform:scale(.85);

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

    .contact-heading{

        padding:40px 15px 30px;

    }


    .contact-heading h1{

        font-size:34px;

    }


    .contact-heading p{

        font-size:13px;

    }


    .contact-container{

        width:92%;

        margin-top:15px;

    }


    .contact-grid{

        grid-template-columns:1fr;

    }


    .contact-box{

        padding:25px;

    }


    .location-section{

        width:92%;

        margin-bottom:50px;

    }


    .location-heading h2{

        font-size:28px;

    }


    .popup-box{

        width:330px;

        padding:30px 20px;

    }

}

</style>


<div class="contact-page">


<!-- =========================
     PAGE HEADING
========================= -->

<section class="contact-heading">

    <div class="heading-line"></div>

    <h1>
        Contact Us
    </h1>

    <p>
        We're here to help you with all your furniture needs
    </p>

</section>


<!-- =========================
     CONTACT CONTENT
========================= -->

<div class="contact-container">


<div class="contact-grid">


<!-- =========================
     LEFT SIDE
========================= -->

<div class="contact-box">


    <h2>
        Let's Connect
    </h2>


    <div class="small-line"></div>


    <p class="connect-message">

        Have a question about our furniture or need assistance.
        Send us a message and our team will be happy to help you.

    </p>


    <!-- =====================
         ADDRESS
    ====================== -->

    <div class="info-box">

        <div class="info-icon">

            <i class="fas fa-map-marker-alt"></i>

        </div>


        <div class="info-content">

            <h4>
                Address
            </h4>

            <p>

                Woodisty Furniture,<br>
                Rajkot, Gujarat,<br>
                India.

            </p>

        </div>

    </div>


    <!-- =====================
         PHONE
    ====================== -->

    <div class="info-box">

        <div class="info-icon">

            <i class="fas fa-phone"></i>

        </div>


        <div class="info-content">

            <h4>
                Phone
            </h4>

            <p>
                +91 98765 43210
            </p>

        </div>

    </div>


    <!-- =====================
         EMAIL
    ====================== -->

    <div class="info-box">

        <div class="info-icon">

            <i class="fas fa-envelope"></i>

        </div>


        <div class="info-content">

            <h4>
                Email
            </h4>

            <p>
                info@woodisty.com
            </p>

        </div>

    </div>


    <!-- =====================
         WORKING HOURS
    ====================== -->

    <div class="info-box">

        <div class="info-icon">

            <i class="fas fa-clock"></i>

        </div>


        <div class="info-content">

            <h4>
                Working Hours
            </h4>

            <p>

                Monday - Saturday<br>
                09:00 AM - 08:00 PM

            </p>

        </div>

    </div>


</div>


<!-- =========================
     RIGHT SIDE
========================= -->

<div class="contact-box contact-form">


    <h2>
        Send Us A Message
    </h2>


    <div class="small-line"></div>


    <form method="POST" action="">


        <!-- =====================
             RATING
        ====================== -->

        <div class="rating-title">

            Your Rating

        </div>


        <div class="rating">


            <input
                type="radio"
                id="star5"
                name="rating"
                value="5"
                required
            >

            <label for="star5">
                &#9733;
            </label>


            <input
                type="radio"
                id="star4"
                name="rating"
                value="4"
            >

            <label for="star4">
                &#9733;
            </label>


            <input
                type="radio"
                id="star3"
                name="rating"
                value="3"
            >

            <label for="star3">
                &#9733;
            </label>


            <input
                type="radio"
                id="star2"
                name="rating"
                value="2"
            >

            <label for="star2">
                &#9733;
            </label>


            <input
                type="radio"
                id="star1"
                name="rating"
                value="1"
            >

            <label for="star1">
                &#9733;
            </label>


        </div>


        <!-- =====================
             EMAIL
        ====================== -->

        <label class="form-label">

            Email

        </label>


        <input
            type="email"
            name="email"
            placeholder="Enter your email address"
            required
        >


        <!-- =====================
             SUBJECT
        ====================== -->

        <label class="form-label">

            Subject

        </label>


        <input
            type="text"
            name="subject"
            placeholder="Enter subject"
            required
        >


        <!-- =====================
             MESSAGE
        ====================== -->

        <label class="form-label">

            Message

        </label>


        <textarea
            name="message"
            placeholder="Write your message..."
            required
        ></textarea>


        <!-- =====================
             BUTTON
        ====================== -->

        <button
            type="submit"
            name="submit"
            class="contact-btn"
        >

            <i class="fas fa-paper-plane"></i>

            Send Message

        </button>


    </form>


</div>


</div>


</div>


<!-- =========================
     LOCATION
========================= -->

<section class="location-section">


    <div class="location-heading">

        <h2>
            Our Location
        </h2>

        <p>
            Visit Woodisty Furniture in Rajkot, Gujarat
        </p>

    </div>


    <div class="location-map">


        <iframe
            src="https://www.google.com/maps?q=Rajkot,Gujarat&output=embed"
            loading="lazy"
            allowfullscreen>
        </iframe>


    </div>


</section>


</div>


<!-- =================================================
     SUCCESS POPUP
================================================= -->

<?php if($show_success){ ?>

<div class="popup-overlay">

    <div class="popup-box">

        <div class="popup-icon">

            <i class="fas fa-check"></i>

        </div>

        <h2>
            Message Sent!
        </h2>

        <p>
            Your message has been sent successfully.
        </p>

        <button
            type="button"
            onclick="window.location='contact.php'">
            OK
        </button>

    </div>

</div>

<?php } ?>


<!-- =================================================
     ERROR POPUP
================================================= -->

<?php if($show_error){ ?>

<div class="popup-overlay">

    <div class="popup-box error-popup">

        <div class="popup-icon">

            <i class="fas fa-times"></i>

        </div>

        <h2>
            Message Not Sent
        </h2>

        <p>
            Something went wrong. Please try again.
        </p>

        <button
            type="button"
            onclick="window.location='contact.php'">
            OK
        </button>

    </div>

</div>

<?php } ?>


<?php include("footer.php"); ?>