<?php
	//header
if (isset($_GET['id'])) {
	$id = vtxt($_GET['id']);
	$target = row("SELECT * FROM wpisy WHERE kategoria != '0' AND id = ".$id);
	if(!$target){
		header('Location: index.php?a=home');
	}
} else {	
	header('Location: index.php?a=home');
}

if(empty($target['id'])){
	$error = true;
	$nieerror = false;
} else{
	$error = false;
	$nieerror = true;
}
if($error):?>
	<!-- Main content -->
	<div class="content">
		<div class="container">
			<div class="row">
				<div class="card-body">
					<p class="card-text"><b>Brak Stron!</b></p>
					<a href="index.php" class="btn btn-primary">Strona Główna</a>
				</div>
			</div>
		</div>
	</div>
<?php elseif($nieerror):?>
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark"><?=$target['tytul'];?></h1>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<!-- Main content -->
	<div class="content">
		<div class="container">
			<div class="row">
				<div class="col-9">	
					<div class="card">					
						<div class="card-body">
							<p class="card-text">
								<?=$target['text'];?>
							</p>
							<a href="index.php" class="btn btn-primary">Powrót na Stronę Główną</a>
						</div>
					</div>
					<div class="card">	
						<div class="card card-light">			
							<div class="card-body">
								<h5 class="card-title-center">Komentarze</h5>
								<?php
									$comments = call("SELECT * FROM comments WHERE cid = ".$id);
									if ($comments->num_rows == 0):
										throwInfo('info', 'Brak komentarzy', false);
									else:
										while($row = mysqli_fetch_array($comments)):
											$name = row("SELECT login FROM users WHERE id = ".$row['uid']); ?>
											<div class="card card-light">
												<div class="card-header">
													<b><?=$name['login'];?></b><span style="float: right;"><?=$row['date'];?></span>
												</div>
												<div class="card-body">
													<?=$row['content'];?>
												</div>
											</div>
										<?php endwhile; ?>
								<?php endif; ?>
							</div>
							
						</div>
					</div>
				</div>
				<div class="col-3">	
					<div class="card">					
						<div class="card-body">
							<h5 class="card-title-center">Informacje o wpisie</h5>
							<p class="card-text"><i class="far fa-calendar-alt"> <?=$target['data'];?></i></p>
							<?php $user = row("SELECT login FROM users WHERE id = ".$target['kto']); ?>
							<p class="card-text"><i class="far fa-user"> <?=$user['login'];?></i></p>
							<p class="card-text"><i class="far fa-comments"></i><a href=""> <?=$target['komentarze'];?> Komentarzy</a>
							<?php $kat = row("SELECT nazwa FROM kategorie WHERE id = ".$target['kategoria']); ?>
							<p class="card-text"><i class="fas fa-th-list"></i><a href="index.php?a=kategoria&id=<?=$target['kategoria'];?>" rel="category tag"> <?=$kat['nazwa'];?></a>
						</div>
					</div>
					<?php 
						socialSidebar();
					?>
				</div>
			</div>
		<!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
<?php endif;?>