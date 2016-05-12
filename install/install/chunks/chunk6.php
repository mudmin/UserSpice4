$publickey = $your_public_key;
$privatekey = $your_private_key;

//Put Your Stripe Keys Here (if you have them)
$test_secret = "Insert_Your_Own_Key_Here";
$test_public = "Insert_Your_Own_Key_Here";
$live_secret = "Insert_Your_Own_Key_Here";
$live_public = "Insert_Your_Own_Key_Here";

require_once $abs_us_root.$us_url_root.'users/classes/Config.php';
require_once $abs_us_root.$us_url_root.'users/classes/Cookie.php';
require_once $abs_us_root.$us_url_root.'users/classes/DB.php';
require_once $abs_us_root.$us_url_root.'users/classes/Hash.php';
require_once $abs_us_root.$us_url_root.'users/classes/Input.php';
require_once $abs_us_root.$us_url_root.'users/classes/Redirect.php';
require_once $abs_us_root.$us_url_root.'users/classes/Session.php';
require_once $abs_us_root.$us_url_root.'users/classes/Token.php';
require_once $abs_us_root.$us_url_root.'users/classes/User.php';
require_once $abs_us_root.$us_url_root.'users/classes/Validate.php';

$currentPage = currentPage();

//Check to see if user has a remember me cookie
if(Cookie::exists(Config::get('remember/cookie_name')) && !Session::exists(Config::get('session/session_name'))){
	$hash = Cookie::get(Config::get('remember/cookie_name'));
	$hashCheck = DB::getInstance()->query("SELECT * FROM users_session WHERE hash = ? AND uagent = ?",array($hash,Session::uagent_no_version()));

	if ($hashCheck->count()) {
		$user = new User($hashCheck->first()->user_id);
		$user->login();

	}
}

//Set Time Zone string
//php.net/manual/en/timezones.php
$timezone_string="America/Toronto";
date_default_timezone_set($timezone_string);

//Check to see that user is logged in on a temporary password
$user = new User();

//Check to see that user is verified
if($user->isLoggedIn()){
	if($user->data()->email_verified == 0 && $currentPage != 'verify.php' && $currentPage != 'logout.php' && $currentPage != 'verify_thankyou.php'){
		Redirect::to('verify.php');
	}
}