	<?php 
		if($perm['zarzadzanie pobieralnia'] == '0'){
			header('Location: index.php?a=home');
		}
		
		if (isset($_GET['action'])) {
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
		}
		
		if(isset($_GET['action']) == 'edit'){
			$xd = true;
		} else {
			$xd = false;
		}
		
		if ($xd && isset($_GET['id'])) {
			$id = vtxt($_GET['id']);
			$target = row("SELECT * FROM pobieralnia WHERE id = ".$id);
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
					<h1 class="m-0 text-dark">Pobieralnia</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="index.php">Panel Administracyjny</a></li>
						<li class="breadcrumb-item active">Pobieralnia</li>
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
			<div class="row">
				<?php if ($tabela): ?>	
					<div class="col-12">
						<div class="card shadow mb-4">
							<div class="card-header">
								<h3 class="m-0 font-weight-bold text-primary">Spis Pojazdów</h3>
							</div>
							<!-- /.card-header -->
							<div class="table-responsive">
								<table id="tabela1" class="table">
									<?php
										$targets = call("SELECT * FROM pobieralnia");
										if ($targets->num_rows == 0) {?>
											<div class="card-body">
												<b>Brak Danych!</b>	
											</div>
										<?php } else {	
										
									?>
									<thead>
										<tr>
											<th>#</th>
											<th>Nazwa</th>
											<th>Kategoria</th>
											<th>Ostatnia aktualizacja</th>
											<th>Opcje</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$i = 1;
										while ($row = mysqli_fetch_array($targets)): ?>
										<tr>
											<td><?=$i++;?></td>
											<td><?=$row['name'];?></td>
											<?php switch($row['cat']){
												case '1'; echo '<td>Mapy</td>'; break;
												case '2'; echo '<td>Pojazdy i Malowania</td>'; break;
												case '3'; echo '<td>Dokumenty</td>'; break;
											}?>
											<td><?=$row['date'];?></td>
											<td class="project-actions ">
												<a class="btn btn-primary btn-sm" href="<?=$row['link'];?>" target="blank"><i class="fas fa-cloud-download-alt"></i> Pobierz</a>
												<a class="btn btn-info btn-sm" href="index.php?a=pobieralnia-zarządzanie&action=edit&id=<?=$row['id'];?>"><i class="fas fa-pencil-alt"></i> Edytuj</a>
												<button type="button" class="btn btn-danger btn-sm del_btn" data-d_id="<?=$row['id'];?>"><i class="fas fa-trash"></i> Usuń</button>
											</td>
										</tr>
										<?php endwhile;}?>
									</tbody>
								</table>
							</div>
						  <!-- /.card-body -->
						</div>
						<div class="card shadow mb-4">		
							<a href="index.php?a=pobieralnia-zarządzanie&action=add" class="btn btn-success">Dodaj</a>
						</div>
					</div>
					<!-- /.card -->
				<?php elseif ($add): ?>
					<div class="col-3">
					</div>
					<div class="col-6">
						<div class="card shadow mb-4">
							<div class="card-header">
								<h4 class="card-title">Dodaj do Pobieralni</h4>
							</div>
							<form action="skrypty/add/pobieralnia.php" method="POST">
								<div class="card-body">
									<div class="row">
										<div class="col-12">
											<div class="form-group mb-3">
												<label for="name">Nazwa</label>
												<input type="text" id="name" name="a_name" class="form-control" placeholder="Nazwa">
											</div>
											<div class="form-group mb-3">
												<label for="link">Link</label>
												<input type="text" id="link" name="a_link" class="form-control" placeholder="Link">
											</div>
											<div class="form-group mb-3">
												<label for="kategoria">Wybierz Kategorię</label>
												<select id="kategoria" name="a_kategoria" class="form-control">
													<option value="1">Mapy</option>
													<option value="2" >Pojazdy i Malowania</option>
													<option value="3">Dokumenty</option>
												</select>
											</div>
										</div>
									</div>	
								</div>
								<div class="modal-footer">
									<button type="submit" name="button_add" id="update" class="btn btn-primary">Zatwierdź</button>	
								</div>
							</form>	
						</div>
					</div>
				<?php elseif ($edit): ?>
					<div class="col-3">
					</div>
					<div class="col-6">
						<div class="card shadow mb-4">
							<div class="card-header">
								<h4 class="card-title">Edytuj Przedmiot</h4>
							</div>
							<form action="skrypty/edit/pobieralnia.php" method="POST">
								<div class="card-body">
									<div class="row">
										<div class="col-12">
											<input type="hidden" name="e_id" value="<?=$target['id'];?>">
											<div class="form-group mb-3">
												<label for="name">Nazwa</label>
												<input type="text" id="name" value="<?=$target['name'];?>" name="e_name" class="form-control" placeholder="Nazwa">
											</div>
											<div class="form-group mb-3">
												<label for="link">Link</label>
												<input type="text" id="link" value="<?=$target['link'];?>" name="e_link" class="form-control" placeholder="Link">
											</div>
											<div class="form-group mb-3">
												<label for="kategoria">Wybierz Kategorię</label>
												<select id="kategoria" name="e_kategoria" class="form-control">
													<option value="1" <?php if($target['cat'] == '1') echo "selected"; ?>>Mapy</option>
													<option value="2" <?php if($target['cat'] == '2') echo "selected"; ?>>Pojazdy i Malowania</option>
													<option value="3" <?php if($target['cat'] == '3') echo "selected"; ?>>Dokumenty</option>
												</select>
											</div>
										</div>
									</div>	
								</div>
								<div class="modal-footer">
									<button type="submit" name="button_edit" id="update" class="btn btn-primary">Zatwierdź</button>	
								</div>
							</form>	
						</div>
						
					</div>
				<?php endif; ?>
				
			</div><!-- /.container-fluid -->
		</div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
	
	
	
	
	
	<!-- delete Modal -->
	<div id="deletepobieralnia" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Usuwanie Przedmiotu z Pobieralni</h4>
				</div>
				<form action="skrypty/delete/pobieralnia.php" method="POST">
					<div class="modal-body">
						<input type="hidden" id="did" name="d_id">
						Czy na pewno chcesz usunąć? 
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
				$("#deletepobieralnia").modal('show');
					var id = $(this).data('d_id')
					$('#did').val(id);
			})
		});
	</script>	