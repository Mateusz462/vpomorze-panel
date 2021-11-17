<?php
	function modal_nie_pojazdy($id){
		$nie_pojazdy = call("SELECT * FROM niepzrzdzielactabor WHERE uid = '".$id."'");

		$us = row("SELECT * FROM users WHERE id = ".$id);
		$role_us = row("SELECT * FROM rangi WHERE id = ".$us['stanowisko']);

		$login_usera = '<a href="index.php?a=profile&p='.$us['id'].'" style="color: '.$role_us['kolor'].'">'.$us['login'].' ['.$role_us['kod_roli'].''.$us['nr_sluzbowy'].']'.'</a>';

		if($nie_pojazdy){
			$modal = '
			<div id="modal-nie-pojazd-'.$us['id'].'" class="modal fade" role="dialog">
				<div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<h2 class="modal-title">Pojazdy nieprzydzielanie użytkownika '.$login_usera.'</h2>
						</div>
						<div class="modal-body">

							<table class="dataTable table table-bordered text-center ">
								<thead>
									<tr>
										<th>Użytkownik</th>
										<th>Pojazd</th>
										<th>Powód nie przydzielania</th>
										<th>Zatwierdził</th>
										<th>Akcja</th>
									</tr>
								</thead>
								<tbody >';
								while ($row = mysqli_fetch_assoc($nie_pojazdy)):
									$pojazd = call("SELECT * FROM tabor WHERE id = '".$row['tid']."'");
									$sus = row("SELECT * FROM users WHERE id = ".$row['sid']);
									$role_sus = row("SELECT * FROM rangi WHERE id = '".$sus['stanowisko']."'");
									$login_useras = '<a href="index.php?a=profile&p='.$sus['id'].'" style="color: '.$role_sus['kolor'].'">'.$sus['login'].' ['.$role_sus['kod_roli'].''.$sus['nr_sluzbowy'].']'.'</a>';
									while ($row1 = mysqli_fetch_assoc($pojazd)):
										//$dataczegos = $row['kiedy'];
										$modal .= '<tr>
											<td>'.$login_usera.'</td>
											<td>#'.$row1['taborowy'].' '.$row1['marka'].' '.$row1['model'].'</td>
											<td>'.$row['powod'].'</td>
											<td>'.$login_useras.'</td>
											<td><button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button></td>
										</tr>';
									endwhile;
								endwhile;
								$modal .= '</tbody>
							</table>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-outline-danger btn-block" data-dismiss="modal">Zamknij</button>
						</div>
					</div>
				</div>
			</div>';
			echo $modal;
			//return true;
		} else {
			return false;
		}
	}

	function modal_log($id){
		$us = row("SELECT * FROM users WHERE id = ".$id);
		$logi = call("SELECT * FROM logi WHERE uid = ".$id);
		/* $logowanie_ostatnie = call("SELECT MAX(data) FROM logi_logowania WHERE uid = ".$id." AND akcja = 'Logowanie do Panelu'");
		$row = mysqli_fetch_array($logowanie_ostatnie);
			$logowanie_ostatnie1 = date("d.m.Y H:i:s", $row[0]);
			//print_r($row[0]); */

		$role_us = row("SELECT * FROM rangi WHERE id = ".$us['stanowisko']);
		$login_usera = '<a href="index.php?a=profile&p='.$us['id'].'" style="color: '.$role_us['kolor'].'">'.$us['login'].' ['.$role_us['kod_roli'].''.$us['nr_sluzbowy'].']'.'</a>';
		if($logi){
			$modal = '
			<div id="modal-log-'.$us['id'].'" class="modal fade" role="dialog">
				<div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<h2 class="modal-title">Logi Użytkownika '.$login_usera.'</h2>
						</div>
						<div class="modal-body">

							<table class="dataTable table table-bordered text-center ">
								<thead>
									<tr>
										<th>Numer</th>
										<th>Użytkownik</th>
										<th>Data</th>
										<th>Akcja</th>
									</tr>
								</thead>
								<tbody >';
								while ($row = mysqli_fetch_assoc($logi)):
									$dataczegos = $row['kiedy'];
									$modal .= '<tr>
										<td>#'.$row['id'].'</td>
										<td>'.$login_usera.'</td>
										<td>'.$dataczegos.'</td>
										<td>'.$row['akcja'].'</td>
									</tr>';
								endwhile;
								$modal .= '</tbody>
							</table>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-outline-danger btn-block" data-dismiss="modal">Zamknij</button>
						</div>
					</div>
				</div>
			</div>';
			echo $modal;
			//return true;
		} else {
			return false;
		}
	}

	function modal_log_logowanie($id){
		$us = row("SELECT * FROM users WHERE id = ".$id);
		$logi_logowania = call("SELECT * FROM logi_logowania WHERE uid = ".$id);
		$logowanie_ostatnie = call("SELECT MAX(data) FROM logi_logowania WHERE uid = ".$id." AND akcja = 'Logowanie do Panelu'");
		$row = mysqli_fetch_array($logowanie_ostatnie);
			$logowanie_ostatnie1 = date("d.m.Y H:i:s", $row[0]);
			//print_r($row[0]);

		$role_us = row("SELECT * FROM rangi WHERE id = ".$us['stanowisko']);
		$login_usera = '<a href="index.php?a=profile&p='.$us['id'].'" style="color: '.$role_us['kolor'].'">'.$us['login'].' ['.$role_us['kod_roli'].''.$us['nr_sluzbowy'].']'.'</a>';
		if($logi_logowania){
			$modal = '
			<div id="modal-log-logowanie-'.$us['id'].'" class="modal fade" role="dialog">
				<div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<h2 class="modal-title">Logi Logowania Użytkownika '.$login_usera.'</h2>
						</div>
						<div class="modal-body">
							<h4><b>Data ostatniego logowania: '.$logowanie_ostatnie1.'</b></h4>
							<table class="dataTable table table-bordered text-center ">
								<thead>
									<tr>
										<th>Numer</th>
										<th>Użytkownik</th>
										<th>Data</th>
										<th>IP</th>
										<th>System Operacyjny</th>
										<th>Przeglądarka</th>
										<th>Urządzenie</th>
										<th>Akcja</th>
									</tr>
								</thead>
								<tbody >';
								while ($row = mysqli_fetch_assoc($logi_logowania)):
									$dataczegos = date("d.m.Y H:i:s", $row['data']);
									$modal .= '<tr>
										<td>#'.$row['id'].'</td>
										<td>'.$login_usera.'</td>
										<td>'.$dataczegos.'</td>
										<td>'.$row['get_ip'].'</td>
										<td>'.$row['get_os'].'</td>
										<td>'.$row['get_browser'].'</td>
										<td>'.$row['get_device'].'</td>
										<td>'.$row['akcja'].'</td>
									</tr>';
								endwhile;
								$modal .= '</tbody>
							</table>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-outline-danger btn-block" data-dismiss="modal">Zamknij</button>
						</div>
					</div>
				</div>
			</div>';
			echo $modal;
			//return true;
		} else {
			return false;
		}
	}

	function modal_awans($id){
		$us = row("SELECT * FROM users WHERE id = ".$id);
		$role_us = row("SELECT * FROM rangi WHERE id = ".$us['stanowisko']);
		$login_usera = '<a href="index.php?a=profile&p='.$us['id'].'" style="color: '.$role_us['kolor'].'">'.$us['login'].' ['.$role_us['kod_roli'].''.$us['nr_sluzbowy'].']'.'</a>';
		if($us['stanowisko'] == 21 || $us['stanowisko'] == 22){
		} else {
			$modal = '
			<div id="modal-awans-'.$us['id'].'" class="modal fade" role="dialog">
				<div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<h2 class="modal-title">Edytuj Stanowisko Użytkownika '.$login_usera.'</h2>
						</div>
						<form action="index.php?a=użytkownicy&awans='.$us['id'].'" method="POST">
							<div class="modal-body">
								<div class="form-group">
									<label>Użytkownik</label>
									<label class="form-control">'.$login_usera.'</label>
								</div>
								<div class="form-group">
									<label>Numer Służbowy</label>
									<input class="form-control" placeholder="Numer Służbowy" name="nr_sluzbowy" value="'.$us['nr_sluzbowy'].'">
								</div>
								<div class="form-group">
									<label>Stanowisko</label>
									<select class="form-control" name="stanowisko">';
										$stanowiska = call("SELECT * FROM rangi ORDER BY kolejnosc");
										while ($row = mysqli_fetch_array($stanowiska)):
										if($us['stanowisko'] == $row['id']){
											$modal .= '<option value="'.$row['id'].'" style="color: '.$row['kolor'].'" selected>'.$row['nazwa'].'</option>';
										} else {
											$modal .= '<option value="'.$row['id'].'" style="color: '.$row['kolor'].'">'.$row['nazwa'].'</option>';
										}
										endwhile;
									$modal .= '</select>
								</div>
								<div class="form-group">
									<label>Dodatkowe Informacje</label>
									<div class="form-check">
										<input class="form-check-input" type="checkbox" name="zarzad" value="1">
										<label class="form-check-label">Zarząd</label>
									</div>
								</div>
							</div>
							<div class="modal-footer justify-content-between">
								<button type="submit" class="btn btn-outline-danger" data-dismiss="modal">Zamknij</button>
								<button type="submit" class="btn btn-outline-primary">Zatwierdź</button>
							</div>
						</form>
					</div>
				</div>
			</div>';
			echo $modal;
			//return true;

		}
	}

	function modal_edytuj($id){
		$us = row("SELECT * FROM users WHERE id = ".$id);
		$role_us = row("SELECT * FROM rangi WHERE id = ".$us['stanowisko']);
		$login_usera = '<a href="index.php?a=profile&p='.$us['id'].'" style="color: '.$role_us['kolor'].'">'.$us['login'].' ['.$role_us['kod_roli'].''.$us['nr_sluzbowy'].']'.'</a>';
		$modal = '
		<div id="modal-edytuj-'.$us['id'].'" class="modal fade" role="dialog">
			<div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<h2 class="modal-title">Edytuj Dane Użytkownika '.$login_usera.'</h2>
					</div>
					<form action="index.php?a=użytkownicy&edytuj='.$us['id'].'" method="POST">
						<div class="modal-body">
							<div class="form-group">
								<label>Użytkownik</label>
								<label class="form-control">'.$login_usera.'</label>
							</div>
							<div class="form-group">
								<label>Numer Służbowy</label>
								<input class="form-control" placeholder="Numer Służbowy" name="nr_sluzbowy" value="'.$us['nr_sluzbowy'].'">
							</div>
							<div class="form-group">
								<label>Stanowisko</label>
								<select class="form-control" name="stanowisko">';
									$stanowiska = call("SELECT * FROM rangi ORDER BY kolejnosc");
									while ($row = mysqli_fetch_array($stanowiska)):
									if($us['stanowisko'] == $row['id']){
										$modal .= '<option value="'.$row['id'].'" style="color: '.$row['kolor'].'" selected>'.$row['nazwa'].'</option>';
									} else {
										$modal .= '<option value="'.$row['id'].'" style="color: '.$row['kolor'].'">'.$row['nazwa'].'</option>';
									}
									endwhile;
								$modal .= '</select>
							</div>
							<div class="form-group">
								<label>Dodatkowe Informacje</label>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" name="zarzad" value="1">
									<label class="form-check-label">Zarząd</label>
								</div>
							</div>
						</div>
						<div class="modal-footer justify-content-between">
							<button type="submit" class="btn btn-outline-danger" data-dismiss="modal">Zamknij</button>
							<button type="submit" class="btn btn-outline-primary">Zatwierdź</button>
						</div>
					</form>
				</div>
			</div>
		</div>';
		echo $modal;
	}

	function modal_zwolnij($id){
		$data = date('d.m.Y');
		$us = row("SELECT * FROM users WHERE id = ".$id);
		$role_us = row("SELECT * FROM rangi WHERE id = ".$us['stanowisko']);
		$login_usera = '<a href="index.php?a=profile&p='.$us['id'].'" style="color: '.$role_us['kolor'].'">'.$us['login'].' ['.$role_us['kod_roli'].''.$us['nr_sluzbowy'].']'.'</a>';
		$modal = '
		<div id="modal-zwolnij-'.$us['id'].'" class="modal fade" role="dialog">
			<div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<h2 class="modal-title">Zwolnij Użytkownika '.$login_usera.'</h2>
					</div>
					<form action="index.php?a=użytkownicy&zwolnij='.$us['id'].'" method="POST">
						<div class="modal-body">
							<div class="form-group">
								<label>Użytkownik</label>
								<label class="form-control">'.$login_usera.'</label>
							</div>
							<div class="form-group">
								<label>Data Zwolnienia</label>
								<input class="form-control" placeholder="Data zwolnienia" name="data" value="'.$data.'" readonly>
							</div>
							<div class="form-group">
								<label>Powód zwolnienia</label>
								<textarea class="form-control" placeholder="Powód zwolnienia" name="powod"></textarea>
							</div>
							<div class="form-group">
								<label>Dodatkowe Informacje</label>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" disabled>
									<label class="form-check-label">Nieaktywne</label>
								</div>
							</div>
						</div>
						<div class="modal-footer justify-content-between">
							<button type="submit" class="btn btn-outline-danger" data-dismiss="modal">Zamknij</button>
							<button type="submit" class="btn btn-outline-primary">Zatwierdź</button>
						</div>
					</form>
				</div>
			</div>
		</div>';
		echo $modal;
	}
?>
