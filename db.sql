CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin','user') NOT NULL DEFAULT 'user'
);

CREATE TABLE IF NOT EXISTS buku (
    id_buku INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(100) NOT NULL,
    pengarang VARCHAR(100) NOT NULL,
    penerbit VARCHAR(100) NOT NULL,
    tahun_terbit YEAR NOT NULL,
    stok INT NOT NULL DEFAULT 0
);

INSERT INTO users (username, password, role)
VALUES ('admin', 'admin123', 'admin')
ON DUPLICATE KEY UPDATE username = username;

INSERT INTO buku (judul, pengarang, penerbit, tahun_terbit, stok) VALUES
('Pemrograman Web Lanjut', 'Bayu Laksono', 'Unindra Press', 2026, 10),
('Dasar-Dasar PHP', 'Andi Setiawan', 'Informatika', 2025, 5),
('Basis Data MySQL', 'Budi Santoso', 'Elex Media', 2024, 8);
