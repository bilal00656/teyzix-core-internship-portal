<?php
require_once __DIR__ . '/../config/db.php';
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $u = trim($_POST['username'] ?? '');
  $p = $_POST['password'] ?? '';
  $stmt = $conn->prepare('SELECT id,password FROM admin_users WHERE username=? LIMIT 1');
  $stmt->bind_param('s', $u);
  $stmt->execute();
  $res = $stmt->get_result()->fetch_assoc();
  $stmt->close();
  if ($res) {
    $ok = ($res['password'] === $p) || (function_exists('password_verify') && @password_verify($p, $res['password']));
    if ($ok) {
      $_SESSION['admin_id'] = $res['id'];
      $_SESSION['admin_user'] = $u;
      header('Location: dashboard.php');
      exit;
    }
  }
  $error = 'Invalid username or password.';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Admin Login — TEYZIX CORE</title>
  <link rel="icon" type="image/png" href="../assets/images/logo.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="../assets/css/style.css" rel="stylesheet">
</head>

<body>
  <div class="tech-bg">
    <div class="particles"></div>
  </div>
  <div class="login-wrap">
    <div class="glass login-card">
      <div class="brand"><img src="../assets/images/logo.png" alt="TEYZIX CORE"></div>
      <h4 class="text-center mb-1">Admin Portal</h4>
      <p class="text-center mb-4" style="color:var(--muted)">Sign in to manage applications</p>
      <?php if ($error): ?><div class="alert alert-error"><?= e($error) ?></div><?php endif; ?>
      <form method="POST">
        <div class="mb-3"><label class="form-label">Username</label><input class="form-control" name="username" required autofocus></div>
        <div class="mb-3"><label class="form-label">Password</label><input type="password" class="form-control" name="password" required></div>
        <button class="btn btn-glow w-100" type="submit"><i class="bi bi-box-arrow-in-right me-1"></i> Sign in</button>
      </form>
      <p class="text-center mt-2"><a href="../index.php" style="color:var(--muted)"><i class="bi bi-arrow-left me-1"></i> Back to site</a></p>
    </div>
  </div>
</body>

</html>
