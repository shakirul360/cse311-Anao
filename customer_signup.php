<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="./admin/style.css">
</head>

<body>

    <!----------------------- Main Container -------------------------->

    <div class="container d-flex justify-content-center align-items-center min-vh-100">

        <!----------------------- Login Container -------------------------->

        <div class="row border rounded-5 p-3 bg-white shadow box-area" style="width: 100%; margin: 0 auto;">

            <!--------------------------- Left Box ----------------------------->

            <div class="col-md-6 col-xs-12 rounded-4  d-flex justify-content-center align-items-center flex-column left-box" style="background: #D35532;">
                <div class="featured-image mb-3">
                    <img src="./images/anao-logo.svg" class="img-fluid logo" style="width: 250px;">
                </div>
            </div>

            <!-------------------- ------ Right Box ---------------------------->

            <div class="col-md-6 col-xs-12 p-4">
                <div class="row align-items-center">
                    <div class="header-text mb-2">
                        <h2>Signup with Anao</h2>
                        <p>Start exploring with Anao</p>
                    </div>


                    <form action="validateCustomerSignup.php" method="post" style="width: 100%">

                        <?php if (isset($_GET['error'])) { ?>
                            <div class="alert alert-danger" role="alert">
                                <?= htmlspecialchars($_GET['error']) ?>
                            </div>
                        <?php } ?>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <b><label for="username" class="form-label">Username:</label></b>
                                    <input class="form-control" id="username" name="userName" placeholder="Choose a unique Username" type="text" required minlength="3" maxlength="11">
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="mb-3">
                                    <b><label for="fullName" class="form-label">Full Name:</label></b>
                                    <input class="form-control" id="fullName" name="fullName" placeholder="Enter your Full Name" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <b><label for="email" class="form-label">Email:</label></b>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Your Email" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <b><label for="phone" class="form-label">Phone No:</label></b>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon">+880</span>
                                        </div>
                                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter Your Phone Number" required pattern="[0-9]{11}" maxlength="11">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-box input-group">
                                    <input class="form-control" id="password" name="password" placeholder="Enter Password" type="password" required data-toggle="password" minlength="6" maxlength="21">
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                        <i class="far fa-eye-slash" id="eyeicon" style="color: white"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="cpassword" class="form-label">Confirm Password</label>
                                <div class="input-box input-group">
                                    <input type="password" placeholder="Confirm Password" class="form-control" name="cpassword" id="cpassword">
                                    <button class="btn btn-outline-secondary" type="button" id="toggleCPassword">
                                        <i class="far fa-eye-slash" id="eyeCIcon" style="color: white"></i>
                                    </button>
                                </div>
                            </div>

                            



                        </div>

                        <button type="submit" class="btn admin_name btn-primary" style="width: 100%">Signup
                        </button>
                    </form>

                    <p class="mb-0 mt-5">Already have an account? <a href="customer_login.php" style="text-decoration: none; color:#D35532;">Login here</a>.</p>
                </div>
            </div>
        </div>
    </div>

    <!--JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>



    <script>
        let toggleCPassword = document.getElementById("toggleCPassword");
        let cpassword = document.getElementById("cpassword");

        let togglePassword = document.getElementById("togglePassword");
        let password = document.getElementById("password");

        toggleCPassword.addEventListener("click", function() {
            if (cpassword.type === "password") {
                cpassword.type = "text";
                eyeCIcon.classList.remove("fa-eye-slash");
                eyeCIcon.classList.add("fa-eye");
            } else {
                cpassword.type = "password";
                eyeCIcon.classList.remove("fa-eye");
                eyeCIcon.classList.add("fa-eye-slash");
            }
        })

        togglePassword.addEventListener("click", function() {
            if (password.type === "password") {
                password.type = "text";
                eyeicon.classList.remove("fa-eye-slash");
                eyeicon.classList.add("fa-eye");
            } else {
                password.type = "password";
                eyeicon.classList.remove("fa-eye");
                eyeicon.classList.add("fa-eye-slash");
            }
        })
    </script>
</body>

</html>