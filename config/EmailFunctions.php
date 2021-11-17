<?php
    function email_config($dataformularza, $userdata){
        $template_email = 'test.php';
        $email = file_get_contents($template_email, true);
        if($dataformularza['typ'] == 'zwolnienie-dyscyplinarne'){
            $tytul = 'Zostałeś zwolniony dyscyplinarne z Wirtualnego Pomorza!';
            $username = $userdata['login'];
            $text = 'Z przykrością pragniemy Cię poinformować, że twoja umowa o pracę w Wirtualnym Pomorzu została rozwiązana w trybie <b>dyscyplinarnym</b>.<br><br><b>Powód:</b> '.$dataformularza['powod'].'<br><br>Z poważaniem,<br>System vPomorze';
        } elseif($dataformularza['typ'] == 'zwolnienie-wniosek-pracownika'){
            $tytul = 'Zostałeś zwolniony z Wirtualnego Pomorza!';
            $username = $userdata['login'];
            $text = 'Z przykrością pragniemy Cię poinformować, że twoja umowa o pracę w Wirtualnym Pomorzu została rozwiązana.<br><br><b>Powód:</b> Zwolnienie na wniosek pracownika.<br><br>Dziękujemy za współpracę i pozdrawiamy.<br><br>Z poważaniem,<br>System vPomorze';
        } elseif($dataformularza['typ'] == 'nagana-pracownika'){
            $tytul = 'Dostałeś Naganę!';
            $username = $userdata['login'];
            $text = 'Z przykrością pragniemy Cię poinformować, że twoja umowa o pracę w Wirtualnym Pomorzu została rozwiązana.<br><br><b>Powód:</b> Zwolnienie na wniosek pracownika.<br><br>Dziękujemy za współpracę i pozdrawiamy.<br><br>Z poważaniem,<br>System vPomorze';
        }
        // elseif($data['status'] == 1) {
        //     $tytul = '1 etap rekrutacji do Wirtualnego Pomorza';
        //     $username = $data['login'];
        //     $powod = $data['powod'];
        //     $text = 'Przykro nam, ale nie udało ci się przejść pomyślnie Pierwszego etapu rekrutacji.<br><br><b>Powód:</b> '.$powod.'<br><br>Z poważaniem,<br>System vPomorze';
        // } elseif($data['status'] == 2){
        //     $tytul = '1 etap rekrutacji do Wirtualnego Pomorza';
        //     $username = $data['login'];
        //     $stanowisko = $data['stanowisko'];
        //     $login = $data['login'];
        //     $haslo = $pass;
        //     $text = 'Gratulacje przeszedłeś/aś pierwszy etap rekrutacji na stanowisko <b>'.$stanowisko.'</b>.<br>Drugi etap rekrutacji - rozmowa rekrutacyjna odbędzie się na naszym specjalnym discordzie.<br>Aby ukończyć ostatni etap musisz się zalogować do <a href="https://vpomorze.pl/panel/">panelu</a>.<br>Dane do logowania znajdują się poniżej<br><br><b>Login:</b><i> '.$login.'</i><br><b>Hasło:</b><i> '.$haslo.'</i><br><br><b>UWAGA!</b><br>Po zalogowaniu prosimy o zmianę hasła na własne! Możesz tego dokonać w ustawieniach profilu.<br><br>Z poważaniem,<br>System vPomorze';
        // }  elseif($data['status'] == 3){
        //     $tytul = '2 etap rekrutacji do Wirtualnego Pomorza';
        //     $username = $data['login'];
        //     $text = 'Przykro nam, ale nie udało ci się przejść pomyślnie rozmowy rekrutacyjnej.<br>Twoje konto w panelu zostaje <b>usunięte!</b><br>Jeżeli dalej chcesz być aplikować do Wirtualnego Pomorza złóż ponownie <a href="https://vpomorze.pl/index.php?a=zloz-wniosek">wniosek rekrutacyjny</a><br><br>Z poważaniem,<br>System vPomorze';
        // }  elseif($data['status'] == 4){
        //     $tytul = '2 etap rekrutacji do Wirtualnego Pomorza';
        //     $username = $data['login'];
        //     $stanowisko = $data['stanowisko'];
        //     $data = $data['data'];
        //     if($stanowisko == 'Praktykant - Kierowca'){
        //         $stanowisko = "Kierowca";
        //     } else {
        //         $stanowisko = "Motorniczy";
        //     }
        //     $text = 'Gratulujemy zostałeś/aś przyjęty/a do Wirtualnego Pomorza na stanowisko <b>'.$stanowisko.'</b><br>Pracę zaczynasz od <b>'.$data.'</b><br>Życzymy przyjemnej współpracy!<br><br>Z poważaniem,<br>System vPomorze';
        // }
        $variables = array(
            '{{tytul}}' => $tytul,
            '{{username}}' => $username,
            '{{tresc}}' => $text,
        );
        foreach($variables as $key => $value)
        $email = str_replace($key, $value, $email);
        //echo $email;
        return $email;
    }

    function email_wnioski_o_prace_config($id, $pass = false){
        $template_email = 'test.php';
        $email = file_get_contents($template_email, true);
        $data = row("SELECT * FROM aplikacje WHERE id = '".$id."'");
        if($data['status'] == 0){
            $tytul = 'Wysłano Wniosek o Pracę';
            $username = $data['login'];
            $text = 'Twój wniosek o pracę w Wirtualnym Pomorzu został wysłany i oczekuje na rozpatrzenie<br><br>Z poważaniem,<br>System vPomorze';
        } elseif($data['status'] == 1) {
            $tytul = '1 etap rekrutacji do Wirtualnego Pomorza';
            $username = $data['login'];
            $powod = $data['powod'];
            $text = 'Przykro nam, ale nie udało ci się przejść pomyślnie Pierwszego etapu rekrutacji.<br><br><b>Powód:</b> '.$powod.'<br><br>Z poważaniem,<br>System vPomorze';
        } elseif($data['status'] == 2){
            $tytul = '1 etap rekrutacji do Wirtualnego Pomorza';
            $username = $data['login'];
            $stanowisko = $data['stanowisko'];
            $login = $data['login'];
            $haslo = $pass;
            $text = 'Gratulacje przeszedłeś/aś pierwszy etap rekrutacji na stanowisko <b>'.$stanowisko.'</b>.<br>Drugi etap rekrutacji - rozmowa rekrutacyjna odbędzie się na naszym specjalnym discordzie.<br>Aby ukończyć ostatni etap musisz się zalogować do <a href="https://vpomorze.pl/panel/">panelu</a>.<br>Dane do logowania znajdują się poniżej<br><br><b>Login:</b><i> '.$login.'</i><br><b>Hasło:</b><i> '.$haslo.'</i><br><br><b>UWAGA!</b><br>Po zalogowaniu prosimy o zmianę hasła na własne! Możesz tego dokonać w ustawieniach profilu.<br><br>Z poważaniem,<br>System vPomorze';
        }  elseif($data['status'] == 3){
            $tytul = '2 etap rekrutacji do Wirtualnego Pomorza';
            $username = $data['login'];
            $text = 'Przykro nam, ale nie udało ci się przejść pomyślnie rozmowy rekrutacyjnej.<br>Twoje konto w panelu zostaje <b>usunięte!</b><br>Jeżeli dalej chcesz być aplikować do Wirtualnego Pomorza złóż ponownie <a href="https://wirtualne-pomorze.pl/index.php?a=zloz-wniosek">wniosek rekrutacyjny</a><br><br>Z poważaniem,<br>System vPomorze';
        }  elseif($data['status'] == 4){
            $tytul = '2 etap rekrutacji do Wirtualnego Pomorza';
            $username = $data['login'];
            $stanowisko = $data['stanowisko'];
            $data = $data['data'];
            if($stanowisko == 'Praktykant - Kierowca'){
                $stanowisko = "Kierowca";
            } else {
                $stanowisko = "Motorniczy";
            }
            $text = 'Gratulujemy zostałeś/aś przyjęty/a do Wirtualnego Pomorza na stanowisko <b>'.$stanowisko.'</b><br>Pracę zaczynasz od <b>'.$data.'</b><br>Życzymy przyjemnej współpracy!<br><br>Z poważaniem,<br>System vPomorze';
        }
        $variables = array(
            '{{tytul}}' => $tytul,
            '{{username}}' => $username,
            '{{tresc}}' => $text,
        );
        foreach($variables as $key => $value)
        $email = str_replace($key, $value, $email);
        //echo $email;
        return $email;
    }

    function email_send($email, $body){
        require("../PHPMailer/src/PHPMailer.php");
        require("../PHPMailer/src/SMTP.php");
        require("../PHPMailer/src/Exception.php");
        $mail = new PHPMailer\PHPMailer\PHPMailer();

        $mail->IsSMTP();
        $mail->CharSet="UTF-8";
        $mail->Host = "ssl0.ovh.net"; /* Zależne od hostingu poczty*/
        $mail->SMTPDebug = 0;
        $mail->Port = 587; /* Zależne od hostingu poczty, czasem 587 */
        $mail->SMTPSecure = true; /* Jeżeli ma być aktywne szyfrowanie SSL */
        $mail->SMTPAuth = true;
        $mail->SMTPAutoTLS = false;
        $mail->IsHTML(true);
        $mail->Username = "programista@wirtualne-pomorze.pl"; /* login do skrzynki email często adres*/
        $mail->Password = "Programista69"; /* Hasło do poczty */
        $mail->setFrom('panel@wirtualne-pomorze.pl', 'Powiadomienia Wirtualne Pomorze'); /* adres e-mail i nazwa nadawcy */
        $mail->AddAddress($email); /* adres lub adresy odbiorców */
        $mail->Subject = "Powiadomienie z panelu"; /* Tytuł wiadomości */
        $mail->Body = $body;
        //$mail->Send();
        if(!$mail->Send()){
            echo $_SESSION['danger'] = 'Błąd Przy wysyłaniu e-mail! Skontaktuj się z programistą!';
        } else{
            echo $_SESSION['success'] = 'Sukces!';
        }
    }

?>
