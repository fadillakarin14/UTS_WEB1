<?php
require 'db.php';
require 'header.php';

// ambil semua info
$stmt = $mysqli->prepare("SELECT id, title, short_desc, created_at FROM infos ORDER BY created_at DESC");
$stmt->execute();
$result = $stmt->get_result();
?>
<h1 class="mb-3">Informasi Perusahaan</h1>

<div class="row">
  <?php while($row = $result->fetch_assoc()): ?>
  <div class="col-md-4">
    <div class="card mb-3 shadow-sm">
      <div class="card-body">
        <h5 class="card-title"><?=htmlspecialchars($row['title'])?></h5>
        <p class="card-text"><?=htmlspecialchars($row['short_desc'])?></p>
        <a href="detail.php?id=<?=$row['id']?>" class="btn btn-sm btn-primary">Baca Detail</a>
      </div>
      <div class="card-footer text-muted small"><?=date('d M Y', strtotime($row['created_at']))?></div>
    </div>
  </div>
  <?php endwhile; ?>
</div>

<?php
$stmt->close();
require 'footer.php';
?>
