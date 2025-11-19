<?php
require 'db.php';
require 'header.php';

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $cpassword = $_POST['cpassword'] ?? '';

    if ($name === '' || $email === '' || $password === '') {
        $errors[] = "Semua field harus diisi.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email tidak valid.";
    }
    if ($password !== $cpassword) {
        $errors[] = "Password dan konfirmasi tidak cocok.";
    }
    if (empty($errors)) {
        // cek email unik
        $check = $mysqli->prepare("SELECT id FROM users WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $check->store_result();
        if ($check->num_rows > 0) {
            $errors[] = "Email sudah digunakan.";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $ins = $mysqli->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
            $ins->bind_param("sss", $name, $email, $hash);
            if ($ins->execute()) {
                echo "<div class='alert alert-success'>Registrasi berhasil. <a href='login.php'>Login sekarang</a></div>";
            } else {
                $errors[] = "Gagal menyimpan user.";
            }
            $ins->close();
        }
        $check->close();
    }
}
?>

<h2>Registrasi</h2>

<?php if(!empty($errors)): ?>
  <div class="alert alert-danger"><ul><?php foreach($errors as $e) echo "<li>".htmlspecialchars($e)."</li>"; ?></ul></div>
<?php endif; ?>

<form method="post" class="w-50">
  <div class="mb-3">
    <label class="form-label">Nama</label>
    <input name="name" class="form-control" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Email</label>
    <input name="email" type="email" class="form-control" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Password</label>
    <input name="password" type="password" class="form-control" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Konfirmasi Password</label>
    <input name="cpassword" type="password" class="form-control" required>
  </div>
  <button class="btn btn-primary" type="submit">Daftar</button>
</form>

<?php require 'footer.php'; ?>
