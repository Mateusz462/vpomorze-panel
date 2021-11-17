	<?php 
		if($perm['pisanie postow na stronie'] == '0'){
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
			$target = row("SELECT * FROM wpisy WHERE kategoria != '0' AND id = ".$id);
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
				<div class="col-12">
					<div class="card shadow mb-4">
						<div class="card-header">
							<h3 class="m-0 font-weight-bold text-primary">Wpisy Na Stronie</h3>
						</div>
						<!-- /.card-header -->
						<div class="table-responsive">
							<table id="tabela1" class="table">
								<?php
									$targets = call("SELECT * FROM wpisy WHERE kategoria != '0'");
									if ($targets->num_rows == 0) {?>
										<div class="card-body">
											<b>Brak Danych!</b>	
										</div>
									<?php } else {	
									
								?>
								<thead>
									<tr>
										<th>#</th>
										<th>Tytuł</th>
										<th>Text</th>
										<th>Kategoria</th>
										<th>Opcje</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$i = 1;
									while ($row = mysqli_fetch_array($targets)): ?>
									<tr>
										<td><?=$i++;?></td>
										<td><?=(substr($row['tytul'], 0, 50) . '...');?></td>
										<td><?=(substr($row['text'], 0, 50) . '...');?></td>
										<?php $kat = row("SELECT nazwa FROM kategorie WHERE id = ".$row['kategoria']); ?>
										<td><?=$kat['nazwa'];?></td>
										<td class="project-actions ">
											<a class="btn btn-primary btn-sm" href="../index.php?a=artykuł&id=<?=$row['id'];?>" target="blank"><i class="fas fa-folder"></i> Pokaż</a>
											<a class="btn btn-info btn-sm" href="index.php?a=ogłoszenia-portal&action=edit&id=<?=$row['id'];?>"><i class="fas fa-pencil-alt"></i> Edytuj</a>
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
						<a href="index.php?a=ogłoszenia-portal&action=add" class="btn btn-success">Dodaj</a>
					</div>
				</div>
				<!-- /.card -->
				<div class="col-12">
					<div class="card shadow mb-4">
						<div class="card-header">
							<h3 class="m-0 font-weight-bold text-primary">Podstrony Na Stronie</h3>
						</div>
						<!-- /.card-header -->
						<div class="table-responsive">
							<table id="tabela1" class="table">
								<?php
									$targets = call("SELECT * FROM wpisy WHERE strona != '0'");
									if ($targets->num_rows == 0) {?>
										<div class="card-body">
											<b>Brak Danych!</b>	
										</div>
									<?php } else {	
									
								?>
								<thead>
									<tr>
										<th>#</th>
										<th>Strona</th>
										<th>Text</th>
										<th>Opcje</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$i = 1;
									while ($row = mysqli_fetch_array($targets)): ?>
									<tr>
										<td><?=$i++;?></td>
										<?php $kat = row("SELECT * FROM navbar WHERE id = ".$row['strona']); ?>
										<td><?=$kat['strona'];?></td>
										<td><?=(substr($row['text'], 0, 50) . '...');?></td>
										<td class="project-actions ">
											<a class="btn btn-primary btn-sm" href="../index.php?a=strona&id=<?=$kat['id'];?>" target="blank"><i class="fas fa-folder"></i> Pokaż</a>
											<a class="btn btn-info btn-sm" href="index.php?a=ogłoszenia-portal&action=edit&id=<?=$row['id'];?>"><i class="fas fa-pencil-alt"></i> Edytuj</a>
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
						<a href="index.php?a=ogłoszenia-portal&action=add" class="btn btn-success">Dodaj</a>
					</div>
				</div>
			<?php elseif ($add): ?>
				<div class="col-3">
				</div>
				<div class="col-6">
					<div class="card shadow mb-4">
						<div class="card-header">
							<h4 class="card-title">Dodaj Nowy Wpis</h4>
						</div>
						<form action="skrypty/add/ogłoszenia-portal.php" method="POST">
							<div class="card-body">
								<div class="row">
									<div class="col-4">
										<div class="form-group mb-3">
											<label for="Autor">Autor</label>
											<input type="text" id="Autor" class="form-control" value="<?=$user['login'];?>" readonly >
											<input type="hidden" name="autor" value="<?=$user['id'];?>">
										</div>
									</div>
									<div class="col-8">
										<div class="form-group mb-3">
											<label for="tytul">Tytuł</label>
											<input type="text" id="tytul" name="tytul" class="form-control" placeholder="Tytuł">
										</div>
									</div>
									<div class="col-12">
										<div class="form-group mb-3">
											<label for="kategoria">Wybierz Kategorię</label>
											<select id="kategoria" name="kategoria" class="form-control">	
												<option selected="" disabled="">Wybierz</option>
												<?php $cat = call("SELECT * FROM kategorie");
												while ($row = mysqli_fetch_array($cat)):;?>
												<option value="<?php echo $row['id'];?>"><?php echo $row['nazwa'];?></option>
												<?php endwhile;?>
											</select>
										</div>
										<div class="form-group mb-3">	
											<textarea id="textarea" name="text" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid rgb(221, 221, 221); padding: 10px;"></textarea>
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
							<h4 class="card-title">Edytuj Wpis</h4>
						</div>
						<form action="skrypty/edit/ogłoszenia-portal.php" method="POST">
							<div class="card-body">
								<div class="row">
									<div class="col-4">
										<div class="form-group mb-3">
											<label for="Autor">Autor</label>
											<?php //$kto = row("SELECT * FROM user WHERE id = ".$target['kto']);?>
											<input type="text" id="Autor" class="form-control" value="<?=$target['kto'];?>" readonly >
											<input type="hidden" name="autor" value="<?=$target['kto'];?>">
											<input type="hidden" name="id" value="<?=$id;?>">
										</div>
									</div>
									<div class="col-8">
										<div class="form-group mb-3">
											<label for="tytul">Tytuł</label>
											<input type="text" id="tytul" name="tytul" value="<?=$target['tytul'];?>" class="form-control" placeholder="Tytuł">
										</div>
									</div>
									<div class="col-12">
										<div class="form-group mb-3">
											<label for="kategoria">Wybierz Kategorię</label>
											<select id="kategoria" name="kategoria" class="form-control">	
												<option selected="" disabled="">Wybierz</option>
												<?php $cat = call("SELECT * FROM kategorie");
												while ($row = mysqli_fetch_array($cat)):;?>
												<option value="<?php echo $row['id'];?>" <?php if($target['kategoria'] == $row['id']) echo "selected"; ?>><?php echo $row['nazwa'];?></option>
												<?php endwhile;?>
											</select>
										</div>
										<div class="form-group mb-3">	
											<textarea id="textarea" name="text" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid rgb(221, 221, 221); padding: 10px;"><?=$target['text'];?></textarea>
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
				<form action="skrypty/delete/ogłoszenia-portal.php" method="POST">
					<div class="modal-body">
						<input type="hidden" id="d_id" name="d_id">
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
	<script src="summernote/summernote-bs4.min.js"></script>

	<!-- Page specific script -->
	<script type="text/javascript">
		$(document).ready(function() {
			$(".del_btn").on('click', function() {
				$("#deletepobieralnia").modal('show');
					var d_id = $(this).data('d_id')
					$('#d_id').val(d_id);
			});
			//$('.textarea').summernote();
			CKEDITOR.replace('textarea')
		});
	</script>