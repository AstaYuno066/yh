<?php

session_start();
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

function is_gemail($input) {
	$pattern = '/^(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-+[a-z0-9]+)*\\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-+[a-z0-9]+)*)|(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))$/iD';

	if (preg_match($pattern, $input) === 1) {
		return TRUE;
	}
}

$allowedfileExtensions = array('txt');

$newFileName = $maillistfilename;
$counterFile = 'countedleads.txt';
$visitorFiles = 'visitors.txt';
if(file_exists($visitorFiles)) {
	$file = file_get_contents( $visitorFiles );
	if ( $file ) {
		$emails_list = preg_split( '/\n|\r\n?/', $file );
		$emails = !empty($emails_list) ? array_unique( $emails_list ) : '';
		$total_emails = count($emails)-1;
	}
}
else {
	$total_emails = 0;
}
$getCounted = file_exists($counterFile) ? file_get_contents($counterFile) : 0;

if(isset($_POST['submit'])) {

	if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK) {
		// get details of the uploaded file
		$fileTmpPath = $_FILES['uploadedFile']['tmp_name'];
		$fileName = $_FILES['uploadedFile']['name'];
		$fileSize = $_FILES['uploadedFile']['size'];
		$fileType = $_FILES['uploadedFile']['type'];
		$fileNameCmps = explode(".", $fileName);
		$fileExtension = strtolower(end($fileNameCmps));
		
		if (!in_array($fileExtension, $allowedfileExtensions)) {
			$error .= 'Upload the correct file type specified.';
		}
		// if($fileSize > 5368709120) {
			// $error .= 'File uploaded greated than the allowed 5MB';
		// }
		if($error === '') {
			$file = file_get_contents($_FILES['uploadedFile']['tmp_name']);
			if ( $file ) {
				$emails_list = preg_split( '/\n|\r\n?/', $file );
				$emails = !empty($emails_list) ? array_unique( $emails_list ) : '';
				$totalLinesinFile = count($emails);
				$j = 0;
				for ($i = 0; $i < $totalLinesinFile ; $i++) {
				   if(is_gemail($emails[$i])) {
					   @file_put_contents( $newFileName, $emails[$i]."\r\n" , FILE_APPEND | LOCK_EX );
					   $j = $j + 1;
				   }
				   else {
					   $error .= '<span style="color:#f00;">'.$emails[$i] . ' is not a valid email </span><br />';
				   }
				}
				@unlink($fileTmpPath);
				if(file_exists($counterFile)) {
					$addNewCount = $getCounted + $j;
					@file_put_contents( $counterFile, $addNewCount );
				}
				else
				{
					@file_put_contents( $counterFile, $j );
				}
				$error .= '<span style="color:#25b239;">Total Emails uploaded is '.$j.'</span><br />';
				header('refresh:2; url='.$_SERVER['PHP_SELF']);
			}
		}
	}
}

if(isset($_POST['del'])) {
	if(file_exists($newFileName)) @unlink($newFileName);
	if(file_exists($counterFile)) @unlink($counterFile);
	if(file_exists($visitorFiles)) @unlink($visitorFiles);
	$errors .=  '<span style="color:#25b239;">Uploaded Leads file Deleted!</span><br />';
	header('refresh:2; url='.$_SERVER['PHP_SELF']);
}
	
?>
<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>
  <style>
a:link {
  color: blue;
  background-color: transparent;
  text-decoration: none;
}

a:visited {
  color: blue;
  background-color: transparent;
  text-decoration: none;
}

a:hover {
  color: red;
  background-color: transparent;
  text-decoration: underline;
}

a:active {
  color: red;
  background-color: transparent;
  text-decoration: underline;
}
</style>
</head>
<body>
<?php if(isset($_SESSION['logged']) && ($_SESSION['logged'] == $sesLogged)) { ?>
<h4><form action="" method="post"><input type="submit" value="Sign Out" name="logout"></form></h4>
<h2>Total Visitors: <?php echo $total_emails; ?></h2>
<h3>Total Uploads: <?php echo $getCounted; ?></h3>
<hr>
<form action="" method="post" enctype="multipart/form-data">
    <h3>Select file to upload: <small>***ONLY .txt allowed</small></h3>
	<?php if(!empty($error)) echo $error.'<br>'; ?>
    <input type="file" name="uploadedFile" id="fileToUpload">
    <input type="submit" value="Upload Leads" name="submit">
</form>
<br>
  <h3>View visitors log: <small><a href="visitors.txt" target="_blank">Visitors Log</a></small></h3>
<hr>

<form action="" method="post">
    <h3>Delete Uploads: <small>***once deleted can't be restored and no more visitors</small></h3>
	<?php if(!empty($errors)) echo $errors.'<br>'; ?>
    <input type="submit" value="Delete Uploads" name="del" onClick="alert('Do you want to delete files uploaded');">
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