<?php
	function przyciski_przesuwania($dni, $start, $end, $tyl, $przod){
		for($i = $start; $i<=$end; $i++){
			$dates[$i] = mktime(0, 0, 0, date("m"), date("d")+$i, date("Y"));
			//echo $i, ' ';
			//echo $dates[0], ' ';

			$tyd[$i] = $dni[(date('w', $dates[$i]))];
			//echo $tyd[0], ' ';
			//echo $end;
			$data[$i] = date('d.m.Y',$dates[$i]);
			//echo $data[0], ' ';

			$zakres[$i] = $data[$i];//, ' ';
			if($i == $start){
				$zakres1 = $zakres[$start];
			}
			if($i == $end){
				$zakres2 = $zakres[$end];
			}
		}
		echo '<div class="text-center">';
		if($tyl){
			echo '<a class="btn btn-success btn-lg" href="index.php?a=zarzadzanie-grafik&przesuwanie='.($start-1).'"><i class="fa fa-arrow-left" style="color: white;"></i></a>';
		} else {
			echo '<button type="button" disabled class="btn btn-danger btn-lg"><i class="fas fa-times" style="color: white;"></i></button>';
		}
		echo '<button type="button" class="btn btn-light btn-lg" disabled=""><div id="nazwa"><b>'.$zakres1.' - '.$zakres2.'</b></div></button>';
		if($przod){
			echo '<a class="btn btn-success btn-lg" href="index.php?a=zarzadzanie-grafik&przesuwanie='.($start+1).'"><i class="fa fa-arrow-right" style="color: white;"></i></a>';
		} else {
			echo '<button type="button" disabled class="btn btn-danger btn-lg"><i class="fas fa-times" style="color: white;"></i></button>';
		}
		echo '</div><br>';
	}

	function daty_grafik_dyspozytornia($dni, $start, $end){
		for($i = $start; $i<=$end; $i++){
			$dates[$i] = mktime(0, 0, 0, date("m"), date("d")+$i, date("Y"));

			$tyd[$i] = $dni[(date('w', $dates[$i]))];

			$data[$i] = date('d.m.Y',$dates[$i]);

			if($data[$i] == date('d.m.Y')){
				 $class = "";
				 $zmienne = " color:rgba(60, 213, 15, 0.56); background-color:rgba(0, 255, 48, 0.35); ";
				 echo '<th id="'.$dates[$i].'" class="'.$class.'" style="'.$zmienne.'">'.$tyd[$i].'<br />'.$data[$i].'<br>DZISIAJ</th>';
			} elseif($tyd[$i] == 'NIEDZIELA'){
				$class = "";
				$zmienne = " color:rgb(106, 26, 28)";
				echo '<th id="'.$dates[$i].'" class="'.$class.'" style="'.$zmienne.'">'.$tyd[$i].'<br />'.$data[$i].'</th>';
			} else {
				$class = "";
				$zmienne = "";
				echo '<th id="'.$dates[$i].'" class="'.$class.'" style="'.$zmienne.'">'.$tyd[$i].'<br />'.$data[$i].'</th>';
			}
		}
	}

	function body_grafik_dyspozytornia($dni, $start, $end){
		$targets = call("SELECT * FROM users WHERE deleted != '1' AND stanowisko != 21 AND stanowisko != 22 ORDER BY nr_sluzbowy");
		for ($a = 0; $a < $targets->num_rows; $a++){
			$row[$a][0] = mysqli_fetch_assoc($targets);
			$role1 = row("SELECT * FROM rangi WHERE id = ".$row[$a][0]['stanowisko']);
			$etat = row("SELECT * FROM etaty WHERE uid = ".$row[$a][0]['id']);
			$login_usera = '<a href="index.php?a=profile&p='.$row[$a][0]['id'].'" style="color: '.$role1['kolor'].'">['.$role1['kod_roli'].$row[$a][0]['nr_sluzbowy'].'] '.$row[$a][0]['login'].'</a>';
			$urlop = row("SELECT * FROM urlopy WHERE uid = ".$row[$a][0]['id']);
			$zawieszenie = row("SELECT * FROM zawieszenie WHERE uid = ".$row[$a][0]['id']);

			if($etat){
				$suma_etatu = $etat['poniedzialek'] + $etat['wtorek'] + $etat['sroda'] + $etat['czwartek'] + $etat['piatek'] + $etat['sobota'] + $etat['niedziela'];
			} else {
				$etat = array(
					'poniedzialek' => 0,
					'wtorek' => 0,
					'sroda' => 0,
					'czwartek' => 0,
					'piatek' => 0,
					'sobota' => 0,
					'niedziela' => 0
				);
			}
			//print_r($etat);
			if($zawieszenie){
				$kierowca = row("SELECT * FROM users WHERE id = ".$zawieszenie['uid']);
				$role_kierowca = row("SELECT * FROM rangi WHERE id = ".$kierowca['stanowisko']);
				$login_kierowcy_zawieszony = "<a href='index.php?a=profile&p=".$kierowca['id']."'>[".$role_kierowca['kod_roli'].$kierowca['nr_sluzbowy']."] ".$kierowca['login']."</a>";

				$sprawdzajacy = row("SELECT * FROM users WHERE id = ".$zawieszenie['sid']);
				$role_sprawdzajacy = row("SELECT * FROM rangi WHERE id = ".$sprawdzajacy['stanowisko']);
				$login_sprawdzajacy_zawieszony = "<a href='index.php?a=profile&p=".$sprawdzajacy['id']."'>[".$role_sprawdzajacy['kod_roli'].$sprawdzajacy['nr_sluzbowy']."] ".$sprawdzajacy['login']."</a>";
			}

			if($urlop){
				$kierowca = row("SELECT * FROM users WHERE id = ".$urlop['uid']);
				$role_kierowca = row("SELECT * FROM rangi WHERE id = ".$kierowca['stanowisko']);
				$login_kierowcy_urlop = "<a href='index.php?a=profile&p=".$kierowca['id']."'>[".$role_kierowca['kod_roli'].$kierowca['nr_sluzbowy']."] ".$kierowca['login']."</a>";

				$sprawdzajacy = row("SELECT * FROM users WHERE id = ".$urlop['sid']);
				$role_sprawdzajacy = row("SELECT * FROM rangi WHERE id = ".$sprawdzajacy['stanowisko']);
				$login_sprawdzajacy_urlop = "<a href='index.php?a=profile&p=".$sprawdzajacy['id']."'>[".$role_sprawdzajacy['kod_roli'].$sprawdzajacy['nr_sluzbowy']."] ".$sprawdzajacy['login']."</a>";
			}

			if($row[$a][0]['tid'] > 0){
				$pojazd_stalka = row("SELECT * FROM tabor WHERE id = ".$row[$a][0]['tid']);
				if($pojazd_stalka){
					$pojazd_stalka = $pojazd_stalka['marka']. ' '. $pojazd_stalka['model']. ' #'. $pojazd_stalka['taborowy'];
				} else {
					$pojazd_stalka = 'pojazd usunięty!';
				}
			} else {
				$pojazd_stalka = 'brak przydziału!';
			}

			echo '<tr style="text-align: center">';


				//echo '<td scope="col" style="vertical-align: middle;"><a href="index.php?a=zarzadzanie-grafik&driver='.$row[$a][0]['id'].'" style="color: '.$role1['kolor'].'">['.$role1['kod_roli'].$row[$a][0]['nr_sluzbowy'].'] '.$row[$a][0]['login'].'</a><br>URLOP<br>przydzial</td>';
			//} else {
				echo '<td scope="col" style="vertical-align: middle;" data-toggle="tooltip" data-placement="right" data-original-title="Brak uprawnień">'.$login_usera.'<br>'.$suma_etatu.'/7<br>'.$pojazd_stalka.'</td>';

			for($b = $start; $b<=$end; $b++){
				//echo $row[$a][$b]['id'], ' ';
				//echo $i, ' ';
				$dzis = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
				$dates[0] = mktime(0, 0, 0, date("m"), date("d")+$b, date("Y"));
				//echo $dates[0], ' ';

				$tyd[0] = $dni[(date('w', $dates[0]))];
				//echo $tyd[0], ' ';

				$data[0] = date('d.m.Y',$dates[0]);
				//echo $data[0], ' ';
				if($dates[0] < $dzis){
					$class = "";
					$zmienne = "";
					$disabled = 'disabled';
					$tooltip = 'data-toggle="tooltip" data-original-title="Nie możesz dodać kursu w przeszłości!"';
				} elseif($data[0] == date('d.m.Y')){
					$class = "";
					$zmienne = " color:rgba(60, 213, 15, 0.56); background-color:rgba(0, 255, 48, 0.35); ";
					$disabled = '';
					$tooltip = '';
				} elseif($tyd[0] == 'NIEDZIELA'){
					$class = "";
					$zmienne = " color:rgb(106, 26, 28)";
					$disabled = '';
					$tooltip = '';
				} else {
					$class = "";
					$zmienne = '';
					$disabled = '';
					$tooltip = '';
				}

				$grafik = row("SELECT * FROM grafik WHERE uid = '".$row[$a][0]['id']."' AND data = '".$dates[0]."'");
				if($grafik){
					if($grafik['uid'] != 0){
						$kierowca = row("SELECT * FROM users WHERE id = ".$grafik['uid']);
						$role_kierowca = row("SELECT * FROM rangi WHERE id = ".$kierowca['stanowisko']);
						$login_kierowcy_grafik = "<a href='index.php?a=profile&p=".$kierowca['id']."' style='color: ".$role_kierowca['kolor']."'>[".$role_kierowca['kod_roli'].$kierowca['nr_sluzbowy']."] ".$kierowca['login']."</a>";
					}  else {
						$login_kierowcy_grafik = 'brak danych!';
					}

					if($grafik['dyspozytor_id'] != 0){
						$sprawdzajacy = row("SELECT * FROM users WHERE id = ".$grafik['dyspozytor_id']);
						$role_sprawdzajacy = row("SELECT * FROM rangi WHERE id = ".$sprawdzajacy['stanowisko']);
						$login_sprawdzajacy_grafik = "<a href='index.php?a=profile&p=".$sprawdzajacy['id']."'>[".$role_sprawdzajacy['kod_roli'].$sprawdzajacy['nr_sluzbowy']."] ".$sprawdzajacy['login']."</a>";
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
							$pojazd = $dane_pojazd['marka']. ' '. $dane_pojazd['model']. ' #'. $dane_pojazd['taborowy'];
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
				}
				//print_r($graf);

				switch($tyd[0]){
					case 'PONIEDZIAŁEK':
						if($etat['poniedzialek'] == "1"){
							if($disabled == 'disabled'):
								$table = '<td style="vertical-align: middle; '.$zmienne.'" id="'.$dates[0].'" '.$tooltip.'><h2><button class="btn" style="background-color: #236B8E; color: white;" '.$disabled.'><i class="far fa-calendar-plus"></i></button></h2></td>';
							else:
								$table = '<td style="vertical-align: middle; '.$zmienne.'" id="'.$dates[0].'" '.$tooltip.'><h2><a href="index.php?a=zarzadzanie-grafik&action=add-duty&user='.$row[$a][0]['id'].'&date='.$dates[0].'" class="btn" style="background-color: #236B8E; color: white;" '.$disabled.'><i class="far fa-calendar-plus"></i></a></h2></td>';
							endif;
						}  else {
							$table = '<td style="vertical-align: middle; '.$zmienne.'" id="'.$dates[0].'" '.$tooltip.'><h2><button type="button" class="btn" style="background-color: #99CCCC; color: white;" '.$disabled.'><i class="far fa-calendar-minus"></i></button></h2></td>';
						}
						if($urlop){
							$urlop_data = call("SELECT * FROM urlopy_grafik_daty WHERE urlop_id = ".$urlop['id']);
							for($url = 0; $url<$urlop_data->num_rows; $url++){
								$test = mysqli_fetch_assoc($urlop_data);
								if($dates[0] == $test['data']){
									$table = '<td style="vertical-align: middle; '.$zmienne.'" id="'.$dates[0].'" data-toggle="popover" data-trigger="hover focus" data-html="true" title="Urlop Pracownika"
									data-content="
									<span><b>Kierowca:</b> '.$login_kierowcy_urlop.'</span><br>
									<span><b>Powód Urlopu:</b> '.$urlop['powod'].'</span><br>
									<span><b>Zatwierdził:</b> '.$login_sprawdzajacy_urlop.'</span><br>
									<span><b>Data wprowadzenia urlopu:</b> '.$urlop['data_wystawienia'].'</span>
									"><button type="button" class="btn" style="background-color: #FF9900; color: white;" disabled><i class="far fa-calendar-alt"></i> URLOP</button></a></td>';
								}
							}
						}
						if($zawieszenie){
							$zawieszenie_data = call("SELECT * FROM zawieszenie_daty WHERE zawieszenie_id = ".$zawieszenie['id']);
							for($zaw = 0; $zaw<$zawieszenie_data->num_rows; $zaw++){
								$test = mysqli_fetch_assoc($zawieszenie_data);
								if($dates[0] == $test['data']){
									$table = '<td style="vertical-align: middle; '.$zmienne.'" id="'.$dates[0].'" data-toggle="popover" data-trigger="hover focus" data-html="true" title="Zawieszenie Pracownika"
									data-content="
									<span><b>Kierowca:</b> '.$login_kierowcy_zawieszony.'</span><br>
									<span><b>Powód Zawieszenia:</b> '.$zawieszenie['powod'].'</span><br>
									<span><b>Wprowadził:</b> '.$login_sprawdzajacy_zawieszony.'</span><br>
									<span><b>Data wprowadzenia zawieszenia:</b> '.$zawieszenie['data_wystawienia'].'</span>
									"><button type="button" class="btn btn-dark" style="" disabled><i class="fas fa-user-times"></i> ZAWIESZONY</button></a></td>';
								}
							}
						}
						if($grafik){
							$table = '<td style="vertical-align: middle; '.$zmienne.'" id="'.$dates[0].'" data-toggle="tooltip" data-html="true"
							title="
							<span><b>Kierowca:</b> '.$login_kierowcy_grafik.'</span><br>
							<span><b>Służba:</b> '.$sluzba.'</span><br>
							<span><b>Pojazd:</b> '.$pojazd.'</span><br>
							<span><b>Typ kursu:</b> '.$typ_sluzby.'</span><br>
							<span><b>Dyspozytor:</b> '.$login_sprawdzajacy_grafik.'</span><br>
							<span><b>Uwagi Dyspozytora:</b> '.$uwagi_dyspozytora.'</span><br>
							<span><b>Data dodania:</b> '.$data_dodania_kursu.'</span>
							"><button type="button" class="btn" style="background-color: #66CC66; color: white;"><i class="fas fa-calendar-check"></i> KURS</button></a></td>';
						}

					break;
					case 'WTOREK':
						if($etat['wtorek'] == "1"){
							if($disabled == 'disabled'):
								$table = '<td style="vertical-align: middle; '.$zmienne.'" id="'.$dates[0].'" '.$tooltip.'><h2><button class="btn" style="background-color: #236B8E; color: white;" '.$disabled.'><i class="far fa-calendar-plus"></i></button></h2></td>';
							else:
								$table = '<td style="vertical-align: middle; '.$zmienne.'" id="'.$dates[0].'" '.$tooltip.'><h2><a href="index.php?a=zarzadzanie-grafik&action=add-duty&user='.$row[$a][0]['id'].'&date='.$dates[0].'" class="btn" style="background-color: #236B8E; color: white;" '.$disabled.'><i class="far fa-calendar-plus"></i></a></h2></td>';
							endif;
						}  else {
							$table = '<td style="vertical-align: middle; '.$zmienne.'" id="'.$dates[0].'" '.$tooltip.'><h2><button type="button" class="btn" style="background-color: #99CCCC; color: white;" '.$disabled.'><i class="far fa-calendar-minus"></i></button></h2></td>';
						}
						if($urlop){
							$urlop_data = call("SELECT * FROM urlopy_grafik_daty WHERE urlop_id = ".$urlop['id']);
							for($url = 0; $url<$urlop_data->num_rows; $url++){
								$test = mysqli_fetch_assoc($urlop_data);
								if($dates[0] == $test['data']){
									$table = '<td style="vertical-align: middle; '.$zmienne.'" id="'.$dates[0].'" data-toggle="popover" data-trigger="hover focus" data-html="true" title="Urlop Pracownika"
									data-content="
									<span><b>Kierowca:</b> '.$login_kierowcy_urlop.'</span><br>
									<span><b>Powód Urlopu:</b> '.$urlop['powod'].'</span><br>
									<span><b>Zatwierdził:</b> '.$login_sprawdzajacy_urlop.'</span><br>
									<span><b>Data wprowadzenia urlopu:</b> '.$urlop['data_wystawienia'].'</span>
									"><button type="button" class="btn" style="background-color: #FF9900; color: white;" disabled><i class="far fa-calendar-alt"></i> URLOP</button></a></td>';
								}
							}
						}
						if($zawieszenie){
							$zawieszenie_data = call("SELECT * FROM zawieszenie_daty WHERE zawieszenie_id = ".$zawieszenie['id']);
							for($zaw = 0; $zaw<$zawieszenie_data->num_rows; $zaw++){
								$test = mysqli_fetch_assoc($zawieszenie_data);
								if($dates[0] == $test['data']){
									$table = '<td style="vertical-align: middle; '.$zmienne.'" id="'.$dates[0].'" data-toggle="popover" data-trigger="hover focus" data-html="true" title="Zawieszenie Pracownika"
									data-content="
									<span><b>Kierowca:</b> '.$login_kierowcy_zawieszony.'</span><br>
									<span><b>Powód Zawieszenia:</b> '.$zawieszenie['powod'].'</span><br>
									<span><b>Wprowadził:</b> '.$login_sprawdzajacy_zawieszony.'</span><br>
									<span><b>Data wprowadzenia zawieszenia:</b> '.$zawieszenie['data_wystawienia'].'</span>
									"><button type="button" class="btn btn-dark" style="" disabled><i class="fas fa-user-times"></i> ZAWIESZONY</button></a></td>';
								}
							}
						}
						if($grafik){
							$table = '<td style="vertical-align: middle; '.$zmienne.'" id="'.$dates[0].'" data-toggle="tooltip" data-html="true"
							title="
							<span><b>Kierowca:</b> '.$login_kierowcy_grafik.'</span><br>
							<span><b>Służba:</b> '.$sluzba.'</span><br>
							<span><b>Pojazd:</b> '.$pojazd.'</span><br>
							<span><b>Typ kursu:</b> '.$typ_sluzby.'</span><br>
							<span><b>Dyspozytor:</b> '.$login_sprawdzajacy_grafik.'</span><br>
							<span><b>Uwagi Dyspozytora:</b> '.$uwagi_dyspozytora.'</span><br>
							<span><b>Data dodania:</b> '.$data_dodania_kursu.'</span>
							"><button type="button" class="btn" style="background-color: #66CC66; color: white;"><i class="fas fa-calendar-check"></i> KURS</button></a></td>';
						}
					break;
					case 'ŚRODA':
						if($etat['sroda'] == "1"){
							if($disabled == 'disabled'):
								$table = '<td style="vertical-align: middle; '.$zmienne.'" id="'.$dates[0].'" '.$tooltip.'><h2><button class="btn" style="background-color: #236B8E; color: white;" '.$disabled.'><i class="far fa-calendar-plus"></i></button></h2></td>';
							else:
								$table = '<td style="vertical-align: middle; '.$zmienne.'" id="'.$dates[0].'" '.$tooltip.'><h2><a href="index.php?a=zarzadzanie-grafik&action=add-duty&user='.$row[$a][0]['id'].'&date='.$dates[0].'" class="btn" style="background-color: #236B8E; color: white;" '.$disabled.'><i class="far fa-calendar-plus"></i></a></h2></td>';
							endif;
						}  else {
							$table = '<td style="vertical-align: middle; '.$zmienne.'" id="'.$dates[0].'" '.$tooltip.'><h2><button type="button" class="btn" style="background-color: #99CCCC; color: white;" '.$disabled.'><i class="far fa-calendar-minus"></i></button></h2></td>';
						}
						if($urlop){
							$urlop_data = call("SELECT * FROM urlopy_grafik_daty WHERE urlop_id = ".$urlop['id']);
							for($url = 0; $url<$urlop_data->num_rows; $url++){
								$test = mysqli_fetch_assoc($urlop_data);
								if($dates[0] == $test['data']){
									$table = '<td style="vertical-align: middle; '.$zmienne.'" id="'.$dates[0].'" data-toggle="popover" data-trigger="hover focus" data-html="true" title="Urlop Pracownika"
									data-content="
									<span><b>Kierowca:</b> '.$login_kierowcy_urlop.'</span><br>
									<span><b>Powód Urlopu:</b> '.$urlop['powod'].'</span><br>
									<span><b>Zatwierdził:</b> '.$login_sprawdzajacy_urlop.'</span><br>
									<span><b>Data wprowadzenia urlopu:</b> '.$urlop['data_wystawienia'].'</span>
									"><button type="button" class="btn" style="background-color: #FF9900; color: white;" disabled><i class="far fa-calendar-alt"></i> URLOP</button></a></td>';
								}
							}
						}
						if($zawieszenie){
							$zawieszenie_data = call("SELECT * FROM zawieszenie_daty WHERE zawieszenie_id = ".$zawieszenie['id']);
							for($zaw = 0; $zaw<$zawieszenie_data->num_rows; $zaw++){
								$test = mysqli_fetch_assoc($zawieszenie_data);
								if($dates[0] == $test['data']){
									$table = '<td style="vertical-align: middle; '.$zmienne.'" id="'.$dates[0].'" data-toggle="popover" data-trigger="hover focus" data-html="true" title="Zawieszenie Pracownika"
									data-content="
									<span><b>Kierowca:</b> '.$login_kierowcy_zawieszony.'</span><br>
									<span><b>Powód Zawieszenia:</b> '.$zawieszenie['powod'].'</span><br>
									<span><b>Wprowadził:</b> '.$login_sprawdzajacy_zawieszony.'</span><br>
									<span><b>Data wprowadzenia zawieszenia:</b> '.$zawieszenie['data_wystawienia'].'</span>
									"><button type="button" class="btn btn-dark" style="" disabled><i class="fas fa-user-times"></i> ZAWIESZONY</button></a></td>';
								}
							}
						}
						if($grafik){
							$table = '<td style="vertical-align: middle; '.$zmienne.'" id="'.$dates[0].'" data-toggle="tooltip" data-html="true"
							title="
							<span><b>Kierowca:</b> '.$login_kierowcy_grafik.'</span><br>
							<span><b>Służba:</b> '.$sluzba.'</span><br>
							<span><b>Pojazd:</b> '.$pojazd.'</span><br>
							<span><b>Typ kursu:</b> '.$typ_sluzby.'</span><br>
							<span><b>Dyspozytor:</b> '.$login_sprawdzajacy_grafik.'</span><br>
							<span><b>Uwagi Dyspozytora:</b> '.$uwagi_dyspozytora.'</span><br>
							<span><b>Data dodania:</b> '.$data_dodania_kursu.'</span>
							"><button type="button" class="btn" style="background-color: #66CC66; color: white;"><i class="fas fa-calendar-check"></i> KURS</button></a></td>';
						}
					break;
					case 'CZWARTEK':
						if($etat['czwartek'] == "1"){
							if($disabled == 'disabled'):
								$table = '<td style="vertical-align: middle; '.$zmienne.'" id="'.$dates[0].'" '.$tooltip.'><h2><button class="btn" style="background-color: #236B8E; color: white;" '.$disabled.'><i class="far fa-calendar-plus"></i></button></h2></td>';
							else:
								$table = '<td style="vertical-align: middle; '.$zmienne.'" id="'.$dates[0].'" '.$tooltip.'><h2><a href="index.php?a=zarzadzanie-grafik&action=add-duty&user='.$row[$a][0]['id'].'&date='.$dates[0].'" class="btn" style="background-color: #236B8E; color: white;" '.$disabled.'><i class="far fa-calendar-plus"></i></a></h2></td>';
							endif;
						}  else {
							$table = '<td style="vertical-align: middle; '.$zmienne.'" id="'.$dates[0].'" '.$tooltip.'><h2><button type="button" class="btn" style="background-color: #99CCCC; color: white;" '.$disabled.'><i class="far fa-calendar-minus"></i></button></h2></td>';
						}
						if($urlop){
							$urlop_data = call("SELECT * FROM urlopy_grafik_daty WHERE urlop_id = ".$urlop['id']);
							for($url = 0; $url<$urlop_data->num_rows; $url++){
								$test = mysqli_fetch_assoc($urlop_data);
								if($dates[0] == $test['data']){
									$table = '<td style="vertical-align: middle; '.$zmienne.'" id="'.$dates[0].'" data-toggle="popover" data-trigger="hover focus" data-html="true" title="Urlop Pracownika"
									data-content="
									<span><b>Kierowca:</b> '.$login_kierowcy_urlop.'</span><br>
									<span><b>Powód Urlopu:</b> '.$urlop['powod'].'</span><br>
									<span><b>Zatwierdził:</b> '.$login_sprawdzajacy_urlop.'</span><br>
									<span><b>Data wprowadzenia urlopu:</b> '.$urlop['data_wystawienia'].'</span>
									"><button type="button" class="btn" style="background-color: #FF9900; color: white;" disabled><i class="far fa-calendar-alt"></i> URLOP</button></a></td>';
								}
							}
						}
						if($zawieszenie){
							$zawieszenie_data = call("SELECT * FROM zawieszenie_daty WHERE zawieszenie_id = ".$zawieszenie['id']);
							for($zaw = 0; $zaw<$zawieszenie_data->num_rows; $zaw++){
								$test = mysqli_fetch_assoc($zawieszenie_data);
								if($dates[0] == $test['data']){
									$table = '<td style="vertical-align: middle; '.$zmienne.'" id="'.$dates[0].'" data-toggle="popover" data-trigger="hover focus" data-html="true" title="Zawieszenie Pracownika"
									data-content="
									<span><b>Kierowca:</b> '.$login_kierowcy_zawieszony.'</span><br>
									<span><b>Powód Zawieszenia:</b> '.$zawieszenie['powod'].'</span><br>
									<span><b>Wprowadził:</b> '.$login_sprawdzajacy_zawieszony.'</span><br>
									<span><b>Data wprowadzenia zawieszenia:</b> '.$zawieszenie['data_wystawienia'].'</span>
									"><button type="button" class="btn btn-dark" style="" disabled><i class="fas fa-user-times"></i> ZAWIESZONY</button></a></td>';
								}
							}
						}
						if($grafik){
							$table = '<td style="vertical-align: middle; '.$zmienne.'" id="'.$dates[0].'" data-toggle="tooltip" data-html="true"
							title="
							<span><b>Kierowca:</b> '.$login_kierowcy_grafik.'</span><br>
							<span><b>Służba:</b> '.$sluzba.'</span><br>
							<span><b>Pojazd:</b> '.$pojazd.'</span><br>
							<span><b>Typ kursu:</b> '.$typ_sluzby.'</span><br>
							<span><b>Dyspozytor:</b> '.$login_sprawdzajacy_grafik.'</span><br>
							<span><b>Uwagi Dyspozytora:</b> '.$uwagi_dyspozytora.'</span><br>
							<span><b>Data dodania:</b> '.$data_dodania_kursu.'</span>
							"><button type="button" class="btn" style="background-color: #66CC66; color: white;"><i class="fas fa-calendar-check"></i> KURS</button></a></td>';
						}
					break;
					case 'PIĄTEK':
						if($etat['piatek'] == "1"){
							if($disabled == 'disabled'):
								$table = '<td style="vertical-align: middle; '.$zmienne.'" id="'.$dates[0].'" '.$tooltip.'><h2><button class="btn" style="background-color: #236B8E; color: white;" '.$disabled.'><i class="far fa-calendar-plus"></i></button></h2></td>';
							else:
								$table = '<td style="vertical-align: middle; '.$zmienne.'" id="'.$dates[0].'" '.$tooltip.'><h2><a href="index.php?a=zarzadzanie-grafik&action=add-duty&user='.$row[$a][0]['id'].'&date='.$dates[0].'" class="btn" style="background-color: #236B8E; color: white;" '.$disabled.'><i class="far fa-calendar-plus"></i></a></h2></td>';
							endif;
						}  else {
							$table = '<td style="vertical-align: middle; '.$zmienne.'" id="'.$dates[0].'" '.$tooltip.'><h2><button type="button" class="btn" style="background-color: #99CCCC; color: white;" '.$disabled.'><i class="far fa-calendar-minus"></i></button></h2></td>';
						}
						if($urlop){
							$urlop_data = call("SELECT * FROM urlopy_grafik_daty WHERE urlop_id = ".$urlop['id']);
							for($url = 0; $url<$urlop_data->num_rows; $url++){
								$test = mysqli_fetch_assoc($urlop_data);
								if($dates[0] == $test['data']){
									$table = '<td style="vertical-align: middle; '.$zmienne.'" id="'.$dates[0].'" data-toggle="popover" data-trigger="hover focus" data-html="true" title="Urlop Pracownika"
									data-content="
									<span><b>Kierowca:</b> '.$login_kierowcy_urlop.'</span><br>
									<span><b>Powód Urlopu:</b> '.$urlop['powod'].'</span><br>
									<span><b>Zatwierdził:</b> '.$login_sprawdzajacy_urlop.'</span><br>
									<span><b>Data wprowadzenia urlopu:</b> '.$urlop['data_wystawienia'].'</span>
									"><button type="button" class="btn" style="background-color: #FF9900; color: white;" disabled><i class="far fa-calendar-alt"></i> URLOP</button></a></td>';
								}
							}
						}
						if($zawieszenie){
							$zawieszenie_data = call("SELECT * FROM zawieszenie_daty WHERE zawieszenie_id = ".$zawieszenie['id']);
							for($zaw = 0; $zaw<$zawieszenie_data->num_rows; $zaw++){
								$test = mysqli_fetch_assoc($zawieszenie_data);
								if($dates[0] == $test['data']){
									$table = '<td style="vertical-align: middle; '.$zmienne.'" id="'.$dates[0].'" data-toggle="popover" data-trigger="hover focus" data-html="true" title="Zawieszenie Pracownika"
									data-content="
									<span><b>Kierowca:</b> '.$login_kierowcy_zawieszony.'</span><br>
									<span><b>Powód Zawieszenia:</b> '.$zawieszenie['powod'].'</span><br>
									<span><b>Wprowadził:</b> '.$login_sprawdzajacy_zawieszony.'</span><br>
									<span><b>Data wprowadzenia zawieszenia:</b> '.$zawieszenie['data_wystawienia'].'</span>
									"><button type="button" class="btn btn-dark" style="" disabled><i class="fas fa-user-times"></i> ZAWIESZONY</button></a></td>';
								}
							}
						}
						if($grafik){
							$table = '<td style="vertical-align: middle; '.$zmienne.'" id="'.$dates[0].'" data-toggle="tooltip" data-html="true"
							title="
							<span><b>Kierowca:</b> '.$login_kierowcy_grafik.'</span><br>
							<span><b>Służba:</b> '.$sluzba.'</span><br>
							<span><b>Pojazd:</b> '.$pojazd.'</span><br>
							<span><b>Typ kursu:</b> '.$typ_sluzby.'</span><br>
							<span><b>Dyspozytor:</b> '.$login_sprawdzajacy_grafik.'</span><br>
							<span><b>Uwagi Dyspozytora:</b> '.$uwagi_dyspozytora.'</span><br>
							<span><b>Data dodania:</b> '.$data_dodania_kursu.'</span>
							"><button type="button" class="btn" style="background-color: #66CC66; color: white;"><i class="fas fa-calendar-check"></i> KURS</button></a></td>';
						}
					break;
					case 'SOBOTA':
						if($etat['sobota'] == "1"){
							if($disabled == 'disabled'):
								$table = '<td style="vertical-align: middle; '.$zmienne.'" id="'.$dates[0].'" '.$tooltip.'><h2><button class="btn" style="background-color: #236B8E; color: white;" '.$disabled.'><i class="far fa-calendar-plus"></i></button></h2></td>';
							else:
								$table = '<td style="vertical-align: middle; '.$zmienne.'" id="'.$dates[0].'" '.$tooltip.'><h2><a href="index.php?a=zarzadzanie-grafik&action=add-duty&user='.$row[$a][0]['id'].'&date='.$dates[0].'" class="btn" style="background-color: #236B8E; color: white;" '.$disabled.'><i class="far fa-calendar-plus"></i></a></h2></td>';
							endif;
						}  else {
							$table = '<td style="vertical-align: middle; '.$zmienne.'" id="'.$dates[0].'" '.$tooltip.'><h2><button type="button" class="btn" style="background-color: #99CCCC; color: white;" '.$disabled.'><i class="far fa-calendar-minus"></i></button></h2></td>';
						}
						if($urlop){
							$urlop_data = call("SELECT * FROM urlopy_grafik_daty WHERE urlop_id = ".$urlop['id']);
							for($url = 0; $url<$urlop_data->num_rows; $url++){
								$test = mysqli_fetch_assoc($urlop_data);
								if($dates[0] == $test['data']){
									$table = '<td style="vertical-align: middle; '.$zmienne.'" id="'.$dates[0].'" data-toggle="popover" data-trigger="hover focus" data-html="true" title="Urlop Pracownika"
									data-content="
									<span><b>Kierowca:</b> '.$login_kierowcy_urlop.'</span><br>
									<span><b>Powód Urlopu:</b> '.$urlop['powod'].'</span><br>
									<span><b>Zatwierdził:</b> '.$login_sprawdzajacy_urlop.'</span><br>
									<span><b>Data wprowadzenia urlopu:</b> '.$urlop['data_wystawienia'].'</span>
									"><button type="button" class="btn" style="background-color: #FF9900; color: white;" disabled><i class="far fa-calendar-alt"></i> URLOP</button></a></td>';
								}
							}
						}
						if($zawieszenie){
							$zawieszenie_data = call("SELECT * FROM zawieszenie_daty WHERE zawieszenie_id = ".$zawieszenie['id']);
							for($zaw = 0; $zaw<$zawieszenie_data->num_rows; $zaw++){
								$test = mysqli_fetch_assoc($zawieszenie_data);
								if($dates[0] == $test['data']){
									$table = '<td style="vertical-align: middle; '.$zmienne.'" id="'.$dates[0].'" data-toggle="popover" data-trigger="hover focus" data-html="true" title="Zawieszenie Pracownika"
									data-content="
									<span><b>Kierowca:</b> '.$login_kierowcy_zawieszony.'</span><br>
									<span><b>Powód Zawieszenia:</b> '.$zawieszenie['powod'].'</span><br>
									<span><b>Wprowadził:</b> '.$login_sprawdzajacy_zawieszony.'</span><br>
									<span><b>Data wprowadzenia zawieszenia:</b> '.$zawieszenie['data_wystawienia'].'</span>
									"><button type="button" class="btn btn-dark" style="" disabled><i class="fas fa-user-times"></i> ZAWIESZONY</button></a></td>';
								}
							}
						}
						if($grafik){
							$table = '<td style="vertical-align: middle; '.$zmienne.'" id="'.$dates[0].'" data-toggle="tooltip" data-html="true"
							title="
							<span><b>Kierowca:</b> '.$login_kierowcy_grafik.'</span><br>
							<span><b>Służba:</b> '.$sluzba.'</span><br>
							<span><b>Pojazd:</b> '.$pojazd.'</span><br>
							<span><b>Typ kursu:</b> '.$typ_sluzby.'</span><br>
							<span><b>Dyspozytor:</b> '.$login_sprawdzajacy_grafik.'</span><br>
							<span><b>Uwagi Dyspozytora:</b> '.$uwagi_dyspozytora.'</span><br>
							<span><b>Data dodania:</b> '.$data_dodania_kursu.'</span>
							"><button type="button" class="btn" style="background-color: #66CC66; color: white;"><i class="fas fa-calendar-check"></i> KURS</button></a></td>';
						}
					break;
					case 'NIEDZIELA':
						if($etat['niedziela'] == "1"){
							if($disabled == 'disabled'):
								$table = '<td style="vertical-align: middle; '.$zmienne.'" id="'.$dates[0].'" '.$tooltip.'><h2><button class="btn" style="background-color: #236B8E; color: white;" '.$disabled.'><i class="far fa-calendar-plus"></i></button></h2></td>';
							else:
								$table = '<td style="vertical-align: middle; '.$zmienne.'" id="'.$dates[0].'" '.$tooltip.'><h2><a href="index.php?a=zarzadzanie-grafik&action=add-duty&user='.$row[$a][0]['id'].'&date='.$dates[0].'" class="btn" style="background-color: #236B8E; color: white;" '.$disabled.'><i class="far fa-calendar-plus"></i></a></h2></td>';
							endif;
						}  else {
							$table = '<td style="vertical-align: middle; '.$zmienne.'" id="'.$dates[0].'" '.$tooltip.'><h2><button type="button" class="btn" style="background-color: #99CCCC; color: white;" '.$disabled.'><i class="far fa-calendar-minus"></i></button></h2></td>';
						}
						if($urlop){
							$urlop_data = call("SELECT * FROM urlopy_grafik_daty WHERE urlop_id = ".$urlop['id']);
							for($url = 0; $url<$urlop_data->num_rows; $url++){
								$test = mysqli_fetch_assoc($urlop_data);
								if($dates[0] == $test['data']){
									$table = '<td style="vertical-align: middle; '.$zmienne.'" id="'.$dates[0].'" data-toggle="popover" data-trigger="hover focus" data-html="true" title="Urlop Pracownika"
									data-content="
									<span><b>Kierowca:</b> '.$login_kierowcy_urlop.'</span><br>
									<span><b>Powód Urlopu:</b> '.$urlop['powod'].'</span><br>
									<span><b>Zatwierdził:</b> '.$login_sprawdzajacy_urlop.'</span><br>
									<span><b>Data wprowadzenia urlopu:</b> '.$urlop['data_wystawienia'].'</span>
									"><button type="button" class="btn" style="background-color: #FF9900; color: white;" disabled><i class="far fa-calendar-alt"></i> URLOP</button></a></td>';
								}
							}
						}
						if($zawieszenie){
							$zawieszenie_data = call("SELECT * FROM zawieszenie_daty WHERE zawieszenie_id = ".$zawieszenie['id']);
							for($zaw = 0; $zaw<$zawieszenie_data->num_rows; $zaw++){
								$test = mysqli_fetch_assoc($zawieszenie_data);
								if($dates[0] == $test['data']){
									$table = '<td style="vertical-align: middle; '.$zmienne.'" id="'.$dates[0].'" data-toggle="popover" data-trigger="hover focus" data-html="true" title="Zawieszenie Pracownika"
									data-content="
									<span><b>Kierowca:</b> '.$login_kierowcy_zawieszony.'</span><br>
									<span><b>Powód Zawieszenia:</b> '.$zawieszenie['powod'].'</span><br>
									<span><b>Wprowadził:</b> '.$login_sprawdzajacy_zawieszony.'</span><br>
									<span><b>Data wprowadzenia zawieszenia:</b> '.$zawieszenie['data_wystawienia'].'</span>
									"><button type="button" class="btn btn-dark" style="" disabled><i class="fas fa-user-times"></i> ZAWIESZONY</button></a></td>';
								}
							}
						}
						if($grafik){
							$table = '<td style="vertical-align: middle; '.$zmienne.'" id="'.$dates[0].'" data-toggle="tooltip" data-html="true"
							title="
							<span><b>Kierowca:</b> '.$login_kierowcy_grafik.'</span><br>
							<span><b>Służba:</b> '.$sluzba.'</span><br>
							<span><b>Pojazd:</b> '.$pojazd.'</span><br>
							<span><b>Typ kursu:</b> '.$typ_sluzby.'</span><br>
							<span><b>Dyspozytor:</b> '.$login_sprawdzajacy_grafik.'</span><br>
							<span><b>Uwagi Dyspozytora:</b> '.$uwagi_dyspozytora.'</span><br>
							<span><b>Data dodania:</b> '.$data_dodania_kursu.'</span>
							"><button type="button" class="btn" style="background-color: #66CC66; color: white;"><i class="fas fa-calendar-check"></i> KURS</button></a></td>';
						}
					break;

				}
				echo $table;
			}
		}
	}

	function add_duty_grafik($uid, $data, $typ, $wykaz_id, $pojazd, $uwagi_dyspozytora, $dyspo_id){
		//$data_dodania_kursu = date("H:i:s d.m.Y");
		$data_dodania_kursu = mktime(date('H'), date('i'), date('s'), date('m'), date('d'), date('Y'));
		$status = 1;
		$wykaz = row("SELECT * FROM wykaz WHERE id = ".$wykaz_id);
		//print_r($wykaz);
		$query = call("INSERT INTO grafik (uid, dyspozytor_id, linia, brygada, zmiana, typ, pojazd, data, data_dodania_kursu, uwagi_dyspozytora, status) VALUES ('".$uid."', '".$dyspo_id."', '".$wykaz['linia']."', '".$wykaz['brygada']."', '".$wykaz['zmiana']."', '".$typ."', '".$pojazd."', '".$data."', '".$data_dodania_kursu."', '".$uwagi_dyspozytora."', '".$status."')");
		if($query){
			$status = 0;
 			$query2 = call("INSERT INTO raporty (uid, did, linia, brygada, zmiana, typ_kursu, pojazd, data_kursu, uwagi_dyspozytor, status) VALUES ('".$uid."', '".$dyspo_id."', '".$wykaz['linia']."', '".$wykaz['brygada']."', '".$wykaz['zmiana']."', '".$typ."', '".$pojazd."', '".$data."', '".$uwagi_dyspozytora."', '".$status."')");
			if($query2){
				$query3 = call("INSERT INTO wykaz_nie_dostepne_sluzby (wykaz_id, data, status) VALUES ('".$wykaz_id."', '".$data."', '".$status."')");
				if($query3){
					$_SESSION['success'] = 'Dodano nowy kurs!';
					header('Location: index.php?a=dyspozytornia2137');
				} else {
					$_SESSION['danger'] = 'Błąd numer 3!';
					header('Location: index.php?a=dyspozytornia2137');
				}
			} else {
				$_SESSION['danger'] = 'Błąd numer 2!';
				header('Location: index.php?a=dyspozytornia2137');
			}
		} else {
			$_SESSION['danger'] = 'Błąd numer 1!';
			header('Location: index.php?a=dyspozytornia2137');
		}
	}
?>
