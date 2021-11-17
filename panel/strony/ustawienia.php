<?php
	require_once "dist/themapart/alerts.php";
	hasPermissionTo('security', $user_role, 'access_ustawienia_user');
?>


	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Ustawienia Użytkownika</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="index.php">Panel Kierowcy</a></li>
						<li class="breadcrumb-item active">Ustawienia Użytkownika</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>

	<section class="content">
		<div class="container-fluid">
			<!-- Main row -->
			<div class="row">
				<div class="col-4">
					<div class="card shadow mb-4">
						<div class="card-header">
							<h3 class="m-0 font-weight-bold text-primary">Zmiana hasła</h3>
						</div>
						<div class="card-body">
							<?php
								if (!empty($_POST)) {
									if (isset($_GET['b']) && $_GET['b'] == 'password') {
										if (empty($_POST['pass']) || empty($_POST['pass1']) || empty($_POST['pass2'])){
											throwInfo('danger', 'Wypełnij wszystkie pola poprawnie!', true);
										}else {
											$pass = vtxt($_POST['pass']);
											$pass1 = vtxt($_POST['pass1']);
											$pass2 = vtxt($_POST['pass2']);
											$passwordHash = password_hash($pass, PASSWORD_BCRYPT);
											$verfiy = password_verify($pass, $passwordHash); //zwraca true gdy sobie odpowiadają tak jak w tym przypadku
											if (!$verfiy){
												throwInfo('danger', 'Podane aktualne hasło jest nieprawidłowe', true);
											}elseif (strlen($pass1) < 6 || strlen($pass1) > 20){
												throwInfo('danger', 'Hasło nie mieści się w danym zakresie', true);
											}elseif ($pass == $pass1){
												throwInfo('danger', 'Nowe hasło nie może być takie same jak stare!', true);
											}elseif ($pass1 != $pass2){
												throwInfo('danger', 'Podane hasła nie zgadzają się!', true);
											}elseif ($user['login'] == $pass1){
												throwInfo('danger', 'Login nie może być taki sam jak hasło', true);
											}else {
												$passwordHash = password_hash($pass1, PASSWORD_BCRYPT);
												$query = call("UPDATE users SET password = '".$passwordHash."' WHERE id = ".$user['id']);
												if (!$query){
													throwInfo('danger', 'Wystąpił błąd podczas zmiany hasła', true);
												}else{
													throwInfo('success', 'Zmieniono hasło', true);
													header('Refresh:1');
												}
											}
										}
									}
								}
							?>
							<form action="index.php?a=ustawienia-użytkownika&b=password" method="POST">
								<div class="form-group">
									<label>Stare Hasło</label>
									<input type="password" name="pass" class="form-control" placeholder="Stare hasło">
								</div>
								<div class="form-group">
									<label>Nowe Hasło</label>
									<input type="password" name="pass1" class="form-control" placeholder="Nowe hasło">
								</div>
								<div class="form-group">
									<label>Powtórz Nowe Hasło</label>
									<input type="password" name="pass2" class="form-control" placeholder="Powtórz nowe hasło">
								</div>
								<button type="submit" class="btn btn-primary btn-block">Zatwierdz</button>
							</form>
						</div>
					  <!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
				<div class="col-4">
					<div class="card shadow mb-4">
						<div class="card-header">
							<h3 class="m-0 font-weight-bold text-primary">Zmiana adresu e-mail</h3>
						</div>
						<div class="card-body">
							<?php
								if (!empty($_POST)) {
									if (isset($_GET['b']) && $_GET['b'] == 'email') {
										if (empty($_POST['email']) || empty($_POST['pass']))
											throwInfo('danger', 'Wypełnij wszystkie pola poprawnie!', true);
										else {
											$mail = vtxt($_POST['email']);
											$pass = vtxt($_POST['pass']);
											$passwordHash = password_hash($pass, PASSWORD_BCRYPT);
											$verfiy = password_verify($pass, $passwordHash); //zwraca true gdy sobie odpowiadają tak jak w tym przypadku
											if (!$verfiy){
												throwInfo('danger', 'Podane aktualne hasło jest nieprawidłowe', true);
											}elseif (filter_var($mail, FILTER_VALIDATE_EMAIL) == false){
												throwInfo('danger', 'Podany ciąg nie jest adresem email', true);
											}elseif (strlen($mail) < 8 || strlen($mail) > 50){
												throwInfo('danger', 'Adres email nie mieści się w danym zakresie', true);
											}else {
												$query = call("UPDATE users SET email = '".$mail."' WHERE id = ".$user['id']);
												if (!$query){
													throwInfo('danger', 'Wystąpił błąd podczas zmiany adresu', true);
												}else{
													throwInfo('success', 'Zmieniono adres email', true);
													header('Refresh:1');
												}
											}
										}
									}
								}
							?>
							<form action="index.php?a=ustawienia-użytkownika&b=email" method="POST">
								<div class="form-group">
									<label>Aktualne Hasło</label>
									<input type="password" name="pass" class="form-control" placeholder="Aktualne hasło">
								</div>
								<div class="form-group">
									<label>Nowy adres e-mail</label>
									<input type="email" name="email" class="form-control" placeholder="Nowy adres e-mail">
								</div>
								<button type="submit" class="btn btn-primary btn-block">Zatwierdz</button>
							</form>
						</div>
					  <!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
				<div class="col-4">
					<div class="card shadow mb-4">
						<div class="card-header">
							<h3 class="m-0 font-weight-bold text-primary">Integracja Discord</h3>
						</div>
						<div class="card-body">
							<?php

								if($user['dc'] == '1'){
									throwInfo('success', 'Połączono konto <b>'.$user_discord['username'].'#'.$user_discord['discriminator'].'</b> z panelem! <br> Możesz już korzystać z naszego serwera! <a href="https://discord.com/channels/@me">Przejdź na discorda</a>', false);
									throwInfo('warning', 'Uwaga! Jeżeli nie masz dostępu do tego konta a chcesz dalej korzystać z naszego serwera discord, skontaktuj się z Prezesem lub Administratorem firmy', false);
								}else{
									throwInfo('danger', 'Nie Połączono konta z panelem! <br> Aby móc korzystać z naszego serwera discord kliknij <a href="https://wirtualne-pomorze.pl/panel/index.php?a=oauth2.php">tutaj</a>', false);
								}
							?>
						</div>
					  <!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>

			</div>
		</div>
	</section>
