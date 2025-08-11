<?php
    session_start();
    require_once 'config.php';

    if(isset($_GET['order_id'])) {
        $orderId = $_GET['order_id'];
    } else {
        $orderId = 0;
    }

    if($orderId <= 0) {
        header('Location: cart.php');
        exit;
    }

    $q = "select * from orders where orderId = $orderId";
    $result = mysqli_query($conn, $q);
    $order = mysqli_fetch_assoc($result);

    $amount = $order['orderTotal'];
?>

<?php include 'header.php'; include 'navbar.php'; include 'topMenu.php'; ?>

<main style="max-width:600px;margin:40px auto;">
  <h2>Order #<?= $orderId ?></h2>
  <p>Total: $<?= $amount ?></p>

  <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" style="margin-top:16px;">
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="business" value="sb-wzzcv45168512@business.example.com">
    <input type="hidden" name="item_name" value="Order #<?= $orderId ?>">
    <input type="hidden" name="amount" value="<?= $amount ?>">
    <input type="hidden" name="currency_code" value="USD">

    <!-- pass your order id so you can update it later -->
    <input type="hidden" name="custom" value="<?= $orderId ?>">

    <!-- where PayPal sends the buyer back -->
    <input type="hidden" name="return" value="http://localhost/waggy-1.0.0/thankyou.php?order_id=<?= $orderId ?>">
    <input type="hidden" name="cancel_return" value="http://localhost/waggy-1.0.0/cart.php">

    <button type="submit">Pay with PayPal</button>
  </form>
</main>

<?php include 'footer.php'; ?>