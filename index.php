<?php
ob_start();
session_start(); // Rozpoczynamy lub przedłużamy pracę sesji
require_once('config/connect.php'); // Pobranie pliku z funkcjami
require_once('config/function.php'); // Pobranie pliku z funkcjami
//require_once('config/DiscordFunctions.php'); // Połączenie z bazą danych
require_once('config/EmailFunctions.php'); // Pobranie pliku z funkcjami
?>
<!DOCTYPE html>
<html lang="pl">
  <?php include 'portal/themapart/header.php';?>
	<body class="hold-transition layout-top-nav">
		<div class="wrapper">
			<?php
				//cookie_info();
				require_once 'portal/themapart/top-menu.php';
			?>
			<!-- /.navbar -->
			<div class="content-wrapper">
				<?php
					if (empty($_GET)) $_GET['a'] = 'home';
					switch($_GET['a']){ // Funkcja wybierania pliku do załadowania
						case 'home': require_once('portal/strony/home.php'); break;
						case 'kontakt': require_once('portal/strony/kontakt.php'); break;
						case 'zloz-wniosek': require_once('portal/strony/wniosekoprace.php'); break;
						case 'artykuł': require_once('portal/strony/artykul.php'); break;
						case 'strona': require_once('portal/strony/strona.php'); break;
						case 'kategoria': require_once('portal/strony/kategorie.php'); break;
						case 'brygadówka-dowlad': require_once('portal/strony/test.php'); break;
						default:
							require_once('portal/strony/home.php');
							$_GET['a'] = 'home';
						break; // Strona ładowana domyślnie
					}
					require_once 'portal/themapart/script.php';
				?>
			</div>
			<?php require_once 'portal/themapart/footer.php';?>
		</div>
	</body>
</html>
<?php
mysqli_close($con); // Zamknięcie połączenia z bazą danych
ob_end_flush();
ob_end_clean();
?>
