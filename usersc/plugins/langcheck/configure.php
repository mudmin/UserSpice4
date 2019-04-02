  <?php if(!in_array($user->data()->id,$master_account)){ Redirect::to($us_url_root.'users/admin.php');} //only allow master accounts to manage plugins! ?>

 <?php
 include "plugin_info.php";
 pluginActive($plugin_name);
 $compare = 0;
if(!empty($_POST)){
  $lang = [];
  include($abs_us_root.$us_url_root."users/lang/en-US.php");
  $english = $lang;
  $language = Input::get('language');
  $lang = [];
  include($abs_us_root.$us_url_root."users/lang/".$language);
  $other = $lang;
  $lang = [];
  include($abs_us_root.$us_url_root."users/lang/en-US.php");
if(!empty($_POST['submitMissing'])){
  $compare = 1;
}
if(!empty($_POST['submitEnglish'])){
  $compare = 2;
}

}
 $token = Token::generate();
 $languages = scandir($abs_us_root.$us_url_root."users/lang");?>
<div class="content mt-3">
 		<div class="row">
 			<div class="col-sm-12">
          <a href="<?=$us_url_root?>users/admin.php?view=plugins">Return to the Plugin Manager</a>
          <div class="row">
            <!-- MISSING langauge keys -->
              <div class="col-sm-6">
              <br>
              <h3 align="center">Check for MISSING language keys</h3>
              <p align="center">This tool will look for keys that are in the English translation that are not in your translation so you can add them to yours.</p>
              <form class="" action="" method="post">
                <input type="hidden" name="csrf" $value="<?=$token;?>" />
                <select class="form-control" name="language">
                  <?php
                  foreach($languages as $l){
                    if($l != 'en-US.php' && $l != '.' && $l != '..' && $l != 'flags'){ ?>
                      <option <?php if(isset($language) && $language == $l){echo "selected='selected'";}?> value="<?=$l?>"><?=$l?></option>
                    <?php }
                  }
                   ?>
                </select>
                <input type="submit" name="submitMissing" value="submit" class="btn btn-primary btn-block">
              </form>
            </div>

            <!-- UNTRANSLATED Language Keys -->
            <div class="col-sm-6">
            <br>
            <h3 align="center">Check for UNTRANSLATED language keys</h3>
            <p align="center">This tool will look for keys that the same in both your langauge and English. This is a good way to find keys that you may have forgotten to translate.</p>
            <form class="" action="" method="post">
              <input type="hidden" name="csrf" $value="<?=$token;?>" />
              <select class="form-control" name="language">
                <?php
                foreach($languages as $l){
                  if($l != 'en-US.php' && $l != '.' && $l != '..' && $l != 'flags'){ ?>
                    <option <?php if(isset($language) && $language == $l){echo "selected='selected'";}?> value="<?=$l?>"><?=$l?></option>
                  <?php }
                }
                 ?>
              </select>
              <input type="submit" name="submitEnglish" value="submit" class="btn btn-primary btn-block">
            </form>
          </div>
          </div>
          <?php if($compare > 0){
            if($compare == 1){
            $diff = array_diff_key($english,$other);
            $count = count($diff);
            }
            if($compare == 2){
            $diff = array_intersect($english,$other);
            $count = count($diff);
            }
            ?>
            <br>
            <h4 align="center">Comparing <?=$language?> to en_US.php</h4><br>
            <?php if($compare == 1){?>
            <h5 align="center">You are missing <font color="red"><?=$count?></font> language keys</h5>
            <?php }elseif($compare == 2){ ?>
              <h5 align="center">There are <font color="red"><?=$count?></font> that are the same as English</h5>
            <?php }?>
            <?php if($count > 0){?>
              The following keys still need to be translated.
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Key</th>
                    <th>English Translation</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($diff as $k=>$v){?>
                    <tr>
                      <td><?=$k?></td>
                      <td><?=$v?></td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
          <?php
            }
          }
        ?>
 			</div> <!-- /.col -->
 		</div> <!-- /.row -->
