<?php
	if($perm['zarzadzanie grafikiem'] == '0'){
		header('Location: index.php?a=home');
	}
	require_once './funkcje/DyspozytorniaFunction.php';
	if(!isset($_GET['driver']) && !isset($_GET['add']) && !isset($_GET['edit']) && !isset($_GET['date'])){
		//kontroler stron
		$strona1 = true;
		$strona2 = false;
		$strona3 = false;
		$strona4 = false;
		
		//data
		
		
		//funkcja do odswiezania grafiku
		
		
		
	}elseif(isset($_GET['driver']) && !isset($_GET['add']) && !isset($_GET['edit']) && !isset($_GET['date'])){

	}elseif(isset($_GET['driver']) && isset($_GET['add']) && isset($_GET['date'])){

	}elseif(isset($_GET['driver']) && isset($_GET['edit']) && isset($_GET['date'])){

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
					<h1>Grafik</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="index.php?a=home">Panel Kierowcy</a></li>
						<li class="breadcrumb-item active">Grafik</li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>


	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
					<div class="card shadow mb-4">
						<div class="card-body">
							<div class="tab-content">
								<div id="loading" class="col-md-12 text-center" style="display: none;">
									<div class="spinner-border" role="status">
										<span class="sr-only">Loading...</span>
									</div>
								</div>
								<div class="tab-pane active" id="tab_1">
									<div id="prywatny" class="col-md-12 text-center" style="display: none;">
									</div>
								</div>
								<!-- /.tab-pane -->
								<div class="tab-pane" id="tab_2">
									<div id="tresc" class="col-md-12 text-center" style="display: none;">
									</div>
									<div id="tresc2" class="col-md-12 text-center" style="display: none;">
									</div>
								</div>
								<!-- /.tab-pane -->
							</div>
							<!-- /.tab-content -->
						</div><!-- /.card-body -->
					</div><!-- /.card -->
					<div class="card shadow mb-4">
						<div class="card-body">
							<a href="index.php?a=dyspozytornia">Curent Week</a> <!--Previous week-->
							
								<?php
									if (isset($_GET['year']) && isset($_GET['week'])) {
										generuj_grafik_dyspozytornia($_GET['year'], $_GET['week']);
									} else {
										$dt = new DateTime;
										$o = $dt->format('o');
										$W = $dt->format('W');
										generuj_grafik_dyspozytornia($o, $W);
									}
								?>
							
							</table>
							
							
							<br /><br />
							<div class="table-responsive">

								

								
									
							</div>
						  <!-- /.card-body -->
						</div>
					</div>
					<!-- /.card -->
				</div>
			</div>
			<!-- /.row -->
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->
	<script type="text/javascript">
		$(function () {
			$('[data-toggle="tooltip"]').tooltip()
		})
	</script>