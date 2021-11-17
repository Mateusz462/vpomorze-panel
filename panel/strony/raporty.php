<?php

	hasPermissionTo('security', $user_role, 'access_raporty');
	require_once './funkcje/RaportyFunctions.php';
	// $date = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
	// $wczoraj = mktime(0, 0, 0, date("m"), date("d")-1, date("Y"));
	// $cos = row("SELECT * FROM users WHERE id =".$user['id']);
	// $jakas = row("SELECT * FROM raporty WHERE uid = ".$user['id']." AND status = 0 AND data < ".$date." AND typ_kursu != 5");
	// if($jakas){
	// 	$elo = call("UPDATE raporty SET status = 1, status2 = 3 WHERE id='".$jakas['id']."'");
	// 	$rapn = $cos['nieraporty'] + 1;
	// 	$elo2 = call("UPDATE users SET nieraporty = '".$rapn."' WHERE id = '".$cos['id']."'");
	// 	throwInfo('info', 'Wczytywanie Raportów', true);
	// } else {
	// 	throwInfo('info', 'Poprawnie Wczytano Raporty', true);
	// }

	if (!isset($_GET['add']) && !isset($_GET['view'])) {
		// echo round(15.7, 2), '<br>';
		// echo round(30.2, 2), '<br>';
		// echo round(round(30.2, 2)-round(15.7, 2), 2), '<br>';
		$strona1 = true;
		$strona2 = false;
		$strona3 = false;
		$loader = false;
	} elseif (isset($_GET['add']) && !isset($_GET['view'])) {
		$id = vtxt($_GET['add']);
		$xd = row("SELECT * FROM raporty WHERE id = ".$id);
		$dane = raporty_dane($id);
		if(!empty($_POST)){
			$strona1 = false;
			$strona2 = true;
			$strona3 = false;
			$loader = false;
			if (empty($_FILES) || !isset($_FILES['statystyka']) || empty($_POST['pierwszy']) || empty($_POST['ostatni']) || empty($_POST['stanpierwszy']) || empty($_POST['stanostatni'])) {
				throwInfo('danger', 'Wypełnij wszystkie pola!', true);
			} else {
				$tytul = 'Użytkownik '.$dane['login_kierowcy_paste'].' złożył raport za służbę '.$dane['sluzba'].' z dnia '.$dane['dzien_sluzby'].'';
				$pierwszy = vtxt($_POST['pierwszy']);
				$ostatni = vtxt($_POST['ostatni']);
				$stanpierwszy = vtxt($_POST['stanpierwszy']);
				$stanostatni = vtxt($_POST['stanostatni']);
				$statystyka = $_FILES['statystyka'];
				$uwagi = vtxt($_POST['uwagi']);
				//echo $statystyka_link = pastebin_create($statystyka, $tytul);
				raport_user_zloz($id, $statystyka, $pierwszy, $ostatni, $stanpierwszy, $stanostatni, $uwagi);
			}

		} else {
			if($xd['uid'] != $user['id']){
				header('Location: index.php?a=raporty');
			} elseif($xd['status'] == 1 || $xd['status2'] != 0 || $xd['typ_kursu'] == 5){
				header('Location: index.php?a=raporty');
			} else {
				$strona1 = false;
				$strona2 = true;
				$strona3 = false;
				$loader = false;
			}
		}
	} elseif (!isset($_GET['add']) && isset($_GET['view'])) {
		$id = vtxt($_GET['view']);
		$xd1 = row("SELECT * FROM raporty WHERE id = ".$id);

		$dane = raporty_dane($id);
		if($xd1['uid'] != $user['id']){
			$_SESSION['danger'] = 'Nie masz dostępu!';
			header('Location: index.php?a=raporty');
		} elseif($xd1['status'] == 0 && $xd1['status2'] != 4){
			$_SESSION['danger'] = 'cos!';
			header('Location: index.php?a=raporty');
		} else {
			$strona1 = false;
			$strona2 = false;
			$strona3 = true;
			$loader = false;
		}
	}
?>
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Raporty</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="index.php?a=home">Panel Kierowcy</a></li>
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
				<?php if($loader):?>
					<div class="col-lg-12">
						<div class="card shadow mb-4">
							<div class="card-body text-center">
								<div class="spinner-border" role="status"></div>
								<span class="visually-hidden">Loading...</span>
							</div>
						</div>
					</div>
				<?php elseif($strona1):?>
					<div class="col-lg-12">
						<div class="card shadow mb-4">
							<button class="card-header btn py-3" type="button" data-toggle="collapse" data-target="#collapseRaportOczekujace" aria-expanded="false" aria-controls="collapseRaportOczekujace">
								<div class="float-left">
									<h6 class="m-0 font-weight-bold">Raporty oczekujące na złożenie</h6>
								</div>
								<div class="float-right">
									<span class="badge bg-info">
										<?php
											$raport = array('typ' => 'oczekuje');
											echo raporty_count_user($raport, $user)
										?>
									</span>
								</div>
							</button>
                            <!-- Card Content - Collapse -->
                            <div class="collapse show" id="collapseRaportOczekujace">
								<?php echo raporty_oczekuja_user($user);?>
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
											echo raporty_count_user($raport, $user)
										?>
									</span>
								</div>
                            </a>
                            <div class="collapse" id="collapseRaportZlozone">
								<?php echo raporty_zlozone_user($user);?>
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
											echo raporty_count_user($raport, $user)
										?>
									</span>
								</div>
                            </a>
                            <!-- Card Content - Collapse -->
                            <div class="collapse" id="collapseRaportNieZlozone" style="">
								<?php echo raporty_nie_zlozone_user($user);?>
                            </div>
                        </div>
						<!-- /.card -->
					</div>
				<?php elseif($strona2):?>
					<div class="col-lg-12">
						<div class="card shadow mb-4">
							<div class="card-header">
								<h3 class="m-0 font-weight-bold">Złóż raport za służbę <?=$dane['sluzba']?> z dnia <?=$dane['dzien_sluzby']?></h3>
							</div>
							<form action="index.php?a=raporty&add=<?=$id?>" method="POST" enctype="multipart/form-data">
								<div class="card-body">
									<div class="row">
										<div class="col-lg-6">
											<p>
												<b>Kierowca:</b> <span><?=$dane['login_kierowcy']?></span><br>
												<b>Przewoźnik:</b> <span>ZTM Ostaszewo</span>
											</p>
										</div>
										<div class="col-lg-6">
											<p>
												<b>Data służby:</b> <span><?=$dane['dzien_sluzby']?></span><br>
												<b>Typ służby:</b> <span><?=$dane['typ_sluzby']?></span><br>
												<b>Pojazd:</b> <span><?=$dane['pojazd']?></span><br>
												<b>Dyspozytor:</b> <span><?=$dane['login_dyspozytor']?></span><br>
												<b>Uwagi dyspozytora:</b> <span>brak danych</span>
											</p>
											<br>
										</div>
										<div class="col-lg-12" style="border-top: 3px solid #505962">
											<br>
											<div class="row">
												<div class="col-lg-4">
													<h4>1. Podaj stany liczników</h4>
													<p>
														<div class="form-group">
															<label for="stanpierwszy"><b>Stan licznika - pierwszy przystanek</b></label>
															<input id="stanpierwszy" type="text" name="stanpierwszy" class="form-control" placeholder="Stan Licznika" >
														</div>
														<div class="form-group">
															<label for="stanostatni"><b>Stan licznika - ostatni przystanek</b></label>
															<input id="stanostatni" type="text" name="stanostatni" class="form-control" placeholder="Stan Licznika" >
														</div>
													</p>
												</div>
												<div class="col-lg-4">
													<h4>2. Podaj linki do zdjęć</h4>
													<p>
														<div class="form-group">
															<label for="pierwszy"><b>Zdjęcie z pierwszego przystanku</b></label>
															<input id="pierwszy" type="text" name="pierwszy" class="form-control" placeholder="Link" >
														</div>
														<div class="form-group">
															<label for="ostatni"><b>Zdjęcie z ostatniego przystanku</b></label>
															<input id="ostatni" type="text" name="ostatni" class="form-control" placeholder="Link" >
														</div>
													</p>
													<br>
												</div>
												<div class="col-lg-4">
													<h4>3. Inne</h4>
													<p>
														<div class="form-group">
															<label for="uwagi"><b>Uwagi</b></label>
															<textarea class="form-control" name="uwagi" id="uwagi" rows="5" placeholder="Uwagi"></textarea>
														</div>
													</p>
												</div>
												<div class="col-lg-12">
													<h4>4. Wklej podsumowanie z gry</h4>
													<p>
														<div class="form-group">
															<label for="statystyka"><b>Statystyka przejazdu</b></label>
															<input type="file" class="form-control" name="statystyka" id="statystyka" rows="15" placeholder="Statystyka przejazdu" >
														</div>
													</p>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="card-footer d-flex justify-content-between">
									<a href="index.php?a=raporty" class="btn btn-outline-danger btn-lg"><i class="far fa-caret-square-left"></i> Powrót</a>
									<button type="submit" class="btn btn-outline-success btn-lg"><i class="fas fa-paper-plane"></i> Wyslij</button>
								</div>
							</form>
						  <!-- /.card-body -->
						</div>
					</div>
				<?php elseif($strona3):?>

					<div class="col-lg-12">
						<div class="card shadow mb-4">
							<div class="card-header">
								<h3 class="m-0 font-weight-bold">Raport służby <?=$dane['sluzba']?> z dnia <?=$dane['dzien_sluzby']?></h3>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-lg-8">
										<div class="row">
											<div class="col-lg-6">
												<h5>Informacje</h5>
												<p>
													<b>Kierowca:</b> <span><?=$dane['login_kierowcy']?></span><br>
													<b>Przewoźnik:</b> <span>ZTM Ostaszewo</span>
													<br>
													<br>
													<b>Data służby:</b> <span><?=$dane['dzien_sluzby']?></span><br>
													<b>Typ służby:</b> <span><?=$dane['typ_sluzby']?></span><br>
													<b>Pojazd:</b> <span><?=$dane['pojazd']?></span><br>
													<b>Dyspozytor:</b> <span><?=$dane['login_dyspozytor']?></span><br>
													<b>Uwagi dyspozytora:</b> <span><?=$dane['uwagi_dyspozytor']?></span>
													<br>
													<br>
													<b>Data oddania raportu:</b> <span><?=$dane['data_oddania_raportu']?></span><br>
													<b>Uwagi kierowcy:</b> <span><?=$dane['uwagi_kierowcy']?></span><br>
												</p>
												<p>
													<?=$dane['statystyka']?>
												</p>
											</div>
											<div class="col-lg-6">
												<h5>Stany liczników</h5>
												<ul>
													<li><strong>Początkowy przystanek:</strong><br> <?=$dane['licznik1'];?> km</li>
													<li><strong>Ostatni przystanek:</strong><br> <?=$dane['licznik2'];?> km</li>
												</ul>

												<p>
													<strong>Razem przejechano: </strong><?=$dane['suma_km']?> km
												</p>

											</div>
										</div>
									</div>
									<div class="col-lg-4">
										<h5 style="margin-top: 10px;">Zrzuty ekranu</h5>
										<br>
										<div class="text-center">
											<div class="row">
												<div class="col-lg-6">
													<h6> Początkowy przystanek</h6>
													<a href="<?=$dane['link1']?>" target="_blank"><img style="width: 100%;" src="<?=$dane['link1']?>" alt="Początkowy przystanek" width="100"></a>
												</div>
												<div class="col-lg-6">
													<h6> Ostatni przystanek</h6>
													<a href="<?=$dane['link2']?>" target="_blank"><img style="width: 100%;" src="<?=$dane['link2']?>" alt="Ostatni przystanek" width="100"></a>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-12" style="border-top: 3px solid #505962">
										<br>
										<?php
											if ($xd1['status2'] == 0) {
												echo '<h5><b style="color: #cccc00;">Oczekuje na sprawdzenie</b></h5>';
											} elseif ($xd1['status2'] == 1) {
												echo '<h5><b style="color: #009900;"><i class="fas fa-check-circle"></i> Zaliczony</b></h5>';
												echo '<p>
													<b>Sprawdzający:</b> <span>'.$dane['login_sprawdzajacy'].'</span><br>
													<b>Sprawdzono:</b> <span>'.$dane['data_sprawdzenia'].'</span><br>
													<b>Punkty:</b><span> '.$dane['punkty'].'</span><br>
													<b>Uwagi:</b><br><span>'.$dane['uwagi_sprawdzajacy'].'</span>
												</p>';
											} elseif ($xd1['status2'] == 2) {
												echo '<h5><b style="color: #ff0000;"><i class="fas fa-times-circle"></i> Niezaliczony</b></h5>';
												echo '<p>
													<b>Sprawdzający:</b> <span>'.$dane['login_sprawdzajacy'].'</span><br>
													<b>Sprawdzono:</b> <span>'.$dane['data_sprawdzenia'].'</span><br>
													<b>Punkty:</b><span> '.$dane['punkty'].'</span><br>
													<b>Uwagi:</b><br><span>'.$dane['uwagi_sprawdzajacy'].'</span>
												</p>';
											} elseif ($xd1['status2'] == 3) {
												echo '<h5><b style="color: #ff0000;"><i class="fas fa-times-circle"></i> Niezłożony</b></h5>';
											}  elseif ($xd1['status2'] == 4) {
												echo '<h5><b style="color: #9113B0;"><i class="fas fa-times-circle"></i> Anulowany</b></h5>';
												echo '<p>
													<b>Anulował:</b> <span>'.$dane['login_sprawdzajacy'].'</span><br>
													<b>Data:</b> <span>'.$dane['data_sprawdzenia'].'</span><br>
													<b>Powód:</b> <span>'.$dane['uwagi_sprawdzajacy'].'</span><br>
												</p>';
											}
										?>
									</div>
								</div>
							</div>
							<div class="card-footer d-flex justify-content-between">
								<a href="index.php?a=raporty" class="btn btn-outline-danger btn-lg"><i class="far fa-caret-square-left"></i> Powrót</a>
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
