<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
require_once("conn.php");
require_once("functions.php");

//ambil data di url
$id = $_GET["product_id"];
//query data mhs berdasarkan id
$produk = query("SELECT * FROM product WHERE product_id = $id")[0];

if (isset($_POST["submit"])) {
    if (update($_POST) > 0) {
        echo "
        <script>
           alert('Update Success');
           document.location.href = 'index.php'; 
        </script>";
    } else {
        echo "
        <script>
           alert('Update Failed');
           document.location.href = 'index.php'; 
        </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <title>Document</title>
</head>

<body class="container mt-6">
    <h1>UPDATE DATA</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <ul>
                <input type="hidden" name="id" id="id" value="<?= $produk["product_id"]; ?>">
                <input type="hidden" name="gambarLama" id="gambarLama" value="<?= $produk["gambar"]; ?>">
                <li>
                    <label for="name">Nama Produk: </label>
                    <input type="text" name="name" id="name" value="<?= $produk["nama"]; ?>">
                </li>
                <li>
                    <label for="production">Negara Manufaktur: </label>
                    <input type="text" name="production" id="production" value="<?= $produk["produksi"]; ?>">
                </li>
                <li>
                    <label for="price">Harga Produk dalam $: </label>
                    <input type="number" name="price" id="price" value="<?= $produk["harga"]; ?>">
                </li>
                <li>
                    <label for="img">Gambar Produk: </label>
                    <img style="width: 100px; length: 100px" src="gmbr/<?= $produk["gambar"]; ?>" alt="">
                    <input type="file" id="img" name="img" accept="gmbr/*">
                </li>
                <button type="submit" name="submit" class="btn-primary">Update Data</button>
            </ul>
        </div>
    </form>
</body>

</html>