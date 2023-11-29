<?php
session_start();
include 'connectdb.php';

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email)) {
        header("Location: customer_login.php?error=Email is required");
        exit;
    } elseif (empty($password)) {
        header("Location: customer_login.php?error=Password is required");
        exit;
    }

    $sql = "SELECT * FROM `customer_signup` WHERE `email`=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $customer = mysqli_fetch_assoc($result);

        $customer_id = $customer['id'];
        $customer_email = $customer['email'];
        $customer_password = $customer['password'];

        if (password_verify($password, $customer_password)) {
            $_SESSION['customer_id'] = $customer_id;
            $_SESSION['customer_email'] = $customer_email;
            
            header("Location: index.php");
            exit;
        } else {
            header("Location: customer_login.php?error=Incorrect email or password");
            exit;
        }
    } else {
        header("Location: customer_login.php?error=Incorrect email or password");
        exit;
    }
} else {
    header("Location: customer_login.php");
    exit;
}
?>
