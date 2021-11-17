<?php
    //require_once('connect.php');
    //require_once('function.php');

    // function _open(){
		// global $_sess_db;
		// /* $db_user = "hcxeyhrwp";
		// $db_pass = "238Rembek";
		// $db_host = 'hcxeyhrwp.mysql.db';
		// $db_name = "hcxeyhrwp"; */
		// $db_user = "root";
		// $db_pass = "";
		// $db_host = 'localhost';
		// $db_name = "hcxeyhrwp";
        // if ($_sess_db = @new mysqli($db_host, $db_user, $db_pass, $db_name)){
           // return mysqli_select_db($_sess_db, );
			
        // }
		// return false;
	// }

    // function _close(){
        // global $_sess_db;
        // return false; //mysqli_close($_sess_db);
    // }

    // function _read($id){
        // global $_sess_db;
        // $id = mysqli_real_escape_string($_sess_db, $id);
        // $sql = "SELECT data FROM sessions WHERE id = '$id'";
        // if ($result = mysqli_query($_sess_db, $sql)){
            // if (mysqli_num_rows($result)) {
                // $record = mysqli_fetch_assoc($result);
                // return $record['data'];
            // }
        // }
        // return '';
    // }

    // function _write($id, $data){
          // global $_sess_db;
          // $access = time();
          // $id = mysqli_real_escape_string($_sess_db, $id);
          // $access = mysqli_real_escape_string($_sess_db, $access);
          // $data = mysqli_real_escape_string($_sess_db, $data);
          // $sql = "REPLACE  INTO sessions  VALUES ('$id', '$access', '$data')";
          // mysqli_query($_sess_db, $sql);
          // return true;
      // }

    // function _destroy($id){
        // global $_sess_db;
        // $id = mysqli_real_escape_string($_sess_db, $id);
        // $sql = "DELETE FROM sessions WHERE id = '$id'";
        // mysqli_query($_sess_db, $sql);
        // return true;
    // }

    // function _clean($max) {
        // global $_sess_db;
        // require_once '../panel/funkcje/IP-user.php';
        // if(!empty($_SESSION['id'])){
            // $user = getUser($_SESSION['id']);
            // $get_ip = UserInfo::get_ip();
            // $get_os = UserInfo::get_os();
            // $get_browser = UserInfo::get_browser();
            // $get_device = UserInfo::get_device();
            // $dataczegos = mktime(date('H'), date('i'), date('s'), date('m'), date('d'), date('Y'));
            // $log = call("INSERT INTO logi_logowania (uid, akcja, data, get_ip, get_os, get_browser, get_device) VALUES ('".$user['id']."', '[SYSTEM] Wylogowanie z Panelu', '".$dataczegos."', '".$get_ip."', '".$get_os."', '".$get_browser."', '".$get_device."')");
        // }
        // $old = time() - $max;
        // $old = mysqli_real_escape_string($_sess_db, $old);
        // $sql = "DELETE FROM sessions WHERE access < '$old'";
        // mysqli_query($_sess_db, $sql);
    // }
?>
