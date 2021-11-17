	<?php
		require_once "dist/themapart/alerts.php";
		hasPermissionTo('security', $user_role, 'access_tabor');
		require_once './funkcje/TaborFunction.php';
	?>

	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Spis pojazdów</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="index.php?a=home">Panel Kierowcy</a></li>
						<li class="breadcrumb-item active">Spis pojazdów</li>
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
							<h3 class="m-0 font-weight-bold text-primary">Autobusy dopuszczone do ruchu</h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body table-responsive p-0">
							<table class="table table-hover text-nowrap">
								<?php
									tabor_index('0');
								?>
							</table>
						</div>
					  <!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
				<!-- /.card -->

				<div class="col-12">
					<div class="card shadow mb-4">
						<div class="card-header">
							<h3 class="m-0 font-weight-bold text-primary">Tramwaje dopuszczone do ruchu</h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body table-responsive p-0">
							<table class="table table-hover text-nowrap">
								<?php
									tabor_index('1');
								?>
							</table>
						</div>
					  <!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>

				<div class="col-12">
					<div class="card shadow mb-4">
						<div class="card-header">
							<h3 class="m-0 font-weight-bold text-primary">Pojazdy niedopuszczone do ruchu</h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body table-responsive p-0">
							<table class="table table-hover text-nowrap">
								<?php
									tabor_index('2');
								?>
							</table>
						</div>
					  <!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>

				<div class="col-12">
					<div class="card shadow mb-4">
						<div class="card-header">
							<h3 class="m-0 font-weight-bold text-primary">Pojazdy ZTM</h3>
						</div>
						<!-- /.card-header -->

						<div class="card-body table-responsive p-0">
							<table class="table table-hover text-nowrap">
								<?php
									tabor_index('3');
								?>
							</table>
						</div>
					  <!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
				<!-- /.card -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->






<script>
	mainSocket.emit('get-notifications', function (res) {
		//console.log(res);
		const rebuildListener = (res) => {
			const usersObj = {}

			users.forEach(([id, user]) => {
				usersObj[id] = user
				console.log(user)
			});

			Object.keys(usersObj).forEach((id) => {
				if (!connectedUsers.has(id)) connectedUsers.set(id, usersObj[id]);
			});

			connectedUsers.forEach((_user, id) => {
				if (!(id in usersObj)) connectedUsers.delete(id)
			});

			onlineUsersBox.querySelectorAll('span[data-user]').forEach(elem => {
				if (!connectedUsers.has(elem.getAttribute('data-user'))) {
					elem.classList.add('animate__animated', 'animate__bounceOut')
					elem.addEventListener('animationend', () => {
						elem.remove()
					});
				}
			});

			connectedUsers.forEach((user, id) => {
				//console.log(user)
			});
		}
	})
</script>