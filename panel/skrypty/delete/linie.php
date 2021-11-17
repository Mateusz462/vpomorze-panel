<?php
session_start(); // Rozpoczynamy lub przedłużamy pracę sesji
require_once('../../../config/connect.php'); // Połączenie z bazą danych
require_once('../../../config/function.php'); // Pobranie pliku z funkcjami
	
	if(!empty($_POST)){	
		if(isset($_POST['button_delete']) && empty($_POST['d_id'])){
			$_SESSION['danger'] = 'Błąd! Skontaktuj się z programistą';
			header('Location: ../../index.php?a=linie-zarządzanie');
		} else {
			$id = vtxt($_POST['d_id']);
			
			call("DELETE FROM linie WHERE id = '".$id."'");
			call("DELETE FROM wykaz_brygad WHERE linia = '".$id."'");
			$_SESSION['success'] = 'Poprawnie Usunięto!';
			header('Location: ../../index.php?a=linie-zarządzanie');
		}
	}
?>