<div class="row">
  <div class="col-xs-12 col-sm-6 col-md-4 col-sm-offset-1 col-md-offset-1">
    <div class="panel panel-default">
      <form class="" action="admin.php" name="css" method="post">

        <input class='btn btn-large btn-primary' type='submit' name="css" value='Save CSS Settings' class='submit' />
        <!-- Test CSS Settings -->
        <br>
        <strong><h4 align="center">UserSpice CSS Settings</h4></strong>
        <br>
          <label for="css_sample">Show CSS Samples</label>
          <select id="css_sample" class="form-control" name="css_sample">
            <option value="1" <?php if($settings->css_sample==1) echo 'selected="selected"'; ?> >Enabled</option>
            <option value="0" <?php if($settings->css_sample==0) echo 'selected="selected"'; ?> >Disabled</option>
            <label for="css_sample" class="form-control"></label></select>
        <br>

        <label for="us_css1">Primary Color Scheme (Loaded 1st)</label>
        <select class="form-control" name="us_css1">
          <option selected="selected"><?=$settings->us_css1?></option>
          <?php foreach(glob('css/color_schemes/*.css') as $filename){
            // $rest = substr($filename, 7);
            echo "<option value=".$filename.">".$filename."</li>";
          }
          ?>

        </select>

        <br>
        <label for="us_css2">Secondary UserSpice CSS (Loaded 2nd)</label>
        <select class="form-control" name="us_css2">
          <option selected="selected"><?=$settings->us_css2?></option>
          <?php foreach(glob('css/*.css') as $filename){
            // $rest = substr($filename, 7);
            echo "<option value=".$filename.">".$filename."</li>";
          }
          ?>
        </select>

        <br>
        <label for="us_css3">Custom UserSpice CSS (Loaded 3rd)</label>
        <select class="form-control" name="us_css3">
          <option selected="selected"><?=$settings->us_css3?></option>
          <?php foreach(glob('css/*.css') as $filename){
            // $rest = substr($filename, 7);
            echo "<option value=".$filename.">".$filename."</li>";
          }
          ?>
        </select>
        <br>
        <strong><h4 align="center">Front End CSS Settings</h4></strong>
        <br>
        <label for="css1"> Primary Color Scheme (Loaded First)</label>
        <select class="form-control" name="css1">
          <option selected="selected"><?=$settings->css1?></option>

          <?php foreach(glob('css/color_schemes/*.css') as $filename){
            // $rest = substr($filename, 7);
            echo "<option value=".$filename.">".$filename."</li>";
          }
          ?>
        </select>

        <br>
        <label for="css2">Secondary Front End CSS (Loaded 2nd)</label>
        <select class="form-control" name="css2">
          <option selected="selected"><?=$settings->css2?></option>
          <?php foreach(glob('css/*.css') as $filename){
            // $rest = substr($filename, 7);
            echo "<option value=".$filename.">".$filename."</li>";
          }
          ?>

        </select>

        <br>
        <label for="css3">Custom Front End CSS (Loaded 3rd)</label>
        <select class="form-control" name="css3">
          <option selected="selected"><?=$settings->css3?></option>
          <?php foreach(glob('css/*.css') as $filename){
            // $rest = substr($filename, 7);
            echo "<option value=".$filename.">".$filename."</li>";
          }
          ?>

        </select>
        Please note that this is a new feature and the included css files are experimental.  You may need to change button colors to get things looking the way you like.  You may also want to consider changing your navbar from navbar-default to navbar-inverse if you don't like the color.
      </form>
    </div>
  </div>
