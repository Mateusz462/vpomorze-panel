<?php
	function generate_pass(){
		// Konfiguracja
		$random_symbols = null;
		$config['mode'] = array(true, true, true, true); // Fajna tablica, nie?
		$config['length'] = 8;
		// Alfabet
		$letters = 'abcdefghijklmnopqrstuvwxyz';

		// Liczby
		if($config['mode'][0])
		{
			$values = '0123456789'; // Można użyć tego: implode('', range(0, 9));
		}

		// Znaki specjalne
		if($config['mode'][1])
		{
			$values .= '`~!@#$%^&*()_-=+<>?,.|\/\'";:[]{}';
		}

		// Małe litery
		if($config['mode'][2])
		{
			$values .= $letters;
		}

		// Duże litery
		if($config['mode'][3])
		{
			$values .= strtoupper($letters);
		}

		for($h = 0, $length = (strlen($values) - 1); $h < $config['length']; ++$h)
		{
			$random_symbols .= substr($values, mt_rand(0, $length), 1);
		}

		echo $random_symbols;
		
	}
	
	function generate_pass_hide($random_symbols){
		echo 'Losowe hasło na teraz brzmi: '.$random_symbols.'<br>';
		echo $hash = password_hash($random_symbols, PASSWORD_BCRYPT);
	}
	
	
	
	// Konfiguracja
		$random_symbols = null;
		$config['mode'] = array(true, true, true, true); // Fajna tablica, nie?
		$config['length'] = 8;
		// Alfabet
		$letters = 'abcdefghijklmnopqrstuvwxyz';

		// Liczby
		if($config['mode'][0])
		{
			$values = '0123456789'; // Można użyć tego: implode('', range(0, 9));
		}

		// Znaki specjalne
		if($config['mode'][1])
		{
			$values .= '`~!@#$%^&*()_-=+<>?,.|\/\'";:[]{}';
		}

		// Małe litery
		if($config['mode'][2])
		{
			$values .= $letters;
		}

		// Duże litery
		if($config['mode'][3])
		{
			$values .= strtoupper($letters);
		}

		for($h = 0, $length = (strlen($values) - 1); $h < $config['length']; ++$h)
		{
			$random_symbols .= substr($values, mt_rand(0, $length), 1);
		}

		//echo '**Twoje nowe hasło brzmi:** '.$random_symbols.'<br>';
		//echo $hash = password_hash($random_symbols, PASSWORD_BCRYPT);
?>