<?php 
 
session_start(); 
 
include("connection.php"); 
include("header.php"); 
 
 
// ========================================
// FEATURED PRODUCTS FROM DATABASE
// ========================================
 
$featured_products = mysqli_query( 
    $con, 
    "SELECT * FROM product ORDER BY pid DESC LIMIT 6" 
); 
 
?> 
 <link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
 
<!-- ========================================================= 
     BILLBOARD
========================================================= -->
 
<section id="billboard" class="overflow-hidden"> 
 
    <div class="swiper main-swiper"> 
 
        <div class="swiper-wrapper"> 
 
 
            <!-- SLIDE 1 -->
 
            <div class="swiper-slide"> 
 
                <div class="container-fluid"> 
 
                    <div class="row"> 
 
                        <div class="col-md-12"> 
 
                            <div 
                                class="banner-item" 
                                style=" 
                                    background-image:url(images/banner-image1.jpg); 
                                    background-repeat:no-repeat; 
                                    background-position:right; 
                                    height:682px; 
                                " 
                            > 
 
                                <div class="banner-content padding-large"> 
 
                                    <h1 class="display-1 text-uppercase text-dark pb-2"> 
                                        wooden table set 
                                    </h1> 
 
 
                                    <p style="font-size:14px"> 
 
                                        Woodisty brings timeless craftsmanship and modern 
                                        design together to create premium wooden furniture 
                                        for every home. Every piece is crafted with attention 
                                        to detail, using high-quality materials that ensure 
                                        durability, elegance, and lasting comfort. From dining 
                                        tables to custom furniture, Woodisty transforms your 
                                        living spaces with style and functionality. 
 
                                    </p> 
 
 
                                    <a 
                                        href="product.php" 
                                        class="btn btn-medium btn-arrow position-relative mt-5" 
                                    > 
 
                                        <span class="text-uppercase"> 
                                            Shop Now 
                                        </span> 
 
                                        <svg 
                                            class="arrow-right position-absolute" 
                                            width="18" 
                                            height="20" 
                                        > 
 
                                            <use xlink:href="#arrow-right"></use> 
 
                                        </svg> 
 
                                    </a> 
 
 
                                </div> 
 
                            </div> 
 
                        </div> 
 
                    </div> 
 
                </div> 
 
            </div> 
 
 
 
            <!-- SLIDE 2 --> 
 
            <div class="swiper-slide"> 
 
                <div class="container-fluid"> 
 
                    <div class="row"> 
 
                        <div class="col-md-12"> 
 
                            <div 
                                class="banner-item" 
                                style=" 
                                    background-image:url(images/banner-image1.jpg); 
                                    background-repeat:no-repeat; 
                                    background-position:right; 
                                    height:682px; 
                                " 
                            > 
 
                                <div class="banner-content padding-large"> 
 
                                    <h1 class="display-1 text-uppercase text-dark pb-2"> 
                                        Comfortable Sofa Set 
                                    </h1> 
 
 
                                    <p style="font-size:14px"> 
 
                                        At Woodisty, our Comfortable Sofa Sets are designed 
                                        to bring together luxury, comfort, and durability. 
                                        Crafted with premium-quality materials and exceptional 
                                        attention to detail, each sofa offers superior support 
                                        and long-lasting performance. Whether you're spending 
                                        time with family, entertaining guests, or simply 
                                        relaxing after a long day, our stylish sofa sets add 
                                        elegance and warmth to every living space while 
                                        complementing both modern and classic interiors. 
 
                                    </p> 
 
 
                                    <a 
                                        href="product.php" 
                                        class="btn btn-medium btn-arrow position-relative mt-5" 
                                    > 
 
                                        <span class="text-uppercase"> 
                                            Shop Now 
                                        </span> 
 
                                        <svg 
                                            class="arrow-right position-absolute" 
                                            width="18" 
                                            height="20" 
                                        > 
 
                                            <use xlink:href="#arrow-right"></use> 
 
                                        </svg> 
 
                                    </a> 
 
 
                                </div> 
 
                            </div> 
 
                        </div> 
 
                    </div> 
 
                </div> 
 
            </div> 
 
 
        </div> 
 
    </div> 
 
 
    <div class="swiper-pagination position-absolute"></div> 
 
</section> 
 
 
 
 
<!-- ========================================================= 
     ABOUT US 
========================================================= -->
 
<section id="about-us"> 
 
    <div class="container-fluid"> 
 
        <div class="row align-items-center justify-content-between g-5"> 
 
 
            <div class="col-lg-6"> 
 
                <div class="image-holder mb-4 jarallax"> 
 
                    <img 
                        src="images/about2.jpg" 
                        alt="single" 
                        class="img-fluid jarallax-img" 
                    > 
 
                </div> 
 
            </div> 
 
 
 
            <div class="col-lg-6"> 
 
                <div class="detail p-5"> 
 
                    <div class="display-header"> 
 
                        <h2 class="display-2 text-uppercase text-dark pb-2"> 
                            About Us 
                        </h2> 
 
 
                        <p class="pb-3"> 
 
                            At Woodisty, we believe furniture is more than just utility 
                            it is a reflection of lifestyle, comfort, and craftsmanship. 
                            With a passion for timeless design and quality workmanship, 
                            we create premium wooden furniture that enhances every living space. 
 
                            <br><br> 
 
                            Each piece is carefully crafted using high-quality materials, 
                            ensuring durability, strength, and long-lasting beauty. 
                            Our designs blend modern aesthetics with traditional craftsmanship, 
                            making them suitable for both contemporary and classic interiors. 
 
                            <br><br> 
 
                            From elegant sofa sets to stylish dining tables and custom 
                            furniture solutions, Woodisty is committed to bringing comfort, 
                            elegance, and functionality into your home. 
 
                        </p> 
 
 
                        <a 
                            href="about.php" 
                            class="btn btn-medium btn-arrow outline-dark position-relative mt-3" 
                        > 
 
                            <span class="text-uppercase"> 
                                About us 
                            </span> 
 
                            <svg 
                                class="arrow-right position-absolute" 
                                width="18" 
                                height="20" 
                            > 
 
                                <use xlink:href="#arrow-right"></use> 
 
                            </svg> 
 
                        </a> 
 
 
                    </div> 
 
                </div> 
 
            </div> 
 
 
        </div> 
 
    </div> 
 
</section> 
 
 
 
 
<!-- ========================================================= 
     FEATURED PRODUCTS 
     DATABASE PRODUCTS
========================================================= -->
 
<section 
    id="featured-products" 
    class="product-store position-relative padding-large" 
> 
 
    <div class="container-fluid"> 
 
 
        <!-- HEADING -->
 
        <div class="row"> 
 
            <div 
                class="display-header pb-3 d-flex justify-content-between 
                       flex-wrap col-md-12" 
            > 
 
                <h2 class="display-2 text-dark text-uppercase"> 
 
                    Our Featured Products 
 
                </h2> 
 
 
                <a 
                    href="product.php" 
                    class="btn btn-medium btn-arrow btn-normal position-relative" 
                > 
 
                    <span class="text-uppercase"> 
                        Shop All 
                    </span> 
 
 
                    <svg 
                        class="arrow-right position-absolute" 
                        width="18" 
                        height="20" 
                    > 
 
                        <use xlink:href="#arrow-right"></use> 
 
                    </svg> 
 
                </a> 
 
            </div> 
 
        </div> 
 
 
 
 
        <!-- PRODUCTS -->
 
        <div class="row"> 
 
            <div 
                id="featured-swiper" 
                class="product-swiper col-md-12" 
            > 
 
                <div class="swiper"> 
 
                    <div class="swiper-wrapper"> 
 
 
                        <?php 
 
                        if(mysqli_num_rows($featured_products) > 0) 
                        { 
 
                            while($row = mysqli_fetch_assoc($featured_products)) 
                            { 
 
                        ?> 
 
 
                        <!-- PRODUCT -->
 
                        <div class="swiper-slide"> 
 
                            <div 
                                class="product-card image-zoom-effect 
                                       link-effect d-flex flex-wrap" 
                            > 
 
 
                                <!-- PRODUCT IMAGE -->
 
                                <div class="image-holder"> 
 
                                    <img 
                                        src="images/product/<?php echo htmlspecialchars($row['image']); ?>" 
                                        alt="<?php echo htmlspecialchars($row['product_name']); ?>" 
                                        class="product-image img-fluid" 
                                        style=" 
                                            height:390px; 
                                            width:100%; 
                                            object-fit:cover; 
                                        " 
                                    > 
 
                                </div> 
 
 
 
                                <!-- PRODUCT INFORMATION -->
 
                                <div class="cart-concern"> 
 
 
                                    <!-- PRODUCT NAME -->
 
                                    <h3 
                                        class="card-title text-uppercase 
                                               pt-3 text-primary" 
                                    > 
 
                                        <a 
                                            href="product_detail.php?id=<?php echo $row['pid']; ?>" 
                                            class="text-primary" 
                                        > 
 
                                            <?php 
                                            echo htmlspecialchars( 
                                                $row['product_name'] 
                                            ); 
                                            ?> 
 
                                        </a> 
 
                                    </h3> 
 
 
 
                                    <!-- PRODUCT PRICE + VIEW PRODUCT -->
 
                                    <div class="cart-info"> 
 
                                        <a 
                                            href="product_detail.php?id=<?php echo $row['pid']; ?>" 
                                            class="pseudo-text-effect" 
                                            data-after="view product" 
                                        > 
 
                                            <br> 
 
                                            <span> 
 
                                                <?php 
                                                echo number_format( 
                                                    $row['price'], 
                                                    0 
                                                ); 
                                                ?> 
 
                                            </span> 
 
                                        </a> 
 
                                    </div> 
 
 
                                </div> 
 
 
                            </div> 
 
                        </div> 
 
 
                        <?php 
 
                            } 
 
                        } 
 
                        else 
                        { 
 
                        ?> 
 
                            <div 
                                style=" 
                                    width:100%; 
                                    text-align:center; 
                                    padding:50px; 
                                " 
                            > 
 
                                <h3> 
                                    No Products Available 
                                </h3> 
 
                            </div> 
 
                        <?php 
 
                        } 
 
                        ?> 
 
 
                    </div> 
 
                </div> 
 
 
                <div class="swiper-pagination text-center mt-5"></div> 
 
            </div> 
 
        </div> 
 
 
    </div> 
 
</section> 
 
 
 
 
<!-- ========================================================= 
     TESTIMONIALS 
========================================================= -->
 
<section 
    id="testimonials" 
    class="position-relative" 
> 
 
    <div class="container"> 
 
        <div class="row"> 
 
            <div class="review-content position-relative"> 
 
 
                <!-- PREVIOUS -->
 
                <div 
                    class="swiper-icon swiper-arrow swiper-arrow-prev 
                           position-absolute d-flex align-items-center 
                           justify-content-center" 
                > 
 
                    <svg 
                        class="icon-arrow" 
                        width="25" 
                        height="25" 
                    > 
 
                        <use xlink:href="#arrow-left"></use> 
 
                    </svg> 
 
                </div> 
 
 
 
                <!-- TESTIMONIAL SWIPER -->
 
                <div class="swiper testimonial-swiper"> 
 
 
                    <div class="quotation text-center"> 
 
                        <svg class="quote"> 
 
                            <use xlink:href="#quote"></use> 
 
                        </svg> 
 
                    </div> 
 
 
                    <div class="swiper-wrapper"> 
 
 
                        <!-- REVIEW 1 -->
 
                        <div 
                            class="swiper-slide text-center 
                                   d-flex justify-content-center" 
                        > 
 
                            <div class="review-item col-md-10"> 
 
                                <i class="icon icon-review"></i> 
 
 
                                <blockquote class="fs-4"> 
 
                                    "Our mission is to provide high-quality products 
                                    at affordable prices while ensuring a seamless 
                                    shopping experience." 
 
                                </blockquote> 
 
 
                                <div class="author-detail"> 
 
                                    <div 
                                        class="name text-primary 
                                               text-uppercase pt-2" 
                                    > 
 
                                        Our Mission 
 
                                    </div> 
 
                                </div> 
 
                            </div> 
 
                        </div> 
 
 
 
                        <!-- REVIEW 2 -->
 
                        <div 
                            class="swiper-slide text-center 
                                   d-flex justify-content-center" 
                        > 
 
                            <div class="review-item col-md-10"> 
 
                                <i class="icon icon-review"></i> 
 
 
                                <blockquote class="fs-4"> 
 
                                    "Enjoy exclusive deals, seasonal discounts, 
                                    and free shipping on selected orders. 
                                    Shop today and save more!" 
 
                                </blockquote> 
 
 
                                <div class="author-detail"> 
 
                                    <div 
                                        class="name text-primary 
                                               text-uppercase pt-2" 
                                    > 
 
                                        Special Offers 
 
                                    </div> 
 
                                </div> 
 
                            </div> 
 
                        </div> 
 
 
                    </div> 
 
                </div> 
 
 
 
                <!-- NEXT -->
 
                <div 
                    class="swiper-icon swiper-arrow swiper-arrow-next 
                           position-absolute d-flex align-items-center 
                           justify-content-center" 
                > 
 
                    <svg 
                        class="icon-arrow" 
                        width="25" 
                        height="25" 
                    > 
 
                        <use xlink:href="#arrow-right"></use> 
 
                    </svg> 
 
                </div> 
 
 
            </div> 
 
        </div> 
 
    </div> 
 
 
    <div 
        class="swiper-pagination text-center position-absolute" 
    ></div> 
 
</section> 
 
 
 
 
<!-- ========================================================= 
     COLLECTIONS 
========================================================= -->
 
<section 
    id="collections" 
    class="position-relative padding-large" 
> 
 
    <div class="container-fluid"> 
 
        <div class="row"> 
 
            <div class="swiper collection-swiper"> 
 
                <div class="swiper-wrapper"> 
 
 
                    <!-- LIVING ROOMS -->
 
                    <div class="swiper-slide overflow-hidden"> 
 
                        <div class="product-card"> 
 
 
                            <div 
                                class="card-detail d-flex 
                                       justify-content-between 
                                       align-items-baseline pt-3" 
                            > 
 
                                <h3 class="card-title text-uppercase"> 
 
                                    <a href="product.php"> 
 
                                        Living Rooms 
 
                                    </a> 
 
                                </h3> 
 
                            </div> 
 
 
 
                            <div class="image-overlay position-relative"> 
 
                                <div class="product-image"> 
 
                                    <img 
                                        src="images/product-item5.jpg" 
                                        alt="product-item" 
                                        class="product-image img-fluid" 
                                    > 
 
 
                                    <div 
                                        class="text-box box-slide 
                                               position-absolute" 
                                    > 
 
                                        <div 
                                            class="text-content p-5 bg-light" 
                                        > 
 
                                            <h3> 
                                                About Room 
                                            </h3> 
 
 
                                            <p> 
 
                                                Transform your living room with 
                                                stylish wooden furniture designed 
                                                for comfort, beauty, and everyday use. 
 
                                            </p> 
 
 
                                            <ul> 
 
                                                <li> 
                                                    Premium Wooden Sofas 
                                                </li> 
 
                                                <li> 
                                                    Coffee Tables & TV Units 
                                                </li> 
 
                                                <li> 
                                                    Modern & Classic Designs 
                                                </li> 
 
                                            </ul> 
 
 
                                        </div> 
 
                                    </div> 
 
 
                                </div> 
 
                            </div> 
 
 
                        </div> 
 
                    </div> 
 
 
 
 
                    <!-- BED ROOMS -->
 
                    <div class="swiper-slide overflow-hidden"> 
 
                        <div class="product-card"> 
 
 
                            <div 
                                class="card-detail d-flex 
                                       justify-content-between 
                                       align-items-baseline pt-3" 
                            > 
 
                                <h3 class="card-title text-uppercase"> 
 
                                    <a href="product.php"> 
 
                                        Bed Rooms 
 
                                    </a> 
 
                                </h3> 
 
                            </div> 
 
 
 
                            <div class="image-overlay position-relative"> 
 
                                <div class="product-image"> 
 
                                    <img 
                                        src="images/product-item6.jpg" 
                                        alt="product-item" 
                                        class="product-image img-fluid" 
                                    > 
 
 
                                    <div 
                                        class="text-box box-slide 
                                               position-absolute" 
                                    > 
 
                                        <div 
                                            class="text-content p-5 bg-light" 
                                        > 
 
                                            <h3> 
                                                About Room 
                                            </h3> 
 
 
                                            <p> 
 
                                                Experience comfort and elegance 
                                                with our premium wooden beds, 
                                                crafted from high-quality Sheesham 
                                                and Teak wood for lasting durability. 
 
                                            </p> 
 
 
                                            <ul> 
 
                                                <li> 
                                                    Modern & Classic Bed Designs 
                                                </li> 
 
                                                <li> 
                                                    Queen, King & Single Size Beds 
                                                </li> 
 
                                                <li> 
                                                    Strong, Stylish & Durable Finish 
                                                </li> 
 
                                            </ul> 
 
 
                                        </div> 
 
                                    </div> 
 
 
                                </div> 
 
                            </div> 
 
 
                        </div> 
 
                    </div> 
 
 
 
 
                    <!-- KITCHENS -->
 
                    <div class="swiper-slide overflow-hidden"> 
 
                        <div class="product-card"> 
 
 
                            <div 
                                class="card-detail d-flex 
                                       justify-content-between 
                                       align-items-baseline pt-3" 
                            > 
 
                                <h3 class="card-title text-uppercase"> 
 
                                    <a href="product.php"> 
 
                                        Kitchens 
 
                                    </a> 
 
                                </h3> 
 
                            </div> 
 
 
 
                            <div class="image-overlay position-relative"> 
 
                                <div class="product-image"> 
 
                                    <img 
                                        src="images/product-item7.jpg" 
                                        alt="product-item" 
                                        class="product-image img-fluid" 
                                    > 
 
 
                                    <div 
                                        class="text-box box-slide 
                                               position-absolute" 
                                    > 
 
                                        <div 
                                            class="text-content p-5 bg-light" 
                                        > 
 
                                            <h3> 
                                                About Kitchen 
                                            </h3> 
 
 
                                            <p> 
 
                                                Transform your kitchen into a 
                                                stylish and functional space with 
                                                modern designs, premium materials, 
                                                and smart storage solutions tailored 
                                                to your lifestyle. 
 
                                            </p> 
 
 
                                            <ul> 
 
                                                <li> 
                                                    Modular Kitchen Designs 
                                                </li> 
 
                                                <li> 
                                                    Custom Cabinets & Storage 
                                                </li> 
 
                                                <li> 
                                                    Premium Countertops & Finishes 
                                                </li> 
 
                                                <li> 
                                                    Modern Appliances Integration 
                                                </li> 
 
                                                <li> 
                                                    Elegant & Functional Layouts 
                                                </li> 
 
                                            </ul> 
 
 
                                        </div> 
 
                                    </div> 
 
 
                                </div> 
 
                            </div> 
 
 
                        </div> 
 
                    </div> 
 
 
 
 
                    <!-- GUEST ROOMS -->
 
                    <div class="swiper-slide overflow-hidden"> 
 
                        <div class="product-card"> 
 
                        <div 
                            class="card-detail d-flex 
                                   justify-content-between 
                                   align-items-baseline pt-3" 
                        > 
 
                            <h3 class="card-title text-uppercase"> 
 
                                <a href="product.php"> 
 
                                    Guest Rooms 
 
                                </a> 
 
                            </h3> 
 
                        </div> 
 
 
 
                        <div class="image-overlay position-relative"> 
 
                            <div class="product-image"> 
 
                                <img 
                                    src="images/product-item8.jpg" 
                                    alt="product-item" 
                                    class="product-image img-fluid" 
                                > 
 
 
                                <div 
                                    class="text-box box-slide 
                                           position-absolute" 
                                > 
 
                                    <div 
                                        class="text-content p-5 bg-light" 
                                    > 
 
                                        <h3> 
                                            About Guest Room 
                                        </h3> 
 
 
                                        <p> 
 
                                            Create a warm and welcoming guest 
                                            room with elegant furniture, 
                                            comfortable seating, and stylish decor 
                                            that offers every guest a relaxing 
                                            and memorable experience. 
 
                                        </p> 
 
 
                                        <ul> 
 
                                            <li> 
                                                Elegant Guest Room Furniture 
                                            </li> 
 
                                            <li> 
                                                Comfortable Beds & Seating 
                                            </li> 
 
                                            <li> 
                                                Modern Interior Designs 
                                            </li> 
 
                                            <li> 
                                                Smart Storage Solutions 
                                            </li> 
 
                                            <li> 
                                                Premium Wooden Finishes 
                                            </li> 
 
                                        </ul> 
 
 
                                    </div> 
 
                                </div> 
 
 
                            </div> 
 
                        </div> 
 
 
                        </div> 
 
                    </div> 
 
 
                </div> 
 
            </div> 
 
        </div> 
 
    </div> 
 
 
    <div 
        class="swiper-pagination position-absolute text-center" 
    ></div> 
 
</section> 
 
 
 
 
<!-- =========================================================
     WHY CHOOSE WOODISTY
     ONLY ICON SIZE CHANGED
========================================================= -->

<style>

.why-woodisty{
    padding:80px 0;
    background:#f8f6f3;
    position:relative;
    overflow:hidden;
}

.why-woodisty .section-heading{
    text-align:center;
    margin-bottom:45px;
}

.why-woodisty .small-title{
    color:#8b5e34;
    font-size:14px;
    font-weight:600;
    letter-spacing:3px;
    text-transform:uppercase;
    margin-bottom:12px;
}

.why-woodisty .main-title{
    font-family:Georgia, "Times New Roman", serif;
    font-size:42px;
    color:#2f2118;
    margin:0;
}

.why-woodisty .heading-line{
    width:55px;
    height:3px;
    background:#a8793f;
    margin:18px auto 0;
}


/* MAIN WHITE BOX */

.why-box{
    width:94%;
    margin:0 auto;
    background:#ffffff;
    border-radius:15px;
    box-shadow:0 8px 30px rgba(0,0,0,0.08);

    display:grid;
    grid-template-columns:repeat(4,1fr);

    padding:35px 20px;
}


/* FOUR ITEMS */

.why-item{
    text-align:center;
    padding:10px 30px;
    position:relative;
}


/* VERTICAL LINE */

.why-item:not(:last-child)::after{
    content:"";
    position:absolute;
    right:0;
    top:5%;
    height:90%;
    width:1px;
    background:#ddd6cf;
}


/* SMALL CIRCLE ICON */
.why-icon{
    width:50px;
    height:50px;
    margin:0 auto 15px;

    border-radius:50%;

    background:#f5ecdf;
    border:1px solid #d8c2a8;

    display:flex;
    align-items:center;
    justify-content:center;

    box-sizing:border-box;

    color:#8b5e34;
}

.why-icon i{
    font-size:20px;
    line-height:1;
    margin:0;
    padding:0;
    color:#8b5e34;

    display:flex;
    align-items:center;
    justify-content:center;
}


/* TITLE */

.why-item h4{
    font-family:Georgia, "Times New Roman", serif;
    color:#3b291d;
    font-size:21px;
    margin-bottom:12px;
}


/* DESCRIPTION */

.why-item p{
    color:#666;
    font-size:14px;
    line-height:1.7;
    margin:0;
}


/* BOTTOM TEXT */

.why-bottom{
    text-align:center;
    margin-top:35px;


    color:#8b5e34;

    font-size:12px;
    letter-spacing:5px;

    text-transform:uppercase;
    font-weight:600;
}


/* TABLET */

@media(max-width:1000px){

    .why-box{
        grid-template-columns:repeat(2,1fr);
    }

    .why-item:nth-child(2)::after{
        display:none;
    }

    .why-item:nth-child(1),
    .why-item:nth-child(2){
        margin-bottom:30px;
    }

}


/* MOBILE */

@media(max-width:600px){

    .why-woodisty{
        padding:55px 0;
    }

    .why-woodisty .main-title{
        font-size:30px;
    }

    .why-box{
        grid-template-columns:1fr;
        width:90%;
        padding:25px 10px;
    }

    .why-item{
        padding:25px 20px;
    }

    .why-item:not(:last-child)::after{
        right:10%;
        top:auto;
        bottom:0;
        width:80%;
        height:1px;
    }

    .why-item:nth-child(2)::after{
        display:block;
    }

}

</style>


<section class="why-woodisty">

    <div class="container-fluid">

        <!-- HEADING -->

        <div class="section-heading">

         
            <h2 class="main-title">
                Building Better Homes, Together
            </h2>

            <div class="heading-line"></div>

        </div>


        <!-- FOUR OPTIONS -->

        <div class="why-box">


            <!-- 1 PREMIUM QUALITY -->

            <div class="why-item">
<div class="why-icon">
    <i class="fas fa-award"></i>
</div>
                <h4>
                    Premium Wood Quality
                </h4>

                <p>
                    We use high-quality wood and durable materials
                    to create furniture built for long-lasting beauty.
                </p>

            </div>


            <!-- 2 CUSTOM DESIGN -->

            <div class="why-item">

               <div class="why-icon">
    <i class="fas fa-pencil-ruler"></i>
</div>
                <h4>
                    Custom Furniture Design
                </h4>

                <p>
                    From modern to classic, our furniture is designed
                    to match your style, space and needs.
                </p>

            </div>


            <!-- 3 DELIVERY -->

            <div class="why-item">

                <div class="why-icon">
    <i class="fas fa-truck"></i>
</div>
                <h4>
                    Safe & Timely Delivery
                </h4>

                <p>
                    Your furniture reaches your doorstep safely,
                    on time and with complete care.
                </p>

            </div>


            <!-- 4 CUSTOMER -->

            <div class="why-item">

              <div class="why-icon">
    <i class="fas fa-heart"></i>
</div>


                <h4>
                    Customer Satisfaction
                </h4>

                <p>
                    Your satisfaction is our priority.
                    We are here to support you before and after your purchase.
                </p>

            </div>


        </div>


        <!-- BOTTOM TEXT -->

        <div class="why-bottom">
            Quality &nbsp;&nbsp; Design &nbsp;&nbsp; Trust
        </div>

    </div>

</section>



<!-- ========================================================= 
     BRAND COLLECTION 
========================================================= -->
 
<section 
    id="brand-collection" 
    class="padding-small border-top border-bottom 
           overflow-hidden margin-large mb-0" 
> 
 
    <div class="container"> 
 
        <div 
            class="d-flex flex-wrap justify-content-between 
                   align-items-center gap-3" 
        > 
 
 
            <a href="#"> 
 
                <img 
                    src="images/brand-logo-1.svg" 
                    alt="brand" 
                > 
 
            </a> 
 
 
            <a href="#"> 
 
                <img 
                    src="images/brand-logo-2.svg" 
                    alt="brand" 
                > 
 
            </a> 
 
 
            <a href="#"> 
 
                <img 
                    src="images/brand-logo-3.svg" 
                    alt="brand" 
                > 
 
            </a> 
 
 
            <a href="#"> 
 
                <img 
                    src="images/brand-logo-4.svg" 
                    alt="brand" 
                > 
 
            </a> 
 
 
            <a href="#"> 
 
                <img 
                    src="images/brand-logo-5.svg" 
                    alt="brand" 
                > 
 
            </a> 
 
 
        </div> 
 
    </div> 
 
</section> 
 
 
 
 
<?php 
 
include("footer.php"); 
 
?>