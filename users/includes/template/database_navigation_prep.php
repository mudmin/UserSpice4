  <?php
  // $settingsQ = $db->query("SELECT * FROM settings");
  // $settings = $settingsQ->first();

  // Set up notifications button/modal
  if ($user->isLoggedIn()) {
      if ($dayLimitQ = $db->query('SELECT notif_daylimit FROM settings', array())) $dayLimit = $dayLimitQ->results()[0]->notif_daylimit;
      else $dayLimit = 7;

      // 2nd parameter- true/false for all notifications or only current
  	$notifications = new Notification($user->data()->id, false, $dayLimit);
  }
  /*
  Load main navigation menus
  */
  $main_nav_all = $db->query("SELECT * FROM menus WHERE menu_title='main' ORDER BY display_order");

  /*
  Set "results" to true to return associative array instead of object...part of db class
  */
  $main_nav=$main_nav_all->results(true);

  /*
  Make menu tree
  */
  $prep=prepareMenuTree($main_nav);

  ?>
