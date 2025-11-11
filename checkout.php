<?php 
include("include/header.php");
//include("new_project_class.php");

if (empty($_SESSION['user_id'])) {
    echo "<script>window.location.href = 'login1.php';</script>";
    exit();
}

$new_project = new new_project_work;
$user_id = $_SESSION['user_id'];
$cart_result = $new_project->get_user_cart($connect, $user_id);

?>
<div class="container py-5">
    <h2 class="mb-4 text-center">Checkout</h2>

    <?php if ($cart_result && mysqli_num_rows($cart_result) > 0): ?>
        <div class="row">
            <div class="col-lg-8">
                <div class="table-responsive">
                    <table class="table table-bordered align-middle text-center" id="checkout_table">
                        <thead class="table-primary">
                            <tr>
                                <th>Product</th>
                                <th>Name</th>
                                <th>Price (₹)</th>
                                <th>Quantity</th>
                                <th>Total (₹)</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $grand_total = 0; 
                            while($item = mysqli_fetch_assoc($cart_result)):
                                $line_total = (float)$item['total_pro_price'];
                                $grand_total += $line_total;
                            ?>
                            <tr data-pro-id="<?php echo $item['pro_id']; ?>">
                                <td style="width:80px"><img src="uploads/<?php echo htmlspecialchars($item['pro_image']); ?>" alt="" class="img-fluid" style="width:60px"></td>
                                <td><?php echo htmlspecialchars($item['pro_name']); ?></td>
                                <td class="price"><?php echo number_format($item['selling_price'], 2); ?></td>
                                <td style="width:120px">
                                    <input type="number" class="form-control form-control-sm quantity_input" value="<?php echo (int)$item['quantity']; ?>" min="1">
                                </td>
                                <td class="line-total"><?php echo number_format($line_total, 2); ?></td>
                                <td>
                                    <button class="btn btn-sm btn-danger remove-item-btn">Remove</button>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                        <tfoot>
                            <tr class="table-success">
                                <td colspan="4" class="text-end fw-bold">Grand Total:</td>
                                <td colspan="2" class="fw-bold" id="grand_total">₹ <?php echo number_format($grand_total, 2); ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">Order Summary</div>
                    <div class="card-body">
                        <p class="d-flex justify-content-between"><span>Items Total</span> <span id="summary_total">₹ <?php echo number_format($grand_total, 2); ?></span></p>
                        <p class="d-flex justify-content-between"><span>Shipping</span> <span>₹ 0.00</span></p>
                        <hr>
                        <p class="d-flex justify-content-between fw-bold"><span>Payable</span> <span id="summary_payable">₹ <?php echo number_format($grand_total, 2); ?></span></p>
                        <form method="post" action="place_order.php">
                            <button type="submit" class="btn btn-success w-100 mt-3" id="place_order_btn" <?php echo ($grand_total>0)?'':'disabled'; ?>>Place Order</button>
                        </form>
                        <small class="text-muted d-block mt-2">(Order placement endpoint not configured yet)</small>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-warning text-center">Your cart is empty. <a href="products.php" class="alert-link">Browse products</a></div>
    <?php endif; ?>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
$(function(){
    function recalcGrandTotal(){
        let sum = 0;
        $("#checkout_table tbody tr").each(function(){
            const v = parseFloat($(this).find('.line-total').text()) || 0;
            sum += v;
        });
        $('#grand_total').text('₹ ' + sum.toFixed(2));
        $('#summary_total').text('₹ ' + sum.toFixed(2));
        $('#summary_payable').text('₹ ' + sum.toFixed(2));
        $('#place_order_btn').prop('disabled', sum <= 0);
    }

    // Quantity change
    $(document).on('change', '.quantity_input', function(){
        const $row = $(this).closest('tr');
        const proId = $row.data('pro-id');
        const qty = parseInt($(this).val());
        if(isNaN(qty) || qty < 1){ $(this).val(1); return; }

        $.ajax({
            url: 'cart_controller.php',
            type: 'POST',
            data: { action: 'update_quantity', pro_id: proId, quantity: qty },
            success: function(resp){
                if(resp === 'success'){
                    const price = parseFloat($row.find('.price').text());
                    const line = price * qty;
                    $row.find('.line-total').text(line.toFixed(2));
                    recalcGrandTotal();
                }else{
                    alert('Failed to update quantity');
                }
            },
            error: function(){ alert('Error updating quantity'); }
        });
    });

    // Remove item
    $(document).on('click', '.remove-item-btn', function(){
        if(!confirm('Remove this item from cart?')) return;
        const $row = $(this).closest('tr');
        const proId = $row.data('pro-id');

        $.ajax({
            url: 'cart_controller.php',
            type: 'POST',
            data: { action: 'remove_item', pro_id: proId },
            success: function(resp){
                if(resp === 'success'){
                    $row.remove();
                    recalcGrandTotal();
                    if($("#checkout_table tbody tr").length === 0){ location.reload(); }
                }else{
                    alert('Failed to remove item');
                }
            },
            error: function(){ alert('Error removing item'); }
        });
    });
});
</script>

<?php include("include/footer.php"); ?>
