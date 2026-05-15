<?php
require_once __DIR__ . '/../config/db.php';

function require_admin(){
  if(empty($_SESSION['admin_id'])){
    header('Location: login.php'); exit;
  }
}

function admin_header($title='Admin — TEYZIX CORE'){
  $current = basename($_SERVER['PHP_SELF']);
  ?>
<!DOCTYPE html><html lang="en"><head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title><?= htmlspecialchars($title) ?></title>
<link rel="icon" type="image/png" href="../assets/images/logo.png">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link href="../assets/css/style.css" rel="stylesheet">
</head><body>
<div class="tech-bg"><div class="particles"></div></div>
<div class="admin-shell">
  <aside class="admin-sidebar">
    <div class="brand mb-4 d-flex align-items-center gap-2">
      <img src="../assets/images/logo.png" alt="TEYZIX CORE">
    </div>
    <nav>
      <a class="nav-item <?= $current==='dashboard.php'?'active':'' ?>" href="dashboard.php"><i class="bi bi-speedometer2"></i> Dashboard</a>
      <a class="nav-item <?= $current==='applications.php'?'active':'' ?>" href="applications.php"><i class="bi bi-file-earmark-person"></i> Applications</a>
      <a class="nav-item <?= $current==='messages.php'?'active':'' ?>" href="messages.php"><i class="bi bi-chat-dots"></i> Messages</a>
      <a class="nav-item" href="../index.php" target="_blank"><i class="bi bi-box-arrow-up-right"></i> View Site</a>
      <a class="nav-item" href="logout.php" style="color:#ff8aa0"><i class="bi bi-box-arrow-right"></i> Logout</a>
    </nav>
  </aside>
  <main class="admin-main">
  <?php
}

function admin_footer(){
  ?>
  </main>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/main.js"></script>
</body></html>
  <?php
}
