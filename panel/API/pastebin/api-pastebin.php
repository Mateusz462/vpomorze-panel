<?php
    require
    if(!empty($_POST)){
        if (empty($_POST['tytul']) || empty($_POST['text'])){
			throwInfo('danger', 'wypelnij wszystkie pola', true);
		}else {
			$tytul = $_POST['tytul'];
			$text = $_POST['text'];
            pastebin_create($text, $tytul)

		}
    }


 ?>
