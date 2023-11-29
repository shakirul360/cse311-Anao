<?php
$showAlert = false;
$showError = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'connectdb.php';
    
    $restname = $_POST["restName"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $restype = $_POST["restType"];
    $location = $_POST["location"];
    $desc = $_POST["description"];

    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    
    // Check whether this username exists
    $existRestnameSql = "SELECT * FROM `rest_reg` WHERE `restaurant_name` = '$restname'";
    $resultRestname = mysqli_query($conn, $existRestnameSql);
    $numExistRestnameRows = mysqli_num_rows($resultRestname);
    
    // Check whether this email exists
    $existEmailSql = "SELECT * FROM `rest_reg` WHERE `email` = '$email'";
    $resultEmail = mysqli_query($conn, $existEmailSql);
    $numExistEmailRows = mysqli_num_rows($resultEmail);
    
    if ($numExistRestnameRows > 0) {
        $showError = "Restauant Name Already Exists";
        header("Location: /anao_main/restaurant/index.php?signupsuccess=false&error=$showError");
    } elseif ($numExistEmailRows > 0) {
        $showError = "Email Already Exists";
        header("Location: /anao_main/restaurant/index.php?signupsuccess=false&error=$showError");
    } else {
        if ($password == $cpassword) {
            $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `rest_reg` (`restaurant_name`,`type`,`location`,`email`,`contact_no`,`description`,`password`) VALUES ('$restname', '$restype', '$location', '$email','$phone', '$desc', '$hashed_pass')";   
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $showAlert = true;
                header("Location: /anao_main/restaurant/index.php?signupsuccess=true");
            }
        } else {
            $showError = "Passwords do not match";
            header("Location: /anao_main/restaurant/index.php?signupsuccess=false&error=$showError");
        }
    }
}

    
?>