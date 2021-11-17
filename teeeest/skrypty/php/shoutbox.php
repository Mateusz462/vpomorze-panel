<?php
	if(isset($_GET['aboutYou'])){
		$dev =  array(
					"valueINT" => "0", 
					"valueTEXT" => "naurrrrrrrra"
				);
		
		$ar = array(
				"pshoutboxhide" => "0", 
				"pshoutboxblockuser" => "0", 
				"blocksb" => "0", 
				"blockReason" => "", 
				"id" => '1407',
				"devmode" => json_encode($dev)
				
			);
		print_r(json_encode($ar));
		
	} elseif(isset($_GET['update'])) {	
		$ar = array(
				"quantity" => "1", 
				"messages" => array ([
					"action" => "add", 
					"uid" => "767",
					"mid" => "9447",
					"user" => "masterofsale",
					"code" => "TK-119",
					"date" => "31.05.2021 15:56",
					"message" => "a ja sobie cierpliwie poczekam",
					"blocked" => "0",
					"accepted" => "1",
					"userBlocked" => "0",
					"color" => "#0f3bac"
				])				
			);
		print_r(json_encode($ar));
	} else {
		
		$ar = array(
				"quantity" => "1", 
				"messages" => array ([
					"action" => "add", 
					"uid" => "767",
					"mid" => "9447",
					"user" => "masterofsale",
					"code" => "TK-119",
					"date" => "31.05.2021 15:56",
					"message" => "a ja sobie cierpliwie poczekam",
					"blocked" => "0",
					"accepted" => "1",
					"userBlocked" => "0",
					"color" => "#0f3bac"
				])				
			);
		print_r(json_encode($ar));
	}
/* <div id="sb-options-9488" class="mdl-cell mdl-cell--2-col sb-options-1407 sb-options" style="padding: 5px; border-bottom: 0.2px solid lightgrey;"><div class="mdl-tooltip mdl-tooltip--large" for="block 90022144">Zabierz użytkownikowi uprawnienia do pisania</div><button style="float: right;" id="block 90022144" data-uid="1407" class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored sb-block-btn sb-block-btn-uid-1407"><i class="material-icons">block</i></button>
<div class="mdl-tooltip mdl-tooltip--large" for="hide 90022144">Ukryj tą wiadomość</div><button style="float: right;" data-mid="9488" class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored sb-hide-btn sb-hide-btn-mid-9488"><i class="material-icons">visibility_off</i></button>
<div style="clear: both;"></div></div> */

?>