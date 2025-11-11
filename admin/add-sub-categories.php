<?php 
      include("include/header.php");

      
        if(empty($_SESSION['admin_username']))
        {
            echo "<script>window.location.href = 'login.php';</script>";
            exit();
        }
        else
        {
            $sub_categories = $admin->getCategories($connect);
?>
<div class="main_content_iner ">
   <div class="container-fluid p-0 sm_padding_15px">
      <div class="row justify-content-center">
         <div class="col-lg-12">
            <div class="white_card card_height_100 mb_30">
               <div class="white_card_header">
                  <div class="box_header m-0">
                     <div class="main-title">
                        <h3 class="m-0">Fill all the categories details</h3>
                     </div>
                  </div>
               </div>
               <div class="white_card_body">
                  <div class="card-body">
                     <span id="msgform" class="text-danger mb-3 d-block text-center"></span>
                     <form action="functions.php" method="post" id="sub_category_form">
                        <div class="row mb-3">
                           <div class="col-md-6 mb-3">
                              <label class="form-label" for="parent_id">Parent Category</label>
                              <select name="parent_id" class="form-control"id="parent_id">
                                 <option value="">--select--</option>
                                    <?php foreach($sub_categories as $val){ ?>
                                 <option value="<?php echo $val['cate_id']; ?>"><?php echo ucwords($val['cate_name']); ?></option>
                                 <?php } ?>
                              </select>
                           </div>
                           <div class="col-md-6">
                              <label class="form-label" for="cate_name">Category Name</label>
                              <input type="text" name="cate_name" class="form-control" id="cate_name" placeholder="Category">
                           </div>
                           <div class="col-md-6 mb-3">
                              <label class="form-label" for="meta_title">Meta Title</label>
                              <input type="text" name="meta_title" class="form-control" id="meta_title" placeholder="Meta Title">
                           </div>
                           <div class="col-md-6 mb-3">
                              <label class="form-label" for="meta_key">Meta Keyword</label>
                              <input type="text" name="meta_key" class="form-control" id="meta_key" placeholder="Meta Keyword">
                           </div>
                           <div class="col-md-6 mb-3">
                              <label class="form-label" for="meta_desc">Meta Description</label>
                              <input type="text" name="meta_desc" class="form-control" id="meta_desc" placeholder="Description">
                           </div>                                    
                           <div class="col-md-6 mb-3">
                              <label class="form-label" for="status">Status</label>
                              <select id="status" name="status" class="form-control">
                                 <option value="">Choose...</option>
                                 <option value="1">Active</option>
                                 <option value="0">Deactive</option>
                              </select>
                           </div>
                        </div>
                        <button type="submit" name="add-sub-categories" class="btn btn-primary">Add Category</button>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php include("include/footer.php");?>

<script src="js/jquery.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$('#sub_category_form').validate({
    errorClass: "text-danger",
    rules:{
        parent_id: "required",
        cate_name:"required",
        meta_title:"required",
        meta_key:"required",
        meta_desc:"required",
        status:"required"
    },
    messages:{
        parent_id: "Please select parent category",
        cate_name:"Please enter category name",
        meta_title:"Please enter meta title",
        meta_key:"Please enter meta keyword",
        meta_desc:"Please enter meta description",
        status:"Please select status"
    },
    submitHandler: function(form) {
        $.ajax({
            url: "sub_category_controller.php",
            type: "POST",
            data: $('#sub_category_form').serialize(),
            success: function(msg){
                if (msg == 1) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Category added successfully!',
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: msg
                    });
                }
            }
        });
    }
});


</script>

<?php } ?>