<?php
session_start(); include "../koneksi.php";
if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') { header("Location: ../login.php"); exit; }
$q=trim($_GET['q']??'');
if($q!==''){ $like="%".$q."%"; $stmt=mysqli_prepare($koneksi,"SELECT * FROM buku WHERE judul LIKE ? OR pengarang LIKE ? ORDER BY id_buku DESC"); mysqli_stmt_bind_param($stmt,"ss",$like,$like); mysqli_stmt_execute($stmt); $data=mysqli_stmt_get_result($stmt); }
else $data=mysqli_query($koneksi,"SELECT * FROM buku ORDER BY id_buku DESC");
?>
<!DOCTYPE html><html><head><title>Data Buku</title><link rel="stylesheet" href="../style.css"></head><body>
<div class="navbar"><div class="brand">📚 Admin · Data Buku</div><div><a href="../admin_dashboard.php">Dashboard</a><a href="../index.php">Beranda</a><a href="../logout.php">Logout</a></div></div>
<div class="container">
<div class="page-title"><div><h1>Data Buku</h1><div class="page-subtitle">Kelola seluruh koleksi buku perpustakaan.</div></div><a class="btn" href="tambah.php">＋ Tambah Buku</a></div>
<form class="search-box" method="get"><input name="q" value="<?= htmlspecialchars($q) ?>" placeholder="🔎 Cari buku..."><button class="btn" type="submit">Cari</button></form>
<table><tr><th>ID</th><th>Judul</th><th>Pengarang</th><th>Penerbit</th><th>Tahun</th><th>Stok</th><th>Aksi</th></tr>
<?php while($b=mysqli_fetch_assoc($data)): ?><tr>
<td><?= $b['id_buku'] ?></td><td><b><?= htmlspecialchars($b['judul']) ?></b></td><td><?= htmlspecialchars($b['pengarang']) ?></td><td><?= htmlspecialchars($b['penerbit']) ?></td><td><?= $b['tahun_terbit'] ?></td>
<td><?php if($b['stok']>0): ?><span class="badge badge-green"><?= $b['stok'] ?> tersedia</span><?php else: ?><span class="badge badge-red">Habis</span><?php endif; ?></td>
<td class="action-row"><a class="btn btn-light" href="edit.php?id=<?= $b['id_buku'] ?>">Edit</a><a class="btn btn-danger" href="hapus.php?id=<?= $b['id_buku'] ?>" onclick="return confirm('Hapus data ini?')">Hapus</a></td>
</tr><?php endwhile; ?></table>
</div></body></html>
