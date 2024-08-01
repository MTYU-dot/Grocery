<?php
include '../config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM products WHERE product_id='$id'";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        header('Location: products.php?status=sukses-delete');
    } else {
        header('Location: products.php?status=error-delete');
    }
} else {
    die("Akses ditolak");
}