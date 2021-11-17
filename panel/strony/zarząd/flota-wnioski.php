<?php
	if($perm['zarzadzanie_wnioskami_tabor'] == '0'){
		header('Location: index.php?a=home');
	}
	require("../PHPMailer/src/PHPMailer.php");
	require("../PHPMailer/src/SMTP.php");
	require("../PHPMailer/src/Exception.php");
	$mail = new PHPMailer\PHPMailer\PHPMailer();
	if (!isset($_GET['edit']) && !isset($_GET['view'])) {
		$strona1 = true;
		$strona2 = false;
		$strona3 = false;
	} elseif (isset($_GET['edit']) && !isset($_GET['delete']) && !isset($_GET['add']) && !isset($_GET['view'])) {
		$id = vtxt($_GET['edit']);

		$target = row("SELECT * FROM wnioski WHERE id = ".$id);
		if(!$target){
			header('Location: index.php?a=home');
		}
		$strona1 = false;
		$strona2 = true;
		$strona3 = false;

	} elseif (isset($_GET['edit']) && isset($_GET['delete']) && !isset($_GET['add']) && !isset($_GET['view'])) {
		$id = vtxt($_GET['edit']);
		$target = row("SELECT * FROM wnioski WHERE id = ".$id);
		if(!$target){
			header('Location: index.php?a=home');
		}
		switch($target['typ']){
			case '1' : $tytul = 'Wniosek o zmianę etatu'; break;
			case '2' : $tytul = 'Wniosek o urlop'; break;
			case '3' : $tytul = 'Wypowiedzenie umowy o pracę'; break;
			case '4' : $tytul = 'Wniosek o kurs z wolnego'; break;
			case '5' : $tytul = 'Wniosek o stały przydział pojazdu'; break;
			case '6' : $tytul = 'Wniosek o nieprzydzielanie pojazdu'; break;
		}
		$u = row("SELECT * FROM users WHERE id = ".$target['uid']);
		$r = row("SELECT * FROM rangi WHERE id = ".$u['stanowisko']);
		if(!empty($_POST)){
			if(empty($_POST['uwagi'])){
				throwInfo('danger', 'Wypełnij Wszystkie Pola', true);
			} else {
				$uwagi = vtxt($_POST['uwagi']);
				$query = call("UPDATE wnioski SET status = '2', sid = '".$user['id']."', uwagi = '".$uwagi."' WHERE id = ".$id);
				$log = call("INSERT INTO logi (uid, akcja) VALUES ('".$user['id']."', 'Użytkownik ".$user['login']." odrzucił ".$tytul.", użytkownika o ID ".$target['uid']."')");
				if($query){
					$client->channel->createMessage([
						'channel.id' => intval($pushchannel),
						'content' => '',
						'embed' => [
							"author" => [
								"name" => "Odrzucono wniosek",
								"url" => "",
								"icon_url" => "https://cdn.discordapp.com/emojis/555804212785840170.png?v=1"
							],
							"description" => '
								» Typ: **'.$tytul.'**
								» Osoba: **['.$r['kod_roli'].''.$u['nr_sluzbowy'].'] '.$u['login'].'**
								» Osoba Sprawdzająca: **['.$role['kod_roli'].''.$user['nr_sluzbowy'].'] '.$user['login'].'**
								» Powód: **'.$uwagi.'**
							',
							"color" => hexdec('#f6c23e'),
							"footer" => [
								"icon_url" => "https://cdn.discordapp.com/icons/645582261378613249/5d0deaffdc5531a405583b16f823d928.png?size=128",
								"text" => "Powiadomienie z panelu!"
							],
							"timestamp" => $timestamp
						]
					]);
					if($client){
						$_SESSION['success'] = 'Sukces!';
						header('Location: index.php?a=pojazd-wnioski');
					} else{
						$_SESSION['danger'] = 'Błąd Przy wysyłaniu powiadomienia na discorda! Skontaktuj się z programistą!';
						header('Location: index.php?a=pojazd-wnioski');
					}
				} else {
					$_SESSION['danger'] = 'Błąd! Przy usuwaniu wniosku! Skontaktuj się z programistą!';
					header('Location: index.php?a=pojazd-wnioski');
				}
			}
		} else {
			header('Location: index.php?a=home');
		}

	} elseif (isset($_GET['edit']) && !isset($_GET['delete']) && isset($_GET['add']) && !isset($_GET['view'])) {
		$id = vtxt($_GET['edit']);
		$target = row("SELECT * FROM wnioski WHERE id = ".$id);
		$strona1 = false;
		$strona2 = true;
		$strona3 = false;
		if(!$target){
			header('Location: index.php?a=home');
		}
		switch($target['typ']){
			case '1' : $tytul = 'Wniosek o zmianę etatu'; break;
			case '2' : $tytul = 'Wniosek o urlop'; break;
			case '3' : $tytul = 'Wypowiedzenie umowy o pracę'; break;
			case '4' : $tytul = 'Wniosek o kurs z wolnego'; break;
			case '5' : $tytul = 'Wniosek o stały przydział pojazdu'; break;
			case '6' : $tytul = 'Wniosek o nieprzydzielanie pojazdu'; break;
		}
		$u = row("SELECT * FROM users WHERE id = ".$target['uid']);
		$r = row("SELECT * FROM rangi WHERE id = ".$u['stanowisko']);

		if($target['typ'] == 1){
			$query1 = call("UPDATE etaty SET poniedzialek = '".$target['pon']."', wtorek = '".$target['wt']."', sroda = '".$target['sr']."', czwartek = '".$target['czw']."', piatek = '".$target['pi']."', sobota = '".$target['sob']."', niedziela = '".$target['niedz']."' WHERE uid = '".$target['uid']."'");
			$log = call("INSERT INTO logi (uid, akcja) VALUES ('".$user['id']."', 'Użytkownik ".$user['login']." przyjął wniosek o zmianę etatu, użytkownika o ID ".$target['uid']."')");
		} elseif($target['typ'] == 2){
			$query1 = call("UPDATE wnioski SET status = '1', sid = '".$user['id']."' WHERE id = ".$id);
			$log = call("INSERT INTO logi (uid, akcja) VALUES ('".$user['id']."', 'Użytkownik ".$user['login']." przyjął wniosek o urlop użytkownika o ID ".$target['uid']."')");

		} elseif ($target['typ'] == 3) {
			$timestamp = date("Y-m-d H:i:s");
			$date = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
			$query1 = call("UPDATE users SET deleted = '1', data_usuniecia = '".$date."' WHERE id = '".$target['uid']."'");
			$body = '
			<center>
				<div style="letter-spacing:0.5px;width:500px;background-color:#BCB714;padding:10px">
					<b>Powiadomienie z panelu</b>
				</div>
				<div style="color:#000;width:500px;background-color:#fff;padding:10px">
					<h3>Zostałeś zwolniony dyscyplinarnie z Wirtualnego Pomorza</h3>
					Witaj '.$u['login'].' .<br>
					Z przykrością pragniemy Cię poinformować, że twoja umowa o pracę w Wirtualnym Pomorzu została rozwiązana w trybie dyscyplinarnym.<br><br>
					<b>Powód:</b> Zwolnienie na wniosek pracownika. Zwolniono '.$timestamp.'.<br><br>
					Zwolnienie dyscyplinarne odbiera Ci kolejną szansę na pracę u nas.<br>
					Dziękujemy za współpracę i pozdrawiamy.
					<br><br>
					Z poważaniem,<br>
					System Wirtualne Pomorze
				</div>
				<div style="margin-bottom:20px;font-size:12px;line-height:130%;width:500px;background-color:#bdbdbd;padding:10px">
					Wiadomość została wysłana automatycznie. Prosimy na nią nie odpowiadać.<br>
					Otrzymałeś tego maila, ponieważ jesteś pracownikiem, lub kandydatem do pracy w Wirtualnym Pomorzu - vPomorze.pl.
					<br><br>
					Copyright © Wirtualne Pomorze 2021 <a href="https://www.vpomorze.pl" target="_blank">www.vpomorze.pl</a><br>
					<a href="">Polityka Prywatności</a> | <a href="">Regulamin</a> | <a href="">Kontakt</a>
				</div>
			</center>';

			$mail->IsSMTP();
			$mail->CharSet="UTF-8";
			$mail->Host = "mail.vpomorze.pl"; /* Zależne od hostingu poczty*/
			$mail->SMTPDebug = 1;
			$mail->Port = 587; /* Zależne od hostingu poczty, czasem 587 */
			$mail->SMTPSecure = true; /* Jeżeli ma być aktywne szyfrowanie SSL */
			$mail->SMTPAuth = true;
			$mail->SMTPAutoTLS = false;
			$mail->IsHTML(true);
			$mail->Username = "kadry@vpomorze.pl"; /* login do skrzynki email często adres*/
			$mail->Password = "WP2021.."; /* Hasło do poczty */
			$mail->setFrom('kadry@vpomorze.pl', 'Powiadomienia vpomorze'); /* adres e-mail i nazwa nadawcy */
			$mail->AddAddress($u['email']); /* adres lub adresy odbiorców */
			$mail->Subject = "Powiadomienie Wirtualne Pomorze"; /* Tytuł wiadomości */
			$mail->Body = $body;
			if($mail->Send()){
				$log = call("INSERT INTO logi (uid, akcja) VALUES ('".$user['id']."', 'Użytkownik ".$user['login']." przyjął wypowiedzenie umowy o pracę, użytkownika o ID ".$target['uid']."')");
			} else{
				$_SESSION['danger'] = 'Błąd Przy wysyłaniu e-mail! Skontaktuj się z programistą!';
				header('Location: index.php?a=wnioskioprace-zarządzanie');
			}

		} elseif ($target['typ'] == 4) {
			$timestamp = date("Y-m-d H:i:s");
			
			$query1 = call("UPDATE wnioski SET status = '1', sid = '".$user['id']."' WHERE id = ".$id);
			if($query1){
				$_SESSION['success'] = 'Sukces!';
				header('Location: index.php?a=pojazd-wnioski');
			} else {
				$_SESSION['danger'] = 'Błąd! Przy zatwierdzaniu wniosku! Skontaktuj się z programistą!';
				header('Location: index.php?a=pojazd-wnioski');
			}
		}

		if ($query1) {
			$query = call("UPDATE wnioski SET status = '1', sid = '".$user['id']."', uwagi = '".$uwagi."' WHERE id = ".$id);
			if($query){
				if($log){
					$client->channel->createMessage([
						'channel.id' => intval($pushchannel),
						'content' => '',
						'embed' => [
							"author" => [
								"name" => "Przyjęto wniosek",
								"url" => "",
								"icon_url" => "https://cdn.discordapp.com/emojis/555804149610971136.png?v=1"
							],
							"description" => '
								» Typ: **'.$tytul.'**
								» Osoba: **['.$r['kod_roli'].''.$u['nr_sluzbowy'].'] '.$u['login'].'**
								» Osoba Sprawdzająca: **['.$role['kod_roli'].''.$user['nr_sluzbowy'].'] '.$user['login'].'**
							',
							"color" => hexdec('#f6c23e'),
							"footer" => [
								"icon_url" => "https://cdn.discordapp.com/icons/645582261378613249/5d0deaffdc5531a405583b16f823d928.png?size=128",
								"text" => "Powiadomienie z panelu!"
							],
							"timestamp" => $timestamp
						]
					]);
					if($client){
						$_SESSION['success'] = 'Sukces!';
						header('Location: index.php?a=pojazd-wnioski');
					} else{
						$_SESSION['danger'] = 'Błąd Przy wysyłaniu powiadomienia na discorda! Skontaktuj się z programistą!';
						header('Location: index.php?a=pojazd-wnioski');
					}
				} else{
					$_SESSION['danger'] = 'Błąd Przy zapisywaniu akcji! Skontaktuj się z programistą!';
					header('Location: index.php?a=pojazd-wnioski');
				}
			} else {
				$_SESSION['danger'] = 'Błąd! Przy zatwierdzaniu wniosku! Skontaktuj się z programistą!';
				header('Location: index.php?a=pojazd-wnioski');
			}
		} else {
			$_SESSION['danger'] = 'Błąd! Przy realizacji wniosku! Skontaktuj się z programistą!';
			header('Location: index.php?a=pojazd-wnioski');
		}



	} elseif (!isset($_GET['edit']) && isset($_GET['view'])) {
		$id = vtxt($_GET['view']);
		$xd1 = row("SELECT * FROM wnioski WHERE id = ".$id);
		$strona1 = false;
		$strona2 = false;
		$strona3 = true;
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
					<h1>Wnioski</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="index.php?a=home">Panel Kierowcy</a></li>
						<li class="breadcrumb-item active">Wnioski</li>
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
							<div class="card-header py-3">
								<h3 class="m-0 font-weight-bold">Wnioski oczekujące na rozpatrzenie</h3>
							</div>
							<!-- /.card-header -->
							<div class="card-body table-responsive">
								<table class="dataTable table table-bordered text-center">
									<?php
										$targets = call("SELECT * FROM wnioski WHERE status = 0 AND typ > 4");
										if ($targets->num_rows == 0) {?>
												<div class="card-body">
													<?php throwInfo('info', 'Brak wniosków oczekujących na rozpatrzenie!', false);?>
												</div>
											<?php } else {
									?>
									<thead>
										<tr>
											<th>Numer</th>
											<th>Użytkownik</th>
											<th>Typ wniosku</th>
											<th>Data złożenia</th>
											<th>Status wniosku</th>
											<th>Opcje</th>
										</tr>
									</thead>
									<tbody >
										<?php
											$i = 1;
											while ($row = mysqli_fetch_array($targets)):
												switch($row['typ']){
													case '1' : $typ = 'Wniosek o zmianę etatu'; break;
													case '2' : $typ = 'Wniosek o urlop'; break;
													case '3' : $typ = 'Wypowiedzenie umowy o pracę'; break;
													case '4' : $typ = 'Wniosek o kurs z wolnego'; break;
													case '5' : $typ = 'Wniosek o stały przydział pojazdu'; break;
													case '6' : $typ = 'Wniosek o nieprzydzielanie pojazdu'; break;
												}
												$us = row("SELECT * FROM users WHERE id =".$row['uid']);
												$role = row("SELECT * FROM rangi WHERE id = ".$us['stanowisko']);
												$dataczegos = date('d.m.Y',$row['datawniosku']);
											?>
											<tr>
												<td>#<?=$row['id'];?></td>
												<td><a href="index.php?a=profile&p=<?=$us['id'];?>" style="color: <?=$role['kolor'];?>"><?=$us['login'], ' [', $role['kod_roli'], $us['nr_sluzbowy'],']';?></a></td>
												<td><?=$typ;?></td>
												<td><?=$dataczegos;?></td>
												<?php
													if($row['status'] == 0){
														echo '<td><b style="color: #cccc00">Oczekuje na sprawdzenie</b></td><td class="project-actions "><a href="index.php?a=pojazd-wnioski&edit='.$row['id'].'"><button type="button" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Wybierz</button></a></td>';
													} elseif($row['status'] == 1){
														echo '<td><b style="color: #009900">Zaliczony</b></td><td class="project-actions ">
														<a href="index.php?a=pojazd-wnioski&view='.$row['id'].'"><button type="button" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Wybierz</button></a></td>';
													} elseif($row['status'] == 2){
														echo '<td><b style="color: #ff0000">Niezaliczony</b></td><td class="project-actions ">
														<a href="index.php?a=pojazd-wnioski&view='.$row['id'].'"><button type="button" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Wybierz</button></a></td>';
													}
												?>
											</tr>
										<?php endwhile;}?>
									</tbody>
								</table>
							</div>
							<!-- /.card-body -->
						</div>
						<!-- /.card -->
					</div>
					<div class="col-lg-12">
						<div class="card shadow mb-4">
							<div class="card-header py-3">
								<h3 class="m-0 font-weight-bold">Wnioski rozpatrzone</h3>
							</div>
							<!-- /.card-header -->
							<div class="card-body table-responsive">
								<table class="dataTable table table-bordered text-center">
									<?php
										$targets = call("SELECT * FROM wnioski WHERE status != 0 AND typ > 4");
										if ($targets->num_rows == 0) {?>
												<div class="card-body">
													<?php throwInfo('info', 'Brak rozpatrzonych wniosków!', false);?>
												</div>
											<?php } else {
									?>
									<thead>
										<tr>
											<th>Numer</th>
											<th>Użytkownik</th>
											<th>Typ wniosku</th>
											<th>Data złożenia</th>
											<th>Status wniosku</th>
											<th>Opcje</th>
										</tr>
									</thead>
									<tbody >
										<?php
											$i = 1;
											while ($row = mysqli_fetch_array($targets)):
												switch($row['typ']){
													case '1' : $typ = 'Wniosek o zmianę etatu'; break;
													case '2' : $typ = 'Wniosek o urlop'; break;
													case '3' : $typ = 'Wypowiedzenie umowy o pracę'; break;
													case '4' : $typ = 'Wniosek o kurs z wolnego'; break;
													case '5' : $typ = 'Wniosek o stały przydział pojazdu'; break;
													case '6' : $typ = 'Wniosek o nieprzydzielanie pojazdu'; break;
												}
												$us = row("SELECT * FROM users WHERE id =".$row['uid']);
												$role = row("SELECT * FROM rangi WHERE id = ".$us['stanowisko']);
												$dataczegos = date('d.m.Y',$row['datawniosku']);
											?>
											<tr>
												<td>#<?=$row['id'];?></td>
												<td><a href="index.php?a=profile&p=<?=$us['id'];?>" style="color: <?=$role['kolor'];?>"><?=$us['login'], ' [', $role['kod_roli'], $us['nr_sluzbowy'],']';?></a></td>
												<td><?=$typ;?></td>
												<td><?=$dataczegos;?></td>
												<?php
													if($row['status'] == 0){
														echo '<td><b style="color: #cccc00">Oczekuje na rozpatrzenie</b></td><td class="project-actions "><a href="index.php?a=pojazd-wnioski&edit='.$row['id'].'"><button type="button" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Wybierz</button></a></td>';
													} elseif($row['status'] == 1){
														echo '<td><b style="color: #009900">Rozpatrzony pozytywnie</b></td><td class="project-actions ">
														<a href="index.php?a=pojazd-wnioski&view='.$row['id'].'"><button type="button" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Wybierz</button></a></td>';
													} elseif($row['status'] == 2){
														echo '<td><b style="color: #ff0000">Rozpatrzony negatywnie</b></td><td class="project-actions ">
														<a href="index.php?a=pojazd-wnioski&view='.$row['id'].'"><button type="button" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Wybierz</button></a></td>';
													}
												?>
											</tr>
										<?php endwhile;}?>
									</tbody>
								</table>
							</div>
							<!-- /.card-body -->
						</div>
						<!-- /.card -->
					</div>
				<?php elseif($strona2):?>
					<?php
						switch($target['typ']){
							case '1' : $tytul = 'Wniosek o zmianę etatu'; break;
							case '2' : $tytul = 'Wniosek o urlop'; break;
							case '3' : $tytul = 'Wypowiedzenie umowy o pracę'; break;
							case '4' : $tytul = 'Wniosek o kurs z wolnego'; break;
							case '5' : $tytul = 'Wniosek o stały przydział pojazdu'; break;
							case '6' : $tytul = 'Wniosek o nieprzydzielanie pojazdu'; break;
						}
						if($target['typ'] == 1){
							$dataczegos = date('d.m.Y', $target['datawniosku']);
							$etat = row("SELECT * FROM etaty WHERE uid = ".$target['uid']);
						} elseif($target['typ'] == 2){
							$dataczegos = date('d.m.Y', $target['datawniosku']);
							$datau1 = date('d.m.Y', $target['data1']);
							$datau2 = date('d.m.Y', $target['data2']);
						} elseif ($target['typ'] == 3) {
							$dataczegos = date('d.m.Y', $target['datawniosku']);
						} elseif ($target['typ'] == 4) {
							$dataczegos = date('d.m.Y', $target['datawniosku']);
							$datakzw = date('d.m.Y', $target['datakzw']);
						} elseif ($target['typ'] == 5) {
							$dataczegos = date('d.m.Y', $target['datawniosku']);
						}
						$u = row("SELECT * FROM users WHERE id = ".$target['uid']);
						$r = row("SELECT * FROM rangi WHERE id = ".$u['stanowisko']);
						if($target['status'] == 0){
							$style = "color: #cccc00";
							$text = 'Oczekuje na rozpatrzenie';
						} elseif($target['status'] == 1){
							$style = "color: #009900";
							$text = "Rozpatrzony pozytywnie";
							
						} elseif($target['status'] == 2){
							$style = "color: #ff0000";
							$text = 'Rozpatrzony negatywnie';
							
						}
					?>
					<div class="col-12">
						<div class="card shadow mb-4">
							<div class="card-header py-3">
								<h3 class="m-0 font-weight-bold text-primary"><?=$tytul?></h3>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-12 col-xl-6">
										<ul class="list-group list-group-unbordered mb-3">
											<li class="list-group-item">
												<b>Data złożenia wniosku</b><span class="float-right"><?=$dataczegos;?></span>
											</li>
											<li class="list-group-item">
												<b>Nazwa uzytkownika</b><span class="float-right"><a href="index.php?a=profile&p=<?=$u['id'];?>" style="color: <?=$r['kolor'];?>"><?='['.$r['kod_roli'].''.$u['nr_sluzbowy'].'] '.$u['login'].'';?></a></span>
											</li>
										</ul>
										<?php if($target['typ'] == 1):?>
											<div class="row">
												<div class="col-12 col-xl-6">
													<ul class="list-group list-group-unbordered mb-3">
														<li class="list-group-item">
															<?php
																$cos = $etat['poniedzialek'] + $etat['wtorek'] + $etat['sroda'] + $etat['czwartek'] + $etat['piatek'] + $etat['sobota'] + $etat['niedziela'];
															?>
															<b>Obecny Etat</b><a class="float-right"><?=$cos;?>/7</a>
														</li>
														<li class="list-group-item">
															<b>Poniedziałek</b><a class="float-right">
															<?php
																if($etat['poniedzialek'] == '1') {
																	echo '<i style="color: green;" class="fa fa-check"></i>';
																}else{
																	echo '<i style="color: red;" class="fa fa-times"></i>';
																};
															?></a>
														</li>
														<li class="list-group-item">
															<b>Wtorek</b><a class="float-right">
															<?php
																if($etat['wtorek'] == '1') {
																	echo '<i style="color: green;" class="fa fa-check"></i>';
																}else{
																	echo '<i style="color: red;" class="fa fa-times"></i>';
																};
															?></a>
														</li>
														<li class="list-group-item">
															<b>Środa</b><a class="float-right">
															<?php
																if($etat['sroda'] == '1') {
																	echo '<i style="color: green;" class="fa fa-check"></i>';
																}else{
																	echo '<i style="color: red;" class="fa fa-times"></i>';
																};
															?></a>
														</li>
														<li class="list-group-item">
															<b>Czwartek</b><a class="float-right">
															<?php
																if($etat['czwartek'] == '1') {
																	echo '<i style="color: green;" class="fa fa-check"></i>';
																}else{
																	echo '<i style="color: red;" class="fa fa-times"></i>';
																};
															?></a>
														</li>
														<li class="list-group-item">
															<b>Piątek</b><a class="float-right">
															<?php
																if($etat['piatek'] == '1') {
																	echo '<i style="color: green;" class="fa fa-check"></i>';
																}else{
																	echo '<i style="color: red;" class="fa fa-times"></i>';
																};
															?></a>
														</li>
														<li class="list-group-item">
															<b>Sobota</b><a class="float-right">
															<?php
																if($etat['sobota'] == '1') {
																	echo '<i style="color: green;" class="fa fa-check"></i>';
																}else{
																	echo '<i style="color: red;" class="fa fa-times"></i>';
																};
															?></a>
														</li>
														<li class="list-group-item">
															<b>Niedziela</b><a class="float-right">
															<?php
																if($etat['niedziela'] == '1') {
																	echo '<i style="color: green;" class="fa fa-check"></i>';
																}else{
																	echo '<i style="color: red;" class="fa fa-times"></i>';
																};
															?></a>
														</li>
													</ul>
												</div>
												<div class="col-12 col-xl-6">
													<ul class="list-group list-group-unbordered mb-3">
														<li class="list-group-item">
															<?php
																$cos = $target['pon'] + $target['wt'] + $target['sr'] + $target['czw'] + $target['pi'] + $target['sob'] + $target['niedz'];
															?>
															<b>Zmieniony Etat</b><a class="float-right"><?=$cos;?>/7</a>
														</li>
														<li class="list-group-item">
															<b>Poniedziałek</b><a class="float-right">
															<?php
																if($target['pon'] == '1') {
																	echo '<i style="color: green;" class="fa fa-check"></i>';
																}else{
																	echo '<i style="color: red;" class="fa fa-times"></i>';
																};
															?></a>
														</li>
														<li class="list-group-item">
															<b>Wtorek</b><a class="float-right">
															<?php
																if($target['wt'] == '1') {
																	echo '<i style="color: green;" class="fa fa-check"></i>';
																}else{
																	echo '<i style="color: red;" class="fa fa-times"></i>';
																};
															?></a>
														</li>
														<li class="list-group-item">
															<b>Środa</b><a class="float-right">
															<?php
																if($target['sr'] == '1') {
																	echo '<i style="color: green;" class="fa fa-check"></i>';
																}else{
																	echo '<i style="color: red;" class="fa fa-times"></i>';
																};
															?></a>
														</li>
														<li class="list-group-item">
															<b>Czwartek</b><a class="float-right">
															<?php
																if($target['czw'] == '1') {
																	echo '<i style="color: green;" class="fa fa-check"></i>';
																}else{
																	echo '<i style="color: red;" class="fa fa-times"></i>';
																};
															?></a>
														</li>
														<li class="list-group-item">
															<b>Piątek</b><a class="float-right">
															<?php
																if($target['pi'] == '1') {
																	echo '<i style="color: green;" class="fa fa-check"></i>';
																}else{
																	echo '<i style="color: red;" class="fa fa-times"></i>';
																};
															?></a>
														</li>
														<li class="list-group-item">
															<b>Sobota</b><a class="float-right">
															<?php
																if($target['sob'] == '1') {
																	echo '<i style="color: green;" class="fa fa-check"></i>';
																}else{
																	echo '<i style="color: red;" class="fa fa-times"></i>';
																};
															?></a>
														</li>
														<li class="list-group-item">
															<b>Niedziela</b><a class="float-right">
															<?php
																if($target['niedz'] == '1') {
																	echo '<i style="color: green;" class="fa fa-check"></i>';
																}else{
																	echo '<i style="color: red;" class="fa fa-times"></i>';
																};
															?></a>
														</li>
													</ul>
												</div>
												<div class="col-12">
													<ul class="list-group list-group-unbordered mb-3">
														<li class="list-group-item">
															<b>Powód</b><span class="float-right"><?=$target['powod'];?></span>
														</li>
														<li class="list-group-item">
															<b>Status</b><span class="float-right"><b style="<?=$style?>"><?=$text?></b></span>
														</li>
													</ul>
												</div>
											</div>
										<?php elseif($target['typ'] == 2):?>
											<div class="row">
												<div class="col-12">
													<ul class="list-group list-group-unbordered mb-3">
														<li class="list-group-item">
															<b>Data Rozpoczęcia Urlopu</b><span class="float-right"><?=$datau1;?></span>
														</li>
														<li class="list-group-item">
															<b>Data Zakończenia Urlopu</b><span class="float-right"><?=$datau2?></b></span>
														</li>
													</ul>
												</div>
												<div class="col-12">
													<ul class="list-group list-group-unbordered mb-3">
														<li class="list-group-item">
															<b>Powód</b><span class="float-right"><?=$target['powod'];?></span>
														</li>
														<li class="list-group-item">
															<b>Status</b><span class="float-right"><b style="<?=$style?>"><?=$text?></b></span>
														</li>
													</ul>
												</div>
											</div>
										<?php elseif($target['typ'] == 3):?>
											<div class="row">
												<div class="col-12">
													<ul class="list-group list-group-unbordered mb-3">
														<li class="list-group-item">
															<b>Powód</b><span class="float-right"><?=$target['powod'];?></span>
														</li>
														<li class="list-group-item">
															<b>Status</b><span class="float-right"><b style="<?=$style?>"><?=$text?></b></span>
														</li>
													</ul>
												</div>
											</div>
										<?php elseif($target['typ'] == 4):?>
											<div class="row">
												<div class="col-12">
													<ul class="list-group list-group-unbordered mb-3">
														<li class="list-group-item">
															<b>Data kursu</b><span class="float-right"><?=$datakzw;?></span>
														</li>
													</ul>
												</div>
												<div class="col-12">
													<ul class="list-group list-group-unbordered mb-3">
														<li class="list-group-item">
															<b>Powód</b><span class="float-right"><?=$target['powod'];?></span>
														</li>
														<li class="list-group-item">
															<b>Status</b><span class="float-right"><b style="<?=$style?>"><?=$text?></b></span>
														</li>
													</ul>
												</div>
											</div>
										<?php elseif($target['typ'] == 5):?>
											<div class="row">
												<div class="col-12">
													<ul class="list-group list-group-unbordered mb-3">
														<li class="list-group-item">
															<b>Pojazd</b><span class="float-right"><?=$target['pojazd'];?></span>
														</li>
														<li class="list-group-item">
															<b>Powód</b><span class="float-right"><?=$target['powod'];?></span>
														</li>
														<li class="list-group-item">
															<b>Status</b><span class="float-right"><b style="<?=$style?>"><?=$text?></b></span>
														</li>
													</ul>
												</div>
											</div>
										<?php endif;?>
									</div>
									<div class="col-12 col-xl-6">
										<ul class="list-group list-group-unbordered mb-3">
											<li class="list-group-item">
												<center>Miejsce przeznaczone dla osoby sprawdzającej</center>
											</li>
										</ul>
										<a href="index.php?a=pojazd-wnioski&edit=<?=$id?>&add=true" class="btn btn-success btn-block">Przyjmnij wniosek</a>
										<button class="btn btn-danger btn-block del_btn" type="button">Odrzuć wniosek</button>
									</div>
								</div>
								<?php //endif; ?>
							</div>
						</div>
					</div>
					
				<?php elseif($strona3):?>
					<?php
						switch($xd1['typ']){
							case '1' : $tytul = 'Wniosek o zmianę etatu'; break;
							case '2' : $tytul = 'Wniosek o urlop'; break;
							case '3' : $tytul = 'Wypowiedzenie umowy o pracę'; break;
							case '4' : $tytul = 'Wniosek o kurs z wolnego'; break;
							case '5' : $tytul = 'Wniosek o stały przydział pojazdu'; break;
							case '6' : $tytul = 'Wniosek o nieprzydzielanie pojazdu'; break;
						}
						if($xd1['typ'] == 1){
							$dataczegos = date('d.m.Y', $xd1['datawniosku']);
						} elseif($xd1['typ'] == 2){
							$dataczegos = date('d.m.Y', $xd1['datawniosku']);
							$datau1 = date('d.m.Y', $xd1['data1']);
							$datau2 = date('d.m.Y', $xd1['data2']);
						} elseif ($xd1['typ'] == 3) {
							$dataczegos = date('d.m.Y', $xd1['datawniosku']);
						} elseif ($xd1['typ'] == 4) {
							$dataczegos = date('d.m.Y', $xd1['datawniosku']);
							$datakzw = date('d.m.Y', $xd1['datakzw']);
						} elseif ($xd1['typ'] == 5) {
							$dataczegos = date('d.m.Y', $xd1['datawniosku']);
						}

						if($xd1['status'] == 0){
							$style = "color: #cccc00";
							$text = 'Oczekuje na sprawdzenie';
						} elseif($xd1['status'] == 1){
							$style = "color: #009900";
							$text = "Rozpatrzony pozytywnie";
							$u = row("SELECT * FROM users WHERE id = ".$xd1['sid']);
							$r = row("SELECT * FROM rangi WHERE id = ".$u['stanowisko']);
						} elseif($xd1['status'] == 2){
							$style = "color: #ff0000";
							$text = 'Rozpatrzony negatywnie';
							$u = row("SELECT * FROM users WHERE id = ".$xd1['sid']);
							$r = row("SELECT * FROM rangi WHERE id = ".$u['stanowisko']);
						}
						
						$u1 = row("SELECT * FROM users WHERE id = ".$xd1['uid']);
						$r1 = row("SELECT * FROM rangi WHERE id = ".$u1['stanowisko']);
					?>
					<div class="col-12">
						<div class="card shadow mb-4">
							<div class="card-header py-3">
								<h3 class="m-0 font-weight-bold text-primary"><?=$tytul?></h3>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-12 col-xl-6">
										<ul class="list-group list-group-unbordered mb-3">
											<li class="list-group-item">
												<b>Data złożenia wniosku</b><span class="float-right"><?=$dataczegos;?></span>
											</li>
											<li class="list-group-item">
												<b>Nazwa uzytkownika</b><span class="float-right"><a href="index.php?a=profile&p=<?=$u1['id'];?>" style="color: <?=$r1['kolor'];?>"><?='['.$r1['kod_roli'].''.$u1['nr_sluzbowy'].'] '.$u1['login'].'';?></a></span>
											</li>
										</ul>
										<?php if($xd1['typ'] == 1):?>
											<div class="row">
												<div class="col-12 col-xl-6">
													<ul class="list-group list-group-unbordered mb-3">
														<li class="list-group-item">
															<?php
																$cos = $etat['poniedzialek'] + $etat['wtorek'] + $etat['sroda'] + $etat['czwartek'] + $etat['piatek'] + $etat['sobota'] + $etat['niedziela'];
															?>
															<b>Obecny Etat</b><a class="float-right"><?=$cos;?>/7</a>
														</li>
														<li class="list-group-item">
															<b>Poniedziałek</b><a class="float-right">
															<?php
																if($etat['poniedzialek'] == '1') {
																	echo '<i style="color: green;" class="fa fa-check"></i>';
																}else{
																	echo '<i style="color: red;" class="fa fa-times"></i>';
																};
															?></a>
														</li>
														<li class="list-group-item">
															<b>Wtorek</b><a class="float-right">
															<?php
																if($etat['wtorek'] == '1') {
																	echo '<i style="color: green;" class="fa fa-check"></i>';
																}else{
																	echo '<i style="color: red;" class="fa fa-times"></i>';
																};
															?></a>
														</li>
														<li class="list-group-item">
															<b>Środa</b><a class="float-right">
															<?php
																if($etat['sroda'] == '1') {
																	echo '<i style="color: green;" class="fa fa-check"></i>';
																}else{
																	echo '<i style="color: red;" class="fa fa-times"></i>';
																};
															?></a>
														</li>
														<li class="list-group-item">
															<b>Czwartek</b><a class="float-right">
															<?php
																if($etat['czwartek'] == '1') {
																	echo '<i style="color: green;" class="fa fa-check"></i>';
																}else{
																	echo '<i style="color: red;" class="fa fa-times"></i>';
																};
															?></a>
														</li>
														<li class="list-group-item">
															<b>Piątek</b><a class="float-right">
															<?php
																if($etat['piatek'] == '1') {
																	echo '<i style="color: green;" class="fa fa-check"></i>';
																}else{
																	echo '<i style="color: red;" class="fa fa-times"></i>';
																};
															?></a>
														</li>
														<li class="list-group-item">
															<b>Sobota</b><a class="float-right">
															<?php
																if($etat['sobota'] == '1') {
																	echo '<i style="color: green;" class="fa fa-check"></i>';
																}else{
																	echo '<i style="color: red;" class="fa fa-times"></i>';
																};
															?></a>
														</li>
														<li class="list-group-item">
															<b>Niedziela</b><a class="float-right">
															<?php
																if($etat['niedziela'] == '1') {
																	echo '<i style="color: green;" class="fa fa-check"></i>';
																}else{
																	echo '<i style="color: red;" class="fa fa-times"></i>';
																};
															?></a>
														</li>
													</ul>
												</div>
												<div class="col-12 col-xl-6">
													<ul class="list-group list-group-unbordered mb-3">
														<li class="list-group-item">
															<?php
																$cos = $xd1['pon'] + $xd1['wt'] + $xd1['sr'] + $xd1['czw'] + $xd1['pi'] + $xd1['sob'] + $xd1['niedz'];
															?>
															<b>Zmieniony Etat</b><a class="float-right"><?=$cos;?>/7</a>
														</li>
														<li class="list-group-item">
															<b>Poniedziałek</b><a class="float-right">
															<?php
																if($xd1['pon'] == '1') {
																	echo '<i style="color: green;" class="fa fa-check"></i>';
																}else{
																	echo '<i style="color: red;" class="fa fa-times"></i>';
																};
															?></a>
														</li>
														<li class="list-group-item">
															<b>Wtorek</b><a class="float-right">
															<?php
																if($xd1['wt'] == '1') {
																	echo '<i style="color: green;" class="fa fa-check"></i>';
																}else{
																	echo '<i style="color: red;" class="fa fa-times"></i>';
																};
															?></a>
														</li>
														<li class="list-group-item">
															<b>Środa</b><a class="float-right">
															<?php
																if($xd1['sr'] == '1') {
																	echo '<i style="color: green;" class="fa fa-check"></i>';
																}else{
																	echo '<i style="color: red;" class="fa fa-times"></i>';
																};
															?></a>
														</li>
														<li class="list-group-item">
															<b>Czwartek</b><a class="float-right">
															<?php
																if($xd1['czw'] == '1') {
																	echo '<i style="color: green;" class="fa fa-check"></i>';
																}else{
																	echo '<i style="color: red;" class="fa fa-times"></i>';
																};
															?></a>
														</li>
														<li class="list-group-item">
															<b>Piątek</b><a class="float-right">
															<?php
																if($xd1['pi'] == '1') {
																	echo '<i style="color: green;" class="fa fa-check"></i>';
																}else{
																	echo '<i style="color: red;" class="fa fa-times"></i>';
																};
															?></a>
														</li>
														<li class="list-group-item">
															<b>Sobota</b><a class="float-right">
															<?php
																if($xd1['sob'] == '1') {
																	echo '<i style="color: green;" class="fa fa-check"></i>';
																}else{
																	echo '<i style="color: red;" class="fa fa-times"></i>';
																};
															?></a>
														</li>
														<li class="list-group-item">
															<b>Niedziela</b><a class="float-right">
															<?php
																if($xd1['niedz'] == '1') {
																	echo '<i style="color: green;" class="fa fa-check"></i>';
																}else{
																	echo '<i style="color: red;" class="fa fa-times"></i>';
																};
															?></a>
														</li>
													</ul>
												</div>
												<div class="col-12">
													<ul class="list-group list-group-unbordered mb-3">
														<li class="list-group-item">
															<b>Powód</b><span class="float-right"><?=$xd1['powod'];?></span>
														</li>
														<li class="list-group-item">
															<b>Status</b><span class="float-right"><b style="<?=$style?>"><?=$text?></b></span>
														</li>
													</ul>
												</div>
											</div>
										<?php elseif($xd1['typ'] == 2):?>
											<div class="row">
												<div class="col-12">
													<ul class="list-group list-group-unbordered mb-3">
														<li class="list-group-item">
															<b>Data Rozpoczęcia Urlopu</b><span class="float-right"><?=$datau1;?></span>
														</li>
														<li class="list-group-item">
															<b>Data Zakończenia Urlopu</b><span class="float-right"><?=$datau2?></b></span>
														</li>
													</ul>
												</div>
												<div class="col-12">
													<ul class="list-group list-group-unbordered mb-3">
														<li class="list-group-item">
															<b>Powód</b><span class="float-right"><?=$xd1['powod'];?></span>
														</li>
														<li class="list-group-item">
															<b>Status</b><span class="float-right"><b style="<?=$style?>"><?=$text?></b></span>
														</li>
													</ul>
												</div>
											</div>
										<?php elseif($xd1['typ'] == 3):?>
											<div class="row">
												<div class="col-12">
													<ul class="list-group list-group-unbordered mb-3">
														<li class="list-group-item">
															<b>Powód</b><span class="float-right"><?=$xd1['powod'];?></span>
														</li>
														<li class="list-group-item">
															<b>Status</b><span class="float-right"><b style="<?=$style?>"><?=$text?></b></span>
														</li>
													</ul>
												</div>
											</div>
										<?php elseif($xd1['typ'] == 4):?>
											<div class="row">
												<div class="col-12">
													<ul class="list-group list-group-unbordered mb-3">
														<li class="list-group-item">
															<b>Data Kursu</b><span class="float-right"><?=$datakzw;?></span>
														</li>
													</ul>
												</div>
												<div class="col-12">
													<ul class="list-group list-group-unbordered mb-3">
														<li class="list-group-item">
															<b>Powód</b><span class="float-right"><?=$xd1['powod'];?></span>
														</li>
														<li class="list-group-item">
															<b>Status</b><span class="float-right"><b style="<?=$style?>"><?=$text?></b></span>
														</li>
													</ul>
												</div>
											</div>
										<?php elseif($xd1['typ'] == 5):?>
											<div class="row">
												<div class="col-12">
													<ul class="list-group list-group-unbordered mb-3">
														<li class="list-group-item">
															<b>Pojazd</b><span class="float-right"><?=$xd1['pojazd'];?></span>
														</li>
													</ul>
												</div>
												<div class="col-12">
													<ul class="list-group list-group-unbordered mb-3">
														<li class="list-group-item">
															<b>Powód</b><span class="float-right"><?=$xd1['powod'];?></span>
														</li>
														<li class="list-group-item">
															<b>Status</b><span class="float-right"><b style="<?=$style?>"><?=$text?></b></span>
														</li>
													</ul>
												</div>
											</div>
										<?php endif;?>
									</div>
									<div class="col-12 col-xl-6">
										<ul class="list-group list-group-unbordered mb-3">
											<li class="list-group-item">
												<center>Miejsce przeznaczone dla osoby sprawdzającej</center>
											</li>
										</ul>
										<?php if($xd1['status'] == 0):?>
											<ul class="list-group list-group-unbordered mb-3">
												<li class="list-group-item">
													<center>Wniosek oczekuje na rozpatrzenie</center>
												</li>
											</ul>
										<?php elseif($xd1['status'] == 1):?>
											<ul class="list-group list-group-unbordered mb-3">
												<li class="list-group-item">
													<center>Wniosek rozpatrzony pozytywnie</center>
												</li>
												<li class="list-group-item">
													<center><b>Uwagi</b></center>
													<center><?=$xd1['uwagi'];?></center>
												</li>
												<li class="list-group-item">
													<center><b>Sprawdził</b></center>
													<center><a href="index.php?a=profile&p=<?=$u['id'];?>" style="color: <?=$r['kolor'];?>"><?=$u['login'], ' [', $r['kod_roli'], $u['nr_sluzbowy'],']';?></a></center>
												</li>
											</ul>
										<?php elseif($xd1['status'] == 2):?>
											<ul class="list-group list-group-unbordered mb-3">
												<li class="list-group-item">
													<center>Wniosek rozpatrzony negatywnie</center>
												</li>
												<li class="list-group-item">
													<center><b>Uwagi</b></center>
													<center><?=$xd1['uwagi'];?></center>
												</li>
												<li class="list-group-item">
													<center><b>Sprawdził</b></center>
													<center><a href="index.php?a=profile&p=<?=$u['id'];?>" style="color: <?=$r['kolor'];?>"><?=$u['login'], ' [', $r['kod_roli'], $u['nr_sluzbowy'],']';?></a></center>
												</li>
											</ul>
										<?php endif;?>
									</div>
								</div>


								<?php //endif; ?>
							</div>
						</div>
					</div>
				<?php endif;?>
			</div>
			<!-- /.row -->
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->

	<!-- delete Modal -->
	<div id="delete" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Odrzucanie wniosku</h4>
				</div>
				<form action="index.php?a=pojazd-wnioski&edit=<?=$id?>&delete=true" method="POST">
					<div class="modal-body">
						<div class="form-group">
							<label>Powód</label>
							<textarea class="form-control" name="uwagi" rows="3" placeholder="Powód" required></textarea>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Anuluj</button>
						<button type="submit" name="button_delete" class="btn btn-primary">Zatwierdź</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- Remember to include jQuery :) -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>

	<!-- jQuery Modal -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>

	<!-- Page specific script -->
	<script type="text/javascript">
		$(document).ready(function() {
			$(".del_btn").on('click', function() {
				$("#delete").modal('show');
			});
		});
	</script>
