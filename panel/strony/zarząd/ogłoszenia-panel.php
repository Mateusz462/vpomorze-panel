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
    <!-- Main content -->
    <section class="content">
        <div class="row">
			<?php if ($tabela): ?>	
				<div class="col-md-12">
					<div class="card shadow mb-4">
						<div class="card-header">
							<h3 class="m-0 font-weight-bold text-primary">Ogłoszenia w Panelu</h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body table-responsive p-0">
							<table class="table table-hover text-nowrap">
								<?php
									$target = call("SELECT * FROM komunikaty ORDER BY id");
									if ($target->num_rows == 0) {?>
										<div class="card-body">
											<b>Brak Danych!</b>
										</div>
									<?php } else {
								?>
								<thead style="text-align: center">
									<tr>
										<th>#</th>
										<th>Temat</th>
										<th>Tresc</th>
										<th>Kategoria</th>
										<th>Wystawiajacy</th>
										<th>Status</th>
										<th>Opcje</th>
									</tr>
								</thead>
								<tbody style="text-align: center">
								<?php
									$i = 1;
									while ($row = mysqli_fetch_array($target)): ?>
									<tr>
										<td><?=$i++;?></td>
										<td><?=$row['temat'];?></td>
										<td><?=(substr($row['tresc'], 0, 100) . '...');?></td>
										<td><?=$row['kategoria'];?></td>
										<td><?=$row['wystawil'];?></td>
										<td><?php if($row['status'] == '1') echo 'Aktywny'; else echo 'Niewidoczny';?></td>
										<td class="project-actions ">
											<a class="btn btn-primary btn-sm" href="index.php?a=home"><i class="fas fa-folder"></i> Pokaż</a>
											<a class="btn btn-info btn-sm" href="index.php?a=ogłoszenia-panel&action=edit&id=<?=$row['id'];?>"><i class="fas fa-pencil-alt"></i> Edytuj</a>
											<button type="button" class="btn btn-danger btn-sm del_btn" data-d_id="<?=$row['id'];?>"><i class="fas fa-trash"></i> Usuń</button>
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