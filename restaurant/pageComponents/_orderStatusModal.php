<?php
$statusModalSql = "SELECT * FROM `orders`";
$statusModalResult = mysqli_query($conn, $statusModalSql);

if (mysqli_num_rows($statusModalResult) > 0) {
    while ($statusModalRow = mysqli_fetch_assoc($statusModalResult)) {
        $orderid = $statusModalRow['orderId'];
        $custid = $statusModalRow['custId'];
        $orderStatus = $statusModalRow['order_status'];
?>

        <!-- Modal -->
        <div class="modal fade" id="orderStatus<?php echo $orderid; ?>" tabindex="-1" role="dialog" aria-labelledby="orderStatus<?php echo $orderid; ?>" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: rgb(111, 202, 203);">
                        <h5 class="modal-title" id="orderStatus<?php echo $orderid; ?>">Order Status and Delivery Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="pageComponents/_orderManage.php" method="post" style="border-bottom: 2px solid #dee2e6;">
                            <div class="text-left my-2">
                                <b><label for="status">Order Status</label></b>
                                <div class="row mx-2">
                                    <select class="form-control" name="status" id="status" required>
                                        <option value="Order Placed" <?php if ($orderStatus == "Order Placed") echo "selected"; ?>>Order Placed</option>
                                        <option value="Order Confirmed" <?php if ($orderStatus == "Order Confirmed") echo "selected"; ?>>Order Confirmed</option>
                                        <option value=" Order Preparing" <?php if ($orderStatus == "Order Preparing") echo "selected"; ?>>Preparing Order</option>
                                        <option value="On the way" <?php if ($orderStatus == "On the way") echo "selected"; ?>>On the Way</option>
                                        <option value="Order Delivered" <?php if ($orderStatus == "Order Delivered") echo "selected"; ?>>Order Delivered</option>
                                        <option value="Order Declined" <?php if ($orderStatus == "Order Declined") echo "selected"; ?>>Order Declined</option>
                                        <option value="Order Cancelled" <?php if ($orderStatus == "Order Cancelled") echo "selected"; ?>>Order Cancelled</option>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="orderId" value="<?php echo $orderid; ?>">
                            <button type="submit" class="btn btn-success mb-2" name="updateStatus">Update</button>
                        </form>

                        <form action="pageComponents/_orderManage.php" method="post">
                            <div class="text-left my-2">
                                <b><label for="name">Delivery Boy Name</label></b>

                                <select name="name" id="name" class="form-control" required>
                                    <option value="Shafin Islam">Shafin Islam</option>
                                    <option value="Sajjad Hossain">Sajjad Hossain</option>
                                    <option value="Tayyeb">Tayyeb</option>
                                    <option value="Nafis Shovon">Nafis Shovon</option>
                                    <option value="Hasib Rahman">Hasib Rahman</option>
                                    <option value="Jamil Sharkar">Jamil Sharkar</option>
                                    <option value="Porag Chowdhury">Porag Chowdhury</option>
                                    <option value="Ananta">Ananta</option>
                                    <option value="Bijoy Rahman">Bijoy Rahman</option>
                                    <option value="Jisan Islam">Jisan Islam</option>
                                </select>
                            </div>

                            <div class="text-left my-2 row">
                                <div class="form-group col-md-6">
                                    <b><label for="phone">Phone No</label></b>
                                    <select class="form-control" name="phone" id="phone">

                                        <option value="01751865812">Shafin Islam-01751865812</option>
                                        <option value="01854126987">Sajjad Hossain-01854126987</option>
                                        <option value="01547896321">Tayyeb-01547896321</option>
                                        <option value="01857965514">Nafis Shovon-01857965514</option>
                                        <option value="01325489652">Hasib Rahman-01325489652</option>
                                        <option value="01785412369">Jamil Sharkar-01785412369</option>
                                        <option value="01874526812">Porag Chowdhury-01874526812</option>
                                        <option value="01365985412">Ananta-01365985412</option>
                                        <option value="01654789521">Bijoy Rahman-01654789521</option>
                                        <option value="01754821567">Jisan Islam-01754821567</option>
                                    </select>


                                </div>
                                <div class="form-group col-md-6">
                                    <b><label for="time">Estimated Time (minutes)</label></b>
                                    <input class="form-control" id="time" name="time" type="number" min="1" max="120" required>
                                </div>
                            </div>
                            <input type="hidden" id="trackId" name="trackId" value="<?php echo $trackId; ?>">
                            <input type="hidden" id="orderId" name="orderId" value="<?php echo $orderid; ?>">

                            <button type="submit" class="btn btn-success" name="updateDeliveryDetails">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

<?php
    }
} else {
    // No rows found
    echo '<script>alert("No orders available.");</script>';
}
?>

<style>
    .popover {
        top: -77px !important;
    }
</style>

<script>
    $(document).ready(function() {
        $('[data-toggle="popover"]').popover();
    });

    const selectElement = document.getElementById('phone');
    selectElement.addEventListener('change', function() {
        const selectedOption = selectElement.value;
        const number = selectedOption.split('-')[1];
        console.log(number);
    });
</script>