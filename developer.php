<style>

body{
    background:#f3eee8;
    font-family:'Segoe UI',sans-serif;
}


.team-section{
    width:90%;
    margin:60px auto;
    text-align:center;
}


/* Premium Header */

.team-title{
    margin-bottom:50px;
}

.team-title h1{
    font-size:55px;
    color:#4b2e1f;
    letter-spacing:4px;
}

.team-title span{
    color:#b07b45;
}

.team-title p{
    margin-top:15px;
    color:#777;
    font-size:18px;
}


/* Cards */

.team-container{
    display:flex;
    justify-content:center;
    gap:35px;
    flex-wrap:wrap;
}


.team-card{

    width:260px;
    height:350px;
    border-radius:25px;
    overflow:hidden;
    position:relative;
    box-shadow:0 15px 30px rgba(0,0,0,0.2);
    background:white;
    transition:.4s;

}


.team-card:hover{

    transform:translateY(-15px);

}


.team-card img{

    width:100%;
    height:100%;
    object-fit:cover;

}


/* Name Overlay */

.team-info{

    position:absolute;
    bottom:0;
    width:100%;
    padding:25px 10px;
    background:linear-gradient(transparent,rgba(0,0,0,.85));
    color:white;

}


.team-info h3{

    font-size:23px;
    margin-bottom:8px;

}


.team-info p{

    color:#e8c08b;
    font-size:16px;
    font-weight:bold;

}


/* Image Zoom */

.team-card:hover img{

    transform:scale(1.1);

}


.team-card img{

    transition:.5s;

}

</style>
<?php include 'header.php'; ?>


<section class="team-section">


<div class="team-title">

<h1>OUR <span>TEAM</span></h1>

<p>The creative minds behind Woodisty</p>

</div>



<div class="team-container">


<div class="team-card">

<img src="images/developer.png">

<div class="team-info">

<h3>Priyanshi Mathukiya</h3>

<p>Frontend Developer</p>

</div>

</div>



<div class="team-card">

<img src="images/DEVELOPER2.png">

<div class="team-info">

<h3>Ansh Patel</h3>

<p>Backend Developer</p>

</div>

</div>



<div class="team-card">

<img src="images/DEVELOPER3.png">

<div class="team-info">

<h3>Jay Solanki</h3>

<p>Database Designer</p>

</div>

</div>



<div class="team-card">

<img src="images/dev4.jpg">

<div class="team-info">

<h3>Meet Patel</h3>

<p>UI/UX Designer</p>

</div>

</div>


</div>

</section>
<?php include 'footer.php'; ?>