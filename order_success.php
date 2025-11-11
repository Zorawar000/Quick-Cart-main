<?php 
include("include/header.php");

if (empty($_SESSION['user_id'])) {
    echo "<script>window.location.href='login1.php';</script>"; exit();
}

$order_id = isset($_GET['order_id']) ? htmlspecialchars($_GET['order_id']) : '';
?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="alert alert-success">
                <h4 class="alert-heading">Order Placed Successfully!</h4>
                <?php if($order_id): ?>
                    <p>Your Order ID is <strong><?php echo $order_id; ?></strong>.</p>
                <?php else: ?>
                    <p>Your order has been placed.</p>
                <?php endif; ?>
                <hr>
                <p class="mb-0">
                    <a href="products.php" class="btn btn-primary btn-sm">Continue Shopping</a>
                    <a href="mycart.php" class="btn btn-outline-secondary btn-sm">View Cart</a>
                </p>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function(){
        const orderId = <?php echo json_encode($order_id); ?>;
        Swal.fire({
            icon: 'success',
            title: 'Thank you! 🎉',
            text: orderId ? ('Your order '+ orderId +' has been placed successfully.') : 'Your order has been placed successfully.',
            confirmButtonText: 'OK'
        });
    });
    </script>
<?php include("include/footer.php"); ?>
