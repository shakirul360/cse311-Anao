<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Restaurant Menu</title>
    <style>
        .jumbotron {
            padding: 2rem 1rem;
        }


        .card {
            border: 1.5;
            border-color: var(--borderColor);
            border-radius: 8px;
            background-color: var(--bgColorWhite);
            transition: all 0.2s ease;
        }

        .card:hover {
            filter: drop-shadow(0px 8px 32px var(--cardShadow));
            border-color: var(--borderColorHover);
        }

        .card .img-fluid {
            height: 240px;
            border: 0;
            border-radius: 8px 8px 0 0;
            object-fit: cover;
        }


        .card .restaurant-category {
            position: relative;
            font-family: var(--font-family-2);
            font-size: var(--h5);
            font-weight: 300;
            color: var(--primaryColor);
            background: var(--bgColorWhite);
            border-radius: 4px;
            width: max-content;
            height: max-content;
            top: 0;
        }

        .card .card-body .card-btn {
            border: 0;
            background-color: var(--bgColorVermillion);
            color: var(--textColorWhite);
            border-radius: 4px;
            padding: 12px 16px;
            font-family: var(--font-family-2);
            font-size: var(--h4);
            font-weight: 400;
        }

        .category-title {
            background-color: orange;
            padding: 8px;
            margin-bottom: 20px;
        }

        .category-title h2 {
            color: white;
            font-size: 24px;
            font-weight: bold;
            margin: 0;
            text-transform: capitalize;
        }
    </style>
</head>

<body>
    <?php require './header_footer/customer_header.php' ?>
    <?php include 'connectdb.php'; ?>

    <?php
    $id = $_GET['restid'];
    $sql = "SELECT * FROM `rest_reg` WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $restname = $row['restaurant_name'];
        $restDesc = $row['description'];



        echo '
        <div class="container" style="margin-top: 180px; margin-bottom: 50px">
            <h1 class="text-center" style="border: solid 2px; padding: 8px">' . $restname . ' Menu</h1>
        </div>';
    }
    ?>

    <div class="modal fade" id="notLoggedInModal" tabindex="-1" aria-labelledby="notLoggedInModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="notLoggedInModalLabel">Alert</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <p class="h4">You are not logged in or signed up.</p>
                    <p class="h4">Please <a href="./customer_login.php" style="color: hsl(13, 65%, 51%)">Login</a> or <a href="./customer_signup.php" style="color: hsl(13, 65%, 51%)">Sign up</a> to place an order.</p>
                </div>
            </div>
        </div>
    </div>


    <div class="container my-3" id="cont">
        <?php
        $id = $_GET['restid'];
        $sql = "SELECT * FROM `menu` WHERE ResID = $id ORDER BY category";
        $result = mysqli_query($conn, $sql);
        $noResult = true;
        $currentCategory = '';

        while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;
            $foodId = $row['food_Id'];
            $foodtype = $row['category'];
            $foodName = $row['food_name'];
            $foodPrice = $row['price'];
            $foodDesc = $row['description'];

            if ($currentCategory !== $foodtype) {
                $currentCategory = $foodtype;

                echo '<div class="category-title">
                        <h2 class="text-left">' . ucfirst($currentCategory) . '</h2>
                    </div>';
            }



            echo '<div class="row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-4">
                <div class="col-md-6 col-lg-3 mb-5">
                    <div class="card h-100">
                        <img src="/anao_main/restaurant/images/food-' . $foodId . '.jpg" class="img-fluid img" alt="restaurant image">
                        <div class="pt-3 card-body d-flex flex-column">
                            <h4 class="card-title">' . $foodName . '</h4>
                            <p class="card-text" style="font-size: 16px">' . substr($foodDesc, 0, 30) . '...</p>
                            
                            <div class="mt-auto justify-content-end">';



            if (isset($_SESSION['customer_id']) && isset($_SESSION['customer_email'])) {
                $customerId = $_SESSION['customer_id'];
                $quaSql = "SELECT `quantity` FROM `cart` WHERE food_id = '$foodId' AND `customer_id`='$customerId'";
                $quaresult = mysqli_query($conn, $quaSql);
                $quaExistRows = mysqli_num_rows($quaresult);
                if ($quaExistRows == 0) {
                    echo '<form action="_manageCart.php" method="POST">
                              <input type="hidden" name="foodId" value="' . $foodId . '">
                              <button class="card-btn me-2 mb-2 addToCartBtn" type="submit"  name="addToCart" data-toggle="modal" data-target="#notLoggedInModal" style="text-decoration: none; color:white;">Add to Cart</button>
                          </form>';
                } else {
                    echo '<a href="cart.php"><button class="card-btn me-2 mb-2" data-toggle="modal" data-target="#notLoggedInModal">Go to Cart</button></a>';
                }
            } else {
                echo '<button class="card-btn me-2 mb-2 addToCartBtn" type="button" name="addToCart" data-toggle="modal" data-target="#notLoggedInModal" style="text-decoration: none; color:white;">Add to Cart</button>';
            }

            echo '</div>
                        </div>
                    </div>
                </div>
            </div>';
        }

        if ($noResult) {
            echo '<div class="jumbotron jumbotron-fluid">
                    <div class="container">
                        <p class="display-4">Sorry, no items available in this category.</p>
                        <p class="lead">We will update soon.</p>
                    </div>
                </div>';
        }
        ?>
    </div>

    <!-- Ion Icon integration -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <!-- JavaScript and other scripts go here -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>


    <script>
        $(document).ready(function() {
            // Add click event to the "Add to Cart" buttons
            $('.addToCartBtn').click(function() {
                // Check if user is not logged in
                <?php
                if (!isset($_SESSION['customer_id']) && !isset($_SESSION['customer_email'])) {
                    echo '$("#notLoggedInModal").modal("show");';  // Show the modal
                }
                ?>
            });

            // Add click event to the close modal button
            $('#notLoggedInModal .btn-close').click(function() {
                $("#notLoggedInModal").modal("hide"); // Hide the modal
            });
        });
    </script>


</body>

</html>