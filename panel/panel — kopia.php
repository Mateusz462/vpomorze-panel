<?php
ob_start();
session_start();
require_once('../config/connect.php'); // Połączenie z bazą danych
require_once('../config/function.php'); // Pobranie pliku z funkcjami
require_once('./API/vendor/autoload.php');
require_once('./API/config.php');

if (!empty($_SESSION['id'])) {
	checkUser($_SESSION['id']); // Sprawdzenie, czy gracz jest zapisany w sesji (zalogowany)
	$user = getUser($_SESSION['id']); // Wybierany danych z bazy o graczu aktualnie zalogowanym
	$perm = row("SELECT * FROM permisje WHERE rid =".$user['stanowisko']);
	$role = row("SELECT * FROM rangi WHERE id = ".$user['stanowisko']);
	if($user['dc'] == 1){
		$dc = row("SELECT * FROM discord WHERE uid = ".$user['id']);
	}
} else {
	$user = array(); // Czyszczenie zmiennej gracza
}
use RestCord\DiscordClient;
$client = new DiscordClient(['token' => $bottoken]); // Token is required
?>
<!DOCTYPE html>
<html lang="pl">
<?php include "dist/themapart/header.php"; ?>
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
								case 'ip': require_once('strony/ip.php'); break; // Strona z listą pracowników
								//zarzad
								case 'flota': require_once('strony/zarząd/flota.php'); break; // Strona z listą pracowników
								case 'email': require_once('strony/zarząd/email.php'); break; // Strona z listą pracowników
								case 'pobieralnia-zarządzanie': require_once('strony/zarząd/pobieralnia.php'); break; // Strona z listą pracowników
								case 'dyspozytornia': require_once('strony/zarząd/grafik.php'); break; // Strona z listą pracowników
								//case 'dyspozytornia1': require_once('strony/zarząd/'); break; // Strona z listą pracowników
								case 'ogłoszenia-panel': require_once('strony/zarząd/ogłoszenia-panel.php'); break; // Strona z listą pracowników
								case 'ogłoszenia-portal': require_once('strony/zarząd/ogłoszenia-portal.php'); break; // Strona z listą pracowników
								case 'ogłoszenia-discord': require_once('strony/zarząd/ogłoszenia-discord.php'); break; // Strona z listą pracowników
								case 'discord-zarządzanie': require_once('strony/zarząd/discord-zarzadzanie.php'); break; // Strona z listą pracowników
								case 'linie-zarządzanie': require_once('strony/zarząd/linie.php'); break; // Strona z listą pracowników
								case 'raporty-zarządzanie': require_once('strony/zarząd/raporty.php'); break; // Strona z listą pracowników
								case 'wnioski-zarządzanie': require_once('strony/zarząd/wnioski.php'); break; // Strona z listą pracowników
								case 'wnioskioprace-zarządzanie': require_once('strony/zarząd/wnioskioprace.php'); break; // Strona z listą pracowników
								case 'zarządzanie-panelem': require_once('strony/zarząd/ustawienia.php'); break; // Strona z listą pracowników
								case 'służby': require_once('strony/zarząd/sluzby.php'); break; // Strona z listą pracowników
								case 'użytkownicy': require_once('strony/zarząd/użytkownicy.php'); break; // Strona z listą pracowników
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
			</div>
		</div>
		<!-- Scroll to Top Button-->
		<a class="scroll-to-top rounded" href="#page-top">
			<i class="fas fa-angle-up"></i>
		</a>
		<?php include "dist/themapart/script.php";?>
	</body>
</html>
<?php
mysqli_close($con); // Zamknięcie połączenia z bazą danych
ob_end_flush();
?>
