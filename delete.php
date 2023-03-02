<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
require_once('conn.php');
$id = $_GET["product_id"];
if (hapus($id) > 0) {
    echo "
    <script>
       alert('Delete Success');
       document.loaction.href = 'index/php'; 
    </script>";
} else {
    echo "
    <script>
       alert('Delete Failed');
       document.loaction.href = 'index/php'; 
    </script>";
}
