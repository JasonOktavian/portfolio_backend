<?php
// $host = "localhost";
// $dbname = "data_produk";
// $username = "root";
// $password = "";

// try {
//     $conn = new PDO("mysql:host=" . $host . ";dbname=" . $dbname, $username, $password);
// } catch (PDOException $pe) {
//     die("Could not connect to the database $dbname :" . $pe->getMessage());
// }


$conn = new mysqli("localhost", "root", "", "data_produk");
if ($conn->connect_error) {
    die("Error : " . $conn->connect_error);
}
