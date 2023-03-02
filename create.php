<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
require_once 'conn.php';
require_once 'functions.php';
require_once 'navbar.php';

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