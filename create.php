<?php
require_once("conn.php");

if (isset($_POST["submit"])) {
    if (tambah($_POST) > 0) {
        echo "
        <script>
           alert('Create Success');
           document.location.href = 'index.php'; 
        </script>";
    } else {
        echo "
        <script>
           alert('Create Failed');
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
    <h1>TAMBAH DATA</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <ul>
                <li>
                    <label for="name">Nama Produk: </label>
                    <input type="text" name="name" id="name">
                </li>
                <li>
                    <label for="production">Negara Manufaktur: </label>
                    <input type="text" name="production" id="production">
                </li>
                <li>
                    <label for="price">Harga Produk dalam $: </label>
                    <input type="number" name="price" id="price">
                </li>
                <li>
                    <label for="img">Gambar Produk: </label>
                    <input type="file" id="img" name="img[]" multiple accept="gmbr/*">
                </li>
                <button type="submit" name="submit" class="btn-primary">Create New Data</button>
            </ul>
        </div>
    </form>
</body>

</html>