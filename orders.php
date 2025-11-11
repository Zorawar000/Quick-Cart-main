<?php 
include("include/header.php");

if (empty($_SESSION['user_id'])) {
    echo "<script>window.location.href='login1.php';</script>"; exit();
}

$user_id = mysqli_real_escape_string($connect, $_SESSION['user_id']);
$orders_q = mysqli_query($connect, "SELECT * FROM ec_orders WHERE user_id='$user_id' ORDER BY created_at DESC");
?>
<div class="container py-5">
  <h3 class="mb-4">My Orders</h3>
  <?php if($orders_q && mysqli_num_rows($orders_q)>0): ?>
    <div class="table-responsive">
      <table class="table table-bordered align-middle text-center">
        <thead class="table-light">
          <tr>
            <th>#</th>
            <th>Order ID</th>
            <th>Date</th>
            <th>Status</th>
            <th>Total (₹)</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $i=1; while($o = mysqli_fetch_assoc($orders_q)): ?>
          <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo htmlspecialchars($o['order_id']); ?></td>
            <td><?php echo htmlspecialchars($o['created_at']); ?></td>
            <td><?php echo ((int)$o['status']===1?'<span class="badge bg-success">Completed</span>':((int)$o['status']===0?'<span class="badge bg-warning">Pending</span>':'<span class="badge bg-danger">Cancelled</span>')); ?></td>
            <td><?php echo number_format((float)$o['total_amount'],2); ?></td>
            <td><button class="btn btn-sm btn-primary view-items" data-order-id="<?php echo htmlspecialchars($o['order_id']); ?>">View Items</button></td>
          </tr>
          <tr class="order-items-row" data-for="<?php echo htmlspecialchars($o['order_id']); ?>" style="display:none">
            <td colspan="6" class="text-start">
              <div class="items-wrap p-2">
                Loading...
              </div>
            </td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  <?php else: ?>
    <div class="alert alert-info">You have no orders yet. <a href="products.php" class="alert-link">Shop now</a>.</div>
  <?php endif; ?>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
$(function(){
  $(document).on('click','.view-items', function(){
    const orderId = $(this).data('order-id');
    const $row = $(".order-items-row[data-for='"+orderId+"']");
    const $wrap = $row.find('.items-wrap');
    if($row.is(':visible')){ $row.hide(); return; }
    $row.show();
    $wrap.text('Loading...');
    $.get('orders_items_api.php', { order_id: orderId }, function(html){
      $wrap.html(html);
    }).fail(function(){
      $wrap.html('<div class="text-danger">Failed to load items.</div>');
    });
  });
});
</script>
<?php include("include/footer.php"); ?>
