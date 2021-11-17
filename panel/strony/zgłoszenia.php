	<?php 
		if($perm['oglądanie_zgłoszen'] == '0'){
			header('Location: index.php?a=home');
		}
		
		$miesiac = date("m");
		$dzien = date("d");
		$rok = date("Y");
		$date = mktime(0, 0, 0, $miesiac, $dzien, $rok);
		$wczoraj = mktime(0, 0, 0, $miesiac, $dzien-1, $rok);
		$jakas = row("SELECT * FROM raporty WHERE uid = ".$user['id']." AND status = 0 AND data < ".$date." AND typ_kursu != 5");
		
		if (!isset($_GET['linia']) && !isset($_GET['id'])) {			
			$strona = true;
			$strona1 = false;
		} else {
			$strona = false;
			$strona1 = true;
			$linia = vtxt($_GET['linia']);
			$id = vtxt($_GET['id']);
			
			$wykaz = row("SELECT * FROM wykaz WHERE linia='".$linia."' AND id = '".$id."'");
			if(!$wykaz){
				header('Location: index.php?a=wykaz-brygad');
			} elseif (isset($_GET['add']) && !isset($_GET['view'])) {
				$id = vtxt($_GET['add']);
				$xd = row("SELECT * FROM raporty WHERE id = ".$id);
			} elseif (!isset($_GET['add']) && isset($_GET['view'])) {
				$id = vtxt($_GET['view']);
				$xd1 = row("SELECT * FROM raporty WHERE id = ".$id);
				if($xd1['uid'] != $user['id']){
					header('Location: index.php?a=raporty');
				}
			}
		}
	?>	
	
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">System zgłoszeń</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="index.php">Panel Kierowcy</a></li>
						<li class="breadcrumb-item active">Zgłoszenia</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->
	
	<section class="content">
		<div class="container-fluid">
			<!-- Main row -->
			<div class="row">
				<?php if($strona):?>						
					<div class="col-lg-12">
						<div class="card shadow mb-4">
							<div class="card-header">
								<h3 class="m-0 font-weight-bold">Złóż zgłoszenie!</h3>
							</div>
							<!-- /.card-header -->
							<div class="card-body table-responsive p-0">
								<table class="table table-hover text-nowrap text-center">
									<?php
										$targets = call("SELECT * FROM raporty WHERE uid = ".$user['id']." AND data = '".$date."' AND status = 0");
										if ($targets->num_rows == 0) {?>
												<div class="card-body">
													<?php throwInfo('info', 'Dziś nie masz kursu w grafiku i nie możesz złożyć zgłoszenia!', false);?>
												</div>
											<?php } else {
									?>
									<thead>	
										<tr style="text-align: center">
											<th>Kierowca</th>
											<th>Służba</th>
											<th>Pojazd</th>
											<th>Typ kursu</th>
											<th>Uwagi</th>
											<th>Wyślij zgłoszenie</th>
										</tr>
									</thead>
									<tbody>
										<?php
											while ($row = mysqli_fetch_array($targets)):?>
											<tr style="text-align: center">
												<td>RIP</textarea></td>
												<td><textarea class="form-control" name="uwagi" id="uwagi" rows="2" placeholder="Służba"></textarea></td>
												<td><textarea class="form-control" name="uwagi" id="uwagi" rows="2" placeholder="Typ kursu"></textarea></td>
												<td><textarea class="form-control" name="uwagi" id="uwagi" rows="2" placeholder="Typ kursu"></textarea></td>
												<td><textarea class="form-control" name="uwagi" id="uwagi" rows="2" placeholder="Uwagi"></textarea></td>
												<td class="project-actions ">
													<a href="index.php?a=wykaz-brygad&id=<?=$row['id'];?>&linia=<?=$row['linia'];?>&typ=<?=$row['typ'];?>">
														<button type="button" class="btn btn-info btn-sm">
															<i class="fas fa-location-arrow"></i> Wyślij
														</button>
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
					
					<div class="col-lg-12">
						<div class="card shadow mb-4">
							<div class="card-header">
								<h3 class="m-0 font-weight-bold">Złożone zgłoszenia</h3>
							</div>
							<!-- /.card-header -->
							<div class="card-body table-responsive p-0">
								<table class="table table-hover text-nowrap text-center">
									<?php
										$targets = call("SELECT * FROM zgloszenia WHERE id = 1");
										if ($targets->num_rows == 0) {?>
											<div class="card-body">
												<?php throwInfo('info', 'Brak złożonych zgłoszeń.', false);?>
											</div>
										<?php } else {
									?>
									<thead>	
										<tr style="text-align: center">
											<th>Numer</th>
											<th>Użytkownik</th>
											<th>Rodzaj zgłoszenia</th>
											<th>Data złożenia</th>
											<th>Status</th>
											<th>Opcje</th>
										</tr>
									</thead>
									<tbody>
										<?php
											while ($row = mysqli_fetch_array($targets)):?>
											<tr style="text-align: center">
												<td><?=$row['id']; ?></td>
												<td><?=$row['user']; ?></td>
												<td><?=$row['r_zgloszenia']; ?></td>
												<td><?=$row['data_zlozenia']; ?></td>
												<td><?=$row['status']; ?></td>
												<td class="project-actions ">
													<a href="index.php?a=wykaz-brygad&id=<?=$row['id'];?>&linia=<?=$row['linia'];?>&typ=<?=$row['typ'];?>">
														<button type="button" class="btn btn-info btn-sm">
															<i class="fas fa-search"></i> Podgląd
														</button>
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
					
				<?php elseif($strona1):?>
					<div class="col-lg-12">
						<div class="card shadow mb-4">
							<div class="card-header">
								<h3 class="m-0 font-weight-bold">Kursówka dla linii: <?=$wykaz['linia']?> | Brygada: <?=$wykaz['brygada']?> | Zmiana: <?=$wykaz['zmiana']?></h3>
							</div>
							<!-- /.card-header -->
							<div class="card-body">
							<p class="text-center"><b>Dodatkowe informacje o służbie:</b></p>
							<br />
							<p class="text-center"> - Ilość półkursów: <?=$wykaz['polkursy']?> - | - Ilość kilometrów: <?=$wykaz['kilometry']?> - | - Czas jazdy: <?=$wykaz['czas_jazdy']?> - | - Klasa taboru: <?=$wykaz['klasa_taboru']?> - </p>
							<p class="text-center"> - Link do zdjęcia kursówki: <a href="<?=$wykaz['link']?>" target="_blank">Otwórz na nowej karcie</a> -</p>
							<br />
								<?php if(!empty($wykaz['link'])):?>
									<p class="text-center"><img class="mx-auto" src="<?=$wykaz['link']?>" alt="Kursówka" title="Kursówka" style="width: 1025px" /></p>
								<?php else: ?>
									<p class="text-center"><img class="mx-auto" src="https://vpomorze.pl/kursowki/brak_fotki.png" alt="Kursówka" title="Kursówka" style="width: 514px" /></p>
								<?php endif;?>
							</div>
							<!-- /.card-body -->
						</div>
						<!-- /.card -->
					</div>
				<?php endif;?>
				<!-- /.col -->
			</div>
			<!-- /.row (main row) -->
		</div><!-- /.container-fluid --> 
	</section>