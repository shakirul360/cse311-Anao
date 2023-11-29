<?php include 'connectdb.php'; ?>


<nav class="navbar navbar-expand-lg navbar-light bg-white py-4 fixed-top">
    <div class="container-fluid">
        <a href="index.php" class="navbar-brand d-flex justify-content-between align-items-center">
            <img src="./images/anao-logo.svg" alt="Anao-logo" width="156px" height="26px">
        </a>

        <div class="nav-icons order-lg-2">
            <?php
            session_start();
            if (isset($_SESSION['customer_id']) && isset($_SESSION['customer_email'])) {
                $customerId = $_SESSION['customer_id'];
                $countsql = "SELECT SUM(`quantity`) FROM `cart` WHERE `customer_id`=$customerId";
                $countresult = mysqli_query($conn, $countsql);
                $countrow = mysqli_fetch_assoc($countresult);
                $count = $countrow['SUM(`quantity`)'];
                if (!$count) {
                    $count = 0;
                }
                echo '
                <a href="cart.php" class="btn position-relative ms-3">
                <i class="icon"><ion-icon name="cart-outline"></ion-icon></i>
                <span class="position-absolute top-0 badge bg-primary me-2">' . $count . '</span>
            </a>';
            }

            ?>
            <button type="button" class="btn position-relative ms-3">
                <i class="icon"><ion-icon name="person-outline"></ion-icon></i>
            </button>

            <?php
            // Customer is logged in, show logout button
            if (isset($_SESSION['customer_id']) && isset($_SESSION['customer_email'])) {
            ?>
                <a href="customer_logout.php" class="signup-btn px-4 ms-2 position-relative">Logout</a>
            <?php
            } else {
                // Customer is not logged in, show signup button
            ?>
                <a href="customer_login.php" class="signup-btn px-4 ms-2 position-relative">Signup/Login</a>
            <?php
            }
            ?>
        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu" aria-controls="#navMenu" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-lg-1" id="navMenu">
            <ul class="navbar-nav mx-auto text-center">
                <li class="nav-item px-3 py-3">
                    <a href="index.php" class="nav-link">Home</a>
                </li>
                <li class="nav-item px-3 py-3">
                    <a href="restaurants.php" class="nav-link">Restaurants</a>
                </li>
                <li class="nav-item px-3 py-3">
                    <a href="parcels.php" class="nav-link">Parcels</a>
                </li>
                <li class="nav-item px-3 py-3">
                    <a href="orders.php" class="nav-link">My Orders</a>
                </li>
                <li class="nav-item px-3 py-3">
                    <a href="about.php" class="nav-link">About</a>
                </li>
            </ul>

            <form class="search-form d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search for Restaurants" aria-label="Search">
                <button class="search-btn position-relative" type="submit">
                    <i class="icon"><ion-icon name="search-outline"></ion-icon></i>
                </button>
            </form>
        </div>
    </div>
</nav>
