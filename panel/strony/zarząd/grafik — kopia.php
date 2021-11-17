<?php
	if($perm['zarzadzanie grafikiem'] == '0'){
		header('Location: index.php?a=home');
	}

	if(!isset($_GET['driver']) && !isset($_GET['add']) && !isset($_GET['edit']) && !isset($_GET['date'])){
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

		//data normalna
		$dzis = date('d.m.Y',$date);
		$jutro = date('d.m.Y',$date1);
		$pojutrze = date('d.m.Y',$date2);
		$za3dni = date('d.m.Y',$date3);
		$za4dni = date('d.m.Y',$date4);
		$za5dni = date('d.m.Y',$date5);
		$za6dni = date('d.m.Y',$date6);
		$za7dni = date('d.m.Y',$date7);
		
		$wybor = false;
		$widok = true;
		$dodawanie = false;
		$edytuj = false;
		
		$miesiac = date("m");
		$dzien = date("d");
		$rok = date("Y");
		$wczoraj = mktime(0, 0, 0, $miesiac, $dzien-1, $rok);

		$query = call("DELETE FROM grafik WHERE data = '".$wczoraj."'");
		if (!$query){
			throwInfo('info', 'Wystąpił błąd! Skontakuj się z programistą!', true);
		}else{
			throwInfo('info', 'Poprawnie Wczytano Grafik', true);
		}
	}elseif(isset($_GET['driver']) && !isset($_GET['add']) && !isset($_GET['edit']) && !isset($_GET['date'])){
		$id = vtxt($_GET['driver']);
		$wybor = true;
		$widok = false;
		$dodawanie = false;
		$edytuj = false;




		$miesiac = date("m");
		$dzien = date("d");
		$rok = date("Y");
		$dni = array('NIEDZIELA', 'PONIEDZIAŁEK', 'WTOREK', 'ŚRODA', 'CZWARTEK', 'PIĄTEK', 'SOBOTA');
		//data unix
		
		$date = mktime(0, 0, 0, $miesiac, $dzien, $rok);
		
		

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

		//data normalna
		$dzis = date('d.m.Y',$date);
		$jutro = date('d.m.Y',$date1);
		$pojutrze = date('d.m.Y',$date2);
		$za3dni = date('d.m.Y',$date3);
		$za4dni = date('d.m.Y',$date4);
		$za5dni = date('d.m.Y',$date5);
		$za6dni = date('d.m.Y',$date6);
		$za7dni = date('d.m.Y',$date7);


		$graf = row("SELECT * FROM grafik WHERE uid = ".$id." AND data = ".$date);
		$graf1 = row("SELECT * FROM grafik WHERE uid = ".$id." AND data = ".$date1);
		$graf2 = row("SELECT * FROM grafik WHERE uid = ".$id." AND data = ".$date2);
		$graf3 = row("SELECT * FROM grafik WHERE uid = ".$id." AND data = ".$date3);
		$graf4 = row("SELECT * FROM grafik WHERE uid = ".$id." AND data = ".$date4);
		$graf5 = row("SELECT * FROM grafik WHERE uid = ".$id." AND data = ".$date5);
		$graf6 = row("SELECT * FROM grafik WHERE uid = ".$id." AND data = ".$date6);
		$graf7 = row("SELECT * FROM grafik WHERE uid = ".$id." AND data = ".$date7);

		$etat = row("SELECT * FROM etaty WHERE uid = ".$id);
		$target = row("SELECT * FROM users WHERE id = ".$id);
		$role1 = row("SELECT * FROM rangi WHERE id = ".$target['stanowisko']);

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
			$wózukryty1 = '1';
		}

		//poniedzialek
		//poniedzialek
		if($tydz == 'PONIEDZIAŁEK'){
			if($etat['poniedzialek'] == "1"){
				$wpisk = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
			} else {
				$wpisk = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
			}
		}elseif($tydz1 == 'PONIEDZIAŁEK'){
			if($etat['poniedzialek'] == "1"){
				$wpisk1 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date1.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
			} else {
				$wpisk1 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date1.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
			}
		}elseif($tydz2 == 'PONIEDZIAŁEK'){
			if($etat['poniedzialek'] == "1"){
				$wpisk2 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date2.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
			} else {
				$wpisk2 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date2.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
			}
		}elseif($tydz3 == 'PONIEDZIAŁEK'){
			if($etat['poniedzialek'] == "1"){
				$wpisk3 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date3.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
			} else {
				$wpisk3 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date3.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
			}
		}elseif($tydz4 == 'PONIEDZIAŁEK'){
			if($etat['poniedzialek'] == "1"){
				$wpisk4 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date4.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
			} else {
				$wpisk4 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date4.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
			}
		}elseif($tydz5 == 'PONIEDZIAŁEK'){
			if($etat['poniedzialek'] == "1"){
				$wpisk5 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date5.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
			} else {
				$wpisk5 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date5.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
			}
		}elseif($tydz6 == 'PONIEDZIAŁEK'){
			if($etat['poniedzialek'] == "1"){
				$wpisk6 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date6.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
			} else {
				$wpisk6 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date6.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
			}
		}elseif($tydz7 == 'PONIEDZIAŁEK'){
			if($etat['poniedzialek'] == "1"){
				$wpisk7 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date7.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
			} else {
				$wpisk7 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date7.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
			}
		}
		//wtorek
		if($tydz == 'WTOREK'){
			if($etat['wtorek'] == "1"){
				$wpisk = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
			} else {
				$wpisk = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
			}
		}
		if($tydz1 == 'WTOREK'){
			if($etat['wtorek'] == "1"){
				$wpisk1 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date1.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
			} else {
				$wpisk1 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date1.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
			}
		}
		if($tydz2 == 'WTOREK'){
			if($etat['wtorek'] == "1"){
				$wpisk2 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date2.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
			} else {
				$wpisk2 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date2.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
			}
		}
		if($tydz3 == 'WTOREK'){
			if($etat['wtorek'] == "1"){
				$wpisk3 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date3.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
			} else {
				$wpisk3 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date3.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
			}
		}
		if($tydz4 == 'WTOREK'){
			if($etat['wtorek'] == "1"){
				$wpisk4 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date4.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
			} else {
				$wpisk4 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date4.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
			}
		}
		if($tydz5 == 'WTOREK'){
			if($etat['wtorek'] == "1"){
				$wpisk5 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date5.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
			} else {
				$wpisk5 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date5.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
			}
		}
		if($tydz6 == 'WTOREK'){
			if($etat['wtorek'] == "1"){
				$wpisk6 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date6.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
			} else {
				$wpisk6 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date6.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
			}
		}
		if($tydz7 == 'WTOREK'){
			if($etat['wtorek'] == "1"){
				$wpisk7 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date7.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
			} else {
				$wpisk7 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date7.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
			}
		}
		//sroda
		if($tydz == 'ŚRODA'){
			if($etat['sroda'] == "1"){
				$wpisk = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
			} else {
				$wpisk = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
			}
		}if($tydz1 == 'ŚRODA'){
			if($etat['sroda'] == "1"){
				$wpisk1 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date1.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
			} else {
				$wpisk1 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date1.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
			}
		}if($tydz2 == 'ŚRODA'){
			if($etat['sroda'] == "1"){
				$wpisk2 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date2.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
			} else {
				$wpisk2 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date2.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
			}
		}if($tydz3 == 'ŚRODA'){
			if($etat['sroda'] == "1"){
				$wpisk3 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date3.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
			} else {
				$wpisk3 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date3.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
			}
		}if($tydz4 == 'ŚRODA'){
			if($etat['sroda'] == "1"){
				$wpisk4 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date4.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
			} else {
				$wpisk4 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date4.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
			}
		}if($tydz5 == 'ŚRODA'){
			if($etat['sroda'] == "1"){
				$wpisk5 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date5.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
			} else {
				$wpisk5 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date5.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
			}
		}if($tydz6 == 'ŚRODA'){
			if($etat['sroda'] == "1"){
				$wpisk6 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date6.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
			} else {
				$wpisk6 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date6.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
			}
		}if($tydz7 == 'ŚRODA'){
			if($etat['sroda'] == "1"){
				$wpisk7 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date7.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
			} else {
				$wpisk7 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date7.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
			}
		}
		//czwartek
		if($tydz == 'CZWARTEK'){
			if($etat['czwartek'] == "1"){
				$wpisk = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
			} else {
				$wpisk = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
			}
		}if($tydz1 == 'CZWARTEK'){
			if($etat['czwartek'] == "1"){
				$wpisk1 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date1.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
			} else {
				$wpisk1 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date1.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
			}
		}if($tydz2 == 'CZWARTEK'){
			if($etat['czwartek'] == "1"){
				$wpisk2 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date2.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
			} else {
				$wpisk2 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date2.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
			}
		}if($tydz3 == 'CZWARTEK'){
			if($etat['czwartek'] == "1"){
				$wpisk3 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date3.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
			} else {
				$wpisk3 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date3.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
			}
		}if($tydz4 == 'CZWARTEK'){
			if($etat['czwartek'] == "1"){
				$wpisk4 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date4.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
			} else {
				$wpisk4 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date4.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
			}
		}if($tydz5 == 'CZWARTEK'){
			if($etat['czwartek'] == "1"){
				$wpisk5 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date5.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
			} else {
				$wpisk5 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date5.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
			}
		}if($tydz6 == 'CZWARTEK'){
			if($etat['czwartek'] == "1"){
				$wpisk6 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date6.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
			} else {
				$wpisk6 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date6.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
			}
		}
		if($tydz7 == 'CZWARTEK'){
			if($etat['czwartek'] == "1"){
				$wpisk7 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date7.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
			} else {
				$wpisk7 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date7.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
			}
		}
		//piátek
		if($tydz == 'PIĄTEK'){
			if($etat['piatek'] == "1"){
				$wpisk = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
			} else {
				$wpisk = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
			}
		}if($tydz1 == 'PIĄTEK'){
			if($etat['piatek'] == "1"){
				$wpisk1 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date1.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
			} else {
				$wpisk1 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date1.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
			}
		}if($tydz2 == 'PIĄTEK'){
			if($etat['piatek'] == "1"){
				$wpisk2 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date2.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
			} else {
				$wpisk2 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date2.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
			}
		}if($tydz3 == 'PIĄTEK'){
			if($etat['piatek'] == "1"){
				$wpisk3 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date3.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
			} else {
				$wpisk3 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date3.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
			}
		}if($tydz4 == 'PIĄTEK'){
			if($etat['piatek'] == "1"){
				$wpisk4 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date4.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
			} else {
				$wpisk4 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date4.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
			}
		}if($tydz5 == 'PIĄTEK'){
			if($etat['piatek'] == "1"){
				$wpisk5 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date5.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
			} else {
				$wpisk5 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date5.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
			}
		}if($tydz6 == 'PIĄTEK'){
			if($etat['piatek'] == "1"){
				$wpisk6 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date6.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
			} else {
				$wpisk6 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date6.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
			}
		}
		if($tydz7 == 'PIĄTEK'){
			if($etat['piatek'] == "1"){
				$wpisk7 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date7.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
			} else {
				$wpisk7 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date7.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
			}
		}
		//sobota
		if($tydz == 'SOBOTA'){
			if($etat['sobota'] == "1"){
				$wpisk = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
			} else {
				$wpisk = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
			}
		}if($tydz1 == 'SOBOTA'){
			if($etat['sobota'] == "1"){
				$wpisk1 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date1.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
			} else {
				$wpisk1 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date1.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
			}
		}if($tydz2 == 'SOBOTA'){
			if($etat['sobota'] == "1"){
				$wpisk2 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date2.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
			} else {
				$wpisk2 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date2.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
			}
		}if($tydz3 == 'SOBOTA'){
			if($etat['sobota'] == "1"){
				$wpisk3 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date3.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
			} else {
				$wpisk3 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date3.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
			}
		}if($tydz4 == 'SOBOTA'){
			if($etat['sobota'] == "1"){
				$wpisk4 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date4.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
			} else {
				$wpisk4 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date4.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
			}
		}if($tydz5 == 'SOBOTA'){
			if($etat['sobota'] == "1"){
				$wpisk5 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date5.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
			} else {
				$wpisk5 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date5.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
			}
		}if($tydz6 == 'SOBOTA'){
			if($etat['sobota'] == "1"){
				$wpisk6 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date6.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
			} else {
				$wpisk6 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date6.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
			}
		}if($tydz7 == 'SOBOTA'){
			if($etat['sobota'] == "1"){
				$wpisk7 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date7.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
			} else {
				$wpisk7 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date7.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
			}
		}
		//niedziela
		if($tydz == 'NIEDZIELA'){
			if($etat['niedziela'] == "1"){
				$wpisk = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
			} else {
				$wpisk = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
			}
		}if($tydz1 == 'NIEDZIELA'){
			if($etat['niedziela'] == "1"){
				$wpisk1 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date1.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
			} else {
				$wpisk1 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date1.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
			}
		}if($tydz2 == 'NIEDZIELA'){
			if($etat['niedziela'] == "1"){
				$wpisk2 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date2.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
			} else {
				$wpisk2 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date2.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
			}
		}if($tydz3 == 'NIEDZIELA'){
			if($etat['niedziela'] == "1"){
				$wpisk3 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date3.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
			} else {
				$wpisk3 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date3.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
			}
		}if($tydz4 == 'NIEDZIELA'){
			if($etat['niedziela'] == "1"){
				$wpisk4 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date4.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
			} else {
				$wpisk4 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date4.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
			}
		}if($tydz5 == 'NIEDZIELA'){
			if($etat['niedziela'] == "1"){
				$wpisk5 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date5.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
			} else {
				$wpisk5 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date5.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
			}
		}if($tydz6 == 'NIEDZIELA'){
			if($etat['niedziela'] == "1"){
				$wpisk6 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date6.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
			} else {
				$wpisk6 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date6.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
			}
		}if($tydz7 == 'NIEDZIELA'){
			if($etat['niedziela'] == "1"){
				$wpisk7 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date7.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
			} else {
				$wpisk7 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&add&date='.$date7.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
			}
		}

		if($graf['typ'] == "7") $wpisk = "<small>Wolne grafikowe</small>";
		elseif($graf['typ'] == "4") $wpisk = '<b style="color: orange;">Urlop</b>';
		elseif($graf['typ'] == "2") $wpisk = '<a href="index.php?a=dyspozytornia&driver='.$id.'&edit&date='.$date.'"><button type="button" class="btn btn-warning btn-lg"><b>'.$graf['linia']. '/' .$graf['brygada']. '/' .$graf['zmiana'].'</b><br/><small>'.$graf['miejsce'].'</small><br/><b>'.$poj['marka']. ' ' .$poj['model']. ' #' .$poj['taborowy'].'</b><br/><small>Kurs Z Wolnego</small></button></a>';
		elseif($graf['typ'] == "3" || $graf['typ'] == "5" || $graf['typ'] == "8") $wpisk = '<s><b>'.$graf['linia']. '/' .$graf['brygada']. '/' .$graf['zmiana'].'</b><br /><small>'.$graf['miejsce'].'</small><br/><b>'.$poj['marka']. ' ' .$poj['model']. ' #' .$poj['taborowy'].'</b><br/></s><small>Anulowany</small>';
		elseif($graf['typ'] == "6") $wpisk = '<a href="index.php?a=dyspozytornia&driver='.$id.'&edit&date='.$date.'"><button type="button" class="btn btn-info btn-lg"><b>'.$graf['linia']. '/' .$graf['brygada']. '/' .$graf['zmiana'].'</b><br/>'.$graf['godzina_od']. ' - ' .$graf['godzina_do'].'<br/><small>'.$graf['miejsce'].'</small><br/><b>'.$poj['marka']. ' ' .$poj['model']. ' #' .$poj['taborowy'].'</b><br/><small>Rezerwa</small></button></a>';
		elseif($graf['typ'] == "1"){
			$wpisk = '<a href="index.php?a=dyspozytornia&driver='.$id.'&edit&date='.$date.'"><button type="button" class="btn btn-primary btn-lg"><b>'.$graf['linia']. '/' .$graf['brygada']. '/' .$graf['zmiana'].'</b><br/><small>'.$graf['miejsce'].'</small><br/><b>'.$poj['marka']. ' ' .$poj['model']. ' #' .$poj['taborowy'].'</b><br /><small>Kurs Grafikowy</small></button></a>';
		}

		if($graf1['typ'] == "7") $wpisk1 = "<small>Wolne grafikowe</small>";
		elseif($graf1['typ'] == "4") $wpisk1 = '<b style="color: orange;">Urlop</b>';
		elseif($graf1['typ'] == "2") $wpisk1 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&edit&date='.$date1.'"><button type="button" class="btn btn-warning btn-lg"><b>'.$graf1['linia']. '/' .$graf1['brygada']. '/' .$graf1['zmiana'].'</b><br/><small>'.$graf1['miejsce'].'</small><br/><b>'.$poj1['marka']. ' ' .$poj1['model']. ' #' .$poj1['taborowy'].'</b><br/><small>Kurs Z Wolnego</small></button></a>';
		elseif($graf1['typ'] == "3" || $graf1['typ'] == "5" || $graf1['typ'] == "8") $wpisk1 = '<s><b>'.$graf1['linia']. '/' .$graf1['brygada']. '/' .$graf1['zmiana'].'</b><br /><small>'.$graf1['miejsce'].'</small><br/><b>'.$poj1['marka']. ' ' .$poj1['model']. ' #' .$poj1['taborowy'].'</b><br/></s><small>Anulowany</small>';
		elseif($graf1['typ'] == "6") $wpisk1 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&edit&date='.$date1.'"><button type="button" class="btn btn-info btn-lg"><b>'.$graf1['linia']. '/' .$graf1['brygada']. '/' .$graf1['zmiana'].'</b><br/>'.$graf1['godzina_od']. '-' .$graf1['godzina_do'].'<br/><small>'.$graf1['miejsce'].'</small><br/><b>'.$poj1['marka']. ' ' .$poj1['model']. ' #' .$poj1['taborowy'].'</b><br/><small>Rezerwa</small></button></a>';
		elseif($graf1['typ'] == "1"){
			$wpisk1 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&edit&date='.$date1.'"><button type="button" class="btn btn-primary btn-lg"><b>'.$graf1['linia']. '/' .$graf1['brygada']. '/' .$graf1['zmiana'].'</b><br/><small>'.$graf1['miejsce'].'</small><br/><b>'.$poj1['marka']. ' ' .$poj1['model']. ' #' .$poj1['taborowy'].'</b><br /><small>Kurs Grafikowy</small></button></a>';
		}

		if($graf2['typ'] == "7") $wpisk2 = "<small>Wolne grafikowe</small>";
		elseif($graf2['typ'] == "4") $wpisk2 = '<b style="color: orange;">Urlop</b>';
		elseif($graf2['typ'] == "2") $wpisk2 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&edit&date='.$date2.'"><button type="button" class="btn btn-warning btn-lg"><b>'.$graf2['linia']. '/' .$graf2['brygada']. '/' .$graf2['zmiana'].'</b><br/><small>'.$graf2['miejsce'].'</small><br/><b>'.$poj2['marka']. ' ' .$poj2['model']. ' #' .$poj2['taborowy'].'</b><br/><small>Kurs Z Wolnego</small></button></a>';
		elseif($graf2['typ'] == "3" || $graf2['typ'] == "5" || $graf2['typ'] == "8") $wpisk2 = '<s><b>'.$graf2['linia']. '/' .$graf2['brygada']. '/' .$graf2['zmiana'].'</b><br /><small>'.$graf2['miejsce'].'</small><br/><b>'.$poj2['marka']. ' ' .$poj2['model']. ' #' .$poj2['taborowy'].'</b><br/></s><small>Anulowany</small>';
		elseif($graf2['typ'] == "6") $wpisk2 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&edit&date='.$date2.'"><button type="button" class="btn btn-info btn-lg"><b>'.$graf2['linia']. '/' .$graf2['brygada']. '/' .$graf2['zmiana'].'</b><br/>'.$graf2['godzina_od']. '-' .$graf2['godzina_do'].'<br/><small>'.$graf2['miejsce'].'</small><br/><b>'.$poj2['marka']. ' ' .$poj2['model']. ' #' .$poj2['taborowy'].'</b><br/><small>Rezerwa</small></button></a>';
		elseif($graf2['typ'] == "1"){
			$wpisk2 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&edit&date='.$date2.'"><button type="button" class="btn btn-primary btn-lg"><b>'.$graf2['linia']. '/' .$graf2['brygada']. '/' .$graf2['zmiana'].'</b><br/><small>'.$graf2['miejsce'].'</small><br/><b>'.$poj2['marka']. ' ' .$poj2['model']. ' #' .$poj2['taborowy'].'</b><br /><small>Kurs Grafikowy</small></button></a>';
		}

		if($graf3['typ'] == "7") $wpisk3 = "<small>Wolne grafikowe</small>";
		elseif($graf3['typ'] == "4") $wpisk3 = '<b style="color: orange;">Urlop</b>';
		elseif($graf3['typ'] == "2") $wpisk3 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&edit&date='.$date3.'"><button type="button" class="btn btn-warning btn-lg"><b>'.$graf3['linia']. '/' .$graf3['brygada']. '/' .$graf3['zmiana'].'</b><br/><small>'.$graf3['miejsce'].'</small><br/><b>'.$poj3['marka']. ' ' .$poj3['model']. ' #' .$poj3['taborowy'].'</b><br/><small>Kurs Z Wolnego</small></button></a>';
		elseif($graf3['typ'] == "3" || $graf3['typ'] == "5" || $graf3['typ'] == "8") $wpisk3 = '<s><b>'.$graf3['linia']. '/' .$graf3['brygada']. '/' .$graf3['zmiana'].'</b><br /><small>'.$graf3['miejsce'].'</small><br/><b>'.$poj3['marka']. ' ' .$poj3['model']. ' #' .$poj3['taborowy'].'</b><br/></s><small>Anulowany</small>';
		elseif($graf3['typ'] == "6") $wpisk3 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&edit&date='.$date3.'"><button type="button" class="btn btn-info btn-lg"><b>'.$graf3['linia']. '/' .$graf3['brygada']. '/' .$graf3['zmiana'].'</b><br/>'.$graf3['godzina_od']. '-' .$graf3['godzina_do'].'<br/><small>'.$graf3['miejsce'].'</small><br/><b>'.$poj3['marka']. ' ' .$poj3['model']. ' #' .$poj3['taborowy'].'</b><br/><small>Rezerwa</small></button></a>';
		elseif($graf3['typ'] == "1"){
			$wpisk3 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&edit&date='.$date3.'"><button type="button" class="btn btn-primary btn-lg"><b>'.$graf3['linia']. '/' .$graf3['brygada']. '/' .$graf3['zmiana'].'</b><br/><small>'.$graf3['miejsce'].'</small><br/><b>'.$poj3['marka']. ' ' .$poj3['model']. ' #' .$poj3['taborowy'].'</b><br /><small>Kurs Grafikowy</small></button></a>';
		}

		if($graf4['typ'] == "7") $wpisk4 = "<small>Wolne grafikowe</small>";
		elseif($graf4['typ'] == "4") $wpisk4 = '<b style="color: orange;">Urlop</b>';
		elseif($graf4['typ'] == "2") $wpisk4 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&edit&date='.$date4.'"><button type="button" class="btn btn-warning btn-lg"><b>'.$graf4['linia']. '/' .$graf4['brygada']. '/' .$graf4['zmiana'].'</b><br/><small>'.$graf4['miejsce'].'</small><br/><b>'.$poj4['marka']. ' ' .$poj4['model']. ' #' .$poj4['taborowy'].'</b><br/><small>Kurs Z Wolnego</small></button></a>';
		elseif($graf4['typ'] == "3" || $graf4['typ'] == "5" || $graf4['typ'] == "8") $wpisk4 = '<s><b>'.$graf4['linia']. '/' .$graf4['brygada']. '/' .$graf4['zmiana'].'</b><br /><small>'.$graf4['miejsce'].'</small><br/><b>'.$poj4['marka']. ' ' .$poj4['model']. ' #' .$poj4['taborowy'].'</b><br/></s><small>Anulowany</small>';
		elseif($graf4['typ'] == "6") $wpisk4 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&edit&date='.$date4.'"><button type="button" class="btn btn-info btn-lg"><b>'.$graf4['linia']. '/' .$graf4['brygada']. '/' .$graf4['zmiana'].'</b><br/>'.$graf4['godzina_od']. '-' .$graf4['godzina_do'].'<br/><small>'.$graf4['miejsce'].'</small><br/><b>'.$poj4['marka']. ' ' .$poj4['model']. ' #' .$poj4['taborowy'].'</b><br/><small>Rezerwa</small></button></a>';
		elseif($graf4['typ'] == "1"){
			$wpisk4 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&edit&date='.$date4.'"><button type="button" class="btn btn-primary btn-lg"><b>'.$graf4['linia']. '/' .$graf4['brygada']. '/' .$graf4['zmiana'].'</b><br/><small>'.$graf4['miejsce'].'</small><br/><b>'.$poj4['marka']. ' ' .$poj4['model']. ' #' .$poj4['taborowy'].'</b><br /><small>Kurs Grafikowy</small></button></a>';
		}

		if($graf5['typ'] == "7") $wpisk5 = "<small>Wolne grafikowe</small>";
		elseif($graf5['typ'] == "4") $wpisk5 = '<b style="color: orange;">Urlop</b>';
		elseif($graf5['typ'] == "2") $wpisk5 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&edit&date='.$date5.'"><button type="button" class="btn btn-warning btn-lg"><b>'.$graf5['linia']. '/' .$graf5['brygada']. '/' .$graf5['zmiana'].'</b><br/><small>'.$graf5['miejsce'].'</small><br/><b>'.$poj5['marka']. ' ' .$poj5['model']. ' #' .$poj5['taborowy'].'</b><br/><small>Kurs Z Wolnego</small></button></a>';
		elseif($graf5['typ'] == "3" || $graf5['typ'] == "5" || $graf5['typ'] == "8") $wpisk5 = '<s><b>'.$graf5['linia']. '/' .$graf5['brygada']. '/' .$graf5['zmiana'].'</b><br /><small>'.$graf5['miejsce'].'</small><br/><b>'.$poj5['marka']. ' ' .$poj5['model']. ' #' .$poj5['taborowy'].'</b><br/></s><small>Anulowany</small>';
		elseif($graf5['typ'] == "6") $wpisk5 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&edit&date='.$date5.'"><button type="button" class="btn btn-info btn-lg"><b>'.$graf5['linia']. '/' .$graf5['brygada']. '/' .$graf5['zmiana'].'</b><br/>'.$graf5['godzina_od']. '-' .$graf5['godzina_do'].'<br/><small>'.$graf5['miejsce'].'</small><br/><b>'.$poj5['marka']. ' ' .$poj5['model']. ' #' .$poj5['taborowy'].'</b><br/><small>Rezerwa</small></button></a>';
		elseif($graf5['typ'] == "1"){
			$wpisk5 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&edit&date='.$date5.'"><button type="button" class="btn btn-primary btn-lg"><b>'.$graf5['linia']. '/' .$graf5['brygada']. '/' .$graf5['zmiana'].'</b><br/><small>'.$graf5['miejsce'].'</small><br/><b>'.$poj5['marka']. ' ' .$poj5['model']. ' #' .$poj5['taborowy'].'</b><br /><small>Kurs Grafikowy</small></button></a>';
		}

		if($graf6['typ'] == "7") $wpisk6 = "<small>Wolne grafikowe</small>";
		elseif($graf6['typ'] == "4") $wpisk6 = '<b style="color: orange;">Urlop</b>';
		elseif($graf6['typ'] == "2") $wpisk6 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&edit&date='.$date6.'"><button type="button" class="btn btn-warning btn-lg"><b>'.$graf6['linia']. '/' .$graf6['brygada']. '/' .$graf6['zmiana'].'</b><br/><small>'.$graf6['miejsce'].'</small><br/><b>'.$poj6['marka']. ' ' .$poj6['model']. ' #' .$poj6['taborowy'].'</b><br/><small>Kurs Z Wolnego</small></button></a>';
		elseif($graf6['typ'] == "3" || $graf6['typ'] == "5" || $graf6['typ'] == "8") $wpisk6 = '<s><b>'.$graf6['linia']. '/' .$graf6['brygada']. '/' .$graf6['zmiana'].'</b><br /><small>'.$graf6['miejsce'].'</small><br/><b>'.$poj6['marka']. ' ' .$poj6['model']. ' #' .$poj6['taborowy'].'</b><br/></s><small>Anulowany</small>';
		elseif($graf6['typ'] == "6") $wpisk6 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&edit&date='.$date6.'"><button type="button" class="btn btn-info btn-lg"><b>'.$graf6['linia']. '/' .$graf6['brygada']. '/' .$graf6['zmiana'].'</b><br/>'.$graf6['godzina_od']. '-' .$graf6['godzina_do'].'<br/><small>'.$graf6['miejsce'].'</small><br/><b>'.$poj6['marka']. ' ' .$poj6['model']. ' #' .$poj6['taborowy'].'</b><br/><small>Rezerwa</small></button></a>';
		elseif($graf6['typ'] == "1"){
			$wpisk6 = '<a href="index.php?a=dyspozytornia&driver='.$id.'&edit&date='.$date6.'"><button type="button" class="btn btn-primary btn-lg"><b>'.$graf6['linia']. '/' .$graf6['brygada']. '/' .$graf6['zmiana'].'</b><br/><small>'.$graf6['miejsce'].'</small><br/><b>'.$poj6['marka']. ' ' .$poj6['model']. ' #' .$poj6['taborowy'].'</b><br /><small>Kurs Grafikowy</small></button></a>';
		}

	}elseif(isset($_GET['driver']) && isset($_GET['add']) && isset($_GET['date'])){
		$id = vtxt($_GET['driver']);
		$data = vtxt($_GET['date']);
		$wybor = false;
		$widok = false;
		$dodawanie = true;
		$edytuj = false;

		$dni = array('Niedziela', 'Poniedzialek', 'Wtorek', 'Środa', 'Czwartek', 'Piátek', 'Sobota');
		$dzientygodnia = $dni[(date('w', $data))];
		$datawpisu = date('d.m.Y',$data);

		$etat = row("SELECT * FROM etaty WHERE uid = ".$id);
		$target = row("SELECT * FROM users WHERE id = ".$id);
		$role1 = row("SELECT * FROM rangi WHERE id = ".$target['stanowisko']);

	}elseif(isset($_GET['driver']) && isset($_GET['edit']) && isset($_GET['date'])){
		$id = vtxt($_GET['driver']);
		$data = vtxt($_GET['date']);
		$wybor = false;
		$widok = false;
		$dodawanie = false;
		$edytuj = true;

		$dni = array('Niedziela', 'Poniedzialek', 'Wtorek', 'Środa', 'Czwartek', 'Piátek', 'Sobota');
		$dzientygodnia = $dni[(date('w', $data))];
		$datawpisu = date('d.m.Y',$data);

		$etat = row("SELECT * FROM etaty WHERE uid = ".$id);
		$target = row("SELECT * FROM users WHERE id = ".$id);
		$role1 = row("SELECT * FROM rangi WHERE id = ".$target['stanowisko']);
		$xd = row("SELECT * FROM grafik WHERE uid = ".$id." AND data = ".$data);

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
			<div class="row">
				<?php if($widok):?>
					<div class="col-lg-12">
						<div class="card shadow mb-4">
							<div class="card-body">
								<button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button> - pracuje w tym dniu &nbsp;
								<button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button> - nie pracuje w tym dniu
							</div>
						</div>

						<div class="card shadow mb-4">
							<div class="card-body">
								<div class="table-responsive text-center">
									<table id="tabela" class="table table-bordered" style="width: 100%;">
										<thead>
											<tr style="text-align: center">
												<th scope="col" style="width: 50px; vertical-align: middle;">Login</th>
												<th scope="col"><?=$dzis;?><BR /><?=$tydz;?></th>
												<th scope="col"><?=$jutro;?><BR /><?=$tydz1;?></th>
												<th scope="col"><?=$pojutrze;?><BR /><?=$tydz2;?></th>
												<th scope="col"><?=$za3dni;?><BR /><?=$tydz3;?></th>
												<th scope="col"><?=$za4dni;?><BR /><?=$tydz4;?></th>
												<th scope="col"><?=$za5dni;?><BR /><?=$tydz5;?></th>
												<th scope="col"><?=$za6dni;?><BR /><?=$tydz6;?></th>
												<th scope="col"><?=$za7dni;?><BR /><?=$tydz7;?></th>
											</tr>
										</thead>
										<tbody>


											<?php
												$targets = call("SELECT * FROM users WHERE deleted != '1' AND stanowisko != 21 AND stanowisko != 22 ORDER BY nr_sluzbowy");
												while ($row = mysqli_fetch_array($targets)):
													$graf = row("SELECT * FROM grafik WHERE uid = ".$row['id']." AND data = ".$date);
													$graf1 = row("SELECT * FROM grafik WHERE uid = ".$row['id']." AND data = ".$date1);
													$graf2 = row("SELECT * FROM grafik WHERE uid = ".$row['id']." AND data = ".$date2);
													$graf3 = row("SELECT * FROM grafik WHERE uid = ".$row['id']." AND data = ".$date3);
													$graf4 = row("SELECT * FROM grafik WHERE uid = ".$row['id']." AND data = ".$date4);
													$graf5 = row("SELECT * FROM grafik WHERE uid = ".$row['id']." AND data = ".$date5);
													$graf6 = row("SELECT * FROM grafik WHERE uid = ".$row['id']." AND data = ".$date6);
													$graf7 = row("SELECT * FROM grafik WHERE uid = ".$row['id']." AND data = ".$date7);

													$etat = row("SELECT * FROM etaty WHERE uid = ".$row['id']);

													$role1 = row("SELECT * FROM rangi WHERE id = ".$row['stanowisko']);


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
														$wózukryty1 = '1';
													}

													//poniedzialek
													if($tydz == 'PONIEDZIAŁEK'){
														if($etat['poniedzialek'] == "1"){
															$wpis = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
														} else {
															$wpis = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
														}
													}elseif($tydz1 == 'PONIEDZIAŁEK'){
														if($etat['poniedzialek'] == "1"){
															$wpis1 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date1.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
														} else {
															$wpis1 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date1.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
														}
													}elseif($tydz2 == 'PONIEDZIAŁEK'){
														if($etat['poniedzialek'] == "1"){
															$wpis2 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date2.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
														} else {
															$wpis2 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date2.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
														}
													}elseif($tydz3 == 'PONIEDZIAŁEK'){
														if($etat['poniedzialek'] == "1"){
															$wpis3 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date3.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
														} else {
															$wpis3 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date3.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
														}
													}elseif($tydz4 == 'PONIEDZIAŁEK'){
														if($etat['poniedzialek'] == "1"){
															$wpis4 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date4.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
														} else {
															$wpis4 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date4.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
														}
													}elseif($tydz5 == 'PONIEDZIAŁEK'){
														if($etat['poniedzialek'] == "1"){
															$wpis5 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date5.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
														} else {
															$wpis5 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date5.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
														}
													}elseif($tydz6 == 'PONIEDZIAŁEK'){
														if($etat['poniedzialek'] == "1"){
															$wpis6 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date6.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
														} else {
															$wpis6 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date6.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
														}
													}elseif($tydz7 == 'PONIEDZIAŁEK'){
														if($etat['poniedzialek'] == "1"){
															$wpis7 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date7.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
														} else {
															$wpis7 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date7.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
														}
													}
													//wtorek
													if($tydz == 'WTOREK'){
														if($etat['wtorek'] == "1"){
															$wpis = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
														} else {
															$wpis = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
														}
													}
													if($tydz1 == 'WTOREK'){
														if($etat['wtorek'] == "1"){
															$wpis1 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date1.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
														} else {
															$wpis1 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date1.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
														}
													}
													if($tydz2 == 'WTOREK'){
														if($etat['wtorek'] == "1"){
															$wpis2 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date2.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
														} else {
															$wpis2 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date2.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
														}
													}
													if($tydz3 == 'WTOREK'){
														if($etat['wtorek'] == "1"){
															$wpis3 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date3.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
														} else {
															$wpis3 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date3.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
														}
													}
													if($tydz4 == 'WTOREK'){
														if($etat['wtorek'] == "1"){
															$wpis4 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date4.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
														} else {
															$wpis4 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date4.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
														}
													}
													if($tydz5 == 'WTOREK'){
														if($etat['wtorek'] == "1"){
															$wpis5 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date5.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
														} else {
															$wpis5 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date5.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
														}
													}
													if($tydz6 == 'WTOREK'){
														if($etat['wtorek'] == "1"){
															$wpis6 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date6.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
														} else {
															$wpis6 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date6.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
														}
													}
													if($tydz7 == 'WTOREK'){
														if($etat['wtorek'] == "1"){
															$wpis7 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date7.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
														} else {
															$wpis7 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date7.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
														}
													}
													//sroda
													if($tydz == 'ŚRODA'){
														if($etat['sroda'] == "1"){
															$wpis = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
														} else {
															$wpis = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
														}
													}if($tydz1 == 'ŚRODA'){
														if($etat['sroda'] == "1"){
															$wpis1 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date1.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
														} else {
															$wpis1 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date1.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
														}
													}if($tydz2 == 'ŚRODA'){
														if($etat['sroda'] == "1"){
															$wpis2 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date2.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
														} else {
															$wpis2 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date2.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
														}
													}if($tydz3 == 'ŚRODA'){
														if($etat['sroda'] == "1"){
															$wpis3 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date3.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
														} else {
															$wpis3 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date3.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
														}
													}if($tydz4 == 'ŚRODA'){
														if($etat['sroda'] == "1"){
															$wpis4 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date4.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
														} else {
															$wpis4 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date4.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
														}
													}if($tydz5 == 'ŚRODA'){
														if($etat['sroda'] == "1"){
															$wpis5 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date5.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
														} else {
															$wpis5 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date5.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
														}
													}if($tydz6 == 'ŚRODA'){
														if($etat['sroda'] == "1"){
															$wpis6 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date6.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
														} else {
															$wpis6 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date6.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
														}
													}if($tydz7 == 'ŚRODA'){
														if($etat['sroda'] == "1"){
															$wpis7 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date7.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
														} else {
															$wpis7 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date7.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
														}
													}
													//czwartek
													if($tydz == 'CZWARTEK'){
														if($etat['czwartek'] == "1"){
															$wpis = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
														} else {
															$wpis = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
														}
													}if($tydz1 == 'CZWARTEK'){
														if($etat['czwartek'] == "1"){
															$wpis1 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date1.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
														} else {
															$wpis1 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date1.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
														}
													}if($tydz2 == 'CZWARTEK'){
														if($etat['czwartek'] == "1"){
															$wpis2 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date2.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
														} else {
															$wpis2 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date2.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
														}
													}if($tydz3 == 'CZWARTEK'){
														if($etat['czwartek'] == "1"){
															$wpis3 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date3.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
														} else {
															$wpis3 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date3.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
														}
													}if($tydz4 == 'CZWARTEK'){
														if($etat['czwartek'] == "1"){
															$wpis4 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date4.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
														} else {
															$wpis4 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date4.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
														}
													}if($tydz5 == 'CZWARTEK'){
														if($etat['czwartek'] == "1"){
															$wpis5 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date5.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
														} else {
															$wpis5 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date5.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
														}
													}if($tydz6 == 'CZWARTEK'){
														if($etat['czwartek'] == "1"){
															$wpis6 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date6.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
														} else {
															$wpis6 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date6.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
														}
													}
													if($tydz7 == 'CZWARTEK'){
														if($etat['czwartek'] == "1"){
															$wpis7 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date7.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
														} else {
															$wpis7 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date7.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
														}
													}
													//piátek
													if($tydz == 'PIĄTEK'){
														if($etat['piatek'] == "1"){
															$wpis = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
														} else {
															$wpis = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
														}
													}if($tydz1 == 'PIĄTEK'){
														if($etat['piatek'] == "1"){
															$wpis1 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date1.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
														} else {
															$wpis1 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date1.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
														}
													}if($tydz2 == 'PIĄTEK'){
														if($etat['piatek'] == "1"){
															$wpis2 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date2.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
														} else {
															$wpis2 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date2.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
														}
													}if($tydz3 == 'PIĄTEK'){
														if($etat['piatek'] == "1"){
															$wpis3 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date3.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
														} else {
															$wpis3 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date3.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
														}
													}if($tydz4 == 'PIĄTEK'){
														if($etat['piatek'] == "1"){
															$wpis4 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date4.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
														} else {
															$wpis4 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date4.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
														}
													}if($tydz5 == 'PIĄTEK'){
														if($etat['piatek'] == "1"){
															$wpis5 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date5.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
														} else {
															$wpis5 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date5.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
														}
													}if($tydz6 == 'PIĄTEK'){
														if($etat['piatek'] == "1"){
															$wpis6 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date6.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
														} else {
															$wpis6 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date6.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
														}
													}
													if($tydz7 == 'PIĄTEK'){
														if($etat['piatek'] == "1"){
															$wpis7 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date7.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
														} else {
															$wpis7 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date7.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
														}
													}
													//sobota
													if($tydz == 'SOBOTA'){
														if($etat['sobota'] == "1"){
															$wpis = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
														} else {
															$wpis = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
														}
													}if($tydz1 == 'SOBOTA'){
														if($etat['sobota'] == "1"){
															$wpis1 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date1.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
														} else {
															$wpis1 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date1.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
														}
													}if($tydz2 == 'SOBOTA'){
														if($etat['sobota'] == "1"){
															$wpis2 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date2.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
														} else {
															$wpis2 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date2.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
														}
													}if($tydz3 == 'SOBOTA'){
														if($etat['sobota'] == "1"){
															$wpis3 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date3.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
														} else {
															$wpis3 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date3.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
														}
													}if($tydz4 == 'SOBOTA'){
														if($etat['sobota'] == "1"){
															$wpis4 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date4.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
														} else {
															$wpis4 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date4.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
														}
													}if($tydz5 == 'SOBOTA'){
														if($etat['sobota'] == "1"){
															$wpis5 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date5.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
														} else {
															$wpis5 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date5.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
														}
													}if($tydz6 == 'SOBOTA'){
														if($etat['sobota'] == "1"){
															$wpis6 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date6.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
														} else {
															$wpis6 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date6.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
														}
													}if($tydz7 == 'SOBOTA'){
														if($etat['sobota'] == "1"){
															$wpis7 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date7.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
														} else {
															$wpis7 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date7.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
														}
													}
													//niedziela
													if($tydz == 'NIEDZIELA'){
														if($etat['niedziela'] == "1"){
															$wpis = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
														} else {
															$wpis = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
														}
													}if($tydz1 == 'NIEDZIELA'){
														if($etat['niedziela'] == "1"){
															$wpis1 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date1.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
														} else {
															$wpis1 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date1.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
														}
													}if($tydz2 == 'NIEDZIELA'){
														if($etat['niedziela'] == "1"){
															$wpis2 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date2.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
														} else {
															$wpis2 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date2.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
														}
													}if($tydz3 == 'NIEDZIELA'){
														if($etat['niedziela'] == "1"){
															$wpis3 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date3.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
														} else {
															$wpis3 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date3.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
														}
													}if($tydz4 == 'NIEDZIELA'){
														if($etat['niedziela'] == "1"){
															$wpis4 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date4.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
														} else {
															$wpis4 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date4.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
														}
													}if($tydz5 == 'NIEDZIELA'){
														if($etat['niedziela'] == "1"){
															$wpis5 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date5.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
														} else {
															$wpis5 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date5.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
														}
													}if($tydz6 == 'NIEDZIELA'){
														if($etat['niedziela'] == "1"){
															$wpis6 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date6.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
														} else {
															$wpis6 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date6.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
														}
													}if($tydz7 == 'NIEDZIELA'){
														if($etat['niedziela'] == "1"){
															$wpis7 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date7.'"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>';
														} else {
															$wpis7 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&add&date='.$date7.'"><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button></a>';
														}
													}

													if($graf['typ'] == "7") $wpis = "<small>Wolne grafikowe</small>";
													elseif($graf['typ'] == "4") $wpis = '<b style="color: orange;">Urlop</b>';
													elseif($graf['typ'] == "2") $wpis = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&edit&date='.$date.'"><button type="button" class="btn btn-warning btn-lg"><b>'.$graf['linia']. '/' .$graf['brygada']. '/' .$graf['zmiana'].'</b><br/><small>'.$graf['miejsce'].'</small><br/><b>'.$poj['marka']. ' ' .$poj['model']. ' #' .$poj['taborowy'].'</b><br/><small>Kurs Z Wolnego</small></button></a>';
													elseif($graf['typ'] == "3" || $graf['typ'] == "5" || $graf['typ'] == "8") $wpis = '<s><b>'.$graf['linia']. '/' .$graf['brygada']. '/' .$graf['zmiana'].'</b><br /><small>'.$graf['miejsce'].'</small><br/><b>'.$poj['marka']. ' ' .$poj['model']. ' #' .$poj['taborowy'].'</b><br/></s><small>Anulowany</small>';
													elseif($graf['typ'] == "6") $wpis = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&edit&date='.$date.'"><button type="button" class="btn btn-info btn-lg"><b>'.$graf['linia']. '/' .$graf['brygada']. '/' .$graf['zmiana'].'</b><br/>'.$graf['godzina_od']. ' - ' .$graf['godzina_do'].'<br/><small>'.$graf['miejsce'].'</small><br/><b>'.$poj['marka']. ' ' .$poj['model']. ' #' .$poj['taborowy'].'</b><br/><small>Rezerwa</small></button></a>';
													elseif($graf['typ'] == "1"){
														$wpis = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&edit&date='.$date.'"><button type="button" class="btn btn-primary btn-lg"><b>'.$graf['linia']. '/' .$graf['brygada']. '/' .$graf['zmiana'].'</b><br/><small>'.$graf['miejsce'].'</small><br/><b>'.$poj['marka']. ' ' .$poj['model']. ' #' .$poj['taborowy'].'</b><br /><small>Kurs Grafikowy</small></button></a>';
													}

													if($graf1['typ'] == "7") $wpis1 = "<small>Wolne grafikowe</small>";
													elseif($graf1['typ'] == "4") $wpis1 = '<b style="color: orange;">Urlop</b>';
													elseif($graf1['typ'] == "2") $wpis1 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&edit&date='.$date1.'"><button type="button" class="btn btn-warning btn-lg"><b>'.$graf1['linia']. '/' .$graf1['brygada']. '/' .$graf1['zmiana'].'</b><br/><small>'.$graf1['miejsce'].'</small><br/><b>'.$poj1['marka']. ' ' .$poj1['model']. ' #' .$poj1['taborowy'].'</b><br/><small>Kurs Z Wolnego</small></button></a>';
													elseif($graf1['typ'] == "3" || $graf1['typ'] == "5" || $graf1['typ'] == "8") $wpis1 = '<s><b>'.$graf1['linia']. '/' .$graf1['brygada']. '/' .$graf1['zmiana'].'</b><br /><small>'.$graf1['miejsce'].'</small><br/><b>'.$poj1['marka']. ' ' .$poj1['model']. ' #' .$poj1['taborowy'].'</b><br/></s><small>Anulowany</small>';
													elseif($graf1['typ'] == "6") $wpis1 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&edit&date='.$date1.'"><button type="button" class="btn btn-info btn-lg"><b>'.$graf1['linia']. '/' .$graf1['brygada']. '/' .$graf1['zmiana'].'</b><br/>'.$graf1['godzina_od']. '-' .$graf1['godzina_do'].'<br/><small>'.$graf1['miejsce'].'</small><br/><b>'.$poj1['marka']. ' ' .$poj1['model']. ' #' .$poj1['taborowy'].'</b><br/><small>Rezerwa</small></button></a>';
													elseif($graf1['typ'] == "1"){
														$wpis1 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&edit&date='.$date1.'"><button type="button" class="btn btn-primary btn-lg"><b>'.$graf1['linia']. '/' .$graf1['brygada']. '/' .$graf1['zmiana'].'</b><br/><small>'.$graf1['miejsce'].'</small><br/><b>'.$poj1['marka']. ' ' .$poj1['model']. ' #' .$poj1['taborowy'].'</b><br /><small>Kurs Grafikowy</small></button></a>';
													}

													if($graf2['typ'] == "7") $wpis2 = "<small>Wolne grafikowe</small>";
													elseif($graf2['typ'] == "4") $wpis2 = '<b style="color: orange;">Urlop</b>';
													elseif($graf2['typ'] == "2") $wpis2 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&edit&date='.$date2.'"><button type="button" class="btn btn-warning btn-lg"><b>'.$graf2['linia']. '/' .$graf2['brygada']. '/' .$graf2['zmiana'].'</b><br/><small>'.$graf2['miejsce'].'</small><br/><b>'.$poj2['marka']. ' ' .$poj2['model']. ' #' .$poj2['taborowy'].'</b><br/><small>Kurs Z Wolnego</small></button></a>';
													elseif($graf2['typ'] == "3" || $graf2['typ'] == "5" || $graf2['typ'] == "8") $wpis2 = '<s><b>'.$graf2['linia']. '/' .$graf2['brygada']. '/' .$graf2['zmiana'].'</b><br /><small>'.$graf2['miejsce'].'</small><br/><b>'.$poj2['marka']. ' ' .$poj2['model']. ' #' .$poj2['taborowy'].'</b><br/></s><small>Anulowany</small>';
													elseif($graf2['typ'] == "6") $wpis2 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&edit&date='.$date2.'"><button type="button" class="btn btn-info btn-lg"><b>'.$graf2['linia']. '/' .$graf2['brygada']. '/' .$graf2['zmiana'].'</b><br/>'.$graf2['godzina_od']. '-' .$graf2['godzina_do'].'<br/><small>'.$graf2['miejsce'].'</small><br/><b>'.$poj2['marka']. ' ' .$poj2['model']. ' #' .$poj2['taborowy'].'</b><br/><small>Rezerwa</small></button></a>';
													elseif($graf2['typ'] == "1"){
														$wpis2 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&edit&date='.$date2.'"><button type="button" class="btn btn-primary btn-lg"><b>'.$graf2['linia']. '/' .$graf2['brygada']. '/' .$graf2['zmiana'].'</b><br/><small>'.$graf2['miejsce'].'</small><br/><b>'.$poj2['marka']. ' ' .$poj2['model']. ' #' .$poj2['taborowy'].'</b><br /><small>Kurs Grafikowy</small></button></a>';
													}

													if($graf3['typ'] == "7") $wpis3 = "<small>Wolne grafikowe</small>";
													elseif($graf3['typ'] == "4") $wpis3 = '<b style="color: orange;">Urlop</b>';
													elseif($graf3['typ'] == "2") $wpis3 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&edit&date='.$date3.'"><button type="button" class="btn btn-warning btn-lg"><b>'.$graf3['linia']. '/' .$graf3['brygada']. '/' .$graf3['zmiana'].'</b><br/><small>'.$graf3['miejsce'].'</small><br/><b>'.$poj3['marka']. ' ' .$poj3['model']. ' #' .$poj3['taborowy'].'</b><br/><small>Kurs Z Wolnego</small></button></a>';
													elseif($graf3['typ'] == "3" || $graf3['typ'] == "5" || $graf3['typ'] == "8") $wpis3 = '<s><b>'.$graf3['linia']. '/' .$graf3['brygada']. '/' .$graf3['zmiana'].'</b><br /><small>'.$graf3['miejsce'].'</small><br/><b>'.$poj3['marka']. ' ' .$poj3['model']. ' #' .$poj3['taborowy'].'</b><br/></s><small>Anulowany</small>';
													elseif($graf3['typ'] == "6") $wpis3 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&edit&date='.$date3.'"><button type="button" class="btn btn-info btn-lg"><b>'.$graf3['linia']. '/' .$graf3['brygada']. '/' .$graf3['zmiana'].'</b><br/>'.$graf3['godzina_od']. '-' .$graf3['godzina_do'].'<br/><small>'.$graf3['miejsce'].'</small><br/><b>'.$poj3['marka']. ' ' .$poj3['model']. ' #' .$poj3['taborowy'].'</b><br/><small>Rezerwa</small></button></a>';
													elseif($graf3['typ'] == "1"){
														$wpis3 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&edit&date='.$date3.'"><button type="button" class="btn btn-primary btn-lg"><b>'.$graf3['linia']. '/' .$graf3['brygada']. '/' .$graf3['zmiana'].'</b><br/><small>'.$graf3['miejsce'].'</small><br/><b>'.$poj3['marka']. ' ' .$poj3['model']. ' #' .$poj3['taborowy'].'</b><br /><small>Kurs Grafikowy</small></button></a>';
													}

													if($graf4['typ'] == "7") $wpis4 = "<small>Wolne grafikowe</small>";
													elseif($graf4['typ'] == "4") $wpis4 = '<b style="color: orange;">Urlop</b>';
													elseif($graf4['typ'] == "2") $wpis4 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&edit&date='.$date4.'"><button type="button" class="btn btn-warning btn-lg"><b>'.$graf4['linia']. '/' .$graf4['brygada']. '/' .$graf4['zmiana'].'</b><br/><small>'.$graf4['miejsce'].'</small><br/><b>'.$poj4['marka']. ' ' .$poj4['model']. ' #' .$poj4['taborowy'].'</b><br/><small>Kurs Z Wolnego</small></button></a>';
													elseif($graf4['typ'] == "3" || $graf4['typ'] == "5" || $graf4['typ'] == "8") $wpis4 = '<s><b>'.$graf4['linia']. '/' .$graf4['brygada']. '/' .$graf4['zmiana'].'</b><br /><small>'.$graf4['miejsce'].'</small><br/><b>'.$poj4['marka']. ' ' .$poj4['model']. ' #' .$poj4['taborowy'].'</b><br/></s><small>Anulowany</small>';
													elseif($graf4['typ'] == "6") $wpis4 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&edit&date='.$date4.'"><button type="button" class="btn btn-info btn-lg"><b>'.$graf4['linia']. '/' .$graf4['brygada']. '/' .$graf4['zmiana'].'</b><br/>'.$graf4['godzina_od']. '-' .$graf4['godzina_do'].'<br/><small>'.$graf4['miejsce'].'</small><br/><b>'.$poj4['marka']. ' ' .$poj4['model']. ' #' .$poj4['taborowy'].'</b><br/><small>Rezerwa</small></button></a>';
													elseif($graf4['typ'] == "1"){
														$wpis4 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&edit&date='.$date4.'"><button type="button" class="btn btn-primary btn-lg"><b>'.$graf4['linia']. '/' .$graf4['brygada']. '/' .$graf4['zmiana'].'</b><br/><small>'.$graf4['miejsce'].'</small><br/><b>'.$poj4['marka']. ' ' .$poj4['model']. ' #' .$poj4['taborowy'].'</b><br /><small>Kurs Grafikowy</small></button></a>';
													}

													if($graf5['typ'] == "7") $wpis5 = "<small>Wolne grafikowe</small>";
													elseif($graf5['typ'] == "4") $wpis5 = '<b style="color: orange;">Urlop</b>';
													elseif($graf5['typ'] == "2") $wpis5 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&edit&date='.$date5.'"><button type="button" class="btn btn-warning btn-lg"><b>'.$graf5['linia']. '/' .$graf5['brygada']. '/' .$graf5['zmiana'].'</b><br/><small>'.$graf5['miejsce'].'</small><br/><b>'.$poj5['marka']. ' ' .$poj5['model']. ' #' .$poj5['taborowy'].'</b><br/><small>Kurs Z Wolnego</small></button></a>';
													elseif($graf5['typ'] == "3" || $graf5['typ'] == "5" || $graf5['typ'] == "8") $wpis5 = '<s><b>'.$graf5['linia']. '/' .$graf5['brygada']. '/' .$graf5['zmiana'].'</b><br /><small>'.$graf5['miejsce'].'</small><br/><b>'.$poj5['marka']. ' ' .$poj5['model']. ' #' .$poj5['taborowy'].'</b><br/></s><small>Anulowany</small>';
													elseif($graf5['typ'] == "6") $wpis5 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&edit&date='.$date5.'"><button type="button" class="btn btn-info btn-lg"><b>'.$graf5['linia']. '/' .$graf5['brygada']. '/' .$graf5['zmiana'].'</b><br/>'.$graf5['godzina_od']. '-' .$graf5['godzina_do'].'<br/><small>'.$graf5['miejsce'].'</small><br/><b>'.$poj5['marka']. ' ' .$poj5['model']. ' #' .$poj5['taborowy'].'</b><br/><small>Rezerwa</small></button></a>';
													elseif($graf5['typ'] == "1"){
														$wpis5 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&edit&date='.$date5.'"><button type="button" class="btn btn-primary btn-lg"><b>'.$graf5['linia']. '/' .$graf5['brygada']. '/' .$graf5['zmiana'].'</b><br/><small>'.$graf5['miejsce'].'</small><br/><b>'.$poj5['marka']. ' ' .$poj5['model']. ' #' .$poj5['taborowy'].'</b><br /><small>Kurs Grafikowy</small></button></a>';
													}

													if($graf6['typ'] == "7") $wpis6 = "<small>Wolne grafikowe</small>";
													elseif($graf6['typ'] == "4") $wpis6 = '<b style="color: orange;">Urlop</b>';
													elseif($graf6['typ'] == "2") $wpis6 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&edit&date='.$date6.'"><button type="button" class="btn btn-warning btn-lg"><b>'.$graf6['linia']. '/' .$graf6['brygada']. '/' .$graf6['zmiana'].'</b><br/><small>'.$graf6['miejsce'].'</small><br/><b>'.$poj6['marka']. ' ' .$poj6['model']. ' #' .$poj6['taborowy'].'</b><br/><small>Kurs Z Wolnego</small></button></a>';
													elseif($graf6['typ'] == "3" || $graf6['typ'] == "5" || $graf6['typ'] == "8") $wpis6 = '<s><b>'.$graf6['linia']. '/' .$graf6['brygada']. '/' .$graf6['zmiana'].'</b><br /><small>'.$graf6['miejsce'].'</small><br/><b>'.$poj6['marka']. ' ' .$poj6['model']. ' #' .$poj6['taborowy'].'</b><br/></s><small>Anulowany</small>';
													elseif($graf6['typ'] == "6") $wpis6 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&edit&date='.$date6.'"><button type="button" class="btn btn-info btn-lg"><b>'.$graf6['linia']. '/' .$graf6['brygada']. '/' .$graf6['zmiana'].'</b><br/>'.$graf6['godzina_od']. '-' .$graf6['godzina_do'].'<br/><small>'.$graf6['miejsce'].'</small><br/><b>'.$poj6['marka']. ' ' .$poj6['model']. ' #' .$poj6['taborowy'].'</b><br/><small>Rezerwa</small></button></a>';
													elseif($graf6['typ'] == "1"){
														$wpis6 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&edit&date='.$date6.'"><button type="button" class="btn btn-primary btn-lg"><b>'.$graf6['linia']. '/' .$graf6['brygada']. '/' .$graf6['zmiana'].'</b><br/><small>'.$graf6['miejsce'].'</small><br/><b>'.$poj6['marka']. ' ' .$poj6['model']. ' #' .$poj6['taborowy'].'</b><br /><small>Kurs Grafikowy</small></button></a>';
													}

													if($graf7['typ'] == "7") $wpis7 = "<small>Wolne grafikowe</small>";
													elseif($graf7['typ'] == "4") $wpis7 = '<b style="color: orange;">Urlop</b>';
													elseif($graf7['typ'] == "2") $wpis7 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&edit&date='.$date6.'"><button type="button" class="btn btn-warning btn-lg"><b>'.$graf7['linia']. '/' .$graf7['brygada']. '/' .$graf7['zmiana'].'</b><br/><small>'.$graf7['miejsce'].'</small><br/><b>'.$poj6['marka']. ' ' .$poj6['model']. ' #' .$poj6['taborowy'].'</b><br/><small>Kurs Z Wolnego</small></button></a>';
													elseif($graf7['typ'] == "3" || $graf7['typ'] == "5" || $graf7['typ'] == "8") $wpis7 = '<s><b>'.$graf7['linia']. '/' .$graf7['brygada']. '/' .$graf7['zmiana'].'</b><br /><small>'.$graf7['miejsce'].'</small><br/><b>'.$poj6['marka']. ' ' .$poj6['model']. ' #' .$poj6['taborowy'].'</b><br/></s><small>Anulowany</small>';
													elseif($graf7['typ'] == "6") $wpis7 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&edit&date='.$date6.'"><button type="button" class="btn btn-info btn-lg"><b>'.$graf7['linia']. '/' .$graf7['brygada']. '/' .$graf7['zmiana'].'</b><br/>'.$graf7['godzina_od']. '-' .$graf7['godzina_do'].'<br/><small>'.$graf7['miejsce'].'</small><br/><b>'.$poj6['marka']. ' ' .$poj6['model']. ' #' .$poj6['taborowy'].'</b><br/><small>Rezerwa</small></button></a>';
													elseif($graf7['typ'] == "1"){
														$wpis7 = '<a href="index.php?a=dyspozytornia&driver='.$row['id'].'&edit&date='.$date6.'"><button type="button" class="btn btn-primary btn-lg"><b>'.$graf7['linia']. '/' .$graf7['brygada']. '/' .$graf7['zmiana'].'</b><br/><small>'.$graf7['miejsce'].'</small><br/><b>'.$poj6['marka']. ' ' .$poj6['model']. ' #' .$poj6['taborowy'].'</b><br /><small>Kurs Grafikowy</small></button></a>';
													}

													$wpis7 = 'chuj nw czemu nie dziala';
												?>
												<tr style="text-align: center">
													<td scope="col" style="vertical-align: middle;"><a href="index.php?a=dyspozytornia&driver=<?=$row['id'];?>" style="color: <?=$role1['kolor'];?>"><?=$row['login'], ' [', $role1['kod_roli'], $row['nr_sluzbowy'],']';?></a></td>
													<td scope="col" style="vertical-align: middle;"><?=$wpis;?></td>
													<td scope="col" style="vertical-align: middle;"><?=$wpis1;?></td>
													<td scope="col" style="vertical-align: middle;"><?=$wpis2;?></td>
													<td scope="col" style="vertical-align: middle;"><?=$wpis3;?></td>
													<td scope="col" style="vertical-align: middle;"><?=$wpis4;?></td>
													<td scope="col" style="vertical-align: middle;"><?=$wpis5;?></td>
													<td scope="col" style="vertical-align: middle;"><?=$wpis6;?></td>
													<td scope="col" style="vertical-align: middle;"><?=$wpis7;?></td>
												</tr>
											<?php endwhile;?>
										</tbody>
									</table>
								</div>
							</div>
						  <!-- /.card-body -->
						</div>
						<!-- /.card -->
					</div>
				<?php elseif($wybor):?>
					<div class="col-lg-3">
						<div class="card shadow mb-4">
							<div class="card-header">
								<h3 class="m-0 font-weight-bold text-primary">Pracownik</h3>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-12">
										<ul class="list-group list-group-unbordered mb-3">
											<?php
												$etat = row("SELECT * FROM etaty WHERE uid = ".$target['id']);
												$cos = $etat['poniedzialek'] + $etat['wtorek'] + $etat['sroda'] + $etat['czwartek'] + $etat['piatek'] + $etat['sobota'] + $etat['niedziela'];
											?>
											<li class="list-group-item">
												<b>Nazwa uzytkownika</b><a class="float-right" style="color: <?=$role1['kolor'];?>"><?=$target['login'], ' [', $role1['kod_roli'], $target['nr_sluzbowy'],']';?></a>
											</li>
											<li class="list-group-item">
												<b>Numer służbowy</b><a class="float-right"><?=$target['nr_sluzbowy'];?></a>
											</li>
											<li class="list-group-item">
												<?php $kod = row("SELECT * FROM przewoznicy WHERE id = ".$target['guild']);?>
												<b>Kod przewoźnika</b><a class="float-right"><?=$kod['tag'];?></a>
											</li>
											<li class="list-group-item">
												<b>Etat</b><a class="float-right"><?=$cos, '/7';?></a>
											</li>
										</ul>
									</div>

								</div>
							</div>

						  <!-- /.card-body -->
						</div>
						<!-- /.card -->
						<div class="card shadow mb-4">
							<div class="card-body">
								<a href="index.php?a=dyspozytornia"><button type="button" class="btn btn-primary">Powrót</button></a>
							</div>
						</div>


					</div>
					<div class="col-lg-9">
						<div class="card shadow mb-4">
							<div class="card-body">

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
											<td scope="col" style="height: 250px; vertical-align: middle;"><?=$wpisk;?></td>
											<td scope="col" style="height: 250px; vertical-align: middle;"><?=$wpisk1;?></td>
											<td scope="col" style="height: 250px; vertical-align: middle;"><?=$wpisk2;?></td>
											<td scope="col" style="height: 250px; vertical-align: middle;"><?=$wpisk3;?></td>
											<td scope="col" style="height: 250px; vertical-align: middle;"><?=$wpisk4;?></td>
											<td scope="col" style="height: 250px; vertical-align: middle;"><?=$wpisk5;?></td>
											<td scope="col" style="height: 250px; vertical-align: middle;"><?=$wpisk6;?></td>
										</tbody>

									</table>

								</div>
							</div>
						  <!-- /.card-body -->
						</div>
						<!-- /.card -->
					</div>
				<?php elseif($dodawanie):?>

					<div class="card shadow mb-4">
						<div class="card-header">
							<h3 class="m-0 font-weight-bold text-primary">Nowy wpis do grafiku</h3>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-lg-4">
									<ul class="list-group list-group-unbordered mb-3">
										<?php
											$etat = row("SELECT * FROM etaty WHERE uid = ".$target['id']);
											$cos = $etat['poniedzialek'] + $etat['wtorek'] + $etat['sroda'] + $etat['czwartek'] + $etat['piatek'] + $etat['sobota'] + $etat['niedziela'];
										?>
										<li class="list-group-item">
											<b>Dzień do wpisu</b><a class="float-right"><?=$datawpisu, ' - ', $dzientygodnia;?></a>
										</li>

										<li class="list-group-item">
											<b>Nazwa uzytkownika</b><a class="float-right" style="color: <?=$role1['kolor'];?>"><?=$target['login'], ' [', $role1['kod_roli'], $target['nr_sluzbowy'],']';?></a>
										</li>
										<li class="list-group-item">
											<b>Numer służbowy</b><a class="float-right"><?=$target['nr_sluzbowy'];?></a>
										</li>
										<li class="list-group-item">
											<?php $kod = row("SELECT * FROM przewoznicy WHERE id = ".$target['guild']);?>
											<b>Kod przewoźnika</b><a class="float-right"><?=$kod['tag'];?></a>
										</li>
										<li class="list-group-item">
											<b>Etat</b><a class="float-right"><?=$cos, '/7';?></a>
										</li>
									</ul>
								</div>
								<div class="col-lg-4">
									<form action="skrypty/add/grafik.php" method="POST">
										<div class="row">
											<div class="col-lg-6">
												<div class="form-group">
													<input type="hidden" name="data" value="<?=$data;?>">
													<input type="hidden" name="uid" value="<?=$target['id'];?>">
													<label for="numer">Numer Linii</label>
													<input id="numer" type="text" name="numer" class="form-control" placeholder="Numer Linii">
												</div>
												<div class="form-group">
													<label for="brygada">Brygada</label>
													<input id="brygada" type="number" name="brygada" class="form-control" placeholder="Brygada">
												</div>
												<div class="form-group">
													<label for="zmiana">Zmiana</label>
													<input id="zmiana" type="text" name="zmiana" class="form-control" placeholder="Zmiana">
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
													<label for="rozpoczecia">Godzina Rozpoczęcia</label>
													<input id="rozpoczecia" type="text" name="rozpoczecia" class="form-control" placeholder="Godzina Rozpoczęcia">
												</div>
												<div class="form-group">
													<label for="zakonczenie">Godzina Zakończenia</label>
													<input id="zakonczenie" type="text" name="zakonczenie" class="form-control" placeholder="Godzina Zakończenia">
												</div>
												<div class="form-group">
													<label for="miejsce">Miejsce Rozpoczęcia</label>
													<input id="miejsce" type="text" name="miejsce" class="form-control" placeholder="Miejsce Rozpoczęcia">
												</div>
											</div>
										</div>


								</div>
								<div class="col-lg-4">
										<div class="row">
											<div class="col-lg-12">
												<div class="form-group">
													<label for="pojazd">Wybierz Pojazd</label>
													<select id="pojazd" name="pojazd" class="form-control">
														<?php
															$pojazd = call("SELECT * FROM tabor");
															while ($row = mysqli_fetch_array($pojazd)):;?>
														<option value="<?php echo $row['id'];?>"><?php echo $row['marka'], ' ', $row['model'], ' #', $row['taborowy'];?></option>
														<?php endwhile;?>
													</select>
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-check mb-3">
													<input class="form-check-input" type="checkbox" value="1" name="kzw">
													<label class="form-check-label">KZW</label>
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-check mb-3">
													<input class="form-check-input" type="checkbox" value="1" name="rezerwa">
													<label class="form-check-label">Rezerwa</label>
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-check mb-3">
													<input class="form-check-input" type="checkbox" value="1" name="urlop">
													<label class="form-check-label">Urlop</label>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="form-group mb-3">
													<label for="uwagi">Uwagi</label>
													<textarea class="form-control" name="uwagi" id="uwagi" style="max-width: 605px;" rows="3" placeholder="Uwagi"></textarea>
												</div>
											</div>
										</div>
										<button type="submit" name="button_add" class="btn btn-primary">Zatwierdź</button>
										<a href="index.php?a=dyspozytornia"><button type="button" class="btn btn-primary">Powrót</button></a>
									</form>
								</div>
							</div>
						</div>

					  <!-- /.card-body -->
					</div>
					<!-- /.card -->
				<?php elseif($edytuj):?>
					<div class="card shadow mb-4">
						<div class="card-header">
							<h3 class="m-0 font-weight-bold text-primary">Edytuj wpis</h3>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-lg-4">
									<ul class="list-group list-group-unbordered mb-3">
										<?php
											$etat = row("SELECT * FROM etaty WHERE uid = ".$target['id']);
											$cos = $etat['poniedzialek'] + $etat['wtorek'] + $etat['sroda'] + $etat['czwartek'] + $etat['piatek'] + $etat['sobota'] + $etat['niedziela'];
										?>
										<li class="list-group-item">
											<b>Dzień do wpisu</b><a class="float-right"><?=$datawpisu, ' - ', $dzientygodnia;?></a>
										</li>

										<li class="list-group-item">
											<b>Nazwa uzytkownika</b><a class="float-right" style="color: <?=$role1['kolor'];?>"><?=$target['login'], ' [', $role1['kod_roli'], $target['nr_sluzbowy'],']';?></a>
										</li>
										<li class="list-group-item">
											<b>Numer służbowy</b><a class="float-right"><?=$target['nr_sluzbowy'];?></a>
										</li>
										<li class="list-group-item">
											<?php $kod = row("SELECT * FROM przewoznicy WHERE id = ".$target['guild']);?>
											<b>Kod przewoźnika</b><a class="float-right"><?=$kod['tag'];?></a>
										</li>
										<li class="list-group-item">
											<b>Etat</b><a class="float-right"><?=$cos, '/7';?></a>
										</li>
									</ul>
								</div>
								<div class="col-lg-4">
									<form action="skrypty/edit/grafik.php" method="POST">
										<div class="row">
											<div class="col-lg-6">
												<div class="form-group">
													<input type="hidden" name="data" value="<?=$data;?>">
													<input type="hidden" name="uid" value="<?=$target['id'];?>">
													<input type="hidden" name="id" value="<?=$xd['id'];?>">
													<label for="numer">Numer linii</label>
													<input id="numer" type="text" value="<?=$xd['linia'];?>" name="numer" class="form-control" placeholder="Numer Linii">
												</div>
												<div class="form-group">
													<label for="brygada">Brygada</label>
													<input id="brygada" type="number" value="<?=$xd['brygada'];?>" name="brygada" class="form-control" placeholder="Brygada">
												</div>
												<div class="form-group">
													<label for="zmiana">Zmiana</label>
													<input id="zmiana" type="text" value="<?=$xd['zmiana'];?>" name="zmiana" class="form-control" placeholder="Zmiana">
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
													<label for="rozpoczecia">Godzina rozpoczęcia</label>
													<input id="rozpoczecia" type="text" value="<?=$xd['godzina_od'];?>" name="rozpoczecia" class="form-control" placeholder="Godzina Rozpoczęcia">
												</div>
												<div class="form-group">
													<label for="zakonczenie">Godzina zakończenia</label>
													<input id="zakonczenie" type="text" value="<?=$xd['godzina_do'];?>" name="zakonczenie" class="form-control" placeholder="Godzina Zakończenia">
												</div>
												<div class="form-group">
													<label for="miejsce">Miejsce rozpoczęcia</label>
													<input id="miejsce" type="text" value="<?=$xd['miejsce'];?>" name="miejsce" class="form-control" placeholder="Miejsce Rozpoczęcia">
												</div>
											</div>
										</div>


								</div>
								<div class="col-lg-4">
										<div class="row">
											<div class="col-lg-12">
												<div class="form-group">
													<label for="pojazd">Wybierz Pojazd</label>
													<select id="pojazd" name="pojazd" class="form-control">
														<?php
															$pojazd = call("SELECT * FROM tabor");
															while ($row = mysqli_fetch_array($pojazd)):;?>
															<option value="<?php echo $row['id'];?>" <?php if($xd['pojazd'] == $row['id']) echo "selected";?>><?php echo $row['marka'], ' ', $row['model'], ' #', $row['taborowy'];?></option>
														<?php endwhile;?>
													</select>
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-check mb-3">
													<input class="form-check-input" type="checkbox" value="1" name="kzw" <?php if($xd['typ'] == '2') echo "checked";?>>
													<label class="form-check-label">KZW</label>
												</div>
												<div class="form-check mb-3">
													<input class="form-check-input" type="checkbox" value="1" name="zwykly" <?php if($xd['typ'] == '1') echo "checked";?>>
													<label class="form-check-label">Zwykła Służba</label>
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-check mb-3">
													<input class="form-check-input" type="checkbox" value="1" name="rezerwa" <?php if($xd['typ'] == '6') echo "checked";?>>
													<label class="form-check-label">Rezerwa</label>
												</div>
												<div class="form-check mb-3">
													<input class="form-check-input" type="checkbox" value="1" name="anuluj">
													<label for="uwagi">Anuluj Kurs</label>
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-check mb-3">
													<input class="form-check-input" type="checkbox" value="1" name="urlop" <?php if($xd['typ'] == '4') echo "checked";?>>
													<label class="form-check-label">Urlop</label>
												</div>
											<div>
										</div>
										<button type="submit" name="button_edit" class="btn btn-primary">Zatwierdź</button>
										<a href="index.php?a=dyspozytornia&driver=<?=$target['id'];?>"><button type="button" class="btn btn-primary">Powrót</button></a>
									</form>
								</div>
							</div>
						</div>

					  <!-- /.card-body -->
					</div>
					<!-- /.card -->
				<?php endif;?>
			</div>
			<!-- /.row -->
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->


	<link href='https://use.fontawesome.com/releases/v5.0.6/css/all.css' rel='stylesheet'>
	<link href='./dist/lib/main.css' rel='stylesheet' />
	<script src='./dist/lib/main.js'></script>
	<script src='./dist/js/theme-chooser.js'></script>
