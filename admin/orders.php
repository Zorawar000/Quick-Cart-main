<?php
include("include/header.php");

// Admin login check
if(empty($_SESSION['admin_username'])){
    echo "<script>window.location.href = 'login.php';</script>";
    exit();
} else {
    // Pagination setup
    $items_per_page = 4;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $page = max(1, $page);
    $offset = ($page - 1) * $items_per_page;
    
    // Get total count
    $total_query = mysqli_query($connect, "SELECT COUNT(*) as total FROM ec_orders");
    $total_row = mysqli_fetch_assoc($total_query);
    $total_items = $total_row['total'];
    $total_pages = ceil($total_items / $items_per_page);
    
    // Fetch paginated orders
    $orders_query = mysqli_query($connect, "SELECT o.order_id, o.customer_name, o.total_amount, o.status, o.created_at 
                                           FROM ec_orders o
                                           ORDER BY o.created_at DESC
                                           LIMIT $items_per_page OFFSET $offset");
?>
<div class="main_content_iner">
    <div class="container-fluid p-0 sm_padding_15px">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="white_card card_height_100 mb_30">
                    <div class="white_card_header">
                        <div class="box_header m-0">
                            <div class="main-title">
                                <h3 class="m-0">Orders List (Total: <?php echo $total_items; ?>)</h3>
                            </div>
                        </div>
                    </div>
                    <div class="white_card_body">
                        <div class="card-body">
                            <table class="table table-bordered table-striped" id="orders_table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Order ID</th>
                                        <th>Customer Name</th>
                                        <th>Total Amount</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $count = 1;
                                    while($order = mysqli_fetch_assoc($orders_query)){ ?>
                                    <tr>
                                        <td><?php echo $count++; ?></td>
                                        <td><?php echo $order['order_id']; ?></td>
                                        <td><?php echo ucwords($order['customer_name']); ?></td>
                                        <td>$<?php echo number_format($order['total_amount'], 2); ?></td>
                                        <td>
                                            <?php 
                                                if($order['status'] == 1) echo '<span class="badge bg-success">Completed</span>';
                                                else if($order['status'] == 0) echo '<span class="badge bg-warning">Pending</span>';
                                                else echo '<span class="badge bg-danger">Cancelled</span>';
                                            ?>
                                        </td>
                                        <td><?php echo date("d M, Y", strtotime($order['created_at'])); ?></td>
                                        <td>
                                            <a href="view_order.php?id=<?php echo $order['order_id']; ?>" class="btn btn-sm btn-primary">View</a>
                                            <button class="btn btn-sm btn-danger delete-order" data-id="<?php echo $order['order_id']; ?>">Delete</button>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Pagination -->
                        <?php if($total_pages > 1): ?>
                        <nav aria-label="Page navigation" class="mt-3">
                           <ul class="pagination justify-content-center">
                              <?php if($page > 1): ?>
                                 <li class="page-item">
                                    <a class="page-link" href="?page=<?php echo ($page - 1); ?>">Previous</a>
                                 </li>
                              <?php else: ?>
                                 <li class="page-item disabled">
                                    <span class="page-link">Previous</span>
                                 </li>
                              <?php endif; ?>
                              
                              <?php
                              $start = max(1, $page - 2);
                              $end = min($total_pages, $page + 2);
                              
                              for($i = $start; $i <= $end; $i++):
                              ?>
                                 <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                 </li>
                              <?php endfor; ?>
                              
                              <?php if($page < $total_pages): ?>
                                 <li class="page-item">
                                    <a class="page-link" href="?page=<?php echo ($page + 1); ?>">Next</a>
                                 </li>
                              <?php else: ?>
                                 <li class="page-item disabled">
                                    <span class="page-link">Next</span>
                                 </li>
                              <?php endif; ?>
                           </ul>
                           <div class="text-center mt-2">
                              <small class="text-muted">Page <?php echo $page; ?> of <?php echo $total_pages; ?></small>
                           </div>
                        </nav>
                        <?php endif; ?>
                    </div>
                </div>
                <a href="index.php" class="btn btn-primary">Back To Dashboard</a>
            </div>
        </div>
    </div>
</div>

<?php include("include/footer.php"); ?>

<!-- Datatables & SweetAlert -->
<script src="./asset/vendors/datatable/./asset/js/jquery.dataTables.min.js"></script>
<script src="./asset/vendors/datatable/./asset/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function(){
    // Remove DataTable pagination since we're using custom pagination
    // $('#orders_table').DataTable({
    //     responsive: true
    // });

    // Delete order
    $('.delete-order').click(function(){
        var order_id = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "This will delete the order permanently!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if(result.isConfirmed){
                $.ajax({
                    url: 'order_controller.php',
                    type: 'POST',
                    data: { delete_order:1, order_id: order_id },
                    success:function(response){
                        if(response == 1){
                            Swal.fire(
                                'Deleted!',
                                'Order has been deleted.',
                                'success'
                            ).then(()=> location.reload());
                        } else {
                            Swal.fire('Error!', response, 'error');
                        }
                    }
                });
            }
        });
    });
});
</script>
<?php } ?>