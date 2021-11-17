<?php
	session_start(); // Rozpoczynamy lub przedłużamy pracę sesji
	require_once('../../../config/connect.php'); // Połączenie z bazą danych
	require_once('../../../config/function.php'); // Pobranie pliku z funkcjami
	require_once('./../../API/vendor/autoload.php');
	require_once('./../../API/config.php');
	use RestCord\DiscordClient;
	$client = new DiscordClient(['token' => $bottoken]); // Token is required


	if (!empty($_POST)) {
		if (empty($_POST['pierwszy']) || empty($_POST['ostatni']) || empty($_POST['stanpierwszy']) || empty($_POST['stanostatni']) ) {
			$id = vtxt($_POST['id']);
			$_SESSION['danger'] = 'Wypełnij wszystkie pola!';
			throwInfo('danger', 'Wypełnij wszystkie pola!', true);
			header('Location: ../../index.php?a=raporty&add='.$id);
		} else {
			$id = vtxt($_POST['id']);
			$pierwszy = vtxt($_POST['pierwszy']);
			$ostatni = vtxt($_POST['ostatni']);
			$stanpierwszy = vtxt($_POST['stanpierwszy']);
			$stanostatni = vtxt($_POST['stanostatni']);
			$uwagi = vtxt($_POST['uwagi']);
			$av = $_FILES['statystyka'];
			$type = $av['type'];
			$size = $av['size'];

			$pname = rand(0,10000).'-'.$_FILES['statystyka']['name'];
			$tname = $_FILES['statystyka']['tmp_name'];
			$uploads_dir = '../../dist/dokumenty';

			$timestamp = date("Y-m-d H:i:s");

			if ($size > 5000){
				$_SESSION['danger'] = 'Wrzucany plik musi ważyć mniej niż 5kB!';
				header('Location: ../../index.php?a=raporty');
			}elseif (!is_uploaded_file($tname)){
				$_SESSION['danger'] = 'Wystąpił błąd podczas wysyłania pliku!';
				header('Location: ../../index.php?a=raporty');
			}elseif (!move_uploaded_file($tname, $uploads_dir.'/'.$pname)){
				$_SESSION['danger'] = 'Wystąpił błąd podczas przenoszenia pliku!';
				header('Location: ../../index.php?a=raporty');
			}else {

				$log = call("INSERT INTO logi (uid, akcja) VALUES ('".$user['id']."', 'Użytkownik ".$user['login']." złożył raport!')");
				$client->channel->createMessage([
					'channel.id' => intval($pushchannel),
					'content' => '<@&826162656754794496>',
					'embed' => [
						"author" => [
							"name" => "Złożono raport",
							"url" => "",
							"icon_url" => "https://cdn.discordapp.com/emojis/732618937446957096.png?v=1"
						],
						"description" => '
							» Osoba: **['.$role['kod_roli'].''.$user['nr_sluzbowy'].'] '.$user['login'].'**
							» Typ: **dshfkuahsfk**
							» Powód: **asfdsdf**
						',
						"color" => hexdec('#f6c23e'),
						"footer" => [
							"icon_url" => "https://cdn.discordapp.com/icons/645582261378613249/5d0deaffdc5531a405583b16f823d928.png?size=128",
							"text" => "Powiadomienie z panelu!"
						],
						"timestamp" => $timestamp
					]
				]);
				$client->channel->createMessage([
					'channel.id' => intval($logchannel),
					'content' => '',
					'embed' => [
						"author" => [
							"name" => "Złożono raport",
							"url" => "",
							"icon_url" => "https://cdn.discordapp.com/emojis/732618937446957096.png?v=1"
						],
						"description" => '
							**['.$role['kod_roli'].''.$user['nr_sluzbowy'].'] '.$user['login'].'** Złożył raport
						',
						"color" => hexdec('#f6c23e'),
						"footer" => [
							"icon_url" => "https://cdn.discordapp.com/icons/645582261378613249/5d0deaffdc5531a405583b16f823d928.png?size=128",
							"text" => "Logi panelu"
						],
						"timestamp" => $timestamp
					]
				]);

				$elo = call("UPDATE raporty SET uwagi = '".$uwagi."', link1 = '".$pierwszy."', link2 = '".$ostatni."', stanpierwszy = '".$stanpierwszy."', stanostatni = '".$stanostatni."', statystyka = '".$pname."', status = 1 WHERE id = '".$id."'");
				if($elo){
					$_SESSION['success'] = 'Złożono Raport!';
					header('Location: ../../index.php?a=raporty');
				} else {
					$_SESSION['danger'] = 'BŁĄD Skontaktuj się z programistą!';
					header('Location: ../../index.php?a=raport');
				}
			}

		}
	}
?>
