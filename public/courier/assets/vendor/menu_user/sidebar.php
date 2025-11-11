      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

        
          <li class="nav-item menu-open">
            <a href="home.php?home=1" class="nav-link">
              <p>
                Dashboard 
              </p>
            </a>
            <ul class="nav nav-treeview">
  
 
            </ul>
          </li>
 
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Job Order
                <i class="fas fa-angle-left right"></i>
                <!--<span class="badge badge-info right">2</span>-->
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pickup.php?pickup=1" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pick Up</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="send.php" class="nav-link" >
                  <i class="far fa-circle nav-icon"></i>
                  <p>Send</p>
                </a>
              </li>
              
              <?php
              if(($nikso==="117010025") OR($nikso==="122000041" )){
                  ?>
                 <li class="nav-item">
                <a href="todayorder.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Today Order</p>
                </a>
              </li>
              <?php
              }
              ?>
 
              <li class="nav-item">
                <a href="todaydelivery.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Today Delivery</p>
                </a>
              </li>
              
 
              <li class="nav-item">
                <a href="mydelivery.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>My Delivery</p>
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
                <a href="multiple_search.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Multiple Search</p>
                </a>
              </li>
            </ul>
          </li>
        <?php 
date_default_timezone_set("Asia/Bangkok");
$nowdate_forexpire = date('Y-m-d');
$hour = date('H');
//echo $hour;
if ($hour <10) {
 
  echo " $hour <li class='nav-header'>Additonal Order > 10 AM</li>";
}    
else{
    ?>
 <li class="nav-header">Additional Order</li>
          <li class="nav-item">
            <a href="important_pickup.php" class="nav-link">
              <i class="nav-icon far fa-circle text-danger"></i>
              <p class="text">Add. Pickup Order</p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="important_send.php" class="nav-link">
              <i class="nav-icon far fa-circle text-danger"></i>
              <p class="text">Add. Send Order</p>
            </a>
          </li>    
<?php

}
?>         
          
          <li class="nav-header">Account</li>
          <li class="nav-item">
            <a href="logout.php" class="nav-link">
              <i class="nav-icon far fa-circle text-warning"></i>
              <p class="text">Logout</p>
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