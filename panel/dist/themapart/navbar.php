	<?php
		$role = row("SELECT * FROM rangi WHERE id = ".$user['stanowisko']);
	?>
	<nav class="navbar navbar-expand topbar mb-4 static-top shadow">
		<!-- Sidebar Toggle (Topbar) -->
		<button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
			<i class="fa fa-bars"></i>
		</button>
		<!-- Topbar Navbar -->
		<ul class="navbar-nav ml-auto">
			<?php if(hasPermissionTo('return', $user_role, 'access_ustawienia_panel')):?>
		        <!-- Nav Item - Alerts -->
		        <li class="nav-item dropdown no-arrow mx-1">
		            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		                <i class="fas fa-bell fa-fw"></i>
		                <!-- Counter - Alerts -->
		                <span class="badge badge-danger badge-counter">3+</span>
		            </a>
		            <!-- Dropdown - Alerts -->
		            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
		                <h6 class="dropdown-header">
		                    Centrum powiadomień - w budowie
		                </h6>
		                <a class="dropdown-item d-flex align-items-center" href="#">
		                    <div class="mr-3">
		                        <div class="icon-circle bg-primary">
		                            <i class="fas fa-file-alt text-white"></i>
		                        </div>
		                    </div>
		                    <div>
		                        <div class="small text-gray-500">December 12, 2019</div>
		                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
		                    </div>
		                </a>
		                <a class="dropdown-item d-flex align-items-center" href="#">
		                    <div class="mr-3">
		                        <div class="icon-circle bg-success">
		                            <i class="fas fa-donate text-white"></i>
		                        </div>
		                    </div>
		                    <div>
		                        <div class="small text-gray-500">December 7, 2019</div>
		                        $290.29 has been deposited into your account!
		                    </div>
		                </a>
		                <a class="dropdown-item d-flex align-items-center" href="#">
		                    <div class="mr-3">
		                        <div class="icon-circle bg-warning">
		                            <i class="fas fa-exclamation-triangle text-white"></i>
		                        </div>
		                    </div>
		                    <div>
		                        <div class="small text-gray-500">December 2, 2019</div>
		                        Test Alert: We've noticed unusually high spending for your account.
		                    </div>
		                </a>
		                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
		            </div>
		        </li>

		        <!-- Nav Item - Messages -->
		        <li class="nav-item dropdown no-arrow mx-1">
		            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		                <i class="fas fa-envelope fa-fw"></i>
		                <!-- Counter - Messages -->
		                <span class="badge badge-danger badge-counter">7</span>
		            </a>
		            <!-- Dropdown - Messages -->
		            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
		                <h6 class="dropdown-header">
		                    Centrum wiadomości - w budowie
		                </h6>
		                <a class="dropdown-item d-flex align-items-center" href="#">
		                    <div class="dropdown-list-image mr-3">
		                        <img class="rounded-circle" src="dist/img/body.png" alt="...">
		                        <div class="status-indicator bg-success"></div>
		                    </div>
		                    <div>
		                        <div class="text-truncate"></div>
		                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
		                    </div>
		                </a>
		                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
		            </div>
		        </li>
			<?php endif;?>

	        <div class="topbar-divider d-none d-sm-block"></div>

	        <!-- Nav Item - User Information -->
			<li class="nav-item dropdown no-arrow">
				<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<span class="mr-2 d-none d-inline text-gray-800"> Witaj: <b style="color: <?=$role['kolor'];?>"><?='['.$role['kod_roli'].''.$user['nr_sluzbowy'].'] '.$user['login'].'';?></b></span>
				</a>
				<!-- Dropdown - User Information -->
				<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
					<?php if(hasPermissionTo('return', $user_role, 'profile_users')):?>
						<a class="dropdown-item" href="index.php?a=profile">
							<i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
							Profil
						</a>
					<?php endif;?>
					<?php if(hasPermissionTo('return', $user_role, 'access_ustawienia_user')):?>
						<a class="dropdown-item" href="index.php?a=ustawienia-użytkownika">
							<i class="fas fa-user-cog fa-sm fa-fw mr-2 text-gray-400"></i>
							Ustawienia Użytkownika
						</a>
					<?php endif;?>
					<?php if(hasPermissionTo('return', $user_role, 'access_ustawienia_panel')):?>
						<a class="dropdown-item" href="index.php?a=zarządzanie-panel">
							<i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
							Ustawienia Panelu
						</a>
					<?php endif;?>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="index.php?a=wyloguj">
						<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
						Wyloguj
					</a>
				</div>
			</li>
	    </ul>
	</nav>
