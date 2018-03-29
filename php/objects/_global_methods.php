<?php
/*
	Developer: Richard D. Grant ii
	Contact: r.grant.jr.122193@gmail.com
*/
require_once("_global_variables.php");
class _global_methods extends _global_variables{
	function __construct(){

	}
	protected function remove_chars($string, $remove_chars){
		return str_replace(str_split($remove_chars), '', $string);
	}
	public function rand_string($length = 0x0, $rules=array('alpha','num','ALPHA'), $remove_chars=''){
		$available_chars = '';
		$character_sets = array(
			'alpha'=>'abcdefghijklmnopqrstuvwxwy',
			'num'=>'0123456789'
		);
		if(gettype($rules) === gettype(array())){
			for ($i = count($rules) - 0x001; $i >= 0x0; $i--) {
				$lower_value = strtolower($rules[$i]);
				if(array_key_exists($lower_value, $character_sets)){
					if($lower_value == $rules[$i]){
						$available_chars .= $character_sets[$rules[$i]];
					}else{
						$available_chars .= strtoupper($character_sets[$lower_value]);
					}
				}
			}
		}else{
			$available_chars .= 'abcdefghijklmnopqrstuvwxwy0123456789';
		}
		if($remove_chars !=''){
			$available_chars = $this->remove_chars($available_chars, $remove_chars);
		}
		$vars = array(
			'charsLength'=>strlen($available_chars),
			'output'=>''
		);
		for ($i = $length - 0x001; $i >= 0x0; $i--) {
			$vars['output'] .= $available_chars[rand(0x0, $vars['charsLength'] - 0x001)];
		}
		return $vars['output'];
	}

	protected function today($timezone = undefined){
		$default_timezone = date_default_timezone_get();
		if($timezone !== undefined){
			date_default_timezone_set($timezone);
		}
		$date = date('m/d/Y h:i:s a', time());
		date_default_timezone_set($default_timezone);
		return $date;
	}
}
?>