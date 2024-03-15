<!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="<?php echo BASE_PATH;?>" class="logo d-flex align-items-center">
        
        <span class="d-none d-lg-block">Tasks Management</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->


        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <i class="ri-shield-user-fill" style="font-size:26px"></i>
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo strtoupper($_SESSION['username']);?></span>
          </a><!-- End Profile Iamge Icon -->



          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo strtoupper($_SESSION['username']);?></h6>
              
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
			

            <li>
              <a class="dropdown-item d-flex align-items-center" href="<?php echo BASE_PATH;?>logout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->
  