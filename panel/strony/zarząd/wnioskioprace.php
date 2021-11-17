	<?php
		if($perm['zarzadzanie wnioskami o prace'] == '0'){
			header('Location: index.php?a=home');
		}
		require_once './funkcje/WnioskiOPrace-z.php';
		require_once './skrypty/generator.php';

		if (!isset($_GET['view'])) {
			$strona1 = true;
			$strona2 = false;
			$target = null;
		} elseif (isset($_GET['view']) && !isset($_GET['remember'])) {
			$view = vtxt($_GET['view']);
			$strona1 = false;
			$strona2 = true;

			$target = row("SELECT * FROM aplikacje WHERE id = ".$view);
			if(!$target){
				header('Location: index.php?a=home');
			} else {
				$dataczegos = date('d.m.Y',$target['data']);
			}

		}  elseif (isset($_GET['view']) && isset($_GET['remember'])) {
			$view = vtxt($_GET['view']);
			$strona1 = true;
			$strona2 = false;

			$target = call("SELECT * FROM aplikacje WHERE status = 2");
			if(!$target){
				throwInfo('info', 'brak wyników', true);
			} else {
				send_email_remember_wnioski_status2($target);
			}

		} else {
			$strona1 = true;
			$strona2 = false;
		}
	?>

	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Wnioski o pracę</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="index.php?a=home">Panel kierowcy</a></li>
						<li class="breadcrumb-item active">Wnioski o pracę</li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
    </section>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<?php
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
			<!-- Small boxes (Stat box) -->
			<div class="row">
				<?php if($strona1):?>
					<div class="col-12">
						<div class="card shadow mb-4">
							<div class="card-header py-3">
								<h3 class="m-0 font-weight-bold text-primary">Wnioski o Pracę</h3>
							</div>
							<!-- /.card-header -->
							<div class="card-body table-responsive p-0">
								<table class="table table-hover text-nowrap text-center">
									<?php
										wnioski_o_prace();
									?>
								</table>
							</div>
							<!-- /.card-body -->
						</div>
						<!-- /.card -->
					</div>
				<?php elseif($strona2):?>
					<div class="col-12">
						<div class="card shadow mb-4">
							<div class="card-header py-3">
								<h3 class="m-0 font-weight-bold text-primary">Wniosek o Pracę</h3>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-3">
										<ul class="list-group list-group-unbordered mb-3">
											<li class="list-group-item">
												<b>Data złożenia wniosku</b><span class="float-right"><?=$dataczegos;?></span>
											</li>
											<li class="list-group-item">
												<b>Nazwa uzytkownika</b><span class="float-right"><?=$target['login'];?></span>
											</li>
											<li class="list-group-item">
												<b>E-mail</b><span class="float-right"><?=$target['email'];?></span>
											</li>
											<li class="list-group-item">
												<b>Stanowisko</b><span class="float-right"><?=$target['stanowisko'];?></span>
											</li>
											<li class="list-group-item">
												<?php $p = row("SELECT * FROM przewoznicy WHERE id = ".$target['przewoznik']);?>
												<b>Przewoźnik</b><span class="float-right"><?=$p['tag']?></span>
											</li>
											<li class="list-group-item">
												<b>Addony</b><a class="float-right"></a>
											</li>
											<li class="list-group-item">
												<b>Add-on Strassenbahn NF6D Essen/Gelsenkirchen</b><a class="float-right">
												<?php
													if($target['addon'] == '1') {
														echo '<i style="color: green;" class="fa fa-check"></i>';
													}else{
														echo '<i style="color: red;" class="fa fa-times"></i>';
													};
												?></a>
											</li>
										</ul>
									</div>
									<div class="col-3">
										<ul class="list-group list-group-unbordered mb-3">
											<li class="list-group-item">
												<?php
													$cos = $target['pon'] + $target['wt'] + $target['sr'] + $target['czw'] + $target['pi'] + $target['sob'] + $target['niedz'];
												?>
												<b>Etat</b><a class="float-right"><?=$cos;?>/7</a>
											</li>
											<li class="list-group-item">
												<b>Poniedziałek</b><a class="float-right">
												<?php
													if($target['pon'] == '1') {
														echo '<i style="color: green;" class="fa fa-check"></i>';
													}else{
														echo '<i style="color: red;" class="fa fa-times"></i>';
													};
												?></a>
											</li>
											<li class="list-group-item">
												<b>Wtorek</b><a class="float-right">
												<?php
													if($target['wt'] == '1') {
														echo '<i style="color: green;" class="fa fa-check"></i>';
													}else{
														echo '<i style="color: red;" class="fa fa-times"></i>';
													};
												?></a>
											</li>
											<li class="list-group-item">
												<b>Środa</b><a class="float-right">
												<?php
													if($target['sr'] == '1') {
														echo '<i style="color: green;" class="fa fa-check"></i>';
													}else{
														echo '<i style="color: red;" class="fa fa-times"></i>';
													};
												?></a>
											</li>
											<li class="list-group-item">
												<b>Czwartek</b><a class="float-right">
												<?php
													if($target['czw'] == '1') {
														echo '<i style="color: green;" class="fa fa-check"></i>';
													}else{
														echo '<i style="color: red;" class="fa fa-times"></i>';
													};
												?></a>
											</li>
											<li class="list-group-item">
												<b>Piątek</b><a class="float-right">
												<?php
													if($target['pi'] == '1') {
														echo '<i style="color: green;" class="fa fa-check"></i>';
													}else{
														echo '<i style="color: red;" class="fa fa-times"></i>';
													};
												?></a>
											</li>
											<li class="list-group-item">
												<b>Sobota</b><a class="float-right">
												<?php
													if($target['sob'] == '1') {
														echo '<i style="color: green;" class="fa fa-check"></i>';
													}else{
														echo '<i style="color: red;" class="fa fa-times"></i>';
													};
												?></a>
											</li>
											<li class="list-group-item">
												<b>Niedziela</b><a class="float-right">
												<?php
													if($target['niedz'] == '1') {
														echo '<i style="color: green;" class="fa fa-check"></i>';
													}else{
														echo '<i style="color: red;" class="fa fa-times"></i>';
													};
												?></a>
											</li>
										</ul>
									</div>
									<div class="col-6">
										<?php if($target['status'] == '0'):?>
											<button class="btn btn-success btn-block dodaj_btn" type="button">Przyjmij wniosek</button>
											<button class="btn btn-danger btn-block odrzuc_btn" type="button">Odrzuć wniosek</button>
										<?php elseif($target['status'] == '1'):?>
											<button class="btn btn-danger btn-block">Nie przeszedł/a 1 etapu rekrutacji</button>
										<?php elseif($target['status'] == '2'):?>
											<button class="btn btn-success btn-block uprawnienia_btn">Przyjmij Nowego pracownika do firmy</button>
											<button class="btn btn-danger btn-block nieprzyjety_btn">Odrzuć kandydature z powodu nie przejścia rozmowy kwalifikacyjnej</button>
										<?php elseif($target['status'] == '3'):?>
											<button class="btn btn-danger btn-block">Nie przeszedł/a 2 etapu rekrutacji</button>
										<?php elseif($target['status'] == '4'):?>
											<button class="btn btn-success btn-block przyjety_btn">Przeszedł/a 2 etap rekrutacji oczekuje na dodane uprawnień</button>
										<?php endif;?>
									</div>
								</div>
								<div class="row">
									<div class="col-6">
										<ul class="list-group list-group-unbordered mb-3">
											<li class="list-group-item">
												<b>Ile czasu grasz w OMSI (od kiedy)?</b><span class="float-right"><?=$target['ileczasu'];?></span>
											</li>
											<li class="list-group-item">
												<b>Dlaczego ty?</b><span class="float-right"><?=$target['dlaczego'];?></span>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php endif;?>
			</div>
		</div><!-- /.container-fluid -->
	</section>
	<?php
		if($strona2){
			if($target['status'] == '0'){
				$modal_tak = true;
				$id_modal = 'dodaj';
				$tytul = 'Dodawanie użytkownika do systemu';
			}elseif($target['status'] == '2'){
				$modal_tak = true;
				$id_modal = 'uprawnienia';
				$tytul = 'Nadawanie odpowiednich uprawnień użytkownika do systemu';
			} else {
				$modal_tak = false;
			}
		}
	?>
	<?php if($strona2):
			if($modal_tak):
	?>
		<!-- add Modal -->
		<div id="<?=$id_modal?>" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title"><?=$tytul?></h4>
					</div>
					<form action="index.php?a=wnioskioprace-zarządzanie&view=<?=$view?>&<?=$id_modal?>=true" method="POST">
						<div class="modal-body">
							<?php if($target['status'] == '0'):?>
								<div class="form-group">
									<label>Login</label>
									<input class="form-control" placeholder="Login" name="login" value="<?=$target['login']?>" readonly>
								</div>
								<div class="form-group">
									<label>E-mail</label>
									<input class="form-control" placeholder="E-mail" name="email" value="<?=$target['email']?>" readonly>
								</div>
								<div class="form-group">
									<label>Stanowisko</label>
									<input class="form-control" placeholder="Stanowisko" name="stanowisko" value="<?=$target['stanowisko']?>" readonly>
								</div>
								<div class="form-group">
									<label>Wygenerowane Hasło</label>
									<input class="form-control" name="pass" placeholder="Hasło" value="<?php generate_pass();?>" readonly required>
								</div>
							<?php elseif($target['status'] == '2'):?>
								<?php
									if($target['stanowisko'] == 'Praktykant - Kierowca'){
										$stanowisko = 'Kierowca';
									}elseif($target['stanowisko'] == 'Praktykant - Motorniczy'){
										$stanowisko = 'Motorniczy';
									}else{
										$_SESSION['danger'] = 'Błąd! Złe stanowisko! Spróbuj ponownie! lub Skontaktuj się z programistą!';
										header('Location: index.php?a=wnioskioprace-zarządzanie');
									}
								?>
								<div class="form-group">
									<label>Login</label>
									<input class="form-control" placeholder="Login" name="login" value="<?=$target['login']?>" readonly>
								</div>
								<div class="form-group">
									<label>E-mail</label>
									<input class="form-control" placeholder="E-mail" name="email" value="<?=$target['email']?>" readonly>
								</div>
								<div class="form-group">
									<label>Stanowisko</label>
									<input class="form-control" placeholder="Stanowisko" name="stanowisko" value="<?=$stanowisko?>" readonly>
								</div>
								<div class="form-group">
									<label>Numer Służbowy</label>
									<input class="form-control" placeholder="Numer Służbowy" name="nr" value="">
								</div>
								<ul class="list-group list-group-unbordered mb-3">
									<li class="list-group-item">
										<?php
											$cos = $target['pon'] + $target['wt'] + $target['sr'] + $target['czw'] + $target['pi'] + $target['sob'] + $target['niedz'];
										?>
										<b>Etat</b><a class="float-right"><?=$cos;?>/7</a>
									</li>
									<li class="list-group-item">
										<b>Poniedziałek</b><a class="float-right">
										<?php
											if($target['pon'] == '1') {
												echo '<i style="color: green;" class="fa fa-check"></i>';
											}else{
												echo '<i style="color: red;" class="fa fa-times"></i>';
											};
										?></a>
									</li>
									<li class="list-group-item">
										<b>Wtorek</b><a class="float-right">
										<?php
											if($target['wt'] == '1') {
												echo '<i style="color: green;" class="fa fa-check"></i>';
											}else{
												echo '<i style="color: red;" class="fa fa-times"></i>';
											};
										?></a>
									</li>
									<li class="list-group-item">
										<b>Środa</b><a class="float-right">
										<?php
											if($target['sr'] == '1') {
												echo '<i style="color: green;" class="fa fa-check"></i>';
											}else{
												echo '<i style="color: red;" class="fa fa-times"></i>';
											};
										?></a>
									</li>
									<li class="list-group-item">
										<b>Czwartek</b><a class="float-right">
										<?php
											if($target['czw'] == '1') {
												echo '<i style="color: green;" class="fa fa-check"></i>';
											}else{
												echo '<i style="color: red;" class="fa fa-times"></i>';
											};
										?></a>
									</li>
									<li class="list-group-item">
										<b>Piątek</b><a class="float-right">
										<?php
											if($target['pi'] == '1') {
												echo '<i style="color: green;" class="fa fa-check"></i>';
											}else{
												echo '<i style="color: red;" class="fa fa-times"></i>';
											};
										?></a>
									</li>
									<li class="list-group-item">
										<b>Sobota</b><a class="float-right">
										<?php
											if($target['sob'] == '1') {
												echo '<i style="color: green;" class="fa fa-check"></i>';
											}else{
												echo '<i style="color: red;" class="fa fa-times"></i>';
											};
										?></a>
									</li>
									<li class="list-group-item">
										<b>Niedziela</b><a class="float-right">
										<?php
											if($target['niedz'] == '1') {
												echo '<i style="color: green;" class="fa fa-check"></i>';
											}else{
												echo '<i style="color: red;" class="fa fa-times"></i>';
											};
										?></a>
									</li>
								</ul>
								<ul class="list-group list-group-unbordered mb-3">
									<li class="list-group-item">
										<b>Uprawnienia wnioski</b><a class="float-right">4/6</a>
									</li>
									<li class="list-group-item">
										<b>pozniej sie zmieni</b><a class="float-right">😀</a>
									</li>
									<li class="list-group-item">
										<b>Wniosek o zmianę etatu</b>
										<a class="float-right">
											<i style="color: green;" class="fa fa-check"></i>
										</a>
									</li>
									<li class="list-group-item">
										<b>Wniosek o urlop</b>
										<a class="float-right">
											<i style="color: green;" class="fa fa-check"></i>
										</a>
									</li>
									<li class="list-group-item">
										<b>Wypowiedzenie umowy o pracę</b>
										<a class="float-right">
											<i style="color: green;" class="fa fa-check"></i>
										</a>
									</li>
									<li class="list-group-item">
										<b>Wniosek o kurs z wolnego</b>
										<a class="float-right">
											<i style="color: green;" class="fa fa-check"></i>
										</a>
									</li>
									<li class="list-group-item">
										<b>Wniosek o stały przydział pojazdu</b>
										<a class="float-right">
											<i style="color: red;" class="fa fa-times"></i>
										</a>
									</li>
									<li class="list-group-item">
										<b>Wniosek o nieprzydzielanie pojazdu</b>
										<a class="float-right">
											<i style="color: red;" class="fa fa-times"></i>
										</a>
									</li>
								</ul>
							<?php else:?>
							<?php endif?>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Anuluj</button>
							<button type="submit" class="btn btn-primary">Zatwierdź</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	<?php endif?>
	<?php endif?>
	<?php
		if($strona2){
			if($target['status'] == '0'){
				$modal_nie = true;
				$id_modal = 'odrzuc';
				$tytul = 'Odrzucanie wniosku o pracę';
			}elseif($target['status'] == '2'){
				$modal_nie = true;
				$id_modal = 'nieprzyjety';
				$tytul = 'Odrzucanie kandydatury z powodu nie przejścia rozmowy kwalifikacyjnej';
			} else {
				$modal_nie = false;
			}
		}
	?>
	<?php if($strona2):if($modal_nie):?>
		<!-- delete Modal -->
		<div id="<?=$id_modal?>" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title"><?=$tytul?></h4>
					</div>
					<form action="index.php?a=wnioskioprace-zarządzanie&view=<?=$view?>&<?=$id_modal?>=true" method="POST">
						<div class="modal-body">
							<?php if($target['status'] == '0'):?>
								<div class="form-group">
									<label>Powód</label>
									<textarea class="form-control" name="powod" rows="3" placeholder="Powód" required></textarea>
								</div>
							<?php elseif($target['status'] == '2'):?>
								<div class="form-group">
									<label>Powód</label>
									<textarea class="form-control" name="powod" rows="3" placeholder="Powód" read-only required>nie przejście rozmowy kwalifikacyjnej</textarea>
								</div>
							<?php else:?>
							<?php endif?>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Anuluj</button>
							<button type="submit" class="btn btn-primary">Zatwierdź</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	<?php endif?>
	<?php endif?>

	<!-- Remember to include jQuery :) -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>

	<!-- jQuery Modal -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>

	<!-- Page specific script -->
	<script type="text/javascript">
		$(document).ready(function() {
			$(".dodaj_btn").on('click', function() {
				$("#dodaj").modal('show');
			});
			$(".odrzuc_btn").on('click', function() {
				$("#odrzuc").modal('show');
			});
			$(".uprawnienia_btn").on('click', function() {
				$("#uprawnienia").modal('show');
			});
			$(".nieprzyjety_btn").on('click', function() {
				$("#nieprzyjety").modal('show');
			})
		});
	</script>

	<?php
		if(isset($_GET['view']) && !isset($_GET['uprawnienia']) && !isset($_GET['nieprzyjety']) && !isset($_GET['odrzuc']) && isset($_GET['dodaj'])){
			$view = vtxt($_GET['view']);

			if(!empty($_POST)){
				if(!empty($_POST['pass'])){
					$login = vtxt($_POST['login']);
					$email = vtxt($_POST['email']);
					$pass = vtxt($_POST['pass']);
					$stanowisko = vtxt($_POST['stanowisko']);
					dodaj_user($login, $email, $pass, $stanowisko, $view);
				} else {
					throwInfo('danger', 'Wypełnij Wszystkie Pola', true);
				}
			} else {
				header('Location: index.php?a=home');
			}
		} elseif(isset($_GET['view']) && !isset($_GET['uprawnienia']) && !isset($_GET['nieprzyjety']) && isset($_GET['odrzuc']) && !isset($_GET['dodaj'])){
			$view = vtxt($_GET['view']);
			$target = row("SELECT * FROM aplikacje WHERE id = ".$view);
			if(!$target){
				header('Location: index.php?a=home');
			}
			if(!empty($_POST)){
				if(!empty($_POST['powod'])){
					$powod = vtxt($_POST['powod']);
					odrzuc_wniosek_o_prace($view, $powod);
				} else {
					throwInfo('danger', 'Wypełnij Wszystkie Pola', true);
				}
			} else {
				header('Location: index.php?a=home');
			}
		} elseif(isset($_GET['view']) && !isset($_GET['uprawnienia']) && isset($_GET['nieprzyjety']) && !isset($_GET['odrzuc']) && !isset($_GET['dodaj'])){
			$view = vtxt($_GET['view']);
			$target = row("SELECT * FROM aplikacje WHERE id = ".$view);
			if(!$target){
				header('Location: index.php?a=home');
			}
			if(!empty($_POST)){
				if(!empty($_POST['powod'])){
					$powod = vtxt($_POST['powod']);
					nieprzyjety_wniosek_o_prace($view);
				} else {
					throwInfo('danger', 'Wypełnij Wszystkie Pola', true);
				}
			} else {
				header('Location: index.php?a=home');
			}
		} elseif(isset($_GET['view']) && isset($_GET['uprawnienia']) && !isset($_GET['nieprzyjety']) && !isset($_GET['odrzuc']) && !isset($_GET['dodaj'])){
			$view = vtxt($_GET['view']);
			$target = row("SELECT * FROM aplikacje WHERE id = ".$view);
			if(!$target){
				header('Location: index.php?a=home');
			}
			if(!empty($_POST)){
				if(!empty($_POST['nr'])){
					$nr = vtxt($_POST['nr']);
					add_uprawnienia($view, $nr);
				} else {
					throwInfo('danger', 'Wypełnij Wszystkie Pola', true);
				}
			} else {
				header('Location: index.php?a=home');
			}
		}
	?>
