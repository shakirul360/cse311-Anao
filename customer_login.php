<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="./admin/style.css">
</head>

<body>

    <!----------------------- Main Container -------------------------->

    <div class="container d-flex justify-content-center align-items-center min-vh-100">

        <!----------------------- Login Container -------------------------->

        <div class="row border rounded-5 p-3 bg-white shadow box-area">

            <!--------------------------- Left Box ----------------------------->

            <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="background: #D35532;">
                <div class="featured-image mb-3">
                    <img src="./images/anao-logo.svg" class="img-fluid logo" style="width: 250px;">
                </div>
            </div>

            <!-------------------- ------ Right Box ---------------------------->

            <div class="col-md-6 right-box">
                <div class="row align-items-center">
                    <div class="header-text mb-4">
                        <h2>Login & Start Exploring</h2>
                    </div>


                    <form action="validateCustomerLogin.php" class="needs-validation" method="post" style="width: 100%;" novalidate>

                        <?php if (isset($_GET['error'])) { ?>
                            <div class="alert alert-danger" role="alert">
                                <?= htmlspecialchars($_GET['error']) ?>
                            </div>
                        <?php } ?>


                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Your email address" value="<?php if (isset($_GET['email'])) echo (htmlspecialchars($_GET['email'])); ?>" required>
                            <div class="invalid-feedback">Invalid email format or domain</div>
                        </div>

                        <div class="mb-3">
                            <label for="pass" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="pass" placeholder="Password">
                        </div>

                        <button type="submit" class="btn admin_name btn-primary" id="loginBtn">Login</button>
                    </form>
                </div>

                <div class="mt-3">
                    <p>Don't Have and Account? <a href="customer_signup.php" style="text-decoration: none; color:#D35532;">Signup Now</a></p>
                </div>
            </div>

        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
