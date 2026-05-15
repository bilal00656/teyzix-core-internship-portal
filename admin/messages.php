<?php
require_once __DIR__ . '/_layout.php';
require_admin();

if(isset($_GET['delete'])){
  $id=(int)$_GET['delete'];
  $stmt=$conn->prepare('DELETE FROM contact_messages WHERE id=?'); $stmt->bind_param('i',$id); $stmt->execute(); $stmt->close();
  header('Location: messages.php?deleted=1'); exit;
}
$q=trim($_GET['q']??'');
if($q!==''){ $like='%'.$q.'%'; $stmt=$conn->prepare('SELECT * FROM contact_messages WHERE name LIKE ? OR email LIKE ? OR subject LIKE ? ORDER BY id DESC'); $stmt->bind_param('sss',$like,$like,$like); $stmt->execute(); $res=$stmt->get_result(); }
else { $res=$conn->query('SELECT * FROM contact_messages ORDER BY id DESC'); }

admin_header('Messages — TEYZIX CORE Admin');
?>
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
  <h2 class="mb-0">Contact Messages</h2>
  <form method="GET" class="d-flex gap-2" style="max-width:380px;width:100%">
    <input class="form-control" name="q" value="<?= e($q) ?>" placeholder="Search…">
    <button class="btn btn-glow"><i class="bi bi-search"></i></button>
  </form>
</div>

<?php if(isset($_GET['deleted'])): ?><div class="alert alert-glow">Message deleted.</div><?php endif; ?>

<div class="glass p-3" style="overflow-x:auto">
  <table class="table-glass">
    <thead><tr><th>#</th><th>Name</th><th>Email</th><th>Subject</th><th>Message</th><th>Date</th><th>Actions</th></tr></thead>
    <tbody>
      <?php if($res->num_rows===0): ?>
        <tr><td colspan="7" class="text-center" style="color:var(--muted);padding:2rem">No messages found.</td></tr>
      <?php else: while($r=$res->fetch_assoc()): ?>
        <tr>
          <td>#<?= $r['id'] ?></td>
          <td><?= e($r['name']) ?></td>
          <td><a href="mailto:<?= e($r['email']) ?>"><?= e($r['email']) ?></a></td>
          <td><?= e($r['subject']) ?></td>
          <td style="max-width:380px"><?= e(mb_strimwidth($r['message'],0,140,'…')) ?></td>
          <td><?= e($r['created_at']) ?></td>
          <td><a class="btn-danger-glow" href="?delete=<?= $r['id'] ?>" onclick="return confirm('Delete this message?')"><i class="bi bi-trash"></i></a></td>
        </tr>
      <?php endwhile; endif; ?>
    </tbody>
  </table>
</div>
<?php admin_footer(); ?>
