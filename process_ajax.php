<?php
	header("Cache-Control: no-cache");
	date_default_timezone_set('Europe/Warsaw');
	require_once('config/connect.php'); // Pobranie pliku z funkcjami
	require_once('config/function.php'); // Pobranie pliku z funkcjami
	if($con)
	{
		//mysql_select_db($dbname,$dbconn);
		//mysql_query("SET NAMES utf8");
		if(isset($_POST['chat']) && $_POST['chat']==1)
		{
			$nick = vtxt($_POST['imie']);
			$tresc = vtxt($_POST['tresc']); 
			call("INSERT INTO wiadomości (uid,tresc,czas) VALUES ('$nick','$tresc',NOW())");
			$last_id = mysqli_insert_id($con);
			$last_item = call("SELECT * FROM wiadomości WHERE id = '$last_id'");
			while($wiadomosc = mysqli_fetch_assoc($last_item)){
				//$wyniki[] = $wiadomosc;
				echo '<li>';
				echo date("d.m.Y H:i",strtotime($wiadomosc['czas'])).' <strong>'.htmlspecialchars($wiadomosc['uid']).'</strong> '.htmlspecialchars($wiadomosc['tresc']);
				echo '</li>';
			}
			//$wiadomosc = mysqli_fetch_assoc($last_item);
		}
		else 
		{
			$data_ostatniej_wiadomosci = call("SELECT MAX(czas) FROM wiadomości");
			$data_ostatniej_wiadomosci = row($data_ostatniej_wiadomosci);
			$data_ostatniej_wiadomosci = strtotime($data_ostatniej_wiadomosci[0]);
			$html = '';
			$data_od_usera = intval($_POST['data_ostatniej_wiadomosci']);
			if($data_ostatniej_wiadomosci > $data_od_usera){
				$items = call("SELECT * FROM wiadomości ORDER BY czas DESC LIMIT 10");
				$wyniki = array();
				while($wiadomosc = mysqli_fetch_assoc($items)){
					$wyniki[] = $wiadomosc;
				}
				$wyniki = array_reverse($wyniki);
				foreach($wyniki as $wiadomosc){
					$html .= '<li>';
					$html .= date("d.m.Y H:i",strtotime($wiadomosc['czas'])).' <strong>'.htmlspecialchars($wiadomosc['uid']).'</strong> '.htmlspecialchars($wiadomosc['tresc']);
					$html .= '</li>'; 
				}
			} else {
				$html .= '';
			}
			header('Content-Type: application/json');
			json_encode(array('html'=>$html,'czas'=>$data_ostatniej_wiadomosci));
		}
	}
?>