<?php
include 'connectdb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['updateStatus'])) {
        // Update order status
        $orderId = $_POST['orderId'];
        $status = $_POST['status'];

        $sql = "UPDATE `orders` SET `order_status`='$status' WHERE `orderId`='$orderId'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo "<script>alert('Update successful');
                window.location=document.referrer;
                </script>";
        } else {
            echo "<script>alert('Update failed: " . mysqli_error($conn) . "');
                window.location=document.referrer;
                </script>";
        }
    }

    if (isset($_POST['updateDeliveryDetails'])) {
        // Update or assign delivery details
        $orderId = $_POST['orderId'];
        $name = $_POST['name'];
        $time = $_POST['time'];
        $phone = $_POST['phone'];

        // Check if delivery details exist for the orderId
        $checkSql = "SELECT * FROM `deliverydetails` WHERE `orderId`='$orderId'";
        $checkResult = mysqli_query($conn, $checkSql);

        if (mysqli_num_rows($checkResult) > 0) {
            // Update existing delivery details
            $sql = "UPDATE `deliverydetails` SET `deliveryBoyName`='$name', `deliveryBoyPhoneNo`='$phone', `deliveryTime`='$time', `dateTime`=current_timestamp() WHERE `orderId`='$orderId'";
            $result = mysqli_query($conn, $sql);
        } else {
            // Insert new delivery details
            $sql = "INSERT INTO `deliverydetails` (`orderId`, `deliveryBoyName`, `deliveryBoyPhoneNo`, `deliveryTime`, `dateTime`) VALUES ('$orderId', '$name', '$phone', '$time', current_timestamp())";
            $result = mysqli_query($conn, $sql);
        }

        // Check the result of the update/insert operation
        if ($result) {
            echo "<script>alert('Update successful');
                window.location=document.referrer;
                </script>";
        } else {
            echo "<script>alert('Update failed: " . mysqli_error($conn) . "');
                window.location=document.referrer;
                </script>";
        }
    }
}

?>
