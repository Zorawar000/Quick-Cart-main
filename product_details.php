<?php
include("include/header.php");

    if(empty($_SESSION['user_id']))
    {
        echo "<script>window.location.href = 'login1.php';</script>";
        exit();
    }
    else
    {
        // --- Get product ID from URL ---
        $pro_id = isset($_GET['pro_id']) ? (int)$_GET['pro_id'] : 0;

        if($pro_id <= 0){
            echo "<div class='alert alert-danger text-center my-5'>Invalid Product!</div>";
            include("include/footer.php");
            exit();
        }
        // --- Fetch product details ---
        $pro_query = mysqli_query($connect, "SELECT ec_products.*, ec_categories.cate_name, ec_sub_categories.cate_name AS sub_cate_name 
                                            FROM ec_products 
                                            LEFT JOIN ec_categories 
                                            ON ec_products.pro_cate = ec_categories.cate_id 
                                            LEFT JOIN ec_sub_categories 
                                            ON ec_products.pro_sub_cate = ec_sub_categories.cate_id 
                                            WHERE ec_products.pro_id = '$pro_id' AND ec_products.status = '1';");

        $product = mysqli_fetch_assoc($pro_query);

        if(!$product){
            echo "<div class='alert alert-info text-center my-5'>Product not found!</div>";
            include("include/footer.php");
            exit();
        }
        ?>

        <div class="container my-5">
            <div class="row">
                <!-- Product Images -->
                <div class="col-md-3">
                    <div class="ratio ratio-1x1">
                        <img src="uploads/<?php echo htmlspecialchars($product['pro_image']); ?>" 
                            class="img-fluid" 
                            alt="<?php echo htmlspecialchars($product['pro_name']); ?>">
                    </div>
                </div>

                <!-- Product Details -->
                <div class="col-md-9">
                    <h3 class="fw-bold text-primary"><?php echo htmlspecialchars($product['pro_name']); ?></h3>
                    <p class="text-muted mb-2">Category: <?php echo htmlspecialchars($product['cate_name']).'&nbsp'.'(&nbsp'.htmlspecialchars($product['sub_cate_name']).'&nbsp'.')'; ?></p>
                    <h4 class="text-danger mb-3">₹<?php echo number_format($product['selling_price'], 2); ?></h4>
                    <p class="mb-3"><?php echo nl2br(htmlspecialchars($product['pro_desc'])); ?></p>

                    <!-- Add to Cart -->
                    <form method="POST" action="cart_controller.php">
                        <div class="mt-3 d-flex gap-2">
                            <input type="hidden" name="action" value="add_to_cart">
                            <input type="hidden" name="pro_id" value="<?php echo $product['pro_id']; ?>">
                            <button type="submit" class="btn btn-primary">Add to Cart</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Optional: More Products from same category -->
            <?php
            $related_query = mysqli_query($connect, "
                SELECT * FROM ec_products 
                WHERE pro_cate = '{$product['pro_cate']}' AND status='1' AND pro_id != '$pro_id' 
                ORDER BY pro_id DESC LIMIT 4
            ");
            if(mysqli_num_rows($related_query) > 0):
            ?>
            <div class="mt-5">
                <h5 class="fw-bold text-secondary mb-3">Related Products</h5>
                <div class="row g-4">
                    <?php while($row = mysqli_fetch_assoc($related_query)): ?>
                    <div class="col-md-3 col-sm-6">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="ratio ratio-1x1">
                                <img src="uploads/<?php echo htmlspecialchars($row['pro_image']); ?>" 
                                    class="img-fluid" 
                                    alt="<?php echo htmlspecialchars($row['pro_name']); ?>">
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h6 class="card-title text-truncate"><?php echo htmlspecialchars($row['pro_name']); ?></h6>
                                <p class="text-muted mb-1">₹<?php echo number_format($row['selling_price'], 2); ?></p>
                                <small class="text-secondary mb-2"><?php echo substr(htmlspecialchars($row['pro_desc']), 0, 60); ?>...</small>
                                <div class="mt-auto">
                                    <a href="product_details.php?pro_id=<?php echo $row['pro_id']; ?>" 
                                    class="btn btn-outline-primary w-100 btn-sm">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <?php include("include/footer.php"); ?>
        <script>
            $(document).ready(function(){
                // Fetch cart count on page load
                function updateCartCount() {
                    $.ajax({
                        url: 'cart_controller.php',
                        method: 'POST',
                        data: { action: 'get_cart_count' },
                        success: function(response) {
                            $('#cart_count').text(response);
                        }
                    });
                }

                updateCartCount();

                // Update cart count when "Add to Cart" button is clicked
                $('#add_to_cart_btn').click(function(e){
                    e.preventDefault();
                    $.ajax({
                        url: 'cart_controller.php',
                        method: 'POST',
                        data: { 
                            action: 'add_to_cart', 
                            pro_id: <?php echo $pro_id; ?> 
                        },
                        success: function(response) {
                            if(response === "success"){
                                updateCartCount();
                                alert('Product added to cart!');
                            } else {
                                alert('Failed to add product to cart.');
                            }
                        }
                    });
                });
            });
        </script>
<?php } ?>
