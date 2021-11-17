<?php
	session_start(); // Rozpoczynamy lub przedłużamy pracę sesji
	require_once('../../../config/connect.php'); // Połączenie z bazą danych
	require_once('../../../config/function.php'); // Pobranie pliku z funkcjami

	$user = getUser($_SESSION['id']);
	if (!empty($_POST)) {
		if (isset($_POST['button_add']) && empty($_POST['numer']) || empty($_POST['brygada']) || empty($_POST['zmiana']) || empty($_POST['rozpoczecia']) || empty($_POST['zakonczenie']) || empty($_POST['miejsce']) || empty($_POST['pojazd']) || empty($_POST['uwagi'])) {
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
			$uwagi = vtxt($_POST['uwagi']);
			$data = vtxt($_POST['data']);
			$uid = vtxt($_POST['uid']);
			if($rezerwa){
				$typ = '6';
			}elseif($kzw){
				$typ = '2';
			}elseif($rezerwa && $kzw){
				$_SESSION['danger'] = 'BŁĄD!';
				header('Location: ../../index.php?a=dyspozytornia&driver='.$uid);
			}else{
				$typ = '1';
			}
			
			$elo = call("INSERT INTO raporty (uid, typ_kursu, linia, brygada, zmiana, pojazd, data) VALUES ('".$uid."', '".$typ."', '".$numer."', '".$brygada."', '".$zmiana."', '".$pojazd."', '".$data."')");
			if($elo){
				$tak = call("INSERT INTO grafik (uid, typ, linia, brygada, zmiana, godzina_od, godzina_do, miejsce, pojazd, data) VALUES ('".$uid."', '".$typ."', '".$numer."', '".$brygada."', '".$zmiana."', '".$rozpoczecia."', '".$zakonczenie."', '".$miejsce."', '".$pojazd."', '".$data."')");

				if($tak){	
					$elo1 = call("INSERT INTO logi (uid, akcja) VALUES ('".$user['id']."', 'Dodał wpis do grafiku dla osoby o id:'".$uid."' w dniu '".$data."')");
					$_SESSION['success'] = 'Dodano Nowy Wpis Do Grafiku!';
					header('Location: ../../index.php?a=dyspozytornia&driver='.$uid);
				} else {
					$_SESSION['danger'] = 'BŁĄD JEBANY DEBILU';
					header('Location: ../../index.php?a=dyspozytornia&driver='.$uid);
				}
			} else {
				$_SESSION['danger'] = 'BŁĄD JEBANY DEBILU';
				header('Location: ../../index.php?a=dyspozytornia&driver='.$uid);
			}
		}
	}
?>