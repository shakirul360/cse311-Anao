<?php
$showAlert = false;
$showError = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'connectdb.php';
    
    $username = $_POST["userName"];
    $fullName = $_POST["fullName"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    
    // Check whether this username exists
    $existUsernameSql = "SELECT * FROM `customer_signup` WHERE `username` = '$username'";
    $resultUsername = mysqli_query($conn, $existUsernameSql);
    $numExistUsernameRows = mysqli_num_rows($resultUsername);
    
    // Check whether this email exists
    $existEmailSql = "SELECT * FROM `customer_signup` WHERE `email` = '$email'";
    $resultEmail = mysqli_query($conn, $existEmailSql);
    $numExistEmailRows = mysqli_num_rows($resultEmail);
    
    if ($numExistUsernameRows > 0) {
        $showError = "Username Already Exists";
        header("Location: /anao_main/index.php?signupsuccess=false&error=$showError");
    } elseif ($numExistEmailRows > 0) {
        $showError = "Email Already Exists";
        header("Location: /anao_main/index.php?signupsuccess=false&error=$showError");
    } else {
        if ($password == $cpassword) {
            $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `customer_signup` (`username`, `fullname`, `phone_number`, `email`, `password`) VALUES ('$username', '$fullName', '$phone', '$email', '$hashed_pass')";   
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $showAlert = true;
                header("Location: /anao_main/customer_login.php?signupsuccess=true");
            }
        } else {
            $showError = "Passwords do not match";
            header("Location: /anao_main/index.php?signupsuccess=false&error=$showError");
        }
    }
}

    
?>