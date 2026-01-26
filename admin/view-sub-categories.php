<?php 
      include("include/header.php");
      
      // Pagination setup
      $items_per_page = 4;
      $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
      $page = max(1, $page);
      $offset = ($page - 1) * $items_per_page;
      
      // Get total count
      $total_query = mysqli_query($connect, "SELECT COUNT(*) as total FROM ec_sub_categories");
      $total_row = mysqli_fetch_assoc($total_query);
      $total_items = $total_row['total'];
      $total_pages = ceil($total_items / $items_per_page);
      
      // Get paginated sub-categories
      $sql = "SELECT * FROM ec_sub_categories ORDER BY id DESC LIMIT $items_per_page OFFSET $offset";
      $check = mysqli_query($connect, $sql);
?>
<div class="main_content_iner ">
   <div class="container-fluid p-0">
      <div class="row justify-content-center">
         <div class="col-lg-12">
            <div class="white_card card_height_100 mb_30">
               <div class="white_card_header">
                  <div class="box_header m-0">
                     <div class="main-title">
                        <h3 class="m-0">Sub-Category Table (Total: <?php echo $total_items; ?>)</h3>
                     </div>
                  </div>
               </div>
               <div class="white_card_body">
                  <div class="QA_section">
                     <div class="white_box_tittle list_header">
                        <div class="box_right d-flex lms_block">
                           <div class="add_button ms-2">
                              <!-- <a href="add-sub-categories.php" data-bs-toggle="modal" data-bs-target="#addcategory" class="btn_1">Add New</a> -->
                               
                              <a href="add-sub-categories.php" class="btn_1">Add New</a>
                           </div>
                        </div>
                     </div>
                     <div class="QA_table mb_30">
                        <table class="table lms_table_active ">
                           <thead>
                              <tr>
                                 <th scope="col">#</th>
                                 <th scope="col">Category ID</th>
                                 <th scope="col">Category Name</th>
                                 <th scope="col">Parent Category Name</th>
                                 <th scope="col">Slug URL</th>
                                 <th scope="col">Status</th>
                                 <th scope="col">Added On</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php 
                                    if(mysqli_num_rows($check) > 0) {
                                        $sno = $offset + 1;
                                        while($result = mysqli_fetch_assoc($check)){
                                           $parent_id = $result['parent_id'];
                                        $sql2 = "SELECT cate_name FROM `ec_categories` WHERE cate_id = $parent_id";
                                        $check2 = mysqli_query($connect,$sql2);
                                        $parent = mysqli_fetch_assoc($check2);
                                        $statusText = ($result['status'] == 1) ? "Active" : "Inactive";
                                           echo "<tr>
                                                    <td>".$sno++."</td>
                                                    <td>".$result['cate_id']."</td>
                                                    <td>".$result['cate_name']."</td>
                                                    <td>".($parent['cate_name'] ?? 'N/A')."</td>
                                                    <td>".$result['slug_url']."</td>
                                                    <td>".$statusText."</td>
                                                    <td>".$result['added_on']."</td>
                                                 </tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='7' class='text-center'>No sub-categories found.</td></tr>";
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
</div>
<?php include("include/footer.php");?>