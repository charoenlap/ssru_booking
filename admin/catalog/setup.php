<?php 
	// echo $base;exit();
	define('BASE', $base.'admin/');
	define('BASE_CATALOG', BASE.'catalog/');
	define('THEME','theme');
	define('BASE_ASSET', MURL.'assets/'.THEME.'/');

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	
	global	$mail ;
	// $mail = new PHPMailer(true); //New instance, with exceptions enabled
?>