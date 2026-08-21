<?php
session_start();
include "koneksi.php";

$error = "";

if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = mysqli_prepare($koneksi, "SELECT id, username, password, role FROM users WHERE username = ?");
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    if ($user && $password === $user['password'] && $user['role'] === 'admin') {
        $_SESSION['login'] = true;
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        header("Location: admin_dashboard.php");
        exit;
    } else {
        $error = "Username atau password salah.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Admin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="navbar">
    <b>📚 Perpustakaan Digital</b>
    <a href="index.php">← Kembali ke Beranda</a>
</div>

<div class="container">
    <form class="card" method="post">
        <h2>Selamat Datang 👋</h2>
        <p class="page-subtitle">Masuk ke dashboard administrator.</p>

        <?php if ($error): ?>
            <div class="alert"><?= htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <label>Username</label>
        <input type="text" name="username" placeholder="Masukkan username" required>

        <label>Password</label>
        <input type="password" name="password" placeholder="Masukkan password" required>

        <button class="btn" type="submit" name="login">Masuk ke Dashboard →</button>
    </form>
</div>
</body>
</html>
