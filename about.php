<?php include('header.php'); ?>

<style>

/* =========================
   ABOUT PAGE
========================= */

body{
    margin:0;
    padding:0;
    background:#f8f8f8;
    color:#333;
    font-family:Arial,sans-serif;
}


/* =========================
   ABOUT BANNER
========================= */

.about-banner{

    height:180px;

    background:#5c3b1e;

    display:flex;
    justify-content:center;
    align-items:center;

    text-align:center;

    color:white;

    margin:0;
}

.about-banner h1{

    font-family:Georgia,serif;

    font-size:46px;

    font-weight:normal;

    letter-spacing:1px;

    margin:0;
}


/* =========================
   MAIN CONTAINER
========================= */

.about-section{

    width:90%;
    max-width:1200px;

    margin:50px auto 80px;

}


/* =========================
   ABOUT ROW
========================= */

.about-row{

    display:grid;

    grid-template-columns:1fr 1fr;

    gap:40px;

    align-items:center;

    margin-bottom:60px;

}


/* =========================
   REVERSE ROW
========================= */

.about-row.reverse{

    direction:rtl;

}

.about-row.reverse .about-content{

    direction:ltr;

}

.about-row.reverse .about-image{

    direction:ltr;

}


/* =========================
   IMAGE CARD
========================= */

.about-image{

    background:#fff;

    border-radius:12px;

    overflow:hidden;

    box-shadow:
    0 5px 15px rgba(0,0,0,.12);

}

.about-image img{

    width:100%;

    height:320px;

    object-fit:cover;

    object-position:center;

    display:block;

}


/* =========================
   CONTENT
========================= */

.about-content{

    background:#fff;

    padding:35px;

    border-radius:12px;

    box-shadow:
    0 5px 15px rgba(0,0,0,.10);

}

.about-content h2{

    color:#5c3b1e;

    font-family:Georgia,serif;

    font-size:30px;

    font-weight:normal;

    margin:0 0 15px;

}

.about-line{

    width:55px;

    height:2px;

    background:#8b5a2b;

    margin-bottom:20px;

}

.about-content p{

    color:#666;

    font-size:15px;

    line-height:1.8;

    margin-bottom:15px;

}


/* =========================
   BUTTON
========================= */

.explore-btn{

    display:inline-block;

    background:#5c3b1e;

    color:#fff;

    text-decoration:none;

    padding:10px 22px;

    border-radius:5px;

    font-size:14px;

    transition:.3s;

}

.explore-btn:hover{

    background:#8b5a2b;

}


/* =========================
   MISSION & VISION
========================= */

.mission-section{

    background:#eee7e1;

    padding:60px 0;

    margin-bottom:60px;

}

.mission-title{

    text-align:center;

    color:#5c3b1e;

    font-family:Georgia,serif;

    font-size:34px;

    font-weight:normal;

    margin:0 0 35px;

}

.mission-grid{

    width:90%;

    max-width:1200px;

    margin:auto;

    display:grid;

    grid-template-columns:1fr 1fr;

    gap:30px;

}

.mission-box{

    background:#fff;

    padding:30px;

    border-radius:12px;

    text-align:center;

    box-shadow:
    0 5px 15px rgba(0,0,0,.10);

    transition:.3s;

}

.mission-box:hover{

    transform:translateY(-7px);

}

.mission-box h3{

    color:#5c3b1e;

    font-family:Georgia,serif;

    font-size:25px;

    font-weight:normal;

    margin:0 0 15px;

}

.mission-box p{

    color:#666;

    font-size:15px;

    line-height:1.8;

    margin:0;

}


/* =========================
   WHY CHOOSE US
========================= */

.why-section{

    width:90%;

    max-width:1200px;

    margin:0 auto 70px;

}

.why-title{

    text-align:center;

    color:#5c3b1e;

    font-family:Georgia,serif;

    font-size:34px;

    font-weight:normal;

    margin-bottom:35px;

}

.why-grid{

    display:grid;

    grid-template-columns:
    repeat(4,1fr);

    gap:25px;

}

.why-box{

    background:#fff;

    padding:28px 20px;

    text-align:center;

    border-radius:10px;

    box-shadow:
    0 5px 15px rgba(0,0,0,.10);

    transition:.3s;

}

.why-box:hover{

    transform:translateY(-7px);

}

.why-icon{

    font-size:30px;

    color:#8b5a2b;

    margin-bottom:15px;

}

.why-box h3{

    color:#5c3b1e;

    font-size:18px;

    margin:0 0 10px;

}

.why-box p{

    color:#666;

    font-size:14px;

    line-height:1.6;

    margin:0;

}


/* =========================
   CTA
========================= */

.about-cta{

    background:#5c3b1e;

    color:#fff;

    text-align:center;

    padding:60px 20px;

}

.about-cta h2{

    font-family:Georgia,serif;

    font-size:36px;

    font-weight:normal;

    margin:0 0 15px;

}

.about-cta p{

    font-size:16px;

    margin:0 0 25px;

}

.cta-btn{

    display:inline-block;

    background:#fff;

    color:#5c3b1e;

    text-decoration:none;

    padding:11px 25px;

    border-radius:5px;

    font-weight:bold;

    font-size:14px;

    transition:.3s;

}

.cta-btn:hover{

    background:#eee1db;

}


/* =========================
   RESPONSIVE
========================= */

@media(max-width:1000px){

    .why-grid{

        grid-template-columns:
        repeat(2,1fr);

    }

}

@media(max-width:750px){

    .about-banner{

        height:150px;

    }

    .about-banner h1{

        font-size:36px;

    }

    .about-row,
    .about-row.reverse{

        grid-template-columns:1fr;

        direction:ltr;

    }

    .about-image img{

        height:280px;

    }

    .mission-grid{

        grid-template-columns:1fr;

    }

}

@media(max-width:600px){

    .why-grid{

        grid-template-columns:1fr;

    }

    .about-section,
    .why-section{

        width:92%;

    }

}

</style>


<!-- =========================
     ABOUT BANNER
========================= -->

<section class="about-banner">

    <h1>ABOUT US</h1>

</section>


<!-- =========================
     ABOUT CONTENT
========================= -->

<section class="about-section">


    <!-- OUR STORY -->

    <div class="about-row">


        <div class="about-content">

            <h2>Our Story</h2>

            <div class="about-line"></div>

            <p>

                Woodisty was founded with a vision to bring timeless
                wooden craftsmanship into every home. Our skilled
                artisans carefully design each furniture piece using
                premium-quality wood and modern techniques.

            </p>

            <p>

                We believe furniture is more than just decoration -
                it is a part of your family's everyday life. Every
                product reflects durability, elegance, comfort, and
                attention to detail.

            </p>

        </div>


        <div class="about-image">

            <img
                src="images/bannerimage.jpg"
                alt="Woodisty Furniture"
            >

        </div>


    </div>


    <!-- WHO WE ARE -->

    <div class="about-row reverse">


        <div class="about-content">

            <h2>Who We Are</h2>

            <div class="about-line"></div>

            <p>

                Woodisty is a premium wooden furniture brand dedicated
                to creating stylish and durable furniture for modern
                homes.

            </p>

            <p>

                From luxurious sofas and elegant beds to dining tables,
                wardrobes, and chairs, we offer a complete range of
                handcrafted furniture that combines beauty with
                functionality.

            </p>

            <p>

                Our commitment to quality materials, skilled
                craftsmanship, and customer satisfaction has made
                Woodisty a trusted name for beautiful wooden furniture.

            </p>

            <a href="product.php" class="explore-btn">

                Explore Collection

            </a>

        </div>


        <div class="about-image">

            <img
                src="images/table3.jpg"
                alt="Woodisty Collection"
            >

        </div>


    </div>


</section>


<!-- =========================
     MISSION & VISION
========================= -->

<section class="mission-section">


    <h2 class="mission-title">

        Our Mission & Vision

    </h2>


    <div class="mission-grid">


        <div class="mission-box">

            <h3>Our Mission</h3>

            <p>

                To provide premium-quality wooden furniture that
                combines elegance, comfort, and durability while
                ensuring complete customer satisfaction.

            </p>

        </div>


        <div class="mission-box">

            <h3>Our Vision</h3>

            <p>

                To become the most trusted wooden furniture brand
                by delivering innovative designs and exceptional
                craftsmanship worldwide.

            </p>

        </div>


    </div>


</section>


<!-- =========================
     WHY CHOOSE WOODISTY
========================= -->

<section class="why-section">


    <h2 class="why-title">

        Why Choose Woodisty?

    </h2>


    <div class="why-grid">


        <div class="why-box">

            <div class="why-icon">
                <i class="fas fa-tree"></i>
            </div>

            <h3>Premium Wood</h3>

            <p>
                High-quality wood selected for
                long-lasting durability.
            </p>

        </div>


        <div class="why-box">

            <div class="why-icon">
                <i class="fas fa-couch"></i>
            </div>

            <h3>Modern Designs</h3>

            <p>
                Elegant furniture designed for
                modern living spaces.
            </p>

        </div>


        <div class="why-box">

            <div class="why-icon">
                <i class="fas fa-hammer"></i>
            </div>

            <h3>Expert Craftsmanship</h3>

            <p>
                Skilled artisans carefully craft
                every furniture piece.
            </p>

        </div>


        <div class="why-box">

            <div class="why-icon">
                <i class="fas fa-truck"></i>
            </div>

            <h3>Safe Delivery</h3>

            <p>
                Secure packaging and safe delivery
                to your doorstep.
            </p>

        </div>


    </div>


</section>


<!-- =========================
     CTA
========================= -->

<section class="about-cta">


    <h2>

        Bring Nature Into Your Home

    </h2>


    <p>

        Explore our premium wooden furniture collection and
        transform your home with timeless elegance.

    </p>


    <a href="product.php" class="cta-btn">

        Shop Now

    </a>


</section>


<?php include('footer.php'); ?>