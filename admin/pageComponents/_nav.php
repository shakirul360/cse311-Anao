    <header class="header" id="header">
        <div class="header__toggle">
            <i class='bx bx-menu' id="header-toggle"></i>
        </div>
        
        <div class="header__img">
            <img src="assetsForSideBar/img/perfil.jpg" alt="">
        </div>
    </header>

    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div>
                <a href="index.php" class="nav__logo">
                    <i class='bx bx-layer nav__logo-icon'></i>
                    <span class="nav__logo-name">Anao Dashboard</span>
                </a>

                <div class="nav__list">
                    <a href="admindashboard.php?page=restaurantManage" class="nav-restaurantManage nav__link ">
                      <i class='bx bx-restaurant nav__icon' ></i>
                      <span class="nav__name">Restaurants</span>
                    </a>

            </div>
            <a href="logout.php" class="nav__link">
              <i class='bx bx-log-out nav__icon' ></i>
              <span class="nav__name">Log Out</span>
            </a>
        </nav>
    </div>  
    
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
    <?php $page = isset($_GET['page']) ? $_GET['page'] :'admindashboard'; ?>
	  $('.nav-<?php echo $page; ?>').addClass('active')
</script>
   