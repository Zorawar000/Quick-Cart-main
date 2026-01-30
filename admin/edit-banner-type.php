<?php
include("include/header.php");

if (empty($_SESSION['admin_username'])) {
    echo "<script>window.location.href='login.php';</script>";
    exit();
}

if (!isset($_GET['id'])) {
    echo "<script>window.location.href='view-banner-type.php';</script>";
    exit();
}

$banner_type_id = intval($_GET['id']);

// Fetch data using function
$result = $admin->getBannerTypeById($connect, $banner_type_id);
$row = mysqli_fetch_assoc($result);

// Update submit
if (isset($_POST['update'])) {

    $_POST['banner_type_id'] = $banner_type_id;

    $update = $admin->updateBannerType($connect);

    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
    
    if ($update == 1 || $update === null) {
        echo "
        <script>
        Swal.fire({
            icon: 'success',
            title: 'Updated!',
            text: 'Banner Type Updated Successfully',
            confirmButtonColor: '#28a745'
        }).then(() => {
            window.location.href = 'view-banner-type.php';
        });
        </script>
        ";
    } else {
        echo "
        <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Banner Type update failed. Please try again.',
            confirmButtonColor: '#dc3545'
        });
        </script>
        ";
    }
}

?>

<div class="main_content_iner">
    <div class="container-fluid p-0">
        <div class="white_card mb_30">
            <div class="white_card_header">
                <h3>Edit Banner Type</h3>
            </div>

            <div class="white_card_body">
                <form method="post">

                    <div class="form-group">
                        <label>Page Name</label>
                        <input type="text" name="page_name" class="form-control"
                               value="<?= htmlspecialchars($row['page_name']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Banner Type</label>
                        <input type="text" name="banner_type" class="form-control"
                               value="<?= htmlspecialchars($row['banner_type']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Banner Position</label>
                        <select name="banner_positions" class="form-control">
                            <option value="1" <?= ($row['banner_positions']==1)?'selected':''; ?>>Top</option>
                            <option value="2" <?= ($row['banner_positions']==2)?'selected':''; ?>>Middle</option>
                            <option value="3" <?= ($row['banner_positions']==3)?'selected':''; ?>>Bottom</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="banner_type_desc" class="form-control editor" rows="6"><?= htmlspecialchars($row['banner_type_desc']); ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="1" <?= ($row['status']==1)?'selected':''; ?>>Active</option>
                            <option value="0" <?= ($row['status']==0)?'selected':''; ?>>Inactive</option>
                        </select>
                    </div>

                    <button type="submit" name="update" class="btn btn-success">
                        Update Banner Type
                    </button>

                    <a href="view-banner-type.php" class="btn btn-secondary">Back</a>

                </form>
            </div>
        </div>
    </div>
</div>

<?php include("include/footer.php"); ?>
<script>
$(document).ready(function() {
    $('.editor').summernote({
        height: 200
    });
});
</script>

