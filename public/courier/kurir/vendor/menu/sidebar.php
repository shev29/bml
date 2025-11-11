      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
			   
			  <?php 
/* 				$home = $_GET['home'];
				if (!empty($home)) {
				  $home = 'active';
				  
				}
				else {
					$home = "";
				}
				$pickup = $_GET['pickup'];
				if (!empty($pickup)) {
				  $pickup = 'active';				  
				  }
				else {
					$pickup = "";
				} */
				?>
          <li class="nav-item menu-open">
            <a href="home.php?home=1" class="nav-link <?php echo $home; ?>"> 
              <p>
                Dashboard 
              </p>
            </a>
            <ul class="nav nav-treeview">
  
 
            </ul>
          </li>
 
          <li class="nav-item">
            <a href="#" class="nav-link <?php echo $pickup; ?>">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Job Order
                <i class="fas fa-angle-left right"></i>
                <!--<span class="badge badge-info right">2</span>-->
              </p>
            </a>
            <ul class="nav nav-treeview">
           <!--    <li class="nav-item">
                <a href="pickup.php?pickup=1" class="nav-link <?php echo $pickup; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pick Up</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="send.php" class="nav-link <?php echo $aktif; ?>" >
                  <i class="far fa-circle nav-icon"></i>
                  <p>Send</p>
                </a>
              </li>-->
 
              <li class="nav-item">
                <a href="index.php" class="nav-link <?php echo $aktif; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Urutan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="home.php" class="nav-link <?php echo $aktif; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kiriman Hari ini</p>
                </a>
              </li>
 
              <li class="nav-item">
                <a href="transfer_kurir.php" class="nav-link <?php echo $aktif; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ganti Kurir</p>
                </a>
              </li>
			  
              <li class="nav-item">
                <a href="todayorder.php" class="nav-link <?php echo $aktif; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kiriman Sampai</p>
                </a>
              </li>
 
              <li class="nav-item">
                <a href="logout.php" class="nav-link <?php echo $aktif; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Logout</p>
                </a>
              </li>
            </ul>
          </li>
 
		  
          <!--<li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Courier
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/tables/simple.html" class="nav-link <?php $aktif; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Simple Tables</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/tables/data.html" class="nav-link <?php $aktif; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>DataTables</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/tables/jsgrid.html" class="nav-link <?php $aktif; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>jsGrid</p>
                </a>
              </li>
            </ul>
          </li> 
          <li class="nav-item">
            <a href="#" class="nav-link <?php $aktif; ?>">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Tables
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/tables/simple.html" class="nav-link <?php $aktif; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Simple Tables</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/tables/data.html" class="nav-link <?php $aktif; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>DataTables</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/tables/jsgrid.html" class="nav-link <?php $aktif; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>jsGrid</p>
                </a>
              </li>
            </ul>
          </li>
 
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-search"></i>
              <p>
                Search
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="single_search.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Single Search</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="multiple_delivery.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Multiple Delivery</p>
                </a>
              </li>
            </ul>
          </li>
           
          <li class="nav-header">Special Case</li>
          <li class="nav-item">
            <a href="index.php" class="nav-link">
              <i class="nav-icon far fa-circle text-danger"></i>
              <p class="text">List & Important Order</p>
            </a>
          </li>
          <!--<li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-warning"></i>
              <p>Warning</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>Informational</p>
            </a>
          </li> -->
        </ul>
      </nav>