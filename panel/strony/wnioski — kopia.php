<?php
	if($perm['oglądanie_wniosków'] == '0'){
		header('Location: index.php?a=home');
	}
	$etat = row("SELECT * FROM etaty WHERE uid = ".$user['id']);
	$wperm1 = row("SELECT * FROM wnioski_permisje WHERE wid = 1 AND uid = ".$user['id']);
	$wperm2 = row("SELECT * FROM wnioski_permisje WHERE wid = 2 AND uid = ".$user['id']);
	$wperm3 = row("SELECT * FROM wnioski_permisje WHERE wid = 3 AND uid = ".$user['id']);
	$wperm4 = row("SELECT * FROM wnioski_permisje WHERE wid = 4 AND uid = ".$user['id']);
	$wperm5 = row("SELECT * FROM wnioski_permisje WHERE wid = 5 AND uid = ".$user['id']);
	$wperm6 = row("SELECT * FROM wnioski_permisje WHERE wid = 6 AND uid = ".$user['id']);
	$wperm7 = row("SELECT * FROM wnioski_permisje WHERE wid = 7 AND uid = ".$user['id']);


	if(empty($wperm1)){
		$wperm1['wid'] = '1';
		$wperm1['przycisk'] = '0';
		$dym1 = 'data-toggle="tooltip" data-original-title="Nie masz uprawnień do złożenia tego wniosku!"';
	} else {
		$wperm1['przycisk'] = $wperm1['przycisk'];
		$dym1 = 'data-toggle="tooltip" data-original-title="'.$wperm1['dymek'].'"';
	}
	if(empty($wperm2)){
		$wperm2['wid'] = '2';
		$wperm2['przycisk'] = '0';
		$dym2 = 'data-toggle="tooltip" data-original-title="Nie masz uprawnień do złożenia tego wniosku!"';
	} else {
		$wperm2['przycisk'] = $wperm2['przycisk'];
		$dym2 = 'data-toggle="tooltip" data-original-title="'.$wperm2['dymek'].'"';
	}
	if(empty($wperm3)){
		$wperm3['wid'] = '3';
		$wperm3['przycisk'] = '0';
		$dym3 = 'data-toggle="tooltip" data-original-title="Nie masz uprawnień do złożenia tego wniosku!"';
	} else {
		$wperm3['przycisk'] = $wperm3['przycisk'];
		$dym3 = 'data-toggle="tooltip" data-original-title="'.$wperm3['dymek'].'"';
	}
	if(empty($wperm4)){
		$wperm4['wid'] = '4';
		$wperm4['przycisk'] = '0';
		$dym4 = 'data-toggle="tooltip" data-original-title="Nie masz uprawnień do złożenia tego wniosku!"';
	} else {
		$wperm4['przycisk'] = $wperm4['przycisk'];
		$dym4 = 'data-toggle="tooltip" data-original-title="'.$wperm4['dymek'].'"';
	}
	if(empty($wperm5)){
		$wperm5['wid'] = '5';
		$wperm5['przycisk'] = '0';
		$dym5 = 'data-toggle="tooltip" data-original-title="Nie masz uprawnień do złożenia tego wniosku!"';
	} else {
		$wperm5['przycisk'] = $wperm5['przycisk'];
		$dym5 = 'data-toggle="tooltip" data-original-title="'.$wperm5['dymek'].'"';
	}
	if(empty($wperm6)){
		$wperm6['wid'] = '6';
		$wperm6['przycisk'] = '0';
		$dym6 = 'data-toggle="tooltip" data-original-title="Nie masz uprawnień do złożenia tego wniosku!"';
	} else {
		$wperm6['przycisk'] = $wperm6['przycisk'];
		$dym6 = 'data-toggle="tooltip" data-original-title="'.$wperm6['dymek'].'"';
	};
	if(empty($wperm7)){
		$wperm7['wid'] = '7';
		$wperm7['przycisk'] = '0';
		$dym6 = 'data-toggle="tooltip" data-original-title="Nie masz uprawnień do złożenia tego wniosku!"';
	} else {
		$wperm7['przycisk'] = $wperm7['przycisk'];
		$dym7 = 'data-toggle="tooltip" data-original-title="'.$wperm7['dymek'].'"';
	};
	if (!isset($_GET['id']) && !isset($_GET['view'])) {
		$strona1 = true;
		$strona2 = false;
		$strona3 = false;
	} elseif (isset($_GET['id']) && !isset($_GET['view'])) {
		$id = vtxt($_GET['id']);

		if($wperm1['wid'] == $id && $wperm1['przycisk'] == '0' || $wperm2['wid'] == $id && $wperm2['przycisk'] == '0' || $wperm3['wid'] == $id && $wperm3['przycisk'] == '0' || $wperm4['wid'] == $id && $wperm4['przycisk'] == '0' || $wperm5['wid'] == $id && $wperm5['przycisk'] == '0' || $wperm6['wid'] == $id && $wperm6['przycisk'] == '0'){
			$strona1 = true;
			$strona2 = false;
			$strona3 = false;
			echo throwInfo('danger', 'Nie masz uprawnień do złożenia tego wniosku!', true);
		} else {
			$strona1 = false;
			$strona2 = true;
			$strona3 = false;
		}

	} elseif (!isset($_GET['id']) && isset($_GET['view'])) {

		$view = vtxt($_GET['view']);
		$target = row("SELECT * FROM wnioski WHERE id = ".$view." AND uid = ".$user['id']);
		if(!$target){
			header('Location: index.php?a=home');
		}

		$strona1 = false;
		$strona2 = false;
		$strona3 = true;
	} else {
		$strona1 = true;
		$strona2 = false;
		$strona2 = false;
	}
?>
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Wnioski</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="index.php?a=home">Panel kierowcy</a></li>
						<li class="breadcrumb-item active">Wnioski</li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<?php
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
			<!-- Small boxes (Stat box) -->
			<div class="row">
				<?php if($strona1):?>
					<div class="col-lg-7">
						<div class="card shadow mb-4">
							<div class="card-header py-3">
								<h3 class="m-0 font-weight-bold text-primary">Wnioski Złożone</h3>
							</div>
							<!-- /.card-header -->
							<div class="card-body table-responsive p-0">
								<table class="table table-hover text-nowrap text-center">
									<?php
										$targets = call("SELECT * FROM wnioski WHERE uid = ".$user['id']."");
										if ($targets->num_rows == 0) {?>
												<div class="card-body">
													<?php throwInfo('info', 'Brak Danych!', false);?>
												</div>
											<?php } else {
									?>
									<thead >
										<tr >
											<th>Typ wniosku</th>
											<th>Data Złożenia</th>
											<th>Status</th>
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
											//$poj = row("SELECT * FROM tabor WHERE id =".$row['pojazd']);
											$dataczegos = date('d.m.Y',$row['datawniosku']);
											?>
											<tr>
												<td><?=$typ;?></td>
												<td><?=$dataczegos;?></td>
												<?php
													if($row['status'] == 0){
														echo '<td><b style="color: #cccc00">Oczekuje na sprawdzenie</b></td><td class="project-actions "><a href="index.php?a=wnioski&view='.$row['id'].'"><button type="button" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Wybierz</button></a></td>';
													} elseif($row['status'] == 1){
														echo '<td><b style="color: #009900">Rozpatrzony Pozytywnie</b></td><td class="project-actions ">
														<a href="index.php?a=wnioski&view='.$row['id'].'"><button type="button" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Wybierz</button></a></td>';
													} elseif($row['status'] == 2){
														echo '<td><b style="color: #ff0000">Rozpatrzony Negatywnie</b></td><td class="project-actions ">
														<a href="index.php?a=wnioski&view='.$row['id'].'"><button type="button" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Wybierz</button></a></td>';
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
					<div class="col-lg-5">
						<div class="card shadow mb-4">
							<div class="card-header py-3">
								<h3 class="m-0 font-weight-bold text-primary">Wnioski</h3>
							</div>
							<!-- /.card-header -->
							<div class="card-body table-responsive p-0">
								<table class="table table-hover text-nowrap text-center">
									<thead >
										<tr>
											<th scope="col">Nazwa</th>
											<th scope="col" style="width: 200px;">Opcje</th>
										</tr>
									</thead>
									<tbody >
										<tr>
											<td>Wniosek o zmianę etatu</td>
											<td>
												<?php
													if($wperm1['przycisk'] == '0'){
														echo '<button class="btn btn-success disabled"'.$dym1.'><i class="fas fa-plus-square"></i>  WYPEŁNIJ</button>';
													}else{
														echo '<a href="index.php?a=wnioski&id=1"><button class="btn btn-success"><i class="fas fa-plus-square"></i>  WYPEŁNIJ</button></a>';
													};
												?>
											</td>
										</tr>
										<tr>
											<td>Wniosek o urlop</td>
											<td>
												<?php
													if($wperm2['przycisk'] == '0'){
														echo '<button class="btn btn-success disabled"'.$dym2.'><i class="fas fa-plus-square"></i>  WYPEŁNIJ</button>';
													}else{
														echo '<a href="index.php?a=wnioski&id=2"><button class="btn btn-success"><i class="fas fa-plus-square"></i>  WYPEŁNIJ</button></a>';
													};
												?>
											</td>
										</tr>
										<tr>
											<td>Wypowiedzenie umowy o pracę</td>
											<td>
												<?php
													if($wperm3['przycisk'] == '0'){
														echo '<button class="btn btn-success disabled"'.$dym3.'><i class="fas fa-plus-square"></i>  WYPEŁNIJ</button>';
													}else{
														echo '<a href="index.php?a=wnioski&id=3"><button class="btn btn-success"><i class="fas fa-plus-square"></i>  WYPEŁNIJ</button></a>';
													};
												?>
											</td>
										</tr>
										<tr>
											<td>Wniosek o kurs z wolnego</td>
											<td>
												<?php
													if($wperm4['przycisk'] == '0'){
														echo '<button class="btn btn-info disabled"'.$dym4.'><i class="fas fa-plus-square"></i>  WYPEŁNIJ</button>';
													}else{
														echo '<a href="index.php?a=wnioski&id=4"><button class="btn btn-info"><i class="fas fa-plus-square"></i>  WYPEŁNIJ</button></a>';
													};
												?>
											</td>
										</tr>
										<tr>
											<td>Wniosek o stały przydział pojazdu</td>
											<td>
												<?php
													if($wperm5['przycisk'] == '0'){
														echo '<button class="btn btn-info disabled"'.$dym5.'><i class="fas fa-plus-square"></i>  WYPEŁNIJ</button>';
													}else{
														echo '<a href="index.php?a=wnioski&id=5"><button class="btn btn-info"><i class="fas fa-plus-square"></i>  WYPEŁNIJ</button></a>';
													};
												?>
											</td>
										</tr>
										<tr>
											<td>Wniosek o nieprzydzielanie pojazdu</td>
											<td>
												<?php
													if($wperm6['przycisk'] == '0'){
														echo '<button class="btn btn-info disabled"'.$dym6.'><i class="fas fa-plus-square"></i>  WYPEŁNIJ</button>';
													}else{
														echo '<a href="index.php?a=wnioski&id=6"><button class="btn btn-info"><i class="fas fa-plus-square"></i>  WYPEŁNIJ</button></a>';
													};
												?>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							<!-- /.card-body -->
						</div>
					</div>
				<?php elseif($strona2):?>
					<div class="col-12">
						<div class="card shadow mb-4">
							<?php
								switch($id){
									case '1' : $tytul = 'Wniosek o zmianę etatu'; break;
									case '2' : $tytul = 'Wniosek o urlop'; break;
									case '3' : $tytul = 'Wypowiedzenie umowy o pracę'; break;
									case '4' : $tytul = 'Wniosek o kurs z wolnego'; break;
									case '5' : $tytul = 'Wniosek o stały przydział pojazdu'; break;
									case '6' : $tytul = 'Wniosek o nieprzydzielanie pojazdu'; break;
								}
							?>
							<div class="card-header py-3">
								<h3 class="m-0 font-weight-bold text-primary"><?=$tytul;?></h3>
							</div>
							<!-- /.card-header -->
							<div class="card-body">
								<?php
									if($id == 1){
										if (!empty($_POST)) {
											if(isset($_POST['button']) && empty($_POST['powod'])){
												throwInfo('danger', 'Wypełnij wszystkie pola!', true);
											} else {
												$powod = vtxt($_POST['powod']);
												$pon = $_POST['etat1'] ?? null;
												$wt = $_POST['etat2'] ?? null;
												$sr = $_POST['etat3'] ?? null;
												$czw = $_POST['etat4'] ?? null;
												$pi = $_POST['etat5'] ?? null;
												$sob = $_POST['etat6'] ?? null;
												$ndz = $_POST['etat7'] ?? null;

												if($pon){
													$pon = 1;
												}else{
													$pon = 0;
												}
												if($wt){
													$wt = 1;
												}else{
													$wt = 0;
												}
												if($sr){
													$sr = 1;
												}else{
													$sr = 0;
												}
												if($czw){
													$czw = 1;
												}else{
													$czw = 0;
												}
												if($pi){
													$pi = 1;
												}else{
													$pi = 0;
												}
												if($sob){
													$sob = 1;
												}else{
													$sob = 0;
												}
												if($ndz){
													$ndz = 1;
												}else{
													$ndz = 0;
												}

												$suma = $pon + $wt + $sr + $czw + $pi + $sob + $ndz;
												if($suma < '1'){
													throwInfo('danger', 'Minimalny etat to 1/7', true);
												}elseif($suma > '6'){
													throwInfo('danger', 'Maksymalny etat to 6/7', true);
												}else{
													$miesiac = date("m");
													$dzien = date("d");
													$rok = date("Y");
													$date = mktime(0, 0, 0, $miesiac, $dzien, $rok);
													$timestamp = date("Y-m-d H:i:s");
													$query = call("INSERT INTO wnioski (uid, typ, pon, wt, sr, czw, pi, sob, niedz, powod, datawniosku) VALUES ('".$user['id']."', 1, '".$pon."', '".$wt."', '".$sr."', '".$czw."', '".$pi."', '".$sob."', '".$ndz."', '".$powod."', '".$date."')");
													$log = call("INSERT INTO logi (uid, akcja) VALUES ('".$user['id']."', 'Użytkownik ".$user['login']." złożył wniosek o zmianę etatu!')");
													$client->channel->createMessage([
														'channel.id' => intval($pushchannel),
														'content' => '<@723433480956018760>',
														'embed' => [
															"author" => [
																"name" => "Złożono wniosek o zmianę etatu",
																"url" => "",
																"icon_url" => "https://cdn.discordapp.com/emojis/732618937446957096.png?v=1"
															],
															"description" => '
																» Osoba: **['.$role['kod_roli'].''.$user['nr_sluzbowy'].'] '.$user['login'].'**
																» Typ: **Wniosek o zmianę etatu**
																» Powód: **'.$powod.'**
															',
															"color" => hexdec('#f6c23e'),
															"footer" => [
																"icon_url" => "https://cdn.discordapp.com/icons/645582261378613249/5d0deaffdc5531a405583b16f823d928.png?size=128",
																"text" => "Powiadomienie z panelu!"
															],
															"timestamp" => $timestamp
														]
													]);
													$client->channel->createMessage([
														'channel.id' => intval($logchannel),
														'content' => '',
														'embed' => [
															"author" => [
																"name" => "Złożono wniosek o zmianę etatu",
																"url" => "",
																"icon_url" => "https://cdn.discordapp.com/emojis/732618937446957096.png?v=1"
															],
															"description" => '
																**['.$role['kod_roli'].''.$user['nr_sluzbowy'].'] '.$user['login'].'** Złożył wniosek o zmianę etatu
															',
															"color" => hexdec('#f6c23e'),
															"footer" => [
																"icon_url" => "https://cdn.discordapp.com/icons/645582261378613249/5d0deaffdc5531a405583b16f823d928.png?size=128",
																"text" => "Logi panelu"
															],
															"timestamp" => $timestamp
														]
													]);
													if($query && $log){
														$_SESSION['success'] = 'Poprawnie wysłano wniosek';
														header('Location: index.php?a=wnioski');
													} else {
														$_SESSION['danger'] = 'Wystąpił błąd!';
														header('Location: index.php?a=wnioski');
													}
												}
											}
										}
									}elseif($id == 2){
										if (!empty($_POST)) {
											if(isset($_POST['button']) && empty($_POST['powod']) || empty($_POST['urlop1']) || empty($_POST['urlop2'])){
												throwInfo('danger', 'Wypełnij wszystkie pola!', true);
											} else {
												//dane z formularza
												$powod = vtxt($_POST['powod']);
												$urlop1 = vtxt($_POST['urlop1']);
												$urlop2 = vtxt($_POST['urlop2']);
												//data
												$miesiac = date("m");
												$dzien = date("d");
												$rok = date("Y");
												$date = mktime(0, 0, 0, $miesiac, $dzien, $rok);
												$timestamp = date("Y-m-d H:i:s");
												$u1 = strtotime($urlop1);
												$u2 = strtotime($urlop2);
												//limity
												$wyprzedzenie = $date + 604800;
												$max = $u1 + 1206000;
												//warunki
												if($u1 == $u2){
													throwInfo('danger', 'Wybrane daty są takie same! Wybierz prawidłowe wartości!', true);
												}elseif($u1 > $u2){
													throwInfo('danger', 'Data zakończenia urlopu nie może być przed rozpoczęciem urlopu!', true);
												}elseif($u1 < $wyprzedzenie){
													throwInfo('danger', 'Urlop można wziąć z tygodniowym wyprzedzeniem!', true);
												}elseif($u2 > $max){
													throwInfo('danger', 'Urlop moży trwać maxymalnie 2 tygodnie!', true);
													throwInfo('warning', 'Jeżeli masz nagłą potrzebę wzięcia dłuższego urlopu niż 2 tygodnie skontaktuj się z zarządem!', true);
												}else{
													$query = call("INSERT INTO wnioski (uid, typ, data1, data2, powod, datawniosku) VALUES ('".$user['id']."', 2, '".$u1."', '".$u2."', '".$powod."', '".$date."')");
													$log = call("INSERT INTO logi (uid, akcja) VALUES ('".$user['id']."', 'Użytkownik ".$user['login']." złożył wniosek o urlop!')");
													$client->channel->createMessage([
														'channel.id' => intval($pushchannel),
														'content' => '<@&723433480956018760>',
														'embed' => [
															"author" => [
																"name" => "Złożono wniosek o urlop",
																"url" => "",
																"icon_url" => "https://cdn.discordapp.com/emojis/732618937446957096.png?v=1"
															],
															"description" => '
																» Osoba: **['.$role['kod_roli'].''.$user['nr_sluzbowy'].'] '.$user['login'].'**
																» Typ: **Wniosek o Urlop**
																» Data rozpoczęcia urlopu: **'.$urlop1.'**
																» Data zakończenia urlopu: **'.$urlop2.'**
																» Powód: **'.$powod.'**
															',
															"color" => hexdec('#f6c23e'),
															"footer" => [
																"icon_url" => "https://cdn.discordapp.com/icons/645582261378613249/5d0deaffdc5531a405583b16f823d928.png?size=128",
																"text" => "Powiadomienie z panelu!"
															],
															"timestamp" => $timestamp
														]
													]);
													$client->channel->createMessage([
														'channel.id' => intval($logchannel),
														'content' => '',
														'embed' => [
															"author" => [
																"name" => "Złożono wniosek o urlop",
																"url" => "",
																"icon_url" => "https://cdn.discordapp.com/emojis/732618937446957096.png?v=1"
															],
															"description" => '
																**['.$role['kod_roli'].''.$user['nr_sluzbowy'].'] '.$user['login'].'** Złożył wniosek o urlop
															',
															"color" => hexdec('#f6c23e'),
															"footer" => [
																"icon_url" => "https://cdn.discordapp.com/icons/645582261378613249/5d0deaffdc5531a405583b16f823d928.png?size=128",
																"text" => "Logi panelu"
															],
															"timestamp" => $timestamp
														]
													]);
													if($query && $log){
														$_SESSION['success'] = 'Poprawnie wysłano wniosek';
														header('Location: index.php?a=wnioski');
													} else {
														$_SESSION['danger'] = 'Wystąpił błąd!';
														header('Location: index.php?a=wnioski');
													}
												}
											}
										}
									}elseif($id == 3) {
										if (!empty($_POST)) {
											if(isset($_POST['button']) && empty($_POST['powod'])){
												throwInfo('danger', 'Wypełnij wszystkie pola!', true);
											} else {
												$powod = vtxt($_POST['powod']);
												$miesiac = date("m");
												$dzien = date("d");
												$rok = date("Y");
												$date = mktime(0, 0, 0, $miesiac, $dzien, $rok);
												$timestamp = date("Y-m-d H:i:s");
												$query = call("INSERT INTO wnioski (uid, typ, powod, datawniosku) VALUES ('".$user['id']."', 3, '".$powod."', '".$date."')");
												$log = call("INSERT INTO logi (uid, akcja) VALUES ('".$user['id']."', 'Użytkownik ".$user['login']." złożył wypowiedzenie umowy o pracę!')");

												$client->channel->createMessage([
													'channel.id' => intval($pushchannel),
													'content' => '<@&723433480956018760>',
													'embed' => [
														"author" => [
															"name" => "Złożono wniosek o zwolnienie",
															"url" => "",
															"icon_url" => "https://cdn.discordapp.com/emojis/732618937446957096.png?v=1"
														],
														"description" => '
															» Osoba: **['.$role['kod_roli'].''.$user['nr_sluzbowy'].'] '.$user['login'].'**
															» Typ: **Wypowiedzenie umowy o pracę**
															» Powód: **'.$powod.'**
														',
														"color" => hexdec('#f6c23e'),
														"footer" => [
															"icon_url" => "https://cdn.discordapp.com/icons/645582261378613249/5d0deaffdc5531a405583b16f823d928.png?size=128",
															"text" => "Powiadomienie z panelu!"
														],
														"timestamp" => $timestamp
													]
												]);
												$client->channel->createMessage([
													'channel.id' => intval($logchannel),
													'content' => '',
													'embed' => [
														"author" => [
															"name" => "Złożono wniosek o zwolnienie",
															"url" => "",
															"icon_url" => "https://cdn.discordapp.com/emojis/732618937446957096.png?v=1"
														],
														"description" => '
															**['.$role['kod_roli'].''.$user['nr_sluzbowy'].'] '.$user['login'].'** Złożył wniosek o zwolnienie
														',
														"color" => hexdec('#f6c23e'),
														"footer" => [
															"icon_url" => "https://cdn.discordapp.com/icons/645582261378613249/5d0deaffdc5531a405583b16f823d928.png?size=128",
															"text" => "Logi panelu"
														],
														"timestamp" => $timestamp
													]
												]);
												if($query && $log){
													$_SESSION['success'] = 'Poprawnie wysłano wniosek';
													header('Location: index.php?a=wnioski');
												} else {
													$_SESSION['danger'] = 'Wystąpił błąd!';
													header('Location: index.php?a=wnioski');
												}
											}
										}
									} elseif ($id == 4) {
										if (!empty($_POST)) {
											if(isset($_POST['button']) && empty($_POST['powod']) && empty($_POST['kzw'])){
												throwInfo('danger', 'Wypełnij wszystkie pola!', true);
											} else {
												//dane z formularza
												$powod = vtxt($_POST['powod']);
												$kzwf = vtxt($_POST['kzw']);
												//data
												$miesiac = date("m");
												$dzien = date("d");
												$rok = date("Y");
												$date = mktime(0, 0, 0, $miesiac, $dzien, $rok);
												$timestamp = date("Y-m-d H:i:s");
												$kzw = strtotime($kzwf);
												//limity
												$wyprzedzenie = $date + 259200;
												//warunki
												//echo $wyprzedzenie, ' ', $kzw;
												if($kzw < $wyprzedzenie){
													throwInfo('danger', 'Kurs z wolnego można wziąć z 3 dniowym wyprzedzeniem!', true);
												} else {
													$query = call("INSERT INTO wnioski (uid, typ, powod, datawniosku, datakzw) VALUES ('".$user['id']."', 4, '".$powod."', '".$date."', '".$kzw."')");
													$log = call("INSERT INTO logi (uid, akcja) VALUES ('".$user['id']."', 'Użytkownik ".$user['login']." złożył wniosek o kurs z wolnego!')");
													if($query){
														if($log){
															$client->channel->createMessage([
																'channel.id' => intval($pushchannel),
																'content' => '<@&723433074951716955>',
																'embed' => [
																	"author" => [
																		"name" => "Złożono wniosek o kurs z wolnego",
																		"url" => "",
																		"icon_url" => "https://cdn.discordapp.com/emojis/732618937446957096.png?v=1"
																	],
																	"description" => '
																		» Osoba: **['.$role['kod_roli'].''.$user['nr_sluzbowy'].'] '.$user['login'].'**
																		» Typ: **Wniosek o kurs z wolnego**
																		» Data Kursu: **'.$kzwf.'**
																		» Powód: **'.$powod.'**
																	',
																	"color" => hexdec('#f6c23e'),
																	"footer" => [
																		"icon_url" => "https://cdn.discordapp.com/icons/645582261378613249/5d0deaffdc5531a405583b16f823d928.png?size=128",
																		"text" => "Powiadomienie z panelu!"
																	],
																	"timestamp" => $timestamp
																]
															]);
															$client->channel->createMessage([
																'channel.id' => intval($logchannel),
																'content' => '',
																'embed' => [
																	"author" => [
																		"name" => "Złożono wniosek o kurs z wolnego",
																		"url" => "",
																		"icon_url" => "https://cdn.discordapp.com/emojis/732618937446957096.png?v=1"
																	],
																	"description" => '
																		**['.$role['kod_roli'].''.$user['nr_sluzbowy'].'] '.$user['login'].'** Złożył wniosek o kurs z wolnego
																	',
																	"color" => hexdec('#f6c23e'),
																	"footer" => [
																		"icon_url" => "https://cdn.discordapp.com/icons/645582261378613249/5d0deaffdc5531a405583b16f823d928.png?size=128",
																		"text" => "Logi panelu"
																	],
																	"timestamp" => $timestamp
																]
															]);
															$_SESSION['success'] = 'Poprawnie wysłano wniosek';
															header('Location: index.php?a=wnioski');
														}else{
															$_SESSION['danger'] = 'Wystąpił błąd!';
															header('Location: index.php?a=wnioski');
														}
													} else {
														$_SESSION['danger'] = 'Wystąpił błąd!';
														header('Location: index.php?a=wnioski');
													}
												}
											}
										}
									}
								?>
								<form action="" method="POST">
									<div class="row">
										<div class="col-md-12 mb-6">
											<div class="form-group">
												<label>Kierowca</label>
												<input type="text" class="form-control" readonly style="color: <?=$role['kolor'];?>" value="<?=$user['login'], ' [', $role['kod_roli'], $user['nr_sluzbowy'],']';?>">
											</div>
										</div>
										<?php if($id == 1):?>
											<div class="col-lg-12 mb-6">
												Twoj obecny etat
											</div>
											<div class="col-lg-12 mb-6">
												<div class="form-group">
													<label>Etat</label>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="etat1" name="etat1" <?php if($etat['poniedzialek'] == '1') echo "checked";?>>
														<label class="form-check-label" for="etat1"> Poniedziałek</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="etat2" name="etat2" <?php if($etat['wtorek'] == '1') echo "checked";?>>
														<label class="form-check-label" for="etat2"> Wtorek</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="etat3" name="etat3" <?php if($etat['sroda'] == '1') echo "checked";?>>
														<label class="form-check-label" for="etat3"> Środa</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="etat4" name="etat4" <?php if($etat['czwartek'] == '1') echo "checked";?>>
														<label class="form-check-label" for="etat4"> Czwartek</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="etat5" name="etat5" <?php if($etat['piatek'] == '1') echo "checked";?>>
														<label class="form-check-label" for="etat5"> Piątek</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="etat6" name="etat6" <?php if($etat['sobota'] == '1') echo "checked";?>>
														<label class="form-check-label" for="etat6"> Sobota</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="etat7" name="etat7" <?php if($etat['niedziela'] == '1') echo "checked";?>>
														<label class="form-check-label" for="etat7"> Niedziela</label>
													</div>
												</div>
											</div>
											<div class="col-lg-12 mb-6">
												<div class="form-group">
													<label for="powod">Powód</label>
													<textarea class="form-control" rows="3" id="powod" name="powod" placeholder="Powód"></textarea>
												</div>
												<button type="submit" name="button" class="btn btn-primary">Zatwierdź</button>
											</div>

										<?php elseif($id == 2):?>
											<div class="col-md-12 mb-6">
												<div class="form-group">
													<label>Początek urlopu</label>
													<div class="input-group">
														<div class="input-group-prepend">
															<span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
														</div>
														<input type="date" class="form-control" name="urlop1" id="urlop1" placeholder="Początek urlopu" value="">
													</div>
												</div>
											</div>
											<div class="col-md-12 mb-6">
												<div class="form-group">
													<label>Koniec urlopu</label>
													<div class="input-group">
														<div class="input-group-prepend">
															<span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
														</div>
														<input type="date" class="form-control" name="urlop2" placeholder="Koniec urlopu" value="">
													</div>
												</div>
											</div>
											<div class="col-lg-12 mb-6">
												<div class="form-group">
													<label for="powod">Powód</label>
													<textarea class="form-control" rows="3" id="powod" name="powod" placeholder="Powód"></textarea>
												</div>
												<button type="submit" name="button" class="btn btn-primary">Zatwierdź</button>
											</div>
										<?php elseif($id == 3):?>
											<div class="col-lg-12 mb-6">
												<div class="form-group">
													<label for="powod">Powód</label>
													<textarea class="form-control" rows="3" id="powod" name="powod" placeholder="Powód"></textarea>
												</div>
												<button type="submit" name="button" class="btn btn-primary">Zatwierdź</button>
											</div>
										<?php elseif($id == 4):?>
											<div class="col-lg-12 mb-6">
												<div class="form-group">
													<label>Data kursu</label>
													<div class="input-group">
														<div class="input-group-prepend">
															<span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
														</div>
														<input type="date" class="form-control" name="kzw" placeholder="Data kursu">
													</div>
												</div>
												<div class="form-group">
													<label for="powod">Powód</label>
													<textarea class="form-control" rows="3" id="powod" name="powod" placeholder="Powód"></textarea>
												</div>
												<button type="submit" name="button" class="btn btn-primary">Zatwierdź</button>
											</div>
										<?php endif;?>
									</div>
								</form>
							</div>
							<!-- /.card-body -->
						</div>
					</div>
				<?php elseif($strona3):?>
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
						} elseif($target['typ'] == 2){
							$dataczegos = date('d.m.Y', $target['datawniosku']);
							$datau1 = date('d.m.Y', $target['data1']);
							$datau2 = date('d.m.Y', $target['data2']);
						} elseif ($target['typ'] == 3) {
							$dataczegos = date('d.m.Y', $target['datawniosku']);
						} elseif ($target['typ'] == 4) {
							$dataczegos = date('d.m.Y', $target['datawniosku']);
							$datakzw = date('d.m.Y', $target['datakzw']);
						}




						if($target['status'] == 0){
							$style = "color: #cccc00";
							$text = 'Oczekuje na sprawdzenie';
						} elseif($target['status'] == 1){
							$style = "color: #009900";
							$text = "Rozpatrzony Pozytywnie";
							$u = row("SELECT * FROM users WHERE id = ".$target['sid']);
							$r = row("SELECT * FROM rangi WHERE id = ".$u['stanowisko']);
						} elseif($target['status'] == 2){
							$style = "color: #ff0000";
							$text = 'Rozpatrzony Negatywnie';
							$u = row("SELECT * FROM users WHERE id = ".$target['sid']);
							$r = row("SELECT * FROM rangi WHERE id = ".$u['stanowisko']);
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
												<b>Nazwa uzytkownika</b><span class="float-right"><a href="index.php?a=profile&p=<?=$user['id'];?>" style="color: <?=$role['kolor'];?>"><?='['.$role['kod_roli'].''.$user['nr_sluzbowy'].'] '.$user['login'].'';?></a></span>
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
															<b>Data Kursu</b><span class="float-right"><?=$datakzw;?></span>
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
										<?php endif;?>
									</div>
									<div class="col-12 col-xl-6">
										<ul class="list-group list-group-unbordered mb-3">
											<li class="list-group-item">
												<center>Miejsce Przeznaczone Dla Sprawdzającego</center>
											</li>
										</ul>
										<?php if($target['status'] == 0):?>
											<ul class="list-group list-group-unbordered mb-3">
												<li class="list-group-item">
													<center>Wniosek oczekuje na rozpatrzenie</center>
												</li>
											</ul>
										<?php elseif($target['status'] == 1):?>
											<ul class="list-group list-group-unbordered mb-3">
												<li class="list-group-item">
													<center>Wniosek rozpatrzony pozytywnie</center>
												</li>
												<li class="list-group-item">
													<center><b>Uwagi</b></center>
													<center><?=$target['uwagi'];?></center>
												</li>
												<li class="list-group-item">
													<center><b>Sprawdził</b></center>
													<center><a href="index.php?a=profile&p=<?=$u['id'];?>" style="color: <?=$r['kolor'];?>"><?=$u['login'], ' [', $r['kod_roli'], $u['nr_sluzbowy'],']';?></a></center>
												</li>
											</ul>
										<?php elseif($target['status'] == 2):?>
											<ul class="list-group list-group-unbordered mb-3">
												<li class="list-group-item">
													<center>Wniosek rozpatrzony negatywnie</center>
												</li>
												<li class="list-group-item">
													<center><b>Uwagi</b></center>
													<center><?=$target['uwagi'];?></center>
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
		</div><!-- /.container-fluid -->
	</section>

	<!-- /.content -->
<!-- Remember to include jQuery :) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
<script type="text/javascript">
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})</script>
