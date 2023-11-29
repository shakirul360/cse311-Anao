<?php
session_start();
include 'connectdb.php';

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email)) {
        header("Location: /anao_main/restaurant/restaurant_login.php?error=Email is required");
        exit;
    } elseif (empty($password)) {
        header("Location: /anao_main/restaurant/restaurant_login.php?error=Password is required");
        exit;
    }

    $sql = "SELECT * FROM `rest_reg` WHERE `email`=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $rest = mysqli_fetch_assoc($result);

        $rest_id = $rest['id'];
        $rest_email = $rest['email'];
        $rest_password = $rest['password'];
        $rest_name = $rest['restaurant_name'];

        if (password_verify($password, $rest_password)) {
            $_SESSION['rest_id'] = $rest_id;
            $_SESSION['rest_email'] = $rest_email;
            $_SESSION['rest_name'] = $rest_name;
            
            header("Location: index.php");
            exit;
        } else {
            header("Location: /anao_main/restaurant/restaurant_login.php?error=Incorrect email or password");
            exit;
        }
    } else {
        header("Location: /anao_main/restaurant/restaurant_login.php?error=Incorrect email or password");
        exit;
    }
} else {
    header("Location: /anao_main/restaurant/restaurant_login.php");
    exit;
}

?>
