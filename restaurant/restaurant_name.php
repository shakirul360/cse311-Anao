<?php
            $restaurantID = $_SESSION['rest_id'];

            $query = "SELECT `restaurant_name` FROM `rest_reg` WHERE `id` = '$restaurantID'";
            $result = mysqli_query($conn, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $restName = $row['restaurant_name'];
                echo "<h1 style='margin-top: 98px;'>Welcome back <b>" . $restName . "</b></h1>";
            }
        
?>

