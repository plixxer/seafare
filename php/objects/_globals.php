<?php
/*
	Developer: Richard D. Grant ii
	Contact: r.grant.jr.122193@gmail.com
*/
require_once("_global_methods.php");
class _globals extends _global_methods{
	private static $sql_hosts = array(
		'ec2-184-72-219-186.compute-1.amazonaws.com'
	);
	private static $sql_dbs = array(
		'd16d2fr0rcfq7k'//replace
	);
	private static $sql_accounts = array(
		array(
			'username'=>'kqwfivyjtluziy',//replace
			'password'=>'d515ab41807df4979410d5c9c21651d030216315fdc4f4000d1ad331c9959776'//replace
		)
	);
	private static $sql_ports = array(
		5432
	);
	protected static $SQL_CONNECTION = array();
	function __construct(){
		parent::__construct();
		self::$SQL_CONNECTION = array(
			array(
				'host'=>self::$sql_hosts[0x0],
				'db'=>self::$sql_dbs[0x0],
				'username'=>self::$sql_accounts[0x0]['username'],
				'password'=>self::$sql_accounts[0x0]['password'],
				'port'=>self::$sql_ports[0x0]
			)
		);
	}
	public static $api_keys = array(
		"reCAPTCHA"=>array(//see https://www.google.com/recaptcha
			"Site key"=>"*",//replace 
			"Secret key"=>"*",//replace
			"enabled"=>true //enables or disables api
		),
		"TWILIO"=>array(// set _globals::$api_keys['TWILIO'] from www.twilio.com/user/account
			"ACCOUNT SID"=>"*",//replace
			"AUTHTOKEN"=>"*",//replace
			"NUMBER"=>array(//list of twilio numbers
				"+13864015464"//replace with your twillo number
			),
			"enabled"=>true //enables or disables api
		)
	);
	public static $system_email = "rgrant1993@gmail.com";//_notification.php only supports gmail, unless you add your own SMTP settings
}
?>
