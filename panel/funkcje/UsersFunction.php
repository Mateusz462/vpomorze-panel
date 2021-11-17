<?php
	function user_anuluj_raporty_count($user){
		$anuluj_raporty = row("SELECT count(id) AS id FROM raporty WHERE uid = ".$user['id']." AND typ_kursu = 5");
		return $anuluj_raporty['id'];
	}


	function awans_user($id, $nr, $stanowisko, $zarzad, $sid){
		$suser = row("SELECT * FROM users WHERE id = '".$sid."'");
		$uuser = row("SELECT * FROM users WHERE id = '".$id."'");
		$query = call("UPDATE users SET nr_sluzbowy = '".$nr."', stanowisko = '".$stanowisko."', zarząd = '".$zarzad."' WHERE id = '".$id."'");
		if($stanowisko == 11 || $stanowisko == 19){
			$typ = 1;
		} elseif($stanowisko == 18 || $stanowisko == 20){
			$typ = 2;
		} else {
			$typ = 0;
		}
		if($query){
			$log = call("INSERT INTO logi (uid, akcja) VALUES ('".$suser['id']."', 'Użytkownik ".$suser['login']." Zmienił Numer Służbowy/Stanowisko/Zarząd Użytkownikowi o ID: ".$id."')");
			if($log){
				$query1 = call("UPDATE etaty SET typ = '".$typ."' WHERE uid = '".$id."'");
				if($query1){
					$log1 = call("INSERT INTO logi (uid, akcja) VALUES ('".$suser['id']."', 'Użytkownik ".$suser['login']." Zmienił typ etatu Użytkownikowi o ID: ".$id."')");
					if($log1){
						$_SESSION['success'] = 'Sukcess!';
						return header('Refresh: 1');
					} else {
						return $_SESSION['danger'] = 'Błąd! Przy zapisywaniu akcji! Skontaktuj się z programistą!';
					}
				} else {
					return $_SESSION['danger'] = 'Błąd! Przy zapisywaniu danych! Skontaktuj się z programistą!';
				}
			} else {
				return $_SESSION['danger'] = 'Błąd! Przy zapisywaniu akcji! Skontaktuj się z programistą!';
			}
		} else {
			return $_SESSION['danger'] = 'Błąd! Przy edytowaniu konta! Skontaktuj się z programistą!';
		}
	}

	function zwolnij_user($id, $data, $powod, $sid){
		$suser = row("SELECT * FROM users WHERE id = '".$sid."'");
		$uuser = row("SELECT * FROM users WHERE id = '".$id."'");
		$query = call("UPDATE users SET	deleted = 1, data_usuniecia = '".$data."', stanowisko = 25 WHERE id = '".$id."'");
		if($query){
			$data = mktime(date('H'), date('i'), date('s'), date('m'), date('d'), date('Y'));
			$query1 = call("INSERT INTO users_banned (uid, sid, data, powod) VALUES ('".$id."', '".$sid."', '".$data."', '".$powod."')");
			if($query1){
				$daneformularza = array(
					'typ' => 'zwolnienie-dyscyplinarne',
					'powod' => $powod
				);
				email_send($uuser['email'], email_config($daneformularza, $uuser));

				$log = call("INSERT INTO logi (uid, akcja) VALUES ('".$suser['id']."', 'Użytkownik ".$suser['login']." Zmienił Numer Służbowy/Stanowisko/Zarząd Użytkownikowi o ID: ".$id."')");
				if($log){
					$_SESSION['success'] = 'Sukcess!';
					return header('Refresh: 1');
				} else {
					return $_SESSION['danger'] = 'Błąd! Przy zapisywaniu akcji! Skontaktuj się z programistą!';
				}
			} else {
				return $_SESSION['danger'] = 'Błąd! Przy zapisywaniu akcji blokowania! Skontaktuj się z programistą!';
			}
		} else {
			return $_SESSION['danger'] = 'Błąd! Przy blokowaniu konta! Skontaktuj się z programistą!';
		}
	}
?>
