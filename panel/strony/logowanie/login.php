	<div class="p-5">
		<p class="text-center"><img class="mx-auto element rounded-circle" src="../portal/img/WP-logo250.png" style="width: 125px"></p>
		<div class="text-center">
			<h1 class="h4 mb-4">Zaloguj się do panelu!</h1>
		</div>
		<?php
			ograniczenia_status('info-logowanie');
			if (isset($_SESSION['danger']))
			{
				echo throwInfo('danger', $_SESSION['danger'], true);
				unset($_SESSION['danger']);
			}
			if (isset($_SESSION['success']))
			{
				echo throwInfo('success', $_SESSION['success'], true);
				unset($_SESSION['success']);
			}
			if (isset($_SESSION['info']))
			{
				echo throwInfo('info', $_SESSION['info'], true);
				unset($_SESSION['info']);
			}
			if (isset($_SESSION['warning']))
			{
				echo throwInfo('warning', $_SESSION['warning'], true);
				unset($_SESSION['warning']);
			}
//456226577798135808
//Deleted User df4c277e#5708
			$logowanie = true;
			if(!empty($_POST)){
				if (empty($_POST['login']) && empty($_POST['pass'])){
					throwInfo('danger', 'Wypełnij wszystkie pola!', true);
				} else {
					$login = vtxt($_POST['login']);
					$pass = vtxt($_POST['pass']);
					$hash = password_hash($pass, PASSWORD_BCRYPT);
					if (!ctype_alnum($login)){
						throwInfo('danger', 'Niepoprawna nazwa użytkownika', true);
					} else {
						$user_login = row("SELECT * FROM users WHERE login = '".$login."'");
						if(!$user_login){
							throwInfo('danger', 'Taki użytkownik nie istnieje', true);
						} else {
							$haslo = password_verify($pass, $user_login['password']); //zwraca true gdy sobie odpowiadają tak jak w tym przypadku
							if(!$haslo){
								throwInfo('danger', 'Nieprawidłowe hasło', true);
							} else {
								$get_ip = UserInfo::get_ip();
								$get_os = UserInfo::get_os();
								$get_browser = UserInfo::get_browser();
								$get_device = UserInfo::get_device();
								$dataczegos = mktime(date('H'), date('i'), date('s'), date('m'), date('d'), date('Y'));
								$log = call("INSERT INTO logi_logowania (uid, akcja, data, get_ip, get_os, get_browser, get_device) VALUES ('".$user_login['id']."', 'Logowanie do Panelu', '".$dataczegos."', '".$get_ip."', '".$get_os."', '".$get_browser."', '".$get_device."')");
								$_SESSION = array();
								$_SESSION['id'] = $user_login['id'];

								throwInfo('success', 'Witaj <b>'.$user_login['login'].'</b> zostaniesz za chwilę przeniesiony do strony głównej panelu!', true);

								if($user_login['deleted'] == 1){
									//header('Location: ./index.php?a=login');
									$block_user = row("SELECT * FROM users_banned WHERE uid = '".$user_login['id']."'");
									if($block_user){
										$kto = row("SELECT * FROM users WHERE id = ".$block_user['sid']);
										$role_kto = row("SELECT * FROM rangi WHERE id = ".$kto['stanowisko']);
										$login = '['.$role_kto['kod_roli'].$kto['nr_sluzbowy'].'] '.$kto['login'].'';
										$data = date("d.m.Y H:i", $block_user['data']);
										echo $message = '<div class="alert alert-danger" role="alert"><h5><i class="fas fa-ban"></i> <b>Brak Dostępu do Panelu!</b></h5>Witaj <b>'.$user_login['login'].'</b>!<br>Nie udało ci się zalogować do panelu z powodu:<br><b>Powód:</b> '.$block_user['powod'].'<hr><small class="mb-0">Poinformował <a href="index.php?a=profile&p='.$kto['id'].'" style="color: '.$role_kto['kolor'].'">'.$login.'</a> w dniu '. $data.'</small></div>';
									} else {
										$data = date("d.m.Y H:i", mktime(0, 0, 0, date("m")  , date("d"), date("Y")));
										echo $message = '<div class="alert alert-danger" role="alert"><h5><i class="fas fa-ban"></i> <b>Brak Dostępu do Panelu!</b></h5>Witaj <b>'.$user_login['login'].'</b>!<br>Nie udało ci się zalogować do panelu z powodu:<br><b>Powód:</b> Brak uzupełnionego powodu!<hr><small class="mb-0">Poinformował <b>System Wirtualnego Pomorza</b> w dniu '. $data.'</small></div>';
									}
									$logowanie = false;
								} else {
									$whitelist = row("SELECT * FROM whitelist_panel_logowanie WHERE uid = ".$user_login['id']);
									if(ograniczenia_status('logowanie') == false){
										if($whitelist){
											header('Location: ./index.php?a=home');
										} else {
											$logowanie = false;
											echo '<p class="text-center"><a href="./index.php?a=wyloguj">Wyloguj</a></p>';
										}
									} else {
									 	header('Location: ./index.php?a=home');
									}
								}
							}
						}
					}
				}
			}
			if($logowanie):
		?>
			<form class="user" action="" method="POST">
				<div class="form-group">
					<input type="text" class="form-control form-control-user" placeholder="Login" name="login">
				</div>
				<div class="form-group">
					<input type="password" class="form-control form-control-user" placeholder="Hasło" name="pass">
				</div>
				<button type="submit" class="btn btn-primary btn-user btn-block">Zaloguj Się</button>
			</form>
		<?php endif;?>
		<hr>

		<div class="text-center">
			<a href="index.php?a=forgot-password">Nie pamiętasz hasła?</a>
		</div>
	</div>
