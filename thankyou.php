<?php
    session_start();
    require_once 'config.php';

    $ORDER_PK = 'orderId';

    if(isset($_GET['order_id'])) {
        $orderId = $_GET['order_id'];
    } else {
        $orderId = 0;
    }

    if ($orderId <= 0) {
        header('Location: cart.php');
        exit;
    }

    $q = "SELECT * FROM orders WHERE `$ORDER_PK` = $orderId";
    $result = mysqli_query($conn, $q);
    if(mysqli_num_rows($result) === 0) {
        header('Location: cart.php');
        exit;
    }
    $order = mysqli_fetch_assoc($result);

    if(isset($order['orderTotal'])) {
        $total = $order['orderTotal'];
    } else {
        $total = 0.0;
    }

    $created = $order['created_at'] ?? date('Y-m-d H:i:s');

    $cart = $_SESSION['cart'] ?? [];

    unset($_SESSION['cart']);
?>

<?php include 'header.php'; include 'navbar.php'; include 'topMenu.php'; ?>

<main style="max-width: 800px; margin: 30px auto;">
  <h2 style="text-align:center; margin-bottom: 10px;">Thank you for your order!</h2>
  <p style="text-align:center; color:#555; margin-bottom: 24px;">
    Your payment was processed for Order #<?= $orderId ?>.
  </p>

  <!-- Actions -->
  <div class="screen-only" style="text-align:right; margin-bottom: 10px;">
    <button onclick="window.print()" style="padding:8px 12px;">Print Receipt</button>
  </div>

  <!-- Receipt -->
  <section id="receipt" style="border:1px solid #ddd; padding:16px;">
    <header style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:16px;">
      <div>
        <div style="font-weight:700; font-size:18px;">Receipt</div>
        <div style="color:#666;">Order #<?= $orderId ?></div>
        <div style="color:#666;">Date: <?= htmlspecialchars(date('Y-m-d H:i', strtotime($created))) ?></div>
      </div>
      <div style="text-align:right;">
        <div style="font-weight:700;">Waggy</div>
        <div style="color:#666;">waggy123@gmail.com</div>
      </div>
    </header>

    <?php if (!empty($cart)): ?>
      <table style="width:100%; border-collapse:collapse; margin-top:8px;">
        <thead>
          <tr>
            <th style="text-align:left; border-bottom:1px solid #ddd; padding:8px;">Item</th>
            <th style="text-align:left; border-bottom:1px solid #ddd; padding:8px;">Price</th>
            <th style="text-align:left; border-bottom:1px solid #ddd; padding:8px;">Qty</th>
            <th style="text-align:left; border-bottom:1px solid #ddd; padding:8px;">Subtotal</th>
          </tr>
        </thead>
        <tbody>
          <?php $calcTotal = 0;
          foreach ($cart as $it):
            $line = $it['price'] * $it['qty'];
            $calcTotal += $line;
          ?>
          <tr>
            <td style="padding:8px; border-bottom:1px solid #eee;">
              <?= htmlspecialchars($it['name']) ?> <span style="color:#888; font-size:12px;">(ID: <?= (int)$it['id'] ?>)</span>
            </td>
            <td style="padding:8px; border-bottom:1px solid #eee;">$<?= number_format($it['price'], 2) ?></td>
            <td style="padding:8px; border-bottom:1px solid #eee;"><?= (int)$it['qty'] ?></td>
            <td style="padding:8px; border-bottom:1px solid #eee;">$<?= number_format($line, 2) ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>

    <!-- Totals -->
    <div style="display:flex; justify-content:flex-end; margin-top:12px;">
      <div style="min-width:280px;">
        <div style="display:flex; justify-content:space-between; margin-bottom:6px;">
          <span style="color:#444;">Subtotal</span>
          <span>$<?= number_format($total, 2) ?></span>
        </div>
        <div style="border-top:1px solid #eee; margin:10px 0;"></div>
        <div style="display:flex; justify-content:space-between; font-weight:700; font-size:16px;">
          <span>Total Paid</span>
          <span>$<?= number_format($total, 2) ?></span>
        </div>
      </div>
    </div>

    <footer style="margin-top:16px; color:#666; font-size:12px;">
      Keep this receipt for your records. If you have questions, contact support.
    </footer>
  </section>

  <div class="screen-only" style="text-align:center; margin-top:16px;">
    <a href="index.php">Back to Home</a>
  </div>
</main>

<?php include 'footer.php'; ?>

<!-- Print styles -->
<style>
  @media print {
    /* Hide site chrome on print */
    .screen-only, header nav, footer { display: none !important; }
    body { background: #fff; }
    #receipt {
      border: none;
      padding: 0;
    }
    /* Fit nicely on A4 */
    @page { margin: 12mm; }
  }
</style>