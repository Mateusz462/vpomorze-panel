	<?php
		require_once "dist/themapart/alerts.php";
		hasPermissionTo('security', $user_role, 'access_wykaz_brygad');

		if (!isset($_GET['linia']) && !isset($_GET['typ'])) {
			$strona = true;
			$strona1 = false;
		} else {
			$strona = false;
			$strona1 = true;
			$linia = vtxt($_GET['linia']);
			$typ = vtxt($_GET['typ']);

			$wykaz = row("SELECT * FROM wykaz WHERE linia='".$linia."' AND typ = '".$typ."'");
			if(!$wykaz){
				header('Location: index.php?a=wykaz-brygad');
			}
		}
	?>

	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Wykaz Brygad - kursówki</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="index.php">Panel Kierowcy</a></li>
						<li class="breadcrumb-item active">Wykaz Brygad</li>
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
								<h3 class="m-0 font-weight-bold">Poniedziałek - Piątek</h3>
							</div>
							<!-- /.card-header -->
							<div class="card-body table-responsive p-0">
								<table class="table table-hover text-nowrap text-center">
									<?php
										$targets = call("SELECT * FROM wykaz WHERE typ = 1");
										if ($targets->num_rows == 0) {?>
											<div class="card-body">
												<?php throwInfo('info', 'Kursówki nie są skończone! Poczekaj, aż autor ich doda.', false);?>
											</div>
										<?php } else {
									?>
									<thead>
										<tr style="text-align: center">
											<th>Linia</th>
											<th>Brygada</th>
											<th>Zmiana</th>
											<th>Miejsce rozpoczęcia</th>
											<th>Czas pracy (od - do)</th>
											<th>Miejsce zakończenia</th>
											<th>Opcje</th>
										</tr>
									</thead>
									<tbody>
										<?php
											while ($row = mysqli_fetch_array($targets)):?>
											<tr style="text-align: center">
												<td><?=$row['linia']; ?></td>
												<td><?=$row['brygada']; ?></td>
												<td><?=$row['zmiana']; ?></td>
												<td><?=$row['m_rozpoczecia']; ?></td>
												<td><?=$row['czas_pracy']; ?></td>
												<td><?=$row['m_zakonczenia']; ?></td>
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

					<div class="col-lg-12">
						<div class="card shadow mb-4">
							<div class="card-header">
								<h3 class="m-0 font-weight-bold">Sobota</h3>
							</div>
							<!-- /.card-header -->
							<div class="card-body table-responsive p-0">
								<table class="table table-hover text-nowrap text-center">
									<?php
										$targets = call("SELECT * FROM wykaz WHERE typ = 2");
										if ($targets->num_rows == 0) {?>
											<div class="card-body">
												<?php throwInfo('info', 'Kursówki nie są skończone! Poczekaj, aż autor ich doda.', false);?>
											</div>
										<?php } else {
									?>
									<thead>
										<tr style="text-align: center">
											<th>Linia</th>
											<th>Brygada</th>
											<th>Zmiana</th>
											<th>Miejsce rozpoczęcia</th>
											<th>Czas pracy (od - do)</th>
											<th>Miejsce zakończenia</th>
											<th>Opcje</th>
										</tr>
									</thead>
									<tbody>
										<?php
											while ($row = mysqli_fetch_array($targets)):?>
											<tr style="text-align: center">
												<td><?=$row['linia']; ?></td>
												<td><?=$row['brygada']; ?></td>
												<td><?=$row['zmiana']; ?></td>
												<td><?=$row['m_rozpoczecia']; ?></td>
												<td><?=$row['czas_pracy']; ?></td>
												<td><?=$row['m_zakonczenia']; ?></td>
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
					<div class="col-lg-12">
						<div class="card shadow mb-4">
							<div class="card-header">
								<h3 class="m-0 font-weight-bold">Niedziela</h3>
							</div>
							<!-- /.card-header -->
							<div class="card-body table-responsive p-0">
								<table class="table table-hover text-nowrap text-center">
									<?php
										$targets = call("SELECT * FROM wykaz WHERE typ = 3");
										if ($targets->num_rows == 0) {?>
											<div class="card-body">
												<?php throwInfo('info', 'Kursówki nie są skończone! Poczekaj, aż autor ich doda.', false);?>
											</div>
										<?php } else {
									?>
									<thead>
										<tr style="text-align: center">
											<th>Linia</th>
											<th>Brygada</th>
											<th>Zmiana</th>
											<th>Miejsce rozpoczęcia</th>
											<th>Czas pracy (od - do)</th>
											<th>Miejsce zakończenia</th>
											<th>Opcje</th>
										</tr>
									</thead>
									<tbody>
										<?php
											while ($row = mysqli_fetch_array($targets)):?>
											<tr style="text-align: center">
												<td><?=$row['linia']; ?></td>
												<td><?=$row['brygada']; ?></td>
												<td><?=$row['zmiana']; ?></td>
												<td><?=$row['m_rozpoczecia']; ?></td>
												<td><?=$row['czas_pracy']; ?></td>
												<td><?=$row['m_zakonczenia']; ?></td>
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
								<h3 class="m-0 font-weight-bold">Kursówka dla linii: <?=$wykaz['linia']?></h3>
							</div>
							<!-- /.card-header -->
							<div class="card-body">
							<p class="text-center"><b>Dodatkowe informacje o służbie:</b></p>
							<br />
							<p class="text-center">- Ilość półkursów: <?=$wykaz['polkursy']?> - | - Ilość kilometrów: <?=$wykaz['kilometry']?> - | - Czas jazdy: <?=$wykaz['czas_jazdy']?> -</p>
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
