<?php //UserSpice Fingerprinting Functions

if(!function_exists('fetchUserFingerprints')) {
	function fetchUserFingerprints() {
		global $user;
		$db = DB::getInstance();
		$q = $db->query("SELECT *,CASE WHEN fp.kFingerprintAssetID IS NULL THEN false ELSE true END AssetsAvailable FROM us_fingerprints f LEFT JOIN us_fingerprint_assets fp ON fp.fkFingerprintID=f.kFingerprintID WHERE f.fkUserID = ? AND f.Fingerprint_Expiry > NOW()",[$user->data()->id]);
		if($q->count()>0) return $q->results();
		else return false;
	}
}

if(!function_exists('expireFingerprints')) {
	function expireFingerprints($fingerprints) {
		global $user;
		$db = DB::getInstance();
		$i=0;
		foreach($fingerprints as $fingerprint) {
			$db->query("UPDATE us_fingerprints SET Fingerprint_Expiry=NOW() WHERE kFingerprintID = ? AND fkUserId = ?",[$fingerprint,$user->data()->id]);
			if(!$db->error()) {
				$i++;
				logger($user->data()->id,"Two FA","Expired Fingerprint ID#$fingerprint");
			} else {
				$error=$db->errorString();
				logger($user->data()->id,"Two FA","Error expiring Fingerprint ID#$fingerprint: $error");
			}
		}
		if($i>0) return $i;
		else return false;
	}
}

if(!function_exists('getOS')) {
	function getOS() {

	    global $user_agent;

	    $os_platform  = "Unknown OS Platform";

	    $os_array     = array(
	                          '/windows nt 10/i'      =>  'Windows 10',
	                          '/windows nt 6.3/i'     =>  'Windows 8.1',
	                          '/windows nt 6.2/i'     =>  'Windows 8',
	                          '/windows nt 6.1/i'     =>  'Windows 7',
	                          '/windows nt 6.0/i'     =>  'Windows Vista',
	                          '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
	                          '/windows nt 5.1/i'     =>  'Windows XP',
	                          '/windows xp/i'         =>  'Windows XP',
	                          '/windows nt 5.0/i'     =>  'Windows 2000',
	                          '/windows me/i'         =>  'Windows ME',
	                          '/win98/i'              =>  'Windows 98',
	                          '/win95/i'              =>  'Windows 95',
	                          '/win16/i'              =>  'Windows 3.11',
	                          '/macintosh|mac os x/i' =>  'Mac OS X',
	                          '/mac_powerpc/i'        =>  'Mac OS 9',
	                          '/linux/i'              =>  'Linux',
	                          '/ubuntu/i'             =>  'Ubuntu',
	                          '/iphone/i'             =>  'iPhone',
	                          '/ipod/i'               =>  'iPod',
	                          '/ipad/i'               =>  'iPad',
	                          '/android/i'            =>  'Android',
	                          '/blackberry/i'         =>  'BlackBerry',
	                          '/webos/i'              =>  'Mobile'
	                    );

	    foreach ($os_array as $regex => $value)
	        if (preg_match($regex, $user_agent))
	            $os_platform = $value;

	    return $os_platform;
	}
}

if(!function_exists('getBrowser')) {
	function getBrowser() {

	    global $user_agent;

	    $browser        = "Unknown Browser";

	    $browser_array = array(
	                            '/msie/i'      => 'Internet Explorer',
	                            '/firefox/i'   => 'Firefox',
	                            '/safari/i'    => 'Safari',
	                            '/chrome/i'    => 'Chrome',
	                            '/edge/i'      => 'Edge',
	                            '/opera/i'     => 'Opera',
	                            '/netscape/i'  => 'Netscape',
	                            '/maxthon/i'   => 'Maxthon',
	                            '/konqueror/i' => 'Konqueror',
	                            '/mobile/i'    => 'Handheld Browser'
	                     );

	    foreach ($browser_array as $regex => $value)
	        if (preg_match($regex, $user_agent))
	            $browser = $value;

	    return $browser;
	}
}
