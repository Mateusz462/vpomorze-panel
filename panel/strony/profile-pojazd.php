<?php
	require_once "dist/themapart/alerts.php";
	//hasPermissionTo('security', $user_role, 'profile_users');

	if (isset($_GET['id'])) {
		$isPlayer = false;
		$id = vtxt($_GET['g']);
		$target = row("SELECT * FROM tabor WHERE id = ".$id);
		if ($target == NULL) {
			header('Location: index.php?a=pojazdy');
		}
	}
	?>
		<div class="content-header">
		    <div class="container-fluid">
		        <div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0 text-dark">Profil Pracownika: <b style="color: <?=$role['kolor'];?>"><?=$target['login'];?></b></h1>
					</div><!-- /.col -->
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="index.php">Strona Główna</a></li>
							<li class="breadcrumb-item">Profil Pracownika</li>
							<li class="breadcrumb-item active"><?=$target['login'];?></li>
						</ol>
					</div><!-- /.col -->
		        </div><!-- /.row -->
			</div><!-- /.container-fluid -->
		</div>
		<!-- /.content-header -->

		<section class="content">
			<div class="container-fluid">
				<!-- Small boxes (Stat box) -->
		        <div class="row">
					<div class="col-md-12">
						<div class="card shadow mb-4">
							<div class="card-body box-profile">
								<div class="text-center">

								</div>

								<h3 class="profile-username text-center" style="color: <?=$role['kolor'];?>"><?=$target['login'];?></h3>
								<p class="text-center"><a href="index.php?a=rangi&id=<?=$role['id'];?>" style="color: <?=$role['kolor'];?>"><?=$role['nazwa'];?></a></p>

								<div class="row">
									<div class="col-md-4">

										<ul class="list-group list-group-unbordered mb-3">
											<li class="list-group-item">
												<?php $kod = row("SELECT * FROM przewoznicy WHERE id = ".$target['guild']);?>
												<b>Kod przewoźnika</b><b class="float-right"><?=$kod['tag'];?></b>
											</li>
											<li class="list-group-item">
												<b>Data zatrudnienia</b><b class="float-right"><?=$target['zatrudnienie'];?></b>
											</li>
											<li class="list-group-item">
												<?php $role = row("SELECT * FROM rangi WHERE id = ".$target['stanowisko']);?>
												<b>Kod pracownika</b><b class="float-right"><?=' [', $role['kod_roli'], $target['nr_sluzbowy'],']';?></b>
											</li>
											<li class="list-group-item">
												<b>Ilość punktów</b><b class="float-right"><?=$target['punkty'];?>pkt</b>
											</li>
											<li class="list-group-item">
												<b>Przejechane kilometry</b><b class="float-right"><?=$target['kilometry'];?>km</b>
											</li>
											<li class="list-group-item">
												<b>Ilość zaliczonych raportów</b><b class="float-right" style="color: #009900"><?=$target['raporty'];?></b>
											</li>
											<li class="list-group-item">
												<b>Ilość niezaliczonych raportów</b><b class="float-right" style="color: #ff0000"><?=$target['nieraporty'];?></b>
											</li>
										</ul>
									</div>
									<div class="col-md-4">
										<ul class="list-group list-group-unbordered mb-3">
											<li class="list-group-item">
												<?php
													$etat = row("SELECT * FROM etaty WHERE uid = ".$target['id']);
													$cos = $etat['poniedzialek'] + $etat['wtorek'] + $etat['sroda'] + $etat['czwartek'] + $etat['piatek'] + $etat['sobota'] + $etat['niedziela'];
												?>
												<b>Etat</b><a class="float-right"><?=$cos;?>/7</a>
											</li>
											<li class="list-group-item">
												<b>Poniedziałek</b><a class="float-right">
												<?php
													if($etat['poniedzialek'] == '1') {
														echo '<i style="color: green;" class="fa fa-check"></i>';
													}else{
														echo '<i style="color: red;" class="fa fa-times"></i>';
													};
												?></a>
											</li>
											<li class="list-group-item">
												<b>Wtorek</b><a class="float-right">
												<?php
													if($etat['wtorek'] == '1') {
														echo '<i style="color: green;" class="fa fa-check"></i>';
													}else{
														echo '<i style="color: red;" class="fa fa-times"></i>';
													};
												?></a>
											</li>
											<li class="list-group-item">
												<b>Środa</b><a class="float-right">
												<?php
													if($etat['sroda'] == '1') {
														echo '<i style="color: green;" class="fa fa-check"></i>';
													}else{
														echo '<i style="color: red;" class="fa fa-times"></i>';
													};
												?></a>
											</li>
											<li class="list-group-item">
												<b>Czwartek</b><a class="float-right">
												<?php
													if($etat['czwartek'] == '1') {
														echo '<i style="color: green;" class="fa fa-check"></i>';
													}else{
														echo '<i style="color: red;" class="fa fa-times"></i>';
													};
												?></a>
											</li>
											<li class="list-group-item">
												<b>Piątek</b><a class="float-right">
												<?php
													if($etat['piatek'] == '1') {
														echo '<i style="color: green;" class="fa fa-check"></i>';
													}else{
														echo '<i style="color: red;" class="fa fa-times"></i>';
													};
												?></a>
											</li>
											<li class="list-group-item">
												<b>Sobota</b><a class="float-right">
												<?php
													if($etat['sobota'] == '1') {
														echo '<i style="color: green;" class="fa fa-check"></i>';
													}else{
														echo '<i style="color: red;" class="fa fa-times"></i>';
													};
												?></a>
											</li>
											<li class="list-group-item">
												<b>Niedziela</b><a class="float-right">
												<?php
													if($etat['niedziela'] == '1') {
														echo '<i style="color: green;" class="fa fa-check"></i>';
													}else{
														echo '<i style="color: red;" class="fa fa-times"></i>';
													};
												?></a>
											</li>
										</ul>
									</div>
									<div class="col-md-4">
										<ul class="list-group list-group-unbordered mb-3">
											<li class="list-group-item">
												<b>Stały przydział</b>
												<?php
													$poj = row("SELECT * FROM tabor WHERE własciciel =".$target['id']);
													$poj2 = row("SELECT * FROM tabor WHERE własciciel2 =".$target['id']);
													if ($poj):?>
														<td><a class="float-right" href="index.php?a=profile&g=<?=$poj['id'];?>"><span><?=$poj['marka'], ' ', $poj['model'], ' ', '#', $poj['taborowy'];?></span></a></td>
													<?php elseif($poj2):?>
														<td><a class="float-right" href="index.php?a=profile&g=<?=$poj2['id'];?>"><span><?=$poj2['marka'], ' ', $poj2['model'], ' ', '#', $poj2['taborowy'];?></span></a></td>
													<?php else:?>
														<td><b class="float-right">-</b></td>
												<?php endif;?>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<!-- /.card-body -->
						</div>
						<!-- /.card -->
					</div>
		          <!-- /.col -->
				</div>
				<!-- /.row (main row) -->

			</div><!-- /.container-fluid -->
		</section>

		<div class="content-header">
		    <div class="container-fluid">
		        <div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0 text-dark">Profil Pojazdu: <b><?=$target['marka'];?> <?=$target['model'];?> #<?=$target['taborowy'];?></b></h1>
					</div><!-- /.col -->
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="index.php">Strona Główna</a></li>
							<li class="breadcrumb-item">Profil Pojazdu</li>
							<li class="breadcrumb-item active"><?=$target['marka'];?> <?=$target['model'];?> #<?=$target['taborowy'];?></li>
						</ol>
					</div><!-- /.col -->
		        </div><!-- /.row -->
			</div><!-- /.container-fluid -->
		</div>
		<!-- /.content-header -->

		<section class="content">
			<div class="container-fluid">
				<!-- Small boxes (Stat box) -->
		        <div class="row">
					<div class="col-md-12">
						<!-- Profile Image -->
						<div class="card card-primary card-outline">
							<div class="card-body box-profile">
								<div class="text-center">
									<?php
										if(!empty($target['link'])){
											echo '<a href="'.$target['link'].'" target="_blank"><img src="'.$target['link'].'" width="425" height="258"></img></a>';
										} else {
											echo '<p class="text-center"><img class="mx-auto" src="https://vpomorze.pl/kursowki/brak_fotki.png" alt="Kursówka" title="Kursówka" style="width: 514px" /></p>';
										};
									?>
								</div>&nbsp
								<h3 class="profile-username text-center"><?=$target['marka'];?> <?=$target['model'];?> #<?=$target['taborowy'];?></h3>
								<?php
									if($target['własciciel'] > 0 || $target['własciciel2'] > 0){
										$user = row("SELECT * FROM users WHERE id =".$target['własciciel']);
										$user1 = row("SELECT * FROM users WHERE id =".$target['własciciel2']);
										$role = row("SELECT * FROM rangi WHERE id =".$user['stanowisko']);
										$role1 = row("SELECT * FROM rangi WHERE id =".$user1['stanowisko']);
										echo '<p class="text-center"><a href="index.php?a=profile&p='.$user['id'].'" style="color: '.$role['kolor'].'">'.$user['login'].'</a> • <a href="index.php?a=profile&p='.$user1['id'].'" style="color: '.$role1['kolor'].'">'.$user1['login'].'</a></p>';
									} else {
										echo '<p class="text-center">-</p>';
									}

								?>

								<div class="row">
									<div class="col-md-6">
										<ul class="list-group list-group-unbordered mb-3">
											<li class="list-group-item">
												<b>ID</b><a class="float-right"><?=$target['id'];?></a>
											</li>
											<li class="list-group-item">
												<b>Numer Taborowy</b><a class="float-right"><?=$target['taborowy'];?></a>
											</li>
											<li class="list-group-item">
												<b>Marka</b><a class="float-right"><?=$target['marka'];?></a>
											</li>
											<li class="list-group-item">
												<b>Model</b><a class="float-right"><?=$target['model'];?></a>
											</li>
											<li class="list-group-item">
												<b>Rok produkcji</b><a class="float-right"><?=$target['produkcja'];?></a>
											</li>
											<li class="list-group-item">
												<b>Przegląd ważny do</b><a class="float-right"><?=$target['przegląd'];?></a>
											</li>
											<li class="list-group-item">
												<b>Numer rejestracyjny</b><a class="float-right"><?=$target['nr_rejestracyjny'];?></a>
											</li>
										</ul>
									</div>
									<div class="col-md-6">
										<ul class="list-group list-group-unbordered mb-3">
											<li class="list-group-item">
												<b>Klasa</b><a class="float-right"><?=$target['klasa'];?></a>
											</li>
											<li class="list-group-item">
												<b>Rodzaj podłogi</b><a class="float-right"><?=$target['podłoga'];?></a>
											</li>
											<li class="list-group-item">
												<b>Zajezdnia</b><a class="float-right"><?=$target['zajezdnia'];?></a>
											</li>

											<li class="list-group-item">
												<b>Uwagi</b><a class="float-right"><?=$target['uwagi'];?></a>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<!-- /.card-body -->
						</div>
						<!-- /.card -->
					</div>
					<div class="col-md-3">

					</div>
		          <!-- /.col -->
				</div>
				<!-- /.row (main row) -->

			</div><!-- /.container-fluid -->
		</section>
	<?php endif; ?>
