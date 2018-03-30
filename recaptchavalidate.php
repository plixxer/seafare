<?php include ('config/config.php') ?>
<?php include ('php/objects/_database.php') ?>

<?php
session_start();

if(!empty($_COOKIE['reCAPTCHA'])){
	if(!empty($_POST['g-recaptcha-response'])){
		echo validate($_POST['g-recaptcha-response']);
	}else{
		if($_COOKIE['reCAPTCHA'] == true){
			echo 1;
		}else{
			echo 0;
		}
	}
}else{
	if(!empty($_POST['g-recaptcha-response'])){
		echo validate($_POST['g-recaptcha-response']);
	}else{
		print_r(json_encode($_COOKIE, true));
	}
}

function validate($captcha_response){
	if(!$captcha_response){//response is missing
		die("captcha response missing.");
	}else{//response is there but not validated
		$response=json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LddnE8UAAAAAG72b2R7JQadoc7fXXRl2w7xi8g2&response=".$_POST['g-recaptcha-response']."&remoteip=".$_SERVER['REMOTE_ADDR']), true);
		if($response['success'] == false){//response is false
			return 0;
		}else{//response is valid
			$_COOKIE['reCAPTCHA'] = true;
			return 1;
		}
	}
	return 0;
}
?>

i79t8ulsa3c7b3i6jns50plqm0