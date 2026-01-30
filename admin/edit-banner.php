<?php
include("include/header.php");

if (empty($_SESSION['admin_username'])) {
    echo "<script>window.location.href='login.php';</script>";
    exit();
}

if (!isset($_GET['id'])) {
    echo "<script>window.location.href='view-banner.php';</script>";
    exit();
}

$banner_id = intval($_GET['id']);

// Fetch banner data
$result = $admin->getBannerById($connect, $banner_id);
$row = mysqli_fetch_assoc($result);

// Update submit
if (isset($_POST['update'])) {

    $_POST['banner_id'] = $banner_id;
    $update = $admin->updateBanner($connect);

    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';

    if ($update === true) {
        echo "
        <script>
        Swal.fire({
            icon: 'success',
            title: 'Updated!',
            text: 'Banner updated successfully',
            confirmButtonColor: '#28a745'
        }).then(() => {
            window.location.href = 'view-banner.php';
        });
        </script>
        ";
    } else {
        echo "
        <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Banner update failed. Please try again.',
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
                <h3>Edit Banner</h3>
            </div>

            <div class="white_card_body">
                <form method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label>Banner Name</label>
                        <input type="text" name="banner_name" class="form-control"
                               value="<?= htmlspecialchars($row['banner_name']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Banner Type</label>
                        <select name="banner_type_id_ref" class="form-control" required>
                            <option value="">-- Select --</option>
                            <?php
                            $types = $admin->getActiveBannerTypes($connect);
                            while ($bt = mysqli_fetch_assoc($types)) {
                                $selected = ($bt['banner_type_id'] == $row['banner_type_id_ref']) ? 'selected' : '';
                                echo "<option value='{$bt['banner_type_id']}' $selected>
                                        {$bt['banner_type']} ({$bt['page_name']})
                                      </option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Current Banner Image</label><br>
                        <img src="../uploads/<?= $row['banner_image']; ?>" width="200" class="mb-2">
                    </div>

                    <div class="form-group">
                        <label>Change Banner Image (optional)</label>
                        <input type="file" name="banner_image" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="1" <?= ($row['status']==1)?'selected':''; ?>>Active</option>
                            <option value="0" <?= ($row['status']==0)?'selected':''; ?>>Inactive</option>
                        </select>
                    </div>

                    <button type="submit" name="update" class="btn btn-success">
                        Update Banner
                    </button>

                    <a href="view-banner.php" class="btn btn-secondary">Back</a>

                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php include("include/footer.php"); ?>
