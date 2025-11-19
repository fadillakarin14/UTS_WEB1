<?php
require 'db.php';
require 'header.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    echo "<div class='alert alert-danger'>Informasi tidak ditemukan.</div>";
    require 'footer.php';
    exit;
}

$stmt = $mysqli->prepare("SELECT title, content, created_at FROM infos WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();
if ($res->num_rows === 0) {
    echo "<div class='alert alert-danger'>Informasi tidak ditemukan.</div>";
    $stmt->close();
    require 'footer.php';
    exit;
}
$data = $res->fetch_assoc();
?>
<h1><?=htmlspecialchars($data['title'])?></h1>
<p class="text-muted small"><?=date('d M Y', strtotime($data['created_at']))?></p>
<div class="mt-3">
  <?=nl2br(htmlspecialchars($data['content']))?>
</div>
<a class="btn btn-secondary mt-3" href="index.php">Kembali</a>

<?php
$stmt->close();
require 'footer.php';
?>
