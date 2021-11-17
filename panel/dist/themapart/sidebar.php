	<?php
		if (empty($_GET['a'])) {
			$pages = 'home';
		}else{
			$pages = $_GET['a'];
		}

	?>
	<!-- Sidebar -->
	<ul class="navbar-nav sidebar sidebar-dark" id="accordionSidebar">

		<!-- Sidebar - Brand -->
		<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
			<div class="sidebar-brand-text mx-3">Wirtualne Pomorze</div>
		</a>

		<!-- Divider -->
		<hr class="sidebar-divider my-0">
		<?php if(hasPermissionTo('return', $user_role, 'strona_glowna')):?>
			<li class="nav-item <?php echo ($pages == 'home') ? 'active' : ''; ?>">
				<a class="nav-link" href="index.php">
					<i class="nav-icon fas fa-home"></i>
					Strona Główna <span class="sr-only">(current)</span>
				</a>
			</li>
		<?php endif;?>
		<?php if(hasPermissionTo('return', $user_role, 'access_raporty')):?>
			<li class="nav-item <?php echo ($pages == 'raporty') ? 'active' : ''; ?>">
				<a href="index.php?a=raporty" class="nav-link">
					<i class="nav-icon fas fa-road"></i>
					Raporty
				</a>
			</li>
		<?php endif;?>
		<?php if(hasPermissionTo('return', $user_role, 'access_grafik')):?>
			<li class="nav-item <?php echo ($pages == 'grafik') ? 'active' : ''; ?>">
				<a href="index.php?a=grafik" class="nav-link">
					<i class="nav-icon far fa-calendar-alt"></i>
					Grafik
				</a>
			</li>
		<?php endif;?>
		<?php if(hasPermissionTo('return', $user_role, 'access_rekrutacja')):?>
			<li class="nav-item <?php echo ($pages == 'rekrutacja') ? 'active' : ''; ?>">
				<a href="index.php?a=rekrutacja" class="nav-link ">
					<i class="nav-icon fas fa-user"></i>
					Rekrutacja
				</a>
			</li>
		<?php endif;?>
		<?php if(hasPermissionTo('return', $user_role, 'access_pracownicy')):?>
			<li class="nav-item <?php echo ($pages == 'pracownicy') ? 'active' : ''; ?>">
				<a href="index.php?a=pracownicy" class="nav-link ">
					<i class="nav-icon fas fa-user"></i>
					Pracownicy
				</a>
			</li>
		<?php endif;?>
		<?php if(hasPermissionTo('return', $user_role, 'access_tabor')):?>
			<li class="nav-item <?php echo ($pages == 'pojazdy') ? 'active' : ''; ?>">
				<a href="index.php?a=pojazdy" class="nav-link">
					<i class="nav-icon fas fa-bus"></i>
					Tabor
				</a>
			</li>
		<?php endif;?>
		<?php if(hasPermissionTo('return', $user_role, 'access_wnioski')):?>
			<li class="nav-item <?php echo ($pages == 'wnioski') ? 'active' : ''; ?>">
				<a href="index.php?a=wnioski" class="nav-link ">
					<i class="nav-icon fas fa-mail-bulk"></i>
					Wnioski
				</a>
			</li>
		<?php endif;?>
		<?php if(hasPermissionTo('return', $user_role, 'access_wykaz_brygad')):?>
			<li class="nav-item <?php echo ($pages == 'wykaz-brygad') ? 'active' : ''; ?>">
				<a class="nav-link" href="index.php?a=wykaz-brygad">
					<i class="fas fa-fw fa-tachometer-alt"></i>
					<span>Wykaz Brygad</span>
				</a>
			</li>
		<?php endif;?>
		<?php if(hasPermissionTo('return', $user_role, 'access_zgloszenia')):?>
			<li class="nav-item <?php echo ($pages == 'zgłoszenia') ? 'active' : ''; ?>">
				<a href="index.php?a=zgłoszenia" class="nav-link">
					<i class="nav-icon fas fa-exclamation-triangle"></i>
					Zgłoszenia
				</a>
			</li>
		<?php endif;?>
		<?php if(hasPermissionTo('return', $user_role, 'access_pobieralnia')):?>
			<li class="nav-item <?php echo ($pages == 'pobieralnia') ? 'active' : ''; ?>">
				<a href="index.php?a=pobieralnia" class="nav-link">
					<i class="nav-icon fas fa-cloud-download-alt"></i>
					Pobieralnia
				</a>
			</li>
		<?php endif;?>
		<?php if(hasPermissionTo('return', $user_role, 'access_dokumentacja')):?>
			<li class="nav-item <?php echo ($pages == 'dokumentacja') ? 'active' : ''; ?>">
				<a href="index.php?a=dokumentacja" class="nav-link">
					<i class="fas fa-file"></i>
					Dokumentacja
				</a>
			</li>
		<?php endif;?>
		<?php if(hasPermissionTo('return', $user_role, 'access_faq')):?>
			<li class="nav-item <?php echo ($pages == 'faq') ? 'active' : ''; ?>">
				<a href="index.php?a=faq" class="nav-link">
					<i class="nav-icon fas fa-question-circle"></i>
					FAQ
				</a>
			</li>
		<?php endif;?>


		<!-- Divider -->
		<hr class="sidebar-divider d-none d-md-block">
		<?php if(hasPermissionTo('return', $user_role, 'strona_glowna')):?>
			<?php if(hasPermissionTo('return', $user_role, 'strona_glowna')):?>
				<li class="nav-item <?php echo ($pages == 'użytkownicy' || $pages == 'zarzadzanie-wnioski' || $pages == 'wnioskioprace-zarządzanie') ? 'active' : ''; ?>">
		            <a class="nav-link <?php echo ($pages == 'użytkownicy' || $pages == 'zarzadzanie-wnioski' || $pages == 'wnioskioprace-zarządzanie') ? '' : 'collapsed'; ?>" href="#" data-toggle="collapse" data-target="#collapse-zarzad" aria-expanded="false" aria-controls="collapse-zarzad">
						<i class="nav-icon fas fa-wheelchair"></i>
				   		Zarząd
		            </a>
		            <div id="collapse-zarzad" class="collapse <?php echo ($pages == 'użytkownicy' || $pages == 'zarzadzanie-wnioski' || $pages == 'wnioskioprace-zarządzanie') ? 'show' : ''; ?>" aria-labelledby="headingUtilities" data-parent="#accordionSidebar" style="">
		                <div class="bg-dark p-2 collapse-inner rounded">
							<?php if($perm['zarzadanie panelem'] == '1'):?>
			                    <a class="collapse-item <?php echo ($pages == 'użytkownicy') ? 'active' : ''; ?>" href="index.php?a=użytkownicy">
									<i class="nav-icon fas fa-users"></i>
									Użytkownicy
								</a>
							<?php endif;?>
							<?php if($perm['zarzadzanie wnioskami'] == '1'):?>
								<a class="collapse-item <?php echo ($pages == 'zarzadzanie-wnioski') ? 'active' : ''; ?>" href="index.php?a=zarzadzanie-wnioski">
									<i class="fas fa-envelope-open-text"></i>
									Zarządzanie Wnioskami
								</a>
							<?php endif;?>
							<?php if($perm['zarzadzanie wnioskami o prace'] == '1'):?>
								<a class="collapse-item <?php echo ($pages == 'wnioskioprace-zarządzanie') ? 'active' : ''; ?>" href="index.php?a=wnioskioprace-zarządzanie">
									<i class="nav-icon fas fa-mail-bulk"></i>
									Zarządzanie Wnioskami o pracę
								</a>
							<?php endif;?>
		                </div>
		            </div>
		        </li>
			<?php endif;?>
		<?php endif;?>
		<?php if($user_role['id'] == '6'):?>
			<li class="nav-item <?php echo ($pages == 'użytkownicy' || $pages == 'zarzadzanie-wnioski' || $pages == 'wnioskioprace-zarządzanie') ? 'active' : ''; ?>">
				<a class="nav-link <?php echo ($pages == 'użytkownicy' || $pages == 'zarzadzanie-wnioski' || $pages == 'wnioskioprace-zarządzanie') ? '' : 'collapsed'; ?>" href="#" data-toggle="collapse" data-target="#collapse-kadry" aria-expanded="false" aria-controls="collapse-kadry">
					<i class="nav-icon fas fa-address-book"></i>
					Kadry
				</a>
				<div id="collapse-kadry" class="collapse <?php echo ($pages == 'użytkownicy' || $pages == 'zarzadzanie-wnioski' || $pages == 'wnioskioprace-zarządzanie') ? 'show' : ''; ?>" aria-labelledby="headingUtilities" data-parent="#accordionSidebar" style="">
					<div class="bg-dark p-2 collapse-inner rounded">
						<?php if($perm['zarzadanie panelem'] == '1'):?>
							<a class="collapse-item <?php echo ($pages == 'użytkownicy') ? 'active' : ''; ?>" href="index.php?a=użytkownicy">
								<i class="nav-icon fas fa-users"></i>
								Użytkownicy
							</a>
						<?php endif;?>
						<?php if($perm['zarzadzanie wnioskami'] == '1'):?>
							<a class="collapse-item <?php echo ($pages == 'zarzadzanie-wnioski') ? 'active' : ''; ?>" href="index.php?a=zarzadzanie-wnioski">
								<i class="fas fa-envelope-open-text"></i>
								Zarządzanie Wnioskami
							</a>
						<?php endif;?>
						<?php if($perm['zarzadzanie wnioskami o prace'] == '1'):?>
							<a class="collapse-item <?php echo ($pages == 'wnioskioprace-zarządzanie') ? 'active' : ''; ?>" href="index.php?a=wnioskioprace-zarządzanie">
								<i class="nav-icon fas fa-mail-bulk"></i>
								Zarządzanie Wnioskami o pracę
							</a>
						<?php endif;?>
					</div>
				</div>
			</li>
		<?php endif;?>
		<?php if(hasPermissionTo('return', $user_role, 'strona_glowna')):?>
			<li class="nav-item <?php echo ($pages == 'zarzadzanie-raporty') ? 'active' : ''; ?>">
	            <a class="nav-link <?php echo ($pages == 'zarzadzanie-raporty') ? '' : 'collapsed'; ?>" href="#" data-toggle="collapse" data-target="#collapse-nr" aria-expanded="false" aria-controls="collapse-nr">
	                <i class="fas fa-traffic-light"></i>
	                <span>Nadzór Ruchu</span>
	            </a>
	            <div id="collapse-nr" class="collapse <?php echo ($pages == 'zarzadzanie-raporty') ? 'show' : ''; ?>" aria-labelledby="headingUtilities" data-parent="#accordionSidebar" style="">
	                <div class="bg-dark p-2 collapse-inner rounded">
						<?php if($perm['zarzadzanie raportami'] == '1'):?>
		                    <a class="collapse-item <?php echo ($pages == 'zarzadzanie-raporty') ? 'active' : ''; ?>" href="index.php?a=zarzadzanie-raporty">
								<i class="nav-icon fas fa-road"></i>
								<span> Zarządzanie raportami</span>
							</a>
						<?php endif;?>
	                </div>
	            </div>
	        </li>
		<?php endif;?>
		<?php if(hasPermissionTo('return', $user_role, 'strona_glowna')):?>
			<li class="nav-item <?php echo ($pages == 'zarzadzanie-grafik' || $pages == 'dyspozytornia-wnioski') ? 'active' : ''; ?>">
	            <a class="nav-link <?php echo ($pages == 'zarzadzanie-grafik' || $pages == 'dyspozytornia-wnioski') ? '' : 'collapsed'; ?>" href="#" data-toggle="collapse" data-target="#collapse-grafik" aria-expanded="false" aria-controls="collapse-grafik">
					<i class="fas fa-bus-alt"></i>
					Dyspozytornia
	            </a>
	            <div id="collapse-grafik" class="collapse <?php echo ($pages == 'zarzadzanie-grafik' || $pages == 'dyspozytornia-wnioski') ? 'show' : ''; ?>" aria-labelledby="headingUtilities" data-parent="#accordionSidebar" style="">
	                <div class="bg-dark p-2 collapse-inner rounded">
						<?php if($perm['zarzadzanie grafikiem'] == '1'):?>
	                    	<a class="collapse-item <?php echo ($pages == 'zarzadzanie-grafik') ? 'active' : ''; ?>" href="index.php?a=zarzadzanie-grafik">
								<i class="collapse-icon far fa-calendar-alt"></i>
								Grafik
							</a>
						<?php endif;?>
						<?php if($perm['zarzadzanie grafikiem'] == '1'):?>
							<a class="collapse-item <?php echo ($pages == 'dyspozytornia-wnioski') ? 'active' : ''; ?>" href="index.php?a=dyspozytornia-wnioski">
								<i class="fas fa-envelope-open-text"></i>
								Wnioski
							</a>
						<?php endif;?>
				    </div>
	            </div>
	        </li>
		<?php endif;?>
		<?php if(hasPermissionTo('return', $user_role, 'strona_glowna')):?>
			<li class="nav-item <?php echo ($pages == 'flota' || $pages == 'flota-wnioski' || $pages == 'zarządzanie-pobieralnia') ? 'active' : ''; ?>">
	            <a class="nav-link <?php echo ($pages == 'flota' || $pages == 'flota-wnioski' || $pages == 'zarządzanie-pobieralnia') ? '' : 'collapsed'; ?>" href="#" data-toggle="collapse" data-target="#collapse-kz" aria-expanded="false" aria-controls="collapse-kz">
					<i class="fas fa-tools"></i>
					Flota
	            </a>
	            <div id="collapse-kz" class="collapse <?php echo ($pages == 'flota' || $pages == 'flota-wnioski' || $pages == 'zarządzanie-pobieralnia') ? 'show' : ''; ?>" aria-labelledby="headingUtilities" data-parent="#accordionSidebar" style="">
	                <div class="bg-dark p-2 collapse-inner rounded">
						<?php if($perm['zarzadzanie taborem'] == '1'):?>
	                    	<a class="collapse-item <?php echo ($pages == 'flota') ? 'active' : ''; ?>" href="index.php?a=flota">
								<i class="collapse-icon fas fa-bus"></i>
								Pojazdy
							</a>
						<?php endif;?>
						<?php if($perm['zarzadzanie_wnioskami_tabor'] == '1'):?>
							<a class="collapse-item <?php echo ($pages == 'flota-wnioski') ? 'active' : ''; ?>" href="index.php?a=flota-wnioski">
								<i class="fas fa-envelope-open-text"></i>
								Wnioski
							</a>
						<?php endif;?>
						<?php if($perm['zarzadzanie pobieralnia'] == '1'):?>
							<a class="collapse-item <?php echo ($pages == 'zarządzanie-pobieralnia') ? 'active' : ''; ?>" href="index.php?a=zarządzanie-pobieralnia">
								<i class="fas fa-cloud-download-alt"></i>
								Zarządzanie Pobieralnią
							</a>
						<?php endif;?>
				    </div>
	            </div>
	        </li>
		<?php endif;?>
		<?php if(hasPermissionTo('return', $user_role, 'strona_glowna')):?>
			<li class="nav-item <?php echo ($pages == 'zarzadzanie-dokumentacja' || $pages == 'zarzadzanie-faq') ? 'active' : ''; ?>">
	            <a class="nav-link <?php echo ($pages == 'zarzadzanie-dokumentacja' || $pages == 'zarzadzanie-faq') ? '' : 'collapsed'; ?>" href="#" data-toggle="collapse" data-target="#collapse-sekretariat" aria-expanded="false" aria-controls="collapse-sekretariat">
					<i class="far fa-newspaper"></i>
					Sekretariat
	            </a>
	            <div id="collapse-sekretariat" class="collapse <?php echo ($pages == 'zarzadzanie-dokumentacja' || $pages == 'zarzadzanie-faq') ? 'show' : ''; ?>" aria-labelledby="headingUtilities" data-parent="#accordionSidebar" style="">
	                <div class="bg-dark p-2 collapse-inner rounded">
						<?php if($perm['zarzadzanie_dokumentacja'] == '1'):?>
							<a class="collapse-item <?php echo ($pages == 'zarzadzanie-dokumentacja') ? 'active' : ''; ?>" href="index.php?a=zarzadzanie-dokumentacja">
								<i class="fas fa-file"></i>
								Zarządzanie dokumentacją
							</a>
						<?php endif;?>
						<?php if($perm['zarzadzanie_faq'] == '1'):?>
							<a class="collapse-item <?php echo ($pages == 'zarzadzanie-faq') ? 'active' : ''; ?>" href="index.php?a=zarzadzanie-faq">
								<i class="nav-icon fas fa-question-circle"></i>
								Zarządzanie FAQ
							</a>
						<?php endif;?>
				    </div>
	            </div>
	        </li>
		<?php endif;?>
		<?php if(hasPermissionTo('return', $user_role, 'strona_glowna')):?>
			<li class="nav-item <?php echo ($pages == '' || $pages == '') ? 'active' : ''; ?>">
	            <a class="nav-link <?php echo ($pages == '' || $pages == '') ? '' : 'collapsed'; ?>" href="#" data-toggle="collapse" data-target="#collapse-admin" aria-expanded="false" aria-controls="collapse-admin">
					<i class="fas fa-briefcase"></i>
					Administracja
	            </a>
	            <div id="collapse-admin" class="collapse <?php echo ($pages == '' || $pages == '') ? 'show' : ''; ?>" aria-labelledby="headingUtilities" data-parent="#accordionSidebar" style="">
	                <div class="bg-dark p-2 collapse-inner rounded">
						<span>W budowie</span>
				    </div>
	            </div>
	        </li>
		<?php endif;?>


		<?php if($perm['zarzadanie wykazem'] == '1'):?>
			<li class="nav-item <?php echo ($pages == 'wykaz-brygad-zarządzanie') ? 'active' : ''; ?>">
				<a class="nav-link" href="index.php?a=służby">
					<i class="fas fa-fw fa-tachometer-alt"></i>
					Zarządzanie Wykazem Brygad
				</a>
			</li>
		<?php endif;?>
		<?php if($perm['zarzadzanie linie'] == '1'):?>
			<li class="nav-item <?php echo ($pages == 'linie-zarządzanie') ? 'active' : ''; ?>">
				<a class="nav-link" href="index.php?a=linie-zarządzanie">
					<i class="fas fa-fw fa-tachometer-alt"></i>
					Zarządzanie Liniami
				</a>
			</li>
		<?php endif;?>

		<?php if($perm['pisanie postow na stronie'] == '1' || $perm['pisanie ogloszen w panelu'] == '1' || $perm['pisanie_discord_ogloszenia'] == '1'):?>
			<li class="nav-item <?php echo ($pages == 'ogłoszenia-portal' || $pages == 'ogłoszenia-panel') ? 'active' : ''; ?>">
				<a class="nav-link collapsed " href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
					<i class="fas fa-fw fa-cog"></i>
					Pisanie Ogłoszeń
				</a>
				<div id="collapseTwo" class="collapse <?php echo ($pages == 'ogłoszenia-portal' || $pages == 'ogłoszenia-panel') ? 'show' : ''; ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
					<div class="py-2 collapse-inner rounded">
						<?php if($perm['pisanie postow na stronie'] == '1'){
							echo '<a class="collapse-item" href="index.php?a=ogłoszenia-portal">Portal</a>';
						}?>
						<?php if($perm['pisanie ogloszen w panelu'] == '1'){
							echo '<a class="collapse-item" href="index.php?a=ogłoszenia-panel">Panel</a>';
						}?>
						<?php
						if($perm['pisanie_discord_ogloszenia'] == '1'){
							echo '<a class="collapse-item" href="index.php?a=ogłoszenia-discord">Discord</a>';
						}?>

					</div>
				</div>
			</li>
		<?php endif;?>
	</ul>
	<!-- End of Sidebar -->
