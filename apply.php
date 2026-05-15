<?php
require_once __DIR__ . '/config/db.php';
$page_title = 'Apply — TEYZIX CORE Internship';

$errors = [];
$success = false;
$old = ['full_name'=>'','email'=>'','phone'=>'','city'=>'','university'=>'','semester'=>'','domain'=>$_GET['domain']??'','skills'=>'','cover_letter'=>''];

if ($_SERVER['REQUEST_METHOD']==='POST') {
  foreach($old as $k=>$_) $old[$k] = trim($_POST[$k] ?? '');

  if($old['full_name']==='') $errors[]='Full name is required.';
  if($old['email']==='' || !filter_var($old['email'],FILTER_VALIDATE_EMAIL)) $errors[]='Valid email is required.';
  if($old['phone']==='') $errors[]='Phone number is required.';
  if($old['city']==='') $errors[]='City is required.';
  if($old['university']==='') $errors[]='University is required.';
  if($old['semester']==='') $errors[]='Semester is required.';
  if($old['domain']==='') $errors[]='Please select a domain.';
  if(strlen($old['skills'])<3) $errors[]='Please list your skills.';
  if(strlen($old['cover_letter'])<10) $errors[]='Cover letter is too short.';

  $cv_filename = null;
  if(isset($_FILES['cv_file']) && $_FILES['cv_file']['error']!==UPLOAD_ERR_NO_FILE){
    if($_FILES['cv_file']['error']!==UPLOAD_ERR_OK){ $errors[]='CV upload failed.'; }
    else {
      $allowed = ['pdf','doc','docx'];
      $ext = strtolower(pathinfo($_FILES['cv_file']['name'],PATHINFO_EXTENSION));
      if(!in_array($ext,$allowed)) $errors[]='CV must be PDF, DOC or DOCX.';
      elseif($_FILES['cv_file']['size']>5*1024*1024) $errors[]='CV must be under 5MB.';
      else {
        $safe = preg_replace('/[^a-zA-Z0-9_-]/','_', pathinfo($_FILES['cv_file']['name'],PATHINFO_FILENAME));
        $cv_filename = time().'_'.$safe.'.'.$ext;
        $dest = __DIR__.'/uploads/'.$cv_filename;
        if(!is_dir(__DIR__.'/uploads')) mkdir(__DIR__.'/uploads',0775,true);
        if(!move_uploaded_file($_FILES['cv_file']['tmp_name'],$dest)){ $errors[]='Could not save CV file.'; $cv_filename=null; }
      }
    }
  }

  if(!$errors){
    $stmt = $conn->prepare('INSERT INTO applications (full_name,email,phone,city,university,semester,domain,skills,cover_letter,cv_file) VALUES (?,?,?,?,?,?,?,?,?,?)');
    $stmt->bind_param('ssssssssss',$old['full_name'],$old['email'],$old['phone'],$old['city'],$old['university'],$old['semester'],$old['domain'],$old['skills'],$old['cover_letter'],$cv_filename);
    if($stmt->execute()){ $success=true; $old=array_fill_keys(array_keys($old),''); }
    else $errors[]='Database error: '.$stmt->error;
    $stmt->close();
  }
}

include __DIR__ . '/includes/header.php';
$domains = ['Web Development','AI & Machine Learning','Cybersecurity','Graphic Design','Mobile App Development','Data Science'];
?>
<section class="hero" style="padding:5rem 0 2rem">
  <div class="container text-center reveal">
    <span class="eyebrow">Application</span>
    <h1>Apply for an <span class="grad">internship</span></h1>
    <p class="lead mx-auto mt-3">Takes about 5 minutes. We review every application within 7 days.</p>
  </div>
</section>

<section style="padding-top:1rem">
  <div class="container" style="max-width:880px">
    <?php if($success): ?>
      <div class="alert alert-glow reveal in"><i class="bi bi-check-circle-fill me-2"></i> Application submitted successfully. We'll be in touch via email.</div>
    <?php endif; ?>
    <?php if($errors): ?>
      <div class="alert alert-error">
        <strong><i class="bi bi-exclamation-triangle me-2"></i>Please fix the following:</strong>
        <ul class="mb-0 mt-2"><?php foreach($errors as $err): ?><li><?= e($err) ?></li><?php endforeach; ?></ul>
      </div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data" class="glass form-card reveal" data-loading novalidate>
      <div class="row g-3">
        <div class="col-md-6">
          <label class="form-label">Full Name</label>
          <input class="form-control" name="full_name" value="<?= e($old['full_name']) ?>" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Email Address</label>
          <input type="email" class="form-control" name="email" value="<?= e($old['email']) ?>" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Phone Number</label>
          <input class="form-control" name="phone" value="<?= e($old['phone']) ?>" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">City</label>
          <input class="form-control" name="city" value="<?= e($old['city']) ?>" required>
        </div>
        <div class="col-md-8">
          <label class="form-label">University / Institute</label>
          <input class="form-control" name="university" value="<?= e($old['university']) ?>" required>
        </div>
        <div class="col-md-4">
          <label class="form-label">Semester</label>
          <input class="form-control" name="semester" placeholder="e.g. 5th" value="<?= e($old['semester']) ?>" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Selected Domain</label>
          <select class="form-select" name="domain" required>
            <option value="">Choose a domain…</option>
            <?php foreach($domains as $d): ?>
              <option value="<?= e($d) ?>" <?= $old['domain']===$d?'selected':'' ?>><?= e($d) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="col-md-6">
          <label class="form-label">CV (PDF/DOC, max 5MB)</label>
          <input type="file" class="form-control" name="cv_file" accept=".pdf,.doc,.docx">
        </div>
        <div class="col-12">
          <label class="form-label">Skills</label>
          <textarea class="form-control" name="skills" rows="2" placeholder="e.g. HTML, CSS, JS, Python, Figma" required><?= e($old['skills']) ?></textarea>
        </div>
        <div class="col-12">
          <label class="form-label">Cover Letter</label>
          <textarea class="form-control" name="cover_letter" rows="5" placeholder="Why TEYZIX CORE? What do you want to build?" required><?= e($old['cover_letter']) ?></textarea>
        </div>
        <div class="col-12 d-flex justify-content-end">
          <button type="submit" class="btn btn-glow"><i class="bi bi-send-fill me-1"></i> Submit Application</button>
        </div>
      </div>
    </form>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
