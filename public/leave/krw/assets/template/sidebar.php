<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="home.php">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="icon-layout menu-icon"></i>
              <span class="menu-title">Pengajuan Cuti</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu"> 
                <li class="nav-item"> <a class="nav-link"  href="preadd_cutithn.php" >Cuti Tahunan</a></li>
                    <li class="nav-item"> <a class="nav-link"   href="preadd_cutistgh.php"  >Cuti 1/2 Hari </a></li> 
                <li class="nav-item"> <a class="nav-link"  href="preadd_cutimlr.php"  >Cuti Melahirkan </a></li>
                <li class="nav-item"> <a class="nav-link"   href="preadd_cutikgg.php"  >Cuti Keguguran </a></li>
                <li class="nav-item"> <a class="nav-link"   href="preadd_cutinr.php"  >Cuti Normatif </a></li> 
                <li class="nav-item"> <a class="nav-link"   href="preadd_cutibsm.php"  >Cuti Bersama </a></li>  
                <li class="nav-item"> <a class="nav-link" href="preadd_izin.php">Unpaid Izin</a></li>
                <li class="nav-item"> <a class="nav-link" href="preadd_alpha.php">Unpaid Alfa/Mangkir</a></li>
				<!-- <li class="nav-item"> <a class="nav-link" href="preadd_Unpaid.php">Form Unpaid</a></li>-->
				<li class="nav-item"> <a class="nav-link" href="track_cuti.php">Track Cuti</a></li>
                <li class="nav-item"> <a class="nav-link" href="reject_log.php">Reject History</a></li>
                 <li class="nav-item"> <a class="nav-link" href="hrga_app.php">HRGA Approval</a></li>
                <li class="nav-item"> <a class="nav-link" href="view_app.php">View All Approval</a></li>
                <li class="nav-item"> <a class="nav-link" href="view_his.php">View History</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#error" aria-expanded="false" aria-controls="error">
              <i class="icon-ban menu-icon"></i>
              <span class="menu-title">Form Sakit</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="error">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="form_sakit.php"> Form Sakit </a></li>
              <!--  <li class="nav-item"> <a class="nav-link" href="app_sakit.php"> Approval Form </a></li>-->
                <!--!<li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> Approval Cuti </a></li>-->
              </ul>
            </div>
          </li>
 
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
              <i class="icon-columns menu-icon"></i>
              <span class="menu-title">Master Cuti</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-elements">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="view_cthn.php">List Hak Cuti</a></li>
              </ul>             
			  <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="ubah_pcuti.php">Ubah Req Cuti</a></li>
              </ul>         
			  <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="lahir_cuti.php">Lahir Cuti Staff </a></li>
              </ul>      
                     
			  <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="lahircuti_spv.php">Lahir Cuti SPV UP</a></li>
              </ul>  
			  <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="app_level.php">Approval Master</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
              <i class="icon-bar-graph menu-icon"></i>
              <span class="menu-title">Cuti Replacement</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="charts">
              <ul class="nav flex-column sub-menu"> 
                <li class="nav-item"> <a class="nav-link" href="add_rlembur.php">Lembur</a></li>
                <li class="nav-item"> <a class="nav-link" href="add_rborn.php">Melahirkan</a></li>
                <li class="nav-item"> <a class="nav-link" href="view_crplmn.php">Data Cuti<br>Replacement</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
              <i class="icon-grid-2 menu-icon"></i>
              <span class="menu-title">Location</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="tables">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="new_location.php">Add New Location</a></li>
                <li class="nav-item"> <a class="nav-link" href="view_dloc.php">Data Location</a></li>
              </ul>
            </div>
          </li>
 
      <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
              <i class="icon-contract menu-icon"></i>
              <span class="menu-title">Dep & Section</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="icons">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="new_dep.php">New Department</a></li>
                <li class="nav-item"> <a class="nav-link" href="view_dep.php">Data Department</a></li>
                 <li class="nav-item"> <a class="nav-link" href="new_section.php">New Section</a></li>
                <li class="nav-item"> <a class="nav-link" href="view_section.php">Data Section</a></li>
              </ul>
            </div>
          </li> 
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">User & Import Data</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="reg_user.php"> Add New User </a></li>				
                <li class="nav-item"> <a class="nav-link" href="data_user.php"> Data User </a></li> 
                <li class="nav-item"> <a class="nav-link" href="import/import_employee.php" target="_blank">Import User</a></li>				
                <li class="nav-item"> <a class="nav-link" href="import/upload_approval.php" target="_blank">Import M Approval</a></li> 
				<li class="nav-item"> <a class="nav-link" href="import/leave_bal.php" target="_blank">Import Leave<br>Balance</a></li> 
              </ul>
            </div>
          </li>
 
          <li class="nav-item">
            <a class="nav-link" href="documentation.php">
              <i class="icon-paper menu-icon"></i>
              <span class="menu-title">Doc Pendukung</span>
            </a>
           
          </li>
          <li class="nav-item">
			<a class="nav-link" href="report.php">
              <i class="icon-paper menu-icon"></i>
              <span class="menu-title">Report</span>
            </a>
           
          </li> 
          
        </ul>
      </nav>