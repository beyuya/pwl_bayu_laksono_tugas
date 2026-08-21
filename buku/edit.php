<?php
session_start();
include "../koneksi.php";

if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

$id = (int) ($_GET['id'] ?? 0);

$stmt = mysqli_prepare($koneksi, "SELECT * FROM buku WHERE id_buku = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$buku = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

if (!$buku) {
    die("Data buku tidak ditemukan.");
}

if (isset($_POST['update'])) {
    $judul = trim($_POST['judul']);
    $pengarang = trim($_POST['pengarang']);
    $penerbit = trim($_POST['penerbit']);
    $tahun = (int) $_POST['tahun'];
    $stok = (int) $_POST['stok'];

    $stmt = mysqli_prepare($koneksi, "UPDATE buku SET judul=?, pengarang=?, penerbit=?, tahun_terbit=?, stok=? WHERE id_buku=?");
    mysqli_stmt_bind_param($stmt, "sssiii", $judul, $pengarang, $penerbit, $tahun, $stok, $id);
    mysqli_stmt_execute($stmt);

    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Buku</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<div class="navbar">
    <b>Edit Buku</b>
    <a href="index.php">Kembali</a>
</div>

<div class="container">
<form class="card" method="post"><div class="page-title"><div><h2>Edit Buku</h2><div class="page-subtitle">Lengkapi informasi buku dengan benar.</div></div></div>
    <h2>Edit Data Buku</h2>

    <label>Judul</label>
    <input type="text" name="judul" value="<?= htmlspecialchars($buku['judul']); ?>" required>

    <label>Pengarang</label>
    <input type="text" name="pengarang" value="<?= htmlspecialchars($buku['pengarang']); ?>" required>

    <label>Penerbit</label>
    <input type="text" name="penerbit" value="<?= htmlspecialchars($buku['penerbit']); ?>" required>

    <label>Tahun Terbit</label>
    <input type="number" name="tahun" value="<?= $buku['tahun_terbit']; ?>" required>

    <label>Stok</label>
    <input type="number" name="stok" min="0" value="<?= $buku['stok']; ?>" required>

    <button class="btn" type="submit" name="update">Update</button>
    <a class="btn btn-secondary" href="index.php">Batal</a>
</form>
</div>
</body>
</html>
