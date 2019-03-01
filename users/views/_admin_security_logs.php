<div class="col-sm-8">
  <div class="page-header float-right">
    <div class="page-title">
      <ol class="breadcrumb text-right">
        <li><a href="<?=$us_url_root?>users/admin.php">Dashboard</a></li>
        <li>Tools</li>
        <li class="active">Security Logs</li>
      </ol>
    </div>
  </div>
</div>
</div>
</header>
<?php
$tomQ = $db->query("SELECT * FROM audit ORDER BY id DESC LIMIT 400");
$tomC = $tomQ->count();

if($tomC > 0){
  $tom = $tomQ->results();
}

if(!empty($_POST)){
  if(!empty($_POST['ban'])){
    $banIP=Input::get('banIP');
    foreach($banIP as $k=>$v){
      $q = $db->query("SELECT ip FROM audit WHERE id = ?",array($v));
      $c = $q->count();
      if($c > 0){
        $f = $q->first();
        if($f->ip == '::1' || $f->ip == "127.0.0.1"){
          continue;
        }else{
          $query = $db->query("SELECT id FROM us_ip_blacklist WHERE ip = ?",array($f->ip));
          $count = $query->count();
          if($count > 0){
            continue;
          }else{
            $luQ = $db->query("SELECT * FROM us_ip_list WHERE ip = ?",array($f->ip));
            $luC = $luQ->count();
            if($luC > 0){
              $luF = $luQ->first();
              $lu = $luF->user_id;
            }else{
              $lu = 0;
            }
            $fields = array(
              'ip'		=> $f->ip,
              'last_user' => $lu,
              'reason'		=> 0,
            );

            $db->insert('us_ip_blacklist',$fields);
            Redirect::to($us_url_root.'users/admin.php?view=security_logs&err=IP+is+now+banned');
          }
        }
      }
    }
  }

  if(!empty($_POST['clear'])){
    $db->query("TRUNCATE TABLE audit");
    Redirect::to($us_url_root.'users/admin.php?view=security_logs&err=All+events+have+been+deleted');
  }
}
?>
<div class="content mt-3">
  <div id="msg" class="bg-info text-info"></div>
  <?php	if($tomC > 0){ ?>
    <h2>View Security Events</h2>
    If someone tries to do something without permission it is logged here.<br>
    Note that this helps check for both security breaches AND figuring out that you have not given someone proper permissions.<br><br>
    <form class="" action="admin.php?view=security_logs" method="post">
      <table id="paginate" class="table table-hover">
        <thead>

          <tr>
            <th>Event ID</th>
            <th>User</th>
            <th>Page</th>
            <th>Timestamp</th>
            <th>IP</th>
            <th>Ban IP</th>
            <!-- <th>Read</th> -->
          </tr>

        </thead>
        <tbody>



          <input class='btn btn-large btn-primary' type='submit' name="clear" value='Clear All Logs'/>
          <input class='btn btn-large btn-danger' type='submit' name="ban" value='Ban Selected IPs'/>

          <?php foreach ($tom as $m){ ?>

            <tr>
              <td><?=$m->id?></td>
              <td><?php
              if($m->user > 0){
                echouser($m->user);
              }else{
                $q = $db->query("SELECT * FROM us_ip_list WHERE ip = ? ORDER BY id DESC",array($m->ip));
                $c = $q->count();
                if($c > 0){
                  $f = $q->first();
                  echo "IP last used by ";
                  echouser($f->user_id);
                }else{
                  echo "<font color='red'>Unknown IP</font>";
                }
              }
              ?></td>

              <td><?php echopage($m->page);?></td>

              <td><?=$m->timestamp?></td>

              <td><?php
              if(checkBan($m->ip)){
                echo "<font color='red'>".$m->ip." (banned)</font>";
              }else{
                echo $m->ip;
              } ?></td>
              <td>
                <?php if(!checkBan($m->ip)){ ?>
                  <input type="checkbox" name="banIP[<?=$m->id?>]" value="<?=$m->id?>"></td>
                <?php } ?>
                <!-- <td><?php //bin($m->viewed); ?></td> -->


              </tr>
            <?php } ?>
          </tbody>

        </table>
      <?php	}else{ ?>
        <h2 align = "center">No Events. Site is clean.</h2>
      <?php	} ?>
    </form>

  </div>

  <script type="text/javascript" src="js/pagination/datatables.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#paginate').DataTable({"pageLength": 25,"aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]], "aaSorting": []});
    } );
  </script>
