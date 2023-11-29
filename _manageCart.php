<?php
include 'connectdb.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_id = $_SESSION['customer_id'];

    if (isset($_POST['addToCart'])) {
        $foodId = $_POST["foodId"];
        // Check whether this item exists
        $existSql = "SELECT * FROM `cart` WHERE food_id = '$foodId' AND `customer_id`='$customer_id'";
        $result = mysqli_query($conn, $existSql);
        $numExistRows = mysqli_num_rows($result);
        if ($numExistRows > 0) {
            echo "<script>
                    alert('Food Already Added.');
                    window.history.back(1);
                </script>";
            exit();
        } else {
            $sql = "INSERT INTO `cart` (`food_id`, `quantity`, `customer_id`, `date_added`) VALUES ('$foodId', '1', '$customer_id', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo "<script>
                    window.history.back(1);
                </script>";
                exit();
            }
        }
    }

    if (isset($_POST['removeItem'])) {
        $foodId = $_POST["foodId"];
        $sql = "DELETE FROM `cart` WHERE `food_id`='$foodId' AND `customer_id`='$customer_id'";
        $result = mysqli_query($conn, $sql);
        echo "<script>
                alert('Removed');
                window.history.back(1);
            </script>";
        exit();
    }

    if (isset($_POST['removeAllItem'])) {
        $sql = "DELETE FROM `cart` WHERE `customer_id`='$customer_id'";
        $result = mysqli_query($conn, $sql);
        echo "<script>
                alert('Removed All');
                window.history.back(1);
            </script>";
        exit();
    }

    if (isset($_POST['checkout'])) {
        $amount = $_POST["amount"];
        $address = $_POST["address"];
        $phone = $_POST["phone"];
        $password = $_POST["password"];
    
        $passSql = "SELECT * FROM customer_signup WHERE id='$customer_id'";
        $passResult = mysqli_query($conn, $passSql);
        $passRow = mysqli_fetch_assoc($passResult);
        $customerName = $passRow['fullname'];
    
        if (password_verify($password, $passRow['password'])) {
            $doSql = "SELECT * FROM `cart` WHERE `customer_id`='$customer_id'";
            $getResult = mysqli_query($conn, $doSql);
            $orderId = null;
            
            while ($getrow = mysqli_fetch_assoc($getResult)) {
                $food_Id = $getrow['food_id'];
                $food_quantity = $getrow['quantity'];

                $getRestaurantIdSql = "SELECT ResID FROM menu WHERE food_Id = '$food_Id'";
                $getRestaurantIdResult = mysqli_query($conn, $getRestaurantIdSql);
                $restaurantIdRow = mysqli_fetch_assoc($getRestaurantIdResult);
                $restaurantId = $restaurantIdRow['ResID'];
    
    
                // Insert the order details into the 'orders' table
                $insertOrderSql = "INSERT INTO `orders` (`custId`, `res_Id`, `quantity`, `totalPrice`, `address`, `phone_number`, `payment_method`, `date_of_purchase`) VALUES ('$customer_id', '$restaurantId', '$food_quantity', '$amount', '$address', '$phone', 'Cash On Delivery', current_timestamp())";
                $insertOrderResult = mysqli_query($conn, $insertOrderSql);
                
                if ($insertOrderResult) {
                    $orderId = mysqli_insert_id($conn);
                    
                    $foodId = $getrow['food_id'];
                    $foodQuantity = $getrow['quantity'];
                    $itemSql = "INSERT INTO `orderitems` (`orderId`, `foodId`, `food_quantity`) VALUES ('$orderId', '$foodId', '$foodQuantity')";
                    $itemResult = mysqli_query($conn, $itemSql);
                }
            }
            
            if ($orderId) {
                $deleteSql = "DELETE FROM `cart` WHERE `customer_id`='$customer_id'";
                $deleteResult = mysqli_query($conn, $deleteSql);
    
                echo '
                    <script>
                        alert("Thanks for ordering with us. Your order id is ' . $orderId . '.");
                        window.location.href = "http://localhost/anao_main/index.php";
                    </script>';
                exit();
            }
        } else {
            echo '<script>
                    alert("Incorrect Password! Please enter the correct password.");
                    window.history.back(1);
                </script>';
            exit();
        }
    }

    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        $foodId = $_POST['foodId'];
        $qty = $_POST['quantity'];
        $updatesql = "UPDATE `cart` SET `quantity`='$qty' WHERE `food_id`='$foodId' AND `customer_id`='$customer_id'";
        $updateresult = mysqli_query($conn, $updatesql);
    }
}
?>

