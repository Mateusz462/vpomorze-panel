<?php
session_start(); // Rozpoczynamy lub przedłużamy pracę sesji
require_once('../../../config/connect.php'); // Połączenie z bazą danych
require_once('../../../config/function.php'); // Pobranie pliku z funkcjami
	
	if (!empty($_POST)) {
		if ($delete && isset($_POST['button_delete']) && empty($_POST['d_id'])) {
			$_SESSION['danger'] = 'Błąd! Skontaktuj się z programistą';
			header('Location: ../../index.php?a=pobieralnia-zarządzanie');
		} else {
			$idd = vtxt($_POST['d_id']);
			$query = call("DELETE FROM pobieralnia WHERE id = '".$idd."'");

			if (!$query){
				$_SESSION['danger'] = 'Wystąpił błąd!';
				header('Location: ../../index.php?a=pobieralnia-zarządzanie');
			}else{
				$_SESSION['success'] = 'Poprawnie Usunięto!';
				header('Location: ../../index.php?a=pobieralnia-zarządzanie');
			}
			
		}	
	}
?>