<?php
	$data=date("Y-m-d");
	$czas=date("H:i");

	if($user['stanowisko'] == '21' || $user['stanowisko'] == '22'){
		header('Location: index.php?a=rekrutacja');
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
	
	//echo $tomorrow  = date('Y-m-d H:i:s');
	//echo mktime(date('H'), date('i'), date('s'), date('m'), date('d'), date('Y'));
	//echo strftime($tomorrow);
?>	
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Strona Główna</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="index.php">Panel Kierowcy</a></li>
					<li class="breadcrumb-item active">Strona Główna</li>
				</ol>
			</div><!-- /.col -->
        </div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->



<section class="content">
	<div class="container-fluid">
		<!-- ZDJ (Stat box) -->
		<?php discord_rebember($user['id']);?>
		<!-- Small boxes (Stat box) -->
		<div class="row">
			<!-- /.col -->
			<div class="col-md-2">
				<div class="card shadow mb-4">
					<div class="card-header">
						<h3 class="m-0 font-weight-bold text-primary">Statystyki</h3>
					</div>
					<div class="card-body text-center">
					    <span class="badge bg-danger" style="color: #ffffff"><?=$user['punkty'];?></span><br><small>Punktów</small><br><br>
						<span class="badge bg-danger" style="color: #ffffff"><?=$user['kilometry'];?></span><br><small>Kilometrów</small><br><br>
						<span class="badge bg-danger" style="color: #ffffff"><?=$user['raporty'];?></span><br><small>Raportów</small>
						<?php 
							if($user['nieraporty'] > 0){
								echo '<br><br><span class="badge bg-danger" style="color: #ffffff">'.$user['nieraporty'].'</span><br><small>Niezaliczone Raporty</small>';
							} else {
								echo '';
							}
						?>
					</div>
					<!-- /.card-body -->
				</div>
				<!-- /.card -->
			</div>
			<!-- /.col -->
			<div class="col-md-10">
				<div class="card shadow mb-4">
					<div class="card-header">
						<h3 class="m-0 font-weight-bold text-primary">Ogłoszenia</h3>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">	
								<?php $changes = call("SELECT * FROM komunikaty ORDER BY id DESC ");
								if ($changes->num_rows == 0) {?>
									<div class="card-body">
										
										<b>Brak Komunikatów!</b>
										
									</div>
								<?php } else {
								$i = 0;
								while ($row = mysqli_fetch_array($changes)):
								?>
									<div class="alert alert-<?=$row['kolor'];?>" role="alert">
										<small><?=$row['kategoria'], ' | ', $row['wystawil'], ' | ', $row['data'];?></small>
										<h5><b><?=$row['temat']?></b></h5> 
										<?=$row['tresc']?>
									</div>
								<?php endwhile; }?>
							</div>
						</div>
					</div>
					<!-- /.card-body -->
				</div>
			</div>
		</div>
		<!-- /.row -->
		
		<!-- Main row -->
		<div class="row">
			<div class="col-md-4">
				<div class="card shadow mb-4">
					<div class="card-header">
						<h3 class="m-0 font-weight-bold text-primary">Najwięcej zaliczonych raportów</h3>
					</div>
					<!-- /.card-header -->
					<div class="card-body p-0">
						<table class="table table-striped">
							<?php
								$targets = call("SELECT * FROM users ORDER BY raporty DESC LIMIT 5");
								if ($targets->num_rows == 0) {?>
									<div class="card-body">
										<?php throwInfo('info', 'Brak Danych!', false);?>
									</div>
								<?php } else {
							?>
							<thead>
								<tr>
									<th style="width: 10px">#</th>
									<th>Nazwa</th>
									<th style="width: 100px">Raporty</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$i = 1;
									while ($row = mysqli_fetch_array($targets)): 
									$role = row("SELECT * FROM rangi WHERE id = ".$row['stanowisko']);
								?>
								<tr>
									<td><?=$i++;?></td>
									<td><a href="index.php?a=profile&p=<?=$row['id'];?>" style="color: <?=$role['kolor'];?>"><?=$row['login'], ' [', $role['kod_roli'], $row['nr_sluzbowy'],']';?></a></td>
									<td><span class="badge bg-danger" style="color: #ffffff"><?=$row['raporty'];?></span></td>
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
				
			<div class="col-md-4">
				<div class="card shadow mb-4">
					<div class="card-header">
						<h3 class="m-0 font-weight-bold text-primary">Najwięcej punktów</h3>
					</div>
					<!-- /.card-header -->
					<div class="card-body p-0">
						<table class="table table-striped">
							<?php
								$targets = call("SELECT * FROM users ORDER BY punkty DESC LIMIT 5");
								if ($targets->num_rows == 0) {?>
									<div class="card-body">
										<?php throwInfo('info', 'Brak Danych!', false);?>
									</div>
								<?php } else {
							?>
							<thead>
								<tr>
									<th style="width: 10px">#</th>
									<th>Nazwa</th>
									<th style="width: 100px">Punkty</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$i = 1;
									while ($row = mysqli_fetch_array($targets)): 
									$role = row("SELECT * FROM rangi WHERE id = ".$row['stanowisko']);
								?>
								<tr>
									<td><?=$i++;?></td>
									<td><a href="index.php?a=profile&p=<?=$row['id'];?>" style="color: <?=$role['kolor'];?>"><?=$row['login'], ' [', $role['kod_roli'], $row['nr_sluzbowy'],']';?></a></td>
									<td><span class="badge bg-danger" style="color: #ffffff"><?=$row['punkty'].' '.'pkt'?></span></td>
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
			
			<div class="col-md-4">
				<div class="card shadow mb-4">
					<div class="card-header">
						<h3 class="m-0 font-weight-bold text-primary">Najwięcej kilometrów</h3>
					</div>
					<!-- /.card-header -->
					<div class="card-body p-0">
						<table class="table table-striped">
							<?php
								$targets = call("SELECT * FROM users ORDER BY kilometry DESC LIMIT 5");
								if ($targets->num_rows == 0) {?>
									<div class="card-body">
										<?php throwInfo('info', 'Brak Danych!', false);?>
									</div>
								<?php } else {
							?>
							<thead>
								<tr>
									<th style="width: 10px">#</th>
									<th>Nazwa</th>
									<th style="width: 100px">Kilometry</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$i = 1;
									while ($row = mysqli_fetch_array($targets)): 
									$role = row("SELECT * FROM rangi WHERE id = ".$row['stanowisko']);
								?>
								<tr>
									<td><?=$i++;?></td>
									<td><a href="index.php?a=profile&p=<?=$row['id'];?>" style="color: <?=$role['kolor'];?>"><?=$row['login'], ' [', $role['kod_roli'], $row['nr_sluzbowy'],']';?></a></td>
									<td><span class="badge bg-success" style="color: #ffffff"><?=$row['kilometry'].' '.'km'?></span></td>
								</tr>
								<?php endwhile;}?>
							</tbody>
						</table>
					</div>
					<!-- /.card-body -->
				</div>
				<!-- /.card -->
			</div>
		</div>
		<!-- /.row (main row) -->
		
	</div><!-- /.container-fluid --> 
</section>
	<!--<script src="skrypty/grafikdzis.js"></script>-->