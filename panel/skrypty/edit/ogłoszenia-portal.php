<?php
session_start(); // Rozpoczynamy lub przedłużamy pracę sesji
require_once('../../../config/connect.php'); // Połączenie z bazą danych
require_once('../../../config/function.php'); // Pobranie pliku z funkcjami
	
	
	if (!empty($_POST)) {
		if (isset($_POST['button_add']) && empty($_POST['autor']) || empty($_POST['tytul']) || empty($_POST['kategoria']) || empty($_POST['text'])) {
			$id = vtxt($_POST['id']);
			$_SESSION['danger'] = 'Wypełnij pola poprawnie3!';
			header('Location: ../../index.php?a=ogłoszenia-portal&action=edit&id='.$id);
		} else {
			$id = vtxt($_POST['id']);
			$autor = vtxt($_POST['autor']);
			$tytul = vtxt($_POST['tytul']);
			$kategoria = vtxt($_POST['kategoria']);
			$text = $_POST['text'];

			call("UPDATE wpisy SET kto = '".$autor."', tytul = '".$tytul."', kategoria = '".$kategoria."', text = '".$text."' WHERE id = '".$id."'");
			$_SESSION['success'] = 'Dodano nowy wpis!';
			header('Location: ../../index.php?a=ogłoszenia-portal');
		};
	}	
?>