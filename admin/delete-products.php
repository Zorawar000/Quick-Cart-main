<?php
include("include/header.php");

if (!isset($_GET['pro_id'])) {
    echo "<div class='alert alert-danger text-center my-4'>Invalid Product Request!</div>";
    include("include/footer.php");
    exit;
}

$id = intval($_GET['pro_id']);

// ✅ पहले product check करें
$query = mysqli_query($connect, "SELECT * FROM `ec_products` WHERE pro_id='$id'");
$product = mysqli_fetch_assoc($query);

if (!$product) {
    echo "<div class='alert alert-warning text-center my-5'>Product not found!</div>";
    include("include/footer.php");
    exit;
}

// ✅ अगर confirm delete button दबाया गया है
if (isset($_POST['confirm_delete'])) {

    // ✅ पहले image delete करें (अगर मौजूद है)
    if (!empty($product['pro_image']) && file_exists("../uploads/" . $product['pro_image'])) {
        unlink("../uploads/" . $product['pro_image']);
    }

    // ✅ अब database से record delete करें
    $deleteQuery = mysqli_query($connect, "DELETE FROM `ec_products` WHERE pro_id='$id'");

    if ($deleteQuery) {
        echo "<script>alert('Product deleted successfully!'); window.location='view-products.php';</script>";
        exit;
    } else {
        echo "<div class='alert alert-danger text-center my-4'>Error deleting product!</div>";
    }
}
?>

<div class="main_content_iner">
   <div class="container my-5">
      <div class="card shadow-sm border-danger">
         <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Delete Product</h5>
            <a href="view-products.php" class="btn btn-light btn-sm">← Back</a>
         </div>

         <div class="card-body text-center">
            <h5 class="mb-3 text-danger">Are you sure you want to delete this product?</h5>

            <div class="border rounded p-3 bg-light mb-3">
               <h6 class="fw-bold mb-2"><?php echo htmlspecialchars($product['pro_name']); ?></h6>
               <p class="mb-1 text-muted"><?php echo htmlspecialchars($product['pro_desc']); ?></p>
               <p class="mb-1"><strong>MRP:</strong> ₹<?php echo htmlspecialchars($product['mrp']); ?> | 
                  <strong>Selling Price:</strong> ₹<?php echo htmlspecialchars($product['selling_price']); ?></p>
               <?php if (!empty($product['pro_image'])) { ?>
                  <div class="mt-3">
                     <img src="../uploads/<?php echo $product['pro_image']; ?>" alt="Product Image" class="img-thumbnail" width="120">
                  </div>
               <?php } ?>
            </div>

            <form method="POST">
               <button type="submit" name="confirm_delete" class="btn btn-danger px-4 me-2">Yes, Delete</button>
               <a href="view-products.php" class="btn btn-secondary px-4">Cancel</a>
            </form>
         </div>
      </div>
   </div>
</div>

<?php include("include/footer.php"); ?>
