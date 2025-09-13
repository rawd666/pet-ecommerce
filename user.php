<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
  header('Location: login.php?error=Please+log+in');
  exit;
}

$userId = (int)$_SESSION['user_id'];
$uRes = mysqli_query($conn, "SELECT userId, username, email FROM users WHERE userId = $userId LIMIT 1");
if (!$uRes || mysqli_num_rows($uRes) === 0) {
  session_destroy();
  header('Location: login.php?error=please+log+in');
  exit;
}
$user = mysqli_fetch_assoc($uRes);

$orders = [];
$oRes = @mysqli_query($conn, "SELECT orderId, orderTotal, timestamp FROM orders WHERE userId = $userId ORDER BY orderId DESC LIMIT 10");
if ($oRes && mysqli_num_rows($oRes) > 0) {
  while ($row = mysqli_fetch_assoc($oRes)) {
    $orders[] = $row;
  }
}

include 'header.php';
include 'navbar.php';
include 'topMenu.php';

?>

<main style="max-width: 800px; margin: 40px auto;">
  <h2 style="text-align:center; margin-bottom: 20px;">My Account</h2>

  <!-- User info card -->
  <section style="border:1px solid #ddd; padding:16px; margin-bottom:20px;">
    <h3 style="margin:0 0 12px 0;">Profile</h3>
    <div style="display:grid; grid-template-columns: 160px 1fr; row-gap:8px; column-gap:12px;">
      <div style="color:#666;">User ID</div>
      <div><?= (int)$user['userId'] ?></div>

      <div style="color:#666;">Username</div>
      <div><?= htmlspecialchars($user['username']) ?></div>

      <div style="color:#666;">Email</div>
      <div><?= htmlspecialchars($user['email']) ?></div>
    </div>

    <div style="margin-top:16px; color:red;">
      <a href="logout.php">Log out</a>
    </div>
  </section>

  <section style="border:1px solid #ddd; padding:16px;">
    <h3 style="margin:0 0 12px 0;">Recent Orders</h3>

    <?php if (empty($orders)): ?>
      <p style="color:#666; margin:0;">No orders yet.</p>
    <?php else: ?>
      <div style="overflow-x:auto;">
        <table style="width:100%; border-collapse:collapse;">
          <thead>
            <tr>
              <th style="text-align:left; padding:8px; border-bottom:1px solid #ddd;">Order #</th>
              <th style="text-align:left; padding:8px; border-bottom:1px solid #ddd;">Total</th>
              <th style="text-align:left; padding:8px; border-bottom:1px solid #ddd;">Date</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($orders as $o): ?>
              <tr>
                <td style="padding:8px; border-bottom:1px solid #eee;">#<?= (int)$o['orderId'] ?></td>
                <td style="padding:8px; border-bottom:1px solid #eee;">$<?= number_format((float)$o['orderTotal'], 2) ?></td>
                <td style="padding:8px; border-bottom:1px solid #eee;"><?= htmlspecialchars(isset($o['timestamp']) ? date('Y-m-d H:i', strtotime($o['timestamp'])) : '-') ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php endif; ?>
  </section>
</main>

<?php include 'footer.php'; ?>