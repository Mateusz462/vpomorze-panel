<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Chat</title>
		<script type="text/javascript"
		src="jquery-1.4.2.min.js"></script>
		<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
		<script type="text/javascript">
			$(function() {
				$(document).ajaxError(function(){
					alert('Nie można wysłać danych lub błąd serwera!');
				}); 
				$('.formularz').submit(function() {      
					if($(this).find('input[name=imie]').val() && $(this).find('textarea').val()){            		   
						$.post('process_ajax.php',$(this).serialize(),function(dane){		
							$(this).find('input[name=imie],textarea').val('');
							$("#chat_area ul li:first").remove();
							$('#chat_area ul').append(dane);      
						});
					}
					return false;
				});
			});
			setInterval('updateChat()',5000);
			var data_ostatniej_wiadomosci = 0;
			function updateChat(){
				$.post('process_ajax.php',{data_ostatniej_wiadomosci: data_ostatniej_wiadomosci},function(dane){
				if(dane){
					data_ostatniej_wiadomosci = dane.czas;
					if(dane.html!=''){
						$('#chat_area ul').html(dane.html);
					}
				}
				});
			}
		</script>
		<style type="text/css">
			/*podstawowe style określające wygląd shoutboxa*/
			body {font: 11px Arial, Helvetica, sans-serif; }
			#chat_area {
				width: 400px;
				height: 300px;
				background: #eee;
				border: 1px solid #9F9F9F;
				border-width: 1px 1px 0 1px;
			}
			#chat_area ul {
				margin: 0;
				padding: 0;
			}
			#chat_area ul li{
				border-bottom: 1px solid #9F9F9F;
				list-style-type: none;
				padding: 4px;
				font: 11px Arial, Helvetica, sans-serif;
			}
			.formularz{
				background: #eee;
				width: 380px;
				border: 1px solid #9F9F9F;
				border-width: 0 1px 1px 1px; 
				padding: 10px;  
			}
			.formularz input, .formularz textarea{
				font:  11px Arial, Helvetica, sans-serif; 
				border: 1px solid #9F9F9F; 
			}
		</style>
	</head>
	<body>
		<div id="chat_area">  
			<ul> 
				<?php
					require_once('config/connect.php'); // Pobranie pliku z funkcjami
					require_once('config/function.php'); // Pobranie pliku z funkcjami
					$wyswietlane = 10;
					$dbconn = @mysqli_connect($dbhost,$dbuser,$dbpass);
					if($dbconn){
						//mysqli_select_db($dbname,$dbconn);
						//mysqli_query("SET NAMES utf8");
						$chat_items_num = mysqli_query("SELECT COUNT(*) FROM wiadomości");
						$chat_items_num = mysqli_fetch_row($chat_items_num);
						$start = $chat_items_num[0] - 10;
						$chat_items = call("SELECT * FROM wiadomości ORDER BY id LIMIT $start, $wyswietlane");

						while($wiadomosc = row($chat_items)){
							echo '<li>';
							echo date("d.m.Y H:i",strtotime($wiadomosc['czas'])).' <strong>'.htmlspecialchars($wiadomosc['uid']).'</strong> 			'.htmlspecialchars($wiadomosc['tresc']);
							echo '</li>';   
						}
					}
				?>
			</ul>
		</div>
		<form action="" method="post" class="formularz">
			<div><div>Imię:</div> <input type="text" name="imie" size="20"/></div>
			<p><div>Treść:</div> <textarea cols="40" rows="5" name="tresc"></textarea></p>
			<p><input type="submit" value="Wyślij" /></p>
			<input type="hidden" name="chat" value="1" />
		</form>
	</body>
</html>




<!DOCTYPE html> <html lang="en" class="bg-gray"> <head> <meta charset="utf-8"> <meta http-equiv="X-UA-Compatible" content="IE=edge"> <meta http-equiv="Content-Language" content="en"> <meta name="viewport" content="width=device-width, initial-scale=1"> <meta name="robots" content="noindex,nofollow"> <!-- Favicon --> <link rel="icon" href="/img/favicon.png?v=1.1" type="image/x-icon"> <title>404 Page Not Found</title> <link href="/css/theme.css" rel="stylesheet"> <!-- Fonts --> <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'> <!-- Font-Awesome --> <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"> <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries --> <!-- WARNING: Respond.js doesn't work if you view the page via file:// --> <!--[if lt IE 9]> <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script> <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script> <![endif]--> <script> (function (i, s, o, g, r, a, m) { i['GoogleAnalyticsObject'] = r; i[r] = i[r] || function () { (i[r].q = i[r].q || []).push(arguments) }, i[r].l = 1 * new Date(); a = s.createElement(o), m = s.getElementsByTagName(o)[0]; a.async = 1; a.src = g; m.parentNode.insertBefore(a, m) })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga'); ga('create', 'UA-46680343-1', 'auto'); ga('send', 'pageview'); </script> <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> <script src="/js/main.js" type="text/javascript"></script> </head> <body class="bg-gray"> <div class="wrapper"> <div class="home"> <div class="home-inner"> <div class="container"> <h1>404 Page Not Found</h1> </div> </div> </div> <div class="section"> <div class="container"> <div class="error-section"> <h2 style="margin-top: 0"> This is somewhat embarrassing! </h2> <p class="lead"> We couldn't find the page you are looking for. You can browse our <a href="/">homepage</a> or use the navigation bar above. </p> <p class="lead"> If you believe you got this error by mistake, you can contact us at <a href="&#x6d;&#97;&#x69;&#x6c;t&#x6f;&#x3a;&#x68;&#101;&#x6c;p&#64;&#97;&#108;&#109;s&#x61;&#101;&#101;&#x64;&#x73;&#x74;&#x75;&#x64;&#x69;&#111;&#46;&#99;&#111;&#109;">&#x68;&#101;&#108;&#112;&#64;a&#108;m&#115;&#97;e&#x65;&#x64;&#115;t&#117;&#x64;&#x69;o.&#x63;&#111;&#109;</a>. </p> </div> </div> </div> </div> <!--/.wrapper --> </body> </html>