<?php
	if($perm['zarzadzanie wnioskami'] == '0'){
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
?>
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Urlopy Pracowników</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="index.php?a=home">Panel Kierowcy</a></li>
						<li class="breadcrumb-item active">Urlopy Pracowników</li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
                <div class="col-12">
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <h3 class="m-0 font-weight-bold">Sobota</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
							<div class="row">
								<?php
									$uzytkownik = call("SELECT * FROM users WHERE stanowisko != 21 AND stanowisko != 22 AND deleted = 0 ORDER BY nr_sluzbowy");
									if ($uzytkownik->num_rows == 0):
										echo
										'<div class="card-body">
											<div class="alert alert-warning">
												<h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
												Brak Wyników!
											</div>
										</div>';
									else :
										while($row = mysqli_fetch_array($uzytkownik)):
											$role_uzytkownika = row("SELECT * FROM rangi WHERE id = ".$row['stanowisko']);
											$login_usera = '<a href="index.php?a=profile&p='.$row['id'].'" style="color: '.$role_uzytkownika['kolor'].'">['.$role_uzytkownika['kod_roli'].''.$row['nr_sluzbowy'].'] '.$row['login'].'</a>';
											echo '
												<div class="col-3">
													<div class="card shadow mb-4">
														<div class="card-header">
															<h3 class="m-0 font-weight-bold">'.$login_usera.'</h3>
														</div>
														<div class="card-body">
															<ul class="list-group list-group-unbordered mb-3">
																<li class="list-group-item">
																	<b>Punkty</b><b class="float-right">'.$row['punkty'].' pkt</b>
																</li>
																<li class="list-group-item">
																	<b>Przejechane kilometry</b><b class="float-right">'.$row['kilometry'].' km</b>
																</li>
																<li class="list-group-item">
																	<b>Ilość zaliczonych raportów</b><b class="float-right" style="color: #009900">'.$row['raporty'].'</b>
																</li>
																<li class="list-group-item">
																	<b>Ilość niezaliczonych raportów</b><b class="float-right" style="color: #ff0000">'.$row['nieraporty'].'</b>
																</li>
																<li class="list-group-item">
																	<b>Ilość anulowanych raportów</b><b class="float-right" style="color: #7901ff">e</b>
																</li>
															</ul>';
															if($perm['raporty_uzytkownicy_reset']){
																echo '<a class="btn btn-outline-info" href="index.php?a=raporty-użytkownicy&uid='.$row['id'].'">Wybierz</a>';
															} else {
															}
													   echo '</div>
													</div>
												</div>
											';
										endwhile;
									endif;
								?>
							</div>
                        </div>
                    </div>
                </div>
			</div>
			<!-- /.row -->
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->
