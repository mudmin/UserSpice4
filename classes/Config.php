<?php
/*
UserSpice 43
by Curtis Parham and Dan Hoover at http://UserSpice.com
*/

//if you are ever questioning if your classes are being included, uncomment the line above and the words "config included" should show at the top of your page.
class Config {
	public static function get($path = null){
		if($path){
			$config = $GLOBALS['config'];
			$path = explode('/', $path);

			foreach ($path as $bit) {
				if(isset($config[$bit])){
					$config = $config[$bit];
				}
			}

			return $config;
		}

		return false;
	}
}
