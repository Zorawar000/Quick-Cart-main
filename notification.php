<?php
include("include/header.php");

if (empty($_SESSION['user_id'])) {
    echo "<script>window.location.href = 'login1.php';</script>";
    exit();
}

$user_id = $_SESSION['user_id'];
$limit = 10; // notifications per page
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Count total notifications for pagination
$count_query = "SELECT COUNT(*) as total FROM `notification_table` WHERE user_id = '$user_id'";
$count_result = mysqli_query($connect, $count_query);
$count_row = mysqli_fetch_assoc($count_result);
$total_notifications = $count_row['total'];
$total_pages = ceil($total_notifications / $limit);

// Fetch notifications with limit and offset
$query = "SELECT * FROM `notification_table` WHERE user_id = '$user_id' ORDER BY created_at DESC LIMIT $limit OFFSET $offset";
$result = mysqli_query($connect, $query);

?>

<div class="container my-5">
    <div class="row">
        <div class="col-lg-3 mb-4">
            <?php include("include/myaccount_dashboard.php"); ?>
        </div>
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Notifications</h5>
                </div>
                <div class="card-body">
                    <?php if (mysqli_num_rows($result) > 0): ?>
                        <ul class="list-group list-group-flush">
                            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center <?php echo $row['is_read'] ? '' : 'fw-bold'; ?>" data-id="<?php echo $row['id']; ?>">
                                    <div>
                                        <strong><?php echo htmlspecialchars($row['title'] ?? 'Notification'); ?></strong>
                                        <br>
                                        <span><?php echo htmlspecialchars($row['description'] ?? ''); ?></span>
                                        <br>
                                        <small class="text-muted">
                                            <?php echo isset($row['created_at']) ? date('d M Y, h:i A', strtotime($row['created_at'])) : ''; ?>
                                        </small>
                                    </div>
                                    <button class="btn btn-sm <?php echo $row['is_read'] ? 'btn-outline-primary' : 'btn-primary'; ?> mark-read-btn" data-read="<?php echo $row['is_read'] ? '1' : '0'; ?>">
                                        <?php echo $row['is_read'] ? 'Mark Unread' : 'Mark Read'; ?>
                                    </button>
                                </li>
                            <?php endwhile; ?>
                        </ul>

                        <!-- Pagination -->
                        <nav aria-label="Page navigation" class="mt-3">
                            <ul class="pagination justify-content-center">
                                <?php if($page > 1): ?>
                                    <li class="page-item"><a class="page-link" href="?page=<?php echo $page-1; ?>">Previous</a></li>
                                <?php endif; ?>

                                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                    <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                                        <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                    </li>
                                <?php endfor; ?>

                                <?php if($page < $total_pages): ?>
                                    <li class="page-item"><a class="page-link" href="?page=<?php echo $page+1; ?>">Next</a></li>
                                <?php endif; ?>
                            </ul>
                        </nav>

                    <?php else: ?>
                        <div class="alert alert-info mb-0">No notifications found.</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="js/jquery.js"></script>
<script>
$(document).ready(function(){
    $('.mark-read-btn').click(function(){
        let btn = $(this);
        let li = btn.closest('li');
        let notificationId = li.data('id');
        let currentReadStatus = btn.data('read'); // 0 ya 1

        let newReadStatus = currentReadStatus == 0 ? 1 : 0;

        $.ajax({
            url: 'mark_notification.php',
            method: 'POST',
            data: {
                id: notificationId,
                is_read: newReadStatus
            },
            success: function(response) {
                if(response.trim() == 'success') {
                    if(newReadStatus == 1) {
                        btn.removeClass('btn-primary').addClass('btn-outline-primary').text('Mark Unread').data('read', 1);
                        li.removeClass('fw-bold');
                    } else {
                        btn.removeClass('btn-outline-primary').addClass('btn-primary').text('Mark Read').data('read', 0);
                        li.addClass('fw-bold');
                    }
                } else {
                    alert('Failed to update notification status. Try again.');
                }
            }
        });

    });
});

</script>

<?php include("include/footer.php"); ?>
