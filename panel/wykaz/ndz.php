<!DOCTYPE html>
<html lang="pl">
  <?php
  include 'themapart/header.php';
  ?>
	<body class="hold-transition layout-top-nav">
		<div class="wrapper">	
			<div class="content-wrapper">	
				<?php		
					if (empty($_GET)) $_GET['a'] = 'home';
					
					switch($_GET['a'])
					{ // Funkcja wybierania pliku do załadowania
						case 'pnpt': require_once('strony/pnpt.php'); break;													
						case 'kontakt': require_once('strony/kontakt.php'); break;
						case 'zloz-wniosek': require_once('strony/wniosekoprace.php'); break;
						case 'artykuł': require_once('strony/artykul.php'); break;
						case 'strona': require_once('strony/strona.php'); break;
						case 'kategoria': require_once('strony/kategorie.php'); break;
						default:
							require_once('strony/ndz.php'); 
							$_GET['a'] = 'home';
						break; // Strona ładowana domyślnie
					}
					
					include 'themapart/script.php';
					
				?>
			</div>
		</div>
	</body>	
</html>
