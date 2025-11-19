<?php
require 'db.php';
require 'header.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>
<h2>Menu Utama</h2>
<p>Selamat datang, <?=htmlspecialchars($_SESSION['user_name'])?>!</p>

<div class="row">
  <div class="col-md-6">
    <div class="card mb-3">
      <div class="card-body">
        <h5 class="card-title">Profil</h5>
        <p class="card-text">Lihat dan edit profil (fitur dapat ditambah).</p>
        <!-- contoh link -->
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="card mb-3">
      <div class="card-body">
        <h5 class="card-title">Kelola Informasi</h5>
        <p class="card-text">Tambah/Edit/Hapus informasi (fitur admin jika dikembangkan).</p>
      </div>
    </div>
  </div>
</div>

<?php require 'footer.php'; ?>
