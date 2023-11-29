<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

</head>

<body>

    <!----------------------- Main Container -------------------------->

    <div class="container d-flex justify-content-center align-items-center min-vh-100">

        <!----------------------- Login Container -------------------------->

        <div class="row border rounded-5 p-3 bg-white shadow box-area">

            <!--------------------------- Left Box ----------------------------->

            <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="background: #D35532;">
                <div class="featured-image mb-3">
                    <img src="./anao-logo.svg" class="img-fluid logo" style="width: 250px;">
                </div>
            </div>

            <!-------------------- ------ Right Box ---------------------------->

            <div class="col-md-6 right-box">
                <div class="row align-items-center">
                    <div class="header-text mb-4">
                        <h2>Login to Dashboard</h2>
                    </div>


                    <form action="validateRestLogin.php" class="needs-validation" method="post" style="width: 100%;" novalidate>

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
                            <label for="password" class="form-label">Password</label>
                            <div class="input-box input-group">
                                <input class="form-control" id="password" name="password" placeholder="Enter Password" type="password" required data-toggle="password" minlength="6" maxlength="21">
                            </div>
                        </div>

                        <button type="submit" class="btn admin_name btn-primary" id="loginBtn">Login</button>
                    </form>
                </div>

                <div class="mt-3">
                    <p>Not a registered Restaurant? <a href="/anao_main/restaurant/restaurant_signup.php" style="text-decoration: none; color:#D35532;">Register Now</a></p>
                </div>
            </div>

        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>