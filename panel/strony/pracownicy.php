<?php
	require_once "dist/themapart/alerts.php";
	hasPermissionTo('security', $user_role, 'access_pracownicy');
	require_once './funkcje/PracownicyFunction.php';
?>



    <!-- Content Header (Page header) -->
    <section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Pracownicy</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="index.php?a=home">Panel Kierowcy</a></li>
						<li class="breadcrumb-item active">Pracownicy</li>
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
						<div class="card-header py-3">
							<h3 class="m-0 font-weight-bold text-primary">Zarząd</h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body table-responsive p-0">
							<table class="table table-hover text-nowrap">
								<?php
									pracownicy_index('0');
								?>
							</table>
						</div>
					  <!-- /.card-body -->
					</div>
					<!-- /.card -->

				</div>

				<div class="col-12">
					<div class="card shadow mb-4">
						<div class="card-header py-3">
							<h3 class="m-0 font-weight-bold text-primary">Pracownicy</h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body table-responsive p-0">
							<table class="table table-hover text-nowrap">
								<?php
									pracownicy_index('1');
								?>
							</table>
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
			</div><!-- /.container-fluid -->
		</div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
<!-- Remember to include jQuery :) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>

<!-- jQuery Modal -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>

<!-- Page specific script -->
<script type="text/javascript">
	$(document).ready(function() {
		$(".edit_btn").on('click', function() {
			$("#edituser").modal('show');


				var id = $(this).data('id')
				var login = $(this).data('login')
				var stanowisko = $(this).data('stanowisko')
				var email = $(this).data('email')
				var produkcja = $(this).data('produkcja')
				var nr_rejestracyjny = $(this).data('nr')
				var przeglad = $(this).data('przeglad')
				var klasa = $(this).data('klasa')
				var podłoga = $(this).data('pod')
				var zajezdnia = $(this).data('zajezdnia')
				var koszt = $(this).data('koszt')
				var uwagi = $(this).data('uwagi')

				$('#id').val(id);
				$('#taborowy').val(tab);
				$('#marka').val(marka);
				$('#model').val(model);
				$('#produkcja').val(produkcja);
				$('#przeglad').val(przeglad);
				$('#nr_rejestracyjny').val(nr_rejestracyjny);
				$('#klasa').val(klasa);
				$('#podłoga').val(podłoga);
				$('#zajezdnia').val(zajezdnia);
				$('#koszt').val(koszt);
				$('#uwagi').val(uwagi);


		});



		$(".del_btn").on('click', function() {
			$("#deleteuser").modal('show');
				var id = $(this).data('id')
				$('#did').val(id);
		})
	});
</script>
