<?php

	require_once './funkcje/IP-user.php';
	function call($sql) { // Wywołanie zapytania do bazy
		global $con;
		$call = mysqli_query($con, $sql);

		if ($con->errno != 0)
		setcookie("last_err", $con->errno);

		return $call;
	}
	function row($sql) { // Funkcja wybierająca cały szereg danych jako tablica asocjacyjna
		global $con;
		return mysqli_fetch_assoc(mysqli_query($con, $sql));
	}

	function arr($sql) { // Funkcja wybierająca cały szereg danych jako zwykła tablica
		global $con;
		return mysqli_fetch_array(mysqli_query($con, $sql));
	}

	function vtxt($var) { // Funkcja zabezpieczająca dane wysyłane do bazy
		global $con;
		return trim(mysqli_real_escape_string($con, strip_tags($var)));
	}

	function avg($arr) { // Funkcja licząca średnią
		if (!is_array($arr))
			return false;
		return array_sum($arr) / count($arr);
	}

	function getUser($id) { // Funkcja wybierająca szereg danych o graczu z podanym ID
		return row("SELECT * FROM users WHERE id = ".(int)$id);
	}

	function socialSidebar() { // Funkcja wybierająca szereg danych o graczu z podanym ID
		echo '<div class="card">
			<div class="card-body">
				<p class="card-text"><i class="fab fa-youtube"></i><a href="https://www.youtube.com/channel/UCKdg6bL9Jr0e_C3FbA0QOrg"> Możesz nas spotkać na Youtubie</a></p>
				<p class="card-text"><i class="fab fa-facebook"></i><a href="https://www.facebook.com/witrualnepomorze"> Możesz nas spotkać na Facebooku</a></p>
				<p class="card-text"><i class="fab fa-instagram"></i><a href="https://www.instagram.com/wirtualne_pomorze/"> Możesz nas spotkać na Instagramie</a></p>
			</div>
		</div>';
	}

	function checkUser($sid) { // Funkcja weryfikująca stan gracza (czy zalogowany)
		if (empty($sid)){
			header("Location: index.php?a=login"); // Jeżeli puste ID sesji, przejście do strony logowania
		} else {
			$user = getUser($sid);
			if($user['deleted'] == 0){
				return $sid = (int)$sid; // Gdy ID sesji jest poprawne, zmiana lub utrzymanie stanu ID jako integer (postać numeryczna)
			} else {
				$_SESSION['danger'] = 'No nie ma tak kolego';
				header("Location: index.php?a=wyloguj"); // Jeżeli puste ID sesji, przejście do strony logowania
			}
		}
	}

	function checkStanowisko($sid) {
		$user = getUser($sid);
		if($user['stanowisko'] != 'Zarząd'){
			header('Location: ../../panel.php?a=wyloguj');
		};
	};

	function throwInfo($type, $msg, $dis = false) {
		$class = 'alert ';
		if ($dis)
			$class .= 'alert-dismissable ';
		if ($type == 'warning' || $type == 'danger' || $type == 'success' || $type == 'info')
			$class .= 'alert-'.$type;
		echo '
			<div class="'.$class.'">
		';
		if ($dis)
			echo '<button type="button" class="close" data-dismiss="alert">×</button>';
		echo '
				'.$msg.'
			</div>
		';
	}

	function box_info() {
		$targets = call("SELECT * FROM info");
		while ($row = mysqli_fetch_array($targets)){
			if($row['status'] == '1'){
				echo '<div class="alert alert-'.$row['kolor'].' alert-dismissible"><h5><i class="'.$row['ikona'].'"></i>'.$row['tytuł'].'</h5>'.$row['tresc'].'</div>' ;
			}else {
				echo '';
			}
		}
	}

	function usernick($id) {
		if (isset($id))
			$zapytanie = getUser($id);
		else
			$zapytanie = getUser($_SESSION['id']);

		if ($zapytanie['guild'] > 0){
			$guild = row("SELECT * FROM przewoznicy WHERE id = ".$zapytanie['guild']);
			return '<a href="panel.php?a=profile" class="d-block">['.$guild['tag'].'] '.$zapytanie['login'].' '.$zapytanie['id'].'</a>';
		}else{
			return '<a href="panel.php?a=profile" class="d-block">'.$zapytanie['login'].' '.$zapytanie['id'].'</a>';
		}
	}

	function ograniczenia() {
		if($ograniczenie['rekrutacja'] == '0' && $ograniczenie['przerwa techniczna'] != '1'){
			$rekrutacja = false;
			echo '<div class="alert alert-warning alert-dismissible"><h5><i class="icon fas fa-exclamation-triangle"></i>Brak Dostępu do Panelu</h5>Chwilowy brak możliwości Zalogowania się do systemu!</div>' ;
		}
	}

	function cookie_info() {
		if (empty($_COOKIE['cookies_enabled'])) {
			if (!empty($_GET['a'])) $link = '<a href="cookie.php?a='.$_GET['a'].'">'; else $link = '<a href="cookie.php">';
			echo '
			<div class="alert alert-dismissable alert-info">
				<button type="button" class="close" data-dismiss="alert">X</button>
				<h4>Uwaga!</h4>
				<p>Ta strona korzysta z "ciasteczek", czyli danych przechowywanych w Twojej przeglądarce.
				Jeżeli nie jesteś pewien co to oznacza, przeczytaj <a href="http://wszystkoociasteczkach.pl/polityka-cookies/"><b>Politykę prywatności Cookies</b></a>.<br/>
				Nie chcesz widzieć tego komunikatu? Kliknij '.$link.'<b>tutaj</b></a>.</p>
			</div>
			';
		}
	}

	function avatar($id) {
		if (isset($id)) {
			$zapytanie = getUser($id);
		} else {
			$zapytanie = getUser($_SESSION['id']);
		}
		if (isset($zapytanie['avatar']) && $zapytanie['avatar'] == 1){
			return '<img src="img/avatar/'.$zapytanie['id'].'.png" alt="" class="brand-image img-circle elevation-3" style="opacity: .8"/>';
		}else{
			return '<img src="img/avatar/avatar.png" alt="" class="brand-image img-circle elevation-3" style="opacity: .8"/>';
		}
	}
	//<img src="./dist/img/user2-160x160.jpg" class="user-image img-circle elevation-2" alt="User Image">

	function tabor_avatar($id) {
		if (isset($id)) {
			$zapytanie = row("SELECT id, avatar FROM tabor WHERE id = ".$id);
			if (isset($zapytanie['avatar']) && $zapytanie['avatar'] == 1) {
				return '<img class="img-fluid" style="max-height: 300px;" src="img/tabor-avatar/'.$zapytanie['id'].'.png" alt=""/>';
			} else {
				return '<img class="img-fluid" style="max-height: 300px;" src="img/tabor-avatar/avatar.png" alt=""/>';
			}
		}
	}

	function tabor_avatar_profile($id) {
		if (isset($id)) {
			$zapytanie = row("SELECT id, avatar FROM tabor WHERE id = ".$id);
			if (isset($zapytanie['avatar']) && $zapytanie['avatar'] == 1) {
				return '<img class="img-fluid" src="img/tabor-avatar/'.$zapytanie['id'].'.png" alt=""/>';
			}
		}
	}

	function sysMail($to, $title, $content, $type = false) {
		if (isset($to) && isset($title) && isset($content)) {
			if (!$type) {
				$to = (int)$to;
				$title = vtxt($title);
				$content = vtxt($content);
				call("INSERT INTO mail (from_id, to_id, type, title, content, date) VALUES (0, ".$to.", 1, '".$title."', '".$content."', now())");
			} elseif ($type == 'arena') {
				$mail = arena_template($content[0], $content[1]);
				call("INSERT INTO mail (from_id, to_id, type, title, content, date) VALUES (0, ".$to.", 1, '".$title."', '".$mail."', now())");
			}
		}
	}


	function niepojazdy($id){
		$query = call("SELECT tid FROM niepzrzdzielactabor WHERE uid=".$id);
		while ($while1 = mysqli_fetch_array($query)){
			$query2 = call("SELECT * FROM tabor WHERE id=".$while1['tid']);
			while ($while2 = mysqli_fetch_assoc($query2)){

				$niepojazdy = array(
					'id' => $while2['id'],
					'taborowy' => $while2['taborowy'],
					'marka' => $while2['marka'],
					'model' => $while2['model'],
					'nr_rejestracyjny' => $while2['nr_rejestracyjny'],
					'link' => $while2['link']
				);
				return $niepojazdy;
			}
			print_r($niepojazdy);
		}
	}



	function logi_logowanie_get(){
		$date = mktime(0, 0, 0, date("m"), date("d")-14, date("Y"));
		$kiedys = date('d.m.Y',$date);
		//echo $kiedys, ' ';
		$date1 = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
		$dzis = date('d.m.Y',$date1);
		//echo $dzis, ' ';
		$logi_logowania = call("SELECT * FROM logi_logowania WHERE data <= '".$date."'");
		if($logi_logowania->num_rows != 0){
			throwInfo('info', 'Wczytywanie danych panelu', true);
			$query = call("DELETE FROM logi_logowania WHERE data <= '".$date."'");
			if ($query){
				throwInfo('success', 'Poprawnie wczytano dane!', true);
			} else {

			}
			header('Refresh:1');
		}
	}

	function wnioski_o_prace_loading(){
		$date = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
		$dateformat = date("d.m.Y", mktime(0, 0, 0, date("m"), date("d"), date("Y")));
		$status1 = arr("SELECT * FROM aplikacje WHERE status = 1 AND data < '".$date."'");
		$status2 = arr("SELECT * FROM aplikacje WHERE status = 2 AND data < '".$date."'");
		$status3 = row("SELECT * FROM aplikacje WHERE status = 3 AND data < '".$date."'");
		$status4 = row("SELECT * FROM aplikacje WHERE status = 4");
		if($status1 || $status2 || $status3 || $status4){
			$query1 = call("DELETE FROM aplikacje WHERE id = '".$status1['id']."'");
			$query2 = call("DELETE FROM aplikacje WHERE id = '".$status2['id']."'");
			$query3 = call("DELETE FROM aplikacje WHERE id = '".$status3['id']."'");
			$query4 = call("DELETE FROM aplikacje WHERE id = '".$status4['id']."'");
			throwInfo('info', 'Wczytywanie Wniosków o Prace', true);
			header('Refresh:1');
		} else {
			//wnioski_o_prace();
		}
	}

	function ograniczenia_status($typ){
		$ograniczenia = call("SELECT * FROM ograniczenia");
		while($ograniczenie = mysqli_fetch_assoc($ograniczenia)){
			if($ograniczenie['typ'] == $typ){
				if($ograniczenie['status'] == '1'){
					return true;
				} else {
					if($ograniczenie['uid'] > 0){
						$kto = row("SELECT * FROM users WHERE id = ".$ograniczenie['uid']);
						$role_kto = row("SELECT * FROM rangi WHERE id = ".$kto['stanowisko']);
						$login = '['.$role_kto['kod_roli'].$kto['nr_sluzbowy'].'] '.$kto['login'].'';
						$text = '<a href="index.php?a=profile&p='.$kto['id'].'" style="color: '.$role_kto['kolor'].'">'.$login.'</a>';
					} else {
						$text = '<b>System Wirtualnego Pomorza</b>';
					}
					switch ($ograniczenie['kolor']) {
						case 'success': $icon = 'fas fa-check'; break;
						case 'danger': $icon = 'fas fa-ban'; break;
						case 'warning': $icon = 'fas fa-exclamation-triangle'; break;
						case 'info': $icon = 'fas fa-info-circle'; break;
						default:
							$icon = 'fas fa-question';
						break;
					}
					echo $message = '<div class="alert alert-'.$ograniczenie['kolor'].'" role="alert"><h5><i class="'.$icon.'"></i> <b>'.$ograniczenie['tytul'].'</b></h5>'.$ograniczenie['tresc'].'<hr><small class="mb-0">Poinformował '.$text.' w dniu '. $ograniczenie['data'].'</small></div>';
					return false;
				}
			}
		}
	}

	function ograniczenia_logout($user_id){
		$whitelist = row("SELECT * FROM whitelist_panel_logowanie WHERE uid = ".$user_id);
		$ograniczenie = row("SELECT * FROM ograniczenia WHERE typ = 'logowanie'");
		if($ograniczenie['status'] == '0'){
			if($whitelist){
				return true;
			} else {
				if(!empty($user_id)){
					require_once '../panel/funkcje/IP-user.php';
					$user = getUser($user_id);
					$get_ip = UserInfo::get_ip();
					$get_os = UserInfo::get_os();
					$get_browser = UserInfo::get_browser();
					$get_device = UserInfo::get_device();
					$dataczegos = mktime(date('H'), date('i'), date('s'), date('m'), date('d'), date('Y'));
					$log = call("INSERT INTO logi_logowania (uid, akcja, data, get_ip, get_os, get_browser, get_device) VALUES ('".$user['id']."', '[SYSTEM - Wyłączanie Panelu] Wylogowanie z Panelu', '".$dataczegos."', '".$get_ip."', '".$get_os."', '".$get_browser."', '".$get_device."')");
					$_SESSION = array(); // Czyszczenie sesji (nadpisanie czystą tablicą)
					session_destroy(); // Usuwanie aktywnej sesji
				}
			}
		} else {
			return false;
		}
	}

	function rekrutacja_status(){
		$ograniczenia = call("SELECT * FROM ograniczenia WHERE typ = 'info_rekrutacja' AND status = 1");
		while($ograniczenie = mysqli_fetch_assoc($ograniczenia)){
			$kto = row("SELECT * FROM users WHERE id = ".$ograniczenie['uid']);
			$role_kto = row("SELECT * FROM rangi WHERE id = ".$kto['stanowisko']);
			$login = '['.$role_kto['kod_roli'].$kto['nr_sluzbowy'].'] '.$kto['login'].'';
			echo $message = '<div class="alert alert-'.$ograniczenie['kolor'].'" role="alert"><h5><i class="'.$ograniczenie['ikona'].'"></i> <b>'.$ograniczenie['tytul'].'</b></h5>'.$ograniczenie['tresc'].'<hr><small class="mb-0">Poinformował <a href="index.php?a=profile&p='.$kto['id'].'" style="color: '.$role_kto['kolor'].'">'.$login.'</a> w dniu '. $ograniczenie['data'].'</small></div>';
		}
	}

	function whitelist_panel_logowanie(){

	}

	function raporty_refresh($user){
        $do_data = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
    	$od_data = mktime(0, 0, 0, date("m"), date("d")-2, date("Y"));
    	$jakas = call("SELECT * FROM raporty WHERE status = 0 AND status2 != 4 AND data_kursu <= ".$od_data."");
		//print_r($jakas);
		if($jakas->num_rows > 0){
			throwInfo('info', 'Wczytywanie Raportów', true);
			while($row = mysqli_fetch_array($jakas)){
				$rapn = $user['nieraporty'] + 1;
				$elo = call("UPDATE raporty SET status = 1, status2 = 3 WHERE id = ".$row['id']);
				$elo2 = call("UPDATE users SET nieraporty = '".$rapn."' WHERE id = '".$user['id']."'");
			}
			throwInfo('info', 'Poprawnie Wczytano Raporty', true);
		}
    }

	function pastebin_login(){
		$api_dev_key 		= 'VwMS_ZG4Z8YXvcRZsRHxTHwdp1E4zUVJ';
		$api_user_name 		= 'mtszwydra';
		$api_user_password 	= 'mnpq6o3dmnpq6o3d';
		$api_user_name 		= urlencode($api_user_name);
		$api_user_password 	= urlencode($api_user_password);
		$url			= 'https://pastebin.com/api/api_login.php';
		$ch			= curl_init($url);

		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, 'api_dev_key='.$api_dev_key.'&api_user_name='.$api_user_name.'&api_user_password='.$api_user_password.'');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
		curl_setopt($ch, CURLOPT_NOBODY, 0);

		$response 		= curl_exec($ch);
		echo $response;
	}

	function pastebin_create($text, $tytul){
		$api_user_key = pastebin_login();
		$api_dev_key 			= 'VwMS_ZG4Z8YXvcRZsRHxTHwdp1E4zUVJ'; // your api_developer_key
		$api_paste_code 		= $text; // your paste text
		$api_paste_private 		= '1'; // 0=public 1=unlisted 2=private
		$api_paste_name			= $tytul; // name or title of your paste
		$api_paste_expire_date 	= 'N';
		$api_paste_format 		= '';
		//$api_user_key 			= ''; // if an invalid or expired api_user_key is used, an error will spawn. If no api_user_key is used, a guest paste will be created
		$api_paste_name			= urlencode($api_paste_name);
		$api_paste_code			= urlencode($api_paste_code);

		$url 				= 'https://pastebin.com/api/api_post.php';
		$ch 				= curl_init($url);

		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, 'api_option=paste&api_user_key='.$api_user_key.'&api_paste_private='.$api_paste_private.'&api_paste_name='.$api_paste_name.'&api_paste_expire_date='.$api_paste_expire_date.'&api_paste_format='.$api_paste_format.'&api_dev_key='.$api_dev_key.'&api_paste_code='.$api_paste_code.'');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
		curl_setopt($ch, CURLOPT_NOBODY, 0);

		$response  			= curl_exec($ch);
		return $response;
	}

	function raporty_count_user($raport, $user){
        if($raport['typ'] == 'oczekuje'){
            $do_data = mktime(0,0,0, date('m'), date('d'), date('Y'));
            $od_data = mktime(0,0,0, date('m'), date('d')-2, date('Y'));
            $targets = row("SELECT count(id) AS id FROM raporty WHERE uid = ".$user['id']." AND status = 0 AND typ_kursu != 5 AND data_kursu >= ".$od_data." AND data_kursu <= $do_data");
            return $targets['id'];
        } elseif($raport['typ'] == 'zlozone'){
            $targets = row("SELECT count(id) AS id FROM raporty WHERE uid = ".$user['id']." AND status = 1 AND status2 != 3");
            return $targets['id'];
        } elseif($raport['typ'] == 'nie-zlozone'){
            $targets = row("SELECT count(id) AS id FROM raporty WHERE uid = ".$user['id']." AND status2 = 3 OR uid = ".$user['id']." AND status2 = 4");
            return $targets['id'];
        } elseif($raport['typ'] == 'nie-zlozone-uzytkownicy'){
            $targets = row("SELECT count(id) AS id FROM raporty WHERE uid = ".$user['id']." AND status2 = 3");
            return $targets['id'];
        } elseif($raport['typ'] == 'anulowane-uzytkownicy'){
            $targets = row("SELECT count(id) AS id FROM raporty WHERE uid = ".$user['id']." AND status2 = 4");
            return $targets['id'];
        } elseif($raport['typ'] == 'zaliczone-uzytkownicy'){
            $targets = row("SELECT count(id) AS id FROM raporty WHERE uid = ".$user['id']." AND status2 = 1");
            return $targets['id'];
        } elseif($raport['typ'] == 'niezaliczone-uzytkownicy'){
            $targets = row("SELECT count(id) AS id FROM raporty WHERE uid = ".$user['id']." AND status2 = 2");
            return $targets['id'];
        } elseif($raport['typ'] == 'zlozone-oczekuja-na-sprawdzenie-uzytkownicy'){
            $targets = row("SELECT count(id) AS id FROM raporty WHERE uid = ".$user['id']." AND status = 1 AND status2 = 0");
            return $targets['id'];
		} elseif($raport['typ'] == 'niezaliczone-i-niezlozone-home'){
            $targets = row("SELECT count(id) AS id FROM raporty WHERE uid = ".$user['id']." AND status2 = 2 OR uid = ".$user['id']." AND status2 = 3");
            return $targets['id'];
        } else {
			return 'Brak danych!';
		}
    }

	function raporty_info_count_user($typ, $user){
		if($typ == 'kilometry'){
			$zmienna = row("SELECT SUM(stanpierwszy) AS stanpierwszy FROM raporty WHERE uid = ".$user['id']." AND status = 1 AND status2 = 1");
			$zmienna1 = row("SELECT SUM(stanostatni) AS stanostatni FROM raporty WHERE uid = ".$user['id']." AND status = 1 AND status2 = 1");
			$stanpierwszy = round($zmienna['stanpierwszy'], 2);
			$stanostatni = round($zmienna1['stanostatni'], 2);
			return $kilometry = round($stanostatni - $stanpierwszy, 2);
		} elseif($typ == 'punkty'){
			$zmienna = row("SELECT SUM(punkty) AS suma_punktów FROM raporty WHERE uid = ".$user['id']."");
			if($zmienna['suma_punktów'] == 0){
				return 0;
			} else {
				return $zmienna['suma_punktów'];
			}
		} else {
			return 'Brak danych!';
		}
	}

	function getAllPermissionRole($role){
		$sql = call("SELECT * FROM role_in_permission WHERE rid = '".$role['id']."'");
		while ($row = mysqli_fetch_assoc($sql)) {
			$perm = row("SELECT * FROM permisje WHERE id = '".$row['pid']."'");
			print_r($perm);
		}
	}

	function hasPermissionTo($typ, $role, $perm){
		if($typ == 'security'){
			$perm = row("SELECT * FROM permisje WHERE nazwa = '".$perm."'");
			if($perm){
				$sql = row("SELECT * FROM role_in_permission WHERE pid = '".$perm['id']."' AND rid = '".$role['id']."'");
				if(!$sql){
					$_SESSION['warning'] = 'Nie masz uprawnień do wyświetlania tej podstrony. Ten incydent zostanie zgłoszony.';
					header('Location: index.php?a=wyloguj');
				}
			} else {
				$_SESSION['danger'] = 'Błąd uprawnień';
				header('Location: index.php?a=wyloguj');
			}
		} elseif($typ == 'return'){
			$perm = row("SELECT * FROM permisje WHERE nazwa = '".$perm."'");
			if($perm){
				$sql = row("SELECT * FROM role_in_permission WHERE pid = '".$perm['id']."' AND rid = '".$role['id']."'");
				if(!$sql){
					return false;
				}
				return true;
			} else {
				return false;
			}
		}
	}
?>
