<?php
session_start(); // Rozpoczynamy lub przedłużamy pracę sesji
require_once('../../../config/connect.php'); // Połączenie z bazą danych
require_once('../../../config/function.php'); // Pobranie pliku z funkcjami
	

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
?>