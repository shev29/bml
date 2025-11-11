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
 <?php
 include "../assets/configure/sesionkurir.php"; 
$nama_kurir = $_SESSION['nama'];
$nikkur = $_SESSION['nik'];

include "../assets/configure/koneksi.php";  
date_default_timezone_set("Asia/Bangkok");

$sql = "SELECT nik, position FROM `courierdtl_kurir` WHERE nik='$nikkur'";
$result = $conn->query($sql);
//var_dump($sql);
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
      
        $nik = $row["nik"];
        $position = $row["position"];
        
        if($position=="koordinator"){
            
            echo"<a href='#' class='nav-link'>  <p>Koordinator  </p> </a>";
                  ?>
              <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-search"></i>
              <p>
                Zona & Kurir
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pilih_kurir.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pilih Kurir</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="manage_kurir.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Atur Kurir</p>
                </a>
              </li>
 
            </ul>
          </li>
    <?php 
        }
        else{
            echo"<a href='#' class='nav-link'>  <p> Member  </p> </a>";
        }
        
  

  }
} else {
 
}

//echo $nikkur;
?>

 
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
                <a href="home.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Permintaan Hari ini</p>
                </a>
              </li>
 
              <li class="nav-item">
                <a href="transfer_kurir.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ganti Kurir</p>
                </a>
              </li>
			  
              <li class="nav-item">
                <a href="todayorder.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kiriman Sampai</p>
                </a>
              </li>
              
               <li class="nav-item">
                <a href="nexdatytdelivery.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kiriman Lintas Hari</p>
                </a>
              </li>
 
              
			  
              <li class="nav-item">
                <a href="todaydelivery.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Rekap Hari Ini</p>
                </a>
              </li>
 
              <li class="nav-item">
                <a href="logout.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Logout</p>
                </a>
              </li>
            </ul>
          </li>
 
		  

        </ul>
      </nav>