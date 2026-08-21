CARA MENJALANKAN

1. Pastikan XAMPP Apache dan MySQL sudah Running.
2. Copy folder "perpustakaan_modular" ke:
   C:\xampp\htdocs\
3. Buka phpMyAdmin:
   http://localhost/phpmyadmin
4. Import file db.sql.
5. Pastikan database "perpustakaan_0067" sudah terbentuk.
6. Buka:
   http://localhost/perpustakaan_modular/

LOGIN ADMIN:
Username: admin
Password: admin123

FITUR:
- Halaman utama
- Halaman daftar buku
- Login admin
- Dashboard admin
- Logout
- CRUD data buku

Struktur:
index.php              = halaman utama
login.php              = login admin
logout.php             = logout
admin_dashboard.php   = dashboard admin
user_home.php          = halaman daftar buku
koneksi.php            = koneksi database
db.sql                 = database
style.css              = CSS
buku/index.php         = Read
buku/tambah.php        = Create
buku/edit.php          = Update
buku/hapus.php         = Delete
