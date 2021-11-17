 <?php
	if($perm['zarzadanie wykazem'] == '0'){
		header('Location: index.php?a=home');
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

	if (!isset($_GET['linia']) && !isset($_GET['brygada'])) {

	} elseif (isset($_GET['linia']) && !isset($_GET['brygada'])) {
	
	} elseif (isset($_GET['linia']) && isset($_GET['brygada'])) {

		
	} else {
		$strona1 = true;
		$strona2 = false;
	}
?>
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Służby</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="index.php">Panel Administracyjny</a></li>
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
				
						
					<div class="col-lg-6">
						<div class="card shadow mb-4">
							<div class="card-header">
								<h3 class="m-0 font-weight-bold text-primary">Dodaj służbę</h3>
							</div>
							<!-- /.card-header -->
							<div class="card-body">
								<div class="col-12">
									<form action="index.php?a=służby&add" method="POST">	
										<div class="form-check">
											<input class="form-check-input" type="radio" value="1" name="typ">
											<label class="form-check-label">P (Dni Powszednie)</label>
										</div>
										<div class="form-check">
											<input class="form-check-input" type="radio" value="2" name="typ">
											<label class="form-check-label">S (Soboty)</label>
										</div>
										<div class="form-check">
											<input class="form-check-input" type="radio" value="3" name="typ">
											<label class="form-check-label">NS (Niedziele i Święta)</label>
										</div>
										<br>
										<div class="form-group">
											<label for="linie">Wybierz Linię</label>
											<select id="linie" name="linie" class="form-control">
												<?php $linie = call("SELECT * FROM linie");
												while ($lini = mysqli_fetch_array($linie)):;?>
												<option value="<?php echo $lini['id'];?>"><?php echo $lini['linia'];?></option>
												<?php endwhile;?>
											</select>																
										</div>	
										<button type="submit" name="button_add" class="btn btn-primary">Zatwierdź</button>
									</form>
								</div>

							</div>
							<!-- /.card-body -->
						</div>
					</div>
					<!-- /.col -->
				
					<div class="col-lg-6">
						<div class="card shadow mb-4">
							<div class="card-header">
								<h3 class="m-0 font-weight-bold text-primary">Edycja brygad</h3>
							</div>
							<!-- /.card-header -->
							<div class="card-body table-responsive text-center p-0">
								<table class="table table-hover text-nowrap">
									<?php
										$targets = call("SELECT * FROM brygady WHERE sid=".$sid);
										if ($targets->num_rows == 0):?>
											<div class="card-body">
												<?php throwInfo('info', 'Brak Danych!', false);?>
											</div>
									<?php else:?>
									<thead>
										<tr style="text-align: center">
											<th>Brygada</th>
											<th>Opcje</th>
										</tr>
									</thead>
									<tbody >
										<?php
											while ($row = mysqli_fetch_array($targets)):?>
											<tr style="text-align: center">
												<td><?=$row['brygada'];?></td>
												<td class="project-actions ">
													<a href="index.php?a=służby&linia=<?=$sid;?>&brygada=<?=$row['brygada'];?>"><button type="button" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Wybierz</button></a>
													<button type="button" class="btn btn-danger btn-sm del_btn"><i class="fas fa-trash"></i> Usuń</button>
												</td>
											</tr>
										<?php endwhile; endif;?>
									</tbody>
								</table>
							</div>
							<!-- /.card-body -->
							<div class="card-body">
								<div class="col-12">
									<form action="index.php?a=służby&linia=<?=$sid;?>" method="POST">	
										<div class="form-group">
											<input id="brygada" type="text" name="brygade" class="form-control" placeholder="Dodaj Brygadę">
										</div>
										<button type="submit" name="add" class="btn btn-primary">Zatwierdź</button>
									</form>
								</div>

							</div>
						</div>
					</div>

			</div>
			<!-- /.row (main row) -->
		</div><!-- /.container-fluid --> 
	</section>