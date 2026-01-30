<?php
   include("include/header.php");
   
   if (empty($_SESSION['admin_username'])) {
       echo "<script>window.location.href='login.php';</script>";
       exit();
   }
   
   $banners = $admin->getAllBannersType($connect);
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
                              <th>Banner Type ID</th>
                              <th>Banner Name</th>
                              <th>Banner Type</th>
                              <th>Banner Positions</th>
                              <th>Banner Description</th>
                              <th>Banner Type Slug URL</th>
                              <th>Status</th>
                              <th>Added On</th>
                              <th>Actions</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php if(mysqli_num_rows($banners) > 0){ 
                              $i=1;
                              while($row = mysqli_fetch_assoc($banners)) { ?>
                           <tr>
                              <td><?php echo $i++; ?></td>
                              <td><?php echo htmlspecialchars($row['banner_type_id']); ?></td>
                              <td><?php echo htmlspecialchars($row['page_name']); ?></td>
                              <td><?php echo htmlspecialchars($row['banner_type']); ?></td>
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
                                <td>
                                <?= ucfirst(strip_tags($row['banner_type_desc'])); ?>
                                </td>

                              <td><?php echo htmlspecialchars($row['banner_slug_url']); ?></td>
                              <!-- Status -->
                              <td>
                                 <?php if($row['status'] == 1){ ?>
                                 <span class="badge bg-success">Active</span>
                                 <?php } else { ?>
                                 <span class="badge bg-danger">Inactive</span>
                                 <?php } ?>
                              </td>
                              <td><?php echo date('d M Y', strtotime($row['added_on'])); ?></td>
                              <td>
                                 <a href="edit-banner-type.php?id=<?= $row['banner_type_id']; ?>" 
                                    class="btn btn-sm btn-warning">
                                     <i class="fa fa-edit"></i> Edit
                                 </a>

                                 <button 
                                    class="btn btn-sm btn-danger"
                                    onclick="deleteBannerType('<?= $row['banner_type_id']; ?>')">
                                     <i class="fa fa-trash"></i> Delete
                                 </button>
                               </td>

                           </tr>
                           <?php } } else { ?>
                           <tr>
                              <td colspan="10" class="text-center text-danger">
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function deleteBannerType(bannerTypeId) {
    Swal.fire({
        title: 'Are you sure?',
        text: "This banner will be permanently deleted!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "delete-banner-type.php?id=" + bannerTypeId;
        }
    });
}
</script>
