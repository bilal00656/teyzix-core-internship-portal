<?php
require_once __DIR__ . '/config/db.php';
$page_title = 'Internships — TEYZIX CORE';
include __DIR__ . '/includes/header.php';

$internships = [
  ['title'=>'Web Development','icon'=>'bi-code-slash','duration'=>'10 Weeks','level'=>'Beginner – Advanced','desc'=>'Build full-stack apps with HTML, CSS, JS, PHP, MySQL, and modern frameworks.'],
  ['title'=>'AI &amp; Machine Learning','icon'=>'bi-cpu','duration'=>'12 Weeks','level'=>'Intermediate','desc'=>'Train models with Python, TensorFlow, and PyTorch on real-world datasets.'],
  ['title'=>'Cybersecurity','icon'=>'bi-shield-lock','duration'=>'10 Weeks','level'=>'Intermediate','desc'=>'Offensive and defensive security: pentesting, OWASP, network forensics.'],
  ['title'=>'Graphic Design','icon'=>'bi-palette','duration'=>'8 Weeks','level'=>'Beginner','desc'=>'Master Figma, branding, and visual systems for SaaS products.'],
  ['title'=>'Mobile App Development','icon'=>'bi-phone','duration'=>'10 Weeks','level'=>'Intermediate','desc'=>'Ship cross-platform apps with Flutter and React Native to production.'],
  ['title'=>'Data Science','icon'=>'bi-bar-chart','duration'=>'12 Weeks','level'=>'Intermediate','desc'=>'Pandas, SQL, visualization, and statistical modeling for business impact.'],
];
?>
<section class="hero" style="padding:5rem 0 2rem">
  <div class="container text-center reveal">
    <span class="eyebrow">Programs</span>
    <h1>Choose your <span class="grad">domain</span></h1>
    <p class="lead mx-auto mt-3">Six immersive tracks designed to take you from curious to confident, with mentorship and a real shipping cadence.</p>
  </div>
</section>

<section style="padding-top:2rem">
  <div class="container">
    <div class="row g-4">
      <?php foreach($internships as $it): ?>
      <div class="col-md-6 col-lg-4 reveal">
        <div class="glass intern-card h-100 d-flex flex-column">
          <div class="d-flex justify-content-between align-items-start mb-2">
            <span class="icon-box"><i class="bi <?= e($it['icon']) ?>"></i></span>
            <span class="badge-soft"><?= $it['duration'] ?></span>
          </div>
          <h5><?= $it['title'] ?></h5>
          <small style="color:var(--accent)"><i class="bi bi-bar-chart-line me-1"></i><?= e($it['level']) ?></small>
          <p class="mt-2"><?= $it['desc'] ?></p>
          <a href="apply.php?domain=<?= urlencode(strip_tags($it['title'])) ?>" class="btn btn-glow mt-auto align-self-start"><i class="bi bi-send me-1"></i> Apply Now</a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
