	<?php 
		if($perm['zarzadzanie taborem'] == '0'){
			header('Location: index.php?a=home');
		}
		require_once './funkcje/TaborFunction.php';
		/*if (isset($_GET['action'])) {
			switch($_GET['action']){
				case 'add':
					$tabela = false;
					$edit = false;
					$add = true;
				break;
				case 'edit':
					$tabela = false;
					$edit = true;
					$add = false;
				break;
				default:
					$tabela = true;
					$edit = false;
					$add = false;
				break; // Strona ładowana domyślnie
			}
		} else {
			$tabela = true;
			$edit = false;
			$add = false;
		}*/
		
		/*if(isset($_GET['action']) == 'add'){
			$xd = true;
		} else {
			$xd = false;
		}*/
	
		if(isset($_GET['add']) && !isset($_GET['edit']) && !isset($_GET['id'])){
			$add = true;
			$edit = false;
			$tabela = false;
		} elseif(!isset($_GET['add']) && isset($_GET['edit']) && isset($_GET['id'])) {
			$add = false;
			$edit = true;
			$id = vtxt($_GET['id']);
			$target = row("SELECT * FROM tabor WHERE id = ".$id);
			$własciciel1 = row("SELECT * FROM users WHERE id = ".$target['własciciel']);
			//$role2 = row("SELECT * FROM rangi WHERE id = ".$własciciel1['stanowisko']);
			
			if (isset($_GET['action']) && $_GET['action'] == 'pdane') {
				if (empty($_POST['marka']) || empty($_POST['model']) || empty($_POST['taborowy']) || empty($_POST['produkcja'])){
					throwInfo('danger', 'Wypełnij wszystkie pola!', true);
				}else {
					$id = vtxt($_GET['id']);
					$marka = vtxt($_POST['marka']);
					$model = vtxt($_POST['model']);
					$taborowy = vtxt($_POST['taborowy']);
					$produkcja = vtxt($_POST['produkcja']);
					
					$istnieje = row("SELECT id FROM tabor WHERE taborowy = '".$taborowy);
					if ($istnieje) {
						throwInfo('danger', 'Istnieje już taki pojazd!', true);
					} else {
						$tak = call("UPDATE `tabor` SET `taborowy`='".$taborowy."',`marka`='".$marka."',`model`='".$model."',`produkcja`='".$produkcja."' WHERE id = '".$id."'");
						if($tak){	
							
							throwInfo('success', 'Sukcess', true);
						} else {
							throwInfo('danger', 'Błąd! Skontaktuj się z programistą!', true);
						}
					}
				}
			} elseif (isset($_GET['action']) && $_GET['action'] == 'przegląd') {
				if (empty($_POST['przegląd'])){
					throwInfo('danger', 'Wypełnij wszystkie pola!', true);
				}else {
					$id = vtxt($_GET['id']);
					$przegląd = vtxt($_POST['przegląd']);
					
					$tak = call("UPDATE `tabor` SET `przegląd`='".$przegląd."' WHERE id = '".$id."'");
					if($tak){	
						
						throwInfo('success', 'Sukcess', true);
					} else {
						throwInfo('danger', 'Błąd! Skontaktuj się z programistą!', true);
					}
					
				}
			} elseif (isset($_GET['action']) && $_GET['action'] == 'klasa') {
				if (empty($_POST['klasa'])){
					throwInfo('danger', 'Wypełnij wszystkie pola!', true);
				}else {
					$id = vtxt($_GET['id']);
					$klasa = vtxt($_POST['klasa']);
					$tak = call("UPDATE `tabor` SET `klasa`='".$klasa."'  WHERE id = '".$id."'");
					if($tak){	
						
						throwInfo('success', 'Sukcess', true);
					} else {
						throwInfo('danger', 'Błąd! Skontaktuj się z programistą!', true);
					}
					
				}
			} elseif (isset($_GET['action']) && $_GET['action'] == 'przewoznik') {
				if (empty($_POST['zajezdnia'])){
					throwInfo('danger', 'Wypełnij wszystkie pola!', true);
				}else {
					$id = vtxt($_GET['id']);
					$zajezdnia = vtxt($_POST['zajezdnia']);		
					$tak = call("UPDATE `tabor` SET `zajezdnia`='".$zajezdnia."' WHERE id = '".$id."'");
					if($tak){	
						
						throwInfo('success', 'Sukcess', true);
					} else {
						throwInfo('danger', 'Błąd! Skontaktuj się z programistą!', true);
					}
					
				}
			} elseif (isset($_GET['action']) && $_GET['action'] == 'rejestracja') {
				if (empty($_POST['rejestracja'])){
					throwInfo('danger', 'Wypełnij wszystkie pola!', true);
				}else {
					$id = vtxt($_GET['id']);
					$rejestracja = vtxt($_POST['rejestracja']);
					$istnieje = row("SELECT id FROM tabor WHERE nr_rejestracyjny = '".$rejestracja."'");
					if ($istnieje) {
						throwInfo('danger', 'Istnieje już taki pojazd!', true);
					} else {
						$tak = call("UPDATE `tabor` SET `nr_rejestracyjny`='".$rejestracja."' WHERE id = '".$id."'");
						if($tak){	
							$tabela = true;
							$add = false;
							$edit = false;
							throwInfo('success', 'Sukcess', true);
						} else {
							throwInfo('danger', 'Błąd! Skontaktuj się z programistą!', true);
						}
					}
					
				}
			} elseif (isset($_GET['action']) && $_GET['action'] == 'opiekun') {
				if (empty($_POST['własciciel'])){
					throwInfo('danger', 'Wypełnij wszystkie pola!', true);
				}else {
					$id = vtxt($_GET['id']);
					$własciciel = vtxt($_POST['własciciel']);
					$tak = call("UPDATE `tabor` SET `własciciel`='".$własciciel."' WHERE id = '".$id."'");
					$tak1 = call("UPDATE `users` SET `tid`='1' WHERE id = '".$własciciel."'");
					if($tak && $tak1){	
						
						throwInfo('success', 'Sukcess', true);
					} else {
						throwInfo('danger', 'Błąd! Skontaktuj się z programistą!', true);
					}
					
				}
			} elseif (isset($_GET['action']) && $_GET['action'] == 'zdjęcie') {
				if (empty($_POST['link'])){
					throwInfo('danger', 'Wypełnij wszystkie pola!', true);
				}else {
					$id = vtxt($_GET['id']);
					$link = vtxt($_POST['link']);
					$tak = call("UPDATE `tabor` SET `link`='".$link."' WHERE id = '".$id."'");
					if($tak){	
						
						throwInfo('success', 'Sukcess', true);
					} else {
						throwInfo('danger', 'Błąd! Skontaktuj się z programistą!', true);
					}
					
				}
			} elseif (isset($_GET['action']) && $_GET['action'] == 'ruch') {
				if (empty($_POST['ruch'])){
					throwInfo('danger', 'Wypełnij wszystkie pola!', true);
				}else {
					$id = vtxt($_GET['id']);
					$ruch = vtxt($_POST['ruch']);
					if($ruch > 1){
						throwInfo('danger', 'Błędne wartości!', true);
					}else{
						$tak = call("UPDATE `tabor` SET `stan`='".$ruch."' WHERE id = '".$id."'");
						if($tak){
							throwInfo('success', 'Sukcess', true);
						} else {
							throwInfo('danger', 'Błąd! Skontaktuj się z programistą!', true);
						}
					}
				}
			} elseif (isset($_GET['action']) && $_GET['action'] == 'inne') {
				if (empty($_POST['podłoga']) || empty($_POST['uwagi'])){
					throwInfo('danger', 'Wypełnij wszystkie pola!', true);
				}else {
					$id = vtxt($_GET['id']);
					$podłoga = vtxt($_POST['podłoga']);
					$uwagi = vtxt($_POST['uwagi']);
					$tak = call("UPDATE `tabor` SET `podłoga`='".$podłoga."',`uwagi`='".$uwagi."' WHERE id = '".$id."'");
					if($tak){	
						
						throwInfo('success', 'Sukcess', true);
					} else {
						throwInfo('danger', 'Błąd! Skontaktuj się z programistą!', true);
					}
					
				}
			} else{
				$tabela = false;
				$add = false;
				$edit = true;
			}
		}else{
			$tabela = true;
			$add = false;
			$edit = false;
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
<?php if ($tabela): ?>
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Flota</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="index.php">Panel Administracyjny</a></li>
						<li class="breadcrumb-item active">Flota</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->
<?php endif; ?>
	
	

    <!-- Main content -->
    <section class="content">
		<div class="container-fluid">
			<!-- Main row -->
			<div class="row">
				<?php if ($tabela): ?>	
					<div class="col-lg-12">
						<div class="card shadow mb-4">
							<div class="card-header">
								<h3 class="m-0 font-weight-bold text-primary">Spis Pojazdów</h3>
							</div>
							<!-- /.card-header -->
							<div class="table-responsive">
								<table id="tabela1" class="table">
									<?php 
										tabor_index('4');
									?>
								</table>
							</div>
						  <!-- /.card-body -->
						</div>
						<div class="card shadow mb-4">		
							<a href="index.php?a=flota&add" class="btn btn-success">Dodaj Pojazd</a>
						</div>
					</div>
					<!-- /.card -->
				<?php elseif ($add): ?>
					<div class="col-lg-12">
						<div class="card shadow mb-4">
							<div class="card-header">
								<h3 class="m-0 font-weight-bold text-primary">Dodawanie Pojazdu</h3>
							</div>
							<div class="card-body">
								<a class="btn btn-info btn-sm" href="index.php?a=flota">Wróć</a>
							</div>
						</div>
					</div>
					<div class="col-lg-12">
						<form action="skrypty/add/flota.php" method="POST">
							<div class="row">
								<div class="col-lg-4">
									<div class="card shadow mb-4">
										<div class="card-header">
											<h3 class="m-0 font-weight-bold text-primary">Podstawowe Dane</h3>
										</div>
										<div class="card-body">
											<div class="form-group mb-3">
												<label for="marka" >Marka</label>
												<input type="text" id="marka" name="marka"  class="form-control"  placeholder="Marka">
											</div>
											<div class="form-group mb-3">
												<label for="model" >Model</label>
												<input type="text" id="model" name="model" class="form-control"  placeholder="Model">
											</div>
											<div class="form-group mb-3">
												<label for="taborowy" >Numer Taborowy</label>
												<input type="text" id="taborowy" name="taborowy" class="form-control"  placeholder="Numer Taborowy">
											</div>
											<div class="form-group mb-3">
												<label for="produkcja" >Rok Produkcji</label>
												<input type="text" id="produkcja" name="produkcja" class="form-control"  placeholder="Rok Produkcji">
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="card shadow mb-4">
										<div class="card-header">
											<h3 class="m-0 font-weight-bold text-primary">Wstrzymywanie eksplotacji</h3>
										</div>
										<div class="card-body">
											tu cos bedzie
											
										</div>
										<div class="card-header">
											<h3 class="m-0 font-weight-bold text-primary">Data ważności przeglądu</h3>
										</div>
										<div class="card-body">
											<div class="form-group mb-3">
												<label for="przegląd" >Przegląd</label>
												<input type="text" id="przegląd" name="przegląd" class="form-control"  placeholder="Przegląd">
											</div>
											
										</div>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="card shadow mb-4">
										<div class="card-header">
											<h3 class="m-0 font-weight-bold text-primary">Typ pojazdu</h3>
										</div>
										<div class="card-body">
											<div class="form-group mb-3">
												<label for="klasa">Klasa</label>
												<select id="klasa" name="klasa" class="form-control">
													<option selected="" disabled="">Wybierz</option>
													<option value="MIDI">MIDI</option>
													<option value="MAXI">MAXI</option>
													<option value="MEGA">MEGA</option>
													<option value="Normal">Normal</option>
												</select>
											</div>
											
											<div class="form-check mb-3">
												<input class="form-check-input" type="checkbox">
												<label class="form-check-label">Pojazd ZTM</label>
											</div>
											
										</div>
										<div class="card-header">
											<h3 class="m-0 font-weight-bold text-primary">Przewoźnik</h3>
										</div>
										<div class="card-body">
											<div class="form-group mb-3">
												<label for="zajezdnia">Zajezdnia</label>
												<select id="zajezdnia" name="zajezdnia" class="form-control">
													<option selected="" disabled="">Wybierz</option>
													<?php $przewoznicy = call("SELECT * FROM przewoznicy");
													while ($row = mysqli_fetch_array($przewoznicy)):;?>
													<option value="<?php echo $row['tag'];?>"><?php echo $row['nazwa'];?></option>
													<?php endwhile;?>
												</select>																
											</div>
											
										</div>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="card shadow mb-4">
										<div class="card-header">
											<h3 class="m-0 font-weight-bold text-primary">Rejestracja</h3>
										</div>
										<div class="card-body">
											<div class="form-group mb-3">
												<label for="rejestracja" >Numer Rejestracyjny</label>
												<input type="text" id="rejestracja" name="rejestracja" class="form-control"  placeholder="Numer Rejestracyjny">
											</div>
											
										</div>
									</div>
								</div>	
								<div class="col-lg-4">
									<div class="card shadow mb-4">
										<div class="card-header">
											<h3 class="m-0 font-weight-bold text-primary">Opiekunowie</h3>
										</div>
										<div class="card-body">
											<div class="form-group mb-3">
												<label for="własciciel">Własciciel</label>
												<select id="własciciel" name="własciciel" class="form-control">
													<option selected="" disabled="">Wybierz</option>
													<option value="-">Brak</option>
													<?php 
														$własciciel = call("SELECT * FROM users WHERE tid = '0'");
														while ($row = mysqli_fetch_array($własciciel)):
														$role = row("SELECT * FROM rangi WHERE id = ".$row['stanowisko']);
														?>
														<option value="<?=$row['id'];?>" style="color: <?=$role['kolor'];?>"><?=$row['login'], ' [', $role['kod_roli'], $row['nr_sluzbowy'],']';?></option>
													<?php endwhile;?>
												</select>																
											</div>
											
										</div>
									</div>
								</div>	
								<div class="col-lg-4">
									<div class="card shadow mb-4">
										<div class="card-header">
											<h3 class="m-0 font-weight-bold text-primary">Zdjęcie pojazdu</h3>
										</div>
										<div class="card-body">
											<div class="form-group mb-3">
												<label for="link">Link do zdjęcia pojazdu</label>
												<input type="text" id="link" name="link" class="form-control" placeholder="Link do zdjęcia pojazdu">
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-12">
									<div class="card shadow mb-4">
										<div class="card-header">
											<h3 class="m-0 font-weight-bold text-primary">Inne Informacje</h3>
										</div>
										<div class="card-body">
											<div class="form-group mb-3">
												<label for="podłoga">Podłoga</label>
												<select id="podłoga" name="podłoga" class="form-control">
													<option selected="" disabled="">Wybierz</option>
													<option value="Niska">Niska</option>
													<option value="Wysoka">Wysoka</option>
												</select>
											</div>
											<div class="form-group mb-3">
												<label for="uwagi">Uwagi</label>
												<textarea class="form-control" name="uwagi" id="uwagi" rows="3" placeholder="Uwagi"></textarea>
											</div>
											<button type="submit" id="update" class="btn btn-primary">Zatwierdź</button>	
										</div>
									</div>
								</div>
							</div>
						</form>	
					</div>
				<?php elseif ($edit): ?>
					<div class="col-lg-12">
						<div class="card shadow mb-4">
							<div class="card-header">
								<h3 class="m-0 font-weight-bold text-primary">Edytowanie Pojazdu <?=$target['marka'], ' ', $target['model'], ' #', $target['taborowy'];?></h3>
							</div>
							<div class="card-body">
								<a class="btn btn-info btn-sm" href="index.php?a=flota">Wróć</a>
								<a class="btn btn-info btn-sm" href="index.php?a=flota&edit&id=<?=$id;?>">Odśwież</a>
							</div>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="card shadow mb-4">
							<div class="card-header">
								<h3 class="m-0 font-weight-bold text-primary">Podstawowe dane</h3>
							</div>
							<div class="card-body">
								<form action="index.php?a=flota&edit&id=<?=$id;?>&action=pdane" method="POST">
									<div class="form-group mb-3">
										<label for="marka" >Marka</label>
										<input type="text" id="marka" value="<?=$target['marka'];?>" name="marka" class="form-control"  placeholder="Marka">
									</div>
									<div class="form-group mb-3">
										<label for="model" >Model</label>
										<input type="text" id="model" value="<?=$target['model'];?>" name="model" class="form-control"  placeholder="Model">
									</div>
									<div class="form-group mb-3">
										<label for="taborowy" >Numer Taborowy</label>
										<input type="text" id="taborowy" value="<?=$target['taborowy'];?>" name="taborowy" class="form-control"  placeholder="Numer Taborowy">
									</div>
									<div class="form-group mb-3">
										<label for="produkcja" >Rok Produkcji</label>
										<input type="text" id="produkcja" value="<?=$target['produkcja'];?>" name="produkcja" class="form-control"  placeholder="Rok Produkcji">
									</div>
									<button type="submit" id="update" class="btn btn-primary">Zatwierdź</button>	
								</form>	
							</div>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="card shadow mb-4">
							<div class="card-header">
								<h3 class="m-0 font-weight-bold text-primary">Wstrzymywanie eksplotacji</h3>
							</div>
							<div class="card-body">
								<form action="index.php?a=flota&edit&id=<?=$id;?>&action=ruch" method="POST">
									<div class="check-group mb-3">
										<?php if($target['stan'] == '1'): ?>
											<input type="radio" value="'0'" name="ruch" class="check-control" id="wstrzymaj" > <label for="wstrzymaj">Wstrzymaj z ruchu</label></br>
										<?php elseif($target['stan'] == '0'):?>
											<input type="radio" value="1" name="ruch" class="check-control" id="przedłuż" > <label for="przedłuż">Puść w ruch</label>
										<?php endif;?>
									</div>
									<button type="submit" id="update" class="btn btn-primary">Zatwierdź</button>
								</form>
							</div>
							<div class="card-header">
								<h3 class="m-0 font-weight-bold text-primary">Data ważności przeglądu</h3>
							</div>
							<div class="card-body">
								<form action="index.php?a=flota&edit&id=<?=$id;?>&action=przegląd" method="POST">
									<div class="form-group mb-3">
										<label for="przegląd" >Przegląd</label>
										<input type="text" id="przegląd" value="<?=$target['przegląd'];?>" name="przegląd" class="form-control"  placeholder="Przegląd">
									</div>
									<button type="submit" id="update" class="btn btn-primary">Przedłuż przegląd</button>
								</form>
							</div>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="card shadow mb-4">
							<div class="card-header">
								<h3 class="m-0 font-weight-bold text-primary">Typ pojazdu</h3>
							</div>
							<div class="card-body">
								<form action="index.php?a=flota&edit&id=<?=$id;?>&action=klasa" method="POST">	
									<div class="form-group mb-3">
										<label for="klasa">Klasa</label>
										<select id="klasa" name="klasa" class="form-control">
											<option selected="" disabled="">Wybierz</option>
											<option value="MIDI" <?php if($target['klasa'] == 'MIDI') echo "selected"; ?>>MIDI</option>
											<option value="MAXI" <?php if($target['klasa'] == 'MAXI') echo "selected"; ?>>MAXI</option>
											<option value="MEGA" <?php if($target['klasa'] == 'MEGA') echo "selected"; ?>>MEGA</option>
											<option value="Normal" <?php if($target['klasa'] == 'Normal') echo "selected"; ?>>Normal</option>
										</select>
									</div>
									<button type="submit" id="update" class="btn btn-primary">Zatwierdź</button>
								</form>
							</div>
							<div class="card-header">
								<h3 class="m-0 font-weight-bold text-primary">Przewoźnik</h3>
							</div>
							<div class="card-body">
								<form action="index.php?a=flota&edit&id=<?=$id;?>&action=przewoznik" method="POST">
									<div class="form-group mb-3">
										<label for="zajezdnia">Zajezdnia</label>
										<select id="zajezdnia" name="zajezdnia" class="form-control">
											<option disabled="">Wybierz</option>
											<?php $przewoznicy = call("SELECT * FROM przewoznicy");
											while ($row = mysqli_fetch_array($przewoznicy)):;?>
											<option value="<?php echo $row['tag'];?>" <?php if($target['zajezdnia'] == $row['tag']) echo "selected"; ?>><?php echo $row['nazwa'];?></option>
											<?php endwhile;?>
										</select>																
									</div>
									<button type="submit" id="update" class="btn btn-primary">Zatwierdź</button>	
								</form>
							</div>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="card shadow mb-4">
							<div class="card-header">
								<h3 class="m-0 font-weight-bold text-primary">Rejestracja</h3>
							</div>
							<div class="card-body">
								<form action="index.php?a=flota&edit&id=<?=$id;?>&action=rejestracja" method="POST">
									<div class="form-group mb-3">
										<label for="rejestracja" >Numer Rejestracyjny</label>
										<input type="text" id="rejestracja" value="<?=$target['nr_rejestracyjny'];?>" name="rejestracja" class="form-control"  placeholder="Numer Rejestracyjny">
									</div>
									<button type="submit" id="update" class="btn btn-primary">Zatwierdź</button>	
								</form>
							</div>
						</div>
					</div>	
					<div class="col-lg-4">
						<div class="card shadow mb-4">
							<div class="card-header">
								<h3 class="m-0 font-weight-bold text-primary">Opiekunowie</h3>
							</div>
							<div class="card-body">
								<form action="index.php?a=flota&edit&id=<?=$id;?>&action=opiekun" method="POST">	
									<div class="form-group mb-3">
										<label for="własciciel">Własciciel</label>
										<select id="własciciel" name="własciciel" class="form-control">
											<option disabled="">Wybierz</option>
											<?php 
												if($target['własciciel'] > 0){
													echo '<option value="'.$własciciel1['id'].'" style="color:'.$role2['kolor'].'">'.$własciciel1['login'], ' [', $role2['kod_roli'], $własciciel1['nr_sluzbowy'],'] - obecny własciciel'.'</option><option value="-">Brak</option>';
													
												} else {
													echo '<option value="-">Brak własciciela</option>';
												}
												
											?>
											<?php $własciciel = call("SELECT * FROM users WHERE tid = '0'");
											while ($row = mysqli_fetch_array($własciciel)):
											$role1 = row("SELECT * FROM rangi WHERE id = ".$row['stanowisko']);
											?>
											<option value="<?=$row['id'];?>" style="color: <?=$role1['kolor'];?>"><?=$row['login'], ' [', $role1['kod_roli'], $row['nr_sluzbowy'],']';?></option>
											<?php endwhile;?>
										</select>																
									</div>
									<button type="submit" id="update" class="btn btn-primary">Zatwierdź</button>	
								</form>
							</div>
						</div>
					</div>	
					<div class="col-lg-4">
						<div class="card shadow mb-4">
							<div class="card-header">
								<h3 class="m-0 font-weight-bold text-primary">Zdjęcie pojazdu</h3>
							</div>
							<div class="card-body">
								<?php 
									if(!empty($target['link'])){
										echo '<a href="'.$target['link'].'" target="_blank"><img src="'.$target['link'].'" width="200" height="129"></img></a>';
									} else {
										echo '<b style="color: #ff0000">Brak zdjęcia!</b>';
									};
								?>
								<form action="index.php?a=flota&edit&id=<?=$id;?>&action=zdjęcie" method="POST">
									<div class="form-group mb-3">
										<label for="link">Link do zdjęcia pojazdu</label>
										<input type="text" id="link" value="<?=$target['link'];?>" name="link" class="form-control" placeholder="Link do zdjęcia pojazdu">
									</div>
									<button type="submit" id="update" class="btn btn-primary">Zatwierdź</button>	
								</form>
							</div>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="card shadow mb-4">
							<div class="card-header">
								<h3 class="m-0 font-weight-bold text-primary">Inne informacje</h3>
							</div>
							<div class="card-body">
								<form action="index.php?a=flota&edit&id=<?=$id;?>&action=inne" method="POST">	
									<div class="form-group mb-3">
										<label for="podłoga">Podłoga</label>
										<select id="podłoga" name="podłoga" class="form-control">
											<option disabled="">Wybierz</option>
											<option value="Niska" <?php if($target['podłoga'] == 'Niska') echo "selected"; ?>>Niska</option>
											<option value="Wysoka" <?php if($target['podłoga'] == 'Wysoka') echo "selected"; ?>>Wysoka</option>
										</select>
									</div>
									<div class="form-group mb-3">
										<label for="uwagi">Uwagi</label>
										<textarea name="uwagi" id="uwagi" class="form-control" rows="3" placeholder="Uwagi"><?=$target['uwagi'];?></textarea>
									</div>
									<button type="submit" id="update" class="btn btn-primary">Zatwierdź</button>
								</form>
							</div>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
	
	
	
	
	
	<!-- delete Modal -->
	<div id="deletepojazd" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Usuwanie Pojazdu z bazy danych</h4>
				</div>
				<form action="skrypty/delete/flota.php" method="POST">
					<div class="modal-body">
						<input type="hidden" id="d_id" name="d_id">
						Czy na pewno chcesz usunąć ten pojazd? 
					</div>	
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Anuluj</button>
						<button type="submit" name="button_delete" class="btn btn-primary">Zatwierdź</button>
					</div>		
				</form>	
			</div>
		</div>
	</div>

	<!-- Remember to include jQuery :) -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>

	<!-- jQuery Modal -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>

	<!-- Page specific script -->
	<script type="text/javascript">
		$(document).ready(function() {
			$(".del_btn").on('click', function() {
				$("#deletepojazd").modal('show');
					var d_id = $(this).data('d_id')
					$('#d_id').val(d_id);
			})
		});
	</script>	

