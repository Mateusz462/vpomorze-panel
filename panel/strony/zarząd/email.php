
<?php
	require("../PHPMailer/src/PHPMailer.php");
	require("../PHPMailer/src/SMTP.php");
	require("../PHPMailer/src/Exception.php");

	$mail = new PHPMailer\PHPMailer\PHPMailer();
	
	$data = date("Y-m-d H:i:s");
	$login = "elo he he";
	$email = "jaroszek.mateusz98@gmail.com";
	$ile = "ileeeeeeeeeeeeeeeeeeeeee";
	$dlaczego = "bo tak";
	
	$body = '
	<div class="card shadow mb-4">
		<div class="card-body">
			<p>W dniu '.$data.', Wniosek o pracę vpomorze napisał(a):</p>
			<div class="card">
				<div class="card-body border border-primary">
					Nazwa użytkownika: <b>'.$login.'</b><br />
					E-mail: <b>'.$email.'</b><br />
					Od kiedy grasz w OMSI: <b>'.$ile.'</b><br />
					Etat:&nbsp;<br />
					Dlaczego ty: <b>'.$dlaczego.'</b>
				</div>
			</div>&nbsp;
			<p>WNIOSEK <b style="color: #ff0000">ODRZUCONY.</b></p>
			<p>Powód:<b> Proszę o poprawne rozwinięcie odpowiedzi na pytanie: "Dlaczego akurat Ty?"</b></p><br />
			<div>
				<div>
					<p>--- Wniosek Rozpatrzył: ---</p>
					<span>Olaf Kurdziel [K-100]</span><br />
					<span>Kierownik Sp&oacute;łki IREX</span><br />
					<span>E-mail:&nbsp;<a href="mailto:kadry@vpomorze.pl" target="_blank" rel="noopener">kadry@vpomorze.pl</a></span><br /><br />
					<span>Wirtualne Pomorze</span><br />
					<span>Strona:&nbsp;<a href="https://www.vpomorze.pl/" target="_blank" rel="noopener noreferrer">https://www.vpomorze.pl/</a></span><br />
					<span>E-mail:&nbsp;<a href="mailto:vpomorze@vpomorze.pl" target="_blank" rel="noopener">vpomorze@vpomorze.pl</a></span><br />
					<span>Facebook:&nbsp;<a href="https://www.facebook.com/witrualnepomorze/" target="_blank" rel="noopener noreferrer">https://www.facebook.com/witrualnepomorze/</a></span>
				</div>
			</div>
			<div>&nbsp;</div>
		</div>
	</div>';
	echo $body;
	
	$mail->IsSMTP();
	$mail->CharSet="UTF-8";
	$mail->Host = "mail.vpomorze.pl"; /* Zależne od hostingu poczty*/
	$mail->SMTPDebug = 1;
	$mail->Port = 587; /* Zależne od hostingu poczty, czasem 587 */
	$mail->SMTPSecure = true; /* Jeżeli ma być aktywne szyfrowanie SSL */
	$mail->SMTPAuth = true;
	$mail->SMTPAutoTLS = false; 
	$mail->IsHTML(true);
	$mail->Username = "kadry@vpomorze.pl"; /* login do skrzynki email często adres*/
	$mail->Password = "WP2021.."; /* Hasło do poczty */
	$mail->setFrom('kadry@vpomorze.pl', 'Powiadomienia vpomorze'); /* adres e-mail i nazwa nadawcy */
	$mail->AddAddress("jaroszek.mateusz98@gmail.com"); /* adres lub adresy odbiorców */
	$mail->Subject = "ab"; /* Tytuł wiadomości */
	$mail->Body = $body;
	
/*  	if(!$mail->Send()) {
		echo "Błąd wysyłania e-maila: " . $mail->ErrorInfo;
	} else {
		echo "Wiadomość została wysłana!";
	} */
?>