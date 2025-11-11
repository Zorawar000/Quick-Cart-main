<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $item_id = $_POST['item_id'] ?? null;

    if ($item_id === null) {
        echo "error|Invalid item";
        exit;
    }

    if (!isset($_SESSION['cart'][$item_id])) {
        echo "error|Item not found in cart";
        exit;
    }

    // Remove item from cart
    unset($_SESSION['cart'][$item_id]);

    // Calculate new grand total
    $grand_total = 0;
    foreach ($_SESSION['cart'] as $item) {
        $grand_total += $item['price'] * $item['quantity'];
    }

    // Return success response: success|grand_total
    echo "success|$grand_total";
    exit;
}
?>
