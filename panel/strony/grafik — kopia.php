<?php
	if($perm['oglądanie_grafiku'] == '0'){
		header('Location: index.php?a=home');
	}
	//$data=date("Y-m-d");
	
//	$elo=date('m', mktime(0, 0, 0, $day+2));
	//echo date("M-d-Y", mktime(0, 0, 0, 0, $day+2, 2021));
?>
<?php
$miesiac = date("m");
$dzien = date("d");
$rok = date("Y");
$dni = array('NIEDZIELA', 'PONIEDZIAŁEK', 'WTOREK', 'ŚRODA', 'CZWARTEK', 'PIĄTEK', 'SOBOTA');
//data unix
$date = mktime(0, 0, 0, $miesiac, $dzien, $rok);
$date1 = mktime(0, 0, 0, $miesiac, $dzien+1, $rok);
$date2 = mktime(0, 0, 0, $miesiac, $dzien+2, $rok);
$date3 = mktime(0, 0, 0, $miesiac, $dzien+3, $rok);
$date4 = mktime(0, 0, 0, $miesiac, $dzien+4, $rok);
$date5 = mktime(0, 0, 0, $miesiac, $dzien+5, $rok);
$date6 = mktime(0, 0, 0, $miesiac, $dzien+6, $rok);
$date7 = mktime(0, 0, 0, $miesiac, $dzien+7, $rok);
$date8 = mktime(0, 0, 0, $miesiac, $dzien+8, $rok);
$date9 = mktime(0, 0, 0, $miesiac, $dzien+9, $rok);
$date10 = mktime(0, 0, 0, $miesiac, $dzien+10, $rok);
$date11 = mktime(0, 0, 0, $miesiac, $dzien+11, $rok);
$date12 = mktime(0, 0, 0, $miesiac, $dzien+12, $rok);
$date13 = mktime(0, 0, 0, $miesiac, $dzien+13, $rok);

$test = strtotime("23 June 2017");
//dni tygodnia
$tydz = $dni[(date('w', $date))];
$tydz1 = $dni[(date('w', $date1))];
$tydz2 = $dni[(date('w', $date2))];
$tydz3 = $dni[(date('w', $date3))];
$tydz4 = $dni[(date('w', $date4))];
$tydz5 = $dni[(date('w', $date5))];
$tydz6 = $dni[(date('w', $date6))];
$tydz7 = $dni[(date('w', $date7))];
$tydz8 = $dni[(date('w', $date8))];
$tydz9 = $dni[(date('w', $date9))];
$tydz10 = $dni[(date('w', $date10))];
$tydz11 = $dni[(date('w', $date11))];
$tydz12 = $dni[(date('w', $date12))];
$tydz13 = $dni[(date('w', $date13))];

//data normalna
$dzis = date('d.m.Y',$date);
$jutro = date('d.m.Y',$date1);
$pojutrze = date('d.m.Y',$date2);
$za3dni = date('d.m.Y',$date3);
$za4dni = date('d.m.Y',$date4);
$za5dni = date('d.m.Y',$date5);
$za6dni = date('d.m.Y',$date6);
$za7dni = date('d.m.Y',$date7);
$za8dni = date('d.m.Y',$date8);
$za9dni = date('d.m.Y',$date9);
$za10dni = date('d.m.Y',$date10);
$za11dni = date('d.m.Y',$date11);
$za12dni = date('d.m.Y',$date12);
$za13dni = date('d.m.Y',$date13);

$daty = array($date, $date2);


	//$graf = call("SELECT * FROM grafik WHERE uid = ".$_SESSION['id']);
	$graf = row("SELECT * FROM grafik WHERE uid = ".$user['id']." AND data = ".$date);
	$graf1 = row("SELECT * FROM grafik WHERE uid = ".$user['id']." AND data = ".$date1);
	$graf2 = row("SELECT * FROM grafik WHERE uid = ".$user['id']." AND data = ".$date2);
	$graf3 = row("SELECT * FROM grafik WHERE uid = ".$user['id']." AND data = ".$date3);
	$graf4 = row("SELECT * FROM grafik WHERE uid = ".$user['id']." AND data = ".$date4);
	$graf5 = row("SELECT * FROM grafik WHERE uid = ".$user['id']." AND data = ".$date5);
	$graf6 = row("SELECT * FROM grafik WHERE uid = ".$user['id']." AND data = ".$date6);
	
	
	if(!empty($graf['pojazd'])){
		$poj = row("SELECT * FROM tabor WHERE id = ".$graf['pojazd']);
		
	}
	if(!empty($graf1['pojazd'])){
		$poj1 = row("SELECT * FROM tabor WHERE id = ".$graf1['pojazd']);
		$wózukryty1 = '1';
	}
	if(!empty($graf2['pojazd'])){
		$poj2 = row("SELECT * FROM tabor WHERE id = ".$graf2['pojazd']);
		$wózukryty2 = '1';
	}
	if(!empty($graf3['pojazd'])){
		$poj3 = row("SELECT * FROM tabor WHERE id = ".$graf3['pojazd']);
		$wózukryty3 = '1';
	}
	if(!empty($graf4['pojazd'])){
		$poj4 = row("SELECT * FROM tabor WHERE id = ".$graf4['pojazd']);
		$wózukryty4 = '1';
	}
	if(!empty($graf5['pojazd'])){
		$poj5 = row("SELECT * FROM tabor WHERE id = ".$graf5['pojazd']);
		$wózukryty5 = '1';
	}
	if(!empty($graf6['pojazd'])){
		$poj6 = row("SELECT * FROM tabor WHERE id = ".$graf6['pojazd']);
		$wózukryty6 = '1';
	}
	
	

	$etat = row("SELECT * FROM etaty WHERE uid = ".$user['id']);
	//poniedzialek
	if($tydz == 'PONIEDZIAŁEK'){
		if($etat['poniedzialek'] == "1"){
			$wpis = '<small>Kurs Grafikowy</small>'; 
		} else {
			$wpis = '<small>Wolne Grafikowe</small>';
		}
	}elseif($tydz1 == 'PONIEDZIAŁEK'){
		if($etat['poniedzialek'] == "1"){
			$wpis1 = '<small>Kurs Grafikowy</small>'; 
		} else {
			$wpis1 = '<small>Wolne Grafikowe</small>';
		}
	}elseif($tydz2 == 'PONIEDZIAŁEK'){
		if($etat['poniedzialek'] == "1"){
			$wpis2 = '<small>Kurs Grafikowy</small>'; 
		} else {
			$wpis2 = '<small>Wolne Grafikowe</small>';
		}
	}elseif($tydz3 == 'PONIEDZIAŁEK'){
		if($etat['poniedzialek'] == "1"){
			$wpis3 = '<small>Kurs Grafikowy</small>'; 
		} else {
			$wpis3 = '<small>Wolne Grafikowe</small>';
		}
	}elseif($tydz4 == 'PONIEDZIAŁEK'){
		if($etat['poniedzialek'] == "1"){
			$wpis4 = '<small>Kurs Grafikowy</small>'; 
		} else {
			$wpis4 = '<small>Wolne Grafikowe</small>';
		}
	}elseif($tydz5 == 'PONIEDZIAŁEK'){
		if($etat['poniedzialek'] == "1"){
			$wpis5 = '<small>Kurs Grafikowy</small>'; 
		} else {
			$wpis5 = '<small>Wolne Grafikowe</small>';
		}
	}elseif($tydz6 == 'PONIEDZIAŁEK'){
		if($etat['poniedzialek'] == "1"){
			$wpis6 = '<small>Kurs Grafikowy</small>'; 
		} else {
			$wpis6 = '<small>Wolne Grafikowe</small>';
		}
	}elseif($tydz7 == 'PONIEDZIAŁEK'){
		if($etat['poniedzialek'] == "1"){
			$wpis7 = '<small>Kurs Grafikowy</small>'; 
		} else {
			$wpis7 = '<small>Wolne Grafikowe</small>';
		}
	}
	//wtorek
	if($tydz == 'WTOREK'){
		if($etat['wtorek'] == "1"){
			$wpis = '<small>Kurs Grafikowy</small>'; 
		} else {
			$wpis = '<small>Wolne Grafikowe</small>';
		}
	}
	if($tydz1 == 'WTOREK'){
		if($etat['wtorek'] == "1"){
			$wpis1 = '<small>Kurs Grafikowy</small>'; 
		} else {
			$wpis1 = '<small>Wolne Grafikowe</small>';
		}
	}
	if($tydz2 == 'WTOREK'){
		if($etat['wtorek'] == "1"){
			$wpis2 = '<small>Kurs Grafikowy</small>'; 
		} else {
			$wpis2 = '<small>Wolne Grafikowe</small>';
		}
	}
	if($tydz3 == 'WTOREK'){
		if($etat['wtorek'] == "1"){
			$wpis3 = '<small>Kurs Grafikowy</small>'; 
		} else {
			$wpis3 = '<small>Wolne Grafikowe</small>';
		}
	}
	if($tydz4 == 'WTOREK'){
		if($etat['wtorek'] == "1"){
			$wpis4 = '<small>Kurs Grafikowy</small>'; 
		} else {
			$wpis4 = '<small>Wolne Grafikowe</small>';
		}
	}
	if($tydz5 == 'WTOREK'){
		if($etat['wtorek'] == "1"){
			$wpis5 = '<small>Kurs Grafikowy</small>'; 
		} else {
			$wpis5 = '<small>Wolne Grafikowe</small>';
		}
	}
	if($tydz6 == 'WTOREK'){
		if($etat['wtorek'] == "1"){
			$wpis6 = '<small>Kurs Grafikowy</small>'; 
		} else {
			$wpis6 = '<small>Wolne Grafikowe</small>';
		}
	}
	if($tydz7 == 'WTOREK'){
		if($etat['wtorek'] == "1"){
			$wpis7 = '<small>Kurs Grafikowy</small>'; 
		} else {
			$wpis7 = '<small>Wolne Grafikowe</small>';
		}
	}
	//sroda
	if($tydz == 'ŚRODA'){
		if($etat['sroda'] == "1"){
			$wpis = '<small>Kurs Grafikowy</small>'; 
		} else {
			$wpis = '<small>Wolne Grafikowe</small>';
		}
	}if($tydz1 == 'ŚRODA'){
		if($etat['sroda'] == "1"){
			$wpis1 = '<small>Kurs Grafikowy</small>'; 
		} else {
			$wpis1 = '<small>Wolne Grafikowe</small>';
		}
	}if($tydz2 == 'ŚRODA'){
		if($etat['sroda'] == "1"){
			$wpis2 = '<small>Kurs Grafikowy</small>'; 
		} else {
			$wpis2 = '<small>Wolne Grafikowe</small>';
		}
	}if($tydz3 == 'ŚRODA'){
		if($etat['sroda'] == "1"){
			$wpis3 = '<small>Kurs Grafikowy</small>'; 
		} else {
			$wpis3 = '<small>Wolne Grafikowe</small>';
		}
	}if($tydz4 == 'ŚRODA'){
		if($etat['sroda'] == "1"){
			$wpis4 = '<small>Kurs Grafikowy</small>'; 
		} else {
			$wpis4 = '<small>Wolne Grafikowe</small>';
		}
	}if($tydz5 == 'ŚRODA'){
		if($etat['sroda'] == "1"){
			$wpis5 = '<small>Kurs Grafikowy</small>'; 
		} else {
			$wpis5 = '<small>Wolne Grafikowe</small>';
		}
	}if($tydz6 == 'ŚRODA'){
		if($etat['sroda'] == "1"){
			$wpis6 = '<small>Kurs Grafikowy</small>'; 
		} else {
			$wpis6 = '<small>Wolne Grafikowe</small>';
		}
	}if($tydz7 == 'ŚRODA'){
		if($etat['sroda'] == "1"){
			$wpis7 = '<small>Kurs Grafikowy</small>'; 
		} else {
			$wpis7 = '<small>Wolne Grafikowe</small>';
		}
	}
	//czwartek
	if($tydz == 'CZWARTEK'){
		if($etat['czwartek'] == "1"){
			$wpis = '<small>Kurs Grafikowy</small>'; 
		} else {
			$wpis = '<small>Wolne Grafikowe</small>';
		}
	}if($tydz1 == 'CZWARTEK'){
		if($etat['czwartek'] == "1"){
			$wpis1 = '<small>Kurs Grafikowy</small>'; 
		} else {
			$wpis1 = '<small>Wolne Grafikowe</small>';
		}
	}if($tydz2 == 'CZWARTEK'){
		if($etat['czwartek'] == "1"){
			$wpis2 = '<small>Kurs Grafikowy</small>'; 
		} else {
			$wpis2 = '<small>Wolne Grafikowe</small>';
		}
	}if($tydz3 == 'CZWARTEK'){
		if($etat['czwartek'] == "1"){
			$wpis3 = '<small>Kurs Grafikowy</small>'; 
		} else {
			$wpis3 = '<small>Wolne Grafikowe</small>';
		}
	}if($tydz4 == 'CZWARTEK'){
		if($etat['czwartek'] == "1"){
			$wpis4 = '<small>Kurs Grafikowy</small>'; 
		} else {
			$wpis4 = '<small>Wolne Grafikowe</small>';
		}
	}if($tydz5 == 'CZWARTEK'){
		if($etat['czwartek'] == "1"){
			$wpis5 = '<small>Kurs Grafikowy</small>'; 
		} else {
			$wpis5 = '<small>Wolne Grafikowe</small>';
		}
	}if($tydz6 == 'CZWARTEK'){
		if($etat['czwartek'] == "1"){
			$wpis6 = '<small>Kurs Grafikowy</small>'; 
		} else {
			$wpis6 = '<small>Wolne Grafikowe</small>';
		}
	}
	if($tydz7 == 'CZWARTEK'){
		if($etat['czwartek'] == "1"){
			$wpis7 = '<small>Kurs Grafikowy</small>'; 
		} else {
			$wpis7 = '<small>Wolne Grafikowe</small>';
		}
	}
	//piátek
	if($tydz == 'PIĄTEK'){
		if($etat['piatek'] == "1"){
			$wpis = '<small>Kurs Grafikowy</small>'; 
		} else {
			$wpis = '<small>Wolne Grafikowe</small>';
		}
	}if($tydz1 == 'PIĄTEK'){
		if($etat['piatek'] == "1"){
			$wpis1 = '<small>Kurs Grafikowy</small>'; 
		} else {
			$wpis1 = '<small>Wolne Grafikowe</small>';
		}
	}if($tydz2 == 'PIĄTEK'){
		if($etat['piatek'] == "1"){
			$wpis2 = '<small>Kurs Grafikowy</small>'; 
		} else {
			$wpis2 = '<small>Wolne Grafikowe</small>';
		}
	}if($tydz3 == 'PIĄTEK'){
		if($etat['piatek'] == "1"){
			$wpis3 = '<small>Kurs Grafikowy</small>'; 
		} else {
			$wpis3 = '<small>Wolne Grafikowe</small>';
		}
	}if($tydz4 == 'PIĄTEK'){
		if($etat['piatek'] == "1"){
			$wpis4 = '<small>Kurs Grafikowy</small>'; 
		} else {
			$wpis4 = '<small>Wolne Grafikowe</small>';
		}
	}if($tydz5 == 'PIĄTEK'){
		if($etat['piatek'] == "1"){
			$wpis5 = '<small>Kurs Grafikowy</small>'; 
		} else {
			$wpis5 = '<small>Wolne Grafikowe</small>';
		}
	}if($tydz6 == 'PIĄTEK'){
		if($etat['piatek'] == "1"){
			$wpis6 = '<small>Kurs Grafikowy</small>'; 
		} else {
			$wpis6 = '<small>Wolne Grafikowe</small>';
		}
	}
	if($tydz7 == 'PIĄTEK'){
		if($etat['piatek'] == "1"){
			$wpis7 = '<small>Kurs Grafikowy</small>'; 
		} else {
			$wpis7 = '<small>Wolne Grafikowe</small>';
		}
	}
	//sobota
	if($tydz == 'SOBOTA'){
		if($etat['sobota'] == "1"){
			$wpis = '<small>Kurs Grafikowy</small>'; 
		} else {
			$wpis = '<small>Wolne Grafikowe</small>';
		}
	}if($tydz1 == 'SOBOTA'){
		if($etat['sobota'] == "1"){
			$wpis1 = '<small>Kurs Grafikowy</small>'; 
		} else {
			$wpis1 = '<small>Wolne Grafikowe</small>';
		}
	}if($tydz2 == 'SOBOTA'){
		if($etat['sobota'] == "1"){
			$wpis2 = '<small>Kurs Grafikowy</small>'; 
		} else {
			$wpis2 = '<small>Wolne Grafikowe</small>';
		}
	}if($tydz3 == 'SOBOTA'){
		if($etat['sobota'] == "1"){
			$wpis3 = '<small>Kurs Grafikowy</small>'; 
		} else {
			$wpis3 = '<small>Wolne Grafikowe</small>';
		}
	}if($tydz4 == 'SOBOTA'){
		if($etat['sobota'] == "1"){
			$wpis4 = '<small>Kurs Grafikowy</small>'; 
		} else {
			$wpis4 = '<small>Wolne Grafikowe</small>';
		}
	}if($tydz5 == 'SOBOTA'){
		if($etat['sobota'] == "1"){
			$wpis5 = '<small>Kurs Grafikowy</small>'; 
		} else {
			$wpis5 = '<small>Wolne Grafikowe</small>';
		}
	}if($tydz6 == 'SOBOTA'){
		if($etat['sobota'] == "1"){
			$wpis6 = '<small>Kurs Grafikowy</small>'; 
		} else {
			$wpis6 = '<small>Wolne Grafikowe</small>';
		}
	}if($tydz7 == 'SOBOTA'){
		if($etat['sobota'] == "1"){
			$wpis7 = '<small>Kurs Grafikowy</small>'; 
		} else {
			$wpis7 = '<small>Wolne Grafikowe</small>';
		}
	}
	//niedziela
	if($tydz == 'NIEDZIELA'){
		if($etat['niedziela'] == "1"){
			$wpis = '<small>Kurs Grafikowy</small>'; 
		} else {
			$wpis = '<small>Wolne Grafikowe</small>';
		}
	}if($tydz1 == 'NIEDZIELA'){
		if($etat['niedziela'] == "1"){
			$wpis1 = '<small>Kurs Grafikowy</small>'; 
		} else {
			$wpis1 = '<small>Wolne Grafikowe</small>';
		}
	}if($tydz2 == 'NIEDZIELA'){
		if($etat['niedziela'] == "1"){
			$wpis2 = '<small>Kurs Grafikowy</small>'; 
		} else {
			$wpis2 = '<small>Wolne Grafikowe</small>';
		}
	}if($tydz3 == 'NIEDZIELA'){
		if($etat['niedziela'] == "1"){
			$wpis3 = '<small>Kurs Grafikowy</small>'; 
		} else {
			$wpis3 = '<small>Wolne Grafikowe</small>';
		}
	}if($tydz4 == 'NIEDZIELA'){
		if($etat['niedziela'] == "1"){
			$wpis4 = '<small>Kurs Grafikowy</small>'; 
		} else {
			$wpis4 = '<small>Wolne Grafikowe</small>';
		}
	}if($tydz5 == 'NIEDZIELA'){
		if($etat['niedziela'] == "1"){
			$wpis5 = '<small>Kurs Grafikowy</small>'; 
		} else {
			$wpis5 = '<small>Wolne Grafikowe</small>';
		}
	}if($tydz6 == 'NIEDZIELA'){
		if($etat['niedziela'] == "1"){
			$wpis6 = '<small>Kurs Grafikowy</small>'; 
		} else {
			$wpis6 = '<small>Wolne Grafikowe</small>';
		}
	}if($tydz7 == 'NIEDZIELA'){
		if($etat['niedziela'] == "1"){
			$wpis7 = '<small>Kurs Grafikowy</small>'; 
		} else {
			$wpis7 = '<small>Wolne Grafikowe</small>';
		}
	}
	
	if($graf['typ'] == "7") $wpis = "<small>Wolne Grafikowe</small>";
	elseif($graf['typ'] == "4") $wpis = '<b style="color: orange;">Urlop</b>';
	elseif($graf['typ'] == "2") $wpis = '<b>'.$graf['linia']. '/' .$graf['brygada']. '/' .$graf['zmiana'].'</b><br/><small>'.$graf['miejsce'].'</small><br/><b>'.$poj['marka']. ' ' .$poj['model']. ' #' .$poj['taborowy'].'</b><br/><small>Kurs Z Wolnego</small>';
	elseif($graf['typ'] == "3" || $graf['typ'] == "5" || $graf['typ'] == "8") $wpis = '<s><b>'.$graf['linia']. '/' .$graf['brygada']. '/' .$graf['zmiana'].'</b><br /><small>'.$graf['miejsce'].'</small><br/><b>'.$poj['marka']. ' ' .$poj['model']. ' #' .$poj['taborowy'].'</b><br/></s><small>Anulowany</small>';
	elseif($graf['typ'] == "6") $wpis = '<b>'.$graf['linia']. '/' .$graf['brygada']. '/' .$graf['zmiana'].'</b><br/>'.$graf['godzina_od']. ' - ' .$graf['godzina_do'].'<br/><small>'.$graf['miejsce'].'</small><br/><b>'.$poj['marka']. ' ' .$poj['model']. ' #' .$poj['taborowy'].'</b><br/><small>Rezerwa</small>';
	elseif($graf['typ'] == "1"){
		$wpis = '<b>'.$graf['linia']. '/' .$graf['brygada']. '/' .$graf['zmiana'].'</b><br/><small>'.$graf['miejsce'].'</small><br/><b>'.$poj['marka']. ' ' .$poj['model']. ' #' .$poj['taborowy'].'</b><br /><small>Kurs Grafikowy</small>';
	}

	if($graf1['typ'] == "7") $wpis1 = "<small>Wolne Grafikowe</small>";
	elseif($graf1['typ'] == "4") $wpis1 = '<b style="color: orange;">Urlop</b>';
	elseif($graf1['typ'] == "2") $wpis1 = '<b>'.$graf1['linia']. '/' .$graf1['brygada']. '/' .$graf1['zmiana'].'</b><br/><small>'.$graf1['miejsce'].'</small><br/><b>'.$poj1['marka']. ' ' .$poj1['model']. ' #' .$poj1['taborowy'].'</b><br/><small>Kurs Z Wolnego</small>';
	elseif($graf1['typ'] == "3" || $graf1['typ'] == "5" || $graf1['typ'] == "8") $wpis1 = '<s><b>'.$graf1['linia']. '/' .$graf1['brygada']. '/' .$graf1['zmiana'].'</b><br /><small>'.$graf1['miejsce'].'</small><br/><b>'.$poj1['marka']. ' ' .$poj1['model']. ' #' .$poj1['taborowy'].'</b><br/></s><small>Anulowany</small>';
	elseif($graf1['typ'] == "6") $wpis1 = '<b>'.$graf1['linia']. '/' .$graf1['brygada']. '/' .$graf1['zmiana'].'</b><br/>'.$graf1['godzina_od']. ' - ' .$graf1['godzina_do'].'<br/><small>'.$graf1['miejsce'].'</small><br/><b>'.$poj1['marka']. ' ' .$poj1['model']. ' #' .$poj1['taborowy'].'</b><br/><small>Rezerwa</small>';
	elseif($graf1['typ'] == "1"){
		if($wózukryty1 == "1"){
			$wpis1 = '<b>'.$graf1['linia']. '/' .$graf1['brygada']. '/' .$graf1['zmiana'].'</b><br/><small>'.$graf1['miejsce'].'</small><br /><small>Kurs Grafikowy</small>';
		}else{
			$wpis1 = '<b>'.$graf1['linia']. '/' .$graf1['brygada']. '/' .$graf1['zmiana'].'</b><br/><small>'.$graf1['miejsce'].'</small><br/><b>'.$poj1['marka']. ' ' .$poj1['model']. ' #' .$poj1['taborowy'].'</b><br /><small>Kurs Grafikowy</small>';
		}
	}

	if($graf2['typ'] == "7") $wpis2 = "<small>Wolne Grafikowe</small>";
	elseif($graf2['typ'] == "4") $wpis2 = '<b style="color: orange;">Urlop</b>';
	elseif($graf2['typ'] == "2") $wpis2 = '<b>'.$graf2['linia']. '/' .$graf2['brygada']. '/' .$graf2['zmiana'].'</b><br/><small>'.$graf2['miejsce'].'</small><br/><b>'.$poj2['marka']. ' ' .$poj2['model']. ' #' .$poj2['taborowy'].'</b><br/><small>Kurs Z Wolnego</small>';
	elseif($graf2['typ'] == "3" || $graf2['typ'] == "5" || $graf2['typ'] == "8") $wpis2 = '<s><b>'.$graf2['linia']. '/' .$graf2['brygada']. '/' .$graf2['zmiana'].'</b><br /><small>'.$graf2['miejsce'].'</small><br/><b>'.$poj2['marka']. ' ' .$poj2['model']. ' #' .$poj2['taborowy'].'</b><br/></s><small>Anulowany</small>';
	elseif($graf2['typ'] == "6") $wpis2 = '<b>'.$graf2['linia']. '/' .$graf2['brygada']. '/' .$graf2['zmiana'].'</b><br/>'.$graf2['godzina_od']. ' - ' .$graf2['godzina_do'].'<br/><small>'.$graf2['miejsce'].'</small><br/><b>'.$poj2['marka']. ' ' .$poj2['model']. ' #' .$poj2['taborowy'].'</b><br/><small>Rezerwa</small>';
	elseif($graf2['typ'] == "1"){
		if($wózukryty2 == "1"){
			$wpis2 = '<b>'.$graf2['linia']. '/' .$graf2['brygada']. '/' .$graf2['zmiana'].'</b><br/><small>'.$graf2['miejsce'].'</small><br /><small>Kurs Grafikowy</small>';
		}else{
			$wpis2 = '<b>'.$graf2['linia']. '/' .$graf2['brygada']. '/' .$graf2['zmiana'].'</b><br/><small>'.$graf2['miejsce'].'</small><br/><b>'.$poj2['marka']. ' ' .$poj2['model']. ' #' .$poj2['taborowy'].'</b><br /><small>Kurs Grafikowy</small>';
		}
		
	}

	if($graf3['typ'] == "7") $wpis3 = "<small>Wolne Grafikowe</small>";
	elseif($graf3['typ'] == "4") $wpis3 = '<b style="color: orange;">Urlop</b>';
	elseif($graf3['typ'] == "2") $wpis3 = '<b>'.$graf3['linia']. '/' .$graf3['brygada']. '/' .$graf3['zmiana'].'</b><br/><small>'.$graf3['miejsce'].'</small><br/><b>'.$poj3['marka']. ' ' .$poj3['model']. ' #' .$poj3['taborowy'].'</b><br/><small>Kurs Z Wolnego</small>';
	elseif($graf3['typ'] == "3" || $graf3['typ'] == "5" || $graf3['typ'] == "8") $wpis3 = '<s><b>'.$graf3['linia']. '/' .$graf3['brygada']. '/' .$graf3['zmiana'].'</b><br /><small>'.$graf3['miejsce'].'</small><br/><b>'.$poj3['marka']. ' ' .$poj3['model']. ' #' .$poj3['taborowy'].'</b><br/></s><small>Anulowany</small>';
	elseif($graf3['typ'] == "6") $wpis3 = '<b>'.$graf3['linia']. '/' .$graf3['brygada']. '/' .$graf3['zmiana'].'</b><br/>'.$graf3['godzina_od']. ' - ' .$graf3['godzina_do'].'<br/><small>'.$graf3['miejsce'].'</small><br/><b>'.$poj3['marka']. ' ' .$poj3['model']. ' #' .$poj3['taborowy'].'</b><br/><small>Rezerwa</small>';
	elseif($graf3['typ'] == "1"){
		if($wózukryty3 == "1"){
			$wpis3 = '<b>'.$graf3['linia']. '/' .$graf3['brygada']. '/' .$graf3['zmiana'].'</b><br/><small>'.$graf3['miejsce'].'</small><br /><small>Kurs Grafikowy</small>';
		}else{
			$wpis3 = '<b>'.$graf3['linia']. '/' .$graf3['brygada']. '/' .$graf3['zmiana'].'</b><br/><small>'.$graf3['miejsce'].'</small><br/><b>'.$poj3['marka']. ' ' .$poj3['model']. ' #' .$poj3['taborowy'].'</b><br /><small>Kurs Grafikowy</small>';
		}
		
	}

	if($graf4['typ'] == "7") $wpis4 = "<small>Wolne Grafikowe</small>";
	elseif($graf4['typ'] == "4") $wpis4 = '<b style="color: orange;">Urlop</b>';
	elseif($graf4['typ'] == "2") $wpis4 = '<b>'.$graf4['linia']. '/' .$graf4['brygada']. '/' .$graf4['zmiana'].'</b><br/><small>'.$graf4['miejsce'].'</small><br/><b>'.$poj4['marka']. ' ' .$poj4['model']. ' #' .$poj4['taborowy'].'</b><br/><small>Kurs Z Wolnego</small>';
	elseif($graf4['typ'] == "3" || $graf4['typ'] == "5" || $graf4['typ'] == "8") $wpis4 = '<s><b>'.$graf4['linia']. '/' .$graf4['brygada']. '/' .$graf4['zmiana'].'</b><br /><small>'.$graf4['miejsce'].'</small><br/><b>'.$poj4['marka']. ' ' .$poj4['model']. ' #' .$poj4['taborowy'].'</b><br/></s><small>Anulowany</small>';
	elseif($graf4['typ'] == "6") $wpis4 = '<b>'.$graf4['linia']. '/' .$graf4['brygada']. '/' .$graf4['zmiana'].'</b><br/>'.$graf4['godzina_od']. ' - ' .$graf4['godzina_do'].'<br/><small>'.$graf4['miejsce'].'</small><br/><b>'.$poj4['marka']. ' ' .$poj4['model']. ' #' .$poj4['taborowy'].'</b><br/><small>Rezerwa</small>';
	elseif($graf4['typ'] == "1"){
		if($wózukryty4 == "1"){
			$wpis4 = '<b>'.$graf4['linia']. '/' .$graf4['brygada']. '/' .$graf4['zmiana'].'</b><br/><small>'.$graf4['miejsce'].'</small><br /><small>Kurs Grafikowy</small>';
		}else{
			$wpis4 = '<b>'.$graf4['linia']. '/' .$graf4['brygada']. '/' .$graf4['zmiana'].'</b><br/><small>'.$graf4['miejsce'].'</small><br/><b>'.$poj4['marka']. ' ' .$poj4['model']. ' #' .$poj4['taborowy'].'</b><br /><small>Kurs Grafikowy</small>';
		}
		
	}

	if($graf5['typ'] == "7") $wpis5 = "<small>Wolne Grafikowe</small>";
	elseif($graf5['typ'] == "4") $wpis5 = '<b style="color: orange;">Urlop</b>';
	elseif($graf5['typ'] == "2") $wpis5 = '<b>'.$graf5['linia']. '/' .$graf5['brygada']. '/' .$graf5['zmiana'].'</b><br/><small>'.$graf5['miejsce'].'</small><br/><b>'.$poj5['marka']. ' ' .$poj5['model']. ' #' .$poj5['taborowy'].'</b><br/><small>Kurs Z Wolnego</small>';
	elseif($graf5['typ'] == "3" || $graf5['typ'] == "5" || $graf5['typ'] == "8") $wpis5 = '<s><b>'.$graf5['linia']. '/' .$graf5['brygada']. '/' .$graf5['zmiana'].'</b><br /><small>'.$graf5['miejsce'].'</small><br/><b>'.$poj5['marka']. ' ' .$poj5['model']. ' #' .$poj5['taborowy'].'</b><br/></s><small>Anulowany</small>';
	elseif($graf5['typ'] == "6") $wpis5 = '<b>'.$graf5['linia']. '/' .$graf5['brygada']. '/' .$graf5['zmiana'].'</b><br/>'.$graf5['godzina_od']. ' - ' .$graf5['godzina_do'].'<br/><small>'.$graf5['miejsce'].'</small><br/><b>'.$poj5['marka']. ' ' .$poj5['model']. ' #' .$poj5['taborowy'].'</b><br/><small>Rezerwa</small>';
	elseif($graf5['typ'] == "1"){
		if($wózukryty5 == "1"){
			$wpis5 = '<b>'.$graf5['linia']. '/' .$graf5['brygada']. '/' .$graf5['zmiana'].'</b><br/><small>'.$graf5['miejsce'].'</small><br /><small>Kurs Grafikowy</small>';
		}else{
			$wpis5 = '<b>'.$graf5['linia']. '/' .$graf5['brygada']. '/' .$graf5['zmiana'].'</b><br/><small>'.$graf5['miejsce'].'</small><br/><b>'.$poj5['marka']. ' ' .$poj5['model']. ' #' .$poj5['taborowy'].'</b><br /><small>Kurs Grafikowy</small>';
		}
		
	}

	if($graf6['typ'] == "7") $wpis6 = "<small>Wolne Grafikowe</small>";
	elseif($graf6['typ'] == "4") $wpis6 = '<b style="color: orange;">Urlop</b>';
	elseif($graf6['typ'] == "2") $wpis6 = '<b>'.$graf6['linia']. '/' .$graf6['brygada']. '/' .$graf6['zmiana'].'</b><br/><small>'.$graf6['miejsce'].'</small><br/><b>'.$poj6['marka']. ' ' .$poj6['model']. ' #' .$poj6['taborowy'].'</b><br/><small>Kurs Z Wolnego</small>';
	elseif($graf6['typ'] == "3" || $graf6['typ'] == "5" || $graf6['typ'] == "8") $wpis6 = '<s><b>'.$graf6['linia']. '/' .$graf6['brygada']. '/' .$graf6['zmiana'].'</b><br /><small>'.$graf6['miejsce'].'</small><br/><b>'.$poj6['marka']. ' ' .$poj6['model']. ' #' .$poj6['taborowy'].'</b><br/></s><small>Anulowany</small>';
	elseif($graf6['typ'] == "6") $wpis6 = '<b>'.$graf6['linia']. '/' .$graf6['brygada']. '/' .$graf6['zmiana'].'</b><br/>'.$graf6['godzina_od']. ' - ' .$graf6['godzina_do'].'<br/><small>'.$graf6['miejsce'].'</small><br/><b>'.$poj6['marka']. ' ' .$poj6['model']. ' #' .$poj6['taborowy'].'</b><br/><small>Rezerwa</small>';
	elseif($graf6['typ'] == "1"){
		if($wózukryty6 == "1"){
			$wpis6 = '<b>'.$graf6['linia']. '/' .$graf6['brygada']. '/' .$graf6['zmiana'].'</b><br/><small>'.$graf6['miejsce'].'</small><br /><small>Kurs Grafikowy</small>';
		}else{
			$wpis6 = '<b>'.$graf6['linia']. '/' .$graf6['brygada']. '/' .$graf6['zmiana'].'</b><br/><small>'.$graf6['miejsce'].'</small><br/><b>'.$poj6['marka']. ' ' .$poj6['model']. ' #' .$poj6['taborowy'].'</b><br /><small>Kurs Grafikowy</small>';
		}
		
	}
?>
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Grafik</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="index.php?a=home">Panel Kierowcy</a></li>
						<li class="breadcrumb-item active">Grafik</li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>


	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<?php
				if($user['stanowisko'] == 'Zarząd') echo 
				'<div class="row">
					<div class="col-md-12">
						<div class="card card-navy">
							<div class="card-body">
								
								<a href="index.php?a=zarzadzaj"><button class="btn btn-primary">Masz uprawnienia do Zarządzania Grafikiem!</button></a>
							</div>
							<!-- /.card-body -->
						</div>
						<!-- /.card -->
					</div>
					<!-- /.col -->
				</div>
				<!-- /.row -->';
			?>
			
			<div class="row">
				<div class="col-md-12">
					<div class="card shadow mb-4">
						<div class="card-body">
							<div class="tab-content">
								<div class="tab-pane active" id="tab_1">
									<div id="prywatny" class="col-md-12 text-center">
										Dzisiaj jest
										<p><?=$dzis, ' ', $tydz;?></p>
										
								
										<div class="table-responsive text-center">
											<table id="tabela" class="table table-bordered" style="width: 100%;">
												<thead>	
													<th scope="col"><?=$dzis;?><BR /><?=$tydz;?></th>
													<th scope="col"><?=$jutro;?><BR /><?=$tydz1;?></th>
													<th scope="col"><?=$pojutrze;?><BR /><?=$tydz2;?></th>
													<th scope="col"><?=$za3dni;?><BR /><?=$tydz3;?></th>
													<th scope="col"><?=$za4dni;?><BR /><?=$tydz4;?></th>
													<th scope="col"><?=$za5dni;?><BR /><?=$tydz5;?></th>
													<th scope="col"><?=$za6dni;?><BR /><?=$tydz6;?></th>
												</thead>
												<tbody>
													<td scope="col" style="height: 250px; vertical-align: middle;"><?=$wpis;?></td>
													<td scope="col" style="height: 250px; vertical-align: middle;"><?=$wpis1;?></td>
													<td scope="col" style="height: 250px; vertical-align: middle;"><?=$wpis2;?></td>
													<td scope="col" style="height: 250px; vertical-align: middle;"><?=$wpis3;?></td>
													<td scope="col" style="height: 250px; vertical-align: middle;"><?=$wpis4;?></td>
													<td scope="col" style="height: 250px; vertical-align: middle;"><?=$wpis5;?></td>
													<td scope="col" style="height: 250px; vertical-align: middle;"><?=$wpis6;?></td>
												</tbody>	
												
											</table>
										
										</div>
									</div>
								</div>
								<!-- /.tab-pane -->
								<div class="tab-pane" id="tab_2">

									<div id="tresc" class="col-md-12 text-center" style="display: none;">
									</div>
									<div id="tresc2" class="col-md-12 text-center" style="display: none;">
									</div>
								</div>
								<!-- /.tab-pane -->
							</div>
						</div>
					  <!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
			</div>
			<!-- /.row -->
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->


	<link href='https://use.fontawesome.com/releases/v5.0.6/css/all.css' rel='stylesheet'>
	<link href='./dist/lib/main.css' rel='stylesheet' />
	<script src='./dist/lib/main.js'></script>
	<script src='./dist/js/theme-chooser.js'></script>

