<?php
    session_start();
    require_once 'config.php';

    if(isset($_SESSION['cart'])){
        $cart = $_SESSION['cart'];
    } else {
        $cart = [];
    }

    if(empty($cart)){
        header('Location: cart.php');
        echo "Your cart is empty.";
        exit;
    }

    $total = 0;
    foreach ($cart as $it) {
        $total += ($it['price'] * $it['qty']);
    }

    $q = "insert into orders (orderTotal) values ('$total')";
    $result = mysqli_query($conn, $q);

    if(!$result) {
        echo "Error creating order: " . mysqli_error($conn);
        exit;
    }

    $orderId = mysqli_insert_id($conn);

    $_SESSION['orderId'] = $orderId;

    header('Location: pay.php?order_id=' . $orderId);
    exit;
?>