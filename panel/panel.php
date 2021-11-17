<?php 
ob_start();
session_start();
$_SESSION = array(); // Czyszczenie sesji (nadpisanie czystą tablicą)
	session_destroy(); // Usuwanie aktywnej sesji
	?>