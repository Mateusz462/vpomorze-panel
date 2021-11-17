<?php 
	require_once('../config/function.php'); // Pobranie pliku z funkcjami
	
	function wnioski_o_prace(){
		$targets = call("SELECT * FROM aplikacje ");
		if ($targets->num_rows == 0) {
			$result =
			'<div class="card-body">
				<div class="alert alert-warning">
					<h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
					Brak Wniosków o Prace!
				</div>
			</div>';
		} else {
			$result =
			'<thead >
				<tr >
					<th>Numer wniosku</th>
					<th>Email</th>
					<th>Stanowisko</th>
					<th>Data złożenia</th>
					<th>Status</th>
					<th>Opcje</th>
				</tr>
			</thead>
			<tbody >';
				$i = 1;
				while ($row = mysqli_fetch_array($targets)):
				if($row['status'] != 4){
					$dataczegos = date('d.m.Y', $row['data']);
				} else {
					$dataczegos = $row['data'];
				}
				$result .=
				'<tr>
					<td>'.$row['id'].'</td>
					<td>'.$row['email'].'</td>
					<td>'.$row['stanowisko'].'</td>
					<td>'.$dataczegos.'</td>';
					if($row['status'] == 0){
						$result .= '<td><b style="color: #cccc00">Oczekuje na sprawdzenie</b></td><td class="project-actions "><a href="index.php?a=wnioskioprace-zarządzanie&view='.$row['id'].'"><button type="button" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Wybierz</button></a></td>';
					} elseif($row['status'] == 1){
						$result .= '<td><b style="color: #ff0000">Nie przeszedł/a 1 etapu rekrutacji</b></td><td class="project-actions ">
						<a href="index.php?a=wnioskioprace-zarządzanie&view='.$row['id'].'"><button type="button" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Wybierz</button></a></td>';
					} elseif($row['status'] == 2){
						$result .= '<td><b style="color: #ffcc00">Przeszedł/a 1 etap rekrutacji oczekuje na rozmowe kwalifikacyjną</b></td><td class="project-actions">
						<a href="index.php?a=wnioskioprace-zarządzanie&view='.$row['id'].'"><button type="button" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Wybierz</button></a></td>';
					} elseif($row['status'] == 3){
						$result .= '<td><b style="color: #660000">Nie przeszedł/a 2 etapu rekrutacji</b></td><td class="project-actions ">
						<a href="index.php?a=wnioskioprace-zarządzanie&view='.$row['id'].'"><button type="button" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Wybierz</button></a></td>';
					} elseif($row['status'] == 4){
						$result .= '<td><b style="color: #009900">Przeszedł/a 2 etap rekrutacji ma już uprawnienia</b></td><td class="project-actions">
						<a href="index.php?a=wnioskioprace-zarządzanie&view='.$row['id'].'"><button type="button" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Wybierz</button></a></td>';
					}
					
				$result .= '</tr>';
				endwhile;
			$result .= '</tbody>';
		}
		echo $result;
	}
	
	
	function dodaj_user($login, $email, $pass, $stanowisko, $view){		
		if($stanowisko == 'Praktykant - Kierowca'){
			$stanowisko = '22';
		}elseif($target['stanowisko'] == 'Praktykant - Motorniczy'){
			$stanowisko = '21';
		}else{
			$_SESSION['danger'] = 'Błąd! Złe stanowisko! Spróbuj ponownie! lub Skontaktuj się z programistą!';
			header('Location: index.php?a=wnioskioprace-zarządzanie');
		}
		$dataczegos = date('d.m.Y');
		//$pass = vtxt($_POST['pass']);
		$hash = password_hash($pass, PASSWORD_BCRYPT);
		$query = call("INSERT INTO users (login, password, email, stanowisko, guild, zatrudnienie) VALUES ('".$login."', '".$hash."', '".$email."', '".$stanowisko."', '1', '".$dataczegos."')");
		if($query){
			$query1 = call("UPDATE aplikacje SET status = '2' WHERE id = ".$view);
			if($query1){
				$user_id = row("SELECT id FROM users WHERE email = ".$email);
				email_send($email, email_wnioski_o_prace_config($view, $pass));
				
				$_SESSION['success'] = 'Sukcess!';
				header('Location: index.php?a=wnioskioprace-zarządzanie');
				
			} else {
				$_SESSION['danger'] = 'Błąd! Przy usuwaniu wniosku o pracę! Skontaktuj się z programistą!';
				header('Location: index.php?a=wnioskioprace-zarządzanie');
			}
		}else {
			$_SESSION['danger'] = 'Błąd! Przy tworzeniu nowego konta! Skontaktuj się z programistą!';
			header('Location: index.php?a=wnioskioprace-zarządzanie');
		}
	}
	
	function odrzuc_wniosek_o_prace($view, $powod){
		$dataczegos = mktime(0, 0, 0, date("m"), date("d")+1, date("Y"));
		$query = call("UPDATE aplikacje SET status = '1', data = '".$dataczegos."', powod = '".$powod."' WHERE id = ".$view);
		if($query){
			$email = row("SELECT email FROM aplikacje WHERE id = ".$view);
			email_send($email['email'], email_wnioski_o_prace_config($view));
			
			$_SESSION['success'] = 'Sukcess!';
			header('Location: index.php?a=wnioskioprace-zarządzanie');
			
		} else {
			$_SESSION['danger'] = 'Błąd! Przy usuwaniu wniosku o pracę! Skontaktuj się z programistą!';
			header('Location: index.php?a=wnioskioprace-zarządzanie');
		}
	}
	
	function nieprzyjety_wniosek_o_prace($view){
		$dataczegos = mktime(0, 0, 0, date("m"), date("d")+1, date("Y"));
		$query = call("UPDATE aplikacje SET status = '3', data = '".$dataczegos."' WHERE id = ".$view);
		if($query){
			$email = row("SELECT email FROM aplikacje WHERE id = ".$view);	
			$query1 = row("SELECT * FROM users WHERE email = '".$email['email']."'");
			$query2 = call("DELETE FROM users WHERE id = '".$query1['id']."'");
			if($query2){			
				email_send($email['email'], email_wnioski_o_prace_config($view));
				$_SESSION['success'] = 'Sukcess!';
				header('Location: index.php?a=wnioskioprace-zarządzanie');
			} else {
				$_SESSION['danger'] = 'Błąd! Przy usuwaniu konta!';
				header('Location: index.php?a=wnioskioprace-zarządzanie');
			}
		} else {
			$_SESSION['danger'] = 'Błąd! Przy usuwaniu wniosku o pracę! Skontaktuj się z programistą!';
			header('Location: index.php?a=wnioskioprace-zarządzanie');
		}
	}
	
	function add_uprawnienia($view, $nr){
		
		$target = row("SELECT * FROM aplikacje WHERE id = ".$view);
		$targetus = row("SELECT * FROM users WHERE email = '".$target['email']."'");
		if(!$target){
			header('Location: index.php?a=home');
		} else {
			$dataczegos = date('d.m.Y',$target['data']);
		}
		
		if($target['stanowisko'] == 'Praktykant - Kierowca'){
			$stanowisko = '11';
			$typ = '1';
		}elseif($target['stanowisko'] == 'Praktykant - Motorniczy'){
			$stanowisko = '18';
			$typ = '2';
		}else{
			$_SESSION['danger'] = 'Błąd! Złe stanowisko! Spróbuj ponownie! lub Skontaktuj się z programistą!';
			header('Location: index.php?a=wnioskioprace-zarządzanie');
		}
		
		$dataczegos = date('d.m.Y');
		
		$query = call("UPDATE users SET dc = 0, nr_sluzbowy = '".$nr."', stanowisko = '".$stanowisko."' WHERE id=".$targetus['id']);
		if($query){
			$query1 = call("INSERT INTO etaty (uid, typ, poniedzialek, wtorek, sroda, czwartek, piatek, sobota, niedziela) VALUES ('".$targetus['id']."', '".$typ."', '".$target['pon']."', '".$target['wt']."', '".$target['sr']."', '".$target['czw']."', '".$target['pi']."', '".$target['sob']."', '".$target['niedz']."')");
			if($query1){
				$i = 1;
				for ($i = 1; $i < 5; $i++){
					echo $i, ' ';
					$query2 = call("INSERT INTO wnioski_permisje (uid, wid, przycisk) VALUES ('".$targetus['id']."', '".$i."', 1)");					
				}
				$query3 = call("UPDATE aplikacje SET status = '4', data = '".$dataczegos."' WHERE id = ".$view);
				email_send($targetus['email'], email_wnioski_o_prace_config($view));
				
				$_SESSION['success'] = 'Sukcess!';
				header('Location: index.php?a=wnioskioprace-zarządzanie');
				
			} else {
				$_SESSION['danger'] = 'Błąd! Przy ustawianiu etatu! Skontaktuj się z programistą!';
				header('Location: index.php?a=wnioskioprace-zarządzanie');
			}
		}else {
			$_SESSION['danger'] = 'Błąd! Przy tworzeniu nowego konta! Skontaktuj się z programistą!';
			header('Location: index.php?a=wnioskioprace-zarządzanie');
		}
	}
	
	function email_remember_wnioski_status2($login){
		$template_email = '../config/test.php';
		$email = file_get_contents($template_email, true);
		
		$tytul = 'Rekrutacja do Wirtualnego Pomorza';
		$username = $login;
		//$stanowisko = $data['stanowisko'];	
		$text = 'Przypominamy, twój wniosek o pracę został rozpatrzony <b>pozytywnie</b>, jednak aby dołączyć do Wirtualnego Pomorza, należy przejść pozytywnie <b>rozmowę kwalifikacyjną</b>.<br> Rozmowa zostanie przeprowadzona na serwerze rekrutacyjnym do którego dostajemy się <b>po autoryzacji konta Discord w panelu!</b><br>Jeżeli nie możesz się zalogować skontaktuj się bezpośrednio z naszym programistą [A-003] mateusz poprzez wysanie wiadomości prywatnej na Discordzie: <br>Nazwa użytkownika: <br><b>Inspekcja Transportu Drogowego#1911</b>. <br>Na przybycie na serwer rekrutacyjny i umówieniu rozmowy kwalifikacyjnej z rekruterem masz <b>24h</b><br>W przeciwnym wypadku twoja kandydatura zostaje <b>odrzucona</b>, a konto <b>usunięte</b><br><br>Z poważaniem,<br>System vPomorze';
		
		$variables = array(
			'{{tytul}}' => $tytul,
			'{{username}}' => $username,
			'{{tresc}}' => $text,
		);
		foreach($variables as $key => $value)
		$email = str_replace($key, $value, $email);
		echo $email;
		return $email;
	}
	
	function send_email_remember_wnioski_status2($target){
		while ($row = mysqli_fetch_array($target)){
			$login = $row['login'];
			$email = $row['email'];
			email_send($email, email_remember_wnioski_status2($login));
		}
	}