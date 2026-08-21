<?php
session_start();
include "../koneksi.php";

if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

$id = (int) ($_GET['id'] ?? 0);

$stmt = mysqli_prepare($koneksi, "DELETE FROM buku WHERE id_buku = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

header("Location: index.php");
exit;
?>
