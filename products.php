<?php
   include("include/header.php");
        // --- Get selected category (if any) ---
        $selected_cat = isset($_GET['cate_id']) ? (int)$_GET['cate_id'] : 0;

        // --- Fetch categories ---
        $cat_query = mysqli_query($connect, "SELECT * FROM ec_categories ORDER BY cate_name ASC");

        // --- Fetch products ---
        if($selected_cat > 0){
            // Selected category ke products
            $pro_query = mysqli_query($connect, "
                SELECT * FROM ec_products 
                WHERE status = '1' AND pro_cate = '$selected_cat'
                ORDER BY pro_id DESC
            ");
        } else {
            // All products
            $pro_query = mysqli_query($connect, "
                SELECT * FROM ec_products 
                WHERE status = '1'
                ORDER BY pro_id DESC
            ");
        }
        ?>
        <div class="container my-5">
        <div class="row">
            <!-- Sidebar: Categories -->
            <div class="col-md-3">
                <h5 class="fw-bold mb-3 text-primary">Categories</h5>
                <ul class="list-group">
                <li class="list-group-item <?php echo ($selected_cat == 0) ? 'active' : ''; ?>">
                    <a href="products.php" class="text-decoration-none <?php echo ($selected_cat == 0) ? 'text-white' : ''; ?>">All Products</a>
                </li>
                <?php while($cat = mysqli_fetch_assoc($cat_query)): ?>
                <li class="list-group-item <?php echo ($selected_cat == $cat['cate_id']) ? 'active' : ''; ?>">
                    <a href="products.php?cate_id=<?php echo $cat['cate_id']; ?>" class="text-decoration-none <?php echo ($selected_cat == $cat['cate_id']) ? 'text-white' : ''; ?>">
                    <?php echo htmlspecialchars($cat['cate_name']); ?>
                    </a>
                </li>
                <?php endwhile; ?>
                </ul>
            </div>
            <!-- Main Products Area -->
            <div class="col-md-9">
                <h3 class="fw-bold text-primary mb-4">
                <?php 
                    if($selected_cat > 0){
                        $cat_name_res = mysqli_fetch_assoc(mysqli_query($connect, "SELECT cate_name FROM ec_categories WHERE cate_id = '$selected_cat'"));
                        echo "Products in " . htmlspecialchars($cat_name_res['cate_name']);
                    } else {
                        echo "All Products";
                    }
                    ?>
                </h3>
                <?php if(mysqli_num_rows($pro_query) > 0): ?>
                <?php 
                    // Collect products to build indicators and slides
                    $products = [];
                    while($r = mysqli_fetch_assoc($pro_query)) { $products[] = $r; }
                    $total = count($products);
                    $slides = $total ? ceil($total/4) : 0;
                ?>
                <div id="productsCarousel" class="carousel slide" data-bs-ride="carousel">
                    <?php if($slides > 1){ ?>
                    <div class="carousel-indicators">
                        <?php for($s=0; $s<$slides; $s++): ?>
                            <button type="button" data-bs-target="#productsCarousel" data-bs-slide-to="<?php echo $s; ?>" class="<?php echo ($s===0?'active':''); ?>" <?php echo ($s===0?'aria-current="true"':''); ?> aria-label="Slide <?php echo ($s+1); ?>"></button>
                        <?php endfor; ?>
                    </div>
                    <?php } ?>
                    <div class="carousel-inner">
                        <?php 
                        $i = 0; 
                        foreach($products as $row){
                            if($i % 4 === 0){
                                $active = ($i === 0) ? ' active' : '';
                                echo '<div class="carousel-item'.$active.'"><div class="row g-4">';
                            }
                        ?>
                        <div class="col-md-3 col-sm-6">
                            <div class="card h-100 shadow-sm border-0">
                                <div class="ratio ratio-1x1">
                                    <img src="uploads/<?php echo htmlspecialchars($row['pro_image']); ?>" class="card-img-top img-fluid" alt="<?php echo htmlspecialchars($row['pro_name']); ?>">
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <h6 class="card-title text-truncate"><?php echo htmlspecialchars($row['pro_name']); ?></h6>
                                    <p class="text-muted mb-1">₹<?php echo number_format($row['selling_price'], 2); ?></p>
                                    <small class="text-secondary mb-2"><?php echo substr(htmlspecialchars($row['pro_desc']), 0, 60); ?>...</small>
                                    <div class="mt-auto d-grid gap-2">
                                        <form method="POST" class="add-to-cart-form">
                                            <a href="product_details.php?pro_id=<?php echo $row['pro_id']; ?>" class="btn btn-outline-primary btn-sm">View Details</a>
                                            <input type="hidden" name="pro_id" value="<?php echo $row['pro_id']; ?>">
                                            <button type="submit" name="submit" class="btn btn-primary add_to_cart_btn">Add to Cart</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php 
                            $i++;
                            if($i % 4 === 0){ echo '</div></div>'; }
                        }
                        if($i % 4 !== 0){ echo '</div></div>'; }
                        ?>
                    </div>
                    <!-- <button class="carousel-control-prev" type="button" data-bs-target="#productsCarousel" data-bs-slide="prev" style="filter: brightness(0);">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#productsCarousel" data-bs-slide="next" style="filter: brightness(0);">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button> -->
                </div>
                <!-- 🟦 Custom arrow section below the products -->
                <div class="text-center mt-4">
                    <button class="btn btn-outline-primary me-2" type="button" data-bs-target="#productsCarousel" data-bs-slide="prev">
                        <i class="bi bi-arrow-left-circle"></i> Previous
                    </button>
                    <button class="btn btn-outline-primary" type="button" data-bs-target="#productsCarousel" data-bs-slide="next">
                        Next <i class="bi bi-arrow-right-circle"></i>
                    </button>
                </div>
                <?php else: ?>
                <div class="col-12 text-center">
                    <div class="alert alert-info">No products found in this category!</div>
                </div>
                <?php endif; ?>
                
            </div>
        </div>
        </div>
<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

        <?php include("include/footer.php"); ?>

        <script src="js/jquery.js"></script>
        <script src="js/jquery.validate.min.js"></script>
        <script>
        // --- Add to Cart Button Click Handler ---
        $(document).ready(function(){
            var LOGGED_IN = <?php echo !empty($_SESSION['user_id']) ? 'true' : 'false'; ?>;
            $(document).on('click', '.add_to_cart_btn', function(e){
                e.preventDefault();
                if(!LOGGED_IN){ window.location.href='login1.php'; return; }
                var $form = $(this).closest('form');
                var pro_id = $form.find('input[name="pro_id"]').val();
                var quantity = 1;

                $.ajax({
                    url: 'cart_controller.php',
                    type: 'POST',
                    data: {
                        action: 'add_to_cart',
                        pro_id: pro_id,
                        quantity: quantity
                    },
                    success: function(response){
                        if (response == 'login_required') { window.location.href='login1.php'; return; }
                        if (response == 'success') {
                            alert('Product added to cart!');
                            location.reload();
                        } else {
                            alert('Failed to add product to cart.');
                        }
                    },
                    error: function(){
                        alert('Error adding product to cart.');
                    }
                });
            });

        });
        </script>
