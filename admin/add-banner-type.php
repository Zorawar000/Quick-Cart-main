<?php 
include("include/header.php"); 

if (empty($_SESSION['admin_username'])) {
    echo "<script>window.location.href = 'login.php';</script>";
    exit();
}
?>

<div class="main_content_iner">
    <div class="container-fluid p-0 sm_padding_15px">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="white_card card_height_100 mb_30">
                    <div class="white_card_header">
                        <div class="box_header m-0">
                            <div class="main-title">
                                <h3 class="m-0">Add Banner Type</h3>
                            </div>
                        </div>
                    </div>

                    <div class="white_card_body">
                        <div class="card-body">
                            <span id="msgform" class="text-danger mb-3 d-block text-center"></span>

                            <form id="banner_type_form"  method="post">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Banner Type Name</label>
                                        <input type="text" name="banner_type" class="form-control" 
                                               placeholder="Home Page Banner">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Page</label>
                                        <select name="page_name" class="form-control">
                                            <option value="">Choose Page</option>
                                            <option value="home">Home Page</option>
                                            <option value="about">About Page</option>
                                            <option value="contact">Contact Page</option>
                                            <option value="products">Products Page</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Banner Positions</label>
                                        <select name="banner_positions" class="form-control">
                                            <option value="">Choose...</option>
                                            <option value="top">Top</option>
                                            <option value="middle">Middle</option>
                                            <option value="bottom">Bottom</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Banner Description</label>
                                        <textarea name="banner_type_desc" id="banner_type_desc" class="form-control"rows="6" placeholder="Enter banner description here...">
                                        </textarea>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Status</label>
                                        <select name="status" class="form-control">
                                            <option value="">Choose...</option>
                                            <option value="1">Active</option>
                                            <option value="0">Deactive</option>
                                        </select>
                                    </div>

                                </div>

                                <button type="submit" class="btn btn-primary">
                                    Add Banner Type
                                </button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("include/footer.php"); ?>
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>

<script>
    CKEDITOR.replace('banner_type_desc', {
        height: 200,
        toolbar: [
            { name: 'basicstyles', items: ['Bold','Italic','Underline'] },
            { name: 'paragraph', items: ['NumberedList','BulletedList'] },
            { name: 'links', items: ['Link','Unlink'] },
            { name: 'styles', items: ['Format'] },
            { name: 'tools', items: ['Maximize'] }
        ]
    });
</script>

<script src="js/jquery.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$("#banner_type_form").validate({
    ignore: [], // 🔥 CKEditor ke liye important
    errorClass: "text-danger",
    rules: {
        banner_type: {
            required: true
        },
        page_name: {
            required: true
        },
        banner_positions: {
            required: true
        },
        banner_type_desc: {
            required: function () {
                CKEDITOR.instances.banner_type_desc.updateElement();
                return true;
            }
        },
        status: {
            required: true
        }
    },
    messages: {
        banner_type: "Please enter banner type name",
        page_name: "Please select page",
        banner_positions: "Please select banner position",
        banner_type_desc: "Please enter banner description",
        status: "Please select status"
    },
    submitHandler: function (form) {

        // 🔥 CKEditor sync before submit
        CKEDITOR.instances.banner_type_desc.updateElement();

        $.ajax({
            url: "banner_type_controller.php",
            type: "POST",
            data: $("#banner_type_form").serialize(),
            success: function (response) {
                if (response == 1) {
                    Swal.fire({
                        icon: "success",
                        title: "Success",
                        text: "Banner type added successfully",
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: response
                    });
                }
            }
        });
    }
});
</script>
