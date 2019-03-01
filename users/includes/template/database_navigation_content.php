<?php
foreach ($prep as $key => $value) {
  $authorizedGroups = array();
  foreach (fetchGroupsByMenu($value['id']) as $g) {
    $authorizedGroups[] = $g->group_id;
  }
  /*
  Check if there are children of the current nav item...if no children, display single menu item, if children display dropdown menu
  */
  if (sizeof($value['children'])==0) {
    if ($user->isLoggedIn()) {
      if((hasPerm($authorizedGroups,$user->data()->id) || in_array(0,$authorizedGroups)) && $value['logged_in']==1) {
      //if (checkMenu($value['id'],$user->data()->id) && $value['logged_in']==1) {
        if($value['label']=='{{notifications}}') {
            $itemString='';
            if($settings->notifications==1) {
                $itemString='<li><a href="#" onclick="displayNotifications(';
                $itemString.="'new')";
                $itemString.='"';
                $itemString.='id="notificationsTrigger" data-toggle="modal" data-target="#notificationsModal"  ><i class="fa fa-bell"></i> <span id="notifCount" class="badge" style="margin-top: -5px">';
                $itemString.=(($notifications->getUnreadCount() > 0) ? $notifications->getUnreadCount() : '');
                $itemString.='</span></a></li>';
            }
         }
        elseif($value['label']=='{{messages}}') {
            $itemString='';
            if($settings->messaging==1) {
                $itemString='<li><a href="'.$us_url_root.'users/messages.php"><i class="fa fa-envelope"></i> <span id="msgCount" class="badge" style="margin-top: -5px">';
                if($msgC > 0) $itemString.= $msgC;
                $itemString.='</span></a></li>'; }
         }
        else {
        $itemString = prepareItemString($value,$user->data()->id);
        $itemString = str_replace('{{username}}',$user->data()->username,$itemString);
        $itemString = str_replace('{{fname}}',$user->data()->fname,$itemString);
        $itemString = str_replace('{{lname}}',$user->data()->lname,$itemString);
        include $abs_us_root.$us_url_root.'usersc/includes/database_navigation_hooks.php';
       }
        echo $itemString;
      }
    } else {
      if ($value['logged_in']==0) {
        echo prepareItemString($value,0);
      }
    }
  } else {
    if ($user->isLoggedIn()) {
      if((hasPerm($authorizedGroups,$user->data()->id) || in_array(0,$authorizedGroups)) && $value['logged_in']==1) {
        $dropdownString=prepareDropdownString($value,$user->data()->id);
        $dropdownString=str_replace('{{username}}',$user->data()->username,$dropdownString);
        $dropdownString = str_replace('{{fname}}',$user->data()->fname,$dropdownString);
        $dropdownString = str_replace('{{lname}}',$user->data()->lname,$dropdownString);
        include $abs_us_root.$us_url_root.'usersc/includes/database_navigation_hooks_dropdown.php';
        echo $dropdownString;
      }
    } else {
      if ($value['logged_in']==0) {
        $dropdownString=prepareDropdownString($value,0);
        #$dropdownString=str_replace('{{username}}',$user->data()->username,$dropdownString); # There *is* no $user->...->username because we're not logged in
        echo $dropdownString;
      }
    }
  }
}
?>
