<?php
	session_start(); // Rozpoczynamy lub przedłużamy pracę sesji
	require_once('../../../config/connect.php'); // Połączenie z bazą danych
	require_once('../../../config/function.php'); // Pobranie pliku z funkcjami


	if (!empty($_POST)) {
		if (isset($_POST['button_edit']) && empty($_POST['decyzja']) || empty($_POST['kilometry']) || empty($_POST['punkty'])) {
			$id = vtxt($_POST['id']);
			$_SESSION['danger'] = 'Wypełnij wszystkie pola!';
			header('Location: ../../index.php?a=raporty-zarządzanie&edit='.$id);
		} else {
			$id = vtxt($_POST['id']);
			$uid = vtxt($_POST['uid']);
			$decyzja = vtxt($_POST['decyzja']);
			$uwagis = vtxt($_POST['uwagis']);
			$cos = row("SELECT * FROM users WHERE id =".$uid);

			if($decyzja == 2){
				$kilometry = 0;
				$punkty = 0;
				$km = $cos['kilometry'] + $kilometry;
				$pt = $cos['punkty'] + $punkty;
				$rap = $cos['raporty'] + 0;
				$rapn = $cos['nieraporty'] + 1;
			} elseif($decyzja == 1) {
				$kilometry = vtxt($_POST['kilometry']);
				$punkty = vtxt($_POST['punkty']);
				$km = $cos['kilometry'] + $kilometry;
				$pt = $cos['punkty'] + $punkty;
				$rap = $cos['raporty'] + 1;
				$rapn = $cos['nieraporty'] + 0;
			} else {
				$_SESSION['danger'] = 'Błąd! Upewnij się czy wszystkie pola zostały poprawnie uzupełnione';
				header('Location: ../../index.php?a=raporty-zarządzanie&edit='.$id);
			}



			$query = call("UPDATE users SET kilometry = '".$km."', punkty = '".$pt."', raporty = '".$rap."', nieraporty = '".$rapn."' WHERE id = '".$uid."'");//Użytkownik Składający raport
			$query1 = call("UPDATE raporty SET kilometry = '".$kilometry."', punkty = '".$punkty."', uwagi2 = '".$uwagis."', status2 = '".$decyzja."' WHERE id = '".$id."'");//raport
			$log = call("INSERT INTO logi (uid, akcja) VALUES ('".$user['id']."', 'Użytkownik ".$user['login']." złożył wniosek o zmianę etatu!')");//log
			// $client->channel->createMessage([
			// 	'channel.id' => intval($pushchannel),
			// 	'content' => '',
			// 	'embed' => [
			// 		"author" => [
			// 			"name" => "Przyjęto raport",
			// 			"url" => "",
			// 			"icon_url" => "https://cdn.discordapp.com/emojis/555804149610971136.png?v=1"
			// 		],
			// 		"description" => '
			// 			» Typ: **Raport**
			// 			» Osoba: **'.$target['login'].'**
			// 			» Osoba Sprawdzająca: **['.$role['kod_roli'].''.$user['nr_sluzbowy'].'] '.$user['login'].'**
			// 		',
			// 		"color" => hexdec('#f6c23e'),
			// 		"footer" => [
			// 			"icon_url" => "https://cdn.discordapp.com/icons/645582261378613249/5d0deaffdc5531a405583b16f823d928.png?size=128",
			// 			"text" => "Powiadomienie z panelu!"
			// 		],
			// 		"timestamp" => $timestamp
			// 	]
			// ]);
			// $client->channel->createMessage([
			// 	'channel.id' => intval($logchannel),
			// 	'content' => '',
			// 	'embed' => [
			// 		"author" => [
			// 			"name" => "Przyjęto raport",
			// 			"url" => "",
			// 			"icon_url" => "https://cdn.discordapp.com/emojis/555804149610971136.png?v=1"
			// 		],
			// 		"description" => '
			// 			» Typ: *Raport **
			// 			» Osoba: **'.$target['login'].'**
			// 			» Osoba Sprawdzająca: **['.$role['kod_roli'].''.$user['nr_sluzbowy'].'] '.$user['login'].'**
			// 		',
			// 		"color" => hexdec('#f6c23e'),
			// 		"footer" => [
			// 			"icon_url" => "https://cdn.discordapp.com/icons/645582261378613249/5d0deaffdc5531a405583b16f823d928.png?size=128",
			// 			"text" => "Powiadomienie z panelu!"
			// 		],
			// 		"timestamp" => $timestamp
			// 	]
			// ]);
			if($query){
				if($query1){
					if($log){
						$_SESSION['success'] = 'Sprawdzono Raport!';
						header('Location: ../../index.php?a=raporty-zarządzanie');
					} else {
						$_SESSION['danger'] = 'BŁĄD! Skontaktuj się z programistą!';
						header('Location: ../../index.php?a=raporty-zarządzanie');
					}
				} else {
					$_SESSION['danger'] = 'BŁĄD Skontaktuj się z programistą!';
					header('Location: ../../index.php?a=raporty-zarządzanie');
				}
			} else {
				$_SESSION['danger'] = 'BŁĄD Skontaktuj się z programistą!';
				header('Location: ../../index.php?a=raporty-zarządzanie');
			}
		}
	}
?>
