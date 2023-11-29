<?php
session_start();

if (!isset($_SESSION['admin_id']) && !isset($_SESSION['admin_name'])) {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Login</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        <link rel="stylesheet" href="./style.css">
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
                            <h2>Admin Login</h2>
                        </div>


                        <form action="validatelogin.php" method="post" style="width: 30rem">

                            <?php if (isset($_GET['error'])) { ?>
                                <div class="alert alert-danger" role="alert">
                                    <?= htmlspecialchars($_GET['error']) ?>
                                </div>
                            <?php } ?>


                            <div class="mb-3">
                                <label for="name" class="form-label">Admin Name</label>
                                <input type="name" name="adminName" placeholder="Admin Name" value="<?php if (isset($_GET['adminName'])) echo (htmlspecialchars($_GET['adminName'])) ?>" class="form-control" id="name">
                            </div>


                            <div class="mb-3">
                                <label for="pass" class="form-label">Password</label>
                                <div class="input-box input-group">
                                    <input type="password" placeholder="Enter Password" class="form-control" name="password" id="pass">
                                </div>
                            </div>


                            <button type="submit" class="btn admin_name btn-primary">LOGIN</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
        <!-- JavaScript -->

    </body>

    </html>

<?php
} else {
    header("Location: admindashboard.php");
}
?>