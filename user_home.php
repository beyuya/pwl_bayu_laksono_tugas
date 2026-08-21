<?php
include "koneksi.php";
$q=trim($_GET['q']??'');
if($q!==''){
  $like="%".$q."%";
  $stmt=mysqli_prepare($koneksi,"SELECT * FROM buku WHERE judul LIKE ? OR pengarang LIKE ? ORDER BY id_buku DESC");
  mysqli_stmt_bind_param($stmt,"ss",$like,$like); mysqli_stmt_execute($stmt); $data=mysqli_stmt_get_result($stmt);
}else{
  $data=mysqli_query($koneksi,"SELECT * FROM buku ORDER BY id_buku DESC");
}
?>
<!DOCTYPE html><html><head><title>Koleksi Buku</title><link rel="stylesheet" href="style.css"></head><body>
<div class="navbar"><div class="brand">📚 Perpustakaan Digital</div><div><a href="index.php">Beranda</a><a href="user_home.php">Koleksi Buku</a><a href="login.php">Login Admin</a></div></div>
<div class="container">
<div class="page-title"><div><h1>Koleksi Buku</h1><div class="page-subtitle">Temukan buku berdasarkan judul atau pengarang.</div></div></div>
<form class="search-box" method="get"><input name="q" value="<?= htmlspecialchars($q) ?>" placeholder="🔎 Cari judul atau pengarang..."><button class="btn" type="submit">Cari</button></form>
<table><tr><th>No</th><th>Judul</th><th>Pengarang</th><th>Penerbit</th><th>Tahun</th><th>Status</th></tr>
<?php $no=1; while($b=mysqli_fetch_assoc($data)): ?><tr>
<td><?= $no++ ?></td><td><b><?= htmlspecialchars($b['judul']) ?></b></td><td><?= htmlspecialchars($b['pengarang']) ?></td><td><?= htmlspecialchars($b['penerbit']) ?></td><td><?= $b['tahun_terbit'] ?></td>
<td><?php if($b['stok']>0): ?><span class="badge badge-green">Tersedia (<?= $b['stok'] ?>)</span><?php else: ?><span class="badge badge-red">Habis</span><?php endif; ?></td>
</tr><?php endwhile; ?></table>
</div><div class="footer">Pemrograman Web Lanjut · UNINDRA</div></body></html>
