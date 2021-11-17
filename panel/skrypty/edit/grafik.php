<?php
session_start(); // Rozpoczynamy lub przedłużamy pracę sesji
require_once('../../../config/connect.php'); // Połączenie z bazą danych
require_once('../../../config/function.php'); // Pobranie pliku z funkcjami
	

	if (!empty($_POST)) {
		if (isset($_POST['button_edit']) && empty($_POST['numer']) || empty($_POST['brygada']) || empty($_POST['zmiana']) || empty($_POST['rozpoczecia']) || empty($_POST['zakonczenie']) || empty($_POST['miejsce']) || empty($_POST['pojazd'])) {
			$uid = vtxt($_POST['uid']);
			$_SESSION['danger'] = 'Wypełnij wszystkie pola!';
			header('Location: ../../index.php?a=dyspozytornia&driver='.$uid);
		} else {
			$numer = vtxt($_POST['numer']);
			$brygada = vtxt($_POST['brygada']);
			$zmiana = vtxt($_POST['zmiana']);
			$rozpoczecia = vtxt($_POST['rozpoczecia']);
			$zakonczenie = vtxt($_POST['zakonczenie']);
			$miejsce = vtxt($_POST['miejsce']);
			$pojazd = vtxt($_POST['pojazd']);
			$kzw = vtxt($_POST['kzw']);
			$rezerwa = vtxt($_POST['rezerwa']);
			$zwykly = vtxt($_POST['zwykly']);
			$anuluj = vtxt($_POST['anuluj']);
			$uid = vtxt($_POST['uid']);
			$data = vtxt($_POST['data']);
			$id = vtxt($_POST['id']);
			if($rezerwa){
				$typ = '6';
			}elseif($kzw){
				$typ = '2';
			}elseif($anuluj){
				$typ = '5';
			}elseif($zwykly){
				$typ = '1';
			}elseif($rezerwa && $kzw && $anuluj && $zwykly){
				$_SESSION['danger'] = 'BŁĄD!';
				header('Location: ../../index.php?a=dyspozytornia&driver='.$uid);
			}else{
				$typ = '1';
			}
			$targets = row("SELECT * FROM raporty WHERE uid = ".$uid." AND data = ".$data);
			$elo = call("UPDATE raporty SET uid = '".$uid."', typ_kursu = '".$typ."', linia = '".$numer."', brygada = '".$brygada."', zmiana = '".$zmiana."', pojazd = '".$pojazd."', data = '".$data."' WHERE id=".$targets['id']);
			if($elo){
				$tak = call("UPDATE grafik SET typ = '".$typ."', linia = '".$numer."', brygada = '".$brygada."', zmiana = '".$zmiana."', godzina_od = '".$rozpoczecia."', godzina_do = '".$zakonczenie."', miejsce = '".$miejsce."', pojazd = '".$pojazd."' WHERE id = '".$id."'");

				if($tak){	
					$_SESSION['success'] = 'Sukces!';
					header('Location: ../../index.php?a=dyspozytornia&driver='.$uid);
				} else {
					$_SESSION['danger'] = 'BŁĄD JEBANY DEBILU';
					header('Location: ../../index.php?a=dyspozytornia&driver='.$uid);
				}
			} else {
				$_SESSION['danger'] = 'BŁĄD JEBANY DEBILU2';
				header('Location: ../../index.php?a=dyspozytornia&driver='.$uid);
			}
		}
	}
?>