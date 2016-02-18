$publickey = $your_public_key;
$privatekey = $your_private_key;

//Put Your Stripe Keys Here (if you have them)
$test_secret = "Insert_Your_Own_Key_Here";
$test_public = "Insert_Your_Own_Key_Here";
$live_secret = "Insert_Your_Own_Key_Here";
$live_public = "Insert_Your_Own_Key_Here";

//If you use composer, include the link below
require env().'users/vendor/autoload.php';

// Auto Load Classes
spl_autoload_register(function($class){
if(file_exists(env().'classes/'.$class.'.php') == 1){
  require_once env().'classes/' . $class . '.php';
}
});

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

//Check to see that user is logged in on a temporary password
$user = new User();

//Check to see that user is verified
if($user->isLoggedIn()){
if($user->data()->email_verified == 0 && $currentPage != 'verify.php' && $currentPage != 'logout.php' && $currentPage != 'verify_thankyou.php'){
  Redirect::to('verify.php');
}
}
