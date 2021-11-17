<?php
    if($perm['zarzadanie panelem'] == '0'){
        header('Location: index.php?a=home');
    }

    if (!isset($_GET['server']) && !isset($_GET['send'])) {
        $start = true;
        $strona1 = false;
        $strona2 = false;
        $strona3 = false;
        $strona4 = false;
        $strona5 = false;
        $strona6 = false;
    } elseif (isset($_GET['server']) && !isset($_GET['send'])) {
        $start = false;
        $strona1 = true;
        $strona2 = false;
        $strona3 = false;
        $strona4 = false;
        $strona5 = false;
        $strona6 = false;
        $server = vtxt($_GET['server']);
        $guild = get_guild($server);
        $users_count = filter_count('users_filter_count', $server);
        $roles_count = filter_count('roles_filter_count', $server);
        $channels_count = filter_count('channels_filter_count', $server);
        $channels_text_count = filter_count('channels_text_filter_count', $server);
        $channels_voice_count = filter_count('channels_voice_filter_count', $server);
        $channels_cat_count = filter_count('channels_cat_filter_count', $server);
        $bans_count = filter_count('bans_count', $server);

        $channels_text_filter = filter_count('channels_text_filter', $server);

    } elseif (isset($_GET['server']) && isset($_GET['send']) && $_GET['send'] == 'message') {
        $start = false;
        $strona1 = true;
        $strona2 = false;
        $strona3 = false;
        $strona4 = false;
        $strona5 = false;
        $strona6 = false;
        $server = vtxt($_GET['server']);
        $guild = get_guild($server);
        $users_count = filter_count('users_filter_count', $server);
        $roles_count = filter_count('roles_filter_count', $server);
        $channels_count = filter_count('channels_filter_count', $server);
        $channels_text_count = filter_count('channels_text_filter_count', $server);
        $channels_voice_count = filter_count('channels_voice_filter_count', $server);
        $channels_cat_count = filter_count('channels_cat_filter_count', $server);
        $bans_count = filter_count('bans_count', $server);

        $channels_text_filter = filter_count('channels_text_filter', $server);
        if (!empty($_POST)) {
    		if (empty($_POST['channel'])){
    			throwInfo('danger', 'wypelnij wszystkie pola', true);
    		}else {
                //$data = date("H:i:s Y-m-d");

                $channel = vtxt($_POST['channel']);
    			$message = vtxt($_POST['message']);


                discord_send_message('message', $channel, $message, '', '', '', '');


    		}
    	}
    } elseif (isset($_GET['server']) && isset($_GET['send']) && $_GET['send'] == 'embed') {
        $start = false;
        $strona1 = true;
        $strona2 = false;
        $strona3 = false;
        $strona4 = false;
        $strona5 = false;
        $strona6 = false;
        $server = vtxt($_GET['server']);
        $guild = get_guild($server);
        $users_count = filter_count('users_filter_count', $server);
        $roles_count = filter_count('roles_filter_count', $server);
        $channels_count = filter_count('channels_filter_count', $server);
        $channels_text_count = filter_count('channels_text_filter_count', $server);
        $channels_voice_count = filter_count('channels_voice_filter_count', $server);
        $channels_cat_count = filter_count('channels_cat_filter_count', $server);
        $bans_count = filter_count('bans_count', $server);

        $channels_text_filter = filter_count('channels_text_filter', $server);
        if (!empty($_POST)) {
    		if (empty($_POST['channel'])){
    			throwInfo('danger', 'wypelnij wszystkie pola', true);
    		}else {

                $channel = vtxt($_POST['channel']);

                $title = vtxt($_POST['title']);
                $title_url = vtxt($_POST['title_url']);
                $description = vtxt($_POST['description']);
                $footer = 'asd';
                $message = 'ad';
                discord_send_message('embed', $channel, $message, $title, $title_url, $description, $footer);
    		}
    	}
    }
?>
<!-- Main content -->
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Zarządzanie Firmowym Discordem</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="index.php?a=home">Panel Kierowcy</a></li>
					<li class="breadcrumb-item active">Zarządzanie Firmowym Discordem</li>
				</ol>
			</div>
		</div>
	</div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="container-fluid">
        <?php if($start):?>
            <div class="row">
                <div class="col-12">
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <h3 class="m-0 font-weight-bold">Wybierz Server</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <?php
                                    if($user['id'] == 6):
                                ?>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="card shadow mb-4">
                                            <div class="card-header">
                                                <h3 class="m-0 font-weight-bold text-center">Wirtualne Pomorze</h3>
                                            </div>
                                            <div class="card-body">
                                                <p class="text-center"><img class="mx-auto element img-thumbnail" src="./../portal/img/WP-logo250.png" style="width: 125px"></p>
                                                <br>
                                                <p class="text-center"><a href="index.php?a=discord-zarządzanie&server=645582261378613249" class="btn btn-success btn-lg">Wybierz</a></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="card shadow mb-4">
                                            <div class="card-header">
                                                <h3 class="m-0 font-weight-bold text-center">Rekrutacja do Wirtualnego Pomorza</h3>
                                            </div>
                                            <div class="card-body">
                                                <p class="text-center"><img class="mx-auto element img-thumbnail" src="./../portal/img/wp-logo-rekrutacja.png" style="width: 125px"></p>
                                                <br>
                                                <p class="text-center"><a href="index.php?a=discord-zarządzanie&server=844148787832553472" class="btn btn-success btn-lg">Wybierz</a></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-4">
                                        <div class="card shadow mb-4">
                                            <div class="card-header">
                                                <h3 class="m-0 font-weight-bold text-center">Testowy Serwer</h3>
                                            </div>
                                            <div class="card-body">
                                                <p class="text-center"><img class="mx-auto element img-thumbnail" src="./../portal/img/wp-logo-testowy-serwer.png" style="width: 125px"></p>
                                                <br>
                                                <p class="text-center"><a href="index.php?a=discord-zarządzanie&server=751885764010311731" class="btn btn-success btn-lg">Wybierz</a></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="col-lg-6">
                                        <div class="card shadow mb-4">
                                            <div class="card-header">
                                                <h3 class="m-0 font-weight-bold text-center">Wirtualne Pomorze</h3>
                                            </div>
                                            <div class="card-body">
                                                <p class="text-center"><img class="mx-auto element img-thumbnail" src="./../portal/img/WP-logo250.png" style="width: 125px"></p>
                                                <br>
                                                <p class="text-center"><a href="index.php?a=discord-zarządzanie&server=645582261378613249" class="btn btn-success btn-lg">Wybierz</a></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="card shadow mb-4">
                                            <div class="card-header">
                                                <h3 class="m-0 font-weight-bold text-center">Rekrutacja do Wirtualnego Pomorza</h3>
                                            </div>
                                            <div class="card-body">
                                                <p class="text-center"><img class="mx-auto element img-thumbnail" src="./../portal/img/wp-logo-rekrutacja.png" style="width: 125px"></p>
                                                <br>
                                                <p class="text-center"><a href="index.php?a=discord-zarządzanie&server=844148787832553472" class="btn btn-success btn-lg">Wybierz</a></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif($strona1):?>
            <div class="row">
                <div class="col-md-4">
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <h3 class="m-0 font-weight-bold">
                                Informacje Ogólne
                                <div class="float-right">
									<a href="index.php?a=discord-zarządzanie" class="btn btn-outline-success">Powrót<a>
								</div>
                            </h3>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
									<h5><b><?=$guild['name'];?></b></h5>
								</li>
                            </ul>
                            <ul class="list-group list-group-unbordered mb-3">
								<li class="list-group-item">
									<b>🎖 • Owner ID:</b>
									<b class="float-right">
                                        <?=$guild['owner_id'];?>
									</b>
								</li>
								<li class="list-group-item">
									<b>🔗• ID:</b>
									<b class="float-right">
                                        <?=$guild['id'];?>
									</b>
								</li>
								<li class="list-group-item">
									<b>🗂 • Poziom zabezpieczeń:</b>
                                    <b class="float-right">
                                        <?php
                                            switch ($guild['verification_level']) {
                                                case '0':
                                                    echo '⬛ Żaden';
                                                break;
                                                case '1':
                                                    echo '🟩 Niski';
                                                break;
                                                case '2':
                                                    echo '🟨 Średni';
                                                break;
                                                case '3':
                                                    echo '🟧 Wysoki';
                                                break;
                                                case '4':
                                                    echo '🟥 Najwyższy';
                                                break;
                                            };
                                        ?>
									</b>
								</li>
								<li class="list-group-item">
                                    <b>🏝 • Region:</b>
									<b class="float-right">
                                        <?=$guild['region'];?>
									</b>
								</li>
                            </ul>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>❌ • Ilość banów:</b>
									<b class="float-right">
                                        <?=$bans_count;?>
									</b>
								</li>
                                <li class="list-group-item">
                                    <b>📽 • Filtr treści:</b>
									<b class="float-right">
                                        <?php
                                            switch ($guild['explicit_content_filter']) {
                                                case '0':
                                                    echo '🟥 Wyłączone';
                                                break;
                                                case '1':
                                                    echo '🟧 od osób bez roli';
                                                break;
                                                case '2':
                                                    echo '🟩 od wszystkich osób';
                                                break;
                                            };
                                        ?>
									</b>
								</li>
                            </ul>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b><i class="fa fa-angle-double-right"></i> Grafiki:</b>
								</li>
                                <li class="list-group-item">
                                    <b>🖼 • Ikona:</b>
									<b class="float-right">
                                        <a href="https://cdn.discordapp.com/icons/<?=$guild['id'];?>/<?=$guild['icon'];?>.png?size=128" target="_blank">Klik</a>
									</b>
								</li>
                            </ul>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>👥 • Użytkowników:</b>
									<b class="float-right">
                                        <?=$users_count;?>
									</b>
								</li>
                                <li class="list-group-item">
                                    <b><i class="fa fa-angle-double-right"></i> Role:</b>
                                    <b class="float-right">
                                        <?=$roles_count?>
									</b>
								</li>
                                <li class="list-group-item">
                                    <b>📂 • Kanałów: </b>
									<b class="float-right">
                                        <?=$channels_count?>
									</b>
								</li>
                                <li class="list-group-item">
                                    <b>💬 • Tekstowe: </b>
									<b class="float-right">
                                        <?=$channels_text_count?>
									</b>
								</li>
                                <li class="list-group-item">
                                    <b>🔊 • Głosowe: </b>
									<b class="float-right">
                                        <?=$channels_voice_count?>
									</b>
								</li>
                                <li class="list-group-item">
                                    <b>🗄 • Kategorii: </b>
									<b class="float-right">
                                        <?=$channels_cat_count?>
									</b>
								</li>
							</ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <h3 class="m-0 font-weight-bold">Wysyłanie Wiadomości</h3>
                        </div>
                        <div class="card-body">
                            <form action="index.php?a=discord-zarządzanie&server=<?=$server?>&send=message" method="POST">
                                <h2 class="title is-size-4">Kanał</h2>
                                <div class="form-group">
                					<label for="channel">Wybierz kanał</label>
                					<select id="channel" name="channel" class="form-control">
                						<option selected="" disabled="">--- Wybierz ---</option>
                						<?php foreach($channels_text_filter as $item):?>
                						<option value="<?=$item['id'];?>"><?=$item['name'];?></option>
                						<?php endforeach;?>
                					</select>
                				</div>
                                <hr>
                                <h2 class="title is-size-4">Wiadomość</h2>
                                <div class="form-group">
                                    <label class="label">Wiadomość — optional</span></label>
                                    <textarea autocomplete="off" name="message" class="form-control" placeholder="Twoja wiadomość..."></textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success"><i class="fas fa-paper-plane"></i> Wyślij wiadomość</button>
                                </div>
                            </form>
                            <br>
                            <hr>
                            <form action="index.php?a=discord-zarządzanie&server=<?=$server?>&send=embed" method="POST">
                                <h2 class="title is-size-4">Kanał</h2>
                                <div class="form-group">
                					<label for="channel">Wybierz kanał</label>
                					<select id="channel" name="channel" class="form-control">
                						<option selected="" disabled="">--- Wybierz ---</option>
                						<?php foreach($channels_text_filter as $item):?>
                						<option value="<?=$item['id'];?>"><?=$item['name'];?></option>
                						<?php endforeach;?>
                					</select>
                				</div>
                                <hr>
                                <h2 class="title is-size-4">Embed</h2>
                                <div class="form-group">
                                    <label class="label">Tytuł </label>
                                    <input class="form-control" type="text" name="title" placeholder="Tytuł">
                                </div>
                                <div class="form-group">
                                    <label class="label">Link URL w tytule — optional</span></label>
                                    <input class="form-control" type="text" name="title_url" placeholder="Link URL">
                                </div>
                                <div class="form-group">
                                    <label class="label">Opis — optional</span></label>
                                    <textarea autocomplete="off" name="description" class="form-control" placeholder="Opis"></textarea>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success"><i class="fas fa-paper-plane"></i> Wyślij wiadomość embed</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <h3 class="m-0 font-weight-bold">Informacje Ogólne</h3>
                        </div>
                        <div class="card-body">
                            <a href="index.php?a=discord-zarządzanie&server=645582261378613249" class="btn btn-success btn-lg">Wybierz</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <h3 class="m-0 font-weight-bold">Informacje Ogólne</h3>
                        </div>
                        <div class="card-body">
                            <a href="index.php?a=discord-zarządzanie&server=645582261378613249" class="btn btn-success btn-lg">Wybierz</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <h3 class="m-0 font-weight-bold">Informacje Ogólne</h3>
                        </div>
                        <div class="card-body">
                            <a href="index.php?a=discord-zarządzanie&server=645582261378613249" class="btn btn-success btn-lg">Wybierz</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <h3 class="m-0 font-weight-bold">Informacje Ogólne</h3>
                        </div>
                        <div class="card-body">
                            <a href="index.php?a=discord-zarządzanie&server=645582261378613249" class="btn btn-success btn-lg">Wybierz</a>
                        </div>
                    </div>
                </div>
                <div class="col-10">
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <h3 class="m-0 font-weight-bold text-primary">Przejdź do ustawień danej kategorii</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
    						<table class="table table-hover text-nowrap">
    							<thead style="text-align: center">
    								<tr>
    								<th>Ustawienie</th>
    								<th>Opcje</th>
    								</tr>
    							</thead>
    							<tbody style="text-align: center">
    								<tr style="text-align: center">
    									<td>Emoji</td>
    									<td class="project-actions ">
    										<a href="index.php?a=discord-zarządzanie&strona=1"><button type="button" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Wybierz</button></a>
                                        </td>
    								</tr>
    								<tr style="text-align: center">
    									<td>Kanały</td>
    									<td class="project-actions ">
    										<a href="index.php?a=discord-zarządzanie&strona=2"><button type="button" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Wybierz</button></a>
    									</td>
    								</tr>
    								<tr style="text-align: center">
    									<td>Role</td>
    									<td class="project-actions ">
    										<a href="index.php?a=discord-zarządzanie&strona=3"><button type="button" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Wybierz</button></a>
    									</td>
    								</tr>
    								<tr style="text-align: center">
    									<td>Użytkownicy</td>
    									<td class="project-actions ">
    										<a href="index.php?a=discord-zarządzanie&strona=4"><button type="button" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Wybierz</button></a>
    									</td>
    								</tr>
    								<tr style="text-align: center">
    									<td>Bany</td>
    									<td class="project-actions ">
    										<a href="index.php?a=discord-zarządzanie&strona=5"><button type="button" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Wybierz</button></a>
    									</td>
    								</tr>
    								<tr style="text-align: center">
    									<td>Wysyłanie wiadomości</td>
    									<td class="project-actions ">
    										<a href="index.php?a=discord-zarządzanie&strona=6"><button type="button" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Wybierz</button></a>
    									</td>
    								</tr>
    							</tbody>
    						</table>
    					</div>
                    </div>
                </div>
            </div>

        <?php elseif($strona2):?>
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h3 class="m-0 font-weight-bold text-primary">Lista kanałów tekstowych</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <?php if(count($channels_text_filter) < 1):?>
                                    <div class="card-body">
                                        <b>Brak danych</b>
                                    </div>
                                <?php else: ?>
                                    <thead style="text-align: center">
            							<tr>
            								<th>ID</th>
            								<th>Nazwa</th>
            								<th>Opcje</th>
            							</tr>
            						</thead>
                                    <tbody style="text-align: center">
                                        <?php foreach($channels_text_filter as $item):?>
                                            <tr>
                								<th><?=$item['id']?></th>
                								<th><?=$item['name']?></th>
                								<th>Pokaż</th>
                							</tr>
                                        <?php endforeach;?>
                                    </tbody>
                                <?php endif; ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif($strona3):?>
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h3 class="m-0 font-weight-bold text-primary">Lista ról</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <?php if(count($roles_filter) < 1):?>
                                    <div class="card-body">
                                        <b>Brak danych</b>
                                    </div>
                                <?php else: ?>
                                    <thead style="text-align: center">
            							<tr>
            								<th>ID</th>
            								<th>Nazwa</th>
            								<th>Opcje</th>
            							</tr>
            						</thead>
                                    <tbody style="text-align: center">
                                        <?php foreach($roles_filter as $item):?>
                                            <tr>
                								<th><?=$item['id']?></th>
                								<th style="color: #<?=dechex($item['color']);?>; <?php if(dechex($item['color']) == 'ffffff'){ echo 'background-color: #000';} else { } ?>"><?=$item['name']?></th>
                								<th>Pokaż</th>
                							</tr>
                                        <?php endforeach;?>
                                    </tbody>
                                <?php endif; ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif($strona4):?>
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h3 class="m-0 font-weight-bold text-primary">Lista użytkowników</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <?php if(count($users_filter) < 1):?>
                                    <div class="card-body">
                                        <b>Brak danych</b>
                                    </div>
                                <?php else: ?>
                                    <thead style="text-align: center">
            							<tr>
            								<th>ID</th>
            								<th>Nazwa</th>
            								<th>Opcje</th>
            							</tr>
            						</thead>
                                    <tbody style="text-align: center">
                                        <?php foreach($users_filter as $item):?>
                                            <tr>
                								<th><?=$item['user']['id']?></th>
                								<th><?=$item['nick']?></th>
                								<th>Pokaż</th>
                							</tr>
                                        <?php endforeach;?>
                                    </tbody>
                                <?php endif; ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif($strona1):?>
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h3 class="m-0 font-weight-bold text-primary">Lista firmowych emoji</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <?php if(count($emoji) < 1):?>
                                    <div class="card-body">
                                        <b>Brak danych</b>
                                    </div>
                                <?php else: ?>
                                    <thead style="text-align: center">
            							<tr>
            								<th>ID</th>
            								<th>Nazwa</th>
                                            <th>Dodał</th>
            								<th>Opcje</th>
            							</tr>
            						</thead>
                                    <tbody style="text-align: center">
                                        <?php foreach($emoji as $item):?>
                                            <tr>
                								<th><?=$item['id']?></th>
                								<th><?=$item['name']?></th>
                                                <th><?=$item['user']['username'],'#',$item['user']['discriminator']?></th>
                								<th>Pokaż</th>
                							</tr>
                                        <?php endforeach;?>
                                    </tbody>
                                <?php endif; ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif($strona5):?>
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h3 class="m-0 font-weight-bold text-primary">Lista banów</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <?php if(count($bans) < 1):?>
                                    <div class="card-body">
                                        <b>Brak danych</b>
                                    </div>
                                <?php else: ?>
                                    <thead style="text-align: center">
            							<tr>
                                            <th>ID użytkownika</th>
                                            <th>Zbanowany</th>
                                            <th>Powód Bana</th>
            								<th>Opcje</th>
            							</tr>
            						</thead>
                                    <tbody style="text-align: center">
                                        <?php foreach($bans as $item):?>
                                            <tr>
                                                <th><?=$item['user']['id'];?></th>
                                                <th><?=$item['user']['username'],'#',$item['user']['discriminator']?></th>
                                                <th><?php if(empty($item['reason'])){ echo 'Brak podanego powodu';} else { echo $item['reason']; }?></th>
                								<th>Pokaż</th>
                							</tr>
                                        <?php endforeach;?>
                                    </tbody>
                                <?php endif; ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif($strona6):?>
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h3 class="m-0 font-weight-bold text-primary">Wysyłanie wiadomości</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        w budowie
                    </div>
                </div>
            </div>
        <?php endif;?>

    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->
