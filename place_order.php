<?php
include("db.php");
include("new_project_class.php");

if (empty($_SESSION['user_id'])) {
    echo "<script>window.location.href='login1.php';</script>"; exit();
}

$user_id = $_SESSION['user_id'];

// Ensure tables exist (basic schema)
mysqli_query($connect, "CREATE TABLE IF NOT EXISTS ec_orders (
  id INT AUTO_INCREMENT PRIMARY KEY,
  order_id VARCHAR(30) NOT NULL,
  user_id VARCHAR(20) NOT NULL,
  customer_name VARCHAR(255) DEFAULT NULL,
  total_amount DECIMAL(10,2) DEFAULT 0,
  status TINYINT(1) DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

mysqli_query($connect, "CREATE TABLE IF NOT EXISTS ec_order_items (
  id INT AUTO_INCREMENT PRIMARY KEY,
  order_id VARCHAR(30) NOT NULL,
  pro_id INT NOT NULL,
  quantity INT NOT NULL DEFAULT 1,
  price DECIMAL(10,2) NOT NULL,
  line_total DECIMAL(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

// Fetch cart
$new_project = new new_project_work;
$cart_rs = $new_project->get_user_cart($connect, $user_id);
if(!$cart_rs || mysqli_num_rows($cart_rs) === 0){
    echo "<script>alert('Cart is empty.');window.location.href='products.php';</script>"; exit();
}

// Fetch user name
$user_q = mysqli_query($connect, "SELECT first_name,last_name FROM new_project_table WHERE user_id='".mysqli_real_escape_string($connect,$user_id)."' LIMIT 1");
$u = mysqli_fetch_assoc($user_q);
$customer_name = trim(($u['first_name'] ?? '').' '.($u['last_name'] ?? ''));

// Compute totals and build items
$items = [];
$grand = 0;
while($row = mysqli_fetch_assoc($cart_rs)){
    $qty = (int)$row['quantity'];
    $price = (float)$row['selling_price'];
    $line = $price * $qty;
    $items[] = [ 'pro_id' => (int)$row['pro_id'], 'qty' => $qty, 'price' => $price, 'line' => $line ];
    $grand += $line;
}

// Create order id
$order_id = 'ORD'.mt_rand(100000,999999);

// Insert order
mysqli_query($connect, "INSERT INTO ec_orders (order_id,user_id,customer_name,total_amount,status) VALUES (
    '".$order_id."', '".$user_id."', '".mysqli_real_escape_string($connect,$customer_name)."', '".number_format($grand,2,'.','')."', 1
)");

// Insert items
foreach($items as $it){
    mysqli_query($connect, "INSERT INTO ec_order_items (order_id,pro_id,quantity,price,line_total) VALUES (
        '".$order_id."', '".$it['pro_id']."', '".$it['qty']."', '".$it['price']."', '".$it['line']."'
    )");
}

// Clear cart
mysqli_query($connect, "DELETE FROM my_cart WHERE user_id='".mysqli_real_escape_string($connect,$user_id)."'");

// Redirect to success page
header("Location: order_success.php?order_id=".urlencode($order_id));
exit();
