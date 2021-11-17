<?php

	function pracownicy_index($data){
		if($data == '0'){
			$targets = call("SELECT * FROM users WHERE zarząd = '1' ORDER BY nr_sluzbowy");
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
					<tr style="text-align: center">
						<th>#</th>
						<th >Nazwa użytkownika</th>
						<th >Zatrudnienie</th>
						<th >Etat</th>
						<th >Stały Przydział</th>
						<th >Punkty</th>
						<th >Kilometry</th>
					</tr>
				</thead>
				<tbody style="text-align: center">';
					$i = 1;
					while ($row = mysqli_fetch_array($targets)):
						$role = row("SELECT * FROM rangi WHERE id = ".$row['stanowisko']);
						$result .=	'<tr>
							<td>'.$i++.'</td>
							<td><a href="index.php?a=profile&p='.$row['id'].'" style="color: '.$role['kolor'].'">'.$row['login']. ' ['. $role['kod_roli'].''. $row['nr_sluzbowy'].']'.'</a></td>
							<td>'.$row['zatrudnienie'].'</td>
							<td>';
								$etat = row("SELECT * FROM etaty WHERE uid = ".$row['id']);
								$cos = $etat['poniedzialek'] + $etat['wtorek'] + $etat['sroda'] + $etat['czwartek'] + $etat['piatek'] + $etat['sobota'] + $etat['niedziela'];
								$result .= $cos .'/7';
							$result .=' </td>';
								$poj = row("SELECT * FROM tabor WHERE własciciel =".$row['id']);
								$poj2 = row("SELECT * FROM tabor WHERE własciciel2 =".$row['id']);
								if ($poj){
									$result .='<td><a href="index.php?a=profile&g='.$poj['id'].'">'.$poj['taborowy'].'</a></td>';
								}elseif($poj2){
									$result .='<td><a href="index.php?a=profile&g='.$poj2['id'].'">'.$poj2['taborowy'].'</a></td>';
								}else{
									$result .='<td><b>-</b></td>';
								}
							$result .='<td><span class="badge bg-danger" style="color: #ffffff">'.$row['punkty'].'pkt</span></td>
							<td><span class="badge bg-success" style="color: #ffffff">'.$row['kilometry'].'km'.'</span></td>
						</tr>';
					endwhile;
				$result .='</tbody>';
			}
			echo $result;
		} elseif($data == '1'){
			$targets = call("SELECT * FROM users WHERE zarząd = '0' AND deleted != '1' AND stanowisko != 21 AND stanowisko != 22 ORDER BY nr_sluzbowy");
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
					<tr style="text-align: center">
						<th>#</th>
						<th >Nazwa użytkownika</th>
						<th >Zatrudnienie</th>
						<th >Etat</th>
						<th >Stały Przydział</th>
						<th >Punkty</th>
						<th >Kilometry</th>
					</tr>
				</thead>
				<tbody style="text-align: center">';
					$i = 1;
					while ($row = mysqli_fetch_array($targets)):
					$role = row("SELECT * FROM rangi WHERE id = ".$row['stanowisko']);
					$result .=	'<tr>
						<td>'.$i++.'</td>
						<td><a href="index.php?a=profile&p='.$row['id'].'" style="color: '.$role['kolor'].'">'.$row['login']. ' ['. $role['kod_roli'].''. $row['nr_sluzbowy'].']'.'</a></td>
						<td>'.$row['zatrudnienie'].'</td>
						<td>';
							$etat = row("SELECT * FROM etaty WHERE uid = ".$row['id']);
							if($etat){
								$cos = $etat['poniedzialek'] + $etat['wtorek'] + $etat['sroda'] + $etat['czwartek'] + $etat['piatek'] + $etat['sobota'] + $etat['niedziela'];
							}
							$result .= $cos .'/7';
						$result .=' </td>';
							$poj = row("SELECT * FROM tabor WHERE własciciel =".$row['id']);
							$poj2 = row("SELECT * FROM tabor WHERE własciciel2 =".$row['id']);
							if ($poj){
								$result .='<td><a href="index.php?a=profile&g='.$poj['id'].'">'.$poj['taborowy'].'</a></td>';
							}elseif($poj2){
								$result .='<td><a href="index.php?a=profile&g='.$poj2['id'].'">'.$poj2['taborowy'].'</a></td>';
							}else{
								$result .='<td><b>-</b></td>';
							}
						$result .='<td><span class="badge bg-danger" style="color: #ffffff">'.$row['punkty'].'pkt</span></td>
						<td><span class="badge bg-success" style="color: #ffffff">'.$row['kilometry'].'km'.'</span></td>
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
