<?php

    function wnioski_nazwy($id){
        $wnioski = row("SELECT * FROM wnioski_tabela WHERE id = $id");
        return $wnioski['nazwa'];
    }
    function wnioski_zlozone($user){
        $targets = call("SELECT * FROM wnioski WHERE uid = ".$user['id']);
        $tabela = '<table class="table table-hover text-nowrap text-center">';
            if ($targets->num_rows == 0):
                $tabela .= '<div class="card-body">';
                    throwInfo('info', 'Brak Danych!', false);
                $tabela .= '</div>';
            else:
            $tabela .= '<thead >
                <tr >
                    <th>Typ wniosku</th>
                    <th>Data złożenia</th>
                    <th>Status</th>
                    <th>Opcje</th>
                </tr>
            </thead>
            <tbody>';
                $i = 1;
                while ($row = mysqli_fetch_array($targets)):

                    $dataczegos = date('d.m.Y', $row['datawniosku']);
                    $tabela .= '<tr>
                        <td>'.wnioski_nazwy($row['typ']).'</td>
                        <td>'.$dataczegos.'</td>';
                        if($row['status'] == 0){
                            $tabela .= '<td><b style="color: #cccc00">Oczekuje na sprawdzenie</b></td><td class="project-actions"><a href="index.php?a=wnioski&view='.$row['id'].'"><button type="button" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Wybierz</button></a></td>';
                        } elseif($row['status'] == 1){
                            $tabela .= '<td><b style="color: #009900">Rozpatrzony Pozytywnie</b></td><td class="project-actions"><a href="index.php?a=wnioski&view='.$row['id'].'"><button type="button" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Wybierz</button></a></td>';
                        } elseif($row['status'] == 2){
                            $tabela .= '<td><b style="color: #ff0000">Rozpatrzony Negatywnie</b></td><td class="project-actions"><a href="index.php?a=wnioski&view='.$row['id'].'"><button type="button" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Wybierz</button></a></td>';
                        }
                    $tabela .= '</tr>';
                endwhile;
            $tabela .= '</tbody>';
        endif;
        $tabela .= '</table>';
        return $tabela;
    }


    function wnioski_send($danewnioski, $daneformularz){
        if($danewnioski['typ'] == 1){
            if (!empty($_POST)) {
                if(isset($_POST['button']) && empty($_POST['powod'])){
                    throwInfo('danger', 'Wypełnij wszystkie pola!', true);
                } else {
                    $powod = vtxt($_POST['powod']);
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

                    $suma = $pon + $wt + $sr + $czw + $pi + $sob + $ndz;
                    if($suma < '1') {
                        throwInfo('danger', 'Minimalny etat to 1/7', true);
                    } elseif($suma > '6') {
                        throwInfo('danger', 'Maksymalny etat to 6/7', true);
                    } else {
                        $date = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"));
                        $timestamp = date("Y-m-d H:i:s");
                        $query = call("INSERT INTO wnioski (uid, typ, pon, wt, sr, czw, pi, sob, niedz, powod, datawniosku) VALUES ('".$user['id']."', 1, '".$pon."', '".$wt."', '".$sr."', '".$czw."', '".$pi."', '".$sob."', '".$ndz."', '".$powod."', '".$date."')");
                        $log = call("INSERT INTO logi (uid, akcja) VALUES ('".$user['id']."', 'Użytkownik ".$user['login']." złożył wniosek o zmianę etatu!')");

                        if($query){
                            if($log){
                                $_SESSION['success'] = 'Poprawnie wysłano wniosek';
                                header('Location: index.php?a=wnioski');
                            }
                        } else {
                            $_SESSION['danger'] = 'Wystąpił błąd!';
                            header('Location: index.php?a=wnioski');
                        }
                    }
                }
            }
        }
    }

?>
