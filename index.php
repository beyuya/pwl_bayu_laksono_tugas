<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Perpustakaan Digital</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="navbar">
    <b>📚 Perpustakaan Digital</b>
    <div>
        <a href="index.php">Beranda</a>
        <a href="user_home.php">Koleksi Buku</a>
        <?php if (isset($_SESSION['login'])): ?>
            <a href="admin_dashboard.php">Dashboard</a>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="login.php">Login Admin</a>
        <?php endif; ?>
    </div>
</div>

<div class="container">
    <div class="hero">
        <h1>Kelola Perpustakaan dengan Lebih Mudah.</h1>
        <p>
            Sistem informasi perpustakaan sederhana untuk melihat koleksi
            dan mengelola data buku secara cepat, rapi, dan terstruktur.
        </p>
        <a class="btn" href="user_home.php">Jelajahi Koleksi →</a>
    </div>

    <div class="card-grid">
        <div class="card">
            <h3>📖 Koleksi Buku</h3>
            <p>Melihat daftar judul, pengarang, penerbit, tahun terbit, dan stok buku.</p>
        </div>
        <div class="card">
            <h3>⚡ Dashboard Admin</h3>
            <p>Admin dapat mengelola data perpustakaan dari satu dashboard.</p>
        </div>
        <div class="card">
            <h3>🔐 Akses Terproteksi</h3>
            <p>Halaman pengelolaan buku hanya dapat diakses setelah login sebagai admin.</p>
        </div>
    </div>
</div>

<div class="footer">Pemrograman Web Lanjut · 202343500067 · Bayu Laksono</div>
</body>
</html>
