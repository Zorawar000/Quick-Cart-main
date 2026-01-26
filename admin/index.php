<?php
include("include/header.php");

// Admin session check
if(empty($_SESSION['admin_username'])) {
    echo "<script>window.location.href = 'login.php';</script>";
    exit();
}

// Example statistics: products, categories, orders
$total_products = $admin->countProducts($connect);
$total_categories = $admin->countCategories($connect);
$total_subcategories = $admin->countSubcategories($connect);
$total_orders = $admin->countOrders($connect);

?>

<div class="main_content_iner">
    <div class="container-fluid p-0 sm_padding_15px">
        <div class="row">
            <!-- Welcome Message -->
            <div class="col-12 mb-3">
                <div class="white_card">
                    <div class="white_card_body">
                        <h4 class="m-0">Welcome, <?php echo $_SESSION['admin_username']; ?>!</h4>
                        <p class="mb-0">Here’s a quick overview of your store.</p>
                    </div>
                </div>
            </div>

            <!-- Dashboard Cards -->
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="white_card card_height_100">
                    <div class="white_card_body text-center">
                        <h5>Total Products</h5>
                        <h3><?php echo $total_products; ?></h3>
                        <a href="view-products.php" class="btn btn-sm btn-primary mt-2">View Products</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-3">
                <div class="white_card card_height_100">
                    <div class="white_card_body text-center">
                        <h5>Total Categories</h5>
                        <h3><?php echo $total_categories; ?></h3>
                        <a href="view-categories.php" class="btn btn-sm btn-primary mt-2">View Categories</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-3">
                <div class="white_card card_height_100">
                    <div class="white_card_body text-center">
                        <h5>Total Subcategories</h5>
                        <h3><?php echo $total_subcategories; ?></h3>
                        <a href="view-sub-categorie_list.php" class="btn btn-sm btn-primary mt-2">View Subcategories</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-3">
                <div class="white_card card_height_100">
                    <div class="white_card_body text-center">
                        <h5>Total Orders</h5>
                        <h3><?php echo $total_orders; ?></h3>
                        <a href="orders.php" class="btn btn-sm btn-primary mt-2">View Orders</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="white_card">
                    <div class="white_card_body">
                        <h5>Quick Actions</h5>
                        <div class="d-flex gap-3 flex-wrap mt-2">
                            <a href="add-products.php" class="btn btn-success">Add New Product</a>
                            <a href="view-products.php" class="btn btn-primary">Manage Products</a>
                            <a href="view-categories.php" class="btn btn-warning">Manage Categories</a>
                            <a href="view-sub-categories.php" class="btn btn-info">Manage Subcategories</a>
                            <a href="orders.php" class="btn btn-dark">View Orders</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php include("include/footer.php"); ?>
