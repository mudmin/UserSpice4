<?php
/*
UserSpice 43
by Curtis Parham and Dan Hoover at http://UserSpice.com
*/
class Input {
	public static function exists($type = 'post'){
		switch ($type) {
			case 'post':
				return (!empty($_POST)) ? true : false;
				break;

			case 'get':
				return (!empty($_GET)) ? true : false;

			default:
				return false;
				break;
		}
	}

	public static function get($item){
		if (isset($_POST[$item])) {
			return self::sanitize($_POST[$item]);
		} else if(isset($_GET[$item])){
			return self::sanitize($_GET[$item]);
		}
		return '';
	}

	public static function sanitize($string){
		return trim(htmlentities($string, ENT_QUOTES, 'UTF-8'));
	}
}
