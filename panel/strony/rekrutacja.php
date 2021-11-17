	<?php
		require_once "dist/themapart/alerts.php";
		hasPermissionTo('security', $user_role, 'access_rekrutacja');
	?>
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Rekrutacja</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="index.php?a=home">Panel Kierowcy</a></li>
						<li class="breadcrumb-item active">Rekrutacja</li>
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
						<div class="card-header">
							<h3 class="m-0 font-weight-bold">Witaj <?=$user['login']?></h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							Jeżeli to czytasz, oznacza to że pomyślnie przeszedłeś/aś <b>pierwszy etap rekrutacji</b>. Aby móc wykonywać służby musisz ukończyć ostatni etap rekrutacji - <b>rozmowa kwalifikacyjna</b>. Odbędzie się ona na naszym specjalnym serwerze Discord do którego dostaniesz się po wciśnięciu przycisku <b>poniżej</b>.<br><br><b>UWAGA</b><br>Rozmowa kwalifikacyjna jest <b>wymagana</b> w celu zatrudnienia się w Wirtualnym Pomotrzu! Nie obecnosc na rozmowie oznacza <b>odrzucanie kandydatury!</b><br><br>Wrazie jakichkolwiek problemów z dołączeniem na serwer, należy niezwłocznie powiadomić o tym Zarząd!
						</div>
						<!-- /.card-body -->
						<div class="card-footer">
							<?php
								if($user['dc'] == 0){
									echo '<a href="https://wirtualne-pomorze.pl/panel/index.php?a=oauth2.php" class="btn btn-primary btn-block"><i class="fab fa-discord"></i> Discord</a>';
								} else {
									throwInfo('info', '<i class="fab fa-discord"></i> Połączono konto discord z panelem', false);
									throwInfo('warning', 'W ciągu najbliższych dni zostaniesz umówiony na rozmowę kwalifikacyjną. Obserwuj Discorda by nie przegapić terminu rozmowy :-)', false);
								}
							?>

						</div>
					</div>
					<!-- /.card -->
				</div>
				<!-- /.col -->
			</div>
        <!-- /.row -->
		</div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
