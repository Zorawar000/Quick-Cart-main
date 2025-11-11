<?php
include("db.php");

if (empty($_SESSION['user_id'])) { http_response_code(403); exit('Forbidden'); }
$order_id = isset($_GET['order_id']) ? mysqli_real_escape_string($connect, $_GET['order_id']) : '';
if ($order_id === '') { exit('Invalid order'); }

// Ensure order belongs to user
$user_id = mysqli_real_escape_string($connect, $_SESSION['user_id']);
$own = mysqli_query($connect, "SELECT order_id FROM ec_orders WHERE order_id='".$order_id."' AND user_id='".$user_id."' LIMIT 1");
if(!$own || mysqli_num_rows($own)===0){ exit('Not found'); }

$q = mysqli_query($connect, "SELECT i.*, p.pro_name, p.pro_image FROM ec_order_items i LEFT JOIN ec_products p ON p.pro_id=i.pro_id WHERE i.order_id='".$order_id."'");
if(!$q || mysqli_num_rows($q)===0){ echo '<div class="alert alert-info m-0">No items.</div>'; exit; }

echo '<div class="table-responsive"><table class="table table-sm table-bordered m-0"><thead class="table-light"><tr><th>Image</th><th>Name</th><th>Price (₹)</th><th>Qty</th><th>Total (₹)</th></tr></thead><tbody>'; 
while($it = mysqli_fetch_assoc($q)){
    echo '<tr>';
    echo '<td style="width:60px"><img src="uploads/'.htmlspecialchars($it['pro_image']??'').'" style="width:50px"/></td>';
    echo '<td>'.htmlspecialchars($it['pro_name']??('Product #'.$it['pro_id'])).'</td>';
    echo '<td>'.number_format((float)$it['price'],2).'</td>';
    echo '<td>'.(int)$it['quantity'].'</td>';
    echo '<td>'.number_format((float)$it['line_total'],2).'</td>';
    echo '</tr>';
}

echo '</tbody></table></div>';
