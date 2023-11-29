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


    <!-- Explore Restaurants -->
    <section id="explore-restaurants" style="margin-top: 100px;">
        <div class="explore-restaurants wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="text-content text-center">
                            <h2 class="title">Restaurants in Anao</h2>
                            <p class="subtitle">Your favourite restaurants all in one place. Order food from your favourite restaurants and we will deliver it to your doorstep.</p>
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
                              <img src="images/card-' . $restId . '.jpg" class="img-fluid img" alt="restaurant image">
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

    <!-- Ion Icon integration -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <!-- Boootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>