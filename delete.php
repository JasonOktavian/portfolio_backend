<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
require_once 'conn.php';
require_once 'functions.php';
require_once 'navbar.php';
$id = $_GET["product_id"];
if (hapus($id) > 0) {
    echo "
    <script>
       alert('Delete Success');
       document.location.href = 'index.php'; 
    </script>";
} else {
    echo "
    <script>
       alert('Delete Failed');
       document.location.href = 'index.php'; 
    </script>";
}
