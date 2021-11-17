	<?php
		if($perm['zarzadanie panelem'] == '0'){
			header('Location: index.php?a=home');
		}
		require_once './funkcje/UsersModalFunction.php';
		require_once './funkcje/UsersFunction.php';
		$count = row("SELECT count(id) AS id FROM users");
		$zatrudnieni = row("SELECT count(id) AS id FROM users WHERE stanowisko != 21 AND stanowisko != 22 AND deleted = 0");
		$przyjeci = row("SELECT count(id) AS id FROM users WHERE stanowisko = 21 OR stanowisko = 22 AND deleted = 0");
		$zwolnieni = row("SELECT count(id) AS id FROM users WHERE deleted = 1");
		$limit = 24;
		$total = $count['id'];
		$pages = ceil($total / $limit);

		if (isset($_GET['strona'])) {
			//
			if($_GET['strona'] < 1 || $_GET['strona'] > $pages){
				$page = 1;
			} else {
				$page = $_GET['strona'];
			}
		} else {
			$page = 1;
		}

		if (isset($_GET['search'])) {
			$search = vtxt($_POST['search']);
			$targets = call("SELECT * FROM users WHERE login = '".$search."' OR nr_sluzbowy = $search OR id = $search");

		} else {
			$start = ($page-1) * $limit;
			$targets = call("SELECT * FROM users WHERE stanowisko != 21 AND stanowisko != 22 AND deleted = 0 ORDER BY nr_sluzbowy LIMIT $start , $limit");
		}

		//echo 'total', $total, ' pages', $pages, ' limit', $limit, ' start', $start, ' page', $page;
		$l1 = call("SELECT * FROM tabor");
		$l2 = call("SELECT tid FROM tabor_w_ruchu");
		$l3 = call("SELECT tid FROM niepzrzdzielactabor");
		$l4 = call("SELECT tid FROM tabor_w_ruchu WHERE tid not in (select tid from niepzrzdzielactabor WHERE uid='".$user['id']."')");
		print "<pre>";
		while ($row = mysqli_fetch_array($l4)){
			$pojazdy = call("SELECT * FROM tabor WHERE id =".$row['tid']);
			while ($row = mysqli_fetch_array($pojazdy)){
				//print_r($row);
			}
		}
		print "</pre>";

		if ($total > $limit) {
			$poprzednia = $page - 1;
			$nastepna = $page + 1;
			if ($poprzednia > 0) {
				$btn_poprzednia = '<a class="page-link" href="index.php?a=użytkownicy&strona='.$poprzednia.'">&laquo;</a>';
			} else {
				$btn_poprzednia = "<a class='page-link' href='index.php?a=użytkownicy'>&laquo;</a>";
			}
			if ($nastepna <= $pages) {
				$btn_nastepna = '<a class="page-link" href="index.php?a=użytkownicy&strona='.$nastepna.'">&raquo;</a>';
			} else {
				$btn_nastepna = '<a class="page-link" href="index.php?a=użytkownicy&strona='.$page.'">&raquo;</a>';
			}
		} else {
			$btn_poprzednia = "<a class='page-link' href='index.php?a=użytkownicy'>&laquo;</a>";
			$btn_nastepna = '<a class="page-link" href="index.php?a=użytkownicy&strona='.$page.'">&raquo;</a>';
		}

		if(isset($_GET['awans']) && !isset($_GET['edytujdane']) && !isset($_GET['zwolnij'])){
			$id = vtxt($_GET['awans']);
			if(empty($id)){
				throwInfo('danger', 'naura', true);
			} else {
				$target = row("SELECT * FROM users WHERE id = '".$id."'");
				if(empty($target)){
					throwInfo('danger', 'nie ma takiego użytkownika', true);
				} else {
					if(!empty($_POST)){
						if(!empty($_POST['nr_sluzbowy"']) || !empty($_POST['stanowisko']) || !empty($_POST['zarzad'])){
							$nr = vtxt($_POST['nr_sluzbowy']);
							$stanowisko = vtxt($_POST['stanowisko']);
							if(!empty($_POST['zarzad'])){
								$check = $_POST['zarzad'];
							} else {
								$check = 0;
							}
							//print_r($user['id']);
							awans_user($id, $nr, $stanowisko, $check, $user['id']);
						} else {
							throwInfo('danger', 'Puste pola! Spróbuj ponownie!', true);
						}
					} else {
						header('Location: index.php?a=użytkownicy');
					}
				}
			}
		} elseif(!isset($_GET['awans']) && !isset($_GET['edytujdane']) && isset($_GET['zwolnij'])){
			$id = vtxt($_GET['zwolnij']);
			if(empty($id)){
				throwInfo('danger', 'naura', true);
			} else {
				$target = row("SELECT * FROM users WHERE id = '".$id."'");
				if(empty($target)){
					throwInfo('danger', 'nie ma takiego użytkownika', true);
				} else {
					if(!empty($_POST)){
						if(!empty($_POST['data"']) || !empty($_POST['powod'])){
							$sid = $user['id'];
							$data = vtxt($_POST['data']);
							$powod = vtxt($_POST['powod']);

							//print_r($user['id']);
							//awans_user($id, $nr, $stanowisko, $check, $user['id']);
							zwolnij_user($id, $data, $powod, $sid);
						} else {
							throwInfo('danger', 'Puste pola! Spróbuj ponownie!', true);
						}
					} else {
						header('Location: index.php?a=użytkownicy');
					}
				}
			}
		}



		if (isset($_SESSION['danger']))
		{
			echo throwInfo('danger', $_SESSION['danger'], true);
			unset($_SESSION['danger']);
		}
		if (isset($_SESSION['success']))
		{
			echo throwInfo('success', $_SESSION['success'], true);
			unset($_SESSION['success']);
		}
		if (isset($_SESSION['info']))
		{
			echo throwInfo('info', $_SESSION['info'], true);
			unset($_SESSION['info']);
		}
		if (isset($_SESSION['warning']))
		{
			echo throwInfo('warning', $_SESSION['warning'], true);
			unset($_SESSION['warning']);
		}
	?>

	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Użytkownicy</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="index.php">Panel Administracyjny</a></li>
						<li class="breadcrumb-item active">Użytkownicy</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->




    <!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card shadow mb-4">
						<div class="card-header">
							<div class="float-right">
								<form class="d-flex" action="index.php?a=użytkownicy&search" method="post">
									<input class="form-control me-2" type="search" placeholder="ID lub Numer służbowy" type="text" name="search">
									<button class="btn btn-outline-success" type="submit">Search</button>
								</form>
								<div class="pt-2">
									<a href="index.php?a=użytkownicy" class="btn btn-outline-info">Pierwsza Strona<a>
									<div class="float-right">
										<ul class="pagination">
											<li class="page-item"><?=$btn_poprzednia?></li>
											<li class="page-item"><?=$btn_nastepna?></li>
										</ul>
									</div>
								</div>
							</div>
							<div class="float-left">
								<h4 class="m-0 font-weight-bold">Użytkownicy</h4>
								<h6>Strona <?=$page;?> z <?=$pages?></h6>
								<h6>Użytkownicy w systemie <?=$total;?></h6>
								<h6>Użytkownicy zatrudnieni <?=$zatrudnieni['id'];?></h6>
								<h6>Użytkownicy przyjeci <?=$przyjeci['id'];?></h6>
								<h6>Użytkownicy Zwolnieni <?=$zwolnieni['id'];?></h6>
							</div>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<div class="row">
								<?php
									$i = 1;
									if ($targets->num_rows == 0):
										echo
										'<div class="card-body">
											<div class="alert alert-warning">
												<h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
												Brak Wyników!
											</div>
										</div>';
									else :
										while ($row = mysqli_fetch_array($targets)):

										$role = row("SELECT * FROM rangi WHERE id = ".$row['stanowisko']);
										$etat = row("SELECT * FROM etaty WHERE uid = ".$row['id']);
										$etat = $etat['poniedzialek'] + $etat['wtorek'] + $etat['sroda'] + $etat['czwartek'] + $etat['piatek'] + $etat['sobota'] + $etat['niedziela'];
										$nie_pojazdy = row("SELECT id FROM niepzrzdzielactabor WHERE uid = '".$row['id']."'");
										$logi = row("SELECT id FROM logi WHERE uid = ".$row['id']);
										$logi_logowania = row("SELECT id FROM logi_logowania WHERE uid = ".$row['id']);

										if($row['dc'] == '1'){
											$discord = row("SELECT * FROM discord WHERE uid = ".$row['id']);
											$dc_konto = true;
										} else {
											$dc_konto = false;
										}

										$user_id = $row['id'];
										if($user_id == $user['id']){
											$zwolnij_przycisk = '<button type="button" class="btn btn-danger btn-block" disabled>Zwolnij</button>';
											$modal_zwolnij = false;
										} else {
											$zwolnij_przycisk = '<button type="button" id="zwolnij-btn-'.$user_id.'" class="btn btn-danger btn-block">Zwolnij</button>';
											$modal_zwolnij = true;
										}
										$login_usera = '<a href="index.php?a=profile&p='.$row['id'].'" style="color: '.$role['kolor'].'">['.$role['kod_roli'].''.$row['nr_sluzbowy'].'] '.$row['login'].'</a>';
										?>
										<div class="col-12 col-lg-4">
											<div class="card shadow mb-4">
												<div class="card-header">
													<h3 class="m-0 font-weight-bold"><?=$login_usera?></h3>
												</div>
												<div class="card-body">
													<p class="text-center"><img class="mx-auto element rounded-circle" src="./../portal/img/avatar5.png" style="width: 125px"></p>
													<p class="text-center"><?=$login_usera?></p>
													<p class="text-center"><a href="index.php?a=rangi&id=<?=$role['id']?>" style="color: <?=$role['kolor']?>"><?=$role['nazwa']?></a></p>
													<br>
													<ul class="list-group list-group-unbordered mb-3">
														<li class="list-group-item">
															<b>ID użytkownika</b><b class="float-right"><?=$row['id']?></b>
														</li>
														<li class="list-group-item">
															<b>E-mail</b><b class="float-right"><?=$row['email']?></b>
														</li>
														<li class="list-group-item">
															<b>Etat</b><b class="float-right"><?=$etat, '/7';?></b>
														</li>
														<li class="list-group-item">
															<b>Data Zatrudnienia</b><b class="float-right"><?=$row['zatrudnienie']?></b>
														</li>
													</ul>
													<ul class="list-group list-group-unbordered mb-3">
														<li class="list-group-item">
															<b>Stały przydział</b><b class="float-right">Brak danych</b>
														</li>
														<li class="list-group-item">
															<b>Pojazdy nieprzydzielanie</b>
															<b class="float-right">
															<?php
																if(!$nie_pojazdy){
																	echo 'Brak danych!';
																} else {
																	echo '<button type="button" class="btn btn-info btn-sm nie-pojazd-'.$user_id.'"><i class="fas fa-search"></i> Podgląd</button>';
																}
															?>

															</b>
														</li>
													</ul>
													<ul class="list-group list-group-unbordered mb-3">
														<li class="list-group-item">
															<b>Przejechane kilometry</b><b class="float-right"><?=$row['kilometry']?> km</b>
														</li>
														<li class="list-group-item">
															<b>Ilość zaliczonych raportów</b><b class="float-right" style="color: #009900"><?=$row['raporty']?></b>
														</li>
														<li class="list-group-item">
															<b>Ilość niezaliczonych raportów</b><b class="float-right" style="color: #ff0000"><?=$row['nieraporty']?></b>
														</li>
														<li class="list-group-item">
															<b>Ilość anulowanych raportów</b><b class="float-right" style="color: #7901ff"><?=user_anuluj_raporty_count($row);?></b>
														</li>
													</ul>
													<ul class="list-group list-group-unbordered mb-3">
														<li class="list-group-item">
															<b>Logi użytkownika</b>
															<b class="float-right">
															<?php
																if(!$logi){
																	echo 'Brak danych!';
																} else {
																	echo '<button type="button" class="btn btn-info btn-sm log-'.$user_id.'"><i class="fas fa-search"></i> Podgląd</button>';
																}
															?>
															</b>
														</li>
														<li class="list-group-item">
															<b>Logi logowania użytkownika</b>
															<b class="float-right">
															<?php
																if(!$logi_logowania){
																	echo 'Brak danych!';
																} else {
																	echo '<button type="button" id="log-logowanie-'.$user_id.'" class="btn btn-info btn-sm"><i class="fas fa-search"></i> Podgląd</button>';
																}
															?>
															</b>
														</li>
													</ul>
													<ul class="list-group list-group-unbordered mb-3">
														<li class="list-group-item">
															<b>Konto Discord</b>
															<b class="float-right">
																<?php
																	if($dc_konto){
																		echo '<i style="color: green;" class="fa fa-check"></i>';
																	}else{
																		echo '<i style="color: red;" class="fa fa-times"></i>';
																	}
																?>
															</b>
														</li>
														<li class="list-group-item">
															<b>ID konta Discord</b>
															<b class="float-right">
																<?php
																	if($dc_konto){
																		echo $discord['dcid'];
																	}else{
																		echo 'Brak danych!';
																	}
																?>
															</b>
														</li>
														<li class="list-group-item">
															<b>Avatar</b>
															<b class="float-right">
																<?php
																	if(!empty($discord['avatar'])){
																		echo '<a href="https://cdn.discordapp.com/avatars/'.$discord['dcid'].'/'.$discord['avatar'].'.png" target="_blank">Klik</a>';
																	} else {
																		echo 'Brak avataru!';
																	}
																?>
															</b>
														</li>
													</ul>
													<ul class="list-group list-group-unbordered mb-3">
														<li class="list-group-item">
															<b>Konto w Panelu (Aktywne)</b>
															<b class="float-right">
																<?php
																	if($row['deleted'] == '0'){
																		echo '<i style="color: green;" class="fa fa-check"></i>';
																	}else{
																		echo '<i style="color: red;" class="fa fa-times"></i>';
																	}
																?>
															</b>
														</li>
													</ul>
												</div>
												<div class="card-footer">
													<?php
														if($row['stanowisko'] == 21 || $row['stanowisko'] == 22):?>
														<h5><b>Ta osoba jest rekrutowana! Brak możliwości edycji danych!</b></h5>
													<?php
														elseif($row['deleted'] == '1'):
															//
														echo '
														<td class="project-actions">
															<button type="button" class="btn btn-success btn-block" disabled><i class="fas fa-unlock-alt"></i> Przywróć konto do systemu</button>
															<button type="button" class="btn btn-danger btn-block" disabled><i class="fas fa-user-lock"></i> Zablokuj konto w systemie</button>
														</td>';

														else:
													?>
														<td class="project-actions">
															<button type="button" id="awans-btn-<?=$user_id?>" class="btn btn-success btn-block">Edytuj Stanowisko</button>
															<button type="button" id="edytuj-btn-<?=$user_id?>" class="btn btn-info btn-block ">Edytuj dane</button>
															<?=$zwolnij_przycisk?>
														</td>
													<?php
														endif;
													?>
												</div>
											</div>
										</div>
										<!-- nie pojazdy -->
										<?php echo modal_nie_pojazdy($row['id']);?>
										<!-- logi -->
										<?php
											if($logi){
												echo modal_log($row['id']);
											} else {
											}

										?>
										<!-- logi logowania-->
										<?php
											if($logi_logowania){
												echo modal_log_logowanie($row['id']);
											} else {
											}

										?>
										<!-- awans-->
										<?php echo modal_awans($row['id']);?>
										<!-- edytuj dane-->
										<?php echo modal_edytuj($row['id']);?>
										<!-- zwolnij -->
										<?php
											if($modal_zwolnij){
												echo modal_zwolnij($row['id']);
											} else {
											}
										?>

										<!-- Remember to include jQuery :) 
										<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>-->
										<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

										<!-- jQuery Modal
										<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.2/jquery.modal.min.js"></script>
										<script src="https://cdn.jsdelivr.net/npm/jquery-modal@0.9.2/jquery.modal.min.js"></script>-->
										<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
										<!-- Page specific script -->
										<script type="text/javascript">
											$(document).ready(function() {
												$(".nie-pojazd-<?=$user_id?>").on('click', function() {
													$("#modal-nie-pojazd-<?=$user_id?>").modal('show');
												});
												$(".log-<?=$user_id?>").on('click', function() {
													$("#modal-log-<?=$user_id?>").modal('show');
												});
												$("#log-logowanie-<?=$user_id?>").on('click', function() {
													$("#modal-log-logowanie-<?=$user_id?>").modal('show');
												});

												$("#awans-btn-<?=$user_id?>").on('click', function() {
													$("#modal-awans-<?=$user_id?>").modal('show');
												});

												$("#edytuj-btn-<?=$user_id?>").on('click', function() {
													$("#modal-edytuj-<?=$user_id?>").modal('show');
												});
												$("#zwolnij-btn-<?=$user_id?>").on('click', function() {
													$("#modal-zwolnij-<?=$user_id?>").modal('show');
												})
											});
										</script>




									<?php endwhile?>
								<?php endif?>
							</div>
						</div>
						<div class="card-footer">
							<div class="float-right">
								<form class="d-flex" action="index.php?a=użytkownicy&search" method="post">
									<input class="form-control me-2" type="search" placeholder="ID lub Numer służbowy" type="text" name="search">
									<button class="btn btn-outline-success" type="submit">Search</button>
								</form>
								<div class="pt-2">
									<a href="index.php?a=użytkownicy" class="btn btn-outline-info">Pierwsza Strona<a>
									<div class="float-right">
										<ul class="pagination">
											<li class="page-item"><?=$btn_poprzednia?></li>
											<li class="page-item"><?=$btn_nastepna?></li>
										</ul>
									</div>
								</div>
							</div>
							<div class="float-left">
								<h4 class="m-0 font-weight-bold">Użytkownicy</h4>
								<h6>Strona <?=$page;?> z <?=$pages?></h6>
								<h6>Użytkownicy w systemie <?=$total;?></h6>
								<h6>Użytkownicy zatrudnieni <?=$zatrudnieni['id'];?></h6>
								<h6>Użytkownicy przyjeci <?=$przyjeci['id'];?></h6>
								<h6>Użytkownicy Zwolnieni <?=$zwolnieni['id'];?></h6>
							</div>
						</div>
						<!-- /.card-header -->
					  <!-- /.card-body -->
					</div>
					<div class="card shadow mb-4">
						<a href="" class="btn btn-success">Dodaj</a>
					</div>
				</div>
				<!-- /.card -->
			</div><!-- /.container-fluid -->
		</div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

	<!-- add Modal -->
