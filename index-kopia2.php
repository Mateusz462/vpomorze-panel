<?php
ob_start();
session_start(); // Rozpoczynamy lub przedłużamy pracę sesji
//require_once('config/DiscordFunctions.php'); // Połączenie z bazą danych
//require_once('config/EmailFunctions.php'); // Pobranie pliku z funkcjami
?>
<!DOCTYPE html>
<html lang="pl">
  <?php include 'portal/themapart/header.php';?>
	<body class="hold-transition layout-top-nav">
		<div class="wrapper">
			<?php
				//require_once 'portal/themapart/top-menu.php';
			?>
			<!-- /.navbar -->
			<div class="content-wrapper">
				<!-- Main content -->
				<div class="content">
					<div class="container">
						<div class="row">
							<div class="col-12">
								<br>
								<br>
								<br>
							</div>
							<div class="col-12">
								<div class="card text-center">
									<div class="card-body">
										<h5 class="card-title-center">Witaj!</h5>
										<p class="card-text">W związku ze zmianą hostingu</p>
										<p class="card-text">strona oraz panel kierowcy dostępne będą pod nową domeną</p>
										<p class="card-text"><a href="http://wirtualne-pomorze.pl/" class="btn btn-dark bg-light">http://wirtualne-pomorze.pl/</a></p>
										<p class="card-text"><a href="http://wirtualne-pomorze.pl/panel" class="btn btn-primary bg-primary">http://wirtualne-pomorze.pl/panel</a></p>
										
									</div>
								</div>
							</div>
						</div>
					<!-- /.row -->
					</div><!-- /.container-fluid -->
				</div>
				<!-- /.content-->
				<?php
					require_once 'portal/themapart/script.php';
				?>
			</div>
			<?php require_once 'portal/themapart/footer.php';?>
		</div>
	</body>
</html>
<?php
ob_end_flush();
ob_end_clean();
?>
