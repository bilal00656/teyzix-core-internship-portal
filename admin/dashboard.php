<?php
require_once __DIR__ . '/_layout.php';
require_admin();

$totalApps  = (int)$conn->query('SELECT COUNT(*) c FROM applications')->fetch_assoc()['c'];
$totalMsgs  = (int)$conn->query('SELECT COUNT(*) c FROM contact_messages')->fetch_assoc()['c'];
$last7      = (int)$conn->query("SELECT COUNT(*) c FROM applications WHERE created_at >= NOW() - INTERVAL 7 DAY")->fetch_assoc()['c'];
$domains    = $conn->query('SELECT domain, COUNT(*) c FROM applications GROUP BY domain ORDER BY c DESC LIMIT 6');
$recent     = $conn->query('SELECT id,full_name,domain,created_at FROM applications ORDER BY id DESC LIMIT 5');

admin_header('Dashboard — TEYZIX CORE Admin');
?>
<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h2 class="mb-0">Welcome back, <span class="grad" style="background:var(--gradient);-webkit-background-clip:text;color:transparent"><?= e($_SESSION['admin_user']) ?></span></h2>
    <small style="color:var(--muted)">Here's what's happening across the portal.</small>
  </div>
</div>

<div class="row g-3 mb-4">
  <div class="col-md-4"><div class="glass stat"><span class="icon-box mb-2"><i class="bi bi-file-earmark-person"></i></span><div class="num"><?= $totalApps ?></div><div class="label">Total Applications</div></div></div>
  <div class="col-md-4"><div class="glass stat"><span class="icon-box mb-2"><i class="bi bi-chat-dots"></i></span><div class="num"><?= $totalMsgs ?></div><div class="label">Contact Messages</div></div></div>
  <div class="col-md-4"><div class="glass stat"><span class="icon-box mb-2"><i class="bi bi-calendar-week"></i></span><div class="num"><?= $last7 ?></div><div class="label">Last 7 Days</div></div></div>
</div>

<div class="row g-4">
  <div class="col-lg-7">
    <div class="glass p-4">
      <h5 class="mb-3">Recent Applications</h5>
      <table class="table-glass">
        <thead><tr><th>#</th><th>Name</th><th>Domain</th><th>Date</th></tr></thead>
        <tbody>
          <?php while($r=$recent->fetch_assoc()): ?>
            <tr><td>#<?= $r['id'] ?></td><td><?= e($r['full_name']) ?></td><td><span class="badge-status"><?= e($r['domain']) ?></span></td><td><?= e($r['created_at']) ?></td></tr>
          <?php endwhile; ?>
        </tbody>
      </table>
      <a href="applications.php" class="btn btn-outline-glow mt-3">View all <i class="bi bi-arrow-right ms-1"></i></a>
    </div>
  </div>
  <div class="col-lg-5">
    <div class="glass p-4">
      <h5 class="mb-3">Top Domains</h5>
      <?php while($d=$domains->fetch_assoc()):
        $pct = $totalApps>0 ? round($d['c']*100/$totalApps) : 0; ?>
        <div class="mb-3">
          <div class="d-flex justify-content-between"><span><?= e($d['domain']) ?></span><small style="color:var(--muted)"><?= $d['c'] ?></small></div>
          <div style="background:rgba(25,240,168,.08);border-radius:999px;height:8px;overflow:hidden;margin-top:6px">
            <div style="width:<?= $pct ?>%;height:100%;background:var(--gradient);box-shadow:var(--glow)"></div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
</div>
<?php admin_footer(); ?>
