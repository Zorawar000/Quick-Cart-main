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

$banner_id = mysqli_real_escape_string($connect, $_GET['id']);
$delete = mysqli_query($connect, "DELETE FROM ec_banners WHERE banner_id='$banner_id'");

// 🔥 Load SweetAlert FIRST
echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';

if ($delete) {
    echo "
    <script>
    Swal.fire({
        icon: 'success',
        title: 'Deleted!',
        text: 'Banner deleted successfully',
        confirmButtonColor: '#28a745'
    }).then(() => {
        window.location.href = 'view-banner.php';
    });
    </script>
    ";
}
?>
