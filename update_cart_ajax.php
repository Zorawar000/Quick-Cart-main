<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $item_id = $_POST['item_id'] ?? null;
    $quantity = $_POST['quantity'] ?? null;

    if ($item_id === null || $quantity === null || !is_numeric($quantity) || $quantity < 1) {
        echo "error|Invalid input";
        exit;
    }

    if (!isset($_SESSION['cart'][$item_id])) {
        echo "error|Item not found in cart";
        exit;
    }

    $_SESSION['cart'][$item_id]['quantity'] = (int)$quantity;

    // Calculate item total and grand total
    $item_price = $_SESSION['cart'][$item_id]['price'];
    $item_total = $item_price * $quantity;

    $grand_total = 0;
    foreach ($_SESSION['cart'] as $item) {
        $grand_total += $item['price'] * $item['quantity'];
    }

    // Return success response as: success|item_total|grand_total
    echo "success|$item_total|$grand_total";
    exit;
}
?>
