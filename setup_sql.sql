-- sql_setup.sql
CREATE DATABASE IF NOT EXISTS company_portal DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE company_portal;

-- tabel users
CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(150) NOT NULL,
  email VARCHAR(150) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- tabel informasi/perusahaan
CREATE TABLE IF NOT EXISTS infos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(200) NOT NULL,
  short_desc VARCHAR(255),
  content TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- contoh data
INSERT INTO infos (title, short_desc, content) VALUES
('Sejarah Perusahaan', 'Ringkasan sejarah', 'wonwoo suka main game'),
('Visi & Misi', 'Visi dan misi perusahaan', 'Isi lengkap visi dan misi...'),
('Produk Unggulan', 'Deskripsi produk', 'Isi lengkap produk unggulan...');
