<?php
	if($perm['raporty_uzytkownicy'] == '0'){
		header('Location: index.php?a=home');
	}
	require_once './funkcje/RaportyFunctions.php';
    require_once './funkcje/UsersFunction.php';

	if (!isset($_GET['uid']) && !isset($_GET['view'])) {
		$strona1 = true;
		$strona2 = false;
		$strona3 = false;
	} elseif (isset($_GET['uid']) && !isset($_GET['view'])) {
		if($perm['raporty_uzytkownicy_reset'] == '0'){
			header('Location: index.php?a=raporty-użytkownicy');
		} else {
			$id = vtxt($_GET['uid']);
			$uzytkownik = getUser($id);
			$role_uzytkownika = row("SELECT * FROM rangi WHERE id = ".$uzytkownik['stanowisko']);
			$login_uzytkownik = '<a href="index.php?a=profile&p='.$uzytkownik['id'].'" style="color: '.$role_uzytkownika['kolor'].'">['.$role_uzytkownika['kod_roli'].''.$uzytkownik['nr_sluzbowy'].'] '.$uzytkownik['login'].'</a>';
			$strona1 = false;
			$strona2 = true;
			$strona3 = false;
		}

	} elseif (!isset($_GET['uid']) && isset($_GET['view'])) {
		$id = vtxt($_GET['view']);
		$xd1 = row("SELECT * FROM raporty WHERE id = ".$id);
		// if($xd1['uid'] != $user['id']){
		// 	header('Location: index.php?a=raporty');
		if($xd1['status'] == 0 && $xd1['typ_kursu'] != 5){
		 	header('Location: index.php?a=raporty');
		} else {
			$strona1 = false;
			$strona2 = false;
			$strona3 = true;
		}
	}

	if (isset($_SESSION['danger']))
	{
		echo throwInfo('danger', $_SESSION['danger'], true);
		unset($_SESSION['danger']);
	}
	if (isset($_SESSION['success']))
	{
		echo throwInfo('success', $_SESSION['success'], true);
		unset($_SESSION['success']);
	}
	if (isset($_SESSION['info']))
	{
		echo throwInfo('info', $_SESSION['info'], true);
		unset($_SESSION['info']);
	}
	if (isset($_SESSION['warning']))
	{
		echo throwInfo('warning', $_SESSION['warning'], true);
		unset($_SESSION['warning']);
	}
?>
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Raporty Użytkowników</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="index.php?a=home">Panel Zarządu</a></li>
						<li class="breadcrumb-item active">Raporty</li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<?php if($strona1):?>
                    <div class="col-lg-12">
                        <div class="card shadow mb-4">
                            <div class="card-header">
                                <div class="float-left">
                                    <h3 class="m-0 font-weight-bold">Raporty Użytkowników</h3>
                                </div>
                            </div>
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
	                                <?php
	                                    $uzytkownik = call("SELECT * FROM users WHERE stanowisko != 21 AND stanowisko != 22 AND deleted = 0 ORDER BY nr_sluzbowy");
	                                    if ($uzytkownik->num_rows == 0):
											echo
											'<div class="card-body">
												<div class="alert alert-warning">
													<h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
													Brak Wyników!
												</div>
											</div>';
										else :
	                                        while($row = mysqli_fetch_array($uzytkownik)):
	                                            $role_uzytkownika = row("SELECT * FROM rangi WHERE id = ".$row['stanowisko']);
	                                            $login_usera = '<a href="index.php?a=profile&p='.$row['id'].'" style="color: '.$role_uzytkownika['kolor'].'">['.$role_uzytkownika['kod_roli'].''.$row['nr_sluzbowy'].'] '.$row['login'].'</a>';
	                                            echo '
	                                                <div class="col-3">
	                                                    <div class="card shadow mb-4">
	                                                        <div class="card-header">
	                                                            <h3 class="m-0 font-weight-bold">'.$login_usera.'</h3>
	                                                        </div>
	                                                        <div class="card-body">
	                                                            <ul class="list-group list-group-unbordered mb-3">
	                                                                <li class="list-group-item">
	                                                                    <b>Punkty</b><b class="float-right">'.$row['punkty'].' pkt</b>
	                                                                </li>
																	<li class="list-group-item">
	                                                                    <b>Przejechane kilometry</b><b class="float-right">'.$row['kilometry'].' km</b>
	                                                                </li>
	                                                                <li class="list-group-item">
	                                                                    <b>Ilość zaliczonych raportów</b><b class="float-right" style="color: #009900">'.$row['raporty'].'</b>
	                                                                </li>
	                                                                <li class="list-group-item">
	                                                                    <b>Ilość niezaliczonych raportów</b><b class="float-right" style="color: #ff0000">'.$row['nieraporty'].'</b>
	                                                                </li>
	                                                                <li class="list-group-item">
	                                                                    <b>Ilość anulowanych raportów</b><b class="float-right" style="color: #7901ff">'.user_anuluj_raporty_count($row).'</b>
	                                                                </li>
	                                                            </ul>';
																if($perm['raporty_uzytkownicy_reset']){
																	echo '<a class="btn btn-outline-info" href="index.php?a=raporty-użytkownicy&uid='.$row['id'].'">Wybierz</a>';
																} else {
																}
	                                                       echo '</div>
	                                                    </div>
	                                                </div>
	                                            ';
	                                        endwhile;
	                                    endif;
	                                ?>
                                </div>
                            </div>
                        </div>
                    </div>
				<?php elseif($strona2):?>
                    <div class="col-12">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <div class="float-left">
                                    <h4>Raporty użytkownika <?=$login_uzytkownik?></h4>
                                </div>
                                <div class="float-right">
                                    <a class="btn btn-outline-info" href="index.php?a=raporty-użytkownicy">Powrót do listy</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
						<div class="card shadow mb-4">
                            <a href="#collapseRaportOczekujace" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseRaportOczekujace">
								<div class="float-left">
									<h6 class="m-0 font-weight-bold">Raporty oczekujące na złożenie</h6>
								</div>
								<div class="float-right">
									<span class="badge bg-info">
										<?php
											$raport = array('typ' => 'oczekuje');
											echo raporty_count_user($raport, $uzytkownik)
										?>
									</span>
								</div>
                            </a>
                            <!-- Card Content - Collapse -->
                            <div class="collapse show" id="collapseRaportOczekujace">
								<?php echo raporty_oczekuja_user($uzytkownik);?>
                            </div>
                        </div>
					</div>

					<div class="col-lg-12">
						<div class="card shadow mb-4">
                            <a href="#collapseRaportZlozone" class="d-block card-header py-3 collapsed" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseRaportZlozone">
								<div class="float-left">
									<h6 class="m-0 font-weight-bold">Raporty złożone</h6>
								</div>
								<div class="float-right">
									<span class="badge bg-success">
										<?php
											$raport = array('typ' => 'zlozone');
											echo raporty_count_user($raport, $uzytkownik)
										?>
									</span>
								</div>
                            </a>
                            <div class="collapse" id="collapseRaportZlozone">
								<?php echo raporty_zlozone_zarzad($uzytkownik);?>
                            </div>
                        </div>
						<!-- /.card -->
					</div>

					<div class="col-lg-12">
						<div class="card shadow mb-4">
                            <a href="#collapseRaportNieZlozone" class="d-block card-header py-3 collapsed" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseRaportNieZlozone">
								<div class="float-left">
									<h6 class="m-0 font-weight-bold">Raporty niezłożone</h6>
								</div>
								<div class="float-right">
									<span class="badge bg-danger">
										<?php
											$raport = array('typ' => 'nie-zlozone');
											echo raporty_count_user($raport, $uzytkownik)
										?>
									</span>
								</div>
                            </a>
                            <!-- Card Content - Collapse -->
                            <div class="collapse" id="collapseRaportNieZlozone" style="">
								<?php echo raporty_nie_zlozone_zarzad($uzytkownik);?>
                            </div>
                        </div>
						<!-- /.card -->
					</div>
				<?php elseif($strona3):?>
					<?php
						$sluzba = $xd1['linia']. '/'. $xd1['brygada']. '/'. $xd1['zmiana'];
						$dzien_sluzby = date('d.m.Y',$xd1['data']);
						if(!empty($xd1['stanpierwszy']) && !empty($xd1['stanostatni'])){
							$suma_km = $xd1['stanostatni'] - $xd1['stanpierwszy'];
						} else {
							$xd1['stanpierwszy'] = 0;
							$xd1['stanostatni'] = 0;
							$suma_km = 0;
						}
						if(!empty($xd1['link1']) && !empty($xd1['stanostatni'])){
							$xd1['link1'] = $xd1['link1'];
							$xd1['link2'] = $xd1['link2'];
						} else {
							$xd1['link1'] = '../kursowki/brak_fotki.png';
							$xd1['link2'] = '../kursowki/brak_fotki.png';
						}

						if($xd1['did'] != 0){
							$dyspozytor = row("SELECT * FROM users WHERE id =".$xd1['sid']);
							$dyspozytor_ranga = row("SELECT * FROM rangi WHERE id =".$dyspozytor['stanowisko']);
							$login_dyspozytor = '<a href="index.php?a=profile&p='.$dyspozytor['id'].'" style="color: '.$dyspozytor_ranga['kolor'].'">['.$dyspozytor_ranga['kod_roli'].''.$dyspozytor['nr_sluzbowy'].'] '.$dyspozytor['login'].'</a>';
						} else {
							$login_dyspozytor = 'brak danych!';
						}

						if($xd1['uid'] != 0){
							$kierowca = row("SELECT * FROM users WHERE id =".$xd1['uid']);
							$kierowca_ranga = row("SELECT * FROM rangi WHERE id =".$kierowca['stanowisko']);
							$login_kierowcy = '<a href="index.php?a=profile&p='.$kierowca['id'].'" style="color: '.$kierowca_ranga['kolor'].'">['.$kierowca_ranga['kod_roli'].''.$kierowca['nr_sluzbowy'].'] '.$kierowca['login'].'</a>';
						} else {
							$login_kierowcy = 'brak danych!';
						}

						if($xd1['sid'] != 0){
							$sprawdzajacy = row("SELECT * FROM users WHERE id =".$xd1['sid']);
							$sprawdzajacy_ranga = row("SELECT * FROM rangi WHERE id =".$sprawdzajacy['stanowisko']);
							$login_sprawdzajacy = '<a href="index.php?a=profile&p='.$sprawdzajacy['id'].'" style="color: '.$sprawdzajacy_ranga['kolor'].'">['.$sprawdzajacy_ranga['kod_roli'].''.$sprawdzajacy['nr_sluzbowy'].'] '.$sprawdzajacy['login'].'</a>';
						} else {
							$login_sprawdzajacy = 'brak danych!';
						}

						if(!empty($xd1['pojazd'])){
							$dane_pojazd = row("SELECT * FROM tabor WHERE id =".$xd1['pojazd']);
							if($dane_pojazd){
								$pojazd = $dane_pojazd['marka']. ' '. $dane_pojazd['model']. ' #'. $dane_pojazd['taborowy'];
							} else {
								$pojazd = 'pojazd usunięty!';
							}
						} else {
							$pojazd = 'brak danych!';
						}

						if(!empty($xd1['data_sprawdzenia'])){
							$data_sprawdzenia = $xd1['data_sprawdzenia'];
						} else {
							$data_sprawdzenia = 'brak danych!';
						}

						if(!empty($xd1['uwagi'])){
							$uwagi = $xd1['uwagi'];
						} else {
							$uwagi = '';
						}
						switch($xd1['typ_kursu']){
							case '1': $typ_sluzby = 'Kurs Grafikowy'; break; // Strona główna
							case '2': $typ_sluzby = 'Kurs z Wolnego'; break; // Strona główna
							case '5': $typ_sluzby = 'Anulowany'; break; // Strona główna
							case '6': $typ_sluzby = 'Rezerwa'; break; // Strona główna
						}

						if(!empty($xd1['statystyka'])){
							$statystyka = '<a href="./dist/dokumenty/'.$xd1['statystyka'].'" target="_blank" class="btn btn-outline-success">Podsumowanie przejazdów</a>';
						} else {
							$statystyka = '<a class="btn btn-outline-danger" disabled>Brak podsumowania przejazdów</a>';
						}
					?>
					<div class="col-lg-12">
						<div class="card shadow mb-4">
							<div class="card-header">
								<h3 class="m-0 font-weight-bold">Raport służby <?=$sluzba?> z dnia <?=$dzien_sluzby?></h3>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-lg-8">
										<div class="row">
											<div class="col-lg-6">
												<h5>Informacje</h5>
												<p>
													<b>Kierowca:</b> <span><?=$login_kierowcy?></span><br>
													<b>Przewoźnik:</b> <span>ZTM Ostaszewo</span>
													<br>
													<br>
													<b>Data służby:</b> <span><?=$dzien_sluzby?></span><br>
													<b>Typ służby:</b> <span><?=$typ_sluzby?></span><br>
													<b>Pojazd:</b> <span><?=$pojazd?></span><br>
													<b>Dyspozytor:</b> <span><?=$login_dyspozytor?></span><br>
													<b>Uwagi dyspozytora:</b> <span>brak danych</span>
													<br>
													<br>
													<b>Data oddania raportu:</b> <span>brak danych</span><br>
													<b>Uwagi kierowcy:</b> <span><?=$uwagi?></span><br>
												</p>
												<p>
													<?=$statystyka?>
												</p>
											</div>
											<div class="col-lg-6">
												<h5>Stany liczników</h5>
												<ul>
													<li><strong>Początkowy przystanek:</strong><br> <?=$xd1['stanpierwszy'];?> km</li>
													<li><strong>Ostatni przystanek:</strong><br> <?=$xd1['stanostatni'];?> km</li>
												</ul>

												<p>
													<strong>Razem przejechano: </strong><?=$suma_km?> km
												</p>

											</div>
										</div>
									</div>
									<div class="col-lg-4">
										<h5 style="margin-top: 10px;">Zrzuty ekranu</h5>
										<br>
										<div class="text-center">
											<div class="row">
												<div class="col-lg-3">
													<h6> Początkowy przystanek</h6>
													<img style="width: 100%;" src="<?=$xd1['link1']?>" alt="Początkowy przystanek" width="100">
												</div>
												<div class="col-lg-3">
													<h6> Ostatni przystanek</h6>
													<img style="width: 100%;" src="<?=$xd1['link2']?>" alt="Ostatni przystanek" width="100">
												</div>
											</div>
										</div>

									</div>
									<div class="col-lg-12" style="border-top: 3px solid #505962">
										<br>
										<?php
											if($xd1['status'] == 0 && $xd1['status2'] == 0 && $xd1['typ_kursu'] == 5){
												echo '<h5><b style="color: #9113B0;"><i class="fas fa-times-circle"></i> Anulowany</b></h5>';
												echo '<p>
													<b>Anulował:</b> <span>'.$login_sprawdzajacy.'</span><br>
													<b>Data:</b> <span>'.$data_sprawdzenia.'</span><br>
													<b>Powód:</b><span>'.$xd1['uwagi2'].'</span><br>
												</p>';
											} elseif ($xd1['status2'] == 0) {
												echo '<h5><b style="color: #cccc00;">Oczekuje na sprawdzenie</b></h5>';
											} elseif ($xd1['status2'] == 1) {
												echo '<h5><b style="color: #ff0000;"><i class="fas fa-check-circle"></i> Zaliczony</b></h5>';
												echo '<p>
													<b>Sprawdzający:</b> <span>'.$login_sprawdzajacy.'</span><br>
													<b>Sprawdzono:</b> <span>'.$data_sprawdzenia.'</span><br>
													<b>Punkty:</b><span> '.$xd1['punkty'].'</span><br>
													<b>Uwagi:</b><br><span>'.$xd1['uwagi2'].'</span>.
												</p>';
											} elseif ($xd1['status2'] == 2) {
												echo '<h5><b style="color: #ff0000;"><i class="fas fa-times-circle"></i> Niezaliczony</b></h5>';
												echo '<p>
													<b>Sprawdzający:</b> <span>'.$login_sprawdzajacy.'</span><br>
													<b>Sprawdzono:</b> <span>'.$data_sprawdzenia.'</span><br>
													<b>Punkty:</b><span> '.$xd1['punkty'].'</span><br>
													<b>Uwagi:</b><br><span>'.$xd1['uwagi2'].'</span>.
												</p>';
											} elseif ($xd1['status2'] == 3) {
												echo '<h5><b style="color: #ff0000;"><i class="fas fa-times-circle"></i> Niezłożony</b></h5>';

											}
										?>

									</div>
								</div>
							</div>
						  <!-- /.card-body -->
						</div>
					</div>
				<?php endif;?>
			</div>
			<!-- /.row -->
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->
