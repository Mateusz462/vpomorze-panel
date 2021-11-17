 <?php
    function raporty_dane($id){
        $dzis_data = date('d.m.Y');
        $xd1 = row("SELECT * FROM raporty WHERE id = ".$id);

        //informacje o sluzbie
        $sluzba = $xd1['linia']. '/'. $xd1['brygada']. '/'. $xd1['zmiana'];
        $dzien_sluzby = date('d.m.Y',$xd1['data_kursu']);

        //typ sluzby
        switch($xd1['typ_kursu']){
            case '1': $typ_sluzby = 'Kurs Grafikowy'; break; // Strona główna
            case '2': $typ_sluzby = 'Kurs z Wolnego'; break; // Strona główna
            case '5': $typ_sluzby = 'Anulowany'; break; // Strona główna
            case '6': $typ_sluzby = 'Rezerwa'; break; // Strona główna
        }

        //pojazd
        if(!empty($xd1['pojazd'])){
            $dane_pojazd = row("SELECT * FROM tabor WHERE id =".$xd1['pojazd']);
            if($dane_pojazd){
                $pojazd = $dane_pojazd['marka']. ' '. $dane_pojazd['model']. ' #'. $dane_pojazd['taborowy'];
            } else {
                $pojazd = 'pojazd usunięty!';
            }
        } else {
            $pojazd = 'brak danych!';
        }

        //kierowca
        if($xd1['uid'] != 0){
            $kierowca = row("SELECT * FROM users WHERE id =".$xd1['uid']);
            $kierowca_ranga = row("SELECT * FROM rangi WHERE id =".$kierowca['stanowisko']);
            $login_kierowcy = '<a href="index.php?a=profile&p='.$kierowca['id'].'" style="color: '.$kierowca_ranga['kolor'].'">['.$kierowca_ranga['kod_roli'].''.$kierowca['nr_sluzbowy'].'] '.$kierowca['login'].'</a>';
            $login_kierowcy_paste = '['.$kierowca_ranga['kod_roli'].''.$kierowca['nr_sluzbowy'].'] '.$kierowca['login'];
            //przewoznicy
            //kiedys
        } else {
            $login_kierowcy = 'brak danych!';
        }
        //dyspozytor
        if($xd1['did'] != 0){
            $dyspozytor = row("SELECT * FROM users WHERE id =".$xd1['did']);
            $dyspozytor_ranga = row("SELECT * FROM rangi WHERE id =".$dyspozytor['stanowisko']);
            $login_dyspozytor = '<a href="index.php?a=profile&p='.$dyspozytor['id'].'" style="color: '.$dyspozytor_ranga['kolor'].'">['.$dyspozytor_ranga['kod_roli'].''.$dyspozytor['nr_sluzbowy'].'] '.$dyspozytor['login'].'</a>';
        } else {
            $login_dyspozytor = 'brak danych!';
        }
        //spradzajacy / anuulujący
        if($xd1['sid'] != 0){
            $sprawdzajacy = row("SELECT * FROM users WHERE id =".$xd1['sid']);
            $sprawdzajacy_ranga = row("SELECT * FROM rangi WHERE id =".$sprawdzajacy['stanowisko']);
            $login_sprawdzajacy = '<a href="index.php?a=profile&p='.$sprawdzajacy['id'].'" style="color: '.$sprawdzajacy_ranga['kolor'].'">['.$sprawdzajacy_ranga['kod_roli'].''.$sprawdzajacy['nr_sluzbowy'].'] '.$sprawdzajacy['login'].'</a>';
        } else {
            $login_sprawdzajacy = 'brak danych!';
        }


        if(!empty($xd1['stanpierwszy']) && !empty($xd1['stanostatni'])){
            if(is_numeric($xd1['stanpierwszy']) && is_numeric($xd1['stanostatni'])){
                $suma_km = round(round($xd1['stanostatni'], 2) - round($xd1['stanpierwszy'], 2), 2);
            } else {
                $xd1['stanpierwszy'] = 0;
                $xd1['stanostatni'] = 0;
                $suma_km = 0;
            }
        } else {
            $xd1['stanpierwszy'] = 0;
            $xd1['stanostatni'] = 0;
            $suma_km = 0;
        }
        if(!empty($xd1['link1']) && !empty($xd1['stanostatni'])){
            $xd1['link1'] = $xd1['link1'];
            $xd1['link2'] = $xd1['link2'];
        } else {
            $xd1['link1'] = '../kursowki/brak_fotki.png';
            $xd1['link2'] = '../kursowki/brak_fotki.png';
        }

        if(!empty($xd1['uwagi_kierowca'])){
            $uwagi_kierowcy = $xd1['uwagi_kierowca'];
        } else {
            $uwagi_kierowcy = '';
        }
        if(!empty($xd1['uwagi_dyspozytor'])){
            $uwagi_dyspozytor = $xd1['uwagi_dyspozytor'];
        } else {
            $uwagi_dyspozytor = '';
        }
        if(!empty($xd1['uwagi_sprawdzajacy'])){
            $uwagi_sprawdzajacy = $xd1['uwagi_sprawdzajacy'];
        } else {
            $uwagi_sprawdzajacy = '';
        }

        if(!empty($xd1['statystyka'])){
        	$statystyka = '<a href="./dist/dokumenty/'.$xd1['statystyka'].'" target="_blank" class="btn btn-outline-success">Podsumowanie przejazdów</a>';
        } else {
        	$statystyka = '<a class="btn btn-outline-danger" disabled>Brak podsumowania przejazdów</a>';
        }


        if($xd1['data_oddania_raportu'] == '' || $xd1['data_oddania_raportu'] == 0){
            $data_oddania_raportu = 'brak danych!';
        } else {
            $data_oddania_raportu = $xd1['data_oddania_raportu'];
        }
        if($xd1['data_sprawdzenia'] == '' || $xd1['data_sprawdzenia'] == 0){
            $data_sprawdzenia = 'brak danych!';
        } else {
            $data_sprawdzenia = $xd1['data_sprawdzenia'];
        }



        $data_return = array(
            'dzis_data' => $dzis_data,
            'sluzba' => $sluzba,
            'dzien_sluzby' => $dzien_sluzby,
            'typ_sluzby' => $typ_sluzby,
            'login_kierowcy' => $login_kierowcy,
            'login_kierowcy_paste' => $login_kierowcy_paste,
            'login_dyspozytor' => $login_dyspozytor,
            'login_sprawdzajacy' => $login_sprawdzajacy,
            'pojazd' => $pojazd,
            'licznik1' => $xd1['stanpierwszy'],
            'licznik2' => $xd1['stanostatni'],
            'suma_km' => $suma_km,
            'link1' => $xd1['link1'],
            'link2' => $xd1['link2'],
            'uwagi_kierowcy' => $uwagi_kierowcy,
            'uwagi_dyspozytor' => $uwagi_dyspozytor,
            'uwagi_sprawdzajacy' => $uwagi_sprawdzajacy,
            'statystyka' => $statystyka,
            'data_sprawdzenia' => $data_sprawdzenia,
            'punkty' => $xd1['punkty'],
            'data_oddania_raportu' => $data_oddania_raportu
        );

        return $data_return;
    }


    function raporty_oczekuja_user($user){
        $do_data = mktime(0,0,0, date('m'), date('d'), date('Y'));
        $od_data = mktime(0,0,0, date('m'), date('d')-2, date('Y'));
        $targets = call("SELECT * FROM raporty WHERE uid = ".$user['id']." AND status = 0 AND typ_kursu != 5 AND data_kursu >= ".$od_data." AND data_kursu <= $do_data");
        if ($targets->num_rows == 0):
            $tabela = '<div class="card-body"><div class="alert alert-info"><b>brak danych</b></div></div>';
            return $tabela;
        else:
        $tabela = '<div class="card-body table-responsive p-0"><table class="table table-hover text-nowrap text-center">';
            $tabela .= '<thead >
                <tr >
                    <th>ID</th>
                    <th>Data</th>
                    <th>Służba</th>
                    <th>Pojazd</th>
                    <th>Status</th>
                    <th>Opcje</th>
                </tr>
            </thead>
            <tbody >';
                $i = 1;
                while ($row = mysqli_fetch_array($targets)):
                    $poj = row("SELECT * FROM tabor WHERE id =".$row['pojazd']);
                    $dataczegos = date('d.m.Y',$row['data_kursu']);
                    $tabela .= '<tr>
                        <td>'.$row['id'].'</td>
                        <td>'.$dataczegos.'</td>
                        <td>'.$row['linia']. '/'. $row['brygada']. '/'. $row['zmiana'].'</td>
                        <td>#'.$poj['taborowy'].'</td>
                        <td>';
                            if($row['status'] == 0){
                                $tabela .= '<b style="color: #cccc00">Oczekuje na złożenie</b>';
                            }
                        $tabela .= '</td>
                        <td class="project-actions ">
                            <a href="index.php?a=raporty&add='.$row['id'].'" class="btn btn-outline-info btn-sm"><i class="fas fa-pencil-alt"></i> Wybierz</a>
                        </td>
                    </tr>';
                endwhile;
            $tabela .= '</tbody>';
        $tabela .= '</table></div>';
        endif;
        return $tabela;
    }

    function raporty_zlozone_user($user){
        $targets = call("SELECT * FROM raporty WHERE uid = ".$user['id']." AND status = 1 AND status2 != 3");
        if ($targets->num_rows == 0):
            $tabela = '<div class="card-body"><div class="alert alert-info"><b>brak danych</b></div></div>';
            return $tabela;
        else:
        $tabela = '<div class="card-body table-responsive p-0"><table class="table table-hover text-nowrap text-center">';
            $tabela .= '<thead >
                <tr >
                    <th>ID</th>
                    <th>Data</th>
                    <th>Służba</th>
                    <th>Pojazd</th>
                    <th>Status</th>
                    <th>Opcje</th>
                </tr>
            </thead>
            <tbody >';
                $i = 1;
                while ($row = mysqli_fetch_array($targets)):
                    $poj = row("SELECT * FROM tabor WHERE id =".$row['pojazd']);
                    if(!$poj){
                        $poj = array('taborowy' => 'pojazd usunięty');
                    }
                    $dataczegos = date('d.m.Y',$row['data_kursu']);
                    $tabela .= '<tr>
                        <td>'.$row['id'].'</td>
                        <td>'.$dataczegos.'</td>
                        <td>'.$row['linia']. '/'. $row['brygada']. '/'. $row['zmiana'].'</td>
                        <td>#'.$poj['taborowy'].'</td>';
                        if($row['status2'] == 0){
                            $tabela .= '<td><b style="color: #cccc00">Oczekuje na sprawdzenie</b></td><td class="project-actions "><a href="index.php?a=raporty&view='.$row['id'].'" class="btn btn-outline-info btn-sm"><i class="fas fa-search"></i> Podgląd</a></td>';
                        } elseif($row['status2'] == 1){
                            $tabela .= '<td><b style="color: #009900">Zaliczony</b></td><td class="project-actions"><a href="index.php?a=raporty&view='.$row['id'].'" class="btn btn-outline-info btn-sm"><i class="fas fa-search"></i> Podgląd</a></td>';
                        } elseif($row['status2'] == 2){
                            $tabela .= '<td><b style="color: #ff0000">Niezaliczony</b></td><td class="project-actions"><a href="index.php?a=raporty&view='.$row['id'].'" class="btn btn-outline-info btn-sm"><i class="fas fa-search"></i> Podgląd</a></td>';
                        }
                    $tabela .= '</tr>';
                endwhile;
            $tabela .= '</tbody>';
        $tabela .= '</table></div>';
        endif;
        return $tabela;
    }

    function raporty_nie_zlozone_user($user){
        $targets = call("SELECT * FROM raporty WHERE uid = ".$user['id']." AND status2 = 3 OR uid = ".$user['id']." AND status2 = 4");
        if ($targets->num_rows == 0):
            $tabela = '<div class="card-body"><div class="alert alert-info"><b>brak danych</b></div></div>';
            return $tabela;
        else:
        $tabela = '<div class="card-body table-responsive p-0"><table class="table table-hover text-nowrap text-center">';
            $tabela .= '<thead >
                <tr >
                    <th>ID</th>
                    <th>Data</th>
                    <th>Służba</th>
                    <th>Pojazd</th>
                    <th>Status</th>
                    <th>Opcje</th>
                </tr>
            </thead>
            <tbody >';
                $i = 1;
                while ($row = mysqli_fetch_array($targets)):
                    $poj = row("SELECT * FROM tabor WHERE id =".$row['pojazd']);
                    if(!$poj){
                        $poj = array('taborowy' => 'pojazd usunięty');
                    }
                    $dataczegos = date('d.m.Y',$row['data_kursu']);
                    $tabela .= '<tr>
                        <td>'.$row['id'].'</td>
                        <td>'.$dataczegos.'</td>
                        <td>'.$row['linia']. '/'. $row['brygada']. '/'. $row['zmiana'].'</td>
                        <td>#'.$poj['taborowy'].'</td>';
                        if($row['status2'] == 3){
                            $tabela .= '<td><b style="color: #ff0000">Niezłożony</b></td><td class="project-actions"><a href="index.php?a=raporty&view='.$row['id'].'" class="btn btn-outline-info btn-sm"><i class="fas fa-search"></i> Podgląd</a></td>';
                        } elseif($row['status2'] == 4){
                            $tabela .= '<td><b style="color: #9113B0">Anulowany</b></td><td class="project-actions"><a href="index.php?a=raporty&view='.$row['id'].'" class="btn btn-outline-info btn-sm"><i class="fas fa-search"></i> Podgląd</a></td>';
                        }
                    $tabela .= '</tr>';
                endwhile;
            $tabela .= '</tbody>';
        $tabela .= '</table></div>';
        endif;
        return $tabela;
    }

    function raport_user_zloz($id_raportu, $av, $pierwszy, $ostatni, $stanpierwszy, $stanostatni, $uwagi){
        $dzis_data = date('H:i:s d.m.Y');

        $stanpierwszy = round($stanpierwszy, 2);
        $stanostatni = round($stanostatni, 2);
        //$timestamp = date("Y-m-d H:i:s");

        $type = $av['type'];
        $size = $av['size'];

        $pname = ($id_raportu. '-' .$av['name']);
        $tname = $av['tmp_name'];
        $uploads_dir = './dist/dokumenty';
        if ($type != 'text/plain'){
			throwInfo('danger', 'Wrzucany plik musi mieć rozszerzenie .txt', true);
        }elseif ($size > 50000){
            throwInfo('danger', 'Wrzucany plik musi ważyć mniej niż 50kB!', true);
            header('Refresh: 1');
        }elseif (!is_uploaded_file($tname)){
            throwInfo('danger', 'Wystąpił błąd podczas wysyłania pliku!', true);
            header('Refresh: 1');
        }elseif (!move_uploaded_file($tname, $uploads_dir.'/'.$pname)){
            throwInfo('danger', 'Wystąpił błąd podczas przenoszenia pliku!', true);
            header('Refresh: 1');
        }else {
            //echo $id_raportu, ' ', $pierwszy, ' ', $ostatni, ' ', $stanpierwszy, ' ', $stanostatni, ' ', $uwagi, ' ', $pname, ' ';
            $elo = call("UPDATE raporty SET data_oddania_raportu = '".$dzis_data."', uwagi_kierowca = '".$uwagi."', link1 = '".$pierwszy."', link2 = '".$ostatni."', stanpierwszy = '".$stanpierwszy."', stanostatni = '".$stanostatni."', statystyka = '".$pname."', status = 1 WHERE id = '".$id_raportu."'");
            if($elo){
                throwInfo('success', 'Złożono Raport!', true);
                header('Refresh: 1');
                //return $dane;
            } else {
                throwInfo('danger', 'BŁĄD Skontaktuj się z programistą!', true);
                header('Location: index.php?a=raporty&error');
            }
        }

	}

    function raporty_zlozone_zarzad($user){
        $targets = call("SELECT * FROM raporty WHERE uid = ".$user['id']." AND status = 1 AND status2 != 3");
        if ($targets->num_rows == 0):
            $tabela = '<div class="card-body"><div class="alert alert-info"><b>brak danych</b></div></div>';
            return $tabela;
        else:
        $tabela = '<div class="card-body table-responsive p-0"><table class="table table-hover text-nowrap text-center">';
            $tabela .= '<thead >
                <tr >
                    <th>ID</th>
                    <th>Data</th>
                    <th>Służba</th>
                    <th>Pojazd</th>
                    <th>Status</th>
                    <th>Opcje</th>
                </tr>
            </thead>
            <tbody >';
                $i = 1;
                while ($row = mysqli_fetch_array($targets)):
                    $poj = row("SELECT * FROM tabor WHERE id =".$row['pojazd']);
                    if(!$poj){
                        $poj = array('taborowy' => 'pojazd usunięty');
                    }
                    $dataczegos = date('d.m.Y',$row['data_kursu']);
                    $tabela .= '<tr>
                        <td>'.$row['id'].'</td>
                        <td>'.$dataczegos.'</td>
                        <td>'.$row['linia']. '/'. $row['brygada']. '/'. $row['zmiana'].'</td>
                        <td>#'.$poj['taborowy'].'</td>';
                        if($row['status2'] == 0){
                            $tabela .= '<td><b style="color: #cccc00">Oczekuje na sprawdzenie</b></td><td class="project-actions "><a href="index.php?a=raporty-użytkownicy&view='.$row['id'].'" class="btn btn-outline-info btn-sm"><i class="fas fa-search"></i> Podgląd</a></td>';
                        } elseif($row['status2'] == 1){
                            $tabela .= '<td><b style="color: #009900">Zaliczony</b></td><td class="project-actions"><a href="index.php?a=raporty-użytkownicy&view='.$row['id'].'" class="btn btn-outline-info btn-sm"><i class="fas fa-search"></i> Podgląd</a></td>';
                        } elseif($row['status2'] == 2){
                            $tabela .= '<td><b style="color: #ff0000">Niezaliczony</b></td><td class="project-actions"><a href="index.php?a=raporty-użytkownicy&view='.$row['id'].'" class="btn btn-outline-info btn-sm"><i class="fas fa-search"></i> Podgląd</a> <button type="button" class="btn btn-outline-success btn-sm"><i class="fas fa-sync-alt"></i> Reset</button></td>';
                        }
                    $tabela .= '</tr>';
                endwhile;
            $tabela .= '</tbody>';
        $tabela .= '</table></div>';
        endif;
        return $tabela;
    }

    function raporty_nie_zlozone_zarzad($user){
        $targets = call("SELECT * FROM raporty WHERE uid = ".$user['id']." AND status2 = 3 AND uid = ".$user['id']." AND status2 = 4");
        if ($targets->num_rows == 0):
            $tabela = '<div class="card-body"><div class="alert alert-info"><b>brak danych</b></div></div>';
            return $tabela;
        else:
        $tabela = '<div class="card-body table-responsive p-0"><table class="table table-hover text-nowrap text-center">';
            $tabela .= '<thead >
                <tr >
                    <th>ID</th>
                    <th>Data</th>
                    <th>Służba</th>
                    <th>Pojazd</th>
                    <th>Status</th>
                    <th>Opcje</th>
                </tr>
            </thead>
            <tbody >';
                $i = 1;
                while ($row = mysqli_fetch_array($targets)):
                    $poj = row("SELECT * FROM tabor WHERE id =".$row['pojazd']);
                    if(!$poj){
                        $poj = array('taborowy' => 'pojazd usunięty');
                    }
                    $dataczegos = date('d.m.Y',$row['data_kursu']);
                    $tabela .= '<tr>
                        <td>'.$row['id'].'</td>
                        <td>'.$dataczegos.'</td>
                        <td>'.$row['linia']. '/'. $row['brygada']. '/'. $row['zmiana'].'</td>
                        <td>#'.$poj['taborowy'].'</td>';
                        if($row['status2'] == 4){
                            $tabela .= '<td><b style="color: #9113B0">Anulowany</b></td><td class="project-actions"><a href="index.php?a=raporty-użytkownicy&view='.$row['id'].'" class="btn btn-outline-info btn-sm"><i class="fas fa-search"></i> Podgląd</a></td>';
                        } elseif($row['status2'] == 3){
                            $tabela .= '<td><b style="color: #ff0000">Niezłożony</b></td><td class="project-actions"><a href="index.php?a=raporty-użytkownicy&view='.$row['id'].'" class="btn btn-outline-info btn-sm"><i class="fas fa-search"></i> Podgląd</a> <button id="btn-raport-reset-'.$row['id'].'" type="button" class="btn btn-outline-success btn-sm"><i class="fas fa-sync-alt"></i> Reset</button></td>';
                            $tabela .= "<script type='text/javascript'>
                            $(document).ready(function() {
                                $('#btn-raport-reset-".$row['id']."').on('click', function() {
                                    $('#modal-raport-reset-".$row['id']."').modal('show');
                                });
                            });
                            </script>";
                            modal_raporty_reset_zarzad($row['id']);
                        }



                    $tabela .= '</tr>';
                endwhile;
            $tabela .= '</tbody>';
        $tabela .= '</table></div>';
        endif;
        return $tabela;
    }

    function modal_raporty_reset_zarzad($id){
        $data = date('d.m.Y');
        $xd1 = row("SELECT * FROM raporty WHERE id = ".$id);
		if($xd1['status'] == 0 && $xd1['typ_kursu'] != 5){
			header('Location: index.php?a=raporty');
		}
        $us = row("SELECT * FROM users WHERE id = ".$xd1['uid']);
		$role_us = row("SELECT * FROM rangi WHERE id = ".$us['stanowisko']);
		$login_usera = '<a href="index.php?a=profile&p='.$us['id'].'" style="color: '.$role_us['kolor'].'">'.$us['login'].' ['.$role_us['kod_roli'].''.$us['nr_sluzbowy'].']'.'</a>';
        $sluzba = $xd1['linia']. '/'. $xd1['brygada']. '/'. $xd1['zmiana'];
        $dzien_sluzby = date('d.m.Y',$xd1['data_kursu']);
        $modal = '
		<div id="modal-raport-reset-'.$xd1['id'].'" class="modal fade" role="dialog">
			<div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<h2 class="modal-title">Zresetuj Raport służby '.$sluzba.' z dnia '.$dzien_sluzby.' <br>Użytkownika '.$login_usera.'</h2>
					</div>
					<form action="index.php?a=raporty-użytkownicy&uid='.$xd1['uid'].'&reset='.$xd1['id'].'" method="POST">
						<div class="modal-body">
                            <div class="form-group">
    							<label>Użytkownik</label>
    							<label class="form-control">'.$login_usera.'</label>

                                <label>Służba</label>
								<label class="form-control">'.$sluzba.'</label>

								<label>Data służby</label>
								<label class="form-control">'.$dzien_sluzby.'</label>
							</div>
                            <div class="form-group">
								<label>Data odrobienia służby</label>
								<input type="date" class="form-control" placeholder="Data odrobienia służby" name="data">
							</div>
							<div class="form-group">
								<label>Dodatkowe Informacje</label>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" disabled>
									<label class="form-check-label">Nieaktywne</label>
								</div>
							</div>
						</div>
						<div class="modal-footer justify-content-between">
							<button type="submit" class="btn btn-outline-danger" data-dismiss="modal">Zamknij</button>
							<button type="submit" class="btn btn-outline-primary">Zatwierdź</button>
						</div>
					</form>
				</div>
			</div>
		</div>';
		echo $modal;
    }


    function raporty_zarzad($typ){
        if($typ == 'do-ocenienia'){
            $targets = call("SELECT * FROM raporty WHERE status = 1 AND status2 = 0");
            if ($targets->num_rows == 0):
                $tabela = '<div class="card-body">';
                throwInfo('info', 'Brak Danych!', false);
                $tabela .= '</div>';
            else:
                $tabela = '<div class="card-body table-responsive"><table class="dataTable table table-bordered text-center">';
                $tabela .= '<thead >
                    <tr >
                        <th>ID</th>
                        <th>Użytkownik</th>
                        <th>Data</th>
                        <th>Służba</th>
                        <th>Pojazd</th>
                        <th>Status</th>
                        <th>Opcje</th>
                    </tr>
                </thead>
                <tbody >';
                $i = 1;
                while ($row = mysqli_fetch_array($targets)):
                    $dane = raporty_dane($row['id']);
                    $tabela .= '<tr>
                        <td>'.$row['id'].'</td>
                        <td>'.$dane['login_kierowcy'].'</td>
                        <td>'.$dane['dzien_sluzby'].'</td>
                        <td>'.$dane['sluzba'].'</td>
                        <td>#'.$dane['pojazd'].'</td>
                        <td>';
                        if($row['status2'] == 0){
                            $tabela .= '<b style="color: #cccc00">Oczekuje na sprawdzenie</b>';
                        }
                        $tabela .= '</td>
                        <td class="project-actions ">
                            <a href="index.php?a=zarzadzanie-raporty&action=sprawdz-raport&id='.$row['id'].'" class="btn btn-outline-info btn-sm"><i class="fas fa-pencil-alt"></i> Wybierz</a>
                        </td>
                    </tr>';
                endwhile;
                $tabela .= '</tbody>';
                $tabela .= '</table></div>';
            endif;
            return $tabela;
        } elseif ($typ == 'rozpatrzone') {
            $targets = call("SELECT * FROM raporty WHERE status = 1 AND status2 = 1 OR status2 = 2");
            if ($targets->num_rows == 0):
                $tabela = '<div class="card-body">';
                throwInfo('info', 'Brak Danych!', false);
                $tabela .= '</div>';
            else:
                $tabela = '<div class="card-body table-responsive"><table class="dataTable table table-bordered text-center">';
                $tabela .= '<thead >
                    <tr >
                        <th>ID</th>
                        <th>Użytkownik</th>
                        <th>Data</th>
                        <th>Służba</th>
                        <th>Pojazd</th>
                        <th>Status</th>
                        <th>Opcje</th>
                    </tr>
                </thead>
                <tbody >';
                $i = 1;
                while ($row = mysqli_fetch_array($targets)):
                    $dane = raporty_dane($row['id']);
                    $tabela .= '<tr>
                        <td>'.$row['id'].'</td>
                        <td>'.$dane['login_kierowcy'].'</td>
                        <td>'.$dane['dzien_sluzby'].'</td>
                        <td>'.$dane['sluzba'].'</td>
                        <td>#'.$dane['pojazd'].'</td>';
                        if($row['status2'] == 1){
                            $tabela .= '<td><b style="color: #009900">Zaliczony</b></td><td class="project-actions"><a href="index.php?a=zarzadzanie-raporty&action=podglad-raport&id='.$row['id'].'" class="btn btn-outline-info btn-sm"><i class="fas fa-search"></i> Podgląd</a></td>';
                        } elseif($row['status2'] == 2){
                            $tabela .= '<td><b style="color: #ff0000">Niezaliczony</b></td><td class="project-actions"><a href="index.php?a=zarzadzanie-raporty&action=podglad-raport&id='.$row['id'].'" class="btn btn-outline-info btn-sm"><i class="fas fa-search"></i> Podgląd</a></td>';
                        }
                    $tabela .= '</tr>';
                endwhile;
                $tabela .= '</tbody>';
                $tabela .= '</table></div>';
            endif;
            return $tabela;
        } elseif ($typ == 'niezlozone') {
            $targets = call("SELECT * FROM raporty WHERE status2 = 3");
            if ($targets->num_rows == 0):
                $tabela = '<div class="card-body">';
                throwInfo('info', 'Brak Danych!', false);
                $tabela .= '</div>';
            else:
                $tabela = '<div class="card-body table-responsive"><table class="dataTable table table-bordered text-center">';
                $tabela .= '<thead >
                    <tr >
                        <th>ID</th>
                        <th>Użytkownik</th>
                        <th>Data</th>
                        <th>Służba</th>
                        <th>Pojazd</th>
                        <th>Status</th>
                        <th>Opcje</th>
                    </tr>
                </thead>
                <tbody >';
                $i = 1;
                while ($row = mysqli_fetch_array($targets)):
                    $dane = raporty_dane($row['id']);
                    $tabela .= '<tr>
                    <td>'.$row['id'].'</td>
                        <td>'.$dane['login_kierowcy'].'</td>
                        <td>'.$dane['dzien_sluzby'].'</td>
                        <td>'.$dane['sluzba'].'</td>
                        <td>#'.$dane['pojazd'].'</td>';
                        if($row['status2'] == 3){
                            $tabela .= '<td><b style="color: #ff0000">Niezłożony</b></td><td class="project-actions"><a href="index.php?a=zarzadzanie-raporty&action=podglad-raport&id='.$row['id'].'" class="btn btn-outline-info btn-sm"><i class="fas fa-search"></i> Podgląd</a></td>';
                        }
                    $tabela .= '</tr>';
                endwhile;
                $tabela .= '</tbody>';
                $tabela .= '</table></div>';
            endif;
            return $tabela;
        } elseif ($typ == 'anulowane') {
            $targets = call("SELECT * FROM raporty WHERE status2 = 4");
            if ($targets->num_rows == 0):
                $tabela = '<div class="card-body">';
                throwInfo('info', 'Brak Danych!', false);
                $tabela .= '</div>';
            else:
                $tabela = '<div class="card-body table-responsive"><table class="dataTable table table-bordered text-center">';
                $tabela .= '<thead >
                    <tr >
                        <th>ID</th>
                        <th>Użytkownik</th>
                        <th>Data</th>
                        <th>Służba</th>
                        <th>Pojazd</th>
                        <th>Status</th>
                        <th>Opcje</th>
                    </tr>
                </thead>
                <tbody >';
                $i = 1;
                while ($row = mysqli_fetch_array($targets)):
                    $dane = raporty_dane($row['id']);
                    $tabela .= '<tr>
                        <td>'.$row['id'].'</td>
                        <td>'.$dane['login_kierowcy'].'</td>
                        <td>'.$dane['dzien_sluzby'].'</td>
                        <td>'.$dane['sluzba'].'</td>
                        <td>#'.$dane['pojazd'].'</td>';
                        if($row['status2'] == 4){
                            $tabela .= '<td><b style="color: #9113B0">Anulowany</b></td><td class="project-actions"><a href="index.php?a=zarzadzanie-raporty&action=podglad-raport&id='.$row['id'].'" class="btn btn-outline-info btn-sm"><i class="fas fa-search"></i> Podgląd</a></td>';
                        }
                    $tabela .= '</tr>';
                endwhile;
                $tabela .= '</tbody>';
                $tabela .= '</table></div>';
            endif;
            return $tabela;
        } elseif ($typ == 'do-zlozenia') {
            $targets = call("SELECT * FROM raporty WHERE status = 0 AND status2 != 3 AND status2 != 4");
            if ($targets->num_rows == 0):
                $tabela = '<div class="card-body">';
                throwInfo('info', 'Brak Danych!', false);
                $tabela .= '</div>';
            else:
                $tabela = '<div class="card-body table-responsive"><table class="dataTable table table-bordered text-center">';
                $tabela .= '<thead >
                    <tr >
                        <th>ID</th>
                        <th>Użytkownik</th>
                        <th>Data</th>
                        <th>Służba</th>
                        <th>Pojazd</th>
                        <th>Status</th>
                        <th>Opcje</th>
                    </tr>
                </thead>
                <tbody >';
                $i = 1;
                while ($row = mysqli_fetch_array($targets)):
                    $dane = raporty_dane($row['id']);
                    $tabela .= '<tr>
                        <td>'.$row['id'].'</td>
                        <td>'.$dane['login_kierowcy'].'</td>
                        <td>'.$dane['dzien_sluzby'].'</td>
                        <td>'.$dane['sluzba'].'</td>
                        <td>#'.$dane['pojazd'].'</td>';
                        if($row['status'] == 0){
                            $tabela .= '<td><b style="color: #137cb0">Do złożenia</b></td><td class="project-actions"><a href="index.php?a=zarzadzanie-raporty&action=podglad-raport&id='.$row['id'].'" class="btn btn-outline-info btn-sm"><i class="fas fa-search"></i> Podgląd</a></td>';
                        }
                    $tabela .= '</tr>';
                endwhile;
                $tabela .= '</tbody>';
                $tabela .= '</table></div>';
            endif;
            return $tabela;
        }
    }
?>
