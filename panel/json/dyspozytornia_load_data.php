<?php
	require_once('../../config/connect.php'); // Połączenie z bazą danych
	//require_once('../../config/session.php'); // Pobranie pliku z funkcjami
	require_once('../../config/function.php'); // Pobranie pliku z funkcjami
	//session_set_save_handler('_open', '_close', '_read', '_write', '_destroy', '_clean');
	//register_shutdown_function('session_write_close');
	ob_start();
	session_start(); // Rozpoczynamy lub przedłużamy pracę sesji
	//_clean(1800);
	/* if (!empty($_SESSION['id'])) {
		checkUser($_SESSION['id']); // Sprawdzenie, czy gracz jest zapisany w sesji (zalogowany)
		$user = getUser($_SESSION['id']); // Wybierany danych z bazy o graczu aktualnie zalogowanym
		$perm = row("SELECT * FROM permisje WHERE rid =".$user['stanowisko']);
		$user_role = row("SELECT * FROM rangi WHERE id = ".$user['stanowisko']);
		if($user['dc'] == 1){
			$user_discord = row("SELECT * FROM discord WHERE uid = ".$user['id']);
		} else {
			$user_discord = array(); // Czyszczenie zmiennej gracza
		}



	}  */
	if(!isset($_GET['action'])){
		$data_add_duty = vtxt($_POST['data']);
		$typ = vtxt($_POST['typ']);
		$l1 = call("SELECT * FROM wykaz WHERE typ = '.$typ.'");
		$l2 = call("SELECT wykaz_id FROM wykaz_nie_dostepne_sluzby");
		$l3 = call("SELECT * FROM wykaz WHERE typ = ".$typ." AND id not in (select wykaz_id from wykaz_nie_dostepne_sluzby WHERE data = $data_add_duty)");
		//print_r($l1);
		//print "<pre>";
		$output = '';
		while ($row = mysqli_fetch_assoc($l3)){
			//print_r($row);
			//$json_array[] = $row;
			$output .= '<option value="'.$row['id'].'">'.$row['linia'].'/'.$row['brygada'].'/'.$row['zmiana'].' - [ '.$row['klasa_taboru'].' ] [ TYP DNIA ] '.$row['typ'].'</option>';
			//print_r($row);
		}
		//print_r(json_encode($json_array));
		echo $output;
	} elseif(isset($_GET['action']) && $_GET['action'] == 'sluzba'){
		$sluzba_id = vtxt($_POST['sluzba_id']);
		$l1 = row("SELECT * FROM wykaz WHERE id = $sluzba_id");

		echo $l1['klasa_taboru'];
	} elseif(isset($_GET['action']) && $_GET['action'] == 'pojazd'){
		//$sluzba_id = vtxt($_POST['sluzba_id']);
		//$l1 = call("SELECT * FROM wykaz WHERE id = $sluzba_id");
		$klasa = vtxt($_POST['klasa']);
		$l1 = call("SELECT * FROM tabor");
		$opcja = '';
		while ($row = mysqli_fetch_assoc($l1)){
			//$l2 = row("SELECT * FROM tabor_w_ruchu WHERE tid = '.$row['id'].'");
			if($row['stan'] == 0){
				$opcja .= '<option disabled>'.$row['marka']. ' '. $row['model']. ' #'. $row['taborowy'].' WST</option>';
			} elseif($row['klasa'] == $klasa){
				$opcja .= '<option value='.$row['id'].'>'.$row['marka']. ' '. $row['model']. ' #'. $row['taborowy'].'</option>';
			}else{
				$opcja .= '<option disabled>'.$row['marka']. ' '. $row['model']. ' #'. $row['taborowy'].' TYP</option>';
			}
		}
		echo $opcja;
		//print_r($l1);
	}
		//echo 'elooooooooooo';

	/* else {
		$user = array(); // Czyszczenie zmiennej gracza
		$perm = array(); // Czyszczenie zmiennej gracza
		$user_role = array(); // Czyszczenie zmiennej gracza
		$user_discord = array(); // Czyszczenie zmiennej gracza
		header("Location: ../index.php"); // Przeniesienie na stronę główną
	} */



?>
