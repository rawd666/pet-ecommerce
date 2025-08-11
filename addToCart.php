<?php
    session_start();
    require_once 'config.php';
    
    if(isset($_POST['prodId'])) {
        $id = $_POST['prodId'];
    } else {
        header('Location: index.php');
        exit;
    }
    
    $qty = 1;

    $q = "select prodId, prodName, prodPrice, prodImage from product where prodId = $id";
    $result = mysqli_query($conn, $q);
    $row = mysqli_fetch_assoc($result);
    
    if (mysqli_num_rows($result) === 0) {
        header('Location: index.php');
        exit;
    }

    if(!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['qty'] += $qty;
    } else {
        $_SESSION['cart'][$id] = [
            'id'    => $row['prodId'],
            'name'  => $row['prodName'],
            'price' => $row['prodPrice'],
            'image' => $row['prodImage'],
            'qty'   => $qty,
        ];
    }

    header('Location: cart.php');
    exit;
?>