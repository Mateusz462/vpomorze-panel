
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Wniosek o Pracę</h1>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<!-- Main content -->
	<div class="content">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<?php
								rekrutacja_status();
								if(ograniczenia_status('rekrutacja') == true){
									$rekrutacja = true;
								} else {
									$rekrutacja = false;
								};
								// $ograniczenie = row("SELECT * FROM ograniczenia");
								// if($ograniczenie['przerwa techniczna'] == '1'){
								// 	$rekrutacja = false;
								// 	echo '<div class="alert alert-warning alert-dismissible"><h5><i class="icon fas fa-exclamation-triangle"></i>Przerwa Techniczna!</h5>Przerwa techniczna! Brak możliwości złożenia wniosku o pracę!</div>' ;
								// 	echo
								// 	'<div class="alert alert-danger alert-dismissible">
								// 		<h5><i class="fas fa-ban"></i> Przerwa Techniczna!</h5>
								// 		Trwają Prace nad Stroną!
								// 		Dostęp tylko dla <b>uprawnionych!</b>
								// 	</div>';
								// } elseif($ograniczenie['rekrutacja'] == '0' && $ograniczenie['przerwa techniczna'] != '1'){
								// 	$rekrutacja = false;
								// 	echo '<div class="alert alert-warning alert-dismissible"><h5><i class="icon fas fa-exclamation-triangle"></i>Rekrutacja Wyłączona!</h5></div>' ;
								// 	/* echo
								// 	'<div class="alert alert-danger alert-dismissible">
								// 		<h5><i class="fas fa-ban"></i> Przerwa Techniczna!</h5>
								// 		Trwają Prace nad Stroną!
								// 		Dostęp tylko dla <b>uprawnionych!</b>
								// 	</div>'; */
								// }else {
								// 	$rekrutacja = true;
								// };
							?>
							<?php if ($rekrutacja): ?>
								<?php
									if (!empty($_POST)) {
										if (empty($_POST['login']) || empty($_POST['email']) || empty($_POST['stanowisko']) || empty($_POST['przewoznik']) || empty($_POST['ile']) || empty($_POST['dlaczego']) || empty($_POST['doswiadczenie']) || !isset($_POST['terms'])){
											throwInfo('danger', 'Wypełnij wszystkie wymagane pola!', true);
										}else {
											$login = vtxt($_POST['login']);
											$email = vtxt($_POST['email']);
											$stanowisko = $_POST['stanowisko'];
											$przewoznik = vtxt($_POST['przewoznik']);
											$ile = vtxt($_POST['ile']);
											$dlaczego = vtxt($_POST['dlaczego']);
											$doswiadczenie = $_POST['doswiadczenie'];
											$addon = $_POST['addon'] ?? null;

											$date = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
											$timestamp = date("Y-m-d H:i:s");
											//etat
											$pon = $_POST['etat1'] ?? null;
											$wt = $_POST['etat2'] ?? null;
											$sr = $_POST['etat3'] ?? null;
											$czw = $_POST['etat4'] ?? null;
											$pi = $_POST['etat5'] ?? null;
											$sob = $_POST['etat6'] ?? null;
											$ndz = $_POST['etat7'] ?? null;
											if($pon){
												$pon = 1;
											}else{
												$pon = 0;
											}
											if($wt){
												$wt = 1;
											}else{
												$wt = 0;
											}
											if($sr){
												$sr = 1;
											}else{
												$sr = 0;
											}
											if($czw){
												$czw = 1;
											}else{
												$czw = 0;
											}
											if($pi){
												$pi = 1;
											}else{
												$pi = 0;
											}
											if($sob){
												$sob = 1;
											}else{
												$sob = 0;
											}
											if($ndz){
												$ndz = 1;
											}else{
												$ndz = 0;
											}
											//addon
											if($addon){
												$addon = 1;
											}else{
												$addon = 0;
											}

											$suma = $pon + $wt + $sr + $czw + $pi + $sob + $ndz;
											if (strlen($login) < 3 || strlen($login) > 25){
												throwInfo('danger', 'Login nie mieści się w danym zakresie!', true);
											}elseif (strlen($email) < 8 || strlen($email) > 50) {
												throwInfo('danger', 'Adres email nie mieści się w danym zakresie!', true);
											}elseif (filter_var($email, FILTER_VALIDATE_EMAIL) == false){
												throwInfo('danger', 'To nie jest poprawny adres email!', true);
											}elseif($suma < '1'){
												throwInfo('danger', 'Minimalny etat to 1/7', true);
											}elseif($suma > '5'){
												throwInfo('danger', 'Maksymalny etat to 6/7', true);
											}else{
												$istnieje = row("SELECT id FROM users WHERE login = '".$login."' OR email = '".$email."'");
												$istnieje2 = row("SELECT id FROM aplikacje WHERE login = '".$login."' OR email = '".$email."'");
												if ($istnieje || $istnieje2) {
													throwInfo('danger', 'Istnieje już użytkownik o takim samym loginie lub adresie email!', true);
												} else {
													$query = call("INSERT INTO aplikacje (login, email, pon, wt, sr, czw, pi, sob, niedz, przewoznik, stanowisko, addon, ileczasu, dlaczego, data, doswiadczenie) VALUES ('".$login."', '".$email."', '".$pon."', '".$wt."', '".$sr."', '".$czw."', '".$pi."', '".$sob."', '".$ndz."', '".$przewoznik."', '".$stanowisko."', '".$addon."', '".$ile."', '".$dlaczego."', '".$date."', '".$doswiadczenie."')");
													$log = call("INSERT INTO logi (uid, akcja) VALUES (0, 'Osoba ".$login." złożyła wniosek o pracę!')");
													if($query && $log){
														$client->channel->createMessage([
															'channel.id' => intval($pushchannel),
															'content' => '<@&723433480956018760>',
															'embed' => [
																"author" => [
																	"name" => "Złożono wniosek o pracę",
																	"url" => "",
																	"icon_url" => "https://cdn.discordapp.com/emojis/732618937446957096.png?v=1"
																],
																"description" => '
																	» Osoba: **'.$login.'**
																	» Typ: **Wniosek o pracę**
																	» Stanowisko: **'.$stanowisko.'**
																	» Etat: **'.$suma.'/7**
																	» Ile czasu grasz w OMSI (od kiedy)?: **'.$ile.'**
																	» Doświadczenie w innych vfirmach: **'.$doswiadczenie.'**
																	» Dlaczego ty?: **'.$dlaczego.'**
																',
																"color" => hexdec('#f6c23e'),
																"footer" => [
																	"icon_url" => "https://cdn.discordapp.com/icons/645582261378613249/5d0deaffdc5531a405583b16f823d928.png?size=128",
																	"text" => "Powiadomienie z panelu!"
																],
																"timestamp" => $timestamp
															]
														]);
														throwInfo('success', 'Sukces Wniosek Złożony Poprawnie!', true);
														header('Location: index.php?a=zloz-wniosek&succes');
													}else {
														throwInfo('danger', 'Blad!', true);
													}
												}
											}
										}
									}


									//busy

									$etaty1_b = row("SELECT SUM(poniedzialek) AS poniedzialek FROM etaty WHERE typ = 1");
									$etaty2_b = row("SELECT SUM(wtorek) AS wtorek FROM etaty WHERE typ = 1");
									$etaty3_b = row("SELECT SUM(sroda) AS sroda FROM etaty WHERE typ = 1");
									$etaty4_b = row("SELECT SUM(czwartek) AS czwartek FROM etaty WHERE typ = 1");
									$etaty5_b = row("SELECT SUM(piatek) AS piatek FROM etaty WHERE typ = 1");
									$etaty6_b = row("SELECT SUM(sobota) AS sobota FROM etaty WHERE typ = 1");
									$etaty7_b = row("SELECT SUM(niedziela) AS niedziela FROM etaty WHERE typ = 1");

									$wolne_etaty_b = row("SELECT * FROM wolne_etaty WHERE typ = 1");

									$liczba1B = $wolne_etaty_b['poniedzialek'] - $etaty1_b['poniedzialek'];
									$liczba2B = $wolne_etaty_b['wtorek'] - $etaty2_b['wtorek'];
									$liczba3B = $wolne_etaty_b['sroda'] - $etaty3_b['sroda'];
									$liczba4B = $wolne_etaty_b['czwartek'] - $etaty4_b['czwartek'];
									$liczba5B = $wolne_etaty_b['piatek'] - $etaty5_b['piatek'];
									$liczba6B = $wolne_etaty_b['sobota'] - $etaty6_b['sobota'];
									$liczba7B = $wolne_etaty_b['niedziela'] - $etaty7_b['niedziela'];



									//tramwaje

									$etaty1_t = row("SELECT SUM(poniedzialek) AS poniedzialek FROM etaty WHERE typ = 2");
									$etaty2_t = row("SELECT SUM(wtorek) AS wtorek FROM etaty WHERE typ = 2");
									$etaty3_t = row("SELECT SUM(sroda) AS sroda FROM etaty WHERE typ = 2");
									$etaty4_t = row("SELECT SUM(czwartek) AS czwartek FROM etaty WHERE typ = 2");
									$etaty5_t = row("SELECT SUM(piatek) AS piatek FROM etaty WHERE typ = 2");
									$etaty6_t = row("SELECT SUM(sobota) AS sobota FROM etaty WHERE typ = 2");
									$etaty7_t = row("SELECT SUM(niedziela) AS niedziela FROM etaty WHERE typ = 2");

									$wolne_etaty_t = row("SELECT * FROM wolne_etaty WHERE typ = 2");

									$liczba1T = $wolne_etaty_t['poniedzialek'] - $etaty1_t['poniedzialek'];
									$liczba2T = $wolne_etaty_t['wtorek'] - $etaty2_t['wtorek'];
									$liczba3T = $wolne_etaty_t['sroda'] - $etaty3_t['sroda'];
									$liczba4T = $wolne_etaty_t['czwartek'] - $etaty4_t['czwartek'];
									$liczba5T = $wolne_etaty_t['piatek'] - $etaty5_t['piatek'];
									$liczba6T = $wolne_etaty_t['sobota'] - $etaty6_t['sobota'];
									$liczba7T = $wolne_etaty_t['niedziela'] - $etaty7_t['niedziela'];

								?>
								<form action="index.php?a=zloz-wniosek" method="post">
									<div class="form-group">
										<label>Nazwa użytkownika:</label>
										<input type="text" name="login" class="form-control" placeholder="Nazwa użytkownika">
									</div>
									<div class="form-group">
										<label>Adres e-mail:</label>
										<input type="email" name="email" class="form-control" placeholder="E-mail">
									</div>
									<div class="row">
										<div class="col-4">
											<div class="form-group">
												<label>Wybierz Etat</label>
												<div><label><input type="checkbox" name="etat1"> Poniedziałek</label> (Wolnych etatów BUS: <?=$liczba1B;?> | TRAM: <?=$liczba1T;?>)</div>
												<div><label><input type="checkbox" name="etat2"> Wtorek </label> (Wolnych etatów BUS: <?=$liczba2B;?> | TRAM: <?=$liczba2T;?>)</div>
												<div><label><input type="checkbox" name="etat3"> Środa </label> ((Wolnych etatów BUS: <?=$liczba3B;?> | TRAM: <?=$liczba3T;?>)</div>
												<div><label><input type="checkbox" name="etat4"> Czwartek </label> (Wolnych etatów BUS: <?=$liczba4B;?> | TRAM: <?=$liczba4T;?>)</div>
												<div><label><input type="checkbox" name="etat5"> Piątek </label> (Wolnych etatów BUS: <?=$liczba5B;?> | TRAM: <?=$liczba5T;?>)</div>
												<div><label><input type="checkbox" name="etat6"> Sobota </label> (Wolnych etatów BUS: <?=$liczba6B;?> | TRAM: <?=$liczba6T;?>)</div>
												<div><label><input type="checkbox" name="etat7"> Niedziela </label> (Wolnych etatów BUS: <?=$liczba7B;?> | TRAM: <?=$liczba7T;?>)</div>
											</div>
										</div>
										<div class="col-4">
											<div class="form-group">
												<label for="przewoznik">Wybierz Przewoźnika</label>
												<?php $stanowisko = call("SELECT * FROM przewoznicy");
													while ($row = mysqli_fetch_array($stanowisko)):;?>
													<div class="form-check">
														<input class="form-check-input" type="radio" value="<?=$row['id'];?>" name="przewoznik">
														<label class="form-check-label"><?=$row['nazwa'];?></label>
													</div>
												<?php endwhile;?>
											</div>
										</div>
										<div class="col-4">
											<div class="form-group">
												<label for="przewoznik">Wybierz Stanowisko</label>
												<div class="form-check">
													<input class="form-check-input" type="radio" value="Praktykant - Kierowca" name="stanowisko">
													<label class="form-check-label">Praktykant - Kierowca</label>
												</div>
												<div class="form-check">
													<input class="form-check-input" type="radio" value="Praktykant - Motorniczy" name="stanowisko">
													<label class="form-check-label">Praktykant - Motorniczy</label>
												</div>
											</div>
										</div>
										<div class="col-12">
											<div class="form-group">
												<label>Określ, jakie posiadasz dodatki w OMSI 2, abyśmy mogli dostosować tabor pod Twoje służby:</label>
												<p class="text-danger">*jeżeli nie posiadasz żadnego z poniższych dodatków możesz ominąć te pytanie</p>
												<div><label><input type="checkbox" name="addon"> Add-On MAN Citybus Series </label></div>
												<div><label><input type="checkbox" name="addon"> Add-On Urbino Stadtbusfamilie </label></div>
												<div><label><input type="checkbox" name="addon"> Add-on Citybus 628c & 628g LF </label></div>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label>Ile czasu grasz w OMSI (od kiedy)?</label>
										<input type="text" name="ile" class="form-control" placeholder="Ile czasu grasz w OMSI (od kiedy)?">
									</div>
									<div class="form-group">
										<label>Twoje doświadczenie w innych vfirmach</label>
										<textarea class="form-control" name="doswiadczenie" rows="3" placeholder="Twoje doświadczenie w innych vfirmach"></textarea>
									</div>
									<div class="form-group">
										<label>Dlaczego ty?</label>
										<textarea class="form-control" name="dlaczego" rows="3" placeholder="Dlaczego ty?"></textarea>
									</div>
									<div class="row">
										<div class="col-12">
											<div class="icheck-primary">
												<input type="checkbox" id="agreeTerms" name="terms" value="agree">
												<label for="agreeTerms">
													Akceptuję<a href="https://drive.google.com/file/d/1782zliCIliiCRZTdZNwDXrcieE4gR-Pp/view"> Regulamin</a>
												</label>
											</div>
										</div>
										<div class="col-12">
											<button type="submit" class="btn btn-primary btn-block">Wyślij Wniosek</button>
										</div>
									</div>
								</form>
							<?php endif?>
						</div>
					</div>
				</div>
			</div>
		<!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content -->
