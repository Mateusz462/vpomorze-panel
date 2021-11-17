<?php
	if($perm['zarzadzanie raportami'] == '0'){
		header('Location: index.php?a=home');
	}

	$miesiac = date("m");
	$dzien = date("d");
	$rok = date("Y");
	$date = mktime(0, 0, 0, $miesiac, $dzien, $rok);
	$wczoraj = mktime(0, 0, 0, $miesiac, $dzien-1, $rok);
    require_once './funkcje/RaportyFunctions.php';


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
					<h1>Nadzór Ruchu</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="index.php?a=home">Panel Kierowcy</a></li>
						<li class="breadcrumb-item active">Nadzór Ruchu</li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<?php if (!isset($_GET['action'])):?>
					<div class="col-lg-9">
						<div class="card shadow mb-4">
                            <button class="card-header btn py-3 collapsed" type="button" data-toggle="collapse" data-target="#collapseRaportOczekujace" aria-expanded="false" aria-controls="collapseRaportOczekujace">
								<h6 class="m-0 font-weight-bold" style="color: #cccc00">Raporty oczekujące na ocenę</h6>
							</button>
                            <!-- Card Content - Collapse -->
                            <div class="collapse" id="collapseRaportOczekujace">
								<?php echo raporty_zarzad('do-ocenienia');?>
                            </div>
							<!-- /.card-body -->
						</div>
						<!-- /.card -->
                        <div class="card shadow mb-4">
                            <button class="card-header btn py-3 collapsed" type="button" data-toggle="collapse" data-target="#collapseRaportyRozpatrzone" aria-expanded="false" aria-controls="collapseRaportyRozpatrzone">
								<h6 class="m-0 font-weight-bold" style="color: #009900">Raporty rozpatrzone</h6>
							</button>
                            <!-- Card Content - Collapse -->
                            <div class="collapse" id="collapseRaportyRozpatrzone">
								<?php echo raporty_zarzad('rozpatrzone');?>
                            </div>
							<!-- /.card-body -->
						</div>
                        <div class="card shadow mb-4">
                            <button class="card-header btn py-3 collapsed" type="button" data-toggle="collapse" data-target="#collapseRaportyNieZlozone" aria-expanded="false" aria-controls="collapseRaportyNieZlozone">
                                <h6 class="m-0 font-weight-bold" style="color: #ff0000">Raporty niezłożone</h6>
							</button>
                            <!-- Card Content - Collapse -->
                            <div class="collapse" id="collapseRaportyNieZlozone">
								<?php echo raporty_zarzad('niezlozone');?>
                            </div>
							<!-- /.card-body -->
						</div>
                        <div class="card shadow mb-4">
                            <button class="card-header btn py-3 collapsed" type="button" data-toggle="collapse" data-target="#collapseRaportyAnulowane" aria-expanded="false" aria-controls="collapseRaportyAnulowane">
								<h6 class="m-0 font-weight-bold" style="color: #9113B0">Raporty anulowane</h6>
							</button>
                            <!-- Card Content - Collapse -->
                            <div class="collapse" id="collapseRaportyAnulowane">
								<?php echo raporty_zarzad('anulowane');?>
                            </div>
							<!-- /.card-body -->
						</div>

                        <div class="card shadow mb-4">
                            <button class="card-header btn py-3 collapsed" type="button" data-toggle="collapse" data-target="#collapseRaportyDoZlozenia" aria-expanded="false" aria-controls="collapseRaportyDoZlozenia">
								<h6 class="m-0 font-weight-bold" style="color: #137cb0">Raporty oczekujące na złożenie</h6>
							</button>
                            <!-- Card Content - Collapse -->
                            <div class="collapse" id="collapseRaportyDoZlozenia">
								<?php echo raporty_zarzad('do-zlozenia');?>
                            </div>
							<!-- /.card-body -->
						</div>
					</div>
                    <div class="col-lg-3">
						<div class="card shadow mb-4 border-light mb-3">
							<div class="card-header py-3">
								<h3 class="m-0 font-weight-bold">Informacje</h3>
							</div>
							<!-- /.card-header -->
							<div class="card-body">
                                <p>
                                    <span>§2. Zasady pracy na służbie:</span><br>
                                    <span>1. Kierowca oraz Motorniczy ma obowiązek wykonania minimum jednego kursu z (pętli A do
                                    B).</span><br>
                                    <span>2. Maksymalny etat Kierowcy wynosi 5/7 dni etatowych, a minimalny 1/7 dni etatowych.</span><br>
                                    <span>3. Maksymalny etat Motorniczego wynosi 4/7 dni etatowych, a minimalny 1/7 dni etatowych.</span><br>
                                    <span>4. W przypadku niewykonania służby, należy ją odrobić poprzez KzW (Kurs z Wolnego).</span><br>
                                    <span>5. Każdy Kierowca oraz Motorniczy ma obowiązek trzymania się tolerancji czasowej (+1:30/- 3:00).
                                    <span>W przypadku opóźnienia, należy to usprawiedliwić w polu "Uwagi" podczas zdawania
                                    raportu.</span><br>
                                    <span>6. Wozy ukazują się w grafiku, w dniu kursu o godzinie 00:00.</span><br>
                                    <span>7. Kierowcy oraz Motorniczy mają 24h na zdanie raportu, od momentu pojawienia się wozu
                                    w grafiku (tj. od godziny 00:00)</span><br>
                                    <span>8. Kierowcy mają obowiązek zablokowania pierwszej połówki drzwi, jeżeli autobus posiada
                                    taką możliwość.</span><br>
                                    <span>9. Podczas zdawania raportu, należy poprawnie przepisać stan licznika z początku oraz
                                    końca służby.</span><br>
                                    <span>10. Kierowca ma obowiązek utrzymywania stałej temperatury 19°C z dopuszczalną
                                    tolerancją (+/-3°C). W przypadku gdy pojazd nie ma działającej klimatyzacji, należy
                                    otworzyć okna oraz szyberdachy.</span><br>
                                    <span>11. Zrzut ekranu należy wykonać w taki sposób, aby był na nim widoczny prawy bok, oraz
                                    przód pojazdu. Należy także uwzględnić na nich rozwinięty pasek informacji (min. 2x
                                    SHIFT+Y)</span><br>
                                    <span>12. Obowiązuje bezwzględny zakaz tankowania pojazdu podczas trwania służby.</span><br>
                                    <span>13. W przypadku awarii pojazdu, należy ją zgłosić poprzez zakładkę „Zgłoszenia”. Znajduje
                                    się tam specjalny formularz, który należy wypełnić aby otrzymać podmianę wozu, w
                                    przypadku kiedy kontynuacja kursu nie będzie możliwa obecnym pojazdem.</span><br>
                                    <span>14. OC* należy wykonać na terenie zajezdni, aby otrzymać bonifikatę punktową.</span><br>
                                    <span>15. Podczas wykonywania OC*, należy zrobić zrzut ekranu autobusu obok stacji lub myjni, a
                                    następnie umieścić link do zdjęcia w polu "Uwagi".</span><br>
                                    <span>16. Kierowca wykonujący włączenie na linie lub zjazd z linii powinien wykonać screen na
                                    terenie zajezdni.</span><br>
                                    <span>17. Podczas wyjazdu lub zjazdu na wyświetlaczach należy ustawić napis „Przejazd
                                    Techniczny”.</span><br>
                                </p>
                                <p>Cały dokument <b>Zasad Sprawdzania Raportów</b> dostępny <a href="https://drive.google.com/file/d/1kcbGVnOPzT8qsnft8MKxQ_CSCDdhQf2M/view">tutaj</a></p>
                            </div>
                        </div>
                    </div>
                <?php elseif (isset($_GET['action']) && $_GET['action'] == 'sprawdz-raport' && isset($_GET['id'])): ?>
                    <?php
                        $id_raportu = vtxt($_GET['id']);
                        $statusy_raportu = row("SELECT status, status2 FROM raporty WHERE id = $id_raportu");
                        //print_r($statusy_raportu);
                        if($statusy_raportu['status'] == 1 && $statusy_raportu['status2'] == 0){
                            $dane = raporty_dane($id_raportu);
                        } else {
                            $_SESSION['danger'] = 'Brak uprawnień!';
                            header('Location: index.php?a=zarzadzanie-raporty');
                        }

                    ?>
                    <div class="col-xl-3">
						<div class="card shadow mb-4 border-light mb-3">
							<div class="card-header py-3">
								<h3 class="m-0 font-weight-bold">Informacje</h3>
							</div>
							<!-- /.card-header -->
							<div class="card-body">
                                <p>
                                    <span>§2. Zasady pracy na służbie:</span><br>
                                    <span>1. Kierowca oraz Motorniczy ma obowiązek wykonania minimum jednego kursu z (pętli A do
                                    B).</span><br>
                                    <span>2. Maksymalny etat Kierowcy wynosi 5/7 dni etatowych, a minimalny 1/7 dni etatowych.</span><br>
                                    <span>3. Maksymalny etat Motorniczego wynosi 4/7 dni etatowych, a minimalny 1/7 dni etatowych.</span><br>
                                    <span>4. W przypadku niewykonania służby, należy ją odrobić poprzez KzW (Kurs z Wolnego).</span><br>
                                    <span>5. Każdy Kierowca oraz Motorniczy ma obowiązek trzymania się tolerancji czasowej (+1:30/- 3:00).
                                    <span>W przypadku opóźnienia, należy to usprawiedliwić w polu "Uwagi" podczas zdawania
                                    raportu.</span><br>
                                    <span>6. Wozy ukazują się w grafiku, w dniu kursu o godzinie 00:00.</span><br>
                                    <span>7. Kierowcy oraz Motorniczy mają 24h na zdanie raportu, od momentu pojawienia się wozu
                                    w grafiku (tj. od godziny 00:00)</span><br>
                                    <span>8. Kierowcy mają obowiązek zablokowania pierwszej połówki drzwi, jeżeli autobus posiada
                                    taką możliwość.</span><br>
                                    <span>9. Podczas zdawania raportu, należy poprawnie przepisać stan licznika z początku oraz
                                    końca służby.</span><br>
                                    <span>10. Kierowca ma obowiązek utrzymywania stałej temperatury 19°C z dopuszczalną
                                    tolerancją (+/-3°C). W przypadku gdy pojazd nie ma działającej klimatyzacji, należy
                                    otworzyć okna oraz szyberdachy.</span><br>
                                    <span>11. Zrzut ekranu należy wykonać w taki sposób, aby był na nim widoczny prawy bok, oraz
                                    przód pojazdu. Należy także uwzględnić na nich rozwinięty pasek informacji (min. 2x
                                    SHIFT+Y)</span><br>
                                    <span>12. Obowiązuje bezwzględny zakaz tankowania pojazdu podczas trwania służby.</span><br>
                                    <span>13. W przypadku awarii pojazdu, należy ją zgłosić poprzez zakładkę „Zgłoszenia”. Znajduje
                                    się tam specjalny formularz, który należy wypełnić aby otrzymać podmianę wozu, w
                                    przypadku kiedy kontynuacja kursu nie będzie możliwa obecnym pojazdem.</span><br>
                                    <span>14. OC* należy wykonać na terenie zajezdni, aby otrzymać bonifikatę punktową.</span><br>
                                    <span>15. Podczas wykonywania OC*, należy zrobić zrzut ekranu autobusu obok stacji lub myjni, a
                                    następnie umieścić link do zdjęcia w polu "Uwagi".</span><br>
                                    <span>16. Kierowca wykonujący włączenie na linie lub zjazd z linii powinien wykonać screen na
                                    terenie zajezdni.</span><br>
                                    <span>17. Podczas wyjazdu lub zjazdu na wyświetlaczach należy ustawić napis „Przejazd
                                    Techniczny”.</span><br>
                                </p>
                                <p>Cały dokument <b>Zasad Sprawdzania Raportów</b> dostępny <a href="https://drive.google.com/file/d/1kcbGVnOPzT8qsnft8MKxQ_CSCDdhQf2M/view">tutaj</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9">
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
										<div class="row">
											<div class="col-lg-4">
                                        		<h5><b style="color: #cccc00;">Oczekuje na sprawdzenie</b></h5>
											</div>
											<div class="col-lg-8">
												<form action="index.php?a=zarzadzanie-raporty&action=sprawdz-raport&id=<?=$id_raportu?>" method="post">
													<div class="row">
														<div class="col-lg-6">
															<h4>1. Status raportu</h4>
															<p>
																<div class="form-check">
																	<input class="form-check-input" type="radio" name="status" id="status1">
																	<label class="form-check-label" for="status1">
																		Zaliczony
																	</label>
																	 <div class="invalid-feedback">Wybierz ocenę raportu: zaliczony!</div>
																</div>
																<div class="form-check">
																	<input class="form-check-input" type="radio" name="status" id="status2">
																	<label class="form-check-label" for="status2">
																		Niezaliczony
																	</label>
																	 <div class="invalid-feedback">Wybierz ocenę raportu: niezaliczony!</div>
																</div>
															</p>
															<br>
															<h4>2. Punkty</h4>
															<p>
																<div class="form-group">
																	<label for="punkty"><b>Podaj ilość punktów</b></label>
																	<input id="punkty" type="text" name="punkty" class="form-control" placeholder="Punkty" >
																	<div class="invalid-feedback">
																		Uzupełnij pole "Punkty"
																	</div>
																</div>
															</p>
															<br>
															<p>
																<button type="submit" class="btn btn-outline-success btn-lg" id="przycisk" onclick="ZlozWniosek(<?=$id_raportu?>)"><i class="far fa-save"></i> Zapisz</button>
																<button class="btn btn-outline-success btn-lg d-none" type="button" id="przycisk1" disabled>
																	<span class="spinner-grow spinner-grow-sm mb-1"></span>
																	Loading...
																</button>
															</p>
														</div>
														<div class="col-lg-6">
															<h4>3. Inne</h4>
															<p>
																<div class="form-group">
																	<label for="uwagi"><b>Uwagi</b></label>
																	<textarea class="form-control" name="uwagi" id="uwagi" rows="7" placeholder="Uwagi"></textarea>
																	<div class="invalid-feedback">
																		Uzupełnij pole "Uwagi"
																	</div>
																</div>
															</p>
														</div>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="card-footer d-flex justify-content-between">
								<a href="index.php?a=zarzadzanie-raporty" class="btn btn-outline-danger btn-lg"><i class="far fa-caret-square-left"></i> Powrót</a>
							</div>
						  <!-- /.card-body -->
						</div>
                    </div>
				<?php elseif(isset($_GET['action']) && $_GET['action'] == 'podglad-raport' && isset($_GET['id'])):?>
					<?php
                        $id_raportu = vtxt($_GET['id']);
                        $statusy_raportu = row("SELECT status, status2 FROM raporty WHERE id = $id_raportu");
                        //print_r($statusy_raportu);
                        if($statusy_raportu['status'] == 1 && $statusy_raportu['status2'] == 0){
							$_SESSION['danger'] = 'Brak uprawnień!';
							header('Location: index.php?a=zarzadzanie-raporty');
                        } else {
							$dane = raporty_dane($id_raportu);
                        }

                    ?>
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
											if($statusy_raportu['status'] == 0 && $statusy_raportu['status2'] == 0){
												echo '<h5><b style="color: #137cb0">Do złożenia</b></h5>';
											} elseif ($statusy_raportu['status2'] == 0) {
												echo '<h5><b style="color: #cccc00;">Oczekuje na sprawdzenie</b></h5>';
											} elseif ($statusy_raportu['status2'] == 1) {
												echo '<h5><b style="color: #009900;"><i class="fas fa-check-circle"></i> Zaliczony</b></h5>';
												echo '<p>
													<b>Sprawdzający:</b> <span>'.$dane['login_sprawdzajacy'].'</span><br>
													<b>Sprawdzono:</b> <span>'.$dane['data_sprawdzenia'].'</span><br>
													<b>Punkty:</b><span> '.$dane['punkty'].'</span><br>
													<b>Uwagi:</b><br><span>'.$dane['uwagi_sprawdzajacy'].'</span>
												</p>';
											} elseif ($statusy_raportu['status2'] == 2) {
												echo '<h5><b style="color: #ff0000;"><i class="fas fa-times-circle"></i> Niezaliczony</b></h5>';
												echo '<p>
													<b>Sprawdzający:</b> <span>'.$dane['login_sprawdzajacy'].'</span><br>
													<b>Sprawdzono:</b> <span>'.$dane['data_sprawdzenia'].'</span><br>
													<b>Punkty:</b><span> '.$dane['punkty'].'</span><br>
													<b>Uwagi:</b><br><span>'.$dane['uwagi_sprawdzajacy'].'</span>
												</p>';
											} elseif ($statusy_raportu['status2'] == 3) {
												echo '<h5><b style="color: #ff0000;"><i class="fas fa-times-circle"></i> Niezłożony</b></h5>';
											}  elseif ($statusy_raportu['status2'] == 4) {
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
								<a href="index.php?a=zarzadzanie-raporty" class="btn btn-outline-danger btn-lg"><i class="far fa-caret-square-left"></i> Powrót</a>
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
	<?php if (isset($_GET['action']) && $_GET['action'] == 'sprawdz-raport' && isset($_GET['id'])): ?>
		<script type="text/javascript">

			$('#przycisk').prop('disabled', true);
			//definiowanie pĂłl
			let status1 = $('#status1');
			let status2 = $('#status2');
			let punkty = $('#punkty');
			let uwagi = $('#uwagi');


			$("#status1").on("change", function(){
				if($('#status1:checked')) {
					$('#punkty').prop('disabled', false);
					$('#przycisk').prop('disabled', false);
				}
			});

			$("#status2").on("change", function(){
				if($('#status2:checked')) {
					$('#punkty').prop('disabled', true);
					$('#punkty').val('');
					$('#przycisk').prop('disabled', false);
				}
			});

			function ZlozWniosek(id_raportu) {
			    event.preventDefault();
			    const error = walidacjaDodawanie();
			    if (error === 0)
			        dodaj(id_raportu);
			    else
			        alert('Błąd! Wypełnij poprawnie wszystkie wymagane pola.');
			}

			function walidacjaDodawanie() {
				var status1 = $('#status1:checked');
				var status2 = $('#status2:checked');
				if($('#status1').is(':checked')) {
					//$('#punkty').prop('disabled', false);
					//$('#przycisk').prop('disabled', false);
					status1.removeClass("is-invalid");
					status1.addClass("is-valid");
					if (punkty.val().length === 0) {
						err = 1;
						punkty.addClass("is-invalid");
					} else {
						err = 0;
						punkty.removeClass("is-invalid");
						punkty.addClass("is-valid");
					}

					if (uwagi.val().length === 0) {
						err = 1;
						uwagi.addClass("is-invalid");
					} else {
						err = 0;
						uwagi.removeClass("is-invalid");
						uwagi.addClass("is-valid");
					}
				} else if($('#status2').is(':checked')){
					status2.removeClass("is-invalid");
					status2.addClass("is-valid");
					if (uwagi.val().length === 0) {
						err = 1;
						uwagi.addClass("is-invalid");
					} else {
						err = 0;
						uwagi.removeClass("is-invalid");
						uwagi.addClass("is-valid");
					}
				} else if($('#status1').not(':checked') && $('#status2').not(':checked')) {
					err = 1;
					status1.addClass("is-invalid");
					status2.addClass("is-invalid");
				}
				//err = 0;
				return err;
			}

			function dodaj(id_raportu) {

				$("#przycisk").addClass("d-none");
				$("#przycisk1").removeClass("d-none");

				function encodeQueryData(data) {
			        let ret = [];
			        for (let d in data)
			            ret.push(encodeURIComponent(d) + '=' + encodeURIComponent(data[d]));
			        return ret.join('&');
			    }

	            var datalogin = encodeQueryData({
	                'id_raportu': id_raportu,
					'id_sprawdzajacy': <?=$user['id']?>,
	                'status1': $('#status1').is(':checked'),
	                'status2': $('#status2').is(':checked'),
					'punkty': punkty.val(),
	                'uwagi': uwagi.val(),
					'kilometry': <?=$dane['suma_km']?>
	            });

			    $.ajax({
			        type: 'POST',
			        data: datalogin,
			        url: 'json/nadzor_ruchu_raport.php',
			        success: function (data) {
						var dane = JSON.parse(data);
						if (dane.success == 1) {
							alert(dane.text);
							window.location.replace("index.php?a=zarzadzanie-raporty");
						} else if (dane.error == 1) {
							alert(dane.text);
							window.location.replace("index.php?a=zarzadzanie-raporty");
			            }
			        }
			    });
			}

		</script>
	<?php endif;?>
