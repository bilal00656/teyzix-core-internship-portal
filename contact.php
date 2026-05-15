<?php
require_once __DIR__ . '/config/db.php';
$page_title = 'Contact — TEYZIX CORE';
$errors=[]; $success=false;
$old = ['name'=>'','email'=>'','subject'=>'','message'=>''];
if ($_SERVER['REQUEST_METHOD']==='POST') {
  foreach($old as $k=>$_) $old[$k]=trim($_POST[$k]??'');
  if($old['name']==='') $errors[]='Name is required.';
  if(!filter_var($old['email'],FILTER_VALIDATE_EMAIL)) $errors[]='Valid email is required.';
  if($old['subject']==='') $errors[]='Subject is required.';
  if(strlen($old['message'])<5) $errors[]='Message is too short.';
  if(!$errors){
    $stmt=$conn->prepare('INSERT INTO contact_messages (name,email,subject,message) VALUES (?,?,?,?)');
    $stmt->bind_param('ssss',$old['name'],$old['email'],$old['subject'],$old['message']);
    if($stmt->execute()){ $success=true; $old=array_fill_keys(array_keys($old),''); }
    else $errors[]='Database error: '.$stmt->error;
    $stmt->close();
  }
}
include __DIR__ . '/includes/header.php';
?>
<section class="hero" style="padding:5rem 0 2rem">
  <div class="container text-center reveal">
    <span class="eyebrow">Contact</span>
    <h1>Let's <span class="grad">talk</span></h1>
    <p class="lead mx-auto mt-3">Questions about programs, partnerships, or hiring our interns? We respond within 24 hours.</p>
  </div>
</section>

<section style="padding-top:1rem">
  <div class="container">
    <div class="row g-4">
      <div class="col-lg-5">
        <div class="glass intern-card mb-3">
          <span class="icon-box"><i class="bi bi-whatsapp"></i></span>
          <h5 class="mt-2">WhatsApp</h5>
          <p class="mb-0"><a href="https://wa.me/923714699788" target="_blank">+92 371 4699788</a></p>
        </div>
        <div class="glass intern-card mb-3">
          <span class="icon-box"><i class="bi bi-envelope"></i></span>
          <h5 class="mt-2">Email</h5>
          <p class="mb-0"><a href="mailto:contact@teyzixcore.com">contact@teyzixcore.com</a></p>
        </div>
        <div class="glass intern-card mb-3">
          <span class="icon-box"><i class="bi bi-share"></i></span>
          <h5 class="mt-2">Follow Us</h5>
          <div class="social mt-2">
            <a href="https://www.linkedin.com/company/teyzixcore/" target="_blank"><i class="bi bi-linkedin"></i></a>
            <a href="https://www.instagram.com/teyzixcore" target="_blank"><i class="bi bi-instagram"></i></a>
            <a href="https://www.facebook.com/share/1D68YsTEqK/" target="_blank"><i class="bi bi-facebook"></i></a>
            <a href="https://tiktok.com/@teyzixcore" target="_blank"><i class="bi bi-tiktok"></i></a>
            <a href="https://www.threads.com/@teyzixcore" target="_blank"><i class="bi bi-threads"></i></a>
          </div>
        </div>
        <div class="glass intern-card">
          <h5><i class="bi bi-geo-alt me-2"></i>Find Us</h5>
          <div class="ratio ratio-16x9 mt-2" style="border-radius:12px;overflow:hidden;border:1px solid var(--border)">
            <iframe src="https://www.google.com/maps?q=Karachi,Pakistan&output=embed" loading="lazy" referrerpolicy="no-referrer-when-downgrade" style="border:0"></iframe>
          </div>
        </div>
      </div>

      <div class="col-lg-7">
        <?php if($success): ?>
          <div class="alert alert-glow"><i class="bi bi-check-circle-fill me-2"></i> Message sent. We'll get back to you shortly.</div>
        <?php endif; ?>
        <?php if($errors): ?>
          <div class="alert alert-error"><ul class="mb-0"><?php foreach($errors as $e): ?><li><?= e($e) ?></li><?php endforeach; ?></ul></div>
        <?php endif; ?>
        <form method="POST" class="glass form-card" data-loading>
          <div class="row g-3">
            <div class="col-md-6"><label class="form-label">Name</label><input class="form-control" name="name" value="<?= e($old['name']) ?>" required></div>
            <div class="col-md-6"><label class="form-label">Email</label><input type="email" class="form-control" name="email" value="<?= e($old['email']) ?>" required></div>
            <div class="col-12"><label class="form-label">Subject</label><input class="form-control" name="subject" value="<?= e($old['subject']) ?>" required></div>
            <div class="col-12"><label class="form-label">Message</label><textarea class="form-control" name="message" rows="6" required><?= e($old['message']) ?></textarea></div>
            <div class="col-12 d-flex justify-content-end"><button class="btn btn-glow" type="submit"><i class="bi bi-send me-1"></i> Send Message</button></div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
