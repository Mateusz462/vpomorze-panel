<?php
	require_once "dist/themapart/alerts.php";
	hasPermissionTo('security', $user_role, 'access_pobieralnia');
?>
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Pobieralnia</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="index.php?a=home">Panel Kierowcy</a></li>
						<li class="breadcrumb-item active">Pobieralnia</li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

    <!-- Main content -->
    <section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="card shadow mb-4">
						<div class="card-header">
							<h3 class="m-0 font-weight-bold text-primary">Mapy</h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body table-responsive p-0">
							<table class="table table-hover text-nowrap">
								<?php
									$targets = call("SELECT * FROM pobieralnia WHERE cat = 1");
									if ($targets->num_rows == 0) {?>
										<div class="card-body">

											<b>Brak Danych!</b>

										</div>
									<?php } else {
								?>
								<thead>
									<tr>
										<th style="width: 10px">#</th>
										<th>Nazwa</th>
										<th style="width: 200px">Ostatnia aktualizacja</th>
										<th style="width: 20%">Opcje</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$i = 1;
									while ($row = mysqli_fetch_array($targets)): ?>
									<tr>
										<td><?=$i++;?></td>
										<td><?=$row['name'];?></td>
										<td><?=$row['date'];?></td>
										<td class="project-actions"><a class="btn btn-success btn-block" href="<?=$row['link'];?>" target="blank"><i class="fas fa-cloud-download-alt"></i> Pobierz</a></td>
									</tr>
									<?php endwhile;}?>
								</tbody>
							</table>
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->

					<div class="card shadow mb-4">
						<div class="card-header">
							<h3 class="m-0 font-weight-bold text-primary">Pojazdy i Malowania</h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body table-responsive p-0">
							<table class="table table-hover text-nowrap">
								<?php
									$targets = call("SELECT * FROM pobieralnia WHERE cat = 2");
									if ($targets->num_rows == 0) {?>
										<div class="card-body">

											<b>Brak Danych!</b>

										</div>
									<?php } else {
								?>
								<thead>
									<tr>
										<th style="width: 10px">#</th>
										<th>Nazwa</th>
										<th style="width: 200px">Ostatnia aktualizacja</th>
										<th style="width: 20%">Opcje</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$i = 1;
									while ($row = mysqli_fetch_array($targets)): ?>
									<tr>
										<td><?=$i++;?></td>
										<td><?=$row['name'];?></td>
										<td><?=$row['date'];?></td>
										<td class="project-actions"><a class="btn btn-info btn-block" href="<?=$row['link'];?>" target="blank"><i class="fas fa-cloud-download-alt"></i> Pobierz</a></td>
									</tr>
									<?php endwhile;}?>
								</tbody>
							</table>
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
					<div class="card shadow mb-4">
						<div class="card-header">
							<h3 class="m-0 font-weight-bold text-primary">Dokumenty</h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body table-responsive p-0">
							<table class="table table-hover text-nowrap">
								<?php
									$targets = call("SELECT * FROM pobieralnia WHERE cat = 3");
									if ($targets->num_rows == 0) {?>
										<div class="card-body">
											<b>Brak Danych!</b>
										</div>
									<?php } else {
								?>
								<thead>
									<tr>
										<th style="width: 10px">#</th>
										<th>Nazwa</th>
										<th style="width: 200px">Ostatnia aktualizacja</th>
										<th style="width: 20%">Opcje</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$i = 1;
									while ($row = mysqli_fetch_array($targets)): ?>
									<tr>
										<td><?=$i++;?></td>
										<td><?=$row['name'];?></td>
										<td><?=$row['date'];?></td>
										<td class="project-actions"><a class="btn btn-danger btn-block" href="<?=$row['link'];?>" target="blank"><i class="fas fa-cloud-download-alt"></i> Pobierz</a></td>
									</tr>
									<?php endwhile;}?>
								</tbody>
							</table>
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
				<!-- /.col -->
			</div>
        <!-- /.row -->
		</div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
