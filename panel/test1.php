<?php 
	require_once('../config/connect.php'); // Pobranie pliku z funkcjami
	require_once('../config/function.php'); // Pobranie pliku z funkcjami
	function email_config($login){
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
	$login = 'test';
	//email_config($login);
	$target = call("SELECT * FROM aplikacje WHERE status = 2");

	
	while ($row = mysqli_fetch_array($target)){
		$login = $row['login'];
		$email = $row['email'];
		email_send($email, email_config($login));
	}
	
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