	<?php
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
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="card shadow mb-4">
						<div class="card-header">
							<h3 class="m-0 font-weight-bold text-primary" id="tytul">Uwaga!</h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body text-center">
							<div class="progress">
								<div id="dynamic" class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
									<span id="current-progress"></span>
								</div>
							</div>
							<div class="dane" style="display: none">
								<?php
									echo 
									UserInfo::get_ip(), '<br>',
									UserInfo::get_os(), '<br>',
									UserInfo::get_browser(), '<br>',
									UserInfo::get_device();
								
								?>
							</div>
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->						
				</div>
				<!-- /.col -->
			</div>
        <!-- /.row -->
		</div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
	<script type="text/javascript">
		
		$(function() {
			
			var current_progress = 0;
			var tytul_progress = 0;
			var interval = setInterval(function() {
				current_progress += 2;
				tytul_progress += 1;
				$("#dynamic")
				.css("width", current_progress + "%")
				.attr("aria-valuenow", current_progress)
				.text(current_progress + "% Ładowanie");
				if (current_progress == 20){
					$("#dynamic").css('background-color', 'orange');
					current_progress += 0;
					current_progress += 5;
					current_progress += 5;
					current_progress += 5;
					current_progress += 5;
				}
				if (current_progress == 50){
					$("#dynamic").css('background-color', 'pink');
					current_progress += 0;
					current_progress += 10;
					current_progress += 10;
					current_progress += 10;
					current_progress += 10;
				}
				if (current_progress == 70){
					$("#dynamic").css('background-color', 'red');
					current_progress += 1;
				}
				if (current_progress >= 100){
					$("#dynamic").css('background-color', 'blue'); 
					clearInterval(interval);
					//setTimeout(showPage, 0);
					$(".dane").css('display', 'block');
					$("#dynamic").css('display', 'none');
				}
				if (current_progress == 1 || current_progress == 30 || current_progress == 60 || current_progress == 90){
					$("#tytul").text("Twoje IP Zostalo zapisane!");
				}
				else if (current_progress == 15 || current_progress == 45 || current_progress == 75){
					$("#tytul").text("Uwaga!");
				}
				else if (current_progress == 100){
					$("#tytul").text("Oto twoje dane!");
				}
			}, 1000);
			
		});
</script>