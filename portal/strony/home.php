	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Strona Główna</h1>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<!-- Main content -->
	<div class="content">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="card text-center">
						<div class="card-body">
							<h5 class="card-title-center">Zostań Naszym Kierowcą!</h5>
							<p class="card-text"></p>
							<a href="index.php?a=zloz-wniosek" class="btn btn-dark bg-light">Złóż wniosek o pracę</a>
							<a href="index.php?a=strona&id=1" class="btn btn-primary bg-primary">Dowiedz się więcej</a>
						</div>
					</div>
				</div>
				<div class="col-9">
					<?php
						$count = row("SELECT count(id) AS id FROM wpisy WHERE kategoria != 0");
						$limit = 6;
						$total = $count['id'];
						$pages = ceil($total / $limit);

						if (isset($_GET['page'])) {
							//
							if($_GET['page'] < 1 || $_GET['page'] > $pages){
								$page = 1;
							} else {
								$page = $_GET['page'];
							}
						} else {
							$page = 1;
						}

						$start = ($page-1) * $limit;
						$target = call("SELECT * FROM wpisy WHERE kategoria != '0' ORDER by id DESC LIMIT $start, $limit");


						if($page == 1){
							$class = false;
							$wstecz = $page - 0;
						} else {
							$class = true;
							$wstecz = $page - 1;
						}
						if($page == $pages){
							$class1 = false;
							$dalej = $page + 0;
						} else {
							$class1 = true;
							$dalej = $page + 1;
						}

						if ($total == 0) {
							echo '<div class="card-body"><b>Brak Stron!</b></div>';

						} else {
							$i = 0;
							while ($row = mysqli_fetch_array($target)){?>

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
								</div><?php
							}
						}
					?>
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

				<?php if ($pages > '1' && $total != 0):?>
					<div class="col-12">
						<nav aria-label="Page navigation example">
							<ul class="pagination">
								<li class="page-item"><a class="page-link" <?php if($class) echo 'href="index.php?a=home&page='.$wstecz.'"';?>>Poprzednia</a></li>
								<?php for($i = 1; $i<= $pages; $i++):?>
									<li class="page-item"><a class="page-link" href="index.php?a=home&page=<?=$i;?>"><?=$i;?></a></li>
								<?php endfor;?>
								<li class="page-item"><a class="page-link" <?php if($class1) echo 'href="index.php?a=home&page='.$dalej.'"';?>>Następna</a></li>
							</ul>
						</nav>
					</div>
				<?php else:?>

				<?php endif;?>

			</div>
		<!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-->
