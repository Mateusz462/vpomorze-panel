<?php
	require_once('../panel/API/vendor/autoload.php');
	require_once('../panel/API/config.php');
	use RestCord\DiscordClient;
	
	
	function discord_authorization(){
		require_once('./../config/function.php');
		$user = getUser($_SESSION['id']);
		global $server;
		global $server_rekru;
		
		//global $_REQUEST;
		//global $_REQUEST;
		
		global $CLIENT_ID;
		global $CLIENT_SECRET;
		global $REDIRECT_URI;
		global $_REQUEST;
		
		
		if (!isset($_GET['code'])) {

			// Step 1. Get authorization code
			$authUrl = 'https://discord.com/api/oauth2/authorize?client_id='.$CLIENT_ID.'&redirect_uri='.$REDIRECT_URI.'&response_type=code&scope=identify%20email%20guilds.join';
			//$_SESSION['oauth2state'] = $provider->getState();
			header('Location: ' . $authUrl);

		} else {
			
			$url = 'https://discord.com/api/oauth2/token';
			$data = array(
				'client_id' => $CLIENT_ID,
				'client_secret' => $CLIENT_SECRET,
				'grant_type' => 'authorization_code',
				'code' => $_REQUEST['code'],
				'redirect_uri' => $REDIRECT_URI,
				'scope' => 'identify guilds.join'
			);
			$header = array(
				'Content-Type' => 'application/x-www-form-urlencoded'
			);
			echo "Żądanie dostępu...<br><br>";
			
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
			$response = curl_exec($ch);
			curl_close($ch);
			//print_r($response);			
			
			$rsp = json_decode($response, 1);	
			if($rsp['error']) {
				$rsp['access_token'] = false;
			} elseif($rsp['access_token']) {
				$rsp['error'] = false;
			} else {
				$rsp['access_token'] = false;
				$rsp['error'] = false;
				
			}
			//print_r($response);
			
			if($rsp['error']){		
				echo "No access token <br><br>";
				//print_r($response);
			}
			
			if($rsp['access_token']){
				
				$access_token = $rsp['access_token'];
				echo "Wyszukiwanie użytkownika...<br><br>";
				
				$url = 'https://discord.com/api/users/@me';
				$ch = curl_init($url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$header = array(
					'Authorization: Bearer ' . $access_token
				);
				curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
				$response = curl_exec($ch);
				curl_close($ch);
				
				$rsp = json_decode($response, 1);
				$json = $rsp;
				//print_r($json);
				
				if($json['verified'] == 1){
					if($user['stanowisko'] == '21' || $user['stanowisko'] == '22'){
						//dodawanie użytkownika na serwer rekrutacyjny
						discord_add_Guild_Member($server_rekru, $access_token, $json['id']);
						
						//ustawienie nicku na serwerze
						$nick = '[ Rekrutent ]'.$user['login'].'';
						discord_Modify_Guild_Member($server_rekru, $json['id'], $nick);
						
						//dodawanie rangi na serwerze rekrutacyjny
						discord_add_Guild_Member_Role($server_rekru, $json['id'], '845624213225340928');
						
						if($user['dc'] == '0'){
							$tak = call("INSERT INTO discord (uid, dcid, username, avatar, discriminator) VALUES ('".$user['id']."', '".$json['id']."', '".$json['username']."', '".$json['avatar']."', '".$json['discriminator']."')");
							$us = call("UPDATE users SET dc = '1' WHERE id = '".$user['id']."'");
							if($tak & $us){
								throwInfo('success', 'Sukces Połączono konto '.$json['username'].'#'.$json['discriminator'].' z panelem! <br> Możesz już korzystać z naszego serwera! <a href="https://discord.com/channels/@me">Przejdź na discorda</a>', false);
								header('Location: index.php?a=home');
							}
						} else {
							$query = row("SELECT * FROM discord WHERE uid =".$user['id']);
							$tak = call("UPDATE discord SET username = '".$json['username']."', avatar = '".$json['avatar']."', discriminator = '".$json['discriminator']."' WHERE uid = '".$user['id']."'");
							if($tak){
								throwInfo('success', 'Sukces Połączono konto '.$json['username'].'#'.$json['discriminator'].' z panelem! <br> Możesz już korzystać z naszego serwera! <a href="https://discord.com/channels/@me">Przejdź na discorda</a>', false);
								header('Location: index.php?a=home');
							}
						}
					} elseif($user['stanowisko'] == '7') {
						
						//dodawanie użytkownika na serwer rekrutacyjny
						discord_add_Guild_Member($server_rekru, $access_token, $json['id']);
						
						//ustawienie nicku na serwerze rekrutacyjny
						$role = row("SELECT * FROM rangi WHERE id = ".$user['stanowisko']); 
						$login = '['.$role['kod_roli'].''.$user['nr_sluzbowy'].'] '.$user['login'].'';
						discord_Modify_Guild_Member($server_rekru, $json['id'], $login);
						
						//dodawanie rangi na serwerze rekrutacyjny
						discord_add_Guild_Member_Role($server_rekru, $json['id'], '844257938578473040');
						
						
						//dodawanie użytkownika na serwer firmowy
						discord_add_Guild_Member($server, $access_token, $json['id']);
						
						//ustawienie nicku na serwerze firmowym
						discord_Modify_Guild_Member($server, $json['id'], $login);						
						
						//dodawanie rangi na serwerze firmowym
						discord_add_Guild_Member_Role($server, $json['id'], $role['id_dc']);
						discord_add_Guild_Member_Role($server, $json['id'], '845609655517446164');
						
						if($user['dc'] == '0'){
							$tak = call("INSERT INTO discord (uid, dcid, username, avatar, discriminator) VALUES ('".$user['id']."', '".$json['id']."', '".$json['username']."', '".$json['avatar']."', '".$json['discriminator']."')");
							$us = call("UPDATE users SET dc = '1' WHERE id = '".$user['id']."'");
							if($tak & $us){
								throwInfo('success', 'Sukces Połączono konto '.$json['username'].'#'.$json['discriminator'].' z panelem! <br> Możesz już korzystać z naszego serwera! <a href="https://discord.com/channels/@me">Przejdź na discorda</a>', false);
								header('Location: index.php?a=home');
							}
						} else {
							$query = row("SELECT * FROM discord WHERE uid =".$user['id']);
							$tak = call("UPDATE discord SET username = '".$json['username']."', avatar = '".$json['avatar']."', discriminator = '".$json['discriminator']."' WHERE uid = '".$user['id']."'");
							if($tak){
								throwInfo('success', 'Sukces Połączono konto '.$json['username'].'#'.$json['discriminator'].' z panelem! <br> Możesz już korzystać z naszego serwera! <a href="https://discord.com/channels/@me">Przejdź na discorda</a>', false);
								header('Location: index.php?a=home');
							}
						}
					} else {
						//dodawanie użytkownika na serwer firmowy
						discord_add_Guild_Member($server, $access_token, $json['id']);
						//echo 'nie';
						//ustawienie nicku na serwerze
						$role = row("SELECT * FROM rangi WHERE id = ".$user['stanowisko']); 
						$login = '['.$role['kod_roli'].''.$user['nr_sluzbowy'].'] '.$user['login'].'';
						discord_Modify_Guild_Member($server, $json['id'], $login);
						
						//dodawanie rangi
						discord_add_Guild_Member_Role($server, $json['id'], $role['id_dc']);
						
						if($user['dc'] == '0'){
							$tak = call("INSERT INTO discord (uid, dcid, username, avatar, discriminator) VALUES ('".$user['id']."', '".$json['id']."', '".$json['username']."', '".$json['avatar']."', '".$json['discriminator']."')");
							$us = call("UPDATE users SET dc = '1' WHERE id = '".$user['id']."'");
							if($tak & $us){
								throwInfo('success', 'Sukces Połączono konto '.$json['username'].'#'.$json['discriminator'].' z panelem! <br> Możesz już korzystać z naszego serwera! <a href="https://discord.com/channels/@me">Przejdź na discorda</a>', false);
								header('Location: index.php?a=home');
							}
						} else {
							$query = row("SELECT * FROM discord WHERE uid =".$user['id']);
							$tak = call("UPDATE discord SET username = '".$json['username']."', avatar = '".$json['avatar']."', discriminator = '".$json['discriminator']."' WHERE uid = '".$user['id']."'");
							if($tak){
								throwInfo('success', 'Sukces Połączono konto '.$json['username'].'#'.$json['discriminator'].' z panelem! <br> Możesz już korzystać z naszego serwera! <a href="https://discord.com/channels/@me">Przejdź na discorda</a>', false);
								header('Location: index.php?a=home');
							}
						}
					}					
				} else {
					echo 'Nie zweryfikowane konto Discord!';
				}
			}
			
		}
	}
	
	function discordListGuildMembers($guild_id){
		global $bottoken;
		$client = new DiscordClient(['token' => $bottoken]); // Token is required
		$result = $client->guild->listGuildMembers([
			'guild.id' => intval($guild_id),
			'limit' => 100
		]);
		print_r($result);
	}
	
	function discord_add_Guild_Member($server, $access_token, $user_id){
		global $bottoken;
		$client = new DiscordClient(['token' => $bottoken]); // Token is required
		echo "Dołączanie na serwer...<br><br>";
		$result = $client->guild->addGuildMember([
			'guild.id' => intval($server),
			'user.id' => intval($user_id),
			'access_token' => $access_token
		]);
		
		echo 'Dołączono na serwer<br><br>';
		
	}
	
	function discord_Modify_Guild_Member($server, $user_id, $nick){
		global $bottoken;
		$client = new DiscordClient(['token' => $bottoken]); // Token is required
		echo "Ustawianie nicku...<br><br>";
		$result = $client->guild->modifyGuildMember([
			'guild.id' => intval($server),
			'user.id' => intval($user_id),
			'nick' => $nick
		]);
		echo 'Ustawiono nick na serwerze<br><br>';
	}
	
	function discord_add_Guild_Member_Role($server, $user_id, $role){
		global $bottoken;
		$client = new DiscordClient(['token' => $bottoken]); // Token is required
		echo "Dodawanie ragi ...<br><br>";
		$result = $client->guild->addGuildMemberRole([
			'guild.id' => intval($server),
			'user.id' => intval($user_id),
			'role.id' => intval($role)
		]);
		echo 'Dodano range<br><br>';
	}
	



	
	/* if($user['dc'] == '1'){
		header('Location: index.php?a=home');
	}
	
	
		if($result && $result1){
			$tak = call("INSERT INTO discord (uid, dcid, username, avatar, discriminator) VALUES ('".$user['id']."', '".$json['id']."', '".$json['username']."', '".$json['avatar']."', '".$json['discriminator']."')");
			
			$us = call("UPDATE users SET dc = '1' WHERE id = '".$user['id']."'");
			throwInfo('success', 'Sukces Połączono konto '.$json['username'].'#'.$json['discriminator'].' z panelem! <br> Możesz już korzystać z naszego serwera! <a href="https://discord.com/channels/@me">Przejdź na discorda</a>', false);			
			header('Refresh:1');
		}
	} */
?>

	<!-- Main content -->
    <section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="card shadow mb-4">
						<div class="card-header">
							<h3 class="m-0 font-weight-bold">Witaj <?=$user['login']?></h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<?php discord_authorization();?>
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->						
				</div>
				<!-- /.col -->
			</div>
        <!-- /.row -->
		</div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->