<?php
include("include/header.php");

if(empty($_SESSION['user_id'])) {
    echo "<script>window.location.href='login1.php';</script>";
    exit;
}

$user_id = $_SESSION['user_id'];
$cart_items = $new_project->get_user_cart($connect, $user_id);

$grand_total = 0;
?>

<div class="container my-5">
    <h3>Your Cart</h3>
    <?php if(mysqli_num_rows($cart_items) > 0): ?>
        <table class="table table-bordered mt-3">
            <thead class="table-light">
                <tr>
                    <th>Product Name</th>
                    <th>Product Image</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while($item = mysqli_fetch_assoc($cart_items)):
                    $item_total = $item['selling_price'] * $item['quantity'];
                    $grand_total += $item_total;
                ?>
                    <tr>
                        <td>
                            <?php echo htmlspecialchars($item['pro_name']); ?>
                        </td>
                        <td>
                            <img src="uploads/<?php echo htmlspecialchars($item['pro_image']); ?>" width="50" height="50">
                        </td>
                        <td>₹<?php echo $item['selling_price']; ?></td>
                        <td>
                            <form method="POST" class="d-flex update-quantity-form">
                                <input type="hidden" name="pro_id" value="<?php echo $item['pro_id']; ?>">
                                <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1" class="form-control" style="width:70px;">
                                <button type="submit" class="btn btn-primary ms-2">Update</button>
                            </form>
                        </td>
                        <td>₹<?php echo $item_total; ?></td>
                        <td>
                            <form method="POST" class="remove-item-form" id="remove-item-form">
                                <input type="hidden" name="pro_id" value="<?php echo $item['pro_id']; ?>">
                                <button type="submit" class="btn btn-danger">Remove</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
                <tr>
                    <td colspan="3" class="text-end fw-bold">Grand Total</td>
                    <td colspan="2" class="fw-bold">₹<?php echo $grand_total; ?></td>
                </tr>
            </tbody>
        </table>
        <a href="checkout.php" class="btn btn-success mt-3">Proceed to Checkout</a>
        <a href="products.php" class="btn btn-secondary mt-3 ms-2">Continue Shopping</a>
    <?php else: ?>
        <div class="alert alert-info mt-3">Your cart is empty.</div>
        <a href="products.php" class="btn btn-secondary mt-3 ms-2">Continue Shopping</a>
    <?php endif; ?>
</div>

<?php include("include/footer.php"); ?>

<script src="js/jquery.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script>
// --- Add to Cart Button Click Handler ---
$(document).ready(function(){
    $('.update-quantity-form').on('submit',function(e){
        e.preventDefault();
        
        var form = $(this);
        var pro_id = form.find('input[name="pro_id"]').val();
        console.log(pro_id);
        var quantity = form.find('input[name="quantity"]').val();
        console.log(quantity);

        $.ajax({
            url: 'cart_controller.php',
            type: 'POST',
            data: {
                action: 'update_quantity',
                pro_id: pro_id,
                quantity: quantity
            },
            success: function(response){
                    //alert(response);
                    //  Handle success messages
                    if (response == 'success') {
                        //  Refresh the page to show updated totals
                        location.reload();
                    }
                    //  Any other error
                    else {
                        alert("Quantity update failed!");
                    }

                // Optionally, update cart count in header
                //updateCartCount();
            },
            error: function(){
                alert('Error updating quantity!');
            }
        });
    });

    /* function updateCartCount(){
        $.ajax({
            url: 'cart_controller.php',
            type: 'GET',
            data: { action: 'get_cart_count' },
            success: function(count){
                $('#cart_count').text(count);
            }
        });
    } */

        // 🔹 Remove Item Handler (optional, same pattern)
    $('.remove-item-form').on('submit', function(e){
        e.preventDefault();

        var form = $(this);
        var pro_id = form.find('input[name="pro_id"]').val();

        $.ajax({
            url: 'cart_controller.php',
            type: 'POST',
            data: {
                action: 'remove_item',
                pro_id: pro_id
            },
            success: function(response){
                if(response.trim() == 'success'){
                    location.reload();
                } else {
                    alert("Failed to remove item!");
                }
            }
        });
    });
    // Initial cart count load
    //updateCartCount();
});
</script>
