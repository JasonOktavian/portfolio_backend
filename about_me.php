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

<h1>About Me</h1>

<div class="contents">
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
</div>