	<?php
		require_once "dist/themapart/alerts.php";
		hasPermissionTo('security', $user_role, 'access_ustawienia_panel');
	?>

	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<?php if (isset($_GET['s']) && $_GET['s'] == 'members'):?>
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Zarządzanie Panelem - Użytkownicy</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="index.php?a=home">Panel Administracyjny</a></li>
							<li class="breadcrumb-item active">Zarządzanie Panelem - Użytkownicy</li>
						</ol>
					</div>
				</div>
			<?php elseif (isset($_GET['s']) && $_GET['s'] == 'permissions'):?>
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Zarządzanie Panelem - Permisje</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="index.php?a=home">Panel Administracyjny</a></li>
							<li class="breadcrumb-item active">Zarządzanie Panelem - Permisje</li>
						</ol>
					</div>
				</div>
			<?php elseif (isset($_GET['s']) && $_GET['s'] == 'roles'):?>
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Zarządzanie Panelem - Rangi</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="index.php?a=home">Panel Administracyjny</a></li>
							<li class="breadcrumb-item active">Zarządzanie Panelem - Rangi</li>
						</ol>
					</div>
				</div>
			<?php elseif (isset($_GET['s']) && $_GET['s'] == 'line'):?>
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Zarządzanie Panelem - Linie</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="index.php?a=home">Panel Administracyjny</a></li>
							<li class="breadcrumb-item active">Zarządzanie Panelem - Linie</li>
						</ol>
					</div>
				</div>
			<?php elseif (isset($_GET['s']) && $_GET['s'] == 'service'):?>
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Zarządzanie Panelem - Służby</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="index.php?a=home">Panel Administracyjny</a></li>
							<li class="breadcrumb-item active">Zarządzanie Panelem - Służby</li>
						</ol>
					</div>
				</div>
			<?php elseif (isset($_GET['s']) && $_GET['s'] == 'company'):?>
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Zarządzanie Panelem - Przewoźnicy</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="index.php?a=home">Panel Administracyjny</a></li>
							<li class="breadcrumb-item active">Zarządzanie Panelem - Przewoźnicy</li>
						</ol>
					</div>
				</div>
			<?php elseif (isset($_GET['s']) && $_GET['s'] == 'code'):?>
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Zarządzanie Panelem - Kody Dostępu</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="index.php?a=home">Panel Administracyjny</a></li>
							<li class="breadcrumb-item active">Zarządzanie Panelem - Kody Dostępu</li>
						</ol>
					</div>
				</div>
			<?php elseif (isset($_GET['s']) && $_GET['s'] == 'limitations'):?>
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Zarządzanie Panelem - Ograniczenia Dostępu</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="index.php?a=home">Panel Administracyjny</a></li>
							<li class="breadcrumb-item active">Zarządzanie Panelem - Ograniczenia Dostępu</li>
						</ol>
					</div>
				</div>
			<?php elseif (isset($_GET['s']) && $_GET['s'] == 'logs'):?>
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Zarządzanie Panelem - Logi</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="index.php?a=home">Panel Administracyjny</a></li>
							<li class="breadcrumb-item active">Zarządzanie Panelem - Logi</li>
						</ol>
					</div>
				</div>
			<?php else:?>
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Zarządzanie Panelem</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="index.php?a=home">Panel Administracyjny</a></li>
							<li class="breadcrumb-item active">Zarządzanie Panelem</li>
						</ol>
					</div>
				</div>
			<?php endif?>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
    <section class="content">
		<div class="container-fluid">
			<div class="row">
				<?php if (isset($_GET['s']) && $_GET['s'] == 'members'):?>
				<?php elseif (isset($_GET['s']) && $_GET['s'] == 'permissions'):?>
					<?php if (isset($_GET['action']) && $_GET['action'] == 'add-perm'):?>
						<div class="col-md-12">
							<div class="card shadow mb-4">
								<div class="card-header">
									<h3 class="m-1">
										<i class="fas fa-fingerprint"></i> Dodaj Permisje <i class="fas fa-fingerprint"></i>
										<div class="float-right">
											<a href="index.php?a=zarządzanie-panel&s=permissions" class="btn btn-outline-danger"><i class="far fa-caret-square-left"></i> Powrót</a>
										</div>
									</h3>
								</div>
								<!-- /.card-header -->
								<div class="card-body">
									<?php
										if (!empty($_POST)) {
											if (empty($_POST['nazwa']) || empty($_POST['opis'])){
												throwInfo('danger', 'Wypełnij wszystkie pola!', true);
											} else {
												$nazwa = vtxt($_POST['nazwa']);
												$opis = vtxt($_POST['opis']);
												$select = call("SELECT * FROM permisje WHERE nazwa = '".$nazwa."'");
												if($select->num_rows > 0){
													$_SESSION['danger'] = 'BŁĄD!';
													$_SESSION['info'] = 'Istnieje już taka permisja!';
													header('Location: index.php?a=zarządzanie-panel&s=permissions');
												} else {
													$query = call("INSERT INTO permisje (nazwa, opis) VALUES ('".$nazwa."','".$opis."')");
													if($query){
														//throwInfo('success', 'Włączono rekrutację!', true);
														$_SESSION['success'] = 'Sukces!';
														header('Location: index.php?a=zarządzanie-panel&s=permissions');
													} else {
														$_SESSION['danger'] = 'BŁĄD!';
														$_SESSION['info'] = 'Skontaktuj się z programistą!';
														header('Location: index.php?a=zarządzanie-panel&s=permissions');
													}
												}
											}
										}
									?>
									<form action="index.php?a=zarządzanie-panel&s=permissions&action=add-perm" method="POST" class="form-horizontal">
										<div class="form-group">
											<label for="nazwa"><b>Nazwa</b></label>
											<input id="nazwa" type="text" name="nazwa" class="form-control" placeholder="Nazwa">
										</div>
										<div class="form-group">
											<label for="opis"><b>Opis</b></label>
											<input id="opis" type="text" name="opis" class="form-control" placeholder="Opis">
										</div>
										<div class="form-group">
											<button type="submit" class="btn btn-outline-success"><i class="far fa-save"></i> Zapisz</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					<?php elseif (isset($_GET['action']) && $_GET['action'] == 'edit-perm' && isset($_GET['id'])):?>
						<div class="col-md-12">
							<div class="card shadow mb-4">
								<div class="card-header">
									<h3 class="m-1">
										<i class="fas fa-fingerprint"></i> Edytuj Permisje <i class="fas fa-fingerprint"></i>
										<div class="float-right">
											<a href="index.php?a=zarządzanie-panel&s=permissions" class="btn btn-outline-danger"><i class="far fa-caret-square-left"></i> Powrót</a>
										</div>
									</h3>
								</div>
								<!-- /.card-header -->
								<div class="card-body">
									<?php
										$id_perm = vtxt($_GET['id']);
										$perm_dane = row("SELECT * FROM permisje WHERE id = '".$id_perm."'");
										if(!$perm_dane){
											$_SESSION['danger'] = 'BŁĄD!';
											$_SESSION['info'] = 'Nie ma takiego uprawnienia!';
											header('Location: index.php?a=zarządzanie-panel&s=permissions');
										} else {
											if (!empty($_POST)) {
												if (empty($_POST['nazwa']) || empty($_POST['opis'])){
													throwInfo('danger', 'Wypełnij wszystkie pola!', true);
												} else {
													$nazwa = vtxt($_POST['nazwa']);
													$opis = vtxt($_POST['opis']);
													if($perm_dane['nazwa'] != $nazwa){
														$select = call("SELECT * FROM permisje WHERE nazwa = '".$nazwa."'");
														if($select->num_rows > 0){
															$_SESSION['danger'] = 'BŁĄD!';
															$_SESSION['info'] = 'Istnieje już taka permisja!';
															header('Location: index.php?a=zarządzanie-panel&s=permissions');
														} else {
															$query = call("UPDATE permisje SET nazwa = '".$nazwa."', opis = '".$opis."' WHERE id = '".$perm_dane['id']."'");
															if($query){
																//throwInfo('success', 'Włączono rekrutację!', true);
																$_SESSION['success'] = 'Sukces!';
																header('Location: index.php?a=zarządzanie-panel&s=permissions');
															} else {
																$_SESSION['danger'] = 'BŁĄD!';
																$_SESSION['info'] = 'Skontaktuj się z programistą!';
																header('Location: index.php?a=zarządzanie-panel&s=permissions');
															}
														}
													} else {
														$query = call("UPDATE permisje SET nazwa = '".$nazwa."', opis = '".$opis."' WHERE id = '".$perm_dane['id']."'");
														if($query){
															//throwInfo('success', 'Włączono rekrutację!', true);
															$_SESSION['success'] = 'Sukces!';
															header('Location: index.php?a=zarządzanie-panel&s=permissions');
														} else {
															$_SESSION['danger'] = 'BŁĄD!';
															$_SESSION['info'] = 'Skontaktuj się z programistą!';
															header('Location: index.php?a=zarządzanie-panel&s=permissions');
														}
													}
												}
											}
										}

									?>
									<form action="index.php?a=zarządzanie-panel&s=permissions&action=edit-perm&id=<?=$perm_dane['id'];?>" method="POST" class="form-horizontal">
										<div class="form-group">
											<label for="nazwa"><b>Nazwa</b></label>
											<input id="nazwa" type="text" name="nazwa" class="form-control" placeholder="Nazwa" value="<?=$perm_dane['nazwa']?>">
										</div>
										<div class="form-group">
											<label for="opis"><b>Opis</b></label>
											<input id="opis" type="text" name="opis" class="form-control" placeholder="Opis" value="<?=$perm_dane['opis']?>">
										</div>
										<div class="form-group">
											<button type="submit" class="btn btn-outline-success"><i class="far fa-save"></i> Zapisz</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					<?php else:?>
						<div class="col-md-12">
							<div class="card shadow mb-4">
								<div class="card-header">
									<h3 class="m-1">
										<i class="fas fa-fingerprint"></i> Permisje <i class="fas fa-fingerprint"></i>
										<div class="float-right">
											<a href="index.php?a=zarządzanie-panel&s=permissions&action=add-perm" class="btn btn-outline-success"><i class="far fa-plus-square"></i> Dodaj uprawnienie</a>
											<a href="index.php?a=zarządzanie-panel" class="btn btn-outline-danger"><i class="far fa-caret-square-left"></i> Zarządzanie Panelem</a>
										</div>
									</h3>
								</div>
								<!-- /.card-header -->
								<div class="card-body p-0">
									<table class="table table-striped">
										<?php
											$targets = call("SELECT * FROM permisje");
											if ($targets->num_rows == 0) {?>
												<div class="card-body">
													<?php throwInfo('info', 'Brak Danych!', false);?>
												</div>
											<?php } else {
										?>
										<thead>
											<tr class="text-center">
												<th>ID</th>
												<th>Nazwa</th>
												<th>Opis</th>
												<th>Opcje</th>
											</tr>
										</thead>
										<tbody>
										<?php
											$i = 1;
											while ($row = mysqli_fetch_array($targets)): ?>
											<tr class="text-center">
												<td><?=$row['id'];?></td>
												<td><?=$row['nazwa'];?></td>
												<td><?=$row['opis'];?></td>
												<td class="project-actions">
													<a href="index.php?a=zarządzanie-panel&s=permissions&action=edit-perm&id=<?=$row['id'];?>" class="btn btn-info btn-sm">
														<i class="fas fa-pencil-alt"></i> Edytuj
													</a>
												</td>
											</tr>
											<?php endwhile;}?>
										</tbody>
									</table>
								</div>
								<!-- /.card-body -->
							</div>
							<!-- /.card -->
						</div>
					<?php endif?>
				<?php elseif (isset($_GET['s']) && $_GET['s'] == 'roles'):?>
					<?php if (isset($_GET['action']) && $_GET['action'] == 'add-role'):?>
						<div class="col-md-12">
							<div class="card shadow mb-4">
								<div class="card-header">
									<h3 class="m-1">
										<i class="fas fa-exclamation-circle"></i> Dodaj Range <i class="fas fa-exclamation-circle"></i>
										<div class="float-right">
											<a href="index.php?a=zarządzanie-panel&s=roles" class="btn btn-outline-danger"><i class="far fa-caret-square-left"></i> Powrót</a>
										</div>
									</h3>
								</div>
								<!-- /.card-header -->
								<div class="card-body">
									<?php
										$role = getGuildRoles(645582261378613249);
										$role_filter = array_filter($role, function($r){
											return $r['hoist'] == 1;
										});

										$permlist = call("SELECT * FROM permisje");
										// while ($row = mysqli_fetch_assoc($permlist)) {
										// 	print_r($row);
										// }
										if (!empty($_POST)) {

											if (empty($_POST['nazwa']) || empty($_POST['kolor']) || empty($_POST['dc']) || empty($_POST['kolejnosc']) || empty($_POST['permissions'])){
												throwInfo('danger', 'Wypełnij wszystkie pola!', true);
											} else {
												// print_r($_POST['permissions']);
												$nazwa = vtxt($_POST['nazwa']);
												$kolor = vtxt($_POST['kolor']);
												$kod = vtxt($_POST['kod']);
												$dc = vtxt($_POST['dc']);
												$kolejnosc = vtxt($_POST['kolejnosc']);
												$permissions = $_POST['permissions'];
												$select = call("SELECT * FROM rangi WHERE nazwa = '".$nazwa."'");
												if($select->num_rows > 0){
													$_SESSION['danger'] = 'BŁĄD!';
													$_SESSION['info'] = 'Istnieje już taka ranga!';
													header('Location: index.php?a=zarządzanie-panel&s=roles');
												} else {
													$query = call("INSERT INTO rangi (nazwa, kolor, kolejnosc, kod_roli, id_dc) VALUES ('".$nazwa."', '".$kolor."', '".$kolejnosc."', '".$kod."', '".$dc."')");
													if($query){
														$select = row("SELECT * FROM rangi WHERE nazwa = '".$nazwa."'");
														foreach ($permissions as $item) {
															$query1 = call("INSERT INTO role_in_permission (rid, pid) VALUES ('".$select['id']."','".$item."')");
														}
														if($query1){
															$_SESSION['success'] = 'Sukces!';
															header('Location: index.php?a=zarządzanie-panel&s=roles');
														} else {
															$_SESSION['danger'] = 'BŁĄD nr 2!';
															$_SESSION['info'] = 'Skontaktuj się z programistą!';
															header('Location: index.php?a=zarządzanie-panel&s=roles');
														}
													} else {
														$_SESSION['danger'] = 'BŁĄD!';
														$_SESSION['info'] = 'Skontaktuj się z programistą!';
														header('Location: index.php?a=zarządzanie-panel&s=roles');
													}
												}
											}
										}
									?>
									<form action="index.php?a=zarządzanie-panel&s=roles&action=add-role" method="POST" class="form-horizontal">
										<div class="form-group">
											<label for="nazwa"><b>Nazwa</b></label>
											<input id="nazwa" type="text" name="nazwa" class="form-control" placeholder="Nazwa">
										</div>
										<div class="form-group">
											<label for="kolor"><b>Kolor</b></label>
											<input id="kolor" type="color" name="kolor" class="form-control" placeholder="Kolor">
										</div>
										<div class="form-group">
											<label for="kod"><b>Kod</b></label>
											<input id="kod" type="text" name="kod" class="form-control" placeholder="Np. P-">
										</div>
										<div class="form-group">
											<label for="dc"><b>Ranga na Discord</b></label>
											<select id="dc" name="dc" class="form-control">
												<option selected="" disabled="">--- Wybierz ---</option>
												<?php foreach($role_filter as $item):?>
												<option value="<?=$item['id'];?>" style="color: #<?=dechex($item['color']);?>; <?php if(dechex($item['color']) == 'ffffff'){ echo 'background-color: #000';} else { } ?>"><?=$item['name'];?></option>
												<?php endforeach;?>
											</select>
										</div>
										<div class="form-group">
											<label for="kolejnosc"><b>Kolejność</b></label>
											<input id="kolejnosc" type="number" name="kolejnosc" class="form-control" placeholder="Kolejność">
										</div>
										<div class="form-group">
				                            <label class="required" for="permissions">Uprawnienia</label>
				                            <div style="padding-bottom: 10px">
				                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">Zaznacz wszystko</span>
				                                <span class="btn btn-danger btn-xs deselect-all" style="border-radius: 0">Odznacz wszystko</span>
				                            </div>
				                            <select class="form-control select2" name="permissions[]" id="permissions" multiple required>
												<?php if(mysqli_num_rows($permlist) > 0):?>
													<?php foreach($permlist as $id => $permissions):?>
					                                    <option value="<?= $permissions['id'] ?>"><?= $permissions['nazwa'] ?></option>
					                                <?php endforeach ?>
												<?php else:?>
													<option selected="" disabled="">Brak danych!</option>
												<?php endif?>
				                            </select>
				                        </div>
										<div class="form-group">
											<button type="submit" class="btn btn-outline-success"><i class="far fa-save"></i> Zapisz</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					<?php elseif (isset($_GET['action']) && $_GET['action'] == 'edit-role' && isset($_GET['id'])):?>
						<?php
							$role = getGuildRoles(645582261378613249);
							$role_filter = array_filter($role, function($r){
								return $r['hoist'] == 1;
							});

							$permlist = call("SELECT * FROM permisje");

							$id_role = vtxt($_GET['id']);
							$role_dane = row("SELECT * FROM rangi WHERE id = '".$id_role."'");
							if(!$role_dane){
								$_SESSION['danger'] = 'BŁĄD!';
								$_SESSION['info'] = 'Nie ma takiej rangi!';
								header('Location: index.php?a=zarządzanie-panel&s=roles');
							}
						?>
						<div class="col-md-12">
							<div class="card shadow mb-4">
								<div class="card-header">
									<h3 class="m-1">
										<i class="fas fa-fingerprint"></i> Edytuj Role <i class="fas fa-fingerprint"></i>
										<div class="float-right">
											<a href="index.php?a=zarządzanie-panel&s=roles" class="btn btn-outline-danger"><i class="far fa-caret-square-left"></i> Powrót</a>
										</div>
									</h3>
								</div>
								<!-- /.card-header -->
								<div class="card-body">
									<?php
										if (!empty($_POST)) {
											if (empty($_POST['nazwa']) || empty($_POST['kolor']) || empty($_POST['dc']) || empty($_POST['kolejnosc']) || empty($_POST['permissions'])){
												throwInfo('danger', 'Wypełnij wszystkie pola!', true);
											} else {
												$nazwa = vtxt($_POST['nazwa']);
												$kolor = vtxt($_POST['kolor']);
												$kod = vtxt($_POST['kod']);
												$dc = vtxt($_POST['dc']);
												$kolejnosc = vtxt($_POST['kolejnosc']);
												$permissions_input = $_POST['permissions'];
												$select = call("SELECT * FROM rangi WHERE nazwa = '".$nazwa."'");
												if($role_dane['nazwa'] != $nazwa){
													$select = call("SELECT * FROM rangi WHERE nazwa = '".$nazwa."'");
													if($select->num_rows > 0){
														$_SESSION['danger'] = 'BŁĄD!';
														$_SESSION['info'] = 'Istnieje już taka ranga!';
														header('Location: index.php?a=zarządzanie-panel&s=roles');
													} else {
														$query = call("UPDATE rangi SET nazwa = '".$nazwa."', kolor = '".$kolor."', kolejnosc = '".$kolejnosc."', kod_roli = '".$kod."', id_dc = '".$dc."' WHERE id = '".$role_dane['id']."'");
														if($query){
															$role_in_permission = call("SELECT * FROM role_in_permission WHERE rid = '".$role_dane['id']."'");
															$role_values = [];
															if(mysqli_num_rows($permlist) > 0){
																foreach ($role_in_permission as $item) {
																	$role_values[] = $item['pid'];
																}
															} else {
																$role_values = [];
															}

															foreach ($role_values as $perm_row) {
																if(in_array($perm_row, $role_values)){
																	//echo $perm_row, ' Delete here <br>';
																	$delete_query = call("DELETE FROM role_in_permission WHERE rid = '".$role_dane['id']."' AND pid = '".$perm_row."'");
																}
															}

															foreach ($permissions_input as $input_val) {
																if(in_array($input_val, $permissions_input)){
																	//echo $input_val, ' Insert here <br>';
																	$insert_query = call("INSERT INTO role_in_permission (rid, pid) VALUES ('".$role_dane['id']."','".$input_val."')");
																}
															}

															$_SESSION['success'] = 'Sukces!';
															header('Location: index.php?a=zarządzanie-panel&s=roles');
														} else {
															$_SESSION['danger'] = 'BŁĄD nr 1!';
															$_SESSION['info'] = 'Skontaktuj się z programistą!';
															header('Location: index.php?a=zarządzanie-panel&s=roles');
														}
													}
												} else {
													$query = call("UPDATE rangi SET nazwa = '".$nazwa."', kolor = '".$kolor."', kolejnosc = '".$kolejnosc."', kod_roli = '".$kod."', id_dc = '".$dc."' WHERE id = '".$role_dane['id']."'");
													if($query){
														$role_in_permission = call("SELECT * FROM role_in_permission WHERE rid = '".$role_dane['id']."'");
														$role_values = [];
														if(mysqli_num_rows($permlist) > 0){
															foreach ($role_in_permission as $item) {
																$role_values[] = $item['pid'];
															}
														} else {
															$role_values = [];
														}

														foreach ($role_values as $perm_row) {
															if(in_array($perm_row, $role_values)){
																//echo $perm_row, ' Delete here <br>';
																$delete_query = call("DELETE FROM role_in_permission WHERE rid = '".$role_dane['id']."' AND pid = '".$perm_row."'");
															}
														}

														foreach ($permissions_input as $input_val) {
															if(in_array($input_val, $permissions_input)){
																//echo $input_val, ' Insert here <br>';
																$insert_query = call("INSERT INTO role_in_permission (rid, pid) VALUES ('".$role_dane['id']."','".$input_val."')");
															}
														}

														$_SESSION['success'] = 'Sukces!';
														header('Location: index.php?a=zarządzanie-panel&s=roles');
													} else {
														$_SESSION['danger'] = 'BŁĄD nr 2!';
														$_SESSION['info'] = 'Skontaktuj się z programistą!';
														header('Location: index.php?a=zarządzanie-panel&s=roles');
													}
												}
											}
										}
									?>
									<form action="index.php?a=zarządzanie-panel&s=roles&action=edit-role&id=<?=$role_dane['id'];?>" method="POST" class="form-horizontal">
										<div class="form-group">
											<label for="nazwa"><b>Nazwa</b></label>
											<input id="nazwa" type="text" name="nazwa" class="form-control" placeholder="Nazwa" value="<?=$role_dane['nazwa']?>">
										</div>
										<div class="form-group">
											<label for="kolor"><b>Kolor</b></label>
											<input id="kolor" type="color" name="kolor" class="form-control" placeholder="Kolor" value="<?=$role_dane['kolor']?>">
										</div>
										<div class="form-group">
											<label for="kod"><b>Kod</b></label>
											<input id="kod" type="text" name="kod" class="form-control" placeholder="Np. P-" value="<?=$role_dane['kod_roli']?>">
										</div>
										<div class="form-group">
											<label for="dc"><b>Ranga na Discord</b></label>
											<select id="dc" name="dc" class="form-control">
												<option selected="" disabled="">--- Wybierz ---</option>
												<?php foreach($role_filter as $item):?>
												<option value="<?=$item['id'];?>" style="color: #<?=dechex($item['color']);?>; <?php if(dechex($item['color']) == 'ffffff'){ echo 'background-color: #000';} else { } ?>"><?=$item['name'];?></option>
												<?php endforeach;?>
											</select>
										</div>
										<div class="form-group">
											<label for="kolejnosc"><b>Kolejność</b></label>
											<input id="kolejnosc" type="number" name="kolejnosc" class="form-control" placeholder="Kolejność" value="<?=$role_dane['kolejnosc']?>">
										</div>
										<div class="form-group">
				                            <label class="required" for="permissions">Uprawnienia</label>
				                            <div style="padding-bottom: 10px">
				                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">Zaznacz wszystko</span>
				                                <span class="btn btn-danger btn-xs deselect-all" style="border-radius: 0">Odznacz wszystko</span>
				                            </div>
				                            <select class="form-control select2" name="permissions[]" id="permissions" multiple required>
												<?php if(mysqli_num_rows($permlist) > 0):
													foreach($permlist as $id => $permissions):?>
					                                    <option value="<?= $permissions['id'] ?>"
															<?php
																$sql = call("SELECT * FROM role_in_permission WHERE rid = '".$role_dane['id']."'");
																if(mysqli_num_rows($sql) > 0){
																	foreach($sql as $row){
																		$rp_array[] =  $row['pid'];
																	}
																	echo in_array($permissions['id'], $rp_array) ? 'selected' : '';
																}
															?>
														><?= $permissions['nazwa'] ?></option>
					                                <?php endforeach;
												else:?>
													<option selected="" disabled="">Brak danych!</option>
												<?php endif?>
				                            </select>
				                        </div>
										<div class="form-group">
											<button type="submit" class="btn btn-outline-success"><i class="far fa-save"></i> Zapisz</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					<?php else:?>
						<div class="col-md-12">
							<div class="card shadow mb-4">
								<div class="card-header">
									<h3 class="m-1">
										<i class="fas fa-exclamation-circle"></i> Rangi <i class="fas fa-exclamation-circle"></i>
										<div class="float-right">
											<a href="index.php?a=zarządzanie-panel&s=roles&action=add-role" class="btn btn-outline-success"><i class="far fa-plus-square"></i> Dodaj range</a>
											<a href="index.php?a=zarządzanie-panel" class="btn btn-outline-danger"><i class="far fa-caret-square-left"></i> Zarządzanie Panelem</a>
										</div>
									</h3>
								</div>
								<!-- /.card-header -->
								<div class="card-body table-responsive p-0">
									<table class="table table-striped">
										<?php
											$targets = call("SELECT * FROM rangi ORDER BY kolejnosc");
											if ($targets->num_rows == 0) {?>
												<div class="card-body">
													<?php throwInfo('info', 'Brak Danych!', false);?>
												</div>
											<?php } else {
										?>
										<thead class="text-center">
											<tr>
												<th>ID</th>
												<th>Kod</th>
												<th>Nazwa</th>
												<th>Kolor</th>
												<th>ID discord</th>
												<th>Opcje</th>
											</tr>
										</thead>
										<tbody class="text-center">
										<?php
											$i = 1;
											while ($row = mysqli_fetch_array($targets)): ?>
											<tr data-index="<?=$row['id'];?>" data-position="<?=$row['kolejnosc'];?>">
												<td><?=$row['id'];?></td>
												<td><?=$row['kod_roli'];?></td>
												<td><a href="index.php?a=zarządzanie-panel&s=roles&id=<?=$row['id'];?>" style="color: <?=$row['kolor'];?>"><?=$row['nazwa'];?></a></td>
												<td><?=$row['kolor'];?></td>
												<td><?=$row['id_dc'];?></td>
												<td class="project-actions">
													<a href="index.php?a=zarządzanie-panel&s=roles&id=<?=$row['id'];?>" class="btn btn-primary btn-sm">
														<i class="fas fa-search"></i> Podgląd uprawnień
													</a>
													<a href="index.php?a=zarządzanie-panel&s=roles&action=edit-role&id=<?=$row['id'];?>" class="btn btn-info btn-sm">
														<i class="fas fa-pencil-alt"></i> Edytuj
													</a>
													<button class="btn btn-danger btn-sm">
														<i class="fas fa-trash-alt"></i> Usuń
													</button>
												</td>
											</tr>
											<?php endwhile;}?>
										</tbody>
									</table>
								</div>
								<!-- /.card-body -->
							</div>
							<!-- /.card -->
						</div>
					<?php endif; ?>
				<?php elseif (isset($_GET['s']) && $_GET['s'] == 'line'):?>
				<?php elseif (isset($_GET['s']) && $_GET['s'] == 'service'):?>
				<?php elseif (isset($_GET['s']) && $_GET['s'] == 'company'):?>
				<?php elseif (isset($_GET['s']) && $_GET['s'] == 'code'):?>
				<?php elseif (isset($_GET['s']) && $_GET['s'] == 'limitations'):?>
					<div class="col-12">
						<div class="card shadow mb-4">
							<div class="card-header">
								<h3 class="m-0 font-weight-bold">Wybierz Ustawienie:</h3>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-lg-6">
                                        <div class="card shadow mb-4">
                                            <div class="card-body">
												<h3 class="font-weight-bold text-center"><i class="fas fa-user-plus"></i> Rekrutacja <i class="fas fa-user-plus"></i></h3>
                                                <br>
												<br>
												<?php if(ograniczenia_status('rekrutacja') == false):?>
													<br>
													<?php if (isset($_GET['s']) && $_GET['s'] == 'limitations' && isset($_GET['action']) && $_GET['action'] == 'register'):
														if (!empty($_POST)) {
															if (empty($_POST['status'])){
																throwInfo('danger', 'Błąd!', true);
															} elseif (!empty($_POST['status']) && $_POST['status'] == 1) {
																$status = vtxt($_POST['status']);
																$query = call("UPDATE ograniczenia SET status = 1 WHERE typ = 'rekrutacja'");
													            if($query){
													                //throwInfo('success', 'Włączono rekrutację!', true);
																	$_SESSION['success'] = 'Włączono rekrutację!';
													               	header('Location: index.php?a=zarządzanie-panel&s=limitations');
													            } else {
													                throwInfo('danger', 'BŁĄD Skontaktuj się z programistą!', true);
													                //header('Location: index.php?a=zarządzanie-panel');
													            }
															} else {
																throwInfo('danger', 'Błąd!', true);
															}
														}
														endif;
													?>
													<form action="index.php?a=zarządzanie-panel&s=limitations&action=register" method="POST">
														<input type="hidden" value="1" name="status">
														<p class="text-center"><button type="submit" class="btn btn-outline-success btn-lg"><i class="fas fa-power-off"></i> Włącz</button></p>
													</form>
												<?php else:?>
													<?php if (isset($_GET['s']) && $_GET['s'] == 'limitations' && isset($_GET['action']) && $_GET['action'] == 'register'):
														if (!empty($_POST)) {
															if (!isset($_POST['status'])){
																throwInfo('danger', 'Błąd!', true);
															} elseif ($_POST['status'] == 0) {
																if(empty($_POST['tytul']) || empty($_POST['powod']) || empty($_POST['kolor'])){
																	throwInfo('danger', 'Błąd!', true);
																} else {
																	$tytul = vtxt($_POST['tytul']);
																	$text = vtxt($_POST['powod']);
																	$kolor = vtxt($_POST['kolor']);
																	$status = vtxt($_POST['status']);
																	$user_id = $user['id'];
																	$timestamp = date("Y-m-d H:i:s");
																	$query = call("UPDATE ograniczenia SET data = '$timestamp', uid = '$user_id', tytul = '$tytul', tresc = '$text', kolor = '$kolor', status = 0 WHERE typ = 'rekrutacja'");
																	if($query){
																		$_SESSION['success'] = 'Wyłączono rekrutację!';
																		header('Location: index.php?a=zarządzanie-panel&s=limitations');
																	} else {
																		$_SESSION['danger'] = 'BŁĄD Skontaktuj się z programistą!';
																		header('Location: index.php?a=zarządzanie-panel&s=limitations');
																	}
																}
															} else {
																throwInfo('danger', 'Błąd 2!', true);
															}
														}
														endif;
													?>
													<h3 class="text-center">Status Rekrutacji: <span class="badge bg-success bg-lg">WŁĄCZONA</span></h3>
													<form action="index.php?a=zarządzanie-panel&s=limitations&action=register" method="POST">
														<input type="hidden" value="0" name="status">
														<div class="form-group">
															<label for="tytul"><b>Tytuł</b></label>
															<input id="tytul" type="text" name="tytul" class="form-control" placeholder="Tytuł" >
														</div>
														<div class="form-group">
															<label for="powod"><b>Powód</b></label>
															<input id="powod" type="text" name="powod" class="form-control" placeholder="Powód" >
														</div>
														<div class="form-group">
															<label for="kolor"><b>Kolor</b></label>
															<select class="form-control" id="kolor" name="kolor">
																<option selected disabled>Otwórz menu</option>
																<option value="success">Zielony</option>
																<option value="danger">Czerwony</option>
																<option value="warning">Żółty</option>
																<option value="info">Niebieski</option>
															</select>
														</div>
														<p class="text-center"><button type="submit" class="btn btn-outline-danger btn-lg"><i class="fas fa-power-off"></i> Wyłącz</button></p>
													</form>
												<?php endif ?>
                                            </div>
                                        </div>
                                    </div>
									<div class="col-lg-6">
                                        <div class="card shadow mb-4">
                                            <div class="card-body">
												<h3 class="font-weight-bold text-center"><i class="fas fa-user-check"></i> Logowanie <i class="fas fa-user-check"></i></h3>
                                                <br>
												<br>
												<?php if(ograniczenia_status('logowanie') == false):?>
													<?php if (isset($_GET['s']) && $_GET['s'] == 'limitations' && isset($_GET['action']) && $_GET['action'] == 'login'):
														if (!empty($_POST)) {
															if (empty($_POST['status'])){
																throwInfo('danger', 'Błąd!', true);
															} elseif (!empty($_POST['status']) && $_POST['status'] == 1) {
																$status = vtxt($_POST['status']);
																$query = call("UPDATE ograniczenia SET status = 1 WHERE typ = 'logowanie'");
													            if($query){
													                //throwInfo('success', 'Włączono rekrutację!', true);
																	$_SESSION['success'] = 'Włączono logowanie!';
													               	header('Location: index.php?a=zarządzanie-panel&s=limitations');
													            } else {
													                throwInfo('danger', 'BŁĄD Skontaktuj się z programistą!', true);
													                //header('Location: index.php?a=zarządzanie-panel');
													            }
															} else {
																throwInfo('danger', 'Błąd!', true);
															}
														}
														endif;
													?>
													<br>
													<form action="index.php?a=zarządzanie-panel&s=limitations&action=login" method="POST">
														<input type="hidden" value="1" name="status">
														<p class="text-center"><button type="submit" class="btn btn-outline-success btn-lg"><i class="fas fa-power-off"></i> Włącz</button></p>
													</form>
												<?php else:?>
													<?php if (isset($_GET['s']) && $_GET['s'] == 'limitations' && isset($_GET['action']) && $_GET['action'] == 'login'):
														if (!empty($_POST)) {
															if (!isset($_POST['status'])){
																throwInfo('danger', 'Błąd!', true);
															} elseif ($_POST['status'] == 0) {
																if(empty($_POST['tytul']) || empty($_POST['powod']) || empty($_POST['kolor'])){
																	throwInfo('danger', 'Błąd!', true);
																} else {
																	$tytul = vtxt($_POST['tytul']);
																	$text = vtxt($_POST['powod']);
																	$kolor = vtxt($_POST['kolor']);
																	$status = vtxt($_POST['status']);
																	$user_id = $user['id'];
																	$timestamp = date("Y-m-d H:i:s");
																	$query = call("UPDATE ograniczenia SET data = '$timestamp', uid = '$user_id', tytul = '$tytul', tresc = '$text', kolor = '$kolor', status = 0 WHERE typ = 'logowanie'");
																	if($query){
																		$_SESSION['success'] = 'Wyłączono Logowanie!';
																		header('Location: index.php?a=zarządzanie-panel&s=limitations');
																	} else {
																		$_SESSION['danger'] = 'BŁĄD Skontaktuj się z programistą!';
																		header('Location: index.php?a=zarządzanie-panel&s=limitations');
																	}
																}
															} else {
																throwInfo('danger', 'Błąd 2!', true);
															}
														}
														endif;
													?>
													<h3 class="text-center">Status Logowanie: <span class="badge bg-success bg-lg">WŁĄCZONA</span></h3>
													<form action="index.php?a=zarządzanie-panel&s=limitations&action=login" method="POST">
														<input type="hidden" value="0" name="status">
														<div class="form-group">
															<label for="tytul"><b>Tytuł</b></label>
															<input id="tytul" type="text" name="tytul" class="form-control" placeholder="Tytuł" >
														</div>
														<div class="form-group">
															<label for="powod"><b>Powód</b></label>
															<input id="powod" type="text" name="powod" class="form-control" placeholder="Powód" >
														</div>
														<div class="form-group">
															<label for="kolor"><b>Kolor</b></label>
															<select class="form-control" id="kolor" name="kolor">
																<option selected disabled>Otwórz menu</option>
																<option value="success">Zielony</option>
																<option value="danger">Czerwony</option>
																<option value="warning">Żółty</option>
																<option value="info">Niebieski</option>
															</select>
														</div>
														<p class="text-center"><button type="submit" class="btn btn-outline-danger btn-lg"><i class="fas fa-power-off"></i> Wyłącz</button></p>
													</form>
												<?php endif ?>
                                            </div>
                                        </div>
                                    </div>
								</div>
								<div class="row">
									<div class="col-lg-6">
                                        <div class="card shadow mb-4">
                                            <div class="card-body">
												<h3 class="font-weight-bold text-center"><i class="fas fa-ban"></i> Informacja o przerwie technicznej <i class="fas fa-ban"></i></h3>
                                                <br>
												<br>
												<?php if(ograniczenia_status('info-logowanie') == true):?>
													<?php if (isset($_GET['s']) && $_GET['s'] == 'limitations' && isset($_GET['action']) && $_GET['action'] == 'pt'):
														if (!empty($_POST)) {
															if (!isset($_POST['status'])){
																throwInfo('danger', 'Błąd!', true);
															} elseif ($_POST['status'] == 0) {
																$timestamp = date("Y-m-d H:i:s");
																$query = call("UPDATE ograniczenia SET data = '$timestamp', status = 0 WHERE typ = 'info-logowanie'");
																if($query){
																	$_SESSION['success'] = 'Wyłączono Logowanie!';
																	header('Location: index.php?a=zarządzanie-panel&s=limitations');
																} else {
																	$_SESSION['danger'] = 'BŁĄD Skontaktuj się z programistą!';
																	header('Location: index.php?a=zarządzanie-panel&s=limitations');
																}
															} else {
																throwInfo('danger', 'Błąd 2!', true);
															}
														}
														endif;
													?>
													<h3 class="text-center">Status: <span class="badge bg-danger bg-lg">WYŁĄCZONA</span></h3>
													<br>
													<form action="index.php?a=zarządzanie-panel&s=limitations&action=pt" method="POST">
														<input type="hidden" value="0" name="status">
														<p class="text-center"><button type="submit" class="btn btn-outline-success btn-lg"><i class="fas fa-power-off"></i> Włącz</button></p>
													</form>
												<?php else:?>
													<?php if (isset($_GET['s']) && $_GET['s'] == 'limitations' && isset($_GET['action']) && $_GET['action'] == 'pt'):
														if (!empty($_POST)) {
															if (!isset($_POST['status'])){
																throwInfo('danger', 'Błąd!', true);
															} elseif ($_POST['status'] == 1) {
																$timestamp = date("Y-m-d H:i:s");
																$query = call("UPDATE ograniczenia SET data = '$timestamp', status = 1 WHERE typ = 'info-logowanie'");
																if($query){
																	$_SESSION['success'] = 'Wyłączono Logowanie!';
																	header('Location: index.php?a=zarządzanie-panel&s=limitations');
																} else {
																	$_SESSION['danger'] = 'BŁĄD Skontaktuj się z programistą!';
																	header('Location: index.php?a=zarządzanie-panel&s=limitations');
																}
															} else {
																throwInfo('danger', 'Błąd 2!', true);
															}
														}
														endif;
													?>
													<h3 class="text-center">Status: <span class="badge bg-success bg-lg">WŁĄCZONA</span></h3>
													<br>
													<form action="index.php?a=zarządzanie-panel&s=limitations&action=pt" method="POST">
														<input type="hidden" value="1" name="status">
														<p class="text-center"><button type="submit" class="btn btn-outline-danger btn-lg"><i class="fas fa-power-off"></i> Wyłącz</button></p>
													</form>
												<?php endif ?>
                                            </div>
                                        </div>
                                    </div>
									<div class="col-xl-6">
                                        <div class="card shadow mb-4">
                                            <div class="card-header">
												<h3 class="font-weight-bold text-center"><i class="fas fa-user-lock"></i> Użytkownicy z pozwoleniem na wejście podczas przerwy technicznej <i class="fas fa-user-lock"></i></h3>
											</div>
											<div class="card-body">
												<div class="row">
													<?php
														$whitelist = call("SELECT * FROM whitelist_panel_logowanie");
														while($whitelista = mysqli_fetch_assoc($whitelist)){
															$kierowca = row("SELECT * FROM users WHERE id =".$whitelista['uid']);
															$kierowca_ranga = row("SELECT * FROM rangi WHERE id =".$kierowca['stanowisko']);
															$login_kierowcy = '<a href="index.php?a=profile&p='.$kierowca['id'].'" style="color: '.$kierowca_ranga['kolor'].'">['.$kierowca_ranga['kod_roli'].''.$kierowca['nr_sluzbowy'].'] '.$kierowca['login'].'</a>';
															echo '<div class="col-xl-4">
																<div class="card shadow mb-4">
																	<div class="card-body">
																		<p class="text-center">'.$login_kierowcy.'</p>
																		<p class="text-center"><a href="index.php?a=rangi&id='.$kierowca_ranga['id'].'" style="color: '.$kierowca_ranga['kolor'].'">'.$kierowca_ranga['nazwa'].'</a></p>
																	</div>
																</div>
															</div>';
														}
													?>
												</div>
                                            </div>
                                        </div>
                                    </div>
								</div>
							</div>
						</div>
					</div>
				<?php elseif (isset($_GET['s']) && $_GET['s'] == 'logs'):?>
				<?php else:?>
					<div class="col-12">
						<div class="card shadow mb-4">
							<div class="card-header">
								<h3 class="m-0 font-weight-bold">Wybierz Ustawienie:</h3>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-md-6 col-lg-4">
                                        <div class="card shadow mb-4">
                                            <div class="card-body">
												<h3 class="font-weight-bold text-center"><i class="fas fa-users-cog"></i> Użytkownicy w systemie <i class="fas fa-users-cog"></i></h3>
                                                <br>
                                                <p class="text-center"><a href="index.php?a=zarządzanie-panel&s=members" class="btn btn-outline-success btn-lg">Wybierz</a></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="card shadow mb-4">
                                            <div class="card-body">
												<h3 class="font-weight-bold text-center"><i class="fas fa-fingerprint"></i> Ustawienia Permisji <i class="fas fa-fingerprint"></i></h3>
                                                <br>
                                                <p class="text-center"><a href="index.php?a=zarządzanie-panel&s=permissions" class="btn btn-outline-success btn-lg">Wybierz</a></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-4">
                                        <div class="card shadow mb-4">
                                            <div class="card-body">
												<h3 class="font-weight-bold text-center"><i class="fas fa-exclamation-circle"></i> Ustawienia Rang <i class="fas fa-exclamation-circle"></i></h3>
                                                <br>
                                                <p class="text-center"><a href="index.php?a=zarządzanie-panel&s=roles" class="btn btn-outline-success btn-lg">Wybierz</a></p>
                                            </div>
                                        </div>
                                    </div>
									<div class="col-md-12 col-lg-4">
                                        <div class="card shadow mb-4">
                                            <div class="card-body">
												<h3 class="font-weight-bold text-center"><i class="fas fa-clipboard"></i> Linie <i class="fas fa-clipboard"></i></h3>
                                                <br>
                                                <p class="text-center"><a href="index.php?a=zarządzanie-panel&s=line" class="btn btn-outline-success btn-lg">Wybierz</a></p>
                                            </div>
                                        </div>
                                    </div>
									<div class="col-md-12 col-lg-4">
                                        <div class="card shadow mb-4">
                                            <div class="card-body">
												<h3 class="font-weight-bold text-center"><i class="fas fa-briefcase"></i> Służby <i class="fas fa-briefcase"></i></h3>
                                                <br>
                                                <p class="text-center"><a href="index.php?a=zarządzanie-panel&s=service" class="btn btn-outline-success btn-lg">Wybierz</a></p>
                                            </div>
                                        </div>
                                    </div>
									<div class="col-md-12 col-lg-4">
                                        <div class="card shadow mb-4">
                                            <div class="card-body">
												<h3 class="font-weight-bold text-center"><i class="far fa-building"></i> Przewoźnicy w systemie <i class="far fa-building"></i></h3>
                                                <br>
                                                <p class="text-center"><a href="index.php?a=zarządzanie-panel&s=company" class="btn btn-outline-success btn-lg">Wybierz</a></p>
                                            </div>
                                        </div>
                                    </div>
									<div class="col-md-12 col-lg-4">
                                        <div class="card shadow mb-4">
                                            <div class="card-body">
												<h3 class="font-weight-bold text-center"><i class="fas fa-code"></i> Kody Dostępu <i class="fas fa-code"></i></h3>
                                                <br>
                                                <p class="text-center"><a href="index.php?a=zarządzanie-panel&s=code" class="btn btn-outline-success btn-lg">Wybierz</a></p>
                                            </div>
                                        </div>
                                    </div>

									<div class="col-md-6 col-lg-4">
                                        <div class="card shadow mb-4">
                                            <div class="card-body">
												<h3 class="font-weight-bold text-center"><i class="fas fa-shield-alt"></i> Ograniczenia Dostępu <i class="fas fa-shield-alt"></i></h3>
												<br>
                                                <p class="text-center"><a href="index.php?a=zarządzanie-panel&s=limitations" class="btn btn-outline-success btn-lg">Wybierz</a></p>
                                            </div>
                                        </div>
                                    </div>
									<div class="col-md-12 col-lg-4">
                                        <div class="card shadow mb-4">
                                            <div class="card-body">
												<h3 class="font-weight-bold text-center"><i class="fas fa-bars"></i> Logi <i class="fas fa-bars"></i></h3>
                                                <br>
                                                <p class="text-center"><a href="index.php?a=zarządzanie-panel&s=logs" class="btn btn-outline-success btn-lg">Wybierz</a></p>
                                            </div>
                                        </div>
                                    </div>

	                            </div>
							</div>
							<!-- /.card-body -->
						</div>
						<!-- /.card -->
					</div>
				<?php endif;?>
			</div>
			<!-- /.row -->
		</div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

	<script>
        $(document).ready(function() {
            var selectmulti = $('.select2').select2();
			$(".select-all").click(function(){
                $(".select2 > option").prop("selected","selected");// Select All Options
                selectmulti.trigger("change");// Trigger change to select 2
            });
            $(".deselect-all").click(function(){
                selectmulti.val(null).trigger("change");
            });

			$("table tbody").sortable({
				update: function (event, ui) {
					$(this).children().each(function (index) {
						if($(this).attr('data-position') != (index+1)){
							$(this).attr('data-position', (index+1)).addClass('updated')
						}
					});
				}
			});
        });
    </script>
