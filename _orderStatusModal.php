<style>
    .card {
        position: relative;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid rgba(0, 0, 0, 0.1);
        border-radius: 0.10rem
    }

    .card-header:first-child {
        border-radius: calc(0.37rem - 1px) calc(0.37rem - 1px) 0 0
    }

    .card-header {
        padding: 0.75rem 1.25rem;
        margin-bottom: 0;
        background-color: #fff;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1)
    }

    .track {
        position: relative;
        background-color: #ddd;
        height: 7px;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        margin-bottom: 60px;
        margin-top: 50px
    }

    .track .step {
        -webkit-box-flex: 1;
        -ms-flex-positive: 1;
        flex-grow: 1;
        width: 25%;
        margin-top: -18px;
        text-align: center;
        position: relative
    }

    .track .step.active:before {
        background: #FF5722
    }

    .track .step::before {
        height: 7px;
        position: absolute;
        content: "";
        width: 100%;
        left: 0;
        top: 18px
    }

    .track .step.active .icon {
        background: #ee5435;
        color: #fff
    }

    .track .step.deactive:before {
        background: #030303;
    }

    .track .step.deactive .icon {
        background: #030303;
        color: #fff
    }

    .track .icon {
        display: inline-block;
        width: 40px;
        height: 40px;
        line-height: 40px;
        position: relative;
        border-radius: 100%;
        background: #ddd
    }

    .track .step.active .text {
        font-weight: 400;
        color: #000
    }

    .track .text {
        display: block;
        margin-top: 7px
    }

    .btn-warning {
        color: #ffffff;
        background-color: #ee5435;
        border-color: #ee5435;
        border-radius: 1px
    }

    .btn-warning:hover {
        color: #ffffff;
        background-color: #ff2b00;
        border-color: #ff2b00;
        border-radius: 1px
    }
</style>

<?php
$statusModalSql = "SELECT * FROM `orders`";
$statusModalResult = mysqli_query($conn, $statusModalSql);

if (mysqli_num_rows($statusModalResult) > 0) {
    while ($statusModalRow = mysqli_fetch_assoc($statusModalResult)) {
        $orderid = $statusModalRow['orderId'];
        $custid = $statusModalRow['custId'];
        $status = $statusModalRow['order_status'];

        if ($status == 'Order Placed') {
            $tstatus = "Order Placed.";
        } elseif ($status == 'Order Confirmed') {
            $tstatus = "Order Confirmed.";
        } elseif ($status == 'Order Preparing') {
            $tstatus = "Preparing your Order.";
        } elseif ($status == 'On the way') {
            $tstatus = "Your order is on the way!";
        } elseif ($status == 'Order Delivered') {
            $tstatus = "Order Delivered.";
        } elseif ($status == 'Order Denied') {
            $tstatus = "Order Denied.";
        } else {
            $tstatus = "Order Cancelled.";
        }

        $deliveryTime = '';
        $trackId = '';
        $deliveryBoyName = '';
        $deliveryBoyPhoneNo = '';

        if (in_array($status, ['Order Confirmed', 'Order Preparing', 'On the way', 'Order Delivered'])) {
            $deliveryDetailSql = "SELECT * FROM `deliverydetails` WHERE `orderId` = $orderid";
            $deliveryDetailResult = mysqli_query($conn, $deliveryDetailSql);

            if (mysqli_num_rows($deliveryDetailResult) > 0) {
                $deliveryDetailRow = mysqli_fetch_assoc($deliveryDetailResult);
                $trackId = $deliveryDetailRow['id'];
                $deliveryBoyName = $deliveryDetailRow['deliveryBoyName'];
                $deliveryBoyPhoneNo = $deliveryDetailRow['deliveryBoyPhoneNo'];
                $deliveryTime = $deliveryDetailRow['deliveryTime'];
                if ($status == 'Order Confirmed') {
                    $deliveryTime = 'xx';
                }
            }
        }
?>
        <!-- Modal -->
        <div class="modal fade" id="orderStatus<?php echo $orderid; ?>" tabindex="-1" role="dialog" aria-labelledby="orderStatus<?php echo $orderid; ?>" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="orderStatus<?php echo $orderid; ?>">Order Status</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="printThis">
                        <div class="container" style="padding-right: 0px;padding-left: 0px;">
                            <article class="card">
                                <div class="card-body">
                                    <h6><strong>Order ID:</strong> #<?php echo $orderid; ?></h6>
                                    <article class="card">
                                        <div class="card-body row">
                                            <div class="col"> <strong>Estimated Delivery time:</strong> <br><?php echo $deliveryTime; ?> minute </div>
                                            <div class="col"> <strong>Shipping By:</strong> <br> <?php echo $deliveryBoyName; ?></div>
                                            <div class="col"><strong>Phone Number:</strong> <?php echo $deliveryBoyPhoneNo; ?> </div>
                                            <div class="col"> <strong>Status:</strong> <br> <?php echo $tstatus; ?> </div>
                                            <div class="col"> <strong>Tracking #:</strong> <br> <?php echo $trackId; ?> </div>
                                        </div>
                                    </article>
                                    <div class="track">


                                        <div class="step <?php if ($status == 'Order Placed') echo 'active'; ?>"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Order Placed</span> </div>
                                        <div class="step <?php if ($status == 'Order Confirmed') echo 'active'; ?>"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Order Confirmed</span> </div>
                                        <div class="step <?php if ($status == 'Order Preparing') echo 'active'; ?>"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Order Preparing</span> </div>
                                        <div class="step <?php if ($status == 'On the way') echo 'active'; ?>"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">On the Way</span> </div>
                                        <div class="step <?php if ($status == 'Order Delivered') echo 'active'; ?>"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Order Delivered</span> </div>
                                    </div>
                                    <hr>

                                </div>
                            </article>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
}
?>