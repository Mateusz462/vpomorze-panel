	<div class="p-5">
		<p class="text-center"><img class="mx-auto element rounded-circle" src="../portal/img/WP-logo250.png" style="width: 125px"></p>
		<div class="text-center">
			<h1 class="h4 mb-4">Zmiana Hasła!</h1>
		</div>
		<?php	
			if (!empty($_POST)) {
				if (empty($_POST['login']) || empty($_POST['kod']) || empty($_POST['pass'])|| empty($_POST['pass2'])){
					throwInfo('danger', 'uzupelnij wszystkie pola', true);
				}else {
					$login = vtxt($_POST['login']);
					$kod = vtxt($_POST['kod']);
					$pass = vtxt($_POST['pass']);
					$pass2 = vtxt($_POST['pass2']);
					
					/* $kod_dostepu = 'CXR26cYWeu';//remek
					$kod_dostepu = 'G4g2B8fy6J';//ohio
					$kod_dostepu = 'QfkkdP9jGR';//TheLol18000
					$kod_dostepu = 'ectU4vvoy5';//Tragar
					$kod_dostepu = 'vN9cJoeXFa';//mateusz
					$kod_dostepu = 'sv3Z8bMLyT';//Michau
					$kod_dostepu = 'sttYCaEEa7';//Solbino */
					/* if($login == 'Remek'){
						if($kod != 'CXR26cYWeu'){
							throwInfo('danger', 'kod dostepu zlyyyyy!', true);
						}else{
							if (strlen($pass) < 6 || strlen($pass) > 20){
								throwInfo('danger', 'Hasło nie mieści się w danym zakresie!', true);
							}elseif ($pass != $pass2){
								throwInfo('danger', 'Podane hasła nie zgadzają się!', true);
							}else {
								$hash = password_hash($pass, PASSWORD_BCRYPT);
								call("UPDATE users SET password = '".$hash."' WHERE login = '".$login."'");
								//call("INSERT INTO users (login, password, email, stanowisko, guild, zarząd) VALUES ('".$login."', '".$pass."', '".$email."', '".$stanowisko."', '".$zajezdnia."', '".$zarzad."')");
								header('Location: index.php?a=login');
								
							}
						}
					} */
					/* if($login == 'BlaiD'){
						if($kod != '73ce77ac35c7c0cacc8e79c5cdc5269b'){
							throwInfo('danger', 'kod dostepu zlyyyyy!', true);
						}else{
							if (strlen($pass) < 6 || strlen($pass) > 20){
								throwInfo('danger', 'Hasło nie mieści się w danym zakresie!', true);
							}elseif ($pass != $pass2){
								throwInfo('danger', 'Podane hasła nie zgadzają się!', true);
							}else {
								$hash = password_hash($pass, PASSWORD_BCRYPT);
								call("UPDATE users SET password = '".$hash."' WHERE login = '".$login."'");
								//call("INSERT INTO users (login, password, email, stanowisko, guild, zarząd) VALUES ('".$login."', '".$pass."', '".$email."', '".$stanowisko."', '".$zajezdnia."', '".$zarzad."')");
								header('Location: index.php?a=login');
								
							}
						}
					} */
/* 					elseif($login == 'TheLol18000'){
						if($kod != 'QfkkdP9jGR'){
							throwInfo('danger', 'kod dostepu zlyyyyy!', true);
						}else{
							if (strlen($pass) < 6 || strlen($pass) > 20){
								throwInfo('danger', 'Hasło nie mieści się w danym zakresie!', true);
							}elseif ($pass != $pass2){
								throwInfo('danger', 'Podane hasła nie zgadzają się!', true);
							}else {
								$hash = password_hash($pass, PASSWORD_BCRYPT);
								call("UPDATE users SET password = '".$hash."' WHERE login = '".$login."'");
								//call("INSERT INTO users (login, password, email, stanowisko, guild, zarząd) VALUES ('".$login."', '".$pass."', '".$email."', '".$stanowisko."', '".$zajezdnia."', '".$zarzad."')");
								header('Location: index.php?a=login');
								
							}
						}
					} */
					/* elseif($login == 'Tragar'){
						if($kod != 'ectU4vvoy5'){
							throwInfo('danger', 'kod dostepu zlyyyyy!', true);
						}else{
							if (strlen($pass) < 6 || strlen($pass) > 20){
								throwInfo('danger', 'Hasło nie mieści się w danym zakresie!', true);
							}elseif ($pass != $pass2){
								throwInfo('danger', 'Podane hasła nie zgadzają się!', true);
							}else {
								$hash = password_hash($pass, PASSWORD_BCRYPT);
								call("UPDATE users SET password = '".$hash."' WHERE login = '".$login."'");
								//call("INSERT INTO users (login, password, email, stanowisko, guild, zarząd) VALUES ('".$login."', '".$pass."', '".$email."', '".$stanowisko."', '".$zajezdnia."', '".$zarzad."')");
								header('Location: index.php?a=login');
								
							}
						}
					} */
					/* elseif($login == 'mateusz'){
						if($kod != 'vN9cJoeXFa'){
							throwInfo('danger', 'kod dostepu zlyyyyy!', true);
						}else{
							if (strlen($pass) < 6 || strlen($pass) > 20){
								throwInfo('danger', 'Hasło nie mieści się w danym zakresie!', true);
							}elseif ($pass != $pass2){
								throwInfo('danger', 'Podane hasła nie zgadzają się!', true);
							}else {
								$hash = password_hash($pass, PASSWORD_BCRYPT);
								call("UPDATE users SET password = '".$hash."' WHERE login = '".$login."'");
								//call("INSERT INTO users (login, password, email, stanowisko, guild, zarząd) VALUES ('".$login."', '".$pass."', '".$email."', '".$stanowisko."', '".$zajezdnia."', '".$zarzad."')");
								header('Location: index.php?a=login');
								
							}
						}
					} */
					/* elseif($login == 'Michau'){
						if($kod != 'sv3Z8bMLyT'){
							throwInfo('danger', 'kod dostepu zlyyyyy!', true);
						}else{
							if (strlen($pass) < 6 || strlen($pass) > 20){
								throwInfo('danger', 'Hasło nie mieści się w danym zakresie!', true);
							}elseif ($pass != $pass2){
								throwInfo('danger', 'Podane hasła nie zgadzają się!', true);
							}else {
								$hash = password_hash($pass, PASSWORD_BCRYPT);
								call("UPDATE users SET password = '".$hash."' WHERE login = '".$login."'");
								//call("INSERT INTO users (login, password, email, stanowisko, guild, zarząd) VALUES ('".$login."', '".$pass."', '".$email."', '".$stanowisko."', '".$zajezdnia."', '".$zarzad."')");
								header('Location: index.php?a=login');
								
							}
						}
					} */
					if($login == 'testnieusuwac'){
						if($kod != 'sttYCaEEa7'){
							throwInfo('danger', 'kod dostepu zlyyyyy!', true);
						}else{
							if (strlen($pass) < 6 || strlen($pass) > 20){
								throwInfo('danger', 'Hasło nie mieści się w danym zakresie!', true);
							}elseif ($pass != $pass2){
								throwInfo('danger', 'Podane hasła nie zgadzają się!', true);
							}else {
								$hash = password_hash($pass, PASSWORD_BCRYPT);
								call("UPDATE users SET password = '".$hash."' WHERE login = '".$login."'");
								//call("INSERT INTO users (login, password, email, stanowisko, guild, zarząd) VALUES ('".$login."', '".$pass."', '".$email."', '".$stanowisko."', '".$zajezdnia."', '".$zarzad."')");
								header('Location: index.php?a=login');
								
							}
						}
					}
					
					
				}
			}
			
		?>
		<form class="user" action="index.php?a=password" method="POST">
			<div class="form-group row">	
				<div class="col-sm-6 mb-3 mb-sm-0">
					<input type="text" class="form-control form-control-user" id="exampleFirstName"
						placeholder="Login" name="login">
				</div>
				<div class="col-sm-6">
					<input type="text" class="form-control form-control-user" id="exampleLastName"
						placeholder="kod dostepu" name="kod">
				</div>
			</div>
			<div class="form-group row">
				<div class="col-sm-6 mb-3 mb-sm-0">
					<input type="password" class="form-control form-control-user"
						id="exampleInputPassword" placeholder="pass" name="pass">
				</div>
				<div class="col-sm-6">
					<input type="password" class="form-control form-control-user"
						id="exampleRepeatPassword" placeholder="pass2" name="pass2">
				</div>
			</div>
			
			<button type="submit" class="btn btn-primary btn-user btn-block">Zatwierdz</button>
		</form>
		<hr>
		<div class="text-center">
			<a class="small" href="index.php?a=login"><button type="submit" class="btn btn-primary btn-user btn-block">Logowanie</button></a>
		</div>
	</div>