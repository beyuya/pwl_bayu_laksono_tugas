<?php
session_start();
include "koneksi.php";
if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') { header("Location: login.php"); exit; }

$total_buku=mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT COUNT(*) total FROM buku"))['total'];
$total_stok=mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT COALESCE(SUM(stok),0) total FROM buku"))['total'];
$stok_habis=mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT COUNT(*) total FROM buku WHERE stok=0"))['total'];
$recent=mysqli_query($koneksi,"SELECT * FROM buku ORDER BY id_buku DESC LIMIT 5");
?>
<!DOCTYPE html><html><head><title>Dashboard Admin</title><link rel="stylesheet" href="style.css"></head><body>
<div class="navbar"><div class="brand">📚 Perpustakaan Digital</div><div><a href="index.php">Beranda</a><a href="user_home.php">Koleksi</a><a href="logout.php">Logout</a></div></div>
<div class="dashboard">
<aside class="sidebar">
  <div class="side-brand">ADMIN PANEL</div>
  <a class="side-link active" href="admin_dashboard.php">🏠 Dashboard</a>
  <a class="side-link" href="buku/index.php">📚 Data Buku</a>
  <a class="side-link" href="buku/tambah.php">➕ Tambah Buku</a>
  <div class="side-brand">LAINNYA</div>
  <a class="side-link" href="user_home.php">🌐 Halaman Publik</a>
  <a class="side-link" href="logout.php">🚪 Logout</a>
</aside>
<main class="dash-main">
  <div class="page-title"><div><h1>Dashboard</h1><div class="page-subtitle">Ringkasan sistem perpustakaan hari ini.</div></div><a class="btn" href="buku/tambah.php">＋ Tambah Buku</a></div>
  <div class="card-grid">
    <div class="card stat-card purple"><div class="stat-icon">📚</div><div class="stat-label">TOTAL JUDUL</div><div class="stat-value"><?= $total_buku ?></div></div>
    <div class="card stat-card cyan"><div class="stat-icon">📦</div><div class="stat-label">TOTAL STOK</div><div class="stat-value"><?= $total_stok ?></div></div>
    <div class="card stat-card green"><div class="stat-icon">⚠️</div><div class="stat-label">STOK HABIS</div><div class="stat-value"><?= $stok_habis ?></div></div>
  </div>
  <div class="section">
    <div class="section-head"><h3>Buku Terbaru</h3><a class="btn btn-light" href="buku/index.php">Lihat Semua →</a></div>
    <table><tr><th>Judul</th><th>Pengarang</th><th>Tahun</th><th>Stok</th></tr>
    <?php while($b=mysqli_fetch_assoc($recent)): ?>
    <tr><td><b><?= htmlspecialchars($b['judul']) ?></b></td><td><?= htmlspecialchars($b['pengarang']) ?></td><td><?= $b['tahun_terbit'] ?></td><td><?php if($b['stok']>0): ?><span class="badge badge-green"><?= $b['stok'] ?> tersedia</span><?php else: ?><span class="badge badge-red">Habis</span><?php endif; ?></td></tr>
    <?php endwhile; ?></table>
  </div>
</main></div></body></html>
