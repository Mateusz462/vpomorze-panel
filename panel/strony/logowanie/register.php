	<div class="p-5">
		<p class="text-center"><img class="mx-auto element rounded-circle" src="../portal/img/WP-logo250.png" style="width: 125px"></p>
		<div class="text-center">
			<h1 class="h4 mb-4">Create an Account!</h1>
		</div>
		<?php	
			if (!empty($_POST)) {
				if (empty($_POST['login']) || empty($_POST['kod']) || empty($_POST['pass'])|| empty($_POST['pass2'])|| empty($_POST['stanowisko']) || empty($_POST['zajezdnia']) || empty($_POST['email'])){
					throwInfo('danger', 'uzupelnij wszystkie pola', true);
				}else {
					$login = vtxt($_POST['login']);
					$email = vtxt($_POST['email']);
					$kod = vtxt($_POST['kod']);
					$pass = vtxt($_POST['pass']);
					$pass2 = vtxt($_POST['pass2']);
					$stanowisko = vtxt($_POST['stanowisko']);
					$zajezdnia = vtxt($_POST['zajezdnia']);
					
					$kod_dostepu = 'Uh3WhHXwTRkc3BpUaNEWzxJTsDF9KJfZHqZR62yWzCmj9xfTrs';
					
					if (strlen($login) < 3 || strlen($login) > 25)
						throwInfo('danger', 'Login nie mieści się w danym zakresie!', true);
					elseif (strlen($pass) < 6 || strlen($pass) > 20)
						throwInfo('danger', 'Hasło nie mieści się w danym zakresie!', true);
					elseif (strlen($email) < 8 || strlen($email) > 50)
						throwInfo('danger', 'Adres email nie mieści się w danym zakresie!', true);
					elseif ($login == $pass)
						throwInfo('danger', 'Login nie może być taki sam jak hasło!', true);
					elseif ($pass != $pass2)
						throwInfo('danger', 'Podane hasła nie zgadzają się!', true);
					elseif (!ctype_alnum($login))
						throwInfo('danger', 'Login zawiera niedozwolone znaki!', true);
					elseif ($kod != $kod_dostepu)
						throwInfo('danger', 'nie tak latwo kod dostepu zlyyyyy!', true);
					elseif (filter_var($email, FILTER_VALIDATE_EMAIL) == false)
						throwInfo('danger', 'To nie jest poprawny adres email!', true);

					else {
						$istnieje = row("SELECT id FROM users WHERE login = '".$login."' OR email = '".$email."'");
						if ($istnieje) {
							throwInfo('danger', 'Istnieje już gracz o takim samym loginie lub adresie email!', true);
						} else {
							if($stanowisko == '1'  || '2' || '3' || '4' || '5' || '6' || '7' || '8' || '9' || '16' || '17'){
								$zarzad == '1';
							} else {
								$zarzad == '0';
							}
							
							$hash = password_hash($pass, PASSWORD_BCRYPT);
							call("INSERT INTO users (login, password, email, stanowisko, guild, zarząd) VALUES ('".$login."', '".$hash."', '".$email."', '".$stanowisko."', '".$zajezdnia."', '".$zarzad."')");
							header('Location: index.php?a=login');
						}
					}
				}
			}
			
		?>	
			<form class="user" action="index.php?a=register" method="POST">
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
				<div class="form-group">
					<input type="email" class="form-control form-control-user" id="exampleInputEmail"
						placeholder="Email Address" name="email">
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
				<div class="form-group">
					<select id="stanowisko" name="stanowisko" class="form-control">
						<option value="">--- Wybierz Swoją Najwyższą Rangę ---</option>
						
						
					</select>	
				</div>
				<div class="form-group">
					<select id="zajezdnia" name="zajezdnia" class="form-control">
						<option value="">--- Wybierz Przewoźnika ---</option>
						<?php $zajezdnia = call("SELECT * FROM przewoznicy");
						while ($row = mysqli_fetch_array($zajezdnia)):;?>
						<option value="<?php echo $row['id'];?>"><?php echo $row['nazwa'];?></option>
						<?php endwhile;?>
					</select>	
				</div>
				<button type="submit" class="btn btn-primary btn-user btn-block">Zatwierdz</button>
			</form>
			<hr>
		<hr>
		<div class="text-center">
			<a class="small" href="index.php">nie kilikaj</a>
		</div>
		<div class="text-center">
			<a class="small" href="index.php">Tu tez nie</a>
		</div>
	</div>