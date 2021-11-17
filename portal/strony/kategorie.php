<?php
	//header
if (isset($_GET['id'])) {
	$id = vtxt($_GET['id']);
	$target = row("SELECT * FROM kategorie WHERE id = ".$id);
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
					<h1 class="m-0 text-dark"><?=$target['nazwa'];?></h1>
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
					<?php $changes = call("SELECT * FROM wpisy WHERE kategoria = ".$id);
					if ($changes->num_rows == 0) {?>
						<div class="card-body">
							<b>Brak Stron!</b>	
						</div>
					<?php } else {
					$i = 0;
					while ($row = mysqli_fetch_array($changes)):
					?>
						<div class="card">					
							<div class="card-body">
								<h2 class="card-title"><a href="index.php?a=artykuł&id=<?=$row['id'];?>"><?=$row['tytul'];?></a></h5>
								<p class="card-text">
									<small class="text-muted">
										<i class="far fa-calendar-alt"> <?=$row['data'];?></i>&nbsp;
										<?php $user = row("SELECT login FROM users WHERE id = ".$row['kto']); ?>
										<i class="far fa-user"> <?=$user['login'];?></i> &nbsp;
										<i class="far fa-comments"></i><a href=""> <?=$row['komentarze'];?> Komentarzy</a>&nbsp;
										<?php $kat = row("SELECT nazwa FROM kategorie WHERE id = ".$row['kategoria']); ?>
										<i class="fas fa-th-list"></i><a href="index.php?a=kategoria&id=<?=$row['kategoria'];?>" rel="category tag"> <?=$kat['nazwa'];?></a>&nbsp;
									</small>&nbsp;
								</p>
								<p class="card-text"><?php echo (substr($row['text'], 0, 150) . '...');?></p>
								<a href="index.php?a=artykuł&id=<?=$row['id'];?>" class="btn btn-primary">Czytaj więcej</a>
							</div>
						</div>
					<?php endwhile; }?>	
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
								$zatrudnieni = row("SELECT count(*) AS ilosc FROM users WHERE stanowisko != 0");
							?>
							<h5 class="card-title-center">Statystyki</h5>
							<p class="card-text">Dzisiaj jest <b><?=$dzis;?></b></p>
							<p class="card-text">Przejechalimy razem <b><?=$kilometry;?></b> km.</p>
							<p class="card-text">Wykonaliśmy <b><?=$raporty;?></b> służb.</p>
							<p class="card-text">Zatrudnionych jest <b><?=$zatrudnieni['ilosc'];?></b> osób.</p>
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


  
