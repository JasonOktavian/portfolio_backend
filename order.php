<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
require_once 'conn.php';
require_once 'functions.php';
require_once 'navbar.php';
