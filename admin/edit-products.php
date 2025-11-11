<?php
include("include/header.php");

if (!isset($_GET['pro_id'])) {
    echo "<div class='alert alert-danger'>Invalid Product Request!</div>";
    exit;
}

$id = $_GET['pro_id'];
$query = mysqli_query($connect, "SELECT * FROM `ec_products` WHERE pro_id='$id'");
$product = mysqli_fetch_assoc($query);

if (!$product) {
    echo "<div class='alert alert-warning text-center my-5'>Product not found!</div>";
    include("include/footer.php");
    exit;
}

// ✅ Update logic
if (isset($_POST['update_product'])) {
    $name  = mysqli_real_escape_string($connect, $_POST['pro_name']);
    $desc  = mysqli_real_escape_string($connect, $_POST['pro_desc']);
    $stock = intval($_POST['stock']);
    $mrp   = floatval($_POST['mrp']);
    $sell  = floatval($_POST['selling_price']);
    $meta_title = mysqli_real_escape_string($connect, $_POST['meta_title']);
    $meta_desc  = mysqli_real_escape_string($connect, $_POST['meta_desc']);
    $meta_key   = mysqli_real_escape_string($connect, $_POST['meta_key']);
    $slug_url   = mysqli_real_escape_string($connect, $_POST['slug_url']);
    $status = $_POST['status'] == '1' ? 1 : 0;

    // --- Image handling ---
    $imageName = $product['pro_image']; // default old image

    if (!empty($_FILES['pro_image']['name'])) {
        $imgName = $_FILES['pro_image']['name'];
        $tmpName = $_FILES['pro_image']['tmp_name'];
        $ext = pathinfo($imgName, PATHINFO_EXTENSION);
        $newName = "product_" . time() . "." . $ext;
        $uploadPath = "../uploads/" . $newName;

        if (move_uploaded_file($tmpName, $uploadPath)) {
            // delete old image if exists
            if (!empty($product['pro_image']) && file_exists("../uploads/" . $product['pro_image'])) {
                unlink("../uploads/" . $product['pro_image']);
            }
            $imageName = $newName;
        }
    }

    // ✅ Update all fields
    $update = "UPDATE `ec_products` SET 
                pro_name='$name',
                pro_desc='$desc',
                stock='$stock',
                mrp='$mrp',
                selling_price='$sell',
                meta_title='$meta_title',
                meta_desc='$meta_desc',
                meta_key='$meta_key',
                slug_url='$slug_url',
                pro_image='$imageName',
                status='$status'
               WHERE pro_id='$id'";

    if (mysqli_query($connect, $update)) {
        echo "<script>alert('Product updated successfully!'); window.location='view-products.php';</script>";
        exit;
    } else {
        echo "<div class='alert alert-danger'>Error updating product!</div>";
    }
}
?>

<div class="main_content_iner">
   <div class="container my-4">
      <div class="card shadow-sm">
         <div class="card-header bg-warning d-flex justify-content-between align-items-center">
            <h5 class="mb-0 text-white">Edit Product</h5>
            <a href="view-products.php" class="btn btn-light btn-sm">← Back</a>
         </div>
         <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
               <div class="row g-3">

                  <div class="col-md-6">
                     <label class="form-label">Product Name</label>
                     <input type="text" name="pro_name" class="form-control" required value="<?php echo htmlspecialchars($product['pro_name']); ?>">
                  </div>

                  <div class="col-md-6">
                     <label class="form-label">Stock</label>
                     <input type="number" name="stock" class="form-control" required value="<?php echo htmlspecialchars($product['stock']); ?>">
                  </div>

                  <div class="col-md-6">
                     <label class="form-label">MRP</label>
                     <input type="number" name="mrp" step="0.01" class="form-control" required value="<?php echo htmlspecialchars($product['mrp']); ?>">
                  </div>

                  <div class="col-md-6">
                     <label class="form-label">Selling Price</label>
                     <input type="number" name="selling_price" step="0.01" class="form-control" required value="<?php echo htmlspecialchars($product['selling_price']); ?>">
                  </div>

                  <div class="col-md-12">
                     <label class="form-label">Description</label>
                     <textarea name="pro_desc" class="form-control" rows="3"><?php echo htmlspecialchars($product['pro_desc']); ?></textarea>
                  </div>

                  <!-- ✅ Meta Fields -->
                  <div class="col-md-6">
                     <label class="form-label">Meta Title</label>
                     <input type="text" name="meta_title" class="form-control" value="<?php echo htmlspecialchars($product['meta_title']); ?>">
                  </div>

                  <div class="col-md-6">
                     <label class="form-label">Meta Description</label>
                     <input type="text" name="meta_desc" class="form-control" value="<?php echo htmlspecialchars($product['meta_desc']); ?>">
                  </div>

                  <div class="col-md-6">
                     <label class="form-label">Meta Key</label>
                     <input type="text" name="meta_key" class="form-control" value="<?php echo htmlspecialchars($product['meta_key']); ?>">
                  </div>

                  <div class="col-md-6">
                     <label class="form-label">Slug URL</label>
                     <input type="text" name="slug_url" class="form-control" value="<?php echo htmlspecialchars($product['slug_url']); ?>">
                  </div>

                  <!-- ✅ Image Upload Section -->
                  <div class="col-md-6">
                     <label class="form-label">Product Image</label>
                     <input type="file" name="pro_image" class="form-control" accept="image/*">
                     <?php if (!empty($product['pro_image'])) { ?>
                        <div class="mt-2">
                           <p class="text-muted small mb-1">Current Image:</p>
                           <img src="../uploads/<?php echo $product['pro_image']; ?>" alt="Product Image" class="img-thumbnail" width="120">
                        </div>
                     <?php } ?>
                  </div>

                  <!-- ✅ Status Dropdown -->
                  <div class="col-md-6">
                     <label class="form-label">Status</label>
                     <select name="status" class="form-select">
                        <option value="1" <?php echo ($product['status'] == 1) ? 'selected' : ''; ?>>Active</option>
                        <option value="0" <?php echo ($product['status'] == 0) ? 'selected' : ''; ?>>Inactive</option>
                     </select>
                  </div>

                  <div class="col-12 text-center mt-3">
                     <button type="submit" name="update_product" class="btn btn-success px-4">Update Product</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>

<?php include("include/footer.php"); ?>
