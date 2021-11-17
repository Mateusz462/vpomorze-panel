<?php

include __DIR__.'/vendor/autoload.php';
include __DIR__.'/config.php';

use RestCord\DiscordClient;



	$client = new DiscordClient(['token' => $bottoken]); // Token is required
	print "<pre>";
	
	
	//echo "Dołączanie na serwer...<br><br>";
 	/* $result = $client->guild->addGuildMember([
		'guild.id' => 844148787832553472,
		'user.id' => 473562196752990218
		//'nick' => '[ Rekrutent ]'
	]); */
	//$result = $client->user->getCurrentUserGuilds();
	//print_r($result);

	//$result = $client->guild->getGuild(['guild.id' => 645582261378613249]);
	//print_r($result);
	//$cos = $client->user->getUser(['user.id' => 811692970452844554]);
	//print_r($cos);
	//$date = date("Y-m-d H:i:s");

/*  	$result = $client->channel->createMessage([
		'channel.id' => 804331488295256064,
		'content' => '<@794216471013883974>',
		'embed' => [
			"author" => [
				"name" => "Złożono wniosek o urlop",
				"url" => "",
				"icon_url" => "https://cdn.discordapp.com/emojis/732618937446957096.png?v=1"
			],
			"description" => "
				» Osoba: **[A-004] mateusz**
				» Typ: **Wniosek o Urlop**
				» Data rozpoczęcia urlopu: **13.14.2012**
				» Data zakończenia urlopu: **15.14.2012**
				» Powód: **elo**
			",
			"color" => hexdec('#f6c23e'),
			"footer" => [
				"icon_url" => "https://cdn.discordapp.com/icons/645582261378613249/5d0deaffdc5531a405583b16f823d928.png?size=128",
				"text" => "Powiadomienie z panelu!"
			],
			"timestamp" => $date
		]
	]); */
	/* $result = $client->guild->removeGuildMember([
		'guild.id' => 645582261378613249,
		'user.id' => 735848665956089893

	]); */
//792198728
	/* $client->guild->addGuildMemberRole([
		'guild.id' => 645582261378613249,
		'user.id' => 799610927141224458,
		'role.id' => 723434411810619442
	]); */
	$client->guild->removeGuildMemberRole([
		'guild.id' => 645582261378613249,
		'user.id' => 467020104555560972,
		'role.id' => 645586452406861824
	]);
	
	
 	$user = $client->guild->listGuildMembers([
		'guild.id' => 645582261378613249,
		'limit' => 1000,
		//'after' => 1
	]);
	$role = $client->guild->getGuildRoles([
		'guild.id' => 645582261378613249
	]);
	$channel = $client->guild->getGuildChannels([
		'guild.id' => 893903220529827900,
		'type' => 2
	]);
    $guild = $client->guild->getGuild(['guild.id' => 645582261378613249]);

	print "<pre>";
	$user = json_decode(json_encode($user), true);
	$role = json_decode(json_encode($role), true);
	$channel = json_decode(json_encode($channel), true);
	$guild = json_decode(json_encode($guild), true);


	$user_filter = array_filter($user, function($it){
		return $it['user']['bot'] == 0;

	});
	$role_filter = array_filter($role, function($r){
		return $r['hoist'] == 1;
	});
	$channel_filter = array_filter($channel, function($it){
		return $it['type'] == 0;
	});
	$guild_filter = array_filter($guild, function($it){
		return;
	});
	//print_r($filter2);
	//print_r($user_filter);
	//echo $guild['name'];
	/* foreach($guild_filter as $item){
		echo $item[1];
	} */
	//$client->emoji->listGuildEmojis(

	/* $elo = $client->user->getUser([
		'user.id' => 467020104555560972
	]); */
	print "<pre>";
	/* $result1 = $client->guild->addGuildMemberRole([
		'guild.id' => 645582261378613249,
		'user.id' => 467020104555560972,
		'role.id' => 845609655517446164
	]);

	$response = $client->channel->createMessage([
		'channel.id' => 766747007511035935,
		'embed' => [
			"title" => "Trello Instrukcja Obsługi",
			"description" => "Trello to nic innego, jak rozbudowana wirtualna tablica, na której możemy przyklejać listy z nowymi zadaniami. Pod każdą listą możemy dodawać karty, w których określamy w dowolny sposób zadania i przypisujemy do nich kolejnych użytkowników. Karty te oferują proste funkcje, jak określenie tematu i jego opis, możemy też dodawać zadania, etykiety, komentarze czy pliki z naszego komputera.",
			"color" => 14290439,
			"timestamp" => $date,
			"footer" => [
				"text" => "Troszkę się rozpisaem :-). Wiem że się powtarzam, ale jednak proponuje skorzystać z tej opcji, oczywiście jak nie chcecie z tego korzystać, coś się nie podoba, coś zmienić to mi `napiszcie` :-) nie będę nalegał"
			],
			"thumbnail" => [
				"url" => "http://allvectorlogo.com/img/2019/04/trello-logo.png"
			],
			"fields" => [
				[
					"name" => "Jak korzystać z Trello?",
					"value" => "Trello składa się z czterech podstawowych elementów, które oferują nieograniczone możliwości:",

				],
				[
					"name" => "1.Tablice",
					"value" => "Tablice reprezentują projekt lub miejsce, w którym można śledzić wszystkie informacje. Niezależnie od tego, czy uruchamiasz nową stronę internetową, czy planujesz wakacje, tablica Trello jest miejscem, w którym możesz porządkować zadania oraz współpracować ze znajomymi, rodziną i przyjaciółmi.",
					//"inline" => true
				],
				[
					"name" => "2.Listy",
					"value" => "Listy umożliwiają porządkowanie kart (C) według różnych etapów postępu prac. Można ich używać do planowania toku pracy, w którym karty od początku do końca mogą być przenoszone z jednej listy na drugą lub można je wykorzystać do gromadzenia pomysłów i śledzenia informacji.",
					//"inline" => true
				],
				[
					"name" => "3.Karty",
					"value" => "Karty są podstawowymi jednostkami tablicy. Wykorzystuje się je do prezentacji zadań i pomysłów. Na kartach mogą się znajdować zadania do zrobienia, np. naprawić zjebane AI, zmienić streownik w Mercedesie itd. Kliknij „Dodaj kartę” na dole dowolnej listy, aby utworzyć nową kartę i nadaj jej nazwę.",
					//"inline" => true
				],
				[
					"name" => "4.Menu",
					"value" => "Po prawej stronie tablicy Trello znajduje się menu — centrum zarządzania tablicą. Służy ono do zarządzania członkami, modyfikowania ustawień, filtrowania kart oraz włączania dodatków Power-Up. Dzięki kanałowi aktywności możesz obserwować wszystkie działania na tablicy.",
				],
				[
					"name" => "Nasze Tablice",
					"value" => "Każdy dział ma swoją tablicę w której znajduje się 6 list, każda jest opisana co powinno się w niej znajdować.",
				],
				[
					"name" => "Korzystanie z list",
					"value" => "**W Pierwszej liście** `Zaległości w pracy`, znajdują się zadania/rzeczy które zakładamy je wykonać, \n **Drugiej liście** `Projekt` projektujemy/planujemy jak dane zadanie/rzecz ma wyglądać, \n **Trzecia lista** `Do zrobienia` jest do zadań/rzeczy które zaprojektowaliśmy i które jesteśmy pewnii że je wykonamy, \n **Na Czwartej liście** `W trakcie` znajdują się zadania/rzeczy nad którymi pracujemy, \n **W Piątej liście** `Testowanie` są zadania/rzeczy które są testowane, \n **Ostatnia lista Piąta** `Zrobione` trafiają tutaj wszystkie zadania które sukcesywnie wykonawaliśmy w poprzednich etapach.",
				],
				[
					"name" => "Linki do widoku Tablic",
					"value" => "To są linki do **widoku** poszczególnych tablic \n\n **Dyspozytornia** link https://trello.com/b/WHfwPZph/dyspozytornia \n\n **Kadry** link https://trello.com/b/Ok7COsdo/kadry \n\n  **Mapa** link https://trello.com/b/or1cNLQH/mapa \n\n **Nadzór Ruchu** link https://trello.com/b/3pKb6MRG/nadzór-ruchu \n\n **Panel vpomorze** link https://trello.com/b/64JDe1K4/panel-vpomorze \n\n **Wirtualne Pomorze (Ogólna Tablica)** link https://trello.com/b/I27Qj6jP/wirtualne-pomorze-ogólna-tablica \n\n **Zaplecze Techniczne** link https://trello.com/b/Sep8MTNE/zaplecze-techniczne \n\n ",
				]
			]
		]
	]);
	*/
	//Wiem że się powtarzam, ale jednak proponuje skorzystać z tej opcji, oczywiście jak nie chcecie z tego korzystać, coś się nie podoba, coś zmienić to mi `napiszcie` :-) nie będę nalegał

	//''
	// $response = $client->channel->createMessage([
	// 	'channel.id' => 751905657963151570,
	// 	'content' => '',
	// 	'embed' => [
	// 		"title" => "",
	// 		"description" => "",
	// 		"timestamp" => "",
	// 		"footer" => [
	// 			"text" => ""
	// 		],
	// 		"thumbnail" => [
	// 			"url" => ""
	// 		]
	// 	]
	// ]);

	/* $response = $client->channel->createMessage([
		'channel.id' => 793476074281500672,
		'content' => ':-)'
	]); */
 	/*$elo = $client->guild->createGuildRole([
		'guild.id' => 645582261378613249,
		'name' => 'REMEK KURWA ZMIEń MI UPRAWNIENIA NA DC żEBYM NIE MUSIAł ROBIC NOWYCH RANG',
		'permissions' => 8589934591
	]); */

	//print_r($elo);
	print_r(
		$message = $client->channel->getChannelMessage([
			'channel.id' => 875476547312681102,
			'message.id' => 906619418572906618,
		])
	);
	

	//print_r($elo);



	/* $result = $client->channel->createMessage([
		'channel.id' => 846021678899003392,
		'content' => 'sam wypierdalaj <@486233141875441664>'
	]); */
	
	/**
     * @param Message $message
     * @param string $content
     */
    function sendDM($message, $content){
        try {
            $channel = $client->user->createDm(
                [
                    'recipient_id' => $message->getAuthorId(),
                ]
            );
            $message->discord->channel->createMessage(
                [
                    'channel.id' => $channel->id,
                    'content'    => $content,
                ]
            );
        } catch (\Exception $e) {
            echo "Failed to error message {$message->getAuthor()} {$e->getMessage()}".PHP_EOL;
        }
        sleep(1);
    }
	
	
	/* $message = [
		'author.id' => 467020104555560972
	]; */
	sendDM($message, 'elo');
?>

	<form action="" method="POST">
		<div class="row">
			<div class="col-md-12 mb-6">
				<div class="form-group">
					<label for="kanal">Kanał</label>
					<select id="kanal" name="kanal" class="form-control">
						<option selected="" disabled="">--- Wybierz ---</option>
						<?php foreach($channel_filter as $item):?>
						<option value="<?=$item['id'];?>"><?=$item['name'];?></option>
						<?php endforeach;?>
					</select>
				</div>
			</div>
			<div class="col-md-12 mb-6">
				<div class="form-group">
					<label for="Osoba">Osoba</label>
					<select id="Osoba" name="Osoba" class="form-control">
						<option selected="" disabled="">--- Wybierz ---</option>
						<?php foreach($user_filter as $item):?>
						<?php//,'#',$item['user']['discriminator'];?>
						<option value="<?=$item['user']['id'];?>"><?=$item['nick'];?></option>
						<?php endforeach;?>
					</select>
				</div>
			</div>
			<div class="col-md-12 mb-6">
				<div class="form-group">
					<label for="Ranga">Ranga</label>
					<select id="Ranga" name="Ranga" class="form-control">
						<option selected="" disabled="">--- Wybierz ---</option>
						<?php foreach($role_filter as $item):?>
						<?php//,'#',$item['user']['discriminator'];?>
						<option value="<?=$item['id'];?>" style="color: #<?=dechex($item['color']);?>; <?php if(dechex($item['color']) == 'ffffff'){ echo 'background-color: #000';} else { } ?>"><?=$item['name'];?></option>
						<?php endforeach;?>
					</select>
				</div>
			</div>
			<div class="col-md-12 mb-6">
				<div class="form-group">
					<label for="Text">Text</label>
					<input id="Text" type="text" name="text" class="form-control">
				</div>
			</div>
			<div class="col-md-12 mb-6">
				<div class="form-group">
					<button type="submit" name="action" class="btn btn-primary">Zatwierdź</button>
				</div>
			</div>
		</div>
	</form>
<?php
	if (!empty($_POST)) {
		if (empty($_POST['kanal']) || empty($_POST['text'])){
			throwInfo('danger', 'wypelnij wszystkie pola', true);
		}else {
			$kanal = $_POST['kanal'];
			//$Osoba = '<@'.$_POST['Osoba'].'>';
			//$Ranga = '<@&'.$_POST['Ranga'].'>';
			$text = $_POST['text'];
			$result = $client->channel->createMessage([
				'channel.id' => intval($kanal),
				'content' => $text
			]);
			throwInfo('success', 'wyslano', true);
		}
	}
?>
