<?php 
  include("include/header.php");
  
  // Pagination setup
  $items_per_page = 4;
  $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
  $page = max(1, $page); // Ensure page is at least 1
  $offset = ($page - 1) * $items_per_page;
  
  // Get total count
  $total_query = mysqli_query($connect, "SELECT COUNT(*) as total FROM ec_products");
  $total_row = mysqli_fetch_assoc($total_query);
  $total_items = $total_row['total'];
  $total_pages = ceil($total_items / $items_per_page);
  
  // Get paginated products
  $sql = "SELECT * FROM ec_products ORDER BY pro_id DESC LIMIT $items_per_page OFFSET $offset";
  $check = mysqli_query($connect, $sql);
?>

<div class="main_content_iner">
   <div class="container-fluid p-0">
      <div class="row justify-content-center">
         <div class="col-lg-12">
            <div class="card shadow-sm mb-4">
               <div class="card-header d-flex justify-content-between align-items-center">
                  <h5 class="mb-0">Product Table (Total: <?php echo $total_items; ?>)</h5>
                  <a href="add-products.php" class="btn btn-primary btn-sm">Add New</a>
               </div>

               <div class="card-body">
                  <div class="table-responsive">
                     <table class="table table-bordered table-striped table-hover align-middle">
                        <thead class="table-light">
                           <tr>
                              <th>#</th>
                              <th>Product ID</th>
                              <th>Product Name</th>
                              <th>Product Category</th>
                              <th>Product Sub Category</th>
                              <!-- <th>Product Description</th> -->
                              <th>Product Stock</th>
                              <th>Product MRP</th>
                              <th>Product Selling Price</th>
                              <th>Product Image</th>
                              <th>Product Meta Title</th>
                              <!--<th>Product Meta Description</th>-->
                              <!--<th>Product Meta Key</th>-->
                              <th>Slug URL</th>
                              <th>Status</th>
                              <th>Added On</th>
                              <th>Actions</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php 
                                if(mysqli_num_rows($check) > 0) {
                                    $sno = $offset + 1;
                                    while($result = mysqli_fetch_assoc($check)) {
                                        $statusText = ($result['status'] == 1) ? "Active" : "Inactive";
                                        echo "
                                            <tr>
                                                <td>".$sno++."</td>
                                                <td>".$result['pro_id']."</td>
                                                <td>".$result['pro_name']."</td>
                                                <td>".$result['pro_cate']."</td>
                                                <td>".$result['pro_sub_cate']."</td>
                                                <!-- <td>".$result['pro_desc']."</td> -->
                                                <td>".$result['stock']."</td>
                                                <td>".$result['mrp']."</td>
                                                <td>".$result['selling_price']."</td>
                                                <td><img src='../uploads/".$result['pro_image']."' alt='' width='60'></td>
                                                <td>".$result['meta_title']."</td>
                                                <!-- <td>".$result['meta_desc']."</td> -->
                                                <!-- <td>".$result['meta_key']."</td> -->
                                                <td>".$result['slug_url']."</td>
                                                <td>".$statusText."</td>
                                                <td>".$result['added_on']."</td>
                                                <td>
                                                    <a href='edit-products.php?pro_id=".$result['pro_id']."' class='btn btn-sm btn-warning'>Edit</a> &nbsp /&nbsp
                                                    <a href='delete-products.php?pro_id=".$result['pro_id']."' class='btn btn-sm btn-danger' onclick=\"return confirm('Are you sure you want to delete this product?');\">Delete</a>
                                                </td>
                                            </tr>
                                        ";
                                    }
                                } else {
                                    echo "<tr><td colspan='15' class='text-center'>No products found.</td></tr>";
                                }
                            ?>

                        </tbody>
                     </table>
                  </div>
                  
                  <!-- Pagination -->
                  <?php if($total_pages > 1): ?>
                  <nav aria-label="Page navigation" class="mt-3">
                     <ul class="pagination justify-content-center">
                        <?php if($page > 1): ?>
                           <li class="page-item">
                              <a class="page-link" href="?page=<?php echo ($page - 1); ?>">Previous</a>
                           </li>
                        <?php else: ?>
                           <li class="page-item disabled">
                              <span class="page-link">Previous</span>
                           </li>
                        <?php endif; ?>
                        
                        <?php
                        $start = max(1, $page - 2);
                        $end = min($total_pages, $page + 2);
                        
                        for($i = $start; $i <= $end; $i++):
                        ?>
                           <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                              <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                           </li>
                        <?php endfor; ?>
                        
                        <?php if($page < $total_pages): ?>
                           <li class="page-item">
                              <a class="page-link" href="?page=<?php echo ($page + 1); ?>">Next</a>
                           </li>
                        <?php else: ?>
                           <li class="page-item disabled">
                              <span class="page-link">Next</span>
                           </li>
                        <?php endif; ?>
                     </ul>
                     <div class="text-center mt-2">
                        <small class="text-muted">Page <?php echo $page; ?> of <?php echo $total_pages; ?></small>
                     </div>
                  </nav>
                  <?php endif; ?>
               </div>
            </div>
            <a href="index.php" class="btn btn-primary">Back To Dashboard</a>
         </div>
      </div>
   </div>
</div>

<?php include("include/footer.php"); ?>
