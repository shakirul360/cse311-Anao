<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Anao</title>

    <style>
        .parcel .send-parcel {
            padding: 12rem 0 2rem;
        }

        .parcel .send-parcel .title,
        .p {
            font-family: var(--font-family-1);
            padding: 1rem;
        }

        .parcel .send-parcel .title {
            font-family: var(--font-family-1);
            font-weight: 500;
            font-size: var(--h1);
            color: var(--textColorVermillion);
        }

        .parcel .send-parcel .subtitle {
            font-family: var(--font-family-1);
            font-weight: 400;
            font-size: var(--h3);
            color: var(--textColorPrimary);
        }

        .parcel-form {
            padding: 2rem 8rem;

        }

        .parcel-form .container {
            padding: 4rem 8rem;
            border: solid 2px;
            border-radius: 2rem;
            border-color: var(--primaryColor);
        }

        .parcel-form h1 {
            font-family: var(--font-family-1);
            font-weight: 500;
            font-size: var(--h1);
            color: var(--textColorVermillion);
        }

        .login form {
            font-size: 20px;
        }

        .login form .form-group {
            margin-bottom: 12px;
        }

        .login form input[type="submit"] {
            font-size: 20px;
            margin-top: 15px;
        }

        .footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
        }
    </style>


</head>

<body>
    <?php include './header_footer/customer_header.php'; ?>
    <?php include 'connectdb.php'; ?>



    <!-- Explore Restaurants -->
    <div class="parcel">
        <div class="send-parcel wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="text-content text-center">
                            <h2 class="title">Send Parcel</h2>
                            <p class="subtitle"> Send Parcels Safely with Anao.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="parcel-form d-flex justify-content-center">
        <div class="container">

            <h1 class="text-center">Parcel Details</h1>

            <form class="parcel-fields">
                <div class="form-group">
                    <label class="form-label" for="sender-name"><b>Sender Name:</b></label>
                    <input class="form-control" type="text" id="sender" required>
                </div>
                <div class="form-group was-validated">
                    <label class="form-label" for="password">Password</label>
                    <input class="form-control" type="password" id="password" required>
                    <div class="invalid-feedback">
                        Please enter your password
                    </div>
                </div>
                <div class="form-group form-check">
                    <input class="form-check-input" type="checkbox" id="check">
                    <label class="form-check-label" for="check">Remember me</label>
                </div>
                <input class="btn btn-success w-100" type="submit" value="SIGN IN">
            </form>

        </div>
    </div>




    <?php include './header_footer/customer_footer.php'; ?>


    <!-- Ion Icon integration -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <!-- Boootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>