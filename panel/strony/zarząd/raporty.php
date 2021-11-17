<?php
	if($perm['zarzadzanie raportami'] == '0'){
		header('Location: index.php?a=home');
	}

	$miesiac = date("m");
	$dzien = date("d");
	$rok = date("Y");
	$date = mktime(0, 0, 0, $miesiac, $dzien, $rok);
	$wczoraj = mktime(0, 0, 0, $miesiac, $dzien-1, $rok);

	$jakas = row("SELECT * FROM raporty WHERE status = 0 AND data=".$wczoraj." AND typ_kursu != 5");
	if($jakas){
		$elo = call("UPDATE raporty SET status = 1, status2 = 3 WHERE id = ".$jakas['id']);
		$cos = row("SELECT * FROM users WHERE id = '".$jakas['uid']."'");
		$rapn = $cos['nieraporty'] + 1;
		$elo2 = call("UPDATE users SET nieraporty = '".$rapn."' WHERE id = ".$cos['id']);
	} else {
		throwInfo('info', 'Poprawnie Wczytano Raporty', true);
	}

	if (!isset($_GET['edit']) && !isset($_GET['view'])) {
		$strona1 = true;
		$strona2 = false;
		$strona3 = false;
	} elseif (isset($_GET['edit']) && !isset($_GET['view'])) {
		$id = vtxt($_GET['edit']);
		$xd = row("SELECT * FROM raporty WHERE id = ".$id);
		$strona1 = false;
		$strona2 = true;
		$strona3 = false;
	} elseif (!isset($_GET['edit']) && isset($_GET['view'])) {
		$id = vtxt($_GET['view']);
		$xd1 = row("SELECT * FROM raporty WHERE id = ".$id);
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
				<?php if($strona1):?>
					<div class="col-lg-12">
						<div class="card shadow mb-4">
							<div class="card-header py-3">
								<h3 class="m-0 font-weight-bold text-primary">Raporty oczekujące na ocenę</h3>
							</div>
							<!-- /.card-header -->
							<div class="card-body table-responsive">
								<table class="dataTable table table-bordered text-center">
									<?php
										$targets = call("SELECT * FROM raporty WHERE status = 1 AND status2 = 0");
										if ($targets->num_rows == 0) {?>
												<div class="card-body">
													<?php throwInfo('info', 'Brak Danych!', false);?>
												</div>
											<?php } else {
									?>
									<thead >
										<tr >
											<th>Użytkownik</th>
											<th>Data</th>
											<th>Służba</th>
											<th>Pojazd</th>
											<th>Status</th>
											<th>Opcje</th>
										</tr>
									</thead>
									<tbody >
										<?php
											$i = 1;
											while ($row = mysqli_fetch_array($targets)):
											$poj = row("SELECT * FROM tabor WHERE id =".$row['pojazd']);
											$us = row("SELECT * FROM users WHERE id =".$row['uid']);
											$role = row("SELECT * FROM rangi WHERE id = ".$us['stanowisko']);
											$dataczegos = date('d.m.Y',$row['data']);
											?>
											<tr>
												<td><a href="index.php?a=profile&p=<?=$us['id'];?>" style="color: <?=$role['kolor'];?>"><?=$us['login'], ' [', $role['kod_roli'], $us['nr_sluzbowy'],']';?></a></td>
												<td><?=$dataczegos;?></td>
												<td><?=$row['linia'], '/', $row['brygada'], '/', $row['zmiana'];?></td>
												<td>#<?=$poj['taborowy'];?></td>
												<?php
													if($row['status2'] == 0){
														echo '<td><b style="color: #cccc00">Oczekuje na sprawdzenie</b></td><td class="project-actions "><a href="index.php?a=raporty-zarządzanie&edit='.$row['id'].'"><button type="button" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Wybierz</button></a></td>';
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
								<h3 class="m-0 font-weight-bold text-primary">Raporty ocenione</h3>
							</div>
							<!-- /.card-header -->
							<div class="card-body table-responsive">
								<table class="dataTable table table-bordered text-center">
									<?php
										$targets = call("SELECT * FROM raporty WHERE status = 1 AND status2 != 0 ORDER BY data DESC");
										if ($targets->num_rows == 0) {?>
												<div class="card-body">
													<?php throwInfo('info', 'Brak Danych!', false);?>
												</div>
											<?php } else {
									?>
									<thead >
										<tr >
											<th>Numer Raportu</th>
											<th>Użytkownik</th>
											<th>Data</th>
											<th>Służba</th>
											<th>Pojazd</th>
											<th>Status</th>
											<th>Opcje</th>
										</tr>
									</thead>
									<tbody >
										<?php
											$i = 1;
											while ($row = mysqli_fetch_array($targets)):
											$poj = row("SELECT * FROM tabor WHERE id =".$row['pojazd']);
											$us = row("SELECT * FROM users WHERE id =".$row['uid']);
											$role = row("SELECT * FROM rangi WHERE id = ".$us['stanowisko']);
											$dataczegos = date('d.m.Y',$row['data']);
											?>
											<tr>
												<td>#<?=$row['id'];?></td>
												<td><a href="index.php?a=profile&p=<?=$us['id'];?>" style="color: <?=$role['kolor'];?>"><?=$us['login'], ' [', $role['kod_roli'], $us['nr_sluzbowy'],']';?></a></td>
												<td><?=$dataczegos;?></td>
												<td><?=$row['linia'], '/', $row['brygada'], '/', $row['zmiana'];?></td>
												<td>#<?=$poj['taborowy'];?></td>
												<?php
													if($row['status2'] == 0){
														echo '<td><b style="color: #cccc00">Oczekuje na sprawdzenie</b></td><td class="project-actions "><a href="index.php?a=raporty-zarządzanie&edit='.$row['id'].'"><button type="button" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Wybierz</button></a></td>';
													} elseif($row['status2'] == 1){
														echo '<td><b style="color: #009900">Zaliczony</b></td><td class="project-actions ">
													<a href="index.php?a=raporty-zarządzanie&view='.$row['id'].'"><button type="button" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Wybierz</button></a></td>';
													} elseif($row['status2'] == 2){
														echo '<td><b style="color: #ff0000">Nie Zaliczony</b></td><td class="project-actions ">
													<a href="index.php?a=raporty-zarządzanie&view='.$row['id'].'"><button type="button" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Wybierz</button></a></td>';
													} elseif($row['status2'] == 3){
														echo '<td><b style="color: #ff0000">Nie Złożony</b></td><td class="project-actions ">
													<button type="button" class="btn btn-danger btn-sm">Brak Podglądu</button></td>';
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
					<div class="col-lg-lg-12">
						<div class="card shadow mb-4">
							<div class="card-header">
								<h3 class="m-0 font-weight-bold text-primary">Sprawdź Raport</h3>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-lg-6">
										<div class="row">
											<div class="col-lg-6">
												<div class="form-group">
													<?php $dzis = date('d.m.Y',$xd['data']);?>
													<label>Data Kursu</label>
													<input value="<?=$dzis;?>" class="form-control" readonly>
												</div>
												<div class="form-group">
													<label>Służba</label>
													<input value="<?=$xd['linia'], '/', $xd['brygada'], '/', $xd['zmiana'];?>"class="form-control" readonly>
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
													<?php $us = row("SELECT * FROM users WHERE id =".$xd['uid']);?>
													<label>Kierowca</label>
													<input value="<?=$us['login'];?>" class="form-control" readonly>
												</div>
												<div class="form-group">
													<?php $poj = row("SELECT * FROM tabor WHERE id =".$xd['pojazd']);?>
													<label>Pojazd</label>
													<input value="<?=$poj['marka'], ' ', $poj['model'], ' #', $poj['taborowy'];?>" class="form-control" readonly>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="form-group">
													<label>Typ Kursu</label>
													<input type="text" value="<?php
														switch($xd['typ_kursu']){
															case '1': echo 'Kurs Grafikowy'; break; // Strona główna
															case '2': echo 'Kurs z Wolnego'; break; // Strona główna
															case '6': echo 'Rezerwa'; break; // Strona główna
														}
													?>" class="form-control" readonly>
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
													<label>Stan Licznika z Pierwszego Przystanku</label>
													<input value="<?=$xd['stanpierwszy'];?>" class="form-control" readonly>
												</div>
												<div class="form-group">
													<label for="uwagi">Statystyka Przejazdu</label><br>
													<a href="./dist/dokumenty/<?=$xd['statystyka'];?>" target="_blank">Klik</a>
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
													<label>Stan Licznika z Ostatniego Przystanku</label>
													<input value="<?=$xd['stanostatni'];?>" class="form-control" readonly>
												</div>
												<div class="form-group">
													<label for="uwagi">Uwagi</label>
													<?php if(empty($xd['uwagi'])){
														echo '<p>Brak</p>';
													} else {
														echo '<p>'.$xd['uwagi'].'</p>';
													}
													?>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-6">
										<form action="./skrypty/add/raport.php" method="POST">
											<div class="row">
												<div class="col-lg-6">
													<input type="hidden" name="id" value="<?=$xd['id'];?>">
													<input type="hidden" name="uid" value="<?=$xd['uid'];?>">
													<div class="form-group">
														<label for="pierwszy">Pierwszy przystanek</label><br>
														<a href="<?=$xd['link1'];?>" target="_blank"><img src="<?=$xd['link1'];?>" width="200" height="129"></img></a>
													</div>
													<div class="form-group">
														<label for="decyzja">Decyzja</label>
														<select id="decyzja" name="decyzja" class="form-control">
															<option selected="" disabled="">--- Wybierz ---</option>
															<option value="1" style="color: #009900">Zaliczony</option>
															<option value="2" style="color: #ff0000">Niezaliczony</option>
														</select>
													</div>
													<div class="form-group">
														<label for="uwagis">Uwagi Sprawdzającego</label>
														<textarea class="form-control" name="uwagis" id="uwagis" rows="3" placeholder="Uwagi Sprawdzającego"></textarea>
													</div>
												</div>
												<div class="col-lg-6">
													<div class="form-group">
														<label for="pierwszy">Ostatni przystanek</label><br>
														<a href="<?=$xd['link2'];?>" target="_blank"><img src="<?=$xd['link2'];?>" width="200" height="129"></img></a>
													</div>
													<div class="form-group">
														<label for="kilometry">Ilość Przejechanych Kilometrów</label><br>
														<?php $dzialanie = $xd['stanostatni'] - $xd['stanpierwszy'];?>
														<input id="kilometry" type="text" value="<?=$dzialanie;?>" name="kilometry" class="form-control" readonly>
													</div>
													<div class="form-group">
														<label for="punkty">Ilość Punktów</label>
														<input id="punkty" type="text" name="punkty" class="form-control" placeholder="Ilość Punktów">
													</div>
													<button type="submit" name="button_edit" class="btn btn-primary">Zatwierdź</button>
												</div>
											</div>
										</form>
									</div>

								</div>
							</div>
						  <!-- /.card-body -->
						</div>
					</div>
				<?php elseif($strona3):?>
					<div class="col-lg-12">
						<div class="card shadow mb-4">
							<div class="card-header">
								<h3 class="m-0 font-weight-bold text-primary">Zobacz Raport</h3>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-lg-6">
										<div class="row">
											<div class="col-lg-6">
												<div class="form-group">
													<?php $dzis = date('d.m.Y',$xd1['data']);?>
													<label>Data Kursu</label>
													<input value="<?=$dzis;?>" class="form-control" readonly>
												</div>
												<div class="form-group">
													<label>Służba</label>
													<input value="<?=$xd1['linia'], '/', $xd1['brygada'], '/', $xd1['zmiana'];?>"class="form-control" readonly>
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
													<?php $us = row("SELECT * FROM users WHERE id =".$xd1['uid']);?>
													<label>Kierowca</label>
													<input value="<?=$us['login'];?>" class="form-control" readonly>
												</div>
												<div class="form-group">
													<?php $poj = row("SELECT * FROM tabor WHERE id =".$xd1['pojazd']);?>
													<label>Pojazd</label>
													<input value="<?=$poj['marka'], ' ', $poj['model'], ' #', $poj['taborowy'];?>" class="form-control" readonly>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="form-group">
													<label>Typ Kursu</label>
													<input type="text" value="<?php
														switch($xd1['typ_kursu']){
															case '1': echo 'Kurs Grafikowy'; break; // Strona główna
															case '2': echo 'Kurs z Wolnego'; break; // Strona główna
															case '6': echo 'Rezerwa'; break; // Strona główna
														}
													?>" class="form-control" readonly>
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
													<label>Stan Licznika z Pierwszego Przystanku</label>
													<input value="<?=$xd1['stanpierwszy'];?>" class="form-control" readonly>
												</div>
												<div class="form-group">
													<label for="uwagi">Statystyka Przejazdu</label><br>
													<a href="./dist/dokumenty/<?=$xd1['statystyka'];?>" target="_blank">Klik</a>
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
													<label>Stan Licznika z Ostatniego Przystanku</label>
													<input value="<?=$xd1['stanostatni'];?>" class="form-control" readonly>
												</div>
												<div class="form-group">
													<label for="uwagi">Uwagi</label>
													<?php if(empty($xd1['uwagi'])){
														echo '<p>Brak</p>';
													} else {
														echo '<p>'.$xd1['uwagi'].'</p>';
													}
													?>

												</div>
											</div>
										</div>

									</div>

									<div class="col-lg-6">
										<div class="row">
											<div class="col-lg-6">
												<div class="form-group">
													<label for="pierwszy">Pierwszy przystanek</label><br>
													<a href="<?=$xd1['link1'];?>" target="_blank"><img src="<?=$xd1['link1'];?>" width="200" height="129"></img></a>
												</div>
												<?php
													if($xd1['status2'] == 0){
														echo '<div class="form-group"><label for="uwagi">Status Wniosku</label><br>';
														if($xd1['status2'] == 0){
															echo '<b style="color: #cccc00">Oczekuje na sprawdzenie</b>';
														} elseif($xd1['status2'] == 1){
															echo '<b style="color: #009900">Zaliczony</b>';
														} elseif($xd1['status2'] == 2){
															echo '<b style="color: #ff0000">Nie Zaliczony</b>';
														} elseif($xd1['status2'] == 3){
															echo '<b style="color: #ff0000">Nie Złożony</b>';
														}echo '</div>';
													}else{
														echo '<div class="form-group"><label for="pierwszy">Ilość Punktów</label><br><p>'.$xd1['punkty'].'</p></div>';
														echo '<div class="form-group"><label for="uwagi">Status Wniosku</label><br>';
														if($xd1['status2'] == 0){
															echo '<b style="color: #cccc00">Oczekuje na sprawdzenie</b>';
														} elseif($xd1['status2'] == 1){
															echo '<b style="color: #009900">Zaliczony</b>';
														} elseif($xd1['status2'] == 2){
															echo '<b style="color: #ff0000">Nie Zaliczony</b>';
														} elseif($xd1['status2'] == 3){
															echo '<b style="color: #ff0000">Nie Złożony</b>';
														}echo '</div>';
													}
												?>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
													<label for="pierwszy">Ostatni przystanek</label><br>
													<a href="<?=$xd1['link2'];?>" target="_blank"><img src="<?=$xd1['link2'];?>" width="200" height="129"></img></a>
												</div>
												<div class="form-group">
													<label for="pierwszy">Ilość Przejechanych Kilometrów</label><br>
													<p><?php $dzialanie = $xd1['stanostatni'] - $xd1['stanpierwszy']; echo $dzialanie, 'km';?></p>
												</div>
												<?php
													if($xd1['status2'] == 0){
														echo '';
													}else{
														echo '<div class="form-group"><label>Uwagi Sprawdzającego</label>';
														if(empty($xd1['uwagi2'])){
															echo '<p>Brak</p>';
														} else {
															echo '<p>'.$xd1['uwagi2'].'</p>';
														}
														echo '</div>';
													}
												?>

											</div>
										</div>
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
