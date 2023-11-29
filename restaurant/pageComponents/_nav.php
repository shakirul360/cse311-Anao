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
                <a href="restaurantdashboard.php" class="nav__logo">
                    <i class='bx bx-layer nav__logo-icon'></i>
                    <span class="nav__logo-name">Dashboard</span>
                </a>

                <div class="nav__list">
                    
                    <a href="restaurantdashboard.php?page=menuManage" class="nav-menu nav__link">
                      <i class='bx bx-food-menu nav__icon' ></i>
                      <span class="nav__name">Menu</span>
                    </a>

                    <a href="restaurantdashboard.php?page=orderManage" class="nav-orderManage nav__link ">
                      <i class='bx bx-clipboard nav__icon' ></i>
                      <span class="nav__name">Orders</span>
                    </a>
                   <!--  <a href="#" class="nav__link nav-menuManage">
                      <i class='bx bx-message-square-detail nav__icon' ></i>
                      <span class="nav__name">Menu</span>
                    </a>
                    <a href="#" class="nav__link nav-contactManage">
                      <i class="fas fa-hands-helping"></i>
                      <span class="nav__name">contact Info</span>
                    </a>
                    <a href="#" class="nav__link nav-userManage">
                      <i class='bx bx-user nav__icon' ></i>
                      <span class="nav__name">Users</span>
                    </a> -->
                    
                    <!-- <a href="#" class="nav__link nav-siteManage">
                      <i class="fas fa-cogs"></i>
                      <span class="nav__name">Personalize Restaurant</span>
                    </a> -->
                </div>
            </div>
            <a href="logout.php" class="nav__link">
              <i class='bx bx-log-out nav__icon' ></i>
              <span class="nav__name">Log Out</span>
            </a>
        </nav>
    </div>  
    
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
    <?php $page = isset($_GET['page']) ? $_GET['page'] :'restaurantdashboard'; ?>
	  $('.nav-<?php echo $page; ?>').addClass('active')
</script>
