<?php //UserSpice Admin Reauthorization

if(!function_exists('updateReAuth')) {
	function updateReAuth($id, $re_auth) {
		$db = DB::getInstance();
		$result = $db->query("UPDATE pages SET re_auth = ? WHERE id = ?",array($re_auth,$id));
		return $result;
	}
}

if(!function_exists('reAuth')) {
	function reAuth(){
		$abs_us_root=$_SERVER['DOCUMENT_ROOT'];
		$self_path=explode("/", $_SERVER['PHP_SELF']);
		$self_path_length=count($self_path);
		$file_found=FALSE;

		for($i = 1; $i < $self_path_length; $i++){
			array_splice($self_path, $self_path_length-$i, $i);
			$us_url_root=implode("/",$self_path)."/";

			if (file_exists($abs_us_root.$us_url_root.'z_us_root.php')){
				$file_found=TRUE;
				break;
			}else{
				$file_found=FALSE;
			}
		}

		$urlRootLength=strlen($us_url_root);
		$page=substr($_SERVER['PHP_SELF'],$urlRootLength,strlen($_SERVER['PHP_SELF'])-$urlRootLength);
		$db = DB::getInstance();
		$id = null;
		$query = $db->query("SELECT id, page, re_auth FROM pages WHERE page = ?",[$page]);
		$count = $query->count();
		if ($count > 0){
			$results = $query->first();
			$pageDetails = array( 'id' =>$results->id, 'page' => $results->page, 're_auth' => $results->re_auth);
			$pageID = $results->id;
			if($_SERVER["REMOTE_ADDR"]=="127.0.0.1" || $_SERVER["REMOTE_ADDR"]=="::1" || $_SERVER["REMOTE_ADDR"]=="localhost"){
				$local = True;
			}else{
				$local = False;
			}
			if (empty($pageDetails)){
				return true;
			}elseif ($pageDetails['re_auth'] == 0){//If page is public, allow access
				return true;
			} elseif ($page=='users/admin_verify.php' || $page=='usersc/admin_verify.php') {
				return true;
			} elseif ($page=='users/admin_pin.php' || $page=='usersc/admin_pin.php') {
				return true;
				} elseif ($local) {
					return true;
			} else{ //Authorization is required.  Insert your authorization code below.
				if(!isset($_SESSION['cloak_to'])) verifyadmin($page);
			}
		}
	}
}

if(!function_exists('verifyadmin')) {
	function verifyadmin($page) {
		global $user;
		global $us_url_root;
		$actual_link = encodeURIComponent("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
		$db = DB::getInstance();
		$settings=$db->query("SELECT * FROM settings WHERE id=1")->first();
		$null=$settings->admin_verify_timeout-1;
		if(isset($_SESSION['last_confirm']) && $_SESSION['last_confirm']!='' && !is_null($_SESSION['last_confirm'])) $last_confirm=$_SESSION['last_confirm'];
		else $last_confirm=date("Y-m-d H:i:s",strtotime('-'.$null.' day',strtotime(date("Y-m-d H:i:s"))));
		$current=date("Y-m-d H:i:s");
		$ctFormatted = date("Y-m-d H:i:s", strtotime($current));
		$dbPlus = date("Y-m-d H:i:s", strtotime('+'.$settings->admin_verify_timeout.' minutes', strtotime($last_confirm)));
		if (strtotime($ctFormatted) > strtotime($dbPlus)){
			$q = $db->query("SELECT pin FROM users WHERE id = ?",[$user->data()->id]);
			if(is_null($q->first()->pin)) Redirect::to($us_url_root.'users/admin_pin.php?actual_link='.$actual_link.'&page='.$page);
			else Redirect::to($us_url_root.'users/admin_verify.php?actual_link='.$actual_link.'&page='.$page);
		}
		else
		{
			$db = DB::getInstance();
			$_SESSION['last_confirm']=$current;
		}
	}
}
