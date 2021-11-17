<?php
	if($perm['zarzadzanie linie'] == '0'){
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
	

	

if (!isset($_GET['linia'])) {
	$strona1 = true;
	$strona2 = false;
	
	if(!empty($_POST)){	
		if(isset($_POST['button_add']) && empty($_POST['numer'])){
			throwInfo('danger', 'Wypełnij Wszystkie Pola', true);
		} else {
			$linia = vtxt($_POST['numer']);
			
			$istnieje = row("SELECT id FROM linie WHERE linia = ".$linia);
			if ($istnieje) {
				throwInfo('danger', 'Istnieje już taka linia!', true);
			} else {
				call("INSERT INTO linie (linia) VALUES ('".$linia."')");
				throwInfo('success', 'Dodano nową Linie!', true);
			}
			
		};
		unset($_POST);
	}
	
	
} elseif (isset($_GET['linia'])) {
	$strona1 = false;
	$strona2 = true;
	$idlini = vtxt($_GET['linia']);
	$dane = row("SELECT * FROM linie WHERE id = ".$idlini);
	
	
	if(!empty($_POST)){	
		if(isset($_POST['button_add']) && empty($_POST['linia'])){
			throwInfo('danger', 'Wypełnij Wszystkie Pola', true);
		} else {
			$id = vtxt($_POST['idlini']);
			$linia = vtxt($_POST['linia']);
			
			
			call("UPDATE linie SET linia = '".$linia."' WHERE id = ".$id);
			throwInfo('success', 'Dodano nową Linie!', true);
			
			
		};
		unset($_POST);
	}
	
} elseif (!isset($_GET['linia']) && isset($_GET['delete'])) {
	$strona1 = true;
	$strona2 = false;
}
?>

	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Linie</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="index.php">Panel Administracyjny</a></li>
						<li class="breadcrumb-item active">Linie</li>
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
				<?php if($strona1): ?>	
					<div class="col-lg-6">
						<div class="card shadow mb-4">
							<div class="card-header">
								<h3 class="m-0 font-weight-bold text-primary">Dodaj linię</h3>
							</div>
							<!-- /.card-header -->
							<div class="card-body">
								<div class="col-12">
									<form action="index.php?a=linie-zarządzanie" method="POST">	
										<div class="form-group">
											<label for="numer">Numer Linii</label>
											<input id="numer" type="text" name="numer" class="form-control" placeholder="Numer Linii">
										</div>
										<button type="submit" name="button_add" class="btn btn-primary">Zatwierdź</button>
									</form>
								</div>

							</div>
							<!-- /.card-body -->
						</div>
					</div>
					<div class="col-lg-6">
						<div class="card shadow mb-4">
							<div class="card-header">
								<h3 class="m-0 font-weight-bold text-primary">Linie</h3>
							</div>
							<!-- /.card-header -->
							<div class="card-body table-responsive p-0">
								<table class="table table-hover text-nowrap">
									<?php $linie = call("SELECT * FROM linie ORDER BY linia");
									if ($linie->num_rows == 0) {?>
										<div class="card-body">
											<?php throwInfo('info', 'Brak Danych!', false);?>
										</div>
									<?php } else { ?>
									<thead>
										<tr style="text-align: center">
										<th >Numer linii</th>
										<th>Opcje</th>
										</tr>
									</thead>
									<tbody >
										<?php
											while ($lin = mysqli_fetch_array($linie)): ?>
											<tr style="text-align: center">
												<td><?=$lin['linia']; ?></td>
												<td class="project-actions ">
													<a href="index.php?a=linie-zarządzanie&linia=<?=$lin['id']; ?>"><button type="button" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Wybierz</button></a>
													<button type="button" data-d_id="<?=$lin['id'];?>" class="btn btn-danger btn-sm del_btn"><i class="fas fa-trash"></i> Usuń</button>
												</td>
											</tr>
											<?php $xd = $lin['id'];?>
										<?php endwhile;};?>
									</tbody>
								</table>
							</div>
							<!-- /.card-body -->
						</div>
					</div>
				<?php elseif($strona2): ?>
					<div class="col-lg-6">
						<div class="card shadow mb-4">
							<div class="card-header">
								<h3 class="m-0 font-weight-bold text-primary">Linie</h3>
							</div>
							<!-- /.card-header -->
							<div class="card-body table-responsive p-0">
								<table class="table table-hover text-nowrap">
									<?php $linie = call("SELECT * FROM linie ORDER BY linia");
									if ($linie->num_rows == 0) {?>
										<div class="card-body">
											<?php throwInfo('info', 'Brak Danych!', false);?>
										</div>
									<?php } else { ?>
									<thead>
										<tr style="text-align: center">
										<th >Numer linii</th>
										<th>Opcje</th>
										</tr>
									</thead>
									<tbody >
										<?php
											while ($lin = mysqli_fetch_array($linie)): ?>
											<tr style="text-align: center">
												<td><?=$lin['linia']; ?></td>
												<td class="project-actions ">
													<a href="index.php?a=linie-zarządzanie&linia=<?=$lin['id']; ?>"><button type="button" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Wybierz</button></a>
												</td>
											</tr>
										<?php endwhile;};?>
									</tbody>
								</table>
							</div>
							<!-- /.card-body -->
						</div>
					</div>
					<div class="col-lg-6">
						<div class="card shadow mb-4">
							<div class="card-header">
								<h3 class="m-0 font-weight-bold text-primary">Edytuj linie <?php echo '<b>',$dane['linia'], '</b>';?></h3>
							</div>
							<!-- /.card-header -->
							<div class="card-body">
								<div class="col-12">
									<form action="index.php?a=linie-zarządzanie&linia=<?=$dane['id'];?>" method="POST">	
										<div class="form-group">
											<input type="hidden" name="idlini" value="<?=$idlini;?>">
											<label for="numer">Numer Linii</label>
											<input id="numer" type="text" name="linia" class="form-control" placeholder="Numer Linii" value="<?php echo $dane['linia'];?>">
										</div>
										<a href="index.php?a=linie-zarządzanie"><button type="button" class="btn btn-primary">Wróć</button></a>
										<button type="submit" name="button_edit" class="btn btn-primary">Zatwierdź</button>	
									</form>
								</div>
							</div>
							<!-- /.card-body -->
						</div>
					</div>
				<?php endif; ?>	
			</div>
			<!-- /.row (main row) -->
		</div><!-- /.container-fluid --> 
	</section>
	
	<!-- delete Modal -->
	<div id="deletelinia" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Usuwanie Linii</h4>
				</div>
				<form action="skrypty/delete/linie.php" method="POST">
					<div class="modal-body">
						<input type="hidden" id="d_id" name="d_id">
						Czy na pewno chcesz usunąć tą linie? 
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
				$("#deletelinia").modal('show');
				var d_id = $(this).data('d_id')
				$('#d_id').val(d_id);
			})
		});
	</script>