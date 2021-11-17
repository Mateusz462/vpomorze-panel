<?php
	require_once "dist/themapart/alerts.php";
	//hasPermissionTo('security', $user_role, 'profile_users');

	if (!isset($_GET['p'])){
		$target = getUser(vtxt($_SESSION['id']));
		$role = row("SELECT * FROM rangi WHERE id = ".$target['stanowisko']);
		$login_usera = '<a href="index.php?a=profile&p='.$target['id'].'" style="color: '.$role['kolor'].'">['.$role['kod_roli'].''.$target['nr_sluzbowy'].'] '.$target['login'].'</a>';
		$role_link = '<a href="index.php?a=rangi&id='.$role['id'].'" style="color: '.$role['kolor'].'">'.$role['nazwa'].'</a>';
	} elseif (isset($_GET['p'])){
		$target = getUser(vtxt($_GET['p']));
		$role = row("SELECT * FROM rangi WHERE id = ".$target['stanowisko']);
		$login_usera = '<a href="index.php?a=profile&p='.$target['id'].'" style="color: '.$role['kolor'].'">['.$role['kod_roli'].''.$target['nr_sluzbowy'].'] '.$target['login'].'</a>';
		$role_link = '<a href="index.php?a=rangi&id='.$role['id'].'" style="color: '.$role['kolor'].'">'.$role['nazwa'].'</a>';
	}
	// $target = getUser(vtxt($_GET['p']));
	// if (!$target){
	// } else {
	// 	$role = row("SELECT * FROM rangi WHERE id = ".$target['stanowisko']);
	// }
?>

		<div class="content-header">
		    <div class="container-fluid">
		        <div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0 text-dark">Profil Pracownika: <?=$login_usera?></h1>
					</div><!-- /.col -->
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="index.php">Strona Główna</a></li>
							<li class="breadcrumb-item">Profil Pracownika</li>
							<li class="breadcrumb-item active"><?=$login_usera?></li>
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
					<div class="col-xl-4 col-12">
						<div class="card shadow mb-4">
							<div class="card-body">
								<p class="text-center"><img class="mx-auto element rounded-circle" src="./../portal/img/avatar5.png" style="width: 125px"></p>
								<p class="text-center"><?=$login_usera?></p>
								<p class="text-center"><?=$role_link?></p>
								<br>
								<ul class="list-group list-group-unbordered mb-3">
									<li class="list-group-item">
										<?php $kod = row("SELECT * FROM przewoznicy WHERE id = ".$target['guild']);?>
										<b>Kod przewoźnika</b><b class="float-right"><?=$kod['tag'];?></b>
									</li>
									<li class="list-group-item">
										<?php $role = row("SELECT * FROM rangi WHERE id = ".$target['stanowisko']);?>
										<b>Kod pracownika</b><b class="float-right"><?=' [', $role['kod_roli'], $target['nr_sluzbowy'],']';?></b>
									</li>
									<li class="list-group-item">
										<b>Data zatrudnienia</b><b class="float-right"><?=$target['zatrudnienie'];?></b>
									</li>
								</ul>
								<ul class="list-group list-group-unbordered mb-3">
									<li class="list-group-item">
										<b>Ilość punktów</b><b class="float-right"><?=$target['punkty'];?> pkt</b>
									</li>
									<li class="list-group-item">
										<b>Przejechane kilometry</b><b class="float-right"><?=$target['kilometry'];?> km</b>
									</li>
									<li class="list-group-item">
										<b>Ilość zaliczonych raportów</b><b class="float-right" style="color: #009900">1</b>
									</li>
									<li class="list-group-item">
										<b>Ilość niezaliczonych raportów</b><b class="float-right" style="color: #ff0000">4</b>
									</li>
									<li class="list-group-item">
										<b>Ilość anulowanych raportów</b><b class="float-right" style="color: #7901ff">0</b>
									</li>
								</ul>
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
								<br>

							</div>
						</div>
					</div>
		          <!-- /.col -->
				</div>
				<!-- /.row (main row) -->
			</div><!-- /.container-fluid -->
		</section>
