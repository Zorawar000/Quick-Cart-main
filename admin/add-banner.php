<?php
include("include/header.php");

if (empty($_SESSION['admin_username'])) {
    echo "<script>window.location.href='login.php';</script>";
    exit();
}
else
    {
        $bannerTypes = $admin->getActiveBannerTypes($connect);
?>
<div class="main_content_iner">
    <div class="container-fluid p-0 sm_padding_15px">
        <div class="row justify-content-center">
            <div class="col-lg-12">

                <div class="white_card mb_30">
                    <div class="white_card_header">
                        <h3>Add New Banner</h3>
                    </div>

                    <div class="white_card_body">
                        <form id="banner_form" enctype="multipart/form-data">

                            <div class="row">

                                <!-- Banner Name -->
                                <div class="col-md-6 mb-3">
                                    <label>Banner Name</label>
                                    <input type="text" name="banner_name" class="form-control">
                                </div>

                                <!-- Banner Type (RELATION) -->
                                <div class="col-md-6 mb-3">
                                    <label>Banner Type</label>
                                    <select name="banner_type_id_ref" class="form-control">
                                        <option value="">Choose Banner Type</option>
                                        <?php while($bt = mysqli_fetch_assoc($bannerTypes)) { ?>
                                            <option value="<?= $bt['banner_type_id'] ?>">
                                                <?= $bt['banner_type'] ?> (<?= ucfirst($bt['page_name']) ?>)
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <!-- Banner Image -->
                                <div class="col-md-6 mb-3">
                                    <label>Banner Image</label>
                                    <input type="file" name="banner_image" class="form-control">
                                </div>

                                <!-- Redirect URL -->
                                <!-- <div class="col-md-6 mb-3">
                                    <label>Redirect URL</label>
                                    <input type="text" name="redirect_url" class="form-control"
                                        placeholder="https://example.com">
                                </div> -->

                                <!-- Display Order -->
                                <!-- <div class="col-md-6 mb-3">
                                    <label>Display Order</label>
                                    <input type="number" name="display_order" class="form-control" value="1">
                                </div> -->

                                <!-- Status -->
                                <div class="col-md-6 mb-3">
                                    <label>Status</label>
                                    <select name="status" class="form-control">
                                        <option value="">Choose...</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>

                            </div>

                            <button type="submit" class="btn btn-primary">
                                Add Banner
                            </button>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php include("include/footer.php"); ?>

<script src="js/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$("#banner_form").validate({
    errorClass: "text-danger",
    rules: {
        banner_name: {
            required: true
        },
        banner_type_id_ref: {
            required: true
        },
        banner_image: {
            required: true
        },
        display_order: {
            required: true
        },
        status: {
            required: true
        }
    },
    messages: {
        banner_name: "Please enter banner name",
        banner_type_id_ref: "Please select banner type",
        banner_image: "Please select banner image",
        status: "Please select status"
    },
    submitHandler: function (form) {

        let formData = new FormData(form);
        formData.append("add-banner", 1);

        $.ajax({
            url: "banner_controller.php",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response == 1) {
                    Swal.fire({
                        icon: "success",
                        title: "Success",
                        text: "Banner added successfully",
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

<?php } ?>