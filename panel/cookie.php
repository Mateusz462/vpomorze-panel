<?php
/*
Kod wykonany przez FireHead996.
Code by FireHead996.
https://www.youtube.com/user/FireHead996
*/
ob_start();
session_start();

setcookie('cookies_enabled', 1, time()+86400);
if (!empty($_GET['a'])) {
	if (empty($_GET['a']))
		header("Location: index.php");
	else
		header("Location: index.php?a=".$_GET['a']);
} else header("Location: index.php");

ob_end_flush();
ob_end_clean();
?>