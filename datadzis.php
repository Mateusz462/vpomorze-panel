<?php
	echo 'dzis ', mktime(date("H"), date("i"), date("s"), date("m")  , date("d"), date("Y")), '<br>';
	echo date("H:i:s Y-m-d", mktime(date("H"), date("i"), date("s"), date("m")  , date("d"), date("Y")));
?>