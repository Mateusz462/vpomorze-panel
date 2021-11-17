	<?php 
		if($perm['pisanie_discord_ogloszenia'] == '0'){
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
		if (!empty($_POST)) {
			if (isset($_POST['action']) && empty($_POST['title']) || empty($_POST['description']) || empty($_POST['color'])) {
				throwInfo('danger', 'Wypełnij wszystkie pola poprawnie!', true);
			} else {
				
				switch($_POST['color']) { 
					case 'danger': $color = '#e74a3b'; break;
					case 'warning': $color = '#f6c23e'; break;
					case 'success': $color = '#1cc88a'; break;
					case 'info': $color = '#36b9cc'; break;
					case 'dark': $color = '#5a5c69'; break;
					case 'light': $color = '#f8f9fc'; break;
					case 'primary': $color = '#4e73df'; break;
					default:
						$color = '#f6c23e'; 
						$_POST['color'] = 'warning';
					break; // Strona ładowana domyślnie
				}
				$ping = $_POST["ping"] ?? null;
				$ping1 = $_POST["ping1"] ?? null;
				$ping2 = $_POST["ping2"] ?? null;
				if($ping){
					$message = '';
				}elseif($ping1){
					$message = '@everyone';
				}elseif($ping2){
					$message = '@here';
				}else{
					$message = '';
				}
				$title = $_POST["title"];
				$title_url = 'https://www.vpomorze.pl/panel';
				$description = $_POST["description"];
				$timestamp = date("Y-m-d H:i:s");
				if($user['dc'] == 1){
					$avatar = "https://cdn.discordapp.com/avatars/".$dc['dcid']."/".$dc['avatar'].".png";
				} else {
					$avatar = "https://i.ibb.co/xJVtYKh/discord.png";
				}
				//https://cdn.discordapp.com/avatars/467020104555560972/bd6ccc87b044054dc58cd8778d29d5d1.png?size=128
				$client->channel->createMessage([
					'channel.id' => intval($ogoszeniachannel),
					'content' => $message,
					'embed' => [
						"title" => $title,
						"url" => $title_url,
						"color" => hexdec($color),
						"description" => $description,
						"author" => [
							"name" => '['.$role['kod_roli'].''.$user['nr_sluzbowy'].'] '.$user['login'].'',
							"url" => "https://www.vpomorze.pl/panel/index.php?a=profile&p=".$user['id'].'',
							"icon_url" => $avatar
						],
						"footer" => [
							"icon_url" => "https://cdn.discordapp.com/icons/645582261378613249/5d0deaffdc5531a405583b16f823d928.png",
							"text" => "Ogłoszenie z panelu!"
						],
						"timestamp" => $timestamp
					]
				]);
				

				
				
				throwInfo('success', 'Sukces!', true);
				header('Refresh:1');
			}
		}
	?>	
    <!-- Main content -->
    <section class="content">
        <div class="row">
			<div class="col-md-12">
				<div class="card shadow mb-4">
					<div class="card-header">
						<h3 class="m-0 font-weight-bold text-primary">Ogłoszenia Discord</h3>
					</div>
					<!-- /.card-header -->
					<div class="card-body">
						<form action="" method="POST">
							<div class="row">
								<div class="col-md-12 mb-6">
									<div class="form-group">
										<label for="title">Tytuł:</label>
										<input class="form-control" type="text" name="title" placeholder="Tytuł">
									</div>
								</div>
								<div class="col-md-12 mb-6">
									<div class="form-group">
										<label for="description">Treść Ogłoszenia:</label>
										<textarea class="form-control" name="description" cols="30" rows="4" placeholder="Treść Ogłoszenia"></textarea>
									</div>
								</div>
								<div class="col-md-12 mb-6">
									<div class="form-group mb-3">
										<label for="kategoria">Wybierz Kolor</label>
										<select id="kategoria" name="color" class="form-control">
											<option value="danger">ADMINISTRACYJNE</option>
											<option value="warning">OGÓLNE</option>
											<option value="success">KADRY</option>
											<option value="info">DYSPOZYTORNIA</option>
											<option value="dark">NADZÓR RUCHU</option>
											<option value="light">EKSPLOATACJA FLOTY</option>
											<option value="primary">POBIERALNIA</option>
										</select>
									</div>
								</div>
								<div class="col-lg-12 mb-6">
									<div class="form-group">
										<label>Dostępne Pingi</label>
										<div class="form-check">
											<input class="form-check-input" type="radio" id="ping" name="ping">
											<label class="form-check-label" for="ping"> brak pingu</label>
										</div>
										<div class="form-check">
											<input class="form-check-input" type="radio" id="ping1" name="ping1">
											<label class="form-check-label" for="ping1"> everyone</label>
										</div>
										<div class="form-check">
											<input class="form-check-input" type="radio" id="ping2" name="ping2">
											<label class="form-check-label" for="ping2"> here</label>
										</div>
									</div>
								</div>
								<div class="col-md-12 mb-6">
									<div class="form-group">
										
										<button type="submit" name="action" class="btn btn-primary">Zatwierdź</button>
									</div>
								</div>
							</div>

						</form>
					</div>
				</div>
			</div>
			
			
		</div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->