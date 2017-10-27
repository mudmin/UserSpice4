<?php
//Every time we do an update to the db, a new migration will be added here
$migrations = array(
  '3GJYaKcqUtw7',
);
$applied = [];
$db_migrations = $db->query("SELECT migration FROM updates")->results();
foreach($db_migrations as $d){
$applied[] = $d->migration;
}
$missing = array_diff($migrations,$applied);
if(!empty($missing)){ ?>
  <div class="alert alert-danger">
    <strong>Warning!</strong> Your database is out of date. Please <a href="update.php">click here</a> to get the latest update. Failure to do so, could cause system instability.
  </div>
<?php } ?>
