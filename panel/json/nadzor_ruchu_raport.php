<?php
    session_start();
    require_once('../../config/connect.php'); // Połączenie z bazą danych
    //require_once('../../config/session.php'); // Pobranie pliku z funkcjami
    require_once('../../config/function.php'); // Pobranie pliku z funkcjami
    if(!empty($_POST)){
        //print_r($_POST);
        if(empty($_POST['id_raportu']) || !isset($_POST['id_raportu']) || $_POST['id_raportu'] == 'undefined'){
            $options['error'] = 1;
            $options['text'] = 'Błąd id raportu!';
        } elseif (empty($_POST['status1']) || !isset($_POST['status1']) || $_POST['status1'] == 'undefined') {
            $options['error'] = 1;
            $options['text'] = 'Błąd STATUS raportu!';
        } elseif (empty($_POST['status2']) || !isset($_POST['status2']) || $_POST['status2'] == 'undefined') {
            $options['error'] = 1;
            $options['text'] = 'Błąd STATUS raportu!';
        } else {
            if (!empty($_POST['status1']) && $_POST['status1'] == 'true') {
                if (empty($_POST['punkty']) || !isset($_POST['punkty']) || $_POST['punkty'] == 'undefined') {
                    $options['error'] = 1;
                    $options['text'] = 'Błąd brak punktów status1 raportu!';
                } elseif (empty($_POST['uwagi']) || !isset($_POST['uwagi']) || $_POST['uwagi'] == 'undefined') {
                    $options['error'] = 1;
                    $options['text'] = 'Błąd brak uwag status1 raportu!';
                } else {
                    $kilometry = vtxt($_POST['kilometry']);
                    $punkty = vtxt($_POST['punkty']);
                    $uwagi = vtxt($_POST['uwagi']);
                    $id_raportu = vtxt($_POST['id_raportu']);
                    $id_sprawdzajacy = vtxt($_POST['id_sprawdzajacy']);

                    $status1 = vtxt($_POST['status1']);

                    $status = 1;
                    $timestamp = date("H:i:s d.m.Y");
                    //header('Location: ../index.php');
                    //$query1 = call();//raport
                    $query = call("UPDATE raporty SET data_sprawdzenia = '".$timestamp."', sid = '".$id_sprawdzajacy."', kilometry = '".$kilometry."', punkty = '".$punkty."', uwagi_sprawdzajacy = '".$uwagi."', status2 = '".$status."' WHERE id = '".$id_raportu."'");
                    if($query){
                        $options['error'] = 0;
                        $options['success'] = 1;
                        $options['text'] = 'sukcess';
                    } else {
                        $options['error'] = 1;
                        $options['success'] = 0;
                        $options['text'] = 'error';
                    }
                }
            } elseif (!empty($_POST['status2']) && $_POST['status2'] == 'true') {
                if (empty($_POST['uwagi']) || !isset($_POST['uwagi']) || $_POST['uwagi'] == 'undefined') {
                    $options['error'] = 1;
                    $options['text'] = 'Błąd brak uwag status2 raportu!';
                } else {
                    $kilometry = vtxt($_POST['kilometry']);

                    $uwagi = vtxt($_POST['uwagi']);
                    $id_raportu = vtxt($_POST['id_raportu']);
                    $id_sprawdzajacy = vtxt($_POST['id_sprawdzajacy']);

                    $status2 = vtxt($_POST['status2']);
                    $status = 2;

                    $timestamp = date("H:i:s d.m.Y");
                    //header('Location: ../index.php');
                    //$query1 = call();//raport
                    $query = call("UPDATE raporty SET data_sprawdzenia = '".$timestamp."', sid = '".$id_sprawdzajacy."', kilometry = '".$kilometry."', uwagi_sprawdzajacy = '".$uwagi."', status2 = '".$status."' WHERE id = '".$id_raportu."'");
                    if($query){
                        $options['error'] = 0;
                        $options['success'] = 1;
                        $options['text'] = 'sukcess';
                    } else {
                        $options['error'] = 1;
                        $options['success'] = 0;
                        $options['text'] = 'error';
                    }
                }
            }
        }

        print_r(json_encode($options));
    } else {
        $_SESSION['danger'] = 'BRAK uprawnień!';
        header('Location: ../index.php');
    }

?>
