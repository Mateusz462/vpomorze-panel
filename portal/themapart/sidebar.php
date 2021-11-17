<?php 
	if (($_GET) == 'home') $class1 = "active";
	elseif (!empty($_GET) == 'home') $class2 = "active";
	
	
	
$user = getUser($_SESSION['id']); // Wybierany danych z bazy o graczu aktualnie zalogowanym
	function sidebar($user) {
		if($user['stanowisko'] == 'Zarząd'){
			if (!empty($user['id'])) {
				echo '
				<aside class="main-sidebar sidebar-dark-primary elevation-4">
					<!-- Brand Logo -->
					<a href="panel.php?a=home" class="brand-link">
					  <img src="dist/img/AdminLTELogo.png" alt="MZDIK Radom" class="brand-image img-circle elevation-3"
						  style="opacity: .8">
					  <span class="brand-text font-weight-light">MZDIK Radom</span>
					</a>
					<!-- Sidebar -->
					<div class="sidebar">
						<!-- Sidebar user panel (optional) -->
						<div class="user-panel mt-3 pb-3 mb-3 d-flex">
							<div class="image">
								'.avatar($user['id']).'
							</div>
							<div class="info">
								<a href="panel.php?a=profile" class="d-block">'.$user['login'].' '.$user['id'].'</a>
							</div>
						</div>
					  
						  
						<!-- Sidebar Menu -->
						<nav class="mt-2">
							<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
							  <!-- Add icons to the links using the .nav-icon class
								  with font-awesome or any other icon font library -->
							  <li class="nav-item">
								<a href="panel.php?a=home" class="nav-link .$class1.">
								  <i class="nav-icon fas fa-tachometer-alt"></i>
								  <p>
									Strona Główna
								  </p>
								</a>
							  </li>
							  <li class="nav-item">
								<a href="https://discordapp.com/channels/640840209600086017/640840209600086019" target="_blank" class="nav-link disabled">
								  <i class="nav-icon fab fa-discord"></i>
								  <p>
									Discord Firmowy
								  </p>
								</a>
							  </li>
							  <li class="nav-item">
								<a href="panel.php?a=grafik" class="nav-link <!--disabled-->.$class2.">
								  <i class="nav-icon far fa-calendar-alt"></i>
								  <p>
									Grafik
								  </p>
								</a>
							  </li>
							  <li class="nav-item">
								<a href="panel.php?a=wnioski" class="nav-link <?php echo $class3 ?>">
								  <i class="nav-icon fas fa-mail-bulk"></i>
								  <p>
									Wnioski
								  </p>
								</a>
							  </li>
							  <li class="nav-item">
								<a href="panel.php?a=raporty" class="nav-link <?php echo $class4 ?> ">
								  <i class="nav-icon fas fa-road"></i>
								  <p>
									Raporty
								  </p>
								</a>
							  </li>
							  <li class="nav-item">
								<a href="panel.php?a=pracownicy" class="nav-link <?php echo $class5 ?>">
								  <i class="nav-icon fas fa-users"></i>
								  <p>
									Spis Pracowników
								  </p>
								</a>
							  </li>
							  <li class="nav-item">
								<a href="panel.php?a=pojazdy" class="nav-link <?php echo $class6 ?>">
								  <i class="nav-icon fas fa-bus"></i>
								  <p>
									Spis Pojazdów
								  </p>
								</a>
							  </li>
							  <li class="nav-item">
								<a href="panel.php?a=pobieralnia" class="nav-link <?php echo $class7 ?>">
								  <i class="nav-icon fas fa-cloud-download-alt"></i>
								  <p>
									Pobieralnia
								  </p>
								</a>
							  </li>
							  <li class="nav-item">
								<a href="panel.php?a=ranking" class="nav-link <?php echo $class8 ?>">
								  <i class="nav-icon fas fa-award"></i>
								  <p>
									Ranking
								  </p>
								</a>
							  </li>
							  <li class="nav-item">
								<a href="panel.php?a=faq" class="nav-link <?php echo $class9 ?>">
								  <i class="nav-icon fas fa-question-circle"></i>
								  <p>
									FAQ
								  </p>
								</a>
							  </li>
							  <li class="nav-item">
								<a href="panel.php?a=wyloguj" class="nav-link">
								  <i class="nav-icon fas fa-sign-out-alt"></i>
								  <p>
									Wyloguj
								  </p>
								</a>
							  </li>
							
							  <li class="user-panel mt-3 pb-3 mb-3 d-flex"></li>
							  
							  <li class="nav-item has-treeview">
								<a href="#" class="nav-link">
								  <i class="nav-icon fas fa-edit"></i>
								  <p>
									Zarząd
									<i class="fas fa-angle-left right"></i>
								  </p>
								</a>
								<ul class="nav nav-treeview" style="display: none;">
								  <li class="nav-item">
									<a href="panel.php?a=sluzby" class="nav-link">
									  <i class="far fa-circle nav-icon"></i>
									  <p>Służby</p>
									</a>
								  </li>
								</ul>
								<ul class="nav nav-treeview" style="display: none;">
								  <li class="nav-item">
									<a href="panel.php?a=linie" class="nav-link">
									  <i class="far fa-circle nav-icon"></i>
									  <p>Linie</p>
									</a>
								  </li>
								</ul>
								<ul class="nav nav-treeview" style="display: none;">
								  <li class="nav-item">
									<a href="panel.php?a=mapy" class="nav-link">
									  <i class="far fa-circle nav-icon"></i>
									  <p>Mapy</p>
									</a>
								  </li>
								</ul>
								<ul class="nav nav-treeview" style="display: none;">
								  <li class="nav-item">
									<a href="panel.php?a=ogloszenia" class="nav-link">
									  <i class="far fa-circle nav-icon"></i>
									  <p>Ogłoszenia</p>
									</a>
								  </li>
								</ul>
							  </li>
							  
							  <li class="nav-item has-treeview">
								<a href="#" class="nav-link">
								  <i class="nav-icon fas fa-bus"></i>
								  <p>
									Dyspozytornia
									<i class="fas fa-angle-left right"></i>
								  </p>
								</a>
								<ul class="nav nav-treeview" style="display: none;">
								  <li class="nav-item">
									<a href="../forms/general.html" class="nav-link">
									  <i class="far fa-circle nav-icon"></i>
									  <p>Grafik</p>
									</a>
								  </li>
								  <li class="nav-item">
									<a href="../forms/advanced.html" class="nav-link">
									  <i class="far fa-circle nav-icon"></i>
									  <p>Wnioski</p>
									</a>
								  </li>
								</ul>
							  </li>
							  
							  <li class="nav-item has-treeview">
								<a href="#" class="nav-link">
								  <i class="nav-icon fas fa-edit"></i>
								  <p>
									Kadry
									<i class="fas fa-angle-left right"></i>
								  </p>
								</a>
								<ul class="nav nav-treeview" style="display: none;">
								  <li class="nav-item">
									<a href="../forms/general.html" class="nav-link">
									  <i class="far fa-circle nav-icon"></i>
									  <p>Wnioski</p>
									</a>
								  </li>
								</ul>
							  </li>
							  
							  <li class="nav-item has-treeview">
								<a href="#" class="nav-link">
								  <i class="nav-icon fas fa-edit"></i>
								  <p>
									Nadzór Ruchu
									<i class="fas fa-angle-left right"></i>
								  </p>
								</a>
								<ul class="nav nav-treeview" style="display: none;">
								  <li class="nav-item">
									<a href="../forms/general.html" class="nav-link">
									  <i class="far fa-circle nav-icon"></i>
									  <p>Raporty</p>
									</a>
								  </li>
								  <li class="nav-item">
									<a href="../forms/general.html" class="nav-link">
									  <i class="far fa-circle nav-icon"></i>
									  <p>Zdarzenia</p>
									</a>
								  </li>
								</ul>
							  </li>
							  
							  <li class="nav-item has-treeview">
								<a href="#" class="nav-link">
								  <i class="nav-icon fas fa-edit"></i>
								  <p>
									Flota
									<i class="fas fa-angle-left right"></i>
								  </p>
								</a>
								<ul class="nav nav-treeview" style="display: none;">
								  <li class="nav-item">
									<a href="../forms/general.html" class="nav-link">
									  <i class="far fa-circle nav-icon"></i>
									  <p>Pojazdy</p>
									</a>
								  </li>
								  <li class="nav-item">
									<a href="../forms/general.html" class="nav-link">
									  <i class="far fa-circle nav-icon"></i>
									  <p>General Elements</p>
									</a>
								  </li>
								</ul>
							  </li>
							  
							  <li class="nav-item has-treeview">
								<a href="#" class="nav-link">
								  <i class="nav-icon fas fa-edit"></i>
								  <p>
									Administracja
									<i class="fas fa-angle-left right"></i>
								  </p>
								</a>
								<ul class="nav nav-treeview" style="display: none;">
								  <li class="nav-item">
									<a href="../forms/general.html" class="nav-link">
									  <i class="fas fa-users nav-icon"></i>
									  <p>Użytkownicy</p>
									</a>
								  </li>
								  <li class="nav-item">
									<a href="../forms/general.html" class="nav-link">
									   <i class="fas fa-ban nav-icon"></i>
									  <p>Ograniczenia dostępu</p>
									</a>
								  </li>
								  <li class="nav-item">
									<a href="../forms/general.html" class="nav-link">
									  <i class="far fa-circle nav-icon"></i>
									  <p>Wnioski do Administacji</p>
									</a>
								  </li>
								  <li class="nav-item">
									<a href="../forms/general.html" class="nav-link">
									  <i class="far fa-circle nav-icon"></i>
									  <p>Zdarzenia</p>
									</a>
								  </li>
								</ul>
							  </li>
							  <li class="nav-item">
								<a href="http://localhost/phpmyadmin/db_structure.php?server=1&db=mzdik" target="_blank" class="nav-link">
								  <i class="fas fa-php nav-icon"></i>
								  <p>phpmyadmin</p>
								</a>
							  </li>
							  //
							</ul>
						</nav>
					</div>
					<!-- /.sidebar -->
				</aside>
				';
			} else {
				echo '
				<aside class="main-sidebar sidebar-dark-primary elevation-4">
					<!-- Brand Logo -->
					<a href="panel.php?a=home" class="brand-link">
						<img src="dist/img/AdminLTELogo.png" alt="MZDIK Radom" class="brand-image img-circle elevation-3"
							style="opacity: .8">
						<span class="brand-text font-weight-light">MZDIK Radom</span>
					</a>
					<!-- Sidebar -->
					<div class="sidebar">
						<!-- Sidebar Menu -->
						<nav class="mt-2">
							<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
								<!-- Add icons to the links using the .nav-icon class
								  with font-awesome or any other icon font library -->
								<li class="nav-item">
									<a href="panel.php?a=login" class="nav-link">
										<i class="nav-icon fas fa-tachometer-alt"></i>
										<p>
											Logowanie
										</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="panel.php?a=register" class="nav-link">
										<i class="nav-icon fas fa-tachometer-alt"></i>
										<p>
											Rejestracja
										</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="panel.php?a=login" class="nav-link">
										<i class="nav-icon fas fa-tachometer-alt"></i>
										<p>
											Strona Główna
										</p>
									</a>
								</li>
							</ul>
						</nav>
					</div>
				</aside>';
				
				
			}
			
		}elseif($user['stanowisko'] == 'Kierowca'){
			echo '
				<aside class="main-sidebar sidebar-dark-primary elevation-4">
					<!-- Brand Logo -->
					<a href="panel.php?a=home" class="brand-link">
					  <img src="dist/img/AdminLTELogo.png" alt="MZDIK Radom" class="brand-image img-circle elevation-3"
						  style="opacity: .8">
					  <span class="brand-text font-weight-light">MZDIK Radom</span>
					</a>
					<!-- Sidebar -->
					  <div class="sidebar">
						<!-- Sidebar user panel (optional) -->
						<div class="user-panel mt-3 pb-3 mb-3 d-flex">
						  <div class="image">
							'.avatar($user['id']).'
						  </div>
						  <div class="info">
							<a href="panel.php?a=profile" class="d-block">'.$user['login'].' '.$user['id'].'</a>
						  </div>
						</div>
					  
						  
						  <!-- Sidebar Menu -->
						  <nav class="mt-2">
							<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
							  <!-- Add icons to the links using the .nav-icon class
								  with font-awesome or any other icon font library -->
							  <li class="nav-item">
								<a href="panel.php?a=home" class="nav-link .$class1.">
								  <i class="nav-icon fas fa-tachometer-alt"></i>
								  <p>
									Strona Główna
								  </p>
								</a>
							  </li>
							  <li class="nav-item">
								<a href="https://discordapp.com/channels/640840209600086017/640840209600086019" target="_blank" class="nav-link disabled">
								  <i class="nav-icon fab fa-discord"></i>
								  <p>
									Discord Firmowy
								  </p>
								</a>
							  </li>
							  <li class="nav-item">
								<a href="panel.php?a=pracownicy" class="nav-link <?php echo $class5 ?>">
								  <i class="nav-icon fas fa-users"></i>
								  <p>
									Spis Pracowników
								  </p>
								</a>
							  </li>
							  <li class="nav-item">
								<a href="panel.php?a=pojazdy" class="nav-link <?php echo $class6 ?>">
								  <i class="nav-icon fas fa-bus"></i>
								  <p>
									Spis Pojazdów
								  </p>
								</a>
							  </li>
							  <li class="nav-item">
								<a href="panel.php?a=pobieralnia" class="nav-link <?php echo $class7 ?>">
								  <i class="nav-icon fas fa-cloud-download-alt"></i>
								  <p>
									Pobieralnia
								  </p>
								</a>
							  </li>
							  <li class="nav-item">
								<a href="panel.php?a=ranking" class="nav-link <?php echo $class8 ?>">
								  <i class="nav-icon fas fa-award"></i>
								  <p>
									Ranking
								  </p>
								</a>
							  </li>
							  
							<li class="nav-item">
								<a href="panel.php?a=wyloguj" class="nav-link">
								  <i class="nav-icon fas fa-sign-out-alt"></i>
								  <p>
									Wyloguj
								  </p>
								</a>
							  </li>
							</ul>
						  </nav>
						<!-- /.sidebar-menu -->
					  </div>
					  <!-- /.sidebar -->
				</aside>';
			
		}elseif($user['stanowisko'] == 'Zawieszony'){
			echo '
				<aside class="main-sidebar sidebar-dark-primary elevation-4">
					<!-- Brand Logo -->
					<a href="panel.php?a=home" class="brand-link">
					  <img src="dist/img/AdminLTELogo.png" alt="MZDIK Radom" class="brand-image img-circle elevation-3"
						  style="opacity: .8">
					  <span class="brand-text font-weight-light">MZDIK Radom</span>
					</a>
					<!-- Sidebar -->
					  <div class="sidebar">
						<!-- Sidebar user panel (optional) -->
						<div class="user-panel mt-3 pb-3 mb-3 d-flex">
						  <div class="image">
							'.avatar($user['id']).'
						  </div>
						  <div class="info">
							<a href="panel.php?a=profile" class="d-block">'.$user['login'].' '.$user['id'].'</a>
						  </div>
						</div>
					  
						  
						  <!-- Sidebar Menu -->
						  <nav class="mt-2">
							<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
							  <!-- Add icons to the links using the .nav-icon class
								  with font-awesome or any other icon font library -->
							  <li class="nav-item">
								<a href="panel.php?a=home" class="nav-link .$class1.">
								  <i class="nav-icon fas fa-tachometer-alt"></i>
								  <p>
									Strona Główna
								  </p>
								</a>
							  </li>
							  <li class="nav-item">
								<a href="https://discordapp.com/channels/640840209600086017/640840209600086019" target="_blank" class="nav-link disabled">
								  <i class="nav-icon fab fa-discord"></i>
								  <p>
									Discord Firmowy
								  </p>
								</a>
							  </li>
							  <li class="nav-item">
								<a href="panel.php?a=pracownicy" class="nav-link <?php echo $class5 ?>">
								  <i class="nav-icon fas fa-users"></i>
								  <p>
									Spis Pracowników
								  </p>
								</a>
							  </li>
							  <li class="nav-item">
								<a href="panel.php?a=pojazdy" class="nav-link <?php echo $class6 ?>">
								  <i class="nav-icon fas fa-bus"></i>
								  <p>
									Spis Pojazdów
								  </p>
								</a>
							  </li>
							  <li class="nav-item">
								<a href="panel.php?a=ranking" class="nav-link <?php echo $class8 ?>">
								  <i class="nav-icon fas fa-award"></i>
								  <p>
									Ranking
								  </p>
								</a>
							  </li>
							  
							<li class="nav-item">
								<a href="panel.php?a=wyloguj" class="nav-link">
								  <i class="nav-icon fas fa-sign-out-alt"></i>
								  <p>
									Wyloguj
								  </p>
								</a>
							  </li>
							</ul>
						  </nav>
						<!-- /.sidebar-menu -->
					  </div>
					  <!-- /.sidebar -->
				</aside>';
			
		} else {
			echo '
				<aside class="main-sidebar sidebar-dark-primary elevation-4">
					<!-- Brand Logo -->
					<a href="panel.php?a=home" class="brand-link">
					  <img src="dist/img/AdminLTELogo.png" alt="MZDIK Radom" class="brand-image img-circle elevation-3"
						  style="opacity: .8">
					  <span class="brand-text font-weight-light">MZDIK Radom</span>
					</a>
					<!-- Sidebar -->
					  <div class="sidebar">
						<!-- Sidebar user panel (optional) -->
						<div class="user-panel mt-3 pb-3 mb-3 d-flex">
						  <div class="image">
							'.avatar($user['id']).'
						  </div>
						  <div class="info">
							<a href="panel.php?a=profile" class="d-block">'.$user['login'].' '.$user['id'].'</a>
						  </div>
						</div>
					  
						  
						  <!-- Sidebar Menu -->
						  <nav class="mt-2">
							<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
							  <!-- Add icons to the links using the .nav-icon class
								  with font-awesome or any other icon font library -->
							  <li class="nav-item">
								<a href="panel.php?a=home" class="nav-link .$class1.">
								  <i class="nav-icon fas fa-tachometer-alt"></i>
								  <p>
									Strona Główna
								  </p>
								</a>
							  </li>
							  <li class="nav-item">
								<a href="https://discordapp.com/channels/640840209600086017/640840209600086019" target="_blank" class="nav-link disabled">
								  <i class="nav-icon fab fa-discord"></i>
								  <p>
									Discord Firmowy
								  </p>
								</a>
							  </li>
							  <li class="nav-item">
								<a href="panel.php?a=pracownicy" class="nav-link <?php echo $class5 ?>">
								  <i class="nav-icon fas fa-users"></i>
								  <p>
									Spis Pracowników
								  </p>
								</a>
							  </li>
							  <li class="nav-item">
								<a href="panel.php?a=pojazdy" class="nav-link <?php echo $class6 ?>">
								  <i class="nav-icon fas fa-bus"></i>
								  <p>
									Spis Pojazdów
								  </p>
								</a>
							  </li>
							  <li class="nav-item">
								<a href="panel.php?a=pobieralnia" class="nav-link <?php echo $class7 ?>">
								  <i class="nav-icon fas fa-cloud-download-alt"></i>
								  <p>
									Pobieralnia
								  </p>
								</a>
							  </li>
							  <li class="nav-item">
								<a href="panel.php?a=ranking" class="nav-link <?php echo $class8 ?>">
								  <i class="nav-icon fas fa-award"></i>
								  <p>
									Ranking
								  </p>
								</a>
							  </li>
							  
							<li class="nav-item">
								<a href="panel.php?a=wyloguj" class="nav-link">
								  <i class="nav-icon fas fa-sign-out-alt"></i>
								  <p>
									Wyloguj
								  </p>
								</a>
							  </li>
							</ul>
						  </nav>
						<!-- /.sidebar-menu -->
					  </div>
					  <!-- /.sidebar -->
				</aside>';
		}
	}
?>