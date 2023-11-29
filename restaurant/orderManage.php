<div class="container" style="margin-top: 98px; background: aliceblue;">
    <div class="table-wrapper">
        <div class="table-title" style="border-radius: 14px;">
            <div class="row">
                <div class="col-sm-4">
                    <h2><b>Order Details:</b></h2>
                </div>
                <div class="col-sm-8">
                    <a href="" class="btn btn-primary"><i class="material-icons">&#xE863;</i> <span>Refresh List</span></a>
                </div>
            </div>
        </div>

        <table class="table table-striped table-hover text-center" id="NoOrder">
            <thead style="background-color: rgb(111, 202, 203);">
                <tr>
                    <th>Order Id</th>
                    <th>Customer Id</th>
                    <th>Customer Address</th>
                    <th>Phone</th>
                    <th>Bill Amount</th>
                    <th>Payment Method</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Items</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'connectdb.php';

            
                $restaurantId = $_SESSION['rest_id'];

                $sql = "SELECT * FROM `orders` WHERE `res_Id`='$restaurantId'";
                $result = mysqli_query($conn, $sql);
                $numRows = mysqli_num_rows($result);

                if ($numRows == 0) {
                    echo '<tr><td colspan="9"><div class="alert alert-info alert-dismissible fade show" role="alert" style="width:100%">You have not received any orders!</div></td></tr>';
                } else {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $orderId = $row['orderId'];
                        $customerId = $row['custId'];
                        $address = $row['address'];
                        $phone = $row['phone_number'];
                        $amount = $row['totalPrice'];
                        $paymentMethod = $row['payment_method'];
                        $orderDate = $row['date_of_purchase'];
                        $status = $row['order_status'];

                        echo '<tr>
                        <td>' . $orderId . '</td>
                        <td>' . $customerId . '</td>
                        <td data-toggle="tooltip" title="' . $address . '">' . substr($address, 0, 20) . '...</td>
                        <td>' . $phone . '</td>
                        <td>' . $amount . '</td>
                        <td>' . $paymentMethod . '</td>
                        <td>' . $orderDate . '</td>
                        <td><a href="#" data-toggle="modal" data-target="#orderStatus' . $orderId . '" class="view"><i class="material-icons">&#xE5C8;</i></a></td>
                        <td><a href="#" data-toggle="modal" data-target="#orderItem' . $orderId . '" class="view" title="View Details"><i class="material-icons">&#xE5C8;</i></a></td>
                    </tr>';
                    }
               }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
include 'pageComponents/_orderItemModal.php';
include 'pageComponents/_orderStatusModal.php';
?>

<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="./pageComponents/orderpagestyle.css">

<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
