<?php
  session_start();
  include 'header.php';
  include 'navbar.php';
  include 'topMenu.php';

  $cart = $_SESSION['cart'] ?? [];
  $total = 0;
?>

<main style="max-width: 960px; margin: 40px auto;">
  <h2 style="text-align:center; margin-bottom: 20px;">Your Cart</h2>

  <!-- Cart Table -->
  <form action="updateCart.php" method="post">
    <div style="overflow-x:auto;">
      <table style="width:100%; border-collapse: collapse;">
        <thead>
          <tr>
            <th style="text-align:left; padding:12px; border-bottom:1px solid #ddd;">Item</th>
            <th style="text-align:left; padding:12px; border-bottom:1px solid #ddd;">Price</th>
            <th style="text-align:left; padding:12px; border-bottom:1px solid #ddd;">Qty</th>
            <th style="text-align:left; padding:12px; border-bottom:1px solid #ddd;">Subtotal</th>
            <th style="text-align:left; padding:12px; border-bottom:1px solid #ddd;">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            if (empty($cart)) {
                echo '<tr><td colspan="5" style="padding:20px; text-align:center; color:#666;">
                    Your cart is empty.
                    </td></tr>';
            }
            foreach ($cart as $id => $item):
                $sub = $item['price'] * $item['qty'];
                $total += $sub;
          ?>
          <tr>
            <td style="padding:12px; border-bottom:1px solid #eee;">
                <div style="display:flex; align-items:center; gap:10px;">
                <img src="<?= $item['image'] ?>" alt="Product" style="width:50px; height:50px; object-fit:cover;">
                <div>
                    <div style="font-weight:600;"><?= $item['name'] ?></div>
                    <div style="font-size:12px; color:#666;">ID=<?= $item['id'] ?></div>
                </div>
                </div>
            </td>
            <td style="padding:12px; border-bottom:1px solid #eee;">
                <span>$<?= $item['price'] ?></span>
                <input type="hidden" name="items[<?= $id ?>][price]" value="<?= $item['price'] ?>">
            </td>
            <td style="padding:12px; border-bottom:1px solid #eee;">
                <input type="number" name="items[<?= $id ?>][qty]" value="<?= $item['qty'] ?>" min="1" style="width:70px; padding:6px; box-sizing:border-box;">
                <input type="hidden" name="items[<?= $id ?>][id]" value="<?= $id ?>">
            </td>
            <td style="padding:12px; border-bottom:1px solid #eee;">$<?= $sub ?></td>
            <td style="padding:12px; border-bottom:1px solid #eee;">
                <a href="removeFromCart.php?id=<?= $id ?>">Remove</a>
            </td>
          </tr>
            <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <!-- Cart Actions -->
    <div style="display:flex; flex-wrap:wrap; gap:10px; justify-content:space-between; margin-top:16px;">
      <a href="index.php" style="display:inline-block; padding:10px 16px;">← Continue Shopping</a>

      <div style="display:flex; gap:10px;">
        <button type="submit" name="update" value="1" style="padding:10px 16px;">Update Cart</button>
      </div>
    </div>
  </form>

  <!-- Summary -->
  <section style="max-width:420px; margin:24px 0 0 auto; border:1px solid #ddd; padding:16px;">
    <h3 style="margin:0 0 12px 0;">Order Summary</h3>

    <div style="display:flex; justify-content:space-between; margin-bottom:8px;">
      <span>Subtotal</span>
      <span>$<?= $total ?></span>
    </div>

    <div style="display:flex; justify-content:space-between; margin-bottom:8px;">
      <span>Discount</span>
      <span>$ 0.00</span>
    </div>

    <div style="display:flex; justify-content:space-between; margin-bottom:8px;">
      <span>Shipping</span>
      <span>Calculated at checkout</span>
    </div>

    <hr style="border:none; border-top:1px solid #eee; margin:12px 0;">

    <div style="display:flex; justify-content:space-between; font-weight:600; margin-bottom:16px;">
      <span>Total</span>
      <span>$<?= $total ?></span>
    </div>

    <form action="#" method="post" style="display:flex; gap:8px; margin-bottom:12px;">
      <input type="text" name="coupon" placeholder="Coupon code" style="flex:1; padding:8px; box-sizing:border-box;">
      <button type="submit" style="padding:8px 12px;">Apply</button>
    </form>

    <form action="checkout.php" method="post" style="margin-top:16px;" >
        <button type="submit" name="place_order" value="1">Pay with Paypal</button>
    </form>
  </section>
</main>

<?php include 'footer.php'; ?>
