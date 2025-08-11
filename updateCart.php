<?php
    session_start();

    if($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: cart.php');
        exit;
    }

    if(isset($_POST['items'])) {
        $items = $_POST['items'];
    } else {
        $items = [];
    }

    foreach($items as $id => $data) {
        $qty = $data['qty'];

        if(isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['qty'] = $qty;
        }
    }

    header('Location: cart.php');
    exit;
?>