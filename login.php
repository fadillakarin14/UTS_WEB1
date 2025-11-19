<?php
require 'db.php';
require 'header.php';

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // server-side validation
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    if ($email === '' || $password === '') {
        $errors[] = "Email dan password wajib diisi.";
    } else {
        $stmt = $mysqli->prepare("SELECT id, password, name FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $res = $stmt->get_result();
        if ($res->num_rows === 1) {
            $u = $res->fetch_assoc();
            if (password_verify($password, $u['password'])) {
                // success -> set session and redirect
                $_SESSION['user_id'] = $u['id'];
                $_SESSION['user_name'] = $u['name'];
                header("Location: dashboard.php");
                exit;
            } else {
                $errors[] = "Kombinasi email/password salah.";
            }
        } else {
            $errors[] = "Kombinasi email/password salah.";
        }
        $stmt->close();
    }
}
?>

<h2>Login</h2>

<?php if(!empty($errors)): ?>
  <div class="alert alert-danger"><ul><?php foreach($errors as $e) echo "<li>".htmlspecialchars($e)."</li>"; ?></ul></div>
<?php endif; ?>

<form id="loginForm" method="post" class="w-50" onsubmit="return validateLoginForm();">
  <div class="mb-3">
    <label class="form-label">Email</label>
    <input id="email" name="email" type="email" class="form-control" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Password</label>
    <input id="password" name="password" type="password" class="form-control" required>
  </div>

  <button class="btn btn-primary" type="submit">Login</button>
</form>

<?php require 'footer.php'; ?>
