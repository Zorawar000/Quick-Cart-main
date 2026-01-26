<?php
include("include/header.php");

// Admin login guard (header already checks), fallback:
if(empty($_SESSION['admin_username'])){
    echo "<script>window.location.href='login.php';</script>"; exit();
}

$order_id = isset($_GET['id']) ? mysqli_real_escape_string($connect, $_GET['id']) : '';
if($order_id === ''){
    echo "<div class='main_content_iner'><div class='container-fluid p-0 sm_padding_15px'><div class='alert alert-danger m-3'>Invalid order id.</div></div></div>";
    include("include/footer.php");
    exit();
}

// Fetch order header
$ord_q = mysqli_query($connect, "SELECT * FROM ec_orders WHERE order_id='".$order_id."' LIMIT 1");
$order = $ord_q ? mysqli_fetch_assoc($ord_q) : null;
if(!$order){
    echo "<div class='main_content_iner'><div class='container-fluid p-0 sm_padding_15px'><div class='alert alert-warning m-3'>Order not found.</div></div></div>";
    include("include/footer.php");
    exit();
}

// Fetch items
$items_q = mysqli_query($connect, "SELECT i.*, p.pro_name, p.pro_image FROM ec_order_items i LEFT JOIN ec_products p ON p.pro_id = i.pro_id WHERE i.order_id='".$order_id."'");
?>
<div class="main_content_iner">
  <div class="container-fluid p-0 sm_padding_15px">
    <div class="row justify-content-center">
      <div class="col-lg-12">
        <div class="white_card mb_30">
          <div class="white_card_header">
            <div class="box_header m-0 d-flex justify-content-between align-items-center">
              <div class="main-title"><h3 class="m-0">Order #<?php echo htmlspecialchars($order_id); ?></h3></div>
              <a href="orders.php" class="btn btn-sm btn-outline-primary">Back to Orders</a>
            </div>
          </div>
          <div class="white_card_body">
            <div class="row">
              <div class="col-md-4">
                <div class="mb-2"><strong>Customer:</strong> <?php echo htmlspecialchars($order['customer_name'] ?? ''); ?></div>
                <div class="mb-2"><strong>User ID:</strong> <?php echo htmlspecialchars($order['user_id'] ?? ''); ?></div>
              </div>
              <div class="col-md-4">
                <div class="mb-2"><strong>Status:</strong> <?php echo ((int)$order['status']===1?'<span class="badge bg-success">Completed</span>':((int)$order['status']===0?'<span class="badge bg-warning">Pending</span>':'<span class="badge bg-danger">Cancelled</span>')); ?></div>
                <div class="mb-2"><strong>Date:</strong> <?php echo htmlspecialchars($order['created_at']); ?></div>
              </div>
              <div class="col-md-4 text-md-end">
                <div class="mb-2"><strong>Total Amount:</strong> ₹ <?php echo number_format((float)$order['total_amount'],2); ?></div>
              </div>
            </div>
            <hr>
            <div class="table-responsive">
              <table class="table table-bordered align-middle text-center">
                <thead class="table-light">
                  <tr>
                    <th>#</th>
                    <th>Product</th>
                    <th>Name</th>
                    <th>Price (₹)</th>
                    <th>Qty</th>
                    <th>Line Total (₹)</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $s=1; $calc_total=0; 
                  while($it = mysqli_fetch_assoc($items_q)):
                    $calc_total += (float)$it['line_total'];
                  ?>
                  <tr>
                    <td><?php echo $s++; ?></td>
                    <td style="width:70px"><img src="../uploads/<?php echo htmlspecialchars($it['pro_image'] ?? ''); ?>" alt="" style="width:60px" class="img-fluid"></td>
                    <td><?php echo htmlspecialchars($it['pro_name'] ?? (string)$it['pro_id']); ?></td>
                    <td><?php echo number_format((float)$it['price'], 2); ?></td>
                    <td><?php echo (int)$it['quantity']; ?></td>
                    <td><?php echo number_format((float)$it['line_total'], 2); ?></td>
                  </tr>
                  <?php endwhile; ?>
                </tbody>
                <tfoot>
                  <tr class="table-success">
                    <td colspan="5" class="text-end fw-bold">Total</td>
                    <td class="fw-bold">₹ <?php echo number_format($calc_total,2); ?></td>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
        <a href="index.php" class="btn btn-primary">Back To Dashboard</a>
      </div>
    </div>
  </div>
</div>
<?php include("include/footer.php"); ?>
