<?php
require_once '../conn.php';

$keyword = $_GET["keyword"];
$barang = query(
    "SELECT * FROM product WHERE 
    nama LIKE '%$keyword%'OR
    produksi LIKE '%$keyword%' OR
    harga LIKE '%$keyword%'"
);

?>

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