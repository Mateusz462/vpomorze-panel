<?php

    /* $host = 'hcxeyhrwp.mysql.db'; // Nazwa hosta (serwera) bazy danych
    $user = 'hcxeyhrwp'; // Nazwa użytkownika bazy danych
    $pass = '238Rembek'; // Hasło użytkownika bazy danych
    $db = 'hcxeyhrwp'; // Nazwa naszej bazy danych

    $con = mysqli_connect($host, $user, $pass, $db);
    $con->set_charset("utf8"); */



    $host = 'localhost'; // Nazwa hosta (serwera) bazy danych
	$user = 'root'; // Nazwa użytkownika bazy danych
	$pass = ''; // Hasło użytkownika bazy danych
	$db = 'hcxeyhrwp'; // Nazwa naszej bazy danych
    //
	$con = @new mysqli($host, $user, $pass, $db);
   
	//$con->set_charset("utf8");
	
	if($con->connect_errno != 0){
		die("<h1><b style='color:#dc3545'>Error: ".$con->connect_errno . " Opis: ". $con->connect_error. "</b></h1>");
	}




?>
