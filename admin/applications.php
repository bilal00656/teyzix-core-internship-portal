<?php
require_once __DIR__ . '/_layout.php';
require_admin();

if(isset($_GET['delete'])){
  $id=(int)$_GET['delete'];
  $stmt=$conn->prepare('SELECT cv_file FROM applications WHERE id=?');
  $stmt->bind_param('i',$id); $stmt->execute();
  $row=$stmt->get_result()->fetch_assoc(); $stmt->close();
  if($row && $row['cv_file']){ @unlink(__DIR__.'/../uploads/'.$row['cv_file']); }
  $stmt=$conn->prepare('DELETE FROM applications WHERE id=?'); $stmt->bind_param('i',$id); $stmt->execute(); $stmt->close();
  header('Location: applications.php?deleted=1'); exit;
}

$q = trim($_GET['q'] ?? '');
if($q!==''){
  $like='%'.$q.'%';
  $stmt=$conn->prepare('SELECT * FROM applications WHERE full_name LIKE ? OR email LIKE ? OR domain LIKE ? OR university LIKE ? ORDER BY id DESC');
  $stmt->bind_param('ssss',$like,$like,$like,$like); $stmt->execute();
  $res=$stmt->get_result();
} else {
  $res=$conn->query('SELECT * FROM applications ORDER BY id DESC');
}

admin_header('Applications — TEYZIX CORE Admin');
?>
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
  <h2 class="mb-0">Applications</h2>
  <form method="GET" class="d-flex gap-2" style="max-width:380px;width:100%">
    <input class="form-control" name="q" value="<?= e($q) ?>" placeholder="Search name, email, domain…">
    <button class="btn btn-glow"><i class="bi bi-search"></i></button>
  </form>
</div>

<?php if(isset($_GET['deleted'])): ?><div class="alert alert-glow">Application deleted.</div><?php endif; ?>

<div class="glass p-3" style="overflow-x:auto">
  <table class="table-glass">
    <thead><tr><th>#</th><th>Name</th><th>Email</th><th>Phone</th><th>Domain</th><th>University</th><th>CV</th><th>Date</th><th>Actions</th></tr></thead>
    <tbody>
      <?php if($res->num_rows===0): ?>
        <tr><td colspan="9" class="text-center" style="color:var(--muted);padding:2rem">No applications found.</td></tr>
      <?php else: while($r=$res->fetch_assoc()): ?>
        <tr>
          <td>#<?= $r['id'] ?></td>
          <td><?= e($r['full_name']) ?></td>
          <td><?= e($r['email']) ?></td>
          <td><?= e($r['phone']) ?></td>
          <td><span class="badge-status"><?= e($r['domain']) ?></span></td>
          <td><?= e($r['university']) ?> · <?= e($r['semester']) ?></td>
          <td><?php if($r['cv_file']): ?><a href="../uploads/<?= e($r['cv_file']) ?>" target="_blank"><i class="bi bi-download"></i> CV</a><?php else: ?><span style="color:var(--muted)">—</span><?php endif; ?></td>
          <td><?= e($r['created_at']) ?></td>
          <td>
            <button class="btn btn-outline-glow btn-sm" data-bs-toggle="modal" data-bs-target="#m<?= $r['id'] ?>"><i class="bi bi-eye"></i></button>
            <a class="btn-danger-glow" href="?delete=<?= $r['id'] ?>" onclick="return confirm('Delete this application?')"><i class="bi bi-trash"></i></a>
          </td>
        </tr>
        <div class="modal fade" id="m<?= $r['id'] ?>" tabindex="-1"><div class="modal-dialog modal-lg modal-dialog-centered"><div class="modal-content glass" style="background:var(--bg-2)">
          <div class="modal-header" style="border-color:var(--border)"><h5 class="modal-title"><?= e($r['full_name']) ?> — <?= e($r['domain']) ?></h5><button class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
          <div class="modal-body">
            <p><strong>Email:</strong> <?= e($r['email']) ?> &nbsp; <strong>Phone:</strong> <?= e($r['phone']) ?></p>
            <p><strong>City:</strong> <?= e($r['city']) ?> &nbsp; <strong>University:</strong> <?= e($r['university']) ?> (<?= e($r['semester']) ?>)</p>
            <p><strong>Skills:</strong><br><?= nl2br(e($r['skills'])) ?></p>
            <p><strong>Cover Letter:</strong><br><?= nl2br(e($r['cover_letter'])) ?></p>
            <?php if($r['cv_file']): ?><p><a class="btn btn-glow" href="../uploads/<?= e($r['cv_file']) ?>" target="_blank"><i class="bi bi-download me-1"></i> Download CV</a></p><?php endif; ?>
          </div>
        </div></div></div>
      <?php endwhile; endif; ?>
    </tbody>
  </table>
</div>
<?php admin_footer(); ?>
