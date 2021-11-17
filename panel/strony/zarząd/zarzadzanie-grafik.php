<?php
	$dni = array('NIEDZIELA', 'PONIEDZIAŁEK', 'WTOREK', 'ŚRODA', 'CZWARTEK', 'PIĄTEK', 'SOBOTA');
	//echo date('d.m.Y',1627941600);
	//data unix
	//$date = mktime(0, 0, 0, $miesiac, $dzien, $rok);
	//$dates[] = $date;
	require_once 'funkcje/DyspozytorniaFunction.php';

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
					<h1>Grafik</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="index.php?a=home">Panel Kierowcy</a></li>
						<li class="breadcrumb-item active">Grafik</li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<?php
				if(isset($_GET['action']) && $_GET['action'] == 'add-duty' && !empty($_GET['user']) && !empty($_GET['date'])):

					$user_add_duty_id = vtxt($_GET['user']);
					$data_add_duty = vtxt($_GET['date']);
					$data_dodania_kursu = date("d.m.Y", $data_add_duty);

					$tyd = $dni[(date('w', $data_add_duty))];
					switch ($tyd) {
						case 'PONIEDZIAŁEK':
						$typ_dnia = '1';
						break;
						case 'WTOREK':
						$typ_dnia = '1';
						break;
						case 'ŚRODA':
						$typ_dnia = '1';
						break;
						case 'CZWARTEK':
						$typ_dnia = '1';
						break;
						case 'PIĄTEK':
						$typ_dnia = '1';
						break;
						case 'SOBOTA':
						$typ_dnia = '2';
						break;
						case 'NIEDZIALA':
						$typ_dnia = '3';
						break;
						default:
						$typ_dnia = '1';
						break;
					}

					$user_add_duty = row("SELECT * FROM users WHERE id = ".$user_add_duty_id);
					$role_user_add_duty = row("SELECT * FROM rangi WHERE id = ".$user_add_duty['stanowisko']);
					$login_user_add_duty = "<a href='index.php?a=profile&p=".$user_add_duty['id']."' style='color: ".$role_user_add_duty['kolor']."'>[".$role_user_add_duty['kod_roli'].$user_add_duty['nr_sluzbowy']."] ".$user_add_duty['login']."</a>";

					$etat = row("SELECT * FROM etaty WHERE uid = ".$user_add_duty_id);
					if($etat){
						$suma_etatu = $etat['poniedzialek'] + $etat['wtorek'] + $etat['sroda'] + $etat['czwartek'] + $etat['piatek'] + $etat['sobota'] + $etat['niedziela'];
					}

					if($user_add_duty['tid'] > 0){
						$pojazd_stalka = row("SELECT * FROM tabor WHERE id = ".$user_add_duty['tid']);
						if($pojazd_stalka){
							$pojazd_stalka = $pojazd_stalka['marka']. ' '. $pojazd_stalka['model']. ' #'. $pojazd_stalka['taborowy'];
						} else {
							$pojazd_stalka = 'pojazd usunięty!';
						}
					} else {
						$pojazd_stalka = 'brak danych!';
					}

					if(!empty($_POST)){
						if (empty($_POST['rodzaj']) || empty($_POST['sluzba']) || empty($_POST['pojazd'])) {
							throwInfo('danger', 'Wypełnij wszystkie pola!', true);
						} else {
							//$tytul = 'Użytkownik '.$dane['login_kierowcy_paste'].' złożył raport za służbę '.$dane['sluzba'].' z dnia '.$dane['dzien_sluzby'].'';

							$rodzaj = vtxt($_POST['rodzaj']);
							$sluzba = vtxt($_POST['sluzba']);
							$pojazd = vtxt($_POST['pojazd']);
							$uwagi = vtxt($_POST['uwagi']);

							if($rodzaj){
								$rodzaj = 1;
							} else {
								$rodzaj = 1;
							}

							add_duty_grafik($user_add_duty_id, $data_add_duty, $rodzaj, $sluzba, $pojazd, $uwagi, $user['id']);
						}
					}

				?>

				<div class="col-md-12">
					<div class="card shadow mb-4">
						<div class="card-header">
							<h3 class="m-0 font-weight-bold text-black">Dodawanie służby <?=$data_dodania_kursu, ' - ', $login_user_add_duty?></h3>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-4">
									<h5>Informacje</h5>
									<p>
										<b>Kierowca:</b> <span><?=$login_user_add_duty?></span><br>
										<b>Przewoźnik:</b> <span>ZTM Ostaszewo</span><br>
										<b>Stanowisko:</b> <span style="color: <?=$role_user_add_duty['kolor']?>"><?=$role_user_add_duty['nazwa']?></span><br>
										<b>Etat:</b> <span><?=$suma_etatu?>/7</span><br>
										<b>Patron:</b> <span class="text-danger"><i class="fas fa-times"></i></span><br>
										<b>Pojazd:</b> <span><?=$pojazd_stalka?></span><br>
									</p>
								</div>
								<div class="col-4">
									<form action="index.php?a=zarzadzanie-grafik&action=add-duty&user=<?=$user_add_duty_id?>&date=<?=$data_add_duty?>" method="POST">
										<p>Typ służby</p>
										<p>
											<div class="form-check">
												<input class="form-check-input" type="radio" name="rodzaj" id="zwykla">
												<label class="form-check-label" for="zwykla">
													Zwykła służba
												</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="radio" disabled>
												<label class="form-check-label" for="rezerwa">
													Rezerwa
												</label>
											</div>
										</p>
										<p>
											<div class="form-group">
												<select class="form-control" aria-label="Służba" id="sluzba" name="sluzba">
													<option selected disabled>Wybierz Służbę...</option>
												</select>
											</div>
											<div class="form-group">
												<select class="form-control" aria-label="Pojazd" id="pojazd" name="pojazd">
													<option selected disabled>Pojazd</option>
												</select>
											</div>
										</p>
										<p>
											<div class="form-group">
												<label for="uwagi"><b>Uwagi</b></label>
												<textarea class="form-control" name="uwagi" id="uwagi" rows="5" placeholder="Uwagi"></textarea>
											</div>
										</p>
										<button type="submit" id="przycisk" class="btn btn-outline-success"><i class="fas fa-save"></i> Zapisz</button>
									</form>
									<br>
									<br>
								</div>
								<div class="col-4">
									<h5>Legenda</h5>
									<p>
										<h6>Służba:</h6>
										<ul>
											<li><strong>[TYP DNIA] 1 -</strong> Dzień powszedni</li>
											<li><strong>[TYP DNIA] 2 -</strong> Sobota</li>
											<li><strong>[TYP DNIA] 3 -</strong> Niedziala i Święta</li>
											<li><strong>[MEGA] -</strong> Klasa pojazdu dopuszczona dla danej służby</li>
										</ul>
									</p>
									<p>
										<h6>Pojazd:</h6>
										<ul>
											<li><strong>WST -</strong> pojazd wstrzymany z ruchu</li>
											<li><strong>TYP -</strong> nieodpowiedni typ pojazdu dla danej służby</li>

										</ul>
									</p>
								</div>
								<div class="col-12">
									<h5>Ostatnie 6 dni</h5>
									<br>
									<div class="row">
										<?php
											$data_start = $data_add_duty - 86400;
											$czas = $data_add_duty - 518400;
											for($i = $czas; $i<=$data_start; $i += 86400){
												$tyd = $dni[(date('w', $i))];
												$data[0] = date('d.m.Y',$i);
												//echo $data[0], ' ';

												$grafik = row("SELECT * FROM grafik WHERE uid = '".$user_add_duty_id."' AND data = '".$i."'");
												if($grafik){
													if($grafik['dyspozytor_id'] != 0){
														$sprawdzajacy = row("SELECT * FROM users WHERE id = ".$grafik['dyspozytor_id']);
														$role_sprawdzajacy = row("SELECT * FROM rangi WHERE id = ".$sprawdzajacy['stanowisko']);
														$login_sprawdzajacy_grafik = "<a href='index.php?a=profile&p=".$sprawdzajacy['id']."' style='color:".$role_sprawdzajacy['kolor']."'>[".$role_sprawdzajacy['kod_roli'].$sprawdzajacy['nr_sluzbowy']."] ".$sprawdzajacy['login']."</a>";
													}  else {
														$login_sprawdzajacy_grafik = 'brak danych!';
													}

													$sluzba = $grafik['linia']. '/'. $grafik['brygada']. '/'. $grafik['zmiana'];
													$dzien_sluzby = date('d.m.Y', $grafik['data']);

													if($grafik['data_dodania_kursu']){
														$data_dodania_kursu = date('d.m.Y', $grafik['data_dodania_kursu']);
													} else {
														$data_dodania_kursu = 'Brak danych!';
													}

													if(!empty($grafik['pojazd'])){
														$dane_pojazd = row("SELECT * FROM tabor WHERE id =".$grafik['pojazd']);
														if($dane_pojazd){
															$pojazd = '<a href="index.php?a=profile&g='.$dane_pojazd['id'].'">'.$dane_pojazd['marka']. ' '. $dane_pojazd['model']. ' #'. $dane_pojazd['taborowy'] . '</a>';
														} else {
															$pojazd = 'pojazd usunięty!';
														}
													} else {
														$pojazd = 'brak danych!';
													}

													//typ sluzby
													switch($grafik['typ']){
														case '1': $typ_sluzby = 'Kurs Grafikowy'; break; // Strona główna
														case '2': $typ_sluzby = 'Kurs z Wolnego'; break; // Strona główna
														case '5': $typ_sluzby = 'Anulowany'; break; // Strona główna
														case '6': $typ_sluzby = 'Rezerwa'; break; // Strona główna
														default: $typ_sluzby = 'BRAK DANYCH'; break;
													}

													if(!empty($grafik['uwagi_dyspozytora'])){
														$uwagi_dyspozytora = $grafik['uwagi_dyspozytora'];
													} else {
														$uwagi_dyspozytora = '';
													}
													if($grafik['data'] == $i){
														$card = '
														<div class="col-2">
															<div class="card shadow mb-4">
																<div class="card-header">
																	<h3 class="m-0 font-weight-bold text-center" id="'.$i.'">'.$data[0].'</h3>
																	<h6 class="m-1 font-weight-bold text-center">'.$tyd.'</h6>
																</div>
																<div class="card-body text-center">
																	<p>
																		<b>Służba:</b> <span>'.$sluzba.'</span><br>
																		<b>Typ służby:</b> <span>'.$typ_sluzby.'</span><br>
																		<b>Pojazd:</b> <span>'.$pojazd.'</span><br>
																		<b>Dyspozytor:</b> <span>'.$login_sprawdzajacy_grafik.'</span><br>
																	</p>
																</div>
															</div>
														</div>';
													} else {
														$card = '
														<div class="col-2">
															<div class="card shadow mb-4">
																<div class="card-header">
																	<h3 class="m-0 font-weight-bold text-center" id="'.$i.'">'.$data[0].'</h3>
																	<h6 class="m-1 font-weight-bold text-center">'.$tyd.'</h6>
																</div>
																<div class="card-body text-center">
																	<p>
																		<b>Brak danych!</b><br>
																	</p>
																</div>
															</div>
														</div>';
													}
												} else {
													$card = '
													<div class="col-2">
														<div class="card shadow mb-4">
															<div class="card-header">
																<h3 class="m-0 font-weight-bold text-center" id="'.$i.'">'.$data[0].'</h3>
																<h6 class="m-1 font-weight-bold text-center">'.$tyd.'</h6>
															</div>
															<div class="card-body text-center">
																<p>
																	<b>-</b><br>
																</p>
															</div>
														</div>
													</div>';
												}
												echo $card;
											}
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php else:?>
				<div class="col-md-12">
					<div class="card shadow mb-4">
						<div class="card-header">
							<h3 class="m-0 font-weight-bold text-black">Grafik</h3>
						</div>
						<div class="card-body">
							<?php
								$licznik = 10;
								if(!isset($_GET['przesuwanie']) && empty($_GET['przesuwanie'])){
									$start = 0;
									$end = round(round($start, 0)+$licznik, 0);
									$tyl = true;
									$przod = true;
									$przesuwanie = 0;
								} elseif(isset($_GET['przesuwanie'])){
									$start = vtxt($_GET['przesuwanie']);
									$tyl = true;
									$przod = true;
									if($start > 2 || $start < -10){
										echo '<div class="card-body text-center text-danger"><p><i class="fas fa-exclamation-triangle"></i> <b>STOP</b> <i class="fas fa-exclamation-triangle"></i></p>';
										echo '<p><i class="fas fa-ban"></i> <b>Dalszy widok jest zablokowany</b> <i class="fas fa-ban"></i></p></div>';
										if($start >= 2){
											$start = 2;
											$przod = false;
										} elseif ($start < -10) {
											$start = -10;
											if($start == -10){
												$tyl = false;
											}
											$tyl = false;
										}
										$end = round(round($start, 0)+$licznik, 0);
									}
									$end = round(round($start, 0)+$licznik, 0);
								}

								przyciski_przesuwania($dni, $start, $end, $tyl, $przod);


							?>
							<h4>
								<b>
									<p class="text-center">
										<button type="button" class="btn" style="background-color: #66CC66; color: white;"><i class="far fa-calendar-check"></i></button> - kurs dodany |
										<button type="button" class="btn" style="background-color: #99CCCC; color: white;"><i class="far fa-calendar-minus"></i></button> - wolne grafikowe |
										<button type="button" class="btn" style="background-color: #236B8E; color: white;"><i class="far fa-calendar-plus"></i></button> - kurs grafikowy |
										<button type="button" class="btn" style="background-color: #7E57C2; color: white;"><i class="far fa-calendar-times"></i></button> - kurs anulowany |
										<button type="button" class="btn" style="background-color: #FF9900; color: white;"><i class="far fa-calendar-alt"></i></button> - urlop
									</p>
								</b>
							</h4>
							<br />
							<table id="tabela" class="table table-bordered" style="width: 100%;">
								<thead>
									<tr style="text-align: center">
										<th>Kierowca<br>Etat<br>Przydział</th>
										<?php
											daty_grafik_dyspozytornia($dni, $start, $end);
										?>
									</tr>
								</thead>
								<tbody>
									<?php
										body_grafik_dyspozytornia($dni, $start, $end)
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			<?php endif?>
		</div>
	</div>
</section>
<!-- Remember to include jQuery :) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
<script type="text/javascript">
	$(function () {
		$('[data-toggle="tooltip"]').tooltip();
		$('[data-toggle="popover"]').popover()
	})
</script>
<?php if(isset($_GET['action']) && $_GET['action'] == 'add-duty' && !empty($_GET['user']) && !empty($_GET['date'])):?>
	<script type="text/javascript">
		$('#przycisk').prop('disabled', true);
		loadData(<?=$data_add_duty?>, <?=$typ_dnia?>);
		function loadData(data, typ){
			$.ajax({
				url: "json/dyspozytornia_load_data.php",
				type: "POST",
				data: {data: data, typ: typ},
				success : function(data){
					$("#sluzba").append(data);
				}
			});
		}
		$("#sluzba").on("change", function(){
			var sluzba_id = $("#sluzba").val();
			if(sluzba_id != ''){
				$.ajax({
					url: "json/dyspozytornia_load_data.php?action=sluzba",
					type: "POST",
					data: {sluzba_id: sluzba_id},
					success : function(data){
						var klasa = data;
						//console.log(klasa);// data;

						pojazdy(klasa);
						function pojazdy(klasa){
							$.ajax({
								url: "json/dyspozytornia_load_data.php?action=pojazd",
								type: "POST",
								data: {klasa: klasa},
								success : function(data){
									$('#pojazd').empty();
									$("#pojazd").append(data);
									$('#pojazd').change();
								}
							});
						}
					}
				});
				$('#przycisk').prop('disabled', false);
			}
		});
	</script>
<?php endif;?>
