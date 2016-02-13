<?php
class Redirect {
	public static function to($location = null){
		if ($location) {
			if (is_numeric($location)) {
				switch ($location) {
					case '404':
						header('HTTP/1.0 404 Not found');
						include 'includes/errors/404.php';
						break;
				}
			}
   	 		if (!headers_sent()){    
        		header('Location: '.$location);
        		exit();
        	} else {  
		        echo '<script type="text/javascript">';
		        echo 'window.location.href="'.$location.'";';
		        echo '</script>';
		        echo '<noscript>';
		        echo '<meta http-equiv="refresh" content="0;url='.$location.'" />';
		        echo '</noscript>'; exit;
		   	 	}
		}	
	}
	
}