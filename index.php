<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Anao</title>
</head>

<body>
    <?php include './header_footer/customer_header.php'; ?>
    <?php include 'connectdb.php'; ?>

    <!-- Hero Section -->

    <div id="banner-carousel" class="carousel slide" data-bs-ride="carousel" style="padding-top: 100px;">
        <div class="carousel-inner">

            <div class="carousel-item active c-item" data-bs-interval="10000">
                <img src="./images/pexels-andre-saddi-14441569.jpg" class="d-block w-100 c-img" alt="...">
                <div class="carousel-caption top-0 mt-4 ">
                    <p class="mt-5 fs-3 h1">Do more with our platform
                    <p>
                    <h1 class="display-1">All in one Delivery Solution</h1>
                    <a href="restaurants.php" class="hero-btn py-3">Order Now</a>
                </div>
            </div>
            <div class="carousel-item c-item" data-bs-interval="2000">
                <img src="./images/pexels-caleb-oquendo-3023476.jpg" class="d-block w-100 c-img" alt="...">
                <div class="carousel-caption top-0 mt-4 ">
                    <p class="mt-5 fs-3 h1">Send Parcels Locally
                    <p>
                    <h1 class="display-1">Parcel Delivery is Safer with Anao</h1>
                    <a href="parcels.php" class="hero-btn py-3">Send Parcel</a>
                </div>
            </div>
            <div class="carousel-item c-item">
                <img src="./images/pexels-engin-akyurt-2725744.jpg" class="d-block w-100 c-img" alt="...">
                <div class="carousel-caption top-0 mt-4 ">
                    <p class="mt-5 fs-3 h1">Browse Restaurants
                    <p>
                    <h1 class="display-1">Your favourite restaurants are now in Anao</h1>
                    <a href="restaurants.php" class="hero-btn py-3">Browse</a>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#banner-carousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#banner-carousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>


    <!-- Explore Restaurants -->
    <section id="explore-restaurants">
        <div class="explore-restaurants wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="text-content text-center">
                            <h2 class="title">Explore Restaurants</h2>
                            <p class="subtitle"> Check out your favourite restaurants all in one place. Order food from your favourite restaurants and we will deliver it to your doorstep.</p>
                        </div>
                    </div>
                </div>


                <div class="row pt-5">
                    <?php
                    $sql = "SELECT * FROM `rest_reg`";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $restId = $row['id'];
                        $restName = $row['restaurant_name'];
                        $desc = $row['description'];

                        echo '
                      <div class="col-md-6 col-lg-3 mb-5">
                          <div class="card h-100">
                              <img src="./images/card-' . $restId . '.jpg" class="img-fluid img" alt="restaurant image">
                              <div class="pt-3 card-body d-flex flex-column">
                                  <h4 class="card-title">' . $restName . '</h4>
                                  <p class="card-text" style="font-size: 16px">' . substr($desc, 0, 30) . '...</p>
                                  <div class="mt-auto justify-content-end">
                                      <button class="card-btn me-2 mb-2"> <a href="restaurant_menu.php?restid=' . $restId . '" style="text-decoration: none; color:white;">Details</a></button>
                                  </div>
                              </div>
                          </div>
                      </div>';
                    }
                    ?>
                </div>





            </div>
        </div>
    </section>


    <section>
        <?php include './header_footer/customer_footer.php'; ?>
    </section>

    <!-- Ion Icon integration -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <!-- Boootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>