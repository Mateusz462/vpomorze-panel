<?php
    include __DIR__.'/vendor/autoload.php';
    include __DIR__.'/config.php';

    use RestCord\DiscordClient;


    $ch = '893905792175079425';
	$client = new DiscordClient(['token' => $bottoken]); // Token is required
    // $client->channel->createMessage([
	// 	'channel.id' => intval($ch),
	// 	'content' => '',
    //     'embed' => [
	// 		"author" => [
	// 			"name" => "Quiz o Polsce",
	// 			"url" => "",
	// 			"icon_url" => ""
	// 		],
    //         "title" => "Spis Kategori:",
    //         "description" => "
    //         1. Historia
    //         2. Muzyka?
    //         3. Kultura?
    //         4. Inne?
    //         ",
	// 		"color" => hexdec('#7bd224'),
	// 		"footer" => [
	// 			"icon_url" => "https://cdn.discordapp.com/avatars/467020104555560972/bd6ccc87b044054dc58cd8778d29d5d1.png",
	// 			"text" => "[PA-003] mateusz"
	// 		]
	// 	]
    //
	// ]);

    /* $client->channel->createMessage([
		'channel.id' => intval($ch),
		'content' => '',
        'embed' => [
			"author" => [
				"name" => "Quiz o Polsce",
				"url" => "",
				"icon_url" => ""
			],
            "title" => "
            Pytanie nr: 1
Kategoria: Historia
            ",
			"description" => "
				W bitwie pod Legnicą w 1241 r. książę ślązki Henryk II Pobożny podniósł klęskę z:
			",
            "fields" => [
				[
					"name" => "Odpowiedź A:",
					"value" => "Mongołami",
                    "inline" => "true"
				],
				[
					"name" => "Odpowiedź B:",
					"value" => "Niemcami",
                    "inline" => "true"
				],
				[
					"name" => "Odpowiedź C:",
					"value" => "Czechami",
                    "inline" => "true"
				]
			],
			"color" => hexdec('#a70224'),
			"footer" => [
				"icon_url" => "https://cdn.discordapp.com/avatars/467020104555560972/bd6ccc87b044054dc58cd8778d29d5d1.png",
				"text" => "[PA-003] mateusz"
			]
		]

	]); */

    $client->channel->createMessage([
		'channel.id' => 893906278290706432,
		'content' => '<@813832670185914419>',
        'embed' => [
            "title" => "
            Wiem o tobie więcej niż ty o mnie
            ",
			"description" => "
				Michal Papież Latala
				Grasz na klarnecie
				Chodzisz do muzyka
				Co chcesz wiedziedz więcej?
			",
			"color" => hexdec('#a70224'),
			"footer" => [
				"icon_url" => "https://wirtualne-pomorze.pl/portal/img/WP-logo250.png",
				"text" => "wirtualne-pomorze.pl"
			]
		]

	]);
	/* print "<pre>";
	print_r($client->guild->getGuildRoles(['guild.id' => 893903220529827900]));
	$client->guild->removeGuildMemberRole([
		'guild.id' => 893903220529827900,
		'user.id' => 809136715918213170,
		'role.id' => 893906463330816030
	]); */


// $client->channel->createMessage([
// 		'channel.id' => intval($ch),
// 		'content' => ':sadge:'
// 	]);
