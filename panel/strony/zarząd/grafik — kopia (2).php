<?php
	if($perm['zarzadzanie grafikiem'] == '0'){
		header('Location: index.php?a=home');
	}

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
						<div class="card-body text-center">
							
						<br /><br />
						<div class="table-responsive">
							<table id="tabela" class="table table-bordered" style="width: calc(100% - 1px);  overflow-x:hidden;">
								<thead>
									<tr style="text-align: center">
										<th scope="col" style="width: 50px; vertical-align: middle;">Login</th>
										<th scope="col"><?=$dzis;?><BR /><?=$tydz;?></th>
										<th scope="col"><?=$jutro;?><BR /><?=$tydz1;?></th>
										<th scope="col"><?=$pojutrze;?><BR /><?=$tydz2;?></th>
										<th scope="col"><?=$za3dni;?><BR /><?=$tydz3;?></th>
										<th scope="col"><?=$za4dni;?><BR /><?=$tydz4;?></th>
										<th scope="col"><?=$za5dni;?><BR /><?=$tydz5;?></th>
										<th scope="col"><?=$za6dni;?><BR /><?=$tydz6;?></th>
										<th scope="col"><?=$za7dni;?><BR /><?=$tydz7;?></th>
									</tr>
								</thead>
								<tbody>
									<?php
										$targets = call("SELECT * FROM users WHERE deleted != '1' AND stanowisko != 21 AND stanowisko != 22 ORDER BY nr_sluzbowy");
										for ($i = 0; $i < $targets->num_rows; $i++):
										
											
											$role = row("SELECT * FROM rangi WHERE id = ".$row['stanowisko']);
											$etat = row("SELECT * FROM etaty WHERE uid = ".$row['id']);
											//$etat = $etat['poniedzialek'] + $etat['wtorek'] + $etat['sroda'] + $etat['czwartek'] + $etat['piatek'] + $etat['sobota'] + $etat['niedziela'];
											
											$grafik = call("SELECT * FROM grafik WHERE uid = '".$row['id']."'");
											$klasy = '';
											while ($row1 = mysqli_fetch_array($grafik)):
												for ($licz = 1; $licz <= 7; $licz++) {
													switch($row1['typ']){
														case "7":
															echo '<td style="vertical-align: middle;" class="'.$klasy.'"><b></b></td>';
														break;
														
														case "4":
															echo '<td style="vertical-align: middle;" class="'.$klasy.'"><b style="color: orange;"></b></td>';
														break;
													}
												}
												
												/* 
												if(!empty($row1['pojazd'])){
													$poj = row("SELECT * FROM tabor WHERE id = ".$row1['pojazd']);
												}
												if($row1['typ'] == "7") $wpis = "<small>Wolne grafikowe</small>";
												elseif($row1['typ'] == "4") $wpis = '<b style="color: orange;">Urlop</b>';
												elseif($row1['typ'] == "2") $wpis = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&edit&date='.$date.'"><button type="button" class="btn btn-warning btn-lg"><b>'.$row1['linia']. '/' .$row1['brygada']. '/' .$row1['zmiana'].'</b><br/><small>'.$row1['miejsce'].'</small><br/><b>'.$poj['marka']. ' ' .$poj['model']. ' #' .$poj['taborowy'].'</b><br/><small>Kurs Z Wolnego</small></button></a>';
												elseif($row1['typ'] == "3" || $row1['typ'] == "5" || $row1['typ'] == "8") $wpis = '<s><b>'.$row1['linia']. '/' .$row1['brygada']. '/' .$row1['zmiana'].'</b><br /><small>'.$row1['miejsce'].'</small><br/><b>'.$poj['marka']. ' ' .$poj['model']. ' #' .$poj['taborowy'].'</b><br/></s><small>Anulowany</small>';
												elseif($row1['typ'] == "6") $wpis = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&edit&date='.$date.'"><button type="button" class="btn btn-info btn-lg"><b>'.$row1['linia']. '/' .$row1['brygada']. '/' .$row1['zmiana'].'</b><br/>'.$row1['godzina_od']. ' - ' .$row1['godzina_do'].'<br/><small>'.$row1['miejsce'].'</small><br/><b>'.$poj['marka']. ' ' .$poj['model']. ' #' .$poj['taborowy'].'</b><br/><small>Rezerwa</small></button></a>';
												elseif($row1['typ'] == "1"){
													$wpis = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&edit&date='.$dzisiaj.'"><button type="button" class="btn btn-primary btn-lg"><b>'.$row1['linia']. '/' .$row1['brygada']. '/' .$row1['zmiana'].'</b><br/><small>'.$row1['miejsce'].'</small><br/><b>'.$poj['marka']. ' ' .$poj['model']. ' #' .$poj['taborowy'].'</b><br /><small>Kurs row1ikowy</small></button></a>';
												} */
												//print_r($row1);
											endwhile;
											
										?>
										<tr style="text-align: center">
											<td style="vertical-align: middle;"><b><a href="index.php?a=dyspozytornia&driver=<?=$row['id'];?>" style="color: <?=$role['kolor'];?>"><?=$row['login'], ' [', $role['kod_roli'], $row['nr_sluzbowy'],']';?></a></b><br /><small>X/7</small></td>
											<?php
												
													'<td scope="col" style="vertical-align: middle;"><?=$wpis;?></td>
													<td scope="col" style="vertical-align: middle;"><?=$wpis1;?></td>
													<td scope="col" style="vertical-align: middle;"><?=$wpis2;?></td>
													<td scope="col" style="vertical-align: middle;"><?=$wpis3;?></td>
													<td scope="col" style="vertical-align: middle;"><?=$wpis4;?></td>
													<td scope="col" style="vertical-align: middle;"><?=$wpis5;?></td>
													<td scope="col" style="vertical-align: middle;"><?=$wpis6;?></td>
													<td scope="col" style="vertical-align: middle;"><?=$wpis7;?></td>';
													
												
											?>
										</tr>
									<?php endfor;?>
									
								</tbody>
							</table>
						</div>
					  <!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
			</div>
			<!-- /.row -->
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->