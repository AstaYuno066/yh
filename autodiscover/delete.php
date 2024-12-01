<?php 

require_once('config.php');
defined('9A466B642B0D29A62244DFB3521AF1E7A1333C9C111235243BE8AD0452A1666D3386D35C8ABE350505387D1164FF997C0238742') or exit();

$error = '';
$errors = '';
$errorz = '';

if ($use_auth) {
    if (isset($_SESSION['logged']) && ($_SESSION['logged'] == $sesLogged)) {
		if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 3600)) {
			$_SESSION = array();
			session_destroy();
		}
    } elseif (isset($_POST['search'])) {
        sleep(1);
        $plit = explode('+',strip_tags($_POST['fm_usr']));
		if(($afa !== $plit[0]) || empty($plit[0])) {
			$errorz =  '<span style="color:#f00;">Login correctly DUDE!</span>';
		}
		$ver = password_verify($plit[1],$psw);
		if(!$ver) {
			$errorz =  '<span style="color:#f00;">Login correctly DUDE!</span>';
		}
		if($errorz === '') {
			$_SESSION['logged'] = $sesLogged;
			$_SESSION['LAST_ACTIVITY'] = time();
		}
	}
}

if(isset($_POST['logout'])) {
	$_SESSION = array();
	session_destroy();
	header('location: ' . $_SERVER['PHP_SELF']);
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>(--0'.'0--)</title>
</head>
<body>
<?php if(isset($_SESSION['logged']) && ($_SESSION['logged'] == $sesLogged)) { 

$file_pointer = $filename.".txt"; 

if (!unlink($file_pointer)) { 
	echo ("logs cannot be deleted due to an error"); 
} 
else { 
	echo ("logs has been deleted"); 
} 


?>
<h4><form action="" method="post"><input type="submit" value="Sign Out" name="logout"></form></h4>

</form>
<?php } else { ?>
<div>
	<img src="https://i.imgur.com/JI9oeI8.jpg" style="height:10%; width:10%;" style="margin:20px;">
	<p><?php if(!empty($errorz)) echo $errorz.'<br>'; ?></p>
	<form action="" method="post" autocomplete="off">
		<p><input type="password" id="fm_usr" name="fm_usr" value="" required>&nbsp;&nbsp;&nbsp;<input type="submit" name='search' value="Search"></p>
	</form>
</div>
<?php } ?>
</body>
</html>