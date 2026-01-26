<?php 
include("include/header.php");

// Pagination setup
$items_per_page = 4;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max(1, $page);
$offset = ($page - 1) * $items_per_page;

// Get total count
$total_query = mysqli_query($connect, "SELECT COUNT(*) as total FROM new_project_table");
$total_row = mysqli_fetch_assoc($total_query);
$total_items = $total_row['total'];
$total_pages = ceil($total_items / $items_per_page);

// Fetch paginated users from DB
$sql = "SELECT * FROM `new_project_table` ORDER BY id DESC LIMIT $items_per_page OFFSET $offset";
$users = mysqli_query($connect, $sql);
?>

<div class="main_content_iner ">
   <div class="container-fluid p-0 sm_padding_15px">
      <div class="row justify-content-center">
         <div class="col-lg-12">
            <div class="white_card card_height_100 mb_30">
               <div class="white_card_header d-flex justify-content-between align-items-center">
                  <h3 class="m-0">All Users (Total: <?php echo $total_items; ?>)</h3>
                  <a href="add_user.php" class="btn btn-sm btn-primary">+ Add User</a>
               </div>

               <div class="white_card_body">
                  <div class="table-responsive">
                     <table class="table table-bordered table-hover text-center align-middle">
                        <thead class="table-dark">
                           <tr>
                              <th>#ID</th>
                              <th>Name</th>
                              <th>Email</th>
                              <th>Status</th>
                              <th>Actions</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php if (mysqli_num_rows($users) > 0) {
                              while ($user = mysqli_fetch_assoc($users)) { ?>
                                 <tr>
                                    <td><?php echo $user['user_id']; ?></td>
                                    <td><?php echo htmlspecialchars($user['first_name']." ".$user['last_name']); ?></td>
                                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                                    <td>
                                       <?php if ($user['status']) { ?>
                                          <span class="badge bg-success">Active</span>
                                       <?php } else { ?>
                                          <span class="badge bg-secondary">Inactive</span>
                                       <?php } ?>
                                    </td>
                                    <td>
                                       <a href="view-user.php?user_id=<?php echo $user['user_id']; ?>" class="btn btn-info btn-sm">View</a>
                                       <a href="edit-user.php?user_id=<?php echo $user['user_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                       <a href="delete-user.php?user_id=<?php echo $user['user_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?');">Delete</a>
                                    </td>
                                 </tr>
                           <?php }
                           } else { ?>
                              <tr>
                                 <td colspan="5">No users found.</td>
                              </tr>
                           <?php } ?>
                        </tbody>
                     </table>
                  </div> <!-- table-responsive -->
                  
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
                  
                  <a href="index.php" class="btn btn-primary">Back To Dashboard</a>
               </div> <!-- white_card_body -->
            </div> <!-- white_card -->
         </div>
      </div>
   </div>
</div>

<?php include("include/footer.php"); ?>
