<?php include ('config/config.php') ?>
<?php include ('php/objects/_database.php') ?>

<?php

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
		echo 0;
	}
}

function validate($captcha_response){
	if(!$captcha_response){//response is missing
		die("captcha response missing.");
	}else{//response is there but not validated
		$response=json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LcCGlIUAAAAAHu_SVnZ4AxiMQ5drt-pWNC_B45I&response=".$_POST['g-recaptcha-response']."&remoteip=".$_SERVER['REMOTE_ADDR']), true);
		if($response['success'] == false){//response is false
			return 0;
		}else{//response is valid
			setcookie("reCAPTCHA", true, time()+3600);
			return 1;
		}
	}
	return 0;
}
?>