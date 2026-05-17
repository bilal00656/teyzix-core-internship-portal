<?php
if (!isset($conn)) {
  require_once __DIR__ . '/../config/db.php';
}
$page_title = $page_title ?? 'TEYZIX CORE Internship Portal';
$current = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= e($page_title) ?></title>
  <meta name="description" content="TEYZIX CORE Internship Portal — Apply to web, AI, cybersecurity, design, mobile and data science internships. Where technology meets vision.">
  <meta name="keywords" content="TEYZIX CORE, internship, portal, web development, AI internship, cybersecurity, data science">
  <link rel="icon" type="image/png" href="assets/images/logo.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>
  <div class="tech-bg">
    <div class="particles"></div>
  </div>

  <nav class="navbar navbar-expand-lg tx-navbar sticky-top">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center gap-3" href="index.php">
        <img src="assets/images/logo.png" alt="TEYZIX CORE">

        <div class="brand-text">
          <h4 class="mb-0">TEYZIX CORE</h4>
          <small>Where Technology Meets Vision</small>
        </div>
      </a>
      <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
        <i class="bi bi-list text-white fs-3"></i>
      </button>
      <div class="collapse navbar-collapse" id="navMain">
        <ul class="navbar-nav ms-auto align-items-lg-center">
          <li class="nav-item"><a class="nav-link <?= $current === 'index.php' ? 'active' : '' ?>" href="index.php">Home</a></li>
          <li class="nav-item"><a class="nav-link <?= $current === 'internships.php' ? 'active' : '' ?>" href="internships.php">Internships</a></li>
          <li class="nav-item"><a class="nav-link <?= $current === 'apply.php' ? 'active' : '' ?>" href="apply.php">Apply</a></li>
          <li class="nav-item"><a class="nav-link <?= $current === 'contact.php' ? 'active' : '' ?>" href="contact.php">Contact</a></li>
          <li class="nav-item ms-lg-2"><a class="btn btn-outline-glow" href="admin/login.php"><i class="bi bi-shield-lock me-1"></i> Admin</a></li>
        </ul>
      </div>
    </div>
  </nav>
