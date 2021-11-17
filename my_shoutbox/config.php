<?php
/*
* Usama Ejaz
* thedeveloper24.com
* osamaejaz1[at]gmail.com
*/

session_start();

#############################################################################

######## Base URL where the script is installed or files are present ########
$base_url="";


######## Username for Admin Panel (admin.php) ########
$admin_username="admin";

######## Password for Admin Panel ########
$admin_password="t00r";


######## MySQL Hostname (usually localhost) ########
$host="localhost";

######## DB Username ########
$username="root";

######## DB Password ########
$password="";

######## DB NAME ########
$db_name="srv30507_panel";

######## DB TABLE NAME ########
/* TABLE NAME */
$tbl3="my_shoutbox"; 

#############################################################################


$con = mysqli_connect("$host", "$username", "$password", "$db_name");
//mysql_select_db();
$con->set_charset("utf8");
//mysqli_set_charset("utf8") or error_log(mysql_error()); 
mysqli_query($con, "SET character_set_client = utf8, character_set_connection = utf8, character_set_database = utf8, character_set_filesystem = binary, character_set_results = utf8, character_set_server = latin1") or error_log(mysqli_error()); 
function clean($str){
	global $con;
	return mysqli_real_escape_string($con, $str);
}


?>