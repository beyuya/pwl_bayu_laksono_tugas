<?php
session_start();
include "../koneksi.php";

if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

if (isset($_POST['simpan'])) {
    $judul = trim($_POST['judul']);
    $pengarang = trim($_POST['pengarang']);
    $penerbit = trim($_POST['penerbit']);
    $tahun = (int) $_POST['tahun'];
    $stok = (int) $_POST['stok'];

    $stmt = mysqli_prepare($koneksi, "INSERT INTO buku (judul,pengarang,penerbit,tahun_terbit,stok) VALUES (?,?,?,?,?)");
    mysqli_stmt_bind_param($stmt, "sssii", $judul, $pengarang, $penerbit, $tahun, $stok);
    mysqli_stmt_execute($stmt);

    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Buku</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<div class="navbar">
    <b>Tambah Buku</b>
    <a href="index.php">Kembali</a>
</div>

<div class="container">
<form class="card" method="post"><div class="page-title"><div><h2>Tambah Buku</h2><div class="page-subtitle">Lengkapi informasi buku dengan benar.</div></div></div>
    <h2>Tambah Data Buku</h2>

    <label>Judul</label>
    <input type="text" name="judul" required>

    <label>Pengarang</label>
    <input type="text" name="pengarang" required>

    <label>Penerbit</label>
    <input type="text" name="penerbit" required>

    <label>Tahun Terbit</label>
    <input type="number" name="tahun" min="1900" max="2100" required>

    <label>Stok</label>
    <input type="number" name="stok" min="0" required>

    <button class="btn" type="submit" name="simpan">Simpan</button>
    <a class="btn btn-secondary" href="index.php">Batal</a>
</form>
</div>
</body>
</html>
