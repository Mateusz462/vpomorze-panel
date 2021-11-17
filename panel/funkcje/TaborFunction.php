<?php

	function tabor_index($data){
		if($data == '0'){
			$targets = call("SELECT * FROM tabor WHERE tram != 1 AND stan = 1 ORDER BY taborowy ASC");
			if ($targets->num_rows == 0) {
				$result =
				'<div class="card-body">
						<div class="alert alert-warning">
							<h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
							Brak Pojazdów!
						</div>
					</div>';
			} else {
				$result =
				'<thead style="text-align: center">
					<tr>
						<th>Nr taborowy</th>
						<th>Marka</th>
						<th>Model</th>
						<th>Nr rejestracyjny</th>
						<th>Zajezdnia</th>
						<th>Uwagi</th>
					</tr>
				</thead>
				<tbody style="text-align: center">';

						$i = 1;
						while ($row = mysqli_fetch_array($targets)):
					$result .=	'<tr>
							<td><a href="index.php?a=profile&g='.$row['id'].'">'.$row['taborowy'].'</a></td>
							<td>'.$row['marka'].'</td>
							<td>'.$row['model'].'</td>
							<td>'.$row['nr_rejestracyjny'].'</td>
							<td>'.$row['zajezdnia'].'</td>
							<td>'.$row['uwagi'].'</td>
						</tr>';
					endwhile;
				$result .='</tbody>';
			}
			echo $result;
		} elseif($data == '1'){
			$targets = call("SELECT * FROM tabor WHERE tram = 1 AND stan = 1 ORDER BY id");
			if ($targets->num_rows == 0) {
				$result =
				'<div class="card-body">
						<div class="alert alert-warning">
							<h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
							Brak Pojazdów!
						</div>
					</div>';
			} else {
				$result =
				'<thead style="text-align: center">
					<tr>
						<th>Nr taborowy</th>
						<th>Marka</th>
						<th>Model</th>
						<th>Zajezdnia</th>
						<th>Uwagi</th>
					</tr>
				</thead>
				<tbody style="text-align: center">';

						$i = 1;
						while ($row = mysqli_fetch_array($targets)):
					$result .=	'<tr>
							<td><a href="index.php?a=profile&g='.$row['id'].'">'.$row['taborowy'].'</a></td>
							<td>'.$row['marka'].'</td>
							<td>'.$row['model'].'</td>
							<td>'.$row['zajezdnia'].'</td>
							<td>'.$row['uwagi'].'</td>
						</tr>';
					endwhile;
				$result .='</tbody>';
			}
			echo $result;
		} elseif($data == '2'){
			$targets = call("SELECT * FROM tabor WHERE stan = 0 ORDER BY taborowy ASC");
			if ($targets->num_rows == 0) {
				$result =
				'<div class="card-body">
						<div class="alert alert-warning">
							<h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
							Brak Pojazdów!
						</div>
					</div>';
			} else {
				$result =
				'<thead style="text-align: center">
					<tr>
						<th>Nr taborowy</th>
						<th>Marka</th>
						<th>Model</th>
						<th>Nr rejestracyjny</th>
						<th>Zajezdnia</th>
						<th>Uwagi</th>
					</tr>
				</thead>
				<tbody style="text-align: center">';

						$i = 1;
						while ($row = mysqli_fetch_array($targets)):
					$result .=	'<tr>
							<td><a href="index.php?a=profile&g='.$row['id'].'">'.$row['taborowy'].'</a></td>
							<td>'.$row['marka'].'</td>
							<td>'.$row['model'].'</td>
							<td>'.$row['nr_rejestracyjny'].'</td>
							<td>'.$row['zajezdnia'].'</td>
							<td>'.$row['uwagi'].'</td>
						</tr>';
					endwhile;
				$result .='</tbody>';
			}
			echo $result;
		} elseif($data == '4'){
			$targets = call("SELECT * FROM tabor ORDER BY taborowy ASC");
			if ($targets->num_rows == 0) {
				$result =
				'<div class="card-body">
						<div class="alert alert-warning">
							<h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
							Brak Pojazdów!
						</div>
					</div>';
			} else {
				$result =
				'<thead style="text-align: center">
					<tr>
						<th>Nr taborowy</th>
						<th>Marka</th>
						<th>Model</th>
						<th>Nr rejestracyjny</th>
						<th>Dopuszczony do ruchu</th>
						<th>Uwagi</th>
						<th>Opcje</th>
					</tr>
				</thead>
				<tbody style="text-align: center">';

						$i = 1;
						while ($row = mysqli_fetch_array($targets)):
					$result .=	'<tr>
							<td><a href="index.php?a=profile&g='.$row['id'].'">'.$row['taborowy'].'</a></td>
							<td>'.$row['marka'].'</td>
							<td>'.$row['model'].'</td>
							<td>'.$row['nr_rejestracyjny'].'</td>
							<td>';
								if($row['stan'] == '1') {
									$result .= '<i style="color: green;" class="fa fa-check"></i>';
								}else{
									$result .= '<i style="color: red;" class="fa fa-times"></i>';
								};
							$result .= '</td>
							<td>'.$row['uwagi'].'</td>
							<td class="project-actions ">

								<a class="btn btn-info btn-icon-split" href="index.php?a=flota&edit&id='.$row['id'].'">
									<span class="icon text-white-50">
										<i class="fas fa-pencil-alt"></i>
									</span>

								</a>&nbsp;
								<a data-d_id="'.$row['id'].'" class="btn btn-danger btn-icon-split del_btn">
									<span class="icon text-white-50">
										<i class="fas fa-trash"></i>
									</span>

								</a>
							</td>
						</tr>';
					endwhile;
				$result .='</tbody>';
			}
			echo $result;
		} else {
			$result =
			'<div class="card-body">
				<div class="alert alert-danger">
					<h5><i class="icon fas fa-ban"></i> Error!</h5>
					Brak Danych!
				</div>
			</div>';
			echo $result;
		}
	}

	function tabor_create(){
		if (!empty($_POST)) {
			if (empty($_POST['marka']) || empty($_POST['taborowy']) || empty($_POST['produkcja']) || empty($_POST['klasa']) || empty($_POST['zajezdnia']) || empty($_POST['model']) || empty($_POST['rejestracja']) || empty($_POST['przegląd']) || empty($_POST['podłoga']) || empty($_POST['własciciel']) || empty($_POST['link']) || empty($_POST['uwagi'])) {
				$_SESSION['danger'] = 'Wypełnij wszystkie pola!';
					header('Location: ../../index.php?a=flota&action=add');
			} else {
				$marka = vtxt($_POST['marka']);
				$taborowy = vtxt($_POST['taborowy']);
				$produkcja = vtxt($_POST['produkcja']);
				$klasa = vtxt($_POST['klasa']);
				$zajezdnia = vtxt($_POST['zajezdnia']);
				$link = vtxt($_POST['link']);

				$model = vtxt($_POST['model']);
				$rejestracja = vtxt($_POST['rejestracja']);
				$przegląd = vtxt($_POST['przegląd']);
				$podłoga = vtxt($_POST['podłoga']);
				$własciciel = vtxt($_POST['własciciel']);
				$uwagi = vtxt($_POST['uwagi']);
				$stan = '1';

				$istnieje = row("SELECT id FROM tabor WHERE taborowy = '".$taborowy."' OR nr_rejestracyjny = '".$rejestracja."'");
				if ($istnieje) {
					$_SESSION['danger'] = 'Istnieje już taki pojazd!';
					header('Location: ../../index.php?a=pojazdy&action=add');
				} else {
					$tak = call("INSERT INTO tabor ( taborowy, marka, model, produkcja, nr_rejestracyjny, klasa, zajezdnia, przegląd, link, podłoga, własciciel, uwagi, stan) VALUES ('".$taborowy."', '".$marka."', '".$model."', '".$produkcja."', '".$rejestracja."', '".$klasa."', '".$zajezdnia."', '".$przegląd."', '".$link."', '".$podłoga."', '".$własciciel."', '".$uwagi."', '".$stan."')");

					if($tak){
						$_SESSION['success'] = 'Dodano nowy pojazd!';
						header('Location: ../../index.php?a=flota');
					} else {
						$_SESSION['danger'] = 'BŁĄD JEBANY DEBILU';
						header('Location: ../../index.php?a=flota');
					}
				}
			}
		}
	}
