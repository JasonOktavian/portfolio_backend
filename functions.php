<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require_once("conn.php");

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_array($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function cari($keyword)
{
    global $conn;
    $query = "SELECT * FROM product WHERE 
                nama LIKE '%$keyword%'OR
                produksi LIKE '%$keyword%' OR
                harga LIKE '%$keyword%'
    ";
    return query(($query));
}

function tambah($data)
{
    global $conn;
    $nama = htmlspecialchars($data["name"]);
    $produk = htmlspecialchars($data["production"]);
    $harga = htmlspecialchars($data["price"]);

    // upload gambar
    $gambar = upload();
    if (!$gambar) {
        return false;
    }

    $sql = "INSERT INTO product
            VALUES ('', '$nama','$produk', '$harga', '$gambar')";

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
}

function update($data)
{
    global $conn;

    $id = $data["id"];
    $nama = htmlspecialchars($data["name"]);
    $produk = htmlspecialchars($data["production"]);
    $harga = htmlspecialchars($data["price"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    //cek apakah user memilih gambar baru atau tidak
    if ($_FILES['img']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
        if (!$gambar) {
            return false;
        }
    }

    $sql = "UPDATE product SET
            nama = '$nama',
            produksi = '$produk',
            harga = '$harga',
            gambar = '$gambar'
            WHERE product_id = $id";
    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
}

function upload()
{
    global $conn;
    $namaFile = $_FILES['img']['name'];
    $ukuranFile = $_FILES['img']['size'];
    $error = $_FILES['img']['error'];
    $tmpName = $_FILES['img']['tmp_name'];

    //cek apakah gambar di upload
    if ($error === 4) {
        echo "<script>
        alert('Pilih gambar');
        </script>";
        return false;
    }

    //cek extension
    $validExtnd = ['jpg', 'jpeg', 'png'];
    $extndGambar = explode('.', $namaFile);
    $extndGambar = strtolower(end($extndGambar));
    if (!in_array($extndGambar, $validExtnd)) {
        echo "<script>
        alert('Not a picture format');
        </script>";
        return false;
    }

    //cek ukuran file
    if ($ukuranFile > 3000000) {
        echo "<script>
        alert('Size is to big must be below 3mb');
        </script>";
        return false;
    }

    //lolos pengecekan gambar siap di upload
    //generate new name
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $extndGambar;

    move_uploaded_file($tmpName, 'gmbr/' . $namaFileBaru);
    return $namaFileBaru;
}


function hapus($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM product WHERE product_id = $id");
    return mysqli_affected_rows($conn);
}

function registrasi($data)
{
    global $conn;
    $username = strtolower(stripslashes($data["username"]));
    $email = strtolower(stripslashes($data["email"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    // cek username
    $result = mysqli_query($conn, " SELECT username FROM user WHERE username='$username'");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>
                alert ('username has already been used!')
            </script>";
        return false;
    }

    // cek username
    $result = mysqli_query($conn, " SELECT email FROM user WHERE email='$email'");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>
                alert ('email has already been used!')
            </script>";
        return false;
    }

    if ($password !== $password2) {
        echo "<script> 
        alert ('Wrong Password!!!');
        </script>";
        return false;
    }

    // Password encrypt
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Tambah ke DB
    mysqli_query($conn, "INSERT INTO user VALUES('', '$username','$email', '$password')");
    return mysqli_affected_rows($conn);
}
