<?php
ob_start();
session_start(); // Rozpoczynamy lub przedłużamy pracę sesji
require_once('../config/connect.php'); // Połączenie z bazą danych
require_once('../config/function.php'); // Pobranie pliku z funkcjami
if (!empty($_SESSION['id'])) {
	header("Location: panel.php");
} else {
	$user = array(); // Czyszczenie zmiennej gracza
}
?>
<!DOCTYPE html>
<html lang="pl">
<?php include "dist/themapart/header.php"; ?>
	<body class="bg-dark">
		<div class="container">
			<!-- Outer Row -->
			<div class="row justify-content-center">
				<div class="col-xl-6 col-lg-6 col-md-9">
					<div class="card o-hidden border-0 shadow-lg my-5">
						<div class="card-body p-0">
							<!-- Nested Row within Card Body -->
							<div class="row">
								<div class="col-lg-12">
									
									<?php if (empty($_GET)) $_GET['a'] = 'login';
		
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
				</div>
			</div>
			<?php include "dist/themapart/script.php";?>
		</div>
	</body>
</html>
<?php
mysqli_close($con); // Zamknięcie połączenia z bazą danych
ob_end_flush();
//ob_end_clean();
?>