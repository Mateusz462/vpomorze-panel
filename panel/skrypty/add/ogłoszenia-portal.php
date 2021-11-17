<?php
session_start(); // Rozpoczynamy lub przedłużamy pracę sesji
require_once('../../../config/connect.php'); // Połączenie z bazą danych
require_once('../../../config/function.php'); // Pobranie pliku z funkcjami
	
	
	if (!empty($_POST)) {
		if (isset($_POST['button_add']) && empty($_POST['autor']) || empty($_POST['tytul']) || empty($_POST['kategoria']) || empty($_POST['text'])) {
			$_SESSION['danger'] = 'Wypełnij pola poprawnie3!';
			header('Location: ../../index.php?a=ogłoszenia-portal&action=add');
		} else {
			$autor = vtxt($_POST['autor']);
			$tytul = vtxt($_POST['tytul']);
			$kategoria = vtxt($_POST['kategoria']);
			$text = $_POST['text'];
			
			
			$istnieje = row("SELECT id FROM wpisy WHERE tytul = '".$tytul."'");
			if ($istnieje) {
				$_SESSION['danger'] = 'Istnieje już taki wpis!';
				header('Location: ../../index.php?a=ogłoszenia-portal&action=add');
			} else {
				call("INSERT INTO wpisy (kto, tytul, kategoria, text) VALUES ('".$autor."', '".$tytul."', '".$kategoria."', '".$text."')");
				$_SESSION['success'] = 'Dodano nowy wpis!';
				header('Location: ../../index.php?a=ogłoszenia-portal');
			}
		};
	}	
?>