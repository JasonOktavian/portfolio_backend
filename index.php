<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
require_once("conn.php");
require_once("functions.php");
require_once("navbar.php");

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
<div id="ajaxcon">
    <table class="mx-auto tabels" border="1" cellpadding="10" cellspacing="0">
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
                    <td>
                        <a href="update.php?product_id=<?= $row["product_id"]; ?>"><i class="fas fa-edit"></i></a>
                        <a href="delete.php?product_id=<?= $row["product_id"]; ?>"><i class="fas fa-trash" onclick="confirm('Are you Sure?');"></i></a>
                    </td>
                </tr>
            </tbody>
            <?php $i++; ?>
        <?php endforeach ?>
    </table>
</div>





<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="text/javascript" src="js/script.js"></script>

</body>

</html>