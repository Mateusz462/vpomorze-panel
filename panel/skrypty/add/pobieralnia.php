<?php
session_start(); // Rozpoczynamy lub przedłużamy pracę sesji
require_once('../../../config/connect.php'); // Połączenie z bazą danych
require_once('../../../config/function.php'); // Pobranie pliku z funkcjami
	
	
	if (!empty($_POST)) {
		if (isset($_POST['button_add']) && empty($_POST['a_name']) || empty($_POST['a_link']) || empty($_POST['a_kategoria'])) {
			$_SESSION['danger'] = 'Wypełnij pola poprawnie3!';
			header('Location: ../../index.php?a=pobieralnia-zarządzanie&action=add');
		} else {
			$name = vtxt($_POST['a_name']);
			$link = vtxt($_POST['a_link']);
			$kategoria = vtxt($_POST['a_kategoria']);
			
			
			$istnieje = row("SELECT id FROM pobieralnia WHERE name = '".$name."' OR link = '".$link."'");
			if ($istnieje) {

				$_SESSION['danger'] = 'Istnieje już taka rzecz!';
				header('Location: ../../index.php?a=pobieralnia-zarządzanie&action=add');
			} else {
				call("INSERT INTO pobieralnia (name, link, cat) VALUES ('".$name."', '".$link."', '".$kategoria."')");
				$_SESSION['success'] = 'Dodano nowy pojazd!';
				header('Location: ../../index.php?a=pobieralnia-zarządzanie');
			}
		};
	}	
?>