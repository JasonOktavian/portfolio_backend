<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
require_once 'conn.php';
require_once 'functions.php';
require_once 'navbar.php';
?>

<div class="container">
    <h1>About Me</h1>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="img/genshin_impact___albedo_s_constellation_by_anemoenjoyer_dfczt0p.jpg" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="img/genshin_impact___kaedehara_kazuha_s_constellation_by_anemoenjoyer_dfczkdl.jpg" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="img/genshin_impact___kamisato_ayato_s_constellation_by_anemoenjoyer_dfcznl3.jpg" alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

</div>

<div class="row">
    <div class="col">
        <p>Hi there my name is Jason Oktavian or you could call me jason im a collage student's and still learning new things about web developer</p>
    </div>
    <div class="col">
        <p>In this page im just showing you some of the UI/UX that i can do using bootstrap as a framework</p>
    </div>
    <div class="col">
        <p>Im open for suggestions and criticism to help me grow as a developer, well thats all cya</p>
    </div>
</div>