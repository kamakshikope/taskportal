 <?php
 if($_SESSION['userId'] != 1)
	header("Location:".BASE_PATH."views/tasks.php");

	 ?>
 
 <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li id="dashboard" class="nav-item">
        <a class="nav-link " href="<?php echo BASE_PATH;?>views/dashboard.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

	

      <li id="master" class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Master</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
         
		  <li>
            <a href="<?php echo BASE_PATH;?>master/user_master.php">
              <i class="bi bi-file-person-fill"></i><span>Users</span>
            </a>
          </li>
		
          
        </ul>
      </li><!-- End Components Nav -->
	 
	
    </ul>

  </aside>
 