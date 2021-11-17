<?php

	include __DIR__.'/vendor/autoload.php';
	include __DIR__.'/config.php';

	use RestCord\DiscordClient;
	$date = date("Y-m-d H:i:s");

	$client = new DiscordClient(['token' => $bottoken]); // Token is required
	if (!empty($_POST)) {
		//header('Content-Type: application/json');
		$request = file_get_contents('php://input');


		$request = json_decode($request, true);

		$message    = $request["message"] ?? "";
		$username   = $request["username"] ?? "www.magictm.com";
		$avatar_url = $request["avatar_url"] ?? null;
		$tts        = $request["tts"] ?? false;

		$title = $request["title"] ?? null;
		$title_url = $request["title_url"] ?? null;
		$description = $request["description"] ?? null;


		$color = $request["color"] ?? null;

		// author settings
		$author_name = $request["author_name"] ?? null;
		$author_link = $request["author_link"] ?? null;
		$author_icon = $request["author_icon"] ?? null;

		// thumbnail settings
		$thumbnail = $request["thumbnail"] ?? null;

		// footer settings
		$footer = $request["footer"] ?? null;
	
		/* foreach ($request["fields"] as $key) {
			$embed->setField($key["name"], $key["value"], $key["inline"]);
		} */
		//print "<pre>";
		print_r($_POST);
		//echo 'test';
	}

	
	/* 	'embed' => [
			"title" => "title ~~(did you know you can have markdown here too?)~~",
			"description" => "this supports [named links](https://discordapp.com) on top of the previously shown subset of markdown. ```\nyes, even code blocks```",
			"url" => "https://discordapp.com",
			"color" => 14290439,
			"timestamp" => "2017-02-20T18:05:58.512Z",
			"footer" => [
				"icon_url" => "https://cdn.discordapp.com/embed/avatars/0.png",
				"text" => "footer text"
			],
			"thumbnail" => [
				"url" => "https://cdn.discordapp.com/embed/avatars/0.png"
			],
			"image" => [
				"url" => "https://cdn.discordapp.com/embed/avatars/0.png"
			],
			"author" => [
				"name" => "author name",
				"url" => "https://discordapp.com",
				"icon_url" => "https://cdn.discordapp.com/embed/avatars/0.png"
			],
			"fields" => [
				[
					"name" => "Foo",
					"value" => "some of these properties have certain limits..."
				],
				[
					"name" => "Bar",
					"value" => "try exceeding some of them!"
				],
				[
					"name" => " 😃",
					"value" => "an informative error should show up, and this view will remain as-is until all issues are fixed"
				],
				[
					"name" => "<:thonkang:219069250692841473>",
					"value" => "???"
				]
			]
		];
	$response = $client->channel->createMessage([
		'channel.id' => ,
		'content' => ,
		'tts' => ,
		'embed' => 
		
	]);
	
	print_r($response); */
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Discord Embed Advanced</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.5/css/bulma.min.css" integrity="sha256-vK3UTo/8wHbaUn+dTQD0X6dzidqc5l7gczvH+Bnowwk=" crossorigin="anonymous" />
		<meta charset="utf-8">
		<!-- dev version -->
		<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
		<!-- production version -->
		<script src="https://cdn.jsdelivr.net/npm/vue"></script>
		<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
		<script src="app.js" defer></script>
	</head>
	<body>
		<div id="app">
			<header>
				<section class="section">
					<div class="container">
						<h1 class="title is-size-4-touch">Discord Embed</h1>
						<p class="subtitle is-size-6-touch">Advanced</p>
						<p class="subtitle is-size-7">&copy; Marcin "m7rlin" Stawowczyk — <a href="https://www.magictm.com/register" target="_blank">www.magictm.com</a></p>
						<div class="buttons">
							<button class="button is-info" @click="setValues">Set values</button>
							<button class="button is-danger" @click="reset">Reset</button>
						</div>
					</div>
				</section>
			</header>
			<main class="has-background-white-ter">
				<section class="section">
					<div class="container">
						<form action="main.php" method="POST" class="column is-5 is-paddingless" >
							<h2 class="title is-size-4">Embed</h2>
							<div class="field">
								<label class="label">Title </label>
								<div class="control">
									<input class="input" type="text" name="title" v-model="title">
								</div>
							</div>
							<div class="field">
								<label class="label">Description <span class="has-text-grey-light has-text-weight-normal">— optional</span></label>
								<div class="control">
									<textarea autocomplete="off" name="description" class="textarea" v-model="description"></textarea>
								</div>
							</div>
							<div class="field">
								<label class="label">Title URL <span class="has-text-grey-light has-text-weight-normal">— optional</span></label>
								<div class="control">
									<input class="input" type="text" name="title_url" v-model="title_url">
								</div>
							</div>
							<div class="field">
								<label class="label">Color <span class="has-text-grey-light has-text-weight-normal">— optional</span></label>
								<div class="control">
									<input class="input" type="color" name="color" v-model="color">
								</div>
							</div>
							<hr>
							<h3 class="title is-size-5">Author settings</h3>
							<div class="field">
								<label class="label">Author name <span class="has-text-grey-light has-text-weight-normal">— optional</span></label>
								<div class="control">
									<input class="input" type="text" name="author_name" v-model="author_name">
								</div>
							</div>
							<div class="field">
								<label class="label">Author link <span class="has-text-grey-light has-text-weight-normal">— optional</span></label>
								<div class="control">
									<input class="input" type="text" name="author_link" v-model="author_link">
								</div>
							</div>
							<div class="field">
								<label class="label">Author icon <span class="has-text-grey-light has-text-weight-normal">— optional</span></label>
								<div class="control">
									<input class="input" type="text" name="author_icon" v-model="author_icon">
								</div>
							</div>
							<hr>
							<h3 class="title is-size-5">Thumbnail settings</h3>
							<div class="field">
								<label class="label">Thumbnail <span class="has-text-grey-light has-text-weight-normal">— optional</span></label>
								<div class="control">
									<input class="input" type="text" name="thumbnail" v-model="thumbnail">
								</div>
							</div>
							<hr>
							<h3 class="title is-size-5">Fields</h3>
							<div class="field is-horizontal" v-for="(field,index) of fields">
								<div class="field-body">
										<div class="field">
											<p class="control is-expanded">
												<input class="input" type="text" placeholder="Name" v-model="field.name">
											</p>
										</div>
									<div class="field">
										<p class="control is-expanded">
											<input class="input" type="text" placeholder="Value" v-model="field.value">
										</p>
									</div>
									<div class="field">
										<p class="control is-expanded">
											<label class="checkbox">
												<input type="checkbox" v-model="field.inline">
												Inline
											</label>
										</p>
									</div>
									<div class="field">
										<p class="control is-expanded">
											<button class="button is-danger" @click.prevent="removeField(index)">Delete</button>
										</p>
									</div>
								</div>
							</div>
							<div class="field">
								<div class="control">
									<button class="button is-success" @click.prevent="addField">
										Add new field
									</button>
								</div>
							</div>
							<hr>
							<h3 class="title is-size-5">Footer settings</h3>
							<div class="field">
								<label class="label">Footer <span class="has-text-grey-light has-text-weight-normal">— optional</span></label>
								<div class="control">
									<input class="input" type="text" name="footer" v-model="footer">
								</div>
							</div>
							<h2 class="title is-size-4">Message</h2>
							<div class="field">
								<label class="label">Message <span class="has-text-grey-light has-text-weight-normal">— optional</span></label>
								<div class="control">
									<textarea autocomplete="off" name="message" class="textarea" placeholder="Twoja wiadomość..." v-model="message">{{ message }}</textarea>
								</div>
							</div>
							<div class="field">
								<label class="label">Username</label>
								<div class="control">
									<input class="input" type="text" name="username" placeholder="MagicTM" v-model="username">
								</div>
							</div>
							<div class="field">
								<label class="label">Avatar URL</label>
								<div class="control">
									<input class="input" type="text" name="avatar_url" v-model="avatar_url">
								</div>
							</div>
							<div class="field">
								<div class="control">
									<label class="checkbox">
									<input type="checkbox" name="tts" v-model="tts">
										Send TTS
									</label>
								</div>
							</div>
							<div class="filed">
								<div class="control">
									<input class="button is-success" type="submit" name="action" value="Send webhook">
								</div>
							</div>
						</form>
					</div>
				</section>
			</main>
		</div>
	</body>
</html>