<?php
    require_once('./API/vendor/autoload.php');
    require_once('./API/config.php');

    use RestCord\DiscordClient;

    function discord_rebember($id){
        $user = getUser($id);
        if($user['stanowisko'] != 21 && $user['dc'] == 0 || $user['stanowisko'] != 22 && $user['dc'] == 0){
            throwInfo('info', 'Wygląda na to że nie masz połączonego konta discord z panelem! Aby to zrobić przejdź do <b>ustawień użytkownika!</b> Możesz to zrobić klikając <a href="https://wirtualne-pomorze.pl/panel/index.php?a=ustawienia-użytkownika">TUTAJ</a>', false);
        }
    }

    function discord_powiadomienia_config($data,  $osoba, $uwagi){
        $timestamp = date("Y-m-d H:i:s");
		if($data == 'wnioski'){
            switch($typ){
				case '1' :
                    $name = 'Złożono wniosek o zmianę etatu';
                    $tytul = 'Wniosek o zmianę etatu';
                    $return_data['content'] = '<@&723433480956018760>';
                    $opis = '
                    » Osoba: **'.$osoba.'**
                    » Typ: **'.$tytul.'**
                    » Powód: **'.$uwagi.'**';
                break;
				case '2' :
                    $name = 'Złożono wniosek o urlop';
                    $tytul = 'Wniosek o urlop';
                    $return_data['content'] = '<@&723433480956018760>';
                    $opis = '
                    » Osoba: **'.$osoba.'**
                    » Typ: **'.$tytul.'**
                    » Data rozpoczęcia urlopu: **'.$urlop1.'**
                    » Data zakończenia urlopu: **'.$urlop2.'**
                    » Powód: **'.$uwagi.'**';
                break;
				case '3' :
                    $name = 'Złożono wniosek o zwolnienie';
                    $tytul = 'Wypowiedzenie umowy o pracę';
                    $return_data['content'] = '<@&723433480956018760>';
                    $opis = '
                    » Osoba: **'.$osoba.'**
                    » Typ: **'.$tytul.'**
                    » Powód: **'.$uwagi.'**';
                break;
				case '4' :
                    $name = 'Złożono wniosek o kurs z wolnego';
                    $tytul = 'Wniosek o kurs z wolnego';
                    $return_data['content'] = '<@&846101070785937459>';
                    $opis = '
                    » Osoba: **'.$osoba.'**
                    » Typ: **'.$tytul.'**
                    » Data Kursu: **'.$kzwf.'**
                    » Powód: **'.$uwagi.'**';
                break;
				case '5' :
                    $name = 'Złożono wniosek o stały przydział pojazdu';
                    $tytul = 'Wniosek o stały przydział pojazdu';
                    $return_data['content'] = '<@&836152523059888139>';
                    $opis = '
                    » Osoba: **'.$osoba.'**
                    » Typ: **'.$tytul.'**
                    » Pojazd: **'.$pojazd.'**
                    » Powód: **'.$uwagi.'**';
                break;
				case '6' :
                    $name = 'Złożono wniosek o nieprzydzielanie pojazdu';
                    $tytul = 'Wniosek o nieprzydzielanie pojazdu';
                    $return_data['content'] = '<@&836152523059888139>';
                    $opis = '
                    » Osoba: **'.$osoba.'**
                    » Typ: **'.$tytul.'**
                    » Powód: **'.$uwagi.'**';
                break;
			}

            $return_data['embed'] = $embed = array(
                "author" => [
                    "name" => $name,
                    "url" => "",
                    "icon_url" => "https://cdn.discordapp.com/emojis/732618937446957096.png?v=1"
                ],
                "description" => '
                    » Typ: **'.$tytul.'**
                    » Osoba: **'.$osoba.'**
                    » Powód: **'.$uwagi.'**
                ',
                "color" => hexdec('#f6c23e'),
                "footer" => [
                    "icon_url" => "https://cdn.discordapp.com/icons/645582261378613249/5d0deaffdc5531a405583b16f823d928.png?size=128",
                    "text" => "Powiadomienie z panelu!"
                ],
                "timestamp" => $timestamp
            );

		} elseif($data == 'wnioski-ocena') {

		} elseif($data == 'raport') {

		} elseif($data == 'raport-ocena') {

		} elseif($data == 'grafik') {

		}

        return $return_data;
	}

	function discord_powiadomienia_send($typ, $dane){
        global $bottoken;
        $pushchannel = '841002960695721994';
        $client = new DiscordClient(['token' => $bottoken]); // Token is required
        if($typ == 'user') {
            //print_r($dane);
            $client->channel->createMessage([
			 	'channel.id' => intval($pushchannel),
			 	'content' => $dane['content'],
			 	'embed' => $dane['embed']
			]);
		} elseif($typ == 'zarzad') {
			$client->channel->createMessage([
				'channel.id' => $pushchannel,
				'content' => '',
				'embed' => [
					"author" => [
						"name" => "Odrzucono wniosek",
						"url" => "",
						"icon_url" => "https://cdn.discordapp.com/emojis/555804212785840170.png?v=1"
					],
					"description" => '
						» Typ: **'.$tytul.'**
						» Osoba: **['.$r['kod_roli'].''.$u['nr_sluzbowy'].'] '.$u['login'].'**
						» Osoba Sprawdzająca: **['.$role['kod_roli'].''.$user['nr_sluzbowy'].'] '.$user['login'].'**
						» Powód: **'.$uwagi.'**
					',
					"color" => hexdec('#f6c23e'),
					"footer" => [
						"icon_url" => "https://cdn.discordapp.com/icons/645582261378613249/5d0deaffdc5531a405583b16f823d928.png?size=128",
						"text" => "Powiadomienie z panelu!"
					],
					"timestamp" => $timestamp
				]
			]);
		} else {

		}


	}

    function discord_send_message($typ, $channel, $message, $title, $title_url, $description, $footer){
        global $bottoken;
        $client = new DiscordClient(['token' => $bottoken]); // Token is required
        if($typ == 'embed'){
            $msg = $client->channel->createMessage([
                'channel.id' => intval($channel),
                //'content' => $message,
                'embed' => [
                    "title" => $title,
                    "url" => $title_url,
                    "description" => $description

                ]
            ]);
            if($msg){
                throwInfo('success', 'wyslano', true);
                header("Refresh:0");
            } else {
                throwInfo('danger', 'błąd', true);
                header("Refresh:0");
            }
        } elseif($typ == 'message') {
            $msg = $client->channel->createMessage([
                'channel.id' => intval($channel),
                'content' => $message
            ]);
            if($msg){
                throwInfo('success', 'wyslano', true);
                header("Refresh:0");
            } else {
                throwInfo('danger', 'błąd', true);
                header("Refresh:0");
            }
        }
    }

    function get_guild($server){
        global $bottoken;
        $client = new DiscordClient(['token' => $bottoken]); // Token is required
        $guild = $client->guild->getGuild([
            'guild.id' => intval($server)
        ]);
        return $guild = json_decode(json_encode($guild), true);
    }

    function listGuildMembers($server){
        global $bottoken;
        $client = new DiscordClient(['token' => $bottoken]); // Token is required
        $users = $client->guild->listGuildMembers([
    		'guild.id' => intval($server),
    		'limit' => 1000
    	]);
        return $users = json_decode(json_encode($users), true);
    }

    function filter_count($operator, $server){
        global $bottoken;
        $client = new DiscordClient(['token' => $bottoken]); // Token is required

        if($operator == 'users_filter_count'){
            $users = listGuildMembers($server);
            $users_filter = array_filter($users, function($it){
        		return $it['user']['bot'] == 0;
        	});

            return $users_count = count($users_filter);
        } elseif ($operator == 'roles_filter_count') {
            $roles = getGuildRoles($server);
            $roles_filter = array_filter($roles, function($r){
        		return $r['hoist'] == 1;
        	});

            return $roles_count = count($roles_filter);
        } elseif ($operator == 'channels_filter_count') {
            $channels = getGuildChannels($server);
            return $channels_count = count($channels);
        } elseif ($operator == 'channels_text_filter') {
            $channels = getGuildChannels($server);
            $channels_text_filter = array_filter($channels, function($it){
        		return $it['type'] == 0;
        	});
            return $channels_text_filter;
        } elseif ($operator == 'channels_text_filter_count') {
            $channels = getGuildChannels($server);
            $channels_text_filter = array_filter($channels, function($it){
        		return $it['type'] == 0;
        	});
            return $channels_text_count = count($channels_text_filter);
        } elseif ($operator == 'channels_voice_filter_count') {
            $channels = getGuildChannels($server);
            $channels_voice_filter = array_filter($channels, function($it){
        		return $it['type'] == 2;
        	});
            return $channels_voice_count = count($channels_voice_filter);
        } elseif ($operator == 'channels_cat_filter_count') {
            $channels = getGuildChannels($server);
            $channels_cat_filter = array_filter($channels, function($it){
        		return $it['type'] == 4;
        	});
            return $channels_cat_count = count($channels_cat_filter);
        } elseif ($operator == 'ban_count') {
            $bans = listGuildMembers($server);

            return $bans_count = count($bans);
        }
    }

    function getGuildRoles($server){
        global $bottoken;
        $client = new DiscordClient(['token' => $bottoken]); // Token is required
        $roles = $client->guild->getGuildRoles([
    		'guild.id' => intval($server)
    	]);
        return $roles = json_decode(json_encode($roles), true);
    }



    function getGuildChannels($server){
        global $bottoken;
        $client = new DiscordClient(['token' => $bottoken]); // Token is required
        $channels = $client->guild->getGuildChannels([
    		'guild.id' => intval($server)
    	]);
        return $channels = json_decode(json_encode($channels), true);
    }

    function getGuildBans($server){
        global $bottoken;
        $client = new DiscordClient(['token' => $bottoken]); // Token is required
        $bans = $client->guild->getGuildBans([
            'guild.id' => intval($server)
        ]);
        return $bans = json_decode(json_encode($bans), true);
    }

    function discord_zarzadzanie(){
        global $bottoken;
        global $server;
        $client = new DiscordClient(['token' => $bottoken]); // Token is required






        $emoji = $client->emoji->listGuildEmojis([
            'guild.id' => intval($server)
        ]);

        print "<pre>";





        $emoji = json_decode(json_encode($emoji), true);

        //users


        //roles



        $roles1_filter = array_filter($roles, function($r){
    		return $r['position'] == 23;
    	});
        $roles2_filter = array_filter($roles, function($r){
    		return $r['position'] == 1;
    	});

        //channels









        $bans_count = count($bans);
        $emoji_count = count($emoji);

        print "</pre>";
    }
?>
