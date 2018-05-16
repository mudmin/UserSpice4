<?php
require_once '../users/init.php';
require_once $abs_us_root.$us_url_root.'users/includes/header.php';
require_once $abs_us_root.$us_url_root.'users/includes/navigation.php';
//if (!securePage($_SERVER['PHP_SELF'])){die();}
$count = 0;
$updates = $db->query("SELECT * FROM updates")->results();
$existing_updates=[];
foreach($updates as $u){
  $existing_updates[] = $u->migration;
}
$update=Input::get('override');
if(!in_array($update,$existing_updates) && $update!='' && !is_null($update)) {
  $db->insert('updates',['migration'=>$update]);
  logger(1,"System Updates","Update $update overridden, no update completed.");
  echo "Update ".$update." overridden.";
  $updates = $db->query("SELECT * FROM updates")->results();
  $existing_updates=[];
  foreach($updates as $u){
    $existing_updates[] = $u->migration;
  }
}
?>
<div id="page-wrapper">

<div class="container">

<!-- Page Heading -->
<div class="row">
<div class="col-sm-12"><br><br><br>
<?php
$update = '3GJYaKcqUtw7';
if(!in_array($update,$existing_updates)){
  //fix vericodes

  $u = $db->query("SELECT id FROM users")->results();
  foreach($u as $me){
    $db->update('users',$me->id,['vericode'=>randomstring(15)]);
  }
  logger(1,"System Updates","Reformatted existing vericodes");

  logger(1,"System Updates","Update $update successfully deployed.");
  $db->insert('updates',['migration'=>$update]);
  echo "Applied update ".$update."<br>";
  $count++;
}

$update = '3GJYaKcqUtz8';
if(!in_array($update,$existing_updates)){
  //fix vericodes
  $test = $db->query("SELECT * FROM users WHERE id = 1")->first();
  if($test->vericode == '322418'){
    $u = $db->query("SELECT id FROM users")->results();
    foreach($u as $me){
      $db->update('users',$me->id,['vericode'=>randomstring(15)]);
    }
    logger(1,"System Updates","Reformatted existing vericodes");

    logger(1,"System Updates","Update $update successfully deployed.");
  }
  echo "Patched vericode vulnerability<br>";
  $db->insert('updates',['migration'=>$update]);
  echo "Applied update ".$update."<br>";
  $count++;
}

$update = '69qa8h6E1bzG';
if(!in_array($update,$existing_updates)){
  //Change old logs to IP Logging
  $db->query("UPDATE logs SET logtype = ? WHERE logtype = ? AND lognote LIKE ?",array("IP Logging","User","%blacklisted%attempted%visit"));
  logger(1,"System Updates","Updated old Blacklisted logs to IP Logging type.");
  //Add new DB field
  $db->query("ALTER TABLE users ADD cloak_allowed tinyint(1) NOT NULL");
  logger(1,"System Updates","Added cloaking to users.");
  $db->insert('updates',['migration'=>$update]);
  $count++;
}

$update = '2XQjsKYJAfn1';
if(!in_array($update,$existing_updates)){
  $db->query("ALTER TABLE settings ADD force_notif tinyint(1)");
  $db->query("ALTER TABLE settings ADD cron_ip varchar(255)");
  $db->update("settings",1,['cron_ip'=>'off']);

  echo "<font color='red'>For security reasons</font>, your cron jobs have been temporarily disabled.  Please visit <a href='cron_manager.php'>Cron Manager</a> for more information.<br>";
  logger(1,"System Updates","Update $update successfully deployed.");
  $db->insert('updates',['migration'=>$update]);
  echo "Applied update ".$update."<br>";
  $count++;
}

$update = '549DLFeHMNw7';
if(!in_array($update,$existing_updates)){
  $db->query("UPDATE settings SET force_notif=0 WHERE force_notif IS NULL");
  logger(1,"System Updates","Updated force_notif to 0 if you had not set it already.");
  logger(1,"System Updates","Update $update successfully deployed.");
  $db->insert('updates',['migration'=>$update]);
  echo "Applied update ".$update."<br>";
  $count++;
}

$update = '4Dgt2XVjgz2x';
if(!in_array($update,$existing_updates)){
  $db->query("ALTER TABLE settings ADD COLUMN registration tinyint(1)");
  $db->query("UPDATE settings SET registration=1 WHERE id=1");
  logger(1,"System Updates","Added registration to settings.");
  logger(1,"System Updates","Update $update successfully deployed.");
  $db->insert('updates',['migration'=>$update]);

  $fields = array(
    'page'=>'users/enable2fa.php',
    'title'=>'Enable 2 Factor Auth',
    'private'=>1,
  );
  $i = $db->insert('pages',$fields);
  $id = $db->lastId();
  $fields = array(
    'permission_id'=>1,
    'page_id'=>$id,
  );
  $db->insert('permission_page_matches',$fields);
  $fields = array(
    'permission_id'=>2,
    'page_id'=>$id,
  );
  $db->insert('permission_page_matches',$fields);
  $fields = array(
    'page'=>'users/disable2fa.php',
    'title'=>'Enable 2 Factor Auth',
    'private'=>1,
  );
  $i = $db->insert('pages',$fields);
  $id = $db->lastId();
  $fields = array(
    'permission_id'=>1,
    'page_id'=>$id,
  );
  $db->insert('permission_page_matches',$fields);
  $fields = array(
    'permission_id'=>2,
    'page_id'=>$id,
  );
  $db->insert('permission_page_matches',$fields);

  echo "Applied update ".$update."<br>";
  $count++;
}


$update = 'VLBp32gTWvEo';
if(!in_array($update,$existing_updates)){

  $db->query("ALTER TABLE users ADD COLUMN vericode_expiry timestamp AFTER `vericode`");
  logger(1,"System Updates","Added Vericode Expiry to Users Table.");

  $db->query("UPDATE pages SET title=? WHERE page = ? and (title = ? OR title = null)",["Two Factor Authentication","users/twofa.php",""]);
  $db->query("UPDATE pages SET title=? WHERE page = ? and (title = ? OR title = null)",["Disable 2 Factor Auth","users/disable2fa.php","Enable 2 Factor Auth"]);
  $db->query("UPDATE pages SET title=? WHERE page = ? and (title = ? OR title = null)",["Notifications Manager","users/admin_notifications.php","Admin Notifications"]);
  $db->query("UPDATE pages SET title=? WHERE page = ? and (title = ? OR title = null)",["IP Manager","users/admin_ips.php","Admin IPs"]);
  $db->query("UPDATE pages SET title=? WHERE page = ? and (title = ? OR title = null)",["Menu Manager","users/admin_menu.php","Manage Menus"]);
  $db->query("UPDATE pages SET title=? WHERE page = ? and (title = ? OR title = null)",["Menu Manager","users/admin_menus.php","Manage Menus"]);
  $db->query("UPDATE pages SET title=? WHERE page = ? and (title = ? OR title = null)",["Menu Manager","users/admin_menu_item.php","Manage Menus"]);
  $db->query("UPDATE pages SET title=? WHERE page = ? and (title = ? OR title = null)",["Update Manager","users/update.php","Update UserSpice"]);
  $db->query("UPDATE pages SET title=? WHERE page = ? and (title = ? OR title = null)",["Logs Manager","users/admin_logs.php","Site Logs"]);
  $db->query("UPDATE pages SET title=? WHERE page = ? and (title = ? OR title = null)",["Logs Manager","users/admin_logs_exempt.php","Site Logs"]);
  $db->query("UPDATE pages SET title=? WHERE page = ? and (title = ? OR title = null)",["Logs Manager","users/admin_logs_manager.php","Site Logs"]);
  $db->query("UPDATE pages SET title=? WHERE page = ? and (title = ? OR title = null)",["Logs Manager","users/admin_logs_mapper.php","Site Logs"]);
  $db->query("UPDATE pages SET title=? WHERE page = ? and (title = ? OR title = null)",["Messages Manager","users/admin_messages.php","View Messages"]);
  $db->query("UPDATE pages SET title=? WHERE page = ? and (title = ? OR title = null)",["Messages Manager","users/admin_message.php","View Message"]);
  $db->query("UPDATE pages SET title=null WHERE page = ? and (title = ? OR title = null)",["users/cron_post.php","Post a Cron Job"]);
  $db->query("UPDATE pages SET title=? WHERE page = ? and (title = ? OR title = null)",["Password Verification","users/admin_verify.php","Verify Password"]);
  $db->query("UPDATE pages SET title=? WHERE page = ? and (title = ? OR title = null)",["Backup Manager","users/admin_backup.php","Backup Files"]);
  $db->query("UPDATE pages SET title=? WHERE page = ? and (title = ? OR title = null)",["Messages","users/messages.php","My Messages"]);
  $db->query("UPDATE pages SET title=? WHERE page = ? and (title = ? OR title = null)",["Messages","users/message.php","My Messages"]);
  $db->query("UPDATE pages SET title=? WHERE page = ? and (title = ? OR title = null)",["User Settings","users/user_settings.php","My Settings"]);
  $db->query("UPDATE pages SET title=? WHERE page = ? and (title = ? OR title = null)",["User Manager","users/admin_users.php","Manage Users"]);
  $db->query("UPDATE pages SET title=? WHERE page = ? and (title = ? OR title = null)",["User Manager","users/admin_user.php","Manage User"]);
  $db->query("UPDATE pages SET title=? WHERE page = ? and (title = ? OR title = null)",["Permissions Manager","users/admin_permissions.php","Manage Permissions"]);
  $db->query("UPDATE pages SET title=? WHERE page = ? and (title = ? OR title = null)",["Permissions Manager","users/admin_permission.php","Manage Permission"]);
  $db->query("UPDATE pages SET title=? WHERE page = ? and (title = ? OR title = null)",["Pages Manager","users/admin_pages.php","Manage Pages"]);
  $db->query("UPDATE pages SET title=? WHERE page = ? and (title = ? OR title = null)",["Pages Manager","users/admin_page.php","Manage Page"]);
  logger(1,"System Updates","Reformatted exiting page titles only if they weren't modified.");

  $db->insert('updates',['migration'=>$update]);
  logger(1,"System Updates","Update $update successfully deployed.");
  echo "Applied update ".$update."<br>";
  $count++;
}

//form tables
$update = '1XdrInkjV86F';
if(!in_array($update,$existing_updates)){
  $db->query("CREATE TABLE `us_form_views` (
    `id` int(11) NOT NULL,
    `form_name` varchar(255) NOT NULL,
    `view_name` varchar(255) NOT NULL,
    `fields` text NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1");

  $db->query("ALTER TABLE `us_form_views`
    ADD PRIMARY KEY (`id`)");

    $db->query("ALTER TABLE `us_form_views`
      MODIFY `id` int(11) NOT NULL AUTO_INCREMENT");

      $db->query("CREATE TABLE `us_form_validation` (
        `id` int(11) NOT NULL,
        `value` varchar(255) NOT NULL,
        `description` varchar(255) NOT NULL,
        `params` varchar(255) NOT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=latin1");

      $db->query("INSERT INTO `us_form_validation` (`id`, `value`, `description`, `params`) VALUES
      (1, 'min', 'Minimum # of Characters', 'number'),
      (2, 'max', 'Maximum # of Characters', 'number'),
      (3, 'is_numeric', 'Must be a number', 'true'),
      (4, 'valid_email', 'Must be a valid email address', 'true'),
      (5, '<', 'Must be a number less than', 'number'),
      (6, '>', 'Must be a number greater than', 'number'),
      (7, '<=', 'Must be a number less than or equal to', 'number'),
      (8, '>=', 'Must be a number greater than or equal to', 'number'),
      (9, '!=', 'Must not be equal to', 'text'),
      (10, '==', 'Must be equal to', 'text'),
      (11, 'is_integer', 'Must be an integer', 'true'),
      (12, 'is_timezone', 'Must be a valid timezone name', 'true'),
      (13, 'is_datetime', 'Must be a valid DateTime', 'true')");

      $db->query("ALTER TABLE `us_form_validation`
        ADD PRIMARY KEY (`id`)");

        $db->query("ALTER TABLE `us_form_validation`
          MODIFY `id` int(11) NOT NULL AUTO_INCREMENT");

          $db->query("CREATE TABLE `us_forms` (
            `id` int(11) NOT NULL,
            `form` varchar(255) NOT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=latin1");

          $db->query("ALTER TABLE `us_forms`
            ADD PRIMARY KEY (`id`)");

            $db->query("ALTER TABLE `us_forms`
              MODIFY `id` int(11) NOT NULL AUTO_INCREMENT");

              $db->insert('updates',['migration'=>$update]);
              logger(1,"System Updates","Update $update successfully deployed.");
              echo "Applied update ".$update."<br>";
              $count++;
            }

//Add new pages
$update = 'Q3KlhjdtxE5X';
if(!in_array($update,$existing_updates)){

  $fields = array(
    'page'=>'users/admin_forms.php',
    'title'=>'Form Manager',
    'private'=>1,
  );
  $i = $db->insert('pages',$fields);
  $id = $db->lastId();
  $fields = array(
    'permission_id'=>2,
    'page_id'=>$id,
  );
  $db->insert('permission_page_matches',$fields);

  $fields = array(
    'page'=>'users/admin_form_views.php',
    'title'=>'Form View Manager',
    'private'=>1,
  );
  $i = $db->insert('pages',$fields);
  $id = $db->lastId();
  $fields = array(
    'permission_id'=>2,
    'page_id'=>$id,
  );

  $fields = array(
    'page'=>'users/edit_form.php',
    'title'=>'Form Editor',
    'private'=>1,
  );
  $i = $db->insert('pages',$fields);
  $id = $db->lastId();
  $fields = array(
    'permission_id'=>2,
    'page_id'=>$id,
  );

  $db->insert('permission_page_matches',$fields);

  $db->insert('updates',['migration'=>$update]);
  logger(1,"System Updates","Update $update successfully deployed.");
  echo "Applied update ".$update."<br>";
  $count++;
}

$update = 'ug5D3pVrNvfS';
if(!in_array($update,$existing_updates)){
  $db->query("ALTER TABLE settings
    ADD COLUMN join_vericode_expiry int(9) UNSIGNED NOT NULL,
    ADD COLUMN reset_vericode_expiry int(9) UNSIGNED NOT NULL");
    $db->query("UPDATE settings SET settings.join_vericode_expiry=24,reset_vericode_expiry=15 WHERE id=1");
    logger(1,"System Updates","Added join_vericode_expiry and reset_vericode_expiry to settings table.");
    $db->insert('updates',['migration'=>$update]);
    logger(1,"System Updates","Update $update successfully deployed.");
    echo "Applied update ".$update."<br>";
    $count++;
  }

$update = '69FbVbv4Jtrz';
if(!in_array($update,$existing_updates)){
  $db->query("ALTER TABLE users
    ADD COLUMN pin varchar(255) DEFAULT NULL AFTER `password`");
    $db->query("ALTER TABLE settings
      ADD COLUMN admin_verify tinyint(1) NOT NULL,
      ADD COLUMN admin_verify_timeout int(9) NOT NULL");
      $db->query("UPDATE settings SET admin_verify=1,settings.admin_verify_timeout=120 WHERE id=1");
      $db->insert('pages',['page' => 'users/admin_pin.php','title' => 'Verification PIN Set','re_auth'=>0,'private'=>1]);
      $db->insert('permission_page_matches',['permission_id' => 1,'page_id' => $db->lastId()]);
      $db->insert('pages',['page' => 'users/manage2fa.php','title' => 'Manage Two FA','re_auth'=>0,'private'=>1]);
      $db->insert('permission_page_matches',['permission_id' => 1,'page_id' => $db->lastId()]);
      logger(1,"System Updates","Added pin to users, admin_verify and admin_verify_timeout to settings");
      logger(1,"System Updates","Added admin_pin page to pages table");
      $db->insert('updates',['migration'=>$update]);
      logger(1,"System Updates","Update $update successfully deployed.");
      echo "Applied update ".$update."<br>";
      $count++;
    }

$update = '4A6BdJHyvP4a';
if(!in_array($update,$existing_updates)){
  $db->query("ALTER TABLE users
    ADD COLUMN twoDate datetime DEFAULT NULL AFTER `twoEnabled`");
    logger(1,"System Updates","Added twoDate to users");
    $db->insert('updates',['migration'=>$update]);
    logger(1,"System Updates","Update $update successfully deployed.");
    echo "Applied update ".$update."<br>";
    $count++;
  }

$update = '37wvsb5BzymK';
if(!in_array($update,$existing_updates)){
  $db->query("UPDATE pages SET private=1 WHERE page=? AND private=2",['users/disable2fa.php']);
  if($db->count()>0) logger(1,"System Updates","Fixed private status on users/disable2fa.php");
  $db->insert('updates',['migration'=>$update]);
  logger(1,"System Updates","Update $update successfully deployed.");
  echo "Applied update ".$update."<br>";
  $count++;
}

$update = 'c7tZQf926zKq';
//This fixes the Fingerprints Tables
if(!in_array($update,$existing_updates)){
  $error=0;
  $errors = [];
  $tables = ['fingerprint_assets','Fingerprint_Assets','fingerprints','Fingerprints','us_fingerprints','us_fingerprint_assets'];
  foreach($tables as $table) {
    $db->query("DROP TABLE $table");
    if(!$db->error()) logger(1,"System Updates","Dropped table ".$table);
    else logger(1,"System Updates","Alert only: Failure dropping ".$table." Error: ".$db->errorString());
  }
  $db->query("CREATE TABLE us_fingerprints (
    kFingerprintID int(11) NOT NULL,
    fkUserID int(11) NOT NULL,
    Fingerprint varchar(32) NOT NULL,
    Fingerprint_Expiry datetime NOT NULL,
    Fingerprint_Added timestamp NOT NULL,
    PRIMARY KEY (kFingerprintID)
  )");
  $dbError=$db->error();
  if(!$dbError) logger(1,"System Updates","Created table us_fingerprints");
  else {
    $errorString=$db->errorString();
    logger(1,"System Updates",'ATTENTION Failed to add table us_fingerprints, Error: '.$errorString);
    $error++;
    $errors[] = $errorString;
  }
  if(!$dbError) {
    $db->query("ALTER TABLE us_fingerprints
      MODIFY COLUMN kFingerprintID int(11) UNSIGNED NOT NULL AUTO_INCREMENT");
      if(!$dbError) logger(1,"System Updates","Set kFingerprintID to Auto Increment");
      else {
        $errorString=$db->errorString();
        logger(1,"System Updates",'ATTENTION Failed to set kFingerprintID to Auto Increment, Error: '.$errorString);
        $error++;
        $errors[] = $errorString;
      }
    }
    $db->query("CREATE TABLE us_fingerprint_assets (
      kFingerprintAssetID int(11) UNSIGNED NOT NULL,
      fkFingerprintID int(11) NOT NULL,
      IP_Address varchar(255) NOT NULL,
      User_Browser varchar(255) NOT NULL,
      User_OS varchar(255) NOT NULL,
      PRIMARY KEY (kFingerprintAssetID)
    )");
    $dbError=$db->error();
    if(!$dbError) logger(1,"System Updates","Created table us_fingerprint_assets");
    else {
      $errorString=$db->errorString();
      logger(1,"System Updates",'ATTENTION Failed to add table us_fingerprint_assets, Error: '.$errorString);
      $error++;
      $errors[] = $errorString;
    }
    if(!$dbError) {
      $db->query("ALTER TABLE us_fingerprint_assets
        MODIFY COLUMN kFingerprintAssetID int(11) UNSIGNED NOT NULL AUTO_INCREMENT");
        if(!$db->error()) logger(1,"System Updates","Set kFingerprintAssetID to Auto Increment");
        else {
          $errorString=$db->errorString();
          logger(1,"System Updates",'ATTENTION Failed to set kFingerprintAssetID to Auto Increment, Error: '.$errorString);
          $error++;
          $errors[] = $errorString;
        }
      }
      if($error==0) {
        $db->insert('updates',['migration'=>$update]);
        logger(1,"System Updates","Update $update successfully deployed.");
        echo "Applied update ".$update."<br>";
        $count++;
      } else {
        if($error==1) {
          logger(1,"System Updates","Update $update failed, $error error.");
          echo "Update ".$update." failed with ".$error." error.<br>";
          foreach($errors as $error) {
            echo $error."<br>";
          }
        }
        if($error >1) {
          logger(1,"System Updates","Update $update failed, $error errors.");
          echo "Update ".$update." failed with ".$error." errors.<br>";
          foreach($errors as $error) {
            echo $error."<br>";
          }
        }
        //Rollback
        $db->query("DROP TABLE us_fingerprints");
        if(!$db->error()) {
          logger(1,"System Updates","Rollback Begun-Dropped us_fingerprints");
        } else {
          logger(1,"System Updates","ALERT ONLY: Rollback on dropping us_fingerprints failed, Error: ".$db->errorString());
        }
        $db->query("DROP TABLE us_fingerprint_assets");
        if(!$db->error()) {
          logger(1,"System Updates","Rollback Begun-Dropped us_fingerprint_assets");
        } else {
          logger(1,"System Updates","ALERT ONLY: Rollback on dropping us_fingerprint_assets failed, Error: ".$db->errorString());
        }
      }
    }

$update = 'ockrg4eU33GP';
if(!in_array($update,$existing_updates)){
  $error=0;
  $errors = [];
  $db->query("ALTER TABLE users
    MODIFY COLUMN password varchar(255) NULL");
    $dbError=$db->error();
    if(!$dbError) logger(1,"System Updates","Allowed password to be NULL");
    else {
      $errorString=$db->errorString();
      logger(1,"System Updates",'ATTENTION Failed to modify password column to allow Nulls, Error: '.$errorString);
      $error++;
      $errors[] = $errorString;
    }
    if($error==0) {
      $db->insert('updates',['migration'=>$update]);
      logger(1,"System Updates","Update $update successfully deployed.");
      echo "Applied update ".$update."<br>";
      $count++;
    } else {
      if($error==1) {
        logger(1,"System Updates","Update $update failed, $error error.");
        echo "Update ".$update." failed with ".$error." error.<br>";
        foreach($errors as $error) {
          echo $error."<br>";
        }
      }
      if($error >1) {
        logger(1,"System Updates","Update $update failed, $error errors.");
        echo "Update ".$update." failed with ".$error." errors.<br>";
        foreach($errors as $error) {
          echo $error."<br>";
        }
      }
    }
  }

  $update = 'XX4zArPs4tor';
  if(!in_array($update,$existing_updates)){
    $error=0;
    $errors = [];
    $db->query("CREATE TABLE us_user_sessions (
                  kUserSessionID int(11) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
                  fkUserID int(11) UNSIGNED NOT NULL,
                  UserFingerprint varchar(255) NOT NULL,
                  UserSessionIP varchar(255) NOT NULL,
                  UserSessionOS varchar(255) NOT NULL,
                  UserSessionBrowser varchar(255) NOT NULL,
                  UserSessionStarted datetime NOT NULL,
                  UserSessionLastUsed datetime NULL,
                  UserSessionLastPage varchar(255) NOT NULL,
                  UserSessionEnded tinyint(1) NOT NULL DEFAULT 0,
                  UserSessionEnded_Time datetime DEFAULT NULL
                )");
      $dbError=$db->error();
      if(!$dbError) logger(1,"System Updates","Created table us_user_sessions");
      else {
        $errorString=$db->errorString();
        logger(1,"System Updates",'ATTENTION Failed to create table us_user_sessions, Error: '.$errorString);
        $error++;
        $errors[] = $errorString;
      }
      $db->query("ALTER TABLE settings
                    ADD COLUMN session_manager tinyint(1) NOT NULL;");
        $dbError=$db->error();
        if(!$dbError) {
          logger(1,"System Updates","Added session_manager to settings table.");
          $db->update('settings',1,['session_manager'=>1]);
          if(!$db->error()) logger(1,"System Updates","Updated session_manager to enabled.");
          else {
            $errorString=$db->errorString();
            logger(1,"System Updates",'ATTENTION Failed to update session_manager, Error: '.$errorString);
            $error++;
            $errors[] = $errorString;
          }
        }
        else {
          $errorString=$db->errorString();
          logger(1,"System Updates",'ATTENTION Failed to add session_manager to settings table, Error: '.$errorString);
          $error++;
          $errors[] = $errorString;
        }
      $db->insert('pages',['page'=>'users/manage_sessions.php','title'=>'Session Manage','private'=>1,'re_auth'=>0]);
      if(!$db->error()) {
        $lastId=$db->lastId();
        logger(1,"System Updates","Added users/manage_sessions.php to pages table.");
        $db->insert('permission_page_matches',['page_id' => $lastId,'permission_id'=>1]);
        if(!$db->error()) logger(1,"System Updates","Added permissions to users/manage_sessions.php.");
        else {
          $errorString=$db->errorString();
          logger(1,"System Updates",'ATTENTION Failed to add permissions to users/manage_sessions.php, Error: '.$errorString);
          $error++;
          $errors[] = $errorString;
        }
      } else {
        $errorString=$db->errorString();
        logger(1,"System Updates",'ATTENTION Failed to add users/manage_sessions.php to pages table, Error: '.$errorString);
        $error++;
        $errors[] = $errorString;
      }
      $db->insert('pages',['page'=>'users/admin_manage_sessions.php','title'=>'Session Manage','private'=>1,'re_auth'=>1]);
      if(!$db->error()) {
        $lastId=$db->lastId();
        logger(1,"System Updates","Added users/admin_manage_sessions.php to pages table.");
        $db->insert('permission_page_matches',['page_id' => $lastId,'permission_id'=>2]);
        if(!$db->error()) logger(1,"System Updates","Added permissions to users/admin_manage_sessions.php.");
        else {
          $errorString=$db->errorString();
          logger(1,"System Updates",'ATTENTION Failed to add permissions to users/admin_manage_sessions.php, Error: '.$errorString);
          $error++;
          $errors[] = $errorString;
        }
      } else {
        $errorString=$db->errorString();
        logger(1,"System Updates",'ATTENTION Failed to add users/admin_manage_sessions.php to pages table, Error: '.$errorString);
        $error++;
        $errors[] = $errorString;
      }
      if($error==0) {
        $db->insert('updates',['migration'=>$update]);
        logger(1,"System Updates","Update $update successfully deployed.");
        echo "Applied update ".$update."<br>";
        $count++;
      } else {
        if($error==1) {
          logger(1,"System Updates","Update $update failed, $error error.");
          echo "Update ".$update." failed with ".$error." error.<br>";
          foreach($errors as $error) {
            echo $error."<br>";
          }
        }
        if($error >1) {
          logger(1,"System Updates","Update $update failed, $error errors.");
          echo "Update ".$update." failed with ".$error." errors.<br>";
          foreach($errors as $error) {
            echo $error."<br>";
          }
        }
        //Rollback
        $db->query("DROP TABLE us_user_sessions");
        if(!$db->error()) {
          logger(1,"System Updates","Rollback Begun-Dropped us_user_sessions");
        } else {
          logger(1,"System Updates","ALERT ONLY: Rollback on dropping us_user_sessions failed, Error: ".$db->errorString());
        }
        $db->query("ALTER TABLE settings DROP COLUMN session_manager");
        if(!$db->error()) {
          logger(1,"System Updates","Rollback Begun-Dropped column session_manager");
        } else {
          logger(1,"System Updates","ALERT ONLY: Rollback on dropping column session_manager failed, Error: ".$db->errorString());
        }
      }
    }

  $update = 'pv7r2EHbVvhD';
  if(!in_array($update,$existing_updates)){
    $error=0;
    $errors = [];
    $db->query("TRUNCATE TABLE us_user_sessions");
      $dbError=$db->error();
      if(!$dbError) logger(1,"System Updates","Truncated table us_user_sessions");
      else {
        $errorString=$db->errorString();
        logger(1,"System Updates",'ALERT ONLY: Failed to truncate table us_user_sessions, Error: '.$errorString);
      }
      if($error==0) {
        $db->insert('updates',['migration'=>$update]);
        logger(1,"System Updates","Update $update successfully deployed.");
        echo "Applied update ".$update."<br>";
        $count++;
      } else {
        if($error==1) {
          logger(1,"System Updates","Update $update failed, $error error.");
          echo "Update ".$update." failed with ".$error." error.<br>";
          foreach($errors as $error) {
            echo $error."<br>";
          }
        }
        if($error >1) {
          logger(1,"System Updates","Update $update failed, $error errors.");
          echo "Update ".$update." failed with ".$error." errors.<br>";
          foreach($errors as $error) {
            echo $error."<br>";
          }
        }
      }
    }

  $update = 'mS5VtQCZjyJs';
  if(!in_array($update,$existing_updates)){
    $error=0;
    $errors = [];
    $q=$db->query("SELECT * FROM profiles");
    if(!$db->error()) {
      if($db->count()>0) {
        $updateCount=0;
        foreach($q->results() as $row) {
          $db->update('profiles',$row->id,['bio' => Input::sanitize($row->bio)]);
          if($db->error()) {
            $errorString=$db->errorString();
        		$error++;
        		$errors[]=$errorString;
            logger(1,"System Updates",'ATTENTION: Unable to update bio, Error: '.$errorString);
          } else $updateCount++;
        }
      }
      if($updateCount==1) {
        logger(1,"System Upates","Sanitized 1 Bio");
      }
      if($updateCount >1) {
        logger(1,"System Upates","Sanitized ".$count." Bios");
      }
    } else {
      $errorString=$db->errorString();
      $error++;
      $errors[]=$errorString;
      logger(1,"System Updates",'ATTENTION: Unable to select bios, Error: '.$errorString);
    }
    if($error==0) {
      $db->insert('updates',['migration'=>$update]);
      logger(1,"System Updates","Update $update successfully deployed.");
      echo "Applied update ".$update."<br>";
      $count++;
    } else {
      if($error==1) {
        logger(1,"System Updates","Update $update failed, $error error.");
        echo "Update ".$update." failed with ".$error." error.<br>";
        foreach($errors as $error) {
          echo $error."<br>";
        }
      }
      if($error >1) {
        logger(1,"System Updates","Update $update failed, $error errors.");
        echo "Update ".$update." failed with ".$error." errors.<br>";
        foreach($errors as $error) {
          echo $error."<br>";
        }
      }
    }
  }

//UPDATE TEMPLATE
// $update = '';
// if(!in_array($update,$existing_updates)){
//
//   $db->insert('updates',['migration'=>$update]);
//   logger(1,"System Updates","Update $update successfully deployed.");
//   echo "Applied update ".$update."<br>";
//  $count++;
// }



if($count == 1){
echo "Finished applying ".$count." update.<br>";
}else{
echo "Finished applying ".$count." updates.<br>";
}

if(isset($user) && $user->isLoggedIn()){
?>
<a href="admin.php">Return to the Admin Dashboard</a>
<?php }else{ ?>
<a href="login.php">Click here to login!</a>
<?php } ?>
</div></div></div></div>
