<?php 
	$_SESSION = array(); // Czyszczenie sesji (nadpisanie czystą tablicą)
	session_destroy(); // Usuwanie aktywnej sesji
	header("Location: index.php?a=login"); // Przeniesienie na stronę główną
?>