<?php
	//header
if (isset($_GET['id'])) {
	$id = vtxt($_GET['id']);
	$target = row("SELECT * FROM wpisy WHERE strona = ".$id);
	if(!$target){
		header('Location: index.php?a=home');
	}
} else {
	header('Location: index.php?a=home');
}
?>

	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark"><?=$target['tytul'];?></h1>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<!-- Main content -->
	<div class="content">
		<div class="container">
			<div class="row">
				<div class="col-9">
					<div class="card">
						<div class="card-body">
							<p class="card-text">
								<small class="text-muted">
									<i class="far fa-calendar-alt"> <?=$target['data'];?></i>&nbsp;
									<?php $user = row("SELECT login FROM users WHERE id = ".$target['kto']); ?>
									<i class="far fa-user"> <?=$user['login'];?></i> &nbsp
								</small>&nbsp;
							</p>
							<p class="card-text">
								<?=$target['text'];?>
							</p>
						</div>
					</div>
					<a href="index.php" class="btn btn-primary">Powrót na Stronę Główną</a>
				</div>
				<div class="col-3">
					<div class="card">
						<div class="card-body">
							<?php
								$dzien = date("d");
								$miesiac = date("m");
								$rok = date("Y");
								$date = mktime(0, 0, 0, $miesiac, $dzien, $rok);
								$dzis = date('d.m.Y',$date);

								$zmienna = row("SELECT SUM(kilometry) AS suma_kilometrów FROM users");
								$kilometry = $zmienna['suma_kilometrów'];
								$zmienna2 = row("SELECT SUM(raporty) AS suma_raportów FROM users");
								$raporty = $zmienna2['suma_raportów'];
								$zatrudnieni = row("SELECT count(*) AS ilosc FROM users WHERE stanowisko != 21 AND stanowisko != 22 AND stanowisko != 0 AND deleted = 0");
								$oczekuje = row("SELECT count(*) AS oczekuje FROM aplikacje WHERE status = 0");
								$etap1 = row("SELECT count(*) AS oczekuje FROM aplikacje WHERE status = 2");
							?>
							<h5 class="card-title-center">Statystyki</h5>
							<p class="card-text">Dzisiaj jest <b><?=$dzis?></b></p>
							<p class="card-text">Przejechalimy razem <b><?=$kilometry?></b> km.</p>
							<p class="card-text">Wykonaliśmy <b><?=$raporty?></b> służb.</p>
							<p class="card-text">Zatrudnionych jest <b><?=$zatrudnieni['ilosc']?></b> osób</p>
							<p class="card-text">Osoby oczekujące na zatrudnienie <b><?=$oczekuje['oczekuje']?></b></p>
							<p class="card-text">Osoby przyjęte po 1 etapie rekrutacji <b><?=$etap1['oczekuje']?></b></p>
						</div>
					</div>
					<?php
						socialSidebar();
					?>
				</div>

			</div>
		<!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content -->
