<?php
   include("include/header.php");
   
   if (empty($_SESSION['admin_username'])) {
       echo "<script>window.location.href='login.php';</script>";
       exit();
   }
   
   $banners = $admin->getAllBanners($connect, 'banner');
   ?>
<div class="main_content_iner">
   <div class="container-fluid p-0 sm_padding_15px">
      <div class="row justify-content-center">
         <div class="col-lg-12">
            <div class="white_card mb_30">
               <div class="white_card_header d-flex justify-content-between">
                  <h3>Banner List</h3>
                  <a href="add-banner.php" class="btn btn-primary btn-sm">+ Add Banner</a>
               </div>
               <div class="white_card_body">
                  <div class="table-responsive">
                     <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                           <tr>
                              <th>#</th>
                              <th>Banner ID</th>
                              <th>Banner Name</th>
                              <th>Banner Type</th>
                              <th>Banner Positions</th>
                              <th>Page</th>
                              <th>Preview</th>
                              <th>Status</th>
                              <th>Added On</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php if(mysqli_num_rows($banners) > 0){ 
                              $i=1;
                              while($row = mysqli_fetch_assoc($banners)) { ?>
                           <tr>
                              <td><?= $i++; ?></td>
                              <td><?= htmlspecialchars($row['banner_type_id']); ?></td>
                              <td><?= htmlspecialchars($row['banner_name']); ?></td>
                              <td><?= htmlspecialchars($row['banner_type']); ?></td>
                              <td>
                                    <?php
                                        if ($row['banner_positions'] == 1) {
                                            echo 'Top';
                                        } elseif ($row['banner_positions'] == 2) {
                                            echo 'Middle';
                                        } elseif ($row['banner_positions'] == 3) {
                                            echo 'Bottom';
                                        } else {
                                            echo '-';
                                        }
                                    ?>
                                </td>

                              <td><?= ucfirst($row['page_name']); ?></td>
                              <!-- Preview -->
                              <td>
                                 <a href="<?= $row['redirect_url']; ?>" 
                                    target="_blank"
                                    class="btn btn-info btn-sm">
                                 View
                                 </a>
                              </td>
                              <!-- Status -->
                              <td>
                                 <?php if($row['type_status'] == 1){ ?>
                                 <span class="badge bg-success">Active</span>
                                 <?php } else { ?>
                                 <span class="badge bg-danger">Inactive</span>
                                 <?php } ?>
                              </td>
                              <td><?= date('d M Y', strtotime($row['type_added_on'])); ?></td>
                           </tr>
                           <?php } } else { ?>
                           <tr>
                              <td colspan="7" class="text-center text-danger">
                                 No banners found
                              </td>
                           </tr>
                           <?php } ?>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php include("include/footer.php"); ?>