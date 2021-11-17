<?php
require_once('../config/connect.php'); // Połączenie z bazą danych
require_once('../config/session.php'); // Pobranie pliku z funkcjami
require_once('../config/function.php'); // Pobranie pliku z funkcjami
require_once('../config/DiscordFunctions.php'); // Połączenie z bazą danych
require_once('../config/EmailFunctions.php'); // Pobranie pliku z funkcjami
session_set_save_handler('_open', '_close', '_read', '_write', '_destroy', '_clean');
register_shutdown_function('session_write_close');
ob_start();
session_start(); // Rozpoczynamy lub przedłużamy pracę sesji
_clean(1800);
ograniczenia_logout();
//echo mktime(0,0,0, date('m'), date('d'), date('Y'));
//echo date("d.m.Y H:i:s", 1627768800);
//wnioski_o_prace_loading();
if (!empty($_SESSION['id'])) {
	checkUser($_SESSION['id']); // Sprawdzenie, czy gracz jest zapisany w sesji (zalogowany)
	logi_logowanie_get();
	$user = getUser($_SESSION['id']); // Wybierany danych z bazy o graczu aktualnie zalogowanym
	$perm = row("SELECT * FROM permisje WHERE rid =".$user['stanowisko']);
	$user_role = row("SELECT * FROM rangi WHERE id = ".$user['stanowisko']);
	if($user['dc'] == 1){
		$user_discord = row("SELECT * FROM discord WHERE uid = ".$user['id']);
	} else {
		$user_discord = array(); // Czyszczenie zmiennej gracza
	}
	$dataformularza = array('typ' => 'zwolnienie-wniosek-pracownika', 'powod' => 'test');
	$userdata = $user;
	raporty_refresh($user);
	//email_send('marian.maselko97@gmail.com', email_config($dataformularza, $userdata));
	//wnioski_permisje();
	//wnioski_permisje($user);
	//session_destroy();
} else {
	$user = array(); // Czyszczenie zmiennej gracza
	$perm = array(); // Czyszczenie zmiennej gracza
	$user_role = array(); // Czyszczenie zmiennej gracza
	$user_discord = array(); // Czyszczenie zmiennej gracza
}
?>
<!DOCTYPE html>
<html lang="pl">
<?php
	include "dist/themapart/header.php";
	if(empty($user['id'])):
?>
	<body style="background-size: cover; background-image: url('https://cdn.discordapp.com/attachments/793594679810588712/854807317659910215/v89lxrH.jpg');">
		<div class="container">
			<!-- Outer Row -->
			<div class="row justify-content-center">
				<div class="col-xl-6 col-lg-6 col-md-9">
					<div class="card o-hidden border-0 shadow-lg my-5">
						<div class="card-body p-0">
							<!-- Nested Row within Card Body -->
							<div class="row">
								<div class="col-lg-12">

									<?php if (empty($_GET)) $_GET['a'] = 'home';
										switch($_GET['a'])
										{ // Funkcja wybierania pliku do załadowania
											case 'login': require_once('strony/logowanie/login.php'); break;
											case 'register': require_once('strony/logowanie/register.php'); break;
											case 'password': require_once('strony/logowanie/password.php'); break;
											case 'forgot-password': require_once('strony/logowanie/forgot-password.php'); break;
											default:
												require_once('strony/logowanie/login.php');
												$_GET['a'] = 'login';
											break; // Strona ładowana domyślnie
										}

									?>
								</div>
							</div>
						</div>
					</div>
					<?php cookie_info();?>
				</div>
			</div>
			<?php
				include "dist/themapart/script.php";
			?>
		</div>
	</body>
<?php
	else:
?>
	<body id="page-top">
		<!-- Page Wrapper -->
		<div id="wrapper">
			<?php include "dist/themapart/sidebar.php";?>
			<div id="content-wrapper" class="d-flex flex-column">
				<div id="content">
					<?php include "dist/themapart/navbar.php";?>
					<div class="container-fluid">
						<?php
							if (empty($_GET)) $_GET['a'] = 'home';

							switch($_GET['a']) { // Funkcja wybierania pliku do załadowania
								case 'rekrutacja': require_once('strony/rekrutacja.php'); break; // Strona główna
								case 'home': require_once('strony/home.php'); break; // Strona główna
								case 'zgłoszenia': require_once('strony/zgłoszenia.php'); break; // Strona z listą pracowników
								case 'wnioski': require_once('strony/wnioski.php'); break; // Strona z listą pracowników
								case 'pracownicy': require_once('strony/pracownicy.php'); break; // Strona z listą pracowników
								case 'pojazdy': require_once('strony/pojazdy.php'); break; // Strona z listą pojazdów
								case 'profile': require_once('strony/profile.php'); break; // Strona kontaktowa
								case 'rangi': require_once('strony/rangi.php'); break; // Strona kontaktowa
								case 'pobieralnia': require_once('strony/pobieralnia.php'); break; // Strona pobieralni
								case 'grafik': require_once('strony/grafik.php'); break; // Strona z listą pracowników
								case 'raporty': require_once('strony/raporty.php'); break; // Strona z listą pracowników
								case 'wykaz-brygad': require_once('strony/wykaz.php'); break; // Strona z listą pracowników
								case 'ustawienia-użytkownika': require_once('strony/ustawienia.php'); break; // Strona z listą pracowników
								case 'faq': require_once('strony/faq.php'); break; // Strona z listą pracowników
								case 'dokumentacja': require_once('strony/dokumentacja.php'); break; // Strona z listą pracowników
								//zarzad
								case 'pojazd-wnioski': require_once('strony/zarząd/pojazd-wnioski.php'); break; // Strona z listą pracowników
								case 'flota': require_once('strony/zarząd/flota.php'); break; // Strona z listą pracowników
								case 'email': require_once('strony/zarząd/email.php'); break; // Strona z listą pracowników
								case 'pobieralnia-zarządzanie': require_once('strony/zarząd/pobieralnia.php'); break; // Strona z listą pracowników
								//case 'dyspozytornia': require_once('strony/zarząd/grafik.php'); break; // Strona z listą pracowników

								case 'dyspozytornia2137': require_once('strony/zarząd/zarzadzanie-grafik.php'); break; // Strona z listą pracowników
								case 'zarzadzanie-raporty': require_once('strony/zarząd/zarzadzanie-raporty.php'); break; // Strona z listą pracowników

								case 'dokumentacja-zarzadzanie': require_once('strony/zarząd/dokumentacja.php'); break; // Strona z listą pracowników
								case 'faq-zarzadzanie': require_once('strony/zarząd/faq.php'); break; // Strona z listą pracowników
								case 'kzw-wnioski': require_once('strony/zarząd/kzw-wnioski.php'); break; // Strona z listą pracowników
								//case 'dyspozytornia1': require_once('strony/zarząd/'); break; // Strona z listą pracowników
								case 'ogłoszenia-panel': require_once('strony/zarząd/ogłoszenia-panel.php'); break; // Strona z listą pracowników
								case 'ogłoszenia-portal': require_once('strony/zarząd/ogłoszenia-portal.php'); break; // Strona z listą pracowników
								case 'ogłoszenia-discord': require_once('strony/zarząd/ogłoszenia-discord.php'); break; // Strona z listą pracowników

								//case 'linie-ząrzadzanie': require_once('strony/zarząd/linie.php'); break; // Strona z listą pracowników
								case 'raporty-zarządzanie': require_once('strony/zarząd/raporty.php'); break; // Strona z listą pracowników
								case 'wnioski-zarządzanie': require_once('strony/zarząd/wnioski.php'); break; // Strona z listą pracowników
								case 'wnioskioprace-zarządzanie': require_once('strony/zarząd/wnioskioprace.php'); break; // Strona z listą pracowników
								case 'służby': require_once('strony/zarząd/sluzby.php'); break; // Strona z listą pracowników
								case 'użytkownicy': require_once('strony/zarząd/użytkownicy.php'); break; // Strona z listą pracowników
								case 'raporty-użytkownicy': require_once('strony/zarząd/raporty-użytkownicy.php'); break; // Strona z listą pracowników
								//przewoznicy
								case 'przewoznicy': require_once('strony/zarząd/przewoznicy.php'); break; // Strona z listą pracowników
								//zarzadanie panelem, logi, ograniczenia, komunikaty, Ustawienia Permisji, Przewoźnicy w systemie, Ustawienia Rang, Kody Dostępu, Ankiety
								case 'zarządzanie-panel': require_once('strony/zarząd/ustawienia.php'); break; // Strona z listą pracowników
								case 'discord-zarządzanie': require_once('strony/zarząd/discord-zarzadzanie.php'); break; // Strona z listą pracowników
								case 'ząrzadzanie-linie': require_once('strony/zarząd/linie.php'); break; // Strona z listą pracowników
								case 'ząrzadzanie-służby': require_once('strony/zarząd/sluzby.php'); break; // Strona z listą pracowników

								//api
								case 'api': require_once('strony/api.php'); break; // Strona z listą pracowników
								case 'oauth2.php': require_once('strony/oauth2.php'); break; // Strona z listą pracowników
								case 'wyloguj': require_once('strony/logowanie/logout.php'); break; // wyloguj
								default:
									require_once('strony/home.php');
									$_GET['a'] = 'home';
								break; // Strona ładowana domyślnie
							};
						?>
					</div>
				</div>
				<?php include "dist/themapart/footer.php";?>
				<?php cookie_info();?>
			</div>
		</div>
		<!-- Scroll to Top Button-->
		<a class="scroll-to-top rounded" href="#page-top">
			<i class="fas fa-angle-up"></i>
		</a>
		<?php include "dist/themapart/script.php";?>
	</body>
<?php
	endif;
?>
</html>
<?php
mysqli_close($con); // Zamknięcie połączenia z bazą danych
ob_end_flush();
ob_end_clean();
?>
