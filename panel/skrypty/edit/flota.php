<?php
session_start(); // Rozpoczynamy lub przedłużamy pracę sesji
require_once('../../../config/connect.php'); // Połączenie z bazą danych
require_once('../../../config/function.php'); // Pobranie pliku z funkcjami
	

	if (!empty($_POST)) {
		if (empty($_POST['marka']) || empty($_POST['taborowy']) || empty($_POST['produkcja']) || empty($_POST['klasa']) || empty($_POST['zajezdnia']) || empty($_POST['model']) || empty($_POST['rejestracja']) || empty($_POST['przegląd']) || empty($_POST['podłoga']) || empty($_POST['własciciel']) || empty($_POST['uwagi'])) {
			$id = vtxt($_POST['id']);
			$_SESSION['danger'] = 'Wypełnij wszystkie pola!';
			header('Location: ../../index.php?a=flota&action=edit&id='.$id);
		} else {
			$id = vtxt($_POST['id']);
			$marka = vtxt($_POST['marka']);
			$taborowy = vtxt($_POST['taborowy']);
			$produkcja = vtxt($_POST['produkcja']);
			$klasa = vtxt($_POST['klasa']);
			$zajezdnia = vtxt($_POST['zajezdnia']);
			
			$model = vtxt($_POST['model']);
			$rejestracja = vtxt($_POST['rejestracja']);
			$przegląd = vtxt($_POST['przegląd']);
			$podłoga = vtxt($_POST['podłoga']);
			$własciciel = vtxt($_POST['własciciel']);
			$uwagi = vtxt($_POST['uwagi']);
			$stan = '1';
			
			$tak = call("UPDATE `tabor` SET `taborowy`='".$taborowy."',`marka`='".$marka."',`model`='".$model."',`produkcja`='".$produkcja."',`nr_rejestracyjny`='".$rejestracja."',`klasa`='".$klasa."',`zajezdnia`='".$zajezdnia."',`przegląd`='".$przegląd."',`podłoga`='".$podłoga."',`własciciel`='".$własciciel."',`uwagi`='".$uwagi."',`stan`= '".$stan."' WHERE id = '".$id."'");
			if($tak){	
				$_SESSION['success'] = 'Dodano nowy pojazd!';
				header('Location: ../../index.php?a=flota');
			} else {
				$_SESSION['danger'] = 'Błąd! Skontaktuj się z progarmistą';
				header('Location: ../../index.php?a=flota');
			}
			
		}
	}
?>