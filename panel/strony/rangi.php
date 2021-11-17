<?php
	require_once "dist/themapart/alerts.php";
	hasPermissionTo('security', $user_role, 'access_rangi');

	if (isset($_GET['id'])) {
		$isPlayer = false;
		$info = true;
		$id = vtxt($_GET['id']);
		$count = row("SELECT count(id) AS id FROM users WHERE stanowisko = '".$id."'");

	} else {
		$isPlayer = true;
	}
?>



<!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Rangi</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php?a=home">Panel Kierowcy</a></li>
              <li class="breadcrumb-item active">Rangi</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

<!-- Main content -->
    <section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="card shadow mb-4">
						<?php if ($isPlayer): ?>
						<div class="card-header">
							<h3 class="card-title">Rangi</h3>
						</div>
						<?php elseif ($info): ?>
						<div class="card-header">
							<?php
								$role = row("SELECT * FROM rangi WHERE id = ".$id);
							?>
							<h3 class="card-title">
								Ranga
								<span style="color: <?=$role['kolor'];?>"><?=$role['nazwa'], '</span>&nbsp<span class="badge bg-ligth">';if($count['id'] <= 0) echo ''; elseif($count['id'] == 1) echo $count['id'], ' osoba'; elseif($count['id'] <= 4) echo $count['id'], ' osoby'; elseif($count['id'] >= 5) echo $count['id'], ' osób';?></span>
								<div class="float-right">
									<a href="index.php?a=rangi" class="btn btn-outline-success">Widok Rang<a>
								</div>
							</h3>
						</div>
						<?php endif; ?>
						<!-- /.card-header -->
						<?php if ($isPlayer): ?>
							<div class="card-body p-0">
								<table class="table table-striped">
									<?php
										$targets = call("SELECT * FROM rangi ORDER BY kolejnosc");
										if ($targets->num_rows == 0) {?>
											<div class="card-body">
												<?php throwInfo('info', 'Brak Danych!', false);?>
											</div>
										<?php } else {
									?>
									<thead>
										<tr>
											<th class="text-center">Nazwa</th>
										</tr>
									</thead>
									<tbody>
									<?php
										$i = 1;
										while ($row = mysqli_fetch_array($targets)): ?>
										<tr>
											<td class="text-center"><a href="index.php?a=rangi&id=<?=$row['id'];?>" style="color: <?=$row['kolor'];?>"><?=$row['nazwa'];?></a></td>
										</tr>
										<?php endwhile;}?>
									</tbody>
								</table>
							</div>
							<!-- /.card-body -->
						<?php //elseif ($brak): ?>

						<?php elseif ($info): ?>
							<div class="card-body p-0">
								<div class="card-body">
									<?php
										$target = call("SELECT * FROM users WHERE stanowisko = ".$id);
										if ($target->num_rows == 0) {?>
											<div class="card-body">
												<?php throwInfo('info', 'Ta ranga nie jest przydzielona do żadnej osoby!', false);?>
											</div>
										<?php } else {
											while ($row1 = mysqli_fetch_array($target)): ?>
											<?php
												//$user = row("SELECT * FROM users WHERE id = ".$row1['uid']);
												$role = row("SELECT * FROM rangi WHERE id = ".$id);
											?>
												<a href="index.php?a=profile&p=<?=$row1['id'];?>" style="color: <?=$role['kolor'];?>"><?=$row1['login'];?></a> ●&nbsp;
											<?php endwhile;
										};
									?>
								</div>
							</div>
						<?php endif; ?>
					</div>
					<!-- /.card -->

				</div>
			</div>
			<!-- /.row -->
		</div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
