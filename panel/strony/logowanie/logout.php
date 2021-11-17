<?php
	require_once './funkcje/IP-user.php';
	$get_ip = UserInfo::get_ip();
	$get_os = UserInfo::get_os();
	$get_browser = UserInfo::get_browser();
	$get_device = UserInfo::get_device();
	$dataczegos = mktime(date('H'), date('i'), date('s'), date('m'), date('d'), date('Y'));
	$log = call("INSERT INTO logi_logowania (uid, akcja, data, get_ip, get_os, get_browser, get_device) VALUES ('".$user['id']."', 'Wylogowanie z Panelu', '".$dataczegos."', '".$get_ip."', '".$get_os."', '".$get_browser."', '".$get_device."')");
	$_SESSION['id'] = array(); // Czyszczenie sesji (nadpisanie czystą tablicą)
	_destroy($user['id']); // Usuwanie aktywnej sesji

	header("Location: index.php"); // Przeniesienie na stronę główną
?>
