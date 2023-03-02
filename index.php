<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
require_once("conn.php");
require_once("functions.php");

//pagination b
$jumlahdataperhalaman = 3;
$jumlahData = count(query("SELECT * FROM product"));
$jumlahHalaman = ceil($jumlahData / $jumlahdataperhalaman);
//operation ternari ? (jika ya) :(jika tidak/else)
$halamanaktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
// untuk menentukan awal data untuk setiap halaman
$awalData = ($jumlahdataperhalaman * $halamanaktif) - $jumlahdataperhalaman;


$barang = query("SELECT * FROM product LIMIT $awalData, $jumlahdataperhalaman");


//tombol cari di klick
if (isset($_POST["cari"])) {
    $barang = cari($_POST["keyword"]);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h4>Portfolio</h4>
            </div>

            <ul class="list-unstyled components">
                <!-- Home menu and sub menu -->
                <li class="active">
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Home</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="#">Home 1</a>
                        </li>
                        <li>
                            <a href="#">Home 2</a>
                        </li>
                        <li>
                            <a href="#">Home 3</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">About</a>
                </li>
                <!-- Page Menu and submenu -->
                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Pages</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="#">Page 1</a>
                        </li>
                        <li>
                            <a href="#">Page 2</a>
                        </li>
                        <li>
                            <a href="#">Page 3</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">Portfolio</a>
                </li>
                <li>
                    <a href="#">Contact</a>
                </li>
            </ul>
        </nav>

        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-bars"></i>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="#">Page</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Page</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Page</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Page</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div id="contents">

                <!-- Form Search -->
                <form action="" method="post" class="mx-auto">
                    <input type="text" id="keyword" name="keyword" autofocus placeholder="Input Keyword Here" autocomplete="off">
                    <button type="submit" id="btnCari " name="cari" class="btn-primary">SEARCH</button>
                </form>

                <!-- Navigasi Pagination -->

                <?php if ($halamanaktif > 1) : ?>
                    <a href="?halaman=<?= $halamanaktif - 1; ?>">&lt</a>
                <?php endif ?>


                <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                    <?php if ($i == $halamanaktif) : ?>
                        <a style="font-weight :bold;" href="?halaman=<?= $i; ?>"><?= $i ?></a>
                    <?php else : ?>
                        <a href="?halaman=<?= $i; ?>"><?= $i ?></a>
                    <?php endif ?>
                <?php endfor ?>

                <?php if ($halamanaktif < $jumlahHalaman) : ?>
                    <a href="?halaman=<?= $halamanaktif + 1; ?>">&gt</a>
                <?php endif ?>

                <br>
                <a href="create.php" class="btn btn-primary mb-1 mt-1">Create</a>
                <a href="logout.php" class="btn btn-primary mb-1 mt-1">Logout</a>
                <div id="ajaxcon">
                    <table class="mx-auto" border="1" cellpadding="10" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Produksi</th>
                                <th>Harga(USD)</th>
                                <th>Gambar</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <?php $i = 1; ?>
                        <?php foreach ($barang as $row) : ?>
                            <tbody>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= $row["nama"]; ?></td>
                                    <td><?= $row["produksi"]; ?></td>
                                    <td><?= $row["harga"]; ?></td>
                                    <td><img style="width: 100px; length: 100px" src="gmbr/<?= $row["gambar"]; ?>"></td>
                                    <td><a href="update.php?product_id=<?= $row["product_id"]; ?>" class="fas fa-edit"></a> <a href="delete.php?product_id=<?= $row["product_id"]; ?>" class="fas fa-trash" onclick="confirm('Are you Sure?');"></a></td>
                                </tr>
                            </tbody>
                            <?php $i++; ?>
                        <?php endforeach ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>




    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/script.js"></script>

</body>

</html>