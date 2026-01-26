<?php 
include("include/header.php");

if(empty($_SESSION['admin_username'])) {
    echo "<script>window.location.href = 'login.php';</script>";
    exit();
} else {
    $categories = $admin->getCategories($connect);
?>
<div class="main_content_iner">
    <div class="container-fluid p-0 sm_padding_15px">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="white_card card_height_100 mb_30">
                    <div class="white_card_header">
                        <div class="box_header m-0">
                            <div class="main-title">
                                <h3 class="m-0">Add New Banner</h3>
                            </div>
                        </div>
                    </div>
                    <div class="white_card_body">
                        <div class="card-body">
                            <span id="msgform" class="text-danger mb-3 d-block text-center"></span>
                            <form id="product_form" enctype="multipart/form-data">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Banner Title</label>
                                        <input type="text" name="banner_title" class="form-control" placeholder="Product Name">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Parent Category</label>
                                        <select name="pro_cate" class="form-control" onchange="get_subcategories(this.value)">
                                            <option value="">--select--</option>
                                            <?php while($val = mysqli_fetch_assoc($categories)) { ?>
                                                <option value="<?php echo $val['cate_id']; ?>">
                                                    <?php echo ucwords($val['cate_name']); ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Sub Category</label>
                                        <select name="pro_sub_cate" id="subcate_id" class="form-control">
                                            <option value="">--select--</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Product Description</label>
                                        <textarea name="pro_desc" id="pro_desc" class="form-control"></textarea>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Stock</label>
                                        <input type="text" name="stock" class="form-control" placeholder="1234">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">MRP</label>
                                        <input type="text" name="mrp" class="form-control" placeholder="$800/-">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Selling Price</label>
                                        <input type="text" name="selling_price" class="form-control" placeholder="$1200/-">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Product Image</label>
                                        <input type="file" name="pro_image" class="form-control">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Meta Title</label>
                                        <input type="text" name="meta_title" class="form-control" placeholder="Meta Title">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Meta Keyword</label>
                                        <input type="text" name="meta_key" class="form-control" placeholder="Meta Keyword">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Meta Description</label>
                                        <input type="text" name="meta_desc" class="form-control" placeholder="Description">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Status</label>
                                        <select name="status" class="form-control">
                                            <option value="">Choose...</option>
                                            <option value="1">Active</option>
                                            <option value="0">Deactive</option>
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" name="add-product" class="btn btn-primary">Add Product</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- CKEditor -->
<script src="asset/js/ckeditor/ckeditor.js"></script>
<script>
$(document).ready(function() {
    function initEditor(){
        if (window.CKEDITOR && document.getElementById('pro_desc')) {
            if (CKEDITOR.instances['pro_desc']) { CKEDITOR.instances['pro_desc'].destroy(true); }
            CKEDITOR.replace('pro_desc', { height: 200 });
        }
    }
    if (!window.CKEDITOR) {
        var s = document.createElement('script');
        s.src = 'https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js';
        s.onload = initEditor;
        document.head.appendChild(s);
    } else {
        initEditor();
    }
});
</script>

<?php include("include/footer.php"); ?>

<!-- jQuery Validate + AJAX -->
<script src="js/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$('#product_form').validate({
    errorClass: "text-danger",
    rules:{
        pro_name: "required",
        pro_cate: "required",
        pro_sub_cate: "required",
        pro_desc: "required",
        stock: { required:true, number:true },
        mrp: { required:true, number:true },
        selling_price: { required:true, number:true },
        pro_image: "required",
        meta_title: "required",
        meta_key: "required",
        meta_desc: "required",
        status: "required"
    },
    messages:{
        pro_name: "Please enter product name",
        pro_cate: "Please select category",
        pro_sub_cate: "Please select sub category",
        pro_desc: "Please enter description",
        stock: "Please enter stock (numbers only)",
        mrp: "Please enter MRP (numbers only)",
        selling_price: "Please enter selling price (numbers only)",
        pro_image: "Please select product image",
        meta_title: "Please enter meta title",
        meta_key: "Please enter meta keyword",
        meta_desc: "Please enter meta description",
        status: "Please select status"
    },
    submitHandler: function(form) {
        if (window.CKEDITOR && CKEDITOR.instances['pro_desc']) {
            CKEDITOR.instances['pro_desc'].updateElement();
        }
        var formData = new FormData(form);
        formData.append('add-product', true); 
        $.ajax({
            url: 'product_controller.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(msg){
                if(msg == 1){
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Product added successfully!',
                        timer: 2000,
                        showConfirmButton: false
                    }).then(()=> window.location.reload());
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: msg
                    });
                }
            },
            error: function(){
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Something went wrong!'
                });
            }
        });
    }
});

// Dynamic subcategories using AdminFunctions function
function get_subcategories(cate_id){
    $.ajax({
        url: 'product_controller.php',
        type: 'POST',
        data: { get_subcategories:1, cate_id:cate_id },
        success: function(data){
            $('#subcate_id').html(data);
        }
    });
}
</script>

<?php } ?>
