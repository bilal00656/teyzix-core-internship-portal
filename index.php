<?php
require_once __DIR__ . '/config/db.php';
$page_title = 'TEYZIX CORE Internship Portal — Core of Innovation';
include __DIR__ . '/includes/header.php';

$stats = [
  ['num'=>'500+','label'=>'Applications Received'],
  ['num'=>'6','label'=>'Internship Domains'],
  ['num'=>'120+','label'=>'Interns Onboarded'],
  ['num'=>'25+','label'=>'Mentors & Engineers'],
];
$features = [
  ['icon'=>'bi-rocket-takeoff','title'=>'Real Industry Projects','text'=>'Work on production-grade products and ship features that real users rely on.'],
  ['icon'=>'bi-people','title'=>'Mentorship That Matters','text'=>'1:1 guidance from senior engineers, designers, and ML practitioners.'],
  ['icon'=>'bi-award','title'=>'Verified Certificate','text'=>'Earn a recognized completion certificate and a strong recommendation letter.'],
  ['icon'=>'bi-globe2','title'=>'Remote Friendly','text'=>'Fully remote and hybrid options across all programs and time zones.'],
  ['icon'=>'bi-lightning-charge','title'=>'Hands-On Curriculum','text'=>'Build, break, and ship — every week is a sprint with measurable outcomes.'],
  ['icon'=>'bi-shield-check','title'=>'Career Support','text'=>'Resume reviews, mock interviews, and direct hiring referrals.'],
];
$techs = ['React','Next.js','Python','TensorFlow','PyTorch','Node.js','PHP','Laravel','MySQL','PostgreSQL','Docker','AWS','Figma','Flutter'];
$testimonials = [
  ['name'=>'Sara Khan','role'=>'AI Intern, FAST NUCES','text'=>'TEYZIX CORE handed me a real ML pipeline on day one. The mentorship was unreal.'],
  ['name'=>'Ali Raza','role'=>'Web Intern, NED','text'=>'I shipped 3 features in 6 weeks. My GitHub finally looks like an engineer\'s.'],
  ['name'=>'Hamza Iqbal','role'=>'Cybersec Intern, COMSATS','text'=>'Learned offensive + defensive security on a live infrastructure. 10/10.'],
];
$faqs = [
  ['q'=>'Is the internship paid?','a'=>'Selected interns receive a stipend on milestone completion. All programs include certification.'],
  ['q'=>'Can I apply if I am a beginner?','a'=>'Yes — we accept beginners for our Foundation track. Show passion and a willingness to ship.'],
  ['q'=>'How long is the program?','a'=>'Most domains run for 8–12 weeks with a flexible 15–20 hour weekly commitment.'],
  ['q'=>'Is it remote?','a'=>'Yes, fully remote with optional on-site sessions in Karachi, Lahore and Islamabad.'],
];
?>

<section class="hero">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-6 reveal">
        <span class="eyebrow"><i class="bi bi-stars me-1"></i> Core of Innovation</span>
        <h1>Launch your tech career with <span class="grad">TEYZIX CORE</span></h1>
        <p class="lead mt-3">A futuristic internship program where students build real products, learn from industry mentors, and graduate with a portfolio that hires itself.</p>
        <div class="d-flex flex-wrap gap-3 mt-4">
          <a href="apply.php" class="btn btn-glow"><i class="bi bi-send-fill me-1"></i> Apply Now</a>
          <a href="internships.php" class="btn btn-outline-glow">Explore Internships <i class="bi bi-arrow-right ms-1"></i></a>
        </div>
        <div class="d-flex align-items-center gap-3 mt-4 text-muted" style="color:var(--muted)">
          <i class="bi bi-shield-check text-success"></i>
          <small>Trusted by 500+ students across Pakistan</small>
        </div>
      </div>
      <div class="col-lg-6 reveal">
        <div class="banner-frame"><div><img src="assets/images/banner.png" alt="TEYZIX CORE — Core of Innovation"></div></div>
      </div>
    </div>
  </div>
</section>

<section>
  <div class="container">
    <div class="row g-3">
      <?php foreach($stats as $s): ?>
      <div class="col-6 col-lg-3 reveal">
        <div class="glass stat">
          <div class="num"><?= e($s['num']) ?></div>
          <div class="label"><?= e($s['label']) ?></div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section id="features">
  <div class="container">
    <div class="text-center reveal">
      <span class="eyebrow">Why Join Us</span>
      <h2 class="section-title">Built for ambitious builders</h2>
      <p class="section-sub">Everything you need to go from student to shipping engineer — mentorship, structure, and real-world stakes.</p>
    </div>
    <div class="row g-4">
      <?php foreach($features as $f): ?>
      <div class="col-md-6 col-lg-4 reveal">
        <div class="glass intern-card h-100">
          <span class="icon-box"><i class="bi <?= e($f['icon']) ?>"></i></span>
          <h5><?= e($f['title']) ?></h5>
          <p class="mb-0"><?= e($f['text']) ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section>
  <div class="container">
    <div class="text-center reveal">
      <span class="eyebrow">Tech Stack</span>
      <h2 class="section-title">Tools you'll master</h2>
      <p class="section-sub">Modern, in-demand technologies used by top product teams worldwide.</p>
    </div>
    <div class="d-flex flex-wrap justify-content-center gap-2 reveal">
      <?php foreach($techs as $t): ?>
        <span class="badge-soft" style="background:rgba(25,240,168,.08);color:var(--accent);border:1px solid var(--border);padding:.55rem 1rem;border-radius:999px;font-weight:600"><?= e($t) ?></span>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section>
  <div class="container">
    <div class="text-center reveal">
      <span class="eyebrow">Testimonials</span>
      <h2 class="section-title">Loved by interns</h2>
      <p class="section-sub">Real feedback from students who built real things.</p>
    </div>
    <div class="row g-4">
      <?php foreach($testimonials as $t): ?>
      <div class="col-md-4 reveal">
        <div class="glass intern-card h-100">
          <div class="text-warning mb-2">★★★★★</div>
          <p>"<?= e($t['text']) ?>"</p>
          <div class="d-flex align-items-center gap-2 mt-3">
            <div class="icon-box" style="width:42px;height:42px;font-size:1rem"><?= e(strtoupper($t['name'][0])) ?></div>
            <div>
              <div class="fw-bold"><?= e($t['name']) ?></div>
              <small style="color:var(--muted)"><?= e($t['role']) ?></small>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section>
  <div class="container">
    <div class="text-center reveal">
      <span class="eyebrow">FAQ</span>
      <h2 class="section-title">Frequently asked</h2>
    </div>
    <div class="accordion mx-auto reveal" id="faq" style="max-width:820px">
      <?php foreach($faqs as $i=>$f): ?>
      <div class="accordion-item glass mb-2" style="border-radius:16px;overflow:hidden">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed" style="background:transparent;color:var(--text);box-shadow:none" type="button" data-bs-toggle="collapse" data-bs-target="#faq<?= $i ?>"><?= e($f['q']) ?></button>
        </h2>
        <div id="faq<?= $i ?>" class="accordion-collapse collapse" data-bs-parent="#faq">
          <div class="accordion-body" style="color:var(--muted)"><?= e($f['a']) ?></div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section>
  <div class="container">
    <div class="glass p-5 text-center reveal" style="background:linear-gradient(135deg,rgba(0,184,107,.15),rgba(0,229,209,.1))">
      <h2 class="section-title mb-3">Ready to build the future?</h2>
      <p style="color:var(--muted);max-width:600px;margin:0 auto 1.5rem">Applications take less than 5 minutes. Cohorts open monthly across all six domains.</p>
      <a href="apply.php" class="btn btn-glow"><i class="bi bi-rocket-takeoff me-1"></i> Start your application</a>
    </div>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
