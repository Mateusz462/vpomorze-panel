<?php
session_start(); // Rozpoczynamy lub przedłużamy pracę sesji
require_once('../../../config/connect.php'); // Połączenie z bazą danych
require_once('../../../config/function.php'); // Pobranie pliku z funkcjami
	
	if (!empty($_POST)) {
		if (isset($_POST['button_edit']) && empty($_POST['e_name']) || empty($_POST['e_link']) || empty($_POST['e_kategoria'])) {
			$id = vtxt($_POST['e_id']);
			$_SESSION['danger'] = 'Wypełnij pola poprawnie!';
			header('Location: ../../index.php?a=pobieralnia-zarządzanie&action=edit&id='.$id);
		} else {
			$id = vtxt($_POST['e_id']);
			$name = vtxt($_POST['e_name']);
			$link = vtxt($_POST['e_link']);
			$kategoria = vtxt($_POST['e_kategoria']);

			call("UPDATE pobieralnia SET name = '".$name."', link = '".$link."', cat = '".$kategoria."' WHERE id = '".$id."'");
			$_SESSION['success'] = 'Sukces skurwysynie!';
			header('Location: ../../index.php?a=pobieralnia-zarządzanie');
			
		};
	}		
?>